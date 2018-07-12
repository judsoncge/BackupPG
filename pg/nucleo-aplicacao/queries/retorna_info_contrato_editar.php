<?php

$contrato = $_GET['contrato'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM contrato WHERE id='$contrato'");

while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['id'];
	$valor = $result['valor'];
	$numero_contrato = $result['numero_contrato'];
	$contratado = $result['contratado'];
	$cnpj_contratado = $result['CNPJ_contratado'];
	$status_prorrogavel = $result['status_prorrogavel'];
	$valor = $result['valor'];
	$objeto_contrato = $result['objeto_contrato'];
	$data_inicio_publicacao = $result['data_inicio_publicacao'];
	$data_termino_publicacao = $result['data_termino_publicacao'];
	$prorrogavel = $result['status_prorrogavel'];
	$vinculacao = $result['vinculacao'];
	$numero_contrato_siafem = $result['numero_contrato_siafem'];	
}

?>