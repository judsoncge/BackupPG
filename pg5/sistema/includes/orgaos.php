<?php 
$lista = retorna_orgaos($conexao_com_banco); 
while($r = mysqli_fetch_object($lista)){ ?> 
	  <option value="<?php echo $r->ID?>"><?php echo "<b>" . $r->CD_ORGAO . "</b> - " . $r->NM_ORGAO?></option> 
<?php } ?>