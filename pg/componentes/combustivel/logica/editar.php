<?php

include('../../banco-dados/conectar.php');

$id = $_GET['id']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_valor = $_POST['valor']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_placa = $_POST['placa']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_data_abastecimento = $_POST['data_abastecimento']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$edita_valor_litro = $_POST['valor_litro'];

//pegando o mês de competencia digitado pelo usuario no cadastro	
$edita_quantidade_litro = $_POST['quantidade_litro']; 

include('../banco-dados/editar.php');

?>