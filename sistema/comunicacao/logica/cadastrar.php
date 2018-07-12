<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

$chapeu = addslashes($_POST["chapeu"]);

$titulo = addslashes($_POST["titulo"]);

$intertitulo = addslashes($_POST["intertitulo"]);

$creditos_texto = addslashes($_POST["creditos_texto"]);

$texto = addslashes($_POST["texto"]);

$data_publicacao = $_POST["data_publicacao"];

$id = cadastrar_comunicacao($conexao_com_banco, $chapeu, $titulo, $intertitulo, $creditos_texto, $texto, $data_publicacao);

$files    = $_FILES["imagens"];

$legendas = $_POST["legendas"];

$creditos = $_POST["creditos"];

$pequenas = $_POST['pequenas'];


foreach ($files["error"] as $key => $error){

	$nome_anexo = $files['name'][$key];
		
	$nome_anexo = retira_caracteres_especiais($nome_anexo);	

	$caminho = "../../../registros/fotos-noticias/";
		
	if(file_exists($caminho.$nome_anexo)){ 
		$a = 1;
		while(file_exists($caminho."[$a]".$nome_anexo."")){
		$a++;
		}
		$nome_anexo = "[".$a."]".$nome_anexo;
	}
	if(!move_uploaded_file($files['tmp_name'][$key], $caminho.$nome_anexo)){ 
	}
	
	$legenda = addslashes($legendas[$key]);
	
	$credito = addslashes($creditos[$key]);
	
	$pequena = $pequenas[$key];
	  
	adicionar_imagem_comunicacao($conexao_com_banco, $id, $legenda, $credito, $pequena, $nome_anexo);	
}
	
header("Location:../detalhes.php?id=$id&mensagem=A notícia foi cadastrada com sucesso!&resultado=sucesso");

?>