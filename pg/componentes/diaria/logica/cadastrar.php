<?php

include('../../banco-dados/conectar.php');
include('../../../nucleo-aplicacao/retornar_dados.php');

session_start();

//pegando o cpf do beneficário pelo usuario no cadastro
$novo_beneficiario = $_POST['beneficiario'];	

//pegando o tipo digitado pelo usuario no cadastro
$novo_tipo = $_POST['tipo'];	

//pegando o numero da portaria digitado pelo usuario no cadastro
$novo_portaria = $_POST['portaria']; 

//pegando a data da publicação da portaria digitada pelo usuario no cadastro
$novo_data_portaria = $_POST['data_portaria']; 

//pegando o destino cedido digitado pelo usuario no cadastro
$novo_destino = $_POST['destino']; 

//pegando a data de ida da viagem digitado pelo usuario no cadastro
$novo_data_ida = $_POST['data_ida']; 

//pegando a data de volta digitado pelo usuario no cadastro
$novo_data_volta = $_POST['data_volta']; 

//pegando a data de volta digitado pelo usuario no cadastro
$novo_valor = $_POST['valor']; 

//pegando o numero de diarias digitado pelo usuario no cadastro
$novo_n_diarias = $_POST['n_diarias']; 

//criando um id para a diaria
$id = "DIARIA_" . $novo_beneficiario . $novo_data_ida . $novo_data_volta . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_cadastrou = $_SESSION['CPF']; 

include('../banco-dados/cadastrar.php');

?>