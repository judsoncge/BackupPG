<?php

$id = $_GET['processo'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM processo WHERE numero_processo='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$numero_processo = $result['numero_processo'];
	$data_entrada = $result['data_entrada'];
	$tipo = $result['tipo'];
	$descricao = $result['descricao'];
	$detalhes = $result['detalhes'];
	$interessado = $result['interessado'];
	$prazo = $result['prazo'];
	$prazo_final = $result['prazo_final'];
	$situacao = $result['situacao'];
	$situacao_final = $result['situacao_final'];
	$estacom = $result['estacom'];
}


$v_numero_processo1 = explode(" ",$numero_processo);

$numero_processo1 = $v_numero_processo1[0];

$v_numero_processo2 = explode("/",$numero_processo);

$numero_processo3 = $v_numero_processo2[1];

$numero2 =  explode(" ", $v_numero_processo2[0]);

$numero_processo2 = $numero2[1];

if($prioridade == 1){
	$prioridade_nome = 'Urgente';
}else if($prioridade == 2){
	$prioridade_nome = 'Alta';
}else if($prioridade == 3){
	$prioridade_nome = 'Média';
}else if($prioridade == 4){
	$prioridade_nome = 'Baixa';
}

?>