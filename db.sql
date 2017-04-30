/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.1.19-MariaDB : Database - inventariofarmacia
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventariofarmacia` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `inventariofarmacia`;

/*Table structure for table `auditoria` */

DROP TABLE IF EXISTS `auditoria`;

CREATE TABLE `auditoria` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `accion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `sucursal` int(11) DEFAULT NULL,
  `producto` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `Usuario` (`usuario`),
  CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `users` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `catcodigo` int(11) NOT NULL AUTO_INCREMENT,
  `catnombre` varchar(50) NOT NULL,
  `catdescripcion` varchar(100) DEFAULT NULL,
  `catestado` varchar(2) DEFAULT 'AC',
  PRIMARY KEY (`catcodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empname` varchar(150) NOT NULL,
  `empdesc` varchar(200) DEFAULT NULL,
  `empnit` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `laboratorio` */

DROP TABLE IF EXISTS `laboratorio`;

CREATE TABLE `laboratorio` (
  `labcodigo` int(11) NOT NULL AUTO_INCREMENT,
  `labnombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `labdescripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `labestado` varchar(2) CHARACTER SET latin1 DEFAULT 'AC',
  PRIMARY KEY (`labcodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `lotes` */

DROP TABLE IF EXISTS `lotes`;

CREATE TABLE `lotes` (
  `lotid` int(11) NOT NULL AUTO_INCREMENT,
  `lotfechavenc` date DEFAULT NULL,
  `lotcantidad` int(11) DEFAULT NULL,
  `lotcoba` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `lotcodigo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Código del lote',
  `lotvalorcompra` double DEFAULT NULL,
  `lotvalorventa` int(11) DEFAULT NULL,
  `lotfechaingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lotproveedor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lotid`),
  KEY `lotes_ibfk_1` (`lotcoba`),
  KEY `lotes_ibfk_2` (`lotproveedor`),
  CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`lotcoba`) REFERENCES `producto` (`proCodigoBarra`) ON UPDATE CASCADE,
  CONSTRAINT `lotes_ibfk_2` FOREIGN KEY (`lotproveedor`) REFERENCES `proveedor` (`prvNit`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `movimientos` */

DROP TABLE IF EXISTS `movimientos`;

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `idproducto` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `accion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkproducto` (`idproducto`),
  KEY `iduser` (`iduser`),
  CONSTRAINT `fkproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`proCodigoBarra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `notificaciones` */

DROP TABLE IF EXISTS `notificaciones`;

CREATE TABLE `notificaciones` (
  `noticodigo` int(11) NOT NULL AUTO_INCREMENT,
  `notidescripcion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `notifecha` date DEFAULT NULL,
  `notivisto` varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `notilink` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `notiestado` varchar(2) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `noticoba` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Codigo de barras',
  `sucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`noticodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `paginas` */

DROP TABLE IF EXISTS `paginas`;

CREATE TABLE `paginas` (
  `pagid` int(11) NOT NULL AUTO_INCREMENT,
  `pagname` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `pagurl` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `pagicono` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pagestado` varchar(1) COLLATE utf8_spanish2_ci DEFAULT 'A',
  `nivel` float DEFAULT NULL,
  PRIMARY KEY (`pagid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `permisos` */

DROP TABLE IF EXISTS `permisos`;

CREATE TABLE `permisos` (
  `perpag` int(11) NOT NULL,
  `peridrol` int(11) NOT NULL,
  `peredita` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'S',
  `perelimina` varchar(1) COLLATE utf8_spanish2_ci DEFAULT 'N',
  UNIQUE KEY `peridrol` (`peridrol`,`perpag`),
  KEY `perpag` (`perpag`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`peridrol`) REFERENCES `role` (`rolid`) ON DELETE NO ACTION,
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`perpag`) REFERENCES `paginas` (`pagid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `presentacion` */

DROP TABLE IF EXISTS `presentacion`;

CREATE TABLE `presentacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `predescripcion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preestado` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `procodigobarra` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `pronombre` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `prolaboratorio` int(11) DEFAULT NULL COMMENT 'Código del laboratorio',
  `provalorventa` int(30) DEFAULT NULL,
  `prostockminimo` int(99) DEFAULT NULL,
  `prostockbodega` int(100) DEFAULT NULL,
  `procategoria` int(11) DEFAULT NULL COMMENT 'Código de la categoria',
  `proestado` varchar(2) CHARACTER SET latin1 NOT NULL DEFAULT 'AC' COMMENT 'AC=Activo, IN=Inactivo',
  `profechaingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proubicacion` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `proimagen` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `profechamodificacion` date DEFAULT NULL,
  `prounidadmedida` int(11) DEFAULT NULL,
  `proreferencia` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `proidusuario` int(11) DEFAULT NULL COMMENT 'Usuario que modifica',
  `prosucursal` int(11) NOT NULL,
  `proiva` double DEFAULT NULL COMMENT 'Porcentaje de iva',
  `proprincipioactivo` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Principio activo',
  `propresentacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`procodigobarra`,`prosucursal`),
  KEY `proMarCodigo` (`prolaboratorio`),
  KEY `proGruCodigo` (`procategoria`),
  KEY `proTipoDescarga` (`prounidadmedida`),
  KEY `proIdUsuario` (`proidusuario`),
  KEY `sucursal` (`prosucursal`),
  KEY `proPresentacion` (`propresentacion`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`prolaboratorio`) REFERENCES `laboratorio` (`labcodigo`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`procategoria`) REFERENCES `categoria` (`catcodigo`),
  CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`prounidadmedida`) REFERENCES `unidadmedida` (`tideCodigo`),
  CONSTRAINT `producto_ibfk_5` FOREIGN KEY (`proIdUsuario`) REFERENCES `users` (`userid`),
  CONSTRAINT `producto_ibfk_6` FOREIGN KEY (`prosucursal`) REFERENCES `sucursal` (`id`),
  CONSTRAINT `producto_ibfk_7` FOREIGN KEY (`proPresentacion`) REFERENCES `presentacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `prvnit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prvnombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prvdireccion` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prvtelefono` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prvcorreo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prvsitioweb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prvfechaingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `prvestado` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'AC, IN',
  PRIMARY KEY (`prvnit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `rolid` int(11) NOT NULL AUTO_INCREMENT,
  `rolname` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `roldesc` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rolestado` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'AC',
  PRIMARY KEY (`rolid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `roleusr` */

DROP TABLE IF EXISTS `roleusr`;

CREATE TABLE `roleusr` (
  `ruid` int(11) NOT NULL AUTO_INCREMENT,
  `ruuserid` int(11) NOT NULL,
  `ruroleid` int(11) NOT NULL,
  PRIMARY KEY (`ruid`),
  UNIQUE KEY `ruuserid` (`ruuserid`,`ruroleid`),
  KEY `ruroleid` (`ruroleid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `sucursal` */

DROP TABLE IF EXISTS `sucursal`;

CREATE TABLE `sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sucname` varchar(150) NOT NULL,
  `sucdesc` varchar(200) DEFAULT NULL,
  `sucdir` varchar(150) DEFAULT NULL,
  `suctel` varchar(50) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `principal` int(11) DEFAULT '0',
  `estado` varchar(2) DEFAULT NULL COMMENT 'AC, IN',
  PRIMARY KEY (`id`),
  KEY `empresa` (`empresa`),
  CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `unidadmedida` */

DROP TABLE IF EXISTS `unidadmedida`;

CREATE TABLE `unidadmedida` (
  `undcodigo` int(11) NOT NULL AUTO_INCREMENT,
  `undnombre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `unddescripcion` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `undestado` varchar(2) CHARACTER SET utf8 DEFAULT 'AC',
  PRIMARY KEY (`undcodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `userpass` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `userdoc` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `userusu` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usertele` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `userdir` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usercorreo` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `userestado` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'AC',
  `keypass` int(11) NOT NULL DEFAULT '0',
  `keypass_tmp` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `session` int(11) NOT NULL DEFAULT '0',
  `rol` int(11) DEFAULT NULL,
  `sucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userusu` (`userusu`),
  UNIQUE KEY `userdoc` (`userdoc`),
  KEY `rol` (`rol`),
  KEY `sucursal` (`sucursal`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `role` (`rolid`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`sucursal`) REFERENCES `sucursal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `ventid` int(11) NOT NULL AUTO_INCREMENT,
  `ventcostototal` int(11) NOT NULL,
  `venfecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ventid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `ventadetalle` */

DROP TABLE IF EXISTS `ventadetalle`;

CREATE TABLE `ventadetalle` (
  `vedeid` int(11) NOT NULL AUTO_INCREMENT,
  `vedeidventa` int(11) DEFAULT NULL,
  `vedecodigobarras` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `vedenombreproducto` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `vedepreciound` double DEFAULT NULL COMMENT 'precio de venta unitario',
  `vedecantidad` int(11) DEFAULT NULL,
  `vedetotalprecio` double DEFAULT NULL COMMENT 'precio de venta total',
  `vededescuento` double DEFAULT NULL,
  PRIMARY KEY (`vedeid`),
  KEY `vedeIdVenta` (`vedeidventa`),
  KEY `vedeCodigoBarrasProducto` (`vedecodigobarras`),
  CONSTRAINT `ventadetalle_ibfk_1` FOREIGN KEY (`vedeIdVenta`) REFERENCES `venta` (`ventId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ventadetalle_ibfk_2` FOREIGN KEY (`vedecodigobarras`) REFERENCES `producto` (`proCodigoBarra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/* Trigger structure for table `producto` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insertarPro` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `insertarPro` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    INSERT INTO auditoria(fecha,hora,accion,producto,sucursal) VALUES (CURDATE(),curtime(),"Insertar",NEW.proCodigoBarra,NEW.prosucursal);
    insert into movimientos values(0,NEW.proIdUsuario,NEW.proCodigoBarra,"Agregado",new.proStockBodega);
END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
