<?php

include('../../banco-dados/conectar.php');

session_start();

$novo_tipo = $_POST['tipo'];

//pegando o cpf do beneficário pelo usuario no cadastro
$novo_credor = $_POST['credor'];

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_valor = $_POST['valor']; 

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_cadastrou = $_SESSION['CPF']; 

//criando um id para a diaria
$id = "SERVICO_" . $novo_tipo . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);

include('../banco-dados/cadastrar.php');

?>