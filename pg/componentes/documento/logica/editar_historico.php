<?php
include('../../banco-dados/conectar.php');


$mensagem = $_POST['mensagem'];

$mensagem = "DISSE: " . $mensagem;

$pessoa = $_GET['pessoa'];

date_default_timezone_set('America/Bahia');

$data_mensagem = date('Y-m-d H:i:s');

$id = $_GET["documento"];

$id2 = "HISTORICO_DOCUMENTO_" . $pessoa . $data_mensagem;
$id2 = str_replace('.', '', $id2);
$id2 = str_replace('-', '', $id2);
$id2 = str_replace(':', '', $id2);
$id2 = str_replace(' ', '', $id2);

include('../banco-dados/editar_historico.php');
		


?>