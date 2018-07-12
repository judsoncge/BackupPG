<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
date_default_timezone_set('America/Bahia');
session_start();

$tipo = $_POST["tipo"];

$servidor = $_SESSION["id"];

$servidor_enviar = $_POST["enviar"];

$caminho = "../../../registros/anexos/";
	
$nome_anexo = cadastrar_anexo($_FILES['arquivo_anexo'], $caminho);

cadastrar_arquivo($conexao_com_banco, $tipo, $servidor, $servidor_enviar, $nome_anexo);

Header("Location:../listar-ativos.php?id=$id&mensagem=Operação realizada com sucesso!&resultado=sucesso");

?>