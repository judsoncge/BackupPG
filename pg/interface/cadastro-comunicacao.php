<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_comunicacao',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de Item da Comunicação</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/comunicacao/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
                        <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Item de Comunicação</label>
									<select class="form-control" id="item" name="item" required/>
										<option value="">Selecione um item da lista</option>
										<option value="CGE News">CGE News</option>
										<option value="Comunicação Externa">Comunicação Externa</option>
										<option value="Rede Social">Rede Social</option>
										<option value="CGE em Movimento">CGE em Movimento</option>
										<option value="Mural de Comunicação Interna">Mural de Comunicação Interna</option>
										<option value="Se vira nos 5">Se vira nos 5</option>
									</select>	
								</div>  
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Título</label>
									<input class="form-control" id="titulo" name="titulo" placeholder="Máximo de 100 caracteres" type="text" maxlenght="100" required />	
								</div>  
							</div>
                        </div>
                        
                        
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Texto do Item</label>
									 <textarea class="texto" rows="7" id="texto" name="texto">Sem texto</textarea>
								</div>  
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="control-label" for="exampleInputEmail1">Selecionar imagens</label><br>
                                <input type="file" class="" name="imagem[]" id="imagem-comunicacao" multiple required/><br>
								<?php  ?>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="exampleInputEmail1">Data de publicação</label>
                                <input type="date" class="" name="data_publicacao" id="data_publicacao"/>
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

<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
<?php include('footer.php')?>