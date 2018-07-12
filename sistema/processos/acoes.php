<div class="row linha-modal-processo">
	
	<?php //fluxo normal: em andamento -> finalizado pelo setor -> finalizado pelo gabinete -> arquivar ou sair (fechamento)]

	//botao para finalizar o processo em nome do setor 
	if($ativo and $informacoes["NM_STATUS"]=="EM ANDAMENTO" and 	
	(($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' and $_SESSION['setor'] == $informacoes["ID_SETOR_LOCALIZACAO"]) or $_SESSION['funcao'] == 'TI' or $_SESSION['funcao'] == 'COMUNICAÇÃO' or $_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'CHEFE DE GABINETE')){
	?>
	
		<a href="logica/editar.php?operacao=finalizar_setor&id=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar em nome do setor&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	
	<?php	
	}
	?>
	
	
	<?php //botao para finalizar o processo em nome do gabinete	
	if($ativo and $informacoes["NM_STATUS"]=="FINALIZADO PELO SETOR" and ($_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'CHEFE DE GABINETE' or $_SESSION['funcao'] == 'TI')){
	?>
		
		<a href="logica/editar.php?operacao=finalizar_gabinete&id=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar em nome do gabinete&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	
	<?php	
	}
	?>	
		
	
	<?php //botao para desfazer a finalização do setor		
	if($ativo and ($informacoes["NM_STATUS"]== "FINALIZADO PELO SETOR") and (($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' and $_SESSION['setor'] == $informacoes["ID_SETOR_LOCALIZACAO"]) or $_SESSION['funcao'] == 'TI')){
	?>
	
		<a href="logica/editar.php?operacao=desfazer_finalizacao&id=<?php echo $id ?>&status=EM ANDAMENTO"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Desfazer finalização do setor&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
	
	<?php	
	}
	?>		
		
	
	<?php //botao para desfazer a finalização do gabinete	
	if($ativo and $informacoes["NM_STATUS"]=="FINALIZADO PELO GABINETE" and 
	(($_SESSION['funcao'] == 'GABINETE') or $_SESSION['funcao'] == 'TI')){
	?>
	
		<a href="logica/editar.php?operacao=desfazer_finalizacao&id=<?php echo $id ?>&status=FINALIZADO PELO SETOR"><button type='submit' class='btn btn-sm btn-success pull-left'name='submit' value='Send' id='botao-dar-saida'>Desfazer finalização do gabinete&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
	
	<?php	
	}
	?>	
	
	<?php //botao para arquivar	processo
	if($ativo and ($informacoes["NM_STATUS"]=="FINALIZADO PELO SETOR" or $informacoes["NM_STATUS"]=="FINALIZADO PELO GABINETE") and ($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'GABINETE'  or $_SESSION['funcao'] == 'CHEFE DE GABINETE' or $_SESSION['funcao'] == 'COMUNICAÇÃO' or $_SESSION['funcao'] == 'TI')){
	?>
			
		<a href="logica/editar.php?operacao=arquivar&id=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-warning pull-left' name='submit' value='Send' id='botao-arquivar'>Arquivar&nbsp;&nbsp;<i class="fa fa-folder" aria-hidden="true"></i></button></a>
	
	<?php	
	}
	?>	
	
	<?php //botao para sair processo		
	if($ativo and $informacoes['NM_STATUS'] == 'FINALIZADO PELO GABINETE' and ($_SESSION['funcao'] == 'PROTOCOLO' or $_SESSION['funcao'] == 'TI')){
	?>
			
		<a href="logica/editar.php?operacao=sair&id=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Dar saída&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
	
	<?php	
	}
	?>	

		
</div>