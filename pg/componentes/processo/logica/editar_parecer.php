<?php
include('../../banco-dados/conectar.php');

session_start();

$pessoa = $_GET["pessoa"];

$parecer = $_POST["parecer"];

date_default_timezone_set('America/Bahia');

$data = date('Y-m-d H:i');

$processo = $_GET["processo"];

$id = $processo . $data;

include('../banco-dados/editar_parecer.php');



?>