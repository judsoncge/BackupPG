<?php

//inserindo a solicitacao da compra no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO tb_compras(CD_COMPRA, CD_SERVIDOR_SOLICITANTE, DS_COMPRA, DT_SOLICITACAO, NM_STATUS) VALUES ('$id_compra','$novo_solicitante', '$novo_descricao', '$novo_data_solicitacao','Solicitado')") or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_compras VALUES ('$id_historico_compra','$id_compra', 'SOLICITOU UMA COMPRA', '$novo_solicitante', '$data_hoje', 'Solicitação')") or die (mysqli_error($conexao_com_banco));


?>