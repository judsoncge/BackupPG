<?php
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-todos-processos'], $conexao_com_banco);
$lista = retorna_todos_processos($conexao_com_banco);
$listagem="todos";
?>

 
<div id="page-content-wrapper">

	<div class="container titulo-pagina">
		<p>Todos os processos</p>
	</div>
	
	<?php include('tabela.php')?>
	
</div>

<?php include('../foot.php')?>