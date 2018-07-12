<div class="row linha-modal-processo">
	<div class="col-md-12">
		<label class="control-label" for="exampleInputEmail1"><b>Responsáveis pelo processo</b>: 
		
		<?php $lista3 = retorna_responsaveis_processo($informacoes['CD_PROCESSO'], $conexao_com_banco); 
		
		while($r = mysqli_fetch_object($lista3)){ 
			
			echo $r->NM_SERVIDOR . "; "; 
			
			if($informacoes['NM_STATUS']!='Saiu' and $informacoes['NM_STATUS']!='Arquivado'){
				if($mexer_processo_outros == true and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-definir-responsaveis-processo']='sim'){	?>
						<a href='logica/editar.php?&operacao=remover_responsavel&processo=<?php echo $informacoes['CD_PROCESSO']?>&responsavel=<?php echo $r->CD_SERVIDOR?>&lider=<?php echo $informacoes['CD_SERVIDOR_RESPONSAVEL_LIDER']?>'><button type='button' class='btn btn-secondary btn-sm' title='Remover responsável'><i class='fa fa-remove' aria-hidden='true'></i></button></a>
				<?php  }
			
				}
			} ?>
		</label>
	</div>
</div>