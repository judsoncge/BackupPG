<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
session_start();
	
//verificando se o CPF já está cadastrado no banco, pois não pode haver dois valores iguais
$CPF = $_POST['CPF'];

$existe_servidor = existe_servidor($conexao_com_banco, $CPF);  

if($existe_servidor==true){ 
	echo "<script>alert('Este CPF já está cadastrado. Tente outro')</script>";
	echo "<script>history.back();</script>";
	die();
}

$nome = $_POST['nome'];	

$funcao = $_POST['funcao']; 

$setor = $_POST['setor']; 

cadastrar_servidor($conexao_com_banco, $nome, $CPF, $funcao, $setor);

Header("Location:../listar-ativos.php?mensagem=Cadastrado(a) com sucesso!&resultado=sucesso");





?>