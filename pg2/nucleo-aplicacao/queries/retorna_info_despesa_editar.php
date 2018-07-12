<?php

$id = $_GET['despesa'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_despesas WHERE ID='$id'");


while($result = mysqli_fetch_array($retornoquery)){
	$codigo_despesa = $result['CD_DESPESA'];
	$descricao_despesa = $result['DS_DESPESA'];
	$mes_despesa = $result['NR_MES'];
	$ano_despesa = $result['NR_ANO'];
	$valor_despesa = $result['VLR_DESPESA'];
	$data_vencimento = $result['DT_VENCIMENTO'];
	$status = $result['NM_STATUS'];
	$nome_despesa = retorna_nome_despesa($codigo_despesa, $conexao_com_banco);
}

?>