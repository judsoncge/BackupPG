<?php

include('../../banco-dados/conectar.php');

session_start();

$id = $_GET['id'];

//pegando o cpf do beneficário pelo usuario no cadastro
$edita_beneficiario = $_POST['beneficiario'];
	
//pegando o valor pago digitado pelo usuario no cadastro	
$edita_numero_integra = $_POST['n_processo_integra'];	

//pegando o destino cedido digitado pelo usuario no cadastro
$edita_destino = $_POST['destino']; 

//pegando a data de ida da viagem digitado pelo usuario no cadastro
$edita_data_ida = $_POST['data_ida']; 

//pegando o horario de ida da viagem digitado pelo usuario no cadastro
$edita_horario_ida = $_POST['horario_ida']; 

//pegando o horario de ida da viagem digitado pelo usuario no cadastro
$edita_valor_ida = $_POST['valor_ida']; 

//pegando a data de volta da viagem digitado pelo usuario no cadastro
$edita_data_volta = $_POST['data_volta']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$edita_horario_volta = $_POST['horario_volta']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$edita_valor_volta = $_POST['valor_volta']; 	

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$edita_finalidade = $_POST['finalidade']; 	

//pegando o ano da diária de acordo com o ano atual 
date_default_timezone_set('America/Bahia');
$edita_ano =  date('Y');

include('../banco-dados/editar.php');

?>