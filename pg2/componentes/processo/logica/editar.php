<?php
include('../../iniciar.php');

if($_GET['operacao']=='info'){
	
	$processo = $_GET['processo'];

	$numero_processo1 = $_POST['numero_processo1'];
	
	$numero_processo2 = $_POST['numero_processo2'];
	
	$numero_processo3 = $_POST['numero_processo3'];

	$numero_processo_ok = $numero_processo1.' '.$numero_processo2.'/'.$numero_processo3;

	if($processo != $numero_processo_ok){
		$numero_processo_verificacao = $numero_processo_ok;
		
		$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_PROCESSO='$numero_processo_verificacao'");
		
		if(mysqli_num_rows($retornoquery) > 0){ 
			
			echo "<script>alert('Um processo com este número já existe!')</script>";
			echo "<script>history.back()</script>";
			die();
		}else{
			
			$edita_processo = $numero_processo_ok; 
		}
	}

	$edita_descricao = $_POST['descricao'];

	$edita_tipo = $_POST['tipo'];

	$edita_detalhes = $_POST["detalhes"];

	$edita_interessado = $_POST["interessado"];
	
	$data_hoje = date('Y-m-d H:i:s');
	
	$data = date('Y-m-d');
	
	$pessoa = $_SESSION['CPF'];
	
	$mensagem = 'EDITOU O PROCESSO';
	
	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
	$id_historico_processo = arruma_id($id_historico_processo);
	
	$num = $_GET['sessionId'];
	
}

else if($_GET['operacao']=='prazos'){
	
	$data = date('Y-m-d');
	
	if(isset($_POST['prazo']) and $_POST['prazo'] == $_GET['prazo'] and isset($_POST['prazo_final']) and $_POST['prazo_final'] == $_GET['prazo_final']){
		echo "<script>alert('Você não alterou nada')</script>";
		echo "<script>history.back()</script>";
		die();
	}
	
	if(isset($_POST['prazo'])){
		$prazo = $_POST['prazo'];
	}
	
	if(isset($_POST['prazo_final'])){
		$prazo_final = $_POST['prazo_final'];
	}
	
	if(isset($_POST['prazo']) and isset($_POST['prazo_final']) and ($prazo < $data) or ($prazo_final < $data)){
		echo "<script>alert('Nenhuma das datas podem ser menores que a data de hoje')</script>";
		echo "<script>history.back()</script>";
		die();
	}
	
	if(isset($_POST['prazo']) and isset($_POST['prazo_final']) and ($prazo > $prazo_final)){
		echo "<script>alert('O prazo parcial não pode ser menor do que o prazo final')</script>";
		echo "<script>history.back()</script>";
		die();
	}

	$cpf = $_SESSION["CPF"];

	$data_mensagem = date('Y-m-d H:i:s');

	$processo = $_GET["processo"];

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_mensagem;
	$id_historico_processo = arruma_id($id_historico_processo);

}

else if($_GET['operacao']=='mensagem'){
	
	
	$mensagem = $_POST['resposta'];

	$cpf = $_SESSION["CPF"];

	$data_mensagem = date('Y-m-d H:i:s');

	$processo = $_GET["processo"];

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_mensagem;
	$id_historico_processo = arruma_id($id_historico_processo);

}

else if($_GET['operacao']=='tramitar'){
	
	$processo = $_GET["processo"];
	
	$search = mysqli_query($conexao_com_banco, "SELECT * FROM tb_responsaveis_processos WHERE CD_PROCESSO='$processo'");

	if($_SESSION['cargo']=='Superintendente' and ($_GET['prazo']=='0000-00-00' and $_GET['prazo_final']=='0000-00-00' or mysqli_num_rows($search) == 0)){
		
		echo "<script>alert('Para poder tramitar, ponha os prazos e defina os responsáveis pelo processo');</script>";
		
		echo "<script>history.back();</script>";
		
		die();
		
	}
	
	$origem = $_SESSION['CPF'];

	$dados_destino = explode("//",$_POST['tramitar']);
	
	$destino = $dados_destino[0];
	
	$setor_destino = retorna_setor_servidor($destino, $conexao_com_banco);
	
	$nome_destino = strtoupper($dados_destino[1]);

	$mensagem = "TRAMITOU O PROCESSO  PARA " . $nome_destino; 

	$data_tramitacao = date('Y-m-d H:i:s');
					
	$id_tramitacao_processo = "TRAMITACAO_PROCESSO_" . $processo . $data_tramitacao;
	$id_tramitacao_processo = arruma_id($id_tramitacao_processo);

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_tramitacao;
	$id_historico_processo = arruma_id($id_historico_processo);
	
	$num = $_GET['sessionId'];
	
}


else if($_GET['operacao']=='sair'){

	$processo = $_GET["processo"];

	$status = 'Saiu';

	$pessoa = $_SESSION["CPF"];

	$mensagem = "DEU SAÍDA NO PROCESSO";

	$data_saida = date('Y-m-d H:i:s');
	
	$num = $_GET['sessionId'];

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_saida;
	$id_historico_processo = arruma_id($id_historico_processo);
		
}

else if($_GET['operacao']=='arquivar'){

	$processo = $_GET['processo'];

	$pessoa_arquivou = $_SESSION["CPF"];

	$data_hoje = date('Y-m-d H:i:s');
	
	$data_saida = date('Y-m-d');
	
	$status = 'Arquivado';

	$mensagem = 'ARQUIVOU O PROCESSO';
	
	$num = $_GET['sessionId'];

	if($_GET['situacao_final']=='Finalização em andamento'){
		$situacao_final = 'Finalizado';
	}else if($_GET['situacao_final']=='Finalização em atraso'){
		$situacao_final = 'Finalizado com atraso';
	}

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
	$id_historico_processo = arruma_id($id_historico_processo);
		
}

else if($_GET['operacao']=='desarquivar'){
	
	$pessoa = $_SESSION["CPF"];

	$mensagem = 'DESARQUIVOU O PROCESSO';

	$setor = $_SESSION["setor"];
	
	$status = 'Ativo';
	
	$prazo_final = $_GET['prazo_final'];

	$data = date('Y-m-d H:i:s');
	
	if($data<$prazo_final){
		$situacao_final = 'Finalização em atraso';
	}else{
		$situacao_final = 'Finalização em andamento';
	}

	$processo = $_GET["processo"];
	
	$num = $_GET['sessionId'];

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data;
	$id_historico_processo = arruma_id($id_historico_processo);
	
}

else if($_GET['operacao']=='voltar'){
	
	$pessoa = $_SESSION["CPF"];

	$mensagem = 'COLOCOU O PROCESSO DE VOLTA NO ÓRGÃO';

	$setor = $_SESSION["setor"];
	
	$status = 'Ativo';

	$data = date('Y-m-d H:i:s');

	$processo = $_GET["processo"];
	
	$num = $_GET['sessionId'];

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data;
	$id_historico_processo = arruma_id($id_historico_processo);
	
}

else if($_GET['operacao']=='concluir'){

	$processo = $_GET['processo'];

	if($_GET['anterior']=='Análise em atraso'){
		
		$situacao = 'Concluído com atraso';	
		$mensagem = "CONCLUIU O PROCESSO, PORÉM COM ATRASO";

	}else{
		
		$situacao = 'Concluído';
		$mensagem = "CONCLUIU O PROCESSO";
	
	}

	$pessoa_concluiu = $_SESSION["CPF"];
	
	$num = $_GET['sessionId'];

	$data_hoje = date('Y-m-d H:i:s');

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
	$id_historico_processo = arruma_id($id_historico_processo);
	
}


else if($_GET['operacao']=='finalizar'){

	$processo = $_GET['processo'];

	if($_GET['anterior']=='Finalização em atraso'){
		
		$situacao = 'Finalizado com atraso';	
		$mensagem = "FINALIZOU O PROCESSO, PORÉM COM ATRASO";

	}else{
		
		$situacao = 'Finalizado';
		$mensagem = "FINALIZOU O PROCESSO";
	
	}

	$pessoa_concluiu = $_SESSION["CPF"];
	
	$num = $_GET['sessionId'];

	$data_hoje = date('Y-m-d H:i:s');
	
	$data = date('Y-m-d');

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
	$id_historico_processo = arruma_id($id_historico_processo);
	
} else if($_GET['operacao']=='responsaveis'){

	$processo = $_GET['processo'];
	
	$responsaveis = $_POST['responsaveis'];

	$pessoa = $_SESSION["CPF"];

	$data_hoje = date('Y-m-d H:i:s');
	
	$mensagem = "DEFINIU RESPONSÁVEIS AO PROCESSO";

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
	$id_historico_processo = arruma_id($id_historico_processo);
	
} else if($_GET['operacao']=='remover_responsavel'){

	$processo = $_GET['processo'];
	
	$responsavel = $_GET['responsavel'];

	$pessoa = $_SESSION["CPF"];

	$data_hoje = date('Y-m-d H:i:s');
	
	$mensagem = "REMOVEU UM RESPONSÁVEL DO PROCESSO";

	$id_historico_processo = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
	$id_historico_processo = arruma_id($id_historico_processo);
	
}


include('../banco-dados/editar.php');
		
?>