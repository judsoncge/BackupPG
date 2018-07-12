<?php
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-todos-processos'], $conexao_com_banco);
?>

	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jspdf.min.js"></script>
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jspdf.plugin.autotable.js"></script>
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jquery.techbytarun.excelexportjs.min.js"></script>
	
<script type="text/javascript">
var pagina = 0, max = 100, status = '', orgao = '', setor = '', situacao = '', dt_inicial ='', dt_final = '', servidor = '', assunto = '';
<?php if($_SESSION["cargo"] != "Controlador Geral"){ echo "setor = '".$_SESSION['setor']."';"; }?>

function organizar_dados (dados) {
	if (!dados.CD_SERVIDOR_RESPONSAVEL || dados.CD_SERVIDOR_RESPONSAVEL == '') {
		dados.CD_SERVIDOR_RESPONSAVEL = "Não definido";
	}
	if (!dados.NM_ORGAO || dados.NM_ORGAO == '') {
		dados.NM_ORGAO = "Não definido";
	}
	if (!dados.VLR_PROCESSO || dados.VLR_PROCESSO == '') {
		dados.VLR_PROCESSO = "0";
	}
		dados.VLR_PROCESSO = parseFloat(dados.VLR_PROCESSO).toFixed(2) + ' R$';
	if (!dados.NM_INTERESSADO || dados.NM_INTERESSADO == '') {
		dados.NM_INTERESSADO = "Não definido";
	}
	if (!dados.NM_ASSUNTO || dados.NM_ASSUNTO == '') {
		dados.NM_ASSUNTO = "Não definido";
	}
	if (!dados.NM_SERVIDOR_RESPONSAVEL || dados.NM_SERVIDOR_RESPONSAVEL == '') {
		dados.NM_SERVIDOR_RESPONSAVEL = "Não definido";
	}
	if (!dados.NM_SUPERINTENDENTE_RESPONSAVEL || dados.NM_SUPERINTENDENTE_RESPONSAVEL == '') {
		dados.NM_SUPERINTENDENTE_RESPONSAVEL = "Não definido";
	}
	if (!dados.DT_ENTRADA || dados.DT_ENTRADA == '' || dados.DT_ENTRADA == "0000-00-00 00:00:00") {
		dados.DT_ENTRADA = "Não definido";
	} else {
		dados.DT_ENTRADA = formatar_data2(dados.DT_ENTRADA);
	}
	if (!dados.DT_SAIDA || dados.DT_SAIDA == '' || dados.DT_SAIDA == "0000-00-00 00:00:00") {
		dados.DT_SAIDA = "Não definido";
	} else {
		dados.DT_SAIDA = formatar_data2(dados.DT_SAIDA);
	}
	if (!dados.DT_DISTRIBUICAO_TECNICO || dados.DT_DISTRIBUICAO_TECNICO == '' || dados.DT_DISTRIBUICAO_TECNICO == "0000-00-00 00:00:00") {
		dados.DT_DISTRIBUICAO_TECNICO = "Não definido";
	} else {
		dados.DT_DISTRIBUICAO_TECNICO = formatar_data2(dados.DT_DISTRIBUICAO_TECNICO);
	}
	if (!dados.DT_DEVOLUCAO_TECNICO || dados.DT_DEVOLUCAO_TECNICO == '' || dados.DT_DEVOLUCAO_TECNICO == "0000-00-00 00:00:00") {
		dados.DT_DEVOLUCAO_TECNICO = "Não definido";
	} else {
		dados.DT_DEVOLUCAO_TECNICO = formatar_data2(dados.DT_DEVOLUCAO_TECNICO);
	}
	if (!dados.DT_ARQUIVADO || dados.DT_ARQUIVADO == '' || dados.DT_ARQUIVADO == "0000-00-00 00:00:00") {
		dados.DT_ARQUIVADO = "Não definido";
	} else {
		dados.DT_ARQUIVADO = formatar_data2(dados.DT_ARQUIVADO);
	}
	return dados;
}
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

var contentEdited = false;
function fn($el) {
  if (contentEdited) {
    var text = $el[0].innerText.trim();
	var valor = parseFloat(text.replace(',', '.')), id = $el.data('id');
    $($el[0]).html('<i class="fa fa-refresh spinner" aria-hidden="true"></i>');
	contentEdited = false;	
	$.ajax({ 
	url: url + '/sistema/servicos/processos.php',
	data: {
	 'acao': 'Atualizar Valor Acompanhamento',
	 'valor':valor,
	 'id': id	 
	 },
    dataType: 'json',
	type: 'get',
	success: function(data) {
		if(data.status == 'Ok') {
			$el[0].innerText = formatar_numero(valor) + ' R$';
		} else {
			$($el[0]).html('<i class="fa fa-times" aria-hidden="true" style="color: #e74c3c;"></i>');	
		}		
	},
	 error: function () {
		 $($el[0]).html('<i class="fa fa-times" aria-hidden="true" style="color: #e74c3c;"></i>');
    }
	});
  }
}



function formatar_numero(num) {
	return (parseFloat(num).toFixed(2) + '').replace('.',',');
}

function listar_setor(novo_setor) {		
	setor = novo_setor;
	iniciar_carregamento();
	$('.lugar').removeClass('ativo');
	if(novo_setor !=='todos') {
		$('#listar-lugar-setor').addClass('ativo');
		$('#setor-' + novo_setor).addClass('ativo');	
	} else {
		setor = '';
	}
	
	atualizar_lista_servidor();
	atualizar_lista_assuntos();
	
	
	
	thread = setTimeout(function(){listar_processos()}, 1000);
	
	
	
}

function atualizar_lista_servidor() {
	$('#carregando-setor-servidor').show();
	$.ajax({ 
	url: url + '/sistema/servicos/setor.php',
	data: {
	 'acao': 'Listar Tecnicos',
	 'setor':setor,
	},
    dataType: 'json',
	type: 'get',
	success: function(data) {
		$('#carregando-setor-servidor').hide();
		$('#filtro-servidor option:gt(0)').remove();	
		for (var i = 0; i < data.length; i++) {
			var opt = $('<option></option>').attr('value', data[i].CD_SERVIDOR).text(data[i].NM_SERVIDOR_COMPLETO);
			$('#filtro-servidor').append(opt);
		}
		
	}
	});
	
}

function atualizar_lista_assuntos() {
	$('#carregando-setor-assunto').show();
	$.ajax({ 
	url: url + '/sistema/servicos/setor.php',
	data: {
	 'acao': 'Listar Assuntos',
	 'setor':setor,
	},
    dataType: 'json',
	type: 'get',
	success: function(data) {
		$('#carregando-setor-assunto').hide();
		$('#filtro-assunto option:gt(0)').remove();
		for (var i = 0; i < data.length; i++) {
			var opt = $('<option></option>').attr('value', data[i].ID).text(data[i].NM_ASSUNTO);
			$('#filtro-assunto').append(opt);
		}
		
	}
	});
	
}

function listar_processos(nova_pagina) {
	iniciar_carregamento();
	if (!nova_pagina) {
		pagina = 0;
	} else {
		pagina = nova_pagina;
	}
	var query = $('#search').val().replace(/\*/g, "%");
	$.ajax({ 
	url: url + '/sistema/servicos/processos.php',
	data: {
	 'acao': 'Listar Acompanhamento',
	 'query':query,
	 'dt_inicial': dt_inicial,
	 'dt_final': dt_final,
	 'servidor': servidor,
	 'assunto': assunto,
	 'orgao': orgao,
	 'offset': pagina * max,
	 'setor': setor,
	 'max': max
	 },
    dataType: 'json',
	type: 'get',
	success: function(data, status, resposta) {
		finalizar_carregamento();
		$('#lista-processos').empty();
		var monthMap = {};
		var month = '';
		var nomes_mes = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
		for (var i = 0; i < data.length; i++) {			
			month = new Date(data[i].DT_ENTRADA);
			month = month.getMonth() + '/' + month.getFullYear();
			console.log( data[i].DT_ENTRADA + ' - ' + data[i].DT_ENTRADA + ' - ' + month);
			if ( !monthMap[month]) {
				monthMap[month] = [];
			}
			monthMap[month].push(data[i]);
			data[i] = organizar_dados(data[i]);
		}
		console.log(monthMap);
		$.each(monthMap, function (index, data) {
			$('#lista-processos').append('<tr class="td-divisor"><td  colspan="13">' + nomes_mes[index.substr(0, index.lastIndexOf('/'))] + ' de ' + index.substr(index.lastIndexOf('/') + 1) + '</td></tr>');
			for (var i = 0; i < data.length; i++) {
				var toAppend = '<tr>'+			
				'<td>' + data[i].NM_ORGAO + ' - <span style="font-weight: normal;">' +	data[i].NM_INTERESSADO + '</span></td>' +			
				'<td>' + data[i].CD_PROCESSO + '</td>' +
				'<td contenteditable="true" class="editable" data-id="' + data[i].ID + '">' + formatar_numero(data[i].VLR_PROCESSO) + ' R$</td>' +
				'<td>' + data[i].NM_ASSUNTO + '</td>' +
				'<td>' + data[i].DT_ENTRADA + '</td>' +
				'<td>' + data[i].DT_SAIDA + '</td>' +
				'<td>' + data[i].NM_SERVIDOR_RESPONSAVEL + '</td>' +
				'<td>' + data[i].DT_DISTRIBUICAO_TECNICO + '</td>' +
				'<td>' + data[i].DT_DEVOLUCAO_TECNICO + '</td>' +
				'<td>' + data[i].NR_DIAS_TECNICO + '</td>' +
				'<td>' + data[i].QTD_DEVOLUCOES + '</td>' +
				'<td>' + data[i].NR_DIAS_SUPERINTENDENTE + '</td>' +
				'<td>' + data[i].STATUS_PROCESSO + '</td>' +			
				'</tr>';			
				$('#lista-processos').append(toAppend);
			}
		});
		
		$("td.editable").on("blur", function() {
		  fn($(this));
		}).on("DOMSubtreeModified", function() {
		  contentEdited = true;
		});
		atualizar_total(resposta.getResponseHeader('total'));
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

function criar_paginacao() {
	$('#paginacao').empty();
	var pagina_final = parseInt(total / max);
	var inicio = inicio > pagina_final - 6 ? pagina_final - 6 : inicio;
	inicio = pagina < 4 ? 0 : pagina - 3;
	
	var i = inicio;
	$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_processos(' + 0 + ')">Inicio</a></li>');
	if (inicio !== 0) {
		$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_processos(' + (inicio - 1) + ')">&laquo; </a></li>');
	} else {
		$('#paginacao').append('<li class="disabled"><a href="javascript:void(0);">&laquo;</a></li>');
	}
	for (; i <= pagina_final && i < inicio + 7; i++) {
		$('#paginacao').append();
		if (i === pagina) {
		$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_processos(' + i + ')"><b><u>' + i + '<u></b></a></li>');
		} else {
		$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_processos(' + i + ')">' + i + '</a></li>');
		}
	}
	if (i < total / max ) {
		$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_processos(' + i + ')">&raquo</a></li>');
	} else {
		$('#paginacao').append('<li class="disabled"><a href="javascript:void(0);">&raquo</a></li>');		
	}
	$('#paginacao').append('<li><a href="javascript:void(0);" onclick="listar_processos(' + pagina_final + ')">Fim</a></li>');
}

window.onload = function() {
	if (getParameterByName('query')) {
		servidor = getParameterByName('query');		
	}
	listar_processos();
	
	//Solução extraída de https://stackoverflow.com/questions/10318575/jquery-search-as-you-type-with-ajax e https://stackoverflow.com/questions/574941/best-way-to-track-onchange-as-you-type-in-input-type-text
	var thread = null;
	$('#search').on('keyup cut paste', function() {
		iniciar_carregamento();
		clearTimeout(thread);thread = setTimeout(function(){listar_processos()}, 1000);
	});
	
	$(window).click(function() {
			 $(".menu-vertical-menu").hide();
	});

	$('.menu-vertical-menu').click(function(event){
		event.stopPropagation();
	});
	
	$('.menu-vertical-toggle').click(function(event){	
		event.stopPropagation();	
		$(this).closest('.menu-vertical-drop').children('.menu-vertical-menu').toggle();
	});
	$('#dt_inicial').blur(function(event) {
		dt_inicial = $('#dt_inicial').val();
		thread = setTimeout(function(){listar_processos()}, 1000);
	});

	$('#dt_final').blur(function(event) {
		dt_final = $('#dt_final').val();
		thread = setTimeout(function(){listar_processos()}, 1000);
	});
	atualizar_lista_assuntos();
	atualizar_lista_servidor(); 
}

function listar_servidor(novo_servidor) {
	servidor = novo_servidor;
	iniciar_carregamento();
	thread = setTimeout(function(){listar_processos()}, 1000);
}

<?php if($_SESSION['cargo'] == 'Controlador Geral'){ ?>
function listar_orgao(novo_orgao) {
	orgao = novo_orgao;
	iniciar_carregamento();
	thread = setTimeout(function(){listar_processos()}, 1000);
}
<?php } ?>

function listar_assunto(novo_assunto) {
	assunto = novo_assunto;
	iniciar_carregamento();
	thread = setTimeout(function(){listar_processos()}, 1000);
}


function listar_total(limite) {
	max = limite;
	$('.limite').removeClass('ativo');
	$('#limite_' + limite).addClass('ativo');
	iniciar_carregamento();
	thread = setTimeout(function(){listar_processos()}, 1000);
}

function atualizar_total(novo_total) {
	$('#total').empty().append('Total: ' + novo_total);
	total = novo_total;
	criar_paginacao();
	if (total == 0) {
		$('#tabela-processos').hide();
		$('#paginacao').hide();
		$('#nao-encontrado').show();
	} else if (total <= max) {
		$('#tabela-processos').show();
		$('#paginacao').hide();
		$('#nao-encontrado').hide();
	} else {
		$('#tabela-processos').show();
		$('#paginacao').show();
		$('#nao-encontrado').hide();
	}
}

var exportando = false;
function exportando_tabela() {
	exportando = true;
	$('#export-button').addClass('disabled');
	$('#exportar').hide();
	$('#exportando').show();
}

function exportar(sucesso) {
	var query = $('#search').val().replace(/\*/g, "%");
	if (!exportando){
		exportando_tabela();
	$.ajax({ 
	url: url + '/sistema/servicos/processos.php',
	data: {
	 'acao': 'Listar Acompanhamento PDF',
	 'query':query,
	 'dt_inicial': dt_inicial,
	 'dt_final': dt_final,
	 'servidor': servidor,
	 'assunto': assunto,
	 'orgao': orgao,
	 'setor': setor,
	 },
    dataType: 'json',
	type: 'get',
	success: function(data) {
		sucesso(data);
	},
	 error: function () {
		$('#export-button').removeClass('disabled');
		$('#exportar').show();
		$('#exportando').hide();
		exportando = false;
    }
	});
	}
}

function exportar_tipo(tipo) {
	$('.menu-vertical-menu').hide();
	if (tipo === 'pdf') {
		exportar(exportar_tabela_pdf);
	} else if (tipo === 'xls') {
		exportar(exportar_tabela_xls);
	}
}

function exportar_tabela_pdf(data) {
		var rows = [];
		
		for (var i = 0; i < data.length; i++) {
			data[i] = organizar_dados(data[i]);
			rows.push([data[i].NM_ORGAO + ' - ' + data[i].NM_INTERESSADO,data[i].CD_PROCESSO, data[i].NM_ASSUNTO, data[i].NM_SERVIDOR_RESPONSAVEL, data[i].DT_DISTRIBUICAO_TECNICO, data[i].DT_DEVOLUCAO_TECNICO, data[i].NR_DIAS_TECNICO, data[i].NR_DIAS_SUPERINTENDENTE, data[i].STATUS_PROCESSO]);
		}		
		var doc = new jsPDF('l', 'pt');

		doc.autoTable(['Orgão - Nome do Interessado', 'Processo', 'Assunto', 'Técnico responsável', 'Distribuição', 'Devolução', 'Dias T.', 'Dias S.',  'Status'], rows,
		{
		styles: {overflow: 'linebreak', halign: 'middle', valign: 'middle'},
		columnStyles: {
			id: {fillColor: [41, 128, 185]},
			halign: 'middle',
			valign: 'middle',
			0: {halign: 'left'},
		},
		alternateRowStyles: {
			halign: 'middle'
		}
		});
		doc.save('Lista de processos.pdf');
		$('#export-button').removeClass('disabled');
		$('#exportar').show();
		$('#exportando').hide();
		exportando = false;
}

function exportar_tabela_xls(data) {	
		for (var i = 0; i < data.length; i++) {
			data[i] = organizar_dados(data[i]);
		}
		var uri = $("#dvjson").excelexportjs({
			containerid: "dvjson"
			, datatype: 'json'
			, dataset: data
			, returnUri: true
			, columns: [
				{ headertext: "Orgão", datatype: "string", datafield: "NM_ORGAO", ishidden: false }
				, { headertext: "Interessado", datatype: "string", datafield: "NM_INTERESSADO", ishidden: false }
				, { headertext: "Processo", datatype: "string", datafield: "CD_PROCESSO", width: "100px"}
				, { headertext: "Valor", datatype: "double", datafield: "VLR_PROCESSO", width: "100px"}
				, { headertext: "Assunto", datatype: "string", datafield: "NM_ASSUNTO", width: "100px" }
				, { headertext: "Entrada", datatype: "string", datafield: "DT_ENTRADA"}
				, { headertext: "Saída", datatype: "string", datafield: "DT_SAIDA"}
				, { headertext: "Técnico Reponsável", datatype: "string", datafield: "NM_SERVIDOR_RESPONSAVEL", width: "100px" }
				, { headertext: "Distribuição Técnico", datatype: "string", datafield: "DT_DISTRIBUICAO_TECNICO"}
				, { headertext: "Devolução Técnico", datatype: "string", datafield: "DT_DEVOLUCAO_TECNICO" }
				, { headertext: "Dias com Técnico", datatype: "string", datafield: "NR_DIAS_TECNICO" }
				, { headertext: "Qtd devoluções", datatype: "string", datafield: "QTD_DEVOLUCOES" }
				, { headertext: "Dias com Superintendente", datatype: "string", datafield: "NR_DIAS_SUPERINTENDENTE" }
				, { headertext: "Status", datatype: "string", datafield: "STATUS_PROCESSO" }
				
			]
		});
		$('#relatorio-xls').attr('download', 'Lista de processos.xls').attr('href', uri).attr('target', '_blank');
		$('#relatorio-xls')[0].click();	
		$('#relatorio-xls').removeAttr('download').attr('href', 'javascript:void(0)').removeAttr('target');
		$('#export-button').removeClass('disabled');
		$('#exportar').show();
		$('#exportando').hide();
		exportando = false;
}

</script>

 
<div id="page-content-wrapper">

	<div class="container titulo-pagina">
		<p>Processos</p>
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
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" placeholder="Buscar por número do processo ou interessado" id="search" autofocus="autofocus" class="input-search form-control"/>
								</div>
							</div>
							
							<div class="col-sm-2 col-xs-12 pull-right">
							<div class="menu-vertical-drop pull-right">
									<button href="javascript:void(0);" id="export-button" class="btn btn-sm btn-info  menu-vertical-toggle" >
										<span id="exportar"><i class="fa fa-file"></i> Exportar</span>
										<span id="exportando" style="display:none;"><i class="fa fa-refresh spinner" aria-hidden="true"></i> Gerando...</span>
									</button>
									<ul class="menu-vertical-menu" aria-labelledby="dropdownMenu1">		
									<li>
										<a id="relatorio-pdf" href="javascript:void(0);" onclick="exportar_tipo('pdf');" class="btn btn-sm btn-info">
										<i class="fa fa-file-pdf-o"></i> PDF
										</a>
									</li>
									<li>
										<a id="relatorio-xls" href="javascript:void(0);" onclick="exportar_tipo('xls');" class="btn btn-sm btn-info">
											<i class="fa fa-file-excel-o"></i> Excel	
										</a>							
									</li>
									</ul>
							</div>		
							</div>
						</div>
						
						<div class="row">										
							<div class="col-md-4 filter-opt">
								<div><h6>Orgão interessado</h6></div>								
								<select class="form-control" id="filtro-orgao" name="filtro-orgao" onchange="listar_orgao(this.value);"/>
									<option value="">TODOS</option>
									<?php include('../includes/orgao_interessado_processo.php'); ?>
								</select>								
							</div>		
							<div class="col-md-4 filter-opt">
								<div><h6>Técnico Responsável</h6></div>	
								<div>
									<select class="form-control" id="filtro-servidor" name="servidor" onchange="listar_servidor(this.value);"/>
												<option value="">TODOS</option>					
									</select><span id="carregando-setor-servidor" style="display: none;position: absolute;top: 44px;left: 14px;"><i class="fa fa-refresh spinner" aria-hidden="true"></i></span>
								</div>								
							</div>
							<div class="col-md-4 filter-opt">
								<div><h6>Assunto</h6></div>	
								<div>
									<select class="form-control" id="filtro-assunto" name="assunto" onchange="listar_assunto(this.value);"/>
											<option value="">Selecione um assunto</option>							
									</select><span id="carregando-setor-assunto" style="display: none;position: absolute;top: 44px;left: 14px;"><i class="fa fa-refresh spinner" aria-hidden="true"></i></span>
								</div>								
							</div>
						</div>	
						<div class="row">
						<?php if($_SESSION['cargo'] == 'Controlador Geral'){ ?>	
						<div class="col-sm-4 filter-opt">
								<div><h6>Localização</h6></div>
								<div class="btn-group search lugar" role="group">		 								  
									  <div class="menu-vertical-drop" style="display: inline-block;width: 117px;">							
										<a href="javascript:void(0);">
										<button type="button" id="listar-lugar-setor" class="btn botao-comunicacao lugar menu-vertical-toggle">Setor</button></a>									
											<ul class="menu-vertical-menu" >	
												<li><a><button type="button" id="setor-SUCOR" class="btn botao-comunicacao lugar menu-vertical-toggle" onclick="listar_setor('SUCOR')">SUCOR</button></a></li>													
												<li><a><button type="button" id="setor-SUCOF" class="btn botao-comunicacao lugar menu-vertical-toggle" onclick="listar_setor('SUCOF')">SUCOF</button></a></li>														
												<li><a><button type="button" id="setor-SUPAD" class="btn botao-comunicacao lugar menu-vertical-toggle" onclick="listar_setor('SUPAD')">SUPAD</button></a></li>													
												<li><a><button type="button" id="setor-todos" class="btn botao-comunicacao lugar menu-vertical-toggle" onclick="listar_setor('todos')">Todos</button></a></li>
											</ul>
									  </div>							  
																 							  
								</div>
							</div>	
						<?php } ?>
						<div class="col-sm-4 filter-opt">
								<div><h6>Período(Entrada)</h6></div>						
									<div class="form-group">
										<label class="control-label" for="dt_inicial"><b>Início:</b></label>
										<input  class="form-control tipo-data" id="dt_inicial" type="date" style="display:inline-block; width: 170px;"/>
									</div>  
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1" style="width: 43px;"><b>Fim:</b></label>
										<input  class="form-control tipo-data" id="dt_final" style="display:inline-block; width: 170px;" type="date"/>
									</div>  			
							
						</div>
						<div class="col-sm-4 filter-opt">
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
					<div class="col-md-12 table-responsive" id="tabela-processos" style="overflow: auto; width: 100%;">
						<table class="table table-hover tabela-dados tabela-fluxo" style="min-width: 1180px;">
							<thead>
								<tr>
									<th>Orgão - Interessado</th>								
									<th>Processo</th>
									<th>Valor</th>
									<th>Assunto</th>
									<th>Entrada</th>
									<th>Saída</th>
									<th>Técnico responsável</th>
									<th>Distribuição técnico</th>
									<th>Devolução técnico</th>
									<th>Dias com o técnico</th>
									<th>Qtd devoluções</th>
									<th>Dias com o superintendente</th>
									<th>Status</th>									
								</tr>	
							</thead>
							<tbody id="lista-processos">
									
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
<div id="dvjson"> </div>


<?php include('../foot.php')?>