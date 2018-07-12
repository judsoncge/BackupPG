<?php 
include('../head.php');
include('../body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Altere sua senha</p>
</div>
<?php include('../includes/mensagem.php'); ?>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="logica/editar.php?&operacao=senha&pessoa=<?php echo $_SESSION['CPF'] ?>" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Nova senha</label>
								<input class="form-control" type='password' id='nova_senha' name='nova_senha'/>
							</div>	
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Confirme</label>
								<input class="form-control" type='password' id='confirma_senha' name='confirma_senha'/>
							</div>	
						</div>
                        <div class="col-md-2">
							<div class="form-group">
								<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Alterar senha</button>
							</div>	
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>