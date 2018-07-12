<?php
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-processos-arquivados'], $conexao_com_banco);
$lista = retorna_processos_status('Arquivado', $conexao_com_banco);
$listagem="arquivados";
$pagina = "arquivados";
?>

<div id="page-content-wrapper">

	<div class="container titulo-pagina">
		<p>Todos os processos que foram arquivados no órgão</p>
	</div>
	
	<?php include('tabela.php')?>

<?php include('../foot.php')?>