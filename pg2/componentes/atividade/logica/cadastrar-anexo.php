<?php

include('../../iniciar.php');
include('../banco-dados/funcoes.php');

//a variavel recebe o ID do documento que terá um anexo
$novo_id_referente = $_POST['id_referente']; 

//a variavel recebe a data atual
$novo_data_criacao = date('Y-m-d H:i:s');

//a variavel recebe a pasta que será gravado o anexo. Pode ser na pasta de fotos de usuário, pasta de notícia ou pasta de anexos
$pasta = 'anexos';
$arquivo_anexo = "anexo-".$novo_id_referente;

//verifica se de fato é um arquivo que foi anexado
if(is_file($_FILES[$arquivo_anexo]['tmp_name'])){

	//a variavel recebe o nome do arquivo anexado pelo usuário
	$novo_anexo = $_FILES[$arquivo_anexo]['name'];
	
	//a variavel recebe o novo nome sem os caracteres especiais (esta função está em arrumar dados)
	$novo_anexo = retira_caracteres_especiais($novo_anexo);
	
	//a variavel recebe o tipo do arquivo
	$arqType = $_FILES[$arquivo_anexo]['type'];
	
	//verifica se este anexo já está gravado na pasta	
	if(file_exists("../../../registros/".$pasta."/".$novo_anexo)){ 
			
			//se sim, coloca um número na frente do anexo, para diferenciar o nome
			$a = 1;
			while(file_exists("../../../registros/".$pasta."/[$a]".$novo_anexo."")){
			$a++;
			}
			//a variavel recebe [1]nome caso já tenha um gravado, [2]nome caso já tenham dois gravados na pasta, e assim por diante
			$novo_anexo = "[".$a."]".$novo_anexo;
		}
	
	//salva o arquivo na pasta de acordo com o tipo de anexo
	if(!move_uploaded_file($_FILES[$arquivo_anexo]['tmp_name'], "../../../registros/".$pasta."/".$novo_anexo)){ 
		}
	
//caso não seja um arquivo válido, volta para a página de anexo pedindo que o usuário anexe um arquivo válido

//criando o ID para salvar no banco de dados, baseado no ID do documento referente e na data, hora e segundo atual
$id = "ANEXO_ATIVIDADE_" . $novo_id_referente . $novo_data_criacao;

//retira os pontos, hífens e barras do ID.
$id = arruma_id($id);

mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos(ID, CD_REFERENTE, NM_ARQUIVO) VALUES ('$id', 'ATIVIDADE_$novo_id_referente' ,'$novo_anexo')") 
or die (mysqli_error($conexao_com_banco));
finalizar_atividade($novo_id_referente, $conexao_com_banco);
	
}

echo "<script>history.back();</script>";

?>