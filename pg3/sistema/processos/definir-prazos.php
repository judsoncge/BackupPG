<div class="row linha-modal-processo">
	<form method='POST' action='logica/editar.php?operacao=prazos&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo=<?php echo $informacoes['DT_PRAZO'] ?>&prazo_final=<?php echo $informacoes['DT_PRAZO_FINAL'] ?>' enctype='multipart/form-data'>	
		<?php if($_SESSION['permissao-definir-prazo-processo']=='sim'){ ?>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="exampleInputEmail1"><b>Prazo parcial:</b></label>
					<input  class="form-control tipo-data" value='<?php echo $informacoes['DT_PRAZO'] ?>' id="prazo" name="prazo" type="date"/>
				</div>  
			</div>
		<?php } ?>
								
		<?php if($_SESSION['permissao-definir-prazo-final-processo']=='sim'){ ?>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="exampleInputEmail1"><b>Prazo final:</b></label>
					<input class="form-control tipo-data" value='<?php echo $informacoes['DT_PRAZO_FINAL'] ?>' id="prazo_final" name="prazo_final" type="date"/>
				</div>  
			</div>
		<?php } ?>	
		
		<?php if($_SESSION['permissao-definir-prazo-processo']=='sim' or $_SESSION['permissao-definir-prazo-final-processo']=='sim'){ ?>
			<div class="col-md-2">
				<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Definir &nbsp;&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
			</div>
		<?php } ?>	
	</form>
</div>