<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
date_default_timezone_set('America/Bahia');
session_start();

if($_GET['operacao'] == 'info'){

	$processo = $_GET['processo'];

	$numero1 = $_POST["numero_processo1"];

	$numero2 = $_POST["numero_processo2"];

	$numero3 = $_POST["numero_processo3"];

	$numero_processo = $numero1 . " " . $numero2 . "/" . $numero3;

	if($processo != $numero_processo){

	$existe_processo = existe_processo($conexao_com_banco, $numero_processo);  

		if($existe_processo){ 
			echo "<script>alert('Este número de processo já está cadastrado. Tente outro')</script>";
			echo "<script>history.back();</script>";
			die();
		}
		
	}

	$assunto = $_POST["assunto"];

	$orgao = $_POST["orgao"];

	$interessado = strtoupper($_POST["interessado"]);

	$detalhes = strtoupper($_POST["detalhes"]);

	$nome_assunto = retorna_nome_assunto($assunto, $conexao_com_banco);

	$urgencia = 0;

	$servidor = $_SESSION["id"]; 

	$setor = $_SESSION["setor"];
		
	if ($nome_assunto == "LAI" or $nome_assunto == "Ouvidoria" or $nome_assunto == "Pagamento") {
		$urgencia = 1;
	}

	$dias_prazo = retorna_dias_prazo_assunto($conexao_com_banco, $assunto);

	$prazo = somar_data($_GET["entrada"], $dias_prazo);

	$id = $_GET["id"];

	editar_processo($conexao_com_banco, $numero_processo, $urgencia, $assunto, $detalhes, $orgao, $interessado, $prazo, $id);

	$mensagem = "EDITOU O PROCESSO";

	$acao = "EDIÇÃO";

	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);
	
	Header("Location:../listar-ativos.php?mensagem=Operação realizada com sucesso!&resultado=sucesso");

}

elseif($_GET['operacao']=='anexar'){
	
	$servidor = $_SESSION["id"];
	
	$tipo = $_POST["tipo"];
	
	$mensagem = "ANEXOU UM(A) $tipo AO PROCESSO";
	
	$acao = "ANEXAR";
	
	$id = $_GET["id"];
	
	$caminho = "../../../registros/anexos/";
	
	$nome_anexo = cadastrar_anexo($_FILES['arquivo_anexo'], $caminho);
	
	anexar_documento_processo($conexao_com_banco, $id, $tipo, $servidor, $nome_anexo);
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);

	echo "<script>history.back();</script>";

}



elseif($_GET['operacao']=='excluir_documento'){
	
	$id_documento = $_GET["id_documento"];
	
	$nome_documento = "../../../registros/anexos/". $_GET["nome_documento"];
	
	excluir_documento_processo($conexao_com_banco, $id_documento);
	
	unlink($nome_documento);
	
	$mensagem = "EXCLUIU UM DOCUMENTO DO PROCESSO";
	
	$acao = "EXCLUIR ANEXO";
	
	$servidor = $_SESSION["id"];
	
	$id = $_GET["id"];
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);

	echo "<script>history.back();</script>";

}

elseif($_GET['operacao']=='solicitar_sobrestado'){
	
	$servidor = $_SESSION["id"];
	
	$id = $_GET["id"];
	
	$solicitacao = retorna_solicitacao_sobrestado_status($id, "SOLICITADO", $conexao_com_banco);
	
	if($solicitacao != NULL){
		
		echo "<script>alert('Já existe uma solicitação de sobrestado para este processo. Aguarde a resposta')</script>";
		echo "<script>history.back();</script>";
		die();
		
	}
	
	$justificativa = $_POST["justificativa"];
	
	$mensagem = "SOLICITOU COLOCAR PROCESSO EM SOBRESTADO: " . $justificativa;
	
	$acao = "SOBRESTADO";
	
	cadastrar_solicitacao_sobrestado($conexao_com_banco, $id, $servidor, $justificativa);
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);
	
	//marcar_sobrestado_processo($conexao_com_banco, $id);

	echo "<script>history.back();</script>";
}

elseif($_GET['operacao']=='urgencia'){
	
	$servidor = $_SESSION["id"];
	
	$mensagem = "MARCOU ESTE PROCESSO COMO URGENTE";
	
	$acao = "URGENTE";
	
	$id = $_GET["id"];
	
	marcar_urgencia_processo($conexao_com_banco, $id);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
		
		marcar_urgencia_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);

	echo "<script>history.back();</script>";

}

elseif($_GET['operacao']=='desmarcar_urgencia'){
	
	$servidor = $_SESSION["id"];
	
	$mensagem = "DESMARCOU A URGENCIA DESTE PROCESSO";
	
	$acao = "URGENTE";
	
	$id = $_GET["id"];
	
	desmarcar_urgencia_processo($conexao_com_banco, $id);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
		
		desmarcar_urgencia_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);

	echo "<script>history.back();</script>";

}

elseif($_GET['operacao']=='recebido'){
	
	$servidor_confirmou = $_SESSION["id"];
	
	$setor_servidor_confirmou = $_SESSION["setor"];
	
	$mensagem = "CONFIRMOU O RECEBIMENTO DO PROCESSO";
	
	$acao = "CONFIRMAR PROCESSO";
	
	$id_tramitacao = $_GET["tramitacao"];
	
	$id = $_GET["id"];
	
	confirmar_recebimento_processo($conexao_com_banco, $servidor_confirmou, $setor_servidor_confirmou, $id_tramitacao, $id);
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor_confirmou, $acao);

	echo "<script>history.back();</script>";

}

elseif($_GET['operacao']=='devolvido'){
	
	$id_tramitacao = $_GET["tramitacao"];
	
	$origem = retorna_servidor_origem($id_tramitacao, $conexao_com_banco);
	
	$nome_origem = strtoupper(retorna_nome_completo_servidor($origem, $conexao_com_banco));
	
	$setor_origem = retorna_setor_servidor($origem, $conexao_com_banco);
	
	$mensagem = "DEVOLVEU O PROCESSO PARA " . $nome_origem;
	
	$acao = "RETORNAR PROCESSO";
	
	$servidor = $_SESSION['id'];
	
	$id = $_GET["id"];
	
	recusar_recebimento_processo($conexao_com_banco, $id_tramitacao, $id, $origem, $setor_origem);
	
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
		
		tramitar_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $origem, $setor_origem);
		
	}
	
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);
	
	Header("Location:../listar-ativos.php?mensagem=O processo foi devolvido para $nome_origem com sucesso!&resultado=sucesso");

}



elseif($_GET['operacao']=='mensagem'){
	
	$id	= $_GET["id"];
	
	$servidor = $_SESSION['id'];
	
	$mensagem = "DISSE: " . $_POST["msg"];

	$acao = 'MENSAGEM';
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);
	
	echo "<script>history.back();</script>";
	
}

elseif($_GET['operacao']=='responsaveis'){

	$id = $_GET['id'];
	
	$responsaveis = $_POST['responsaveis'];
	
	$mensagem = "DEFINIU OS RESPONSÁVEIS DO PROCESSO";

	$servidor = $_SESSION['id'];

	$acao = 'RESPONSÁVEIS';	
	
	for ($i=0;$i<count($responsaveis);$i++){
		definir_responsavel_processo($conexao_com_banco, $id, $responsaveis[$i]);
	}
	
	//se tiver somente um responsavel na lista, ele automaticamente vira o resp. líder.
	if(count($responsaveis) == 1){
		
		$setor_responsavel = retorna_setor_servidor($responsaveis[0], $conexao_com_banco);
		
		definir_responsavel_lider($conexao_com_banco, $id, $responsaveis[0], $setor_responsavel);
	}	
	
	
	//Fazendo a mesma coisa com os processos apensados
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
		
		for ($i=0;$i<count($responsaveis);$i++){
			definir_responsavel_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $responsaveis[$i]);
		}
	
		//se tiver somente um responsavel na lista, ele automaticamente vira o resp. líder.
		if(count($responsaveis) == 1){
			$setor_responsavel = retorna_setor_servidor($responsaveis[0], $conexao_com_banco);
			
			definir_responsavel_lider($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $responsaveis[0]);
		}		
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
} 

elseif($_GET['operacao']=='remover_responsavel'){

	$id = $_GET['id'];
	
	$responsavel = $_GET['responsavel'];
	
	$mensagem = "REMOVEU UM RESPONSÁVEL DO PROCESSO";

	$servidor = $_SESSION['id'];

	$acao = 'REMOVER RESPONSÁVEL';	

	remover_responsavel_processo($conexao_com_banco, $id, $responsavel);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
		
		remover_responsavel_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $responsavel);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
} 

elseif($_GET['operacao']=='lider'){

	$id = $_GET['id'];
	
	$lider = $_POST['lider'];
	
	$mensagem = "DEFINIU O RESPONSÁVEL LÍDER DO PROCESSO";

	$servidor = $_SESSION['id'];

	$acao = 'RESPONSÁVEIS';	
	
	$setor_responsavel = retorna_setor_servidor($lider, $conexao_com_banco);
	
	definir_responsavel_lider_processo($conexao_com_banco, $id, $lider, $setor_responsavel);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
		
		definir_responsavel_lider_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $lider, $setor_responsavel);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
} 

elseif($_GET['operacao']=='lider'){

	$id = $_GET['id'];
	
	$lider = $_POST['lider'];
	
	$mensagem = "DEFINIU O RESPONSÁVEL LÍDER DO PROCESSO";

	$servidor = $_SESSION['id'];

	$acao = 'RESPONSÁVEIS';	
	
	$setor_responsavel = retorna_setor_servidor($lider, $conexao_com_banco);
	
	definir_responsavel_lider_processo($conexao_com_banco, $id, $lider, $setor_responsavel);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
		
		definir_responsavel_lider_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $lider, $setor_responsavel);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
} 

elseif($_GET['operacao']=='apensar'){

	$id = $_GET['id'];
	
	$sql_responsaveis_mae = retorna_responsaveis_processo($id, $conexao_com_banco);
	
	$lista_responsaveis_mae = mysqli_fetch_row($sql_responsaveis_mae);
	
	$responsavel_lider_mae = retorna_responsavel_lider_processo($id, $conexao_com_banco);
	
	$apensados = $_POST['apensos'];
	
	//quando varios processos sao apensados, o maior prazo e o que fica, tanto para o mae quanto para os apensados
	$maior_prazo = retorna_maior_prazo_apensados($id, $apensados, $conexao_com_banco);
	
	$mensagem = "APENSOU PROCESSOS A ESTE PROCESSO";

	$servidor = $_SESSION['id'];

	$acao = 'APENSAR';	
	
	//editando o prazo do processo mae
	editar_prazo_processo($conexao_com_banco, $maior_prazo, $id);
	
	for ($i=0;$i<count($apensados);$i++){
		
		//apensando...
		definir_apenso_processo($conexao_com_banco, $id, $apensados[$i]);
		
		//editando os prazos dos apensados
		editar_prazo_processo($conexao_com_banco, $maior_prazo, $apensados[$i]);
		
		//igualando todos os responsaveis com o do processo mae
		for($j=0;$j<count($lista_responsaveis_mae);$j++){
			definir_responsavel_processo($conexao_com_banco, $apensados[$i], $lista_responsaveis_mae[$j]);
		}
		
		//igualando todos os responsaveis lideres com o do processo mae
		definir_responsavel_lider_processo($conexao_com_banco, $apensados[$i], $responsavel_lider_mae);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
} 

elseif($_GET['operacao']=='remover_apenso'){

	$id = $_GET['id'];
	
	$apenso = $_GET['apenso'];
	
	$mensagem = "REMOVEU UM APENSO DO PROCESSO";

	$servidor = $_SESSION['id'];

	$acao = 'REMOVER APENSO';	

	remover_apenso_processo($conexao_com_banco, $id, $apenso);
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
} 

elseif($_GET['operacao']=='aceitar_sobrestado'){

	$id = $_GET['id'];
	
	$id_processo = $_GET['id_processo'];
	
	$mensagem = "ACEITOU A SOLICITAÇÃO E MARCOU O PROCESSO COMO SOBRESTADO";

	$servidor = $_SESSION['id'];

	$acao = 'SOBRESTADO';	

	marcar_sobrestado_processo($conexao_com_banco, $id_processo);
	
	aceitar_solicitacao_sobrestado($conexao_com_banco, $id, $servidor);
	
	cadastrar_historico_processo($conexao_com_banco, $id_processo, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
}

elseif($_GET['operacao']=='recusar_sobrestado'){

	$id = $_GET['id'];
	
	$id_processo = $_GET['id_processo'];
	
	$mensagem = "RECUSOU A SOLICITAÇÃO DE SOBRESTADO";

	$servidor = $_SESSION['id'];

	$acao = 'SOBRESTADO';	

	recusar_solicitacao_sobrestado($conexao_com_banco, $id, $servidor);
	
	cadastrar_historico_processo($conexao_com_banco, $id_processo, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
}

elseif($_GET['operacao']=='sobrestado'){

	$id = $_GET['id'];
	
	$mensagem = "MARCOU O PROCESSO COMO SOBRESTADO";

	$servidor = $_SESSION['id'];

	$acao = 'SOBRESTADO';	

	marcar_sobrestado_processo($conexao_com_banco, $id);
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
}

elseif($_GET['operacao']=='desmarcar_sobrestado'){

	$id = $_GET['id'];
	
	$mensagem = "DESMARCOU O SOBRESTADO DESTE PROCESSO";

	$servidor = $_SESSION['id'];

	$acao = 'SOBRESTADO';	

	desmarcar_sobrestado_processo($conexao_com_banco, $id);
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
}

elseif($_GET['operacao']=='finalizar_setor'){
	
	$status = "FINALIZADO PELO SETOR";
	
	$mensagem = "FINALIZOU O PROCESSO EM NOME DO SETOR";

	$acao = 'FINALIZAÇÃO';	
	
	$servidor = $_SESSION['id'];
	
	$id = $_GET['id'];

	finalizar_processo_setor($conexao_com_banco, $id, $status);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
	
		finalizar_processo_setor($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $status);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
}

elseif($_GET['operacao']=='finalizar_gabinete'){
	
	$status = "FINALIZADO PELO GABINETE";
	
	$mensagem = "FINALIZOU O PROCESSO EM NOME DO GABINETE";

	$acao = 'FINALIZAÇÃO';	
	
	$servidor = $_SESSION['id'];
	
	$id = $_GET['id'];

	finalizar_processo_gabinete($conexao_com_banco, $id, $status);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
	
		finalizar_processo_setor($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $status);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
}

elseif($_GET['operacao']=='desfazer_finalizacao'){
	
	$status = $_GET['status'];
	
	$mensagem = "DESFEZ A FINALIZAÇÃO";

	$acao = 'FINALIZAÇÃO DESFEITA';	
	
	$servidor = $_SESSION['id'];
	
	$id = $_GET['id'];

	desfazer_finalizacao_processo($conexao_com_banco, $id, $status);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
	
		desfazer_finalizacao_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $status);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	echo "<script>history.back();</script>";
	
}

elseif($_GET['operacao']=='arquivar'){
	
	$status = "ARQUIVADO";
	
	$mensagem = "ARQUIVOU O PROCESSO";

	$acao = 'ARQUIVAMENTO';	
	
	$servidor = $_SESSION['id'];
	
	$id = $_GET['id'];

	arquivar_processo($conexao_com_banco, $id, $status);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
	
		arquivar_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $status);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	Header("Location:../listar-ativos.php?mensagem=O processo foi arquivado com sucesso!&resultado=sucesso");
	
}

elseif($_GET['operacao']=='sair'){
	
	$status = "SAIU";
	
	$mensagem = "DEU SAÍDA NO PROCESSO";

	$acao = 'SAÍDA';	
	
	$servidor = $_SESSION['id'];
	
	$id = $_GET['id'];

	sair_processo($conexao_com_banco, $id, $status);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
	
		sair_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $status);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	Header("Location:../listar-ativos.php?mensagem=O processo saiu com sucesso!&resultado=sucesso");
	
}

elseif($_GET['operacao']=='tramitar'){
	
	$id	= $_GET["id"];
	
	$origem = $_SESSION['id'];
	
	$setor_origem = $_SESSION['setor'];

	$destino = $_POST['tramitar'];
	
	$r = retorna_servidor($destino, $conexao_com_banco);
	
	$servidor_destino = mysqli_fetch_array($r);	
	
	$setor_destino = $servidor_destino['ID_SETOR'];
	
	$funcao_origem = retorna_funcao_servidor($_SESSION['id'], $conexao_com_banco);
	
	$funcao_destino = retorna_funcao_servidor($servidor_destino['ID'], $conexao_com_banco);
	
	$status = retorna_status_processo($id, $conexao_com_banco);
	
	$nome_destino = strtoupper($servidor_destino['NM_SERVIDOR']);
	
	$mensagem = "TRAMITOU O PROCESSO PARA " . $nome_destino; 

	$acao = 'TRAMITAÇÃO';

	//nessa função tanto tramita quanto registra na tabela de tramitação
	tramitar_registrar_processo($conexao_com_banco, $id, $origem, $destino, $setor_origem, $setor_destino);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
		
		//nessa função apenas tramita e nao registra na tabela de tramitação, pois se aceitou o mae ja aceitou esses tambem.
		tramitar_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $destino, $setor_destino);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $origem, $acao);
	
	Header("Location:../listar-ativos.php?mensagem=O processo foi tramitado para $nome_destino com sucesso!&resultado=sucesso");

}

elseif($_GET['operacao']=='voltar'){
	
	$id = $_GET['id'];
	
	$status = "EM ANDAMENTO";
	
	$mensagem = "COLOCOU O PROCESSO DE VOLTA NO ÓRGÃO";

	$acao = 'VOLTAR';	
	
	$servidor = $_SESSION['id'];
	
	$setor = retorna_setor_servidor($servidor, $conexao_com_banco);
	
	$assunto = retorna_assunto_processo($id, $conexao_com_banco);
	
	$dias_prazo = retorna_dias_prazo_assunto($conexao_com_banco, $assunto);
	
	$data_atual = date('Y-m-d');

	$prazo = somar_data($data_atual, $dias_prazo);

	voltar_processo($conexao_com_banco, $id, $prazo, $servidor, $setor);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
	
		voltar_processo($conexao_com_banco, $r -> ID_PROCESSO_APENSADO, $prazo, $servidor, $setor);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	Header("Location:../detalhes.php?id=$id&mensagem=O processo voltou com sucesso!&resultado=sucesso");
	
}

elseif($_GET['operacao']=='desarquivar'){
	
	$servidor = $_SESSION["id"];
	
	$setor = $_SESSION["setor"];
	
	$mensagem = 'DESARQUIVOU O PROCESSO';	
	
	$id = $_GET["id"];
	
	$acao = 'DESARQUIVAMENTO';
	
	$setor_finalizou = retorna_setor_finalizou($id, $conexao_com_banco);
	
	if($setor_finalizou == 5){
		$status = 'FINALIZADO PELO GABINETE';
	}else{
		$status = 'FINALIZADO PELO SETOR';
	}

	desarquivar_processo($conexao_com_banco, $status, $servidor, $setor, $id);
	
	//Fazendo a mesma coisa com os processos apensados desse processo
	$apensados = retorna_processos_apensados($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($apensados)){
	
		desarquivar_processo($conexao_com_banco, $status, $servidor, $setor, $r -> ID_PROCESSO_APENSADO);
		
	}
	
	cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao);	
	
	Header("Location:../detalhes.php?id=$id&mensagem=O processo foi desarquivado com sucesso!&resultado=sucesso");
}



?>