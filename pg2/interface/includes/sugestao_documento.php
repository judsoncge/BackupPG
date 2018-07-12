<div class='row' style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: white; margin: 5px;'>
		<form name='teste' method='POST' action='../componentes/documento/logica/editar.php?operacao=sugerir&documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>' enctype='multipart/form-data'>
			<div class='row'>
				<div class="col-md-6">
					<label class="control-label" for="comment"><b>Sugestão para texto (max. 2000 caract):</b></label>
						<textarea class="form-control" rows="8" id="sugestao_resposta" name="sugestao_resposta"  maxlength="2000" required>Sem texto</textarea>	<br>
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