<?php

//tempo máximo para a execução do arquivo
ini_set('max_execution_time', 5000);

//definindo a hora local
date_default_timezone_set('America/Bahia');

//conectando ao banco de dados
$conexao_com_banco = mysqli_connect('localhost', 'root', 'cgeagt', 'pg2');

//setando todos os nomes para o UTF8 encoding
mysqli_query($conexao_com_banco, "SET NAMES 'utf8'"); 
mysqli_query($conexao_com_banco, 'SET character_set_connection=utf8');
mysqli_query($conexao_com_banco, 'SET character_set_client=utf8');
mysqli_query($conexao_com_banco, 'SET character_set_results=utf8');

$data_hoje = date('Y-m-d H:i:s');

//definindo as funções desejadas

//função que atualiza a quantidade de dias 
function atualiza_dias($conexao_com_banco){
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NR_DIAS= NR_DIAS + 1 WHERE NM_STATUS!='ARQUIVADO' and NM_STATUS!='SAIU' and BL_SOBRESTADO = 0");
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NR_DIAS_SOBRESTADO = NR_DIAS_SOBRESTADO + 1 WHERE NM_STATUS!='ARQUIVADO' and NM_STATUS!='SAIU' and BL_SOBRESTADO = 1");
}

//função que verifica se os processos ainda estão com prazo em dia. Se não estiver, o status do processo fica em atraso
function verifica_prazo($conexao_com_banco){
	
	$query = "UPDATE tb_processos SET BL_ATRASADO = 1 WHERE NM_STATUS!='ARQUIVADO' and NM_STATUS!='SAIU' and NR_DIAS > 60";
	   
	mysqli_query($conexao_com_banco, $query);
	
	$query2 = "UPDATE tb_processos SET BL_ATRASADO = 0 WHERE NM_STATUS!='ARQUIVADO' and NM_STATUS!='SAIU' and NR_DIAS < 61";
	   
	mysqli_query($conexao_com_banco, $query2);
	
}


//chamando as funções para a execução
verifica_prazo($conexao_com_banco);

atualiza_dias($conexao_com_banco);


?>
