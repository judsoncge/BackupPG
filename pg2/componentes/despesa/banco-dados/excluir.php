<?php

mysqli_query($conexao_com_banco, "DELETE FROM tb_despesas WHERE ID='$id'");

header("Location:../../../interface/despesas.php?sessionId=$num&mensagem=A despesa foi excluída com sucesso!&resultado=sucesso");

?>