<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Chamados</p>
	</div>
	<div class="container caixa-conteudo">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-8">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo solicitante ou setor" id="search"/>
								</div>
							</div>
							
							
							<?php 
							
							$n = retorna_numero_chamados_sem_nota($_SESSION['CPF'], $conexao_com_banco);
							if($n == 0){ ?>
							
							<div class="col-sm-4 pull-right">
								<a href="abrir-chamado.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Abrir Chamado</a>
							</div>
							
							<?php } else { ?>
							
							Você tem <?php echo sizeof($n) ?> chamado sem nota. Dê nota aos que faltam e depois você poderá abrir um chamado.
							
							<?php } ?>
							
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Data de abertura</th>
									<th>Natureza do problema</th>
									<th>Solicitante</th>
									<th>Setor</th>
									<th>Status</th>
									<th>Nota</th>
									<th><center>Ver detalhes</center></th>
									<th><center>Ação</center></th>
									
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_dados("chamado", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ $id = $r->id?>
								
								
								<tr>
									<td><?php echo arruma_data2($r -> data_abertura) ?></td>
									<td><?php echo $r -> natureza_problema ?></td>
									<td><?php echo retorna_nome_pessoa($r -> Pessoa_CPF_requisitante, $conexao_com_banco)?></td>
									<td><?php echo $r -> setor ?></td>
									<td><?php echo $r -> status ?></td>
									<td><?php echo $r -> nota ?></td>
									
								    <td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
									data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
									
									<td><center>
									<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'fechar_chamado',$conexao_com_banco); 
									if($permissao=='Sim' and $r->status != 'Resolvido'){ ?>
											<a href='../componentes/chamado/logica/editar.php?chamado=<?php echo $r -> id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>'><button type='button' class='btn btn-secondary btn-sm' title="Retirar"><i aria-hidden="true"></i>Fechar</button></a>
									<?php } 
									if($permissao=='Sim' and $r->status == 'Resolvido' and $r -> nota != 'Sem nota'){ ?>
											<a href='../componentes/chamado/logica/editar_encerrar.php?chamado=<?php echo $r -> id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>'><button type='button' class='btn btn-secondary btn-sm' title="Retirar"><i aria-hidden="true"></i>Encerrar</button></a>
									<?php } 
									if($permissao=='Sim' and $r->status == 'Aberto'){ ?>
											<a href='../componentes/chamado/logica/excluir.php?id=<?php echo $r -> id ?>'><button type='button' class='btn btn-secondary btn-sm' title="Retirar"><i aria-hidden="true"></i>Excluir</button></a>
									<?php } ?>
									</center></td>
									
								</tr>

								<div class='modal fade' id='<?php echo $r -> id ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title' id='myModalLabel'> Chamado de <?php echo retorna_nome_pessoa($r -> Pessoa_CPF_requisitante, $conexao_com_banco)?> sobre <?php echo $r -> natureza_problema ?></h4>
										</div>
										<div class='modal-body'>
											<div class='row'>
												<div class='col-md-6'>
													<label class='control-label' id='solicitante'><b>Solicitante</b>: <?php echo retorna_nome_pessoa($r -> Pessoa_CPF_requisitante, $conexao_com_banco) ?></label>
												</div>
											</div>
											<div class='row'>
												<div class='col-md-3'>
													<label class='control-label' id='data_abertura'><b>Natureza do problema</b>: <?php echo $r -> natureza_problema ?></label>
												</div>
												<div class='col-md-3'>
													<label class='control-label' id='data_abertura'><b>Data de abertura</b>: <?php echo arruma_data2($r -> data_abertura) ?></label>
												</div>
												<div class='col-md-3'>
													<label class='control-label' id='data_abertura'><b>Data de fechamento</b>: <?php echo arruma_data2($r -> data_fechamento) ?></label>
												</div>
												<div class='col-md-3'>
													<label class='control-label' id='data_abertura'><b>Nota do atendimento</b>: <?php echo $r -> nota ?></label>
												</div>
											</div>
											<hr>											
											<div class='row'>
												<div class='col-md-12'>
													<label class='control-label' id='data_abertura'><b>Relato do problema</b>:</label>
													<p class='text-justify'><?php echo $r->problema ?></p>
												</div>
											</div>						
											<hr>
											
											
											
											
											
											<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
												<div class="col-md-12">

													<label>Histórico do chamado:</label>
													<br>
													<?php 
													$lista2 = retorna_historico_chamado($id, $conexao_com_banco);
													while($r2 = mysqli_fetch_object($lista2)){ 
													

													$mensagem = '';
													$data = arruma_data2($r2->data_mensagem);
													$foto = retorna_foto_pessoa($r2->pessoa, $conexao_com_banco);
                                                    $nome = retorna_nome_pessoa($r2->pessoa, $conexao_com_banco);
                                                    
													if ($r2-> acao == "Ação") { ?>
                                                    <div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(236, 240, 241,0.4); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo $r2->mensagem ?></div>
													<?php } 
													else if($r2-> acao == "Mensagem"){?>
                                                    <div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(46, 204, 113,0.3); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo $r2->mensagem ?></div>

													<?php }

													}	?>
												</div>
												
											</div>
												<?php if($r->status != 'Resolvido'){ ?>
												<form name='teste' method='POST' action='../componentes/chamado/logica/editar_historico.php?operacao=Mensagem&chamado=<?php echo $id ?>' enctype='multipart/form-data'>
														<div class='row linha-modal-processo'>
															<div class='col-md-10'>
																<div class='form-group'>
																	<label for='comment'>Nova mensagem:</label>
																	<input type='text' class='form-control' rows='1' id='comment' name='mensagem' maxlength="300" required></input>
																</div>	
															</div>
															<div class="col-md-2">
																<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-enviar-mensagem'><i class='fa fa-comments fa-lg' aria-hidden='true'></i></button>
															</div>
														</div>
												
												</form>
												<?php } ?>
											<hr>
											
												
										<div class='row'>
													
												<div class='modal-footer'>
													<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'nota_chamado',$conexao_com_banco); if($permissao=='Sim' and $r->status == 'Resolvido' and $r->nota == 'Sem nota'){ ?>
													<div class='row'>
													<hr>		
														<form name="cadastro" method="POST" action="../componentes/chamado/logica/editar_nota.php?chamado=<?php echo $r -> id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>" enctype="multipart/form-data">
															<div class="col-md-6">
																<select class="form-control" id="nota" name="nota" required/>
																	<option value="">Dê uma nota para o atendimento</option>
																	<option value="Péssimo">Péssimo</option>
																	<option value="Ruim">Ruim</option>
																	<option value="Regular">Regular</option>
																	<option value="Bom">Bom</option>
																	<option value="Excelente">Excelente</option>
																</select>
															</div>
															<div class="col-md-6">
																<button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit2' value='Send' id='btn-editar'>Dar nota</button>
															</div>	
														</form>				
													</div>
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