<?php
include('../../iniciar.php');

if($_GET['operacao']=='info'){
	
	$id = $_GET['receita'];
	
	$edita_codigo_receita = $_POST['tipo'];

	$edita_descricao = $_POST['descricao'];

	$edita_mes = $_POST['mes'];

	$edita_ano = $_POST['ano'];
	
	$edita_valor = $_POST['valor'];
	
	$num = $_GET['sessionId'];
	
}

include('../banco-dados/editar.php');
		
?>