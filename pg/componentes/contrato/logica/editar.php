<?php

include('../../banco-dados/conectar.php');

session_start();


$id = $_GET['id']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_valor = $_POST['valor']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$edita_numero_contrato = $_POST['numero_contrato'];
	
//pegando o valor pago digitado pelo usuario no cadastro	
$edita_contratado = $_POST['contratado'];	

//pegando o destino cedido digitado pelo usuario no cadastro
$edita_cnpj_contratado = $_POST['cnpj_contratado']; 

//pegando a data de ida da viagem digitado pelo usuario no cadastro
$edita_status_prorrogavel = $_POST['status_prorrogavel']; 

//pegando o horario de ida da viagem digitado pelo usuario no cadastro
$edita_objeto_contrato = $_POST['objeto_contrato']; 

//pegando a data de volta da viagem digitado pelo usuario no cadastro
$edita_data_inicio_publicacao = $_POST['data_inicio_publicacao']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$edita_data_termino_publicacao = $_POST['data_termino_publicacao']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$edita_vinculacao = $_POST['vinculacao']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$edita_numero_contrato_siafem = $_POST['numero_contrato_siafem']; 

//pegando o cpf da pessoa que está cadastrando esta diária
$edita_cadastrou = $_SESSION['CPF']; 

include('../banco-dados/editar.php');

?>