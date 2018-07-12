<?php
$ROOT = ' http://'.$_SERVER['SERVER_NAME'].'/pg/';
include($_SERVER['DOCUMENT_ROOT'].'/pg/sistema/atividades/banco-dados/funcoes.php');


function listar_gabinete_andamento($conexao_com_banco, $cd_servidor) {
	
	return listar_atividades_gabinete_andamento($conexao_com_banco, $cd_servidor);
	
}

function listar_gabinete_tramitada($conexao_com_banco, $cd_servidor) {
	
	return  listar_atividades_gabinete_tramitadas($conexao_com_banco, $cd_servidor);
	
}






?>