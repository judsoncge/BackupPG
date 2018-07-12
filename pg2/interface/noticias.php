<?php 
include('../componentes/sessao/iniciar-sessao.php');include('head.php'); 
include('body.php');
?>


<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
    
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">

  <div id="natal3"></div>

	<div class="container menu-home">
		<div class="btn-group" role="group" aria-label="...">
              <a href="home.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-comunicacao-ativo">Todas</button></a>
              <a href="cgenews.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-comunicacao">CGE News</button></a>
              <a href="comunicacao-externa.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-comunicacao">Comunicação Externa</button></a>
              <a href="rede-social.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-comunicacao">Rede Social</button></a>
              <a href="cge-em-movimento.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-comunicacao">CGE em Movimento</button></a>
              <a href="mural-comunicacao-interna.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-comunicacao">Mural de Comunicação Interna</button></a>
              <a href="se-vira-nos-5.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-comunicacao">Se vira nos 5</button></a>
              
	   </div>
	</div>   
    
    <div class="container caixa-conteudo">
        <?php $lista = retorna_comunicacoes_submetidas($conexao_com_banco);
        while($r = mysqli_fetch_object($lista)){ $id=$r -> ID;?>
        <div class="col-md-4">
		<?php 
			
			$lista2 = retorna_anexos($id,$conexao_com_banco);
			while($r2 = mysqli_fetch_object($lista2)){
			
			$imagem = $r2->NM_ARQUIVO;
			
			}?>
            <div class="card" style="background-image: url('../registros/fotos-noticias/<?php echo $imagem ?>');">
                <div class="card-moldura">
                    <p class="card-texto" data-toggle="modal" data-target="#<?php echo $id ?>"><?php echo $r->NM_TITULO ?></p>
                </div>
            </div>
        </div>
   
        
    <?php if($r -> NM_ITEM == 'Comunicação Externa' or $r -> NM_ITEM == 'Rede Social' or $r -> NM_ITEM == 'Se vira nos 5'){ ?>
    <!-- Modal -->
     <div id="<?php echo $id ?>" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-title">
                <center><p class="comunicacao-cabecalho"><?php echo $r->NM_TITULO ?></p></center>
					<!--SLIDE-->
                      <ul class="rslides" >
					  <?php $lista3 = retorna_anexos($id, $conexao_com_banco);
					  while($r3 = mysqli_fetch_object($lista3)){ ?>
                        <li class="modal-card-foto2">
                          <img src="../registros/fotos-noticias/<?php echo $r3->NM_ARQUIVO ?>" alt="">
                        </li>
					  <?php } ?>
                      </ul>
                      <!--/SLIDE-->
            </div>
          </div>
           
          <div class="modal-body">
            <p>Publicado em: <?php echo arruma_data($r->DT_PUBLICACAO) ?></p>
            <p><?php echo $r->NM_TEXTO ?></p>
          </div>
    
        </div>

      </div>
    </div>
    <?php } ?>
     
        
        <?php if($r -> NM_ITEM == 'CGE News' or $r -> NM_ITEM == 'CGE em Movimento' or $r -> NM_ITEM == 'Mural de Comunicação Interna'){ ?>	
        <div id="<?php echo $id ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="modal-title">
                            <center><p class="comunicacao-cabecalho"><?php echo $r -> NM_TITULO ?></p></center>
                            <img src="../registros/fotos-noticias/<?php echo $imagem ?>"/ class="modal-card-foto">  
                        </div>
                  </div>
                </div>
            </div>
         </div>	
        <?php } ?>
        
        
        
        
  	<?php } ?>  
	</div> 
</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->

<!-- chamando o bootstrap novamente para o modal funcionar -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/js_responsiveslides.js"></script>
 <link rel="stylesheet" href="css/responsiveslides.css">

<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
</script>


<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
