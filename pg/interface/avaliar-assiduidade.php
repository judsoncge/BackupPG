<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('header.php'); 
include('body-padrao.php');
//$data = retorna_avaliacao_feita($_POST['data_avaliacao'], $_POST['avaliado']);
//echo $data;

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
            <form name="cadastro" method="POST" action="../componentes/indice-produtividade/assiduidade/logica/cadastrar.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="item-avalia-tecnico">
                                <div class="row">
                                    <div class="col-md-6">
										<div class="form-group">
											<label class="control-label" for="exampleInputEmail1">Servidor a ser avaliado</label>
											<select class="form-control" id="avaliado" name="avaliado" required/>
												<option value="">Selecione o servidor</option>
												<?php $lista = retorna_avaliar($conexao_com_banco);
												while($r = mysqli_fetch_object($lista)){ ?>
												<option value="<?php echo $r->CPF ?>"><?php echo $r->nome ?></option><?php } ?>
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
											<option value="2016">2016</option>
											<option value="2017">2017</option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
											<option value="2028">2028</option>
											<option value="2029">2029</option>
											<option value="2030">2030</option>
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



<?php include('footer.php')?>