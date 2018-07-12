<?php  
include('../head.php'); 
include('../body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de Notícia</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
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
									<input class="form-control" id="titulo" name="titulo" placeholder="Máximo de 100 caracteres" 
									type="text" maxlenght="100" required />	
								</div>  
							</div>
                        </div>
                        
                        
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Texto do Item</label>
									 <textarea rows="10" cols="140" name="texto">Sem texto</textarea>
								</div>  
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="control-label" for="exampleInputEmail1">Selecionar imagens</label><br>
                                <input type="file" class="" name="imagem[]" accept=".jpg, .jpeg, .pjpeg, .gif, .png" id="imagem-comunicacao" multiple required/><br>
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


<?php include('../foot.php')?>