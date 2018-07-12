<?php
include('../../banco-dados/conectar.php');

session_start(); 

if($_GET['operacao']=='Mensagem'){
	
$mensagem = $_POST['mensagem'];

$mensagem = "DISSE: " . $mensagem;

$pessoa = $_SESSION["CPF"];

date_default_timezone_set('America/Bahia');

$data_mensagem = date('Y-m-d H:i:s');

$id = $_GET["chamado"];

$id2 = "HISTORICO_CHAMADO_" . $pessoa . $data_mensagem;
$id2 = str_replace('.', '', $id2);
$id2 = str_replace('-', '', $id2);
$id2 = str_replace(':', '', $id2);
$id2 = str_replace(' ', '', $id2);

include('../banco-dados/editar_historico.php');
		
}

?>