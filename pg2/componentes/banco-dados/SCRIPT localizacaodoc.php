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

$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE NM_STATUS!='Resolvido'") or die (mysqli_error($conexao_com_banco));

while($r = mysqli_fetch_object($resultado)){
	
	$id = $r->CD_DOCUMENTO;
	$servidor_documento = $r->CD_SERVIDOR_LOCALIZACAO;
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT CD_SETOR FROM tb_servidores WHERE CD_SERVIDOR='$servidor_documento'") or die (mysqli_error($conexao_com_banco));
	
	while($r2 = mysqli_fetch_object($resultado2)){
		
		$setor = $r2->CD_SETOR;
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SETOR_LOCALIZACAO='$setor' WHERE CD_DOCUMENTO='$id'") or die (mysqli_error($conexao_com_banco));	
			
	}
		
}

echo "Finalizado.";




?>