<?php

mysqli_query($conexao_com_banco, "INSERT INTO chamado (id, problema, natureza_problema, setor, Pessoa_CPF_requisitante, data_abertura, status, nota)
 VALUES ('$id', '$novo_problema', '$novo_natureza_problema', '$novo_setor', '$novo_requisitante', '$novo_data_abertura', 'Aberto', 'Sem nota')") or die (mysqli_error($conexao_com_banco));
  //quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);

mysqli_query($conexao_com_banco, "INSERT INTO historico_chamado (id, Chamado_numero, mensagem, pessoa, data_mensagem, acao)
 VALUES ('$id_historico', '$id', 'SOLICITOU AJUDA', '$novo_requisitante', '$novo_data_abertura', 'Ação')") or die (mysqli_error($conexao_com_banco));
  //quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);

//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){         echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Chamado enviado!')</script>"; 
	//se nenhuma linha foi modificada, é porque houve algum problema
}	else{	
		echo "<script>history.back();</script>";
		echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
	}

?>