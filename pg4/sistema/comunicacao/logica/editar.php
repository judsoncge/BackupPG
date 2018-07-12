<?php
include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

if($_GET['operacao']=='info'){

	$comunicacao = $_GET['comunicacao'];

	$item = $_POST["item"];

	$titulo = $_POST["titulo"];

	$texto = $_POST["texto"];

	$data_publicacao = $_POST["data_publicacao"];

	if ($edita_data_publicacao == null){
		$edita_data_publicacao =  date('Y-m-d H:i:s');
	}

	editar_comunicacao($conexao_com_banco, $comunicacao, $item, $titulo, $texto, $data_publicacao);
	
	header("Location:../comunicacao.php?mensagem=As informações foram atualizadas com sucesso!&resultado=sucesso");
}

else if($_GET['operacao']=='status'){
	
	$comunicacao = $_GET['id'];
	
	$status = $_GET['status'];	
		
	editar_status_comunicacao($conexao_com_banco, $comunicacao, $status);
	 
	if ($status=='Submetida') {
		header("Location:../comunicacao.php?mensagem=A notícia foi publicada para todos!&resultado=info");
	} else if ($status=='Aberta') {
		header("Location:../comunicacao.php?mensagem=A notícia não está publicada&resultado=info");
	} else if ($status=='Excluída'){
		header("Location:../comunicacao.php?mensagem=A notícia foi ocultada mas está gravada no banco de dados!&resultado=info");
	}

} else if($_GET['operacao']=='anexo'){
	
	$id_comunicacao = $_GET['comunicacao']; 
	
	cadastrar_anexo($conexao_com_banco, $id_comunicacao, $_FILES['arquivo_anexo'], 'COMUNICACAO');	
	
	echo '<script>history.back();</script>';
}


?>