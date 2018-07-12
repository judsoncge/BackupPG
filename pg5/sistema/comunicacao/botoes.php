<div class="row linha-modal-processo">
							
	<?php if($informacoes["NM_STATUS"] == 'OCULTADA'){ ?>					
		<a href="logica/editar.php?operacao=status&id=<?php echo $id?>&status=PUBLICADA"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Publicar</button></a>
		
		<a href="logica/editar.php?operacao=status&id=<?php echo $id?>&status=INATIVA"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Inativar</button></a>

	
	<?php } 

	if($informacoes["NM_STATUS"] == 'PUBLICADA'){ ?>					
		<a href="logica/editar.php?operacao=status&id=<?php echo $id?>&status=OCULTADA"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Ocultar</button></a>
	<?php } ?>	

	<a onclick="return confirm('Tem certeza que deseja apagar este registro?')" href="logica/excluir.php?id=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-dar-saida'>Excluir</button></a>
		
	<a href="editar.php?id=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-dar-saida'>Editar</button></a>
	
							
</div>