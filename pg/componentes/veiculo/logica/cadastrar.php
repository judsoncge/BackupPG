<?php

include('../../banco-dados/conectar.php');

session_start();

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_valor = $_POST['valor']; 

//verificando se já existe diária cadastrada com o mesmo número de placa digitado pelo usuário
$placa_verificacao = $_POST['placa'];
//verificando no banco
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM veiculo WHERE placa='$placa_verificacao'");
$linha = mysqli_affected_rows($conexao_com_banco);
//se ja estiver cadastrado...
if($linha==1){ 
	echo "<script>history.back();</script>";
	echo "<script>alert('Esta placa já está cadastrada. Tente outra')</script>";
	die();
}else{
	//se ainda não estiver cadastrado, pegando o numero de placa digitado pelo usuario no cadastro
	$novo_placa = $_POST['placa']; 
}

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_modelo = $_POST['modelo']; 

//pegando o cpf do beneficário pelo usuario no cadastro
$novo_condutor = $_POST['condutor'];

//pegando o mês de competencia digitado pelo usuario no cadastro	
$novo_termo_cessao = $_POST['termo_cessao']; 

//pegando o mês de pagamento digitado pelo usuario no cadastro	
$novo_chipado = $_POST['chipado']; 

//pegando o valor pago digitado pelo usuario no cadastro	
$novo_codigo_chip = $_POST['codigo_chip'];	

//pegando o tipo digitado pelo usuario no cadastro
$novo_logomarca = $_POST['logomarca'];	

//pegando o numero da portaria digitado pelo usuario no cadastro
$novo_licenciado = $_POST['licenciado']; 

//pegando a data da publicação da portaria digitada pelo usuario no cadastro
$novo_ano_fabricacao = $_POST['ano_fabricacao']; 

//pegando a data da publicação da portaria digitada pelo usuario no cadastro
$novo_locado = $_POST['locado']; 

//pegando o destino cedido digitado pelo usuario no cadastro
$novo_renavam = $_POST['renavam']; 

//pegando a data de volta digitado pelo usuario no cadastro
$novo_seguro = $_POST['seguro']; 

//pegando o numero de diarias digitado pelo usuario no cadastro
$novo_recolhido_garagem_noite = $_POST['recolhido_garagem']; 

//pegando o numero de diarias digitado pelo usuario no cadastro
$novo_observacoes = $_POST['observacoes']; 

//pegando o ano da diária de acordo com o ano atual 
date_default_timezone_set('America/Bahia');
$novo_ano =  date('Y');

//criando um id para a diaria
$id = "VEICULO_" . $novo_placa . $novo_renavam . date('H:i:s');
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);

//pegando o cpf da pessoa que está cadastrando esta diária
$novo_cadastrou = $_SESSION['CPF']; 

include('../banco-dados/cadastrar.php');

?>