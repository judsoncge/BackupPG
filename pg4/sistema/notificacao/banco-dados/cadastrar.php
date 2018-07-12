<?php
function criar_notificacao($conexao_com_banco, $responsavel, $mensagem, $link) {
	$data = date('Y-m-d H:i:s');
	mysqli_query($conexao_com_banco, "INSERT INTO notificacao (ID, TX_MENSAGEM, NM_STATUS, CD_SERVIDOR, DT_CRIADO, DT_VISUALIZADO, LINK_NOTIFICACAO) VALUES (NULL, '$mensagem', 'NOVA', '$responsavel', '$data', NULL, '$link')") or die (mysqli_error($conexao_com_banco));
	
}


?>