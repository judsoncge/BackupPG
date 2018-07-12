<div class="row linha-modal-processo">
	<div class="col-md-12">
			<b>Número do patrimônio: </b><?php echo $numero_patrimonio ?><br>
			<b>Setor: </b><?php echo $setor ?><br>
			<b>Descrição: </b><?php echo $descricao ?><br>
			<b>Denominação: </b><?php echo $denominacao ?><br>
			<b>Conservação: </b><?php echo $conservacao ?><br>
			<b>Documento de aquisição: </b><?php echo $documento_aquisicao ?><br>
			<b>Data de aquisição: </b><?php echo arruma_data($data_aquisicao) ?><br>
			<b>Valor de aquisição: R$ </b><?php echo arruma_numero($valor_aquisicao) ?><br>
			<b>Anos: </b><?php echo $anos ?><br>
			<b>Taxa de depreciação: </b><?php echo $taxa_depreciacao ?>%<br>
			<b>Valor residual: R$ </b><?php echo arruma_numero($valor_residual) ?><br>
			<b>Valor depreciável: R$ </b><?php echo arruma_numero($valor_depreciavel) ?><br>
			<b>Valor da depreciação acumulada: R$ </b><?php echo arruma_numero($valor_depreciacao_acumulada) ?><br>
			<b>Valor líquido: R$ </b><?php echo arruma_numero($valor_liquido) ?><br>
			<b>Valor de depreciação por mês: R$ </b><?php echo arruma_numero($valor_depreciacao_mes) ?>		
	</div>
</div>