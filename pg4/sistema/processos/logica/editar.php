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

	$edita_assunto = $_POST['assunto'];
	
	$dias_prazo = retorna_dias_prazo_assunto_processo($conexao_com_banco, $edita_assunto);

	$novo_prazo = somar_data($_GET["entrada"], $dias_prazo);
	
	$edita_detalhes = $_POST["detalhes"];
	
	$edita_orgao = $_POST["orgao"];

	$edita_interessado = $_POST["interessado"];
	
	$mensagem = 'EDITOU O PROCESSO';
	
	$pessoa = $_SESSION['CPF'];
	
	$acao = 'Edição';
	
	editar_processo($conexao_com_banco, $processo, $edita_processo, $edita_assunto, $edita_detalhes, $edita_orgao, $edita_interessado, $novo_prazo);
	
	cadastrar_historico_processo($conexao_com_banco, $edita_processo, $mensagem, $pessoa, $acao);

	$pagina = $_GET["pagina"];

	header("Location:../".$pagina.".php?mensagem=As informações do processo foram editadas com sucesso!&resultado=sucesso");

}

else if($_GET['operacao']=='prazos'){
		
	$processo = $_GET['processo'];
	
	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Mudança de prazo';
	
	$prazo_atual = $_GET["prazo"];
	
	$novo_prazo = $_POST["prazo"];
	
	$justificativa = $_POST["justificativa"];
	
	if($novo_prazo == $prazo_atual){
		echo "<script>alert('Você não alterou nada')</script>";
		echo "<script>history.back()</script>";
		die();
	}elseif( ($novo_prazo < $prazo_atual) or ($novo_prazo < date('Y-m-d')) ){
		echo "<script>alert('O novo prazo não pode ser menor que o atual ou do que a data de hoje')</script>";
		echo "<script>history.back()</script>";
		die();
	}
	$data_mensagem = arruma_data($novo_prazo);
	$mensagem = "ATUALIZOU O PRAZO PARA " . $data_mensagem . ": " . $justificativa;	
	
	editar_prazo($conexao_com_banco, $novo_prazo, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		editar_prazo($conexao_com_banco, $novo_prazo, $r->CD_PROCESSO);
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $pessoa, $acao);
	}
		

	echo "<script>history.back()</script>";
}


else if($_GET['operacao']=='finalizar'){

	$processo = $_GET['processo'];
	
	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Finalização';
	
	if($_GET['operacao2']=='gabinete'){
		$status = 'Finalizado pelo gabinete';
	}else{
		$status = 'Finalizado pelo setor';
	}

	if($_GET['anterior']=='Atrasado'){
		$mensagem = "FINALIZOU O PROCESSO, PORÉM COM ATRASO";
	}else{
		$mensagem = "FINALIZOU O PROCESSO";
	}
	
	editar_status_processo($conexao_com_banco, $processo, $status);
	editar_status_documentos_processo($conexao_com_banco, $processo, 'Aprovado');
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		editar_status_processo($conexao_com_banco,  $r->CD_PROCESSO, $status);
		editar_status_documentos_processo($conexao_com_banco,  $r->CD_PROCESSO, 'Aprovado');
		cadastrar_historico_processo($conexao_com_banco,  $r->CD_PROCESSO, $mensagem, $pessoa, $acao);
		
	}

	echo '<script>history.back();</script>';
	
}

else if($_GET['operacao']=='desfazer_finalizacao'){
	
	$processo = $_GET["processo"];
	
	$prazo = $_GET["prazo"];
	
	$data_hoje = date("Y-m-d");
	
	$status_atual = $_GET["status"];
	
	if($status_atual=="Finalizado pelo gabinete"){
		$novo_status = "Finalizado pelo setor";
	}else{
		if($prazo < $data_hoje){
			$novo_status = "Atrasado";
		}else{
			$novo_status = "Em andamento";
		}
	}
	
	
	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Finalização desfeita';
	
	$mensagem = 'DESFEZ A FINALIZAÇÃO';
	
	editar_status_processo($conexao_com_banco, $processo, $novo_status);
	editar_status_documentos_processo($conexao_com_banco, $processo, 'Em análise');
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		editar_status_processo($conexao_com_banco, $r->CD_PROCESSO, $novo_status);
		editar_status_documentos_processo($conexao_com_banco, $r->CD_PROCESSO, 'Em análise');
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $pessoa, $acao);
		
	}
	
	echo '<script>history.back();</script>';
	
}


else if($_GET['operacao']=='arquivar'){

	$processo = $_GET['processo'];

	$pessoa = $_SESSION["CPF"];

	$data_hoje = date('Y-m-d H:i:s');
	
	$data_saida = date('Y-m-d');

	$mensagem = 'ARQUIVOU O PROCESSO';
	
	$acao = 'Arquivamento';
	
	$status = 'Arquivado';
	
	arquivar_sair_processo($conexao_com_banco, $data_saida, $status,  $processo);
	editar_status_documentos_processo($conexao_com_banco, $processo, 'Resolvido');
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		arquivar_sair_processo($conexao_com_banco, $data_saida, $status,  $r->CD_PROCESSO);
		editar_status_documentos_processo($conexao_com_banco,  $r->CD_PROCESSO, 'Resolvido');
		cadastrar_historico_processo($conexao_com_banco,  $r->CD_PROCESSO, $mensagem, $pessoa, $acao);
		
	}
	
	$pagina = $_GET["pagina"];

	header("Location:../".$pagina.".php?mensagem=O Processo foi arquivado com sucesso!&resultado=sucesso");
}

else if($_GET['operacao']=='desarquivar'){
	
	$pessoa = $_SESSION["CPF"];
	
	$setor = $_SESSION["setor"];
	
	$mensagem = 'DESARQUIVOU O PROCESSO';	
	
	$processo = $_GET["processo"];
	
	$acao = 'Desarquivamento';
	
	$setor_finalizou = retorna_setor_finalizou($conexao_com_banco, $processo);
	
	if($setor_finalizou == 'GAB'){
		$status = 'Finalizado pelo gabinete';
	}else{
		$status = 'Finalizado pelo setor';
	}

	desarquivar_processo($conexao_com_banco, $status, $pessoa, $setor, $processo);
	editar_status_documentos_processo($conexao_com_banco, $processo, 'Aprovado');
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		desarquivar_processo($conexao_com_banco, $status, $pessoa, $setor, $r->CD_PROCESSO);
		editar_status_documentos_processo($conexao_com_banco, $r->CD_PROCESSO, 'Aprovado');
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $pessoa, $acao);
		
	}
	
	$pagina = $_GET["pagina"];

	header("Location:../".$pagina.".php?mensagem=O Processo foi desarquivado com sucesso!&resultado=sucesso");

}

else if($_GET['operacao']=='sair'){

	$processo = $_GET['processo'];

	$pessoa = $_SESSION["CPF"];

	$data_hoje = date('Y-m-d H:i:s');
	
	$data_saida = date('Y-m-d');

	$mensagem = 'DEU SAÍDA NO PROCESSO';
	
	$acao = 'Saída';
	
	$status = 'Saiu';

	arquivar_sair_processo($conexao_com_banco, $data_saida, $status, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		arquivar_sair_processo($conexao_com_banco, $data_saida, $status, $r->CD_PROCESSO);
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $pessoa, $acao);
		
	}
	
	$pagina = $_GET["pagina"];

	header("Location:../".$pagina.".php?mensagem=O Processo saiu com sucesso!&resultado=sucesso");
}



else if($_GET['operacao']=='voltar'){
	
	$pessoa = $_SESSION["CPF"];
	
	$setor = $_SESSION["setor"];
	
	$mensagem = 'COLOCOU O PROCESSO DE VOLTA NO ÓRGÃO';	
	
	$processo = $_GET["processo"];
	
	$acao = 'Voltar';
	
	$setor_finalizou = retorna_setor_finalizou($conexao_com_banco, $processo);
	
	$status = 'Em andamento';
	
	$assunto = $_GET["assunto"];
	
	$dias_prazo = retorna_dias_prazo_assunto_processo($conexao_com_banco, $assunto);

	$prazo = somar_data(date('Y-m-d'), $dias_prazo);

	voltar_processo($conexao_com_banco, $pessoa, $setor, $prazo, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		voltar_processo($conexao_com_banco, $pessoa, $setor, $prazo, $r->CD_PROCESSO);
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $pessoa, $acao);
		
	}
	
	$pagina = $_GET["pagina"];

	header("Location:../".$pagina.".php?mensagem=O Processo voltou para o órgão com sucesso!&resultado=sucesso");

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
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		cadastrar_responsaveis_processo($conexao_com_banco, $r->CD_PROCESSO, $responsaveis);
	}
	
	
	echo "<script>history.back();</script>";
	
} 

else if($_GET['operacao']=='apensar'){

	$processo = $_GET['processo'];
	
	$apensos = $_POST['apensos'];
	
	$mensagem = "DEFINIU APENSOS AO PROCESSO";

	$pessoa = $_SESSION["CPF"];

	$acao = 'Apensar';	
	
	cadastrar_apensos_processo($conexao_com_banco, $processo, $apensos);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	echo "<script>history.back();</script>";
	
}



else if($_GET['operacao']=='remover_responsavel'){

	$processo = $_GET['processo'];
	
	$responsavel = $_GET['responsavel'];
	
	$mensagem = "REMOVEU UM RESPONSÁVEL DO PROCESSO";

	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Responsáveis';
	
	$lider = $_GET['lider'];
	
	remover_responsavel_processo($conexao_com_banco, $processo, $responsavel);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);
	
	if($responsavel == $lider){
		remover_lider_processo($conexao_com_banco, $processo);
	}
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		remover_responsavel_processo($conexao_com_banco, $r->CD_PROCESSO, $responsavel);
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $pessoa, $acao);
		
		if($responsavel == $lider){
			remover_lider_processo($conexao_com_banco, $r->CD_PROCESSO);
		}
		
	}

	echo "<script>history.back();</script>";
}

else if($_GET['operacao']=='tramitar'){
	
	$processo = $_GET["processo"];
	
	$funcao = $_SESSION['funcao'];
	
	$lider = $_GET['lider'];
	
	$tem_responsavel = retorna_responsaveis($conexao_com_banco, $processo);

	if(($_SESSION['cargo']=='Superintendente' or $funcao == 'Assessor Técnico Setor') and mysqli_num_rows($tem_responsavel) == 0){
		
		echo "<script>alert('Para poder tramitar, defina os responsáveis pelo processo');</script>";
		
		echo "<script>history.back();</script>";
		
		die();
		
	}
	
	if($lider == '' and ($_SESSION['cargo']=='Superintendente' or $funcao == 'Assessor Técnico Setor')){
		
		echo "<script>alert('Para poder tramitar, defina um responsável líder pelo processo');</script>";
		
		echo "<script>history.back();</script>";
		
		die();
		
	}
	
	$dados_destino = explode("//",$_POST['tramitar']);
	
	$destino = $dados_destino[0];
	
	$servidor_destino = retorna_dados_servidor($destino, $conexao_com_banco);
		
	$origem = $_SESSION['CPF'];
	
	$servidor_origem = retorna_dados_servidor($_SESSION['CPF'], $conexao_com_banco);
	
	$setor_destino = $servidor_destino -> CD_SETOR;
	
	$nome_destino = strtoupper($dados_destino[1]);

	$mensagem = "TRAMITOU O PROCESSO PARA " . $nome_destino; 

	$data_tramitacao = date('Y-m-d H:i:s');
	
	$acao = 'Tramitação';
	$servidor_origem = retorna_dados_servidor($origem, $conexao_com_banco);
	$servidor_destino = retorna_dados_servidor($destino, $conexao_com_banco);
	
	$acao = 'Tramitação';
	if (str_replace('SUP-','',$servidor_origem -> CD_SETOR) ==  str_replace('SUP-','',$servidor_destino -> CD_SETOR)) {
		$recebido = 1;
	} else {
		$recebido = 0;
	}
	registrar_tramitacao($processo, $servidor_origem, $servidor_destino, $data_tramitacao, $conexao_com_banco);
	tramitar_processo($conexao_com_banco, $origem, $destino, $setor_destino, $processo, $recebido);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $origem, $acao);
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		registrar_tramitacao($r->CD_PROCESSO, $servidor_origem, $servidor_destino, $data_tramitacao, $conexao_com_banco);
		tramitar_processo($conexao_com_banco, $origem, $destino, $setor_destino, $r->CD_PROCESSO, $recebido);
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $origem, $acao);	
	}

	$pagina = $_GET["pagina"];

	header("Location:../geral.php?mensagem=O Processo foi tramitado com sucesso para ".$nome_destino."!&resultado=sucesso");
	
} 

else if($_GET['operacao']=='auto_tramite'){
	
	$funcao = $_SESSION['funcao'];
	
	$lider = $_GET['lider'];
	
	$processo = $_GET["processo"];
	
	$assunto = retorna_assunto_processo($processo, $conexao_com_banco);
	
	if($assunto == ''){
		echo "<script>alert('O processo está sem assunto. Não sei para quem tramitar! =(');</script>";
		
		echo "<script>history.back();</script>";
		
		die();
		
	}
	
	if($funcao==''){
		
		echo "<script>alert('Você não faz parte do fluxo padrão do trâmite de processo. Por favor, utilize o trâmite manual localizado em detalhes.');</script>";
		
		echo "<script>history.back();</script>";
		
		die();
		
	}
	
	
	
	$tem_responsavel = retorna_responsaveis($conexao_com_banco, $processo);

	if(($_SESSION['cargo']=='Superintendente' or $funcao == 'Assessor Técnico Setor') and mysqli_num_rows($tem_responsavel) == 0){
		
		echo "<script>alert('Para poder tramitar, defina os responsáveis pelo processo');</script>";
		
		echo "<script>history.back();</script>";
		
		die();
		
	}
	
	if($lider == '' and ($_SESSION['cargo']=='Superintendente' or $funcao == 'Assessor Técnico Setor')){
		
		echo "<script>alert('Para poder tramitar, defina um responsável líder pelo processo');</script>";
		
		echo "<script>history.back();</script>";
		
		die();
		
	}
	
	$origem = $_SESSION['CPF'];
	
	$status = retorna_status_processo($processo, $conexao_com_banco);
	
	$dados_destino = retorna_proximo_fluxo_processo($funcao, $status, $processo, $assunto, $conexao_com_banco);
	
	$destino = $dados_destino[0];
	
	$setor_destino = $dados_destino[3];
	
	$nome_destino = strtoupper($dados_destino[1] . " " . $dados_destino[2]);
	
	$funcao_destino = $dados_destino[4];
	
	if($funcao_destino == "Superintendente sem assessor"){
		definir_responsavel_processo($conexao_com_banco, $processo, $destino);
		definir_lider_processo($conexao_com_banco, $processo, $destino);
	}

	$mensagem = "TRAMITOU O PROCESSO PARA " . $nome_destino; 

	$data_tramitacao = date('Y-m-d H:i:s');
	
	$servidor_origem = retorna_dados_servidor($origem, $conexao_com_banco);
	$servidor_destino = retorna_dados_servidor($destino, $conexao_com_banco);
	
	$acao = 'Tramitação';
	
	if (str_replace('SUP-','',$servidor_origem -> CD_SETOR) ==  str_replace('SUP-','',$servidor_destino -> CD_SETOR)) {
		$recebido = 1;
	} else {
		$recebido = 0;
	}
	registrar_tramitacao($processo, $servidor_origem, $servidor_destino, $data_tramitacao, $conexao_com_banco);
	tramitar_processo($conexao_com_banco, $origem, $destino, $setor_destino, $processo, $recebido);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $origem, $acao);
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		registrar_tramitacao($r->CD_PROCESSO, $servidor_origem, $servidor_destino, $data_tramitacao, $conexao_com_banco);
		tramitar_processo($conexao_com_banco, $origem, $destino, $setor_destino, $r->CD_PROCESSO, $recebido);
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $origem, $acao);
		if($funcao_destino == "Superintendente sem assessor"){
			definir_responsavel_processo($conexao_com_banco, $r->CD_PROCESSO, $destino);
			definir_lider_processo($conexao_com_banco, $r->CD_PROCESSO, $destino);
		}	
	}

	$pagina = $_GET["pagina"];

	header("Location:../geral.php?mensagem=O Processo foi tramitado com sucesso para ".$nome_destino."!&resultado=sucesso");
	
}

else if($_GET['operacao']=='lider'){
	
	$lider = $_POST['lider'];
	
	$processo = $_GET['processo'];
	
	$nome_lider = retorna_nome_servidor($lider, $conexao_com_banco);
	
	$mensagem = "DEFINIU " . $nome_lider ." COMO RESPONSÁVEL LÍDER DO PROCESSO";

	$pessoa = $_SESSION["CPF"];
	
	$acao = 'Líder';
	
	cadastrar_lider_processo($conexao_com_banco, $processo, $lider);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $pessoa, $acao);	
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		
		cadastrar_lider_processo($conexao_com_banco, $r->CD_PROCESSO, $lider);
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $pessoa, $acao);	
		
	}
	
	echo "<script>history.back();</script>";

}

else if($_GET['operacao']=='urgente'){
	$processo = $_GET["processo"];
	$valor = $_GET["valor"];
	
	
	$origem = $_SESSION['CPF'];

	$mensagem = "DESMARCOU A URGENCIA DESTE PROCESSO";
	if ($valor == 1) {
		$justificativa = $_POST['justificativa'];
		$mensagem = "MARCOU COMO URGENTE: " . $justificativa;
	}
	 

	$data_tramitacao = date('Y-m-d H:i:s');
	
	$acao = 'Urgente';

	definir_urgencia_processo($conexao_com_banco, $valor, $processo);
	cadastrar_historico_processo($conexao_com_banco, $processo, $mensagem, $origem, $acao);
	
	
	$processos_apensados = retorna_apensos_processo($processo, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($processos_apensados)){
		definir_urgencia_processo($conexao_com_banco, $valor, $r->CD_PROCESSO);
		cadastrar_historico_processo($conexao_com_banco, $r->CD_PROCESSO, $mensagem, $origem, $acao);
	}

	echo "<script>history.back();</script>";
	
} else if($_GET['operacao']=='cadastrar_orgao'){
	
		$cd_orgao = $_POST['cd_orgao'];
	
	$nm_orgao = $_POST['nm_orgao'];
	
	
	cadastrar_orgao($conexao_com_banco, $cd_orgao, $nm_orgao);


	echo "<script>history.back();</script>";

}





		
?>