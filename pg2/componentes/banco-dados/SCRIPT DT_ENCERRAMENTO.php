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

$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_chamados WHERE NM_STATUS='Encerrado' and DT_ENCERRAMENTO='0000-00-00 00:00:00'") or die (mysqli_error($conexao_com_banco));

while($r = mysqli_fetch_object($resultado)){
	
	$id = $r->ID;
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT * FROM tb_historico_chamados WHERE NM_ACAO='Encerramento' and CD_CHAMADO='$id'") or die (mysqli_error($conexao_com_banco));
	
	while($r2 = mysqli_fetch_object($resultado2)){
		
		$hora = $r2->DT_MENSAGEM;
		
		mysqli_query($conexao_com_banco, "UPDATE tb_chamados SET DT_ENCERRAMENTO='$hora' WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));	
			
	}
		
}

echo "Finalizado.";




?>