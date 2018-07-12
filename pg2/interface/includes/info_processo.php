<div class="row linha-modal-processo">
	<div class="col-md-12">
			<b>Data de entrada</b>: <?php echo arruma_data($data_entrada) ?><br>
			<b>Tipo</b>: <?php echo $tipo ?><br> 
			<b>Assunto:</b>: <?php echo $descricao ?><br>
			<b>Detalhes</b>: <?php echo $detalhes ?><br> 
			<b>Interessado</b>: <?php echo $interessado ?>		
	</div>
</div>

<div class="row linha-modal-processo">
	<div class="col-md-12">
		<label class="control-label" for="exampleInputEmail1"><b>Responsáveis pelo processo</b>: 
		<?php $lista3 = retorna_responsaveis_processo($numero_processo, $conexao_com_banco); 
		while($r = mysqli_fetch_object($lista3)){ 
			echo $r->NM_SERVIDOR . " "; 
			if($status!='Arquivado' and $status!='Saiu'){ 
				echo " <a href='../componentes/processo/logica/editar.php?sessionId=$num &operacao=remover_responsavel&processo=$numero_processo&responsavel=$r->CD_SERVIDOR'><button type='button' class='btn btn-secondary btn-sm' title='Remover responsável'><i class='fa fa-remove' aria-hidden='true'></i></button></a>" ;
			}
		} ?>
		</label>
	</div>
</div>