<?php

$id = $_GET['combustivel'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM combustivel WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['id'];
	$valor = $result['valor'];
	$placa = $result['Veiculo_placa'];
	$data_abastecimento = $result['data_abastecimento'];
	$valor_litro = $result['valor_litro'];
	$quantidade_litro = $result['quantidade_litro'];
}

?>