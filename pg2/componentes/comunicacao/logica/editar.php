<?php

include('../../iniciar.php');

if($_GET['operacao']=='info'){

	$id_comunicacao = $_GET['comunicacao'];

	$edita_item = $_POST["item"];

	$edita_titulo = $_POST["titulo"];

	$edita_texto = $_POST["texto"];

	$edita_data_publicacao = $_POST["data_publicacao"];

	$i = 0;
		
	if ($edita_data_publicacao == null){
		$edita_data_publicacao =  date('Y-m-d H:i:s');
	}
	
	$num = $_GET['sessionId'];

}

else if($_GET['operacao']=='status'){
	
	$id_comunicacao = $_GET['id'];

	$edita_status = $_GET['status'];
	
	$num = $_GET['sessionId'];

}

include('../banco-dados/editar.php');

?>