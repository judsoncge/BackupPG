<?php

mysqli_query($conexao_com_banco, 

"DELETE FROM anexo WHERE id='$id' ") 

or die (mysqli_error($conexao_com_banco));

echo "<script>history.back();</script>";

?>