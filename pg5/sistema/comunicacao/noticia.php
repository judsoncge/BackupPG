<div class="col-md-12">
	<div class="row linha-modal-processo">
		<small>
			<?php echo "Publicada em: " . 
					date_format(new DateTime($informacoes['DT_PUBLICACAO']), 'd/m/Y H:i');
			?>
		</small>
		<br>
		<br>
		<h6>
			<?php echo $informacoes['NM_CHAPEU'] ?>
		</h6>
		<br>
		<h3>
			<strong>
				<?php echo $informacoes['NM_TITULO'] ?>
			</strong>
		</h3>
		<br>
		<h5>
			<?php echo $informacoes['NM_INTERTITULO'] ?>
		</h5>
		
		<br>
			<?php 
				$lista = retorna_imagens_tamanho_comunicacao(0, $id, $conexao_com_banco);
				
				if(mysqli_num_rows($lista) > 0) {
			?>
					<ul id="imagensgrandes" class="rslides">
					
						<?php while($r = mysqli_fetch_object($lista)){  ?>
							
							<li class="modal-card-foto3">	
								<img src="../../registros/fotos-noticias/<?php echo $r->NM_ARQUIVO ?>" ></img>
								<p style="text-align:center;"><?php echo $r->NM_LEGENDA . " (" . $r->NM_CREDITOS . ") " ?></p>
								
							</li>
							

						<?php } ?> 
					
					</ul>
		<br>
		<h6>
				<?php } echo $informacoes['NM_CREDITOS'] ?>
		</h6>	
		
		<br>
		<br>
		
		
		<div>
			<?php 
				$lista = retorna_imagens_tamanho_comunicacao(1, $id, $conexao_com_banco);
						
				if(mysqli_num_rows($lista) > 0) {

				?>
					<ul id="imagenspequenas" class="rslides">
					
					
						<?php while($r = mysqli_fetch_object($lista)){  ?>
							
							<li class="modal-card-foto3">	
								<img src="../../registros/fotos-noticias/<?php echo $r->NM_ARQUIVO ?>" ></img>
								
								<p style="text-align:center;" class="caption"><?php echo $r->NM_LEGENDA . " (" . $r->NM_CREDITOS . ") " ?></p>
							</li>

						<?php } ?> 
					
					</ul>
			
				<?php } echo $informacoes['TX_NOTICIA'] ?>
		</div>
	</div>
</div>