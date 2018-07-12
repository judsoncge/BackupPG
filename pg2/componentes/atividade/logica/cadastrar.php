<?php

include('../../iniciar.php');
include('../../../nucleo-aplicacao/verifica_feriado.php');
include('../banco-dados/cadastrar.php');

//a variavel recebe a data atual
$novo_data_criado = date('Y-m-d H:i:s');


$novo_descricao = $_POST["descricao"];

$novo_encarregado = $_POST['encarregado'];
$novo_mes_inicio = $_POST['mes-inicio'];
$novo_ano_inicio = $_POST['ano-inicio'];
$novo_data_inicio = $novo_ano_inicio.'-'.$novo_mes_inicio.'-01';
$novo_mes_fim = $_POST['mes-fim'];
$novo_ano_fim = $_POST['ano-fim'];
$novo_data_fim = $novo_ano_fim.'-'.$novo_mes_fim.'-01';

$start = $month = strtotime($novo_data_inicio);
$end = strtotime($novo_data_fim);

//a variavel recebe a data e hora atual
$novo_dia = $_POST['dia'];
while($month <= $end)
{
		$novo_dt_vencimento = retorna_data($month, $novo_dia);
	//echo date('Y-m-d H:i:s', retorna_data($month, $novo_dia));
	cadastrar_atividade($conexao_com_banco, $novo_descricao, date('Y-m-d H:i:s', $novo_dt_vencimento), $novo_encarregado);
	$month = strtotime("+1 month", $month);	
}
//a variavel recebe o numero de sessao atual
$num = $_GET['sessionId'];

 //voltando para a pagina de atividades informando que a atividade foi cadastrada com sucesso
header("Location:../../../interface/atividades.php?sessionId=$num&mensagem=Atividade(s) criada(s) com sucesso!&resultado=sucesso&cd_servidor=$novo_encarregado");








?>