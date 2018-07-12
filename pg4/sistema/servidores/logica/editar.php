<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

if($_GET['operacao']=='info'){

	$edita_cargo = $_POST['cargo']; 
	
	$edita_funcao = $_POST['funcao']; 
		
	$edita_nivel = $_POST['nivel']; 
		
	$edita_grupo = $_POST['grupo']; 

	$edita_nome = $_POST['nome'];	
		
	$edita_sobrenome = $_POST['sobrenome'];	

	$edita_nomeacao = $_POST['nomeacao'];	

	$edita_situacao_funcional = $_POST['situacao-funcional'];	

	$CPF_atual = $_GET['servidor'];
	
	$edita_CPF = $_POST['CPF'];
	
	if($CPF_atual != $edita_CPF){
	
		$existe_servidor = existe_servidor($conexao_com_banco, $edita_CPF);  

		if($existe_servidor==true){ 
			echo "<script>history.back();</script>";
			echo "<script>alert('Este CPF já está cadastrado. Tente outro')</script>";
			die();
		}	
	
	}

	$edita_email_institucional = $_POST['email_institucional']; 

	$edita_matricula = $_POST['matricula']; 

	$edita_cedido_por = $_POST['cedido_por']; 

	$edita_graduacao = $_POST['graduacao']; 

	$edita_setor = $_POST['setor']; 

	$edita_salario = $_POST['salario']; 
	
	$funcao_atual = retorna_funcao_servidor($CPF_atual, $conexao_com_banco);
	
	if($edita_funcao != $funcao_atual){
		
		editar_permissoes_servidor_funcao($conexao_com_banco, $edita_funcao, $CPF_atual);
		
	}
	
	editar_servidor($conexao_com_banco, $CPF_atual ,$edita_cargo, $edita_funcao,$edita_setor,$edita_nivel,$edita_grupo,$edita_salario,$edita_nome, $edita_sobrenome , $edita_nomeacao,$edita_situacao_funcional, $edita_CPF, $edita_email_institucional ,$edita_matricula, $edita_cedido_por ,$edita_graduacao);
	
	
	
	echo '<script>history.back();</script>';
	echo '<script>history.back();</script>';
}

else if($_GET['operacao']=='foto'){
	
	$servidor = $_SESSION['CPF'];
	
	cadastrar_anexo($conexao_com_banco, $servidor, $_FILES['arquivo_foto'], 'foto');
	
	echo '<script>history.back();</script>';
	echo '<script>history.back();</script>';

}


else if($_GET['operacao']=='senha'){
	
	$servidor = $_GET['pessoa'];

	$edita_nova_senha = $_POST['nova_senha']; 

	$edita_confirma_nova_senha = $_POST['confirma_senha']; 

	if($edita_nova_senha != $edita_confirma_nova_senha){
		header("Location:../editar-senha.php?mensagem=As senhas não conferem!&resultado=falha");
		die();
	}else{
		$edita_nova_senha = md5($edita_nova_senha);
		editar_senha_servidor($conexao_com_banco, $servidor, $edita_nova_senha);
		header("Location:../editar-senha.php?mensagem=A senha foi alterada com sucesso!&resultado=sucesso");
		
	}
	
}


else if($_GET['operacao']=='permissao'){
	
	$servidor = $_GET['pessoa'];

	$informacoes = retorna_permissoes_servidor($servidor, $conexao_com_banco);
	
	foreach($informacoes as $val){ 
		
		if($val->name!='ID' and $val->name!='CD_SERVIDOR'){
			if(isset($_POST[$val->name])){
				setar_permissao_servidor($conexao_com_banco, $servidor, $val->name, 'sim');
			}else{
				setar_permissao_servidor($conexao_com_banco, $servidor, $val->name, 'não');
			}
		}
	}
	
	header("Location:../listar.php?mensagem=As permissões foram atualizadas com sucesso!&resultado=sucesso");
	
}

?>