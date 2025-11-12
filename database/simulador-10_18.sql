-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/10/2024 às 21:05
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
  `fk_produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `codigo`, `peso`, `fk_produto`) VALUES
(1, 'PA1A1', 10, 1),
(2, 'PA1A2', NULL, NULL),
(3, 'PA1A3', NULL, NULL),
(4, 'PA1A4', NULL, NULL),
(5, 'PA1B1', NULL, NULL),
(6, 'PA1B2', NULL, NULL),
(7, 'PA1B3', NULL, NULL),
(8, 'PA1B4', NULL, NULL),
(9, 'PA1C1', NULL, NULL),
(10, 'PA1C2', NULL, NULL),
(11, 'PA1C3', NULL, NULL),
(12, 'PA1C4', NULL, NULL),
(13, 'PA1D1', NULL, NULL),
(14, 'PA1D2', NULL, NULL),
(15, 'PA1D3', NULL, NULL),
(16, 'PA1D4', NULL, NULL),
(17, 'PA1E1', NULL, NULL),
(18, 'PA1E2', NULL, NULL),
(19, 'PA1E3', NULL, NULL),
(20, 'PA1E4', NULL, NULL),
(21, 'PA1F1', NULL, NULL),
(22, 'PA1F2', NULL, NULL),
(23, 'PA1F3', NULL, NULL),
(24, 'PA1F4', NULL, NULL),
(25, 'PA1G1', NULL, NULL),
(26, 'PA1G2', NULL, NULL),
(27, 'PA1G3', NULL, NULL),
(28, 'PA1G4', NULL, NULL),
(29, 'PA1H1', NULL, NULL),
(30, 'PA1H2', NULL, NULL),
(31, 'PA1H3', NULL, NULL),
(32, 'PA1H4', NULL, NULL),
(33, 'PA1I1', NULL, NULL),
(34, 'PA1I2', NULL, NULL),
(35, 'PA1I3', NULL, NULL),
(36, 'PA1I4', NULL, NULL),
(37, 'PA1J1', NULL, NULL),
(38, 'PA1J2', NULL, NULL),
(39, 'PA1J3', NULL, NULL),
(40, 'PA1J4', NULL, NULL),
(41, 'PA1K1', NULL, NULL),
(42, 'PA1K2', NULL, NULL),
(43, 'PA1K3', NULL, NULL),
(44, 'PA1K4', NULL, NULL),
(45, 'PA1L1', NULL, NULL),
(46, 'PA1L2', NULL, NULL),
(47, 'PA1L3', NULL, NULL),
(48, 'PA1L4', NULL, NULL),
(49, 'PA1M1', NULL, NULL),
(50, 'PA1M2', NULL, NULL),
(51, 'PA1M3', NULL, NULL),
(52, 'PA1M4', NULL, NULL),
(53, 'PA1N1', NULL, NULL),
(54, 'PA1N2', NULL, NULL),
(55, 'PA1N3', NULL, NULL),
(56, 'PA1N4', NULL, NULL),
(57, 'PA1O1', NULL, NULL),
(58, 'PA1O2', NULL, NULL),
(59, 'PA1O3', NULL, NULL),
(60, 'PA1O4', NULL, NULL),
(61, 'PA1P1', NULL, NULL),
(62, 'PA1P2', NULL, NULL),
(63, 'PA1P3', NULL, NULL),
(64, 'PA1P4', NULL, NULL),
(65, 'PA1Q1', NULL, NULL),
(66, 'PA1Q2', NULL, NULL),
(67, 'PA1Q3', NULL, NULL),
(68, 'PA1Q4', NULL, NULL),
(69, 'PA1R1', NULL, NULL),
(70, 'PA1R2', NULL, NULL),
(71, 'PA1R3', NULL, NULL),
(72, 'PA1R4', NULL, NULL),
(73, 'PA1S1', NULL, NULL),
(74, 'PA1S2', NULL, NULL),
(75, 'PA1S3', NULL, NULL),
(76, 'PA1S4', NULL, NULL),
(77, 'PA1T1', NULL, NULL),
(78, 'PA1T2', NULL, NULL),
(79, 'PA1T3', NULL, NULL),
(80, 'PA1T4', NULL, NULL),
(81, 'PA1U1', NULL, NULL),
(82, 'PA1U2', NULL, NULL),
(83, 'PA1U3', NULL, NULL),
(84, 'PA1U4', NULL, NULL),
(85, 'PA1V1', NULL, NULL),
(86, 'PA1V2', NULL, NULL),
(87, 'PA1V3', NULL, NULL),
(88, 'PA1V4', NULL, NULL),
(89, 'PARUA', NULL, NULL);

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
(1, 'Chuletaão'),
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
  `tipo` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '1', 'CARNE MOIDA CONG BOVINO - TUBETE 500G - MARCA CHULETAO - CX 10KG', NULL);

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
  ADD KEY `fk_produto` (`fk_produto`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`fk_produto`) REFERENCES `produtos` (`id`);

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
