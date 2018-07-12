<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
date_default_timezone_set('America/Bahia');
session_start();

$numero1 = $_POST["numero_processo1"];

$numero2 = $_POST["numero_processo2"];

$numero3 = $_POST["numero_processo3"];

$numero_processo = $numero1 . " " . $numero2 . "/" . $numero3;

$existe_processo = existe_processo($conexao_com_banco, $numero_processo);  

	if($existe_processo){ 
		echo "<script>alert('Este número de processo já está cadastrado. Tente outro')</script>";
		echo "<script>history.back();</script>";
		die();
	}

$assunto = $_POST["assunto"];

$orgao = $_POST["orgao"];

$interessado = strtoupper($_POST["interessado"]);

$detalhes = strtoupper($_POST["detalhes"]);

$nome_assunto = retorna_nome_assunto($assunto, $conexao_com_banco);

$urgencia = 0;

$data_entrada = date("Y-m-d"); 

$servidor = $_SESSION["id"]; 

$setor = $_SESSION["setor"];
	
if ($nome_assunto == "LAI" or $nome_assunto == "Ouvidoria" or $nome_assunto == "Pagamento") {
	$urgencia = 1;
}

$dias_prazo = retorna_dias_prazo_assunto($conexao_com_banco, $assunto);

$prazo = somar_data($data_entrada, $dias_prazo);

$id = cadastrar_processo($conexao_com_banco, $numero_processo, $urgencia, $assunto, $detalhes, $orgao, $interessado, $data_entrada, $prazo, $setor, $servidor);

$mensagem = "ABRIU O PROCESSO";

$acao = "ABERTURA";

cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);

Header("Location:../cadastrar.php?mensagem=Operação realizada com sucesso!&id=$id");

?>