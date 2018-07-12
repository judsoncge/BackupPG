<?php

$id = $_GET['bem-patrimonial'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_bem_patrimonial WHERE ID='$id'");


while($result = mysqli_fetch_array($retornoquery)){
	$numero_patrimonio = $result['NM_PATRIMONIO'];
	$setor = $result['CD_SETOR_LOCALIZACAO'];
	$descricao = $result['DS_DESCRICAO'];
	$denominacao = $result['NM_DENOMINACAO'];
	$conservacao = $result['NM_CONSERVACAO'];
	$documento_aquisicao = $result['NM_DOC_AQUISICAO'];
	$data_aquisicao = $result['DT_AQUISICAO'];
	$valor_aquisicao = $result['VLR_AQUISICAO'];
	$anos = $result['NM_ANOS'];
	$taxa_depreciacao = $result['TX_DEPRECIACAO'];
	$valor_residual = $result['VLR_RESIDUAL'];
	$valor_depreciavel = $result['VLR_DEPRECIAVEL'];
	$valor_depreciacao_acumulada = $result['VLR_DEPRECIACAO_ACUMULADA'];
	$valor_liquido = $result['VLR_LIQUIDO'];
	$valor_depreciacao_mes = $result['VLR_DEPRECIACAO_MES'];
}


?>