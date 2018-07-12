<?php
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-todos-documentos'], $conexao_com_banco);
?>

<script type="text/javascript">
var pagina = 0, max = 100, status = '', lugar = 'comigo';
function iniciar_carregamento() {
	$('#tabela-documentos').hide();
	$('#paginacao').hide();
	$('#nao-encontrado').hide();
	$('#erro-busca').hide();
	$('#carregando').show();
}

function finalizar_carregamento() {
	$('#carregando').hide();
	$('#tabela-documentos').show();	
	$('#paginacao').show();	
	var link = 'pdf.php?busca_query='+ $('#search').val() +'&status=' + status + '&lugar=' + lugar;
	$('#relatorio-pdf').attr('href', link);
}

function listar_documentos(nova_pagina) {
	iniciar_carregamento();
	if (!nova_pagina) {
		pagina = 0;
	} else {
		pagina = nova_pagina;
	}
	var query = $('#search').val().replace(/\*/g, "%");
	$.ajax({ 
	url: url + '/sistema/servicos/documentos.php',
	data: {
	 'acao': 'Listar',
	 'query':query,
	 'lugar': lugar,
	 'status': status,
	 'offset': pagina * max,
	 'max': max
	 },
    dataType: 'json',
	type: 'get',
	success: function(data, status, resposta) {
		finalizar_carregamento();
		$('#lista-documentos').empty();
		for (var i = 0; i < data.length; i++) {
			data[i].NM_SERVIDOR_LOCALIZACAO = data[i].NM_SERVIDOR_LOCALIZACAO !== null ? data[i].NM_SERVIDOR_LOCALIZACAO : '';
		var toAppend = '';
		if(data[i].NM_SITUACAO === 'Análise em atraso' || data[i].NM_SITUACAO_FINAL === 'Finalização em atraso') { 
			toAppend += '<tr style="background-color: #e74c3c; color:white;" >';
		} else {
			toAppend += '<tr>';
		}
		toAppend += '<td><a href="../processos/detalhes.php?pagina=geral&processo=' + data[i].CD_PROCESSO + '">' + data[i].CD_PROCESSO + '</a></td>' +
														
		'<td>' + data[i].NM_DOCUMENTO + '</td>' +	
		'<td>' + data[i].NM_SERVIDOR_CRIACAO + '</td>' +	
		'<td>' + data[i].NM_SERVIDOR_LOCALIZACAO + '</td>' +
		'<td>' + data[i].NR_PRIORIDADE + '</td>' +
		'<td>' + data[i].NM_STATUS + '</td>' +	
		'<td>' +
			'<center>' +
				'<a href="detalhes.php?documento=' + data[i].CD_DOCUMENTO + '">' + 
					'<button id="detalhes" type="button" class="btn btn-default btn-sm">' +
						'<i class="fa fa-eye" aria-hidden="true"></i>' +
					'</button>' +
				'</a>' +
			'</center>' +
		'</td>' +
		'<td><center>';
		if (data[i].EDITAR) {
			if(data[i].CD_PROCESSO==''){
				toAppend += '<a href="editar.php?pagina=geral&documento=' + data[i].CD_DOCUMENTO + '">' +
				'<button type="button" class="btn btn-secondary btn-sm" title="Editar">' +
					'<i class="fa fa-pencil" aria-hidden="true"></i>' +
				'</button>' +
			'</a>';
			} else{
				toAppend += '<a href="editar-documento-processo.php?pagina=geral&documento=' + data[i].CD_DOCUMENTO + '">' +
				'<button type="button" class="btn btn-secondary btn-sm" title="Editar">' +
					'<i class="fa fa-pencil" aria-hidden="true"></i>' +
				'</button>' +
			'</a>';
			}
			
		} else { 
			toAppend += '-';
		}
		if (data[i].EXCLUIR) {
			toAppend += '<a href="logica/excluir.php?operacao=documento&documento=' + data[i].CD_DOCUMENTO + '" onclick="return confirm(\'Você tem certeza que deseja apagar este documento?\');">' +
				'<button type="button" class="btn btn-secondary btn-sm" title="Excluir">' +
					'<i class="fa fa-trash" aria-hidden="true"></i>' +
				'</button>' +
			'</a>';
		} else { 
			toAppend += '-';
		}
		toAppend += '</center></td>' +
			'</tr>';			
			$('#lista-documentos').append(toAppend);
		}
		atualizar_total(resposta.getResponseHeader('total'));
	},
	 error: function () {
		$('#tabela-documentos').hide();
		$('#paginacao').hide();
		$('#nao-encontrado').hide();
		$('#carregando').hide();
		$('#erro-busca').show();
    }
	});
}

function criar_paginacao() {
	$('#paginacao').empty();
	var pagina_final = parseInt(total / max);
	var inicio = inicio > pagina_final - 6 ? pagina_final - 6 : inicio;
	inicio = pagina < 4 ? 0 : pagina - 3;
	
	var i = inicio;
	$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_documentos(' + 0 + ')">Inicio</a></li>');
	if (inicio !== 0) {
		$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_documentos(' + (inicio - 1) + ')">&laquo; </a></li>');
	} else {
		$('#paginacao').append('<li class="disabled"><a href="javascript:void(0);">&laquo;</a></li>');
	}
	for (; i <= pagina_final && i < inicio + 7; i++) {
		$('#paginacao').append();
		if (i === pagina) {
		$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_documentos(' + i + ')"><b><u>' + i + '<u></b></a></li>');
		} else {
		$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_documentos(' + i + ')">' + i + '</a></li>');
		}
	}
	if (i < total / max ) {
		$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_documentos(' + i + ')">&raquo</a></li>');
	} else {
		$('#paginacao').append('<li class="disabled"><a href="javascript:void(0);">&raquo</a></li>');		
	}
	$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_documentos(' + pagina_final + ')">Fim</a></li>');
}

window.onload = function() {
	if (getParameterByName('query')) {
		servidor = getParameterByName('query');		
	}
	listar_documentos();
	
	//Solução extraída de https://stackoverflow.com/questions/10318575/jquery-search-as-you-type-with-ajax e https://stackoverflow.com/questions/574941/best-way-to-track-onchange-as-you-type-in-input-type-text
	var thread = null;
	$('#search').on('keyup cut paste', function() {
		iniciar_carregamento();
		clearTimeout(thread);thread = setTimeout(function(){listar_documentos()}, 1000);
	});

}


function listar_lugar(novo_lugar) {
	
	if (novo_lugar !== 'todos') {
		lugar = novo_lugar;
	} else {
		lugar = '';
	}
	$('.lugar').removeClass('ativo');
	$('#listar_lugar_' + novo_lugar).addClass('ativo');
	iniciar_carregamento();
	thread = setTimeout(function(){listar_documentos()}, 1000);
}

function listar_status(novo_status) {
	if (novo_status !== 'todos') {
		status = novo_status;
	} else {
		status = '';
	}
	$('.status').removeClass('ativo');
	
	$('#listar_status_' + novo_status).addClass('ativo');
	
	if (novo_status === 'analise') {
		status = 'Em análise';
	}
	
	iniciar_carregamento();
	thread = setTimeout(function(){listar_documentos()}, 1000);
}


function listar_total(limite) {
	max = limite;
	$('.limite').removeClass('ativo');
	$('#limite_' + limite).addClass('ativo');
	iniciar_carregamento();
	thread = setTimeout(function(){listar_documentos()}, 1000);
}

function atualizar_total(novo_total) {
	$('#total').empty().append('Total: ' + novo_total);
	total = novo_total;
	criar_paginacao();
	if (total == 0) {
		$('#tabela-documentos').hide();
		$('#paginacao').hide();
		$('#nao-encontrado').show();
	} else if (total <= max) {
		$('#tabela-documentos').show();
		$('#paginacao').hide();
		$('#nao-encontrado').hide();
	} else {
		$('#tabela-documentos').show();
		$('#paginacao').show();
		$('#nao-encontrado').hide();
	}
}



</script>

 
<div id="page-content-wrapper">

	<div class="container titulo-pagina">
		<p>Documentos</p>
	</div>
	
	<?php include('../includes/mensagem.php'); ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">						
						<div class="row">
							<div class="col-sm-8">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" placeholder="Buscar por número do documento ou situação ou situação final" id="search" autofocus="autofocus" class="input-search form-control"/>
								</div>
							</div>
							<?php if($_SESSION['permissao-cadastrar-documento']=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastrar.php" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Documento</a>
								</div>
							<?php } ?>

						</div>
						<div class="row">
							<div class="col-sm-4 filter-opt">
								<div><h6>Localização</h6></div>
								<div class="btn-group search lugar" role="group">
									  <a href="javascript:void(0);" onclick = "listar_lugar('comigo');"><button type="button" id="listar_lugar_comigo" class="btn ativo botao-comunicacao lugar">Comigo</button></a>
									  
									  <a href="javascript:void(0);" onclick = "listar_lugar('setor');")><button type="button" id="listar_lugar_setor" class="btn botao-comunicacao lugar">Setor</button></a>
									  <a href="javascript:void(0);" onclick = "listar_lugar('todos');")><button type="button" id="listar_lugar_todos" class="btn  botao-comunicacao lugar">Todas</button></a>								 							  
								</div>
							</div>
							<div class="col-sm-5 filter-opt">
								<div><h6>Status</h6></div>
								<div class="btn-group search" role="group">
									  <a href="javascript:void(0);" onclick = "listar_status('todos');"><button type="button" id="listar_status_todos" class="btn botao-comunicacao status ativo">Todos</button></a>
									  <a href="javascript:void(0);" onclick = "listar_status('aprovado');"><button type="button" id="listar_status_aprovado" class="btn botao-comunicacao status">Aprovado</button></a>
									  <a href="javascript:void(0);" onclick = "listar_status('analise');"><button type="button" id="listar_status_analise" class="btn botao-comunicacao status">Em análise</button></a>
									  <a href="javascript:void(0);" onclick = "listar_status('resolvido');"><button type="button" id="listar_status_resolvido" class="btn botao-comunicacao status">Resolvido</button></a>									  
								</div>
							</div>
							<div class="col-sm-3 filter-opt">
								<div><h6>Quantidade por Página</h6></div>
								<div class="btn-group search" role="group">
									  <a href="javascript:void(0);" onclick = "listar_total(100);")><button type="button" id="limite_100" class="btn ativo botao-comunicacao limite">100</button></a>
									  <a href="javascript:void(0);" onclick = "listar_total(50);")><button type="button" id="limite_50" class="btn botao-comunicacao limite">50</button></a>
									  <a href="javascript:void(0);" onclick = "listar_total(10);"><button type="button" id="limite_10" class="btn botao-comunicacao limite">10</button></a>
																  
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
							<div id="carregando" class="carregando"><i class="fa fa-refresh spin" aria-hidden="true"></i> <span>Carregando dados...</span></div>
							<div id="nao-encontrado" class="carregando"><i class="fa fa-search-minus" aria-hidden="true"></i> <span>Não foram encontradas ocorrências para essa busca.</span></div>
							<div id="erro-busca" class="carregando"><i class="fa fa-times" aria-hidden="true" style="color: #e74c3c;"></i> <span>O servidor se comportou de maneira inesperada e não foi possível completar sua busca.</br> Caso o erro persista, entre em contato com o suporte.</span></div>
					</div>
					<div class="col-md-12 table-responsive" id="tabela-documentos" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
										<th>Processo relacionado</th>
										<th>Tipo</th>
										<th>Criado por</th>
										<th>Está com</th>
										<th>Prioridade</th>
										<th>Status</th>
										<th><center>+</center></th>
										<th><center><i class="fa fa-pencil" aria-hidden="true"></center></i></th>
								</tr>	
							</thead>
							<tbody id="lista-documentos">
									
							</tbody>
						</table>
					</div>					
				</div>
				<ul class="paginacao" id="paginacao"></ul>
				
			</div>
		</div>
	</div>
<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="total"></div>
	
</div>

<?php include('../foot.php')?>