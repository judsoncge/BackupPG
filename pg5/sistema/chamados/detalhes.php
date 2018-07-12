<?php 
include('../head.php');
include('../body.php');
$id = $_GET['id']; 
$tabela = "tb_chamados";
include('../includes/verificacao-id.php');
$informacoes = retorna_informacoes($tabela, $id, $conexao_com_banco);
?>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
	
		<p>Chamado de <?php echo retorna_nome_servidor($informacoes['ID_SERVIDOR_REQUISITANTE'], $conexao_com_banco) ?> sobre <?php echo $informacoes['NM_NATUREZA'] ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						
							<?php 
							
							if($_SESSION['funcao']=='TI'){
								include('botoes.php');
							}
														
							include('informacoes.php'); 
							
							include('historico.php'); 
														
							if($informacoes['NM_STATUS'] != 'ENCERRADO'){
								include('../includes/enviar-mensagem.php');
							}
							
							if($_SESSION['funcao']!='TI' and $informacoes['NM_AVALIACAO'] == 'SEM AVALIAÇÃO' and $informacoes['NM_STATUS'] == 'RESOLVIDO'){
								include('avaliacao.php');
							}
							
							?>
							

						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->

<?php include('../foot.php')?>