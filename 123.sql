-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.13-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных test2
DROP DATABASE IF EXISTS `test2`;
CREATE DATABASE IF NOT EXISTS `test2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test2`;

-- Дамп структуры для таблица test2.basket
DROP TABLE IF EXISTS `basket`;
CREATE TABLE IF NOT EXISTS `basket` (
  `id_basket` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_good` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  `is_in_order` tinyint(4) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_basket`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


-- Дамп структуры для таблица test2.goods
DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
  `id_good` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` double DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1-доступен\r\n2-нет на складе\r\n3-предзаказ',
  PRIMARY KEY (`id_good`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test2.goods: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` (`id_good`, `name`, `price`, `id_category`, `status`) VALUES
	(3, 'Intel Core i3-2100', 4543, 1, 1),
	(4, 'GeForce 6600', 3780, NULL, NULL),
	(6, 'AMD Radeon 7770 1Gb', 4350, NULL, NULL),
	(7, 'test3', 103, NULL, NULL),
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;

-- Дамп структуры для таблица test2.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `datetime_create` datetime DEFAULT current_timestamp(),
  `id_order_status` int(11) NOT NULL,
  `destination` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


-- Дамп структуры для таблица test2.order_status
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id_order_status` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_order_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test2.order_status: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` (`id_order_status`, `order_status_name`) VALUES
	(1, 'сформирован'),
	(2, 'отправлен');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;

-- Дамп структуры для таблица test2.pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test2.pages: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Дамп структуры для таблица test2.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test2.role: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `role_name`) VALUES
	(1, 'admin'),
	(2, 'manager'),
	(3, 'user');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Дамп структуры для таблица test2.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL DEFAULT 3,
  `user_name` varchar(50) DEFAULT NULL,
  `user_login` varchar(50) NOT NULL,
  `user_password` varchar(60) DEFAULT NULL,
  `user_last_action` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test2.user: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `id_role`, `user_name`, `user_login`, `user_password`, `user_last_action`) VALUES
	(3, 1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2019-07-21 13:45:48');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
