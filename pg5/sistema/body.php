<body>  

<!-- menu superior da página -->
<div class="menu-superior">
	<div>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
		<!-- <a href="<?php echo $ROOT ?>sistema/home.php"><img src="" id="logo-home"></a> -->
	</div>
	<div>
		<!-- carregamento da página -->
		<div class="loader" id="preloader"></div>
	</div>
	<div class="container-icone">
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
						<center><a href="<?php echo $ROOT ?>sistema/servidores/editar-senha.php" id="alterar-senha"><i class="fa fa-edit" aria-hidden="true"></i>  Alterar senha</a>
						<a href="<?php echo $ROOT ?>sistema/servidores/editar-foto.php" id="alterar-foto"><i class="fa fa-edit" aria-hidden="true"></i>  Alterar foto</a></center>
					</div>
				</div>
			</li>
			<hr>
			<li>
				<a href="<?php echo $ROOT ?>sistema/home.php"><i class="fa fa-home icone-menu" aria-hidden="true"></i>Início</a>
			</li>
			
			
			
			
			
			<li id="arquivos">
				<a href="#"><i class="fa fa-file-archive-o icone-menu" aria-hidden="true"></i>Arquivos</a>
			</li>	
				
			<li class="arquivos-subitem">
				<a href="<?php echo $ROOT ?>sistema/arquivos/listar-ativos.php"><i class="fa fa-file-archive-o icone-menu" aria-hidden="true"></i>Ativos</a>
			</li>
			
			<li class="arquivos-subitem">
				<a href="<?php echo $ROOT ?>sistema/arquivos/listar-inativos.php"><i class="fa fa-file-archive-o icone-menu" aria-hidden="true"></i>Inativos</a>
			</li>
			
			
			
			
			
			
			
			<li id="chamados">
				<a href="#"><i class="fa fa-headphones icone-menu" aria-hidden="true"></i>Chamados</a>
			</li>
			
			<li class="chamados-subitem">
				<a href="<?php echo $ROOT ?>sistema/chamados/listar-ativos.php"><i class="fa fa-headphones icone-menu" aria-hidden="true"></i>Ativos</a>
			</li>
			<?php //somente o TI pode visualizar os chamados já encerrados
			if($_SESSION['funcao'] == 'TI'){ ?>
				<li class="chamados-subitem">
					<a href="<?php echo $ROOT ?>sistema/chamados/listar-inativos.php" ><i class="fa fa-headphones icone-menu" aria-hidden="true"></i>Inativos</a>
				</li>
			<?php } 
			
			
			if($_SESSION['funcao'] == 'COMUNICAÇÃO' or $_SESSION['funcao'] == 'TI'){ ?>
				<li id="comunicacao">
					<a href="#"><i class="fa fa-volume-up icone-menu" aria-hidden="true"></i>Comunicação</a>
				</li>
				
				<li class="comunicacao-subitem">
					<a href="<?php echo $ROOT ?>sistema/comunicacao/listar-ativos.php"><i class="fa fa-volume-up icone-menu" aria-hidden="true"></i>Ativos</a>
				</li>
				<li class="comunicacao-subitem">
					<a href="<?php echo $ROOT ?>sistema/comunicacao/listar-inativos.php" ><i class="fa fa-volume-up icone-menu" aria-hidden="true"></i>Inativos</a>
				</li>
			<?php } ?>
			
			

			
			<li id="processos">
				<a href="#"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Processos</a>
			</li>
			
			<?php if($_SESSION['funcao']=='PROTOCOLO' or $_SESSION['funcao']=='TI'){ ?>
				<li class="processos-subitem">
					<a href="<?php echo $ROOT ?>sistema/processos/cadastrar.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Cadastrar</a>
				</li>
			<?php } ?>
			
			<li class="processos-subitem">
				<a href="<?php echo $ROOT ?>sistema/processos/listar-ativos.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Ativos</a>
			</li>
			
			<li class="processos-subitem">
				<a href="<?php echo $ROOT ?>sistema/processos/listar-recebidos.php"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Recebidos</a>
			</li>
			
			
			<li class="processos-subitem">
				<a href="<?php echo $ROOT ?>sistema/processos/consultar.php" ><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Consultar</a>
			</li>
			
			<?php if($_SESSION['funcao']=='CONTROLADOR' or $_SESSION['funcao']=='CHEFE DE GABINETE' or $_SESSION['funcao']=='TI'){ ?>
				
				<li class="processos-subitem">
					<?php $quantidade = retorna_quantidade_solicitacoes_sobrestado($conexao_com_banco); ?>
					<a href="<?php echo $ROOT ?>sistema/processos/solicitacoes-sobrestado.php" ><i class="fa fa-exchange icone-menu" aria-hidden="true"></i><?php if($quantidade >0){ echo "($quantidade) ";} ?>Sol. Sobrestado</a>
				</li>
			
				<li class="processos-subitem">
					<a href="<?php echo $ROOT ?>sistema/processos/relatorio.php" ><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Relatório</a>
				</li>
			<?php } ?>
		

				
			<?php if($_SESSION['funcao'] == 'TI'){ ?>

				<li id="servidores">
					<a href="#"><i class="fa fa-user icone-menu" aria-hidden="true"></i>Servidores</a>
				</li>	
				<li class="servidores-subitem">
					<a href="<?php echo $ROOT ?>sistema/servidores/listar-ativos.php"><i class="fa fa-user icone-menu" aria-hidden="true"></i>Ativos</a>
				</li>
				
				<li class="servidores-subitem">
					<a href="<?php echo $ROOT ?>sistema/servidores/listar-inativos.php"><i class="fa fa-user icone-menu" aria-hidden="true"></i>Inativos</a>
				</li>
				
			<?php } ?>
				
	
			<li>
				<a href="<?php echo $ROOT ?>sistema/sobre.php"><i class="fa fa-info-circle icone-menu" aria-hidden="true"></i>Sobre</a>
			</li>
		</ul>
	</div>
