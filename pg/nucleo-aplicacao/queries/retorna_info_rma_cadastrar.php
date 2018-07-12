<?php

$material_anterior = $_POST['material'];
$mes_competencia_anterior = $_POST['competencia'];

//pegando o ano da diária de acordo com o ano atual 
date_default_timezone_set('America/Sao_Paulo');
$novo_ano =  date('Y');

$ano_anterior = $novo_ano

$mes_competencia_anterior = $mes_competencia_anterior - 1;

if($mes_competencia_anterior==0){
	$mes_competencia_anterior=12;
	$ano_anterior = $ano_anterior - 1;
}

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM rma WHERE material='$material_anterior' and mes_competencia='$mes_competencia_anterior'
and ano='$ano_anterior'");

$linha = mysqli_affected_rows($conexao_com_banco);


