<?php

include('../../iniciar.php');

$numero_processo1 = $_POST['numero_processo1'];

$numero_processo2 = $_POST['numero_processo2'];

$numero_processo3 = $_POST['numero_processo3'];

$numero_processo_ok = $numero_processo1.' '.$numero_processo2.'/'.$numero_processo3;

$novo_processo = $numero_processo_ok;

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_PROCESSO='$novo_processo'");

if(mysqli_num_rows($retornoquery) > 0){ 
	echo "<script>alert('Um processo com este número já existe!')</script>";
	echo "<script>history.back()</script>";
	die();
}

$novo_descricao = $_POST['descricao']; 

$novo_detalhes = $_POST['detalhes']; 

$novo_interessado = $_POST['interessado']; 
	
$novo_tipo = $_POST['tipo'];

$novo_data_entrada = date('Y-m-d'); 

$data_hora_atual = date('Y-m-d H:i:s');

$id_historico_processo = "HISTORICO_PROCESSO_" . $novo_processo . $data_hora_atual;
$id_historico_processo = arruma_id($id_historico_processo);

$pessoa = $_SESSION['CPF']; 

$nome_pessoa = $_SESSION['nome']; 

$setor = $_SESSION['setor'];

$num = $_GET['sessionId'];

include('../banco-dados/cadastrar.php');

?>