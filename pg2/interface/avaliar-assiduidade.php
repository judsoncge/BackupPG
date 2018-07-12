<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php'); 
include('body.php');
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container ">
        <div class="row">
            <div class="col-md-12">
                <p class="titulo-pagina">Avaliar assiduidade</p>
            </div>                
		</div>
		<div class="container caixa-conteudo">
            <form name="cadastro" method="POST" action="../componentes/indice-produtividade/logica/cadastrar.php?sessionId=<?php echo $num ?>&operacao=assiduidade" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="item-avalia-tecnico">
                                <div class="row">
                                    <div class="col-md-6">
										<div class="form-group">
											<label class="control-label" for="exampleInputEmail1">Servidor a ser avaliado</label>
											<select class="form-control" id="avaliado" name="avaliado" required/>
												<option value="">Selecione o servidor</option>
												<?php $lista = retorna_servidores_avaliados($conexao_com_banco);
												while($r = mysqli_fetch_object($lista)){ ?>
												<option value="<?php echo $r->CD_SERVIDOR ?>"><?php echo $r->NM_SERVIDOR ?></option><?php } ?>
											</select>
										</div>	
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="exampleInputEmail1">Referente ao mês de:</label>
										<select class="form-control" id="mes" name="mes" required/>
											<option value="">Selecione o mês</option>
											<option value="01">Janeiro</option>
											<option value="02">Fevereiro</option>
											<option value="03">Março</option>
											<option value="04">Abril</option>
											<option value="05">Maio</option>
											<option value="06">Junho</option>
											<option value="07">Julho</option>
											<option value="08">Agosto</option>
											<option value="09">Setembro</option>
											<option value="10">Outubro</option>
											<option value="11">Novembro</option>
											<option value="12">Dezembro</option>
										</select>
                                    </div>
									<div class="col-md-3">
                                        <label class="control-label" for="exampleInputEmail1">Referente ao ano:</label>
										<select class="form-control" name="ano" required/>
											<option value="">Selecione o ano</option>
											<?php $i = date('Y'); while($i >= 2016 ){ ?>
												<option value="<?php echo $i ?>"><?php echo $i ?></option>
											<?php $i--;} ?>
										</select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                	<div class="col-md-2">
                                        <label class="control-label" for="exampleInputEmail1">Horas esperadas:</label>
                                        <input class="form-control" id="horas_esperadas" name="horas_esperadas" type="number"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" for="exampleInputEmail1">Horas trabalhadas:</label>
                                        <input class="form-control" id="trabalhadas" name="trabalhadas" type="number"/>
                                    </div>
                                
                                    <div class="col-md-2">
                                        <label class="control-label" for="exampleInputEmail1">Horas abonadas:</label>
                                        <input class="form-control" id="abonadas" name="abonadas" placeholder="" type="number"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="exampleInputEmail1">Justificativa:</label>
                                        <input maxlength='100' class="form-control" id="justificativa" name="justificativa" placeholder="Informe os motivos do abono das horas apontadas" type="text"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="row" id="cad-button">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-default" name="submit" value="Send" id="submit" style="margin-left:10px;">Cadastrar</button>
                    </div>
                </div>    
            </form>    

        
    </div>
</div>		
</div>
</div>


<!-- /#Conteúdo da Página/-->


<!-- /#wrapper -->

<!-- chamando o bootstrap novamente para o modal funcionar -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript" src="js/avaliar_tecnico.js"></script>

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>



<?php include('foot.php')?>