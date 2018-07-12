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
		<p>Cadastro de Serviço</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/servico/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo</label>
									<select class="form-control" id="tipo" name="tipo" required/>
										<option value="">Selecione o tipo</option>
										<option value="PF">Pessoa Física</option>
										<option value="PJ">Pessoa Jurídica</option>
									</select>
								</div> 
							</div> 
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Credor</label>
									<input class="form-control" id="credor" name="credor" placeholder="Digite o credor" 
									type="text" maxlength="" required/>
								</div>  
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Valor</label>
									<input class="form-control" id="valor" name="valor" placeholder="Digite o valor a ser pago" 
									type="float" maxlength="10" onkeypress="mascara(this,mreais)" required/>
								</div>  
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