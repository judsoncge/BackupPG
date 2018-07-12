<?php
include('../../iniciar.php');

include('../../notificacao/logica/cadastrar.php');
//se a operacao foi para resolver o chamado
if($_GET['operacao']=='resolver'){
	
	//a variavel recebe o nome Resolvido, para gravar no banco de dados
	$edita_status_chamado = "Resolvido";

	//a variavel recebe a data e hota atual
	$edita_data_fechamento = date('Y-m-d H:i:s');

	//a variavel recebe via get o id do chamado que sera resolvido
	$id_chamado = $_GET['chamado'];
	
	//construindo o id do historico do chamado
	$id_historico_chamado = "HISTORICO_".$id_chamado.$edita_data_fechamento;
	$id_historico_chamado = arruma_id($id_historico_chamado);
	
	//a variavel recebe o cpf da pessoa que resolveu o chamado
	$pessoa = $_SESSION['CPF'];

	//incluindo o código para editar no banco de dados
	include('../banco-dados/editar.php');
	$nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	notificar_encerrar_chamado($conexao_com_banco, $id_chamado, $nome_requisitante, $pessoa);
}

//se a operacao foi para a encerrar o chamado
else if($_GET['operacao']=='encerrar'){
	
	//a variavel recebe o nome Encerrado, para gravar no banco de dados
	$edita_status_chamado = "Encerrado";

	//a variavel recebe a data e a hora atual
	$edita_data_encerramento = date('Y-m-d H:i:s');

	//a variavel recebe via get o id do chamado que sera encerrado
	$id_chamado = $_GET['chamado'];
	
	//construindo o id do historico do chamado para gravar no banco de dados
	$id_historico_chamado = "HISTORICO_". $id_chamado . $edita_data_encerramento;
	$id_historico_chamado = arruma_id($id_historico_chamado);
	
	//a variavel recebe o cpf da pessoa que encerrou o chamado
	$pessoa = $_SESSION['CPF'];
	
	//a variavel recebe o numero de sessao atual
	$num = $_GET['sessionId'];

	//incluindo o código para editar no banco de dados
	include('../banco-dados/editar.php');
	
}

//se foi enviada uma mensagem
else if($_GET['operacao']=='mensagem'){
	
	//a variavel recebe a mensagem digitada pelo usuario, deixando tudo em maiusculo
	$mensagem = strtoupper($_POST['resposta']);

	//a variavel recebe a palavra DISSE no começo da mensagem digitada pelo usuario
	$mensagem = "DISSE: " . $mensagem;

	//a variavel recebe o cpf da pessoa que escreveu a mensagem
	$pessoa = $_SESSION["CPF"];

	//a variavel recebe a data e a hora atual
	$data_mensagem = date('Y-m-d H:i:s');

	//a variavel recebe via get o id do chamado que foi enviada a mensagem
	$id_chamado = $_GET["chamado"];

	//construindo o id do historico do chamado para gravar no banco de dados
	$id_historico_chamado = "HISTORICO_" . $id_chamado . $data_mensagem;
	$id_historico_chamado = arruma_id($id_historico_chamado);
	
	//incluindo o código para editar no banco de dados
	include('../banco-dados/editar.php');
	$nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	notificar_mensagem_chamado($conexao_com_banco, $id_chamado, $nome_requisitante, $pessoa);
}

//se o usuario der uma nota para o chamado
else if($_GET['operacao']=='nota'){
	
	//a variavel recebe a nota dada pelo usuario
	$nota = $_POST['nota'];

	//a variavel recebe via get o id do chamado que foi dada a nota
	$id_chamado = $_GET["chamado"];
	
	//a variavel recebe a data e a hora atual
	$data_nota = date('Y-m-d H:i:s');

    //a variavel recebe o cpf da pessoa que deu a nota
	$pessoa = $_SESSION['CPF'];

	//construindo o id do historico do chamado para gravar no banco de dados
	$id_historico_chamado = "HISTORICO_" . $id_chamado . $data_nota;
	$id_historico_chamado = arruma_id($id_historico_chamado);
	
	//a variavel recebe o numero de sessao atual
	$num = $_GET['sessionId'];
	
	//incluindo o código para editar no banco de dados
	include('../banco-dados/editar.php');

	}


?>