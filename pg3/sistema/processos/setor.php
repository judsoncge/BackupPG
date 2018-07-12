<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-processos-setor'], $conexao_com_banco);
$lista = retorna_processos_setor($_SESSION['setor'],$conexao_com_banco);
$pagina = "setor";
$listagem = "setor";
?>

<div id="page-content-wrapper">
	
	<div class="container titulo-pagina">
		<p>Todos os processos ativos que estão no meu setor</p>
	</div>
	
	<?php include('tabela.php')?>
</div>


<?php include('../foot.php')?>