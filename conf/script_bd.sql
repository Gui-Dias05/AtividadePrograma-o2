CREATE TABLE `ativprog3`.`usuario` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(45) NULL,
  `name` VARCHAR(45) NULL,
  `idade` INT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `ativprog3`.`computador` (
  `computador_id` INT NOT NULL AUTO_INCREMENT,
  `tipocomp` VARCHAR(45) NULL,
  `valorhora` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

  CREATE TABLE `ativprog3`.`jogos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `faixaetaria` VARCHAR(45) NULL,
  `gênero` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `ativprog3`.`usuario` 
ADD COLUMN `tempo` VARCHAR(45) NULL AFTER `idade`;

INSERT INTO `ativprog3`.`usuario` (`cpf`, `name`, `idade`) VALUES ('623.762.763-10', 'Celio', '16');
INSERT INTO `ativprog3`.`usuario` (`cpf`, `name`, `idade`) VALUES ('481.573.968-40', 'Rodrigo', '16');
INSERT INTO `ativprog3`.`usuario` (`cpf`, `name`, `idade`) VALUES ('481.762.672-30', 'Vinicius', '17');
INSERT INTO `ativprog3`.`usuario` (`cpf`, `name`, `idade`) VALUES ('632.273.761-62', 'Murilo', '17');
INSERT INTO `ativprog3`.`usuario` (`cpf`, `name`, `idade`) VALUES ('763.391.372-18', 'Guilherme', '16');

INSERT INTO `ativprog3`.`computador` (`tipocomp`, `valorhora`) VALUES ('PC Gamer G-Fire HTG-500 AMD Athlon 8 GB de RAM e 120 GB de SSD', '35');
INSERT INTO `ativprog3`.`computador` (`tipocomp`, `valorhora`) VALUES ('PC gamer AMD 6-Core CPU 8 GB de RAM e 120 GB de SSD', '40');
INSERT INTO `ativprog3`.`computador` (`tipocomp`, `valorhora`) VALUES ('PC gamer Skill 40471 AMD A6 7480 8 GB de RAM e 120 GB de SSD', '45');
INSERT INTO `ativprog3`.`computador` (`tipocomp`, `valorhora`) VALUES ('PC gamer Intel Core i7 16 GB de RAM e 480  GB de SSD', '55');
INSERT INTO `ativprog3`.`computador` (`tipocomp`, `valorhora`) VALUES ('PC 3Green 47733 Intel Core i7 8 GB de RAM e 240 GB de SSD', '60');

INSERT INTO `ativprog3`.`jogos` (`nome`, `faixaetaria`, `gênero`) VALUES ('CS Go', '+16', 'Tiro');
INSERT INTO `ativprog3`.`jogos` (`nome`, `faixaetaria`, `gênero`) VALUES ('Fifa 22', 'livre', 'Futebol');
INSERT INTO `ativprog3`.`jogos` (`nome`, `faixaetaria`, `gênero`) VALUES ('Minecraft', 'Livre', 'Sobrevivência');
INSERT INTO `ativprog3`.`jogos` (`nome`, `faixaetaria`, `gênero`) VALUES ('Gta V', '+18', 'Ação');
INSERT INTO `ativprog3`.`jogos` (`nome`, `faixaetaria`, `gênero`) VALUES ('Resident Evil 2', '+16', 'Sobrevivência');

UPDATE `ativprog3`.`usuario` SET `tempo` = '2' WHERE (`id` = '1');
UPDATE `ativprog3`.`usuario` SET `tempo` = '4' WHERE (`id` = '2');
UPDATE `ativprog3`.`usuario` SET `tempo` = '6' WHERE (`id` = '3');
UPDATE `ativprog3`.`usuario` SET `tempo` = '7' WHERE (`id` = '4');
UPDATE `ativprog3`.`usuario` SET `tempo` = '3' WHERE (`id` = '5');

ALTER TABLE `ativprog3`.`jogos` 
CHANGE COLUMN `nome` `name` VARCHAR(45) NULL DEFAULT NULL ;
ALTER TABLE `ativprog3`.`jogos` 
CHANGE COLUMN `gênero` `genero` VARCHAR(45) NULL DEFAULT NULL ;



ENGINE=InnoDB DEFAULT CHARSET=UTF-8;
