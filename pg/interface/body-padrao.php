<?php 
//Retorna o nome e a foto do usuário logado
$lista = retorna_pessoa_cpf($_SESSION['CPF'],$conexao_com_banco); 
while($result = mysqli_fetch_array($lista)){ 	
	$nome = $result['nome']; 	
	$foto = $result['foto']; 	
}   
?>


<body>
	
	
	<!-- <div id="bg-loader"></div> -->
    
    <!-- menu superior da página -->
	<div class="menu-superior">
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
		<a href="todas.php?sessionId=<?php echo $num ?>"><img src="img/painel-gestao-cge.png" id="logo-home"></a>

		<!-- carregamento da página -->
		<div class="loader" id="preloader"></div>

		<!-- botão de notificações -->
		<a href=""><i class="fa fa-bell fa-lg" aria-hidden="true" id="notificacao-icone"></i></a>
		
		<!-- botão para fazer logoff -->
		<a href="../componentes/sessao/destruir-sessao.php" alt="Logoff"><i class="fa fa-sign-out fa-lg" aria-hidden="true" id="sair-icone"></i><!-- <img src="img/sair.png" id="sair-icone"> --></a> 
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
                            <a href="edita-senha.php?sessionId=<?php echo $num ?>" id="alterar-senha"><i class="fa fa-edit" aria-hidden="true"></i>  Alterar senha</a><br>
                            <a href="edita-foto.php?sessionId=<?php echo $num ?>" id="alterar-foto"><i class="fa fa-edit" aria-hidden="true"></i>  Alterar foto</a>
						</div>
						<img src="img/novembro_azul2.png" id="novembro_azul">		
					</div>
				</li>
				<li>
					<a href="todas.php?sessionId=<?php echo $num ?>"><i class="fa fa-home icone-menu" aria-hidden="true"></i>Início</a>
				</li>
                
				<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_comunicacao',$conexao_com_banco); if($permissao=='Sim'){?>
						
						<li>
							<a href="comunicacao.php?sessionId=<?php echo $num ?>"><i class="fa fa-volume-up" aria-hidden="true"></i>&nbsp; &nbsp;&nbsp;Comunicação</a>
						</li>
               
			   <?php } ?>
				
				 <?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_processo',$conexao_com_banco); if($permissao=='Sim'){?>
						
						<li id="processos">
							<a href="#"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Processos</a>
						</li>	
						<li class="processos-subitem">
							<a href="processos.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Comigo</a>
						</li>
						<li class="processos-subitem">
							<a href="processos-relatorio1.php?sessionId=<?php echo $num ?>"><i class="fa fa-pie-chart icone-menu" aria-hidden="true"></i>Relatórios</a>
						
						</li>
				<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_processo_todos',$conexao_com_banco); if($permissao=='Sim'){?>
						
						<li class="processos-subitem">
							<a href="processos-sairam.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu fa-1x" aria-hidden="true"></i>Saíram</a>
						</li>
						<li class="processos-subitem">
							<a href="processos-arquivados.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Arquivados</a>
						
						</li>
				 
				 <?php } ?>
               
			   <li class="processos-subitem">
					<a href="processos-todos.php?sessionId=<?php echo $num ?>"><i class="fa fa-exchange icone-menu" aria-hidden="true"></i>Todos</a>
				</li>
				
				
				<?php } ?>
				<li id="chamado">
					<a href="#"><i class="fa fa-exclamation-circle icone-menu" aria-hidden="true"></i>Chamados</a>
				</li>
				<li class="chamado-subitem">
					<a href="chamados.php?sessionId=<?php echo $num ?>"><i class="fa fa-exclamation-circle icone-menu" aria-hidden="true"></i>Meus chamados</a>
				</li>
				<li class="chamado-subitem">
					<a href="chamado-relatorio.php?sessionId=<?php echo $num ?>"><i class="fa fa-pie-chart icone-menu" aria-hidden="true"></i>Relatório</a>
				</li>
				  <?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_documento',$conexao_com_banco); if($permissao=='Sim'){?>
				<li id="sucor">
					<a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Documentos</a>
				</li>
                <li class="sucor-subitem">
					<a href="documentos.php?sessionId=<?php echo $num ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Comigo</a>
				</li>
				<li class="sucor-subitem">
					<a href="documentos_enviados.php?sessionId=<?php echo $num ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Enviados</a>
				</li>
				
				<li class="sucor-subitem">
					<a href="documentos_todos.php?sessionId=<?php echo $num ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Todos</a>
				</li>
				
				<?php } ?>
				
				<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_servidores',$conexao_com_banco); if($permissao=='Sim'){?>
						
						<li id="servidor">
							<a href="#"><i class="fa fa-user icone-menu" aria-hidden="true"></i><!--Recursos Humanos-->Servidores</a>
						</li>
						<li class="servidor-subitem">
							<a href="servidores.php?sessionId=<?php echo $num ?>"><i class="fa fa-users icone-menu" aria-hidden="true"></i>Servidores</a>
						</li>
						
						<li class="servidor-subitem">
							<a href="cadastro-pessoa.php?sessionId=<?php echo $num ?>"><i class="fa fa-user-plus icone-menu" aria-hidden="true"></i>Novo servidor</a>
						</li>
				
				<?php } ?>
				
				<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_financeiro',$conexao_com_banco); if($permissao=='Sim'){?>
						
						<li id="financeiro">
							<a href="#"><i class="fa fa-money icone-menu" aria-hidden="true"></i>Financeiro</a>
						</li>	
						<li class="financeiro-subitem">
							<a href="empenhosepagamentos.php?sessionId=<?php echo $num ?>"><i class="fa fa-dollar icone-menu" aria-hidden="true"></i><b>Empenhos</b></a>
						</li><li class="financeiro-subitem">
							<a href="rma.php?sessionId=<?php echo $num ?>"><i class="fa fa-cart-plus icone-menu" aria-hidden="true"></i>Almoxarifado</a>
						</li>
						<li class="financeiro-subitem">
							<a href="bens-patrimoniais.php?sessionId=<?php echo $num ?>"><i class="fa fa-university icone-menu" aria-hidden="true"></i>Bens patrimoniais</a>
						</li>
						<li class="financeiro-subitem">
							<a href="combustiveis.php?sessionId=<?php echo $num ?>"><i class="fa fa-tint icone-menu" aria-hidden="true"></i>Combustíveis</a>
						</li>
						<li class="financeiro-subitem">
							<a href="contratos.php?sessionId=<?php echo $num ?>"><i class="fa fa-file-text icone-menu" aria-hidden="true"></i>Contratos</a>
						</li>
						<li class="financeiro-subitem">
							<a href="diarias.php?sessionId=<?php echo $num ?>"><i class="fa fa-bed icone-menu" aria-hidden="true"></i>Diárias</a>
						</li>
						<li class="financeiro-subitem">
							<a href="passagens.php?sessionId=<?php echo $num ?>"><i class="fa fa-plane icone-menu" aria-hidden="true"></i>Passagens</a>
						</li>
						<li class="financeiro-subitem">
							<a href="servicos.php?sessionId=<?php echo $num ?>"><i class="fa fa-folder-open icone-menu" aria-hidden="true"></i>Serviços</a>
						</li>
						<li class="financeiro-subitem">
							<a href="telefones.php?sessionId=<?php echo $num ?>"><i class="fa fa-phone icone-menu" aria-hidden="true"></i>Telefones</a>
						</li>
						<li class="financeiro-subitem">
							<a href="veiculos.php?sessionId=<?php echo $num ?>"><i class="fa fa-car icone-menu" aria-hidden="true"></i>Veículos</a>
						</li>
						
				<?php } ?>
				
				<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_indice_produtividade',$conexao_com_banco); 
				$permissao2 = retorna_permissao_pessoa($_SESSION['CPF'],'avaliar_todos',$conexao_com_banco);if($permissao=='Sim' and $permissao2=='Sim'){?>
						
						<li id="indice-produtividade">
							<a href="#"><i class="fa fa-black-tie" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Índice de Produtividade</a>
						</li>
						<li class="indice-produtividade-subitem">
							<a href="avaliar-assiduidade.php?sessionId=<?php echo $num ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Avaliar assiduidade</a>
						</li>
						<li class="indice-produtividade-subitem">
							<a href="indice-produtividade-avaliacoes.php?sessionId=<?php echo $num ?>"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Avaliações</a>
						</li>
						<li class="indice-produtividade-subitem">
							<a href="indice-produtividade.php?sessionId=<?php echo $num ?>"><i class="fa fa-pie-chart icone-menu" aria-hidden="true"></i>Relatório</a>
						
						</li>
				<?php } ?>
				
				<li>
					<a href="relatoriousosistema.php?sessionId=<?php echo $num ?>"><i class="fa fa-wpforms" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Relatório de uso</a>
				</li>
				<li>
					<a href="sobre.php?sessionId=<?php echo $num ?>"><i class="fa fa-info-circle icone-menu" aria-hidden="true"></i>Sobre o sistema</a>
				</li>
			</ul>
		</div>
		<!-- /#sidebar-wrapper -->
		<!-- menu lateral /-->
        
        <!-- Modal
        <div id="modal-alterar-senha" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
              </div>
              <div class="modal-body">
                <p>Some text in the modal.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        -->
        



        

		 