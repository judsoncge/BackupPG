<?php  
include('../componentes/sessao/iniciar-sessao.php');include('head.php'); 
include('body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastre um novo pagamento</p>
	</div>
	<?php include('includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/pagamento/logica/cadastrar.php?sessionId=<?php echo $num ?>&operacao=pagamento" enctype="multipart/form-data"> <!-- login.php -->  
                        <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="codigo">Tipo de pagamento</label>
									<select class="form-control" id="codigo" name="codigo" required/>
										<option value="">Selecione o tipo da receita</option>
										<?php $lista = retorna_tipos_pagamentos($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_PAGAMENTO ?>"><?php echo $r->NM_PAGAMENTO?></option>
										<?php } ?>
								</select>	
								</div>  
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<label class="control-label" for="descricao">Descrição</label>
									<input class="form-control" id="descricao" name="descricao" 
									type="text" />	
								</div>  
							</div>							
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="control-label" for="anexo">Selecionar imagens</label><br>
                                <input type="file" class="" name="imagem[]" id="anexo" multiple required/><br>
								<?php  ?>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="data_vencimento">Data de vencimento</label>
                                <input type="date" class="" name="data_vencimento" id="data_vencimento"/>
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
<?php include('includes/cadastro-tipos-despesas.php'); ?>
		
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
<?php include('foot.php')?>