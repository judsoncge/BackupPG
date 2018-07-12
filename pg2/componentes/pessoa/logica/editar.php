<?php

include('../../iniciar.php');

if($_GET['operacao']=='info'){

	$edita_cargo = $_POST['cargo']; 
		
	$edita_nivel = $_POST['nivel']; 
		
	$edita_grupo = $_POST['grupo']; 

	$edita_nome = $_POST['nome'];	
		
	$edita_sobrenome = $_POST['sobrenome'];	

	$edita_nomeacao = $_POST['nomeacao'];	

	$edita_situacao_funcional = $_POST['situacao-funcional'];	

	$edita_CPF = $_GET['cpf']; 

	$edita_email_institucional = $_POST['email_institucional']; 

	$edita_matricula = $_POST['matricula']; 

	$edita_cedido_por = $_POST['cedido_por']; 

	$edita_graduacao = $_POST['graduacao']; 

	$edita_setor = $_POST['setor']; 

	$edita_salario = $_POST['salario']; 
	
	$num = $_GET['sessionId'];

}

else if($_GET['operacao']=='foto'){
	
	$pessoa = $_GET['pessoa'];
	$atual = $_GET['atual'];
	$atual = '../../../registros/fotos/'.$atual;
	$num = $_GET['sessionId'];
	


	if(is_file($_FILES["arquivo_foto"]['tmp_name'])){
		
		$edita_foto = $_FILES['arquivo_foto']['name'];
		
		$edita_foto = retira_caracteres_especiais($edita_foto);
		
		$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png'); 
		
		$arqType = $_FILES['arquivo_foto']['type'];
		
		if(array_search($arqType,$tipos) === false){ 
			echo "
			<meta http-equiv=refresh content='0; url=index.php'>
			<script type='text/javascript'>
			alert('Formato inválido');
			</script>
			";
		
		}else{ 
		
		if(file_exists("../../../registros/fotos/".$edita_foto."")){ 
				$a = 1;
				while(file_exists("../../../registros/fotos/[$a]".$edita_foto."")){
				$a++;
				}
				$edita_foto = "[".$a."]".$edita_foto;
			}
		
		if(!move_uploaded_file($_FILES['arquivo_foto']['tmp_name'], "../../../registros/fotos/".$edita_foto)){ 
			
			}
		}
		
	}else{
		$edita_foto = $_GET['atual'];
	}

}


else if($_GET['operacao']=='senha'){
	
	$pessoa = $_GET['pessoa'];

	$edita_nova_senha = $_POST['nova_senha']; 

	$edita_confirma_nova_senha = $_POST['confirma_senha']; 
	
	$num = $_GET['sessionId'];

	if($edita_nova_senha != $edita_confirma_nova_senha){
		header("Location:../../../interface/edita-senha.php?sessionId=$num&mensagem=As senhas não correspondem!&resultado=falha");
		die();
	}else{
		$edita_nova_senha = md5($edita_nova_senha);
	}
	
}


else if($_GET['operacao']=='permissao'){
	
	$pessoa = $_GET['pessoa'];

	if(isset($_POST['VISUALIZAR_CHAMADO'])){$VISUALIZAR_CHAMADO = "sim"; } else { $VISUALIZAR_CHAMADO = "não"; }
	if(isset($_POST['VISUALIZAR_TODOS_CHAMADO'])){$VISUALIZAR_TODOS_CHAMADO = "sim"; } else { $VISUALIZAR_TODOS_CHAMADO = "não"; }
	if(isset($_POST['ABRIR_CHAMADO'])){$ABRIR_CHAMADO = "sim"; } else { $ABRIR_CHAMADO = "não"; }
	if(isset($_POST['ABRIR_TODOS_CHAMADO'])){$ABRIR_TODOS_CHAMADO = "sim"; } else { $ABRIR_TODOS_CHAMADO = "não"; }
	if(isset($_POST['EDITAR_CHAMADO'])){$EDITAR_CHAMADO = "sim"; } else { $EDITAR_CHAMADO = "não"; }
	if(isset($_POST['EXCLUIR_CHAMADO'])){$EXCLUIR_CHAMADO = "sim"; } else { $EXCLUIR_CHAMADO = "não"; }
	if(isset($_POST['FECHAR_CHAMADO'])){$FECHAR_CHAMADO ="sim";  } else { $FECHAR_CHAMADO = "não"; }
	if(isset($_POST['ENCERRAR_CHAMADO'])){$ENCERRAR_CHAMADO = "sim";  } else { $ENCERRAR_CHAMADO = "não"; }
	if(isset($_POST['VISUALIZAR_RELATORIO_CHAMADO'])){$VISUALIZAR_RELATORIO_CHAMADO = "sim"; } else { $VISUALIZAR_RELATORIO_CHAMADO = "não"; }
	if(isset($_POST['VISUALIZAR_COMUNICACAO'])){$VISUALIZAR_COMUNICACAO = "sim"; } else { $VISUALIZAR_COMUNICACAO = "não"; }
	if(isset($_POST['CADASTRAR_COMUNICACAO'])){$CADASTRAR_COMUNICACAO = "sim"; } else { $CADASTRAR_COMUNICACAO = "não"; }
	if(isset($_POST['EDITAR_COMUNICACAO'])){$EDITAR_COMUNICACAO = "sim"; } else { $EDITAR_COMUNICACAO = "não"; }
	if(isset($_POST['EXCLUIR_COMUNICACAO'])){$EXCLUIR_COMUNICACAO = "sim"; } else { $EXCLUIR_COMUNICACAO = "não"; }
	if(isset($_POST['VISUALIZAR_DOCUMENTO'])){$VISUALIZAR_DOCUMENTO = "sim"; } else { $VISUALIZAR_DOCUMENTO = "não"; }
	if(isset($_POST['VISUALIZAR_TODOS_SETOR_DOCUMENTO'])){$VISUALIZAR_TODOS_SETOR_DOCUMENTO = "sim"; } else { $VISUALIZAR_TODOS_SETOR_DOCUMENTO = "não"; }
	if(isset($_POST['VISUALIZAR_TODOS_ORGAO_DOCUMENTO'])){$VISUALIZAR_TODOS_ORGAO_DOCUMENTO = "sim"; } else { $VISUALIZAR_TODOS_ORGAO_DOCUMENTO = "não"; }
	if(isset($_POST['CADASTRAR_DOCUMENTO'])){$CADASTRAR_DOCUMENTO = "sim"; } else { $CADASTRAR_DOCUMENTO = "não"; }
	if(isset($_POST['EDITAR_DOCUMENTO'])){$EDITAR_DOCUMENTO = "sim"; } else { $EDITAR_DOCUMENTO = "não"; }
	if(isset($_POST['EXCLUIR_DOCUMENTO'])){$EXCLUIR_DOCUMENTO = "sim"; } else { $EXCLUIR_DOCUMENTO = "não"; }
	if(isset($_POST['APROVAR_DOCUMENTO'])){$APROVAR_DOCUMENTO = "sim"; } else { $APROVAR_DOCUMENTO = "não"; }
	if(isset($_POST['SUGESTAO_DOCUMENTO'])){$SUGESTAO_DOCUMENTO = "sim"; } else { $SUGESTAO_DOCUMENTO = "não"; }
	if(isset($_POST['RESOLVER_DOCUMENTO'])){$RESOLVER_DOCUMENTO = "sim"; } else { $RESOLVER_DOCUMENTO = "não"; }
	if(isset($_POST['VISUALIZAR_INDICE_PRODUTIVIDADE'])){$VISUALIZAR_INDICE_PRODUTIVIDADE = "sim"; } else { $VISUALIZAR_INDICE_PRODUTIVIDADE = "não"; }
	if(isset($_POST['VISUALIZAR_TODOS_SETOR_INDICE_PRODUTIVIDADE'])){$VISUALIZAR_TODOS_SETOR_INDICE_PRODUTIVIDADE = "sim"; } else { $VISUALIZAR_TODOS_SETOR_INDICE_PRODUTIVIDADE = "não"; }
	if(isset($_POST['VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE'])){$VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE = "sim"; } else { $VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE = "não"; }
	if(isset($_POST['AVALIAR_ASSIDUIDADE'])){$AVALIAR_ASSIDUIDADE = "sim"; } else { $AVALIAR_ASSIDUIDADE = "não"; }
	if(isset($_POST['NOTA_EXTRA_INDICE_PRODUTIVIDADE'])){$NOTA_EXTRA_INDICE_PRODUTIVIDADE = "sim"; } else { $NOTA_EXTRA_INDICE_PRODUTIVIDADE = "não"; }
	if(isset($_POST['SER_AVALIADO_INDICE_PRODUTIVIDADE'])){$SER_AVALIADO_INDICE_PRODUTIVIDADE = "sim"; } else { $SER_AVALIADO_INDICE_PRODUTIVIDADE = "não"; }
	if(isset($_POST['VISUALIZAR_PROCESSO'])){$VISUALIZAR_PROCESSO = "sim"; } else { $VISUALIZAR_PROCESSO = "não"; }
	if(isset($_POST['VISUALIZAR_TODOS_SETOR_PROCESSO'])){$VISUALIZAR_TODOS_SETOR_PROCESSO = "sim"; } else { $VISUALIZAR_TODOS_SETOR_PROCESSO = "não"; }
	if(isset($_POST['VISUALIZAR_TODOS_ORGAO_PROCESSO'])){$VISUALIZAR_TODOS_ORGAO_PROCESSO = "sim"; } else { $VISUALIZAR_TODOS_ORGAO_PROCESSO = "não"; }
	if(isset($_POST['VISUALIZAR_ARQUIVADOS_PROCESSO'])){$VISUALIZAR_ARQUIVADOS_PROCESSO = "sim"; } else { $VISUALIZAR_ARQUIVADOS_PROCESSO = "não"; }
	if(isset($_POST['VISUALIZAR_SAIRAM_PROCESSO'])){$VISUALIZAR_SAIRAM_PROCESSO = "sim"; } else { $VISUALIZAR_SAIRAM_PROCESSO = "não"; }
	if(isset($_POST['ABRIR_PROCESSO'])){$ABRIR_PROCESSO = "sim"; } else { $ABRIR_PROCESSO = "não"; }
	if(isset($_POST['EDITAR_PROCESSO'])){$EDITAR_PROCESSO = "sim"; } else { $EDITAR_PROCESSO = "não"; }
	if(isset($_POST['EXCLUIR_PROCESSO'])){$EXCLUIR_PROCESSO = "sim"; } else { $EXCLUIR_PROCESSO = "não"; }
	if(isset($_POST['DESPACHO_PROCESSO'])){$DESPACHO_PROCESSO = "sim"; } else { $DESPACHO_PROCESSO = "não"; }
	if(isset($_POST['PARECER_PROCESSO'])){$PARECER_PROCESSO = "sim"; } else { $PARECER_PROCESSO = "não"; }
	if(isset($_POST['CONCLUIR_PROCESSO'])){$CONCLUIR_PROCESSO = "sim"; } else { $CONCLUIR_PROCESSO = "não"; }
	if(isset($_POST['FINALIZAR_PROCESSO'])){$FINALIZAR_PROCESSO = "sim"; } else { $FINALIZAR_PROCESSO = "não"; }
	if(isset($_POST['ARQUIVAR_PROCESSO'])){$ARQUIVAR_PROCESSO = "sim"; } else { $ARQUIVAR_PROCESSO = "não"; }
	if(isset($_POST['SAIDA_PROCESSO'])){$SAIDA_PROCESSO = "sim"; } else { $SAIDA_PROCESSO = "não"; }
	if(isset($_POST['VOLTAR_PROCESSO'])){$VOLTAR_PROCESSO = "sim"; } else { $VOLTAR_PROCESSO = "não"; }
	if(isset($_POST['DEFINIR_RESPONSAVEIS_PROCESSO'])){$DEFINIR_RESPONSAVEIS_PROCESSO = "sim"; } else { $DEFINIR_RESPONSAVEIS_PROCESSO = "não"; }
	if(isset($_POST['SER_RESPONSAVEL_PROCESSO'])){$SER_RESPONSAVEL_PROCESSO = "sim"; } else { $SER_RESPONSAVEL_PROCESSO = "não"; }
	if(isset($_POST['DESTINO_PROCESSO'])){$DESTINO_PROCESSO = "sim"; } else { $DESTINO_PROCESSO = "não"; }
	if(isset($_POST['PRAZO_PROCESSO'])){$PRAZO_PROCESSO = "sim"; } else { $PRAZO_PROCESSO = "não"; }
	if(isset($_POST['PRAZO_FINAL_PROCESSO'])){$PRAZO_FINAL_PROCESSO = "sim"; } else { $PRAZO_FINAL_PROCESSO = "não"; }
	if(isset($_POST['VISUALIZAR_SERVIDORES'])){$VISUALIZAR_SERVIDORES = "sim"; } else { $VISUALIZAR_SERVIDORES = "não"; }
	if(isset($_POST['EDITAR_SERVIDORES'])){$EDITAR_SERVIDORES = "sim"; } else { $EDITAR_SERVIDORES = "não"; }
	if(isset($_POST['EXCLUIR_SERVIDORES'])){$EXCLUIR_SERVIDORES = "sim"; } else { $EXCLUIR_SERVIDORES = "não"; }
	if(isset($_POST['VISUALIZAR_SETOR_RELATORIO'])){$VISUALIZAR_SETOR_RELATORIO = "sim"; } else { $VISUALIZAR_SETOR_RELATORIO = "não"; }
	if(isset($_POST['VISUALIZAR_ORGAO_RELATORIO'])){$VISUALIZAR_ORGAO_RELATORIO = "sim"; } else { $VISUALIZAR_ORGAO_RELATORIO = "não"; }
	if(isset($_POST['FAZER_OPERACOES_OUTROS_SETOR'])){$FAZER_OPERACOES_OUTROS_SETOR = "sim"; } else { $FAZER_OPERACOES_OUTROS_SETOR = "não"; }
	if(isset($_POST['FAZER_OPERACOES_OUTROS_ORGAO'])){$FAZER_OPERACOES_OUTROS_ORGAO = "sim"; } else { $FAZER_OPERACOES_OUTROS_ORGAO = "não"; }	
	
	$num = $_GET['sessionId'];
	
}




include('../banco-dados/editar.php');
?>