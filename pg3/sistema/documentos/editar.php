<?php  
include('../head.php'); 
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-editar-documento'], $conexao_com_banco);
$informacoes = retorna_informacoes_documento($_GET['documento'], $conexao_com_banco);
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edite o documento</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/editar.php?operacao=info&documento=<?php echo $informacoes['CD_DOCUMENTO'] ?>" enctype="multipart/form-data">  
						<div class="row">
						<?php if($informacoes['CD_PROCESSO']!=''){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<select class="form-control" id="numero_processo" name="numero_processo"/>
										<option value="<?php echo $informacoes['CD_PROCESSO'] ?>"><?php echo $informacoes['CD_PROCESSO'] ?></option>
										<?php $lista = retorna_processos_com_servidor($_SESSION['CPF'],$conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_PROCESSO ?>"><?php echo $r->CD_PROCESSO?></option>
										<?php } ?>
									</select>
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
						<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<select class="form-control" id="documento" name="tipo_documento" required/>
										<option value="<?php echo $informacoes['NM_DOCUMENTO'] ?>"><?php echo $informacoes['NM_DOCUMENTO'] ?></option>
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
									</select>	
								</div>  
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" required/>
										<option value="<?php echo $informacoes['NM_ATIVIDADE'] ?>"><?php echo $informacoes['NM_ATIVIDADE'] ?></option>
										<?php include('../includes/assunto_processo_documento.php'); ?>
									</select>	
								</div>  
							</div>							 
						</div>
			
				<div class="row">	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Interessado</label>
							<input class="form-control" value="<?php echo $informacoes['NM_INTERESSADO'] ?>" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" required/>	
						</div>  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input class="form-control tipo-data" value='<?php echo $informacoes['DT_ENTRADA'] ?>' id="data_entrada" name="data_entrada" type="date" required />	
						</div>  
					</div>
					<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Prazo para a resposta</label>
								<input class="form-control tipo-data" value='<?php echo $informacoes['DT_PRAZO'] ?>' id="prazo" name="prazo" type="date" required />	
							</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Prioridade</label>
									<select class="form-control" id="prioridade" name="prioridade" required/>
										<option value="<?php echo $informacoes['NR_PRIORIDADE'] ?>"><?php echo arruma_prioridade($informacoes['NR_PRIORIDADE']) ?></option>
										<option value="4">Baixa</option>
										<option value="3">Média</option>
										<option value="2">Alta</option>
										<option value="1">Urgente</option>
									</select>	
						</div>  	
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="comment">Descrição do fato:</label>
							<input class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300" value='<?php echo $informacoes['DS_DOCUMENTO'] ?>' required/>
						</div>	
					</div>	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Valor</label>
							<input class="form-control" id="valor" name="valor" placeholder="Digite o valor" 
							onkeypress="mascara(this,mreais)" type="float" maxlength="10" value='<?php echo $informacoes['VLR_DOCUMENTO'] ?>'/>
						</div> 						
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="comment">Texto do documento:</label>
	  						<textarea class="form-control" rows="12" id="texto_documento" name="texto_documento"><?php echo $informacoes['TX_DOCUMENTO'] ?></textarea>
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
							<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Atualizar informações &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>