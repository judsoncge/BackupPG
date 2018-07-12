<div class='row linha-modal-processo'>
	<label class="control-label" for="exampleInputEmail1" style="margin-left:17px;"><b>Documentos do processo</b>:</label><br>
	<?php $lista4 = retorna_documentos_processo($informacoes['CD_PROCESSO'], $conexao_com_banco); 
	$contador = 0;
	while($r4 = mysqli_fetch_object($lista4)){ 
		$contador = $contador+1; ?>
		<div class='col-md-4'>
			<h5>
				<b><a href='../documentos/detalhes.php?documento=<?php echo $r4->CD_DOCUMENTO?>'>
					<i class='fa fa-file-pdf-o' aria-hidden='true'></i>
					<?php echo "  " . $contador . " - " . $r4->NM_DOCUMENTO ?></b></a>
				
		</div>
	<?php } ?>
</div>