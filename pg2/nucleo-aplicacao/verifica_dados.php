<?php

ini_set('max_execution_time', 1000);

date_default_timezone_set('America/Bahia');

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

function atualiza_dias($conexao_com_banco){
	
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NR_DIAS=DATEDIFF(CURDATE(), DT_ENTRADA) WHERE NM_STATUS!='Arquivado'
		and NM_STATUS!='Saiu'");
	
}

function verifica_caixa($conexao_com_banco){
	
	$ano = date('Y');
	
	$search = mysqli_query($conexao_com_banco, "SELECT * FROM tb_caixa WHERE NR_ANO = '$ano'");
	
	if(mysqli_num_rows($search) == 0){
		for($i=1;$i<13;$i++){
			mysqli_query($conexao_com_banco, "INSERT INTO tb_caixa VALUES ('A', '$ano', '$i', '0')");
		}		
	}
}

function atualiza_caixa($conexao_com_banco){
	
	$ano = date('Y');
	
	$mes = date('m');
	
	for($i=1;$i<=$mes;$i++){

		$saldo = retorna_saldo($i, $ano, $conexao_com_banco);
			
		mysqli_query($conexao_com_banco, "UPDATE tb_caixa SET VLR_CAIXA='$saldo' WHERE NR_MES='$i' and NR_ANO='$ano'");
		
	}

}
?>