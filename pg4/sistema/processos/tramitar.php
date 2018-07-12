<form name='teste' method='POST' action='logica/editar.php?operacao=tramitar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo=<?php echo $informacoes['DT_PRAZO'] ?>&lider=<?php echo $informacoes['CD_SERVIDOR_RESPONSAVEL_LIDER'] ?>&pagina=<?php echo $_GET['pagina'] ?>' enctype='multipart/form-data'>	
	<div class="row linha-modal-processo">
		<div class="col-md-10">
			<label class="control-label" for="exampleInputEmail1"><b>Tramitar o PROCESSO para</b></label>
			<select class="form-control" id="tramitar" name="tramitar" required/>
				<option value="">Selecione o servidor</option>
				<?php $lista2 = retorna_servidores_tramitar($conexao_com_banco);
				while($r2 = mysqli_fetch_object($lista2)){
								
				 ?>	
					<option value="<?php echo $r2->CD_SERVIDOR . "//" . $r2->NM_SERVIDOR . " " . $r2->SNM_SERVIDOR ?>"><?php echo $r2->NM_SERVIDOR  . " " . $r2->SNM_SERVIDOR ?></option>
					
				<?php } ?>
			</select>
		</div>
		<div class='col-md-2'>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Tramitar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
		</div>
	</div>
</form>