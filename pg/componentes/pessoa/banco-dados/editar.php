<?php

mysqli_query($conexao_com_banco, "UPDATE pessoa SET cargo='$edita_cargo', setor='$edita_setor', nivel='$edita_nivel', grupo='$edita_grupo', 
salario='$edita_salario', nome='$edita_nome', sobrenome='$edita_sobrenome', data_nomeacao='$edita_nomeacao', situacao_funcional='$edita_situacao_funcional', email_institucional='$edita_email_institucional' , matricula='$edita_matricula',
cedido_por='$edita_cedido_por' ,graduacao='$edita_graduacao', foto='$edita_foto', anexo_dados_gerais='$edita_dados', anexo_comprovante_residencia='$edita_comprovante', anexo_diploma='$edita_diploma' 
WHERE CPF='$edita_CPF' ") or die (mysqli_error($conexao_com_banco));


mysqli_query($conexao_com_banco, "UPDATE permissao SET abrir_chamado_pessoa='$edita_abrir_chamado_pessoa',
fechar_chamado='$edita_fechar_chamado',
nota_chamado='$edita_nota_chamado',
visualizar_todos_chamados='$edita_visualizar_todos_chamados',
visualizar_financeiro='$edita_visualizar_financeiro',
cadastrar_comunicacao='$edita_cadastrar_comunicacao',
visualizar_processo='$edita_visualizar_processo',
abrir_processo='$edita_abrir_processo',
analisar_processo='$edita_analisar_processo',
prazo_processo='$edita_prazo_processo',
prazo_final_processo='$edita_prazo_final_processo',
arquivar_processo='$edita_arquivar_processo',
saida_processo='$edita_saida_processo',
visualizar_processo_todos='$edita_visualizar_processo_todos',
destino_tramitacao_processo='$edita_destino_tramitacao_processo',
concluir_processo='$edita_concluir_processo',
finalizar_processo='$edita_finalizar_processo',
voltar_processo='$edita_voltar_processo',
visualizar_servidores='$edita_visualizar_servidores',
visualizar_documento='$edita_visualizar_documento',
visualizar_documento_todos='$edita_visualizar_documento_todos',
aprovar_documento='$edita_aprovar_documento',
sugestao_documento='$edita_sugestao_documento',
visualizar_indice_produtividade='$edita_visualizar_indice_produtividade',
avaliar_todos='$edita_avaliar_todos',
ser_avaliado='$edita_ser_avaliado'
WHERE Pessoa_CPF='$edita_CPF'") or die (mysqli_error($conexao_com_banco)); 

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){
	echo "<script>history.back();</script>";
	echo "<script>history.back();</script>";
	echo "<script>alert('Edição realizada com sucesso!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	
	echo "<script>alert('Selecione pelo menos um campo para editar')</script>";
}

?>