<?php 
include('../head.php');
include('../body.php');
$id = $_GET['chamado'];
$informacoes = retorna_informacoes_chamado($_GET['chamado'], $conexao_com_banco);
?>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
	
		<p>Chamado de <?php echo $informacoes['NM_SERVIDOR'] ?> sobre <?php echo $informacoes['NM_NATUREZA'] ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						
							<?php include('botoes.php'); 
							
							include('informacoes.php'); 
							
							include('historico.php'); 
														
							if($informacoes['NM_STATUS'] == 'Aberto'){
								include('../includes/enviar-mensagem.php');
							}
							
							if($_SESSION['permissao-nota-chamado']=='sim' and $informacoes['NM_NOTA'] == 'Sem nota' and $informacoes['NM_STATUS'] == 'Resolvido'){
								include('nota.php');
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