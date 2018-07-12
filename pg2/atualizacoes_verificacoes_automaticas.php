<?php

//tempo máximo para a execução do arquivo
ini_set('max_execution_time', 5000);

//definindo a hora local
date_default_timezone_set('America/Bahia');

//conectando ao banco de dados
$conexao_com_banco = mysqli_connect('localhost', 'root', 'cgeagt', 'pg');

//setando todos os nomes para o UTF8 encoding
mysqli_query($conexao_com_banco, "SET NAMES 'utf8'"); 
mysqli_query($conexao_com_banco, 'SET character_set_connection=utf8');
mysqli_query($conexao_com_banco, 'SET character_set_client=utf8');
mysqli_query($conexao_com_banco, 'SET character_set_results=utf8');

$data_hoje = date('Y-m-d H:i:s');

//definindo as funções desejadas

//função que verifica se os processos ainda estão com prazo parcial em dia. Se não estiver, a situação parcial do processo fica em atraso
function verifica_prazo($conexao_com_banco){
	
	$data_hoje = date('Y-m-d');
	
	$query = "SELECT * FROM tb_processos WHERE NM_STATUS='Ativo'";
	   
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	while($r = mysqli_fetch_object($resultado)){ 
	
		$processo = $r->CD_PROCESSO;
		
		if($data_hoje <= $r->DT_PRAZO and $r->DT_PRAZO != '0000-00-00' and $r->NM_SITUACAO!='Concluído' and $r->NM_SITUACAO!='Concluído com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO='Análise em andamento' WHERE CD_PROCESSO='$processo'");
		
		}else if($data_hoje > $r->DT_PRAZO and $r->DT_PRAZO != '0000-00-00' and $r->NM_SITUACAO!='Concluído' and $r->NM_SITUACAO!='Concluído com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO='Análise em atraso' WHERE CD_PROCESSO='$processo'");
			
		}

	}
	
}

//função que verifica se os processos ainda estão com prazo final em dia. Se não estiver, a situação final do processo fica em atraso
function verifica_prazo_final($conexao_com_banco){
	
	$data_hoje = date('Y-m-d');
	
	$query = "SELECT * FROM tb_processos WHERE NM_STATUS='Ativo'";
	   
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	while($r = mysqli_fetch_object($resultado)){ 
	
		$processo = $r->CD_PROCESSO;
		
		if($data_hoje <= $r->DT_PRAZO_FINAL and $r->DT_PRAZO_FINAL != '0000-00-00' and $r->NM_SITUACAO_FINAL!='Finalizado' and $r->NM_SITUACAO_FINAL!='Finalizado com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO_FINAL='Finalização em andamento' WHERE CD_PROCESSO='$processo'");
		
		}else if($data_hoje > $r->DT_PRAZO_FINAL and $r->DT_PRAZO_FINAL != '0000-00-00' and $r->NM_SITUACAO_FINAL!='Finalizado' and $r->NM_SITUACAO_FINAL!='Finalizado com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO_FINAL='Finalização em atraso' WHERE CD_PROCESSO='$processo'");
			
		}

	}
	
}

//função que atualiza a quantidade de dias 
function atualiza_dias($conexao_com_banco){
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NR_DIAS=DATEDIFF(CURDATE(), DT_ENTRADA) WHERE NM_STATUS!='Arquivado' and NM_STATUS!='Saiu'");
}

//chamando as funções para a execução
verifica_prazo($conexao_com_banco);
verifica_prazo_final($conexao_com_banco);
atualiza_dias($conexao_com_banco);

//criando uma notificação no banco para dizer que foram feitas as atualizações
mysqli_query($conexao_com_banco, "INSERT INTO notificacao (ID, TX_MENSAGEM, NM_STATUS, CD_SERVIDOR, DT_CRIADO, DT_VISUALIZADO, LINK_NOTIFICACAO) VALUES (NULL, 'Atualizações e verificações automáticas realizadas com sucesso', 'NOVA', '062.200.904-46', '$data_hoje', NULL, 'lala')") or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "INSERT INTO notificacao (ID, TX_MENSAGEM, NM_STATUS, CD_SERVIDOR, DT_CRIADO, DT_VISUALIZADO, LINK_NOTIFICACAO) VALUES (NULL, 'Atualizações e verificações automáticas realizadas com sucesso', 'NOVA', '077.036.184-62', '$data_hoje', NULL, 'lala')") or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "UPDATE `tb_atividades` SET NM_STATUS = 'VENCEU' WHERE DT_VENCIMENTO < CURDATE() AND NM_STATUS IN ('FALTA ANEXO', 'EM ANDAMENTO')") or die (mysqli_error($conexao_com_banco));

?>
