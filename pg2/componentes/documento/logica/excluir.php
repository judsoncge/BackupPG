<?php

include('../../banco-dados/conectar.php');

//pegando o id da diaria para fazer a exclusão
$id_documento = $_GET['documento']; 

$num = $_GET['sessionId'];

include('../banco-dados/excluir.php');

?>