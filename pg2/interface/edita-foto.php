<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('head.php'); 
include('body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Altere sua foto</p>
</div>
<?php include('includes/mensagem.php'); ?>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="../componentes/pessoa/logica/editar.php?sessionId=<?php echo $num ?>&operacao=foto&pessoa=<?php echo $_SESSION['CPF'] ?>&atual=<?php echo $foto ?>" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-10">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Selecione a nova foto</label>
								<input class="form-control" type='file' id='arquivo_foto' name='arquivo_foto' enctype="multipart/form-data"/>
							</div>	
						</div>
                        <div class="col-md-2">
							<div class="form-group">
								<button type="submit" class="btn btn-sm" name="submit" value="Send" style="margin-top:32px;" id="botao-tramitar">Alterar foto</button>
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
<?php include('foot.php')?>