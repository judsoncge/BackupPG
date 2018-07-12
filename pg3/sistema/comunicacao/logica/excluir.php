<?php


include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

if($_GET['operacao']=='excluir'){

	$id = $_GET['id'];
	
	excluir_anexos_comunicacao($id, $conexao_com_banco);
	
	remover_comunicacao($conexao_com_banco, $id);
	
	header("Location:../comunicacao.php?mensagem=Comunicação removida!&resultado=sucesso");

} else if($_GET['operacao']=='anexo_comunicacao'){

	$id_anexo = $_GET['id'];

	excluir_anexo_comunicacao($_GET['id'], $conexao_com_banco);

	echo '<script>history.back();</script>';

}


?>