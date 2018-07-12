<?php
function notificar_chamado($conexao_com_banco, $chamado, $requisitante) {	
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE visualizar_todos_chamado = 'sim'");
	
	while ($servidor = mysqli_fetch_row($servidores)){
		criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.' criou um novo chamado.','chamados/detalhes.php?chamado='.$chamado);
	};

}
function notificar_encerrar_chamado($conexao_com_banco, $chamado, $requisitante, $requisitante_cod) {
	notificar_status_chamado($conexao_com_banco, $chamado, $requisitante, $requisitante_cod, 'encerrou');
}

function notificar_mensagem_chamado($conexao_com_banco, $chamado, $requisitante, $requisitante_cod){
$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE visualizar_todos_chamado = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.' respondeu um chamado.','chamados/detalhes.php?chamado='.$chamado);
		}		
	};
	
	$chamado_requisitantes = mysqli_query($conexao_com_banco, "SELECT cd_servidor,nm_servidor FROM tb_servidores s where s.cd_servidor = (SELECT cd_servidor_requisitante FROM tb_chamados c where c.CD_CHAMADO ='$chamado')");
	while ($chamado_requisitante = mysqli_fetch_row($chamado_requisitantes)){
		if ($chamado_requisitante[0] !== $requisitante_cod) {
			criar_notificacao($conexao_com_banco, $chamado_requisitante[0], $requisitante.' respondeu seu chamado.','chamados/detalhes.php?chamado='.$chamado);
	
		}
		
	}	
}

function notificar_solicitar_compra($conexao_com_banco, $chamado, $requisitante, $requisitante_cod){
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE autorizar_compra = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.' solicitou uma compra.','compras/detalhes.php?compra='.$chamado);
		}		
	};	
}

function notificar_autorizar_compra($conexao_com_banco, $chamado, $requisitante, $requisitante_cod){
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE efetuar_compra = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.' autorizou uma compra.','compras/detalhes.php?compra='.$chamado);
		}		
	};	
}

function notificar_recusar_compra($conexao_com_banco, $chamado, $requisitante, $requisitante_cod){
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE efetuar_compra = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.' recusou uma compra.','compras/detalhes.php?compra='.$chamado);
		}		
	};	
}

function notificar_status_chamado($conexao_com_banco, $chamado, $requisitante, $requisitante_cod, $status) {	
	$cod = '';
	$chamado_requisitantes = mysqli_query($conexao_com_banco, "SELECT cd_servidor,nm_servidor FROM tb_servidores s where s.cd_servidor = (SELECT cd_servidor_requisitante FROM tb_chamados c where c.CD_CHAMADO ='$chamado')");
	while ($chamado_requisitante = mysqli_fetch_row($chamado_requisitantes)){
		$cod = $chamado_requisitante[0];
		if ($chamado_requisitante[0] !== $requisitante_cod) {
			criar_notificacao($conexao_com_banco, $chamado_requisitante[0], $requisitante.' '.$status.' seu chamado. Por favor avalie o atendimento.','chamados/detalhes.php?chamado='.$chamado);
	
		}
		
	}
	
	
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE visualizar_todos_chamado = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0] && $cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.' '.$status.' um chamado.','chamados/detalhes.php?chamado='.$chamado);
		}		
	};
	
				
	
}

function notificar_autorizar_empenho($conexao_com_banco, $despesa, $natureza, $requisitante, $requisitante_cod) {	
	
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE autorizar_empenho = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.'  solicitou o pagamento de uma despesa de '.$natureza.'.','despesas/detalhes.php?despesa='.$despesa);
		}		
	};
}

function notificar_empenhar_despesa($conexao_com_banco, $despesa, $natureza, $requisitante, $requisitante_cod, $status) {	
	
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE empenhar_despesa = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.'  '.$status.' o empenho de uma despesa de '.$natureza.'.','despesas/detalhes.php?despesa='.$despesa);
		}		
	};
}

function notificar_autorizar_pagamento($conexao_com_banco, $despesa, $natureza, $requisitante, $requisitante_cod) {	
	
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE autorizar_pagamento = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.'  empenhou uma despesa de '.$natureza.'.','despesas/detalhes.php?despesa='.$despesa);
		}		
	};
}

function notificar_pagamento_autorizado($conexao_com_banco, $despesa, $natureza, $requisitante, $requisitante_cod) {	
	
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE pagar_despesa = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.'  autorizou o pagamento de '.$natureza.'.', 'despesas/detalhes.php?despesa='.$despesa);
		}		
	};
}
	
function notificar_pagamento_efetuado($conexao_com_banco, $despesa, $natureza, $requisitante, $requisitante_cod) {	
	
	$servidores = mysqli_query($conexao_com_banco, "SELECT cd_servidor FROM permissao WHERE pagar_despesa = 'sim'");	
	while ($servidor = mysqli_fetch_row($servidores)){
		if ($requisitante_cod !== $servidor[0]) {
			criar_notificacao($conexao_com_banco, $servidor[0], $requisitante.'  realizou um pagamento referente de '.$natureza.'.', 'financeiro/fluxo-caixa.php');
		}		
	};
}



include('../../notificacao/banco-dados/cadastrar.php');

?>