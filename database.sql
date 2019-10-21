-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Out-2019 às 00:51
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vs-challenge`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `brand`
--

INSERT INTO `brand` (`id`, `name`, `created`, `updated`) VALUES
(1, 'Kasvi', '2019-10-20 01:34:52', NULL),
(2, 'Marte', '2019-10-20 01:36:13', NULL),
(3, 'Sdorf Scientific', '2019-10-20 01:36:37', '2019-10-20 07:02:17'),
(4, 'Hanna Instruments', '2019-10-20 01:36:52', NULL),
(5, 'Fisatom', '2019-10-20 01:36:59', NULL),
(6, 'Nalgon', '2019-10-20 01:37:25', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `idBrand` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amount` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`id`, `idBrand`, `name`, `price`, `amount`, `created`, `updated`) VALUES
(1, 1, 'FILTRO PARA SERINGA MEMBRANA PES ESTÉRIL', '7.50', 10, '2019-10-20 04:00:52', NULL),
(2, 1, 'PLACA PARA CULTIVO DE CÉLULAS E TECIDOS FUNDO CHATO', '7.56', 100, '2019-10-20 04:04:14', NULL),
(3, 2, 'DESTILADOR DE ÁGUA TIPO PILSEN', '1472.00', 30, '2019-10-20 04:05:46', NULL),
(4, 2, 'BALANÇA DIGITAL SEMI ANALITICA COM PROCESSADOR ESTATÍSTICO', '2768.00', 5, '2019-10-20 04:06:48', NULL),
(5, 3, 'CHECKER®HC ANALISADOR DE COR DE ÁGUA FAIXA 0-500 PCU HI727', '331.78', 7, '2019-10-20 04:09:19', NULL),
(6, 4, 'INDICADOR DE CONDUTIVIDADE (EC) HI983304', '633.60', 20, '2019-10-20 04:10:30', NULL),
(7, 4, 'REFRATOMETRO DIGITAL PARA ANÁLISE DE ÁGUA SALGADA HI96822', '1513.00', 3, '2019-10-20 04:14:16', NULL),
(8, 5, 'AGITADOR MAGNÉTICO COM AQUECIMENTO', '1728.00', 0, '2019-10-20 04:16:01', NULL),
(9, 5, 'MANTA AQUECEDORA COM REGULADOR DE POTÊNCIA', '617.60', 1, '2019-10-20 04:16:32', NULL),
(10, 5, 'CHAPA AQUECEDORA ANALÓGICA EM ALUMÍNIO 31X31CM ATÉ 360ºC 509', '3836.80', 15, '2019-10-20 04:17:19', NULL),
(13, 1, 'Teste Editado', '15.99', 0, '2019-10-21 00:49:08', '2019-10-21 00:53:13');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unq_product_name` (`name`),
  ADD KEY `idx_product_idBrand` (`idBrand`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_idBrand` FOREIGN KEY (`idBrand`) REFERENCES `brand` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
