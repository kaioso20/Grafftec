-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Jan-2019 às 20:39
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leilao_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lance_tb`
--

CREATE TABLE `lance_tb` (
  `id_lance` int(5) NOT NULL,
  `id_pessoa` int(5) NOT NULL,
  `id_produto` int(5) NOT NULL,
  `valor_lance` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lance_tb`
--

INSERT INTO `lance_tb` (`id_lance`, `id_pessoa`, `id_produto`, `valor_lance`) VALUES
(19, 50, 12, '51,35'),
(20, 51, 12, '56,78'),
(21, 50, 9, '2,35'),
(25, 51, 13, '3250,52'),
(26, 50, 14, '4,56'),
(27, 51, 12, '60,00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_tb`
--

CREATE TABLE `pessoa_tb` (
  `id_pessoa` int(5) NOT NULL,
  `nm_pessoa` varchar(30) DEFAULT NULL,
  `idade` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa_tb`
--

INSERT INTO `pessoa_tb` (`id_pessoa`, `nm_pessoa`, `idade`) VALUES
(50, 'Caio R. Gabardo', 19),
(51, 'Fernando Lima', 25),
(52, 'Maria Carmem', 24),
(53, 'Kassandra', 52),
(54, 'Leticia Amorim', 68),
(55, 'Germano Krows', 26),
(56, 'Kauane Cavalcanti', 18),
(57, 'Elenize Rosana Gabardo', 51);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_tb`
--

CREATE TABLE `produto_tb` (
  `id_produto` int(5) NOT NULL,
  `nm_prod` varchar(60) DEFAULT NULL,
  `valor_inicial` varchar(12) DEFAULT NULL,
  `valor_final` varchar(12) DEFAULT NULL,
  `id_pessoa` int(5) DEFAULT NULL COMMENT 'Pessoa se refere a quem gerou o produto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto_tb`
--

INSERT INTO `produto_tb` (`id_produto`, `nm_prod`, `valor_inicial`, `valor_final`, `id_pessoa`) VALUES
(9, 'Teste de PlÃ¡stico', '2,00', NULL, 50),
(11, 'TÃªnis Adidas UB', '212,39', NULL, 50),
(12, 'Ventilador PortÃ¡til', '50,00', NULL, 55),
(13, 'TelevisÃ£o 49\"', '2235,50', '3250,52', 50),
(14, 'Sabonete Natura', '3,50', '4,56', 57);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lance_tb`
--
ALTER TABLE `lance_tb`
  ADD PRIMARY KEY (`id_lance`),
  ADD KEY `id_pessoa` (`id_pessoa`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Indexes for table `pessoa_tb`
--
ALTER TABLE `pessoa_tb`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Indexes for table `produto_tb`
--
ALTER TABLE `produto_tb`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_pessoa` (`id_pessoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lance_tb`
--
ALTER TABLE `lance_tb`
  MODIFY `id_lance` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pessoa_tb`
--
ALTER TABLE `pessoa_tb`
  MODIFY `id_pessoa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `produto_tb`
--
ALTER TABLE `produto_tb`
  MODIFY `id_produto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `lance_tb`
--
ALTER TABLE `lance_tb`
  ADD CONSTRAINT `lance_tb_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa_tb` (`id_pessoa`),
  ADD CONSTRAINT `lance_tb_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto_tb` (`id_produto`);

--
-- Limitadores para a tabela `produto_tb`
--
ALTER TABLE `produto_tb`
  ADD CONSTRAINT `produto_tb_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa_tb` (`id_pessoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
