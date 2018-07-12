<?php

include('../../banco-dados/conectar.php');

$id = $_GET['documento']; 

$edita_sugestao = $_POST['sugestao_resposta']; 
$edita_tipo_sugestao = $_POST['tipo_sugestao']; 

$pessoa = $_GET['pessoa']; 
//gravando o nome do requisitante
date_default_timezone_set('America/Bahia');
$data_mensagem = date('Y-m-d H:i:s');

$id_historico = "HISTORICO_DOCUMENTO_" . $pessoa . $data_mensagem;
$id_historico = str_replace('.', '', $id_historico);
$id_historico = str_replace('-', '', $id_historico);
$id_historico = str_replace(':', '', $id_historico);
$id_historico = str_replace(' ', '', $id_historico);


include('../banco-dados/editar_sugerir.php');

?>