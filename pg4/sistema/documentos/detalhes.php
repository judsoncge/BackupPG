<?php 
include('../head.php');
include('../body.php');
$informacoes = retorna_informacoes_documento($_GET['documento'], $conexao_com_banco);
$id = $informacoes['CD_DOCUMENTO'];
$prazo = retorna_prazo_processo($informacoes['CD_PROCESSO'], $conexao_com_banco);
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
			removeButtons: 'Source,PasteFromWord,Save,HiddenField,Print,Form,Radio,TextField,Textarea,Select,Button,ImageButton,Checkbox,CreateDiv,Anchor,Flash,Iframe,ShowBlocks,Maximize'
		} );
		
	$('#cadastro').submit(function(event) {

		event.preventDefault(); 

	  
		$('#texto_documento').val(CKEDITOR.instances.editor2.getData().replace(/\"/g,"&quot;"));
	  

		$(this).unbind('submit').submit(); 
	})
	
	$('.toggle').click(function(){
		$('#' + $(this).attr("data-target")).toggle();
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
		<p>Documento sobre <?php echo retorna_nome_assunto($informacoes['ID_ASSUNTO'], $conexao_com_banco) ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					
					<?php 
					
					if(($informacoes['NM_STATUS'] != 'Resolvido' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Resolvido' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Resolvido' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
						include('botoes.php'); 
					}
					
					include('informacoes.php');
					if ( $informacoes['TX_DOCUMENTO']){?>
						<div class="row linha-modal-processo" style="padding-left: 25px;">
							<label class='control-label toggle' data-target="texto-documento" id='solicitante'><b>Texto do Documento (Clique para expandir):</b></label>
							<div id="texto-documento" style="display: none; width: 100%;">
							<textarea cols="80" id="editor2" name="editor2" rows="10" disabled >
								<?php echo $informacoes['TX_DOCUMENTO'] ?>
							</textarea>
							</div>
						</div>
					<?php }
					
					include('historico.php');
					
					if(($informacoes['NM_STATUS'] != 'Resolvido' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Resolvido' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Resolvido' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
						include('../includes/enviar-mensagem.php');
					}
					
					if(($_SESSION['permissao-sugestao-documento'] == 'sim' and $informacoes['NM_STATUS'] != 'Aprovado' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($_SESSION['permissao-sugestao-documento'] == 'sim' and $informacoes['NM_STATUS'] != 'Aprovado' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-sugestao-documento'] == 'sim' and $informacoes['NM_STATUS'] != 'Aprovado' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
						include('sugestao.php');
					}
					
					include('anexos.php');
									
					if(($informacoes['NM_STATUS'] != 'Resolvido' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Resolvido' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Resolvido' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
						include('enviar.php'); 
					}
					?>
								
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