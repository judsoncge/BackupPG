<?php 
include('../head.php');
include('../body.php');
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
					<form name="cadastro" method="POST" action="logica/cadastrar.php" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								 <div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Natureza do problema:</label>
									<select class="form-control" id="natureza" name="natureza_problema" required/>
										<option value="">Selecione a natureza do problema</option>
										<option value="WORD">WORD</option>
										<option value="EXCEL">EXCEL</option>
										<option value="POWER POINT">POWER POINT</option>
										<option value="TRELLO">TRELLO</option>
										<option value="SIAFEM">SIAFEM</option>
										<option value="SIAPI">SIAPI</option>
										<option value="COMPUTADOR OU PEÇA COM DEFEITO">COMPUTADOR OU PEÇA COM DEFEITO</option>
										<option value="INTERNET">INTERNET</option>
										<option value="COMPARTILHAMENTO DE PASTA">COMPARTILHAMENTO DE PASTA</option>
										<option value="IMPRESSORA">IMPRESSORA</option>
										<option value="PAINEL DE GESTÃO">PAINEL DE GESTÃO</option>
										<option value="OUTRO">OUTRO</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="comment">Problema: (máx 300 carac.)</label>
									<input type='text' class='form-control' rows='1' id='problema' name='problema' maxlength="300" required></input>	
								</div>	
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
<?php include('../foot.php')?>