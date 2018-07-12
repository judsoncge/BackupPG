<?php

//executando a consulta no banco de dados para deletar o registro da tabela anexo
mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos WHERE ID='$id' ") or die (mysqli_error($conexao_com_banco));

//exclui o arquivo dado o caminho atual 
unlink($atual);

//retorna para a página que o usuário estava
echo "<script>history.back();</script>";

?>