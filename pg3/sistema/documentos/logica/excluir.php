<?php
include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
date_default_timezone_set('America/Bahia');
session_start();

if($_GET['operacao']=='documento'){
	$id_documento = $_GET['documento']; 

	excluir_documento($conexao_com_banco, $id_documento);

	echo '<script>window.location = document.referrer + "?mensagem=O documento e seus anexos foram excluídos com sucesso!&resultado=sucesso";</script>';
}

else if($_GET['operacao']=='anexo_documento'){

	$id_anexo = $_GET['id'];
	
	$nome_anexo = $_GET['nome'];
	
	$id_documento = $_GET['documento'];
	
	$mensagem = 'EXCLUIU UM ANEXO';
	
	$pessoa = $_SESSION['CPF'];
	
	$acao = 'Anexo';
	
	excluir_anexo_documento($id_anexo, $conexao_com_banco);
	cadastrar_historico_documento($conexao_com_banco, $id_documento, $mensagem, $pessoa, '' , $acao);

	echo '<script>history.back();</script>';

}
?>