<?php
include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
include('../../notificacao/logica/cadastrar.php');
session_start();

if($_GET['operacao']=='pagar'){

	$id_despesa = $_GET['despesa'];
	
	$valor = $_GET['valor'];
	
	$mes = $_GET['mes'];
	
	$ano = $_GET['ano'];
	
	$data_vencimento = $_GET['vencimento'];
	
	if($data_vencimento < date('Y-m-d')){
		
		$mensagem = 'PAGOU A DESPESA, PORÉM COM ATRASO';
	
		$status = 'Pago atrasado';
	}else{
		
		$mensagem = 'PAGOU A DESPESA';
	
		$status = 'Pago';
		
	}
	
	$acao = 'Pagamento';
	
	$pessoa = $_SESSION['CPF'];
	
	
	
	$notificacao_id_despesa = $_GET['despesa'];
	$notificacao_pessoa = $_SESSION['CPF'];
	$notificacao_nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	$notificacao_codigo_despesa = retorna_tipo_despesa($notificacao_id_despesa, $conexao_com_banco);
	$notificacao_nome_despesa = retorna_nome_despesa($notificacao_codigo_despesa, $conexao_com_banco);
	
	pagar_despesa($conexao_com_banco, $id_despesa, $mes, $ano, $valor, $status);
	
	cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);

	notificar_pagamento_efetuado($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa);
	
	echo "<script>history.back();</script>";
}

else if($_GET['operacao']=='status'){
	
	$id_despesa = $_GET['despesa'];
	
	$edita_status = $_GET['status'];
	
	$pessoa = $_SESSION["CPF"];

	$notificacao_id_despesa = $_GET['despesa'];
	$notificacao_pessoa = $_SESSION['CPF'];
	$notificacao_nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	$notificacao_codigo_despesa = retorna_tipo_despesa($notificacao_id_despesa, $conexao_com_banco);
	$notificacao_nome_despesa = retorna_nome_despesa($notificacao_codigo_despesa, $conexao_com_banco);
	
	
	if($edita_status == 'Empenho autorizado'){
		
		$mes = $_GET["mes"];
	
		$ano = $_GET["ano"];
		
		$valor = $_GET["valor"];
		
		if(($mes < date('m')) or ($mes > date('m') and $ano < date('Y'))){
			atualiza_data_despesa($conexao_com_banco, $id_despesa, date('m'), date('Y'));
			$valor_disponivel = retorna_caixa_disponivel(date('m'), date('Y'), $conexao_com_banco);
		}else{
			$valor_disponivel = retorna_caixa_disponivel($mes, $ano, $conexao_com_banco);
		}
		
		if ($valor_disponivel < $valor){
			echo "<script>alert('Não é possível empenhar este valor pois o valor disponível para o caixa é de R$ $valor_disponivel,00 reais')</script>";
			echo "<script>history.back();</script>";
			die();
		}
		
		$mensagem = 'AUTORIZOU O EMPENHO';
		$acao = 'Autorização de empenho';
		
		editar_status($conexao_com_banco, $id_despesa, $edita_status);
		cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);
		notificar_empenhar_despesa($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa, 'autorizou');
		echo "<script>history.back();</script>";
	
	} else if($edita_status == 'Recusado'){
		$mensagem = 'RECUSOU A SOLICITAÇÃO';
		$acao = 'Recusado';
		editar_status($conexao_com_banco, $id_despesa, $edita_status);
		cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);
		notificar_empenhar_despesa($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa, 'recusou');
		echo "<script>history.back();</script>";
	
	} else if($edita_status == 'Empenhado'){
		$mensagem = 'CONCLUIU O EMPENHO';
		$acao = 'Empenho';
		editar_status($conexao_com_banco, $id_despesa, $edita_status);
		cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);
		notificar_autorizar_pagamento($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa);
		echo "<script>history.back();</script>";

		
	} else if($edita_status == 'Pagamento autorizado'){
		$mensagem = 'AUTORIZOU O PAGAMENTO';
		$acao = 'Autorização de pagamento';
		editar_status($conexao_com_banco, $id_despesa, $edita_status);
		cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);
		notificar_pagamento_autorizado($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa);
		echo "<script>history.back();</script>";
	}		
}

else if($_GET['operacao']=='mensagem'){
	
	$mensagem = $_POST['msg'];

	$pessoa = $_SESSION["CPF"];

	$id_despesa = $_GET["id"];
	
	$acao = 'Mensagem';

	cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);
	
	echo "<script>history.back();</script>";

}

else if($_GET['operacao']=='anexo'){
	
	$id_despesa = $_GET['despesa']; 
	
	$mensagem = 'ANEXOU UM ARQUIVO';

	$pessoa = $_SESSION['CPF']; 
	
	$acao = 'Anexo';

	cadastrar_anexo($conexao_com_banco, $id_despesa, $_FILES['arquivo_anexo'], 'DESPESA');	
	cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao);
	
	echo '<script>history.back();</script>';
}

		
?>