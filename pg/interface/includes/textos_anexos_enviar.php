<div class='row' style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: white; margin: 5px;'>
	<div class="col-md-12">
		<form name='teste' method='POST' action='../componentes/documento/logica/editar_fato.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>' enctype='multipart/form-data'>
			<div class="form-group">
				<label class="control-label" for="comment"><b>Descrição do fato:</b></label>
				<input class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300" value='<?php echo $descricao_fato ?>' required/>
				<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'modificar_documento_todos',$conexao_com_banco); 
				if($permissao=='Sim' and $status == 'Em análise') { ?>
				<button type='submit' class='btn btn-sm btn-info pull-right' >Editar fato</button>
				<?php } ?>
			</div>	
		</form>	
	</div>
	<div>
		<div class="form-group">
			<form name='teste' method='POST' action='../componentes/documento/logica/editar_resposta.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>' enctype='multipart/form-data'>
				<label class="control-label" for="comment"><b>Texto do documento:</b></label>
				<textarea class="form-control" rows="12" id="texto_documento" name="texto_documento"  maxlength="1000" required>
				<?php echo $texto_documento ?></textarea>	
				<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'modificar_documento_todos',$conexao_com_banco); 
				if($permissao=='Sim' and $status == 'Em análise') { ?>
				<button type='submit' class='btn btn-sm btn-info pull-right' >Gravar texto documento</button>
				<?php } ?>
			</form>	
		</div>
	</div>
	<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'sugestao_documento',$conexao_com_banco); if($permissao=='Sim' and  $status != 'Aprovado' and $status != 'Resolvido'){     ?>
															<div>
																<div class="form-group">
																	<form name='teste' method='POST' action='../componentes/documento/logica/editar_sugerir.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>' enctype='multipart/form-data'>
																		<div class='row'>
																			<div class="col-md-12">
																				<label class="control-label" for="comment"><b>Sugestão para texto (max. 2000 caract):</b></label>
																				<textarea class="form-control" rows="12" id="sugestao_resposta" name="sugestao_resposta"  maxlength="2000" required>Sem texto</textarea>	<br>
																			</div>
																		</div>
																		<div class='row'>
																			<div class="col-md-9">
																				<select class="form-control" id="tipo_sugestao" name="tipo_sugestao" required/>
																					<option value="">Selecione o tipo de sugestão</option>
																					<option value="Erro de português">Erro de português</option>
																					<option value="Word">Formatação de Word</option>
																					<option value="Excel">Formatação de Excel</option>
																					<option value="Power Point">Power Point</option>
																					<option value="Legislação">Legislação</option>
																					<option value="Softwares de uso do órgão">Softwares de uso do órgão</option>
																					<option value="Outros">Outros</option>
																				</select>
																			</div>
																			<div class="col-md-3">
																				<button type='submit' class='btn btn-sm btn-info pull-right' >Gravar sugestão</button>
																			</div>
																		</div>
																	</form>	
																</div>
															</div>
															<?php } ?>
</div>
<div class='row linha-modal-processo'>
	<div class="col-md-6">
		Anexos: <br>
		<?php $lista2 = retorna_anexos_documento($id, $conexao_com_banco);
		while($r2 = mysqli_fetch_object($lista2)){ ?>
		<a href="../registros/anexos/<?php echo $r2->caminho ?>" download><?php echo $r2->caminho ?></a><br>
		<?php } ?>
	</div>
	<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'modificar_documento_todos',$conexao_com_banco); 
	if($permissao=='Sim' and $status == 'Em análise') { ?>
	<div class="col-md-6">
		Novo anexo:
		<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF']?>' enctype='multipart/form-data'>
			<div class="form-group">
				<input type="file" class="" name="arquivo_anexo" id="arquivo_anexo" required/>
				<button type='submit' class='btn btn-sm btn-info pull-right' >Gravar</button>
			</div>
		</form>
	</div>	
	<?php } ?>
	
</div>

<?php if($numero_processo==''){ ?>
<div class='row'>
		<form name='teste' method='POST' action='../componentes/documento/logica/editar_enviar.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>' enctype='multipart/form-data'>	
					<div class="row linha-modal-processo">
					<div class="col-md-10">
						<select class="form-control" id="enviar" name="enviar" required/>
							<option value="">Selecione o servidor</option>
							<?php $lista3 = retorna_dados("pessoa", $conexao_com_banco);
								while($r3 = mysqli_fetch_object($lista3)){ ?>
									<option value="<?php echo $r3->CPF ?>"><?php echo $r3->nome . " " . $r3->sobrenome ?></option><?php } ?>
						
						</select>
					</div>
					<div class='col-md-2'>
						<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send'>Enviar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
					</div>
					</div>
		</form>
</div>
<?php }else{ ?>



Este documento está atrelado ao processo <?php echo $numero_processo ?>. Por favor, tramite o processo e este documento irá junto.





<?php } ?>

