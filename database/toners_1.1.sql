-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/09/2024 às 21:10
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
-- Banco de dados: `alles`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `toners`
--

CREATE TABLE `toners` (
  `idToner` int(11) NOT NULL,
  `modeloToner` varchar(100) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `cheio` int(11) NOT NULL,
  `vazio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `toners`
--

INSERT INTO `toners` (`idToner`, `modeloToner`, `cor`, `cheio`, `vazio`) VALUES
(1, 'testes', 'Preto', 4, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `toners`
--
ALTER TABLE `toners`
  ADD PRIMARY KEY (`idToner`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `toners`
--
ALTER TABLE `toners`
  MODIFY `idToner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
