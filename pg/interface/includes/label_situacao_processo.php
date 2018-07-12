<div class="row">
	<div class="col-md-4">	
	<?php if($situacao == "Concluído"){ ?>
		<b><p id="situacao-concluido">Análise Concluída</p></b>
	<?php } else ?>
		<?php if($situacao_final == "Finalizado"){ ?>
		<b><p id="situacao-concluido">Processo Finalizado</p></b>
	<?php } else ?>
		<?php if($situacao == "Em andamento" or $situacao_final == "Em andamento"){ ?>
		<b><p id="situacao-em-andamento">Em andamento</p></b>
	<?php } else ?>
		<?php if($situacao == "Análise em atraso" or $situacao_final == "Finalização em atraso"){ ?>
		<b><p id="situacao-em-atraso">Em atraso</p></b>
	<?php } else ?>
		<?php if($situacao == "Concluído com atraso"){ ?>
		<b><p id="situacao-concluido-em-atraso">Concluído com atraso</p></b>
	<?php } ?>
		<?php if($situacao_final == "Finalizado com atraso"){ ?>
		<b><p id="situacao-concluido-em-atraso">Finalizado com atraso</p></b>
	<?php } ?>
	</div>
</div>