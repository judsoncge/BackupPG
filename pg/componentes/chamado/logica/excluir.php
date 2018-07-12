<?php

include('../../banco-dados/conectar.php');

//pegando o id do anexo para fazer a exclusão
$id = $_GET['id']; 

include('../banco-dados/excluir.php');

?>