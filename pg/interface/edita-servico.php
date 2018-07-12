<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_servico_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição de Serviço prestado por <?php echo $credor ?>)</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/servico/logica/editar.php?id=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo</label>
									<select class="form-control" id="tipo" name="tipo" required/>
									<option value="<?php echo $tipo?>"><?php echo $tipo?></option>
									<option value="PF">PF</option>
									<option value="PJ">PJ</option>
									</select>
								</div> 
							</div> 
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Credor</label>
									<input class="form-control" id="credor" name="credor" placeholder="Digite o credor" 
							type="text" value="<?php echo $credor ?>" maxlength="" required/>
								</div>  
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Valor</label>
									<input class="form-control" id="valor" name="valor" placeholder="Digite o valor do empenho" 
									type="float" value="<?php echo $valor ?>" maxlength="10" onkeypress="mascara(this,mreais)" required/>
								</div>  
							</div>
						</div>
					
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Editar</button>
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
<?php include('footer.php')?>