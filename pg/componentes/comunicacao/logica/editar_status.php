<?php
include('../../banco-dados/conectar.php');

//gravando o novo status do chamado numa variável de sessão	
$id = $_GET['id'];

$edita_status = $_GET['status'];

include('../banco-dados/editar_status.php');

?>