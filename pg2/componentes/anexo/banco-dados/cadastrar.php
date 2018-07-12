<?php

//executando a consulta no banco de dados para salvar o registro na tabela anexo
mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos(ID, CD_REFERENTE, NM_ARQUIVO) VALUES ('$id', '$novo_id_referente' ,'$novo_anexo')") 
or die (mysqli_error($conexao_com_banco));

//retorna para a página que o usuário estava
echo "<script>history.back();</script>";

?>