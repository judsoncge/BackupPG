<div class="row linha-modal-processo">
	
	<?php if($_SESSION['permissao-autorizar-empenho']=='sim' and $informacoes['NM_STATUS'] =='Solicitado'){ ?>
				<a href="logica/editar.php?operacao=status&status=Empenho autorizado&despesa=<?php echo $informacoes['ID_DESPESA'] ?>&mes=<?php echo $informacoes['NR_MES'] ?>&ano=<?php echo $informacoes['NR_ANO'] ?>&valor=<?php echo $informacoes['VLR_DESPESA'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Autorizar empenho</button></a>
				
				<a href="logica/editar.php?&operacao=status&status=Recusado&despesa=<?php echo $informacoes['ID_DESPESA'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Recusar solicitação</button></a>
	<?php } ?>	
	
	
	<?php if($_SESSION['permissao-empenhar-despesa']=='sim' and $informacoes['NM_STATUS'] == 'Empenho autorizado'){ ?>	
				<a href="logica/editar.php?&operacao=status&status=Empenhado&despesa=<?php echo $informacoes['ID_DESPESA']  ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Empenhar</button></a>	
	<?php } ?>

	<?php if($_SESSION['permissao-autorizar-pagamento']=='sim' and $informacoes['NM_STATUS'] == 'Empenhado'){ ?>
				<a href="logica/editar.php?operacao=status&status=Pagamento autorizado&despesa=<?php echo $informacoes['ID_DESPESA'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Autorizar pagamento</button></a>	
	<?php } ?>	

	
	<?php if($_SESSION['permissao-pagar-despesa']=='sim' and $informacoes['NM_STATUS']=='Pagamento autorizado'){ ?>
				<a href="logica/editar.php?operacao=pagar&valor=<?php echo $informacoes['VLR_DESPESA'] ?>&despesa=<?php echo $informacoes['ID_DESPESA'] ?>&mes=<?php echo $informacoes['NR_MES'] ?>&ano=<?php echo $informacoes['NR_ANO'] ?>&vencimento=<?php echo $informacoes['DT_VENCIMENTO'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Pagar</button></a>	
	<?php } ?>	
	
</div>