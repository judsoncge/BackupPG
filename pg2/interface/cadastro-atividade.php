<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('head.php'); 
include('body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Cadastre uma nova atividade</p>
</div>
<?php include('includes/mensagem.php'); ?>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="../componentes/atividade/logica/cadastrar.php?sessionId=<?php echo $num ?>" enctype="multipart/form-data"> <!-- login.php -->  					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="encarregado">Encarregado</label>
								<select class="form-control" id="encarregado" name="encarregado" required/>
								<option value="">Selecione o servidor</option>
								<?php $lista = retorna_servidores($conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<option value="<?php echo $r->CD_SERVIDOR ?>"><?php echo $r->NM_SERVIDOR ?></option><?php } ?>
								</select>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="dia">Dia de vencimento:</label>
								<select class="form-control" id="dia" name="dia" required/>
									<option value="">Selecione o dia</option>
									<?php $i = 1; while($i <= 31){ ?>
									<option value="<?php echo $i ?>"><?php echo $i ?></option>
									<?php $i++;} ?>
								</select>
							</div>	
						</div>						
					</div>
					<div class="row">
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="mes-inicio">Mês Inicial:</label>
										<select class="form-control" id="mes-inicio" name="mes-inicio" required/>
											<option value="">Selecione o mês</option>
											<option value="1">Janeiro</option>
											<option value="2">Fevereiro</option>
											<option value="3">Março</option>
											<option value="4">Abril</option>
											<option value="5">Maio</option>
											<option value="6">Junho</option>
											<option value="7">Julho</option>
											<option value="8">Agosto</option>
											<option value="9">Setembro</option>
											<option value="10">Outubro</option>
											<option value="11">Novembro</option>
											<option value="12">Dezembro</option>
										</select>
							</div>	
						</div>
						<div class="col-md-6">
	                        <label class="control-label" for="ano-inicio">Ano Inicial:</label>
							<select class="form-control" name="ano-inicio" required/>
							<option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
							</select>
						</div>						
					</div>
					<div class="row">
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="mes-fim">Mês Final:</label>
								<select class="form-control" id="mes-fim" name="mes-fim" required/>
									<option value="">Selecione o mês</option>
										<option value="1">Janeiro</option>
										<option value="2">Fevereiro</option>
										<option value="3">Março</option>
										<option value="4">Abril</option>
										<option value="5">Maio</option>
										<option value="6">Junho</option>
										<option value="7">Julho</option>
										<option value="8">Agosto</option>
										<option value="9">Setembro</option>
										<option value="10">Outubro</option>
										<option value="11">Novembro</option>
										<option value="12">Dezembro</option>
								</select>
							</div>	
						</div>
						<div class="col-md-6">
	                        <label class="control-label" for="ano-fim">Ano Final:</label>
							<select class="form-control" name="ano-fim" required/>
							<option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
							</select>
						</div>
						
					</div>				
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="descricao">Descrição</label>
								<textarea class="form-control" placeholder='Digite a descrição (máx 500 carac.)' type='text' id='descricao' name='descricao' maxlength='500'></textarea>
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
		



<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});


	/*tipo de telefone*/
/*	$("#tipo").on('change', function(){
		$('.opcao').hide();
		$('#' + this.value).fadeIn("slow");
	});*/

</script>
<?php include('foot.php')?>