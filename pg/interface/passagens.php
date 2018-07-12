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
		<p>Passagens Aéreas</p>
	</div>
	<div class="container caixa-conteudo">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo beneficiário, valor pago, quantidade de diárias, destino ou ano" id="search"/>
								</div>
							</div>
							<div class="col-sm-2 col-xs-12 pull-right">
								<a href="cadastro-passagem.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Nova passagem</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Beneficiário</th>
									<th>Destino</th>
									<th>Data - ida</th>
									<th>Data - volta</th>
									<th>Valor - ida</th>			
									<th>Valor - volta</th>			
									<th><center>Ver detalhes ou empenhar</center></th>
									
									<th id="ano">Ano</th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_dados("passagem_aerea", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>

								<tr>
									<td><?php $beneficiario2 = retorna_nome_pessoa($r -> Pessoa_CPF_beneficiario, $conexao_com_banco); echo $beneficiario2 ?></td>
									<td><?php echo $r -> destino_viagem ?></td>
									<td><?php echo arruma_data($r -> data_ida) ?></td>
									<td><?php echo arruma_data($r -> data_volta) ?></td>
									<td>R$ <?php echo arruma_numero($r-> valor_pago_ida) ?></td>
									<td>R$ <?php echo arruma_numero($r-> valor_pago_volta) ?></td>
																	
								    <td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
									data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
									
									
								</tr>

								<div class='modal fade' id='<?php echo $r -> id ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title' id='myModalLabel'> Passagem de <?php echo $beneficiario2 ?> para <?php echo $r->destino_viagem ?></h4>
										</div>
										<div class='modal-body'>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Número do empenho: <b><?php echo $r -> numero_empenho ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Beneficiário: <b><?php echo $beneficiario2 ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Nº do processo no Integra: <b><?php echo $r -> numero_processo_integra ?></b></label>
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Destino da viagem: <b><?php echo $r -> destino_viagem ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Data de ida: <b><?php echo arruma_data($r -> data_ida) ?></b></label>
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Horário de ida: <b><?php echo $r -> horario_ida ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Valor pago na ida: <b>R$ <?php echo arruma_numero($r -> valor_pago_ida) ?></b></label>
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Data de volta: <b><?php echo arruma_data($r -> data_volta) ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Horário de volta: <b><?php echo $r -> horario_volta ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Valor pago na volta: <b>R$ <?php echo arruma_numero($r -> valor_pago_volta) ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Finalidade da viagem: <b><?php echo $r -> finalidade ?></b></label>
												</div>
											</div>
										</div>
										<div class='modal-footer'>
										
										<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_financeiro',$conexao_com_banco); if($permissao=='Sim'){ ?>								
										<div class="row">
												
											<div class="col-md-6">
													<a href='edita-passagem.php?sessionId=<?php echo $num ?>&passagem=<?php echo $r->id ?>' name='submit' value='Send' id='btn-editar'><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-editar'>Editar passagem &nbsp;&nbsp;<i class='fa fa-pencil-square' aria-hidden='true'></i></button></a>
											</div>
											<div class="col-md-6">
													<a href='../componentes/passagem/logica/excluir.php?id=<?php echo $r -> id ?>' name='submit' value='Send' id='btn-editar'><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-editar'>Excluir passagem &nbsp;&nbsp;<i class='fa fa-pencil-square' aria-hidden='true'></i></button></a>
											</div>	
										
										</div>	
										
										
										<?php $valor_ida = $r->valor_pago_ida; $valor_volta = $r->valor_pago_volta; $valor = $valor_ida+$valor_volta; ?>
													
													<hr>
														
														<div class="row">
															<?php $falta = retorna_falta_empenhar($valor, $r -> id , $conexao_com_banco); ?>
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