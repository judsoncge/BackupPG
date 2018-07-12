<?php

//incluindo a conexão com o banco de dados
include("../banco-dados/conectar.php");

//as variaveis pegam o que foi digitado pelo usuário na página index para efetuar o login
$CPF = $_POST['CPF'];

//a senha digitada pelo usuário é codificada em md5 para a busca no banco
$senha = md5($_POST['senha']); 

//fazendo a query para buscar se existe um servidor que tem as credenciais digitadas pelo usuário no index
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$CPF' AND SENHA='$senha'");

//a variavel recebe o número de registros encontrados pela query executada
$num_registros = mysqli_affected_rows($conexao_com_banco);

//se encontrou um registro...
if($num_registros == 1){
	
	//a variavel é um array que pega as informações do servidor no banco de dados
	$servidor = mysqli_fetch_array($retornoquery);
	
	//fazendo a query para pegar as permissoes do usuario
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM permissao WHERE CD_SERVIDOR='$CPF'");
	
	//a variavel é um array que pega as informações do servidor no banco de dados
	$permissoes = mysqli_fetch_array($retornoquery);
		
	//a variável recebe um número randômico para ser variável de sessão	
	$num = rand(100000,900000);
	
	//iniciando a sessão
	session_start();
	
	//setando todas as variáveis de sessão do usuário, como número de sessão e as informações gravadas no banco
	$_SESSION['numLogin']									= $num;
	$_SESSION['nome']										= $servidor['NM_SERVIDOR'];
	$_SESSION['CPF']										= $servidor['CD_SERVIDOR'];
	$_SESSION['foto']										= $servidor['NM_ARQUIVO_FOTO'];
	$_SESSION['setor']										= $servidor['CD_SETOR'];
	$_SESSION['funcao']										= $servidor['NM_FUNCAO'];
	$setor 													= $_SESSION['setor'];
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SETOR_SUBORDINADO FROM tb_setores WHERE CD_SETOR='$setor'");
	$setor_subordinado 										= mysqli_fetch_row($resultado);
	$_SESSION['setor-subordinado'] 							= $setor_subordinado[0];
	
	$_SESSION['sobrenome']									= $servidor['SNM_SERVIDOR'];
	$_SESSION['cargo']										= $servidor['NM_CARGO'];
	$_SESSION['foto']										= $servidor['NM_ARQUIVO_FOTO'];
	
	//permissoes processos
    $_SESSION['permissao-visualizar-processos']				= $permissoes['VISUALIZAR_PROCESSO'];
	$_SESSION['permissao-visualizar-processos-setor']		= $permissoes['VISUALIZAR_TODOS_SETOR_PROCESSO'];
	$_SESSION['permissao-visualizar-todos-processos']		= $permissoes['VISUALIZAR_TODOS_ORGAO_PROCESSO'];
	$_SESSION['permissao-visualizar-processos-sairam']		= $permissoes['VISUALIZAR_SAIRAM_PROCESSO'];
	$_SESSION['permissao-visualizar-processos-arquivados']	= $permissoes['VISUALIZAR_ARQUIVADOS_PROCESSO'];
	$_SESSION['permissao-abrir-processo']					= $permissoes['ABRIR_PROCESSO'];
	$_SESSION['permissao-editar-processo']					= $permissoes['EDITAR_PROCESSO'];
	$_SESSION['permissao-excluir-processo']					= $permissoes['EXCLUIR_PROCESSO'];
	$_SESSION['permissao-concluir-processo']				= $permissoes['CONCLUIR_PROCESSO'];
	$_SESSION['permissao-finalizar-processo']				= $permissoes['FINALIZAR_PROCESSO'];
	$_SESSION['permissao-finalizar-gabinete-processo']		= $permissoes['FINALIZAR_GABINETE_PROCESSO'];
	$_SESSION['permissao-desfazer-finalizacao-processo']	= $permissoes['DESFAZER_FINALIZACAO_PROCESSO'];
	$_SESSION['permissao-desfazer-finalizacao-gabinete-processo']= $permissoes['DESFAZER_FINALIZACAO_GABINETE_PROCESSO'];
	$_SESSION['permissao-arquivar-processo']				= $permissoes['ARQUIVAR_PROCESSO'];
	$_SESSION['permissao-sair-processo']					= $permissoes['SAIDA_PROCESSO'];
	$_SESSION['permissao-voltar-processo']					= $permissoes['VOLTAR_PROCESSO'];
	$_SESSION['permissao-desarquivar-processo']				= $permissoes['DESARQUIVAR_PROCESSO'];
	$_SESSION['permissao-parecer-processo']					= $permissoes['PARECER_PROCESSO'];
	$_SESSION['permissao-despacho-processo'	]				= $permissoes['DESPACHO_PROCESSO'];
	$_SESSION['permissao-definir-prazo-processo']			= $permissoes['PRAZO_PROCESSO'];
	$_SESSION['permissao-definir-responsaveis-processo']	= $permissoes['DEFINIR_RESPONSAVEIS_PROCESSO'];
	$_SESSION['permissao-urgencia-processo']				= $permissoes['URGENCIA_PROCESSO'];
	$_SESSION['permissao-guia-processo']					= $permissoes['ACESSO_GUIA_TRAMITACAO_PROCESSO'];
	$_SESSION['permissao-definir-apenso-processo']          = $permissoes['APENSO_PROCESSO'];
	
	//permissoes chamados
	$_SESSION['permissao-fechar-chamado']					= $permissoes['FECHAR_CHAMADO'];
	$_SESSION['permissao-encerrar-chamado']					= $permissoes['ENCERRAR_CHAMADO'];
	$_SESSION['permissao-nota-chamado']						= $permissoes['NOTA_CHAMADO'];
	$_SESSION['permissao-todos-chamado']					= $permissoes['ABRIR_TODOS_CHAMADO'];
	$_SESSION['permissao-abrir-chamado']					= $permissoes['ABRIR_CHAMADO'];
	$_SESSION['permissao-excluir-chamado']					= $permissoes['EXCLUIR_CHAMADO'];
	$_SESSION['permissao-visualizar-chamado']				= $permissoes['VISUALIZAR_CHAMADO'];
	$_SESSION['permissao-visualizar-relatorio-chamado']		= $permissoes['VISUALIZAR_RELATORIO_CHAMADO'];
	
	//permissoes documentos
	$_SESSION['permissao-visualizar-documentos']			= $permissoes['VISUALIZAR_DOCUMENTO'];
	$_SESSION['permissao-visualizar-documentos-setor']		= $permissoes['VISUALIZAR_TODOS_SETOR_DOCUMENTO'];
	$_SESSION['permissao-visualizar-todos-documentos']		= $permissoes['VISUALIZAR_TODOS_ORGAO_DOCUMENTO'];
	$_SESSION['permissao-cadastrar-documento']				= $permissoes['CADASTRAR_DOCUMENTO'];
	$_SESSION['permissao-editar-documento']					= $permissoes['EDITAR_DOCUMENTO'];
	$_SESSION['permissao-excluir-documento']				= $permissoes['EXCLUIR_DOCUMENTO'];
	$_SESSION['permissao-sugestao-documento']				= $permissoes['SUGESTAO_DOCUMENTO'];
	$_SESSION['permissao-aprovar-documento']				= $permissoes['APROVAR_DOCUMENTO'];
	$_SESSION['permissao-resolver-documento']				= $permissoes['RESOLVER_DOCUMENTO'];
	
	//permissoes atividades
	$_SESSION['permissao-visualizar-atividade']				= $permissoes['VISUALIZAR_ATIVIDADE'];
	$_SESSION['permissao-visualizar-todas-atividades']		= $permissoes['VISUALIZAR_TODAS_ATIVIDADE'];
	$_SESSION['permissao-cadastrar-atividade']				= $permissoes['CADASTRAR_ATIVIDADE'];
	
	
	//permissoes comunicacao
	$_SESSION['permissao-visualizar-comunicacao']			= $permissoes['VISUALIZAR_COMUNICACAO'];
	$_SESSION['permissao-cadastrar-comunicacao']			= $permissoes['CADASTRAR_COMUNICACAO'];
	$_SESSION['permissao-editar-comunicacao']				= $permissoes['EDITAR_COMUNICACAO'];
	$_SESSION['permissao-excluir-comunicacao']				= $permissoes['EXCLUIR_COMUNICACAO'];
	
	//permissoes servidores
	$_SESSION['permissao-visualizar-servidores']			= $permissoes['VISUALIZAR_SERVIDORES'];
	$_SESSION['permissao-cadastrar-servidores']				= $permissoes['CADASTRAR_SERVIDORES'];
	$_SESSION['permissao-editar-servidores']				= $permissoes['EDITAR_SERVIDORES'];
	$_SESSION['permissao-excluir-servidores']				= $permissoes['EXCLUIR_SERVIDORES'];
	$_SESSION['permissao-visualizar-log-servidores']		= $permissoes['VISUALIZAR_LOG_SERVIDORES'];
	
	//permissoes financeiro
	$_SESSION['permissao-visualizar-financeiro']			= $permissoes['VISUALIZAR_FINANCEIRO'];
	$_SESSION['permissao-cadastrar-receita']				= $permissoes['CADASTRAR_RECEITA'];
	$_SESSION['permissao-excluir-receita']					= $permissoes['EXCLUIR_RECEITA'];
	$_SESSION['permissao-cadastrar-despesa']				= $permissoes['CADASTRAR_DESPESA'];
	$_SESSION['permissao-excluir-despesa']					= $permissoes['EXCLUIR_DESPESA'];
	$_SESSION['permissao-autorizar-empenho']				= $permissoes['AUTORIZAR_EMPENHO'];
	$_SESSION['permissao-empenhar-despesa']					= $permissoes['EMPENHAR_DESPESA'];
	$_SESSION['permissao-autorizar-pagamento']				= $permissoes['AUTORIZAR_PAGAMENTO'];
	$_SESSION['permissao-autorizar-compra']					= $permissoes['AUTORIZAR_COMPRA'];
	$_SESSION['permissao-efetuar-compra']					= $permissoes['EFETUAR_COMPRA'];
	$_SESSION['permissao-pagar-despesa']					= $permissoes['PAGAR_DESPESA'];
	
	//permissoes globais
	$_SESSION['permissao-fazer-operacoes-outros-setor']		= $permissoes['FAZER_OPERACOES_OUTROS_SETOR'];
	$_SESSION['permissao-fazer-operacoes-outros-orgao']		= $permissoes['FAZER_OPERACOES_OUTROS_ORGAO'];
	$_SESSION['permissao-visualizar-relatorio-setor']		= $permissoes['VISUALIZAR_SETOR_RELATORIO'];
	$_SESSION['permissao-visualizar-relatorio-orgao']		= $permissoes['VISUALIZAR_ORGAO_RELATORIO'];

	//redireciona o usuário para a página home
	header("Location:../home.php");

//se não encontrou nenhum registro...	
}else{
	//redireciona para a index para login novamente
	header("Location:../../index.php?err=true");
}

?>