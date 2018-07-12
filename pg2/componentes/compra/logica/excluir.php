<?php

include('../../banco-dados/conectar.php');

//pegando o id do chamado para fazer a exclusão
$id = $_GET['chamado']; 

//a variavel recebe o numero de sessao atual
$num = $_GET['sessionId'];

//incluindo o código para excluir do banco de dados
include('../banco-dados/excluir.php');

?>