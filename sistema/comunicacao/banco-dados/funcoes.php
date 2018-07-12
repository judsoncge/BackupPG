<?php

function cadastrar_comunicacao($conexao_com_banco, $chapeu, $titulo, $intertitulo, $creditos, $texto, $data_publicacao){

	mysqli_query($conexao_com_banco, "INSERT INTO tb_comunicacao (NM_CHAPEU, NM_TITULO, NM_INTERTITULO, NM_CREDITOS, TX_NOTICIA, DT_PUBLICACAO, NM_STATUS) VALUES ('$chapeu', '$titulo', '$intertitulo', '$creditos','$texto', '$data_publicacao', 'OCULTADA')") or die (mysqli_error($conexao_com_banco));

	return mysqli_insert_id($conexao_com_banco);
}



function editar_comunicacao($conexao_com_banco, $chapeu, $titulo, $intertitulo, $creditos, $texto, $data_publicacao, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_comunicacao SET NM_CHAPEU='$chapeu', NM_TITULO='$titulo', NM_INTERTITULO='$intertitulo', NM_CREDITOS='$creditos', TX_NOTICIA='$texto', DT_PUBLICACAO='$data_publicacao' WHERE ID='$id'") 
	or die (mysqli_error($conexao_com_banco));
	
}

function excluir_comunicacao($conexao_com_banco, $id){

	mysqli_query($conexao_com_banco, "DELETE FROM tb_comunicacao WHERE ID='$id'") 
	or die (mysqli_error($conexao_com_banco));
	
}

	
function editar_status_comunicacao($conexao_com_banco, $id, $status) {
	
	mysqli_query($conexao_com_banco, "UPDATE tb_comunicacao SET NM_STATUS='$status'	WHERE ID='$id'") 
	or die (mysqli_error($conexao_com_banco));

}


function adicionar_imagem_comunicacao($conexao_com_banco, $id, $legenda, $credito, $pequena, $nome_anexo){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos_comunicacao VALUES ('a', '$id', '$legenda', '$credito', '$pequena', '$nome_anexo')") or die (mysqli_error($conexao_com_banco));
}

function excluir_anexo_comunicacao($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos_comunicacao WHERE ID='$id'")
	or die (mysqli_error($conexao_com_banco));
	
}

function excluir_anexos_comunicacao($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos_comunicacao where ID_COMUNICACAO = '$id'") 
	or die (mysqli_error($conexao_com_banco));
	
	
}

function editar_imagem_comunicacao($conexao_com_banco, $nome_anexo, $legenda, $creditos, $pequena, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_anexos_comunicacao SET NM_ARQUIVO = '$nome_anexo', NM_LEGENDA='$legenda', NM_CREDITOS='$creditos', BL_PEQUENA='$pequena' WHERE ID = '$id'");
	
}
	
?>