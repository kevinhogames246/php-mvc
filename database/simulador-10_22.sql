-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/10/2024 às 22:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `simulador`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `peso` double DEFAULT NULL,
  `fk_produto` int(11) DEFAULT NULL,
  `armazem` varchar(2) NOT NULL,
  `rua` varchar(1) NOT NULL,
  `coluna` varchar(1) NOT NULL,
  `andar` varchar(1) NOT NULL,
  `fk_movimento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `codigo`, `peso`, `fk_produto`, `armazem`, `rua`, `coluna`, `andar`, `fk_movimento`) VALUES
(1, 'PA1A1', 2000, 1, 'PA', '1', 'A', '1', 14),
(2, 'PA1A2', 220, 3, 'PA', '1', 'A', '2', 15),
(3, 'PA1A3', NULL, NULL, 'PA', '1', 'A', '3', NULL),
(4, 'PA1A4', NULL, NULL, 'PA', '1', 'A', '4', NULL),
(5, 'PA1B1', NULL, NULL, 'PA', '1', 'B', '1', NULL),
(6, 'PA1B2', NULL, NULL, 'PA', '1', 'B', '2', NULL),
(7, 'PA1B3', NULL, NULL, 'PA', '1', 'B', '3', NULL),
(8, 'PA1B4', NULL, NULL, 'PA', '1', 'B', '4', NULL),
(9, 'PA1C1', NULL, NULL, 'PA', '1', 'C', '1', NULL),
(10, 'PA1C2', NULL, NULL, 'PA', '1', 'C', '2', NULL),
(11, 'PA1C3', NULL, NULL, 'PA', '1', 'C', '3', NULL),
(12, 'PA1C4', NULL, NULL, 'PA', '1', 'C', '4', NULL),
(13, 'PA1D1', NULL, NULL, 'PA', '1', 'D', '1', NULL),
(14, 'PA1D2', NULL, NULL, 'PA', '1', 'D', '2', NULL),
(15, 'PA1D3', NULL, NULL, 'PA', '1', 'D', '3', NULL),
(16, 'PA1D4', NULL, NULL, 'PA', '1', 'D', '4', NULL),
(17, 'PA1E1', NULL, NULL, 'PA', '1', 'E', '1', NULL),
(18, 'PA1E2', NULL, NULL, 'PA', '1', 'E', '2', NULL),
(19, 'PA1E3', NULL, NULL, 'PA', '1', 'E', '3', NULL),
(20, 'PA1E4', NULL, NULL, 'PA', '1', 'E', '4', NULL),
(21, 'PA1F1', NULL, NULL, 'PA', '1', 'F', '1', NULL),
(22, 'PA1F2', NULL, NULL, 'PA', '1', 'F', '2', NULL),
(23, 'PA1F3', NULL, NULL, 'PA', '1', 'F', '3', NULL),
(24, 'PA1F4', NULL, NULL, 'PA', '1', 'F', '4', NULL),
(25, 'PA1G1', NULL, NULL, 'PA', '1', 'G', '1', NULL),
(26, 'PA1G2', NULL, NULL, 'PA', '1', 'G', '2', NULL),
(27, 'PA1G3', NULL, NULL, 'PA', '1', 'G', '3', NULL),
(28, 'PA1G4', NULL, NULL, 'PA', '1', 'G', '4', NULL),
(29, 'PA1H1', NULL, NULL, 'PA', '1', 'H', '1', NULL),
(30, 'PA1H2', NULL, NULL, 'PA', '1', 'H', '2', NULL),
(31, 'PA1H3', NULL, NULL, 'PA', '1', 'H', '3', NULL),
(32, 'PA1H4', NULL, NULL, 'PA', '1', 'H', '4', NULL),
(33, 'PA1I1', NULL, NULL, 'PA', '1', 'I', '1', NULL),
(34, 'PA1I2', NULL, NULL, 'PA', '1', 'I', '2', NULL),
(35, 'PA1I3', NULL, NULL, 'PA', '1', 'I', '3', NULL),
(36, 'PA1I4', NULL, NULL, 'PA', '1', 'I', '4', NULL),
(37, 'PA1J1', NULL, NULL, 'PA', '1', 'J', '1', NULL),
(38, 'PA1J2', NULL, NULL, 'PA', '1', 'J', '2', NULL),
(39, 'PA1J3', NULL, NULL, 'PA', '1', 'J', '3', NULL),
(40, 'PA1J4', NULL, NULL, 'PA', '1', 'J', '4', NULL),
(41, 'PA1K1', NULL, NULL, 'PA', '1', 'K', '1', NULL),
(42, 'PA1K2', NULL, NULL, 'PA', '1', 'K', '2', NULL),
(43, 'PA1K3', NULL, NULL, 'PA', '1', 'K', '3', NULL),
(44, 'PA1K4', NULL, NULL, 'PA', '1', 'K', '4', NULL),
(45, 'PA1L1', NULL, NULL, 'PA', '1', 'L', '1', NULL),
(46, 'PA1L2', NULL, NULL, 'PA', '1', 'L', '2', NULL),
(47, 'PA1L3', NULL, NULL, 'PA', '1', 'L', '3', NULL),
(48, 'PA1L4', NULL, NULL, 'PA', '1', 'L', '4', NULL),
(49, 'PA1M1', NULL, NULL, 'PA', '1', 'M', '1', NULL),
(50, 'PA1M2', NULL, NULL, 'PA', '1', 'M', '2', NULL),
(51, 'PA1M3', NULL, NULL, 'PA', '1', 'M', '3', NULL),
(52, 'PA1M4', NULL, NULL, 'PA', '1', 'M', '4', NULL),
(53, 'PA1N1', NULL, NULL, 'PA', '1', 'N', '1', NULL),
(54, 'PA1N2', NULL, NULL, 'PA', '1', 'N', '2', NULL),
(55, 'PA1N3', NULL, NULL, 'PA', '1', 'N', '3', NULL),
(56, 'PA1N4', NULL, NULL, 'PA', '1', 'N', '4', NULL),
(57, 'PA1O1', NULL, NULL, 'PA', '1', 'O', '1', NULL),
(58, 'PA1O2', NULL, NULL, 'PA', '1', 'O', '2', NULL),
(59, 'PA1O3', NULL, NULL, 'PA', '1', 'O', '3', NULL),
(60, 'PA1O4', NULL, NULL, 'PA', '1', 'O', '4', NULL),
(61, 'PA1P1', NULL, NULL, 'PA', '1', 'P', '1', NULL),
(62, 'PA1P2', NULL, NULL, 'PA', '1', 'P', '2', NULL),
(63, 'PA1P3', NULL, NULL, 'PA', '1', 'P', '3', NULL),
(64, 'PA1P4', NULL, NULL, 'PA', '1', 'P', '4', NULL),
(65, 'PA1Q1', NULL, NULL, 'PA', '1', 'Q', '1', NULL),
(66, 'PA1Q2', NULL, NULL, 'PA', '1', 'Q', '2', NULL),
(67, 'PA1Q3', NULL, NULL, 'PA', '1', 'Q', '3', NULL),
(68, 'PA1Q4', NULL, NULL, 'PA', '1', 'Q', '4', NULL),
(69, 'PA1R1', NULL, NULL, 'PA', '1', 'R', '1', NULL),
(70, 'PA1R2', NULL, NULL, 'PA', '1', 'R', '2', NULL),
(71, 'PA1R3', NULL, NULL, 'PA', '1', 'R', '3', NULL),
(72, 'PA1R4', NULL, NULL, 'PA', '1', 'R', '4', NULL),
(73, 'PA1S1', NULL, NULL, 'PA', '1', 'S', '1', NULL),
(74, 'PA1S2', NULL, NULL, 'PA', '1', 'S', '2', NULL),
(75, 'PA1S3', NULL, NULL, 'PA', '1', 'S', '3', NULL),
(76, 'PA1S4', NULL, NULL, 'PA', '1', 'S', '4', NULL),
(77, 'PA1T1', NULL, NULL, 'PA', '1', 'T', '1', NULL),
(78, 'PA1T2', NULL, NULL, 'PA', '1', 'T', '2', NULL),
(79, 'PA1T3', NULL, NULL, 'PA', '1', 'T', '3', NULL),
(80, 'PA1T4', NULL, NULL, 'PA', '1', 'T', '4', NULL),
(81, 'PA1U1', NULL, NULL, 'PA', '1', 'U', '1', NULL),
(82, 'PA1U2', NULL, NULL, 'PA', '1', 'U', '2', NULL),
(83, 'PA1U3', NULL, NULL, 'PA', '1', 'U', '3', NULL),
(84, 'PA1U4', NULL, NULL, 'PA', '1', 'U', '4', NULL),
(85, 'PA1V1', NULL, NULL, 'PA', '1', 'V', '1', NULL),
(86, 'PA1V2', NULL, NULL, 'PA', '1', 'V', '2', NULL),
(87, 'PA1V3', NULL, NULL, 'PA', '1', 'V', '3', NULL),
(88, 'PA1V4', NULL, NULL, 'PA', '1', 'V', '4', NULL),
(89, 'PARUA', NULL, NULL, 'PA', 'R', 'U', 'A', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marcas`
--

INSERT INTO `marcas` (`id`, `nome`) VALUES
(1, 'Chuletão'),
(2, 'Alleza'),
(3, 'Rm'),
(4, 'Nova Itaberaba'),
(5, 'Beef Passion');

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentos`
--

CREATE TABLE `movimentos` (
  `id` int(11) NOT NULL,
  `fk_produto` int(11) NOT NULL,
  `fk_endereco` int(11) NOT NULL,
  `peso` double NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `movimentos`
--

INSERT INTO `movimentos` (`id`, `fk_produto`, `fk_endereco`, `peso`, `tipo`, `fk_usuario`) VALUES
(5, 1, 1, 0, '0', 1),
(6, 1, 1, 0, '0', 1),
(7, 1, 1, 0, '0', 1),
(8, 1, 1, 0, '0', 1),
(9, 1, 1, 20, 'Saida', 1),
(10, 1, 1, 20, 'Entrada', 1),
(11, 1, 1, 500, 'Entrada', 1),
(12, 1, 1, 20, 'Saida', 1),
(13, 1, 1, 500, 'Entrada', 1),
(14, 1, 1, 1000, 'Entrada', 1),
(15, 6, 2, 220, 'Entrada', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `fk_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `nome`, `fk_marca`) VALUES
(1, '1', 'CARNE MOIDA CONG BOVINO - TUBETE 500G - MARCA CHULETAO - CX 10KG', 1),
(2, '2', 'CARNE MOIDA CONG SUINA - TUBETE 500G - CHULETÃO - CX 10KG', 1),
(3, '4', 'CARNE MOIDA CONG BOVINO - TERMOFORMADA 1KG - ALLEZA - CX 12KG', 2),
(4, '5', 'CARNE MOIDA CONG BOVINO - TERMOFORMADA 1KG - CHULETAO - CX 12KG', 1),
(5, '6', 'CARNE MOIDA CONG BOVINO - TUBETE 400G - RM - CX 10KG', 3),
(6, '7', 'CARNE MOIDA CONG BOVINO - SC 500G - NOVA ITABERABA - CX 10 KG', 4),
(7, '8', 'CARNE MOIDA CONG BOVINO - TUBETE 400G - CHULETÃO - CX 10KG', 1),
(8, '9', 'CARNE MOIDA CONG BOVINO - TUBETE 400G - CHULETÃO - CX 9,600KG', 1),
(9, '10', 'CARNE MOIDA CONG SUINA - TUBETE 500G - NOVA ITABERABA - CX10KG', 4),
(10, '11', 'CARNE MOIDA CONG BOVINO - TUBETE 500G - CHULETAO - CX 10KG', 1),
(11, '14', 'CARNE MOIDA CONG BOVINO - TERMOFORMADA 500G - CHULETÃO - CX 12KG', 1),
(12, '15', 'CARNE MOIDA CONG BOVINO - TERMOFORMADA 500G - ALLEZA - CX 12KG', 2),
(13, '18', 'CARNE MOIDA CONG FRANGO - TUBETE 500G - CHULETÃO - CX 10KG', 1),
(14, '22', 'CARNE MOIDA CONG BOVINO - TERM 2KG - BEEF PASSION', 5),
(15, '31', 'CARNE MOIDA CONG BOVINO EMB AZUL - TUBETE 500G - CHULETÃO - CX 10KG', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `nivel`) VALUES
(1, 'Kevin Queiroz Cardoso', 'kevin.cardoso', '2655', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_produto` (`fk_produto`),
  ADD KEY `fk_movimento` (`fk_movimento`);

--
-- Índices de tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movimentos`
--
ALTER TABLE `movimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto` (`fk_produto`),
  ADD KEY `fk_endereco` (`fk_endereco`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_marca` (`fk_marca`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `movimentos`
--
ALTER TABLE `movimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`fk_produto`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `fk_movimento` FOREIGN KEY (`fk_movimento`) REFERENCES `movimentos` (`id`);

--
-- Restrições para tabelas `movimentos`
--
ALTER TABLE `movimentos`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `movimentos_ibfk_1` FOREIGN KEY (`fk_produto`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `movimentos_ibfk_2` FOREIGN KEY (`fk_endereco`) REFERENCES `enderecos` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`fk_marca`) REFERENCES `marcas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
