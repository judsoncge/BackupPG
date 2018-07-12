<?php 
include('../head.php');
include('../body.php');
?>
<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/js_responsiveslides.js"></script>
<link rel="stylesheet" href="<?php echo $ROOT ?>/interface/css/responsiveslides.css">

   
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">

	<div class="container menu-home">
		<div class="btn-group" role="group" aria-label="...">
              <a href="noticias.php"><button type="button" class="btn botao-comunicacao">Todas</button></a>
              <a href="cgenews.php"><button type="button" class="btn botao-comunicacao">CGE News</button></a>
              <a href="comunicacao-externa.php"><button type="button" class="btn botao-comunicacao">Comunicação Externa</button></a>
              <a href="rede-social.php"><button type="button" class="btn botao-comunicacao">Rede Social</button></a>
              <a href="cge-em-movimento.php"><button type="button" class="btn botao-comunicacao-ativo">CGE em Movimento</button></a>
              <a href="mural-comunicacao-interna.php"><button type="button" class="btn botao-comunicacao">Mural de Comunicação Interna</button></a>
              <a href="se-vira-nos-5.php"><button type="button" class="btn botao-comunicacao">Se vira nos 5</button></a>   
	   </div>
	</div>   
    
    <div class="container caixa-conteudo">
	    
        <?php $lista = retorna_comunicacoes_tipo("CGE em Movimento", "Submetida", $conexao_com_banco);
        while($r = mysqli_fetch_object($lista)){ ?>
        <div class="col-md-4">
		<?php 
			
			$lista2 = retorna_anexos_comunicacao($r -> CD_COMUNICACAO,$conexao_com_banco);
			while($r2 = mysqli_fetch_object($lista2)){
			
			$imagem = $r2->NM_ARQUIVO;
			
			}?>
            <div class="card" style="background-image: url('../registros/fotos-noticias/<?php echo $imagem ?>');">
                <div class="card-moldura">
                    <p class="card-texto" data-toggle="modal" data-target="#<?php echo $r->CD_COMUNICACAO ?>"><?php echo $r->NM_TITULO ?></p>
                </div>
            </div>
        </div>
       
	
    
        <!-- Modal -->
        <div id="<?php echo $r->CD_COMUNICACAO ?>" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-title">
                    <center><p class="comunicacao-cabecalho"><?php echo $r->NM_TITULO ?></p></center>
                   <img src="../../registros/fotos-noticias/<?php echo $imagem ?>"/ class="modal-card-foto">  
                </div>
              </div>
            <!--    
              <div class="modal-body">
                <p>Some text in the modal.</p>
              </div>
              <div class="modal-foot">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            -->
        </div>

      </div>
    </div>
	<?php } ?>
  </div> 
</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->


<?php include('../foot.php')?>
