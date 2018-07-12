<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<center><p>Bem vindo ao Painel de Gestão, <?php echo $_SESSION["nome"] ?>!</p>
<p>Para iniciar, selecione um item no menu a esquerda.</p></center>

  <!--<div class="container caixa-conteudo">
    <div class="row">
      <div class="col-md-12" style="margin-left: 20px;">
        Informação 1
      </div>
    </div>
    <div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-ativos" >
		Informação 2
		</div>
      </div>
      <div class="col-md-6">
        <div class="grafico" id="processos-analise">
		Informação 3
		</div>
      </div>
    </div>  
    <div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao">
		Informação 4
		</div>
      </div>
	  <div class="col-md-6">
        <div class="grafico" id="processos-arquivados-e-saiu">
		Informação 5
		</div>
      </div>
		</div>
      </div>
</div>-->

<script type="text/javascript">
  /*menu lateral*/
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>
