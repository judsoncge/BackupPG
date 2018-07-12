<?php
include('../../iniciar.php');
include('../../notificacao/logica/cadastrar.php');

$edita_codigo_despesa = '';
if($_GET['operacao']=='pagar'){

	$despesa = $_GET['despesa'];
	
	$valor = $_GET['valor'];
	
	$mes = $_GET['mes'];
	
	$ano = $_GET['ano'];
	
	$pessoa = $_SESSION['CPF'];
	
	$data_hoje = date('Y-m-d H:i:s');
	
	$mensagem = 'PAGOU A DESPESA';
	
	$acao = 'Pagamento';
	
	$id_historico_despesa = "HISTORICO_DESPESA_" . $despesa . $data_hoje;
	$id_historico_despesa = arruma_id($id_historico_despesa);
	
	$num = $_GET['sessionId'];
	
	$notificacao_id_despesa = $_GET['despesa'];
	$notificacao_pessoa = $_SESSION['CPF'];
	$notificacao_nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	$notificacao_codigo_despesa = retorna_tipo_despesa($notificacao_id_despesa, $conexao_com_banco);
	$notificacao_nome_despesa = retorna_nome_despesa($notificacao_codigo_despesa, $conexao_com_banco);
	notificar_pagamento_efetuado($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa);
}

else if($_GET['operacao']=='mensagem'){
	
	$mensagem = $_POST['resposta'];

	$cpf = $_SESSION["CPF"];

	$data_mensagem = date('Y-m-d H:i:s');

	$despesa = $_GET["despesa"];

	$id_historico_despesa = "HISTORICO_" . $despesa . $data_mensagem;
	$id_historico_despesa = arruma_id($id_historico_despesa);

}


else if($_GET['operacao']=='status'){
	
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
		
		$valor_disponivel = retorna_caixa_disponivel($mes, $ano, $conexao_com_banco);
		
		if ($valor_disponivel < $valor){
			echo "<script>history.back();</script>";
			echo "<script>alert('Não é possível empenhar este valor pois o valor disponível para o caixa é de R$ $valor_disponivel reais')</script>";
			die();
		}
		
		$mensagem = 'AUTORIZOU O EMPENHO';
		$acao = 'Autorização de empenho';
		notificar_empenhar_despesa($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa, 'autorizou');
	
	} else if($edita_status == 'Recusado'){
		$mensagem = 'RECUSOU A SOLICITAÇÃO';
		$acao = 'Recusado';
		notificar_empenhar_despesa($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa, 'recusou');
	
	} else if($edita_status == 'Empenhado'){
		$mensagem = 'CONCLUIU O EMPENHO';
		$acao = 'Empenho';
		notificar_autorizar_pagamento($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa);
	} else if($edita_status == 'Pagamento autorizado'){
		$mensagem = 'AUTORIZOU O PAGAMENTO';
		$acao = 'Autorização de pagamento';
		notificar_pagamento_autorizado($conexao_com_banco, $notificacao_id_despesa, $notificacao_nome_despesa, $notificacao_nome_requisitante, $notificacao_pessoa);
	}

	$data_hoje = date('Y-m-d H:i:s');

	$despesa = $_GET["despesa"];
	
	$num = $_GET['sessionId'];

	$id_historico_despesa = "HISTORICO_" . $despesa . $data_hoje;
	$id_historico_despesa = arruma_id($id_historico_despesa);
	
		
}

else if($_GET['operacao']=='info'){
	
	$edita_codigo_despesa = $_POST['tipo'];

	$edita_descricao = $_POST['descricao'];

	$edita_mes = $_POST['mes'];

	$edita_ano = $_POST['ano'];
	
	$edita_valor = $_POST['valor'];
	
	$edita_data_vencimento = $_POST['data'];
	
	$num = $_GET['sessionId'];
	
	$pessoa = $_SESSION['CPF'];
	
	$mensagem = 'EDITOU AS INFORMAÇÕES DA DESPESA';
	
	$data_hoje = date('Y-m-d H:i:s');
	
	$id_despesa = $_GET['despesa'];
	
	$id_historico_despesa = "HISTORICO_" . $id_despesa . $data_hoje;
	$id_historico_despesa = arruma_id($id_historico_despesa);
	

}

include('../banco-dados/editar.php');
		
?>