<?php

$id = $_GET['diaria'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM diaria WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['id'];
	$portaria = $result['numero_portaria'];
	$beneficiario = $result['Pessoa_CPF_beneficiario'];;
	$data_portaria = $result['data_publicacao_portaria'];
	$data_ida = $result['data_ida'];
	$tipo = $result['tipo'];
	$n_diarias = $result['numero_diarias'];
	$destino = $result['destino'];
	$data_volta = $result['data_volta'];
	$valor = $result['valor'];
}

$retornoquery2 = mysqli_query($conexao_com_banco, "SELECT nome FROM pessoa WHERE CPF='$beneficiario'");

while($result2 = mysqli_fetch_array($retornoquery2)){
	
	$beneficiario2 = $result2['nome'];
		
}


?>