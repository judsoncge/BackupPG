<?php

include('../../iniciar.php');

//a variavel recebe a data atual
$novo_data_chamado =  date('Y-m-d');

//a variavel recebe a natureza do chamado informada pelo usuario
$novo_natureza_problema = $_POST["natureza_problema"];

//a variavel recebe o problema escrito pelo usuario
$novo_problema = $_POST["problema"];

//se foi um gerente de chamados que criou, ele criou no nome de outra pessoa. se foi um usuario comum que criou, sera no nome dele.
if(isset($_POST['requisitante'])){
	$novo_requisitante = $_POST['requisitante'];
}else{
	$novo_requisitante = $_SESSION['CPF'];
}

//a variavel recebe a data e hora atual
$novo_data_abertura = date('Y-m-d H:i:s');

//construindo o id do chamado para gravar no banco de dados
$id_chamado = 'CHAMADO_' . $novo_requisitante . $novo_data_abertura;
$id_chamado = arruma_id($id_chamado);

//construindo o id do historico do chamado para gravar no banco de dados
$id_historico_chamado = "HISTORICO_".$id_chamado;
$id_historico_chamado = arruma_id($id_historico_chamado);

//a variavel recebe o numero de sessao atual
$num = $_GET['sessionId'];

$nome_requisitante = retorna_nome_servidor($novo_requisitante, $conexao_com_banco);

//incluindo o código para gravar do banco de dados
include('../banco-dados/cadastrar.php');

include('../../notificacao/logica/cadastrar.php');
 notificar_chamado($conexao_com_banco, $id_chamado, $nome_requisitante);
 
 //voltando para a pagina de chamados informando que o chamado foi enviado com sucesso
header("Location:../../../interface/chamados.php?sessionId=$num&mensagem=O chamado foi enviado com sucesso!&resultado=sucesso");


?>