
												<div class="row linha-modal-processo">

													<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'finalizar_processo',$conexao_com_banco); 
														//se o processo já estiver concluído (com ou sem atraso), o botão de finalizar aparece
														if($permissao=='Sim' and ($situacao == 'Concluído' or $situacao == 'Concluído com atraso') and $situacao_final != 'Finalizado' and $situacao_final != 'Finalizado com atraso') { ?> 
															<a href="../componentes/processo/logica/editar_historico.php?operacao=finalizar&processo=<?php echo $numero_processo ?>&anterior=<?php echo $situacao_final ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar &nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a> <?php } ?>
													<!-- Somente algumas pessoas podem concluir um processo -->		
													<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'concluir_processo',$conexao_com_banco); if($permissao=='Sim'){ if(($situacao == 'Em andamento' or $situacao == 'Análise em atraso') and $prazo != '0000-00-00') { ?> <a href="../componentes/processo/logica/editar_historico.php?operacao=concluir&processo=<?php echo $numero_processo ?>&anterior=<?php echo $situacao ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Concluir processo&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a> <?php } }?>
													<!-- Somente algumas pessoas podem arquivar num processo -->
													<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'arquivar_processo',$conexao_com_banco); if($permissao=='Sim' and $situacao == 'Concluído' or $situacao == 'Concluído com atraso'	) { ?> <a href="../componentes/processo/logica/editar_historico.php?operacao=arquivar&processo=<?php echo $numero_processo ?>&situacao_final=<?php echo $situacao_final ?>"><button type='submit' class='btn btn-sm btn-warning pull-left' name='submit' value='Send' id='botao-arquivar'>Arquivar processo&nbsp;&nbsp;<i class="fa fa-folder" aria-hidden="true"></i></button></a><?php } ?>
													<!-- Somente algumas pessoas podem dar saída num processo -->
													<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'saida_processo',$conexao_com_banco); if($permissao=='Sim' and $situacao_final == 'Finalizado' or $situacao_final == 'Finalizado com atraso'	) { ?> <a href="../componentes/processo/logica/editar_historico.php?operacao=sair&processo=<?php echo $numero_processo ?>"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Dar saída no processo&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a><?php } ?>											
													<!-- Se o processo ainda estiver em andamento, a pessoa pode criar um documento (despacho ou parecer) -->
													<?php if($situacao_final != 'Finalizado' and $situacao_final != 'Finalizado com atraso'){ ?>
														<a href="cadastro-documento.php?sessionId=<?php echo $num ?>&processo=<?php echo $numero_processo ?>&tipo=Parecer&prazo=<?php echo $prazo ?>&entrada=<?php echo $data_entrada ?>&descricao=<?php echo $descricao ?>&interessado=<?php echo $interessado ?>"><button class='btn btn-sm btn-info pull-right' id='botao-dar-saida' style="margin-right:10px;"><i class="fa fa-plus-circle"></i> Parecer</button></a>
														<!-- Somente algumas pessoas podem cadastrar um despacho -->
														<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_despacho',$conexao_com_banco); if($permissao=='Sim'){ ?>
															<a href="cadastro-documento.php?sessionId=<?php echo $num ?>&processo=<?php echo $numero_processo ?>&tipo=Despacho&prazo=<?php echo $prazo ?>&entrada=<?php echo $data_entrada ?>&descricao=<?php echo $descricao ?>&interessado=<?php echo $interessado ?>"><button class='btn btn-sm btn-info pull-right' id='botao-dar-saida' style="margin-right:10px;"><i class="fa fa-plus-circle"></i> Despacho</button></a>
														<?php } ?>
													
													<?php } ?>
												</div> 