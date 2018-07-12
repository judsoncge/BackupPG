<?php

include('../../iniciar.php');

//a variavel recebe o cpf da pessoa que esta solicitando a compra
$novo_solicitante = $_SESSION["CPF"];

//a variavel recebe a descricao digitada pelo usuario
$novo_descricao = $_POST['descricao'];

//a variavel recebe a data que esta sendo feita a solicitacao
$novo_data_solicitacao = date('Y-m-d');

//a variavel recebe a data e a hora atual da solicitacao
$data_hoje = date('Y-m-d H:i:s');

//construindo o id da compra para gravar no banco de dados
$id_compra = 'COMPRA_' . $novo_solicitante . $data_hoje;
$id_compra = arruma_id($id_compra);

//construindo o id do histórico da compra para gravar no banco de dados
$id_historico_compra = 'HISTORICO_COMPRA_' . $novo_solicitante . $data_hoje;
$id_historico_compra = arruma_id($id_historico_compra);

//a variavel recebe o numero de sessao atual
$num = $_GET['sessionId'];

$nome_requisitante = retorna_nome_servidor($novo_solicitante, $conexao_com_banco);

//incluindo o código para gravar do banco de dados
include('../banco-dados/cadastrar.php');

//include('../../notificacao/logica/cadastrar.php');
 //notificar_compra($conexao_com_banco, $id_compra, $nome_requisitante);
 
 //voltando para a pagina de compras informando que o chamado foi enviado com sucesso
header("Location:../../../interface/compras.php?sessionId=$num&mensagem=A solicitação de compra foi enviada com sucesso!&resultado=sucesso");


?>