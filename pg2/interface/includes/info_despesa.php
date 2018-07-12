<div class="row linha-modal-processo">
	<div class="col-md-12">
			<b>Código da despesa</b>: <?php echo $codigo_despesa ?><br>
			<b>Nome da despesa</b>: <?php echo $nome_despesa ?><br> 
			<b>Mês para realização do pagamento</b>: <?php echo arruma_numero_mes($mes_despesa) ?><br>
			<b>Ano para realização do pagamento</b>: <?php echo $ano_despesa ?><br> 
			<b>Descrição</b>: <?php echo $descricao_despesa ?><br> 			
			<b>Valor</b>: <?php echo "R$ " . arruma_numero($valor_despesa) ?><br> 		
			<b>Data de vencimento</b>: <?php echo arruma_data($data_vencimento) ?><br> 			
			<b>Status</b>: <?php echo $status ?>				
	</div>
</div>