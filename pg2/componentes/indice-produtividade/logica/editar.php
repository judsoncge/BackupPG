<?php

include('../../iniciar.php');

include('../../../nucleo-aplicacao/atualiza_notas.php');

if($_GET['operacao']=='extra'){
		
	$id = $_GET['id']; 

	$extra = $_POST['extra'];

	$justificativa = $_POST['justificativa'];

	$notaanterior = $_GET['notaanterior'];

	$mes = $_GET['mes'];

	$ano = $_GET['ano'];
	
	$servidor = $_GET['servidor'];
	
	$tabela = $_GET['tipo'];

	$nova_nota = $notaanterior + $extra;
	
	$num = $_GET['sessionId'];

	if($nova_nota > 10){
		$nova_nota = 10;
	}
	
}

include('../banco-dados/editar.php');
?>