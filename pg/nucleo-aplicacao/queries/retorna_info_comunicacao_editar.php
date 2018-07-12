<?php

$id = $_GET['comunicacao'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM comunicacao WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$item = $result['item'];
	$titulo = $result['titulo'];
	$texto = $result['texto'];
	$data_publicacao = $result['data_publicacao'];
	$status = $result['status'];	
}


?>