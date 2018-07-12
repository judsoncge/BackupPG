<?php

include('../../iniciar.php');

$id = $_GET['receita'];

$num = $_GET['sessionId'];

include('../banco-dados/excluir.php');

?>