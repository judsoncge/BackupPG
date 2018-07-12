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
		<p>Cadastro de Diária</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/diaria/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-3">
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
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Tipo</label>
							<select class="form-control" id="tipo" name="tipo" required/>
							<option value="">Selecione o tipo</option>
							<option value="Fora do território nacional">Fora do território nacional</option>
							<option value="Fora do território estadual">Fora do território estadual</option>
							<option value="Dentro do terriório estadual">Dentro do terriório estadual</option>
						</select>
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Número da portaria</label>
						<input class="form-control" id="portaria" name="portaria" placeholder="Digite o número da portaria" type="text" maxlength="" required/>
					</div>  
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Data da publicação da portaria</label>
						<input class="form-control tipo-data" id="data_portaria" name="data_portaria" type="date" required/>
					</div>  
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Destino</label>
						<input class="form-control" id="destino" name="destino" placeholder="Digite o destino da viagem" type="text" maxlength="" required/>
					</div>  
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Data de ida</label>
						<input class="form-control tipo-data" id="data_ida" name="data_ida" type="date" onBlur="verifica_data('data_portaria', 'data_ida')" required/>
					
						<div id="msg-data_ida" ></div>
					
					</div>  
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Data de volta</label>
						<input class="form-control tipo-data" id="data_volta" name="data_volta" type="date" onBlur="verifica_data('data_ida', 'data_volta')" required/>
					
						<div id="msg-data_volta" ></div>
					
					</div>  
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Número de diárias</label>
						<input class="form-control" id="n_diarias" name="n_diarias" placeholder="Digite a quantidade de diárias" type="float" maxlength="5" required/>
					</div>  
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Valor total da(s) diária(s)</label>
						<input class="form-control" id="valor" onkeypress="mascara(this,mreais)" name="valor" placeholder="Digite o valor total das diárias" type="float" maxlength="" required/>
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
<script src="jquery.maskMoney.min.js" type="text/javascript"></script>
<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
<?php include('footer.php')?>