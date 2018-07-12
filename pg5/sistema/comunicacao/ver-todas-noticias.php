<?php 
include('../head.php');
include('../body.php');
$data = date("Y-m-d");
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">	
	<div class="row linha-grafico">
		<div class="grafico" id="processos-ativos" >
			<b>Todas as notícias</b>: <br><br>
				
			<?php 
				$lista = retorna_comunicacoes_publicadas($conexao_com_banco);
					
				while($noticia = mysqli_fetch_object($lista)){ 
				
				echo "<font size='2px'>
					(" . date_format(new DateTime($noticia->DT_PUBLICACAO) , 'd/m/Y H:i') . ")
						</font>"; ?>
				<br>
				<a href="comunicacao/ver-noticia.php?id=<?php echo $noticia->ID ?>">
					<h3><?php echo $noticia->NM_TITULO ?></h3>
				</a>
				<br>
					<font size="2px"><?php echo $noticia->NM_INTERTITULO ?></font>	
				<br>
				<br>
				
				<?php } ?>
		</div>
	</div>
	 
	
</div>
