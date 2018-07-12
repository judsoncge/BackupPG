<div class="row linha-modal-processo">
	<div class="col-md-12">
			<b>Data de entrada</b>: <?php echo arruma_data($informacoes['DT_ENTRADA']) ?><br>
			<b>Tipo</b>: <?php echo $informacoes['NM_TIPO'] ?><br> 
			<b>Assunto:</b>: <?php echo $informacoes['DS_PROCESSO'] ?><br>
			<b>Detalhes</b>: <?php echo $informacoes['NM_DETALHES'] ?><br> 
			<b>Interessado</b>: <?php echo $informacoes['NM_INTERESSADO'] ?><br>		
			<b>Está com</b>: <?php echo retorna_nome_servidor($informacoes['CD_SERVIDOR_LOCALIZACAO'], $conexao_com_banco) ?>		
	</div>
</div>