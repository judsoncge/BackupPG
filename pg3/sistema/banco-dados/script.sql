use pg;

#criar tabelas de anexos

CREATE TABLE tb_anexos_atividade (
  ID int(100) NOT NULL,
  CD_ATIVIDADE int(100) NOT NULL,
  NM_ARQUIVO varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 
CREATE TABLE tb_anexos_comunicacao (
  ID int(100) NOT NULL,
  CD_COMUNICACAO int(100) NOT NULL,
  NM_ARQUIVO varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 
CREATE TABLE tb_anexos_despesa (
  ID int(100) NOT NULL,
  ID_DESPESA int(100) NOT NULL,
  NM_ARQUIVO varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


 
CREATE TABLE tb_anexos_documento (
  ID int(100) NOT NULL,
  CD_DOCUMENTO int(100) NOT NULL,
  NM_ARQUIVO varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE tb_anexos_atividade
  ADD PRIMARY KEY (ID);


ALTER TABLE tb_anexos_comunicacao
  ADD PRIMARY KEY (ID);


ALTER TABLE tb_anexos_despesa
  ADD PRIMARY KEY (ID);


ALTER TABLE tb_anexos_documento
  ADD PRIMARY KEY (ID);

 
ALTER TABLE tb_anexos_atividade
  MODIFY ID int(100) NOT NULL AUTO_INCREMENT;

 
ALTER TABLE tb_anexos_comunicacao
  MODIFY ID int(100) NOT NULL AUTO_INCREMENT;
 
ALTER TABLE tb_anexos_despesa
  MODIFY ID int(100) NOT NULL AUTO_INCREMENT;

 
ALTER TABLE tb_anexos_documento
  MODIFY ID int(100) NOT NULL AUTO_INCREMENT;



#script para processos


ALTER TABLE `tb_historico_processos` DROP `ID`;

ALTER TABLE `tb_historico_processos` ADD `ID` INT(100) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`ID`);

ALTER TABLE `tb_tramitacao_processos` DROP `ID`;

ALTER TABLE `tb_tramitacao_processos` ADD `ID` INT(100) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`ID`);



#Script para documentos

ALTER TABLE `tb_documentos` ADD `CD_DOCUMENTO_OLD` VARCHAR(50) NOT NULL AFTER `NM_STATUS`;

UPDATE `tb_documentos` SET CD_DOCUMENTO_OLD = CD_DOCUMENTO;

ALTER TABLE `tb_documentos` DROP `CD_DOCUMENTO`;

ALTER TABLE `tb_documentos` ADD `CD_DOCUMENTO` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`CD_DOCUMENTO`);

UPDATE `tb_historico_documentos` h SET h.CD_DOCUMENTO = (SELECT d.CD_DOCUMENTO FROM tb_documentos d WHERE d.CD_DOCUMENTO_OLD = h.CD_DOCUMENTO);

ALTER TABLE `tb_historico_documentos` DROP `ID`;

ALTER TABLE `tb_historico_documentos` ADD `ID` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`ID`);

INSERT INTO tb_anexos_documento (CD_DOCUMENTO, NM_ARQUIVO) SELECT d.CD_DOCUMENTO, a.NM_ARQUIVO FROM tb_documentos d left join `tb_anexos` a on a.CD_REFERENTE = d.CD_DOCUMENTO_OLD WHERE a.NM_ARQUIVO is not NULL;

#Script para despesas

ALTER TABLE `tb_despesas` ADD `ID_DESPESA_OLD` VARCHAR(50) NOT NULL AFTER `NM_STATUS`;

UPDATE `tb_despesas` SET ID_DESPESA_OLD = ID;

ALTER TABLE `tb_despesas` DROP `ID`;

ALTER TABLE `tb_despesas` ADD `ID` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`ID`);

UPDATE `tb_historico_despesas` h SET h.ID_DESPESA = (SELECT d.ID FROM tb_despesas d WHERE d.ID_DESPESA_OLD = h.ID_DESPESA);

ALTER TABLE `tb_historico_despesas` DROP `ID`;

ALTER TABLE `tb_historico_despesas` ADD `ID` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`ID`);

ALTER TABLE `tb_despesas` CHANGE `ID` `ID_DESPESA` INT(11) NOT NULL AUTO_INCREMENT;

INSERT INTO tb_anexos_despesa (ID_DESPESA, NM_ARQUIVO) SELECT d.ID_DESPESA, a.NM_ARQUIVO FROM tb_despesas d left join `tb_anexos` a on a.CD_REFERENTE = d.ID_DESPESA_OLD where a.NM_ARQUIVO is not NULL;

#Script para comunicacao

ALTER TABLE `tb_comunicacao` ADD `ID_COMUNICACAO_OLD` VARCHAR(50) NOT NULL AFTER `NM_STATUS`;

UPDATE `tb_comunicacao` SET ID_COMUNICACAO_OLD = ID;

ALTER TABLE `tb_comunicacao` DROP `ID`;

ALTER TABLE `tb_comunicacao` ADD `CD_COMUNICACAO` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`CD_COMUNICACAO`);


INSERT INTO tb_anexos_comunicacao (CD_COMUNICACAO, NM_ARQUIVO) SELECT d.CD_COMUNICACAO, a.NM_ARQUIVO FROM tb_comunicacao d left join `tb_anexos` a on a.CD_REFERENTE = d.ID_COMUNICACAO_OLD where a.NM_ARQUIVO is not NULL;

#Script atividade

ALTER TABLE `tb_atividades` CHANGE `ID` `CD_ATIVIDADE` INT(6) NOT NULL AUTO_INCREMENT;

INSERT INTO tb_anexos_atividade (CD_ATIVIDADE, NM_ARQUIVO) SELECT d.CD_ATIVIDADE, a.NM_ARQUIVO FROM tb_atividades d left join `tb_anexos` a on a.CD_REFERENTE = CONCAT('ATIVIDADE_',d.CD_ATIVIDADE) where a.NM_ARQUIVO is not NULL;

#Script chamados

ALTER TABLE `tb_chamados` ADD `ID_CHAMADO_OLD` VARCHAR(50) NOT NULL AFTER `NM_NOTA`;

UPDATE `tb_chamados` SET ID_CHAMADO_OLD = ID;

ALTER TABLE `tb_chamados` DROP `ID`;

ALTER TABLE `tb_chamados` ADD `CD_CHAMADO` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`CD_CHAMADO`);

UPDATE `tb_historico_chamados` h SET h.CD_CHAMADO = (SELECT d.CD_CHAMADO FROM tb_chamados d WHERE d.ID_CHAMADO_OLD = h.CD_CHAMADO);

ALTER TABLE `tb_historico_chamados` DROP `ID`;

ALTER TABLE `tb_historico_chamados` ADD `ID` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`ID`);

#Drops

ALTER TABLE `tb_documentos` DROP `CD_DOCUMENTO_OLD`;

ALTER TABLE `tb_despesas` DROP `ID_DESPESA_OLD`;

ALTER TABLE `tb_comunicacao` DROP `ID_COMUNICACAO_OLD`;

ALTER TABLE `tb_chamados` DROP `ID_CHAMADO_OLD`;


#permissao



ALTER TABLE permissao DROP FOREIGN KEY permissao_ibfk_1;

ALTER TABLE `permissao` DROP PRIMARY KEY;

ALTER TABLE `permissao` ADD `ID` INT(100) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`ID`);

ALTER TABLE `permissao` ADD `CADASTRAR_SERVIDORES` VARCHAR(3) NOT NULL AFTER `VISUALIZAR_SERVIDORES`;

update `permissao` set `CADASTRAR_SERVIDORES`='sim';

ALTER TABLE `permissao` ADD `EDITAR_RECEITA` VARCHAR(3) NOT NULL AFTER `CADASTRAR_RECEITA`, ADD `EXCLUIR_RECEITA` VARCHAR(3) NOT NULL AFTER `EDITAR_RECEITA`;

update permissao set EXCLUIR_RECEITA='não';

update permissao set EXCLUIR_RECEITA='sim' WHERE CD_SERVIDOR='062.200.904-46' or CD_SERVIDOR='894.568.234-15' or CD_SERVIDOR='077.036.184-62' or CD_SERVIDOR='057.996.054-46';


#processos

ALTER TABLE `tb_processos` CHANGE `NM_DESCRICAO` `DS_PROCESSO` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

#documentos

ALTER TABLE `tb_documentos` CHANGE `NM_TEXTO` `TX_DOCUMENTO` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;