<html>
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
		<meta name="author" content="Romero Malaquias">

		<title>Executar scripts PG</title>
	</head>

	<!-- Campos para login -->
	<body style="background-color:rgba(41, 128, 185,1.0);">
		<div class="container" id="container-index" style="max-width: 1400px;">
			<div id="sub-container-index">
				<div class="logo" >
					<center>
						<div class="row">
							<span><img src="interface/img/gestao-cge-index3.png" id="logo-gestao-cge-mobile"></span>	
						</div>
					</center>
				<br>
				</div>
				<div class="login">
					<?php 
						ini_set('max_execution_time', 1000);
						//carregando o banco para transformação
						exec('mysql -u root pg2 < pg_depois_do_script.sql');
						
						//executando modificações de atualização
						//exec('mysql -u root pg2 < script_setar_nomes_assunto.sql');
						
						//modificando as senhas para 123456
						//$conexao_com_banco = mysqli_connect("localhost", "root", "" , "pg2") or die(mysqli_error("pg2"));
						//mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET SENHA='e10adc3949ba59abbe56e057f20f883e'");
						
						echo "<center>script carregado com sucesso!</center>";
					?>
				</div>
			</div>
		</div>
	</body>
</html>	
