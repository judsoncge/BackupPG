<?php

include('../../banco-dados/conectar.php');

//pegando o numero de empenho para fazer a atualização
$edita_empenho = $_GET['empenho']; 

//pegando o tipo digitado pelo usuario na edição
$edita_ordem_bancaria = $_POST['bancaria'];	

date_default_timezone_set('America/Bahia');
$edita_data_pagamento = date('Y-m-d');

include('../banco-dados/editar.php');
?>