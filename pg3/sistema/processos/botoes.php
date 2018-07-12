<div class="row linha-modal-processo">
		
		<?php if(($informacoes['NM_SITUACAO']=='Concluído' or $informacoes['NM_SITUACAO']=='Concluído com atraso') and ($informacoes['NM_SITUACAO_FINAL']!='Finalizado' and $informacoes['NM_SITUACAO_FINAL']!='Finalizado com atraso') and $_SESSION['permissao-finalizar-processo']=='sim'){ ?>
				<a href="logica/editar.php?operacao=finalizar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&anterior=<?php echo $informacoes['NM_SITUACAO_FINAL'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar processo&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
		<?php } ?>	
		
		<?php if(($informacoes['NM_SITUACAO']=='Análise em andamento' or $informacoes['NM_SITUACAO']=='Análise em atraso') and $_SESSION['permissao-concluir-processo']=='sim'){ ?>
				<a href="logica/editar.php?operacao=concluir&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&anterior=<?php echo $informacoes['NM_SITUACAO'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Concluir processo&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a> 
		<?php } ?>	

		
		<?php 
		$pode_gerar_despesa = retorna_pode_gerar_despesa($informacoes['CD_PROCESSO'], $conexao_com_banco);
		if($pode_gerar_despesa==true and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
			<a href='../despesas/cadastrar.php?processo=<?php echo $informacoes['CD_PROCESSO'] ?>'><button type='submit' class='btn btn-sm btn-info pull-right' style="margin-right:10px;">Gerar Despesa</button></a>
		<?php } ?>
		
		<?php if(($informacoes['NM_SITUACAO_FINAL']=='Finalizado' or $informacoes['NM_SITUACAO_FINAL']=='Finalizado com atraso') and $_SESSION['permissao-finalizar-processo']=='sim'){ ?>
			<a href="logica/editar.php?operacao=desfazer_finalizacao&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo_final=<?php echo $informacoes['DT_PRAZO_FINAL'] ?>"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Desfazer finalização&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
		<?php } ?>	

		<?php if(($informacoes['NM_SITUACAO']=='Concluído' or $informacoes['NM_SITUACAO']=='Concluído com atraso' or $informacoes['NM_SITUACAO_FINAL']=='Finalizado' and $informacoes['NM_SITUACAO_FINAL']=='Finalizado com atraso') and $_SESSION['permissao-arquivar-processo']=='sim'){ ?>	
				<a href="logica/editar.php?operacao=arquivar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&situacao_final=<?php echo $informacoes['NM_SITUACAO_FINAL'] ?>"><button type='submit' class='btn btn-sm btn-warning pull-left' name='submit' value='Send' id='botao-arquivar'>Arquivar processo&nbsp;&nbsp;<i class="fa fa-folder" aria-hidden="true"></i></button></a>
		<?php } ?>	
	
			
		<?php if(($informacoes['NM_SITUACAO_FINAL']=='Finalizado' or $informacoes['NM_SITUACAO_FINAL']=='Finalizado com atraso') and $_SESSION['permissao-sair-processo']=='sim'){ ?>	
				
				<a href="logica/editar.php?operacao=sair&processo=<?php echo $informacoes['CD_PROCESSO'] ?>"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Dar saída no processo&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
				
		<?php } ?>	
		
		<?php if($_SESSION['permissao-despacho-processo']=='sim'){ ?>
				<a href="../documentos/cadastrar.php?processo=<?php echo $informacoes['CD_PROCESSO'] ?>&tipo=Despacho"><button class='btn btn-sm btn-info pull-right' id='botao-dar-saida' style="margin-right:10px;"><i class="fa fa-plus-circle"></i> Despacho</button></a>
		<?php } ?>		
		
		<?php if($_SESSION['permissao-parecer-processo']=='sim' and $informacoes['DT_PRAZO']!='0000-00-00' and $informacoes['DT_PRAZO_FINAL']!='0000-00-00'){ ?>		
				<a href="../documentos/cadastrar.php?processo=<?php echo $informacoes['CD_PROCESSO'] ?>&tipo=Parecer"><button class='btn btn-sm btn-info pull-right' id='botao-dar-saida' style="margin-right:10px;"><i class="fa fa-plus-circle"></i> Parecer</button></a>
		<?php } ?>
		
		<?php if($informacoes['DT_PRAZO']!='0000-00-00' and $informacoes['DT_PRAZO_FINAL']!='0000-00-00'){ ?>		
				<a href="../documentos/cadastrar.php?processo=<?php echo $informacoes['CD_PROCESSO'] ?>"><button class='btn btn-sm btn-info pull-right' id='botao-dar-saida' style="margin-right:10px;"><i class="fa fa-plus-circle"></i> Documento</button></a>
		<?php } ?>
		
		<?php if(array_key_exists('permissao-urgencia-processo', $_SESSION) && $_SESSION['permissao-urgencia-processo']=='sim'){ 
				if ($informacoes['URGENTE'] == 1) {?>	
					<a href="logica/editar.php?operacao=urgente&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&valor=0"><button class='btn btn-sm btn-info pull-right btn-danger' id='botao-desmarcar-urgente' style="margin-right:10px;"><i class="fa fa-exclamation-triangle"></i> Desmarcar urgente</button></a>
			<?php	} else {?>	
					<a href="logica/editar.php?operacao=urgente&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&valor=1"><button class='btn btn-sm btn-info pull-right btn-success' id='botao-marcar-urgente' style="margin-right:10px;"><i class="fa fa-exclamation-triangle"></i> Definir urgente</button></a>
			<?php	}				

		 } ?>
	
	</div>