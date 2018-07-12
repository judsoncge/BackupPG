<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
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

$novo_assunto = $_POST['assunto']; 

$nome_assunto = retorna_nome_assunto($novo_assunto, $conexao_com_banco);

$novo_detalhes = $_POST['detalhes']; 

$novo_interessado = $_POST['interessado']; 

$nr_urgencia = 0;
	
if ($nome_assunto == 'LAI' or $nome_assunto == 'Ouvidoria' or $nome_assunto == 'Pagamento') {
	$nr_urgencia = 1;
}

$novo_data_entrada = date('Y-m-d'); 

$pessoa = $_SESSION['CPF']; 

$setor = $_SESSION['setor'];

$mensagem = 'ABRIU O PROCESSO';

$acao = 'Abertura';

$dias_prazo = retorna_dias_prazo_assunto_processo($conexao_com_banco, $novo_assunto);

$novo_prazo = somar_data($novo_data_entrada, $dias_prazo);

$novo_orgao = $_POST['orgao']; 

cadastrar_processo($conexao_com_banco, $novo_processo, $nr_urgencia, $novo_assunto, $novo_detalhes, $novo_orgao, $novo_interessado, $novo_data_entrada, $novo_prazo, $setor, $pessoa);

cadastrar_historico_processo($conexao_com_banco,$novo_processo,$mensagem,$pessoa,$acao);

$pagina = $_GET["pagina"];

header("Location:../".$pagina.".php?mensagem=O Processo foi aberto com sucesso!&resultado=sucesso");
?>