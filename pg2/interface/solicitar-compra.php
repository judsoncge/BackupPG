<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Solicitar uma compra</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/compra/logica/cadastrar.php?sessionId=<?php echo $num ?>" enctype="multipart/form-data"> <!-- login.php -->  						
							<div class="row">
								<div class="col-md-12">
								<label class="control-label" for="exampleInputEmail1">Descrição</label>
									<input class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição da compra (max 100 carac.)" type="text" maxlength="100" required/>
								</div>
							</div>
							<div class="row" id="cad-button">
							<div class="col-md-12">
								<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Solicitar</button>
							</div>
						</div>	
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>

<?php include('foot.php')?>