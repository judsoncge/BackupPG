<script type="text/javascript">
	var sessionId = getParameterByName('sessionId');
	var total = -1;
	var started = false;
	var loading = false;
	var url ='<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  echo $actual_link; ?>';
	if (url.indexOf('.br') !== -1) {
		url = url.substr(0, url.indexOf('.br') + 3);	
	} else {
		url = url.substr(0, url.indexOf(':8080') + 5) + '/pg';
	}
	
	(function(){
		verificar_notificacoes(5000);
		$(window).click(function() {
			 $("#container-notificacao").hide();
		});

		$('#container-notificacao').click(function(event){
			event.stopPropagation();
		});
		})();
	function listar_novas_notificacoes(max) {
		$.ajax({ 
		url: url + '/servicos/notificacao.php',
		data: {
		 'acao': 'Recentes',
		 'sessionId':sessionId,
		 'max':max
		 },
		type: 'get',
		success: function(data) {
			data = $.parseJSON(data);			
				var texto, i = 0, link, div_id;						
				for (i = 0; i < data.length; i++) {
					link = data[i].LINK_NOTIFICACAO !== undefined && data[i].LINK_NOTIFICACAO !== null ? data[i].LINK_NOTIFICACAO: '';
					if (link.indexOf('sessionId') == -1) {
						if (link.indexOf('?') == -1) {
							link += '?sessionId=' + sessionId;
						} else {
							link += '&sessionId=' + sessionId;
						}
					}
					div_id = 'alert-show-'+data[i].ID;
					texto = '<a href="javascript:void(0)" onclick="redirecionar(' + data[i].ID + ', \'' + url + '/interface/' + link + '\')">' + data[i].TX_MENSAGEM + '</a>';
					texto = '<div class="alert alert-info" id="' +  div_id + '">' +
					texto +
   				    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
					'<span aria-hidden="true">&times;</span>' +
					'</button>' +
					'</div>';
					$("#caixa-alerta").prepend(texto);
					$('#' + div_id).fadeIn(3000,function(){
						$('#' + div_id).fadeOut(5000);
					});
					
				}
				//if (data.length > 0 ){
					//tocar_musica();
				//}
			
		}
		});
	}
	function tocar_musica(){   
	var filename = '../componentes/audio/icq-message.wav';
                document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="' + filename + '" type="audio/mpeg" /><source src="' + filename + '" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + filename +'" /></audio>';
	}

	function verificar_notificacoes(tempo_limite) {
		$.ajax({ url: url + '/servicos/notificacao.php',
         data: {
			 'acao': 'Verificar',
			 'sessionId':sessionId
			 },
         type: 'get',
         success: function(data) {
					  var temp = $.parseJSON(data)[0];
					  total = total === -1 ? temp : total;
					  if (temp != total && temp > total) {
						  listar_novas_notificacoes(temp - total);
					  }
					  total = temp;
					  if (total > 0) {
						$('#notificacao-icone').addClass('nova');
						$('#alerta-notificacao').empty().append(total);
						$('#alerta-notificacao').show();
					  } else {
						$('#notificacao-icone').removeClass('nova');  
						$('#alerta-notificacao').hide();
					  }
					  if (tempo_limite && tempo_limite > 0) {
						setTimeout(function (){verificar_notificacoes(tempo_limite);},tempo_limite);  
					  }
					  
                  }
		});		
	}
	function getParameterByName(name, url) {
		if (!url) {
		  url = window.location.href;
		}
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
	
	function exibir_notificacoes() {
		$("#container-notificacao").empty();
		started = false;
		pre_visualizar();
		buscar_notificacoes();
	}
	function buscar_notificacoes(offset) {
	if (!loading) {	
		loading = true;
			offset = offset ? offset : 0;
			$.ajax({ url: url + '/servicos/notificacao.php',
		 data: {
			 'acao': 'Listar',
			 'sessionId':sessionId,
			 'offset': offset
			 },
		 type: 'get',
		 success: function(data) {
				data = $.parseJSON(data);
				var texto, i = 0, link;						
				for (i = 0; i < data.length; i++) {
					link = data[i].LINK_NOTIFICACAO !== undefined? data[i].LINK_NOTIFICACAO: '';
					if (link.indexOf('sessionId') == -1) {
						if (link.indexOf('?') == -1) {
							link += '?sessionId=' + sessionId;
						} else {
							link += '&sessionId=' + sessionId;
						}
					}
					texto = '<a href="javascript:void(0)" onclick="redirecionar(' + data[i].ID + ', \''+ url + '/interface/' + link + '\')"><li class="resumo-notificacao';
					if (data[i].NM_STATUS === 'NOVA' || data[i].NM_STATUS === 'PRE-VISUALIZADA') {
						texto += ' nova'; 
					}
					texto += '" id="'+ data[i].ID + '">' + data[i].TX_MENSAGEM + '</li></a>';
					
					$("#container-notificacao").append(texto);									
				}  
				$("#container-notificacao").show();
				if (data.length == 5) {
					started = true;
				$('#container-notificacao').bind('scroll', function() {								  
						if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight)
						{							
							offset += 5;
							if (!loading) {
								buscar_notificacoes(offset);
							}
							loading = true;							
						}
				
					  });
				} else if (data.length < 5) {
					$('#container-notificacao').unbind('scroll')
				}				
				 loading = false;
				 
		 }
		});
	}
}
	
	function redirecionar(id, link) {
		$.ajax({ 
		url: url + '/servicos/notificacao.php',
		data: {
		 'acao': 'Marcar Lido',
		 'sessionId':sessionId,
		 'notificacao':id
		 },
		type: 'get',
		success: function() {
			$('#li-notificacao-' + id).removeClass('nova');
			verificar_notificacoes();
			window.location = link;
		}
		});	
		
	}
	
	function pre_visualizar() {
		$.ajax({ 
		url: url + '/servicos/notificacao.php',
		data: {
		 'acao': 'Marcar Lido',
		 'sessionId':sessionId
		 },
		type: 'get',
		success: function() {
			verificar_notificacoes(0);
		}
		});	
		
	}
</script>

    
<span style="display: none;" class="alerta-notificacao" id="alerta-notificacao"></span>