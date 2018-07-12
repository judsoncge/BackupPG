<?php 

	while($r = mysqli_fetch_object($lista)){ ?>
		<div class='row linha-modal-processo'>
			<thead>
				<tr>
					<th><label class="control-label" for="exampleInputEmail1" style="margin-left:17px;"><b>Documentos da compra </b>: <a href='compra-detalhes.php?sessionId=<?php echo $num ?>&compra=<?php echo $r -> CD_COMPRA ?>'>Ver detalhes</a></label><br></th>
					<?php if($r->NM_STATUS == 'Em análise'){ ?>
						<th>Excluir</th>
					<?php } ?>
				</tr>
			</thead>
			<br>
			<?php if($r->NM_STATUS == 'Processo aberto' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_PUBLICACAO_DIARIO&status=Publicação no diário&mensagem=ANEXOU A PUBLICAÇÃO NO DIARIO&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Publicação no diário:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_PUBLICACAO_DIARIO, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Publicação no diário:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Publicação no diário' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_TERMO_REFERENCIA&status=Termo de referência&mensagem=ANEXOU O TERMO DE REFERÊNCIA&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Termo de referência:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_TERMO_REFERENCIA, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Termo de referência:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Termo de referência' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_COTACAO_PRECO1&status=Cotação de preço 1&mensagem=ANEXOU A PRIMEIRA COTAÇÃO DE PREÇO&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Cotação de preço 1:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_COTACAO_PRECO1, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Cotação de preço 1:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Cotação de preço 1' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_COTACAO_PRECO2&status=Cotação de preço 2&mensagem=ANEXOU A SEGUNDA COTAÇÃO DE PREÇO&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Cotação de preço 2:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_COTACAO_PRECO2, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Cotação de preço 2:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Cotação de preço 2' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_COTACAO_PRECO3&status=Cotação de preço 3&mensagem=ANEXOU A TERCEIRA COTAÇÃO DE PREÇO&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Cotação de preço 3:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_COTACAO_PRECO3, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Cotação de preço 3:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Cotação de preço 3' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_CERTIDAO_NEGATIVA1&status=Certidão negativa 1&mensagem=ANEXOU A PRIMEIRA CERTIDAO NEGATIVA&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Certidão negativa 1:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_CERTIDAO_NEGATIVA1, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Certidão negativa 1:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Certidão negativa 1' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_CERTIDAO_NEGATIVA2&status=Certidão negativa 2&mensagem=ANEXOU A SEGUNDA CERTIDAO NEGATIVA&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Certidão negativa 2:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_CERTIDAO_NEGATIVA2, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Certidão negativa 2:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Certidão negativa 2' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_CERTIDAO_NEGATIVA3&status=Certidão negativa 3&mensagem=ANEXOU A TERCEIRA CERTIDAO NEGATIVA&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Certidão negativa 3:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_CERTIDAO_NEGATIVA3, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Certidão negativa 3:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Certidão negativa 3' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
					<form name='teste' method='POST' action='../componentes/compra/logica/editar.php?operacao=empenhar&compra=<?php echo $r->CD_COMPRA ?>&descricao=<?php echo $r->DS_COMPRA ?>&prazo=<?php echo $r->DT_PRAZO ?>' enctype='multipart/form-data'>
						<div class="col-md-3">
							<label class="control-label" for="exampleInputEmail1"><b>Valor a ser empenhado:</b></label>
						</div>	
						<div class="col-md-3">
							<input class="form-control" placeholder='Digite o valor' onkeypress="mascara(this,mreais)" type="float" id='valor' name='valor' required/>
						</div>
						<div class="col-md-3">
							<select class="form-control" id="tipo" name="tipo" required/>
								<option value="">Selecione o tipo da despesa</option>
								<?php $lista = retorna_tipos_despesas($conexao_com_banco);
								while($r2 = mysqli_fetch_object($lista)){ ?>
									<option value="<?php echo $r2->CD_DESPESA ?>"><?php echo $r2->NM_DESPESA?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-3">
							<button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Empenhar</button></a>
						</div>
					</form>
			<?php }else if($r->ID_DESPESA_COMPRA != ''){ ?>
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1"><b>Compra empenhada.</b></label>
					</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Empenhada' and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?compra=<?php echo $r->CD_COMPRA ?>&coluna=ID_ANEXO_AQUISICAO&status=Aquisição&mensagem=ANEXOU A AQUISIÇÃO&pasta=anexos' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Aquisição:</b></label>
							<td><input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/></td>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Anexar</button></a>
						</form>
				</div>
			<?php }else{ $anexo = retorna_nome_anexo($r->ID_ANEXO_AQUISICAO, $conexao_com_banco); ?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Aquisição:</b></label>
							<a href="../registros/anexos/<?php echo $anexo ?>" download><?php echo $anexo ?></a>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
			<?php if($r->NM_STATUS == 'Aquisição' and $_SESSION['permissao-efetuar-compra']=='sim'){?>
				<div class="col-md-12">
						<form name='teste' method='POST' action='../componentes/compra/logica/editar.php?operacao=pagar&compra=<?php echo $r->CD_COMPRA ?>&despesa=<?php echo $r->ID_DESPESA_COMPRA ?>&prazo=<?php echo $r->DT_PRAZO ?>' enctype='multipart/form-data'>
							<label class="control-label" for="exampleInputEmail1"><b>Clique para pagar a compra:</b></label>
							<td><button type="submit" class='btn btn-sm btn-info' style="margin-right:10px;">Pagar</button></a>
						</form>
				</div>
			<?php }else if($r->NM_STATUS == 'Paga' or $r->NM_STATUS == 'Paga com atraso'){?>
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1"><b>Compra paga. Por favor, conclua e finalize o processo.</b></label>
						</div>
				</div>
			<?php } ?>
			<br>
			<br>
		</div>
	<?php }



