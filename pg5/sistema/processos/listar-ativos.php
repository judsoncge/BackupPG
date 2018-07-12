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
		<p>Processos ativos</p>
	</div>
		
	<?php include('../includes/mensagem.php') ?>
	
	<button onclick="javascript: exportar();" class="btn btn-sm btn-success" name="submit" value="Send">Exportar</button>
	
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">					
					
					<?php 
						include('campos-filtros.php'); 
						
						$lista = retorna_lista_processos_ativos($conexao_com_banco);
						
						include('tabela-ativos.php'); 
					?>
					

				</div>
			</div>
		</div>
	</div>


<?php include('../foot.php')?>