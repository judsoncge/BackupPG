<?php 
if($informacoes['CD_SERVIDOR_RESPONSAVEL_LIDER']=='' and ($informacoes['NM_STATUS']=='Em andamento' or $informacoes['NM_STATUS']=='Atrasado')){ ?>
<div class="row linha-modal-processo">
	<form method='POST' action='logica/editar.php?operacao=lider&processo=<?php echo $informacoes['CD_PROCESSO'] ?>' enctype='multipart/form-data'>	
		<div class="col-md-10">
				<label class="control-label" for="exampleInputEmail1"><b>Defina o líder do processo</b></label>
				<select class="form-control" id="lider" name="lider" required/>
					<option value="">Selecione o servidor</option>
					<?php while($l = mysqli_fetch_object($responsaveis_processo)){ ?>
					<option value="<?php echo $l->CD_SERVIDOR ?>"><?php echo retorna_nome_servidor($l->CD_SERVIDOR, $conexao_com_banco) ?></option><?php } ?>
				</select>
		</div>
		<div class='col-md-2'>
			<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Definir &nbsp;&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
		</div>
	</form>
</div>
<?php } ?>


