<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-todos-documentos'], $conexao_com_banco);
$lista = retorna_documentos($conexao_com_banco);
$pagina = "todos";
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	
	<div class="container titulo-pagina">
		<p>Documentos ativos que estão no meu órgão</p>
	</div>
	
	<?php include('tabela.php')?>

</div>

<?php include('../foot.php')?>