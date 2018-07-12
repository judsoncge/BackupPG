<div class='row linha-modal-processo'>
	<label class="control-label" for="exampleInputEmail1" style="margin-left:17px;"><b>Documentos do processo</b>:</label><br>
	<?php $lista4 = retorna_documentos_processo($numero_processo, $conexao_com_banco); $contador == 0;
	while($r4 = mysqli_fetch_object($lista4)){ 
		//contador de documentos atrelados ao processo
		$contador++; ?>
		<div class='col-md-4'>
			<h5>
				<b><?php echo $contador . " - " . $r4->tipo_documento ?></b>
				<?php 
					//só consegue visualizar o pdf para poder imprimir somente se o documento já estiver sido aprovado
					if($r4->status=='Aprovado' or $r4->status=='Resolvido'){?>
					<a href='pdf-documento.php?tipo_atividade=<?php echo $r4->tipo_atividade?>&processo=<?php echo $r4->Processo_numero?>&descricao=<?php echo $r4 -> descricao_fato?>tipo=<?php echo $r4->tipo_documento?>&resposta=<?php echo $r4->texto_documento?>&interessado=<?php echo $r4->interessado?>' target='_blank'><i class='fa fa-file-pdf-o' aria-hidden='true'></i>Ver pdf</a>
				<?php }else{
					echo "(não aprovado)";
					} ?>
			</h5>
		</div>
	<?php } ?>
</div>