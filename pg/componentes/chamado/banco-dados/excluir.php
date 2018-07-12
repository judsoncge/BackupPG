<?php

mysqli_query($conexao_com_banco, 

"DELETE FROM chamado WHERE id='$id' ") 

or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, 

"DELETE FROM historico_chamado WHERE Chamado_numero='$id' ") 

or die (mysqli_error($conexao_com_banco));

echo "<script>history.back();</script>";

?>