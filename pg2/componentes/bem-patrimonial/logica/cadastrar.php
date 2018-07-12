<?php

include('../../iniciar.php');

//pegando o valor pago digitado pelo usuario no cadastro	
$novo_numero_patrimonio = $_POST['numero_patrimonio'];	

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_setor = $_POST['setor']; 	

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_descricao = $_POST['descricao']; 	

//pegando a data de volta da viagem digitado pelo usuario no cadastro
$novo_denominacao = $_POST['denominacao'];

//pegando a data de ida da viagem digitado pelo usuario no cadastro
$novo_conservacao = $_POST['conservacao']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_doc_aquisicao = $_POST['doc_aquisicao']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_data_aquisicao = $_POST['data_aquisicao']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_valor_aquisicao = $_POST['valor_aquisicao'];

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_tempo_anos = $_POST['tempo_anos'];
	
//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_taxa_depreciacao = $_POST['taxa_depreciacao']; 

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_valor_residual = ($novo_valor_aquisicao * 10)/100; 	

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_valor_depreciavel = $novo_valor_aquisicao - $novo_valor_residual; 

//pegando o destino cedido digitado pelo usuario no cadastro
$novo_depreciacao_do_mes = ($novo_valor_depreciavel/$novo_tempo_anos)/12; 	

//verificando se já existe diária cadastrada com o mesmo número de empenho digitado pelo usuário
$novo_depreciacao_acumulada = $_POST['depreciacao_acumulada'];

//pegando o horario de volta da viagem digitado pelo usuario no cadastro
$novo_valor_liquido = $novo_valor_depreciavel - $novo_depreciacao_acumulada; 

//criando um id para a diaria
$id = "PATRIMONIO_" . $novo_doc_aquisicao . date('Y-m-d H:i:s');
$id = arruma_id($id);

$num = $_GET['sessionId'];

include('../banco-dados/cadastrar.php');

?>