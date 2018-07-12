<?php 
include('../head.php');
include('../body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Consulte um processo</p>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/consultar.php" enctype="multipart/form-data">  
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Digite o número do processo para consulta</label>
									<input class="form-control" type='text' id='p' name='p'/>
								</div>	
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Consultar</button>
								</div>	
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php include('../foot.php')?>