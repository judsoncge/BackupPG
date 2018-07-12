<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')
?>
   
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
    <div class="container menu-home">
		<div class="btn-group" role="group" aria-label="...">
              <a href="processos-relatorio1.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Visão Geral</button></a>
              <a href="processos-relatorio2.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Setor</button></a>
              <a href="processos-relatorio3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Pessoa</button></a>
              <a href="processos-relatorio-geral.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Relatório Executivo</button></a>
              <!-- <a href="home3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">SUPAD</button></a> -->
	   </div>
	</div>
	

	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-md-12" style="margin-left: 20px;">
				Total de processos (ativos e inativos): <b><?php $numero_total = retorna_numero_processos(date('Y'),$conexao_com_banco); echo $numero_total ?></b>
			</div>
		</div>
		<?php $lista = retorna_dados("pessoa", $conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){ ?>
				<div class="row linha-grafico">
					
					<div class="grafico2" id="processos-ativos" >
						<div class="col-md-5">
							<center>
								<div class='box-servidor2'>
									<img src='../registros/fotos/<?php echo $r->foto ?>' class='servidor-img2'></img>
								</div>
								<div style="margin-top:10px;"><b><?php echo $r->nome . " " . $r->sobrenome ?></b></div>
							</center>
						</div>	
						<div class="col-md-7">	
								<h5>Está com: <a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?>"><?php $total = retorna_numero_processos_pessoa($r->CPF,$conexao_com_banco); echo $total ?></a> processo(s)</h5>
								<hr>
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Aberto"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao($r->CPF,"Aberto",$conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) sem prazo <br>
								<hr>
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Em andamento"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao($r->CPF,"Em andamento",$conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) com análise no prazo <br>
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Análise em atraso Em andamento"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao2($r->CPF,"Análise em atraso","Em andamento",$conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;}?></b></a> processo(s) em análise com atraso e finalização ainda no prazo <br> 
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Análise em atraso Finalização em atraso"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao2($r->CPF,"Análise em atraso","Finalização em atraso", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) em análise com atraso e finalização em atraso <br> 
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Concluído Em andamento"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao2($r->CPF,"Concluído", "Em andamento", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) com análise concluída no prazo e finalização ainda no prazo <br>
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Concluído Finalização em atraso"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao2($r->CPF,"Concluído", "Finalização em atraso",$conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) com análise concluída no prazo, mas a finalização em atraso <br>
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Concluído com atraso Em andamento"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao2($r->CPF,"Concluído com atraso","Em andamento", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) com análise concluída com atraso e finalização no prazo <br>
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Concluído com atraso Finalização em atraso"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao2($r->CPF,"Concluído com atraso","Finalização em atraso", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) com análise concluída com atraso e finalização em atraso <br>
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Concluído Finalizado"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao2($r->CPF,"Concluído","Finalizado", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) analisado(s) e finalizado(s) no prazo <br>
								<a href="processos-todos.php?sessionId=<?php echo $num ?>&filtro= <?php echo $r -> nome ?> Concluído com atraso Finalizado com atraso"><b><?php $numero_total = retorna_numero_processos_pessoa_situacao2($r->CPF,"Concluído com atraso","Finalizado com atraso", $conexao_com_banco); if($total!=0){$porcentagem = ($numero_total/$total)*100;$porcentagem=number_format($porcentagem, 1) ;echo $numero_total . " (" . $porcentagem . "%)" ;}else{echo $numero_total;} ?></b></a> processo(s) analisado(s) e finalizado(s) com atraso<br>
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
