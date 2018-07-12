<?php

include('../../iniciar.php');

if($_GET['operacao']=='info'){

	$id_documento = $_GET['documento'];

	$edita_numero_processo = $_POST['numero_processo']; 

	$edita_tipo_atividade = $_POST['tipo_atividade']; 

	$edita_tipo_documento = $_POST['tipo_documento'];

	$edita_interessado = $_POST['interessado']; 

	$edita_data_entrada = $_POST['data_entrada']; 
	
	$edita_prazo = $_POST['prazo'];	
	
	$data = date('Y-m-d');
	
	if($edita_numero_processo!=''){
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT DT_PRAZO FROM tb_processos WHERE CD_PROCESSO='$edita_numero_processo'");
		
		$result = mysqli_fetch_array($resultado);
		
		$prazo_processo = $result['DT_PRAZO'];
		
		if($prazo_processo < $edita_prazo){		
			echo "<script>alert('O prazo nao pode ser maior do que o prazo do processo que este documento está atrelado')</script>";
			echo "<script>history.back();</script>";
			die();
		}
		
		
	}
	
	if($edita_prazo < $data){
		echo "<script>alert('O prazo nao pode ser menor que a data de hoje')</script>";
		echo "<script>history.back();</script>";
		die();
	}

	if($edita_data_entrada > $edita_prazo){
		echo "<script>alert('A data de entrada nao pode ser maior que o prazo')</script>";
		echo "<script>history.back();</script>";
		die();
	}

	$edita_prioridade = $_POST['prioridade']; 
	
	$edita_descricao_fato = $_POST['descricao_fato']; 
	
	$edita_texto_documento = $_POST['texto_documento'];	
	
	$num = $_GET['sessionId'];
	
}

else if($_GET['operacao']=='aprovar'){
	
	$id_documento = $_GET['documento']; 
	
	$pessoa = $_GET['pessoa']; 

	$data_mensagem = date('Y-m-d H:i:s');

	$id_historico_documento = "HISTORICO_" . $id_documento . $data_mensagem;
	$id_historico_documento = arruma_id($id_historico_documento);
	
}

else if($_GET['operacao']=='desaprovar'){
	
	$id_documento = $_GET['documento']; 
	
	$pessoa = $_GET['pessoa']; 

	$data_mensagem = date('Y-m-d H:i:s');

	$id_historico_documento = "HISTORICO_" . $id_documento . $data_mensagem;
	$id_historico_documento = arruma_id($id_historico_documento);
	
}

else if($_GET['operacao']=='enviar'){
	
	$id_documento = $_GET['documento']; 

	$estacom = $_POST['enviar']; 

	$query = "SELECT CD_SETOR, NM_SERVIDOR FROM tb_servidores WHERE CD_SERVIDOR='$estacom'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	$nome='';
	$setor='';
	
	while($resultado = mysqli_fetch_array($lista)){
			$nome = $resultado['NM_SERVIDOR'];
			$setor = $resultado['CD_SETOR'];
	}
	
	$nome = strtoupper($nome);

	$pessoa = $_GET['pessoa']; 
	
	$data_mensagem = date('Y-m-d H:i:s');

	$id_historico_documento = "HISTORICO_" . $id_documento . $data_mensagem;
	$id_historico_documento = arruma_id($id_historico_documento);
	
	$num = $_GET['sessionId'];
	
}

else if($_GET['operacao']=='mensagem'){
	
	$mensagem = $_POST['resposta'];

	$mensagem = "DISSE: " . $mensagem;

	$pessoa = $_SESSION['CPF'];

	$data_mensagem = date('Y-m-d H:i:s');

	$id_documento = $_GET["documento"];

	$id_historico_documento = "HISTORICO_" . $id_documento . $data_mensagem;
	$id_historico_documento = arruma_id($id_historico_documento);

}

else if($_GET['operacao']=='resolver'){
	
	$id_documento = $_GET['documento']; 
	
	$pessoa = $_GET['pessoa']; 
	
	$data_mensagem = date('Y-m-d H:i:s');
	
	$data_resolvido = date('Y-m-d');

	$id_historico_documento = "HISTORICO_" . $id_documento . $data_mensagem;
	$id_historico_documento = arruma_id($id_historico_documento);
	
	$num = $_GET['sessionId'];

}

else if($_GET['operacao']=='sugerir'){
	
	$id_documento = $_GET['documento']; 

	$edita_sugestao = $_POST['sugestao_resposta']; 
	
	$edita_tipo_sugestao = $_POST['tipo_sugestao']; 

	$pessoa = $_GET['pessoa']; 
	
	$data_mensagem = date('Y-m-d H:i:s');

	$id_historico_documento = "HISTORICO_" . $id_documento . $data_mensagem;
	$id_historico_documento = arruma_id($id_historico_documento);
	
}

include('../banco-dados/editar.php');


?>