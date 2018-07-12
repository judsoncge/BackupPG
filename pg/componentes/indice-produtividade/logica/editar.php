<?php

include('../../banco-dados/conectar.php');

//pegando o numero de empenho para fazer a atualização
$id = $_GET['id']; 

//pegando as variáveis do form
//$edita_avaliado = $_POST['avaliado'];
$edita_ass1 = $_POST['ass1'];
$edita_ass2 = $_POST['ass2'];
$edita_ass_result = $_POST['ass_result'];
$edita_cum1 = $_POST['cum1'];
$edita_cum2 = $_POST['cum2'];
$edita_cum_result = $_POST['cum_result'];
$edita_leg1 = $_POST['leg1'];
$edita_leg2 = $_POST['leg2'];
$edita_leg_result = $_POST['leg_result'];
$edita_word1 = $_POST['word1'];
$edita_word2 = $_POST['word2'];
$edita_word_result = $_POST['word_result'];
$edita_excel1 = $_POST['excel1'];
$edita_excel2 = $_POST['excel2'];
$edita_excel_result = $_POST['excel_result'];
$edita_power1 = $_POST['power1'];
$edita_power2 = $_POST['power2'];
$edita_power_result = $_POST['power_result'];
$edita_soft_result = $_POST['soft_result'];
$edita_soft_cge1 = $_POST['soft_cge1'];
$edita_soft_cge2 = $_POST['soft_cge2'];
$edita_soft_cge_result = $_POST['soft_cge_result'];
$edita_pro1 = $_POST['pro1'];
$edita_pro2 = $_POST['pro2'];
$edita_pro_result = $_POST['pro_result'];
$edita_data_avaliacao = date('Y-m-d');
$edita_media_final = ($edita_ass_result + $edita_cum_result + $edita_leg_result + $edita_soft_result + $edita_soft_cge_result + $edita_pro_result) / 6;
$edita_atualizado_em = date('Y-m-d');

include('../banco-dados/editar.php');
?>