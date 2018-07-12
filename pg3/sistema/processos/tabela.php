<?php include('../includes/mensagem.php'); ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" <?php if(isset($_GET['filtro'])){
									?> value="<?php echo $_GET['filtro'] ?>" <?php } ?> class="input-search form-control" alt="tabela-dados" placeholder="Buscar por número do processo ou situação ou situação final" id="search" autofocus="autofocus" />
								</div>
							</div>
							<?php if($_SESSION['permissao-abrir-processo']=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastrar.php" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Processo</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Processo</th>
									<th>Está com</th>
									<th>No setor</th>
									<th>Situação</th>
									<th>Situação Final</th>
									<th>Prazo Final</th>
									<th>Dias no órgão</th>
									<th><center>+</center></th>
									<th><center><i class="fa fa-pencil" aria-hidden="true"></i></center></th>
								</tr>	
							</thead>
							<tbody>
								<?php 
									$total = 0; 
									while($r = mysqli_fetch_object($lista)){ 
										$total = $total+1; ?>	
											<tr <?php if($r -> NM_SITUACAO == 'Análise em atraso' or $r -> NM_SITUACAO_FINAL == 'Finalização em atraso'){ ?> style="background-color: #e74c3c; color:white;"<?php } ?> > 
												<td>
													<?php echo $r -> CD_PROCESSO; ?>
												</td>
												<td>
													<?php echo $r-> NM_SERVIDOR_LOCALIZACAO; ?>
												</td>	
												<td>
													<?php echo $r-> CD_SETOR_LOCALIZACAO; ?>
												</td>	
												<td>
													<?php echo $r-> NM_SITUACAO; ?>
												</td>
												<td>
													<?php echo $r-> NM_SITUACAO_FINAL; ?>
												</td>
												<td>
													<?php echo arruma_data($r-> DT_PRAZO_FINAL); ?>
												</td>
												<td>
													<?php echo $r-> NR_DIAS; ?>
												</td>	
												<td>
													<center>
														<a href='detalhes.php?processo=<?php echo $r -> CD_PROCESSO ?>'>
															<button id='detalhes' type='button' class='btn btn-default btn-sm'>
																<i class='fa fa-eye' aria-hidden='true'></i>
															</button>
														</a>
													</center>
												</td>
												<td><center>
													<?php 
													if(($_SESSION['permissao-editar-processo']=='sim' and  $r -> NM_STATUS == 'Ativo' and $r ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-editar-processo']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $r -> NM_STATUS == 'Ativo' and ($r ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $r ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-editar-processo']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $r -> NM_STATUS == 'Ativo')){
													?>
														<a href="editar.php?processo=<?php echo $r -> CD_PROCESSO ?>">
															<button type='button' class='btn btn-secondary btn-sm' title="Editar">
																<i class="fa fa-pencil" aria-hidden="true"></i>
															</button>
														</a>
													<?php }else{ ?>
															-
													<?php } ?>
													<?php if(($_SESSION['permissao-excluir-processo']=='sim' and  $r -> NM_STATUS == 'Ativo' and $r ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-excluir-processo']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $r -> NM_STATUS == 'Ativo' and ($r ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $r ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-excluir-processo']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $r -> NM_STATUS == 'Ativo')){
													?>
														<a href="logica/excluir.php?processo=<?php echo $r -> CD_PROCESSO ?>" onclick="return confirm('Você tem certeza que deseja apagar este processo?');">
															<button type='button' class='btn btn-secondary btn-sm' title="Excluir">
																<i class="fa fa-trash" aria-hidden="true"></i>
															</button>
														</a>
													<?php }else{ ?>
															-
													<?php } ?>
												</center></td>
											</tr>
									<?php } ?>	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>