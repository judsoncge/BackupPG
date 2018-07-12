<?php

$empenho = $_GET['rma'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM rma WHERE numero_empenho='$empenho'");

echo "passou aqui";

while($result = mysqli_fetch_array($retornoquery)){
	$empenho = $result['numero_empenho'];
	$competencia = $result['mes_competencia'];
	$pagamento = $result['mes_pagamento'];
	$valor = $result['valor'];
	$ano = $result['ano'];
	$ano_adquiridos = $result['ano_adquiridos'];
	$material = $result['material'];
	$nota_fiscal = $result['nota_fiscal'];
	$subitem_orcamentario = $result['subitem_orcamentario'];
	$fornecedor = $result['fornecedor'];
	$saldo_anterior_qtd = $result['saldo_anterior_qtd'];
	$saldo_anterior_vlr_unit = $result['saldo_anterior_vlr_unit'];
	$saldo_anterior_vlr_total = $result['saldo_anterior_vlr_total'];
	$atual_qtd = $result['atual_qtd'];
	$atual_vlr_unit = $result['atual_vlr_unit'];
	$atual_vlr_total = $result['atual_vlr_total'];
	$tipo = $result['tipo'];
	$entrada_qtd = $result['entrada_qtd'];
	$entrada_vlr_unit = $result['entrada_vlr_unit'];
	$entrada_vlr_total = $result['entrada_vlr_total'];
	$saida_qtd = $result['saida_qtd'];
	$saida_vlr_unit = $result['saida_vlr_unit'];
	$saida_vlr_total = $result['saida_vlr_total'];	
}


?>