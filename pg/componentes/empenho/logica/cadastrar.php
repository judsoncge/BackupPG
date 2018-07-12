<?php

include('../../banco-dados/conectar.php');

session_start();



//verificando se já existe diária cadastrada com o mesmo número de empenho digitado pelo usuário
$empenho_verificacao = $_POST['empenho'];
//verificando no banco
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM empenho WHERE numero_empenho='$empenho_verificacao'");
$linha = mysqli_affected_rows($conexao_com_banco);
//se ja estiver cadastrado...
if($linha==1){ 
	echo "<script>history.back();</script>";
	echo "<script>alert('Este empenho já está cadastrado. Tente outro')</script>";
	die();
}else{
	//se ainda não estiver cadastrado, pegando o numero de empenho digitado pelo usuario no cadastro
	$novo_empenho = $_POST['empenho']; 
}

//verificando se já existe diária cadastrada com o mesmo número de empenho digitado pelo usuário
$valor_verificacao = $_GET['valor'];
$novo_valor_empenhado = $_POST['valor'];

if($valor_verificacao < $novo_valor_empenhado){ 
	echo "<script>history.back();</script>";
	echo "<script>alert('O valor do empenho deve ser igual ou menor ao valor cadastrado')</script>";
	die();
}else{
	$novo_valor_empenhado = $_POST['valor'];
}

//pegando o tipo digitado pelo usuario no cadastro
$novo_id_despesa = $_GET['despesa'];	

//pegando o tipo digitado pelo usuario no cadastro
date_default_timezone_set('America/Bahia');
$novo_data_empenho = date('Y-m-d');

//pegando o tipo digitado pelo usuario no cadastro
$novo_valor_empenhado = $_POST['valor'];	

include('../banco-dados/cadastrar.php');

?>