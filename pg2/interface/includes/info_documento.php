<div class="row linha-modal-processo" style="padding-left: 25px;">
		<label class='control-label' id='solicitante'><b>Tipo de atividade:</b> <?php echo $tipo_atividade ?></label><br>
		<label class='control-label' id='data_abertura'><b>Tipo de documento:</b> <?php echo $tipo_documento ?></label><br>
		<label class='control-label' id='data_abertura'><b>Criado por:</b> <?php echo retorna_nome_servidor($criadopor ,$conexao_com_banco)  ?></label><br>
		<label class='control-label' id='data_abertura'><b>Número do processo:</b><a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $numero_processo ?>'><?php echo $numero_processo ?></a></label><br>
		<label class='control-label' id='data_abertura'><b>Interessado:</b> <?php echo $interessado ?></label><br>
		<label class='control-label' id='data_abertura'><b>Prioridade:</b> <?php echo arruma_prioridade($prioridade) ?></label><br>
		<label class='control-label' id='data_abertura'><b>Data de criação do documento:</b> <?php echo arruma_data($criacao) ?></label><br>
		<label class='control-label' id='data_abertura'><b>Data de entrada da solicitação:</b> <?php echo arruma_data($entrada) ?></label><br>
		<label class='control-label' id='data_abertura'><b>Prazo de resposta:</b> <?php echo arruma_data($prazo) ?></label>
</div>