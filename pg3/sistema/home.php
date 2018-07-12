<?php 
include('head.php');
include('body.php');
$data = date("Y-m-d");
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<center>
	<p><h2>Bem vindo(a) ao Painel de Gestão, <?php echo $_SESSION["nome"] ?>!</h2></p>
	<p>Hoje, até agora, <b>entraram</b> <?php echo retorna_processos_entraram_hoje($conexao_com_banco); ?> processos.</p>
	<p>Hoje, até agora, <b>saíram</b> <?php echo retorna_processos_sairam_hoje($conexao_com_banco); ?> processos.</p>
	<p>Hoje, <?php echo retorna_processos_prazo_final_hoje($conexao_com_banco); ?> processos <b>vencem o prazo</b>.
	<?php if($_SESSION["permissao-visualizar-todos-processos"]=="sim"){ ?>
		<a href="processos/todos.php?filtro=<?php echo arruma_data($data) ?>">Ver</a>
	<?php } ?>
	</p>
</center>
