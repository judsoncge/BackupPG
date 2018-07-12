 <div class="container menu-home">
		<div class="btn-group" role="group" aria-label="...">
			<a href="relatorio-por-pessoa.php"><button type="button" class="btn botao-dashboard">Por Pessoa</button></a>
			<?php if($_SESSION['permissao-visualizar-relatorio-orgao']=="sim"){ ?>
				<a href="relatorio-geral.php"><button type="button" class="btn botao-dashboard">Visão Geral</button></a>
				<a href="relatorio-executivo-selecionar.php"><button type="button" class="btn botao-dashboard">Executivo</button></a>
			<?php } ?>
		 </div>
	</div>