<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$id_despesa = $_GET['despesa'];	
$tipo_despesa = $_GET['tipo'];	
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Empenhar</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/empenho/logica/cadastrar.php?despesa=<?php echo $id_despesa ?>&tipo=Diária" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Número de empenho</label>
								<input class="form-control" id="empenho" name="empenho" type="text" maxlength="" required/>
							</div> 
						</div>
						<div class="col-md-6">
								<label class="control-label" for="exampleInputEmail1">Valor</label>
								<input class="form-control" id="valor" onkeypress="mascara(this,mreais)" name="valor" placeholder="Digite o valor de empenho" type="float" maxlength="" required/>
						</div>	
					</div>
					<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Empenhar</button>
					</div>
				</div>
			</div>
		</form>
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
</script>

<script type="text/javascript">
	/*buscar foto*/
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
		});

		$(document).ready( function() {
			$('.btn-file :file').on('fileselect', function(event, numFiles, label) {

				var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}

			});
		});
	</script>
	<?php include('footer.php')?>