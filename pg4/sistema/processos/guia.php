<?php
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-todos-processos'], $conexao_com_banco);
?>

	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jspdf.min.js"></script>
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jspdf.plugin.autotable.js"></script>
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jquery.techbytarun.excelexportjs.min.js"></script>
	
<script type="text/javascript">
var pagina = 0, max = 100, status = '', lugar = '', setor = '', situacao = '';

function iniciar_carregamento() {
	$('#tabela-processos').hide();
	$('#paginacao').hide();
	$('#nao-encontrado').hide();
	$('#erro-busca').hide();
	$('#carregando').show();
}

function finalizar_carregamento() {
	$('#carregando').hide();
	$('#tabela-processos').show();	
	$('#paginacao').show();	
}

function listar_processos() {
	iniciar_carregamento();	
	$.ajax({ 
	url: url + '/sistema/servicos/processos.php',
	data: {
	 'acao': 'Listar Tramitacao',
	 },
    dataType: 'json',
	type: 'get',
	success: function(data, status, resposta) {
		var apensos = {}, cd_processo;
		if (data.length > 0) {
		$('#lista-processos').empty();
		for (var i = 0; i < data.length; i++) {
		cd_processo = data[i].CD_PROCESSO.replace(/ /g, '_').replace(/\//g, '_');
		
		data[i].NM_ASSUNTO = !data[i].NM_ASSUNTO ? 'Não definido' : data[i].NM_ASSUNTO;
		var toAppend;
		if (data[i].CD_APENSADO === '') {	
			toAppend = '<tr id="status-tramitacao-' + cd_processo + '">';
		} else {	
			toAppend = '<tr  class="apenso" id="status-tramitacao-' + cd_processo + '">';
		}
		if (data[i].NR_URGENCIA === '0') {
			toAppend += '<td style="width: 10px;"> </td>';
		} else {
			toAppend += '<td class="text-center" style="width: 10px"><i class="fa fa-exclamation-triangle"><i></td>';	
		}
		 toAppend +=	'<td > <a href="detalhes.php?pagina=geral&processo=' + data[i].CD_PROCESSO + '">';
		if (data[i].CD_APENSADO === '') {	
			toAppend +=  data[i].CD_PROCESSO;
		} else {	
			toAppend += data[i].CD_PROCESSO + ' (APENSO)';
		}


		toAppend += '</a></td>' +
		'<td >' + data[i].NM_SERVIDOR_ORIGEM + '</td>' +
		'<td >' + data[i].NM_ASSUNTO + '</td>' +		
		'<td class="text-center">' + formatar_data2(data[i].DT_TRAMITACAO) + '</td>';
		if (data[i].CD_APENSADO === '') {	
				toAppend +='<td class="text-center"><a id="aceitar-' + data[i].CD_TRAMITACAO +'" class="confirma-processo-recebido" href="javascript:void(0);" onclick="atualizar_status(' + data[i].CD_TRAMITACAO +', 1 ,\'' + cd_processo + '\');"><i class="fa fa-thumbs-up "></i></a><a id="recusar-' + data[i].CD_TRAMITACAO +'" class="nega-processo-recebido" href="javascript:void(0);" onclick="atualizar_status(' + data[i].CD_TRAMITACAO +', 2 ,\'' + cd_processo +'\');"><i class="fa fa-thumbs-down "></i></a></td>';
		} else {
				toAppend += '<td></td>'
		}
		toAppend +='</tr>';
			

			if (data[i].CD_APENSADO !== '') {	
				if (!apensos[data[i].CD_APENSADO]) {
					apensos[data[i].CD_APENSADO] = [];
				}
				apensos[data[i].CD_APENSADO].push(toAppend);
			} else {	
				if ( !$( '#lista-processos-' + data[i].SETOR ).length ) {
	 
					$("#lista-processos").append('<div class="guia-subtitulo"><div> Setor: ' + data[i].SETOR + '</div></div>' +
						'<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; max-height: 300px; margin-bottom: 10px;">' +
						'<table class="table table-hover tabela-dados">' +
						'<thead>' +
							'<tr>' +
								'<th></th>' +
								'<th>Processo</th>' +
								'<th>Servidor</th>' +
								'<th>Assunto</th>' +
								'<th class="text-center">Data de tramitação</th>' +
								'<th class="text-center">Recebido</th>' +									
							'</tr>' +	
						'</thead>' +
						'<tbody id="lista-processos-' + data[i].SETOR + '" class="table-body-guia">' +									
						'</tbody>' +
					'</table>' +
					'</div>');
				 
				}	
				$('#lista-processos-' + data[i].SETOR).append(toAppend);
			}			
		}		
			$.each(apensos, function (i, val) {
				cd_processo = i.replace(/ /g, '_').replace(/\//g, '_');
				for (var j = 0; j < val.length; j++) {					
					$('#status-tramitacao-' + cd_processo).after(val[j]);
				}
			});
		finalizar_carregamento();
		} else {
		finalizar_carregamento();
		$("#lista-processos").append('<div id="carregando" class="carregando" style="display: block;"><span>Não foi possível encontrar tramitações pendentes</span></div>'); 
		}
	},
	 error: function () {
		$('#tabela-processos').hide();
		$('#paginacao').hide();
		$('#nao-encontrado').hide();
		$('#carregando').hide();
		$('#erro-busca').show();
    }
	});
}

function atualizar_status(id, status, cd_processo) {
	$('#aceitar-' + id).prop('onclick',null).off('click');
	$('#recusar-' + id).prop('onclick',null).off('click');
	$.ajax({ 
	url: url + '/sistema/servicos/processos.php',
	data: {
	 'acao': 'Tramitacao',
	 'id_tramitacao': id,
	 'status': status
	 },
	type: 'get',
	dataType: 'json',
	success: function(data) {
		if (status === 1) {
			$('#status-tramitacao-' + cd_processo).addClass('guia-processo-recebido').removeClass('guia-processo-rejeitado');
		} else if (status === 2){
			$('#status-tramitacao-' + cd_processo).addClass('guia-processo-rejeitado').removeClass('guia-processo-recebido');
		} else {
			listar_processos2();
		}
	}
	});
	
		
	
}

function iniciar_carregamento2() {
	$('#tabela-processos2').hide();
	$('#paginacao2').hide();
	$('#nao-encontrado2').hide();
	$('#erro-busca2').hide();
	$('#carregando2').show();
}

function finalizar_carregamento2() {
	$('#carregando2').hide();
	$('#tabela-processos2').show();	
	$('#paginacao2').show();	
}

function listar_processos2() {
	iniciar_carregamento2();	
	$.ajax({ 
	url: url + '/sistema/servicos/processos.php',
	data: {
	 'acao': 'Listar Tramitacao Enviada',
	 },
    dataType: 'json',
	type: 'get',
	success: function(data, status, resposta) {
		var apensos = {}, cd_processo;
		$('#lista-processos2').empty();
		if (data.length > 0) {		
		for (var i = 0; i < data.length; i++) {		
		cd_processo = data[i].CD_PROCESSO.replace(/ /g, '_').replace(/\//g, '_');		
		data[i].NM_ASSUNTO = !data[i].NM_ASSUNTO ? 'Não definido' : data[i].NM_ASSUNTO;
				var toAppend;
			if (data[i].CD_APENSADO === '') {	
				toAppend = '<tr id="status-tramitacao-' + cd_processo + '">';
			} else {	
				toAppend = '<tr  class="apenso" id="status-tramitacao-' + cd_processo + '">';
			}
		if (data[i].NR_URGENCIA === '0') {
			toAppend += '<td style="width: 10px;"> </td>';
		} else {
			toAppend += '<td class="text-center" style="width: 10px"><i class="fa fa-exclamation-triangle"><i></td>';	
		}
		  toAppend +=	'<td > <a href="detalhes.php?pagina=geral&processo=' + data[i].CD_PROCESSO + '">';
		  
		if (data[i].CD_APENSADO === '') {	
			toAppend +=  data[i].CD_PROCESSO;
		} else {	
			toAppend += data[i].CD_PROCESSO + ' (APENSO)';
		}


		toAppend += '</a></td>' +
		'<td >' + data[i].NM_SERVIDOR_DESTINO + '</td>' +
		'<td >' + data[i].NM_ASSUNTO + '</td>' +		
		'<td class="text-center">' + formatar_data2(data[i].DT_TRAMITACAO) + '</td>' +	
		'<td class="text-center"> <a href="javascript:void(0);" onclick="return confirm(\'Deseja cancelar essa tramitação?\')? atualizar_status(' + data[i].CD_TRAMITACAO +', 3 ,\'' + cd_processo + '\'):\'\'"> <i class="fa fa-remove"><i></a></td>';
		'</tr>';
				
			if (data[i].CD_APENSADO !== '') {	
				if (!apensos[data[i].CD_APENSADO]) {
					apensos[data[i].CD_APENSADO] = [];
				}
				apensos[data[i].CD_APENSADO].push(toAppend);
			} else {	
				if ( !$( '#lista-processos2-' + data[i].SETOR ).length ) {
 
					$("#lista-processos2").append('<div class="guia-subtitulo"><div> Setor: ' + data[i].SETOR + '</div></div>' +
						'<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; max-height: 300px; margin-bottom: 10px;">' +
						'<table class="table table-hover tabela-dados">' +
						'<thead>' +
							'<tr>' +
								'<th></th>' +
								'<th>Processo</th>' +
								'<th>Servidor</th>' +
								'<th>Assunto</th>' +
								'<th class="text-center">Data de Tramitação</th>' +
								'<th class="text-center">Cancelar Tramitação</th>' +

							'</tr>' +	
						'</thead>' +
						'<tbody id="lista-processos2-' + data[i].SETOR + '" class="table-body-guia">' +									
						'</tbody>' +
					'</table>' +
					'</div>');
				 
				}	
				$('#lista-processos2-' + data[i].SETOR).append(toAppend);
			}			
		}		
			$.each(apensos, function (i, val) {
				cd_processo = i.replace(/ /g, '_').replace(/\//g, '_');
				for (var j = 0; j < val.length; j++) {					
					$('#status-tramitacao-' + cd_processo).after(val[j]);
				}
			});
		
		finalizar_carregamento2();
		} else {
		finalizar_carregamento2();
		$("#lista-processos2").append('<div id="carregando" class="carregando" style="display: block;"><span>Não foi possível encontrar tramitações pendentes</span></div>'); 
		}
	},
	 error: function () {
		$('#tabela-processos2').hide();
		$('#paginacao2').hide();
		$('#nao-encontrado2').hide();
		$('#carregando2').hide();
		$('#erro-busca2').show();
    }
	});
}

window.onload = function() {
	listar_processos();
	listar_processos2();
}

</script>

 
<div id="page-content-wrapper">

	<div class="container titulo-pagina">
		<p>Guia de Tramitação (Recebido)</p>
	</div>
	
	<?php include('../includes/mensagem.php'); ?>
	<div class="container caixa-conteudo">

					<div class="col-md-12">
							<div id="carregando" class="carregando"><i class="fa fa-refresh spin" aria-hidden="true"></i> <span>Carregando dados...</span></div>
							<div id="nao-encontrado" class="carregando"><i class="fa fa-search-minus" aria-hidden="true"></i> <span>Não foram encontradas ocorrências para essa busca.</span></div>
							<div id="erro-busca" class="carregando"><i class="fa fa-times" aria-hidden="true" style="color: #e74c3c;"></i> <span>O servidor se comportou de maneira inesperada e não foi possível completar sua busca.</br> Caso o erro persista, entre em contato com o suporte.</span></div>
					</div>
					<div id="lista-processos">
						
					</div>					
				</div>

				
				<div class="container titulo-pagina" style="margin-top: 30px;">
		<p>Guia de Tramitação (Enviado)</p>
	</div>
	
	
	<div class="container caixa-conteudo">

					<div class="col-md-12">
							<div id="carregando2" class="carregando"><i class="fa fa-refresh spin" aria-hidden="true"></i> <span>Carregando dados...</span></div>
							<div id="nao-encontrado2" class="carregando"><i class="fa fa-search-minus" aria-hidden="true"></i> <span>Não foram encontradas ocorrências para essa busca.</span></div>
							<div id="erro-busca2" class="carregando"><i class="fa fa-times" aria-hidden="true" style="color: #e74c3c;"></i> <span>O servidor se comportou de maneira inesperada e não foi possível completar sua busca.</br> Caso o erro persista, entre em contato com o suporte.</span></div>
					</div>
					<div id="lista-processos2">
						
					</div>					
				</div>

				
			</div>
		</div>
	</div>	
	
	
			</div>
		</div>
	</div>	
</div>



<?php include('../foot.php')?>