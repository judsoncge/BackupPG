<div class="row linha-modal-processo">
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'FECHAR_CHAMADO',$conexao_com_banco); if($status=='Aberto' and $permissao='sim'){ ?>
			<a href="../componentes/chamado/logica/editar.php?sessionId=<?php echo $num ?>&operacao=resolver&chamado=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Fechar chamado&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	<?php } ?>	
	
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'ENCERRAR_CHAMADO',$conexao_com_banco); if($status=='Resolvido' and $permissao='sim' and $nota!="Sem nota"){ ?>
			<a href="../componentes/chamado/logica/editar.php?sessionId=<?php echo $num ?>&operacao=encerrar&chamado=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Encerrar chamado&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	<?php } ?>
</div> 