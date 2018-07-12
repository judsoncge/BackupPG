<div class="row linha-modal-processo">
	<div class="col-md-12">
			<b>Código da despesa</b>: <?php echo $informacoes['CD_DESPESA'] ?><br>
			<b>Nome da despesa</b>: <?php echo retorna_nome_despesa($informacoes['CD_DESPESA'], $conexao_com_banco) ?><br> 
			<b>Mês para realização do pagamento</b>: <?php echo $informacoes['NR_MES'] ?><br>
			<b>Ano para realização do pagamento</b>: <?php echo $informacoes['NR_ANO'] ?><br> 
			<b>Descrição</b>: <?php echo $informacoes['DS_DESPESA'] ?><br> 			
			<b>Valor</b>: <?php echo "R$ " . arruma_numero($informacoes['VLR_DESPESA']) ?><br> 		
			<b>Data de vencimento</b>: <?php echo arruma_data($informacoes['DT_VENCIMENTO']) ?><br> 			
			<b>Status</b>: <?php echo $informacoes['NM_STATUS'] ?>				
	</div>
</div>