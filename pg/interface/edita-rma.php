<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_rma_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição do estoque de <?php echo $material ?> em 0<?php echo $competencia ?>/<?php echo $ano ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/rma/logica/editar.php?empenho=<?php echo $empenho ?>&entrada=<?php echo $entrada_qtd ?>
					&material=<?php echo $material ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do empenho</label>
									<input class="form-control" disabled value="<?php echo $empenho ?>" id="empenho" name="empenho" placeholder="Digite o número do empenho" type="text" maxlength="" required/>
								</div>  
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Mês de competência</label>
									<select class="form-control" id="competencia" name="competencia" required/>
									<option value="<?php echo $competencia ?>"><?php echo $competencia ?></option>
									<option value="1">Janeiro</option>
									<option value="2">Fevereiro</option>
									<option value="3">Março</option>
									<option value="4">Abril</option>
									<option value="5">Maio</option>
									<option value="6">Junho</option>
									<option value="7">Julho</option>
									<option value="8">Agosto</option>
									<option value="9">Setembro</option>
									<option value="10">Outubro</option>
									<option value="11">Novembro</option>
									<option value="12">Dezembro</option>
								</select>
							</div>  
						</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Valor</label>
							<input class="form-control" id="valor" name="valor" placeholder="Digite o valor do empenho" 
							type="float" value="<?php echo $valor ?>" maxlength="10" onkeypress="mascara(this,mreais)" required/>
						</div>  
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="form-group">
						<div class="col-md-4">
							<label class="control-label" for="exampleInputEmail1">Nota fiscal</label>
							<input class="form-control" value="<?php echo $nota_fiscal ?>" id="nota_fiscal" name="nota_fiscal" placeholder="Digite a nota fiscal" type="text" maxlength="" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Tipo</label>
							<input class="form-control" value="<?php echo $tipo ?>" id="tipo" name="tipo" placeholder="Digite o tipo" type="text" maxlength="" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Material</label>
							<input class="form-control" disabled value="<?php echo $material ?>" id="material" name="material" placeholder="Digite o material" type="text" maxlength="" required/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Subitem orçamentário</label>
							<input class="form-control" value="<?php echo $subitem_orcamentario ?>" id="subitem_orcamentario" name="subitem_orcamentario" placeholder="Digite subitem" type="text" maxlength="" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Adquiridos a partir de</label>
							<select class="form-control" id="adiquiridos_a_partir" name="ano_adquiridos" required/>
							<option value="<?php echo $ano_adquiridos ?>"><?php echo $ano_adquiridos ?></option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Fornecedor</label>
						<input class="form-control" value="<?php echo $fornecedor ?>"  id="material" name="fornecedor" placeholder="Digite o fornecedor" type="text" maxlength="20" required/>
					</div>
				</div>
			</div>
			<hr>
			<h4>Mais Entrada</h4>
			<br>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Quantidade</label>
						<input class="form-control" id="quantidade" name="entrada_qtd" placeholder="Digite a quantidade do item" type="number" maxlength="" required/>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Valor unitário</label>
						<input class="form-control" value="<?php echo $entrada_vlr_unit ?>" id="valor unitario" name="entrada_vlr_unit" placeholder="Digite o valor unitário do item" type="float"  maxlength="10" onkeypress="mascara(this,mreais)" required/>
					</div>
				</div>
			</div>
			<h4>Dar Saída</h4>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Quantidade</label>
						<input class="form-control" id="quantidade" name="saida_qtd" placeholder="Digite a quantidade do item" type="number" maxlength="" required/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Valor unitário</label>
						<input class="form-control" id="valor unitario" name="saida_vlr_unit" placeholder="Digite o valor unitário do item" type="float"  maxlength="10" onkeypress="mascara(this,mreais)" required/>
					</div>
				</div>
			</div>
			<div class="row" id="cad-button">
				<div class="col-md-12">
					<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Editar</button>
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