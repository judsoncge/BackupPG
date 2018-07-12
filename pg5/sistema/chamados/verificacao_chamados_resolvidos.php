<?php 
//se não for TI e tiver chamados resolvidos sem nota, o usuario nao podera abrir um novo chamado se nao der a nota antes
if($_SESSION['funcao']!='TI'){ ?>

		<div class="col-sm-10">
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Busque por qualquer termo da tabela" id="search" autofocus="autofocus" />
			</div>
		</div>
		<?php 
		$n = retorna_numero_chamados_resolvidos_sem_nota($_SESSION['id'], $conexao_com_banco);
		if($n == 0){ ?>
			
			<div class="col-sm-2 pull-right">
				<a href="cadastrar.php" id="botao-cadastrar">
				<i class="fa fa-plus-circle"></i> Novo chamado</a>
			</div>
			
		<?php } elseif($n > 0) { ?>
			<br><br>
			<center>
				<div class="alert alert-warning">
				Você tem <?php echo $n ?> chamado(s) sem nota. Eles estão destacados em amarelo. Dê nota para o(s) que falta(m) e depois você poderá abrir um chamado.
				</div>
			</center>
			
		<?php //se for TI e tiver chamados resolvidos com nota, aparecera um aviso com a quantidade de chamados que ele precisa encerrar
			}	
	} else{ ?>
		<div class="col-sm-12">
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Busque por qualquer termo da tabela" id="search" autofocus="autofocus" />
			</div>
		</div>
		<?php
		$p = retorna_numero_chamados_resolvidos_com_nota($conexao_com_banco);
		if($p > 0){ ?>
			<br><br>
			<center>
				<div class="alert alert-warning">
				Você tem <?php echo $p ?> chamado(s) resolvidos com nota. Eles estão destacados em amarelo. Encerre-os, por favor.
				</div>
			</center>		
	<?php 
		}
	} 
?>