<body>
	<!-- <div id="bg-loader"></div> -->
    
    <!-- menu superior da página -->
<div class="menu-superior">
	<div>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
		<a href="home.php?sessionId=<?php echo $num ?>"><img src="img/painel-gestao-cge.png" id="logo-home"></a>
			
	</div>
	<div>
		<!-- carregamento da página -->
			<div class="loader" id="preloader"></div>
	</div>
	<div class="container-icone">
		<div style="position: relative;">
			<!-- botão de notificações -->
			<a href="javascript:void(0);" onclick="exibir_notificacoes();"><div class="fa fa-bell fa-lg" aria-hidden="true" id="notificacao-icone">
				<?php 	include('../interface/includes/notificacao.php'); 	?>
			</div></a>
		</div>
		 <ul class="container-notificacao" id="container-notificacao"></ul>
		<div>
			<!-- botão para fazer logoff -->
			<a href="../componentes/sessao/destruir-sessao.php" alt="Logoff"><i class="fa fa-sign-out fa-lg" aria-hidden="true" id="sair-icone"></i><!-- <img src="img/sair.png" id="sair-icone"> --></a>
		</div>	

	</div>	
</div>
<div class="caixa-alerta" id="caixa-alerta"> <div id="sound" style="display:none;"></div>
</div>

	<!-- menu lateral -->
	<div id="wrapper">
		<!-- Sidebar -->
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="sidebar-brand">
					<div id="usuario">
						<div id="box-imagem">
							<img src="../registros/fotos/<?php echo $foto?>" id="imagem">
						</div>
						<div id="mensagem">
							<p align="left">Bem vindo(a)<br><?php echo $nome; ?></p>
                            <a href="edita-senha.php?sessionId=<?php echo $num ?>" id="alterar-senha"><i class="fa fa-edit" aria-hidden="true"></i>  Alterar senha</a>
                            <a href="edita-foto.php?sessionId=<?php echo $num ?>" id="alterar-foto"><i class="fa fa-edit" aria-hidden="true"></i>  Alterar foto</a>
						</div>
					</div>
				</li>
				<li>
					<a href="home.php?sessionId=<?php echo $num ?>"><i class="fa fa-home icone-menu" aria-hidden="true"></i>Início</a>
				</li>
				
				<?php //$permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_ATIVIDADE',$conexao_com_banco); if($permissao=='sim'){ ?>
					<li id="administrativo">
						<a href="#"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Administrativo</a>
					</li>
					<li class="administrativo-subitem">
						<a href="compras.php?sessionId=<?php echo $num ?>"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Compras</a>
					</li>
					<?php //$permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODAS_ATIVIDADE',$conexao_com_banco); if($permissao=='sim'){ ?>
					<li class="administrativo-subitem">
						<a href="compras-todos.php?sessionId=<?php echo $num ?>"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Todas as compras</a>
					</li>
					<?php //} ?>
				<?php //} ?>
				
				<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_ATIVIDADE',$conexao_com_banco); if($permissao=='sim'){ ?>
					<li id="atividades">
						<a href="#"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Atividades</a>
					</li>
					<li class="atividades-subitem">
						<a href="lista-atividades.php?sessionId=<?php echo $num ?>"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Minhas atividades</a>
					</li>
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODAS_ATIVIDADE',$conexao_com_banco); if($permissao=='sim'){ ?>
					<li class="atividades-subitem">
						<a href="atividades.php?sessionId=<?php echo $num ?>"><i class="fa fa-tasks icone-menu" aria-hidden="true"></i>Todas as atividades</a>
					</li>
					<?php } ?>
				<?php } ?>
				
				
				<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_CHAMADO',$conexao_com_banco); if($permissao=='sim'){ ?>
				<li id="chamado">
					<a href="#"><i class="fa fa-exclamation-circle icone-menu" aria-hidden="true"></i>Chamados</a>
				</li>
				<li class="chamado-subitem">
					<a href="chamados.php?sessionId=<?php echo $num ?>"><i class="fa fa-exclamation-circle icone-menu" aria-hidden="true"></i>Meus chamados</a>
				</li>
				<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_RELATORIO_CHAMADO',$conexao_com_banco); if($permissao=='sim'){ ?>
				<li class="chamado-subitem">
					<a href="chamado-relatorio.php?sessionId=<?php echo $num ?>"><i class="fa fa-pie-chart icone-menu" aria-hidden="true"></i>Relatório</a>
				</li>
				<?php } ?>
			<?php } ?>
                
				<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_COMUNICACAO',$conexao_com_banco); if($permissao=='sim'){ ?>
				<li>
					<a href="comunicacao.php?sessionId=<?php echo $num ?>"><i class="fa fa-volume-up" aria-hidden="true"></i>&nbsp; &nbsp;&nbsp;Comunicação</a>
				</li>
				<?php } ?>
				
				<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_DOCUMENTO',$conexao_com_banco); if($permissao=='sim'){ ?>
						
						<li id="sucor">
							<a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Documentos</a>
						</li>
						<li class="sucor-subitem">
							<a href="documentos.php?sessionId=<?php echo $num ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Comigo</a>
						</li>
						<li class="sucor-subitem">
							<a href="documentos-criados.php?sessionId=<?php echo $num ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Criados por mim</a>
						</li>
					
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_SETOR_DOCUMENTO',$conexao_com_banco); if($permissao=='sim'){ ?>
						<li class="sucor-subitem">
							<a href="documentos-setor.php?sessionId=<?php echo $num ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Setor</a>
						</li>
					<?php } ?>	
					
					
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_ORGAO_DOCUMENTO',$conexao_com_banco); if($permissao=='sim'){ ?>
						<li class="sucor-subitem">
							<a href="documentos-todos.php?sessionId=<?php echo $num ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Todos</a>
						</li>
					<?php } ?>
				
				<?php } ?>
				
				<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_FINANCEIRO',$conexao_com_banco); if($permissao=='sim'){ ?>
					<li id="financeiro">
						<a href="#"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Financeiro</a>
					</li>
					<li class="financeiro-subitem">
						<a href="fluxo-caixa.php?sessionId=<?php echo $num ?>"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Fluxo de caixa</a>
					</li>
					<li class="financeiro-subitem">
						<a href="bens-patrimoniais.php?sessionId=<?php echo $num ?>"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Bens patrimoniais</a>
					</li>
					<li class="financeiro-subitem">
						<a href="despesas.php?sessionId=<?php echo $num ?>"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Despesas</a>
					</li>
					<li class="financeiro-subitem">
						<a href="despesas-todos.php?sessionId=<?php echo $num ?>"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Todas as Despesas</a>
					</li>					
					<li class="financeiro-subitem">
						<a href="receitas.php?sessionId=<?php echo $num ?>"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Receitas</a>
					</li>						
				<?php } ?>
				
				
				<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_INDICE_PRODUTIVIDADE',$conexao_com_banco); if($permissao=='sim'){ ?>
					<li id="indice-produtividade">
						<a href="#"><i class="fa fa-black-tie" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Índice de Produtividade</a>
					</li>
					<li class="indice-produtividade-subitem">
						<a href="assiduidades.php?sessionId=<?php echo $num ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Assiduidade</a>
					</li>
					<li class="indice-produtividade-subitem">
						<a href="cumprimentos-de-prazo.php?sessionId=<?php echo $num ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Cumpr. de prazo</a>
					</li>
					<li class="indice-produtividade-subitem">
						<a href="produtividades.php?sessionId=<?php echo $num ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Produtividade</a>
					</li>
					<li class="indice-produtividade-subitem">
						<a href="indice-produtividade-selecionar.php?sessionId=<?php echo $num ?>"><i class="fa fa-pie-chart icone-menu" aria-hidden="true"></i>Relatório</a>
					</li>
               <?php } ?>
			   
				<li id="indice-produtividade">
					<a href="noticias.php?sessionId=<?php echo $num ?>"><i class="fa fa-volume-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Notícias</a>
				</li>
             
			   <?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_PROCESSO',$conexao_com_banco); if($permissao=='sim'){ ?>
				   <li id="processos">
						<a href="#"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Processos</a>
					</li>	
					<li class="processos-subitem">
						<a href="processos.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Comigo</a>
					</li>
					
					
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_SETOR_PROCESSO',$conexao_com_banco); if($permissao=='sim'){ ?>
						<li class="processos-subitem">
							<a href="processos-setor.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Setor</a>
						</li>
					<?php } ?>
					
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_ORGAO_PROCESSO',$conexao_com_banco); if($permissao=='sim'){ ?>
						<li class="processos-subitem">
							<a href="processos-todos.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Todos</a>
						</li>
					<?php } ?>
					
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_SAIRAM_PROCESSO',$conexao_com_banco); if($permissao=='sim'){ ?>
						<li class="processos-subitem">
							<a href="processos-sairam.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu fa-1x" aria-hidden="true"></i>Saíram</a>
						</li>
					<?php } ?>
					
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_ARQUIVADOS_PROCESSO',$conexao_com_banco); if($permissao=='sim'){ ?>
						<li class="processos-subitem">
							<a href="processos-arquivados.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Arquivados</a>
						</li>
					<?php } ?>
					
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_ORGAO_RELATORIO',$conexao_com_banco); if($permissao=='sim'){ ?>
						<li class="processos-subitem">
							<a href="processos-relatorio1.php?sessionId=<?php echo $num ?>"><i class="fa fa-pie-chart icone-menu" aria-hidden="true"></i>Relatórios</a>
						</li>
					<?php } ?>
					
					<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_ORGAO_RELATORIO',$conexao_com_banco); if($permissao=='sim'){ ?>
						<li class="processos-subitem">
							<a href="processos-relatorio-geral-selecionar.php?sessionId=<?php echo $num ?>"><i class="fa fa-pie-chart icone-menu" aria-hidden="true"></i>Relatório exec.</a>
						</li>
					<?php } ?>
					
				<?php } ?>
				
				
				
				<li id="servidor">
					<a href="#"><i class="fa fa-user icone-menu" aria-hidden="true"></i>Servidores</a>
				</li>
				<li class="servidor-subitem">
					<a href="servidores.php?sessionId=<?php echo $num ?>"><i class="fa fa-users icone-menu" aria-hidden="true"></i>Servidores</a>
				</li>
				<li class="servidor-subitem">
					<a href="cadastro-pessoa.php?sessionId=<?php echo $num ?>"><i class="fa fa-user-plus icone-menu" aria-hidden="true"></i>Novo servidor</a>
				</li>
				
				<!--<?php $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_ODP',$conexao_com_banco); if($permissao=='sim'){ ?>
				<li id="odp">
					<a href="#"><i class="fa fa-search icone-menu" aria-hidden="true"></i>ODP</a>
				</li>
				<li class="odp-subitem">
					<a href="odp-servidores-empresas.php?sessionId=<?php echo $num ?>"><i class="fa fa-users icone-menu" aria-hidden="true"></i>Serv. que fornecem</a>
				</li>
				<li class="odp-subitem">
					<a href="odp-fracionamento-despesas.php?sessionId=<?php echo $num ?>"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Frac. de despesas</a>
				</li>
				<li class="odp-subitem">
					<a href="odp-empresas-forneceram-ceis.php?sessionId=<?php echo $num ?>"><i class="fa fa-building icone-menu" aria-hidden="true"></i>Empr. forn. CEIS/AL</a>
				</li>
				<li class="odp-subitem">
					<a href="odp-empresas-forneceram-ceisBR.php?sessionId=<?php echo $num ?>"><i class="fa fa-building icone-menu" aria-hidden="true"></i>Empr. forn. CEIS/BR</a>
				</li>
				<li class="odp-subitem">
					<a href="odp-empresas-mesmo-endereco.php?sessionId=<?php echo $num ?>"><i class="fa fa-building icone-menu" aria-hidden="true"></i>Empr. mesmo end.</a>
				</li>
				<?php } ?>-->
				
				<li>
					<a href="sobre.php?sessionId=<?php echo $num ?>"><i class="fa fa-info-circle icone-menu" aria-hidden="true"></i>Sobre o sistema</a>
				</li>
			</ul>
		</div>
