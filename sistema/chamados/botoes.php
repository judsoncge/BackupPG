<div class="row linha-modal-processo">

	<?php if($informacoes['NM_STATUS'] =='ABERTO' and $_SESSION['funcao']=='TI'){ ?>
	
			<a href="logica/editar.php?operacao=resolver&id=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Resolver chamado&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	
	<?php } 	
	
	if($informacoes['NM_STATUS']=='RESOLVIDO' and $_SESSION['funcao']=='TI' and $informacoes['NM_AVALIACAO'] != "SEM AVALIAÇÃO"){ ?>
	
			<a href="logica/editar.php?operacao=encerrar&id=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Encerrar chamado&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	<?php } 
	
	if($_SESSION['funcao'] == 'TI' and $informacoes['NM_STATUS']=='ABERTO'){ ?>
			
			<a href="logica/excluir.php?id=<?php echo $id ?>"><button type='submit' onclick="return confirm('Você tem certeza que deseja apagar este processo?');" class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Excluir&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button></a>
		
	<?php } ?>
	
</div> 