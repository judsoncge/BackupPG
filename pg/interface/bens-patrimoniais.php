	<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_financeiro',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Bens patrimoniais</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar placa, modelo, renavam, ano ou condutor do veículo" id="search"/>
								</div>
							</div>
							<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_financeiro',$conexao_com_banco); if($permissao=='Sim'){ ?>
							<div class="col-sm-2 col-xs-12 pull-right">
								<a href="cadastro-bem-patrimonial.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo Bem</a>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Nº do patrimônio</th>
									<th>Descrição</th>
									<th>Valor da aquisição</th>
									<th>Valor líquido</th>
									<th><center>Ver detalhes</center></th>
									<th id="ano">Ano</th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_dados("bem_patrimonial", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
									<td><?php echo $r -> numero_patrimonio ?></td>
									<td><?php echo $r -> descricao ?></td>
									<td>R$<?php echo arruma_numero($r -> valor_aquisicao) ?></td>
									<td>R$<?php echo arruma_numero($r -> valor_liquido) ?></td>			
									
									
								    <td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
									data-target='#<?php echo $r -> numero_patrimonio ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>

									<td id="ano-item"><?php echo $r -> ano ?></td>
								</tr>

								<div class='modal fade' id='<?php echo $r -> numero_patrimonio ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title' id='myModalLabel'> Bem Patrimonial <?php echo $r -> numero_patrimonio ?></h4>
										</div>
										<div class='modal-body'>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Número do patrimônio: <b><?php echo $r -> numero_patrimonio ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Setor: <b><?php echo $r -> setor ?></b></label>
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Descrição: <b><?php echo $r -> descricao ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Denominação: <b><?php echo $r -> denominacao ?></b></label>
												</div>																
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Estado de conservação: <b><?php echo $r -> conservacao ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Documento de aquisição: <b><?php echo $r -> doc_aquisicao ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Data de aquisição: <b><?php echo arruma_data($r -> data_aquisicao) ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Valor de aquisição: <b>R$<?php echo arruma_numero($r -> valor_aquisicao) ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Tempo / Anos: <b><?php echo $r -> tempo_anos ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Taxa de depreciação: <b><?php echo $r -> taxa_depreciacao ?>%</b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Valor residual: <b>R$<?php echo arruma_numero($r -> valor_residual) ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Valor depreciável: <b>R$<?php echo arruma_numero($r -> valor_depreciavel) ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Depreciação do mês: <b>R$<?php echo arruma_numero($r -> depreciacao_mes) ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Depreciação acumulada: <b>R$<?php echo arruma_numero($r -> depreciacao_acumulada) ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Valor líquido: <b>R$<?php echo arruma_numero($r -> valor_liquido) ?></b></label>
												</div>
											</div>
										</div>
										<div class='modal-footer'>
										
											<?php $liquido=$r->valor_liquido; $residual=$r->valor_residual;  if($liquido != $residual){ ?>
											<form name="cadastro" method="POST" action="../componentes/bem-patrimonial/logica/editar.php?id=<?php echo $r->id ?>&liquido=<?php echo $r->valor_liquido ?>&acumulada=<?php echo $r->depreciacao_acumulada ?>&residual=<?php echo $r->valor_residual ?>" enctype="multipart/form-data"> <!-- login.php -->  
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<input class="form-control" id="depreciacao_mes" name="depreciacao_mes" placeholder="Digite a depreciação do mês" type="float" onkeypress="mascara(this,mreais)" required />	
															</div>  
														</div>
													
												
												
													<div class="col-md-6">
													<div class="form-group">
														<button type="submit" class="btn btn-sm btn-default btn-block pull-right" name="submit" value="Send">Depreciar</button>
													</div>
													</div>
												</div>	
											</form>	
											
											
											
											<div class="row">
											
											<hr>
											
															<?php $falta = retorna_falta_empenhar($r -> valor_aquisicao, $r -> id , $conexao_com_banco); ?>
															<form name="cadastro" method="POST" action="../componentes/empenho/logica/cadastrar.php?despesa=<?php echo $r-> id ?>&valor=<?php echo $falta ?>" enctype="multipart/form-data">
																	<div class="col-md-3">
																		Ainda falta empenhar: R$<?php echo arruma_numero($falta); ?>
																	</div>
																	<div class="col-md-3">
																		<input class="form-control" id="empenho" name="empenho" placeholder="Número de empenho" type="text" maxlength="" required/>
																	</div>
																	<div class="col-md-3">
																		<div class="form-group">
																			<input class="form-control" id="valor" onkeypress="mascara(this,mreais)" name="valor" placeholder="Valor a ser empenhado" type="float" maxlength="" required/>
																			<div id="msg" ></div>
																		</div>  
																	</div>
																	<div class="col-md-3">
																		<button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit2' value='Send' id='btn-editar'>Efetuar empenho</button>
																	</div>	
															</form>				
											</div>
											<?php } else { ?>  BEM DEPRECIADO <?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->


<!-- chamando o bootstrap novamente para o modal funcionar -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>

<?php include('footer.php')?>