-- MySQL Script generated by MySQL Workbench
-- Wed Mar  8 00:06:13 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ShareMyTrip
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ShareMyTrip
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ShareMyTrip` DEFAULT CHARACTER SET utf8 ;
USE `ShareMyTrip` ;

-- -----------------------------------------------------
-- Table `ShareMyTrip`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NULL,
  `password` VARCHAR(255) NOT NULL,
  `photo` VARCHAR(255) NULL,
  `photo_dir` VARCHAR(45) NULL,
  `avatar` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShareMyTrip`.`trips`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`trips` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `owner_id` INT NOT NULL,
  `currency` VARCHAR(3) NULL,
  `date_start` DATE NULL,
  `date_end` DATE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_trips_users1_idx` (`owner_id` ASC),
  CONSTRAINT `fk_trips_users1`
    FOREIGN KEY (`owner_id`)
    REFERENCES `ShareMyTrip`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShareMyTrip`.`trips_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`trips_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `trip_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Trips_has_Users_Users1_idx` (`user_id` ASC),
  INDEX `fk_Trips_has_Users_Trips_idx` (`trip_id` ASC),
  CONSTRAINT `fk_tripsusers_trips`
    FOREIGN KEY (`trip_id`)
    REFERENCES `ShareMyTrip`.`trips` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tripsusers_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `ShareMyTrip`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShareMyTrip`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShareMyTrip`.`types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_types_categories1_idx` (`category_id` ASC),
  CONSTRAINT `fk_types_categories`
    FOREIGN KEY (`category_id`)
    REFERENCES `ShareMyTrip`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShareMyTrip`.`actions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`actions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `trip_id` INT NOT NULL,
  `type_id` INT NOT NULL,
  `owner_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `company` VARCHAR(255) NULL,
  `reservation` VARCHAR(255) NULL,
  `identifier` VARCHAR(255) NULL,
  `note` LONGTEXT NULL,
  `price` DECIMAL(7,2) NULL,
  `currency` VARCHAR(3) NULL,
  `status` INT NULL,
  `start_name` VARCHAR(255) NULL,
  `start_date` DATETIME NULL,
  `start_lng` FLOAT NULL,
  `start_lat` FLOAT NULL,
  `end_name` VARCHAR(255) NULL,
  `end_date` DATETIME NULL,
  `end_lng` FLOAT NULL,
  `end_lat` FLOAT NULL,
  `private` TINYINT(1) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_actions_trips1_idx` (`trip_id` ASC),
  INDEX `fk_actions_types1_idx` (`type_id` ASC),
  INDEX `fk_actions_users1_idx` (`owner_id` ASC),
  CONSTRAINT `fk_actions_trips`
    FOREIGN KEY (`trip_id`)
    REFERENCES `ShareMyTrip`.`trips` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actions_types`
    FOREIGN KEY (`type_id`)
    REFERENCES `ShareMyTrip`.`types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actions_users1`
    FOREIGN KEY (`owner_id`)
    REFERENCES `ShareMyTrip`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShareMyTrip`.`actions_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`actions_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `action_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_actions_actions_users1_idx` (`user_id` ASC),
  INDEX `fk_actions_users_actions1_idx` (`action_id` ASC),
  CONSTRAINT `fk_participations_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `ShareMyTrip`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_participations_actions`
    FOREIGN KEY (`action_id`)
    REFERENCES `ShareMyTrip`.`actions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShareMyTrip`.`methods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`methods` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ShareMyTrip`.`payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ShareMyTrip`.`payments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `action_id` INT NOT NULL,
  `method_id` INT NULL,
  `amount` DECIMAL(7,2) NULL,
  `currency` VARCHAR(3) NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_payments_actions1_idx` (`action_id` ASC),
  INDEX `fk_payments_users1_idx` (`user_id` ASC),
  INDEX `fk_payments_methods1_idx` (`method_id` ASC),
  CONSTRAINT `fk_payments_actions`
    FOREIGN KEY (`action_id`)
    REFERENCES `ShareMyTrip`.`actions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payments_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `ShareMyTrip`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payments_methods`
    FOREIGN KEY (`method_id`)
    REFERENCES `ShareMyTrip`.`methods` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
