<?php

include('../../iniciar.php');

$novo_item = $_POST["item"];

$novo_titulo = $_POST["titulo"];

$novo_texto = $_POST["texto"];

$novo_data_publicacao = $_POST["data_publicacao"];

$i = 0;

foreach ($_FILES["imagem"]["error"] as $key => $error){
	
	$novo_foto = $_FILES['imagem']['name'][$i];
	
	$novo_foto = retira_caracteres_especiais($novo_foto);
	
	$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png'); 
	
	$arqType = $_FILES['imagem']['type'][$i];
	
	if(array_search($arqType,$tipos) === false){ 
		echo "
		<script type='text/javascript'>
		alert('Formato inválido');
		</script>
		";
	
	}else{ 
	
	if(file_exists("../../../registros/fotos-noticias/".$novo_foto."")){ 
			$a = 1;
			while(file_exists("../../../registros/fotos-noticias/[$a]".$novo_foto."")){
			$a++;
			}
			$novo_foto = "[".$a."]".$novo_foto;
		}

	if(!move_uploaded_file($_FILES['imagem']['tmp_name'][$i], "../../../registros/fotos-noticias/".$novo_foto)){ 
		}
	}
    
    $id_comunicacao = "NOTICIA_" . $novo_item . date('Y-m-d H:i:s');
    $id_comunicacao = arruma_id($id_comunicacao);
	
	$id = 'ANEXO_'.$id_comunicacao;
	$id = arruma_id($id);

    mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos(ID, CD_REFERENTE, NM_ARQUIVO) VALUES ('$id', '$id_comunicacao', '$novo_foto')") or die (mysqli_error($conexao_com_banco));
    
    $i++;
	
}

if ($novo_data_publicacao == null){
    $novo_data_publicacao =  date('Y-m-d H:i:s');
}

$num = $_GET['sessionId'];

include('../banco-dados/cadastrar.php');

?>