<?php 
include('../head.php'); 
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-editar-comunicacao'], $conexao_com_banco);
$id = $_GET['comunicacao'];
$comunicacao = retorna_comunicacao($id, $conexao_com_banco);
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição de <?php echo $comunicacao['NM_TITULO'] ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/editar.php?operacao=info&comunicacao=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
                        <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Item de Comunicação</label>
									<select class="form-control" id="item" name="item" required/>
										<option value="<?php echo $comunicacao['NM_ITEM'] ?>"><?php echo $comunicacao['NM_ITEM'] ?></option>
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
									<input class="form-control" value="<?php echo $comunicacao['NM_TITULO'] ?>" id="titulo" name="titulo" placeholder="Máximo de 100 caracteres" type="text" maxlenght="100" required />	
								</div>  
							</div>
                        </div>
                        
                        
                        <div class="row">
						
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Texto do Item</label>
									 <textarea rows="10" cols="140" name="texto"><?php if( $comunicacao['NM_TEXTO'] == null){ echo 'Sem texto';}else{ echo $comunicacao['NM_TEXTO'];} ?></textarea>
								</div>  
                            </div>
						</div>
                        
                    <div class="row">
                            <div class="col-md-10">
                                <label class="control-label" for="exampleInputEmail1">Data de publicação</label>
                                <input type="date" class="" value="<?php echo $comunicacao['DT_PUBLICACAO'] ?>" name="data_publicacao" id="data_publicacao"/>
								
							</div>
                        
							<div class="col-md-2">
								<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Salvar</button>
							</div>
					</div>	
			</form>	
			<hr>
			<h3>Edição de anexos</h3>
				
			<table class="table table-hover tabela-dados">
        <thead>
			<tr>
				<th>Anexos</th>
				
					<th>Excluir</th>
				
			</tr>
        </thead>
        <tbody>    
		<?php $lista2 = retorna_anexos_comunicacao($id, $conexao_com_banco); 
				while($r2 = mysqli_fetch_object($lista2)){ ?>
					<tr>
						<td>
							<a href="../../registros/anexos/<?php echo $r2->NM_ARQUIVO ?>" download><?php echo $r2->NM_ARQUIVO ?></a>
						</td>
							<td>
								<a href="logica/excluir.php?operacao=anexo_comunicacao&comunicacao=<?php echo $id ?>&id=<?php echo $r2 -> ID ?>&nome=<?php echo $r2 -> NM_ARQUIVO ?>">
									<button type='button' class='btn btn-secondary btn-sm' title="Excluir anexo">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
								</a>
							</td>
				   </tr>
				<?php } ?>
                
					<tr>
						<form name='teste' method='POST' action='logica/editar.php?operacao=anexo&comunicacao=<?php echo $id ?>' enctype='multipart/form-data'> 
							<td>
								<input type="file" class="" name="arquivo_anexo" id="imagem-comunicacao"/>
							</td> 
							<td>
								<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar' style="margin-top:0; max-width: 140px;" onclick="play()";>Anexar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
								</button>
							</td>
						</form>
					</tr> 
				
        </tbody>
	</table>
		</div>
	</div>
</div>
</div>

<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->

<?php include('../foot.php')?>