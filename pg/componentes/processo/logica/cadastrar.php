<?php

include('../../banco-dados/conectar.php');

session_start();

$numero_processo1 = $_POST['numero_processo1'];
$numero_processo2 = $_POST['numero_processo2'];
$numero_processo3 = $_POST['numero_processo3'];
$numero_processo_ok = $numero_processo1.' '.$numero_processo2.'/'.$numero_processo3;


//verificando se já existe diária cadastrada com o mesmo número de empenho digitado pelo usuário
/*$numero_processo_verificacao = $_POST['numero_processo'];*/
$numero_processo_verificacao = $numero_processo_ok;
//verificando no banco
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM processo WHERE numero_processo='$numero_processo_verificacao'");
$linha = mysqli_affected_rows($conexao_com_banco);
//se ja estiver cadastrado...
if($linha==1){ 
	//echo "<script>history.back();</script>";
	echo "<script>alert('Um processo com este número já existe!')</script>";
	echo "<script>history.back()</script>";
	die();
}else{
	//se ainda não estiver cadastrado, pegando o numero de empenho digitado pelo usuario no cadastro
	$novo_processo = $numero_processo_ok; 
}

//pegando o mês de competencia digitado pelo usuario no cadastro	
$novo_descricao = $_POST['descricao']; 
$novo_detalhes = $_POST['detalhes']; 
$novo_interessado = $_POST['interessado']; 

//pegando o mês de competencia digitado pelo usuario no cadastro	
$novo_tipo = $_POST['tipo'];

date_default_timezone_set('America/Bahia');

$novo_data_entrada = date('Y-m-d'); 

$data_hora_atual = date('Y-m-d H:i:s');

$meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);

$novo_mes_entrada = $meses[date('m')];

$novo_id = "HISTORICO_PROCESSO_" . $novo_processo . $data_hora_atual;
$novo_id = str_replace('.', '', $novo_id);
$novo_id = str_replace('-', '', $novo_id);
$novo_id = str_replace(':', '', $novo_id);
$novo_id = str_replace(' ', '', $novo_id);


//pegando o cpf da pessoa que está cadastrando esta diária
$novo_cadastrou = $_SESSION['CPF']; 

$falante =  $_SESSION['nome']; 

$setor = $_SESSION['setor'];



include('../banco-dados/cadastrar.php');

?>