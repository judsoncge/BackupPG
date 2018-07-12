<?php

//excluindo o chamado do banco de dados
mysqli_query($conexao_com_banco, "DELETE FROM tb_chamados WHERE ID='$id' ") or die (mysqli_error($conexao_com_banco));

//excluindo todos os registros do chamado
mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_chamados WHERE CD_CHAMADO='$id' ") or die (mysqli_error($conexao_com_banco));

//voltando para a pagina de chamados informando que o chamado foi excluido com sucesso
header("Location:../../../interface/chamados.php?sessionId=$num&mensagem=O chamado foi excluído com sucesso!&resultado=sucesso");

?>