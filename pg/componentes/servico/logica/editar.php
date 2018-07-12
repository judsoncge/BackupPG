<?php

include('../../banco-dados/conectar.php');

session_start();

$id = $_GET['id']; 

$edita_tipo = $_POST['tipo'];

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_valor = $_POST['valor']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$edita_credor = $_POST['credor'];

include('../banco-dados/editar.php');

?>