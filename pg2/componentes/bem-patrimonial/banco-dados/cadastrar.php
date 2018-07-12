<?php
//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO tb_bem_patrimonial(ID, NM_PATRIMONIO, CD_SETOR_LOCALIZACAO, DS_DESCRICAO, NM_DENOMINACAO, NM_CONSERVACAO, NM_DOC_AQUISICAO, DT_AQUISICAO, VLR_AQUISICAO, NM_ANOS, TX_DEPRECIACAO, VLR_RESIDUAL, VLR_DEPRECIAVEL, VLR_DEPRECIACAO_ACUMULADA, VLR_LIQUIDO) VALUES 

('$id', '$novo_numero_patrimonio', '$novo_setor', '$novo_descricao' ,'$novo_denominacao','$novo_conservacao', '$novo_doc_aquisicao', '$novo_data_aquisicao', '$novo_valor_aquisicao', '$novo_tempo_anos' ,'$novo_taxa_depreciacao', '$novo_valor_residual','$novo_valor_depreciavel', '$novo_depreciacao_acumulada' , '$novo_valor_liquido')") 

or die (mysqli_error($conexao_com_banco));

header("Location:../../../interface/bens-patrimoniais.php?sessionId=$num&mensagem=O bem foi cadastrado com sucesso!&resultado=sucesso");



?>