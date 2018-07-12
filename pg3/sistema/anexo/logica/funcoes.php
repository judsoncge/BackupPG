<?php

$ROOT = ' http://'.$_SERVER['SERVER_NAME'].'/';
include($_SERVER['DOCUMENT_ROOT'].'/sistema/anexo/banco-dados/funcoes.php');

function cadastrar_anexo($conexao_com_banco, $novo_id_referente, $file, $tipo) {
	
	$caminho = '../../../registros/anexos/';
	if ($tipo == 'foto') {
		$caminho = '../../../registros/fotos/';
	} else if ($tipo == 'COMUNICACAO') {
		$caminho = '../../../registros/fotos-noticias/';
	}
	//verifica se de fato é um arquivo que foi anexado
	if(is_file($file['tmp_name'])){

		//a variavel recebe o nome do arquivo anexado pelo usuário
		$novo_anexo = $file['name'];
		
		//a variavel recebe o novo nome sem os caracteres especiais 
		$novo_anexo = retira_caracteres_especiais($novo_anexo);
		
		//a variavel recebe o tipo do arquivo
		$arqType = $file['type'];
		
		//verifica se este anexo já está gravado na pasta	
		if(file_exists($caminho.$novo_anexo)){ 
				
				//se sim, coloca um número na frente do anexo, para diferenciar o nome
				$a = 1;
				while(file_exists($caminho."[$a]".$novo_anexo."")){
				$a++;
				}
				//a variavel recebe [1]nome caso já tenha um gravado, [2]nome caso já tenham dois gravados na pasta, e assim por diante
				$novo_anexo = "[".$a."]".$novo_anexo;
			}
		
		//salva o arquivo na pasta de acordo com o tipo de anexo
		if(!move_uploaded_file($file['tmp_name'], $caminho.$novo_anexo)){ 
			}
		
		if ($tipo == 'ATIVIDADE') {
			cadastrar_anexo_atividade($conexao_com_banco, $novo_id_referente, $novo_anexo);
		} else if ($tipo == 'DOCUMENTO') {
			cadastrar_anexo_documento($conexao_com_banco, $novo_id_referente, $novo_anexo);
		} else if ($tipo == 'COMUNICACAO') {
			cadastrar_anexo_comunicacao($conexao_com_banco, $novo_id_referente, $novo_anexo);
		} else if ($tipo == 'DESPESA') {
			cadastrar_anexo_despesa($conexao_com_banco, $novo_id_referente, $novo_anexo);
		} else if ($tipo == 'foto') {
			if($_SESSION['foto']!='default.jpg'){
				unlink($caminho.$_SESSION['foto']);
			}
			cadastrar_foto_servidor($conexao_com_banco, $novo_id_referente, $novo_anexo);
			$_SESSION['foto'] = $novo_anexo;
		}
		
	}
}

function cadastrar_anexos($conexao_com_banco, $novo_id_referente, $file, $tipo) {
	$i = 0;
	$caminho = '../../../registros/anexos/';
	if ($tipo == 'foto') {
		$caminho = '../../../registros/fotos/';
	} else if ($tipo == 'COMUNICACAO') {
		$caminho = '../../../registros/fotos-noticias/';
	}
	foreach ($file["error"] as $key => $error){

		$novo_anexo = $file['name'][$key];
		
		$novo_anexo = retira_caracteres_especiais($novo_anexo);			
			
		$arqType = $file['type'][$key];		
		
		if(file_exists($caminho.$novo_anexo)){ 
			$a = 1;
			while(file_exists($caminho."[$a]".$novo_anexo."")){
			$a++;
			}
			$novo_anexo = "[".$a."]".$novo_anexo;
		}

		if(!move_uploaded_file($file['tmp_name'][$key], $caminho.$novo_anexo)){ 
		}
		echo $caminho.$novo_anexo.' ';	
	  
		if ($tipo == 'ATIVIDADE') {
				cadastrar_anexo_atividade($conexao_com_banco, $novo_id_referente, $novo_anexo);
		} else if ($tipo == 'DOCUMENTO') {
				cadastrar_anexo_documento($conexao_com_banco, $novo_id_referente, $novo_anexo);
		} else if ($tipo == 'COMUNICACAO') {
				cadastrar_anexo_comunicacao($conexao_com_banco, $novo_id_referente, $novo_anexo);
		} else if ($tipo == 'DESPESA') {
				cadastrar_anexo_despesa($conexao_com_banco, $novo_id_referente, $novo_anexo);
		}
		$i++;
	
	}			
			
	
}

function retorna_anexos($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_anexos WHERE CD_REFERENTE='$id'");
	
	return $resultado;
	
}

function retorna_anexos_documento($id_documento, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_anexos_documento WHERE CD_DOCUMENTO='$id_documento'");
	
	return $resultado;
	

}

function retorna_anexos_despesa($id_despesa, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_anexos_despesa WHERE ID_DESPESA='$id_despesa'");
	
	return $resultado;
	

}

function retorna_anexos_comunicacao($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_anexos_comunicacao WHERE CD_COMUNICACAO='$id'");
	
	return $resultado;
	
}


function retorna_nome_anexo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_ARQUIVO FROM tb_anexos WHERE ID='$id'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];

}

function retorna_anexo_comunicacao($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_anexos_comunicacao WHERE ID='$id'");
	
	$anexo = mysqli_fetch_object($resultado);
	
	return $anexo;

}

function retorna_anexo_documento($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_anexos_documento WHERE ID='$id'");
	
	$anexo = mysqli_fetch_object($resultado);
	
	return $anexo;

}


function excluir_anexo_comunicacao($id, $conexao_com_banco) {
	
	$anexo = retorna_anexo_comunicacao($id, $conexao_com_banco);	
	
	$nome_anexo = '../../../registros/fotos-noticias/'.$anexo -> NM_ARQUIVO;
	
	unlink($nome_anexo);
	
	remover_anexo_comunicacao($conexao_com_banco, $id);
}

function excluir_anexos_comunicacao($id, $conexao_com_banco) {
	
	$anexos = retorna_anexos_comunicacao($id, $conexao_com_banco);
	
	while($r = mysqli_fetch_object($anexos)){	
	
		excluir_anexo_comunicacao($r -> ID, $conexao_com_banco);
		
	}
			
}

function excluir_anexo_documento($id, $conexao_com_banco) {
	
	$anexo = retorna_anexo_documento($id, $conexao_com_banco);	
	
	$nome_anexo = '../../../registros/anexos/'.$anexo -> NM_ARQUIVO;
	
	//unlink($nome_anexo);
	
	remover_anexo_documento($conexao_com_banco, $id);
}

?>