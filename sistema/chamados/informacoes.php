<div class="row linha-modal-processo">
	<div class="col-md-12">
			<b>Status          </b>:
				<?php echo $informacoes['NM_STATUS'] ?><br><br>	
			<b>Data de abertura  </b>: 
				<?php echo date_format(new DateTime($informacoes['DT_ABERTURA']), 'd/m/Y H:i:s') ?><br> 
			<b>Requisitante      </b>: 
				<?php echo retorna_nome_servidor($informacoes['ID_SERVIDOR_REQUISITANTE'], $conexao_com_banco) ?><br>
			<b>Problema          </b>: 
				<?php echo $informacoes['NM_PROBLEMA'] ?><br> 
			<b>Natureza          </b>:
				<?php echo $informacoes['NM_NATUREZA'] ?>	
	</div>
</div>