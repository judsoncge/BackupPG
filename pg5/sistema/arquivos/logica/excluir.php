<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
session_start();

$id = $_GET['id'];

excluir_arquivo($conexao_com_banco, $id);

$caminho = "../../../registros/anexos/".$_GET['anexo'];

unlink($caminho);

Header("Location:../listar-ativos.php?mensagem=Operação realizada com sucesso!&resultado=sucesso");

?>