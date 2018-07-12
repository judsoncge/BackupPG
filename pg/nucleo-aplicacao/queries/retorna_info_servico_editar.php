<?php

$id = $_GET['servico'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM servico WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['id'];
	$valor = $result['valor'];
	$credor = $result['credor'];
	$tipo = $result['tipo'];
}

?>