<?php
// inclui a conexão
include_once('../conectar2.php');

// Abre o Arquvio no Modo r (para leitura)
$arquivo = fopen ('../tabelas/tb_pessoa_pf.csv', 'r');

// Lê o conteúdo do arquivo
while(!feof($arquivo))
{
// Pega os dados da linha
$linha = fgets($arquivo, 1024);

// Divide as Informações das celulas para poder salvar
$dados = explode(';', $linha);

ini_set('max_execution_time', 300);
// Verifica se o Dados Não é o cabeçalho ou não esta em branco

mysqli_query($conexao_com_banco, "INSERT INTO tb_pessoa_pf 
VALUES ('$dados[0]', ' $dados[1]', '$dados[2]', '$dados[3]', '$dados[4]', '$dados[5]', '$dados[6]', '$dados[7]', '$dados[8]', '$dados[9]', '$dados[10]', '$dados[11]', '$dados[12]', '$dados[13]', '$dados[14]', '$dados[15]')") 
or die(mysqli_error($conexao_com_banco));

}
echo "acabou tudo";
// Fecha arquivo aberto
fclose($arquivo);
?>