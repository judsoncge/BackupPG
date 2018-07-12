<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO documento (id, Processo_numero, tipo_atividade, tipo_documento, interessado, 
data_entrada, data_criacao, prazo, prioridade, descricao_fato, texto_documento, criadopor, estacom, status) 
VALUES ('$id','$novo_numero_processo' ,'$novo_tipo_atividade','$novo_tipo_documento','$novo_interessado', '$novo_data_entrada','$novo_prazo',
'$novo_data_criacao','$novo_prioridade','$novo_descricao_fato', '$novo_texto_documento', '$novo_criadopor', '$novo_estacom', 'Em análise')") or die (mysqli_error($conexao_com_banco));

 
 mysqli_query($conexao_com_banco, "INSERT INTO historico_documento (id, Documento_id, mensagem, pessoa, data_mensagem, acao)
 VALUES ('$id_historico', '$id', 'CRIOU UM DOCUMENTO', '$novo_criadopor', '$novo_data_criacao', 'Ação')") or die (mysqli_error($conexao_com_banco));
  //quantidade de linhas modificadas após a ação
 
 if($novo_anexo != ""){
	 
	mysqli_query($conexao_com_banco, "INSERT INTO anexo (id, id_referente, caminho)
 VALUES ('$id_anexo', '$id', '$novo_anexo')") or die (mysqli_error($conexao_com_banco));
  //quantidade de linhas modificadas após a ação
	 
 }
 
 if($novo_numero_processo != null and $novo_numero_processo != ''){
	 mysqli_query($conexao_com_banco, "INSERT INTO historico_processo (id, Processo_numero, mensagem, Pessoa_CPF_responsavel, data_mensagem, acao) 
 VALUES ('$id_processo', '$novo_numero_processo', 'CRIOU UM $novo_tipo_documento', '$novo_criadopor', '$novo_data_criacao', 'Ação')") or die (mysqli_error($conexao_com_banco));
   
 }
 

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