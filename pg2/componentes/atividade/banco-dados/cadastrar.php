<?php

function cadastrar_atividade($conexao_com_banco, $descricao, $dt_vencimento, $cd_servidor) {
$dt_criado = date('Y-m-d H:i:s');
$status = 'EM ANDAMENTO';
if ($dt_criado > $dt_vencimento) {
	$status = 'VENCEU';
}
//inserindo o novo chamado no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO `tb_atividades` (`ID`, `TX_DESCRICAO`, `DT_CRIADO`, `DT_VENCIMENTO`, `CD_SERVIDOR`, `NM_STATUS`) VALUES (NULL, '$descricao', '$dt_criado', '$dt_vencimento', '$cd_servidor', '$status');") or die (mysqli_error($conexao_com_banco));
}

?>