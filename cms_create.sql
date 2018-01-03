-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Tempo de geração: 03/01/2018 às 12:22
-- Versão do servidor: 10.0.31-MariaDB-0ubuntu0.16.04.2
-- Versão do PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ci_cms`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_de_cadastro` datetime NOT NULL,
  `email_confirmado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `id` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto_alternativo` text NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `identificador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  `log` varchar(1000) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `assunto` varchar(255) NOT NULL,
  `mensagem` text NOT NULL,
  `data_de_cadastro` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `corpo` longtext NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `visibilidade` tinyint(4) NOT NULL,
  `token` varchar(100) NOT NULL,
  `autor` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `data_atualizacao` datetime NOT NULL,
  `ultimo_usuario_que_atualizou` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia_categoria`
--

CREATE TABLE `noticia_categoria` (
  `id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia_tag`
--

CREATE TABLE `noticia_tag` (
  `id` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  `noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `option`
--

CREATE TABLE `option` (
  `id_option` int(11) NOT NULL,
  `nome_option` varchar(100) NOT NULL,
  `valor_option` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nivel_de_acesso` tinyint(4) NOT NULL,
  `data_de_cadastro` datetime NOT NULL,
  `data_de_ultimo_acesso` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `visualizacoes`
--

CREATE TABLE `visualizacoes` (
  `id` int(11) NOT NULL,
  `tipo` smallint(6) DEFAULT NULL,
  `opcional_1` smallint(6) NOT NULL,
  `opcional_2` smallint(6) NOT NULL,
  `opcional_3` smallint(6) NOT NULL,
  `data_de_visualizacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia` (`noticia`),
  ADD KEY `categoria` (`categoria`);

--
-- Índices de tabela `noticia_tag`
--
ALTER TABLE `noticia_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag` (`tag`),
  ADD KEY `noticia` (`noticia`);

--
-- Índices de tabela `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id_option`);

--
-- Índices de tabela `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `visualizacoes`
--
ALTER TABLE `visualizacoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de tabela `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT de tabela `noticia_tag`
--
ALTER TABLE `noticia_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT de tabela `option`
--
ALTER TABLE `option`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de tabela `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `visualizacoes`
--
ALTER TABLE `visualizacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  ADD CONSTRAINT `noticia_categoria_ibfk_1` FOREIGN KEY (`noticia`) REFERENCES `noticia` (`id`),
  ADD CONSTRAINT `noticia_categoria_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`);

--
-- Restrições para tabelas `noticia_tag`
--
ALTER TABLE `noticia_tag`
  ADD CONSTRAINT `noticia_tag_ibfk_1` FOREIGN KEY (`tag`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `noticia_tag_ibfk_2` FOREIGN KEY (`noticia`) REFERENCES `noticia` (`id`),
  ADD CONSTRAINT `noticia_tag_ibfk_3` FOREIGN KEY (`noticia`) REFERENCES `noticia` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
