<?php

mysqli_query($conexao_com_banco, "DELETE FROM tb_processos WHERE CD_PROCESSO='$id'");

mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_processos WHERE CD_PROCESSO='$id'");

mysqli_query($conexao_com_banco, "DELETE FROM tb_responsaveis_processos WHERE CD_PROCESSO='$id'");

mysqli_query($conexao_com_banco, "DELETE FROM tb_tramitacao_processos WHERE CD_PROCESSO='$id'");

$resultado = mysqli_query($conexao_com_banco, "SELECT CD_DOCUMENTO FROM tb_documentos WHERE CD_PROCESSO='$id'");

while($r = mysqli_fetch_object($resultado)){
	
	$id_documento = $r->CD_DOCUMENTO;
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_documentos WHERE CD_DOCUMENTO='$id_documento'");
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_documentos WHERE CD_DOCUMENTO='$id_documento'");
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT ID, NM_ARQUIVO FROM tb_anexos WHERE CD_REFERENTE='$id_documento'");
	
	while($r2 = mysqli_fetch_object($resultado2)){
		
		$nome_anexo = $r2->NM_ARQUIVO;
		
		$id_anexo = $r2->ID;
			
		mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos WHERE ID='$id_anexo'");
			
		$nome_anexo = '../../../registros/anexos/'.$nome_anexo;
			
		unlink($nome_anexo);
		
	}
	
	
}

header("Location:../../../interface/processos".$_GET['pagina'].".php?sessionId=$num&mensagem=O processo e seus documentos e anexos foram excluídos com sucesso!&resultado=sucesso");

?>