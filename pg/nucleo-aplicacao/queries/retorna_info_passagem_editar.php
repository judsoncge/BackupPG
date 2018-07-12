<?php

$id = $_GET['passagem'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM passagem_aerea WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$empenho = $result['numero_empenho'];
	$beneficiario = $result['Pessoa_CPF_beneficiario'];
	$numero_integra = $result['numero_processo_integra'];
	$data_ida = $result['data_ida'];
	$horario_ida = $result['horario_ida'];
	$data_volta = $result['data_volta'];
	$horario_volta = $result['horario_volta'];
	$valor_ida = $result['valor_pago_ida'];
	$valor_volta = $result['valor_pago_volta'];
	$destino_viagem = $result['destino_viagem'];
	$finalidade = $result['finalidade'];
	
}

$retornoquery2 = mysqli_query($conexao_com_banco, "SELECT nome FROM pessoa WHERE CPF='$beneficiario'");

while($result2 = mysqli_fetch_array($retornoquery2)){
	
	$beneficiario2 = $result2['nome'];
		
}


?>