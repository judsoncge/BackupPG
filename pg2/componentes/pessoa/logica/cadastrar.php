<?php

include('../../iniciar.php');

//verificando se o CPF já está cadastrado no banco, pois não pode haver dois valores iguais
$cpf_verificacao = $_POST['CPF'];
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$cpf_verificacao'");
$linha = mysqli_affected_rows($conexao_com_banco);
//se ja estiver cadastrado...
if($linha==1){ 
	echo "<script>history.back();</script>";
	echo "<script>alert('Este CPF já está cadastrado. Tente outro')</script>";
	die();
}else{
	//se ainda não estiver cadastrado, pegando o cpf digitado pelo usuario no cadastro
	$novo_CPF = $_POST['CPF']; 
}

//verificando se a senha digitada pelo usuário é a mesma do campo confirma senha
$v_senha = $_POST['senha'];
$v_confirma_senha = $_POST['confirma-senha'];
//se não for igual...
if($v_senha != $v_confirma_senha){ 
	echo "<script>alert('Senhas não correspondem!')</script>";
	echo "<script>history.back();</script>";
	die();
	//se for igual...
}else{ 
	$novo_senha = md5($_POST['senha']); 
}

//pegando o nome digitado pelo usuario no cadastro	
$novo_nome = $_POST['nome'];	

//pegando o nome digitado pelo usuario no cadastro	
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

$num = $_GET['sessionId'];

include('../banco-dados/cadastrar.php');

?>