<div class="row linha-modal-processo">
	<div class="col-md-12">
		<form name='teste' method='POST' action='logica/editar.php?operacao=sugerir&documento=<?php echo $id ?>' enctype='multipart/form-data'>
			<div class='row'>
				<div class="col-md-6">
					<label class="control-label" for="comment"><b>Sugestão para texto (max. 2000 caract):</b></label>
						<textarea class="form-control" rows="1" id="sugestao_resposta" name="sugestao_resposta"  maxlength="2000" required>Sem texto</textarea>	<br>
				</div>
				<div class="col-md-4">
				<label class="control-label" for="comment"><b>Selecione o tipo de sugestão:</b></label>
					<select class="form-control" id="tipo_sugestao" name="tipo_sugestao" required/>
						<option value="">Selecione o tipo de sugestão</option>
						<option value="Português">Português</option>
						<option value="Word">Word</option>
						<option value="Excel">Excel</option>
						<option value="Power Point">Power Point</option>
						<option value="Legislação">Legislação</option>
						<option value="Softwares de uso do órgão">Softwares de uso do órgão</option>
						<option value="Outros">Outros</option>
					</select>
				</div>
				<div class="col-md-2">
					<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar' onclick="play()";>Sugerir &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
				</div>
			</div>
		</form>	
	</div>
</div>