-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Out-2019 às 03:12
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `nm_nome` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `ds_login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ds_senha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_login` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`nm_nome`, `ds_login`, `ds_senha`, `id_login`) VALUES
('natanael', 'natanael', '123', 1),
('veus', 'veus', 'veus', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_prod` int(10) NOT NULL,
  `ds_prod` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `ds_marca` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `vl_preco` double NOT NULL,
  `qt_estoque` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_prod`, `ds_prod`, `ds_marca`, `vl_preco`, `qt_estoque`) VALUES
(17, 'pasta de dente', 'sorriso', 2.69, 78),
(18, 'batata chips', 'ruffles', 85545.52, 44),
(19, 'produto sem nome', 'marca sem nome', 10.2, 1),
(20, 'produto 15', 'marca7', 855.45, 22),
(21, 'produto 16', 'marca', 10.2, 16),
(22, 'produto 17', 'marca', 10.2, 17),
(23, 'produto 18', 'marca', 10.2, 18),
(25, 'produto 20', 'marca', 10.2, 20),
(26, 'produto 21', 'marca', 10.2, 21),
(27, 'produto 22', 'marca', 10.2, 22),
(28, 'produto 23', 'marca', 10.2, 23),
(29, 'produto 24', 'marca', 10.2, 24),
(30, 'produto 25', 'marca', 10.2, 25),
(31, 'produto 26', 'marca', 10.2, 26),
(32, 'produto 27', 'marca', 10.2, 27),
(33, 'produto 28', 'marca', 10.2, 28),
(34, 'produto 29', 'marca', 10.2, 29),
(35, 'produto 30', 'marca', 10.2, 30),
(36, 'produto 31', 'marca', 10.2, 31),
(37, 'produto 32', 'marca', 10.2, 32),
(39, 'produto 34', 'marca', 10.2, 34),
(40, 'produto 35', 'marca', 10.2, 35),
(41, 'produto 36', 'marca', 10.2, 36),
(42, 'produto 37', 'marca', 10.2, 37),
(43, 'produto 38', 'marca', 10.2, 38),
(44, 'produto 39', 'marca', 10.2, 39),
(45, 'produto 40', 'marca', 10.2, 40),
(46, 'produto 41', 'marca', 10.2, 41),
(47, 'produto 42', 'marca', 10.2, 42),
(48, 'produto 43', 'marca', 10.2, 43),
(49, 'produto 44', 'marca', 10.2, 44),
(50, 'produto 45', 'marca', 10.2, 45),
(51, 'produto 46', 'marca', 10.2, 46),
(52, 'produto 47', 'marca', 10.2, 47);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_prod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_prod` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
