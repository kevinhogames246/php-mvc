-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Out-2023 às 13:48
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

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
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCargo` varchar(80) NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

DROP TABLE IF EXISTS `cidades`;
CREATE TABLE IF NOT EXISTS `cidades` (
  `idCidade` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCidade` varchar(80) NOT NULL,
  `fk_idEstado` int(11) NOT NULL,
  PRIMARY KEY (`idCidade`),
  KEY `fk_idEstado` (`fk_idEstado`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`idCidade`, `nomeCidade`, `fk_idEstado`) VALUES
(1, 'Diadema', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE IF NOT EXISTS `especialidades` (
  `idEspecialidade` int(11) NOT NULL AUTO_INCREMENT,
  `nomeEspecialidade` varchar(80) NOT NULL,
  `descEspecialidade` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idEspecialidade`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `nomeEstado` varchar(80) NOT NULL,
  `ufEstado` varchar(2) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`idEstado`, `nomeEstado`, `ufEstado`) VALUES
(1, 'são Paulo', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exames`
--

DROP TABLE IF EXISTS `exames`;
CREATE TABLE IF NOT EXISTS `exames` (
  `idExame` int(11) NOT NULL,
  `nomeExame` varchar(80) NOT NULL,
  `unidadeExame` varchar(80) NOT NULL,
  `arquivoExame` blob,
  `dataExame` date NOT NULL,
  `fk_idProcessoProc` int(11) NOT NULL,
  PRIMARY KEY (`idExame`),
  KEY `fk_idProcessoProc` (`fk_idProcessoProc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `idFuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idPessoa` int(11) NOT NULL,
  `fk_idEspecialidade` int(11) DEFAULT NULL,
  `fk_idCargo` int(11) NOT NULL,
  PRIMARY KEY (`idFuncionario`),
  KEY `fk_idPessoa` (`fk_idPessoa`),
  KEY `fk_idEspecialidade` (`fk_idEspecialidade`),
  KEY `fk_idCargo` (`fk_idCargo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `statusPaciente` varchar(20) NOT NULL,
  `alergiaPaciente` varchar(300) DEFAULT NULL,
  `doencaGeneticaPaciente` varchar(300) DEFAULT NULL,
  `telEmergenciaPaciente` varchar(15) DEFAULT NULL,
  `fk_idPessoa` int(11) NOT NULL,
  PRIMARY KEY (`idPaciente`),
  KEY `fk_paciente_pessoa1_idx` (`fk_idPessoa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE IF NOT EXISTS `pessoas` (
  `idPessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nomePessoa` varchar(80) NOT NULL,
  `usuarioPessoa` varchar(30) NOT NULL,
  `emailPessoa` varchar(250) DEFAULT NULL,
  `senhaPessoa` varchar(250) NOT NULL,
  `tipoPessoa` varchar(10) NOT NULL,
  `cpfPessoa` varchar(14) DEFAULT NULL,
  `enderecoPessoa` varchar(250) DEFAULT NULL,
  `telPessoa` varchar(15) DEFAULT NULL,
  `dataNascPessoa` date NOT NULL,
  `fk_idUniSaude` int(11) NOT NULL,
  PRIMARY KEY (`idPessoa`),
  KEY `fk_idUniSaude` (`fk_idUniSaude`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`idPessoa`, `nomePessoa`, `usuarioPessoa`, `emailPessoa`, `senhaPessoa`, `tipoPessoa`, `cpfPessoa`, `enderecoPessoa`, `telPessoa`, `dataNascPessoa`, `fk_idUniSaude`) VALUES
(1, 'Kevin Queiroz Cardoso', 'KEVIN', 'kevinqcardoso@gmail.com', '$2y$10$eZjJ3hfK4Czrkzvpc6qRJOAYpySaS7fPaToaBUSXZMeD7pPKfyeb.', 'admin', '123.456.789-01', 'Rua Waldemar', '(17) 99614-7456', '2006-02-24', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `procedimentos`
--

DROP TABLE IF EXISTS `procedimentos`;
CREATE TABLE IF NOT EXISTS `procedimentos` (
  `idProcedimento` int(11) NOT NULL AUTO_INCREMENT,
  `nomeProcedimento` varchar(80) NOT NULL,
  `descProcedimento` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idProcedimento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

DROP TABLE IF EXISTS `processos`;
CREATE TABLE IF NOT EXISTS `processos` (
  `idProcesso` int(11) NOT NULL AUTO_INCREMENT,
  `protocoloProcesso` varchar(12) NOT NULL,
  `dataInicialProcesso` date NOT NULL,
  `dataFinalProcesso` date NOT NULL,
  `fk_idPaciente` int(11) NOT NULL,
  PRIMARY KEY (`idProcesso`),
  KEY `fk_processo_paciente1_idx` (`fk_idPaciente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `processosproc`
--

DROP TABLE IF EXISTS `processosproc`;
CREATE TABLE IF NOT EXISTS `processosproc` (
  `idProcessoProc` int(11) NOT NULL AUTO_INCREMENT,
  `dataHoraProcessoProc` varchar(5) NOT NULL,
  `statusHistorico` varchar(20) NOT NULL,
  `remedioProcessoProc` varchar(250) DEFAULT NULL,
  `obsMedicas` varchar(250) DEFAULT NULL,
  `fk_idProcesso` int(11) NOT NULL,
  `fk_idProcedimento` int(11) NOT NULL,
  `fk_idUniSaude` int(11) NOT NULL,
  `fk_idFuncionario` int(11) NOT NULL,
  PRIMARY KEY (`idProcessoProc`),
  KEY `fk_idProcedimento` (`fk_idProcedimento`),
  KEY `fk_processoProc_unidadeSaude1_idx` (`fk_idUniSaude`),
  KEY `fk_processoProc_funcionario1_idx` (`fk_idFuncionario`),
  KEY `fk_processoProc_processo1_idx` (`fk_idProcesso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidadessaude`
--

DROP TABLE IF EXISTS `unidadessaude`;
CREATE TABLE IF NOT EXISTS `unidadessaude` (
  `idUniSaude` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUniSaude` varchar(80) NOT NULL,
  `enderecoUniSaude` varchar(250) NOT NULL,
  `fk_idCidade` int(11) NOT NULL,
  PRIMARY KEY (`idUniSaude`),
  KEY `fk_idCidade` (`fk_idCidade`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unidadessaude`
--

INSERT INTO `unidadessaude` (`idUniSaude`, `nomeUniSaude`, `enderecoUniSaude`, `fk_idCidade`) VALUES
(1, 'SAUDE TOP', 'onde judas perdeu as botas', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
