<script type="text/javascript">
	window.onload = function(){
		$('#apensos').multipleSelect();
		
	}
</script>
<div class='row linha-modal-processo'>
	<form method='POST' action='logica/editar.php?operacao=apensar&id=<?php echo $id ?>' enctype='multipart/form-data'>	
		<div class="col-md-10">
			<label class="control-label" for="exampleInputEmail1"><b>Defina os Apensos</b>:</label><br>
			<select multiple id="apensos" name="apensos[]" style="width: 96%;" required>
				<?php $lista3 = retorna_processos_apensar($id, $conexao_com_banco);
				while($r3 = mysqli_fetch_object($lista3)){ ?>
				<option value="<?php echo $r3->ID ?>"><?php echo $r3->CD_PROCESSO ?></option><?php } ?>
			</select>
		</div>
		<div class="col-md-2">
			<br>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Apensar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right"  aria-hidden="true"></i></button>
		</div>
	</form>	
</div>