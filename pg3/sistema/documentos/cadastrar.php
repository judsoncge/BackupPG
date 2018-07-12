<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-cadastrar-documento'], $conexao_com_banco);
if(isset($_GET["processo"])){
	$informacoes = retorna_informacoes_processo($_GET['processo'], $conexao_com_banco);
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de Novo Documento</p>
	</div>
	
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/cadastrar.php?servidor=<?php $servidor = (isset($informacoes["CD_SERVIDOR_LOCALIZACAO"]))?$informacoes["CD_SERVIDOR_LOCALIZACAO"]:$_SESSION["CPF"]; echo $servidor; ?>&setor=<?php $setor = (isset($informacoes["CD_SETOR_LOCALIZACAO"]))?$informacoes["CD_SETOR_LOCALIZACAO"]:$_SESSION["setor"]; echo $setor; ?>" enctype="multipart/form-data"> 
						<div class="row">
							<?php if(isset($_GET["processo"])){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<input readonly class="form-control" id="numero_processo" value="<?php echo $_GET["processo"] ?>" name="numero_processo" placeholder="Digite o número do processo" type="text"/>	
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<select class="form-control" id="numero_processo" name="numero_processo"/>
										<option value="">Selecione o processo</option>
										<?php $lista = retorna_processos_com_servidor($_SESSION['CPF'],$conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_PROCESSO ?>"><?php echo $r->CD_PROCESSO?></option>
										<?php } ?>
									</select>
								</div>  
							</div>
							<?php } ?>
							
							<?php if(isset($_GET["tipo"])){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<input readonly class="form-control" id="tipo_documento" value="<?php echo $_GET["tipo"] ?>" name="tipo_documento" type="text" required/>	
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<select class="form-control" id="documento" name="tipo_documento" required/>
										<option value="">Selecione o documento</option>
										<option value="Despacho">Despacho</option>
										<option value="Parecer">Parecer</option>
										<option value="Relatório">Relatório</option>
										<option value="Ofício">Ofício</option>
										<option value="Memorando">Memorando</option>
										<option value="Resposta ao Interessado">Resposta ao Interessado</option>
										<option value="Apresentação">Apresentação</option>
										<option value="Publicação no Diário">Publicação no Diário</option>
										<option value="Termo de Referência">Termo de Referência</option>
										<option value="Cotação de Preço">Cotação de Preço</option>
										<option value="Certidão Negativa">Certidão Negativa</option>
										<option value="Aquisição">Aquisição</option>
										<option value="Outros">Outros</option>
									</select>	
								</div>  
							</div>
							<?php } ?>
							
							<?php if(isset($informacoes["DS_DOCUMENTO"])){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<input readonly class="form-control" id="atividade" value="<?php echo $informacoes["DS_DOCUMENTO"] ?>" name="tipo_atividade" type="text" required/>	
	
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" required/>
										<option value="">Selecione uma atividade</option>
										<?php include('../includes/assunto_processo_documento.php'); ?>
									</select>	
								</div>  
							</div>
							<?php } ?> 
						</div>
			
				<div class="row">
					<?php if(isset($informacoes["NM_INTERESSADO"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Interessado</label>
							<input readonly class="form-control" id="interessado" value='<?php echo $informacoes["NM_INTERESSADO"] ?>' 
							name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" required/>	
						</div>    
					</div>	
					<?php }else{ ?>	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Interessado</label>
							<input class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" 
							type="text" maxlength="50" required/>	
						</div>  
					</div>
					<?php } ?>
					<?php if(isset($informacoes["DT_ENTRADA"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input readonly class="form-control tipo-data" value='<?php echo $informacoes["DT_ENTRADA"] ?>' 
							id="data_entrada" name="data_entrada" type="date" required/>	
						</div>  
					</div>
					<?php }else{ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input class="form-control tipo-data" id="data_entrada" name="data_entrada" type="date" required/>	
						</div>  
					</div>
					<?php } ?>
					
					
					
					<?php 
					if(isset($informacoes["DT_PRAZO"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prazo para a resposta</label>
							<input <?php $prazo=$informacoes["DT_PRAZO"]; if($prazo!='0000-00-00'){ ?> readonly <?php }?>  
							class="form-control tipo-data" value='<?php echo $informacoes["DT_PRAZO"] ?>' id="prazo" name="prazo" type="date"/>	
						</div>  
					</div>
					<?php }else{ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prazo para a resposta</label>
							<input class="form-control tipo-data" id="prazo" name="prazo" type="date"/>	
						</div>  
					</div>
					<?php } ?>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prioridade</label>
								<select class="form-control" id="prioridade" name="prioridade" required/>
									<option value="">Selecione a prioridade</option>
									<option value="4">Baixa</option>
									<option value="3">Média</option>
									<option value="2">Alta</option>
									<option value="1">Urgente</option>
								</select>	
						</div>  	
					</div>		
					<?php if(isset($informacoes["NM_DETALHES"])){ ?>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="comment">Descrição do fato:</label>
								<input class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300" 
								value='<?php echo $informacoes["NM_DETALHES"] ?>' placeholder="Descreva o documento" required/>
							</div>	
						</div>
					<?php }else{ ?>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="comment">Descrição do fato:</label>
								<input class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300"placeholder="Descreva o documento" required/>
							</div>	
						</div>
					<?php } ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Valor</label>
							<input class="form-control" id="valor" name="valor" placeholder="Digite o valor" 
							onkeypress="mascara(this,mreais)" type="float" maxlength="10"/>
						</div> 						
					</div> 
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="comment">Texto do documento:</label>
	  						<textarea class="form-control" rows="12" id="texto_documento" name="texto_documento">Sem texto</textarea>
						</div>	
					</div>
				
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Enviar anexo</label><br>
						<input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/>
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

<?php include('../foot.php')?>