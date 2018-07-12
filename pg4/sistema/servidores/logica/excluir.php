<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
session_start();

$CPF = $_GET['servidor'];

excluir_servidor($conexao_com_banco, $CPF);

echo "<script>history.back();</script>";

?>