<div class="row linha-modal-processo">
	
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'AUTORIZAR_EMPENHO',$conexao_com_banco); if($permissao=='sim'){ ?>
		<?php if($status=='Solicitado'){ ?>
				<a href="../componentes/despesa/logica/editar.php?sessionId=<?php echo $num ?>&operacao=status&status=Empenho autorizado&despesa=<?php echo $id ?>&mes=<?php echo $mes_despesa ?>&ano=<?php echo $ano_despesa ?>&valor=<?php echo $valor_despesa ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Autorizar empenho</button></a>
				<a href="../componentes/despesa/logica/editar.php?sessionId=<?php echo $num ?>&operacao=status&status=Recusado&despesa=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Recusar</button></a>
		<?php } ?>	
	<?php } ?>	
	
	
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'EMPENHAR_DESPESA',$conexao_com_banco); if($permissao=='sim'){ ?>
		<?php if($status=='Empenho autorizado'){ ?>
				<a href="../componentes/despesa/logica/editar.php?sessionId=<?php echo $num ?>&operacao=status&status=Empenhado&despesa=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Empenhar</button></a>
		<?php } ?>	
	<?php } ?>

	
	
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'AUTORIZAR_PAGAMENTO',$conexao_com_banco); if($permissao=='sim'){ ?>
		<?php if($status=='Empenhado'){ ?>
				<a href="../componentes/despesa/logica/editar.php?sessionId=<?php echo $num ?>&operacao=status&status=Pagamento autorizado&despesa=<?php echo $id ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Autorizar pagamento</button></a>
		<?php } ?>	
	<?php } ?>	

	
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'PAGAR_DESPESA',$conexao_com_banco); if($permissao=='sim'){ ?>
		<?php if($status=='Pagamento autorizado'){ ?>
				<a href="../componentes/despesa/logica/editar.php?sessionId=<?php echo $num ?>&operacao=pagar&valor=<?php echo $valor_despesa ?>&despesa=<?php echo $id ?>&mes=<?php echo $mes_despesa ?>&ano=<?php echo $ano_despesa ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Pagar</button></a>
		<?php } ?>	
	<?php } ?>	
	
</div>