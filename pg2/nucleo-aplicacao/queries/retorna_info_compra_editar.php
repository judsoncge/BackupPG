<?php

$id = $_GET['compra'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_compras WHERE CD_COMPRA='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$solicitante = $result['CD_SERVIDOR_SOLICITANTE'];
	$descricao = $result['DS_COMPRA'];
	$numero_processo = $result['CD_PROCESSO'];
	$data_solicitacao = $result['DT_SOLICITACAO'];
	$prazo = $result['DT_PRAZO'];	
	$valor = $result['VLR_COMPRA'];
	$status = $result['NM_STATUS'];
	$nome_solicitante = retorna_nome_servidor($solicitante, $conexao_com_banco);
}

?>