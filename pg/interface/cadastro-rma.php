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
		<p>Cadastro de RMA</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/rma/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="form-group">
								<div class="col-md-4">
									<label class="control-label" for="exampleInputEmail1">Código</label>
									<input class="form-control" id="codigo" name="codigo" placeholder="Digite a nota fiscal" type="text" maxlength="5" required/>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Item</label>
									<input class="form-control" id="item" name="item" placeholder="Digite o tipo" type="text" maxlength="100" required/>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Medida</label>
									<select class="form-control" id="medida" name="medida" required/>
										<option value="">Selecione o material</option>
										<?php $lista = retorna_dados("medida", $conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->medida ?>"><?php echo $r->medida ?></option><?php } ?>
									</select>
								</div>
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