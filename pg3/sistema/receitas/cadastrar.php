<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-cadastrar-receita'], $conexao_com_banco);
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Cadastre uma nova receita</p>
</div>
<?php include('../includes/mensagem.php'); ?>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="logica/cadastrar.php?operacao=receita" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Tipo</label>
								<select class="form-control" id="tipo" name="tipo" required/>
										<option value="">Selecione o tipo da receita</option>
										<?php $lista = retorna_tipos_receitas($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_RECEITA ?>"><?php echo $r->NM_RECEITA?></option>
										<?php } ?>
								</select>
							</div>	
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Descrição</label>
								<input class="form-control" placeholder='Digite a descrição (máx 500 carac.)' type='text' id='descricao' name='descricao' maxlength='500'/>
							</div>	
						</div>
					    <div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Valor</label>
								<input class="form-control" placeholder='Digite o valor da receita' onkeypress="mascara(this,mreais)" type="float" id='valor' name='valor' required/>
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
					<form name="cadastro" method="POST" action="logica/cadastrar.php?operacao=tipo_receita" enctype="multipart/form-data"> <!-- login.php -->  
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label" for="exampleInputEmail1">Código:</label>
											<input class="form-control" type='text' id='codigo' name='codigo'/>
										</div>	
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label" for="exampleInputEmail1">Nome da receita:</label>
											<input class="form-control" type='text' id='nome' name='nome'/>
										</div>	
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Cadastrar novo tipo</button>
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