<?php

include('../../../banco-dados/conectar.php');
include('../../../../nucleo-aplicacao/retornar_dados.php');

session_start();

//pegando as variáveis do form
$novo_avaliado = $_POST['avaliado'];
$novo_mes = $_POST['mes'];
$mes_hoje = date('m');
$novo_ano = $_POST['ano'];
$ano_hoje = date('Y');
$novo_esperadas = $_POST['horas_esperadas'];
$novo_trabalhadas = $_POST['trabalhadas'];
$novo_abonadas = $_POST['abonadas'];
$novo_justificativa = $_POST['justificativa'];

$query_verificacao = "SELECT * FROM indice_produtividade WHERE servidor_avaliado='$novo_avaliado'
 and mes_referencia='$novo_mes' and ano_referencia='$novo_ano' and tipo_avaliacao='ASSIDUIDADE'";
$search = mysqli_query($conexao_com_banco, $query_verificacao);

if($novo_ano > $ano_hoje){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não pode avaliar num ano futuro!')</script>";	
}elseif($mes_hoje < $novo_mes){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não pode avaliar um mês futuro!')</script>";
}elseif(mysqli_num_rows($search) == 1){
	
	echo "<script>history.back();</script>";
	echo "<script>alert('A assiduidade para este servidor em $novo_mes/$novo_ano já foi avaliada!')</script>";

}else{

date_default_timezone_set('America/Bahia');

$novo_nota_avaliacao = number_format(((($novo_trabalhadas + $novo_abonadas)/$novo_esperadas)*10), 1, '.', '.');

if($novo_nota_avaliacao > 10){
	$novo_nota_avaliacao = 10;
}

//criando um id para a diaria
$id = "ASSIDUIDADE_" . $novo_avaliado . $novo_mes . $novo_ano;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/cadastrar.php');
}
?>