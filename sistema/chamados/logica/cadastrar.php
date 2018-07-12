<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

//a variavel recebe a natureza do chamado informada pelo usuario
$natureza_problema = $_POST["natureza_problema"];

//a variavel recebe o problema escrito pelo usuario
$problema = $_POST["problema"];

//pega quem esta criando o chamado
$requisitante = $_SESSION['id'];

//pegando o nome do requisitante
$nome_requisitante = retorna_nome_servidor($requisitante, $conexao_com_banco);

$id = cadastrar_chamado($conexao_com_banco, $problema, $natureza_problema, $requisitante);

cadastrar_historico_chamado($conexao_com_banco, $id,'ABRIU UM CHAMADO', $requisitante, 'ABERTURA');
 
//voltando para a pagina de chamados informando que o chamado foi enviado com sucesso
header("Location:../listar-ativos.php?mensagem=O chamado foi enviado com sucesso!&resultado=sucesso");


?>