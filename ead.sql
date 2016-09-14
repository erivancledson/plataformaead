-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Set-2016 às 23:02
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ead`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `senha` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Bonieky', 'suporte@b7web.com.br', '202cb962ac59075b964b07152d234b70'),
(2, 'Aluno de teste', 'aluno@teste.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_curso`
--

CREATE TABLE `aluno_curso` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno_curso`
--

INSERT INTO `aluno_curso` (`id`, `id_curso`, `id_aluno`) VALUES
(5, 1, 1),
(6, 2, 1),
(7, 3, 1),
(8, 6, 1),
(9, 7, 1),
(10, 8, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `ordem` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aulas`
--

INSERT INTO `aulas` (`id`, `id_modulo`, `id_curso`, `ordem`, `tipo`) VALUES
(1, 1, 1, 1, 'video'),
(2, 1, 1, 2, 'video'),
(3, 2, 1, 1, 'video'),
(4, 2, 1, 2, 'poll'),
(5, 3, 1, 1, 'video'),
(7, 3, 1, 3, 'video'),
(8, 6, 1, 1, 'video'),
(9, 1, 1, 3, 'poll');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `imagem` varchar(37) NOT NULL DEFAULT '',
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `imagem`, `descricao`) VALUES
(1, 'PHP', 'php.jpg', 'Curso para desenvolvimento de sites e sistemas.'),
(2, 'HTML', 'html.jpg', NULL),
(3, 'JAVASCRIPT', 'javascript.jpg', NULL),
(4, 'CSS', '503e41d1aa116efa266c7467dcd24a68.jpg', 'Esse curso faz CSS parecer facil.'),
(6, 'jQuery', '0676d836af8b182c6d38547f8bb31219.jpg', ''),
(7, 'Swift', 'swift.jpg', NULL),
(8, 'Android', '782d69edbb6949f7d81a54828d84768d.jpg', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `duvidas`
--

CREATE TABLE `duvidas` (
  `id` int(11) UNSIGNED NOT NULL,
  `data_duvida` datetime NOT NULL,
  `respondida` tinyint(1) NOT NULL,
  `duvida` text,
  `id_aluno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `duvidas`
--

INSERT INTO `duvidas` (`id`, `data_duvida`, `respondida`, `duvida`, `id_aluno`) VALUES
(1, '2016-08-12 05:45:23', 0, 'Duvida de teste...', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) UNSIGNED NOT NULL,
  `data_viewed` datetime NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`id`, `data_viewed`, `id_aluno`, `id_aula`) VALUES
(25, '2016-08-30 06:07:44', 1, 1),
(26, '2016-08-30 06:10:00', 1, 9),
(27, '2016-08-30 06:10:18', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_curso` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id`, `id_curso`, `nome`) VALUES
(1, 1, 'Básico'),
(2, 1, 'Intermediário'),
(3, 1, 'Avançado'),
(6, 1, 'Super Avançado'),
(7, 3, 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionarios`
--

CREATE TABLE `questionarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_aula` int(11) NOT NULL,
  `pergunta` varchar(100) NOT NULL DEFAULT '',
  `opcao1` varchar(100) DEFAULT NULL,
  `opcao2` varchar(100) DEFAULT NULL,
  `opcao3` varchar(100) DEFAULT NULL,
  `opcao4` varchar(100) DEFAULT NULL,
  `resposta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `questionarios`
--

INSERT INTO `questionarios` (`id`, `id_aula`, `pergunta`, `opcao1`, `opcao2`, `opcao3`, `opcao4`, `resposta`) VALUES
(1, 4, 'Qual a pergunta? 2', 'Op122', 'Op23333', 'Op35555', 'Op41111', 4),
(2, 9, 'Pergunta de teste', 'Opcoao1', 'copaosr2', 'aposri3', 'apsori4', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `senha` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`) VALUES
(1, 'erivancled@hotmail.com', 'a01610228fe998f515a72dd730294d87');

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE `videos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_aula` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `descricao` text,
  `url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `videos`
--

INSERT INTO `videos` (`id`, `id_aula`, `nome`, `descricao`, `url`) VALUES
(1, 1, 'Aula 1', '', '178300706'),
(2, 2, 'Aula 2', NULL, '178300706'),
(3, 3, 'Aula 3', NULL, '178300706'),
(4, 5, 'Aula 4', NULL, '178300706'),
(6, 7, 'Aula 6', NULL, '178300706'),
(7, 8, 'Aula Teste 2', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aluno_curso`
--
ALTER TABLE `aluno_curso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duvidas`
--
ALTER TABLE `duvidas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionarios`
--
ALTER TABLE `questionarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `aluno_curso`
--
ALTER TABLE `aluno_curso`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `duvidas`
--
ALTER TABLE `duvidas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `questionarios`
--
ALTER TABLE `questionarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
