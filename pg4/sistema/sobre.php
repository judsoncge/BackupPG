<?php 
include('head.php');
include('body.php');
?>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Sobre o Painel de Gestão CGE</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-12">
					<p class="text-justify">O sistema Painel de Gestão CGE foi criado com o objetivo auxiliar no gerenciamento de processos, pessoas e tecnologias dentro do órgão Controladoria Geral do Estado, Governo de Alagoas.</p>
					<p class="text-justify">O mesmo foi idealizado e criado pelo setor de Assessoria de Governança e Transparência da Controladoria Geral do Estado de Alagoas, sob o apoio da atual gestora Controladora Geral Dra. Maria Clara Cavalcante Bugarim.</p>
					<hr>
				</div>
			</div>
					<center><p style="font-size: 20pt;">Equipe</p>	
							<div class="row">

								<div class='col-md-3'>
									<div class='box-equipe'>
										<img src='../registros/fotos/<?php echo retorna_foto_servidor('277.246.974-34', $conexao_com_banco) ?>' class='equipe-img'>
									</div>
                                    <div class='equipe_servidor'><b>Maria Clara Bugarim</b><br>Apoio</div>
								</div>
                                	
                                <div class='col-md-3'>
									<div class='box-equipe'>
										<img src='../registros/fotos/<?php echo retorna_foto_servidor('057.996.054-46', $conexao_com_banco) ?>' class='equipe-img'>
									</div>
									<div class='equipe_servidor'><b>Thiago Paiva</b><br>Coordenador</div>
								</div>
								<div class='col-md-3'>
									<div class='box-equipe'>
										<img src='../registros/fotos/<?php echo retorna_foto_servidor('062.200.904-46', $conexao_com_banco) ?>' class='equipe-img'>
									</div>
                                    <div class='equipe_servidor'><b>Judson Bandeira</b><br>Desenvolvedor</div>
								</div>
								<div class='col-md-3'>
									<div class='box-equipe'>
										<img src='../registros/fotos/<?php echo retorna_foto_servidor('077.036.184-62', $conexao_com_banco) ?>' class='equipe-img'>
									</div>
									<div class='equipe_servidor'><b>Romero Malaquias</b><br>Desenvolvedor</div>
								</div>
    							<div class='col-md-3'>
									<div class='equipe_servidor'><b>Anterior : Denys Rocha</b><br>Desenvolvedor</div>
								</div>
									
							</div>
					</center>				
		</div>
	</div>
</div>

	<!-- /#wrapper -->

	<!-- chamando o bootstrap novamente para o modal funcionar -->
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<script type="text/javascript">
		/*menu lateral*/
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	</script>
