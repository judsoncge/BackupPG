<?php


include('../../banco-dados/conectar.php');

session_start();

$id = $_GET['comunicacao'];

$edita_item = $_POST["item"];

$edita_titulo = $_POST["titulo"];

$edita_texto = $_POST["texto"];

$edita_data_publicacao = $_POST["data_publicacao"];

$i = 0;

if($_FILES["imagem"] == null){
foreach ($_FILES["imagem"]["error"] as $key => $error){
	//gravando a foto numa variável de sessão
	$edita_foto = $_FILES['imagem']['name'][$i];
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
	$arqType = $_FILES['imagem']['type'][$i];
	//se o arquivo tiver um formato não aceito pelos mencionados acima...
	if(array_search($arqType,$tipos) === false){ 
		echo "
		<script type='text/javascript'>
		alert('Formato inválido');
		</script>
		";
	//se o formato for aceito...
	}else{ 
	//se já existir um arquivo com o mesmo nome na foto, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/fotos-noticias/".$edita_foto."")){ 
			$a = 1;
			while(file_exists("../../../registros/fotos-noticias/[$a]".$edita_foto."")){
			$a++;
			}
			$edita_foto = "[".$a."]".$edita_foto;
		}
	//salva a foto numa pasta chamada fotos
	if(!move_uploaded_file($_FILES['imagem']['tmp_name'][$i], "../../../registros/fotos-noticias/".$edita_foto)){ 
		}
	}
    
    $id_anexo = "ANEXONOTICIA_" . $edita_foto . date('H:i:s');
	$id_anexo = str_replace('.', '', $id_anexo);
	$id_anexo = str_replace('-', '', $id_anexo);
	$id_anexo = str_replace(':', '', $id_anexo);
    
    date_default_timezone_set('America/Bahia');


    mysqli_query($conexao_com_banco, "INSERT INTO anexo (id, id_referente, caminho)
 VALUES ('$id_anexo', '$id', '$edita_foto')") or die (mysqli_error($conexao_com_banco));
  //quantidade de linhas modificadas após a ação
    
    $i++;
	
}
}

date_default_timezone_set('America/Bahia');


if ($edita_data_publicacao == null){
    $edita_data_publicacao =  date('Y-m-d H:i:s');
}

include('../banco-dados/editar.php');

?>