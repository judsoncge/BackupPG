<?php 
include('../head.php');
include('../body.php');
if($_SESSION['permissao-visualizar-relatorio-orgao']=="não" and $_SESSION['permissao-visualizar-relatorio-orgao']=="não"){
	echo "<script>alert('Você não tem permissão para estar nessa página!')</script>";
	echo "<script>history.back()</script>";
	die();
}
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
								<h5>Está com: <a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?>"><?php $total = retorna_numero_processos_com_servidor($r->CD_SERVIDOR,$conexao_com_banco); echo $total ?></a> processo(s)</h5>
								<hr>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Aberto"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao($r->CD_SERVIDOR,"Aberto",$conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) sem prazo <br>
								<hr>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Análise em andamento Finalização em andamento"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Análise em andamento","Finalização em andamento",$conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) com análise no prazo e finalização no prazo <br>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Análise em atraso Finalização em andamento"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Análise em atraso", "Finalização em andamento", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;}?></b></a> processo(s) com análise em atraso e finalização no prazo<br> 
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Análise em atraso Finalização em atraso"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Análise em atraso","Finalização em atraso",$conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;}?></b></a> processo(s) com análise em atraso e finalização em atraso <br> 
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído Finalização em andamento"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído", "Finalização em andamento",$conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;}?></b></a> processo(s) concluídos no prazo e finalização no prazo <br> 
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído Finalização em atraso"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído","Finalização em atraso", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) concluídos no prazo e finalização em atraso <br> 
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído com atraso Finalização em andamento"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído com atraso","Finalização em andamento", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) concluídos com atraso e finalização no prazo<br>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído com atraso Finalização em atraso"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído com atraso","Finalização em atraso", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) concluídos com atraso e finalização em atraso <br>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído com atraso Finalizado com atraso"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído com atraso","Finalizado com atraso", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) concluídos com atraso e finalizados com atraso <br>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído com atraso Finalizado"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído com atraso","Finalizado", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) concluídos com atraso e finalizados no prazo <br>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído com atraso Finalizado"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído com atraso","Finalizado com atraso", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) concluídos com atraso e finalizados com atraso <br>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído Finalizado com atraso"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído","Finalizado com atraso", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) concluídos no prazo e finalizados com atraso <br>
								<a href="todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Concluído Finalizado"><b><?php $numero_total = retorna_numero_processos_com_servidor_situacao2($r->CD_SERVIDOR,"Concluído","Finalizado", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) concluídos no prazo e finalizados no prazo<br>
						</div>
						
					
					</div>
					
				</div>
		<?php } ?>

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
