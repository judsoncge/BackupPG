<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-atividade'], $conexao_com_banco);
?>
<script type="text/javascript">
var atividade = '';

window.onload = function () {
//$(".quadro-tarefas-corpo").height($(window).height() - 20);
var dropSpace = $(window).width() - $(".quadro-tarefas-corpo").width();
$("#dropZone").width(dropSpace - 70);
$("#dropZone").height($(".quadro-tarefas-corpo").height());

$(".cartao").draggable({
    appendTo: "body",
    cursor: "move",
    helper: 'clone',
    revert: "invalid"
});

$("#tarefas-a-fazer").droppable({
    tolerance: "intersect",
    accept: ".cartao",
    activeClass: "ui-state-default",
    hoverClass: "ui-state-hover",
    drop: function(event, ui) {
        $("#tarefas-a-fazer").append($(ui.draggable));
    }
});
$("#tarefas-em-andamento").droppable({
    tolerance: "intersect",
    accept: ".cartao",
    activeClass: "ui-state-default",
    hoverClass: "ui-state-hover",
    drop: function(event, ui) {
        $("#tarefas-em-andamento").append($(ui.draggable));
    }
});

$("#tarefas-finalizadas").droppable({
    tolerance: "intersect",
    accept: ".cartao",
    activeClass: "ui-state-default",
    hoverClass: "ui-state-hover",
    drop: function(event, ui) {
		var div_id = $(ui.draggable).attr('id'); atividade_id = $(ui.draggable).attr('id').substr($(ui.draggable).attr('id').lastIndexOf('-') + 1);
        $("#tarefas-finalizadas").append($(ui.draggable));
		verificar_conclusao(atividade_id);
		
    }
});

}
function verificar_conclusao(atividade_id) {
	$.ajax({ 
		url: url + '/sistema/servicos/atividades.php',
		data: {
		 'acao': 'Finalizar',
		 'sessionId':sessionId,
		 'id': atividade_id
		 },
		type: 'get',
		success: function(data) {
			$('#status-'+atividade_id).empty().append($.trim(data).toLowerCase());
			if ($.trim(data).toLowerCase() === 'falta anexo') {
				$('#anexos-' + atividade_id).show();
			} else {
				$('#anexos-' + atividade_id).hide();
			}
		}});
}

function criar_atividade_container(atividade) {
	var texto = '', venceu = true, display= 'display: none;';
	if ( new Date(atividade.DT_VENCIMENTO) >= new Date().setHours(0,0,0,0)) {
		venceu = false;
	}
		if ($.trim(atividade.NM_STATUS).toLowerCase() === 'falta anexo') {
		display = '';
	}
	texto = '<div class="cartao" id="cartao-' + atividade.CD_ATIVIDADE + '">' +
	'<div><span class="cartao-status"> Status: </span>';
	if (venceu) {
		texto += '<span style="color: red; text-transform: capitalize;" id="status-' + atividade.CD_ATIVIDADE + '">' + atividade.NM_STATUS.toLowerCase() + '</span>';
	} else {
		texto += '<span style="color: green; text-transform: capitalize;" id="status-' + atividade.CD_ATIVIDADE + '">' + atividade.NM_STATUS.toLowerCase() + '</span>';
	}
	
	texto += '</div>'+
		'<div>' +
			atividade.TX_DESCRICAO + 
		' <\div>' +
		'<div id="anexos-' + atividade.CD_ATIVIDADE + '" style="' + display + ' margin-top: 5px; border-top: 1px solid rgba(0,0,0,0.1); padding-top: 2px; font-size: 12px;">' +
				'<div>'+
				'<form id="atividade-anexo-' + atividade.CD_ATIVIDADE + '" method="POST" action="logica/cadastrar-anexo.php" method="post" enctype="multipart/form-data" >' +
				'<input type="hidden" name="id_referente" value="' + atividade.CD_ATIVIDADE + '">' +
					'<label class="control-label" style="color:red; font-weight: bold;"for="anexo-' + atividade.CD_ATIVIDADE + '">Adicione um anexo que comprove que a tarefa foi finalizada</label><br>' +
					'<input type="file" class="" name="anexo-' + atividade.CD_ATIVIDADE + '" id="anexo-' + atividade.CD_ATIVIDADE + '" single required/> <input id="anexo-botao-' + atividade.CD_ATIVIDADE + '" type="button" value="Enviar" onclick="enviar_form(' + atividade.CD_ATIVIDADE + ');" />'+
					'<i id="anexo-carregando-' + atividade.CD_ATIVIDADE + '"class="fa fa-refresh fa-spin fa-3x fa-fw" style="font-size: 14px; display:none;"></i>' +
					'<br>' +
				'</form></div>' +
		'</div>' +
		' <div style="margin-top: 5px; border-top: 1px solid rgba(0,0,0,0.1); padding-top: 2px;"><i><small>Vence em  <b>' + formatar_data(new Date(atividade.DT_VENCIMENTO))+ '<b><small><i></div></div>';	
	
	return texto;
}
function enviar_form(id) {
	if($('#anexo-' + id).val() !== ''){
		$('#atividade-anexo-' + id).submit();
		verificar_conclusao(id);
	}
}

function listar_atividades_tipo() {
	$.ajax({ 
	url: url + '/sistema/servicos/atividades.php',
	data: {
	 'acao': 'Listar Abertas Tipo',
	 'sessionId':sessionId,
	 'id': atividade
	 },
	type: 'get',
	success: function(data) {
		data = $.parseJSON(data);			
		var i = 0, link, div_id, venceu = false;
		$("#tarefas-a-fazer").empty();		
		if (data.length > 0) {
			for (i = 0; i < data.length; i++) {				
				$("#tarefas-a-fazer").append(criar_atividade_container(data[i]));	
				
				
			}		
		$(".cartao").draggable({
			appendTo: "body",
			cursor: "move",
			helper: 'clone',
			revert: "invalid"
		});
		}	
		
		
	}
	});
}

function listar_atividades_finalizadas() {
	$.ajax({ 
	url: url + '/sistema/servicos/atividades.php',
	data: {
	 'acao': 'Listar Finalizadas Tipo',
	 'sessionId':sessionId,
	 'id':atividade
	 },
	type: 'get',
	success: function(data) {
		data = $.parseJSON(data);			
		var i = 0, link, div_id;	
		$("#tarefas-finalizadas").empty();		
		if (data.length > 0) {
			for (i = 0; i < data.length; i++) {	
				
				$("#tarefas-finalizadas").append(criar_atividade_container(data[i]));	
			}
		$(".cartao").draggable({
			appendTo: "body",
			cursor: "move",
			helper: 'clone',
			revert: "invalid"
		});
		}	
		
		
	}
	});
}

(function(){
	atividade = pegar_parametro_query('atividade');
	listar_atividades_tipo();
	listar_atividades_finalizadas();
})();


</script>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
		<p>Todas as minhas atividades</p>
	</div>
  <div class="container caixa-conteudo">
    <div class="row">
      <div class="col-md-12" style="margin-left: 20px;">
        <h3>Tarefas</h3>
      </div>
    </div>
    <div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" >
			<div class="quadro-tarefas-titulo">
				Para fazer
			</div>	
			<div class="quadro-tarefas-a-fazer quadro-tarefas-corpo" id="tarefas-a-fazer" style="height: 100%;">			
			</div>
		
		</div>
      </div>     
	  <div class="col-md-6">
        <div class="grafico">
			<div class="quadro-tarefas-titulo">
				Finalizada
			</div>
			<div class="quadro-tarefas-corpo" id="tarefas-finalizadas" style="height: 100%;">
			</div>
		</div>
      </div>
    </div>  
	
</div>