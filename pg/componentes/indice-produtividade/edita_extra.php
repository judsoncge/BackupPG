<?php

include('../banco-dados/conectar.php');

//pegando o numero de empenho para fazer a atualização
$id = $_GET['id']; 

$extra = $_POST['extra'];

$justificativa = $_POST['justificativa'];

$notaanterior = $_GET['notaanterior'];

$mes = $_GET['mes'];

$ano = $_GET['ano'];

$nova_nota = $notaanterior + $extra;

if($nova_nota > 10){
	$nova_nota = 10;
}


include('editar.php');
?>