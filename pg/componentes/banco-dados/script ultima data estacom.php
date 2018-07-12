<?php

//conecta-se com o banco de dados
//servidor para conexão com o banco de dados
$servidor_banco = 'localhost';
//usuario para conexão com o banco de dados
$usuario_banco = 'root'; 
//senha para conexão com o banco de dados           
$senha_banco = 'cgeagt';       
//nome do banco de dados         
$nome_banco = 'pg';  



//conectando ao banco de dados ou mostra erro caso não consiga conectar
$conexao_com_banco = mysqli_connect($servidor_banco, $usuario_banco, $senha_banco, $nome_banco) or die(mysqli_error($nome_banco));

mysqli_query($conexao_com_banco, "SET NAMES 'utf8'");
mysqli_query($conexao_com_banco, 'SET character_set_connection=utf8');
mysqli_query($conexao_com_banco, 'SET character_set_client=utf8');
mysqli_query($conexao_com_banco, 'SET character_set_results=utf8');

$query = "SELECT * from processo WHERE estacom!='Ninguém'";			
	
$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));

while($r = mysqli_fetch_object($resultado)){
	
	$numero_processo = $r -> numero_processo;
	
	echo "Iniciando o script para o processo: ".$numero_processo."<br>";
	
	$query2 = "SELECT destino FROM tramitacao_processo WHERE data_tramitacao in (select max(data_tramitacao) 
	from tramitacao_processo where Processo_numero='$numero_processo') and Processo_numero = '$numero_processo'";			
	
	$resultado2 = mysqli_query($conexao_com_banco, $query2) or die (mysqli_error($conexao_com_banco));
	
	$destino = mysqli_fetch_row($resultado2);
	
	$destino_certo = $destino[0];
	
	echo "O destino correto do processo: ".$numero_processo." agora é: ".$destino_certo."<br>"; 
	
	$query3 = "UPDATE processo SET estacom='$destino_certo' WHERE numero_processo='$numero_processo'";			
	
	$resultado3 = mysqli_query($conexao_com_banco, $query3) or die (mysqli_error($conexao_com_banco));
	
	echo "Finalizado para o processo: ".$numero_processo. "<br><br>";
	
	}
		

?>