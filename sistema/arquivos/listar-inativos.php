<?php 
include('../head.php');
include('../body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Meus Arquivos Inativos</p>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">	
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group margin-bottom-sm">
										<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Busque por qualquer termo da tabela" id="search" autofocus="autofocus" />
									</div>
								</div>
							</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th><center>Tipo</center></th>
									<th><center>Criado por</center></th>
									<th><center>Data de criação</center></th>
									<th><center>Baixar</center></th>
								</tr>	
							</thead>
							<tbody>
								<?php 
									$lista = retorna_lista_arquivos_status('INATIVO', $conexao_com_banco);
									while($r = mysqli_fetch_object($lista)){ $id = $r->ID 
								?>
								
								<tr>
									<td>
										<center>
											<?php echo $r->NM_TIPO ?>
										</center>
									</td>
									<td>
										<center>
											<?php echo retorna_nome_servidor($r->ID_SERVIDOR_CRIACAO, $conexao_com_banco) ?>
										</center>
									</td>
									<td>
										<center>
											<?php if($r->DT_CRIACAO != '0000-00-00'){
												echo date_format(new DateTime($r->DT_CRIACAO), 'd/m/Y');
												}else{
													echo "sem data";
												} ?>
										</center>
									</td>
									<td>
										<center>
											<?php 
											$caminho = "../../registros/anexos/".$r->NM_ANEXO; ?>
											
											<a href="<?php echo $caminho ?>" title="<?php echo $r->NM_ANEXO ?>" download><?php echo substr($r->NM_ANEXO, 0, 20) . "..."; ?></a> 
										</center>
									</td>									
								</tr>
							<?php } ?>		
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- informa o número de processos que está "comigo" -->
		<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>
	</div>


<?php include('../foot.php')?>