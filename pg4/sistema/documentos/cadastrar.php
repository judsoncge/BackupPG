<?php  
include('../head.php'); 
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-cadastrar-documento'], $conexao_com_banco);
if(isset($_GET["processo"])){
	$informacoes = retorna_informacoes_processo($_GET['processo'], $conexao_com_banco);
}
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
		
		var titulo = $('#documento').val();
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
		<p>Cadastro de Novo Documento</p>
	</div>
	
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" id="cadastro" method="POST" action="logica/cadastrar.php?servidor=<?php $servidor = (isset($informacoes["CD_SERVIDOR_LOCALIZACAO"]))?$informacoes["CD_SERVIDOR_LOCALIZACAO"]:$_SESSION["CPF"]; echo $servidor; ?>&setor=<?php $setor = (isset($informacoes["CD_SETOR_LOCALIZACAO"]))?$informacoes["CD_SETOR_LOCALIZACAO"]:$_SESSION["setor"]; echo $setor; ?>&processo=<?php $processo = (isset($informacoes["CD_PROCESSO"]))?$informacoes["CD_PROCESSO"]:""; echo $processo; ?>" enctype="multipart/form-data"> 
						<div class="row">
							<?php if(isset($_GET["tipo"])){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<input readonly class="form-control" id="tipo_documento" value="<?php echo $_GET["tipo"] ?>" name="tipo_documento" type="text" required/>	
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<select class="form-control" id="documento" name="tipo_documento" required/>
										<option value="">Selecione o tipo de documento</option>
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
										<option value="Outros">Outros</option>
									</select>	
								</div>  
							</div>
							<?php } ?>
							
							<?php if(isset($informacoes["ID_ASSUNTO"])){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" readonly required/>
										<option value="<?php echo $informacoes["ID_ASSUNTO"] ?>"><?php echo retorna_nome_assunto($informacoes["ID_ASSUNTO"], $conexao_com_banco); ?></option>
									</select>
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" required/>
										<option value="">Selecione uma atividade</option>
										<?php include('../includes/assunto_processo_documento.php'); ?>
									</select>	
								</div>  
							</div>
							<?php } ?> 
						
					<?php if(isset($informacoes["NM_INTERESSADO"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Interessado</label>
							<input readonly class="form-control" id="interessado" value='<?php echo $informacoes["NM_INTERESSADO"] ?>' 
							name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" required/>	
						</div>    
					</div>	
					<?php }else{ ?>	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Interessado</label>
							<input class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" 
							type="text" maxlength="50" required/>	
						</div>  
					</div>
					<?php } ?>
					</div>
			
				<div class="row">
					<?php if(isset($informacoes["DT_ENTRADA"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input readonly class="form-control tipo-data" value='<?php echo $informacoes["DT_ENTRADA"] ?>' 
							id="data_entrada" name="data_entrada" type="date" required/>	
						</div>  
					</div>
					<?php }else{ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input class="form-control tipo-data" id="data_entrada" name="data_entrada" type="date" required/>	
						</div>  
					</div>
					<?php } ?>

					<?php 
					if(isset($informacoes["DT_PRAZO"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prazo</label>
							<input <?php $prazo=$informacoes["DT_PRAZO"]; if($prazo!='0000-00-00'){ ?> readonly <?php }?>  
							class="form-control tipo-data" value='<?php echo $informacoes["DT_PRAZO"] ?>' id="prazo" name="prazo" type="date"/>	
						</div>  
					</div>
					<?php }else{ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prazo</label>
							<input class="form-control tipo-data" id="prazo" name="prazo" type="date"/>	
						</div>  
					</div>
					<?php } ?>
					<?php if(isset($informacoes["NR_URGENCIA"]) and ($informacoes["NR_URGENCIA"]==1)){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prioridade</label>
								<select class="form-control" id="prioridade" name="prioridade" required/>
									<option value="1">Urgente</option>
								</select>	
						</div>  	
					</div>	
					<?php }else{ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prioridade</label>
								<select class="form-control" id="prioridade" name="prioridade" required/>
									<option value="">Selecione a prioridade</option>
									<option value="4">Baixa</option>
									<option value="3">Média</option>
									<option value="2">Alta</option>
									<option value="1">Urgente</option>
								</select>	
						</div>  	
					</div>
					<?php } ?>					
					<?php if(isset($informacoes["NM_DETALHES"])){ ?>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="comment">Descrição do fato:</label>
								<input class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300" value='<?php echo $informacoes["NM_DETALHES"] ?>' placeholder="Descreva o documento" readonly required/>
							</div>	
						</div>
					<?php }else{ ?>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="comment">Descrição do fato:</label>
								<input class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300"placeholder="Descreva o documento" required/>
							</div>	
						</div>
					<?php } ?>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="comment">Texto do documento:</label>
	  						<textarea cols="80" id="editor2" name="editor2" rows="10" >
							</textarea>
						</div>	
					</div>
				 <input type="hidden" value="" name="texto_documento" id="texto_documento" />
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Enviar anexo</label><br>
						<input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/>
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