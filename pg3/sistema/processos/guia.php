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
		
		if (data.length > 0) {
		$('#lista-processos').empty();
		for (var i = 0; i < data.length; i++) {
			data[i].NM_SERVIDOR_LOCALIZACAO = data[i].NM_SERVIDOR_LOCALIZACAO !== null ? data[i].NM_SERVIDOR_LOCALIZACAO : '';
		var toAppend = '<tr id="status-tramitacao-' + data[i].CD_TRAMITACAO + '">' +
		'<td > <a href="detalhes.php?processo=' + data[i].CD_PROCESSO + '">' + data[i].CD_PROCESSO + '</a></td>' +
		'<td >' + data[i].NM_SERVIDOR_ORIGEM + '</td>' +												
		'<td class="text-center">' + formatar_data2(data[i].DT_TRAMITACAO) + '</td>' +	
		'<td class="text-center"><a id="aceitar-' + data[i].CD_TRAMITACAO +'" class="confirma-processo-recebido" href="javascript:void(0);" onclick="atualizar_status(' + data[i].CD_TRAMITACAO +', 1 );"><i class="fa fa-thumbs-up "></i></a><a id="recusar-' + data[i].CD_TRAMITACAO +'" class="nega-processo-recebido" href="javascript:void(0);" onclick="atualizar_status(' + data[i].CD_TRAMITACAO +', 2 );"><i class="fa fa-thumbs-down "></i></a></td>'+
		'</tr>';
			if ( !$( '#lista-processos-' + data[i].SETOR ).length ) {
 
				$("#lista-processos").append('<div class="guia-subtitulo"><div> Setor: ' + data[i].SETOR + '</div></div>' +
					'<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; max-height: 300px; margin-bottom: 10px;">' +
					'<table class="table table-hover tabela-dados">' +
					'<thead>' +
						'<tr>' +
							'<th>Processo</th>' +
							'<th>Servidor</th>' +
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

function atualizar_status(id, status) {
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
		$('#aceitar-' + id).prop('onclick',null).off('click');
		$('#recusar-' + id).prop('onclick',null).off('click');
		if (status === 1) {
			$('#status-tramitacao-' + id).addClass('guia-processo-recebido').removeClass('guia-processo-rejeitado');
		} else {
			$('#status-tramitacao-' + id).addClass('guia-processo-rejeitado').removeClass('guia-processo-recebido');
		}
	}
	});
	
		
	
}

window.onload = function() {
	listar_processos();
}

</script>

 
<div id="page-content-wrapper">

	<div class="container titulo-pagina">
		<p>Guia de Tramitação</p>
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

				
			</div>
		</div>
	</div>	
</div>



<?php include('../foot.php')?>