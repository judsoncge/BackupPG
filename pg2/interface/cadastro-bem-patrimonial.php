<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); ?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de Bem Patrimonial</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/bem-patrimonial/logica/cadastrar.php?sessionId=<?php echo $num ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do patrimônio</label>
									<input class="form-control" id="numero_patrimonio" name="numero_patrimonio" placeholder="Digite o número do patrimônio" type="text" maxlength="8" required />	
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Setor</label>
									<select class="form-control" id="setor" name="setor" required/>
										<option value="">Selecione o setor</option>
										<?php $lista = retorna_setores($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_SETOR ?>"><?php echo $r->NM_SETOR ?></option><?php } ?>
									</select>	
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Descrição</label>
									<input class="form-control" id="descricao" name="descricao" placeholder="Digite descrição do patrimônio" type="text" required />	
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Denominação</label>
										<select class="form-control" id="denominacao" name="denominacao" required/>
											<option value="">Selecione a denominação</option>
											<?php $lista = retorna_rmb($conexao_com_banco);
											while($r = mysqli_fetch_object($lista)){ ?>
											<option value="<?php echo $r->NM_CLASSIFICACAO_CONTABIL ?>"><?php echo $r->NM_DENOMINACAO ?></option><?php } ?>
										</select>
								</div>  
							</div>
				</div>
				<div class="row">	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Conservação</label>
							<select class="form-control" id="conservacao" name="conservacao" required/>
								<option value="">Selecione</option>
								<option value="Bom">Bom</option>
								<option value="Regular">Regular</option>
								<option value="Inservível">Inservível</option>
							</select>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Documento de aquisição</label>
							<input class="form-control" id="doc_aquisicao" name="doc_aquisicao" placeholder="Digite o documento de aquisição" type="text" required />	
						</div>  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de aquisição</label>
							<input class="form-control tipo-data" id="data_aquisicao" name="data_aquisicao" placeholder="Digite o documento de aquisição" type="date" required />	
						</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Valor de aquisição</label>
							<input class="form-control" id="valor_aquisicao" name="valor_aquisicao" placeholder="Digite o valor de aquisição" type="float" onkeypress="mascara(this,mreais)" required />	
						</div>  
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Tempo / Anos</label>
							<input class="form-control" id="tempo_anos" name="tempo_anos" placeholder="Digite o tempo em anos do bem" type="number" required />	
						</div>  
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Taxa de depreciação (%)</label>
							<input class="form-control" id="taxa_depreciacao" name="taxa_depreciacao" placeholder="Digite a taxa de depreciação do móvel" type="number" required />	
						</div>  
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Depreciação acumulada</label>
							<input class="form-control" id="depreciacao_acumulada" name="depreciacao_acumulada" placeholder="Digite a depreciação acumulada" onkeypress="mascara(this,mreais)" type="float" required />	
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