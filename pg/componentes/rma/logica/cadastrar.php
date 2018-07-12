<?php

include('../../banco-dados/conectar.php');

session_start();

//pegando o destino cedido digitado pelo usuario no cadastro
$novo_codigo = $_POST['codigo']; 

//pegando a data de ida da viagem digitado pelo usuario no cadastro
$novo_item = $_POST['item']; 

//pegando o horario de ida da viagem digitado pelo usuario no cadastro
$novo_medida = $_POST['medida']; 


include('../banco-dados/cadastrar.php');

?>