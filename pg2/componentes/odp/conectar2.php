<?php
//conecta-se com o banco de dados
//servidor para conexão com o banco de dados
$servidor_banco = 'localhost';
//usuario para conexão com o banco de dados
$usuario_banco = 'root'; 
//senha para conexão com o banco de dados           
$senha_banco2 = '';       
//nome do banco de dados         
$nome_banco2 = 'odp';  

//conectando ao banco de dados ou mostra erro caso não consiga conectar
$conexao_com_banco2 = mysqli_connect($servidor_banco, $usuario_banco, $senha_banco2, $nome_banco2) or die(mysqli_error($nome_banco2));

mysqli_query($conexao_com_banco2, "SET NAMES 'utf8'");
mysqli_query($conexao_com_banco2, 'SET character_set_connection=utf8');
mysqli_query($conexao_com_banco2, 'SET character_set_client=utf8');
mysqli_query($conexao_com_banco2, 'SET character_set_results=utf8');

?>