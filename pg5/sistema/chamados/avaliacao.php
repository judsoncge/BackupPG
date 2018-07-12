<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
	<form name="cadastro" method="POST" action="logica/editar.php?operacao=avaliacao&id=<?php echo $id ?>" enctype="multipart/form-data">
		<div class="col-md-10">
			<select class="form-control" id="avaliacao" name="avaliacao" required/>
				<option value="">Avalie o atendimento     </option>
				<option value="PÉSSIMO">PÉSSIMO           </option>
				<option value="RUIM">RUIM                 </option>
				<option value="REGULAR">REGULAR           </option>
				<option value="BOM">BOM                   </option>
				<option value="EXCELENTE">EXCELENTE       </option>
			</select>
		</div>
		<div class='col-md-2'>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Avaliar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
		</div>
	</form>				
</div>