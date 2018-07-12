<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Tipo</label>
								<select class="form-control" id="tipo" name="tipo" required/>
										<option value="">Selecione a natureza</option>
										<?php $lista = retorna_tipos_despesas($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_DESPESA ?>"><?php echo $r->NM_DESPESA?></option>
										<?php } ?>
								</select>
							</div>	
						</div>