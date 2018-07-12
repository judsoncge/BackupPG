<?php


include("../banco-dados/conectar.php");

//include("../../nucleo-aplicacao/verifica_dados.php");
 
$CPF = $_POST['CPF'];
$senha = md5($_POST['senha']);

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$CPF' AND SENHA='$senha'");

while($result = mysqli_fetch_array($retornoquery)){
	$cpf = $result['CD_SERVIDOR'];
	$nome = $result['NM_SERVIDOR'];
	$sobrenome = $result['SNM_SERVIDOR'];
	$foto = $result['NM_ARQUIVO_FOTO'];
	$setor = $result['CD_SETOR'];
	$cargo = $result['NM_CARGO'];
}


$linha = mysqli_affected_rows($conexao_com_banco);

if($linha>0){
	$num = rand(100000,900000);
	session_start();
	$_SESSION['numLogin']=$num;
	$_SESSION['nome']=$nome;
	$_SESSION['CPF']=$cpf;
	$_SESSION['foto']=$foto;
	$_SESSION['setor']=$setor;
	$_SESSION['sobrenome']=$sobrenome;
	$_SESSION['cargo']=$cargo;
	
	//verifica_prazo($conexao_com_banco);
	//verifica_prazo_final($conexao_com_banco);
	//atualiza_dias($conexao_com_banco);

	header("Location:../../interface/home.php?sessionId=$num");
}else{
	header("Location:../../index.php?mensagem=Falha");
}

?>