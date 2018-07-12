<?php
include('../../banco-dados/conectar.php');
include('../../notificacao/logica/cadastrar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

//se a operacao foi para resolver o chamado
if($_GET['operacao']=='resolver'){
	
	//a variavel recebe o nome Resolvido, para gravar no banco de dados
	$edita_status_chamado = "Resolvido";

	//a variavel recebe a data e hota atual
	$edita_data_fechamento = date('Y-m-d H:i:s');

	//a variavel recebe via get o id do chamado que sera resolvido
	$id_chamado = $_GET['chamado'];
	
	alterar_status($conexao_com_banco,$id_chamado, $edita_status_chamado, $edita_data_fechamento);

	//a variavel recebe o cpf da pessoa que resolveu o chamado
	$pessoa = $_SESSION['CPF'];

	cadastrar_historico_chamado($conexao_com_banco, $id_chamado,'RESOLVEU O CHAMADO', $pessoa, 'Fechamento');
	
	$nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	notificar_encerrar_chamado($conexao_com_banco, $id_chamado, $nome_requisitante, $pessoa);
	
	echo "<script>history.back()</script>";
}

//se a operacao foi para a encerrar o chamado
else if($_GET['operacao']=='encerrar'){
	
	//a variavel recebe o nome Encerrado, para gravar no banco de dados
	$status = "Encerrado";

	//a variavel recebe via get o id do chamado que sera encerrado
	$id_chamado = $_GET['chamado'];
	
	//a variavel recebe o cpf da pessoa que encerrou o chamado
	$pessoa = $_SESSION['CPF'];
	

	alterar_status($conexao_com_banco,$id_chamado, $status, $data);
	cadastrar_historico_chamado($conexao_com_banco, $id_chamado,'ENCERROU O CHAMADO', $pessoa, 'Encerramento');

	
	header("Location:../listar.php?mensagem=O chamado foi encerrado. Seus registros estão no nosso banco de dados&resultado=sucesso");
	

	
}

//se foi enviada uma mensagem
else if($_GET['operacao']=='mensagem'){
	$id_chamado = $_GET["id"];
	
	$mensagem = $_POST['msg'];

	$pessoa = $_SESSION["CPF"];

	$acao = "Mensagem";

	cadastrar_historico_chamado($conexao_com_banco, $id_chamado, $mensagem, $pessoa, 'Mensagem');
	
		
	$nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	notificar_mensagem_chamado($conexao_com_banco, $id_chamado, $nome_requisitante, $pessoa);
	echo '<script>history.back();</script>';
}

//se o usuario der uma nota para o chamado
else if($_GET['operacao']=='nota'){
	
	//a variavel recebe a nota dada pelo usuario
	$nota = $_POST['nota'];

	//a variavel recebe via get o id do chamado que foi dada a nota
	$id_chamado = $_GET["chamado"];


    //a variavel recebe o cpf da pessoa que deu a nota
	$pessoa = $_SESSION['CPF'];

	alterar_nota($conexao_com_banco, $id_chamado, $nota);
	cadastrar_historico_chamado($conexao_com_banco, $id_chamado,'DEU UMA NOTA PARA O ATENDIMENTO', $pessoa, 'Nota');
		//voltando para a pagina de chamados informando que a nota foi dada com sucesso
	header("Location:../listar.php?mensagem=Sua nota foi computada com sucesso!&resultado=sucesso");


	}


?>