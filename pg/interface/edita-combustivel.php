<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_combustivel_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição do abastecimento do veículo <?php echo $placa ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/combustivel/logica/editar.php?id=<?php echo $id?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Placa do veículo</label>
							<select class="form-control" id="placa_veiculo" name="placa" required/>
								<option value="<?php echo $placa ?>"><?php echo $placa ?></option>
								<?php include('../nucleo-aplicacao/queries/retorna_veiculos.php');
								while($r = mysqli_fetch_object($qr)){ ?>
								<option value="<?php echo $r->placa ?>"><?php echo $r->placa ?></option><?php } ?>
							</select>
						</div>  
					</div>		 
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Valor</label>
							<input class="form-control" id="valor" name="valor" placeholder="Digite o valor do empenho" 
							type="float" maxlength="10" value="<?php echo $valor ?>" onkeypress="mascara(this,mreais)" required/>
						</div>  
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de abastecimento</label>
							<input class="form-control tipo-data" value="<?php echo $data_abastecimento ?>" id="data_abastecimento" name="data_abastecimento" placeholder="Ex.: dd/mm/aaaa" type="date"/>	
						</div>  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Valor do litro</label>
							<input class="form-control" id="valor_litro" value="<?php echo $valor_litro ?>" name="valor_litro" placeholder="Digite valor do litro" type="float" maxlength="" onkeypress="mascara(this,mreais)" required/>
						</div>  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Quantidade de litros</label>
							<input class="form-control" id="quantidade_litro" value="<?php echo $valor_litro ?>" name="quantidade_litro" placeholder="Digite quantidade de litros" type="number" maxlength="" required/>
						</div>	
					</div>
				</div>
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Atualizar Informações</button>
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