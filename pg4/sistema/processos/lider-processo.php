<?php 
$lider = retorna_lider_processo($informacoes['CD_PROCESSO'], $conexao_com_banco);

if($informacoes['CD_SERVIDOR_RESPONSAVEL_LIDER']!=''){ ?>
<div class="row linha-modal-processo">
	<div class="col-md-12">
		<label class="control-label" for="exampleInputEmail1"><b>Líder responsável pelo processo</b>: 
		<?php echo retorna_nome_servidor($lider, $conexao_com_banco); ?>
		</label>
	</div>
</div>
<?php } ?>


