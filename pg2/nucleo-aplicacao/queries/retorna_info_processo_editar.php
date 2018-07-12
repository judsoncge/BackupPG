<?php

$id = $_GET['processo'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_PROCESSO='$id'");


while($result = mysqli_fetch_array($retornoquery)){
	$numero_processo = $result['CD_PROCESSO'];
	$data_entrada = $result['DT_ENTRADA'];
	$tipo = $result['NM_TIPO'];
	$descricao = $result['NM_DESCRICAO'];
	$detalhes = $result['NM_DETALHES'];
	$interessado = $result['NM_INTERESSADO'];
	$prazo = $result['DT_PRAZO'];
	$prazo_final = $result['DT_PRAZO_FINAL'];
	$situacao = $result['NM_SITUACAO'];
	$situacao_final = $result['NM_SITUACAO_FINAL'];
	$estacom = $result['CD_SERVIDOR_LOCALIZACAO'];
	$status = $result['NM_STATUS'];
}


$v_numero_processo1 = explode(" ",$numero_processo);

$numero_processo1 = $v_numero_processo1[0];

$v_numero_processo2 = explode("/",$numero_processo);

$numero_processo3 = $v_numero_processo2[1];

$numero2 =  explode(" ", $v_numero_processo2[0]);

$numero_processo2 = $numero2[1];


?>