<?php 
include('../head.php');
include('../body.php');
$informacoes = retorna_permissoes_servidor($_GET['servidor'], $conexao_com_banco);
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Editar permissões de <?php echo retorna_nome_servidor($_GET['servidor'], $conexao_com_banco); ?></p>
</div>
<div class="container caixa-conteudo">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="logica/editar.php?operacao=permissao&pessoa=<?php echo $_GET['servidor']?>" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="form-group">
						<div class="checkbox">
							<center><label class="control-label" for="exampleInputEmail1">O que o usuário poderá fazer?</label><br><br><br><a href="javascript:cadastrar_marcar()">Tudo</a> ou <a href="javascript:cadastrar_desmarcar()">Nenhum</a><br><br></center>
							<center><div class="row">
								<div class="col-md-6">
									<?php foreach($informacoes as $val){ ?>
										
										<?php if ($val->name!='ID' and $val->name!='CD_SERVIDOR'){ 
											$name = retorna_permissao($_GET['servidor'], $val->name, $conexao_com_banco); ?>
											
											<p><input type="checkbox" class="cadastra" name="<?php echo $val->name ?>" <?php if($name=='sim'){?> checked <?php } ?>><?php echo $val->name ?></input></p>
											
										<?php } ?>
										
									<?php } ?>
								</div>
							</div></center>
							<div class="row">			
								<div class="col-md-12">
									<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Atualizar permissões</button>
								</div>
							</div>	

						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>