<?php  
include('../head.php'); 
include('../body.php');
if($_SESSION['funcao'] != 'COMUNICAÇÃO' and $_SESSION['funcao'] != 'TI'){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home.php?mensagem=Você não tem permissão para acessar essa página.&resultado=falha'>";
}
$id = $_GET['id']; 
$tabela = "tb_comunicacao";
include('../includes/verificacao-id.php');
$informacoes = retorna_informacoes($tabela, $id, $conexao_com_banco);
?>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<script src="adicionar-imagens.js"></script>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de Comunicação</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" id="cadastro" method="POST" action="logica/editar.php?operacao=info&id=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Chapéu</label>
									<input class="form-control" id="chapeu" name="chapeu" placeholder="Máximo de 30 caracteres" 
									type="text" maxlength="30" value="<?php echo $informacoes['NM_CHAPEU'] ?>" required />	
								</div> 
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Título</label>
									<input class="form-control" id="titulo" name="titulo" placeholder="Máximo de 100 caracteres" 
									type="text" maxlength="100" value="<?php echo $informacoes['NM_TITULO'] ?>" required />	
								</div>  
							</div>
                        </div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Intertítulo</label>
									<input class="form-control" id="intertitulo" name="intertitulo" placeholder="Máximo de 100 caracteres" 
									type="text" maxlength="100" value="<?php echo $informacoes['NM_INTERTITULO'] ?>" required />	
								</div>  
							</div>
                        </div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Créditos</label>
									<input class="form-control" id="creditos" name="creditos" placeholder="Máximo de 30 caracteres" 
									type="text" maxlength="30" value="<?php echo $informacoes['NM_CREDITOS'] ?>" required />	
								</div>  
							</div>
                        </div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Texto</label>
									<textarea class="form-control" id="texto" name="texto" rows="15" required /><?php echo $informacoes['TX_NOTICIA'] ?></textarea>	
								</div>  
							</div>
                        </div>
						<div class="row">
							<div class="col-md-12">
								<label class="control-label" for="exampleInputEmail1">Data de publicação</label>
                                <input type="datetime-local" name="data_publicacao" id="data_publicacao" value="<?php echo retorna_data_datetime_local("tb_comunicacao","DT_PUBLICACAO", $id, $conexao_com_banco); ?>" required /><br>
                            </div>
                        </div>
						<div class="row" id="cad-button">
							<div class="col-md-12">
								<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Editar informações</button>
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container caixa-conteudo">	
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h3>Edição de anexos</h3><br>
							<?php include('editar_anexos.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->


<?php include('../foot.php')?>