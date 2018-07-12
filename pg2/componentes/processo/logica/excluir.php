<?php

include('../../iniciar.php');

$id = $_GET['processo'];

$num = $_GET['sessionId'];

include('../banco-dados/excluir.php');

?>