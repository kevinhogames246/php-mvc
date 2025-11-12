-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Dez-2023 às 09:41
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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `exames`
--

INSERT INTO `exames` (`idExame`, `nomeExame`, `unidadeExame`, `arquivoExame`, `dataExame`, `fk_idProcedimento`) VALUES
(40, '', '', NULL, '0000-00-00', 99),
(39, '', '', NULL, '0000-00-00', 98),
(38, '', '', NULL, '0000-00-00', 97),
(37, '', '', NULL, '0000-00-00', 96),
(36, '', '', NULL, '0000-00-00', 95),
(35, '', '', NULL, '0000-00-00', 94),
(33, '', '', NULL, '0000-00-00', 92),
(34, '', '', NULL, '0000-00-00', 93);

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
  `cargoFuncionario` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`idFuncionario`),
  KEY `fk_idPessoa` (`fk_idPessoa`),
  KEY `fk_idEspecialidade` (`fk_idEspecialidade`),
  KEY `fk_idCargo` (`fk_idCargo`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`idFuncionario`, `fk_idPessoa`, `fk_idEspecialidade`, `fk_idCargo`, `cargoFuncionario`) VALUES
(8, 298, 1, 1, 'medico'),
(6, 296, 1, 1, 'administrador'),
(7, 297, 1, 1, 'enfermeira'),
(9, 299, 1, 1, 'recepcionista'),
(10, 305, 1, 1, '');

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
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb3;

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
(111, 'Top', 'Nenhuma', 'Todas', '(23) 14256-7753', 290),
(109, 'Jinto', '', '', '(13) 25436-8769', 288),
(120, 'Bom', 'Dipirona', 'Nenhuma', '(23) 45671-2022', 304);

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
) ENGINE=MyISAM AUTO_INCREMENT=306 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`idPessoa`, `nomePessoa`, `emailPessoa`, `senhaPessoa`, `arquivoPerfil`, `tipoPessoa`, `cpfPessoa`, `enderecoPessoa`, `telPessoa`, `dataNascPessoa`, `fk_idUniSaude`) VALUES
(292, 'Kevin Queiroz Cardoso', 'kevin@teste.com', '$2y$10$tsv.roXrjaSqqE524P8p0OMkFXf0SCZr/IyQa0iT7t8D5WVeYZyp6', '', 'user', '531.383.568-85', 'Rua Waldemar Fugiu Ynayama, 40', '(17) 99614-7456', '2006-02-24', 1),
(299, 'recepcionista', 'recepcionista@teste.com', '$2y$10$.k1HsufhDfIq47WhhVQx7upMMr.5WkLfRp9Ntd0qZdupUQTyF//Ny', 'perfilPadrao.jpg', 'recepcioni', '124.012.945-18', 'Logo Ali', '(01) 29293-0130', '2023-12-05', 1),
(295, 'Osmar Albino Cardoso', 'osmar@teste.com', '$2y$10$4MvPLph.wlMpGLJBABwhJuyiMmSHYStkM9QjN8YZVl7ugFqCDplj6', '37303f64daffe1f81d7c272e74d3ce62.png', 'user', '415.336.448-98', 'Rua Waldemar Fugiu Ynayama, 40', '(15) 34689-8984', '1972-04-18', 1),
(281, 'Marcia barriquelo', 'marcia.barriquelo@teste.com', '$2y$10$sxMwX6EE46wEXpWx7ge7BuX0/z1YBgiNsH2oWn5sunTqnccZGLDSe', '', 'user', '125.265.124-52', 'Logo Ali', '(14) 35246-5742', '0000-00-00', 2),
(298, 'Medico', 'medico@teste.com', '$2y$10$l96f0n6vJcG84/cK4caMo.4YjJmVY66pJXJ/JsA68UqaZKXArJHi2', 'perfilPadrao.jpg', 'medico', '159.756.384-25', 'Logo Ali', '(98) 69168-7962', '2023-11-21', 1),
(300, 'Breno Henrique', 'brenohenry570@gmail.com', '$2y$10$YCjmEaIg6mhmfg1uvQh2M.7rOxxxnZ1IkTBU/EEIXSY4zqVz9VygG', '395921d0b40e811025dbb9aabedfde62.jpg', 'user', '252.247.678-57', 'testse', '(17) 99263-1410', '2006-02-24', 1),
(296, 'Admin', 'admin@teste.com', '$2y$10$OddBe8yUpxnyTZybZFLA9ukau7cSB55LtEb2JW3jN0XDB4UVUMNVC', 'perfilPadrao.jpg', 'admin', '214.352.643-74', 'Logo Ali', '(14) 61261-2623', '2023-12-19', 4),
(304, 'Mateus Aparecido Aragão Panula', 'mateus.panula@gmail.com', '$2y$10$X00KMX2hnvbLLhMGOaX4Ve/ZV39VHORvEX2NQyPudgCkYtIq0c/jW', 'eabf147abcf2edccb99e1bc19edad44c.png', 'user', '507.633.768-09', 'Rua do Endereco', '(17) 99212-3456', '2006-06-12', 1),
(297, 'Enfermeira', 'enfermeira@teste.com', '$2y$10$lP6c0gQ7Vm8LHK8mO0dUXOhwp0lmx9XYnx4Ibn2o1yf71swZ6XLim', 'perfilPadrao.jpg', 'enfermeira', '341.512.323-03', 'Logo Alli', '(92) 84501-8938', '2023-12-04', 1),
(305, 'Breno Henry ', 'breno@etec.sp.gov.br', '$2y$10$y7ZzlRq/NjV/e6A3xy/bc.yLNooHEJyyaNjifgpVUH3tOQFe/19Yi', '3064136932bbabebaf622481db0392fc.jpg', NULL, '124.567.891-02', 'Rua do Postinho, 208, Santa fé do sul', '(17) 99648-5125', '2006-06-20', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `procedimentos`
--

DROP TABLE IF EXISTS `procedimentos`;
CREATE TABLE IF NOT EXISTS `procedimentos` (
  `idProcedimento` int NOT NULL AUTO_INCREMENT,
  `dataHoraProcedimento` datetime NOT NULL,
  `statusHistorico` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `iconeProcedimento` varchar(30) NOT NULL,
  `remedioProcedimento` varchar(250) DEFAULT NULL,
  `obsMedicas` varchar(250) DEFAULT NULL,
  `nomeProcedimento` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `descProcedimento` varchar(250) DEFAULT NULL,
  `fk_idProcesso` int NOT NULL,
  `fk_idUniSaude` int NOT NULL,
  `fk_idFuncionario` int NOT NULL,
  PRIMARY KEY (`idProcedimento`),
  KEY `fk_processoProc_unidadeSaude1_idx` (`fk_idUniSaude`),
  KEY `fk_processoProc_funcionario1_idx` (`fk_idFuncionario`),
  KEY `fk_processoProc_processo1_idx` (`fk_idProcesso`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `procedimentos`
--

INSERT INTO `procedimentos` (`idProcedimento`, `dataHoraProcedimento`, `statusHistorico`, `iconeProcedimento`, `remedioProcedimento`, `obsMedicas`, `nomeProcedimento`, `descProcedimento`, `fk_idProcesso`, `fk_idUniSaude`, `fk_idFuncionario`) VALUES
(111, '2023-12-04 21:46:05', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 72, 4, 6),
(108, '2023-12-04 09:57:48', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 69, 4, 6),
(109, '2023-12-04 09:57:58', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 70, 4, 6),
(107, '2023-12-04 09:57:27', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 68, 4, 6),
(106, '2023-12-04 09:57:26', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 67, 4, 6),
(105, '2023-12-04 09:56:50', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 66, 4, 6),
(104, '2023-12-04 09:56:29', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 65, 4, 6),
(103, '2023-12-04 09:55:08', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 64, 4, 6),
(102, '2023-12-04 09:54:40', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 63, 4, 6),
(100, '2023-12-04 09:25:15', '', 'bi-hospital', '', '', 'Saida do hospital', '', 60, 1, 6),
(99, '2023-12-04 09:23:55', '', 'bi-hospital', '', '', 'tsts_teempo02', '', 60, 4, 6),
(110, '2023-12-04 21:45:24', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 71, 4, 6),
(101, '2023-12-04 09:25:30', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na unidade', '', 62, 4, 6),
(96, '2023-12-04 03:28:10', '', 'bi-pen', '', '', 'QQQQQQQ', '', 60, 1, 6),
(91, '2023-12-04 02:41:05', 'Não avaliado', 'bi-hospital', '', '', 'Entrada na', '', 61, 1, 6),
(92, '2023-12-04 03:19:44', 'bemzim', 'bi-eye', '', '', 'Kevin Queiro', '', 61, 1, 6),
(90, '2023-12-03 18:35:26', '', 'bi bi-hospital', '', '', 'Entrada na unidade', '', 60, 4, 6),
(89, '2023-12-03 14:38:55', '', 'bi bi-hospital', '', '', 'Entrada na unidade', '', 59, 4, 6),
(87, '2023-12-03 14:33:01', '', 'bi bi-hospital', '', '', 'Entrada na unidade', '', 57, 4, 6),
(88, '2023-12-03 14:38:03', '', 'bi bi-hospital', '', '', 'Entrada na unidade', '', 58, 4, 6);

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
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `processos`
--

INSERT INTO `processos` (`idProcesso`, `protocoloProcesso`, `dataInicialProcesso`, `dataFinalProcesso`, `fk_idPaciente`) VALUES
(71, 'HT76737124PB', '2023-12-05', NULL, 113),
(72, 'HT66737165PB', '2023-12-05', NULL, 113),
(60, 'HT48628526PB', '2023-12-03', '2023-12-04', 116);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `unidadessaude`
--

INSERT INTO `unidadessaude` (`idUniSaude`, `nomeUniSaude`, `enderecoUniSaude`, `nomeCidade`, `ufEstado`) VALUES
(1, 'SAUDE', 'onde judas perdeu as botas', 'Vieirópolis', 'PB'),
(2, ' hospital do amor', ' Rua 15, 697', 'Santa Fé do Sul', 'SP'),
(3, 'Ame 2', 'Rua 10', 'Água Branca', 'PB'),
(4, 'fodasss', 'rua askksk', 'Abaíra', 'BA'),
(5, 'manicomio', 'tseste', 'Alta Floresta D\'Oeste', 'RO'),
(6, 'Ulisses Terapia', 'Rua inesxistente', 'Santa Fé do Sul', 'SP');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
