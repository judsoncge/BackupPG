<?php 
include('../head.php');
include('../body.php');
if($_SESSION['funcao'] != 'PROTOCOLO' and $_SESSION['funcao'] != 'TI'){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home.php?mensagem=Você não tem permissão para acessar essa página.&resultado=falha'>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de processo</p>
	</div>
	
	<?php if(isset($_GET['mensagem'])){ ?>
	
		<center>
			<div class="alert alert-warning"><?php echo $_GET['mensagem'] ?>  Deseja ir para a página do processo?<a href="detalhes.php?id=<?php echo $_GET['id'] ?>"> Sim</a></div>
		</center>
		
	<?php } ?>
	
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/cadastrar.php" enctype="multipart/form-data"> 
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Número do processo</label>
										<div class="row">
											<div class="col-md-4">
												<input class="form-control" id="numero_processo1" name="numero_processo1" placeholder="Órgão" type="text" maxlength="6" required />
											</div>
											<div class="col-md-4">
												<input class="form-control" id="numero_processo2" name="numero_processo2" placeholder="Número" type="text" maxlength="6" required />
											</div>
											<div class="col-md-4">
												<input class="form-control" id="numero_processo3" name="numero_processo3" placeholder="Ano" type="text" maxlength="4" required />
											</div>
										</div>
									</div>  
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Assunto</label>
										<select class="form-control" id="assunto" name="assunto" required />
											<option value="">Selecione o assunto</option>
											<?php include('../includes/assuntos.php'); ?>
										</select>
									</div>  
								</div>
							</div>
							<div class="row">						
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Órgão Interessado</label>
										<select class="form-control" id="orgao" name="orgao" required />
											<option value="">Selecione o Órgão Interessado</option>
											<?php include('../includes/orgaos.php'); ?>
										</select>
									</div>  
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Nome do Interessado</label>
										<input class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="255" required />
									</div>  
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Detalhes</label>
										<input class="form-control" id="detalhes" name="detalhes" placeholder="Digite os detalhes do processo" type="text" maxlength="255" required />
									</div>  
								</div>
							</div>
							<div class="row" id="cad-button">
								<div class="col-md-12">
									<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Cadastrar</button>
								</div>
							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>

<?php include('../foot.php')?>