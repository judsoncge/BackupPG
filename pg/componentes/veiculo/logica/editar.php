<?php

include('../../banco-dados/conectar.php');

$id = $_GET['id']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_valor = $_POST['valor']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_placa = $_POST['placa']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_modelo = $_POST['modelo']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$edita_condutor = $_POST['condutor'];

//pegando o mês de competencia digitado pelo usuario no cadastro	
$edita_termo_cessao = $_POST['termo_cessao']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$edita_chipado = $_POST['chipado']; 

//pegando o valor pago digitado pelo usuario no cadastro	
$edita_codigo_chip = $_POST['codigo_chip'];	

//pegando o tipo digitado pelo usuario no cadastro
$edita_logomarca = $_POST['logomarca'];	

//pegando o numero da portaria digitado pelo usuario no cadastro
$edita_licenciado = $_POST['licenciado']; 

//pegando a data da publicação da portaria digitada pelo usuario no cadastro
$edita_ano_fabricacao = $_POST['ano_fabricacao']; 

//pegando a data da publicação da portaria digitada pelo usuario no cadastro
$edita_locado = $_POST['locado']; 

//pegando o destino cedido digitado pelo usuario no cadastro
$edita_renavam = $_POST['renavam']; 

//pegando a data de volta digitado pelo usuario no cadastro
$edita_seguro = $_POST['seguro']; 

//pegando o numero de diarias digitado pelo usuario no cadastro
$edita_recolhido_garagem_noite = $_POST['recolhido_garagem']; 

//pegando o numero de diarias digitado pelo usuario no cadastro
$edita_observacoes = $_POST['observacoes']; 

include('../banco-dados/editar.php');

?>