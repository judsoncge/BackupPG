<div id="resultado" class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
<div id="carregando" class="carregando"><i class="fa fa-refresh spin" aria-hidden="true"></i> <span>Carregando dados...</span></div>
	<table class="table table-hover tabela-dados">
		<thead>
			<tr>
				<th><center>Número  </center></th>
				<th><center>Servidor</center></th>
				<th><center>Setor</center></th>
				<th><center>Prazo   </center></th>
				<th><center>Status  </center></th>
				<th><center>Situação</center></th>
				<th><center>Dias    </center></th>
				<!-- tem que ser criada uma classe para nao ser impressa na exportação -->
				<th><center>Recebido</center></th>
				<th><center>Ação    </center></th>
			</tr>	
		</thead>
		<tbody>
			<?php 
				
				$l = mysqli_num_rows($lista);
				
				echo "<center><h5><div id='qtde'>$l</div></h5>";
			
				while($r = mysqli_fetch_object($lista)){ 
				
				$id = $r->ID;
				
				//retorna se ja existe alguma tramitacao do processo (para caso do processo ser recem criado e nao precisar de confirmacao de recebido)
				$tem_tramitacao = retorna_tem_tramitacao_processo($id, $conexao_com_banco);
				
				$recebido = retorna_recebido_processo($id, $conexao_com_banco);
			
				if($r->BL_URGENCIA and $r->NM_STATUS!="ARQUIVADO" and $r->NM_STATUS!="SAIU"){ ?>
				
				
				<tr style="background-color:#f1c40f;">
				<?php }else{ ?>
				<tr>
				<?php } ?>
				
				<td>
					<center>
						<?php echo $r->CD_PROCESSO ?>
					</center>
				</td>
				<td>
					<center>
						<?php echo retorna_nome_servidor($r->ID_SERVIDOR_LOCALIZACAO, $conexao_com_banco) ?>
					</center>
				</td>
				<td>
					<center>
						<?php echo retorna_sigla_setor($r->ID_SETOR_LOCALIZACAO, $conexao_com_banco) ?>
					</center>
				</td>
				<td>
					<center>
						<?php echo date_format(new DateTime($r->DT_PRAZO), 'd/m/Y') ?>
					</center>
				</td>
				<td>
					<center>
						<?php echo $r->NM_STATUS ?>
					</center>
				</td>
				<td>
					<center>
						<?php 
							if($r->BL_ATRASADO){
								echo "<font color='red'>ATRASADO</font>";
							}else{
								echo "<font color='green'>DENTRO DO PRAZO</font>";
							} 
						?>
					</center>
				</td>
				<td>
					<center>
						<?php echo $r->NR_DIAS ?>
					</center>
				</td>
				<td id="statusRecebido<?php echo $id?>">
					<center>
					<?php if($recebido){
							echo "SIM";
						  }else{ 
							echo "NÃO";
						  } ?>
					</center>
				</td>				
				<td id="recebido<?php echo $id?>">
					<?php if(!$recebido and $_SESSION['funcao'] != 'TI'){ ?>
						
						<a id="<?php echo $id . "-" . $tem_tramitacao ?>" onclick="receber(<?php echo $id ?>, <?php echo $tem_tramitacao ?>)" href='javascript:void(0);'>RECEBER</a>
						<!--<a href='logica/editar.php?id=<?php echo $id ?>&operacao=recebido&tramitacao=<?php echo $tem_tramitacao ?>'>RECEBER</a>--> 
				
						<br> 
								
						<a href='logica/editar.php?id=<?php echo $id ?>&operacao=devolvido&tramitacao=<?php echo $tem_tramitacao ?>'>DEVOLVER</a>
					
					<?php }else{ ?>
						
						<center>
							<a href="detalhes.php?id=<?php echo $id ?>">
								<button type='button' class='btn btn-secondary btn-sm' title="Detalhes e operações">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</button>
							</a>
						</center>
						
					<?php } ?>
				</td>
			</tr>
		<?php } ?>		
		</tbody>
	</table>
</div>