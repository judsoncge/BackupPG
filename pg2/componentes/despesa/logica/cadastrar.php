<?php

include('../../iniciar.php');
include('../../notificacao/logica/cadastrar.php');

if($_GET['operacao']=='despesa'){
	
	$novo_codigo_despesa = $_POST['tipo'];

	$novo_descricao = $_POST['descricao'];

	$novo_mes = $_POST['mes'];

	$novo_ano = $_POST['ano'];
	
	$novo_valor = $_POST['valor'];
	
	$novo_data_vencimento = $_POST['data'];
	
	$num = $_GET['sessionId'];
	
	$pessoa = $_SESSION['CPF'];
	
	$data_hoje = date('Y-m-d H:i:s');
	
	$id_despesa = 'DESPESA_' . $pessoa . $data_hoje;
	$id_despesa = arruma_id($id_despesa);
	
	$id_anexo = "ANEXO_" . $id_despesa;
	
	$id_historico_despesa = "HISTORICO_" . $id_despesa;
	
	
	
	if(is_file($_FILES["arquivo_anexo"]['tmp_name'])){
	
		$novo_anexo = $_FILES['arquivo_anexo']['name'];
		
		$novo_anexo = retira_caracteres_especiais($novo_anexo);
		
		$arqType = $_FILES['arquivo_anexo']['type'];
		
		//se jรก existir um arquivo com o mesmo nome na anexo, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
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
	$nome_requisitante = retorna_nome_servidor($pessoa, $conexao_com_banco);
	$nome_despesa = retorna_nome_despesa($novo_codigo_despesa, $conexao_com_banco);
	notificar_autorizar_empenho($conexao_com_banco, $id_despesa, $nome_despesa, $nome_requisitante, $pessoa);
	
}else if($_GET['operacao']=='tipo_despesa'){

	$novo_codigo_despesa = $_POST['codigo'];
	
	$novo_tipo_despesa = $_POST['tipo'];
	
	$novo_nome_despesa = $_POST['nome'];
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_tipos_despesas WHERE CD_DESPESA='$novo_codigo_despesa'");
	$linha = mysqli_affected_rows($conexao_com_banco);
	if($linha==1){ 
		echo "<script>history.back();</script>";
		echo "<script>alert('Esta despesa já está cadastrada.')</script>";
		die();
	}
	
	$num = $_GET['sessionId'];

}	

include('../banco-dados/cadastrar.php');

?>