<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
session_start();

$id = $_GET['id'];

excluir_servidor($conexao_com_banco, $id);

Header("Location:../listar.php?mensagem=O(A) servidor(a) foi excluído(a) com sucesso!&resultado=sucesso");

?>