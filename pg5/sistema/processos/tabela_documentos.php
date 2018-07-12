<div class="row linha-modal-processo">
	<b>Documentos do processo</b>:<br>
	<table class="table table-hover tabela-dados">
		<thead>
			<tr>
				<th><center>Número</center></th>
				<th><center>Tipo</center></th>
				<th><center>Criador</center></th>
				<th><center>Data de criação</center></th>
				<th><center>Baixar</center></th>
				<th><center>Ação</center></th>
			</tr>	
		</thead>
		<tbody>
			<?php 
			$contador = 1;
			while($documento = mysqli_fetch_object($lista_documentos)){
				$id_documento = $documento->ID;
				$tipo         = $documento->NM_TIPO;
				$nome_criador = retorna_nome_servidor($documento->ID_SERVIDOR_CRIACAO, $conexao_com_banco);
				$data_criacao = date_format(new DateTime($documento->DT_CRIACAO), 'd/m/Y');
				$nome_anexo   = $documento->NM_ANEXO;
				//para download
				$caminho = "../../registros/anexos/".$nome_anexo;
				 ?>
				
				<tr>
					<td><center><?php echo $contador;     ?></center></td>
					<td><center><?php echo $tipo;         ?></center></td>
					<td><center><?php echo $nome_criador; ?></center></td>
					<td><center><?php echo $data_criacao; ?></center></td>
					<td>
						<center>
							<a href="<?php echo $caminho ?>" title="<?php echo $nome_anexo; ?>" download><?php echo substr($nome_anexo, 0, 20) . "..." ; ?></a>   
						</center>
					</td>
					<td><center>
					<?php if($ativo 
					and ($_SESSION['id']==$documento->ID_SERVIDOR_CRIACAO
					
					or $_SESSION['funcao'] == 'TI'
					
					or $_SESSION['funcao'] == 'SUPERINTENDENTE'
					
					or $_SESSION['funcao'] == 'TÉCNICO ANALISTA CORREÇÃO') 
					
					){ ?> 
					
						<a href="logica/editar.php?operacao=excluir_documento&id=<?php echo $id ?>&id_documento=<?php echo $id_documento ?>&nome_documento=<?php echo $nome_anexo ?>">Excluir
						</a></center>
						
					<?php } ?>
					
					</td>
				</tr>
			<?php $contador++; } ?>
		</tbody>
	</table>
</div>