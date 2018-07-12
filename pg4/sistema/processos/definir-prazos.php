<div class="row linha-modal-processo">
	<form method='POST' action='logica/editar.php?operacao=prazos&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo=<?php echo $informacoes['DT_PRAZO'] ?>' enctype='multipart/form-data'>	
		<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="exampleInputEmail1"><b>Prazo:</b></label>
					<input  class="form-control tipo-data" value='<?php echo $informacoes['DT_PRAZO'] ?>' id="prazo" name="prazo" type="date" required/>
				</div>  
			</div>
			
		<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="exampleInputEmail1"><b>Justificativa:</b></label>
					<input class="form-control tipo-data" id="justificativa" name="justificativa" type="text" required/>
				</div>  
		</div>	
	
		<div class="col-md-2">
				<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Definir &nbsp;&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
		</div>	
	</form>
</div>