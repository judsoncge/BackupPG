<div class="row linha-modal-processo">
	<div class="col-md-12">
		<label class="control-label" for="exampleInputEmail1"><b>Responsáveis pelo processo</b>: 
		<?php $lista3 = retorna_responsaveis_processo($informacoes['CD_PROCESSO'], $conexao_com_banco); 
		while($r = mysqli_fetch_object($lista3)){ 
			echo $r->NM_SERVIDOR . "; "; 
			if(($_SESSION['permissao-definir-responsaveis-processo']='sim' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($_SESSION['permissao-definir-responsaveis-processo']='sim' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-definir-responsaveis-processo']='sim' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){ ?>
				<a href='logica/editar.php?&operacao=remover_responsavel&processo=<?php echo $informacoes['CD_PROCESSO']?>&responsavel=<?php echo $r->CD_SERVIDOR?>'><button type='button' class='btn btn-secondary btn-sm' title='Remover responsável'><i class='fa fa-remove' aria-hidden='true'></i></button></a>
		<?php  }
		} ?>
		</label>
	</div>
</div>