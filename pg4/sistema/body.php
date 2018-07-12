<body>  

<!-- menu superior da página -->
<div class="menu-superior">
	<div>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
		<a href="<?php echo $ROOT ?>sistema/home.php"><img src="<?php echo $ROOT ?>/interface/img/painel-gestao-cge.png" id="logo-home"></a>
	</div>
	<div>
		<!-- carregamento da página -->
		<div class="loader" id="preloader"></div>
	</div>
	<div class="container-icone">
		<div style="position: relative;">
			<!-- botão de notificações -->
			<a href="javascript:void(0);" onclick="exibir_notificacoes();"><div class="fa fa-bell fa-lg" aria-hidden="true" id="notificacao-icone">
				<?php include('notificacao/sino.php'); ?>
			</div></a>
		</div>
	    <ul class="container-notificacao" id="container-notificacao"></ul>
		<div>
			<!-- botão para fazer logoff -->
			<a href="<?php echo $ROOT ?>sistema/sessao/destruir-sessao.php" alt="Logoff"><i class="fa fa-sign-out fa-lg" aria-hidden="true" id="sair-icone"></i></a>
		</div>	
	</div>	
</div> 

<script type="text/javascript">
	/*fazer menu aparecer e desaparecer*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
	
<!-- menu lateral -->
<div id="wrapper">
	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		<ul class="sidebar-nav">
			<li class="sidebar-brand">
				<div id="usuario">
					<div id="box-imagem">
						<img src="<?php echo $ROOT ?>/registros/fotos/<?php echo $_SESSION['foto']?>" id="imagem">
					</div>
					<div id="mensagem">
						<p align="left">Bem vindo(a)<br><?php echo $_SESSION['nome']; ?></p>
						<a href="<?php echo $ROOT ?>sistema/servidores/editar-senha.php" id="alterar-senha"><i class="fa fa-edit" aria-hidden="true"></i>  Alterar senha</a>
						<a href="<?php echo $ROOT ?>sistema/servidores/editar-foto.php" id="alterar-foto"><i class="fa fa-edit" aria-hidden="true"></i>  Alterar foto</a>
					</div>
				</div>
			</li>
			<li>
				<a href="<?php echo $ROOT ?>sistema/home.php"><i class="fa fa-home icone-menu" aria-hidden="true"></i>Início</a>
			</li>
			
			<!-- menu atividades, com verificacao de permissao para visualizar -->
			<?php if($_SESSION['permissao-visualizar-atividade']=="sim"){ ?>
				<li id="atividades">
					<a href="#"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Atividades</a>
				</li>
				<li class="atividades-subitem">
					<a href="<?php echo $ROOT ?>sistema/atividades/minhas.php"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Minhas atividades</a>
				</li>
				<?php if($_SESSION['permissao-visualizar-todas-atividades']=="sim"){ ?>
				<li class="atividades-subitem">
					<a href="<?php echo $ROOT ?>sistema/atividades/todas.php"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Todas as atividades</a>
				</li>
				<?php } ?>
			<?php } ?>
			
			<!-- menu chamados, com verificacao de permissao para visualizar -->
			<?php if($_SESSION['permissao-visualizar-chamado']=="sim"){ ?>
				<li id="chamado">
					<a href="#"><i class="fa fa-exclamation-circle icone-menu" aria-hidden="true"></i>Chamados</a>
				</li>
				<li class="chamado-subitem">
					<a href="<?php echo $ROOT ?>sistema/chamados/listar.php"><i class="fa fa-exclamation-circle icone-menu" aria-hidden="true"></i>Meus chamados</a>
				</li>
				<?php if($_SESSION['permissao-visualizar-relatorio-chamado']=="sim"){ ?>
				<li class="chamado-subitem">
					<a href="<?php echo $ROOT ?>sistema/chamados/relatorio.php"><i class="fa fa-pie-chart icone-menu" aria-hidden="true"></i>Relatório</a>
				</li>
				<?php } ?>
			<?php } ?>
			
			<!-- opcao comunicacao, com verificacao de permissao para visualizar -->
			<?php if($_SESSION['permissao-visualizar-comunicacao']=="sim"){ ?>
			<li>
				<a href="<?php echo $ROOT ?>sistema/comunicacao/listar.php"><i class="fa fa-volume-up" aria-hidden="true"></i>&nbsp; &nbsp;&nbsp;Comunicação</a>
			</li>
			<?php } ?>
			
			<!-- menu documentos, com verificacao de permissao para visualizar -->
			<?php if($_SESSION['permissao-visualizar-documentos']=="sim"){ ?>
					
					<li id="documentos">
						<a href="<?php echo $ROOT ?>sistema/documentos/geral.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Documentos</a>
					</li>
					<!--<li class="documentos-subitem">
						<a href="<?php echo $ROOT ?>sistema/documentos/geral.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Geral</a>
					</li>
					<li class="documentos-subitem">
						<a href="<?php echo $ROOT ?>sistema/documentos/comigo.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Comigo</a>
					</li>
					<li class="documentos-subitem">
						<a href="<?php echo $ROOT ?>sistema/documentos/criados.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Criados por mim</a>
					</li>
				
				<?php if($_SESSION['permissao-visualizar-documentos-setor']=="sim"){ ?>
					<li class="documentos-subitem">
						<a href="<?php echo $ROOT ?>sistema/documentos/setor.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Setor</a>
					</li>
				<?php } ?>	
				
				
				<?php if($_SESSION['permissao-visualizar-todos-documentos']=="sim"){ ?>
					<li class="documentos-subitem">
						<a href="<?php echo $ROOT ?>sistema/documentos/todos.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Todos</a>
					</li>
				<?php } ?>-->
			
			<?php } ?>
			
			
			<!-- menu financeiro, com verificacao de permissao para visualizar -->
			<?php if($_SESSION['permissao-visualizar-financeiro']=="sim"){ ?>
				<li id="financeiro">
					<a href="#"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Financeiro</a>
				</li>
				<li class="financeiro-subitem">
					<a href="<?php echo $ROOT ?>sistema/financeiro/fluxo-caixa.php"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Fluxo de caixa</a>
				</li>
				<!--<li class="financeiro-subitem">
					<a href="bens-patrimoniais.php"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Bens patrimoniais</a>-->
				</li>
				<li class="financeiro-subitem">
					<a href="<?php echo $ROOT ?>sistema/despesas/listar.php"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Despesas</a>
				</li>
				<li class="financeiro-subitem">
					<a href="<?php echo $ROOT ?>sistema/despesas/todas.php"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Todas as Despesas</a>
				</li>					
				<li class="financeiro-subitem">
					<a href="<?php echo $ROOT ?>sistema/receitas/listar.php""><i class="fa fa-money icone-menu" aria-hidden="true"></i>Receitas</a>
				</li>
				<li class="financeiro-subitem">
					<a href="<?php echo $ROOT ?>sistema/receitas/todas.php"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Todas as Receitas</a>
				</li>										
			<?php } ?>
			
			<!-- opcao noticias, com verificacao de permissao para visualizar -->
			<li id="noticias">
				<a href="<?php echo $ROOT ?>sistema/comunicacao/noticias.php"><i class="fa fa-volume-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Notícias</a>
			</li>
		 
			<!-- menu processos, com verificacao de permissao para visualizar -->
		   <?php if($_SESSION['permissao-visualizar-processos']=="sim"){ ?>
			   <li id="processos">
					<a href="#"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Processos</a>
				</li>
				<?php if(array_key_exists('permissao-guia-processo', $_SESSION) && $_SESSION['permissao-guia-processo']=='sim'){ ?>
					 <li class="processos-subitem">
						<a href="<?php echo $ROOT ?>sistema/processos/guia.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Guia de Tramitação</a>
					</li>
				<?php }	?>			
				<li class="processos-subitem">
					<a href="<?php echo $ROOT ?>sistema/processos/geral.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Geral</a>
				</li>
				<!--<li class="processos-subitem">
					<a href="<?php echo $ROOT ?>sistema/processos/comigo.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Comigo</a>
				</li>

				<?php if($_SESSION['permissao-visualizar-processos-setor']=="sim"){ ?>
					<li class="processos-subitem">
						<a href="<?php echo $ROOT ?>sistema/processos/setor.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Setor</a>
					</li>
				<?php } ?>
				
				<?php if($_SESSION['permissao-visualizar-todos-processos']=="sim"){ ?>
					<li class="processos-subitem">
						<a href="<?php echo $ROOT ?>sistema/processos/todos.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Todos</a>
					</li>
				<?php } ?>
				
				<?php if($_SESSION['permissao-visualizar-processos-sairam']=="sim"){ ?>
					<li class="processos-subitem">
						<a href="<?php echo $ROOT ?>sistema/processos/sairam.php"><i class="fa fa-exchange icone-menu fa-1x" aria-hidden="true"></i>Saíram</a>
					</li>
				<?php } ?>
				
				<?php if($_SESSION['permissao-visualizar-processos-arquivados']=="sim"){ ?>
					<li class="processos-subitem">
						<a href="<?php echo $ROOT ?>sistema/processos/arquivados.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Arquivados</a>
					</li>
				<?php } ?>-->
				
				<?php if($_SESSION['permissao-visualizar-relatorio-setor']=="sim" or $_SESSION['permissao-visualizar-relatorio-orgao']=="sim"){ ?>
					 <li class="processos-subitem">
						<a href="<?php echo $ROOT ?>sistema/processos/relatorio-por-pessoa.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Relatórios</a>
					</li>
				<?php } ?>
					 			
				<?php if($_SESSION['cargo']=='Superintendente' || $_SESSION['cargo']=='Controlador Geral'){ ?>
					 <li class="processos-subitem">
						<a href="<?php echo $ROOT ?>sistema/processos/acompanhamento.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Acompanhamento</a>
					</li>
				<?php } ?>
			<?php } ?>
			
			<!-- menu servidores, com verificacao de permissao para visualizar -->
			<?php if($_SESSION['permissao-visualizar-servidores']=="sim"){ ?>
				<li id="servidor">
					<a href="#"><i class="fa fa-user icone-menu" aria-hidden="true"></i>Servidores</a>
				</li>
				<li class="servidor-subitem">
					<a href="<?php echo $ROOT ?>sistema/servidores/listar.php"><i class="fa fa-users icone-menu" aria-hidden="true"></i>Servidores</a>
				</li>
				<?php if($_SESSION['permissao-cadastrar-servidores']=="sim"){ ?>
					<li class="servidor-subitem">
						<a href="<?php echo $ROOT ?>sistema/servidores/cadastrar.php"><i class="fa fa-user-plus icone-menu" aria-hidden="true"></i>Novo servidor</a>
				<?php } ?>
				</li>
			<?php } ?>
				
			<!-- opcao sobre, com verificacao de permissao para visualizar -->		
			<li>
				<a href="<?php echo $ROOT ?>sistema/sobre.php"><i class="fa fa-info-circle icone-menu" aria-hidden="true"></i>Sobre</a>
			</li>
		</ul>
	</div>
