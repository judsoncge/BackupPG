<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_compra_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Compra solicitada por <?php echo $nome_solicitante ?> (<?php echo $status ?>)</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					
					<?php 
					
					if($status != 'Pago'){
						include('includes/bts_compra.php'); 
					}
					
					include('includes/info_compra.php');
					
					include('includes/historico_compra.php');

					?>
								
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->

<!-- chamando o bootstrap novamente para o modal funcionar -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>

<?php include('foot.php')?>