<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('head.php'); 
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_bem_patrimonial_editar.php');	
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição de Bem Patrimonial</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					
					<form name="cadastro" method="POST" action="../componentes/bem-patrimonial/logica/editar.php?id=<?php echo $id ?>&liquido=<?php echo $valor_liquido ?>&acumulada=<?php echo $depreciacao_acumulada ?>&residual=<?php echo $valor_residual ?>" enctype="multipart/form-data"> <!-- login.php -->  
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Depreciação do mês</label>
										<input class="form-control" id="depreciacao_mes" name="depreciacao_mes" placeholder="Digite a depreciação do mês" type="float" onkeypress="mascara(this,mreais)" required />	
									</div>  
								</div>
							</div>
						</div>
						<div class="row" id="cad-button">
							<div class="col-md-12">
								<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Depreciar</button>
							</div>
						</div>	
					</form>	
					
		</div>
	</div>
</div>
</div>

<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

</script>
<?php include('foot.php')?>