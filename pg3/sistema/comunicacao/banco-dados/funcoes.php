<?php

function cadastrar_comunicacao($conexao_com_banco, $item, $titulo, $texto, $data_publicacao) {
	mysqli_query($conexao_com_banco, "INSERT INTO tb_comunicacao (NM_ITEM, NM_TITULO, NM_TEXTO, DT_PUBLICACAO, NM_STATUS) VALUES ('$item', '$titulo', '$texto', '$data_publicacao', 'Aberta')") 
	or die (mysqli_error($conexao_com_banco));

	return mysqli_insert_id($conexao_com_banco);
}

function editar_comunicacao($conexao_com_banco, $comunicacao, $item, $titulo, $texto, $data) {
	
	mysqli_query($conexao_com_banco, "UPDATE tb_comunicacao SET NM_ITEM='$item', NM_TITULO='$titulo', NM_TEXTO='$texto', DT_PUBLICACAO='$data' WHERE CD_COMUNICACAO='$comunicacao'") 
	or die (mysqli_error($conexao_com_banco));
	
}

	
function editar_status_comunicacao($conexao_com_banco, $comunicacao, $status) {
	mysqli_query($conexao_com_banco, "UPDATE tb_comunicacao SET NM_STATUS='$status' WHERE CD_COMUNICACAO='$comunicacao'") 
	or die (mysqli_error($conexao_com_banco));

}

function remover_comunicacao($conexao_com_banco, $id) {
	mysqli_query($conexao_com_banco, "DELETE FROM tb_comunicacao WHERE CD_COMUNICACAO='$id'")
	or die (mysqli_error($conexao_com_banco));
	
}

	
?>