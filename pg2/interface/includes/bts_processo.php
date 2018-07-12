<div class="row linha-modal-processo">
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'FINALIZAR_PROCESSO',$conexao_com_banco); if(($situacao=='Concluído' or $situacao=='Concluído com atraso') and ($situacao_final!='Finalizado' and $situacao_final!='Finalizado com atraso') and $permissao=='sim'){ ?>
			<a href="../componentes/processo/logica/editar.php?sessionId=<?php echo $num ?>&operacao=finalizar&processo=<?php echo $numero_processo ?>&anterior=<?php echo $situacao_final ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Finalizar processo&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a>
	<?php } ?>	
	
	<?php 
	$existe_compra = retorna_existe_compra_processo($numero_processo, $conexao_com_banco);
	
	if($existe_compra == null){
		$permissao = retorna_permissao($_SESSION['CPF'],'CONCLUIR_PROCESSO',$conexao_com_banco); if(($situacao=='Análise em andamento' or $situacao=='Análise em atraso') and $permissao=='sim'){ ?>
			<a href="../componentes/processo/logica/editar.php?sessionId=<?php echo $num ?>&operacao=concluir&processo=<?php echo $numero_processo ?>&anterior=<?php echo $situacao ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Concluir processo&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a> 
	<?php }
	}else if($existe_compra != null and $existe_compra == "Paga" or $existe_compra == "Paga com atraso"){
		$permissao = retorna_permissao($_SESSION['CPF'],'CONCLUIR_PROCESSO',$conexao_com_banco); if(($situacao=='Análise em andamento' or $situacao=='Análise em atraso') and $permissao=='sim'){ ?>
			<a href="../componentes/processo/logica/editar.php?sessionId=<?php echo $num ?>&operacao=concluir&processo=<?php echo $numero_processo ?>&anterior=<?php echo $situacao ?>"><button type='submit' class='btn btn-sm btn-info pull-left' name='submit' value='Send' id='botao-dar-saida'>Concluir processo&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar-check-o" aria-hidden="true"></i></button></a> 
	<?php }
	} ?>	

	
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'ARQUIVAR_PROCESSO',$conexao_com_banco); if(($situacao=='Concluído' or $situacao=='Concluído com atraso' or $situacao_final=='Finalizado' and $situacao_final=='Finalizado com atraso') and $permissao=='sim'){ ?>	
			<a href="../componentes/processo/logica/editar.php?sessionId=<?php echo $num ?>&operacao=arquivar&processo=<?php echo $numero_processo ?>&situacao_final=<?php echo $situacao_final ?>&pagina=<?php echo $_GET['pagina']?>"><button type='submit' class='btn btn-sm btn-warning pull-left' name='submit' value='Send' id='botao-arquivar'>Arquivar processo&nbsp;&nbsp;<i class="fa fa-folder" aria-hidden="true"></i></button></a>
	<?php } ?>	
		
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'SAIDA_PROCESSO',$conexao_com_banco); if(($situacao_final=='Finalizado' or $situacao_final=='Finalizado com atraso') and $permissao=='sim'){ ?>		
			<a href="../componentes/processo/logica/editar.php?sessionId=<?php echo $num ?>&operacao=sair&processo=<?php echo $numero_processo ?>&pagina=<?php echo $_GET['pagina']?>"><button type='submit' class='btn btn-sm btn-success pull-left' name='submit' value='Send' id='botao-dar-saida'>Dar saída no processo&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>			
	<?php } ?>	
	
	<?php $permissao = retorna_permissao($_SESSION['CPF'],'PARECER_PROCESSO',$conexao_com_banco); if($status != 'Arquivado' and $status != 'Saiu' and $permissao=='sim'){ ?>		
			<a href="cadastro-documento.php?sessionId=<?php echo $num ?>&processo=<?php echo $numero_processo ?>&tipo=Parecer&prazo=<?php echo $prazo ?>&entrada=<?php echo $data_entrada ?>&descricao=<?php echo $descricao ?>&interessado=<?php echo $interessado ?>&detalhes=<?php echo $detalhes ?>"><button class='btn btn-sm btn-info pull-right' id='botao-dar-saida' style="margin-right:10px;"><i class="fa fa-plus-circle"></i> Parecer</button></a>
	<?php } ?>

	<?php $permissao = retorna_permissao($_SESSION['CPF'],'DESPACHO_PROCESSO',$conexao_com_banco); if($status != 'Arquivado' and $status != 'Saiu' and $permissao=='sim'){ ?>		
			<a href="cadastro-documento.php?sessionId=<?php echo $num ?>&processo=<?php echo $numero_processo ?>&tipo=Despacho&prazo=<?php echo $prazo ?>&entrada=<?php echo $data_entrada ?>&descricao=<?php echo $descricao ?>&interessado=<?php echo $interessado ?>&detalhes=<?php echo $detalhes ?>"><button class='btn btn-sm btn-info pull-right' id='botao-dar-saida' style="margin-right:10px;"><i class="fa fa-plus-circle"></i> Despacho</button></a>
	<?php } ?>		
</div>