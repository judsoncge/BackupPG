<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Altere sua foto</p>
</div>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="../componentes/pessoa/logica/editar_foto.php?pessoa=<?php echo $_SESSION['CPF'] ?>&atual=<?php echo $foto ?>" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-5">
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


	/*tipo de telefone*/
/*	$("#tipo").on('change', function(){
		$('.opcao').hide();
		$('#' + this.value).fadeIn("slow");
	});*/

</script>
<?php include('footer.php')?>