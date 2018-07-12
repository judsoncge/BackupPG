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
		<p>RMA</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo item, mês, ano ou qualquer valor" id="search"/>
								</div>
							</div>
							<div class="col-sm-2 col-xs-12 pull-right">
								<a href="cadastro-rma.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo item</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados table-bordered">
							<thead>
								<tr>
									<th>Código</th>
									<th>Item</th>
									<th>Medida</th>
									<th>Quantidade</th>
									<th><center>Ver detalhes, empenhar ou atualizar quantidade</center></th>
									
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_dados("almoxarifado", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
									<td><?php echo $r -> codigo ?></td>
									<td><?php echo $r -> item ?></td>
									<td><?php echo $r -> medida ?></td>
									<td><?php echo $r -> quantidade_atual ?></td>
		
								    <td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
									data-target='#<?php echo $r -> codigo ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
	
								</tr>

								<div class='modal fade' id='<?php echo $r -> codigo ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title' id='myModalLabel'> Item <?php echo $r -> item ?></h4>
										</div>
										<div class='modal-body'>
											<div class="row">
												<div class="col-md-4">
													<label class="control-label" for="exampleInputEmail1">Código: <b><?php echo $r -> codigo ?></b></label>
												</div>
												<div class="col-md-4">
													<label class="control-label" for="exampleInputEmail1">Nome: <b><?php echo $r -> item ?></b></label>
												</div>												
												<div class="col-md-4">
													<label class="control-label" for="exampleInputEmail1">Quantidade atual: <b><?php echo $r -> quantidade_atual ?></b></label>
												</div>
											</div>
										</div>
										<div class='modal-footer'>
										<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_financeiro',$conexao_com_banco); if($permissao=='Sim'){ ?>								
										<div class="row">
															<form name="cadastro" method="POST" action="../componentes/empenho/logica/cadastrar.php?despesa=RMA_<?php echo $r-> codigo ?>&valor=999999999999999999" enctype="multipart/form-data">
																	<div class="col-md-4">
																		<input class="form-control" id="empenho" name="empenho" placeholder="Número de empenho" type="text" maxlength="" required/>
																	</div>
																	<div class="col-md-4">
																		<div class="form-group">
																			<input class="form-control" id="valor" onkeypress="mascara(this,mreais)" name="valor" placeholder="Valor a ser empenhado" type="float" maxlength="" required/>
																			<div id="msg" ></div>
																		</div>  
																	</div>
																	<div class="col-md-4">
																		<button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit2' value='Send' id='btn-editar'>Efetuar empenho</button>
																	</div>	
															</form>				
										</div>
										<div class="row">
										<hr>
															<form name="cadastro" method="POST" action="../componentes/rma/logica/editar.php?codigo=<?php echo $r-> codigo ?>" enctype="multipart/form-data">
																	<div class="col-md-4">
																		<div class="form-group">
																					<select class="form-control" id="acao" name="acao" required/>
																						<option value="">Entrada ou Saída?</option>
																						<option value="Saída">Saída</option>
																						<option value="Entrada">Entrada</option>
																					</select>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<div class="form-group">
																			<input class="form-control" id="quantidade" name="quantidade" placeholder="Digite a quantidade" type="number" maxlength="" required/>
																		</div>  
																	</div>
																	<div class="col-md-4">
																		<button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit2' value='Send' id='btn-editar'>Atualizar quantidade</button>
																	</div>	
															</form>				
										</div>
										<?php } ?>
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