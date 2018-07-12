<?php
include('../../banco-dados/conectar.php');

session_start();

$pessoa = $_GET["pessoa"];

$despacho = $_POST["despacho"];

date_default_timezone_set('America/Bahia');

$data = date('Y-m-d H:i:s');

$processo = $_GET["processo"];

$id = $processo . $data;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

$id2 = 'DESPACHO_'. $processo . $data;
$id2 = str_replace('.', '', $id2);
$id2 = str_replace('-', '', $id2);
$id2 = str_replace(':', '', $id2);
$id2 = str_replace(' ', '', $id2);

include('../banco-dados/editar_despacho.php');

?>