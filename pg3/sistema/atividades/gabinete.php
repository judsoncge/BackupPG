<?php 
include('../head.php');
include('../body.php'); 
verificar_permissao_pagina($_SESSION['permissao-visualizar-atividade'], $conexao_com_banco);
?>
<script type="text/javascript">
var retorno;
var mapa_exibicao;
var nomes_mes = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

function listar_atividades() {
	$.ajax({ 
	url: url + '/sistema/servicos/atividades.php',
	data: {
	 'acao': 'Listar Gabinete',
	 'sessionId':sessionId,
	 },
	type: 'get',
	success: function(data) {
		var color = '', texto = '', classe = '';
		data = $.parseJSON(data);			
		retorno = data;
		for (var i = 0; i < data.length; i++) { 
			if (data[i].Dias > 3) {
				classe = 'outdated';
			} else {
				classe = 'd_' + data[i].Dias; 
			}
			texto = '<tr><td style=" max-width: 320px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;}"> <a href="../processos/detalhes.php?processo=' + data[i].Processo +'">' + data[i].Processo + '</a>'+ 
			'<td style="text-align: center;">' + formatar_data2(data[i].Data_Entrada) + '</td>'+
			'<td style="text-align: center;">' +
			'<div class="progress-bar ' + classe +'"><div></div><div></div><div></div></div>' +
			
			 + data[i].Dias + '</td></tr>';			
			$("#atividades-processos").append(texto);
		}
	
		}
		
	
	
	});


}


(function(){
	listar_atividades();
})();
</script>
<style>
.progress-bar {
	display: flex;
	border: 1px solid #c1c1c1;
	display: flex;
	padding: 1px;
	justify-content: center;
	border-radius: 5px;
	border-style: groove;
}

.progress-bar > div {
	padding: 10px;
	flex-basis: 33%;
}

.progress-bar.outdated > div {
	background-color: red;
}
.progress-bar > div:first-child {
	border-top-left-radius: 5px;
	border-bottom-left-radius: 5px;
}

.progress-bar > div:nth-child(3) {
	border-top-right-radius: 5px;
	border-bottom-right-radius: 5px;
}

.progress-bar > div:nth-child(2) {
	border-left: 1px solid #c1c1c1;
	border-right: 1px solid #c1c1c1;
}

.progress-bar.d_1 > div:first-child {
	background-color: green;
}
.progress-bar.d_2 > div:first-child, .progress-bar.2 > div:nth-child(2) {
	background-color: green;
}
.progress-bar.d_3 > div {
	background-color: green;
}
</style>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Atividades</p>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="col-md-12 table-responsive" style="width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Processo</th>
									<th style="text-align: center;">Data de entrada</th>
									<th style="text-align: center;">Prazo</th>								
									
								</tr>	
							</thead>
							<tbody id="atividades-processos">
								
								
							</tbody>
						</table>								
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->


<?php include('../foot.php')?>