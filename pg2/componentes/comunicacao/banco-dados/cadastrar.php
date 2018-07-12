<?php

mysqli_query($conexao_com_banco, "INSERT INTO tb_comunicacao (ID, NM_ITEM, NM_TITULO, NM_TEXTO, DT_PUBLICACAO, NM_STATUS) VALUES ('$id_comunicacao', '$novo_item', '$novo_titulo', '$novo_texto', '$novo_data_publicacao', 'Aberta')") 
or die (mysqli_error($conexao_com_banco));

header("Location:../../../interface/comunicacao.php?sessionId=$num&mensagem=A notícia foi cadastrada com sucesso!&resultado=sucesso");

?>