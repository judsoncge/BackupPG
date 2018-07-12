<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-processos'], $conexao_com_banco);
$lista = retorna_processos_com_servidor($_SESSION['CPF'], $conexao_com_banco);
$listagem="comigo";
?>

<div id="page-content-wrapper">
	
	<div class="container titulo-pagina">
		<p>Todos os processos que estão comigo</p>
	</div>

	<?php include('tabela.php')?>
	
</div>

<?php include('../foot.php')?>