<?php

include('../../banco-dados/conectar.php');

//pegando o id da diaria para fazer a exclusão
$id = $_GET['documento']; 

include('../banco-dados/excluir.php');

?>