-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bothniabladet
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bothniabladet
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bothniabladet` DEFAULT CHARACTER SET utf8 ;
USE `bothniabladet` ;

-- -----------------------------------------------------
-- Table `bothniabladet`.`Member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bothniabladet`.`Member` (
  `ID_member` INT NOT NULL AUTO_INCREMENT,
  `password` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `city` VARCHAR(45) NULL,
  `postal` VARCHAR(45) NULL,
  `street` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `email` VARCHAR(100) NOT NULL,
  `discount_amount` INT NULL DEFAULT 0,
  PRIMARY KEY (`ID_member`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bothniabladet`.`Invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bothniabladet`.`Invoice` (
  `ID_invoice` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `payment_term` VARCHAR(255) NULL,
  PRIMARY KEY (`ID_invoice`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bothniabladet`.`Image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bothniabladet`.`Image` (
  `ID_image` INT NOT NULL AUTO_INCREMENT,
  `imageURL` VARCHAR(500) NOT NULL,
  `resolution` VARCHAR(45) NULL,
  `file_size` INT NULL,
  `file_type` VARCHAR(45) NULL,
  `GPS_coordinates` VARCHAR(255) NULL,
  `photographer` VARCHAR(100) NULL,
  `location` VARCHAR(500) NULL,
  `date` DATETIME NULL,
  `camera` VARCHAR(255) NULL,
  PRIMARY KEY (`ID_image`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bothniabladet`.`Key_word`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bothniabladet`.`Key_word` (
  `ID_key_word` INT NOT NULL AUTO_INCREMENT,
  `keyword` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`ID_key_word`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bothniabladet`.`Invoice_has_Image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bothniabladet`.`Invoice_has_Image` (
  `ID_invoice_has_image` INT NOT NULL AUTO_INCREMENT,
  `Invoice_ID_invoice` INT NOT NULL,
  `Image_ID_image` INT NOT NULL,
  PRIMARY KEY (`ID_invoice_has_image`),
  INDEX `fk_Invoice_has_Image_Image1_idx` (`Image_ID_image` ASC) VISIBLE,
  INDEX `fk_Invoice_has_Image_Invoice_idx` (`Invoice_ID_invoice` ASC) VISIBLE,
  CONSTRAINT `fk_Invoice_has_Image_Invoice`
    FOREIGN KEY (`Invoice_ID_invoice`)
    REFERENCES `bothniabladet`.`Invoice` (`ID_invoice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Invoice_has_Image_Image1`
    FOREIGN KEY (`Image_ID_image`)
    REFERENCES `bothniabladet`.`Image` (`ID_image`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bothniabladet`.`Key_word_has_Image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bothniabladet`.`Key_word_has_Image` (
  `ID_key_word_has_image` INT NOT NULL AUTO_INCREMENT,
  `Key_word_ID_key_word` INT NOT NULL,
  `Image_ID_image` INT NOT NULL,
  PRIMARY KEY (`ID_key_word_has_image`),
  INDEX `fk_Key_word_has_Image_Image1_idx` (`Image_ID_image` ASC) VISIBLE,
  INDEX `fk_Key_word_has_Image_Key_word1_idx` (`Key_word_ID_key_word` ASC) VISIBLE,
  CONSTRAINT `fk_Key_word_has_Image_Key_word1`
    FOREIGN KEY (`Key_word_ID_key_word`)
    REFERENCES `bothniabladet`.`Key_word` (`ID_key_word`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Key_word_has_Image_Image1`
    FOREIGN KEY (`Image_ID_image`)
    REFERENCES `bothniabladet`.`Image` (`ID_image`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
