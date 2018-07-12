<?php

include('../../banco-dados/conectar.php');
include('../../../nucleo-aplicacao/retornar_dados.php');

session_start();

//pegando as variáveis do form
$novo_avaliado = $_POST['avaliado'];
$novo_ass1 = $_POST['ass1'];
$novo_ass2 = $_POST['ass2'];
$novo_ass_result = $_POST['ass_result'];
$novo_cum1 = $_POST['cum1'];
$novo_cum2 = $_POST['cum2'];
$novo_cum_result = $_POST['cum_result'];
$novo_leg1 = $_POST['leg1'];
$novo_leg2 = $_POST['leg2'];
$novo_leg_result = $_POST['leg_result'];
$novo_word1 = $_POST['word1'];
$novo_word2 = $_POST['word2'];
$novo_word_result = $_POST['word_result'];
$novo_excel1 = $_POST['excel1'];
$novo_excel2 = $_POST['excel2'];
$novo_excel_result = $_POST['excel_result'];
$novo_power1 = $_POST['power1'];
$novo_power2 = $_POST['power2'];
$novo_power_result = $_POST['power_result'];
$novo_soft_result = $_POST['soft_result'];
$novo_soft_cge1 = $_POST['soft_cge1'];
$novo_soft_cge2 = $_POST['soft_cge2'];
$novo_soft_cge_result = $_POST['soft_cge_result'];
$novo_pro1 = $_POST['pro1'];
$novo_pro2 = $_POST['pro2'];
$novo_pro_result = $_POST['pro_result'];
$novo_data_avaliacao = $_POST['data_avaliacao'];
$novo_atualizado_em = date('Y-m-d');

//pegando o cpf da pessoa que está avaliando
$novo_avaliador = $_SESSION['CPF']; 


$novo_media_final = ($novo_ass_result + $novo_cum_result + $novo_leg_result + $novo_soft_result + $novo_soft_cge_result + $novo_pro_result) / 6;


//criando um id para a diaria
$id = "AVALIACAO_" . $novo_avaliado . $novo_avaliador . $novo_data_avaliacao . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);


include('../banco-dados/cadastrar.php');

?>