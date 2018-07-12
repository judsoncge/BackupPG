<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-documentos-setor'], $conexao_com_banco);
$lista = retorna_documentos_setor($_SESSION['setor'], $conexao_com_banco);
$pagina = "setor";
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	
	<div class="container titulo-pagina">
		<p>Documentos ativos que estão no meu setor</p>
	</div>
	
	<?php include('tabela.php')?>

</div>

<?php include('../foot.php')?>