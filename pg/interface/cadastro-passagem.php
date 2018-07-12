<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_financeiro',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de Passagem</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/passagem/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Beneficiário</label>
										<select class="form-control" id="beneficiario" name="beneficiario" required/>
											<option value="">Selecione o servidor</option>
												<?php $lista = retorna_dados("pessoa", $conexao_com_banco);
												while($r = mysqli_fetch_object($lista)){ ?>
											<option value="<?php echo $r->CPF ?>"><?php echo $r->nome ?></option><?php } ?>
									</select>
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Nº do processo no Integra</label>
										<input class="form-control" id="n_processo_integra" name="n_processo_integra" placeholder="Digite o número do processo do Integra" type="text" maxlength="" required/>
								</div>	
							</div>
							<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Destino</label>
								<input class="form-control" id="destino" name="destino" placeholder="Digite o destino da viagem" type="text" maxlength="" required/>
							</div>  
							</div>
						</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Data de ida</label>
								<input class="form-control tipo-data" id="data_ida" name="data_ida" type="date" required/>
							</div>  
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Horário de ida</label>
								<input class="form-control tipo-data" id="horario_ida" name="horario_ida" type="time" required/>
							</div>  
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Valor pago na ida</label>
								<input class="form-control" id="valor_ida" onkeypress="mascara(this,mreais)" name="valor_ida" placeholder="Digite o valor pago ao servidor na ida" type="float" maxlength="" required/>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Data de volta</label>
								<input class="form-control tipo-data" id="data_volta" name="data_volta" type="date" onBlur="verifica_data('data_ida', 'data_volta')" required/>
							<div id="msg-data_volta" ></div>
							</div>  
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Horário de volta</label>
								<input class="form-control tipo-data" id="horario_volta" name="horario_volta" type="time" required/>
							</div>  
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Valor pago na volta</label>
								<input class="form-control" id="valor_volta" name="valor_volta" onkeypress="mascara(this,mreais)" placeholder="Digite o valor pago ao servidor na viagem de volta" type="float" maxlength="" required/>
							</div>	
						</div>
					</div>
				<div class="row">					
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Finalidade da viagem</label>
							<input class="form-control" rows="5" id="finalidade" name="finalidade" placeholder="Digite a finalidade da viagem" type="text" required></input>
						</div>  
					</div>
				</div>
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Cadastrar</button>
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