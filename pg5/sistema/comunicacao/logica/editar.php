<?php
include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

if($_GET['operacao']=='info'){

	$chapeu = addslashes($_POST["chapeu"]);

	$titulo = addslashes($_POST["titulo"]);

	$intertitulo = addslashes($_POST["intertitulo"]);

	$creditos = addslashes($_POST["creditos"]);

	$texto = addslashes($_POST["texto"]);

	$data_publicacao = $_POST["data_publicacao"];
	
	$id = $_GET['id'];

	editar_comunicacao($conexao_com_banco, $chapeu, $titulo, $intertitulo, $creditos, $texto, $data_publicacao, $id);
	
	header("Location:../detalhes.php?id=$id&mensagem=As informações foram atualizadas com sucesso!&resultado=sucesso");
}

elseif($_GET['operacao']=='status'){
	
	$id = $_GET['id'];
	
	$status = $_GET['status'];	
		
	editar_status_comunicacao($conexao_com_banco, $id, $status);
	 
	header("Location:../detalhes.php?id=$id&mensagem=Operação realizada com sucesso!&resultado=sucesso");

} 

elseif($_GET['operacao']=='info_imagem'){
	
	$id = $_GET['id'];

	$legenda = $_POST['legenda_editar'];
	
	$creditos = $_POST['creditos_editar'];
	
	$pequena = $_POST['pequena_editar'];
	
	if($_FILES['imagem_editar']['tmp_name'] != ''){
		
		$caminho = "../../../registros/fotos-noticias/";
		
		$nome_anexo = cadastrar_anexo($_FILES['imagem_editar'], $caminho);
		
		unlink($caminho.$_GET['anexo_atual']);
		
	}else{
		
		$nome_anexo = $_GET['anexo_atual'];
		
	}
	
	editar_imagem_comunicacao($conexao_com_banco, $nome_anexo, $legenda, $creditos, $pequena, $id);
	
	echo '<script>history.back();</script>';
}

elseif($_GET['operacao']=='excluir_anexo'){
	
	$id = $_GET['id']; 
	
	$caminho = $_GET['caminho'];
	
	excluir_anexo_comunicacao($conexao_com_banco, $id);	
	
	unlink($caminho);
	
	echo '<script>history.back();</script>';
}

elseif($_GET['operacao']=='adicionar_anexo'){
	
	$id = $_GET['id'];
	
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
	
	echo '<script>history.back();</script>';
}





?>