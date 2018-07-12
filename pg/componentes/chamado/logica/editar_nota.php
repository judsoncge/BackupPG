<?php
include('../../banco-dados/conectar.php');

session_start(); 

$nota = $_POST['nota'];

$id = $_GET["chamado"];

$data_nota = date('Y-m-d H:i:s');

$pessoa = $_GET['pessoa'];

$id2 = "HISTORICO_CHAMADO_" . $pessoa . $data_nota;
$id2 = str_replace('.', '', $id2);
$id2 = str_replace('-', '', $id2);
$id2 = str_replace(':', '', $id2);
$id2 = str_replace(' ', '', $id2);

include('../banco-dados/editar_nota.php');

?>