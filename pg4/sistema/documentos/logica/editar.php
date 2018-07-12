<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
session_start();

if($_GET['operacao']=='info'){

	$id_documento = $_GET['documento'];
	
	$informacoes = retorna_informacoes_documento($id_documento, $conexao_com_banco);

	$edita_numero_processo = isset($_POST['numero_processo']) ? $_POST['numero_processo'] : ""; 

	$edita_tipo_atividade = isset($_POST['tipo_atividade']) ? $_POST['tipo_atividade'] : $informacoes['NM_ATIVIDADE']; 

	$edita_tipo_documento = $_POST['tipo_documento'];

	$edita_interessado = isset($_POST['interessado']) ? $_POST['interessado'] : $informacoes['NM_INTERESSADO']; 

	$edita_data_entrada = isset($_POST['data_entrada']) ? $_POST['data_entrada'] : $informacoes['DT_ENTRADA']; 
	
	$edita_prazo = isset($_POST['prazo']) ? $_POST['prazo'] : $informacoes['DT_PRAZO']; 
	
	$data = date('Y-m-d');
	
	if($edita_data_entrada > $edita_prazo){
		echo "<script>alert('A data de entrada nao pode ser maior que o prazo')</script>";
		echo "<script>history.back();</script>";
		die();
	}

	$edita_prioridade = isset($_POST['prioridade']) ? $_POST['prioridade'] : $informacoes['NR_PRIORIDADE']; 
	
	$edita_descricao_fato = isset($_POST['descricao_fato']) ? $_POST['descricao_fato'] : $informacoes['DS_DOCUMENTO'];
	
	$edita_texto_documento = $_POST['texto_documento'];	
	
	$edita_valor = $_POST['valor'];	
	
	$mensagem = 'EDITOU O DOCUMENTO';
	
	$pessoa = $_SESSION['CPF'];
	
	$acao = 'Edição';
	
	editar_documento($conexao_com_banco, $id_documento, $edita_numero_processo, $edita_tipo_atividade, $edita_tipo_documento, $edita_interessado, $edita_data_entrada, $edita_prazo, $edita_prioridade, $edita_descricao_fato, $edita_texto_documento, $edita_valor);
	
	cadastrar_historico_documento($conexao_com_banco, $id_documento, $mensagem, $pessoa, '' ,$acao);

	echo '<script>history.back();</script>';
	echo '<script>history.back();</script>';
	
}

else if($_GET['operacao']=='status'){
	
	$id_documento = $_GET['documento']; 
	
	$status = $_GET['status']; 
	
	$pessoa = $_SESSION['CPF']; 

	$mensagem = $_GET['mensagem'];
	
	$acao = $_GET['acao'];
	
	editar_status_documento($conexao_com_banco, $id_documento, $status);
	cadastrar_historico_documento($conexao_com_banco, $id_documento, $mensagem, $pessoa, '' ,$acao);
	
	echo '<script>history.back();</script>';

}

else if($_GET['operacao']=='resolver'){
	
	$id_documento = $_GET['documento']; 
	
	$pessoa = $_SESSION['CPF']; 

	$mensagem = 'MARCOU COMO RESOLVIDO';
	
	$acao = 'Resolução';
	
	resolver_documento($conexao_com_banco, $id_documento);
	cadastrar_historico_documento($conexao_com_banco, $id_documento, $mensagem, $pessoa, '' ,$acao);
	
	echo '<script>history.back();</script>';
	echo '<script>history.back();</script>';

}

else if($_GET['operacao']=='enviar'){
	
	$id_documento = $_GET['documento']; 

	$pessoa_recebeu = $_POST['enviar']; 
	
	$lista = retorna_nome_setor_servidor($pessoa_recebeu, $conexao_com_banco);
	
	$nome_pessoa = strtoupper($lista['NM_SERVIDOR']);
	
	$setor_pessoa = $lista['CD_SETOR'];

	$pessoa = $_SESSION['CPF']; 
	
	$mensagem = 'ENVIOU O DOCUMENTO PARA ' . $nome_pessoa;
	
	$acao = 'Envio';
	
	enviar_documento($conexao_com_banco, $id_documento, $pessoa_recebeu, $setor_pessoa);
	cadastrar_historico_documento($conexao_com_banco, $id_documento, $mensagem, $pessoa, '' ,$acao);
	
	echo '<script>history.back();</script>';
	echo '<script>history.back();</script>';
	
}

else if($_GET['operacao']=='mensagem'){
	
	$documento = $_GET["id"];
	
	$mensagem = $_POST['msg'];

	$pessoa = $_SESSION["CPF"];

	$acao = "Mensagem";

	cadastrar_historico_documento($conexao_com_banco, $documento, $mensagem, $pessoa, '' ,$acao);
	echo '<script>history.back();</script>';

}

else if($_GET['operacao']=='sugerir'){
	
	$documento = $_GET['documento']; 

	$edita_sugestao = $_POST['sugestao_resposta']; 
	
	$edita_tipo_sugestao = $_POST['tipo_sugestao']; 

	$edita_sugestao = 'Sugestão de ' . $edita_tipo_sugestao . ": " . $edita_sugestao;
	
	$pessoa = $_SESSION['CPF']; 
	
	$acao = 'Sugestão';
	
	cadastrar_historico_documento($conexao_com_banco, $documento, $edita_sugestao, $pessoa, $edita_tipo_sugestao , $acao);
	
	echo '<script>history.back();</script>';
}

else if($_GET['operacao']=='anexo'){
	
	$id_documento = $_GET['documento']; 
	
	$mensagem = 'ANEXOU UM ARQUIVO';

	$pessoa = $_SESSION['CPF']; 

	$acao = 'Anexo';
	
	cadastrar_anexo($conexao_com_banco, $id_documento, $_FILES['arquivo_anexo'], 'DOCUMENTO');	
	cadastrar_historico_documento($conexao_com_banco, $id_documento, $mensagem, $pessoa, '' , $acao);
	
	echo '<script>history.back();</script>';
}

?>