<?php

include('../../banco-dados/conectar.php');
include('../../notificacao/logica/cadastrar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();


//a variavel recebe a data atual
$novo_data_chamado =  date('Y-m-d');

//a variavel recebe a natureza do chamado informada pelo usuario
$novo_natureza_problema = $_POST["natureza_problema"];

//a variavel recebe o problema escrito pelo usuario
$novo_problema = $_POST["problema"];

//se foi um gerente de chamados que criou, ele criou no nome de outra pessoa. se foi um usuario comum que criou, sera no nome dele.
if(isset($_POST['requisitante'])){
	$novo_requisitante = $_POST['requisitante'];
}else{
	$novo_requisitante = $_SESSION['CPF'];
}


$nome_requisitante = retorna_nome_servidor($novo_requisitante, $conexao_com_banco);

$id_chamado = cadastrar_chamado($conexao_com_banco, $novo_problema, $novo_natureza_problema, $novo_requisitante);

cadastrar_historico_chamado($conexao_com_banco, $id_chamado,'ABRIU UM CHAMADO', $novo_requisitante, 'Abertura');


notificar_chamado($conexao_com_banco, $id_chamado, $nome_requisitante);
 
 //voltando para a pagina de chamados informando que o chamado foi enviado com sucesso
header("Location:../listar.php?mensagem=O chamado foi enviado com sucesso!&resultado=sucesso");


?>