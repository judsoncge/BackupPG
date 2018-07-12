<?php

include('../../banco-dados/conectar.php');

session_start();

//pegando o id do documento que contem o anexo
$novo_id_referente = $_GET['documento']; 

//pegando o cpf da pessoa que anexou
$novo_pessoa_enviou = $_GET['pessoa'];

//pegando o ano da diária de acordo com o ano atual 
date_default_timezone_set('America/Bahia');
$novo_data_criacao =  date('Y-m-d H:i:s');


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

	$id_anexo = "ANEXODOCUMENTO_" . $novo_pessoa_enviou . $novo_data_criacao;
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
	echo "<script>history.back();</script>";
	echo "<script>alert('Insira um arquivo válido')</script>";
}

$id_historico = "HISTORICO_DOCUMENTO_" . $novo_pessoa_enviou . $novo_data_criacao;
$id_historico = str_replace('.', '', $id_historico);
$id_historico = str_replace('-', '', $id_historico);
$id_historico = str_replace(':', '', $id_historico);
$id_historico = str_replace(' ', '', $id_historico);

//chamando o cadastro no banco
include('../banco-dados/cadastrar.php');

?>