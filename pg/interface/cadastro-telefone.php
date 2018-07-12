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
		<p>Cadastro de Telefone</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/telefone/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Portador</label>
										<select class="form-control" id="beneficiario" name="beneficiario" required/>
										<option value="">Selecione o servidor</option>
										<?php $lista = retorna_dados("pessoa", $conexao_com_banco);
											while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CPF ?>"><?php echo $r->nome ?></option><?php } ?>
									</select>
								</div>	
							</div>
													
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Valor</label>
									<input class="form-control" id="valor" name="valor" placeholder="Digite o valor do empenho" 
									type="float" maxlength="10" onkeypress="mascara(this,mreais)"/>
								</div>  
							</div>
						</div>
						<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Tipo</label>
										<select class="form-control" id="tipo" name="tipo" required/>
											<option value="">Selecione o tipo</option>
											<option value="fixo">Fixo</option>
											<option value="movel">Móvel</option>
										</select>
									</div>	
								</div>	
								<div class="col-md-6">
									<div class="form-group opcao" style="display: none;" id="fixo">
										<label class="control-label" for="exampleInputEmail1">Número do Telefone</label>
										<input class="form-control tipo-data" id="numero-fixo" name="numero" type="text"/>
									</div>
									<div class="form-group opcao" style="display: none;" id="movel">
										<label class="control-label" for="exampleInputEmail1">Número do Celular</label>
										<input class="form-control tipo-data" id="numero-movel" name="numero" type="text"/>
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


	/*tipo de telefone*/
	$("#tipo").on('change', function(){
		$('.opcao').hide();
		$('#' + this.value).fadeIn("slow");
	});

</script>
<?php include('footer.php')?>