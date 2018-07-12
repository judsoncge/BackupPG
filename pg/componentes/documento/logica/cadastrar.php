<?php

include('../../banco-dados/conectar.php');

session_start();

//pegando o mês de pagamento digitado pelo usuario no cadastro
if(isset($_POST['numero_processo'])){
	$novo_numero_processo = $_POST['numero_processo']; 
}else{
	$novo_numero_processo = "";
}

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_tipo_atividade = $_POST['tipo_atividade']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$novo_tipo_documento = $_POST['tipo_documento'];

//pegando o mês de competencia digitado pelo usuario no cadastro	
$novo_interessado = $_POST['interessado']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_data_entrada = $_POST['data_entrada']; 

//pegando o valor pago digitado pelo usuario no cadastro	
$novo_prazo = $_POST['prazo'];	

//pegando o tipo digitado pelo usuario no cadastro
$novo_descricao_fato = $_POST['descricao_fato'];	

//pegando o numero da portaria digitado pelo usuario no cadastro
$novo_texto_documento = $_POST['texto_documento']; 

//pegando o ano da diária de acordo com o ano atual 
date_default_timezone_set('America/Bahia');
$novo_data_criacao =  date('Y-m-d H:i:s');

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_criadopor = $_SESSION['CPF']; 

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_estacom = $_SESSION['CPF']; 

//criando um id para a diaria
$id = "DOCUMENTO_" . $novo_criadopor . $novo_data_criacao;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_prioridade = $_POST['prioridade']; 

//validando a anexo selecionada pelo usuário
if(is_file($_FILES["arquivo_anexo"]['tmp_name'])){
	//gravando a anexo numa variável de sessão
	$novo_anexo = $_FILES['arquivo_anexo']['name'];
	//tirar caracteres especiais
	
	$novo_anexo = str_replace(" ","_",$novo_anexo);
	$novo_anexo = str_replace("á","a",$novo_anexo);
	$novo_anexo = str_replace("Á","A",$novo_anexo);
	$novo_anexo = str_replace("à","a",$novo_anexo);
	$novo_anexo = str_replace("ã","a",$novo_anexo);
	$novo_anexo = str_replace("Ã","A",$novo_anexo);
	$novo_anexo = str_replace("â","a",$novo_anexo);
	$novo_anexo = str_replace("ä","a",$novo_anexo);
	$novo_anexo = str_replace("é","e",$novo_anexo);
	$novo_anexo = str_replace("è","e",$novo_anexo);
	$novo_anexo = str_replace("ê","e",$novo_anexo);
	$novo_anexo = str_replace("ë","e",$novo_anexo);
	$novo_anexo = str_replace("í","i",$novo_anexo);
	$novo_anexo = str_replace("ì","i",$novo_anexo);
	$novo_anexo = str_replace("î","i",$novo_anexo);
	$novo_anexo = str_replace("ï","i",$novo_anexo);
	$novo_anexo = str_replace("ó","o",$novo_anexo);
	$novo_anexo = str_replace("ò","o",$novo_anexo);
	$novo_anexo = str_replace("õ","o",$novo_anexo);
	$novo_anexo = str_replace("ô","o",$novo_anexo);
	$novo_anexo = str_replace("ö","o",$novo_anexo);
	$novo_anexo = str_replace("ú","u",$novo_anexo);
	$novo_anexo = str_replace("ù","u",$novo_anexo);
	$novo_anexo = str_replace("û","u",$novo_anexo);
	$novo_anexo = str_replace("ü","u",$novo_anexo);
	$novo_anexo = str_replace("ç","c",$novo_anexo);
	$novo_anexo = str_replace("Á","A",$novo_anexo);
	$novo_anexo = str_replace("À","A",$novo_anexo);
	$novo_anexo = str_replace("Ã","A",$novo_anexo);
	$novo_anexo = str_replace("Â","A",$novo_anexo);
	$novo_anexo = str_replace("Ä","A",$novo_anexo);
	$novo_anexo = str_replace("É","E",$novo_anexo);
	$novo_anexo = str_replace("È","E",$novo_anexo);
	$novo_anexo = str_replace("Ê","E",$novo_anexo);
	$novo_anexo = str_replace("Ë","E",$novo_anexo);
	$novo_anexo = str_replace("Í","I",$novo_anexo);
	$novo_anexo = str_replace("Ì","I",$novo_anexo);
	$novo_anexo = str_replace("Î","I",$novo_anexo);
	$novo_anexo = str_replace("Ï","I",$novo_anexo);
	$novo_anexo = str_replace("Ó","O",$novo_anexo);
	$novo_anexo = str_replace("Ò","O",$novo_anexo);
	$novo_anexo = str_replace("Õ","O",$novo_anexo);
	$novo_anexo = str_replace("Ô","O",$novo_anexo);
	$novo_anexo = str_replace("Ö","O",$novo_anexo);
	$novo_anexo = str_replace("Ú","U",$novo_anexo);
	$novo_anexo = str_replace("Ù","U",$novo_anexo);
	$novo_anexo = str_replace("Û","U",$novo_anexo);
	$novo_anexo = str_replace("Ü","U",$novo_anexo);
	$novo_anexo = str_replace("Ç","C",$novo_anexo);
	
	$novo_anexo = strtolower($novo_anexo);

	$id_anexo = "ANEXODOCUMENTO_" . $novo_criadopor . $novo_data_criacao;
	$id_anexo = str_replace('.', '', $id_anexo);
	$id_anexo = str_replace('-', '', $id_anexo);
	$id_anexo = str_replace(':', '', $id_anexo);
	$id_anexo = str_replace(' ', '', $id_anexo);
	
	$arqType = $_FILES['arquivo_anexo']['type'];
	
	//se já existir um arquivo com o mesmo nome na anexo, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/anexos/".$novo_anexo."")){ 
			$a = 1;
			while(file_exists("../../../registros/anexos/[$a]".$novo_anexo."")){
			$a++;
			}
			$novo_anexo = "[".$a."]".$novo_anexo;
		}
			
						
		
	//salva a anexo numa pasta chamada anexos
	if(!move_uploaded_file($_FILES['arquivo_anexo']['tmp_name'], "../../../registros/anexos/".$novo_anexo)){ 
		}
	
	
}else{
	$novo_anexo = '';
}

$id_historico = "HISTORICO_DOCUMENTO_" . $novo_criadopor . date('Y-m-d H:i:s');
$id_historico = str_replace('.', '', $id_historico);
$id_historico = str_replace('-', '', $id_historico);
$id_historico = str_replace(':', '', $id_historico);
$id_historico = str_replace(' ', '', $id_historico);

if($novo_numero_processo != null and $novo_numero_processo != ''){
	$id_processo = "HISTORICO_PROCESSO_" . $novo_numero_processo . $novo_criadopor . date('Y-m-d H:i:s');
	$id_processo = str_replace('.', '', $id_processo);
	$id_processo = str_replace('-', '', $id_processo);
	$id_processo = str_replace(':', '', $id_processo);
	$id_processo = str_replace(' ', '', $id_processo);
}

include('../banco-dados/cadastrar.php');

?>