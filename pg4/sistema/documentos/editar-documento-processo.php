<?php  
include('../head.php'); 
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-editar-documento'], $conexao_com_banco);
$informacoes = retorna_informacoes_documento($_GET['documento'], $conexao_com_banco);
?>
<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jspdf.min.js"></script>
<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/from_html.js"></script>
<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/split_text_to_size.js"></script>
<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/standard_fonts_metrics.js"></script>
<script>


window.onload = function() {
	 CKEDITOR.on('instanceReady', function (ev) {

        // Create a new command with the desired exec function
        var editor = ev.editor;
   
		var overridecmd = new CKEDITOR.command(editor, {
            exec: function(editor){
               exportar();
            }
        });

   
        ev.editor.commands.preview.exec = overridecmd.exec;
    });
		CKEDITOR.replace( 'editor2', {
			height: 260,
			skin: 'office2013',
			removeButtons: 'PasteFromWord,Save,HiddenField,Print,Form,Radio,TextField,Textarea,Select,Button,ImageButton,Checkbox,CreateDiv,Anchor,Flash,Iframe,ShowBlocks,Maximize'
		} );
		
	$('#cadastro').submit(function(event) {

		event.preventDefault(); 

	  
		$('#texto_documento').val(CKEDITOR.instances.editor2.getData().replace(/\"/g,"&quot;"));
	  

		$(this).unbind('submit').submit(); 
	})
};
	
	
	function exportar() {
		
		var titulo = 'Parecer';
	   $('body').append('<form action="exportar.php" method="post" target="frame" id="postToIframe"></form>');
		
		$('#postToIframe').append('<input type="hidden" name="html" value="'+CKEDITOR.instances.editor2.getData().replace(/\"/g,"&quot;") +'" />');
		$('#postToIframe').append('<input type="hidden" name="titulo" value="'+titulo+'" />');
		
		$('#postToIframe').submit().remove();
		$('#myModal').modal('show');
	
	}

	
	
</script>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edite o documento</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro"  id="cadastro" method="POST" action="logica/editar.php?operacao=info&documento=<?php echo $informacoes['CD_DOCUMENTO'] ?>&status=<?php echo $informacoes['NM_STATUS'] ?>" enctype="multipart/form-data">  
						<div class="row">
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
								
								<textarea cols="80" id="editor2" name="editor2" rows="10" >
									<?php echo $informacoes['TX_DOCUMENTO'] ?>
								</textarea>
							</div>	
						</div>
						<input type="hidden" value="" name="texto_documento" id="texto_documento" />
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

<form target="frame" action="exportar.php" method="post">
    <input type="hidden" value="" name="html" />
    <input type="hidden" value="" name="titulo" />
    
</form>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Visualizar Documento</h4>
      </div>
      <div class="modal-body">
      <iFrame src="" name="frame" style="width: 100%; height: 420px;"></iFrame>
      </div>
      
    </div>
  </div>
</div>


<?php include('../foot.php')?>