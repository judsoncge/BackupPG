<?php

mysqli_query($conexao_com_banco, "UPDATE tb_bem_patrimonial SET 
 
VLR_DEPRECIACAO_ACUMULADA='$edita_depreciacao_acumulada', VLR_LIQUIDO='$edita_valor_liquido', VLR_DEPRECIACAO_MES = '$edita_depreciacao_mes'

 WHERE ID='$id' ") or die (mysqli_error($conexao_com_banco));

header("Location:../../../interface/bens-patrimoniais.php?sessionId=$num&mensagem=O bem foi enviado com sucesso!&resultado=sucesso");


?>