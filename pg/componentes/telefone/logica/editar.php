<?php

include('../../banco-dados/conectar.php');

session_start();

//se ainda não estiver cadastrado, pegando o numero de empenho digitado pelo usuario no cadastro
$id = $_GET['id']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$edita_valor = $_POST['valor'];

//pegando o cpf do beneficário pelo usuario no cadastro
$edita_beneficiario = $_POST['beneficiario'];
	
include('../banco-dados/editar.php');

?>