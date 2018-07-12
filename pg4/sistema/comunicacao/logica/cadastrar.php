<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

$novo_item = $_POST["item"];

$novo_titulo = $_POST["titulo"];

$novo_texto = $_POST["texto"];

$novo_data_publicacao = $_POST["data_publicacao"];

if ($novo_data_publicacao == null) {
    $novo_data_publicacao =  date('Y-m-d H:i:s');
}


$id_comunicacao = cadastrar_comunicacao($conexao_com_banco, $novo_item, $novo_titulo, $novo_texto, $novo_data_publicacao);
$i = 0;



foreach ($_FILES["imagem"]["error"] as $key => $error) {
	
	$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png'); 
	
	$arqType = $_FILES['imagem']['type'][$i];
	
	if (array_search($arqType,$tipos) === false) { 
		echo "
		<script type='text/javascript'>
		alert('Formato inválido');
		</script>
		";	
	}
	
}
	
cadastrar_anexos($conexao_com_banco, $id_comunicacao, $_FILES['imagem'], 'COMUNICACAO');	
	
header("Location:../listar.php?mensagem=A notícia foi cadastrada com sucesso!&resultado=sucesso");






?>