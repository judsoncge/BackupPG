<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php'); 
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_avaliacao_editar.php'); 
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
        <p>Edição do Índice de Produtividade </p>
    </div>
<div class="container caixa-conteudo">
  <div class="row">
     <div class="col-lg-12">
        <div class="container">
         <form name="cadastro" method="POST" action="../componentes/indice-produtividade/logica/editar.php?id=<?php echo $id ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <center>
                        <div class='col-md-3'>
                            <div class='box-avalia-tecnico'>
                                <img src='../registros/fotos/<?php echo $servidor_avaliado_foto ?>' class='avalia-tecnico-img'>
                            </div>

                        </div>

                    </center>
                    </div>
                    <div class="col-md-4">
                        <center>
                            <div class="box-avalia-tecnico-nota">
                                <div class='nome-avalia-tecnico'><?php echo $servidor_avaliado_nome ?></div>
                                <div class="nota-avalia-tecnico"><?php echo number_format($media_final, 1, ',', '.'); ?></div>
                            </div>    
                        </center>
                    </div>
                    <div class="col-md-4">
                        <center>
                            <div class="box-avalia-tecnico-nota">
                                <div class='nome-avalia-tecnico'><?php $setor = retorna_setor_pessoa($servidor_avaliado, $conexao_com_banco); echo $setor; ?></div>
                                <div class="nota-avalia-tecnico"><?php $media = retorna_media_nota_setor($setor, $conexao_com_banco); echo number_format($media, 1, ',', '.'); ?></div>
                            </div>    
                        </center>    
                    </div>

                </div>

                
                    <div class="row">
                        <div class="col-md-4">
                            <div class="item-avalia-tecnico">
                                <center><h5>Assiduidade</h5></center><br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Horas esperadas:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $ass1 ?>" id="ass1" name="ass1" placeholder="" type="number" maxlength="" onblur="assiduidade();"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Horas trabalhadas:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $ass2 ?>" id="ass2" name="ass2" placeholder="" type="number" maxlength="" onblur="assiduidade();"/>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $ass_result ?>" id="ass_result" name="ass_result" type="number" step=0.1 readonly/>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-avalia-tecnico">
                                <center><h5>Cumprimento de prazos</h5></center><br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Entregues em dia:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $cum1 ?>" id="cum1" name="cum1" placeholder="" type="number" maxlength="" onblur="cumprimentoDePrazo();"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Entregues em atraso:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $cum2 ?>" id="cum2" name="cum2" placeholder="" type="number" maxlength="" onblur="cumprimentoDePrazo();"/>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $cum_result ?>" id="cum_result" name="cum_result" type="number" type="number" step=0.1 readonly/>
                                        <!--<div id="cum_result"></div>-->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-avalia-tecnico">
                                <center><h5>Legislação</h5></center><br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Citou a legislação:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $leg1 ?>" id="leg1" name="leg1" placeholder="" type="number" maxlength="" onblur="legislacao();"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Não citou a legislação:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $leg2 ?>" id="leg2" name="leg2" placeholder="" type="number" maxlength="" onblur="legislacao();"/>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" value="<?php echo $leg_result ?>" id="leg_result" name="leg_result" type="number" type="number" step=0.1 readonly/>
                                        <!--<div id="cum_result"></div>-->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="item-avalia-tecnico" style="margin-left:14px; margin-right:12px; margin-top:10px;">
                        <center><h5>Softwares de Escritório</h5></center><br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="item-avalia-tecnico">
                                    <center><h5>Microsoft Word</h5></center><br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Dentro do padrão:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $word1 ?>" id="word1" name="word1" placeholder="" type="number" maxlength="" onblur="softwareEscritorio();"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Fora do padrão:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $word2 ?>" id="word2" name="word2" placeholder="" type="number" maxlength="" onblur="softwareEscritorio();"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $word_result ?>" id="word_result" name="word_result" type="number" step=0.1 readonly/>
                                            <!--<div id="cum_result"></div>-->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="item-avalia-tecnico">
                                    <center><h5>Microsoft Excel</h5></center><br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Dentro do padrão:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $excel1 ?>" id="excel1" name="excel1" placeholder="" type="number" maxlength="" onblur="softwareEscritorio();"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Fora do padrão:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $excel2 ?>" id="excel2" name="excel2" placeholder="" type="number" maxlength="" onblur="softwareEscritorio();"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $excel_result ?>" id="excel_result" name="excel_result" type="number" step=0.1 readonly/>
                                            <!--<div id="cum_result"></div>-->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="item-avalia-tecnico">
                                    <center><h5>Microsoft Power Point</h5></center><br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Dentro do padrão:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $power1 ?>" id="power1" name="power1" placeholder="" type="number" maxlength="" onblur="softwareEscritorio();"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Fora do padrão:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $power2 ?>" id="power2" name="power2" placeholder="" type="number" maxlength="" onblur="softwareEscritorio();"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" value="<?php echo $power_result ?>" id="power_result" name="power_result" type="number" step=0.1 readonly/>
                                            <!--<div id="cum_result"></div>-->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-1">
                                <label class="control-label" for="exampleInputEmail1">Nota:</label>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" value="<?php echo $soft_result ?>" id="soft_result" name="soft_result" type="number" step=0.1 readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                        <div class="item-avalia-tecnico">
                            <center><h5>Softwares de uso da CGE</h5></center><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Usou dados do sistema:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $soft_cge1 ?>" id="soft_cge1" name="soft_cge1" placeholder="" type="number" maxlength="" onblur="softwareCGE();"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Não usou:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $soft_cge2 ?>" id="soft_cge2" name="soft_cge2" placeholder="" type="number" maxlength="" onblur="softwareCGE();"/>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $soft_result ?>" id="soft_cge_result" name="soft_cge_result" type="number" step=0.1 readonly/>
                                    <!--<div id="cum_result"></div>-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item-avalia-tecnico">
                            <center><h5>Proatividade</h5></center><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Total de atividades:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $pro1 ?>" id="pro1" name="pro1" placeholder="" type="number" maxlength="" onblur="proatividade();"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Foi proativo em:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $pro2 ?>" id="pro2" name="pro2" placeholder="" type="number" maxlength="" onblur="proatividade();"/>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $pro_result ?>" id="pro_result" name="pro_result" type="number" step=0.1 readonly/>
                                    <!--<div id="cum_result"></div>-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item-avalia-tecnico">
                            <center><h5>Relacionamento Interpessoal</h5></center><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Já avaliaram:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $rel_inter1 ?>" id="rel_inter1" name="rel_inter1" type="number" step=0.1 readonly value="0" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Faltam avaliar:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $rel_inter2 ?>" id="rel_inter2" name="rel_inter2" type="number" step=0.1 readonly value="0" />
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="exampleInputEmail1">Nota:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="<?php echo $rel_inter_result ?>" id="rel_inter_result" name="rel_inter_result" type="number" step=0.1 readonly value="0" />
                                    <!--<div id="cum_result"></div>-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row" id="cad-button">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-default" name="submit" value="Send" id="submit" style="margin-left:10px;">Atualizar</button>
                    </div>
                </div>    
            </form>    

        </div>
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