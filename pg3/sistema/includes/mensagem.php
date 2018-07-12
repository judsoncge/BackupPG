<div>
<?php 
if(isset($_GET['mensagem'])){
	
	if($_GET['resultado']=='sucesso'){
		echo '<div class="alert alert-success" role="alert" id="mensagem_sucesso">'.$_GET['mensagem'].'</div>';
	}else if($_GET['resultado']=='falha'){
		echo '<div class="alert alert-danger" role="alert" id="mensagem_erro">'.$_GET['mensagem'].'</div>';
	}else if($_GET['resultado']=='info'){
		echo '<div class="alert alert-warning" role="alert" id="mensagem_aviso">'.$_GET['mensagem'].'</div>';
	}
}
?>
</div>