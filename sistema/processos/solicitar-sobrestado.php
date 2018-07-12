<div class="row linha-modal-processo">
	<label class="control-label" for="exampleInputEmail1"><b>Solicitar Sobrestado</b></label>
	<form method='POST' action='logica/editar.php?operacao=solicitar_sobrestado&id=<?php echo $id ?>' enctype='multipart/form-data'>	
		<div class="col-md-10">
			<input class="form-control" id="justificativa" name="justificativa" placeholder="Digite aqui a sua justificativa (Máximo de 50 caracteres)" type="text" maxlength="50" required />	
		</div>
		<div class='col-md-2'>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar' onclick="play()">Solicitar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
		</div>
	</form>
</div>