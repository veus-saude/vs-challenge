-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.30-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para veus
DROP DATABASE IF EXISTS `veus`;
CREATE DATABASE IF NOT EXISTS `veus` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `veus`;

-- Copiando estrutura para tabela veus.api_authorization
DROP TABLE IF EXISTS `api_authorization`;
CREATE TABLE IF NOT EXISTS `api_authorization` (
  `id_api_authorization` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `header` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expires_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_api_authorization`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela veus.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_clients` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `image` varchar(100) NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_clients`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela veus.client_keys
DROP TABLE IF EXISTS `client_keys`;
CREATE TABLE IF NOT EXISTS `client_keys` (
  `id_clients_keys` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL DEFAULT '0',
  `key` varchar(50) NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id_clients_keys`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela veus.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_products` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL DEFAULT '',
  `price` float(18,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_products`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
