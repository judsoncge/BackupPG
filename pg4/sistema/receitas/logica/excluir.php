<?php
include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

$id_receita = $_GET['receita'];
$ano = $_GET['ano'];
$mes = $_GET['mes'];
$valor = $_GET['valor'];

excluir_receita($conexao_com_banco, $id_receita, $mes, $ano, $valor);

echo '<script>window.location = document.referrer + "?mensagem=A receita foi excluída com sucesso!&resultado=sucesso";</script>';

?>