<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Abrir Chamado</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/chamado/logica/cadastrar.php" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-6">
								 <div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Natureza do problema:</label>
									<select class="form-control" id="natureza" name="natureza_problema" required/>
										<option value="">Selecione a natureza do problema</option>
										<option value="Word">Word</option>
										<option value="Excel">Excel</option>
										<option value="Power Point">Power Point</option>
										<option value="Trello">Trello</option>
										<option value="SIAFEM">Siafem</option>
										<option value="SIAPI">SIAPI</option>
										<option value="Computador ou peça com defeito">Computador ou peça com defeito</option>
										<option value="Internet">Internet</option>
										<option value="Compartilhamento de pasta">Compartilhamento de pasta</option>
										<option value="Impressora">Impressora</option>
										<option value="Painel de Gestão">Painel de Gestão</option>
										<option value="Outro">Outro</option>
									</select>
								</div>
							</div>	
							<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_chamado_pessoa',$conexao_com_banco); if($permissao=='Sim'){ ?>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Requisitante</label>
									<select class="form-control" id="requisitante" name="requisitante" required/>
									<option value="">Selecione o servidor</option>
									<?php $lista = retorna_dados("pessoa", $conexao_com_banco);
									while($r = mysqli_fetch_object($lista)){ ?>
									<option value="<?php echo $r->CPF ?>"><?php echo $r->nome ?></option><?php } ?>
									</select>
								</div>	
							</div>	
							<?php } ?>
						</div>	
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="comment">Problema: (máx 300 carac.)</label>
									<input type='text' class='form-control' rows='1' id='problema' name='problema' maxlength="300" required></input>								</div>	
							</div>
						</div>	
						<div class="row" id="cad-button">
							<div class="col-md-12">
								<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Abrir chamado</button>
							</div>
						</div>
					</form>
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

<script type="text/javascript">
	/*buscar foto*/
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});

		$(document).ready( function() {
			$('.btn-file :file').on('fileselect', function(event, numFiles, label) {

				var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}

			});
		});
	</script>
<?php include('footer.php')?>