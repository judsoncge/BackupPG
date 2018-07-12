<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo processo, tipo de documento, pessoa que criou ou com quem está, prioridade e status" id="search"/>
								</div>
							</div>							
							
							<?php if($_SESSION['permissao-cadastrar-documento']=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastrar.php" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Documento</a>
								</div>
							<?php } ?>
	
						
						</div>
					</div>
						<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
							<table class="table table-hover tabela-dados">
								<thead>
									<tr>
										<th>Processo relacionado</th>
										<th>Tipo</th>
										<th>Criado por</th>
										<th>Está com</th>
										<th>Prioridade</th>
										<th>Status</th>
										<th><center>+</center></th>
										<th><center><i class="fa fa-pencil" aria-hidden="true"></center></i></th>
									</tr>	
								</thead>
								<tbody>
									<?php while($r = mysqli_fetch_object($lista)){ ?>
											<tr>
												<td>
													<?php if($r -> CD_PROCESSO != ''){ ?>
														<a href='../processos/detalhes.php?processo=<?php echo $r -> CD_PROCESSO ?>&pagina=geral'><?php echo $r -> CD_PROCESSO ?>
														</a>
													<?php }else{ ?>
														Sem processo
													<?php } ?>
												</td>
												<td>
													<?php echo $r -> NM_DOCUMENTO ?>
												</td>
												<td>
													<?php echo $r -> NM_SERVIDOR_CRIACAO ?>
												</td>
												<td>
													<?php echo $r -> NM_SERVIDOR_LOCALIZACAO ?>
												</td>
												<td>
													<?php echo arruma_prioridade($r -> NR_PRIORIDADE) ?>
												</td>
												<td>
													<?php echo $r -> NM_STATUS ?>
												</td>
												<td>
													<center>
														<a href='detalhes.php?documento=<?php echo $r->CD_DOCUMENTO ?>&pagina=<?php echo $pagina ?>'>
														<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
														><i class='fa fa-eye' aria-hidden='true'></i></button></a>
													</center>
												</td>
												<td>
													<center>
													<?php if(($_SESSION['permissao-editar-documento']=='sim' and  $r -> NM_STATUS == 'Em análise' and $r ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-editar-documento']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $r -> NM_STATUS == 'Em análise' and ($r ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $r ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-editar-documento']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $r -> NM_STATUS == 'Em análise')){	
														if($r -> CD_PROCESSO == ''){ ?>
															<a href='editar.php?documento=<?php echo $r -> CD_DOCUMENTO ?>&pagina=<?php echo $pagina ?>'><button type='button' class='btn btn-secondary btn-sm' title="Editar" ><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
														<?php }else{?>
															<a href='editar-documento-processo.php?documento=<?php echo $r -> CD_DOCUMENTO ?>&pagina=<?php echo $pagina ?>'><button type='button' class='btn btn-secondary btn-sm' title="Editar" ><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
														<?php } ?>
														
													
													<?php } if(($_SESSION['permissao-excluir-documento']=='sim' and  $r -> NM_STATUS == 'Em análise' and $r ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-excluir-documento']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $r -> NM_STATUS == 'Em análise' and ($r ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $r ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-excluir-documento']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $r -> NM_STATUS == 'Em análise')){ ?>
														<a href="logica/excluir.php?operacao=documento&documento=<?php echo $r -> CD_DOCUMENTO ?>" onclick="return confirm('Você tem certeza que deseja apagar este documento?');"><button type='button' class='btn btn-secondary btn-sm' title="Excluir" ><i class="fa fa-trash" aria-hidden="true"></i></button></a>
													
													<?php } ?>
													
													
													</center>
												
												</td>
											</tr>
									<?php } ?>
							</tbody>			
						</table>
					</div>
				</div>
			</div>
		</div>
	<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>
</div>
