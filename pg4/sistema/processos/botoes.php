<div class="row linha-modal-processo">
		
		<?php if(($informacoes['NM_STATUS']=='Em andamento' or $informacoes['NM_STATUS']=='Atrasado') and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-finalizar-processo']=='sim' and $informacoes['CD_SERVIDOR_RESPONSAVEL_LIDER']!=''){ ?>
				<a href="logica/editar.php?operacao=finalizar&operacao2=setor&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&anterior=<?php echo $informacoes['NM_STATUS'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar em nome do setor&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
		<?php } ?>

		<?php if($informacoes['NM_STATUS']=='Finalizado pelo setor' and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-finalizar-gabinete-processo']=='sim'){ ?>
				<a href="logica/editar.php?operacao=finalizar&operacao2=gabinete&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&anterior=<?php echo $informacoes['NM_STATUS'] ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar em nome do gabinete&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
		<?php } ?>			
		
		<?php if($informacoes['NM_STATUS']=='Finalizado pelo setor' and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-desfazer-finalizacao-processo']=='sim'){ ?>
			<a href="logica/editar.php?operacao=desfazer_finalizacao&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo=<?php echo $informacoes['DT_PRAZO'] ?>&status=Finalizado pelo setor"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Desfazer finalização do setor&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
		<?php } ?>	
		
		<?php if($informacoes['NM_STATUS']=='Finalizado pelo gabinete' and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-desfazer-finalizacao-gabinete-processo']=='sim'){ ?>
			<a href="logica/editar.php?operacao=desfazer_finalizacao&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo=<?php echo $informacoes['DT_PRAZO'] ?>&status=Finalizado pelo gabinete"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Desfazer finalização do gabinete&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
		<?php } ?>
		
		<?php 
		$pode_gerar_despesa = retorna_pode_gerar_despesa($informacoes['CD_PROCESSO'], $conexao_com_banco);
		if($pode_gerar_despesa==true and $_SESSION['permissao-efetuar-compra']=='sim'){ ?>
			<a href='../despesas/cadastrar.php?processo=<?php echo $informacoes['CD_PROCESSO'] ?>'><button type='submit' class='btn btn-sm btn-info pull-right' style="margin-right:10px;">Gerar Despesa</button></a>
		<?php } ?>

		<?php if(($informacoes['NM_STATUS']=='Finalizado pelo setor' or $informacoes['NM_STATUS']=='Finalizado pelo gabinete') and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-arquivar-processo']=='sim'){ ?>	
				<a href="logica/editar.php?operacao=arquivar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&pagina=<?php echo $pagina ?>"><button type='submit' class='btn btn-sm btn-warning pull-left' name='submit' value='Send' id='botao-arquivar'>Arquivar&nbsp;&nbsp;<i class="fa fa-folder" aria-hidden="true"></i></button></a>
		<?php } ?>	
		
		<?php if($informacoes['NM_STATUS']=='Finalizado pelo gabinete' and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-sair-processo']=='sim'){ ?>	
				
				<a href="logica/editar.php?operacao=sair&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&pagina=<?php echo $pagina ?>"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Dar saída&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
				
		<?php } ?>	
		
		<?php if($informacoes['CD_PROCESSO_APENSADO'] == '' and $informacoes['NM_STATUS'] != 'Arquivado' and $informacoes['NM_STATUS'] != 'Saiu'){	?>	
			<a href="../documentos/cadastrar.php?processo=<?php echo $informacoes['CD_PROCESSO'] ?>"><button class='btn btn-sm btn-info' id='botao-dar-saida' style="margin-right:10px;"><i class="fa fa-plus-circle"></i> Documento</button></a>
		<?php } ?>
		
		<?php if($informacoes['CD_PROCESSO_APENSADO'] == '' and $informacoes['NM_STATUS'] != 'Arquivado' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['CD_SERVIDOR_LOCALIZACAO'] == $_SESSION['CPF']){	?>	
			<a href="logica/editar.php?operacao=auto_tramite&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&lider=<?php echo $informacoes['CD_SERVIDOR_RESPONSAVEL_LIDER'] ?>&pagina=<?php echo $pagina ?>">
				<button type='button' title="Tramitar automático" class='btn btn-sm btn-info pull-right'>
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Auto tramitar
				</button>
			</a>
		<?php } ?>
</div>
