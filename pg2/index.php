<html>

<!-- Verifica se o usuário já está logado no sistema. Se sim, redireciona-o para home -->
<?php 
	session_start();
	
	if(isset($_SESSION["numLogin"])){
		$num = $_SESSION["numLogin"];
		header("Location: interface/home.php?sessionId=$num");
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
	<link rel="shortcut icon" href="interface/img/shortcut.ico">
	<meta name="interfaceport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Denys Rocha">
	<meta name="author" content="Judson Bandeira">

	<title>Gestão CGE</title>

	<!-- imports -->
	<link rel="stylesheet" type="text/css" href="interface/css/font-awesome.min.css" >
	<link rel="stylesheet" type="text/css" href="interface/css/bootstrap.css">
	<script type="text/javascript" src="interface/js/bootstrap.js"></script>
	<script src="interface/js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="interface/css/simple-sidebar.css">
	<script type="text/javascript" src="interface/js/submenu.js"></script>
	<script type="text/javascript" src="interface/js/jquery.maskedinput.js"></script>
	<link rel="stylesheet" type="text/css" href="interface/css/estilo.css">
	
	<!-- script de máscaras -->
	<script type="text/javascript">
		jQuery(function($){  
			$("#CPF").mask("999.999.999-99");
		});
	</script>

</head>

<!-- Campos para login -->
<body style="background-color:rgba(41, 128, 185,1.0);">
	<div class="container" id="container-index" style="max-width: 1400px;">
		<div id="sub-container-index">
			<div class="logo" >
				<center>
					<div class="row">
						<img src="interface/img/logo-governo.png" id="logo-governo">
					</div>
					<div class="row">
						<img class="img-responsive" src="interface/img/gestao-cge-index2.png" id="logo-gestao-cge">
						<span><img src="interface/img/gestao-cge-index3.png" id="logo-gestao-cge-mobile"></span>	
					</div>
				</center>
			</div>
			<div class="login">
				<div class="row">
					<form  name="form-login" method="POST" action="componentes/sessao/verificar-login.php">
						<div class="col-md-5" id="campo-login">
							<input type="text" class="form-control" placeholder="CPF" name="CPF" id="CPF" required>
						</div>
						<div class="col-md-5" id="campo-senha">
							<input type="password" class="form-control" placeholder="Senha" aria-describedby="sizing-addon3" name="senha" required>
						</div>
						<div class="col-md-2">
							<center><button type="submit" class="btn btn-large" id="botao-entrar">ENTRAR</button></center>
						</div>
					</form>
					<div class="col-md-12" style="margin-top:10px;">
							<?php if(isset($_GET['mensagem'])){ echo "<div style='position: relative; color:yellow';>CPF ou senha inválidos. Tente novamente.</div>";  } ?>
					</div>
				</div>	
			 </div>

		</div>
	</div>
	
	</body>
</html>	
