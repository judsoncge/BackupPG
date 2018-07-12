<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
	<form name="cadastro" method="POST" action="../componentes/chamado/logica/editar.php?sessionId=<?php echo $num ?>&operacao=nota&chamado=<?php echo $id ?>" enctype="multipart/form-data">
		<div class="col-md-10">
			<label class="control-label" for="exampleInputEmail1"><b>Dê uma nota para o atendimento</b></label>
			<select class="form-control" id="nota" name="nota" required/>
				<option value="">Selecione a nota</option>
				<option value="Péssimo">Péssimo</option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
		</div>
		<div class='col-md-2'>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar' onclick="play()";>Dar nota &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
		</div>
	</form>				
</div>