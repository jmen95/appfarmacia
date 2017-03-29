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
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Accion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Usuario` int(11) DEFAULT NULL,
  `sucursal` int(11) DEFAULT NULL,
  `producto` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `Usuario` (`Usuario`),
  CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `users` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `auditoria` */

insert  into `auditoria`(`Codigo`,`Fecha`,`Hora`,`Accion`,`Usuario`,`sucursal`,`producto`) values (1,'2014-03-17',NULL,NULL,NULL,NULL,NULL),(2,'2014-03-17',NULL,NULL,NULL,NULL,NULL),(3,'2014-03-17','07:58:54',NULL,NULL,NULL,NULL),(4,'2014-03-17','08:00:24','Insertar',NULL,NULL,NULL),(5,'2014-03-20','07:50:25','Insertar',NULL,NULL,NULL),(6,'2014-03-23','21:49:37','Insertar',NULL,NULL,NULL),(16,'2015-11-22','16:39:39','Insertar',NULL,NULL,NULL);

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empname` varchar(150) NOT NULL,
  `empdesc` varchar(200) DEFAULT NULL,
  `empnit` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `empresa` */

insert  into `empresa`(`id`,`empname`,`empdesc`,`empnit`) values (1,'La central del remedio','Farmacia novedosa y emprendedora','1234');

/*Table structure for table `grupo` */

DROP TABLE IF EXISTS `grupo`;

CREATE TABLE `grupo` (
  `gruCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `gruNombre` varchar(50) NOT NULL,
  `gruDescripcion` varchar(100) DEFAULT NULL,
  `gruEstado` varchar(2) DEFAULT 'AC',
  PRIMARY KEY (`gruCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `grupo` */

insert  into `grupo`(`gruCodigo`,`gruNombre`,`gruDescripcion`,`gruEstado`) values (1,'Materiales de construcción','Materiales de construcción','IN'),(2,'Pinturas',NULL,'AC'),(3,'Herramientas',NULL,'AC'),(4,'Sanitario',NULL,'AC'),(5,'El?ctricos',NULL,'AC'),(6,'Pegantes',NULL,'AC'),(7,'Torniller?a',NULL,'AC');

/*Table structure for table `lotes` */

DROP TABLE IF EXISTS `lotes`;

CREATE TABLE `lotes` (
  `lotid` int(11) NOT NULL,
  `lotfechavenc` date DEFAULT NULL,
  `lotcantidad` int(11) DEFAULT NULL,
  `lotpiva` double DEFAULT NULL,
  `lotiva` double DEFAULT NULL,
  `lotcoba` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`lotid`),
  KEY `lotcoba` (`lotcoba`),
  CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`lotcoba`) REFERENCES `producto` (`proCodigoBarra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `lotes` */

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `marCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `marNombre` varchar(100) NOT NULL,
  `marDescripcion` varchar(200) DEFAULT NULL,
  `marEstado` varchar(2) DEFAULT 'AC',
  PRIMARY KEY (`marCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `marca` */

insert  into `marca`(`marCodigo`,`marNombre`,`marDescripcion`,`marEstado`) values (1,'Genfar',NULL,'AC'),(2,'JGB',NULL,'AC'),(3,'MK','Productos totalmente confiables','AC');

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

/*Data for the table `notificaciones` */

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

/*Data for the table `paginas` */

insert  into `paginas`(`pagid`,`pagname`,`pagurl`,`pagicono`,`pagestado`,`nivel`) values (1,'Listado de usuarios','users','ICONO1','A',1.1),(2,'Crear Usuarios','users/crear','ICONO2','A',1.2),(3,'Gestion de usuarios','#','glyphicon glyphicon-user','A',1),(4,'Gestion de roles','#','glyphicon glyphicon-user','A',2),(5,'Listado','role',NULL,'A',2.1),(6,'Crear','role/crear',NULL,'A',2.2),(7,'Opciones generales','#','glyphicon glyphicon-user','A',3),(8,'Listado empresas','empresa','','A',3.1),(9,'Crear empresa','empresa/crear',NULL,'A',3.2),(10,'Listado de sucursales','sucursal',NULL,'A',3.3),(11,'Crear sucursal','sucursal/crear',NULL,'A',3.4),(12,'Permisos','permisos',NULL,'A',2.3);

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

/*Data for the table `permisos` */

insert  into `permisos`(`perpag`,`peridrol`,`peredita`,`perelimina`) values (1,1,'S','N'),(2,1,'N','N'),(3,1,'N','N'),(4,1,'N','N'),(5,1,'N','N'),(6,1,'N','N'),(7,1,'N','N'),(8,1,'N','N'),(9,1,'N','N'),(10,1,'N','N'),(12,1,'N','N'),(1,3,'N','S'),(2,3,'S','S');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `proCodigoBarra` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `proNombre` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `proMarCodigo` int(11) DEFAULT NULL,
  `proValorCompra` int(30) DEFAULT NULL,
  `proStockMinimo` int(99) DEFAULT NULL,
  `proStockBodega` int(100) DEFAULT NULL,
  `proGruCodigo` int(11) DEFAULT NULL,
  `proEstado` varchar(2) CHARACTER SET latin1 NOT NULL DEFAULT 'AC' COMMENT 'AC=Activo, IN=Inactivo',
  `proFechaIngreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proUbicacion` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `proImagen` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `proFechaModificacion` date DEFAULT NULL,
  `proTipoDescarga` int(11) DEFAULT NULL,
  `proReferencia` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `proLote` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `proIdUsuario` int(11) DEFAULT NULL COMMENT 'Usuario que modifica',
  `sucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`proCodigoBarra`),
  KEY `proMarCodigo` (`proMarCodigo`),
  KEY `proGruCodigo` (`proGruCodigo`),
  KEY `proTipoDescarga` (`proTipoDescarga`),
  KEY `sucursal` (`sucursal`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`proMarCodigo`) REFERENCES `marca` (`marCodigo`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`proGruCodigo`) REFERENCES `grupo` (`gruCodigo`),
  CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`proTipoDescarga`) REFERENCES `tipodescarga` (`tideCodigo`),
  CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`sucursal`) REFERENCES `sucursal` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `producto` */

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `rolid` int(11) NOT NULL AUTO_INCREMENT,
  `rolname` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `roldesc` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rolestado` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'AC',
  PRIMARY KEY (`rolid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `role` */

insert  into `role`(`rolid`,`rolname`,`roldesc`,`rolestado`) values (1,'ADMINISTRADOR','ADMINISTRADOR DEL SISTEMA','AC'),(2,'AUXILIAR','AUXILIAR DE CONTABILIDAD','AC'),(3,'VENTAS','','AC');

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

/*Data for the table `roleusr` */

insert  into `roleusr`(`ruid`,`ruuserid`,`ruroleid`) values (17,19,1),(18,19,2);

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
  PRIMARY KEY (`id`),
  KEY `empresa` (`empresa`),
  CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `sucursal` */

insert  into `sucursal`(`id`,`sucname`,`sucdesc`,`sucdir`,`suctel`,`empresa`,`principal`) values (1,'Sede Villa zambreano','Primera sucursal','Calle 123','3925222',1,1),(2,'Sede centro','Nueva sede','Calle 70 # 2-19','300321',1,0);

/*Table structure for table `tipodescarga` */

DROP TABLE IF EXISTS `tipodescarga`;

CREATE TABLE `tipodescarga` (
  `tideCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `tideNombre` varchar(100) NOT NULL,
  `tideDescripcion` varchar(200) DEFAULT NULL,
  `tideEstado` varchar(2) DEFAULT 'AC',
  PRIMARY KEY (`tideCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tipodescarga` */

insert  into `tipodescarga`(`tideCodigo`,`tideNombre`,`tideDescripcion`,`tideEstado`) values (1,'Unidad',NULL,'AC'),(2,'Gramos',NULL,'AC'),(3,'Mililitros',NULL,'AC');

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

/*Data for the table `users` */

insert  into `users`(`username`,`userpass`,`userdoc`,`userid`,`userusu`,`usertele`,`userdir`,`usercorreo`,`userestado`,`keypass`,`keypass_tmp`,`session`,`rol`,`sucursal`) values ('JESÚS MENDOZA','$2a$10$1678a2a3409f453608e54urdbutdZFr0MASRFja6.YXzt0GaAM7Z2','1042450864',19,'JMEN','3002119842','Calle 70 # 2-19 2','jmen95@misena.edu.co','AC',0,'',1484435185,1,NULL),('Mendoza','$2a$10$236c4c2076cb550299af3uSpItfj0GHioCp2vfBFxC0sq5euA876C','1234',21,'xile','3004355896','Calle 70 # 2-19','xilenemendoza@gmail.com','AC',0,'',0,1,1),('Walter Martinez','$2a$10$5e2a0f4e877c2a0a4b48buGL99D/pE5wbXoFqeAsVmp8xsVwjC/xS','123',22,'wmartinez','3017485','calle falsa 123','g7wal@gmail.com','AC',0,'',0,1,1);

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `ventId` int(11) NOT NULL AUTO_INCREMENT,
  `ventCostoTotal` int(11) NOT NULL,
  `venFechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `venta` */

/*Table structure for table `ventadetalle` */

DROP TABLE IF EXISTS `ventadetalle`;

CREATE TABLE `ventadetalle` (
  `vedeId` int(11) NOT NULL AUTO_INCREMENT,
  `vedeIdVenta` int(11) NOT NULL,
  `vedeCodigoBarrasProducto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `vedeNombreProducto` varchar(700) COLLATE utf8_spanish2_ci NOT NULL,
  `vedePrecioVentaUnitarioProducto` int(11) NOT NULL,
  `vedeCantidad` int(11) NOT NULL,
  `vedeTotalPrecioVenta` int(11) NOT NULL,
  `vedeDescuentoint` int(11) DEFAULT NULL,
  PRIMARY KEY (`vedeId`),
  KEY `vedeIdVenta` (`vedeIdVenta`),
  KEY `vedeCodigoBarrasProducto` (`vedeCodigoBarrasProducto`),
  CONSTRAINT `ventadetalle_ibfk_1` FOREIGN KEY (`vedeIdVenta`) REFERENCES `venta` (`ventId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ventadetalle_ibfk_2` FOREIGN KEY (`vedeCodigoBarrasProducto`) REFERENCES `producto` (`proCodigoBarra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `ventadetalle` */

/* Trigger structure for table `producto` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insertarPro` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `insertarPro` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    INSERT INTO auditoria(Fecha,Hora,Accion,producto,sucursal) VALUES (CURDATE(),curtime(),"Insertar",NEW.proCodigoBarra,NEW.sucursal);
    insert into movimientos values(0,NEW.proIdUsuario,NEW.proCodigoBarra,"Agregado",new.proStockBodega);
END */$$


DELIMITER ;

/* Trigger structure for table `producto` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `actualizarPro` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `actualizarPro` AFTER UPDATE ON `producto` FOR EACH ROW BEGIN
	DECLARE cantidad int;
	DECLARE accion varchar(100);
	INSERT INTO auditoria(Fecha,Hora,Accion,producto,sucursal) VALUES (CURDATE(),CURTIME(),"Actualizar",NEW.proCodigoBarra,NEW.sucursal);
	IF OLD.proStockBodega<>new.proStockBodega THEN
		IF OLD.proStockBodega>NEW.proStockBodega THEN
			SET accion="Egreso";
			set cantidad=OLD.proStockBodega-NEW.proStockBodega;
		ELSE
			SET accion="Ingreso";
			SET cantidad=NEW.proStockBodega-OLD.proStockBodega;
		END IF;
		INSERT INTO movimientos VALUES(0,NEW.proIdUsuario,proCodigoBarra,accion,cantidad);
	END IF;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
