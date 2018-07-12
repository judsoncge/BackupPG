<?php
include('../../banco-dados/conectar.php');

session_start();

if($_GET['operacao']=='mensagem'){
	
$mensagem = $_POST['resposta'];

$falante = $_SESSION["nome"];

date_default_timezone_set('America/Bahia');

$data_mensagem = date('Y-m-d H:i');

$processo = $_GET["processo"];

$id = $processo . $data_mensagem;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/editar_historico.php');
		
}



?>