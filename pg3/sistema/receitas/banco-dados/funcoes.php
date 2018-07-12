<?php

function existe_receita($conexao_com_banco, $id_receita){
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_tipos_receitas WHERE CD_RECEITA='$id_receita'");

	if(mysqli_num_rows($retornoquery) > 0){
		return true;
	}else{
		return false;
	}
}

function cadastrar_receita($conexao_com_banco, $codigo_receita, $descricao, $mes, $ano, $valor){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_receitas VALUES ('a', '$codigo_receita','$descricao', '$mes', '$ano', '$valor')")  or die (mysqli_error($conexao_com_banco));
	
	atualizar_caixa($mes, $ano, $valor, $conexao_com_banco);
	
}

function cadastrar_tipo_receita($conexao_com_banco, $codigo_receita, $nome_receita){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_tipos_receitas VALUES ('$codigo_receita','$nome_receita')") or die (mysqli_error($conexao_com_banco));
	
}

function excluir_receita($conexao_com_banco, $id_receita, $mes, $ano, $valor){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_receitas WHERE ID='$id_receita'") or die (mysqli_error($conexao_com_banco));
	
	atualizar_caixa($mes, $ano, -$valor, $conexao_com_banco);
	
}

?>