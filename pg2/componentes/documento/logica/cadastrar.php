<?php

include('../../iniciar.php');

if(isset($_POST['numero_processo'])){
	$novo_numero_processo = $_POST['numero_processo']; 
}else{
	$novo_numero_processo = "";
}

$novo_tipo_atividade = $_POST['tipo_atividade']; 

$novo_tipo_documento = $_POST['tipo_documento'];

$novo_interessado = $_POST['interessado']; 
	
$novo_data_entrada = $_POST['data_entrada']; 
	
$novo_prazo = $_POST['prazo'];

$data = date('Y-m-d');

if($novo_prazo < $data){
	
	echo "<script>alert('O prazo nao pode ser menor que a data de hoje')</script>";
	echo "<script>history.back();</script>";
	die();
	
}

if($novo_data_entrada > $novo_prazo){
	
	echo "<script>alert('A data de entrada nao pode ser maior que o prazo')</script>";
	echo "<script>history.back();</script>";
	die();
	
}

$novo_descricao_fato = $_POST['descricao_fato'];	

$novo_texto_documento = $_POST['texto_documento']; 

$novo_data_criacao =  date('Y-m-d H:i:s');

$novo_criadopor = $_SESSION['CPF']; 

$novo_estacom = $_SESSION['CPF']; 

$novo_setor = $_SESSION['setor']; 

$id_documento = "DOCUMENTO_" . $novo_criadopor . $novo_data_criacao;
$id_documento = arruma_id($id_documento);

$novo_prioridade = $_POST['prioridade']; 

if(is_file($_FILES["arquivo_anexo"]['tmp_name'])){
	
	$novo_anexo = $_FILES['arquivo_anexo']['name'];
	
	$novo_anexo = retira_caracteres_especiais($novo_anexo);
	
	$arqType = $_FILES['arquivo_anexo']['type'];
	
	//se já existir um arquivo com o mesmo nome na anexo, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/anexos/".$novo_anexo."")){ 
			$a = 1;
			while(file_exists("../../../registros/anexos/[$a]".$novo_anexo."")){
			$a++;
			}
			$novo_anexo = "[".$a."]".$novo_anexo;
		}
		
	//salva a anexo numa pasta chamada anexos
	if(!move_uploaded_file($_FILES['arquivo_anexo']['tmp_name'], "../../../registros/anexos/".$novo_anexo)){ 
		}
	
	
}else{
	$novo_anexo = '';
}

$id_historico_documento = "HISTORICO_" . $id_documento . $novo_data_criacao;
$id_historico_documento = arruma_id($id_historico_documento);

if($novo_numero_processo != null and $novo_numero_processo != ''){
	$id_historico_processo = "HISTORICO_PROCESSO_" . $novo_numero_processo . date('Y-m-d H:i:s');
	$id_historico_processo = arruma_id($id_historico_processo);
}

$id = "ANEXO_" . $id_documento;

$num = $_GET['sessionId'];

include('../banco-dados/cadastrar.php');

?>