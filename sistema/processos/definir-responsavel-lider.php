<form name='teste' method='POST' action='logica/editar.php?operacao=lider&id=<?php echo $informacoes['ID'] ?>' enctype='multipart/form-data'>
	<div class="row linha-modal-processo">
		<div class="col-md-10">
			<label class="control-label" for="exampleInputEmail1"><b>Defina o responsável líder</b>:</label><br>
			<select class="form-control" id="lider" name="lider" required />
				
				<option value="">Líder atual: <?php echo retorna_nome_servidor($responsavel_lider, $conexao_com_banco) ?></option>
				<?php 
				
				$lista2 = retorna_lista_nao_lideres_processo($id, $conexao_com_banco);
				while($r2 = mysqli_fetch_object($lista2)){ 
				
				?>	
				<option value="<?php echo $r2->ID_SERVIDOR ?>"><?php echo $r2->NM_SERVIDOR; ?></option>
					
				<?php } ?>
			</select>
			
		</div>
		<div class='col-md-2'>
			<br>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Definir &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
		</div>
	</div>
</form>