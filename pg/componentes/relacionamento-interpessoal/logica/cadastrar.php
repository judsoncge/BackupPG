<?php

include('../../banco-dados/conectar.php');
include('../../../nucleo-aplicacao/retornar_dados.php');

session_start();

//pegando o cpf da pessoa que está avaliando
$novo_avaliador = $_SESSION['CPF'];
$novo_avaliado = $_POST['avaliado'];
$novo_nota = $_POST['nota'];
$novo_data_avaliacao = date('Y-m-d');


//criando um id para a diaria
$id = "AVALIACAO_" . $novo_avaliado . $novo_avaliador . $novo_data_avaliacao . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);


include('../banco-dados/cadastrar.php');

?>