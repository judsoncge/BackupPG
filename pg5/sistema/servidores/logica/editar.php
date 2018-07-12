<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
session_start();

if($_GET["operacao"]=="info"){
	
	//verificando se o CPF já está cadastrado no banco, pois não pode haver dois valores iguais
	$CPF = $_POST['CPF'];

	if($_GET['CPF'] != $CPF){
		$existe_servidor = existe_servidor($conexao_com_banco, $CPF);  
		
		if($existe_servidor==true){
			echo "<script>history.back();</script>";
			echo "<script>alert('Este CPF já está cadastrado. Tente outro')</script>";
			die();
		}
	}
	
	$nome = $_POST['nome'];	

	$funcao = $_POST['funcao']; 

	$setor = $_POST['setor']; 
	
	$id = $_GET['id'];

	editar_servidor($conexao_com_banco, $nome, $CPF, $funcao, $setor, $id);
	
	if($setor != $_GET['setor']){
		liberar_processos_servidor($id, $conexao_com_banco);
	}
	
	

	Header("Location:../listar-ativos.php?mensagem=Operação realizada com sucesso!&resultado=sucesso");
	
}elseif($_GET["operacao"]=="foto"){
	
	//pegando o id de registro do servidor para editar
	$id = $_SESSION['id'];
	
	//pegando o arquivo
	$file = $_FILES['arquivo_foto'];
	
	//pegando o caminho que será gravado o arquivo da foto selecionada
	$caminho = "../../../registros/fotos/";
	
	$nome_arquivo = cadastrar_anexo($file, $caminho);
	
	if($_SESSION["foto"]!= "default.jpg"){
		unlink($caminho.$_SESSION["foto"]);
	
	}

	editar_foto_servidor($conexao_com_banco, $nome_arquivo, $id);
	
	$_SESSION["foto"] = $nome_arquivo;
	
	Header("Location:../../home.php?mensagem=Editado com sucesso!&resultado=sucesso");
	
}elseif($_GET["operacao"]=="senha"){
	
	//pegando o id de registro do servidor para editar
	$id = $_SESSION['id'];
	
	//pegando a nova senha digitada pelo usuario
	$senha = $_POST["senha"];
	
	//pegando a confirmação de senha digitada pelo usuario
	$confirma_senha = $_POST["confirma_senha"];
	
	if($senha == $confirma_senha){
		editar_senha_servidor($conexao_com_banco, md5($senha), $id);
		Header("Location:../../home.php?mensagem=Editado com sucesso!&resultado=sucesso");
	
	}else{
		Header("Location:../editar-senha.php?mensagem=As senhas não correspondem!&resultado=falha");
	}

}elseif($_GET["operacao"]=="status"){
	
	//pegando o status para ser modificado
	$status = $_GET['status'];
	
	//pegando o id do usuario a ser modificado
	$id = $_GET["id"];
	
	editar_status_servidor($conexao_com_banco, $status, $id);
	
	//se for inativado, os processos que estao com ele ficam sem ninguém
	if($status == "INATIVO"){
		liberar_processos_servidor($id, $conexao_com_banco);
	}
	
	Header("Location:../listar-ativos.php?mensagem=Operação realizada com sucesso!&resultado=sucesso");

}		
?>