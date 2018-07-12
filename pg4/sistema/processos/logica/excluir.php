<?php
include('../../banco-dados/conectar.php');
include('../../documentos/banco-dados/funcoes.php');
include('../../despesas/banco-dados/funcoes.php');
include('../banco-dados/funcoes.php');
session_start();

$id_processo = $_GET['processo'];

excluir_processo($conexao_com_banco, $id_processo);

echo '<script>window.location = document.referrer + "?mensagem=O processo e seus documentos e anexos foram excluídos com sucesso!&resultado=sucesso";</script>';

?>