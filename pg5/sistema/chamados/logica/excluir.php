<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
session_start();

//pegando o id do chamado para fazer a exclusão
$id = $_GET['chamado']; 
deletar_historico_chamado($conexao_com_banco, $id);
excluir_chamado($conexao_com_banco, $id);


header("Location:../listar.php?mensagem=O chamado foi excluído com sucesso!&resultado=sucesso");
?>