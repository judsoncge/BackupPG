<?php

include('../../banco-dados/conectar.php');

//pegando o numero de empenho para fazer a atualização
$id = $_GET['id']; 

//pegando o cpf do beneficiario digitado pelo usuario na edição
$edita_beneficiario = $_POST['beneficiario'];	

//pegando o tipo digitado pelo usuario na edição
$edita_tipo = $_POST['tipo'];	

//pegando o numero da portaria digitado pelo usuario na edição
$edita_portaria = $_POST['portaria']; 

//pegando a data de publicação da portaria digitada pelo usuario na edição
$edita_data_portaria = $_POST['data_portaria']; 

//pegando o destino digitado pelo usuario na edição
$edita_destino = $_POST['destino']; 

//pegando a data de ida digitada pelo usuario na edição
$edita_data_ida = $_POST['data_ida']; 

//pegando a data de volta digitada pelo usuario na edição
$edita_data_volta = $_POST['data_volta']; 

//pegando o numero de diarias digitado pelo usuario na edição
$edita_n_diarias = $_POST['n_diarias']; 

//pegando o valor das diarias digitado pelo usuario na edição
$edita_valor = $_POST['valor']; 

include('../banco-dados/editar.php');
?>