<?php

include('../../banco-dados/conectar.php');

//pegando o cargo digitado pelo usuario no cadastro
$novo_cargo = $_POST['cargo']; 

//pegando o nivel digitado pelo usuario no cadastro	
$novo_nivel = $_POST['nivel']; 

//pegando o grupo digitado pelo usuario no cadastro	
$novo_grupo = $_POST['grupo']; 

//pegando o nome digitado pelo usuario no cadastro	
$novo_nome = $_POST['nome'];	

//pegando o nome digitado pelo usuario no cadastro	
$novo_sobrenome = $_POST['sobrenome'];	

//pegando a nomeação digitada pelo usuario no cadastro
$novo_nomeacao = $_POST['nomeacao'];	

//pegando a situação funcional digitado pelo usuario no cadastro
$novo_situacao_funcional = $_POST['situacao-funcional'];	

//verificando se o CPF já está cadastrado no banco, pois não pode haver dois valores iguais
$cpf_verificacao = $_POST['CPF'];
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM pessoa WHERE CPF='$cpf_verificacao'");
$linha = mysqli_affected_rows($conexao_com_banco);
//se ja estiver cadastrado...
if($linha==1){ 
	echo "<script>history.back();</script>";
	echo "<script>alert('Este CPF já está cadastrado. Tente outro')</script>";
	die();
}else{
	//se ainda não estiver cadastrado, pegando o cpf digitado pelo usuario no cadastro
	$novo_CPF = $_POST['CPF']; 
}	
//pegando email digitado pelo usuario no cadastro
$novo_email_institucional = $_POST['email_institucional']; 

//pegando a matrícula digitada pelo usuario no cadastro
$novo_matricula = $_POST['matricula']; 

//pegando o orgao cedido digitado pelo usuario no cadastro
$novo_cedido_por = $_POST['cedido_por']; 

//pegando a graduação digitado pelo usuario no cadastro
$novo_graduacao = $_POST['graduacao']; 

//pegando o setor digitado pelo usuario no cadastro
$novo_setor = $_POST['setor']; 

//pegando o salário digitado pelo usuario no cadastro
$novo_salario = $_POST['salario']; 

//verificando se a senha digitada pelo usuário é a mesma do campo confirma senha
$v_senha = $_POST['senha'];
$v_confirma_senha = $_POST['confirma-senha'];
//se não for igual...
if($v_senha != $v_confirma_senha){ 
	echo "<script>alert('Senhas não correspondem!')</script>";
	echo "<script>history.back();</script>";
	die();
	//se for igual...
}else{ 
	$novo_senha = md5($_POST['senha']); 
}

//validando a foto selecionada pelo usuário
if(is_file($_FILES["arquivo_foto"]['tmp_name'])){
	//gravando a foto numa variável de sessão
	$novo_foto = $_FILES['arquivo_foto']['name'];
	//tirar caracteres especiais
	$novo_foto = str_replace(" ","_",$novo_foto);
	$novo_foto = str_replace("á","a",$novo_foto);
	$novo_foto = str_replace("à","a",$novo_foto);
	$novo_foto = str_replace("ã","a",$novo_foto);
	$novo_foto = str_replace("â","a",$novo_foto);
	$novo_foto = str_replace("ä","a",$novo_foto);
	$novo_foto = str_replace("é","e",$novo_foto);
	$novo_foto = str_replace("è","e",$novo_foto);
	$novo_foto = str_replace("ê","e",$novo_foto);
	$novo_foto = str_replace("ë","e",$novo_foto);
	$novo_foto = str_replace("í","i",$novo_foto);
	$novo_foto = str_replace("ì","i",$novo_foto);
	$novo_foto = str_replace("î","i",$novo_foto);
	$novo_foto = str_replace("ï","i",$novo_foto);
	$novo_foto = str_replace("ó","o",$novo_foto);
	$novo_foto = str_replace("ò","o",$novo_foto);
	$novo_foto = str_replace("õ","o",$novo_foto);
	$novo_foto = str_replace("ô","o",$novo_foto);
	$novo_foto = str_replace("ö","o",$novo_foto);
	$novo_foto = str_replace("ú","u",$novo_foto);
	$novo_foto = str_replace("ù","u",$novo_foto);
	$novo_foto = str_replace("û","u",$novo_foto);
	$novo_foto = str_replace("ü","u",$novo_foto);
	$novo_foto = str_replace("ç","c",$novo_foto);
	$novo_foto = strtolower($novo_foto);
	//verificando a extensão do arquivo postado, e só aceita jpg,jpeg,pjpeg,gif
	$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png'); 
	//pegando o tipo do arquivo
	$arqType = $_FILES['arquivo_foto']['type'];
	//se o arquivo tiver um formato não aceito pelos mencionados acima...
	if(array_search($arqType,$tipos) === false){ 
		echo "
		<script type='text/javascript'>
		alert('Formato inválido');
		</script>
		";
	//se o formato for aceito...
	}else{ 
	//se já existir um arquivo com o mesmo nome na foto, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/fotos/".$novo_foto."")){ 
			$a = 1;
			while(file_exists("../../../registros/fotos/[$a]".$novo_foto."")){
			$a++;
			}
			$novo_foto = "[".$a."]".$novo_foto;
		}
	//salva a foto numa pasta chamada fotos
	if(!move_uploaded_file($_FILES['arquivo_foto']['tmp_name'], "../../../registros/fotos/".$novo_foto)){ 
		}
	}
	
}else{
	$novo_foto = "user-default.png";
}
//validando a dados selecionada pelo usuário
if(is_file($_FILES["arquivo_dados"]['tmp_name'])){
	//gravando a dados numa variável de sessão
	$novo_dados = $_FILES['arquivo_dados']['name'];
	//tirar caracteres especiais
	$novo_dados = str_replace(" ","_",$novo_dados);
	$novo_dados = str_replace("á","a",$novo_dados);
	$novo_dados = str_replace("à","a",$novo_dados);
	$novo_dados = str_replace("ã","a",$novo_dados);
	$novo_dados = str_replace("â","a",$novo_dados);
	$novo_dados = str_replace("ä","a",$novo_dados);
	$novo_dados = str_replace("é","e",$novo_dados);
	$novo_dados = str_replace("è","e",$novo_dados);
	$novo_dados = str_replace("ê","e",$novo_dados);
	$novo_dados = str_replace("ë","e",$novo_dados);
	$novo_dados = str_replace("í","i",$novo_dados);
	$novo_dados = str_replace("ì","i",$novo_dados);
	$novo_dados = str_replace("î","i",$novo_dados);
	$novo_dados = str_replace("ï","i",$novo_dados);
	$novo_dados = str_replace("ó","o",$novo_dados);
	$novo_dados = str_replace("ò","o",$novo_dados);
	$novo_dados = str_replace("õ","o",$novo_dados);
	$novo_dados = str_replace("ô","o",$novo_dados);
	$novo_dados = str_replace("ö","o",$novo_dados);
	$novo_dados = str_replace("ú","u",$novo_dados);
	$novo_dados = str_replace("ù","u",$novo_dados);
	$novo_dados = str_replace("û","u",$novo_dados);
	$novo_dados = str_replace("ü","u",$novo_dados);
	$novo_dados = str_replace("ç","c",$novo_dados);
	$novo_dados = strtolower($novo_dados);
	//verificando a extensão do arquivo postado, e só aceita jpg,jpeg,pjpeg,gif
	$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png', 'document/pdf'); 
	//pegando o tipo do arquivo
	$arqType = $_FILES['arquivo_dados']['type'];
	//se o arquivo tiver um formato não aceito pelos mencionados acima...
	if(array_search($arqType,$tipos) === false){ 
		echo "
		<meta http-equiv=refresh content='0; url=index.php'>
		<script type='text/javascript'>
		alert('Formato inválido');
		</script>
		";
	//se o formato for aceito...
	}else{ 
	//se já existir um arquivo com o mesmo nome na dados, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/dados/".$novo_dados."")){ 
			$a = 1;
			while(file_exists("../../../registros/dados/[$a]".$novo_dados."")){
			$a++;
			}
			$novo_dados = "[".$a."]".$novo_dados;
		}
	//salva a dados numa pasta chamada dados
	if(!move_uploaded_file($_FILES['arquivo_dados']['tmp_name'], "../../../registros/dados/".$novo_dados)){ 
		}
	}
}else{
	$novo_dados = " ";
}
	
//validando a dados selecionada pelo usuário
if(is_file($_FILES["arquivo_comprovante"]['tmp_name'])){
	//gravando a dados numa variável de sessão
	$novo_comprovante = $_FILES['arquivo_comprovante']['name'];
	//tirar caracteres especiais
	$novo_comprovante = str_replace(" ","_",$novo_comprovante);
	$novo_comprovante = str_replace("á","a",$novo_comprovante);
	$novo_comprovante = str_replace("à","a",$novo_comprovante);
	$novo_comprovante = str_replace("ã","a",$novo_comprovante);
	$novo_comprovante = str_replace("â","a",$novo_comprovante);
	$novo_comprovante = str_replace("ä","a",$novo_comprovante);
	$novo_comprovante = str_replace("é","e",$novo_comprovante);
	$novo_comprovante = str_replace("è","e",$novo_comprovante);
	$novo_comprovante = str_replace("ê","e",$novo_comprovante);
	$novo_comprovante = str_replace("ë","e",$novo_comprovante);
	$novo_comprovante = str_replace("í","i",$novo_comprovante);
	$novo_comprovante = str_replace("ì","i",$novo_comprovante);
	$novo_comprovante = str_replace("î","i",$novo_comprovante);
	$novo_comprovante = str_replace("ï","i",$novo_comprovante);
	$novo_comprovante = str_replace("ó","o",$novo_comprovante);
	$novo_comprovante = str_replace("ò","o",$novo_comprovante);
	$novo_comprovante = str_replace("õ","o",$novo_comprovante);
	$novo_comprovante = str_replace("ô","o",$novo_comprovante);
	$novo_comprovante = str_replace("ö","o",$novo_comprovante);
	$novo_comprovante = str_replace("ú","u",$novo_comprovante);
	$novo_comprovante = str_replace("ù","u",$novo_comprovante);
	$novo_comprovante = str_replace("û","u",$novo_comprovante);
	$novo_comprovante = str_replace("ü","u",$novo_comprovante);
	$novo_comprovante = str_replace("ç","c",$novo_comprovante);
	$novo_comprovante = strtolower($novo_comprovante);
	//verificando a extensão do arquivo postado, e só aceita jpg,jpeg,pjpeg,gif
	$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png', 'document/pdf'); 
	//pegando o tipo do arquivo
	$arqType = $_FILES['arquivo_comprovante']['type'];
	//se o arquivo tiver um formato não aceito pelos mencionados acima...
	if(array_search($arqType,$tipos) === false){ 
		echo "
		<meta http-equiv=refresh content='0; url=index.php'>
		<script type='text/javascript'>
		alert('Formato inválido');
		</script>
		";
	//se o formato for aceito...
	}else{ 
	//se já existir um arquivo com o mesmo nome na dados, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/comprovantes/".$novo_comprovante."")){ 
			$a = 1;
			while(file_exists("../../../registros/comprovantes/[$a]".$novo_comprovante."")){
			$a++;
			}
			$novo_comprovante = "[".$a."]".$novo_comprovante;
		}
	//salva a dados numa pasta chamada dados
	if(!move_uploaded_file($_FILES['arquivo_comprovante']['tmp_name'], "../../../registros/comprovantes/".$novo_comprovante)){ 
		}
	}	
}else{
	$novo_comprovante = " ";
}
	
	
	

//validando a dados selecionada pelo usuário
if(is_file($_FILES["arquivo_diploma"]['tmp_name'])){
	//gravando a dados numa variável de sessão
	$novo_diploma = $_FILES['arquivo_diploma']['name'];
	//tirar caracteres especiais
	$novo_diploma = str_replace(" ","_",$novo_diploma);
	$novo_diploma = str_replace("á","a",$novo_diploma);
	$novo_diploma = str_replace("à","a",$novo_diploma);
	$novo_diploma = str_replace("ã","a",$novo_diploma);
	$novo_diploma = str_replace("â","a",$novo_diploma);
	$novo_diploma = str_replace("ä","a",$novo_diploma);
	$novo_diploma = str_replace("é","e",$novo_diploma);
	$novo_diploma = str_replace("è","e",$novo_diploma);
	$novo_diploma = str_replace("ê","e",$novo_diploma);
	$novo_diploma = str_replace("ë","e",$novo_diploma);
	$novo_diploma = str_replace("í","i",$novo_diploma);
	$novo_diploma = str_replace("ì","i",$novo_diploma);
	$novo_diploma = str_replace("î","i",$novo_diploma);
	$novo_diploma = str_replace("ï","i",$novo_diploma);
	$novo_diploma = str_replace("ó","o",$novo_diploma);
	$novo_diploma = str_replace("ò","o",$novo_diploma);
	$novo_diploma = str_replace("õ","o",$novo_diploma);
	$novo_diploma = str_replace("ô","o",$novo_diploma);
	$novo_diploma = str_replace("ö","o",$novo_diploma);
	$novo_diploma = str_replace("ú","u",$novo_diploma);
	$novo_diploma = str_replace("ù","u",$novo_diploma);
	$novo_diploma = str_replace("û","u",$novo_diploma);
	$novo_diploma = str_replace("ü","u",$novo_diploma);
	$novo_diploma = str_replace("ç","c",$novo_diploma);
	$novo_diploma = strtolower($novo_diploma);
	//verificando a extensão do arquivo postado, e só aceita jpg,jpeg,pjpeg,gif
	$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png', 'document/pdf'); 
	//pegando o tipo do arquivo
	$arqType = $_FILES['arquivo_diploma']['type'];
	//se o arquivo tiver um formato não aceito pelos mencionados acima...
	if(array_search($arqType,$tipos) === false){ 
		echo "
		<meta http-equiv=refresh content='0; url=index.php'>
		<script type='text/javascript'>
		alert('Formato inválido');
		</script>
		";
	//se o formato for aceito...
	}else{ 
	//se já existir um arquivo com o mesmo nome na dados, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/diplomas/".$novo_diploma."")){ 
			$a = 1;
			while(file_exists("../../../registros/diplomas/[$a]".$novo_diploma."")){
			$a++;
			}
			$novo_diploma = "[".$a."]".$novo_diploma;
		}
	//salva a dados numa pasta chamada dados
	if(!move_uploaded_file($_FILES['arquivo_diploma']['tmp_name'], "../../../registros/diplomas/".$novo_diploma)){ 
		}
	}	
}else{
	$novo_diploma = " ";
}


if(isset($_POST['abrir_chamado_pessoa'])){ $novo_abrir_chamado_pessoa = "Sim"; } else { $novo_abrir_chamado_pessoa = "Não"; }
if(isset($_POST['fechar_chamado'])){ $novo_fechar_chamado = "Sim";}else{ $novo_fechar_chamado = "Não";}
if(isset($_POST['nota_chamado'])){ $novo_nota_chamado = "Sim";}else{ $novo_nota_chamado = "Não";}
if(isset($_POST['visualizar_todos_chamados'])){ $novo_visualizar_todos_chamados = "Sim";}else{ $novo_visualizar_todos_chamados = "Não";}
if(isset($_POST['visualizar_financeiro'])){ $novo_visualizar_financeiro = "Sim";}else{ $novo_visualizar_financeiro = "Não";}
if(isset($_POST['cadastrar_comunicacao'])){ $novo_cadastrar_comunicacao = "Sim";}else{ $novo_cadastrar_comunicacao = "Não";}
if(isset($_POST['visualizar_processo'])){ $novo_visualizar_processo = "Sim";}else{ $novo_visualizar_processo = "Não";}
if(isset($_POST['abrir_processo'])){ $novo_abrir_processo = "Sim";}else{ $novo_abrir_processo = "Não";}
if(isset($_POST['analisar_processo'])){ $novo_analisar_processo = "Sim";}else{ $novo_analisar_processo = "Não";}
if(isset($_POST['prazo_processo'])){ $novo_prazo_processo = "Sim";}else{ $novo_prazo_processo = "Não";}
if(isset($_POST['prazo_final_processo'])){ $novo_prazo_final_processo = "Sim";}else{ $novo_prazo_final_processo = "Não";}
if(isset($_POST['arquivar_processo'])){ $novo_arquivar_processo = "Sim";}else{ $novo_arquivar_processo = "Não";}
if(isset($_POST['saida_processo'])){ $novo_saida_processo = "Sim";}else{ $novo_saida_processo = "Não";}
if(isset($_POST['visualizar_processo_todos'])){ $novo_visualizar_processo_todos = "Sim";}else{ $novo_visualizar_processo_todos = "Não";}
if(isset($_POST['destino_tramitacao_processo'])){ $novo_destino_tramitacao_processo = "Sim";}else{ $novo_destino_tramitacao_processo = "Não";}
if(isset($_POST['concluir_processo'])){ $novo_concluir_processo = "Sim";}else{ $novo_concluir_processo = "Não";}
if(isset($_POST['finalizar_processo'])){ $novo_finalizar_processo = "Sim";}else{ $novo_finalizar_processo = "Não";}
if(isset($_POST['voltar_processo'])){ $novo_voltar_processo = "Sim";}else{ $novo_voltar_processo = "Não";}
if(isset($_POST['visualizar_servidor'])){ $novo_visualizar_servidor = "Sim";}else{ $novo_visualizar_servidor = "Não";}
if(isset($_POST['visualizar_documento'])){ $novo_visualizar_documento = "Sim";}else{ $novo_visualizar_documento = "Não";}
if(isset($_POST['visualizar_documento_todos'])){ $novo_visualizar_documento_todos = "Sim";}else{ $novo_visualizar_documento_todos = "Não";}
if(isset($_POST['aprovar_documento'])){ $novo_aprovar_documento = "Sim";}else{ $novo_aprovar_documento = "Não";}
if(isset($_POST['sugestao_documento'])){ $novo_sugestao_documento = "Sim";}else{ $novo_sugestao_documento = "Não";}
if(isset($_POST['visualizar_indice_produtividade'])){ $novo_visualizar_indice_produtividade = "Sim";}else{ $novo_visualizar_indice_produtividade = "Não";}
if(isset($_POST['avaliar_todos'])){ $novo_avaliar_todos = "Sim";}else{ $novo_avaliar_todos = "Não";}
if(isset($_POST['ser_avaliado'])){ $novo_ser_avaliado = "Sim";}else{ $novo_ser_avaliado = "Não";}


$novo_id = "PERMISSAO_".$novo_CPF;
$novo_id = str_replace('.', '', $novo_id);
$novo_id = str_replace('-', '', $novo_id);

include('../banco-dados/cadastrar.php');

?>