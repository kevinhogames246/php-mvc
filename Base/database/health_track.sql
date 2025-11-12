-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20-Nov-2023 às 23:17
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
-- Estrutura da tabela `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `idCargo` int NOT NULL AUTO_INCREMENT,
  `nomeCargo` varchar(80) NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`idCargo`, `nomeCargo`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE IF NOT EXISTS `especialidades` (
  `idEspecialidade` int NOT NULL AUTO_INCREMENT,
  `nomeEspecialidade` varchar(80) NOT NULL,
  `descEspecialidade` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idEspecialidade`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `especialidades`
--

INSERT INTO `especialidades` (`idEspecialidade`, `nomeEspecialidade`, `descEspecialidade`) VALUES
(1, 'Pediatra', 'Cuida dos pés');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exames`
--

DROP TABLE IF EXISTS `exames`;
CREATE TABLE IF NOT EXISTS `exames` (
  `idExame` int NOT NULL AUTO_INCREMENT,
  `nomeExame` varchar(80) NOT NULL,
  `unidadeExame` varchar(80) NOT NULL,
  `arquivoExame` varchar(40) DEFAULT NULL,
  `dataExame` date NOT NULL,
  `fk_idProcedimento` int NOT NULL,
  PRIMARY KEY (`idExame`),
  KEY `fk_idProcessoProc` (`fk_idProcedimento`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `idFuncionario` int NOT NULL AUTO_INCREMENT,
  `fk_idPessoa` int NOT NULL,
  `fk_idEspecialidade` int DEFAULT NULL,
  `fk_idCargo` int NOT NULL,
  PRIMARY KEY (`idFuncionario`),
  KEY `fk_idPessoa` (`fk_idPessoa`),
  KEY `fk_idEspecialidade` (`fk_idEspecialidade`),
  KEY `fk_idCargo` (`fk_idCargo`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`idFuncionario`, `fk_idPessoa`, `fk_idEspecialidade`, `fk_idCargo`) VALUES
(8, 298, 1, 1),
(6, 296, 1, 1),
(3, 280, 1, 1),
(7, 297, 1, 1),
(9, 299, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `idPaciente` int NOT NULL AUTO_INCREMENT,
  `statusPaciente` varchar(20) NOT NULL,
  `alergiaPaciente` varchar(300) DEFAULT NULL,
  `doencaGeneticaPaciente` varchar(300) DEFAULT NULL,
  `telEmergenciaPaciente` varchar(15) DEFAULT NULL,
  `fk_idPessoa` int NOT NULL,
  PRIMARY KEY (`idPaciente`),
  KEY `fk_paciente_pessoa1_idx` (`fk_idPessoa`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`idPaciente`, `statusPaciente`, `alergiaPaciente`, `doencaGeneticaPaciente`, `telEmergenciaPaciente`, `fk_idPessoa`) VALUES
(4, '', 'AWEREG', 'eeqrdsg', '', 65),
(115, '', '', '', '(99) 58741-5875', 295),
(103, 'Uma Merda', 'gente feia', 'Todas', ' (12) 45346-541', 281),
(116, 'Uma merda ', 'pó, poeira, leite, suor, pessoas', 'rinite, sinusite, ite ite', '(42) 75852-4758', 300),
(23, '', NULL, NULL, NULL, 83),
(24, '', NULL, NULL, NULL, 84),
(104, 'Uma merda ', 'Todas', 'Todas', '(13) 52465-7253', 283),
(26, '', NULL, NULL, NULL, 86),
(27, '', NULL, NULL, NULL, 87),
(28, '', NULL, NULL, NULL, 88),
(29, '', NULL, NULL, NULL, 89),
(31, '', NULL, NULL, NULL, 91),
(32, '', NULL, NULL, NULL, 92),
(34, '', NULL, NULL, NULL, 94),
(35, '', NULL, NULL, NULL, 95),
(36, '', NULL, NULL, NULL, 96),
(37, '', NULL, NULL, NULL, 97),
(38, '', NULL, NULL, NULL, 98),
(39, '', NULL, NULL, NULL, 99),
(40, '', NULL, NULL, NULL, 100),
(41, '', NULL, NULL, NULL, 101),
(42, '', NULL, NULL, NULL, 102),
(43, '', NULL, NULL, NULL, 103),
(44, '', NULL, NULL, NULL, 104),
(45, '', NULL, NULL, NULL, 105),
(46, '', NULL, NULL, NULL, 106),
(47, '', NULL, NULL, NULL, 107),
(48, '', NULL, NULL, NULL, 108),
(49, '', NULL, NULL, NULL, 109),
(50, '', NULL, NULL, NULL, 110),
(51, '', NULL, NULL, NULL, 111),
(52, '', NULL, NULL, NULL, 112),
(53, '', NULL, NULL, NULL, 113),
(54, '', NULL, NULL, NULL, 114),
(55, '', NULL, NULL, NULL, 115),
(56, '', NULL, NULL, NULL, 116),
(57, '', NULL, NULL, NULL, 117),
(58, '', NULL, NULL, NULL, 118),
(59, '', NULL, NULL, NULL, 119),
(60, '', NULL, NULL, NULL, 120),
(61, '', NULL, NULL, NULL, 121),
(62, '', NULL, NULL, NULL, 122),
(63, '', NULL, NULL, NULL, 123),
(64, '', NULL, NULL, NULL, 124),
(113, 'Estavel', '', '', '(17) 99666-0329', 292),
(66, '', NULL, NULL, NULL, 126),
(67, '', NULL, NULL, NULL, 127),
(68, '', NULL, NULL, NULL, 128),
(69, '', NULL, NULL, NULL, 129),
(70, '', NULL, NULL, NULL, 130),
(71, '', NULL, NULL, NULL, 131),
(72, '', NULL, NULL, NULL, 132),
(73, '', NULL, NULL, NULL, 133),
(74, '', NULL, NULL, NULL, 134),
(75, '', NULL, NULL, NULL, 135),
(76, '', NULL, NULL, NULL, 136),
(77, '', NULL, NULL, NULL, 137),
(78, '', NULL, NULL, NULL, 138),
(79, '', NULL, NULL, NULL, 139),
(80, '', NULL, NULL, NULL, 140),
(81, '', NULL, NULL, NULL, 141),
(82, '', NULL, NULL, NULL, 142),
(83, '', NULL, NULL, NULL, 143),
(84, '', NULL, NULL, NULL, 144),
(85, '', NULL, NULL, NULL, 145),
(86, '', NULL, NULL, NULL, 146),
(87, '', NULL, NULL, NULL, 147),
(88, '', NULL, NULL, NULL, 148),
(89, '', NULL, NULL, NULL, 149),
(90, '', NULL, NULL, NULL, 150),
(91, '', NULL, NULL, NULL, 151),
(92, '', NULL, NULL, NULL, 152),
(93, '', NULL, NULL, NULL, 153),
(94, '', NULL, NULL, NULL, 154),
(95, '', NULL, NULL, NULL, 155),
(96, '', NULL, NULL, NULL, 156),
(97, '', NULL, NULL, NULL, 157),
(98, '', NULL, NULL, NULL, 158),
(99, '', NULL, NULL, NULL, 159),
(100, '', NULL, NULL, NULL, 160),
(102, 'Especial', '', 'Aultismo', '', 274),
(105, 'Uma merda ', 'Todas', 'Nenhuma\r\n', '(52) 34674-4215', 284),
(110, 'Jinto', '', '', '(13) 25436-8769', 289),
(111, 'Top', 'Nenhuma', 'Todas', '(23) 14256-7753', 290),
(109, 'Jinto', '', '', '(13) 25436-8769', 288),
(114, 'Estavel', '', '', '(17) 99666-0329', 293);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE IF NOT EXISTS `pessoas` (
  `idPessoa` int NOT NULL AUTO_INCREMENT,
  `nomePessoa` varchar(80) NOT NULL,
  `emailPessoa` varchar(250) DEFAULT NULL,
  `senhaPessoa` varchar(250) DEFAULT NULL,
  `arquivoPerfil` varchar(40) NOT NULL,
  `tipoPessoa` varchar(10) DEFAULT NULL,
  `cpfPessoa` varchar(14) DEFAULT NULL,
  `enderecoPessoa` varchar(250) DEFAULT NULL,
  `telPessoa` varchar(15) DEFAULT NULL,
  `dataNascPessoa` date DEFAULT NULL,
  `fk_idUniSaude` int DEFAULT NULL,
  PRIMARY KEY (`idPessoa`),
  KEY `fk_idUniSaude` (`fk_idUniSaude`)
) ENGINE=MyISAM AUTO_INCREMENT=301 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`idPessoa`, `nomePessoa`, `emailPessoa`, `senhaPessoa`, `arquivoPerfil`, `tipoPessoa`, `cpfPessoa`, `enderecoPessoa`, `telPessoa`, `dataNascPessoa`, `fk_idUniSaude`) VALUES
(292, 'Kevin Queiroz Cardoso', 'kevin@teste.com', '$2y$10$tsv.roXrjaSqqE524P8p0OMkFXf0SCZr/IyQa0iT7t8D5WVeYZyp6', '', 'user', '531.383.568-85', 'Rua Waldemar Fugiu Ynayama, 40', '(17) 99614-7456', '2006-02-24', 1),
(299, 'recepcionista', 'recepcionista@teste.com', '$2y$10$.k1HsufhDfIq47WhhVQx7upMMr.5WkLfRp9Ntd0qZdupUQTyF//Ny', 'perfilPadrao.jpg', 'recep', '124.012.945-18', 'Logo Ali', '(01) 29293-0130', '0000-00-00', 1),
(295, 'Osmar Albino Cardoso', 'osmar@teste.com', '$2y$10$kebNSP9Y6nzamgrQc26RYewvJod9h3ilaPp.fwZaCFSxTHL0ZkPpi', '37303f64daffe1f81d7c272e74d3ce62.png', 'user', '415.336.448-98', '', '(15) 34689-8984', '0000-00-00', 1),
(281, 'Marcia barriquelo', 'marcia.barriquelo@teste.com', '$2y$10$sxMwX6EE46wEXpWx7ge7BuX0/z1YBgiNsH2oWn5sunTqnccZGLDSe', '', 'user', '125.265.124-52', 'Logo Ali', '(14) 35246-5742', '0000-00-00', 2),
(298, 'Medico', 'medico@teste.com', '$2y$10$l96f0n6vJcG84/cK4caMo.4YjJmVY66pJXJ/JsA68UqaZKXArJHi2', 'perfilPadrao.jpg', 'admin', '159.756.384-25', 'Logo Ali', '(98) 69168-7962', '0000-00-00', 1),
(83, 'Isabel Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'Daniel Sousa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'Sofia Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'Sofia Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'Miguel Santos', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'Miguel Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'Camila Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'Gustavo Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'Fernanda Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'Fernanda Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(96, 'Ricardo Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'Ricardo Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'Tatiana Santos', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'Tatiana Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'Luís Oliveira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'Luís Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(102, 'Cláudia Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'Cláudia Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'Manuel Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(105, 'Manuel Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(106, 'Eduarda Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(107, 'Eduarda Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(108, 'Rui Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(109, 'Rui Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(110, 'Catarina Lopes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(111, 'Catarina Sousa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(112, 'André Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(113, 'André Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(114, 'Carolina Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(115, 'Carolina Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(116, 'António Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(117, 'António Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(118, 'Mariana Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(119, 'Mariana Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(120, 'José Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(121, 'José Santos', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(122, 'Laura Oliveira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(123, 'Laura Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(124, 'Hugo Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(125, 'Hugo Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(126, 'Beatriz Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(127, 'Beatriz Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(128, 'Fábio Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(129, 'Fábio Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(130, 'Jéssica Lopes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(131, 'Jéssica Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(132, 'Nuno Santos', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(133, 'Nuno Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(134, 'Amanda Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(135, 'Amanda Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(136, 'Dinis Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(137, 'Dinis Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(138, 'Elisa Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(139, 'Elisa Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(140, 'Vítor Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(141, 'Vítor Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(142, 'Patrícia Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(143, 'Patrícia Sousa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(144, 'David Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(145, 'David Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(146, 'Vera Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(147, 'Vera Santos', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(148, 'Paulo Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(149, 'Paulo Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(150, 'Leonor Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(151, 'Leonor Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(152, 'Bruno Santos', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(153, 'Bruno Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(154, 'Andreia Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(155, 'Andreia Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(156, 'Nelson Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(157, 'Nelson Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(158, 'Diana Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(159, 'Diana Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(160, 'Sérgio Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(163, 'Elena Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(164, 'Raul Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(165, 'Raul Santos', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(166, 'Célia Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(167, 'Célia Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(168, 'Luisa Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(169, 'Luisa Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(170, 'Alexandre Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(171, 'Alexandre Sousa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(172, 'Helena Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(173, 'Helena Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(174, 'Jorge Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(175, 'Jorge Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(176, 'Sónia Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(177, 'Sónia Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(178, 'Gonçalo Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(179, 'Gonçalo Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(180, 'Carla Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(181, 'Carla Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(182, 'Samuel Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(183, 'Samuel Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(184, 'Rosa Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(185, 'Rosa Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(186, 'Marco Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(187, 'Marco Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(188, 'Teresa Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(189, 'Teresa Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(190, 'Rodrigo Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(191, 'Rodrigo Lopes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(192, 'Sara Santos', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(193, 'Sara Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(194, 'Nuno Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(195, 'Nuno Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(196, 'Joana Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(197, 'Joana Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(198, 'Fernando Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(199, 'Fernando Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(200, 'Monica Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(201, 'Monica Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(202, 'Henrique Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(203, 'Henrique Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(204, 'Rute Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(205, 'Rute Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(206, 'Fábio Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(207, 'Fábio Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(208, 'Isabel Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(209, 'Isabel Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(210, 'Ricardo Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(211, 'Ricardo Lopes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(212, 'Liliana Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(213, 'Liliana Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(214, 'Mário Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(215, 'Mário Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(216, 'Inês Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(217, 'Inês Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(218, 'Márcio Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(219, 'Márcio Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(220, 'Susana Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(221, 'Susana Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(222, 'Dinis Lopes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(223, 'Dinis Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(224, 'Lara Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(225, 'Lara Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(226, 'Simão Pereira', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(227, 'Simão Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(228, 'Tânia Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(229, 'Tânia Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(230, 'Vasco Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(231, 'Vasco Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(232, 'Andreia Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(233, 'Andreia Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(234, 'Pedro Gonçalves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(235, 'Pedro Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(236, 'Marta Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(237, 'Marta Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(238, 'Gustavo Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(239, 'Gustavo Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(240, 'Cristina Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(241, 'Cristina Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(242, 'Eduardo Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(243, 'Eduardo Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(244, 'Lorena Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(245, 'Lorena Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(246, 'Guilherme Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(247, 'Guilherme Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(248, 'Mónica Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(249, 'Mónica Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(250, 'Paulo Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(251, 'Paulo Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(252, 'Isabella Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(253, 'Isabella Fernandes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(254, 'Raul Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(255, 'Raul Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(256, 'Rosa Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(257, 'Rosa Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(258, 'André Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(259, 'André Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(260, 'Elena Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(261, 'Elena Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(262, 'Nuno Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(263, 'Nuno Costa', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(264, 'Rute Silva', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(265, 'Rute Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(266, 'Bruno Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(267, 'Bruno Almeida', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(268, 'Jéssica Rodrigues', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(269, 'Jéssica Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(270, 'António Gomes', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(271, 'António Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(272, 'Carolina Alves', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(273, 'Carolina Martins', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(274, 'Everton Fellipe da Silva', 'everton@teste.com', '$2y$10$IoSk3LACnqPQ4tpwqpcF9eZ5wZTICYEOyb7tGBX7E8t2BNaJ33xES', '', 'user', '124.567.980-87', '', '', '0000-00-00', 2),
(300, 'breninho', 'brenohenry570@gmail.com', '$2y$10$YCjmEaIg6mhmfg1uvQh2M.7rOxxxnZ1IkTBU/EEIXSY4zqVz9VygG', '395921d0b40e811025dbb9aabedfde62.jpg', 'user', '252.247.678-57', 'av rio parana', '(17) 99263-1410', '2006-02-24', 1),
(296, 'Admin', 'admin@teste.com', '$2y$10$tUTd5mlmaEY8rbTq4X5I.eFdvvdSqRJp.PWn.Ik7C3drQeVmjlcMy', 'perfilPadrao.jpg', 'admin', '214.352.643-74', 'Logo Ali', '(14) 61261-2623', '0000-00-00', 3),
(283, 'Cleberson Luiz', 'cleberson@teste.com', '$2y$10$c14ZzxZwTpa0Y0d0Z6COUOZizIEN6ynune6J0GjvKx74gHeojRfTO', '', 'user', '213.502.153-59', 'No chaxa prego', '(13) 52463-5723', '0000-00-00', 1),
(284, 'cleiton Junior fegueiredo', 'cleiton@teste.com', '$2y$10$ArncI5ZYGC5QDacU594W5OeJdCKq1ZyTzGbmhAs.UCg7TV7iE23F.', '', 'user', '453.246.357-62', 'No chaxa prego', '(14) 26374-6597', '0000-00-00', 1),
(289, 'Nicole Silva Sauro', 'nicole@teste.com', '$2y$10$gwyfWUSF5hEfDGlwdFgyMunZMarWmnAhZWskwBrH9VhS072r/BQwe', '', 'user', '213.502.153-59', '12354364786', '(14) 35436-4657', '0000-00-00', 1),
(290, 'Matheus Alonso', 'matheus.alonso@teste.com', '$2y$10$3gwNko9xGbWLD8apf7EPE.E0I/ZyVQvHd7hvcrtAjbqVqN8Q2k2SG', '', 'user', '435.465.746-86', 'Rua Waldemar Fugiu Ynayama, 40', '(13) 24365-7866', '0000-00-00', 1),
(293, 'Kevin Queiroz Cardoso', 'kevin.queiroz@teste.com', '$2y$10$Dq4zg9QWIaBKKjdQT9wbeuREYjwi1Ly2iKf8R79bVPefUsek1MG3S', 'f73fdc637b4abcf05f908d685272637e.jpg', 'user', '531.383.568-85', 'Rua Waldemar Fugiu Ynayama, 40', '(17) 99614-7456', '2006-02-24', 1),
(297, 'Enfermeira', 'enfermeira@teste.com', '$2y$10$lP6c0gQ7Vm8LHK8mO0dUXOhwp0lmx9XYnx4Ibn2o1yf71swZ6XLim', 'perfilPadrao.jpg', 'enfer', '341.512.323-03', 'Logo Alli', '(92) 84501-8938', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `procedimentos`
--

DROP TABLE IF EXISTS `procedimentos`;
CREATE TABLE IF NOT EXISTS `procedimentos` (
  `idProcedimento` int NOT NULL AUTO_INCREMENT,
  `dataHoraProcedimento` datetime NOT NULL,
  `statusHistorico` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `iconeProcedimento` int NOT NULL,
  `remedioProcedimento` varchar(250) DEFAULT NULL,
  `obsMedicas` varchar(250) DEFAULT NULL,
  `nomeProcedimento` varchar(200) NOT NULL,
  `descProcedimento` varchar(250) DEFAULT NULL,
  `fk_idProcesso` int NOT NULL,
  `fk_idUniSaude` int NOT NULL,
  `fk_idFuncionario` int NOT NULL,
  PRIMARY KEY (`idProcedimento`),
  KEY `fk_processoProc_unidadeSaude1_idx` (`fk_idUniSaude`),
  KEY `fk_processoProc_funcionario1_idx` (`fk_idFuncionario`),
  KEY `fk_processoProc_processo1_idx` (`fk_idProcesso`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

DROP TABLE IF EXISTS `processos`;
CREATE TABLE IF NOT EXISTS `processos` (
  `idProcesso` int NOT NULL AUTO_INCREMENT,
  `protocoloProcesso` varchar(14) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dataInicialProcesso` date NOT NULL,
  `dataFinalProcesso` date DEFAULT NULL,
  `fk_idPaciente` int NOT NULL,
  PRIMARY KEY (`idProcesso`),
  KEY `fk_processo_paciente1_idx` (`fk_idPaciente`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidadessaude`
--

DROP TABLE IF EXISTS `unidadessaude`;
CREATE TABLE IF NOT EXISTS `unidadessaude` (
  `idUniSaude` int NOT NULL AUTO_INCREMENT,
  `nomeUniSaude` varchar(80) NOT NULL,
  `enderecoUniSaude` varchar(250) NOT NULL,
  `nomeCidade` varchar(80) NOT NULL,
  `ufEstado` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`idUniSaude`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `unidadessaude`
--

INSERT INTO `unidadessaude` (`idUniSaude`, `nomeUniSaude`, `enderecoUniSaude`, `nomeCidade`, `ufEstado`) VALUES
(1, 'SAUDE', 'onde judas perdeu as botas', 'Vieirópolis', 'PB'),
(2, ' Ame', ' Rua 15', 'Abaiara', 'CE'),
(3, 'Ame 2', 'Rua 10', 'Água Branca', 'PB');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
