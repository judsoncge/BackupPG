<?php

$id = $_GET['comunicacao'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_comunicacao WHERE ID='$id'");


while($result = mysqli_fetch_array($retornoquery)){
	$item = $result['NM_ITEM'];
	$titulo = $result['NM_TITULO'];
	$texto = $result['NM_TEXTO'];
	$data_publicacao = $result['DT_PUBLICACAO'];
	$status = $result['NM_STATUS'];	
}


?>