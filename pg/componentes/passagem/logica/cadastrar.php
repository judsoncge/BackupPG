<?php

include('../../banco-dados/conectar.php');

session_start();

//pegando o cpf do beneficário pelo usuario no cadastro
$novo_beneficiario = $_POST['beneficiario'];
	
//pegando o valor pago digitado pelo usuario no cadastro	
$novo_numero_integra = $_POST['n_processo_integra'];	

//pegando o destino cedido digitado pelo usuario no cadastro
$novo_destino = $_POST['destino']; 

//pegando a data de ida da viagem digitado pelo usuario no cadastro
$novo_data_ida = $_POST['data_ida']; 

//pegando o horario de ida da viagem digitado pelo usuario no cadastro
$novo_horario_ida = $_POST['horario_ida']; 

//pegando o horario de ida da viagem digitado pelo usuario no cadastro
$novo_valor_ida = $_POST['valor_ida']; 

//pegando a data de volta da viagem digitado pelo usuario no cadastro
$novo_data_volta = $_POST['data_volta']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_horario_volta = $_POST['horario_volta']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_valor_volta = $_POST['valor_volta']; 	

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_finalidade = $_POST['finalidade']; 	

//criando um id para a diaria
$id = "PASSAGEM_AEREA_" . $novo_beneficiario . $novo_data_ida . $novo_data_volta . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_cadastrou = $_SESSION['CPF']; 

include('../banco-dados/cadastrar.php');

?>