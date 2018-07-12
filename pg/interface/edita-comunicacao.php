<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_comunicacao_editar.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_comunicacao',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição de <?php echo $titulo ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/comunicacao/logica/editar.php?comunicacao=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
                        <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Item de Comunicação</label>
									<select class="form-control" id="item" name="item" required/>
										<option value="<?php echo $item ?>"><?php echo $item ?></option>
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
									<input class="form-control" value="<?php echo $titulo ?>" id="titulo" name="titulo" placeholder="Máximo de 100 caracteres" type="text" maxlenght="100" required />	
								</div>  
							</div>
                        </div>
                        
                        
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Texto do Item</label>
									 <textarea class="texto" rows="7" id="texto" name="texto" required><?php if($texto == null){ echo 'Sem texto';}else{ echo $texto;} ?></textarea>
								</div>  
                            </div>
						</div>
                        
                    <div class="row">
                            <div class="col-md-10">
                                <label class="control-label" for="exampleInputEmail1">Data de publicação</label>
                                <input type="date" class="" value="<?php echo $data_publicacao ?>" name="data_publicacao" id="data_publicacao"/>
								
							</div>
                        
							<div class="col-md-2">
								<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Salvar</button>
							</div>
					</div>	
			</form>	
			<hr>
			<h3>Edição de anexos</h3>
				
			<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: auto; margin-top: 20px;">
                                    <table class="table table-hover tabela-dados">
                                        <thead>
                                            <tr>
                                                <th>Anexos</th>
                                                <th>Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>    
                                            <?php $lista2 = retorna_anexos_documento($id, $conexao_com_banco); while($r2 = mysqli_fetch_object($lista2)){ ?>
                                            <tr>
                                                <td><?php echo $r2 -> caminho; ?> <b></td>
                                                <td><a href="../componentes/anexo/logica/excluir.php?id=<?php echo $r2 -> id ?>"><button type='button' class='btn btn-secondary btn-sm' title="Excluir anexo"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
                                            
                                            </tr>
											<?php } ?>
                                            <tr>
												<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF']?>' enctype='multipart/form-data'>
													<td colspan="2"><input type="file" class="" name="arquivo_anexo[]" id="imagem-comunicacao"/>
													<button type='submit' class='btn btn-sm btn-info pull-right' >Gravar</button></td>
												</form>
                                            </tr>    
                                            
										</tbody>
										</table>
                </div>
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