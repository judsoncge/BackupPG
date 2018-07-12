<?php 
include('../head.php'); 
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-cadastrar-despesa'], $conexao_com_banco);
if(isset($_GET['processo'])){
	$informacoes = retorna_informacoes_processo($_GET['processo'], $conexao_com_banco);
	$valor = retorna_menor_valor_documentos_processo($informacoes['CD_PROCESSO'], $conexao_com_banco);
	$processo = $informacoes['CD_PROCESSO'];
	$action = "logica/cadastrar.php?operacao=despesa&processo=$processo";
}else{
	$action = "logica/cadastrar.php?operacao=despesa";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Cadastre uma nova despesa</p>
</div>
<?php include('../includes/mensagem.php'); ?>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="<?php echo $action ?>" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Tipo</label>
								<select class="form-control" id="tipo" name="tipo" required/>
										<option value="">Selecione o tipo da despesa</option>
										<?php $lista = retorna_tipos_despesas($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_DESPESA ?>"><?php echo $r->NM_DESPESA?></option>
										<?php } ?>
								</select>
							</div>	
						</div>		
						<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Descrição</label>
									<input class="form-control" placeholder='Digite a descrição (máx 500 carac.)' type='text' id='descricao' name='descricao' maxlength='500'/>
								</div>	
							</div>
						<?php if(isset($_GET['processo'])){ ?>
							<div class="col-md-4">
								<label class="control-label" for="data">Data de vencimento:</label>
								<input class="form-control" type="date" id='data' name='data' value='<?php echo $informacoes['DT_PRAZO'] ?>' readonly required/>
							</div>
						<?php }else{ ?>
							<div class="col-md-4">
								<label class="control-label" for="data">Data de vencimento:</label>
								<input class="form-control" type="date" id='data' name='data' required/>
							</div>
						<?php } ?>
					</div>
					<div class="row">
					<?php if(isset($_GET['processo'])){ ?>
                        <div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Valor</label>
								<input class="form-control" placeholder='Digite o valor da despesa' onkeypress="mascara(this,mreais)" type="float" id='valor' name='valor' value='<?php echo $valor ?>' readonly required/>
							</div>	
						</div>
					<?php }else{ ?>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Valor</label>
								<input class="form-control" placeholder='Digite o valor da despesa' onkeypress="mascara(this,mreais)" type="float" id='valor' name='valor' required/>
							</div>	
						</div>
					<?php } ?>
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label" for="arquivo_anexo">Enviar anexo</label><br>
								<input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/>
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
<div class="container well">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/cadastrar.php?&operacao=tipo_despesa" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Código:</label>
									<input class="form-control" type='text' id='codigo' name='codigo'/>
								</div>	
							</div>
							<div class="col-md-3">
							<label class="control-label" for="exampleInputEmail1">Tipo:</label>
								<select class="form-control" id="tipo" name="tipo" required/>
									<option value="">Selecione o tipo</option>
									<option value="Fixa">Fixa</option>
									<option value="Variável">Variável</option>
								</select>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Nome da despesa:</label>
									<input class="form-control" type='text' id='nome' name='nome'/>
								</div>	
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Cadastrar nova despesa</button>
								</div>	
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>