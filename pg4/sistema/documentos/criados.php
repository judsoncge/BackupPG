<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-documentos'], $conexao_com_banco);
$lista = retorna_documentos_criados_servidor($_SESSION['CPF'], $conexao_com_banco);
$pagina = "criados";
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	
	<div class="container titulo-pagina">
		<p>Documentos ativos que foram criados por mim</p>
	</div>
	
	<?php include('tabela.php')?>

</div>

<?php include('../foot.php')?>