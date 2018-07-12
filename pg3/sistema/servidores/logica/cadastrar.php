<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
session_start();

//verificando se o CPF já está cadastrado no banco, pois não pode haver dois valores iguais
$novo_CPF = $_POST['CPF'];

$existe_servidor = existe_servidor($conexao_com_banco, $novo_CPF);  

if($existe_servidor==true){ 
	echo "<script>history.back();</script>";
	echo "<script>alert('Este CPF já está cadastrado. Tente outro')</script>";
	die();
}

//verificando se a senha digitada pelo usuário é a mesma do campo confirma senha
$novo_senha = $_POST['senha'];

$confirma_senha = $_POST['confirma-senha'];

//se não for igual...

if($novo_senha != $confirma_senha){ 
	echo "<script>alert('Senhas não correspondem!')</script>";
	echo "<script>history.back();</script>";
	die();
}

$novo_senha = MD5($novo_senha);

//pegando o nome digitado pelo usuario no cadastro	
$novo_nome = $_POST['nome'];	

//pegando o sobrenome digitado pelo usuario no cadastro	
$novo_sobrenome = $_POST['sobrenome'];	

//pegando a situação funcional digitado pelo usuario no cadastro
$novo_situacao_funcional = $_POST['situacao-funcional'];

//pegando o nivel digitado pelo usuario no cadastro	
$novo_nivel = $_POST['nivel']; 

//pegando a graduação digitado pelo usuario no cadastro
$novo_graduacao = $_POST['graduacao']; 

//pegando a nomeação digitada pelo usuario no cadastro
$novo_nomeacao = $_POST['nomeacao'];	

//pegando email digitado pelo usuario no cadastro
$novo_email_institucional = $_POST['email_institucional']; 

//pegando o setor digitado pelo usuario no cadastro
$novo_setor = $_POST['setor'];

//pegando o grupo digitado pelo usuario no cadastro	
$novo_grupo = $_POST['grupo'];  

//pegando o salário digitado pelo usuario no cadastro
$novo_salario = $_POST['salario']; 

//pegando o orgao cedido digitado pelo usuario no cadastro
$novo_cedido_por = $_POST['cedido_por']; 

//pegando a matrícula digitada pelo usuario no cadastro
$novo_matricula = $_POST['matricula']; 

//pegando o cargo digitado pelo usuario no cadastro
$novo_cargo = $_POST['cargo']; 

cadastrar_servidor($conexao_com_banco, $novo_cargo, $novo_setor,$novo_nivel,$novo_grupo,$novo_salario,$novo_nome, $novo_sobrenome , $novo_nomeacao,$novo_situacao_funcional,$novo_CPF, $novo_email_institucional ,$novo_matricula, $novo_cedido_por ,$novo_graduacao, $novo_senha);

echo '<script>history.back();</script>';
echo '<script>history.back();</script>';


?>