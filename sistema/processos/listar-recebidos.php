<?php 
include('../head.php');
include('../body.php');
?>

<script src='js/receber.js'></script>
<script src='js/filtros.js'></script>
<script src='js/exportar.js'></script>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Processos recebidos de outro setor</p>
	</div>
		
	<?php include('../includes/mensagem.php') ?>

	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">	
					<div class="well">
						<div class="input-group margin-bottom-sm">
							<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Busque por qualquer termo da tabela" id="search" autofocus="autofocus" />
						</div>
					</div>
					<?php 
					
						$lista = retorna_lista_processos_recebidos($conexao_com_banco);
						
						include('tabela-ativos.php'); 
					?>
				</div>
			</div>
		</div>
	</div>


<?php include('../foot.php')?>