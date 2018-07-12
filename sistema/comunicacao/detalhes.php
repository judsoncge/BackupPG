<?php 
include('../head.php');
include('../body.php');
if($_SESSION['funcao'] != 'COMUNICAÇÃO' and $_SESSION['funcao'] != 'TI'){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home.php?mensagem=Você não tem permissão para acessar essa página.&resultado=falha'>";
}
$id = $_GET['id']; 
$tabela = "tb_comunicacao";
include('../includes/verificacao-id.php');
$informacoes = retorna_informacoes($tabela, $id, $conexao_com_banco);
?>


<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/js_responsiveslides.js"></script>
<link rel="stylesheet" href="<?php echo $ROOT ?>/interface/css/responsiveslides.css">
<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
</script>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Detalhes de <?php echo $informacoes['NM_CHAPEU'] . " (" . $informacoes['NM_STATUS'] . ")" ?></p>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
							<?php 
							
							include('botoes.php');
							
							include('noticia.php');
							
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->

<?php include('../foot.php')?>