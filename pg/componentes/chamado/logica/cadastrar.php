<?php

session_start();

include('../../banco-dados/conectar.php');

//pegando a data e hora atual da ação do cadastro
date_default_timezone_set('America/Bahia');
$novo_data_chamado =  date('Y-m-d');
//gravando a natureza do problema numa variável de sessão
$novo_natureza_problema = $_POST["natureza_problema"];
//gravando o problema numa variável de sessão
$novo_problema = $_POST["problema"];
//gravando o setor numa variável de sessão


//gravando o requisitante
if($_SESSION['setor']=='TI'){
	$novo_requisitante = $_POST['requisitante'];
}else{
	$novo_requisitante = $_SESSION['CPF'];
}

$query = "SELECT setor FROM pessoa WHERE CPF='$novo_requisitante'";
	
$lista = mysqli_query($conexao_com_banco, $query);
	
$novo_setor='';
	
while($resultado = mysqli_fetch_array($lista)){
	
	$novo_setor = $resultado['setor'];
		
}

$novo_data_abertura = date('Y-m-d H:i:s');

$id = "CHAMADO_" . $novo_requisitante . $novo_data_chamado . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);

$id_historico = "HISTORICO_CHAMADO_" . $novo_requisitante . $novo_data_chamado . date('H:i:s');
$id_historico = str_replace('.', '', $id_historico);
$id_historico = str_replace('-', '', $id_historico);
$id_historico = str_replace(':', '', $id_historico);

include('../banco-dados/cadastrar.php');

?>