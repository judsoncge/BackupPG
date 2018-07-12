<?php if($informacoes['CD_PROCESSO']==''){ ?>
	<div class="row linha-modal-processo">
		<form name='teste' method='POST' action='logica/editar.php?&operacao=enviar&documento=<?php echo $id ?>' enctype='multipart/form-data'>	
			<div class="col-md-10">
				<label class="control-label" for="exampleInputEmail1"><b>Enviar o DOCUMENTO para</b></label>
					<select class="form-control" id="enviar" name="enviar" required/>
						<option value="">Selecione o servidor</option>
							<?php $lista3 = retorna_servidores_tramitar($informacoes['CD_SERVIDOR_LOCALIZACAO'], $conexao_com_banco);
								while($r3 = mysqli_fetch_object($lista3)){ ?>
									<option value="<?php echo $r3->CD_SERVIDOR ?>"><?php echo $r3->NM_SERVIDOR . " " . $r3->SNM_SERVIDOR?></option><?php } ?>
						
					</select>
			</div>
			<div class='col-md-2'>
				<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Enviar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
			</div>
		</form>
	</div>
<?php }else{ ?>
			<form name='teste' method='POST' action='../processos/logica/editar.php?&operacao=tramitar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo=<?php echo $prazo ?>&prazo_final=<?php echo $prazo_final ?>' enctype='multipart/form-data'>	
				<div class="row linha-modal-processo">
					<div class="col-md-10">
						<label class="control-label" for="exampleInputEmail1"><b>Tramitar o PROCESSO para</b></label>
						<select class="form-control" id="tramitar" name="tramitar" required/>
							<option value="">Selecione o servidor</option>
							<?php $lista2 = retorna_servidores_tramitar($informacoes['CD_SERVIDOR_LOCALIZACAO'], $conexao_com_banco);
							while($r2 = mysqli_fetch_object($lista2)){ ?>
							<option value="<?php echo $r2->CD_SERVIDOR . "//" . $r2->NM_SERVIDOR . " " . $r2->SNM_SERVIDOR?>"><?php echo $r2->NM_SERVIDOR . " " . $r2->SNM_SERVIDOR ?></option><?php } ?>
						</select>
					</div>
					<div class='col-md-2'>
						<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Tramitar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
					</div>
				</div>
			</form>
<?php } ?>
</div>