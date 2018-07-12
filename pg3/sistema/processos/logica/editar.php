<?php
include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

if($_GET['operacao']=='info'){
	
	$processo = $_GET['processo'];

	$numero_processo1 = $_POST['numero_processo1'];
	
	$numero_processo2 = $_POST['numero_processo2'];
	
	$numero_processo3 = $_POST['numero_processo3'];

	$edita_processo = $numero_processo1.' '.$numero_processo2.'/'.$numero_processo3;

	if($processo != $edita_processo){
				
		$existe_processo = existe_processo($conexao_com_banco, $edita_processo);

		if($existe_processo == true){ 
			echo "<script>alert('Um processo com este número já existe!')</script>";
			echo "<script>history.back()</script>";
			die();
		}
	}

	$edita_descricao = $_POST['descricao'];

	$edita_tipo = $_POST['tipo'];
	
	$edita_detalhes = $_POST["detalhes"];

	$edita_interessado = $_POST["interessado"];
	
	$mensagem = 'EDITOU O PROCESSO';
	
	$pessoa = $_SESSION['CPF'];
	
	$acao = 'Edição';
	
	editar_processo($conexao_com_banco, $processo, $edita_processo, $edita_descricao, $edita_detalhes, $edita_interessado, $edita_tipo);
	
	cadastrar_historico_processo($conexao_com_banco, $edita_processo, $mensagem, $pessoa, $acao);

	echo '<script>history.back();</script>';
	echo '<script>history.back();</script>';

}

else if($_GET['operacao']=='prazos'){
	
	$data = date('Y-m-d');
	
	$processo = $_GET['processo'];
	
	$pessoa = $_SESSION["CPF"];

	$data_mensagem = date('Y-m-d H:i:s');
	
	$acao = 'Mudança de prazo';
	
	if((isset($_POST['prazo']) or $_POST['prazo']!='') and (!isset($_POST['prazo_final']) or $_POST['prazo_final']=='')){
		
		if($_POST['prazo'] == $_GET['prazo']){
			echo "<script>alert('Você não alterou nada')</script>";
			echo "<script>history.back()</script>";
			die();
		}else if($_POST['prazo'] < $data){
			echo "<script>alert('O prazo não pode ser menor que a data de hoje!')</script>";
			echo "<script>history.back()</script>";
			die();
		}else if($_GET['prazo_final']!='' and $_GET['prazo_final']!='0000-00-00'){
				if($_POST['prazo'] > $_GET['prazo_final']){
					echo "<script>alert('O prazo parcial não pode ser maior que o prazo final!')</script>";
					echo "<script>history.back()</script>";
					die();
		}}else{
			$mensagem = 'ATUALIZOU O PRAZO PARCIAL';
			editar_prazo($conexao_com_banco, $_POST['prazo'], $processo);
			cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
			echo '<script>history.back();</script>';
		}
	}
	
	if((isset($_POST['prazo_final']) or $_POST['prazo_final']!='') and (!isset($_POST['prazo']) or $_POST['prazo']=='')){
		if($_POST['prazo_final'] == $_GET['prazo_final']){
			echo "<script>alert('Você não alterou nada')</script>";
			echo "<script>history.back()</script>";
			die();
		}else if($_POST['prazo_final'] < $data){
			echo "<script>alert('O prazo não pode ser menor que a data de hoje!')</script>";
			echo "<script>history.back()</script>";
			die();
		}else if($_GET['prazo'] > $_POST['prazo_final']){
			echo "<script>alert('O prazo final não pode ser menor que o prazo parcial!')</script>";
			echo "<script>history.back()</script>";
			die();
		}else{
			$mensagem = 'ATUALIZOU O PRAZO FINAL';
			editar_prazo_final($conexao_com_banco, $_POST['prazo_final'], $processo);
			cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
			echo '<script>history.back();</script>';
		}
	}
	
	if(isset($_POST['prazo_final']) and $_POST['prazo_final']!='' and isset($_POST['prazo']) and $_POST['prazo']!=''){
		if($_POST['prazo_final'] == $_GET['prazo_final'] and $_POST['prazo'] == $_GET['prazo']){
			echo "<script>alert('Você não alterou nada')</script>";
			echo "<script>history.back()</script>";
			die();
		}else if($_POST['prazo_final'] < $data or $_POST['prazo'] < $data){
			echo "<script>alert('O prazo não pode ser menor que a data de hoje!')</script>";
			echo "<script>history.back()</script>";
			die();
		}else if($_POST['prazo'] > $_POST['prazo_final']){
			echo "<script>alert('O prazo final não pode ser menor que o prazo parcial!')</script>";
			echo "<script>history.back()</script>";
			die();
		}else if($_POST['prazo'] == $_GET['prazo']){
			$mensagem = 'ATUALIZOU O PRAZO FINAL';
			editar_prazo_final($conexao_com_banco, $_POST['prazo_final'], $processo);
			cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
			echo '<script>history.back();</script>';
		}else if($_POST['prazo_final'] == $_GET['prazo_final']){
			$mensagem = 'ATUALIZOU O PRAZO PARCIAL';
			editar_prazo($conexao_com_banco, $_POST['prazo'], $processo);
			cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
			echo '<script>history.back();</script>';
		}else{
			$mensagem = 'ATUALIZOU O PRAZO PARCIAL E FINAL';
			editar_prazos($conexao_com_banco, $_POST['prazo'], $_POST['prazo_final'], $processo);
			cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
			echo '<script>history.back();</script>';
		}
	}
}

else if($_GET['operacao']=='concluir'){

	$processo = $_GET['processo'];
	
	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Conclusão';

	if($_GET['anterior']=='Análise em atraso'){
		$situacao = 'Concluído com atraso';	
		$mensagem = "CONCLUIU O PROCESSO, PORÉM COM ATRASO";
	}else{
		$situacao = 'Concluído';
		$mensagem = "CONCLUIU O PROCESSO";
	}
	
	editar_situacao($conexao_com_banco, $situacao, $processo, $conexao_com_banco);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo '<script>history.back();</script>';
	
}

else if($_GET['operacao']=='finalizar'){

	$processo = $_GET['processo'];
	
	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Finalização';

	if($_GET['anterior']=='Finalização em atraso'){
		$situacao_final = 'Finalizado com atraso';	
		$mensagem = "FINALIZOU O PROCESSO, PORÉM COM ATRASO";
	}else{
		$situacao_final = 'Finalizado';
		$mensagem = "FINALIZOU O PROCESSO";
	}
	
	editar_situacao_final($conexao_com_banco, $situacao_final, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo '<script>history.back();</script>';
	
}

else if($_GET['operacao']=='desfazer_finalizacao'){
	
	$processo = $_GET["processo"];
	
	$prazo_final = $_GET["prazo_final"];
	
	$data_hoje = date("Y-m-d");
	
	if($prazo_final < $data_hoje){
		$nova_situacao_final = "Finalização em atraso";
	}else{
		$nova_situacao_final = "Finalização em andamento";
	}
	
	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Finalização desfeita';
	
	$mensagem = 'DESFEZ A FINALIZAÇÃO';
	
	editar_situacao_final($conexao_com_banco, $nova_situacao_final, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo '<script>history.back();</script>';
	
}


else if($_GET['operacao']=='arquivar'){

	$processo = $_GET['processo'];

	$pessoa = $_SESSION["CPF"];

	$data_hoje = date('Y-m-d H:i:s');
	
	$data_saida = date('Y-m-d');

	$mensagem = 'ARQUIVOU O PROCESSO';
	
	$acao = 'Arquivamento';

	if($_GET['situacao_final']=='Finalização em andamento'){
		$situacao_final = 'Finalizado';
	}else if($_GET['situacao_final']=='Finalização em atraso'){
		$situacao_final = 'Finalizado com atraso';
	}else{
		$situacao_final = $_GET['situacao_final'];
	}

	arquivar_processo($conexao_com_banco, $data_saida, $situacao_final, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	header("Location: ../setor.php");
}

else if($_GET['operacao']=='desarquivar'){
	
	$prazo_final = $_GET['prazo_final'];
	
	$pessoa = $_SESSION["CPF"];
	
	$setor = $_SESSION["setor"];
	
	$mensagem = 'DESARQUIVOU O PROCESSO';	

	$data = date('Y-m-d');
	
	$processo = $_GET["processo"];
	
	$acao = 'Desarquivamento';
	
	if($data < $prazo_final){
		$situacao_final = 'Finalização em atraso';
	}else{
		$situacao_final = 'Finalização em andamento';
	}

	desarquivar_processo($conexao_com_banco, $situacao_final, $pessoa, $setor, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	header("Location: ../setor.php");
	
		
}

else if($_GET['operacao']=='sair'){

	$processo = $_GET["processo"];

	$pessoa = $_SESSION["CPF"];

	$mensagem = "DEU SAÍDA NO PROCESSO";

	$data_saida = date('Y-m-d');
	
	$acao = 'Saída';
	
	sair_processo($conexao_com_banco, $data_saida, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo '<script>history.back();</script>';
	
}



else if($_GET['operacao']=='voltar'){
	
	$prazo_final = $_GET['prazo_final'];
	
	$pessoa = $_SESSION["CPF"];
	
	$setor = $_SESSION["setor"];
	
	$mensagem = 'COLOCOU O PROCESSO DE VOLTA NO ÓRGÃO';	

	$data = date('Y-m-d');
	
	$processo = $_GET["processo"];
	
	$acao = 'Voltar';
	
	if($data < $prazo_final){
		$situacao_final = 'Finalização em atraso';
	}else{
		$situacao_final = 'Finalização em andamento';
	}

	voltar_processo($conexao_com_banco, $situacao_final, $pessoa, $setor, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo '<script>history.back();</script>';

}

else if($_GET['operacao']=='mensagem'){

	$processo = $_GET["id"];
	
	$mensagem = $_POST['msg'];

	$pessoa = $_SESSION["CPF"];

	$acao = "Mensagem";

	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo '<script>history.back();</script>';
}

 else if($_GET['operacao']=='responsaveis'){

	$processo = $_GET['processo'];
	
	$responsaveis = $_POST['responsaveis'];
	
	$mensagem = "DEFINIU RESPONSÁVEIS AO PROCESSO";

	$pessoa = $_SESSION["CPF"];

	$acao = 'Responsáveis';	
	
	cadastrar_responsaveis_processo($conexao_com_banco, $processo, $responsaveis);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo "<script>history.back();</script>";
	
} else if($_GET['operacao']=='remover_responsavel'){

	$processo = $_GET['processo'];
	
	$responsavel = $_GET['responsavel'];
	
	$mensagem = "REMOVEU UM RESPONSÁVEL DO PROCESSO";

	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Responsáveis';
	
	remover_responsavel_processo($conexao_com_banco, $processo, $responsavel);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo "<script>history.back();</script>";
}

else if($_GET['operacao']=='tramitar'){
	
	$processo = $_GET["processo"];
	
	$tem_responsavel = retorna_responsaveis($conexao_com_banco, $processo);

	if($_SESSION['cargo']=='Superintendente' and ($_GET['prazo']=='0000-00-00' and $_GET['prazo_final']=='0000-00-00' or mysqli_num_rows($tem_responsavel) == 0)){
		
		echo "<script>alert('Para poder tramitar, ponha os prazos e defina os responsáveis pelo processo');</script>";
		
		echo "<script>history.back();</script>";
		
		die();
		
	}
	
	$origem = $_SESSION['CPF'];

	$dados_destino = explode("//",$_POST['tramitar']);
	
	$destino = $dados_destino[0];
	
	$setor_destino = retorna_setor_servidor($destino, $conexao_com_banco);
	
	$nome_destino = strtoupper($dados_destino[1]);

	$mensagem = "TRAMITOU O PROCESSO PARA " . $nome_destino; 

	$data_tramitacao = date('Y-m-d H:i:s');
	
	$acao = 'Tramitação';

	tramitar_processo($conexao_com_banco, $origem, $destino, $setor_destino, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $origem, $acao);
	echo "<script>history.back();</script>";
	echo "<script>history.back();</script>";
	
} else if($_GET['operacao']=='urgente'){
	$processo = $_GET["processo"];
	$valor = $_GET["valor"];
	
	
	$origem = $_SESSION['CPF'];

	$mensagem = "DESMARCOU COMO URGENTE";
	if ($valor == 1) {
		$mensagem = "MARCOU COMO URGENTE";
	}
	 

	$data_tramitacao = date('Y-m-d H:i:s');
	
	$acao = 'Urgente';

	definir_urgencia_processo($conexao_com_banco, $valor, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $origem, $acao);
	echo "<script>history.back();</script>";
	
}





		
?>