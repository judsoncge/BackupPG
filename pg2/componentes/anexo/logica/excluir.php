<?php

include('../../iniciar.php');

//a variavel recebe o id do anexo que se deseja excluir
$id = $_GET['id'];

//a variavel recebe o nome do anexo
$atual = $_GET['atual'];

//a variavel recebe a pasta do anexo
$pasta = $_GET['pasta'];

//a variavel recebe o caminho completo do arquivo
$atual = '../../../registros/'.$pasta.'/'.$atual;

//incluindo o código para excluir do banco de dados
include('../banco-dados/excluir.php');

?>