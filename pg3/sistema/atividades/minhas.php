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
	 'acao': 'Listar Grupo',
	 'sessionId':sessionId,
	 },
	type: 'get',
	success: function(data) {
		var color = '', texto = '';
		data = $.parseJSON(data);			
		retorno = data;
		$("#atividades-mes").empty();
		for (var i = 0; i < data.length; i++) { 
			
			texto = '<tr id="atividade-' + data[i].CD_ATIVIDADE + '"><td style=" max-width: 320px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;}">' + data[i].TX_DESCRICAO + 
			'<td style="text-align: center;">' + data[i].TOTAL_FECHADO + '/' + data[i].TOTAL + '</td>'+
			'<td style="text-align: center;">';
			texto += '<a href="quadrotarefas.php?sessionId=' + sessionId + '&atividade=' + data[i].CD_ATIVIDADE + '"><i class="fa fa-eye" aria-hidden="true"></i></td></tr>';			
			$("#atividades-mes").append(texto);
		}
		$(".geral").addClass('closed');
		$(".mes").removeClass('closed');
		
	}
	});


}


(function(){
	listar_atividades();
})();
</script>
<style>
.slider {
	padding: 0px;
	overflow: auto;
	max-width: 100%;
	transition-property: all;
	transition-duration: .5s;
	transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
	-webkit-transition-delay: padding 0.5s; /* Safari */
    transition-delay: padding 0.5s;
}
.slider > table {
	margin-left: 15px;
	margin-right: 15px;
	width: 97%;

}
.slider.closed {
	max-width: 0;
	overflow: hidden;
}

.slider.mes {
	-webkit-transition-delay: 0.7s; /* Safari */
    transition-delay: 0.7s;
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
									<th>Descrição</th>
									<th style="text-align: center;">Status</th>								
									<th style="text-align: center;">Ação</th>
								</tr>	
							</thead>
							<tbody id="atividades-mes">
								
								
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