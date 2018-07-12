<?php 
include('../head.php');
include('../body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de arquivo</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form method='POST' action='logica/cadastrar.php' enctype='multipart/form-data'>	
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Selecione o tipo</label>
									<select class="form-control" id="tipo" name="tipo" required/>
										<option value="">Selecione o tipo de arquivo</option>
										<option value="APRESENTAÇÃO">APRESENTAÇÃO</option>
										<option value="AQUISIÇÃO">AQUISIÇÃO</option>
										<option value="CERTIFICADO">CERTIFICADO</option>
										<option value="CHECKLIST">CHECKLIST</option>
										<option value="COTAÇÃO DE PREÇO">COTAÇÃO DE PREÇO</option>
										<option value="CERTIDÃO NEGATIVA">CERTIDÃO NEGATIVA</option>
										<option value="DESPACHO">DESPACHO</option>
										<option value="MEMORANDO">MEMORANDO</option>
										<option value="OFÍCIO">OFÍCIO</option>
										<option value="PARECER">PARECER</option>
										<option value="PUBLICAÇÃO NO DIÁRIO">PUBLICAÇÃO NO DIÁRIO</option>
										<option value="RELATÓRIO">RELATÓRIO</option>
										<option value="RESPOSTA AO INTERESSADO">RESPOSTA AO INTERESSADO</option>
										<option value="TERMO DE REFERÊNCIA">TERMO DE REFERÊNCIA</option>
									</select>	
								</div>  
							</div>
							<div class="col-md-4">
								<label class="control-label" for="exampleInputEmail1">Escolha o servidor para enviar</label><br>
								<select class="form-control" id="enviar" name="enviar" required />
									<option value="">Selecione o servidor para enviar</option>
									
									<?php 
										
										$servidores = retorna_servidores_status("ATIVO", $conexao_com_banco);
									
										while($r = mysqli_fetch_object($servidores)){ ?>
										
											<option value="<?php echo $r->ID ?>">
												<?php 
												
												echo 
												
												$r->NM_SERVIDOR;
												
												?>
											</option>
										
									<?php } ?>
								</select>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Escolher anexo</label><br>
									<input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/>
								</div>
							</div>	
						</div>
						<div class="row" id="cad-button">
							<div class="col-md-12">
								<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Cadastrar e enviar</button>
							</div>
						</div>
					</form>	
				</div>
			</div>	
		</div>
	</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>

<?php include('../foot.php')?>