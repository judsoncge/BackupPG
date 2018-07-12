<?php

ini_set('max_execution_time', 100000);

$servidor_banco = 'localhost';
$usuario_banco = 'root';       
$senha_banco = 'cgeagt';       
$nome_banco = 'pg';  

$conexao_com_banco = mysqli_connect($servidor_banco, $usuario_banco, $senha_banco, $nome_banco) or die(mysqli_error($nome_banco));

mysqli_query($conexao_com_banco, "SET NAMES 'utf8'");
mysqli_query($conexao_com_banco, 'SET character_set_connection=utf8');
mysqli_query($conexao_com_banco, 'SET character_set_client=utf8');
mysqli_query($conexao_com_banco, 'SET character_set_results=utf8');

$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM `tb_processos` WHERE LENGTH(cd_processo) >= 16");

while($r = mysqli_fetch_object($resultado)){

	$numero_antigo = $r->CD_PROCESSO;
	
	$numero_para_atualizar = $numero_antigo;
	
	$numero_antigo = trim($numero_antigo, " ");
	
	$numero_antigo = trim($numero_antigo, " ");
	
	$numero_antigo = str_replace('/', ' ', $numero_antigo);
	
	$numero_separado = explode(' ', $numero_antigo);
	
	$primeira = (int) $numero_separado[0];
	$segunda = (int) $numero_separado[1];
	$terceira = (int) $numero_separado[2];
	
	$novo_numero = $primeira . " " . $segunda . "/" . $terceira;
	
	echo "Antes: " . $numero_antigo . "<br>";
	
	echo "Depois: " . $novo_numero . "<br><br>";
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_PROCESSO='$novo_numero' WHERE CD_PROCESSO='$numero_para_atualizar'") or die(mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_historico_processos SET CD_PROCESSO='$novo_numero' WHERE CD_PROCESSO='$numero_para_atualizar'") or die(mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_tramitacao_processos SET CD_PROCESSO='$novo_numero' WHERE CD_PROCESSO='$numero_para_atualizar'") or die(mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET CD_PROCESSO='$novo_numero' WHERE CD_PROCESSO='$numero_para_atualizar'") or die(mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$novo_numero' WHERE CD_PROCESSO='$numero_para_atualizar'") or die(mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_acompanhamento_processo SET CD_PROCESSO='$novo_numero' WHERE CD_PROCESSO='$numero_para_atualizar'") or die(mysqli_error($conexao_com_banco));
	
	echo "Terminou com sucesso!<br>";
	
}




?>