<?php

ini_set('max_execution_time', 100000);

include("../conectar.php");

mysqli_query($conexao_com_banco, "UPDATE `tb_processos` set NM_STATUS = 'Finalizado pelo setor' where NM_STATUS = 'Em andamento' AND CD_SETOR_LOCALIZACAO = 'GAB' and CD_PROCESSO IN (SELECT CD_PROCESSO FROM `tb_historico_processos` WHERE NM_ACAO = 'Conclusão')");

echo "ACABOU!!!";

?>