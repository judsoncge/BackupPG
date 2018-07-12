<!DOCTYPE html>
<html>
<head>
	<!-- metadados -->
	<meta charset="utf-8">
	<meta name="interfaceport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="pt-br">
	<!-- <meta http-equiv="refresh" content="10"/> -->
	<meta name="keywords" content="cge, controladoria geral do estado, estado de alagoas, alagoas">
	<meta name="description" content="cge, controladoria geral do estado de alagoas">
	<link rel="shortcut icon" href="img/gestao-cge.ico">
	<meta name="interfaceport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Denys Rocha">
	<meta name="author" content="Judson Bandeira">

	<title>Gestão CGE</title>

	<!-- imports -->
	
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" >
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	
	<script src="js/jquery.js"></script>
	<!--<script src="js/jquery-3.0.0.min.js"></script>-->
		
	<link rel="stylesheet" type="text/css" href="css/simple-sidebar.css">
	<script type="text/javascript" src="js/submenu.js"></script>
	<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/multiple-select.css">
	<script type="text/javascript" src="js/multiple-select.js"></script>
	<!-- script de máscaras -->
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<!-- script para múltiplos filtros. o resto está no foot.php -->
	<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
	
	
	
	<script type="text/javascript">
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-84014368-1', 'auto');
	  ga('send', 'pageview');

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
	    $(window).load(function(){
	        $('#mensagem_aviso').fadeOut(4000);//1500 é a duração do efeito (1.5 seg)
	    	});
		});
	</script>
	
	
	<script type="text/javascript">
		jQuery(function($){ 
			$("#matricula").mask("999999-9"); 
			$("#cnpj").mask("99.999.999/9999-99");
			
			$("#numero_contrato_siafem").mask("9999999"); 
			$("#n_processo_integra").mask("99999 999999/9999");
			$("#CPF").mask("999.999.999-99");
			$("#numero-fixo").mask("(99)9999-9999");
			$("#numero-movel").mask("(99)99999-9999");
			$("#renavam").mask("999999999-9");
			$("#placa").mask("aaa-9999");
			$("#termo_cessao").mask("999/9999");
			hoje = new Date();
			ano = hoje.getFullYear();
			$("#empenho").mask(""+ano+"NE99999");
			$("#bancaria").mask(""+ano+"OB99999");
			$("#portaria").mask("999/"+ano+"");
			$("#doc_aquisicao").mask("N.F. "+"99999");
			
		});
	</script>

	<script type="text/javascript">
		function validarSenha() {
			if($("#senha").value() != $("#senha2").value()){
				alert("As senhas não conferem!");
			}
		}
	</script>
	
	<script>
	   function cadastrar_marcar(){
	   boxes = document.getElementsByClassName('cadastra');
	   for(var i = 0; i < boxes.length; i++)
	   boxes[i].checked = true;
	   }
   </script> 
   
    <script>
	function cadastrar_desmarcar(){
					boxes = document.getElementsByClassName('cadastra');
					for(var i = 0; i < boxes.length; i++)
					  boxes[i].checked = false;
	}
	</script>
	
	<script type="text/javascript">
				function mascara(o,f){
						v_obj=o
						v_fun=f
						setTimeout("execmascara()",1)
					}
					function execmascara(){
						v_obj.value=v_fun(v_obj.value)
					}
					function mreais(v){
						v=v.replace(/\D/g,"")						//Remove tudo o que não é dígito
						v=v.replace(/(\d{2})$/,".$1") 			//Coloca a virgula
						//v=v.replace(/(\d+)(\d{3},\d{2})$/,"$1$2") 	//Coloca o primeiro ponto
						return v
				}
	</script>
	
	<script type="text/javascript">
	function verifica_data(data1, data2){
						var data_1 = document.getElementById(data1).value;
						var data_2 = document.getElementById(data2).value;

						var Compara01 = parseInt(data_1.split("-")[2].toString() + data_1.split("-")[1].toString() + data_1.split("-")[0].toString());
						var Compara02 = parseInt(data_2.split("-")[2].toString() + data_2.split("-")[1].toString() + data_2.split("-")[0].toString());

						if ((Compara01 < Compara02) || (Compara01 == Compara02) ) {
							document.getElementById("msg").innerHTML = "Data válida!";     
						}else{
							document.getElementById("msg-"+data2).innerHTML = "<div style='color:#FF6347'>Esta data não pode ser menor!</div>";   
							document.getElementById(data2).value=''; 							
							return false;    
							}
					}
	function pegar_parametro_query(nome, url) {
		if (!url) url = window.location.href;
		nome = nome.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + nome + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
	</script>
			
	<?php 
	include('../componentes/banco-dados/conectar.php'); 
	include("../nucleo-aplicacao/arrumar_dados.php");
	include("../nucleo-aplicacao/retornar_dados.php");
	include("../nucleo-aplicacao/verifica_dados.php");
	$nome = retorna_nome_servidor($_SESSION['CPF'],$conexao_com_banco);
	$foto = retorna_foto_servidor($_SESSION['CPF'],$conexao_com_banco);
	?>
	
	

</head>