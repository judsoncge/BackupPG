<div class="row linha-modal-processo" style="padding-left: 25px;">
		<label class='control-label' id='solicitante'><b>Descrição do fato:</b> <?php echo $informacoes['DS_DOCUMENTO'] ?></label><br>
		<label class='control-label' id='solicitante'><b>Tipo de atividade:</b> <?php echo retorna_nome_assunto($informacoes['ID_ASSUNTO'], $conexao_com_banco) ?></label><br>
		<label class='control-label' id='data_abertura'><b>Tipo de documento:</b> <?php echo $informacoes['NM_DOCUMENTO'] ?></label><br>
		<label class='control-label' id='data_abertura'><b>Criado por:</b> <?php echo retorna_nome_servidor($informacoes['CD_SERVIDOR_CRIACAO'] ,$conexao_com_banco)  ?></label><br>
		<label class='control-label' id='data_abertura'><b>Número do processo: </b><a href='../processos/detalhes.php?processo=<?php echo $informacoes['CD_PROCESSO'] ?>&pagina=geral'><?php echo $informacoes['CD_PROCESSO'] ?></a></label><br>
		<label class='control-label' id='data_abertura'><b>Interessado:</b> <?php echo $informacoes['NM_INTERESSADO'] ?></label><br>
		<label class='control-label' id='data_abertura'><b>Prioridade:</b> <?php echo arruma_prioridade($informacoes['NR_PRIORIDADE']) ?></label><br>
		<label class='control-label' id='data_abertura'><b>Data de criação do documento:</b> <?php echo arruma_data($informacoes['DT_CRIACAO']) ?></label><br>
		<label class='control-label' id='data_abertura'><b>Data de entrada da solicitação:</b> <?php echo arruma_data($informacoes['DT_ENTRADA']) ?></label><br>
		<label class='control-label' id='data_abertura'><b>Prazo de resposta:</b> <?php echo arruma_data($informacoes['DT_PRAZO']) ?></label><br>
		<label class='control-label' id='data_abertura'><b>Status:</b> <?php echo $informacoes['NM_STATUS'] ?></label><br>
		<label class='control-label' id='data_abertura'><b>Valor: </b>R$ <?php echo arruma_numero($informacoes['VLR_DOCUMENTO']) ?></label>
</div>