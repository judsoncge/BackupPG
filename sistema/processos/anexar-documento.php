<div class='row linha-modal-processo'>
	<form method='POST' action='logica/editar.php?operacao=anexar&id=<?php echo $id ?>' enctype='multipart/form-data'>	
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label" for="exampleInputEmail1"><b>Anexar documento</b></label>
				<select class="form-control" id="tipo" name="tipo" required/>
					<option value="">Selecione o tipo de arquivo</option>
						<option value="APRESENTAÇÃO">APRESENTAÇÃO</option>
						<option value="AQUISIÇÃO">AQUISIÇÃO</option>
						<option value="CERTIFICADO">CERTIFICADO</option>
						<option value="CHECKLIST">CHECKLIST</option>
						<option value="COTAÇÃO DE PREÇO">COTAÇÃO DE PREÇO</option>
						<option value="CERTIDÃO NEGATIVA">CERTIDÃO NEGATIVA</option>
						<option value="DESPACHO">DESPACHO</option>
						<option value="MEMORANDO">MEMORANDO</option>
						<option value="OFÍCIO">OFÍCIO</option>
						<option value="PARECER">PARECER</option>
						<option value="PUBLICAÇÃO NO DIÁRIO">PUBLICAÇÃO NO DIÁRIO</option>
						<option value="RELATÓRIO">RELATÓRIO</option>
						<option value="RESPOSTA AO INTERESSADO">RESPOSTA AO INTERESSADO</option>
						<option value="TERMO DE REFERÊNCIA">TERMO DE REFERÊNCIA</option>
				</select>	
			</div>  
		</div>
		<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Enviar anexo</label><br>
						<input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/>
					</div>
				</div>	
		<div class="col-md-2">
			<br>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Anexar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right"  aria-hidden="true"></i></button>
		</div>
	</form>	
</div>