<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_financeiro',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de Veículo</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/veiculo/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Valor (aluguel ou compra)</label>
									<input class="form-control" id="valor" name="valor" placeholder="valor de alguel ou compra" 
									type="float" maxlength="10" onkeypress="mascara(this,mreais)" required/>
								</div>  
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Placa</label>
									<input class="form-control" id="placa" name="placa" placeholder="" style="text-transform:uppercase" type="text" maxlength="" required/>
								</div>  
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Modelo</label>
									<input class="form-control" id="modelo" name="modelo" placeholder="Digite modelo do veículo" type="text" maxlength="" required/>
								</div>  
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Renavam</label>
									<input class="form-control" id="renavam" name="renavam" placeholder="Digite renavam do veículo" type="text" maxlength="" required/>
								</div>  
							</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Condutor</label>
							<select class="form-control" id="condutor" name="condutor" required/>
								<option value="">Selecione o servidor</option>
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
							<input class="form-control" id="termo_cessao" name="termo_cessao" placeholder="Digite termo de cessão do veículo" type="text" maxlength="" required/>
						</div>  
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Ano de fabricação</label>
							<input class="form-control" id="ano_fabricacao" name="ano_fabricacao" placeholder="Digite o ano de fabricação do veículo" type="text" maxlength="4" required/>
						</div>  
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">É locado?</label>
								<select class="form-control" id="locado" name="locado"/>
								<option value="">Selecione</option>
								<option value="sim">Sim</option>
								<option value="não">Não</option>
								</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Possui seguro?</label>
								<select class="form-control" id="seguro" name="seguro"/>
								<option value="">Selecione</option>
								<option value="sim">Sim</option>
								<option value="não">Não</option>
								</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Possui logomarca?</label>
								<select class="form-control" id="logomarca" name="logomarca"/>
								<option value="">Selecione</option>
								<option value="sim">Sim</option>
								<option value="não">Não</option>
								</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">É licenciado?</label>
								<select class="form-control" id="licenciado" name="licenciado"/>
								<option value="">Selecione</option>
								<option value="sim">Sim</option>
								<option value="não">Não</option>
								</select>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">É recolhido para a garagem a noite?</label>
								<select class="form-control" id="recolhido_garagem" name="recolhido_garagem"/>
								<option value="">Selecione</option>
								<option value="sim">Sim</option>
								<option value="não">Não</option>
								</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">É chipado?</label>
								<select class="form-control" id="chipado" name="chipado"/>
								<option value="">Selecione</option>
								<option value="sim">Sim</option>
								<option value="não">Não</option>
								</select>
						</div>		
					</div>	
					<div class="col-md-4" >
						<div class="form-group opcao" style="display: none;" id="sim">
							<label class="control-label" for="exampleInputEmail1">Chip</label>
							<input class="form-control" id="codigo_chip" name="codigo_chip" placeholder="Digite o chip do veículo" type="text" maxlength=""/>
						</div>  
					</div>	
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						  <label for="comment">Observações</label>
						  <textarea class="form-control" rows="5" id="observacoes" name="observacoes"></textarea>
						 <!-- <input class="form-control" id="observacoes" name="observacoes" placeholder="Digite as observações" type="text" maxlength=""/> -->
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

<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});



		/*tem chip?*/
	$("#chipado").on('change', function(){
		$('.opcao').hide();
		$('#' + this.value).fadeIn("slow");
	});

</script>
<?php include('footer.php')?>