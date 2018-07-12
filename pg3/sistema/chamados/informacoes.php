<div class="row linha-modal-processo">
	<div class="col-md-12">
			<b>Data de abertura</b>: <?php echo arruma_data($informacoes['DT_ABERTURA']) ?><br>
			<b>Data de fechamento</b>: <?php echo arruma_data($informacoes['DT_FECHAMENTO']) ?><br> 
			<b>Requisitante:</b>: <?php echo $informacoes['NM_SERVIDOR'] ?><br>
			<b>Problema</b>: <?php echo $informacoes['NM_PROBLEMA'] ?><br> 
			<b>Natureza</b>: <?php echo $informacoes['NM_NATUREZA'] ?>		
	</div>
</div>