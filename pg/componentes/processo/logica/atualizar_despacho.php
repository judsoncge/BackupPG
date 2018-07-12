<?php
include('../../banco-dados/conectar.php');

session_start();

$pessoa = $_GET["pessoa"];

$despacho = $_POST["despacho"];

date_default_timezone_set('America/Bahia');

$data = date('Y-m-d H:i:s');

$id_despacho = $_GET["despacho"];
$processo = $_GET["processo"];

$id = $processo . $data;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);


include('../banco-dados/atualizar_despacho.php');

?>