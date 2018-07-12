<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, 

"INSERT INTO anexo (id, id_referente, caminho) 

VALUES 

('$id_anexo','$novo_id_referente' ,'$novo_anexo')") 

or die (mysqli_error($conexao_com_banco));

//cadastrando uma msg no histórico para informar que algo foi anexado
mysqli_query($conexao_com_banco, 

"INSERT INTO historico_documento (id, Documento_id, mensagem, pessoa, data_mensagem, acao) 

VALUES 

('$id_historico', '$novo_id_referente', 'ANEXOU UM ARQUIVO', '$novo_pessoa_enviou', '$novo_data_criacao', 'Ação')") 

or die (mysqli_error($conexao_com_banco));

//voltando para a página anterior e informando o cadastro
echo "<script>history.back();</script>";

echo "<script>alert('Anexo cadastrado com sucesso!')</script>";

?>