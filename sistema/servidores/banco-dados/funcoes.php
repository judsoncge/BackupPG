<?php
function existe_servidor($conexao_com_banco, $CPF){
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$CPF'");
	
	if(mysqli_num_rows($retornoquery) > 0){
		return true;
	}else{
		return false;
	}
	
}

function cadastrar_servidor($conexao_com_banco, $nome, $CPF, $funcao, $setor){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_servidores (NM_SERVIDOR, CD_SERVIDOR, NM_FUNCAO, ID_SETOR) VALUES ('$nome','$CPF', '$funcao', '$setor')") or die (mysqli_error($conexao_com_banco));
	
	$id = mysqli_insert_id($conexao_com_banco);

	return $id;
}

function editar_servidor($conexao_com_banco, $nome, $CPF, $funcao, $setor, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET NM_SERVIDOR = '$nome', CD_SERVIDOR = '$CPF', NM_FUNCAO = '$funcao', ID_SETOR = '$setor' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}


function editar_foto_servidor($conexao_com_banco, $nome_arquivo, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET NM_ARQUIVO_FOTO='$nome_arquivo' WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));
	
}

function editar_senha_servidor($conexao_com_banco, $senha, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET SENHA='$senha' WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));	
	
}


function excluir_servidor($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_permissoes WHERE ID_SERVIDOR='$id'") or die (mysqli_error($conexao_com_banco));
	mysqli_query($conexao_com_banco, "DELETE FROM tb_servidores WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));
	
	
}

function liberar_processos_servidor($id, $conexao_com_banco){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET ID_SERVIDOR_LOCALIZACAO=NULL WHERE ID_SERVIDOR_LOCALIZACAO='$id'") or die (mysqli_error($conexao_com_banco));		
	
}

function editar_status_servidor($conexao_com_banco, $status, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET NM_STATUS='$status' WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));	
	
}
?>
