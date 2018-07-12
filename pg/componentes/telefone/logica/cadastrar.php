<?php

include('../../banco-dados/conectar.php');

session_start();


//pegando o cpf do beneficário pelo usuario no cadastro
$novo_beneficiario = $_POST['beneficiario'];

//pegando o cpf do beneficário pelo usuario no cadastro
$novo_valor = $_POST['valor'];

//pegando o destino cedido digitado pelo usuario no cadastro
$novo_tipo = $_POST['tipo']; 

//pegando a data de ida da viagem digitado pelo usuario no cadastro
$novo_numero = $_POST['numero'];  	

//criando um id para a diaria
$id = "TELEFONE_" . $novo_numero . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace('(', '', $id);
$id = str_replace(')', '', $id);

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_cadastrou = $_SESSION['CPF']; 

include('../banco-dados/cadastrar.php');

?>