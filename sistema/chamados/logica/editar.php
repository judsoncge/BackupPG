<?php
include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

//se a operacao foi para resolver o chamado
if($_GET['operacao']=='resolver'){
	
	//a variavel recebe o nome Resolvido, para gravar no banco de dados
	$status = "RESOLVIDO";

	//a variavel recebe a data e hota atual
	$data = date('Y-m-d H:i:s');

	//a variavel recebe via get o id do chamado que sera resolvido
	$id = $_GET['id'];
	
	alterar_status($conexao_com_banco, $id, $status, $data);

	//a variavel recebe o id do servidor que resolveu o chamado
	$servidor = $_SESSION['id'];

	cadastrar_historico_chamado($conexao_com_banco, $id,'RESOLVEU O CHAMADO', $servidor, 'RESOLUÇÃO');
	
	echo "<script>history.back()</script>";
}

//se a operacao foi para a encerrar o chamado
else if($_GET['operacao']=='encerrar'){
	
	//a variavel recebe o nome Encerrado, para gravar no banco de dados
	$status = "ENCERRADO";

	//a variavel recebe via get o id do chamado que sera encerrado
	$id = $_GET['id'];
	
	//a variavel recebe o id do servidor que encerrou o chamado
	$servidor = $_SESSION['id'];
	
	//a variavel recebe a data e hota atual
	$data = date('Y-m-d H:i:s');
	
	alterar_status($conexao_com_banco, $id, $status, $data);
	
	cadastrar_historico_chamado($conexao_com_banco, $id,'ENCERROU O CHAMADO', $servidor, 'ENCERRAMENTO');
	
	header("Location:../listar-ativos.php?mensagem=O chamado foi encerrado. Seus registros estão no nosso banco de dados&resultado=sucesso");
	
}

//se foi enviada uma mensagem
else if($_GET['operacao']=='mensagem'){
	
	$id = $_GET["id"];
	
	$mensagem = $_POST['msg'];

	$servidor = $_SESSION["id"];

	cadastrar_historico_chamado($conexao_com_banco, $id, $mensagem, $servidor, "MENSAGEM");
	
	echo '<script>history.back();</script>';
}

//se o usuario avaliar o chamado
else if($_GET['operacao']=='avaliacao'){
	
	//a variavel recebe a avaliacao dada pelo usuario
	$avaliacao = $_POST['avaliacao'];

	//a variavel recebe via get o id do chamado que foi dada a avaliacao
	$id = $_GET["id"];

    //a variavel recebe o id do servidor que deu a avaliacao
	$servidor = $_SESSION['id'];

	alterar_avaliacao($conexao_com_banco, $id, $avaliacao);
	
	cadastrar_historico_chamado($conexao_com_banco, $id,"AVALIOU O CHAMADO: $avaliacao", $servidor, 'AVALIAÇÃO');
	
	//voltando para a pagina de chamados informando que a avaliacao foi dada com sucesso
	header("Location:../listar-ativos.php?mensagem=Chamado avaliado com sucesso!&resultado=sucesso");


	}


?>