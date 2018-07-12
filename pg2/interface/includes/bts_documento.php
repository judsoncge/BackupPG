<div class="row" style="margin-top: 10px;">
	<div class="col-md-12">
			<?php $permissao = retorna_permissao($_SESSION['CPF'],'APROVAR_DOCUMENTO',$conexao_com_banco);
			 if($permissao=='sim'){ 
				if($status=='Em análise') { ?>
						<a href='../componentes/documento/logica/editar.php?operacao=aprovar&documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>'><button type='submit' class='btn btn-sm btn-info pull-left' style="margin-right:10px;">Aprovar</button></a>
					<?php } else if($status=='Aprovado'){ ?>
						<a href='../componentes/documento/logica/editar.php?operacao=desaprovar&documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>'><button type='submit' class='btn btn-sm btn-info pull-left' style="margin-right:10px;">Desaprovar</button></a>
					<?php }
				} ?>
				
			<?php if($status=='Aprovado'){ ?>
				<a href='pdf-documento.php?tipo_atividade=<?php echo $tipo_atividade ?>&processo=<?php echo $numero_processo ?>&tipo=<?php echo $tipo_documento ?>&resposta=<?php echo $texto_documento ?>&interessado=<?php echo $interessado ?>' target="_blank"><button type='submit' class='btn btn-sm btn-info pull-left' style="margin-right:10px;">Gerar PDF</button></a>
				
			<?php $permissao = retorna_permissao($_SESSION['CPF'],'RESOLVER_DOCUMENTO',$conexao_com_banco); if($permissao=='sim'){ ?>
				<a href='../componentes/documento/logica/editar.php?sessionId=<?php echo $num ?>&operacao=resolver&documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>'><button type='submit' class='btn btn-sm btn-info pull-left' >Marcar como Resolvido</button></a>
			<?php } ?>
			
			<?php } $permissao = retorna_permissao($_SESSION['CPF'],'ABRIR_PROCESSO',$conexao_com_banco); if($tipo_documento=='Memorando' and $numero_processo='' and $permissao='sim'){ ?>
				<a href='abrir-processo.php?sessionId=<?php echo $num ?>&documento=<?php echo $id ?>&assunto=<?php echo $tipo_atividade ?>&detalhes=<?php echo $descricao_fato ?>&interessado=<?php echo $interessado ?>'><button type='submit' class='btn btn-sm btn-info pull-right' >Abrir um processo</button></a>
			<?php } ?>	
	</div>
</div>