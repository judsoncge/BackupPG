<div class="row linha-modal-processo" style="padding-left: 25px;">
		<label class='control-label'><b>Descrição:</b> <?php echo $descricao ?></label><br>
		<label class='control-label'><b>Solicitante:</b> <?php echo retorna_nome_servidor($solicitante ,$conexao_com_banco)  ?></label><br>
		<label class='control-label'><b>Processo: </b><a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $numero_processo ?>&pagina='><?php echo $numero_processo; ?></a></label><br>
		<label class='control-label'><b>Data da solicitação:</b> <?php echo arruma_data($data_solicitacao) ?></label><br>
		<label class='control-label'><b>Prazo:</b> <?php echo arruma_data($prazo) ?></label><br>
		<label class='control-label'><b>Valor:</b> <?php if($valor==0){echo 'Sem valor definido';}else{echo arruma_numero($valor);} ?></label><br>
		<label class='control-label'><b>Status:</b> <?php echo $status ?></label><br>
</div>