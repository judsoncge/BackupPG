<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_veiculo_editar.php');	
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição de Veículo de placa <?php echo $placa ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/veiculo/logica/editar.php?id=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Valor de aluguel ou compra</label>
							<input class="form-control" id="valor" name="valor" placeholder="Valor de aluguel ou compra" 
							type="float" maxlength="10" value="<?php echo $valor ?>" onkeypress="mascara(this,mreais)" required/>
						</div>  
					</div>
				
				
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Placa</label>
							<input class="form-control" value="<?php echo $placa ?>" id="placa" name="placa" placeholder="" style="text-transform:uppercase" type="text" maxlength="" required/>
						</div>  
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Modelo</label>
							<input class="form-control" value="<?php echo $modelo ?>" id="modelo" name="modelo" placeholder="Digite modelo do veículo" type="text" maxlength="" required/>
						</div>  
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Renavam</label>
							<input class="form-control" value="<?php echo $renavam ?>" id="renavam" name="renavam" placeholder="Digite renavam do veículo" type="text" maxlength="" required/>
						</div>  
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Condutor</label>
							<select class="form-control" id="condutor" name="condutor" required/>
								<option value="<?php echo $beneficiario ?>"><?php echo $beneficiario2 ?></option>
								<?php $lista = retorna_dados("pessoa", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<option value="<?php echo $r->CPF ?>"><?php echo $r->nome ?></option><?php } ?>
							</select>
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Termo de cessão</label>
							<input class="form-control" value="<?php echo $termo_cessao ?>" id="termo_cessao" name="termo_cessao" placeholder="Digite termo de cessão do veículo" type="text" maxlength="" required/>
						</div>  
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Ano de fabricação</label>
							<input class="form-control" value="<?php echo $ano_fabricacao ?>" id="ano_fabricacao" name="ano_fabricacao" placeholder="Digite o ano de fabricação do veículo" type="text" maxlength="4" required/>
						</div>  
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">É locado?</label>
								<select class="form-control" id="locado" name="locado"/>
								<option value="<?php echo $locado ?>"><?php echo $locado ?></option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
								</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Possui seguro?</label>
								<select class="form-control" id="seguro" name="seguro"/>
								<option value="<?php echo $seguro ?>"><?php echo $seguro ?></option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
								</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Possui logomarca?</label>
								<select class="form-control" id="logomarca" name="logomarca"/>
								<option value="<?php echo $logomarca ?>"><?php echo $logomarca ?></option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
								</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">É licenciado?</label>
								<select class="form-control" id="licenciado" name="licenciado"/>
								<option value="<?php echo $licenciado ?>"><?php echo $licenciado ?></option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
								</select>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">É recolhido para a garagem a noite?</label>
								<select class="form-control" id="recolhido_garagem" name="recolhido_garagem"/>
								<option value="<?php echo $recolhido_garagem ?>"><?php echo $recolhido_garagem ?></option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
								</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">É chipado?</label>
								<select class="form-control" id="chipado" name="chipado"/>
								<option value="<?php echo $chipado ?>"><?php echo $chipado ?></option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
								</select>
						</div>		
					</div>	
					<div class="col-md-4" >
						<div class="form-group opcao" id="sim">
							<label class="control-label" for="exampleInputEmail1">Chip</label>
							<input class="form-control" value="<?php echo $codigo_chip ?>" id="codigo_chip" name="codigo_chip" placeholder="Digite o chip do veículo" type="text" maxlength=""/>
						</div>  
					</div>	
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						  <label for="comment">Observações</label>
						 <input class="form-control" value="<?php echo $observacoes ?>" id="observacoes" name="observacoes" placeholder="Digite as observações" type="text" maxlength=""/>
						</div>
					</div>
				</div>
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Atualizar informações</button>
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

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
<?php include('footer.php')?>