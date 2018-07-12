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
		<p>Veículos</p>
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
							<div class="col-sm-2 col-xs-12 pull-right">
								<a href="cadastro-veiculo.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo Veículo</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Placa</th>
									<th>Modelo</th>
									<th>Renavam</th>
									<th>Condutor</th>
									<th><center>Ver detalhes</center></th>
									<th id="ano">Ano</th>
									
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_dados("veiculo", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
									<td><?php echo $r -> placa ?></td>
									<td><?php echo $r -> modelo ?></td>
									<td><?php echo $r -> renavam ?></td>			
									<td><?php $beneficiario2 = retorna_nome_pessoa($r -> Pessoa_CPF_condutor, $conexao_com_banco); echo $beneficiario2 ?></td>
																	
									
								    <td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
									data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
				
									
									
								</tr>

								<div class='modal fade' id='<?php echo $r -> id ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title' id='myModalLabel'> Veículo de placa <?php echo $r -> placa ?></h4>
										</div>
										<div class='modal-body'>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Placa: <b><?php echo $r -> placa ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Modelo: <b><?php echo $r -> modelo ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Renavam: <b><?php echo $r -> renavam ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Condutor: <b><?php echo $beneficiario2 ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Termo de cessão: <b><?php echo $r -> termo_cessao ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Valor: <b>R$<?php echo arruma_numero($r -> valor) ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Ano de fabricação: <b><?php echo $r -> ano_fabricacao ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Locado: <b><?php echo $r -> locado ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Possui seguro: <b><?php echo $r -> seguro ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Possui logomarca: <b><?php echo $r -> logomarca ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Possui licenciamento: <b><?php echo $r -> licenciado ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">É recolhido para a garagem a noite: <b><?php echo $r -> recolhido_garagem_noite ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Possui chip: <b><?php echo $r -> chipado ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Chip: <b><?php echo $r -> codigo_chip ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label class="control-label" for="exampleInputEmail1">Observações: <b><?php echo $r -> observacoes ?></b></label>
												</div>
											</div>
										</div>
										<div class='modal-footer'>
										
										<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_financeiro',$conexao_com_banco); if($permissao=='Sim'){ ?>		
										
										<div class="row">
												
											<div class="col-md-6">
													<a href='edita-veiculo.php?sessionId=<?php echo $num ?>&veiculo=<?php echo $r->id ?>' name='submit' value='Send' id='btn-editar'><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-editar'>Editar veículo &nbsp;&nbsp;<i class='fa fa-pencil-square' aria-hidden='true'></i></button></a>
											</div>	
											<div class="col-md-6">
													<a href='../componentes/veiculo/logica/excluir.php?id=<?php echo $r -> id ?>' name='submit' value='Send' id='btn-editar'><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-editar'>Excluir veículo &nbsp;&nbsp;<i class='fa fa-pencil-square' aria-hidden='true'></i></button></a>
											</div>	
										
										</div>	
										
										
										
													
													<hr>
														
														<div class="row">
															<?php $falta = retorna_falta_empenhar($r -> valor, $r -> id , $conexao_com_banco); ?>
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
											
											
													<hr>
														
														
										
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