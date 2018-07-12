<div class="row linha-modal-processo">

	<?php	
	if($ativo and !$informacoes["BL_SOBRESTADO"] and ($_SESSION['funcao'] == 'CHEFE DE GABINETE' or $_SESSION['funcao'] == 'TI')){
	?>
	
		<a href="logica/editar.php?operacao=sobrestado&id=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Marcar sobrestado&nbsp;&nbsp;&nbsp;<i class="fa fa-warning" aria-hidden="true"></i></button></a>
	
	<?php	
	}
	?>
	
	<?php	
	if($ativo and $informacoes["BL_SOBRESTADO"] and ($_SESSION['funcao'] == 'CHEFE DE GABINETE' or $_SESSION['funcao'] == 'TI')){
	?>
	
		<a href="logica/editar.php?operacao=desmarcar_sobrestado&id=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Desmarcar sobrestado&nbsp;&nbsp;&nbsp;<i class="fa fa-warning" aria-hidden="true"></i></button></a>
	
	<?php	
	}
	?>

	<?php	
	if($ativo and !$informacoes["BL_URGENCIA"] and ($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'TI')){
	?>
	
		<a href="logica/editar.php?operacao=urgencia&id=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-urgencia'>Marcar como urgente&nbsp;&nbsp;&nbsp;<i class="fa fa-warning" aria-hidden="true"></i></button></a>
	
	<?php	
	}
	?>
	
	<?php	
	if($ativo and $informacoes["BL_URGENCIA"] and ($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'TI')){
	?>
	
		<a href="logica/editar.php?operacao=desmarcar_urgencia&id=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-urgencia'>Desmarcar urgência&nbsp;&nbsp;&nbsp;<i class="fa fa-warning" aria-hidden="true"></i></button></a>
	
	<?php	
	}
	?>
	
	
	<?php	
	if($ativo){
		if($_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'PROTOCOLO' or $_SESSION['funcao'] == 'TI'){ ?>
		
			<a href="editar.php?id=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Editar&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i></button></a>
	
			
			<a href="logica/excluir.php?id=<?php echo $id ?>"><button type='submit' onclick="return confirm('Você tem certeza que deseja apagar este processo?');" class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Excluir&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button></a>
		
		<?php } 
	} ?>

		
</div>