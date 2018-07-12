<div class="row linha-modal-processo">
	<form method='POST' action='../componentes/documento/logica/editar.php?sessionId=<?php echo $num ?>&operacao=mensagem&documento=<?php echo $id ?>' enctype='multipart/form-data'>	
		<div class="col-md-10">
			<label class="control-label" for="exampleInputEmail1"><b>Deixe um recado</b></label>
			<input class="form-control" id="resposta" name="resposta" placeholder="Máximo de 100 caracteres" type="text" maxlenght="100" required />	
		</div>
		<div class='col-md-2'>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar' onclick="play()";>Enviar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
		</div>
	</form>
</div>
	
