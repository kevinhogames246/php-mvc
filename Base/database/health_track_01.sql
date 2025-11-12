-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29-Set-2023 às 02:53
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `health track`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `idFuncionario` int NOT NULL AUTO_INCREMENT,
  `fk_idPessoa` int DEFAULT NULL,
  `fk_idEspecialidade` int DEFAULT NULL,
  `fk_idCargo` int DEFAULT NULL,
  PRIMARY KEY (`idFuncionario`),
  KEY `fk_idPessoa` (`fk_idPessoa`),
  KEY `fk_idEspecialidade` (`fk_idEspecialidade`),
  KEY `fk_idCargo` (`fk_idCargo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `fk_idPessoa`, `fk_idEspecialidade`, `fk_idCargo`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `idPaciente` int NOT NULL AUTO_INCREMENT,
  `statusPaciente` varchar(20) DEFAULT NULL,
  `alergiasPaciente` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `doencaGeneticaPaciente` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `telEmergenciaPaciente` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `imagemPaciente` varbinary(8000) DEFAULT NULL,
  `fk_IdPessoa` int NOT NULL,
  PRIMARY KEY (`idPaciente`),
  KEY `fk_IdPessoa` (`fk_IdPessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`idPaciente`, `statusPaciente`, `alergiasPaciente`, `doencaGeneticaPaciente`, `telEmergenciaPaciente`, `imagemPaciente`, `fk_IdPessoa`) VALUES
(1, 'Vivo', 'Nenhuma', 'Nenhuma', '17996147456', NULL, 3),
(2, 'Doente', 'nenhuma', 'nenhuma', '17996147456', NULL, 23),
(16, 'Gos', 'Nenhuma que deixa feio', 'Nenhuma que deixa feio', '(11) 11111-1111', NULL, 51),
(14, '11/11/1111', 'Todas', 'Pessimo', 'Todas', NULL, 49),
(9, 'Top', 'fetchColumn();', 'fetchColumn();', '(11) 11111-1111', NULL, 44);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE IF NOT EXISTS `pessoas` (
  `idPessoa` int NOT NULL AUTO_INCREMENT,
  `nomePessoa` varchar(80) DEFAULT NULL,
  `emailPessoa` varchar(220) DEFAULT NULL,
  `senhaPessoa` varchar(220) DEFAULT NULL,
  `tipoPessoa` varchar(10) DEFAULT NULL,
  `docPessoa` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `enderecoPessoa` varchar(80) DEFAULT NULL,
  `telPessoa` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `dataNascPessoa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idPessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`idPessoa`, `nomePessoa`, `emailPessoa`, `senhaPessoa`, `tipoPessoa`, `docPessoa`, `enderecoPessoa`, `telPessoa`, `dataNascPessoa`) VALUES
(49, 'osvaldo', 'osvaldo@teste.com', '$2y$10$eZjJ3hfK4Czrkzvpc6qRJOAYpySaS7fPaToaBUSXZMeD7pPKfyeb.', 'user', '234.567.890-12', 'Rua dos cravos\r\n', 'Rua Waldemar Fu', '(22) 22222'),
(51, 'Gostoso', 'Usuario@teste.com', '$2y$10$s3eO/Ci.2Ea8Yie3echXIe8Qm1TeNocqs7A9r0EVibrSML3E5EU4e', 'user', '345.678.901-23', 'Rua Waldemar Fugiu Ynayama', '(11) 11111-1111', '1111-11-11'),
(24, 'Mateus', 'mateus@teste.com', '$2y$10$6M1ensAL6ZgM6hk8KS3f/.ExS.DGUe0AE3tSsQBL8G0lcuiEVOYY6', 'admin', '', '', '', ''),
(52, 'Chato', 'chato@teste.com', '$2y$10$n3fndA0SHULX2hvlGCihr.o/2Mbw1NWhtpf2z5K0GucLA3CXRHZ2G', 'admin', '456.789.012-34', 'Rua Waldemar Fugiu Ynayama', '(11) 11111-1111', '1111-11-11'),
(44, 'Alan Queiroz Cardoso', 'alan@teste.com', '$2y$10$z.V5iVpZStd95Stp7JOce.6eVsH.35y7AXOzQzZGscvXTa6XRDQCO', 'user', '123.456.789-01', 'Rua Waldemar Fugiu Ynayama, 40', '(11) 11111-1111', '11/11/1111');

-- --------------------------------------------------------

--
-- Estrutura da tabela `procedimentos`
--

DROP TABLE IF EXISTS `procedimentos`;
CREATE TABLE IF NOT EXISTS `procedimentos` (
  `idProcedimento` int NOT NULL AUTO_INCREMENT,
  `descProcedimento` varchar(80) DEFAULT NULL,
  `nomeProcedimento` varchar(80) NOT NULL,
  PRIMARY KEY (`idProcedimento`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `procedimentos`
--

INSERT INTO `procedimentos` (`idProcedimento`, `descProcedimento`, `nomeProcedimento`) VALUES
(1, 'Raio-x', 'Raio-x'),
(2, 'Tomar soro', 'é feita a aplicação de soro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processoproc`
--

DROP TABLE IF EXISTS `processoproc`;
CREATE TABLE IF NOT EXISTS `processoproc` (
  `idProcessoProc` int NOT NULL AUTO_INCREMENT,
  `dataHoraProcessoProc` datetime NOT NULL,
  `statusHistorico` varchar(10) NOT NULL,
  `receitaProcessoProc` varchar(200) DEFAULT NULL,
  `obsMedica` varchar(200) DEFAULT NULL,
  `fk_idProcesso` int NOT NULL,
  `fk_idProcedimento` int NOT NULL,
  PRIMARY KEY (`idProcessoProc`),
  KEY `fk_idProcesso` (`fk_idProcesso`),
  KEY `fk_idProcedimento` (`fk_idProcedimento`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `processoproc`
--

INSERT INTO `processoproc` (`idProcessoProc`, `dataHoraProcessoProc`, `statusHistorico`, `receitaProcessoProc`, `obsMedica`, `fk_idProcesso`, `fk_idProcedimento`) VALUES
(1, '0000-00-00 00:00:00', 'bom', NULL, NULL, 1, 1),
(3, '0000-00-00 00:00:00', 'Ruim', NULL, NULL, 1, 2),
(2, '0000-00-00 00:00:00', 'Otimo', NULL, NULL, 2, 1),
(4, '0000-00-00 00:00:00', 'Pécimo', NULL, NULL, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

DROP TABLE IF EXISTS `processos`;
CREATE TABLE IF NOT EXISTS `processos` (
  `idProcesso` int NOT NULL AUTO_INCREMENT,
  `protocoloProcesso` varchar(6) DEFAULT NULL,
  `dataInicialProcesso` date DEFAULT NULL,
  `dataFinalProcesso` date DEFAULT NULL,
  `condicaoProcesso` varchar(11) NOT NULL DEFAULT 'Ativo',
  `uniSaude` varchar(80) NOT NULL,
  `fk_idPaciente` int DEFAULT NULL,
  PRIMARY KEY (`idProcesso`),
  KEY `fk_idPaciente` (`fk_idPaciente`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `processos`
--

INSERT INTO `processos` (`idProcesso`, `protocoloProcesso`, `dataInicialProcesso`, `dataFinalProcesso`, `condicaoProcesso`, `uniSaude`, `fk_idPaciente`) VALUES
(1, 'AB11AB', '2023-09-27', '0000-00-00', 'Ativo', '', 1),
(3, 'AC12AC', NULL, NULL, 'Desativado', '', 1),
(2, 'AD13AD', '2023-09-20', NULL, 'Ativo', '', 9),
(4, 'AE14AE', NULL, NULL, 'Ativo', '', 9),
(5, 'AF15AF', '1111-11-11', '0000-00-00', 'Ativo', 'Santa Fé do Sul', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'kevin', '$2y$10$d3U0L04j9klpIoDaByIJaeRkyngYbDUqDGyC7RINRe6RcDXtLV6mS', 'admin'),
(2, 'Mateus', '$2y$10$6j.a60jGsfH5dCVhIxatROx4rraFXf4eqK5m4kzu9aDMFAJHMf8ma', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
