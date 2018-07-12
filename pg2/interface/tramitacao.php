<form name='teste' method='POST' action='../componentes/processo/logica/editar_historico.php?operacao=tramitar&processo=<?php echo $processo ?>&prazo_final=<?php echo $prazo_final ?>&prazo=<?php echo $prazo ?>' enctype='multipart/form-data'>	
											
												<div class='row linha-modal-processo'>
													<div class='col-md-12'>
														<div class='form-group'>
															<label for='comment'>Nova mensagem:</label>
																<input type='text' class='form-control' rows='1' id='comment' name='resposta' maxlength="300">
														</div>	
													</div>
												</div>
												
												
												<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'prazo_final_processo',$conexao_com_banco); if($permissao=='Sim' and ( $r->situacao_final != 'Finalizado' and  $r->situacao_final != 'Finalizado com atraso')) { ?>
														<div class="row linha-modal-processo">
																<div class="col-md-12">
																	<label class="control-label" for="exampleInputEmail1">Prazo para saída do órgão ou arquivamento:</label>
																	<input class="form-control tipo-data" id="prazo_final" name="prazo_final" type="date" value="<?php echo $prazo_final ?>" required />
																</div>
														</div>  
												<?php } ?>
												
												<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'prazo_processo',$conexao_com_banco); if($permissao=='Sim' and ( $r->situacao != 'Concluído' and  $r->situacao != 'Concluído com atraso')) { ?>
														<div class="row linha-modal-processo">
																<div class="col-md-12">
																	<label class="control-label" for="exampleInputEmail1">Prazo para o servidor e superintendente concluírem a análise do processo:</label>
																	<input  class="form-control tipo-data" id="prazo" name="prazo" type="date" value="<?php echo $prazo ?>" required />
																	
																</div>
																
														</div>  
												<?php } ?>
												
												
												<div class="row linha-modal-processo">
													<div class="col-md-10">
														<label class="control-label" for="exampleInputEmail1">Tramitar para</label>
														<select class="form-control" id="tramitar" name="tramitar" required/>
															<option value="">Selecione o servidor</option>
															<?php $lista2 = retorna_pessoas_tramitar($conexao_com_banco);
															while($r2 = mysqli_fetch_object($lista2)){ ?>
															<option value="<?php echo $r2->CPF ?>"><?php echo $r2->nome . " " . $r2->sobrenome ?></option><?php } ?>
														</select>
													</div>
													<div class='col-md-2'>
														<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Tramitar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
													</div>
												</div>
</form>