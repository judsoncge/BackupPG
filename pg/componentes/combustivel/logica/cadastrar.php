<?php

include('../../banco-dados/conectar.php');

session_start();

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_valor = $_POST['valor']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_placa = $_POST['placa']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_data_abastecimento = $_POST['data_abastecimento']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$novo_valor_litro = $_POST['valor_litro'];

//pegando o mês de competencia digitado pelo usuario no cadastro	
$novo_quantidade_litro = $_POST['quantidade_litro']; 

//criando um id para a diaria
$id = "COMBUSTIVEL_" . $novo_placa . $novo_data_abastecimento . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_cadastrou = $_SESSION['CPF']; 

include('../banco-dados/cadastrar.php');

?>