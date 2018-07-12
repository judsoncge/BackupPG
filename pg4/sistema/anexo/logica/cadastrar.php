<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
session_start();



if(isset($_GET['comunicacao'])){
	$id = $_GET['comunicacao']; 
	cadastrar_anexo($conexao_com_banco, $id, $_FILES["arquivo_anexo"], 'COMUNICACAO');
	echo "<script>history.back();</script>";
}

?>