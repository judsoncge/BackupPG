<?php


include('../../banco-dados/conectar.php');

session_start();

$novo_item = $_POST["item"];

$novo_titulo = $_POST["titulo"];

$novo_texto = $_POST["texto"];

$novo_data_publicacao = $_POST["data_publicacao"];

$i = 0;

foreach ($_FILES["imagem"]["error"] as $key => $error){
	//gravando a foto numa variável de sessão
	$novo_foto = $_FILES['imagem']['name'][$i];
	//tirar caracteres especiais
	$novo_foto = str_replace(" ","_",$novo_foto);
	$novo_foto = str_replace("á","a",$novo_foto);
	$novo_foto = str_replace("à","a",$novo_foto);
	$novo_foto = str_replace("ã","a",$novo_foto);
	$novo_foto = str_replace("â","a",$novo_foto);
	$novo_foto = str_replace("ä","a",$novo_foto);
	$novo_foto = str_replace("é","e",$novo_foto);
	$novo_foto = str_replace("è","e",$novo_foto);
	$novo_foto = str_replace("ê","e",$novo_foto);
	$novo_foto = str_replace("ë","e",$novo_foto);
	$novo_foto = str_replace("í","i",$novo_foto);
	$novo_foto = str_replace("ì","i",$novo_foto);
	$novo_foto = str_replace("î","i",$novo_foto);
	$novo_foto = str_replace("ï","i",$novo_foto);
	$novo_foto = str_replace("ó","o",$novo_foto);
	$novo_foto = str_replace("ò","o",$novo_foto);
	$novo_foto = str_replace("õ","o",$novo_foto);
	$novo_foto = str_replace("ô","o",$novo_foto);
	$novo_foto = str_replace("ö","o",$novo_foto);
	$novo_foto = str_replace("ú","u",$novo_foto);
	$novo_foto = str_replace("ù","u",$novo_foto);
	$novo_foto = str_replace("û","u",$novo_foto);
	$novo_foto = str_replace("ü","u",$novo_foto);
	$novo_foto = str_replace("ç","c",$novo_foto);
	$novo_foto = strtolower($novo_foto);
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
	if(file_exists("../../../registros/fotos-noticias/".$novo_foto."")){ 
			$a = 1;
			while(file_exists("../../../registros/fotos-noticias/[$a]".$novo_foto."")){
			$a++;
			}
			$novo_foto = "[".$a."]".$novo_foto;
		}
	//salva a foto numa pasta chamada fotos
	if(!move_uploaded_file($_FILES['imagem']['tmp_name'][$i], "../../../registros/fotos-noticias/".$novo_foto)){ 
		}
	}
    
    $id_anexo = "ANEXONOTICIA_" . $novo_foto . date('H:i:s');
	$id_anexo = str_replace('.', '', $id_anexo);
	$id_anexo = str_replace('-', '', $id_anexo);
	$id_anexo = str_replace(':', '', $id_anexo);
    
    date_default_timezone_set('America/Bahia');


    $id = "NOTICIA_" . $novo_item . date('Y-m-d H:i:s');
    $id = str_replace('.', '', $id);
    $id = str_replace('-', '', $id);
    $id = str_replace(':', '', $id);
    $id = str_replace(' ', '', $id);

    mysqli_query($conexao_com_banco, "INSERT INTO anexo (id, id_referente, caminho)
 VALUES ('$id_anexo', '$id', '$novo_foto')") or die (mysqli_error($conexao_com_banco));
  //quantidade de linhas modificadas após a ação
    
    $i++;
	
}

date_default_timezone_set('America/Bahia');


if ($novo_data_publicacao == null){
    $novo_data_publicacao =  date('Y-m-d');
}


$id = "NOTICIA_" . $novo_item . date('Y-m-d H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/cadastrar.php');

?>