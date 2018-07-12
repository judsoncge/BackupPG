<script type="text/javascript">
	$('#responsaveis').multipleSelect();
</script>

<div class='row linha-modal-processo'>
	<form method='POST' action='logica/editar.php?operacao=responsaveis&processo=<?php echo $informacoes['CD_PROCESSO'] ?>' enctype='multipart/form-data'>	
		<div class="col-md-10">
			<label class="control-label" for="exampleInputEmail1"><b>Defina os responsáveis</b>:</label><br>
			<select multiple id="responsaveis" name="responsaveis[]" style="width: 96%;" required>
				<?php $lista3 = retorna_podem_ser_responsaveis_processo($informacoes['CD_PROCESSO'], $conexao_com_banco);
				while($r3 = mysqli_fetch_object($lista3)){ ?>
				<option value="<?php echo $r3->CD_SERVIDOR?>"><?php echo "  " . $r3->NM_SERVIDOR . " " . $r3->SNM_SERVIDOR ?></option><?php } ?>
			</select>
		</div>
		<div class="col-md-2">
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Definir &nbsp;&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
		</div>
	</form>	
</div>

