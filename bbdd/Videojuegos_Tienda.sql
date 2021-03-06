-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19/11/2019 a las 19:46
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Videojuegos`
--
drop schema if exists `Videojuegos`;

CREATE schema `Videojuegos`;
USE `Videojuegos`;

DROP TABLE IF EXISTS `Usuarios`;
CREATE TABLE `Usuarios`(
 `NOMBRE_U`		VARCHAR(25) PRIMARY KEY,
 `CONTRASEÑA` 	VARCHAR(25),
 `NOMBRE` 		VARCHAR(25),
 `APELLIDOS`      VARCHAR(14),
 `TELEFONO`		INT(8),
 `DIRECCION`		VARCHAR(14),
 `ROL`			VARCHAR(10)
)ENGINE=InnoDB;


DROP TABLE IF EXISTS `Videojuego`;
CREATE TABLE `Videojuego`(
 `PRODUCTO_NO`  		SMALLINT(4) PRIMARY KEY,
 `NOMBRE`             VARCHAR(25),
 `DESCRIPCION`  		VARCHAR(30),
 `TIPO`				VARCHAR(25),
 `PRECIO_ACTUAL` 		INTEGER(8),
 `STOCK_DISPONIBLE`	INTEGER(9)
)ENGINE=InnoDB;


DROP TABLE IF EXISTS `Cesta`;
CREATE TABLE `Cesta`(
 `PEDIDO_NO`    	SMALLINT(4) PRIMARY KEY,
 `PRODUCTO_NO` 		SMALLINT(4),
 `NOMBRE_U`	 		SMALLINT(4),
 `UNIDADES` 	        SMALLINT(4),
 `FECHA_PEDIDO`     	DATE,
INDEX `PRODUCTO_NO` (`PRODUCTO_NO` ASC),
INDEX `NOMBRE_U`(`NOMBRE_U`	ASC),
CONSTRAINT `Videojuego`

    FOREIGN KEY (`PRODUCTO_NO`)

    REFERENCES `Videojuegos`.`Videojuego` (`PRODUCTO_NO`)

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,
   CONSTRAINT `Usuarios`

    FOREIGN KEY (`NOMBRE_U`)

    REFERENCES `Videojuegos`.`Usuarios`(`NOMBRE_U`)

    ON DELETE NO ACTION

    ON UPDATE NO ACTION
)ENGINE=InnoDB;

DROP TABLE IF EXISTS `Ranking`;
CREATE TABLE `Ranking`(
 `PRODUCTO_NO`  	SMALLINT(4) PRIMARY KEY,
 `NOMBRE`             VARCHAR(25),
 `DESCRIPCION`  		VARCHAR(30),
 `PRECIO_ACTUAL` 		INTEGER(8),
 `VENTAS_X_PRODUC`	INTEGER(9)
)ENGINE=InnoDB;