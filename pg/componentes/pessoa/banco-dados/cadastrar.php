<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO pessoa (cargo, setor, nivel, grupo, salario, nome, sobrenome, data_nomeacao, situacao_funcional, 
CPF, email_institucional , matricula, cedido_por ,graduacao, foto, anexo_dados_gerais, anexo_comprovante_residencia, anexo_diploma, senha) VALUES 
('$novo_cargo', '$novo_setor','$novo_nivel','$novo_grupo','$novo_salario','$novo_nome', '$novo_sobrenome' , '$novo_nomeacao','$novo_situacao_funcional',
'$novo_CPF', '$novo_email_institucional' ,'$novo_matricula', '$novo_cedido_por' ,'$novo_graduacao','$novo_foto', '$novo_dados',
 '$novo_comprovante', '$novo_diploma', '$novo_senha')") or die (mysqli_error($conexao_com_banco));
 
 
mysqli_query($conexao_com_banco, "INSERT INTO permissao(id,Pessoa_CPF,abrir_chamado_pessoa,fechar_chamado,nota_chamado,
visualizar_todos_chamados,visualizar_financeiro,cadastrar_comunicacao,visualizar_processo,abrir_processo,analisar_processo,prazo_processo,prazo_final_processo,
arquivar_processo,saida_processo,visualizar_processo_todos,destino_tramitacao_processo,concluir_processo,finalizar_processo,
voltar_processo,visualizar_servidores,visualizar_documento,visualizar_documento_todos,aprovar_documento, sugestao_documento, visualizar_indice_produtividade,
avaliar_todos,ser_avaliado)  VALUES ('$novo_id','$novo_CPF','$novo_abrir_chamado_pessoa','$novo_fechar_chamado','$novo_nota_chamado','$novo_visualizar_todos_chamados',
'$novo_visualizar_financeiro','$novo_cadastrar_comunicacao','$novo_visualizar_processo','$novo_abrir_processo','$novo_analisar_processo',
'$novo_prazo_processo','$novo_prazo_final_processo','$novo_arquivar_processo','$novo_saida_processo','$novo_visualizar_processo_todos',
'$novo_destino_tramitacao_processo','$novo_concluir_processo','$novo_finalizar_processo','$novo_voltar_processo','$novo_visualizar_servidor',
'$novo_visualizar_documento','$novo_visualizar_documento_todos','$novo_aprovar_documento','$novo_sugestao_documento','$novo_visualizar_indice_produtividade',
'$novo_avaliar_todos','$novo_ser_avaliado')") or die (mysqli_error($conexao_com_banco)); 
 
 
//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){       
	echo "<script>history.back();</script>"; 
	echo "<script>history.back();</script>"; 
	echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
}


?>