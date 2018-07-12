<!DOCTYPE html>
<html>
	<?php 
		session_start();
		include("banco-dados/conectar.php"); 
		include("funcoes.php");
		
		if(!isset($_SESSION["numLogin"])){
				$num = $_SESSION["numLogin"];
				header("Location: $ROOT/index.php");
		}
	?>
<head>
	<!-- metadados -->
	<meta charset="utf-8">
	<meta name="interfaceport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="pt-br">
	<meta name="keywords" content="cge, controladoria geral do estado, estado de alagoas, alagoas">
	<meta name="description" content="cge, controladoria geral do estado de alagoas">
	<link rel="shortcut icon" href="<?php echo $ROOT ?>interface/img/shortcut.ico">
	<meta name="interfaceport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Denys Rocha">
	<meta name="author" content="Judson Bandeira">
	<meta name="author" content="Vilker Tenório">

	<title>Painel de Gestão - CGE</title>

	<!-- imports -->
	

	<link rel="stylesheet" type="text/css" href="<?php echo $ROOT ?>/interface/css/font-awesome.min.css" >
	<script src="<?php echo $ROOT ?>/interface/js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $ROOT ?>/interface/css/bootstrap.css">
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo $ROOT ?>/interface/css/simple-sidebar.css">
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/submenu.js"></script>
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jquery.maskedinput.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $ROOT ?>/interface/css/estilo.css?version=12">
	<link rel="stylesheet" type="text/css" href="<?php echo $ROOT ?>/interface/css/multiple-select.css">
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/multiple-select.js"></script>
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $ROOT ?>/interface/css/jquery-ui.min.css">
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/jquery.quicksearch.js"></script>
	<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/util.js"></script>
	
	<script type="text/javascript">
	 var url = window.location.href.indexOf('/pg/') == -1 ? window.location.href.substring(0, window.location.href.indexOf('/',7)) : window.location.href.substring(0, window.location.href.indexOf('/pg/') + 4);

	</script>

	<script type="text/javascript">
		$(document).ready(function(){
	    //Esconde preloader
	    $(window).load(function(){
	        $('#preloader').fadeOut(1500);//1500 é a duração do efeito (1.5 seg)
	    	});
	    $(window).load(function(){
	        $('#bg-loader').fadeOut(1500);//1500 é a duração do efeito (1.5 seg)
	    	});
	    $(window).load(function(){
	        $('#mensagem_sucesso').fadeOut(4000);//1500 é a duração do efeito (1.5 seg)
	    	});
	    $(window).load(function(){
	        $('#mensagem_erro').fadeOut(4000);//1500 é a duração do efeito (1.5 seg)
	    	});
		});
		
		

		
		
		
	</script>
	
</head>