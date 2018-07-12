<?php

$id = $_GET['chamado'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_chamados WHERE ID='$id'");


while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['ID'];
	$problema = $result['NM_PROBLEMA'];
	$natureza = $result['NM_NATUREZA'];
	$requisitante = $result['CD_SERVIDOR_REQUISITANTE'];
	$status = $result['NM_STATUS'];
	$data_abertura = $result['DT_ABERTURA'];
	$data_fechamento = $result['DT_FECHAMENTO'];
	$data_encerramento = $result['DT_ENCERRAMENTO'];
	$nota = $result['NM_NOTA'];
	$nome_requisitante = retorna_nome_servidor($requisitante, $conexao_com_banco);
}


?>