<?php

include('../../banco-dados/conectar.php');

$pessoa = $_GET['pessoa'];
$atual = $_GET['atual'];
$atual = '../../../registros/fotos/'.$atual;

//validando a foto selecionada pelo usuário
if(is_file($_FILES["arquivo_foto"]['tmp_name'])){
	//gravando a foto numa variável de sessão
	$edita_foto = $_FILES['arquivo_foto']['name'];
	//tirar caracteres especiais
	$edita_foto = str_replace(" ","_",$edita_foto);
	$edita_foto = str_replace("á","a",$edita_foto);
	$edita_foto = str_replace("à","a",$edita_foto);
	$edita_foto = str_replace("ã","a",$edita_foto);
	$edita_foto = str_replace("â","a",$edita_foto);
	$edita_foto = str_replace("ä","a",$edita_foto);
	$edita_foto = str_replace("é","e",$edita_foto);
	$edita_foto = str_replace("è","e",$edita_foto);
	$edita_foto = str_replace("ê","e",$edita_foto);
	$edita_foto = str_replace("ë","e",$edita_foto);
	$edita_foto = str_replace("í","i",$edita_foto);
	$edita_foto = str_replace("ì","i",$edita_foto);
	$edita_foto = str_replace("î","i",$edita_foto);
	$edita_foto = str_replace("ï","i",$edita_foto);
	$edita_foto = str_replace("ó","o",$edita_foto);
	$edita_foto = str_replace("ò","o",$edita_foto);
	$edita_foto = str_replace("õ","o",$edita_foto);
	$edita_foto = str_replace("ô","o",$edita_foto);
	$edita_foto = str_replace("ö","o",$edita_foto);
	$edita_foto = str_replace("ú","u",$edita_foto);
	$edita_foto = str_replace("ù","u",$edita_foto);
	$edita_foto = str_replace("û","u",$edita_foto);
	$edita_foto = str_replace("ü","u",$edita_foto);
	$edita_foto = str_replace("ç","c",$edita_foto);
	$edita_foto = strtolower($edita_foto);
	//verificando a extensão do arquivo postado, e só aceita jpg,jpeg,pjpeg,gif
	$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png'); 
	//pegando o tipo do arquivo
	$arqType = $_FILES['arquivo_foto']['type'];
	//se o arquivo tiver um formato não aceito pelos mencionados acima...
	if(array_search($arqType,$tipos) === false){ 
		echo "
		<meta http-equiv=refresh content='0; url=index.php'>
		<script type='text/javascript'>
		alert('Formato inválido');
		</script>
		";
	//se o formato for aceito...
	}else{ 
	//se já existir um arquivo com o mesmo nome na foto, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/fotos/".$edita_foto."")){ 
			$a = 1;
			while(file_exists("../../../registros/fotos/[$a]".$edita_foto."")){
			$a++;
			}
			$edita_foto = "[".$a."]".$edita_foto;
		}
	//salva a foto numa pasta chamada fotos
	if(!move_uploaded_file($_FILES['arquivo_foto']['tmp_name'], "../../../registros/fotos/".$edita_foto)){ 
		
		}
	}
	
}else{
	$edita_foto = $_GET['atual'];
}

include('../banco-dados/editar_foto.php');


?>