<?php
include('../../banco-dados/conectar.php');

session_start();

$pessoa = $_SESSION["CPF"];

$mensagem = 'COLOCOU O PROCESSO DE VOLTA NO ÓRGÃO';

$status = $_SESSION["setor"];

date_default_timezone_set('America/Bahia');

$data = date('Y-m-d H:i:s');

$processo = $_GET["processo"];

$id = "HISTORICO_PROCESSO_" . $processo . $data;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/editar_voltar.php');



?>