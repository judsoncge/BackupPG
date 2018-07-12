<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
session_start();

date_default_timezone_set('America/Bahia');

$numero_processo1 = $_POST['numero_processo1'];

$numero_processo2 = $_POST['numero_processo2'];

$numero_processo3 = $_POST['numero_processo3'];

$novo_processo = $numero_processo1.' '.$numero_processo2.'/'.$numero_processo3;

$existe_processo = existe_processo($conexao_com_banco, $novo_processo);

if($existe_processo == true){ 
	echo "<script>alert('Um processo com este número já existe!')</script>";
	echo "<script>history.back()</script>";
	die();
}

$novo_descricao = $_POST['descricao']; 

$novo_detalhes = $_POST['detalhes']; 

$novo_interessado = $_POST['interessado']; 

$urgente = 0;
	
$novo_tipo = $_POST['tipo'];
if ($novo_tipo == 'LAI' || $novo_descricao == 'Ouvidoria') {
	$urgente = 1;
}

$novo_data_entrada = date('Y-m-d'); 

$pessoa = $_SESSION['CPF']; 

$setor = $_SESSION['setor'];

$mensagem = 'ABRIU O PROCESSO';

$acao = 'Abertura';

cadastrar_processo($conexao_com_banco,$novo_processo, $urgente, $novo_descricao, $novo_detalhes, $novo_interessado, $novo_data_entrada, $setor, $pessoa, $novo_tipo);

cadastrar_historico_processo($conexao_com_banco,$novo_processo,$mensagem,$pessoa,$acao);

header("Location:../comigo.php?mensagem=O processo foi aberto com sucesso!&resultado=sucesso");
?>