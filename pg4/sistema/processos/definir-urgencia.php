
<div class="row linha-modal-processo">
	<?php if(array_key_exists('permissao-urgencia-processo', $_SESSION) && $_SESSION['permissao-urgencia-processo'] =='sim'){ ?>
				<?php	if ($informacoes['NR_URGENCIA'] == 1) {?>	
						<a href="logica/editar.php?operacao=urgente&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&valor=0"><button class='btn btn-sm btn-info pull-right btn-danger' id='botao-desmarcar-urgente' style="margin-right:10px;"><i class="fa fa-exclamation-triangle"></i> Desmarcar urgente</button></a>
				<?php	} else {?>	
						<form action="logica/editar.php?operacao=urgente&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&valor=1" method="POST">
							<div class="col-md-10">
								<label class="control-label" for="exampleInputEmail1"><b>Justifique o motivo do processo ser urgente</b></label>
								<input class="form-control" id="justificativa" name="justificativa" placeholder="Máximo de 100 caracteres" type="text" maxlenght="100" required />	
							</div>
							<div class='col-md-2'>
								<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar';>Definir URGENTE</button>
							</div>
						</form>
				<?php	}


			 } ?>
</div>