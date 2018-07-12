<?php

//iniciando a sessão do usuário
session_start();

//incluindo as funções de arrumar alguns dados, como o IDs, por exemplo
include('../../../nucleo-aplicacao/arrumar_dados.php');

//incluindo as funções para retornar dados, para verificar se um processo já existe na hora de cadastrar, por exemplo, entre outros
include('../../../nucleo-aplicacao/retornar_dados.php');

//abrindo a conexão com o banco de dados
include('../../banco-dados/conectar.php');


?>