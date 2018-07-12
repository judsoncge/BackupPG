<?php

mysqli_query($conexao_com_banco, "INSERT INTO tb_servidores(NM_CARGO, CD_SETOR, NM_NIVEL, NM_GRUPO, VLR_SALARIO, NM_SERVIDOR, SNM_SERVIDOR, DT_NOMEACAO, NM_SITUACAO_FUNCIONAL, CD_SERVIDOR, NM_EMAIL, NM_MATRICULA, NM_CEDIDO, NM_GRADUACAO, NM_ARQUIVO_FOTO, SENHA) VALUES ('$novo_cargo', '$novo_setor','$novo_nivel','$novo_grupo','$novo_salario','$novo_nome', '$novo_sobrenome' , '$novo_nomeacao','$novo_situacao_funcional','$novo_CPF', '$novo_email_institucional' ,'$novo_matricula', '$novo_cedido_por' ,'$novo_graduacao', 'default.jpg', '$novo_senha')") 
or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "INSERT INTO permissao VALUES ('$novo_CPF','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não','não')
") 
or die (mysqli_error($conexao_com_banco));


header("Location:../../../interface/servidores.php?sessionId=$num&mensagem=$nome foi cadastrado com sucesso!&resultado=sucesso");

?>