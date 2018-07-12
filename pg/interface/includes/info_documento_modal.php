<div class="row linha-modal-processo" style="padding-left: 25px;">
	<div class='row'>
		<div class='col-md-4'>
			<label class='control-label' id='solicitante'><b>Tipo de atividade:</b> <?php echo $tipo_atividade ?></label>
		</div>
		<div class='col-md-4'>
			<label class='control-label' id='data_abertura'><b>Tipo de documento:</b> <?php echo $tipo_documento ?></label>
		</div>
		<div class='col-md-4'>
			<label class='control-label' id='data_abertura'><b>Criado por:</b> <?php echo retorna_nome_pessoa( $criadopor ,$conexao_com_banco)  ?></label>
		</div>
	</div>
	<br>									
	<div class='row'>
		<div class='col-md-4'>
			<label class='control-label' id='data_abertura'><b>Número do processo:</b> <?php echo $numero_processo ?></label>
		</div>
		<div class='col-md-4'>
			<label class='control-label' id='data_abertura'><b>Interessado:</b> <?php echo  $interessado ?></label>
		</div>
		<div class='col-md-4'>
			<label class='control-label' id='data_abertura'><b>Prioridade:</b> <?php echo  arruma_prioridade($prioridade) ?></label>
		</div>
	</div>
	<br>
	<div class='row'>
		<div class='col-md-4'>
			<label class='control-label' id='data_abertura'><b>Data de criação do documento:</b> <?php echo arruma_data($criacao) ?></label>
		</div>

		<div class='col-md-4'>
			<label class='control-label' id='data_abertura'><b>Data de entrada da solicitação:</b> <?php echo arruma_data($entrada) ?></label>
		</div>

		<div class='col-md-4'>
			<label class='control-label' id='data_abertura'><b>Prazo de resposta:</b> <?php echo arruma_data($prazo) ?></label>
		</div>
	</div>
</div>