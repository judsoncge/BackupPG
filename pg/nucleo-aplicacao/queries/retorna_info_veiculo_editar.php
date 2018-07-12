<?php

$id = $_GET['veiculo'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM veiculo WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$placa = $result['placa'];
	$modelo = $result['modelo'];
	$valor = $result['valor'];
	$beneficiario = $result['Pessoa_CPF_condutor'];
	$termo_cessao = $result['termo_cessao'];
	$chipado = $result['chipado'];
	$codigo_chip = $result['codigo_chip'];
	$logomarca = $result['logomarca'];
	$licenciado = $result['licenciado'];
	$ano_fabricacao = $result['ano_fabricacao'];
	$locado = $result['locado'];
	$renavam = $result['renavam'];
	$aluguel_mensal = $result['aluguel_mensal'];
	$seguro = $result['seguro'];
	$recolhido_garagem = $result['recolhido_garagem_noite'];
	$observacoes = $result['observacoes'];	
}

$retornoquery2 = mysqli_query($conexao_com_banco, "SELECT nome FROM pessoa WHERE CPF='$beneficiario'");

while($result2 = mysqli_fetch_array($retornoquery2)){
	
	$beneficiario2 = $result2['nome'];
		
}


?>