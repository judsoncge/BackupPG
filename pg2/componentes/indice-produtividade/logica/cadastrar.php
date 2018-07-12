<?php

include('../../iniciar.php');

include('../../../nucleo-aplicacao/atualiza_notas.php');

if($_GET['operacao']=='assiduidade'){
		
	$novo_avaliado = $_POST['avaliado'];
	$novo_mes = $_POST['mes'];
	$novo_ano = $_POST['ano'];
	$novo_esperadas = $_POST['horas_esperadas'];
	$novo_trabalhadas = $_POST['trabalhadas'];
	$novo_abonadas = $_POST['abonadas'];
	$novo_justificativa = $_POST['justificativa'];

	$query_verificacao = "SELECT * FROM tb_assiduidade WHERE CD_SERVIDOR='$novo_avaliado'
	 and NR_MES='$novo_mes' and NR_ANO='$novo_ano'";
	$search = mysqli_query($conexao_com_banco, $query_verificacao);

	if(mysqli_num_rows($search) == 1){
		
		echo "<script>history.back();</script>";
		echo "<script>alert('A assiduidade para este servidor em $novo_mes/$novo_ano já foi avaliada!')</script>";

	}

	$novo_nota_avaliacao = number_format(((($novo_trabalhadas + $novo_abonadas)/$novo_esperadas)*10), 1, '.', '.');

	if($novo_nota_avaliacao > 10){
		$novo_nota_avaliacao = 10;
	}

	//criando um id para a diaria
	$id = "ASSIDUIDADE_" . $novo_avaliado . $novo_mes . $novo_ano;
	$id = arruma_id($id);

	$num = $_GET['sessionId'];
	
}

include('../banco-dados/cadastrar.php');

?>