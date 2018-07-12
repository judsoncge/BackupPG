<?php
include('../../iniciar.php');

include('../../notificacao/logica/cadastrar.php');
//se a operacao foi para autorizar a compra
if($_GET['operacao']=='autorizar'){
	
	//a variavel recebe o nome Compra autorizada, para gravar no banco de dados
	$edita_status_compra = "Compra autorizada";

	//a variavel recebe o prazo informado pelo usuario
	$edita_prazo = $_POST['prazo'];

	//a variavel recebe via get o id da compra autorizada
	$id_compra = $_GET['compra'];
	
	//a variavel recebe a data e a hora atual da solicitacao
	$data_hoje = date('Y-m-d H:i:s');
	
	if($edita_prazo < $data_hoje){
		echo "<script>alert('O prazo não pode ser menor que a data de hoje!')</script>";
		echo "<script>history.back()</script>";
		die();	
	}
	
	//construindo o id do historico do chamado
	$id_historico_compra = "HISTORICO_" . $id_compra . $data_hoje;
	$id_historico_compra = arruma_id($id_historico_compra);
	
	//a variavel recebe o cpf da pessoa que autorizou a compra
	$pessoa = $_SESSION['CPF'];

	//incluindo o código para editar no banco de dados
	include('../banco-dados/editar.php');
	//$nome_solicitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	//notificar_autorizar_compra($conexao_com_banco, $id_compra, $nome_solicitante, $pessoa);

}else if($_GET['operacao']=='recusar'){
	
	//a variavel recebe o nome Compra recusada, para gravar no banco de dados
	$edita_status_compra = "Compra recusada";

	//a variavel recebe via get o id da compra autorizada
	$id_compra = $_GET['compra'];
	
	//a variavel recebe a data e a hora atual da solicitacao
	$data_hoje = date('Y-m-d H:i:s');
	
	//construindo o id do historico do chamado
	$id_historico_compra = "HISTORICO_" . $id_compra . $data_hoje;
	$id_historico_compra = arruma_id($id_historico_compra);
	
	//a variavel recebe o cpf da pessoa que autorizou a compra
	$pessoa = $_SESSION['CPF'];

	//incluindo o código para editar no banco de dados
	include('../banco-dados/editar.php');
	//$nome_solicitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	//notificar_autorizar_compra($conexao_com_banco, $id_compra, $nome_solicitante, $pessoa);
}else if($_GET['operacao']=='empenhar'){
	
	//a variavel recebe o valor a ser empenhado
	$valor = $_POST['valor'];
	
	$mes = date('m');
	
	$ano = date('Y');
	
	$valor_disponivel = retorna_caixa_disponivel($mes, $ano, $conexao_com_banco);
		
	if ($valor_disponivel < $valor){
		echo "<script>history.back();</script>";
		echo "<script>alert('Não é possível empenhar este valor pois o valor disponível para o caixa é de R$ $valor_disponivel reais')</script>";
		die();
	}

	//a variavel recebe o tipo de despesa da compra a ser feita
	$tipo = $_POST['tipo'];
	
	//a variavel recebe a descricao da compra
	$descricao = $_GET['descricao'];
	
	//a variavel recebe o prazo da compra
	$prazo = $_GET['prazo'];
	
	//a variavel recebe via get o id da compra a ser empenhada
	$id_compra = $_GET['compra'];
	
	//a variavel recebe a data e a hora atual da solicitacao
	$data_hoje = date('Y-m-d H:i:s');
	
	//construindo o id do historico da compra
	$id_historico_compra = "HISTORICO_" . $id_compra . $data_hoje;
	$id_historico_compra = arruma_id($id_historico_compra);
	
	//a variavel recebe o cpf da pessoa que autorizou a compra
	$pessoa = $_SESSION['CPF'];

	//construindo o id da despesa
	$id_despesa = "DESPESA_" . $pessoa . $data_hoje;
	$id_despesa = arruma_id($id_despesa);
	
	//incluindo o código para editar no banco de dados
	include('../banco-dados/editar.php');
	//$nome_solicitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	//notificar_autorizar_compra($conexao_com_banco, $id_compra, $nome_solicitante, $pessoa);
}else if($_GET['operacao']=='pagar'){
	
	//a variavel recebe o prazo da compra
	$prazo = $_GET['prazo'];
	
	//a variavel recebe a descricao da compra
	$id_despesa = $_GET['despesa'];
	
	//a variavel recebe via get o id da compra a ser empenhada
	$id_compra = $_GET['compra'];
	
	//a variavel recebe a data e a hora atual da solicitacao
	$data_hoje = date('Y-m-d H:i:s');
	
	//verifica se está sendo paga no prazo
	if($prazo >= $data_hoje){
		$status = 'Paga';
	}else{
		$status = 'Paga com atraso';
	}
	
	//construindo o id do historico da compra
	$id_historico_compra = "HISTORICO_" . $id_compra . $data_hoje;
	$id_historico_compra = arruma_id($id_historico_compra);
	
	//a variavel recebe o cpf da pessoa que autorizou a compra
	$pessoa = $_SESSION['CPF'];
	
	//incluindo o código para editar no banco de dados
	include('../banco-dados/editar.php');
	//$nome_solicitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	//notificar_autorizar_compra($conexao_com_banco, $id_compra, $nome_solicitante, $pessoa);
}


?>