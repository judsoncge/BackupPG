<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_diaria_editar.php');	
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição da Diária de <?php echo $beneficiario2 ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/diaria/logica/editar.php?id=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
							
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Beneficiário</label>
									<select class="form-control" id="beneficiario" name="beneficiario" required/>
									<option value="<?php echo $beneficiario ?>"><?php echo $beneficiario2 ?></option>
									<?php include('../nucleo-aplicacao/queries/retorna_servidores.php');
									while($r = mysqli_fetch_object($qr)){ ?>
									<option value="<?php echo $r->CPF ?>"><?php echo $r->nome ?></option><?php } ?>
									</select>
								</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Tipo</label>
								<select class="form-control" value="<?php echo $tipo ?>" id="tipo" name="tipo" required/>
								<option value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
								<option value="Fora do território nacional">Fora do território nacional</option>
								<option value="Fora do território estadual">Fora do território estadual</option>
								<option value="Dentro do terriório estadual">Dentro do terriório estadual</option>
							</select>
						</div>	
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Número da portaria</label>
							<input class="form-control" value="<?php echo $portaria ?>" id="portaria" name="portaria" placeholder="Digite o número da portaria" type="text" maxlength="" required/>
						</div>  
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data da publicação da portaria</label>
							<input class="form-control tipo-data" value="<?php echo $data_portaria ?>" id="data_portaria" name="data_portaria" type="date" required/>
						</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Destino</label>
							<input class="form-control" id="destino" value="<?php echo $destino ?>" name="destino" placeholder="Digite o destino da viagem" type="text" maxlength="" required/>
						</div>  
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de ida</label>
							<input class="form-control tipo-data" value="<?php echo $data_ida ?>" id="data_ida" name="data_ida" type="date" required/>
						<div id="msg-data_ida" ></div>
						</div>  
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de volta</label>
							<input class="form-control tipo-data" id="data_volta" value="<?php echo $data_volta ?>" name="data_volta" type="date" onBlur="verifica_data('data_ida', 'data_volta')" required/>
						</div>  
						<div id="msg-data_volta" ></div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Número de diárias</label>
							<input class="form-control" id="n_diarias" value="<?php echo $n_diarias ?>" name="n_diarias" placeholder="Digite a quantidade de diárias" type="number" maxlength="2" required/>
						</div>  
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Valor total da(s) diária(s)</label>
						<input class="form-control"  value="<?php echo $valor ?>" id="valor" onkeypress="mascara(this,mreais)" name="valor" placeholder="Digite o valor total das diárias" type="float" maxlength="" required/>
					</div>  
				</div>
				</div>
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Atualizar informações</button>
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