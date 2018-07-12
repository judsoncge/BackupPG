<?php

include('../../iniciar.php');

$id = $_GET['despesa'];

$num = $_GET['sessionId'];

include('../banco-dados/excluir.php');

?>