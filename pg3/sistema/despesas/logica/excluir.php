<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
date_default_timezone_set('America/Bahia');
session_start();

if(($_GET['operacao']=='despesa')){
	
	$id_despesa = $_GET['despesa']; 

	excluir_despesa($conexao_com_banco, $id_despesa);

	echo '<script>window.location = document.referrer + "?mensagem=A despesa e seus anexos foram excluídos com sucesso!&resultado=sucesso";</script>';
	
}


else if($_GET['operacao']=='anexo_despesa'){
	
	$id_anexo = $_GET['id'];
	
	$nome_anexo = $_GET['nome'];
	
	$id_despesa = $_GET['despesa'];
	
	$mensagem = 'EXCLUIU UM ANEXO';
	
	$pessoa = $_SESSION['CPF'];
	
	$acao = 'Anexo';
	
	excluir_anexo_despesa($conexao_com_banco, $id_anexo, $nome_anexo);
	cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);

	echo '<script>history.back();</script>';

}
?>