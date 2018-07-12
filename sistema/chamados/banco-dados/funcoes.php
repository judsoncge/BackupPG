<?php
function cadastrar_chamado($conexao_com_banco, $problema, $natureza, $requisitante) {
	
	$data = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_chamados(NM_PROBLEMA, NM_NATUREZA, ID_SERVIDOR_REQUISITANTE, NM_STATUS, DT_ABERTURA, NM_AVALIACAO) VALUES ('$problema', '$natureza', '$requisitante', 'ABERTO', '$data',  'SEM AVALIAÇÃO')") or die (mysqli_error($conexao_com_banco));
	
	return mysqli_insert_id($conexao_com_banco);

}

function excluir_chamado($conexao_com_banco, $id) {

	//excluindo todos os registros do chamado
	mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_chamados WHERE CD_CHAMADO='$id' ") or die (mysqli_error($conexao_com_banco));
	//excluindo o chamado do banco de dados
	mysqli_query($conexao_com_banco, "DELETE FROM tb_chamados WHERE CD_CHAMADO='$id' ") or die (mysqli_error($conexao_com_banco));
	
}

function alterar_status($conexao_com_banco, $id, $status, $data) {
	
	//mudando o status para Encerrado do chamado desejado	
	mysqli_query($conexao_com_banco, "UPDATE tb_chamados SET NM_STATUS='$status', DT_ENCERRAMENTO='$data' WHERE ID='$id'") 
	or die (mysqli_error($conexao_com_banco));	
	
}


function alterar_avaliacao($conexao_com_banco, $id, $avaliacao) {

	mysqli_query($conexao_com_banco, "UPDATE tb_chamados SET NM_AVALIACAO='$avaliacao' WHERE ID='$id'") 
	or die (mysqli_error($conexao_com_banco));
	
}

function cadastrar_historico_chamado($conexao_com_banco, $id, $mensagem, $servidor, $acao) {
	
	$data = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_chamados(ID_CHAMADO, NM_MENSAGEM, ID_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id','$mensagem', '$servidor', '$data', '$acao')")
	or die (mysqli_error($conexao_com_banco));
}

function deletar_historico_chamado($conexao_com_banco, $id_chamado) {
	mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_chamados WHERE CD_CHAMADO = '$id_chamado'")
	or die (mysqli_error($conexao_com_banco));
}

?>