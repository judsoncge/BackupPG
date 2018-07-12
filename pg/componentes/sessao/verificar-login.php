<?php

//incluindo a classe conexão para conectar ao banco de dados antes de cadastrar
include("../banco-dados/conectar.php");
 
//pegando os valores das variáveis da página que solicitou login
$CPF = $_POST['CPF'];
$senha = md5($_POST['senha']); //encriptando a senha

//consulta para gravar os valores no banco de dados e gravar o resultado da query
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM pessoa WHERE CPF='$CPF' AND senha='$senha'");

//pegando as informações do usuário para mostrar na página de logado
while($result = mysqli_fetch_array($retornoquery)){
	$cpf = $result['CPF'];
	$nome = $result['nome'];
	$foto = $result['foto'];
	$setor = $result['setor'];
	$cargo = $result['cargo'];
	$sobrenome = $result['sobrenome'];
}

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);

//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>0){
	$num = rand(100000,900000);
	session_start();
	$_SESSION['numLogin']=$num;
	$_SESSION['nome']=$nome;
	$_SESSION['CPF']=$cpf;
	$_SESSION['foto']=$foto;
	$_SESSION['setor']=$setor;
	$_SESSION['cargo']=$cargo;
	$_SESSION['sobrenome']=$sobrenome;

	header("Location:../../interface/todas.php?sessionId=$num");
	//se nenhuma linha foi modificada, é porque houve algum problema
}else{
	echo "<script>history.back();</script>";
	echo "<script>alert('CPF ou senha inválidos. Tente novamente.')</script>";
}

?>