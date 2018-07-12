<?php

include('../../banco-dados/conectar.php');
//pegando o cargo digitado pelo usuario na edição
$edita_cargo = $_POST['cargo']; 

//pegando o nivel digitado pelo usuario na edição	
$edita_nivel = $_POST['nivel']; 

//pegando o grupo digitado pelo usuario na edição	
$edita_grupo = $_POST['grupo']; 

//pegando o nome digitado pelo usuario na edição	
$edita_nome = $_POST['nome'];	

//pegando o nome digitado pelo usuario na edição	
$edita_sobrenome = $_POST['sobrenome'];	

//pegando a nomeação digitada pelo usuario na edição
$edita_nomeacao = $_POST['nomeacao'];	

//pegando a situação funcional digitado pelo usuario na edição
$edita_situacao_funcional = $_POST['situacao-funcional'];	

//pegando o CPF
$edita_CPF = $_GET['cpf']; 

//pegando email digitado pelo usuario na edição
$edita_email_institucional = $_POST['email_institucional']; 

//pegando a matrícula digitada pelo usuario na edição
$edita_matricula = $_POST['matricula']; 

//pegando o orgao cedido digitado pelo usuario na edição
$edita_cedido_por = $_POST['cedido_por']; 

//pegando a graduação digitado pelo usuario na edição
$edita_graduacao = $_POST['graduacao']; 

//pegando o setor digitado pelo usuario na edição
$edita_setor = $_POST['setor']; 

//pegando o salário digitado pelo usuario na edição
$edita_salario = $_POST['salario']; 

//validando a foto selecionada pelo usuário
if(is_file($_FILES["arquivo_foto"]['tmp_name'])){
	//gravando a foto numa variável de sessão
	$edita_foto = $_FILES['arquivo_foto']['name'];
	//tirar caracteres especiais
	$edita_foto = str_replace(" ","_",$edita_foto);
	$edita_foto = str_replace("á","a",$edita_foto);
	$edita_foto = str_replace("à","a",$edita_foto);
	$edita_foto = str_replace("ã","a",$edita_foto);
	$edita_foto = str_replace("â","a",$edita_foto);
	$edita_foto = str_replace("ä","a",$edita_foto);
	$edita_foto = str_replace("é","e",$edita_foto);
	$edita_foto = str_replace("è","e",$edita_foto);
	$edita_foto = str_replace("ê","e",$edita_foto);
	$edita_foto = str_replace("ë","e",$edita_foto);
	$edita_foto = str_replace("í","i",$edita_foto);
	$edita_foto = str_replace("ì","i",$edita_foto);
	$edita_foto = str_replace("î","i",$edita_foto);
	$edita_foto = str_replace("ï","i",$edita_foto);
	$edita_foto = str_replace("ó","o",$edita_foto);
	$edita_foto = str_replace("ò","o",$edita_foto);
	$edita_foto = str_replace("õ","o",$edita_foto);
	$edita_foto = str_replace("ô","o",$edita_foto);
	$edita_foto = str_replace("ö","o",$edita_foto);
	$edita_foto = str_replace("ú","u",$edita_foto);
	$edita_foto = str_replace("ù","u",$edita_foto);
	$edita_foto = str_replace("û","u",$edita_foto);
	$edita_foto = str_replace("ü","u",$edita_foto);
	$edita_foto = str_replace("ç","c",$edita_foto);
	$edita_foto = strtolower($edita_foto);
	//verificando a extensão do arquivo postado, e só aceita jpg,jpeg,pjpeg,gif
	$tipos = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png'); 
	//pegando o tipo do arquivo
	$arqType = $_FILES['arquivo_foto']['type'];
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
	//se já existir um arquivo com o mesmo nome na foto, enumera [1]nomeigual.jpg,[2]nomeigual.jpg...
	if(file_exists("../../../registros/fotos/".$edita_foto."")){ 
			$a = 1;
			while(file_exists("../../../registros/fotos/[$a]".$edita_foto."")){
			$a++;
			}
			$edita_foto = "[".$a."]".$edita_foto;
		}
	//salva a foto numa pasta chamada fotos
	if(!move_uploaded_file($_FILES['arquivo_foto']['tmp_name'], "../../../registros/fotos/".$edita_foto)){ 
		}
	}
	
}else{
	$edita_foto = $_GET['mf'];
}



//validando a dados selecionada pelo usuário
if(is_file($_FILES["arquivo_dados"]['tmp_name'])){
	//gravando a dados numa variável de sessão
	$edita_dados = $_FILES['arquivo_dados']['name'];
	//tirar caracteres especiais
	$edita_dados = str_replace(" ","_",$edita_dados);
	$edita_dados = str_replace("á","a",$edita_dados);
	$edita_dados = str_replace("à","a",$edita_dados);
	$edita_dados = str_replace("ã","a",$edita_dados);
	$edita_dados = str_replace("â","a",$edita_dados);
	$edita_dados = str_replace("ä","a",$edita_dados);
	$edita_dados = str_replace("é","e",$edita_dados);
	$edita_dados = str_replace("è","e",$edita_dados);
	$edita_dados = str_replace("ê","e",$edita_dados);
	$edita_dados = str_replace("ë","e",$edita_dados);
	$edita_dados = str_replace("í","i",$edita_dados);
	$edita_dados = str_replace("ì","i",$edita_dados);
	$edita_dados = str_replace("î","i",$edita_dados);
	$edita_dados = str_replace("ï","i",$edita_dados);
	$edita_dados = str_replace("ó","o",$edita_dados);
	$edita_dados = str_replace("ò","o",$edita_dados);
	$edita_dados = str_replace("õ","o",$edita_dados);
	$edita_dados = str_replace("ô","o",$edita_dados);
	$edita_dados = str_replace("ö","o",$edita_dados);
	$edita_dados = str_replace("ú","u",$edita_dados);
	$edita_dados = str_replace("ù","u",$edita_dados);
	$edita_dados = str_replace("û","u",$edita_dados);
	$edita_dados = str_replace("ü","u",$edita_dados);
	$edita_dados = str_replace("ç","c",$edita_dados);
	$edita_dados = strtolower($edita_dados);
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
	if(file_exists("../../../registros/dados/".$edita_dados."")){ 
			$a = 1;
			while(file_exists("../../../registros/dados/[$a]".$edita_dados."")){
			$a++;
			}
			$edita_dados = "[".$a."]".$edita_dados;
		}
	//salva a dados numa pasta chamada dados
	if(!move_uploaded_file($_FILES['arquivo_dados']['tmp_name'], "../../../registros/dados/".$edita_dados)){ 
		}
	}
}else{
	$edita_dados = $_GET['mdg'];
}
	
//validando a dados selecionada pelo usuário
if(is_file($_FILES["arquivo_comprovante"]['tmp_name'])){
	//gravando a dados numa variável de sessão
	$edita_comprovante = $_FILES['arquivo_comprovante']['name'];
	//tirar caracteres especiais
	$edita_comprovante = str_replace(" ","_",$edita_comprovante);
	$edita_comprovante = str_replace("á","a",$edita_comprovante);
	$edita_comprovante = str_replace("à","a",$edita_comprovante);
	$edita_comprovante = str_replace("ã","a",$edita_comprovante);
	$edita_comprovante = str_replace("â","a",$edita_comprovante);
	$edita_comprovante = str_replace("ä","a",$edita_comprovante);
	$edita_comprovante = str_replace("é","e",$edita_comprovante);
	$edita_comprovante = str_replace("è","e",$edita_comprovante);
	$edita_comprovante = str_replace("ê","e",$edita_comprovante);
	$edita_comprovante = str_replace("ë","e",$edita_comprovante);
	$edita_comprovante = str_replace("í","i",$edita_comprovante);
	$edita_comprovante = str_replace("ì","i",$edita_comprovante);
	$edita_comprovante = str_replace("î","i",$edita_comprovante);
	$edita_comprovante = str_replace("ï","i",$edita_comprovante);
	$edita_comprovante = str_replace("ó","o",$edita_comprovante);
	$edita_comprovante = str_replace("ò","o",$edita_comprovante);
	$edita_comprovante = str_replace("õ","o",$edita_comprovante);
	$edita_comprovante = str_replace("ô","o",$edita_comprovante);
	$edita_comprovante = str_replace("ö","o",$edita_comprovante);
	$edita_comprovante = str_replace("ú","u",$edita_comprovante);
	$edita_comprovante = str_replace("ù","u",$edita_comprovante);
	$edita_comprovante = str_replace("û","u",$edita_comprovante);
	$edita_comprovante = str_replace("ü","u",$edita_comprovante);
	$edita_comprovante = str_replace("ç","c",$edita_comprovante);
	$edita_comprovante = strtolower($edita_comprovante);
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
	if(file_exists("../../../registros/comprovantes/".$edita_comprovante."")){ 
			$a = 1;
			while(file_exists("../../../registros/comprovantes/[$a]".$edita_comprovante."")){
			$a++;
			}
			$edita_comprovante = "[".$a."]".$edita_comprovante;
		}
	//salva a dados numa pasta chamada dados
	if(!move_uploaded_file($_FILES['arquivo_comprovante']['tmp_name'], "../../../registros/comprovantes/".$edita_comprovante)){ 
		}
	}	
}else{
	$edita_comprovante = $_GET['mc'];
}
	
	
	

//validando a dados selecionada pelo usuário
if(is_file($_FILES["arquivo_diploma"]['tmp_name'])){
	//gravando a dados numa variável de sessão
	$edita_diploma = $_FILES['arquivo_diploma']['name'];
	//tirar caracteres especiais
	$edita_diploma = str_replace(" ","_",$edita_diploma);
	$edita_diploma = str_replace("á","a",$edita_diploma);
	$edita_diploma = str_replace("à","a",$edita_diploma);
	$edita_diploma = str_replace("ã","a",$edita_diploma);
	$edita_diploma = str_replace("â","a",$edita_diploma);
	$edita_diploma = str_replace("ä","a",$edita_diploma);
	$edita_diploma = str_replace("é","e",$edita_diploma);
	$edita_diploma = str_replace("è","e",$edita_diploma);
	$edita_diploma = str_replace("ê","e",$edita_diploma);
	$edita_diploma = str_replace("ë","e",$edita_diploma);
	$edita_diploma = str_replace("í","i",$edita_diploma);
	$edita_diploma = str_replace("ì","i",$edita_diploma);
	$edita_diploma = str_replace("î","i",$edita_diploma);
	$edita_diploma = str_replace("ï","i",$edita_diploma);
	$edita_diploma = str_replace("ó","o",$edita_diploma);
	$edita_diploma = str_replace("ò","o",$edita_diploma);
	$edita_diploma = str_replace("õ","o",$edita_diploma);
	$edita_diploma = str_replace("ô","o",$edita_diploma);
	$edita_diploma = str_replace("ö","o",$edita_diploma);
	$edita_diploma = str_replace("ú","u",$edita_diploma);
	$edita_diploma = str_replace("ù","u",$edita_diploma);
	$edita_diploma = str_replace("û","u",$edita_diploma);
	$edita_diploma = str_replace("ü","u",$edita_diploma);
	$edita_diploma = str_replace("ç","c",$edita_diploma);
	$edita_diploma = strtolower($edita_diploma);
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
	if(file_exists("../../../registros/diplomas/".$edita_diploma."")){ 
			$a = 1;
			while(file_exists("../../../registros/diplomas/[$a]".$edita_diploma."")){
			$a++;
			}
			$edita_diploma = "[".$a."]".$edita_diploma;
		}
	//salva a dados numa pasta chamada dados
	if(!move_uploaded_file($_FILES['arquivo_diploma']['tmp_name'], "../../../registros/diplomas/".$edita_diploma)){ 
		}
	}	
}else{
	$edita_diploma = $_GET['md'];
}

if(isset($_POST['abrir_chamado_pessoa'])){ $edita_abrir_chamado_pessoa = "Sim"; } else { $edita_abrir_chamado_pessoa = "Não"; }
if(isset($_POST['fechar_chamado'])){ $edita_fechar_chamado = "Sim";}else{ $edita_fechar_chamado = "Não";}
if(isset($_POST['nota_chamado'])){ $edita_nota_chamado = "Sim";}else{ $edita_nota_chamado = "Não";}
if(isset($_POST['visualizar_todos_chamados'])){ $edita_visualizar_todos_chamados = "Sim";}else{ $edita_visualizar_todos_chamados = "Não";}
if(isset($_POST['visualizar_financeiro'])){ $edita_visualizar_financeiro = "Sim";}else{ $edita_visualizar_financeiro = "Não";}
if(isset($_POST['cadastrar_comunicacao'])){ $edita_cadastrar_comunicacao = "Sim";}else{ $edita_cadastrar_comunicacao = "Não";}
if(isset($_POST['visualizar_processo'])){ $edita_visualizar_processo = "Sim";}else{ $edita_visualizar_processo = "Não";}
if(isset($_POST['abrir_processo'])){ $edita_abrir_processo = "Sim";}else{ $edita_abrir_processo = "Não";}
if(isset($_POST['analisar_processo'])){ $edita_analisar_processo = "Sim";}else{ $edita_analisar_processo = "Não";}
if(isset($_POST['prazo_processo'])){ $edita_prazo_processo = "Sim";}else{ $edita_prazo_processo = "Não";}
if(isset($_POST['prazo_final_processo'])){ $edita_prazo_final_processo = "Sim";}else{ $edita_prazo_final_processo = "Não";}
if(isset($_POST['arquivar_processo'])){ $edita_arquivar_processo = "Sim";}else{ $edita_arquivar_processo = "Não";}
if(isset($_POST['saida_processo'])){ $edita_saida_processo = "Sim";}else{ $edita_saida_processo = "Não";}
if(isset($_POST['visualizar_processo_todos'])){ $edita_visualizar_processo_todos = "Sim";}else{ $edita_visualizar_processo_todos = "Não";}
if(isset($_POST['destino_tramitacao_processo'])){ $edita_destino_tramitacao_processo = "Sim";}else{ $edita_destino_tramitacao_processo = "Não";}
if(isset($_POST['concluir_processo'])){ $edita_concluir_processo = "Sim";}else{ $edita_concluir_processo = "Não";}
if(isset($_POST['finalizar_processo'])){ $edita_finalizar_processo = "Sim";}else{ $edita_finalizar_processo = "Não";}
if(isset($_POST['voltar_processo'])){ $edita_voltar_processo = "Sim";}else{ $edita_voltar_processo = "Não";}
if(isset($_POST['visualizar_servidores'])){ $edita_visualizar_servidores = "Sim";}else{ $edita_visualizar_servidores = "Não";}
if(isset($_POST['visualizar_documento'])){ $edita_visualizar_documento = "Sim";}else{ $edita_visualizar_documento = "Não";}
if(isset($_POST['visualizar_documento_todos'])){ $edita_visualizar_documento_todos = "Sim";}else{ $edita_visualizar_documento_todos = "Não";}
if(isset($_POST['aprovar_documento'])){ $edita_aprovar_documento = "Sim";}else{ $edita_aprovar_documento = "Não";}
if(isset($_POST['sugestao_documento'])){ $edita_sugestao_documento = "Sim";}else{ $edita_sugestao_documento = "Não";}
if(isset($_POST['visualizar_indice_produtividade'])){ $edita_visualizar_indice_produtividade = "Sim";}else{ $edita_visualizar_indice_produtividade = "Não";}
if(isset($_POST['avaliar_todos'])){ $edita_avaliar_todos = "Sim";}else{ $edita_avaliar_todos = "Não";}
if(isset($_POST['ser_avaliado'])){ $edita_ser_avaliado = "Sim";}else{ $edita_ser_avaliado = "Não";}

include('../banco-dados/editar.php');
?>