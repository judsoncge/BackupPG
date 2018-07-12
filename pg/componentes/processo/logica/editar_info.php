<?php
include('../../banco-dados/conectar.php');

session_start();

$id = $_GET['processo'];

$numero_processo1 = $_POST['numero_processo1'];
$numero_processo2 = $_POST['numero_processo2'];
$numero_processo3 = $_POST['numero_processo3'];

$numero_processo_ok = $numero_processo1.' '.$numero_processo2.'/'.$numero_processo3;

if($id != $numero_processo_ok){
	$numero_processo_verificacao = $numero_processo_ok;
	//verificando no banco
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM processo WHERE numero_processo='$numero_processo_verificacao'");
	$linha = mysqli_affected_rows($conexao_com_banco);
	//se ja estiver cadastrado...
	if($linha==1){ 
		//echo "<script>history.back();</script>";
		echo "<script>alert('Um processo com este número já existe!')</script>";
		echo "<script>history.back()</script>";
		die();
	}else{
		//se ainda não estiver cadastrado, pegando o numero de empenho digitado pelo usuario no cadastro
		$edita_processo = $numero_processo_ok; 
	}
}

$edita_descricao = $_POST['descricao'];

$edita_tipo = $_POST['tipo'];

$edita_detalhes = $_POST["detalhes"];

$edita_interessado = $_POST["interessado"];

include('../banco-dados/editar_info.php');
		




?>