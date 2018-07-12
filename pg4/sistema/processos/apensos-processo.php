<div class='row linha-modal-processo'>
	<label class="control-label" for="exampleInputEmail1" style="margin-left:17px;"><b>Apensos do processo</b>:</label><br>
	<?php $lista4 = retorna_apensos_processo($informacoes['CD_PROCESSO'], $conexao_com_banco); 
	$contador = 0;
	while($r4 = mysqli_fetch_object($lista4)){ 
		$contador = $contador+1; ?>
		<div class='col-md-4'>
			<h5><b><a href='detalhes.php?processo=<?php echo $r4->CD_PROCESSO?>&pagina=<?php echo $pagina ?>'><?php echo $r4->CD_PROCESSO?></a></b></h5>
		</div>
	<?php } ?>
</div>