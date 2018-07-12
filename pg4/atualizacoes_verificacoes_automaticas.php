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

//função que verifica se os processos ainda estão com prazo em dia. Se não estiver, o status do processo fica em atraso
function verifica_prazo($conexao_com_banco){
	
	$data_hoje = date('Y-m-d');
	
	$query = "SELECT * FROM tb_processos WHERE NM_STATUS!='Arquivado' and NM_STATUS!='Saiu' and NM_STATUS != 'Saiupol' and NM_STATUS!='Finalizado pelo setor' and NM_STATUS!='Finalizado pelo gabinete' and DT_PRAZO != '0000-00-00'";
	   
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	while($r = mysqli_fetch_object($resultado)){ 
	
		$processo = $r->CD_PROCESSO;
		
		if($data_hoje <= $r->DT_PRAZO){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_STATUS='Em andamento' WHERE CD_PROCESSO='$processo'");
		
		}else if($data_hoje > $r->DT_PRAZO){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_STATUS='Atrasado' WHERE CD_PROCESSO='$processo'");
			
		}

	}
	
}

//função que atualiza a quantidade de dias 
function atualiza_dias($conexao_com_banco){
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NR_DIAS=DATEDIFF(CURDATE(), DT_ENTRADA) WHERE NM_STATUS!='Arquivado' and NM_STATUS!='Saiu'");
}

//função que atualiza a quantidade de dias que um superintendente está com um processo na tabela de acompanhamento de processos
function atualizar_acompanhamento($conexao_com_banco) {	
	mysqli_query($conexao_com_banco, "UPDATE `tb_acompanhamento_processo` tap2 RIGHT JOIN (SELECT tap.ID, tap.CD_PROCESSO, SUM(DATEDIFF((SELECT IF(MIN(t.DT_TRAMITACAO) IS NULL OR MIN(t.DT_TRAMITACAO) = '0000-00-00 00:00:00', CURDATE(), MIN(t.DT_TRAMITACAO)) FROM `tb_tramitacao_processos` t WHERE t.CD_PROCESSO = tp.CD_PROCESSO AND t.CD_SERVIDOR_ORIGEM = tp.CD_SERVIDOR_DESTINO AND t.ID > tp.ID AND DATE_FORMAT(t.DT_TRAMITACAO, '%m-%d-%y') >= DATE_FORMAT(tap.DT_ENTRADA, '%m-%d-%y') AND DATE_FORMAT(t.DT_TRAMITACAO, '%m-%d-%y') <= DATE_FORMAT(IF(tap.DT_SAIDA IS NULL || tap.DT_SAIDA = '0000-00-00 00:00:00', CURDATE(), tap.DT_SAIDA), '%m-%d-%y')), tp.DT_TRAMITACAO)) periodo FROM `tb_acompanhamento_processo` tap LEFT JOIN `tb_tramitacao_processos` tp on tap.CD_SUPERINTENDENTE_RESPONSAVEL = tp.CD_SERVIDOR_DESTINO AND tap.CD_PROCESSO = tp.CD_PROCESSO WHERE DATE_FORMAT(tap.DT_ENTRADA, '%m-%d-%y') <= DATE_FORMAT(tp.DT_TRAMITACAO, '%m-%d-%y') AND DATE_FORMAT(IF(tap.DT_SAIDA IS NULL || tap.DT_SAIDA = '0000-00-00 00:00:00', CURDATE(), tap.DT_SAIDA), '%m-%d-%y') >= DATE_FORMAT(tp.DT_TRAMITACAO, '%m-%d-%y') AND tap.DT_ENTRADA <> '0000-00-00 00:00:00' AND tap.DT_ENTRADA IS NOT NULL AND tap.CD_SUPERINTENDENTE_RESPONSAVEL IS NOT NULL GROUP BY tap.ID) resumo on resumo.ID = tap2.ID SET tap2.NR_DIAS_SUPERINTENDENTE = resumo.periodo")
	or die (mysqli_error($conexao_com_banco));

	mysqli_query($conexao_com_banco, "UPDATE `tb_acompanhamento_processo` tap2 RIGHT JOIN (SELECT tap.ID, tap.CD_PROCESSO, SUM(DATEDIFF((SELECT IF(MIN(t.DT_TRAMITACAO) IS NULL OR MIN(t.DT_TRAMITACAO) = '0000-00-00 00:00:00', CURDATE(), MIN(t.DT_TRAMITACAO)) FROM `tb_tramitacao_processos` t WHERE t.CD_PROCESSO = tp.CD_PROCESSO AND t.CD_SERVIDOR_ORIGEM = tp.CD_SERVIDOR_DESTINO AND t.ID > tp.ID AND DATE_FORMAT(t.DT_TRAMITACAO, '%m-%d-%y') >= DATE_FORMAT(tap.DT_ENTRADA, '%m-%d-%y') AND DATE_FORMAT(t.DT_TRAMITACAO, '%m-%d-%y') <= DATE_FORMAT(IF(tap.DT_SAIDA IS NULL || tap.DT_SAIDA = '0000-00-00 00:00:00', CURDATE(), tap.DT_SAIDA), '%m-%d-%y')), tp.DT_TRAMITACAO)) periodo FROM `tb_acompanhamento_processo` tap LEFT JOIN `tb_tramitacao_processos` tp on tap.CD_SERVIDOR_RESPONSAVEL = tp.CD_SERVIDOR_DESTINO AND tap.CD_PROCESSO = tp.CD_PROCESSO WHERE DATE_FORMAT(tap.DT_ENTRADA, '%m-%d-%y') <= DATE_FORMAT(tp.DT_TRAMITACAO, '%m-%d-%y') AND DATE_FORMAT(IF(tap.DT_SAIDA IS NULL || tap.DT_SAIDA = '0000-00-00 00:00:00', CURDATE(), tap.DT_SAIDA), '%m-%d-%y') >= DATE_FORMAT(tp.DT_TRAMITACAO, '%m-%d-%y') AND tap.DT_ENTRADA <> '0000-00-00 00:00:00' AND tap.DT_ENTRADA IS NOT NULL AND tap.CD_SERVIDOR_RESPONSAVEL IS NOT NULL GROUP BY tap.ID) resumo on resumo.ID = tap2.ID SET tap2.NR_DIAS_TECNICO = resumo.periodo")
	or die (mysqli_error($conexao_com_banco));	
	
	
}

//chamando as funções para a execução
verifica_prazo($conexao_com_banco);
atualiza_dias($conexao_com_banco);
atualizar_acompanhamento($conexao_com_banco);

//criando uma notificação no banco para dizer que foram feitas as atualizações
mysqli_query($conexao_com_banco, "INSERT INTO notificacao (ID, TX_MENSAGEM, NM_STATUS, CD_SERVIDOR, DT_CRIADO, DT_VISUALIZADO, LINK_NOTIFICACAO) VALUES (NULL, 'Atualizações e verificações automáticas realizadas com sucesso', 'NOVA', '062.200.904-46', '$data_hoje', NULL, 'lala')") or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "INSERT INTO notificacao (ID, TX_MENSAGEM, NM_STATUS, CD_SERVIDOR, DT_CRIADO, DT_VISUALIZADO, LINK_NOTIFICACAO) VALUES (NULL, 'Atualizações e verificações automáticas realizadas com sucesso', 'NOVA', '077.036.184-62', '$data_hoje', NULL, 'lala')") or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "UPDATE `tb_atividades` SET NM_STATUS = 'VENCEU' WHERE DT_VENCIMENTO < CURDATE() AND NM_STATUS IN ('FALTA ANEXO', 'EM ANDAMENTO')") or die (mysqli_error($conexao_com_banco));

?>
