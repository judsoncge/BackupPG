<div class="row linha-modal-processo">
	<div class="col-md-12">
			<?php if($_SESSION['permissao-aprovar-documento']=='sim'){ 
				if($informacoes['NM_STATUS']=='Em análise') { ?>
						<a href='logica/editar.php?operacao=status&status=Aprovado&mensagem=APROVOU O DOCUMENTO&acao=Aprovação&documento=<?php echo $id ?>'>
							<button type='submit' class='btn btn-sm btn-info pull-left' style="margin-right:10px;">Aprovar</button>
						</a>
					<?php } else if($informacoes['NM_STATUS']=='Aprovado'){ ?>
						<a href='logica/editar.php?operacao=status&status=Em análise&mensagem=DESFEZ A APROVAÇÃO&acao=Desaprovação&documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>'><button type='submit' class='btn btn-sm btn-info pull-left' style="margin-right:10px;">Desfazer aprovação</button>
						</a>
					<?php }
				} ?>
				
			<?php if($informacoes["NM_STATUS"]=='Aprovado'){ ?>
					<a href='pdf.php?tipo_atividade=<?php echo $informacoes['ID_ASSUNTO'] ?>&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&tipo=<?php echo $informacoes['NM_DOCUMENTO'] ?>&resposta=<?php echo $informacoes['TX_DOCUMENTO'] ?>&interessado=<?php echo $informacoes['NM_INTERESSADO'] ?>' target="_blank"><button type='submit' class='btn btn-sm btn-info pull-left' style="margin-right:10px;">Gerar PDF</button></a>
			<?php } ?>
	
			<?php if($informacoes["NM_STATUS"]=='Aprovado' and $_SESSION['permissao-resolver-documento']=='sim'){ ?>
					<a href='logica/editar.php?operacao=resolver&documento=<?php echo $id ?>&pagina=<?php echo $pagina ?>'><button type='submit' class='btn btn-sm btn-info pull-left' >Resolver</button></a>
			<?php } ?>
			
			<?php if($informacoes["NM_DOCUMENTO"]=='Memorando' and $informacoes["CD_PROCESSO"]=='' and $_SESSION['permissao-abrir-processo']=='sim'){ ?>
					<a href='../processos/cadastrar.php?documento=<?php echo $id ?>&assunto=<?php echo $informacoes["ID_ASSUNTO"] ?>&detalhes=<?php echo $informacoes["DS_DOCUMENTO"] ?>&interessado=<?php echo $informacoes["NM_INTERESSADO"] ?>&pagina=geral'><button type='submit' class='btn btn-sm btn-info pull-right' >Abrir um processo</button></a>
			<?php } ?>	
			
			
	</div>
</div>