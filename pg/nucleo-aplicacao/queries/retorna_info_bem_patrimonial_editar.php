<?php

$id = $_GET['bempatrimonial'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM bem_patrimonial WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['id'];
	$depreciacao_acumulada = $result['depreciacao_acumulada'];
	$valor_liquido = $result['valor_liquido'];
	$valor_residual = $result['valor_residual'];
}


?>