<?php

include('../../iniciar.php');

$mes = $_POST['mes'];

$ano = $_POST['ano'];

$num = $_GET['sessionId'];

header("Location:../../interface/indice-produtividade.php?sessionId=$num&mes=$mes&ano=$ano");

?>