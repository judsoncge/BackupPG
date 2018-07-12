<?php
include('../../banco-dados/conectar.php');



//gravando o novo status do chamado numa variável de sessão	
$edita_status_chamado = "Encerrado";
//pegando a data e hora atual da ação
date_default_timezone_set('America/Bahia');
//gravando a data e hora de fechamento do chamado numa variável de sessão
$edita_data_fechamento = date('Y-m-d H:i:s');
//gravando o id do chamado numa variável de sessão
$id_chamado = $_GET['chamado'];

$pessoa = $_GET['pessoa'];

$id2 = "HISTORICO_CHAMADO_" . $pessoa . $edita_data_fechamento;
$id2 = str_replace('.', '', $id2);
$id2 = str_replace('-', '', $id2);
$id2 = str_replace(':', '', $id2);
$id2 = str_replace(' ', '', $id2);


include('../banco-dados/editar_encerrar.php');

?>