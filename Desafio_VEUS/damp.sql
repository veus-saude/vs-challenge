-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Maio-2019 às 07:53
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 5.6.40

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
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idproduto` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `marca` varchar(100) COLLATE utf8_bin NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idproduto`, `nome`, `marca`, `preco`, `quantidade`) VALUES
(1, 'Seringa', 'BUNZL', '10.50', 10),
(2, 'Seringa', 'XXXX', '5.00', 10),
(3, 'Seringa', 'bbbbbbbbbbb', '5.00', 6),
(4, 'Seringa', 'XXXX', '5.00', 10),
(5, 'Seringa', 'AAAAAAAAAAAA', '5.00', 6),
(6, 'Seringa', 'BBBBBBBBBBB', '7.00', 6),
(7, 'Seringa', 'CCCCCCCCCC', '7.00', 6),
(8, 'Seringa', 'DDDDDDDDDDD', '8.00', 6),
(9, 'Seringa', 'EEEEEEEEEEE', '9.00', 6),
(10, 'Seringa', 'FFFFFFFFFF', '5.00', 6),
(11, 'Seringa', 'GGGGGGGGGGGG', '5.00', 6),
(12, 'Seringa', 'HHHHHHHHHHHH', '5.00', 6),
(13, 'Seringa', 'JJJJJJJJJJJJ', '5.00', 6),
(14, 'Seringa', 'LLLLLLLLLLL', '5.00', 6),
(15, 'Seringa', 'MMMMMMMMMM', '5.00', 6),
(16, 'Seringa', 'NNNNNNNNNNN', '5.00', 6),
(17, 'Seringa', 'KKKKKKKKKKKK', '5.00', 6),
(18, 'Seringa', 'ZZZZZZZZZZZZ', '5.00', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `senha` varchar(100) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`, `login`) VALUES
(1, 'Felipe Alves de Oliveira', 'feliperj629@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'felipe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idproduto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
