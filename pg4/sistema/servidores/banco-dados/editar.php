<?php

if($_GET['operacao']=='info'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET NM_CARGO='$edita_cargo', CD_SETOR='$edita_setor', NM_NIVEL='$edita_nivel', NM_GRUPO='$edita_grupo', VLR_SALARIO='$edita_salario', NM_SERVIDOR='$edita_nome', SNM_SERVIDOR='$edita_sobrenome', DT_NOMEACAO='$edita_nomeacao', NM_SITUACAO_FUNCIONAL='$edita_situacao_funcional', NM_EMAIL='$edita_email_institucional' , NM_MATRICULA='$edita_matricula', NM_CEDIDO='$edita_cedido_por', NM_GRADUACAO='$edita_graduacao' WHERE CD_SERVIDOR='$edita_CPF' ") 
	or die (mysqli_error($conexao_com_banco));

	$linha = mysqli_affected_rows($conexao_com_banco);
	
	header("Location:../../../interface/servidores.php?sessionId=$num&mensagem=As informações foram atualizadas com sucesso!&resultado=sucesso");
	
}


if($_GET['operacao']=='foto'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET NM_ARQUIVO_FOTO='$edita_foto' WHERE CD_SERVIDOR='$pessoa' ")
	or die (mysqli_error($conexao_com_banco));

	if($atual!='../../../registros/fotos/default.jpg'){
		unlink($atual);
	}
	
	header("Location:../../../interface/edita-foto.php?sessionId=$num&mensagem=A foto foi alterada com sucesso!&resultado=sucesso");  
	
}


else if($_GET['operacao']=='senha'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET SENHA='$edita_nova_senha' WHERE CD_SERVIDOR='$pessoa' ") 
	or die (mysqli_error($conexao_com_banco));

	header("Location:../../../interface/edita-senha.php?sessionId=$num&mensagem=A senha foi alterada com sucesso!&resultado=sucesso");

		
}

else if($_GET['operacao']=='permissao'){
	
	mysqli_query($conexao_com_banco, "UPDATE permissao SET 

	VISUALIZAR_CHAMADO='$VISUALIZAR_CHAMADO',
	VISUALIZAR_TODOS_CHAMADO='$VISUALIZAR_TODOS_CHAMADO',
	ABRIR_CHAMADO='$ABRIR_CHAMADO',
	ABRIR_TODOS_CHAMADO='$ABRIR_TODOS_CHAMADO',
	EDITAR_CHAMADO='$EDITAR_CHAMADO',
	EXCLUIR_CHAMADO='$EXCLUIR_CHAMADO',
	FECHAR_CHAMADO='$FECHAR_CHAMADO',
	ENCERRAR_CHAMADO='$ENCERRAR_CHAMADO',
	VISUALIZAR_RELATORIO_CHAMADO='$VISUALIZAR_RELATORIO_CHAMADO',
	VISUALIZAR_COMUNICACAO='$VISUALIZAR_COMUNICACAO',
	CADASTRAR_COMUNICACAO='$CADASTRAR_COMUNICACAO',
	EDITAR_COMUNICACAO='$EDITAR_COMUNICACAO',
	EXCLUIR_COMUNICACAO='$EXCLUIR_COMUNICACAO',
	VISUALIZAR_DOCUMENTO='$VISUALIZAR_DOCUMENTO',
	VISUALIZAR_TODOS_SETOR_DOCUMENTO='$VISUALIZAR_TODOS_SETOR_DOCUMENTO',
	VISUALIZAR_TODOS_ORGAO_DOCUMENTO='$VISUALIZAR_TODOS_ORGAO_DOCUMENTO',
	CADASTRAR_DOCUMENTO='$CADASTRAR_DOCUMENTO',
	EDITAR_DOCUMENTO='$EDITAR_DOCUMENTO',
	EXCLUIR_DOCUMENTO='$EXCLUIR_DOCUMENTO',
	APROVAR_DOCUMENTO='$APROVAR_DOCUMENTO',
	SUGESTAO_DOCUMENTO='$SUGESTAO_DOCUMENTO',
	RESOLVER_DOCUMENTO='$RESOLVER_DOCUMENTO',
	VISUALIZAR_INDICE_PRODUTIVIDADE='$VISUALIZAR_INDICE_PRODUTIVIDADE',
	VISUALIZAR_TODOS_SETOR_INDICE_PRODUTIVIDADE='$VISUALIZAR_TODOS_SETOR_INDICE_PRODUTIVIDADE',
	VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE='$VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE',
	AVALIAR_ASSIDUIDADE='$AVALIAR_ASSIDUIDADE',
	NOTA_EXTRA_INDICE_PRODUTIVIDADE='$NOTA_EXTRA_INDICE_PRODUTIVIDADE',
	SER_AVALIADO_INDICE_PRODUTIVIDADE='$SER_AVALIADO_INDICE_PRODUTIVIDADE',
	VISUALIZAR_PROCESSO='$VISUALIZAR_PROCESSO',
	VISUALIZAR_TODOS_SETOR_PROCESSO='$VISUALIZAR_TODOS_SETOR_PROCESSO',
	VISUALIZAR_TODOS_ORGAO_PROCESSO='$VISUALIZAR_TODOS_ORGAO_PROCESSO',
	VISUALIZAR_ARQUIVADOS_PROCESSO='$VISUALIZAR_ARQUIVADOS_PROCESSO',
	VISUALIZAR_SAIRAM_PROCESSO='$VISUALIZAR_SAIRAM_PROCESSO',
	ABRIR_PROCESSO='$ABRIR_PROCESSO',
	EDITAR_PROCESSO='$EDITAR_PROCESSO',
	EXCLUIR_PROCESSO='$EXCLUIR_PROCESSO',
	DESPACHO_PROCESSO='$DESPACHO_PROCESSO',
	PARECER_PROCESSO='$PARECER_PROCESSO',
	CONCLUIR_PROCESSO='$CONCLUIR_PROCESSO',
	FINALIZAR_PROCESSO='$FINALIZAR_PROCESSO',
	ARQUIVAR_PROCESSO='$ARQUIVAR_PROCESSO',
	SAIDA_PROCESSO='$SAIDA_PROCESSO',
	VOLTAR_PROCESSO='$VOLTAR_PROCESSO',
	DEFINIR_RESPONSAVEIS_PROCESSO='$DEFINIR_RESPONSAVEIS_PROCESSO',
	SER_RESPONSAVEL_PROCESSO='$SER_RESPONSAVEL_PROCESSO',
	DESTINO_PROCESSO='$DESTINO_PROCESSO',
	PRAZO_PROCESSO='$PRAZO_PROCESSO',
	PRAZO_FINAL_PROCESSO='$PRAZO_FINAL_PROCESSO',
	VISUALIZAR_SERVIDORES='$VISUALIZAR_SERVIDORES',
	EDITAR_SERVIDORES='$EDITAR_SERVIDORES',
	EXCLUIR_SERVIDORES='$EXCLUIR_SERVIDORES',
	VISUALIZAR_SETOR_RELATORIO='$VISUALIZAR_SETOR_RELATORIO',
	VISUALIZAR_ORGAO_RELATORIO='$VISUALIZAR_ORGAO_RELATORIO',
	FAZER_OPERACOES_OUTROS_SETOR='$FAZER_OPERACOES_OUTROS_SETOR',
	FAZER_OPERACOES_OUTROS_ORGAO='$FAZER_OPERACOES_OUTROS_ORGAO'

	WHERE CD_SERVIDOR='$pessoa'") 

or die (mysqli_error($conexao_com_banco));

header("Location:../../../interface/servidores.php?sessionId=$num&mensagem=As permissões foram alteradas com sucesso!&resultado=sucesso");

		
}

?>