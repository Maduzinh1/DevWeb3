-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema siga
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema siga
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `siga` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `siga` ;

-- -----------------------------------------------------
-- Table `siga`.`disciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `siga`.`disciplina` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `siga`.`atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `siga`.`atividade` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `peso` DECIMAL(16,2) NULL DEFAULT NULL,
  `anexo` VARCHAR(255) NULL DEFAULT NULL,
  `tipo` VARCHAR(10) NULL,
  `recuperacao` DECIMAL(16,2) NULL,
  `equipe` VARCHAR(255) NULL,
  `idDisciplina` INT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idDisciplina`)
  REFERENCES `siga`.`disciplina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `siga`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `siga`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL,
  `senha` VARCHAR(255) NULL,
  `matricula` INT(11) NULL,
  `contato` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;