<?php 
$lista = retorna_assuntos($conexao_com_banco); 
while($r = mysqli_fetch_object($lista)){ ?> 
	  <option value="<?php echo $r->ID?>"><?php echo $r->NM_ASSUNTO?></option> 
<?php } ?>