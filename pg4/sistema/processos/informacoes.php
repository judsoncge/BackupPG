<div class="row linha-modal-processo">
	<div class="col-md-12">
			<b>STATUS</b>: <?php echo $informacoes['NM_STATUS'] ?><br><br>
			<b>Data de entrada</b>: <?php echo arruma_data($informacoes['DT_ENTRADA']) ?><br>
			<b>Prazo</b>: <?php echo arruma_data($informacoes['DT_PRAZO']) ?><br><br>
			<b>Assunto:</b>: <?php echo retorna_nome_assunto($informacoes['ID_ASSUNTO'],$conexao_com_banco) ?><br>
			<b>Detalhes</b>: <?php echo $informacoes['NM_DETALHES'] ?><br> 
			<b>Órgão Interessado</b>: <?php echo retorna_nome_orgao($informacoes['ID_ORGAO_INTERESSADO'], $conexao_com_banco) ?><br>	
			<b>Interessado</b>: <?php echo $informacoes['NM_INTERESSADO'] ?><br>		
			<b>Está com</b>: <?php echo retorna_nome_servidor($informacoes['CD_SERVIDOR_LOCALIZACAO'], $conexao_com_banco) ?><br>
			<b>No setor</b>: <?php echo $informacoes['CD_SETOR_LOCALIZACAO'] ?><br><br>
			<b>Processo-mãe</b>: <a href='detalhes.php?processo=<?php echo $informacoes['CD_PROCESSO_APENSADO'] ?>&pagina=<?php echo $pagina ?>'><?php echo $informacoes['CD_PROCESSO_APENSADO'] ?></a>
	</div>
</div>