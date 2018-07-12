<div class="well">
	<center>
		<form>
			<div class="row">						
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Filtro de servidor</label><br>
						<select id="filtroservidor" name="filtroservidor" >
							<option value="%">Todos</option>
							<?php 
							
							$lista_servidores = retorna_servidores_status_filtro("ATIVO", $conexao_com_banco);
							
							while($servidor = mysqli_fetch_object($lista_servidores)){ ?>
							
							<option value="<?php echo $servidor->ID ?>"><?php echo $servidor->NM_SERVIDOR ?></option>

							<?php } ?>
					
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Filtro de setor</label><br>
							<select id="filtrosetor" name="filtrosetor" >
								<option value="%">Todos</option>
								<?php 
								
								$lista_setores = retorna_setores_filtro($conexao_com_banco);
								
								while($setor = mysqli_fetch_object($lista_setores)){ ?>
								
								<option value="<?php echo $setor->ID ?>"><?php echo $setor->NM_SETOR ?></option>

								<?php } ?>
							
							</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Filtro de situação</label><br>
							<select id="filtrosituacao" name="filtrosituacao" >
								<option value="%">Todos</option>
								<option value="0">DENTRO DO PRAZO</option>
								<option value="1">ATRASADO</option>
								
							
							</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="exampleInputEmail1">Sobrestado</label><br>
						<select id="filtrosobrestado" name="filtrosobrestado" >
							<option value="%">Todos</option>
							<option value="0">Não</option>
							<option value="1">Sim</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-group margin-bottom-sm">
							<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Busque pelo numero do processo" id="filtroprocesso" name="filtroprocesso" autofocus="autofocus" />
						</div>
					</div>	
				</div>
			</div>
		</form>
	</center>
</div>

