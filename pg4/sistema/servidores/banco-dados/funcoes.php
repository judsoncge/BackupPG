<?php
function existe_servidor($conexao_com_banco, $servidor){
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$servidor'");
	
	if(mysqli_num_rows($retornoquery) > 0){
		return true;
	}else{
		return false;
	}
	
}

function cadastrar_servidor($conexao_com_banco, $cargo, $funcao, $setor, $nivel, $grupo, $salario, $nome, $sobrenome , $nomeacao, $situacao_funcional, $CPF, $email_institucional , $matricula, $cedido_por , $graduacao, $novo_senha){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_servidores(NM_CARGO, NM_FUNCAO, CD_SETOR, NM_NIVEL, NM_GRUPO, VLR_SALARIO, NM_SERVIDOR, SNM_SERVIDOR, DT_NOMEACAO, NM_SITUACAO_FUNCIONAL, CD_SERVIDOR, NM_EMAIL, NM_MATRICULA, NM_CEDIDO, NM_GRADUACAO, NM_ARQUIVO_FOTO, SENHA) VALUES ('$cargo','$funcao','$setor','$nivel','$grupo','$salario','$nome','$sobrenome ','$nomeacao','$situacao_funcional','$CPF','$email_institucional ','$matricula','$cedido_por ','$graduacao','default.jpg','$novo_senha')") or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "INSERT INTO permissao (ID, CD_SERVIDOR) VALUES ('A','$CPF')");

	
}

function editar_servidor($conexao_com_banco, $CPF_atual, $cargo, $funcao, $setor, $nivel, $grupo, $salario, $nome, $sobrenome, $nomeacao, $situacao_funcional, $CPF, $email_institucional , $matricula, $cedido_por , $graduacao){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET NM_CARGO='$cargo', NM_FUNCAO='$funcao', CD_SETOR='$setor', NM_NIVEL='$nivel', NM_GRUPO='$grupo', VLR_SALARIO='$salario', NM_SERVIDOR='$nome', SNM_SERVIDOR='$sobrenome', DT_NOMEACAO='$nomeacao', NM_SITUACAO_FUNCIONAL='$situacao_funcional',CD_SERVIDOR='$CPF',NM_EMAIL='$email_institucional' , NM_MATRICULA='$matricula', NM_CEDIDO='$cedido_por', NM_GRADUACAO='$graduacao' WHERE CD_SERVIDOR='$CPF_atual'") 
	or die (mysqli_error($conexao_com_banco));
	
	
	if($CPF_atual != $CPF){
		mysqli_query($conexao_com_banco, "UPDATE permissao SET CD_SERVIDOR='$CPF' WHERE CD_SERVIDOR='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_acompanhamento_processo SET CD_SUPERINTENDENTE_RESPONSAVEL='$CPF' WHERE CD_SUPERINTENDENTE_RESPONSAVEL='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_acompanhamento_processo SET CD_SERVIDOR_RESPONSAVEL='$CPF' WHERE CD_SERVIDOR_RESPONSAVEL='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_chamados SET CD_SERVIDOR_REQUISITANTE='$CPF' WHERE CD_SERVIDOR_REQUISITANTE='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_CRIACAO='$CPF' WHERE CD_SERVIDOR_CRIACAO='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$CPF' WHERE CD_SERVIDOR_LOCALIZACAO='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_historico_chamados SET CD_SERVIDOR='$CPF' WHERE CD_SERVIDOR='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_historico_despesas SET CD_SERVIDOR='$CPF' WHERE CD_SERVIDOR='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_historico_documentos SET CD_SERVIDOR='$CPF' WHERE CD_SERVIDOR='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_historico_processos SET CD_SERVIDOR='$CPF' WHERE CD_SERVIDOR='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SERVIDOR_LOCALIZACAO='$CPF' WHERE CD_SERVIDOR_LOCALIZACAO='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SERVIDOR_RESPONSAVEL_LIDER='$CPF' WHERE CD_SERVIDOR_RESPONSAVEL_LIDER='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET CD_SERVIDOR='$CPF' WHERE CD_SERVIDOR='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_tramitacao_processos SET CD_SERVIDOR_ORIGEM='$CPF' WHERE CD_SERVIDOR_ORIGEM='$CPF_atual'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "UPDATE tb_tramitacao_processos SET CD_SERVIDOR_DESTINO='$CPF' WHERE CD_SERVIDOR_DESTINO='$CPF_atual'") 
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

function retornar_permissoes_servidor($servidor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM permissao WHERE CD_SERVIDOR='$servidor'" ) or die (mysqli_error($conexao_com_banco));
	
	$permissoes = mysqli_fetch_array($resultado);
	
	return $permissoes;

}

function editar_permissoes_servidor_funcao($conexao_com_banco, $funcao, $servidor){
	
	if($funcao == 'Protocolo'){
		
		mysqli_query($conexao_com_banco, "UPDATE permissao SET VISUALIZAR_ATIVIDADE='não',VISUALIZAR_TODAS_ATIVIDADE='não',CADASTRAR_ATIVIDADE='não',AUTORIZAR_COMPRA='não',EFETUAR_COMPRA='não',VISUALIZAR_CHAMADO='sim',VISUALIZAR_TODOS_CHAMADO='não',ABRIR_CHAMADO='sim',ABRIR_TODOS_CHAMADO='não',EXCLUIR_CHAMADO='não',FECHAR_CHAMADO='não',ENCERRAR_CHAMADO='não',NOTA_CHAMADO='sim',VISUALIZAR_RELATORIO_CHAMADO='não',VISUALIZAR_COMUNICACAO='não',CADASTRAR_COMUNICACAO='não',EDITAR_COMUNICACAO='não',EXCLUIR_COMUNICACAO='não',VISUALIZAR_DOCUMENTO='sim',VISUALIZAR_TODOS_SETOR_DOCUMENTO='sim',VISUALIZAR_TODOS_ORGAO_DOCUMENTO='sim',CADASTRAR_DOCUMENTO='não',EDITAR_DOCUMENTO='não',EXCLUIR_DOCUMENTO='não',APROVAR_DOCUMENTO='não',SUGESTAO_DOCUMENTO='não',RESOLVER_DOCUMENTO='não',VISUALIZAR_FINANCEIRO='não',CADASTRAR_RECEITA='não',EXCLUIR_RECEITA='não',CADASTRAR_DESPESA='não',EXCLUIR_DESPESA='não',AUTORIZAR_EMPENHO='não',EMPENHAR_DESPESA='não',AUTORIZAR_PAGAMENTO='não',PAGAR_DESPESA='não',VISUALIZAR_PROCESSO='sim',VISUALIZAR_TODOS_SETOR_PROCESSO='sim',VISUALIZAR_TODOS_ORGAO_PROCESSO='sim',VISUALIZAR_ARQUIVADOS_PROCESSO='sim',VISUALIZAR_SAIRAM_PROCESSO='sim',ABRIR_PROCESSO='sim',EDITAR_PROCESSO='sim',EXCLUIR_PROCESSO='não',DESPACHO_PROCESSO='não',PARECER_PROCESSO='não',FINALIZAR_PROCESSO='não',FINALIZAR_GABINETE_PROCESSO='não',DESFAZER_FINALIZACAO_PROCESSO='não',DESFAZER_FINALIZACAO_GABINETE_PROCESSO='não',ARQUIVAR_PROCESSO='não',DESARQUIVAR_PROCESSO='não',SAIDA_PROCESSO='sim',VOLTAR_PROCESSO='sim',DEFINIR_RESPONSAVEIS_PROCESSO='não',SER_RESPONSAVEL_PROCESSO='não',DESTINO_PROCESSO='sim',PRAZO_PROCESSO='não',URGENCIA_PROCESSO='não',ACESSO_GUIA_TRAMITACAO_PROCESSO='não',APENSO_PROCESSO='não',VISUALIZAR_SERVIDORES='não',CADASTRAR_SERVIDORES='não',EDITAR_SERVIDORES='não',EXCLUIR_SERVIDORES='não',VISUALIZAR_SETOR_RELATORIO='não',VISUALIZAR_ORGAO_RELATORIO='não',FAZER_OPERACOES_OUTROS_SETOR='sim',FAZER_OPERACOES_OUTROS_ORGAO='não' WHERE CD_SERVIDOR='$servidor'") or die(mysqli_error($conexao_com_banco));
		
	}else if($funcao == 'Assessor Técnico Gabinete'){
		
		mysqli_query($conexao_com_banco, "UPDATE permissao SET VISUALIZAR_ATIVIDADE='não',VISUALIZAR_TODAS_ATIVIDADE='não',CADASTRAR_ATIVIDADE='não',AUTORIZAR_COMPRA='sim',EFETUAR_COMPRA='não',VISUALIZAR_CHAMADO='sim',VISUALIZAR_TODOS_CHAMADO='não',ABRIR_CHAMADO='sim',ABRIR_TODOS_CHAMADO='não',EXCLUIR_CHAMADO='não',FECHAR_CHAMADO='não',ENCERRAR_CHAMADO='não',NOTA_CHAMADO='sim',VISUALIZAR_RELATORIO_CHAMADO='não',VISUALIZAR_COMUNICACAO='não',CADASTRAR_COMUNICACAO='não',EDITAR_COMUNICACAO='não',EXCLUIR_COMUNICACAO='não',VISUALIZAR_DOCUMENTO='sim',VISUALIZAR_TODOS_SETOR_DOCUMENTO='sim',VISUALIZAR_TODOS_ORGAO_DOCUMENTO='sim',CADASTRAR_DOCUMENTO='sim',EDITAR_DOCUMENTO='sim',EXCLUIR_DOCUMENTO='não',APROVAR_DOCUMENTO='não',SUGESTAO_DOCUMENTO='não',RESOLVER_DOCUMENTO='sim',VISUALIZAR_FINANCEIRO='sim',CADASTRAR_RECEITA='não',EXCLUIR_RECEITA='não',CADASTRAR_DESPESA='não',EXCLUIR_DESPESA='não',AUTORIZAR_EMPENHO='sim',EMPENHAR_DESPESA='não',AUTORIZAR_PAGAMENTO='sim',PAGAR_DESPESA='não',VISUALIZAR_PROCESSO='sim',VISUALIZAR_TODOS_SETOR_PROCESSO='sim',VISUALIZAR_TODOS_ORGAO_PROCESSO='sim',VISUALIZAR_ARQUIVADOS_PROCESSO='sim',VISUALIZAR_SAIRAM_PROCESSO='sim',ABRIR_PROCESSO='não',EDITAR_PROCESSO='sim',EXCLUIR_PROCESSO='não',DESPACHO_PROCESSO='sim',PARECER_PROCESSO='não',FINALIZAR_PROCESSO='não',FINALIZAR_GABINETE_PROCESSO='sim',DESFAZER_FINALIZACAO_PROCESSO='não',DESFAZER_FINALIZACAO_GABINETE_PROCESSO='sim',ARQUIVAR_PROCESSO='sim',DESARQUIVAR_PROCESSO='sim',SAIDA_PROCESSO='não',VOLTAR_PROCESSO='não',DEFINIR_RESPONSAVEIS_PROCESSO='não',SER_RESPONSAVEL_PROCESSO='não',DESTINO_PROCESSO='sim',PRAZO_PROCESSO='sim',URGENCIA_PROCESSO='sim',ACESSO_GUIA_TRAMITACAO_PROCESSO='sim',APENSO_PROCESSO='não',VISUALIZAR_SERVIDORES='não',CADASTRAR_SERVIDORES='não',EDITAR_SERVIDORES='não',EXCLUIR_SERVIDORES='não',VISUALIZAR_SETOR_RELATORIO='não',VISUALIZAR_ORGAO_RELATORIO='não',FAZER_OPERACOES_OUTROS_SETOR='sim',FAZER_OPERACOES_OUTROS_ORGAO='não' WHERE CD_SERVIDOR='$servidor'") or die(mysqli_error($conexao_com_banco));		

	}else if($funcao == 'Assessor Técnico Setor'){
		
		mysqli_query($conexao_com_banco, "UPDATE permissao SET VISUALIZAR_ATIVIDADE='não',VISUALIZAR_TODAS_ATIVIDADE='não',CADASTRAR_ATIVIDADE='não',AUTORIZAR_COMPRA='não',EFETUAR_COMPRA='não',VISUALIZAR_CHAMADO='sim',VISUALIZAR_TODOS_CHAMADO='não',ABRIR_CHAMADO='sim',ABRIR_TODOS_CHAMADO='não',EXCLUIR_CHAMADO='não',FECHAR_CHAMADO='não',ENCERRAR_CHAMADO='não',NOTA_CHAMADO='sim',VISUALIZAR_RELATORIO_CHAMADO='não',VISUALIZAR_COMUNICACAO='não',CADASTRAR_COMUNICACAO='não',EDITAR_COMUNICACAO='não',EXCLUIR_COMUNICACAO='não',VISUALIZAR_DOCUMENTO='sim',VISUALIZAR_TODOS_SETOR_DOCUMENTO='sim',VISUALIZAR_TODOS_ORGAO_DOCUMENTO='sim',CADASTRAR_DOCUMENTO='sim',EDITAR_DOCUMENTO='sim',EXCLUIR_DOCUMENTO='não',APROVAR_DOCUMENTO='não',SUGESTAO_DOCUMENTO='não',RESOLVER_DOCUMENTO='sim',VISUALIZAR_FINANCEIRO='não',CADASTRAR_RECEITA='não',EXCLUIR_RECEITA='não',CADASTRAR_DESPESA='não',EXCLUIR_DESPESA='não',AUTORIZAR_EMPENHO='não',EMPENHAR_DESPESA='não',AUTORIZAR_PAGAMENTO='não',PAGAR_DESPESA='não',VISUALIZAR_PROCESSO='sim',VISUALIZAR_TODOS_SETOR_PROCESSO='sim',VISUALIZAR_TODOS_ORGAO_PROCESSO='sim',VISUALIZAR_ARQUIVADOS_PROCESSO='sim',VISUALIZAR_SAIRAM_PROCESSO='sim',ABRIR_PROCESSO='não',EDITAR_PROCESSO='sim',EXCLUIR_PROCESSO='não',DESPACHO_PROCESSO='sim',PARECER_PROCESSO='não',FINALIZAR_PROCESSO='sim',FINALIZAR_GABINETE_PROCESSO='não',DESFAZER_FINALIZACAO_PROCESSO='sim',DESFAZER_FINALIZACAO_GABINETE_PROCESSO='não',ARQUIVAR_PROCESSO='sim',DESARQUIVAR_PROCESSO='sim',SAIDA_PROCESSO='não',VOLTAR_PROCESSO='não',DEFINIR_RESPONSAVEIS_PROCESSO='sim',SER_RESPONSAVEL_PROCESSO='sim',DESTINO_PROCESSO='sim',PRAZO_PROCESSO='sim',URGENCIA_PROCESSO='sim',ACESSO_GUIA_TRAMITACAO_PROCESSO='sim',APENSO_PROCESSO='não',VISUALIZAR_SERVIDORES='não',CADASTRAR_SERVIDORES='não',EDITAR_SERVIDORES='não',EXCLUIR_SERVIDORES='não',VISUALIZAR_SETOR_RELATORIO='não',VISUALIZAR_ORGAO_RELATORIO='não',FAZER_OPERACOES_OUTROS_SETOR='sim',FAZER_OPERACOES_OUTROS_ORGAO='não' WHERE CD_SERVIDOR='$servidor'") or die(mysqli_error($conexao_com_banco));
		
	}else if($funcao == 'Superintendente' or $funcao == 'Superintendente sem assessor'){
		
		mysqli_query($conexao_com_banco, "UPDATE permissao SET VISUALIZAR_ATIVIDADE='sim',VISUALIZAR_TODAS_ATIVIDADE='não',CADASTRAR_ATIVIDADE='não',AUTORIZAR_COMPRA='não',EFETUAR_COMPRA='não',VISUALIZAR_CHAMADO='sim',VISUALIZAR_TODOS_CHAMADO='não',ABRIR_CHAMADO='sim',ABRIR_TODOS_CHAMADO='não',EXCLUIR_CHAMADO='não',FECHAR_CHAMADO='não',ENCERRAR_CHAMADO='não',NOTA_CHAMADO='sim',VISUALIZAR_RELATORIO_CHAMADO='não',VISUALIZAR_COMUNICACAO='não',CADASTRAR_COMUNICACAO='não',EDITAR_COMUNICACAO='não',EXCLUIR_COMUNICACAO='não',VISUALIZAR_DOCUMENTO='sim',VISUALIZAR_TODOS_SETOR_DOCUMENTO='sim',VISUALIZAR_TODOS_ORGAO_DOCUMENTO='sim',CADASTRAR_DOCUMENTO='sim',EDITAR_DOCUMENTO='sim',EXCLUIR_DOCUMENTO='não',APROVAR_DOCUMENTO='sim',SUGESTAO_DOCUMENTO='sim',RESOLVER_DOCUMENTO='sim',VISUALIZAR_FINANCEIRO='não',CADASTRAR_RECEITA='não',EXCLUIR_RECEITA='não',CADASTRAR_DESPESA='não',EXCLUIR_DESPESA='não',AUTORIZAR_EMPENHO='não',EMPENHAR_DESPESA='não',AUTORIZAR_PAGAMENTO='não',PAGAR_DESPESA='não',VISUALIZAR_PROCESSO='sim',VISUALIZAR_TODOS_SETOR_PROCESSO='sim',VISUALIZAR_TODOS_ORGAO_PROCESSO='sim',VISUALIZAR_ARQUIVADOS_PROCESSO='sim',VISUALIZAR_SAIRAM_PROCESSO='sim',ABRIR_PROCESSO='não',EDITAR_PROCESSO='sim',EXCLUIR_PROCESSO='não',DESPACHO_PROCESSO='sim',PARECER_PROCESSO='sim',FINALIZAR_PROCESSO='sim',FINALIZAR_GABINETE_PROCESSO='não',DESFAZER_FINALIZACAO_PROCESSO='sim',DESFAZER_FINALIZACAO_GABINETE_PROCESSO='não',ARQUIVAR_PROCESSO='sim',DESARQUIVAR_PROCESSO='sim',SAIDA_PROCESSO='não',VOLTAR_PROCESSO='não',DEFINIR_RESPONSAVEIS_PROCESSO='sim',SER_RESPONSAVEL_PROCESSO='sim',DESTINO_PROCESSO='sim',PRAZO_PROCESSO='sim',URGENCIA_PROCESSO='sim',ACESSO_GUIA_TRAMITACAO_PROCESSO='sim',APENSO_PROCESSO='não',VISUALIZAR_SERVIDORES='não',CADASTRAR_SERVIDORES='não',EDITAR_SERVIDORES='não',EXCLUIR_SERVIDORES='não',VISUALIZAR_SETOR_RELATORIO='sim',VISUALIZAR_ORGAO_RELATORIO='não',FAZER_OPERACOES_OUTROS_SETOR='sim',FAZER_OPERACOES_OUTROS_ORGAO='não' WHERE CD_SERVIDOR='$servidor'") or die(mysqli_error($conexao_com_banco));
	
	}else if($funcao == 'Analisa Processo'){
		
		mysqli_query($conexao_com_banco, "UPDATE permissao SET VISUALIZAR_ATIVIDADE='não',VISUALIZAR_TODAS_ATIVIDADE='não',CADASTRAR_ATIVIDADE='não',AUTORIZAR_COMPRA='não',EFETUAR_COMPRA='não',VISUALIZAR_CHAMADO='sim',VISUALIZAR_TODOS_CHAMADO='não',ABRIR_CHAMADO='sim',ABRIR_TODOS_CHAMADO='não',EXCLUIR_CHAMADO='não',FECHAR_CHAMADO='não',ENCERRAR_CHAMADO='não',NOTA_CHAMADO='sim',VISUALIZAR_RELATORIO_CHAMADO='não',VISUALIZAR_COMUNICACAO='não',CADASTRAR_COMUNICACAO='não',EDITAR_COMUNICACAO='não',EXCLUIR_COMUNICACAO='não',VISUALIZAR_DOCUMENTO='sim',VISUALIZAR_TODOS_SETOR_DOCUMENTO='sim',VISUALIZAR_TODOS_ORGAO_DOCUMENTO='sim',CADASTRAR_DOCUMENTO='sim',EDITAR_DOCUMENTO='sim',EXCLUIR_DOCUMENTO='não',APROVAR_DOCUMENTO='não',SUGESTAO_DOCUMENTO='não',RESOLVER_DOCUMENTO='não',VISUALIZAR_FINANCEIRO='não',CADASTRAR_RECEITA='não',EXCLUIR_RECEITA='não',CADASTRAR_DESPESA='não',EXCLUIR_DESPESA='não',AUTORIZAR_EMPENHO='não',EMPENHAR_DESPESA='não',AUTORIZAR_PAGAMENTO='não',PAGAR_DESPESA='não',VISUALIZAR_PROCESSO='sim',VISUALIZAR_TODOS_SETOR_PROCESSO='sim',VISUALIZAR_TODOS_ORGAO_PROCESSO='sim',VISUALIZAR_ARQUIVADOS_PROCESSO='sim',VISUALIZAR_SAIRAM_PROCESSO='sim',ABRIR_PROCESSO='não',EDITAR_PROCESSO='não',EXCLUIR_PROCESSO='não',DESPACHO_PROCESSO='não',PARECER_PROCESSO='sim',FINALIZAR_PROCESSO='não',FINALIZAR_GABINETE_PROCESSO='não',DESFAZER_FINALIZACAO_PROCESSO='não',DESFAZER_FINALIZACAO_GABINETE_PROCESSO='não',ARQUIVAR_PROCESSO='não',DESARQUIVAR_PROCESSO='não',SAIDA_PROCESSO='não',VOLTAR_PROCESSO='não',DEFINIR_RESPONSAVEIS_PROCESSO='sim',SER_RESPONSAVEL_PROCESSO='sim',DESTINO_PROCESSO='sim',PRAZO_PROCESSO='não',URGENCIA_PROCESSO='não',ACESSO_GUIA_TRAMITACAO_PROCESSO='não',APENSO_PROCESSO='não',VISUALIZAR_SERVIDORES='não',CADASTRAR_SERVIDORES='não',EDITAR_SERVIDORES='não',EXCLUIR_SERVIDORES='não',VISUALIZAR_SETOR_RELATORIO='não',VISUALIZAR_ORGAO_RELATORIO='não',FAZER_OPERACOES_OUTROS_SETOR='não',FAZER_OPERACOES_OUTROS_ORGAO='não' WHERE CD_SERVIDOR='$servidor'") or die(mysqli_error($conexao_com_banco));

	}

}