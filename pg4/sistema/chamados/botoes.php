<div class="row linha-modal-processo">
	<?php if($informacoes['NM_STATUS'] =='Aberto' and $_SESSION['permissao-fechar-chamado'] == 'sim'){ ?>
			<a href="logica/editar.php?operacao=resolver&chamado=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Fechar chamado&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	<?php } ?>	
	
	<?php if($informacoes['NM_STATUS']=='Resolvido' and $_SESSION['permissao-encerrar-chamado'] == 'sim' and $informacoes['NM_NOTA'] != "Sem nota"){ ?>
			<a href="logica/editar.php?operacao=encerrar&chamado=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Encerrar chamado&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	<?php } ?>
</div> 