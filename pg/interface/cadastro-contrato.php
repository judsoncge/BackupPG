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
		<p>Cadastro de Contrato</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/contrato/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do contrato</label>
									<input class="form-control" id="numero_contrato" name="numero_contrato" placeholder="Digite o número do contrato " type="text"/>	
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Contratado</label>
									<input class="form-control" id="contratado" name="contratado" placeholder="Digite o contratado" type="text"/>	
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">CNPJ do contratado</label>
									<input class="form-control" id="cnpj" name="cnpj_contratado" placeholder="Digite CNPJ do contratado" type="text" maxlength="18" required/>
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Valor</label>
									<input class="form-control" id="valor" name="valor" placeholder="Digite o valor do empenho" 
									type="float" maxlength="10" onkeypress="mascara(this,mreais)" required/>
								</div>  
							</div>
						</div>
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Número do contrato no SIAFEM</label>
							<input class="form-control" id="numero_contrato_siafem" name="numero_contrato_siafem" placeholder="Digite o número do contrato no SIAFEM" type="text" maxlength="" required/>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Objeto do contrato</label>
							<input class="form-control" id="" name="objeto_contrato" placeholder="Digite o objeto do contrato" minlength="4" maxlength="100" type="text" required>
						</div>  
					</div>
					</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de início da publicação</label>
							<input class="form-control tipo-data" id="data_ida" name="data_inicio_publicacao" placeholder="Informe a data de início da publicação" maxlength="" type="date" required>
						</div> 
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de término da publicação</label>
							<input class="form-control tipo-data" id="data_volta" name="data_termino_publicacao" placeholder="Informe a data de término da publicação" maxlength="" type="date" onBlur="verifica_data('data_ida', 'data_volta')" required>
						</div> 
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">É prorrogável?</label>
								<select class="form-control" id="status_prorrogavel" name="status_prorrogavel" required/>
									<option value="">É prorrogável?</option>
									<option value="Sim">Sim</option>
									<option value="Não">Não</option>
								</select>
							</div>  
						</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Vinculação</label>
							<input class="form-control" id="vinculacao" name="vinculacao" placeholder="Informe se há algum vínculo" maxlength="" type="text" required>
						</div> 
					</div>
					<div class="col-md-4">
						<center><div id="msg-data_volta" ></div></center>
					</div>
				</div>
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Cadastrar</button>
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