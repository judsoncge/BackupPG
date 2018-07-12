<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_telefone_editar.php');	
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição de Telefone de <?php echo $beneficiario2 ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/telefone/logica/editar.php?id=<?php echo $id ?>"" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Portador</label>
										<select class="form-control" id="beneficiario" name="beneficiario" required/>
											<option value="<?php echo $beneficiario ?>"><?php echo $beneficiario2 ?></option>
											<?php $lista = retorna_dados("pessoa", $conexao_com_banco);
											while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CPF ?>"><?php echo $r->nome ?></option><?php } ?>
									</select>
										</select>
									</div>	
							</div>
													
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Valor</label>
									<input class="form-control" value="<?php echo $valor ?>" id="valor" name="valor" placeholder="Digite o valor do empenho" 
									type="float" maxlength="10" onkeypress="mascara(this,mreais)" required/>
								</div>  
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


	/*tipo de telefone*/
/*	$("#tipo").on('change', function(){
		$('.opcao').hide();
		$('#' + this.value).fadeIn("slow");
	});*/

</script>
<?php include('footer.php')?>