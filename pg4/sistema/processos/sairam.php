<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-processos-sairam'], $conexao_com_banco);
$lista = retorna_processos_status('Saiu', $conexao_com_banco);
$listagem = "sairam";
$pagina = "sairam";
?>

<div id="page-content-wrapper">

	<div class="container titulo-pagina">
		<p>Todos os processos que saíram do órgão</p>
	</div>
	
	<?php include('tabela.php')?>

<?php include('../foot.php')?>