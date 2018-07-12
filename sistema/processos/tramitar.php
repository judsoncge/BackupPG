<form name='teste' method='POST' action='logica/editar.php?operacao=tramitar&id=<?php echo $informacoes['ID'] ?>' enctype='multipart/form-data'>	
	<div class="row linha-modal-processo">
		<div class="col-md-10">
			<select class="form-control" id="tramitar" name="tramitar" required/>
				<option value="">Selecione o servidor para tramitar</option>
				
				<?php $lista2 = retorna_servidores_tramitar($conexao_com_banco);
				
				while($r2 = mysqli_fetch_object($lista2)){ ?>
				
					<option value="<?php echo $r2->ID ?>"><?php echo $r2->NM_SERVIDOR; ?></option>
					
				<?php } ?>
			</select>
		</div>
		
		<div class='col-md-2'>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Tramitar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
		</div>
		
	</div>
</form>