<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

if(isset($_POST['numero_processo'])){
	$novo_numero_processo = $_POST['numero_processo']; 
}else{
	$novo_numero_processo = "";
}

$novo_tipo_atividade = $_POST['tipo_atividade']; 

$novo_tipo_documento = $_POST['tipo_documento'];

if(($novo_tipo_documento == 'Parecer' or $novo_tipo_documento == 'Publicação no Diário' or $novo_tipo_documento == 'Termo de Referência' or $novo_tipo_documento == 'Cotação de Preço' or $novo_tipo_documento == 'Aquisição') and $novo_numero_processo == ''){
	echo "<script>alert('Para criar um documento do tipo $novo_tipo_documento, é necessário selecionar um processo relacionado!')</script>";
	echo "<script>history.back()</script>";
	die();
}

if($novo_numero_processo != '' and ($novo_tipo_documento == 'Parecer' or $novo_tipo_documento == 'Publicação no Diário' or $novo_tipo_documento == 'Termo de Referência' or $novo_tipo_documento == 'Cotação de Preço' or $novo_tipo_documento == 'Aquisição')){
		
		$tem_prazo = retorna_tem_prazo_processo($novo_numero_processo, $conexao_com_banco);
		
		if($tem_prazo == false){
			echo "<script>alert('Para editar um documento do tipo $novo_tipo_documento, é necessário selecionar um processo que já tenha os prazos definidos!')</script>";
			echo "<script>history.back()</script>";
			die();
		}
	}

$novo_interessado = $_POST['interessado']; 
	
$novo_data_entrada = $_POST['data_entrada']; 
	
$novo_prazo = $_POST['prazo'];

$novo_descricao_fato = $_POST['descricao_fato'];	

$novo_texto_documento = $_POST['texto_documento']; 

$novo_data_criacao = date('Y-m-d H:i:s');

$novo_criado_por = $_SESSION['CPF']; 

$novo_esta_com = $_GET['servidor']; 

$novo_esta_setor = $_GET['setor']; 

$novo_prioridade = $_POST['prioridade']; 

$novo_valor = $_POST['valor']; 

if($novo_tipo_documento == 'Memorando' or $novo_tipo_documento == 'Publicação no Diário' or $novo_tipo_documento == 'Termo de Referência' or $novo_tipo_documento == 'Cotação de Preço' or $novo_tipo_documento == 'Aquisição'){
	$novo_status = 'Aprovado';
}else{
	$novo_status = 'Em análise';
}

$mensagem = 'CRIOU UM '.$novo_tipo_documento;

$acao = 'Criação';

$id_documento = cadastrar_documento($conexao_com_banco, $novo_numero_processo, $novo_tipo_atividade, $novo_tipo_documento, $novo_interessado, $novo_data_entrada, $novo_prazo, $novo_data_criacao, $novo_prioridade, $novo_descricao_fato, $novo_texto_documento, $novo_valor, $novo_criado_por, $novo_esta_com, $novo_esta_setor, $novo_status);

cadastrar_anexo($conexao_com_banco, $id_documento, $_FILES['arquivo_anexo'], 'DOCUMENTO');	

cadastrar_historico_documento($conexao_com_banco, $id_documento, $mensagem, $novo_criado_por, '', $acao);

header("Location:../comigo.php?mensagem=O documento foi criado com sucesso!&resultado=sucesso");


?>