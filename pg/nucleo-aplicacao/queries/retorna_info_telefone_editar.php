<?php

$id = $_GET['telefone'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM telefone WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$valor = $result['valor'];
	$beneficiario = $result['Pessoa_CPF_beneficiario'];
	$tipo = $result['tipo'];
	$numero = $result['numero'];
}

$retornoquery2 = mysqli_query($conexao_com_banco, "SELECT nome FROM pessoa WHERE CPF='$beneficiario'");

while($result2 = mysqli_fetch_array($retornoquery2)){
	
	$beneficiario2 = $result2['nome'];
		
}


?>