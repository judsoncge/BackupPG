<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-documentos'], $conexao_com_banco);
$lista = retorna_documentos_com_servidor($_SESSION['CPF'], $conexao_com_banco);
$pagina = "comigo";
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	
	<div class="container titulo-pagina">
		<p>Documentos ativos que estão comigo</p>
	</div>
	
	<?php include('tabela.php')?>

</div>

<?php include('../foot.php')?>