<?php

include('../../banco-dados/conectar.php');

$pessoa = $_GET['pessoa'];

$edita_nova_senha = $_POST['nova_senha']; 

$edita_confirma_nova_senha = $_POST['confirma_senha']; 

if($edita_nova_senha != $edita_confirma_nova_senha){
	echo "<script>history.back();</script>";
	echo "<script>alert('A nova senha e a confirmação estão diferentes. Digite-as novamente.')</script>"; 
}else{
	$edita_nova_senha = md5($edita_nova_senha);
	include('../banco-dados/editar_senha.php');
}


?>