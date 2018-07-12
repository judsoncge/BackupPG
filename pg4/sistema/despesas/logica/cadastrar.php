<?php
include('../../notificacao/logica/cadastrar.php');
include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

if($_GET['operacao']=='despesa'){
	
	$novo_codigo_despesa = $_POST['tipo'];

	$novo_descricao = $_POST['descricao'];
	
	if(isset($_GET['processo'])){
		$novo_processo = $_GET['processo'];
	}else{
		$novo_processo = '';
	}

	$novo_mes = date('m');

	$novo_ano = date('Y');
	
	$novo_valor = $_POST['valor'];
	
	$novo_data_vencimento = $_POST['data'];
	
	if($novo_data_vencimento < date('Y-m-d')){
		echo "<script>alert('A data de vencimento não pode ser menor que a data de hoje')</script>";
		echo "<script>history.back()</script>";
		die();
	}
	
	$pessoa = $_SESSION['CPF'];
	
	$mensagem = 'SOLICITOU UMA DESPESA';
	
	$acao = 'Solicitação';
	
	$nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	
	$nome_despesa = retorna_nome_despesa($novo_codigo_despesa, $conexao_com_banco);
	
	$id_despesa = cadastrar_despesa($conexao_com_banco, $novo_codigo_despesa, $novo_processo, $novo_descricao, $novo_mes, $novo_ano, $novo_valor, $novo_data_vencimento);
	
	cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);
	
	cadastrar_anexo($conexao_com_banco, $id_despesa, $_FILES['arquivo_anexo'], 'DESPESA');
	
	notificar_autorizar_empenho($conexao_com_banco, $id_despesa, $nome_despesa, $nome_requisitante, $pessoa);
	
	echo "<script>history.back();</script>";
	echo "<script>history.back();</script>";
	
}else if($_GET['operacao']=='tipo_despesa'){

	$novo_codigo_despesa = $_POST['codigo'];
	
	$novo_tipo_despesa = $_POST['tipo'];
	
	$novo_nome_despesa = $_POST['nome'];
	
	$existe_despesa = existe_despesa($conexao_com_banco, $novo_codigo_despesa);

	if($existe_despesa == true){ 
		echo "<script>alert('Uma despesa com este código já existe!')</script>";
		echo "<script>history.back()</script>";
		die();
	}
	
	cadastrar_tipo_despesa($conexao_com_banco, $novo_codigo_despesa, $novo_tipo_despesa, $novo_nome_despesa);
	header("Location:../cadastrar.php?mensagem=O novo tipo de despesa foi cadastrado com sucesso!&resultado=sucesso");
		

}	

?>