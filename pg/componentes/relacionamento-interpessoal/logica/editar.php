<?php

include('../../banco-dados/conectar.php');

//pegando o numero de empenho para fazer a atualização
$id = $_GET['id']; 

//pegando as variáveis do form
$edita_nota = $_POST['nota'];
$edita_data_avaliacao = date('Y-m-d');

include('../banco-dados/editar.php');
?>