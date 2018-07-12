<?php 
include('../head.php');
include('../body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Altere sua foto</p>
	</div>
	<?php include('../includes/mensagem.php'); ?>
	<div class="container well">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/editar.php?operacao=foto" enctype="multipart/form-data"> 
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Selecione a nova foto</label>
									<input class="form-control" type='file' id='arquivo_foto' name='arquivo_foto' enctype="multipart/form-data"/>
								</div>	
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Alterar foto</button>
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