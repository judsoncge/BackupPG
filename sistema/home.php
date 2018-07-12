<?php 
include('head.php');
include('body.php');
$data = date("Y-m-d");
?>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.12&appId=2008844572700318&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<?php include('includes/mensagem.php'); ?>
	<p>
		<center><h2>Bem vindo(a) ao Painel de Gestão, <br><?php echo $_SESSION['nome']?>!</h2></center>
	</p>
	
	<div class="row linha-grafico">
		<div class="col-md-6">
				<div class="grafico" id="processos-ativos" >
					<b>Principais notícias</b>: <br><br>
						
					<?php 
						$lista = retorna_cinco_comunicacoes_publicadas($conexao_com_banco);
							
						while($noticia = mysqli_fetch_object($lista)){ 
						
						echo "<font size='2px'>
							(" . date_format(new DateTime($noticia->DT_PUBLICACAO) , 'd/m/Y H:i') . ")
								</font>"; ?>
						<br>
						<a href="comunicacao/ver-noticia.php?id=<?php echo $noticia->ID ?>">
							<h3><?php echo $noticia->NM_TITULO ?></h3>
						</a>
						
							<font size="2px"><?php echo substr($noticia->NM_INTERTITULO, 0, 79) . "..." ?></font>	
						<br>
						<br>
						
						<?php } ?>
						
						<center><a href="comunicacao/ver-todas-noticias.php">Ver todas</a></center>
				</div>
		  </div>
		 
		  <div class="col-md-6">
				<center>
					<div class="fb-page" data-href="https://www.facebook.com/ControladoriaGeralAL/" data-tabs="timeline" data-width="600" data-height="685" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ControladoriaGeralAL/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ControladoriaGeralAL/">CGE - AL</a></blockquote></div>
				
				</center>
		 </div>
	</div>
	 
	
</div>
