<?php

//inserindo o novo chamado no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO tb_chamados(ID, NM_PROBLEMA, NM_NATUREZA, CD_SERVIDOR_REQUISITANTE, NM_STATUS, DT_ABERTURA, NM_NOTA) VALUES ('$id_chamado','$novo_problema', '$novo_natureza_problema', '$novo_requisitante', 'Aberto', '$novo_data_abertura',  'Sem nota')") or die (mysqli_error($conexao_com_banco));

//inserindo na tabela de historico chamado a informacao de que foi aberto um chamado, com a pessoa e a hora
mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_chamados(ID, CD_CHAMADO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_chamado','$id_chamado', 'ABRIU UM CHAMADO', '$novo_requisitante', '$novo_data_abertura', 'Abertura')") 
or die (mysqli_error($conexao_com_banco));





?>