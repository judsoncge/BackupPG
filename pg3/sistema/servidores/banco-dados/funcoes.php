<?php
function existe_servidor($conexao_com_banco, $servidor){
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$servidor'");
	
	if(mysqli_num_rows($retornoquery) > 0){
		return true;
	}else{
		return false;
	}
	
}

function cadastrar_servidor($conexao_com_banco, $cargo, $setor, $nivel, $grupo, $salario, $nome, $sobrenome , $nomeacao, $situacao_funcional, $CPF, $email_institucional , $matricula, $cedido_por , $graduacao, $novo_senha){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_servidores(NM_CARGO, CD_SETOR, NM_NIVEL, NM_GRUPO, VLR_SALARIO, NM_SERVIDOR, SNM_SERVIDOR, DT_NOMEACAO, NM_SITUACAO_FUNCIONAL, CD_SERVIDOR, NM_EMAIL, NM_MATRICULA, NM_CEDIDO, NM_GRADUACAO, NM_ARQUIVO_FOTO, SENHA) VALUES ('$cargo','$setor','$nivel','$grupo','$salario','$nome','$sobrenome ','$nomeacao','$situacao_funcional','$CPF','$email_institucional ','$matricula','$cedido_por ','$graduacao','default.jpg','$novo_senha')") or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "INSERT INTO permissao (ID, CD_SERVIDOR) VALUES ('A','$CPF')");

	
}

function editar_servidor($conexao_com_banco, $CPF_atual, $cargo, $setor, $nivel, $grupo, $salario, $nome, $sobrenome, $nomeacao, $situacao_funcional, $CPF, $email_institucional , $matricula, $cedido_por , $graduacao){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET NM_CARGO='$cargo', CD_SETOR='$setor', NM_NIVEL='$nivel', NM_GRUPO='$grupo', VLR_SALARIO='$salario', NM_SERVIDOR='$nome', SNM_SERVIDOR='$sobrenome', DT_NOMEACAO='$nomeacao', NM_SITUACAO_FUNCIONAL='$situacao_funcional',CD_SERVIDOR='$CPF',NM_EMAIL='$email_institucional' , NM_MATRICULA='$matricula', NM_CEDIDO='$cedido_por', NM_GRADUACAO='$graduacao' WHERE CD_SERVIDOR='$CPF_atual'") 
	or die (mysqli_error($conexao_com_banco));
	
	if($CPF_atual != $CPF){
		mysqli_query($conexao_com_banco, "UPDATE permissao SET CD_SERVIDOR='$CPF' WHERE CD_SERVIDOR='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
	}
	
}

function editar_senha_servidor($conexao_com_banco, $servidor, $senha){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET senha='$senha' WHERE CD_SERVIDOR='$servidor'") 
	or die (mysqli_error($conexao_com_banco));
	
}

function excluir_servidor($conexao_com_banco, $CPF){
	
	mysqli_query($conexao_com_banco, "DELETE FROM permissao WHERE CD_SERVIDOR='$CPF'") or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_servidores WHERE CD_SERVIDOR='$CPF'") or die (mysqli_error($conexao_com_banco));
	
}

function setar_permissao_servidor($conexao_com_banco, $servidor, $campo, $valor){
	
	mysqli_query($conexao_com_banco, "UPDATE permissao SET $campo='$valor' WHERE CD_SERVIDOR='$servidor'" ) or die (mysqli_error($conexao_com_banco));
	
}