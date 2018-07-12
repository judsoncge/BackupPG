<?php

include('../../banco-dados/conectar.php');

session_start();

$id = $_GET['id']; 

$edita_valor_residual = $_GET["residual"]; 	

$edita_depreciacao_acumulada = $_GET["acumulada"]; 	

$edita_valor_liquido = $_GET["liquido"]; 	

$edita_depreciacao_mes = $_POST["depreciacao_mes"]; 	

$edita_valor_liquido = $edita_valor_liquido - $edita_depreciacao_mes;

if($edita_valor_liquido <= $edita_valor_residual){
	$edita_valor_liquido = $edita_valor_residual;
}

$edita_depreciacao_acumulada = $edita_depreciacao_acumulada + $edita_depreciacao_mes;


include('../banco-dados/editar.php');

?>