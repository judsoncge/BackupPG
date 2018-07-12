<?php

$id = $_GET['receita'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_receitas WHERE ID='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['ID'];
	$codigo_receita = $result['CD_RECEITA'];
	$nome_receita = retorna_nome_receita($codigo_receita,$conexao_com_banco);
	$mes_receita = $result['NR_MES'];
	$ano_receita = $result['NR_ANO'];
	$descricao_receita = $result['DS_RECEITA'];
	$valor_receita = $result['VLR_RECEITA'];	
}

?>