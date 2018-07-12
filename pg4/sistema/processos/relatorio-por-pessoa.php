<?php 
include('../head.php');
include('../body.php');
?>
   
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
    <div class="container menu-home">
		<?php include('menu-relatorio.php'); ?>
	</div>
	<div class="container caixa-conteudo">
		<?php $lista = retorna_servidores_relatorio_pessoa($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){ ?>
				<div class="row linha-grafico">
					
					<div class="grafico2" id="processos-ativos" >
						<div class="col-md-5">
							<center>
								<div class='box-servidor2'>
									<img src='../../registros/fotos/<?php echo $r->NM_ARQUIVO_FOTO ?>' class='servidor-img2'></img>
								</div>
								<div style="margin-top:10px;"><b><?php echo $r->NM_SERVIDOR . " " . $r->SNM_SERVIDOR ?></b></div>
							</center>
						</div>	
						<div class="col-md-7">	
								
								<!-- Número total de processos que estão com o servidor -->
								<h5>
									Está com: 
										<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?>">
											<?php $total = retorna_numero_processos_com_servidor($r->CD_SERVIDOR,$conexao_com_banco); 
											echo $total; 
											?>
										</a> 
									processo(s).
								</h5>
								
								<hr>
								<!-- Número de processos em andamento que estão com o servidor -->
								<!-- Está com: -->
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Em andamento">
									<b>
										<?php 
											$numero_total = retorna_numero_processos_com_servidor_status($r->CD_SERVIDOR,"Em andamento",$conexao_com_banco); 
											if($total!=0){
												$porcentagem = ($numero_total/$total)*100;
												$porcentagem = number_format($porcentagem, 1);
												echo $numero_total . " (" . $porcentagem . "%)";
											}else{
												echo $numero_total;
											} 
										?>
									</b>
								</a> 
								processo(s) em andamento.
								
								<br>
								
								<!-- Número de processos atrasados que estão com o servidor -->
								<!-- Está com: -->
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Atrasado">
									<b>
										<?php 
											$numero_total = retorna_numero_processos_com_servidor_status($r->CD_SERVIDOR,"Atrasado",$conexao_com_banco); 
											if($total!=0){
												$porcentagem = ($numero_total/$total)*100;
												$porcentagem = number_format($porcentagem, 1);
												echo $numero_total . " (" . $porcentagem . "%)";
											}else{
												echo $numero_total;
											} 
										?>
									</b>
								</a> 
								processo(s) atrasados.
								
								<br>
								
								<!-- Número de processos finalizados pelo setor que estão com o servidor -->
								<!-- Está com: -->
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Finalizado pelo setor">
									<b>
										<?php 
											$numero_total = retorna_numero_processos_com_servidor_status($r->CD_SERVIDOR,"Finalizado pelo setor",$conexao_com_banco); 
											if($total!=0){
												$porcentagem = ($numero_total/$total)*100;
												$porcentagem = number_format($porcentagem, 1);
												echo $numero_total . " (" . $porcentagem . "%)";
											}else{
												echo $numero_total;
											} 
										?>
									</b>
								</a> 
								processo(s) finalizados pelo setor.
								
								<br>
								
								<!-- Número de processos finalizados pelo gabinete que estão com o servidor -->
								<!-- Está com: -->
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Finalizado pelo gabinete">
									<b>
										<?php 
											$numero_total = retorna_numero_processos_com_servidor_status($r->CD_SERVIDOR,"Finalizado pelo gabinete",$conexao_com_banco); 
											if($total!=0){
												$porcentagem = ($numero_total/$total)*100;
												$porcentagem = number_format($porcentagem, 1);
												echo $numero_total . " (" . $porcentagem . "%)";
											}else{
												echo $numero_total;
											} 
										?>
									</b>
								</a> 
								processo(s) finalizados pelo gabinete.
						</div>
					</div>
				</div>
		<?php } ?>
	</div>
</div>