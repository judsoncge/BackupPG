<?php

mysqli_query($conexao_com_banco, "DELETE FROM tb_receitas WHERE ID='$id'");

header("Location:../../../interface/receitas.php?sessionId=$num&mensagem=A receita foi excluída com sucesso!&resultado=sucesso");

?>