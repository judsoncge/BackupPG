<?php

include('../../banco-dados/conectar.php');

$id = $_GET['documento'];

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_numero_processo = $_POST['numero_processo']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_tipo_atividade = $_POST['tipo_atividade']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$edita_tipo_documento = $_POST['tipo_documento'];

//pegando o mês de competencia digitado pelo usuario no cadastro	
$edita_interessado = $_POST['interessado']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_data_entrada = $_POST['data_entrada']; 

//pegando o valor pago digitado pelo usuario no cadastro	
$edita_prazo = $_POST['prazo'];	

//pegando o cpf da pessoa que está cadastrando esta diária
$edita_prioridade = $_POST['prioridade']; 


include('../banco-dados/editar.php');

?>