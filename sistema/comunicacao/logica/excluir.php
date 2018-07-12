<?php


include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

$id = $_GET['id'];

$lista = retorna_imagens_comunicacao($id, $conexao_com_banco);

while($r = mysqli_fetch_object($lista)){
	
	unlink("../../../registros/fotos-noticias/".$r->NM_ARQUIVO);
	
}

	
excluir_anexos_comunicacao($conexao_com_banco, $id);

excluir_comunicacao($conexao_com_banco, $id);
	
header("Location:../listar-ativos.php?mensagem=Operação realizada com sucesso!&resultado=sucesso");

?>