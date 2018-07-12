
#Adicionando urgencia nos processos

ALTER TABLE `permissao` ADD `URGENCIA_PROCESSO` VARCHAR(4) NOT NULL DEFAULT 'não' AFTER `PRAZO_FINAL_PROCESSO`;

#Marcando os processos como recebidos
UPDATE `tb_tramitacao_processos` SET RECEBIDO = 1

#adicionando dados de confirmação de tramitação
ALTER TABLE `tb_tramitacao_processos` ADD `DT_CONFIRMACAO` DATE NULL AFTER `RECEBIDO`;

ALTER TABLE `tb_tramitacao_processos` ADD `RECEBIDO` TINYINT NOT NULL DEFAULT '0' AFTER `DT_TRAMITACAO`;

ALTER TABLE `tb_tramitacao_processos` CHANGE `DT_CONFIRMACAO` `DT_CONFIRMACAO` DATETIME NULL DEFAULT NULL;

ALTER TABLE `tb_tramitacao_processos` ADD `CD_SERVIDOR_CONFIRMOU` VARCHAR(17) NULL AFTER `DT_CONFIRMACAO`;


#Adicionando permissão de acesso ao GUIA
ALTER TABLE `permissao` ADD `ACESSO_GUIA_TRAMITACAO_PROCESSO` VARCHAR(3) NOT NULL DEFAULT 'não' AFTER `URGENCIA_PROCESSO`;



#Atualizando textos dos documentos
ALTER TABLE `tb_documentos` CHANGE `TX_DOCUMENTO` `TX_DOCUMENTO` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
UPDATE `tb_documentos` SET TX_DOCUMENTO = NULL where TX_DOCUMENTO LIKE '%sem texto%'

#Adicionar a query de montar a tabela de controle das planilhas