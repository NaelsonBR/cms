-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 20-Dez-2017 às 00:12
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `slug`, `descricao`) VALUES
(3, 'Perfumaria', 'Perfumaria', ''),
(5, 'Maquiagem', 'Maquiagem', ''),
(6, 'VestuÃ¡rio', 'VestuÃ¡rio', ''),
(8, 'Banho', 'Banho', ''),
(9, 'Joias', 'Joias', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_de_cadastro` datetime NOT NULL,
  `email_confirmado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`id`, `nome`, `telefone`, `email`, `data_de_cadastro`, `email_confirmado`) VALUES
(1, 'Peterson', '98926652163', 'peterson.jfp@gmail.com', '2017-08-08 04:25:08', 1),
(2, 'Patricia', '99586485', 'patriciaalessandraborges@gmail.com', '2017-06-01 07:17:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `id` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto_alternativo` text NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `identificador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`id`, `imagem`, `titulo`, `texto_alternativo`, `data_cadastro`, `identificador`) VALUES
(1, 'Penguins.jpg', '', '', '2017-08-31 15:49:15', '2QCD6M59a85a2b881a0XXJFCS'),
(2, 'Tulips.jpg', '', '', '2017-08-31 15:49:16', 'RU0FX359a85a2c3a3afPTMVTF'),
(3, 'Chrysanthemum.jpg', '', '', '2017-08-31 15:49:18', 'YE57IF59a85a2ed451d2NE5FP'),
(4, 'Desert.jpg', '', '', '2017-08-31 15:49:19', '6BJVZ359a85a2f7b762A3D8ZU'),
(5, 'Hydrangeas.jpg', '', '', '2017-08-31 15:49:20', 'GYH3TZ59a85a302e5294ALIRG'),
(6, 'Jellyfish.jpg', '', '', '2017-08-31 15:49:20', 'B9Q03H59a85a30cdffeVXKUJP'),
(7, 'Lighthouse.jpg', '', '', '2017-08-31 15:49:21', 'SML9CI59a85a3177953B4CPM8'),
(8, 'Penguins-1.jpg', '', '', '2017-08-31 15:49:22', 'EYT2KG59a85a322d213QKHYR8'),
(9, 'Tulips-1.jpg', '', '', '2017-08-31 15:49:22', '7NP0B959a85a32c8a7fXEY19B'),
(10, 'Chrysanthemum-1.jpg', '', '', '2017-08-31 15:51:37', 'PN1AMB59a85ab964ba959CTV0'),
(11, 'Desert-1.jpg', '', '', '2017-08-31 15:51:38', 'YB4K0J59a85aba152606BNPXZ'),
(12, 'Hydrangeas-1.jpg', '', '', '2017-08-31 15:51:38', 'GK0YIB59a85abaacc4cB9FN5C'),
(13, 'Jellyfish-1.jpg', '', '', '2017-08-31 15:51:39', 'AT150J59a85abb72ac7B701UF'),
(14, 'Koala.jpg', '', '', '2017-08-31 15:51:40', 'XZYBIN59a85abc0b2a8HTZQTE'),
(15, 'Lighthouse-1.jpg', '', '', '2017-08-31 15:51:40', 'GGQ2JJ59a85abcab166M8B7AX'),
(16, 'Penguins-2.jpg', '', '', '2017-08-31 15:51:41', 'D54KTM59a85abd4f4c9Y58B45'),
(17, 'Tulips-2.jpg', '', '', '2017-08-31 15:51:41', 'PGGIVS59a85abde14dbBQRHJQ'),
(18, 'Chrysanthemum-2.jpg', '', '', '2017-08-31 15:52:57', '0BG1PG59a85b090bff4YKGNBU'),
(19, 'Desert-2.jpg', '', '', '2017-08-31 15:52:57', 'B3GSWI59a85b09a4980NVA5S3'),
(20, 'Hydrangeas-2.jpg', '', '', '2017-08-31 15:52:58', '4P6XGE59a85b0a4236aPAVY0P'),
(21, 'Jellyfish-2.jpg', '', '', '2017-08-31 15:52:58', 'HKY3WZ59a85b0af08a3WY6FB9'),
(22, 'Koala-1.jpg', '', '', '2017-08-31 15:52:59', 'XLKH9P59a85b0b9a9c8HKRIFZ'),
(23, 'Lighthouse-2.jpg', '', '', '2017-08-31 15:53:00', 'I69Q3G59a85b0c40c6cA8NKCH'),
(24, 'Penguins-3.jpg', '', '', '2017-08-31 15:53:00', 'P8UZFN59a85b0cd7aa0JNCJUY'),
(25, 'Tulips-3.jpg', '', '', '2017-08-31 15:53:01', 'L5KWR659a85b0d81bc52XXU60'),
(26, 'Chrysanthemum-3.jpg', '', '', '2017-08-31 15:53:50', 'PU9N6G59a85b3e44e494RWC5U'),
(27, 'Desert-3.jpg', '', '', '2017-08-31 15:53:50', '1Q5V5D59a85b3ee25f6IBBG13'),
(28, 'Hydrangeas-3.jpg', '', '', '2017-08-31 15:53:51', '5P2RQD59a85b3f8abc3H704LX'),
(29, 'Jellyfish-3.jpg', '', '', '2017-08-31 15:53:52', '279XHB59a85b4043f1bUM1P5Z'),
(30, 'Koala-2.jpg', '', '', '2017-08-31 15:53:52', 'B2JJEN59a85b40defb8U6W5GG'),
(31, 'Lighthouse-3.jpg', '', '', '2017-08-31 15:53:53', 'XR591959a85b4194c5fB3CTSX'),
(32, 'Penguins-4.jpg', '', '', '2017-08-31 15:53:54', 'F6W8EJ59a85b4231e79IZUNYM'),
(33, 'Tulips-4.jpg', '', '', '2017-08-31 15:53:54', 'VP251F59a85b42db59170H176'),
(34, 'Chrysanthemum-4.jpg', '', '', '2017-08-31 15:54:54', 'R9F4ZB59a85b7eae0a60URWCR'),
(35, 'Desert-4.jpg', '', '', '2017-08-31 15:54:55', '598UR359a85b7f5b494QLPNNZ'),
(36, 'Hydrangeas-4.jpg', '', '', '2017-08-31 15:54:55', 'KLBGF759a85b7fed0beMZV5W1'),
(37, 'Jellyfish-4.jpg', '', '', '2017-08-31 15:54:56', '0PYLGI59a85b809bc1c549VCL'),
(38, 'Koala-3.jpg', '', '', '2017-08-31 15:54:57', '2FWGXG59a85b813ccb7LPGNUS'),
(39, 'Lighthouse-4.jpg', '', '', '2017-08-31 15:54:57', 'Q8F0CX59a85b81e09f6QUFYL9'),
(40, 'Penguins-5.jpg', '', '', '2017-08-31 15:54:58', 'J0CERB59a85b8289f63U7QNF6'),
(41, 'Tulips-5.jpg', '', '', '2017-08-31 15:54:59', 'I5XAPK59a85b83305efPZE5L8'),
(42, 'Chrysanthemum-5.jpg', '', '', '2017-08-31 15:55:13', '7KYI7259a85b91ea5e3MSZDXI'),
(43, 'Desert-5.jpg', '', '', '2017-08-31 15:55:14', 'N0PPRP59a85b92927c8CSHPNQ'),
(44, 'Hydrangeas-5.jpg', '', '', '2017-08-31 15:55:15', 'CDY1GX59a85b9335b8b5NF2K1'),
(45, 'Jellyfish-5.jpg', '', '', '2017-08-31 15:55:15', 'C206SL59a85b93d8159UJVWY2'),
(46, 'Koala-4.jpg', '', '', '2017-08-31 15:55:16', '60M9T559a85b947093aP2C1LZ'),
(47, 'Lighthouse-5.jpg', '', '', '2017-08-31 15:55:17', 'WK2Y1H59a85b9558e86IGVXRG'),
(48, 'Penguins-6.jpg', '', '', '2017-08-31 15:55:18', '0P6EIZ59a85b9604eebKBZHAM'),
(49, 'Tulips-6.jpg', '', '', '2017-08-31 15:55:18', 'JG6AQL59a85b96a3251LTP3D4'),
(50, 'Tulips-7.jpg', '', '', '2017-08-31 15:55:48', 'G6ZSB859a85bb498d22PW0QWR'),
(51, 'Lighthouse-6.jpg', '', '', '2017-08-31 16:34:35', '0KQDL159a864cbccd34MZSEDX'),
(52, 'Penguins-7.jpg', '', '', '2017-08-31 16:34:36', 'TDCMS659a864cc7e772C2BIRQ'),
(53, 'Tulips-8.jpg', '', '', '2017-08-31 16:34:37', 'GMFLT759a864cd3a1dcN3IIB8'),
(54, 'Chrysanthemum.jpg', '', '', '2017-08-31 16:35:10', '37RFPK59a864ee6741eSQX9TJ'),
(55, 'Desert.jpg', '', '', '2017-08-31 16:35:11', 'TJMU0459a864ef4516fK4K8JB'),
(56, 'Hydrangeas.jpg', '', '', '2017-08-31 16:35:11', '4JTYQB59a864efd4e599XZ99R'),
(57, 'Jellyfish.jpg', '', '', '2017-08-31 16:35:12', '0LLEE159a864f077e34NB7S9H'),
(58, 'Koala.jpg', '', '', '2017-08-31 16:35:13', '2MRD2059a864f13b59f0YSQC0'),
(59, 'Lighthouse.jpg', '', '', '2017-08-31 16:35:13', 'B0LI9659a864f1c7fc04YPISY'),
(60, 'Penguins.jpg', '', '', '2017-08-31 16:35:14', '90VZZX59a864f263682A0IZCI'),
(61, 'Tulips.jpg', '', '', '2017-08-31 16:35:15', 'X1VFTT59a864f355bf8999KBZ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  `log` varchar(1000) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
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

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`id`, `nome`, `telefone`, `email`, `assunto`, `mensagem`, `data_de_cadastro`, `status`) VALUES
(1, 'Peterson', '992212548', 'peterson.jfp@gmail.com', 'assunto', 'mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, ', '2017-08-16 06:11:48', 1),
(2, 'Paty', '995216458', 'paty@gmail.com', 'outro assunto maior', 'mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande, mensagem grande,', '2017-08-15 03:29:19', 0),
(3, 'Peterson', '51992129851', 'peter@peter', 'bug', 'houve um bug na linha 125 do controler dashboard quando uma requisição a api do pagseguro não retornou nenhum dado', '2017-12-18 01:14:02', 0),
(4, 'Peterson', '51992129851', 'peter@peter', 'bug', 'houve um bug na linha 125 do controler dashboard quando uma requisição a api do pagseguro não retornou nenhum dado', '2017-12-18 01:14:02', 0),
(5, 'Peterson', '51992129851', 'peter@peter', 'bug', 'houve um bug na linha 125 do controler dashboard quando uma requisição a api do pagseguro não retornou nenhum dado', '2017-12-18 01:14:02', 0),
(6, 'Peterson', '51992129851', 'peter@peter', 'bug', 'houve um bug na linha 125 do controler dashboard quando uma requisição a api do pagseguro não retornou nenhum dado', '2017-12-18 01:14:02', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
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

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `corpo`, `imagem`, `status`, `visibilidade`, `token`, `autor`, `data_cadastro`, `data_atualizacao`, `ultimo_usuario_que_atualizou`) VALUES
(6, 'uma noticia', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus, eros eu elementum dapibus, magna odio tincidunt tortor, non sodales leo purus ut ligula. Aenean viverra a lacus id elementum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla at vestibulum est, non facilisis augue. Integer magna mauris, pulvinar ut vestibulum nec, auctor et nisi. Nam posuere dolor massa, ut vulputate mi eleifend eu. Sed odio magna, commodo nec laoreet vitae, blandit sit amet quam. Sed lacinia, enim vel interdum euismod, sapien lacus elementum libero, sit amet ullamcorper turpis sem quis ex.</p>\r\n\r\n<p>Maecenas id turpis a mauris gravida porta. Etiam molestie consequat lobortis. Praesent viverra sapien sit amet ligula faucibus, nec posuere est facilisis. Nam vestibulum lorem lorem, et lobortis mauris aliquet mattis. Aenean sit amet risus sit amet dolor facilisis bibendum sit amet vel lacus. Suspendisse imperdiet fringilla nisl in aliquet. Cras dapibus in risus in rutrum. Donec risus odio, tincidunt at commodo sagittis, commodo vel mi.</p>\r\n\r\n<p>Ut ac ex eu leo lobortis posuere sed eget ipsum. Maecenas pellentesque vestibulum orci, ut vulputate sem elementum id. Fusce ut ultrices nunc. Mauris ac aliquam velit. Suspendisse varius orci risus. Cras placerat, diam eu dignissim ultricies, urna ante facilisis lacus, eget fringilla enim elit a lacus. Vestibulum at consequat urna. Aliquam lobortis tellus eget nisl fringilla maximus. Nunc rutrum sem vitae pellentesque iaculis. Nullam auctor vel nunc vel varius.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'black-wallpaper.jpg', 1, 1, 'WHTW7W599b3614a4937Q9JWZK', 1, '2017-08-21 16:35:48', '2017-12-03 17:38:16', 1),
(7, 'Outra noticia', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus, eros eu elementum dapibus, magna odio tincidunt tortor, non sodales leo purus ut ligula. Aenean viverra a lacus id elementum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla at vestibulum est, non facilisis augue. Integer magna mauris, pulvinar ut vestibulum nec, auctor et nisi. Nam posuere dolor massa, ut vulputate mi eleifend eu. Sed odio magna, commodo nec laoreet vitae, blandit sit amet quam. Sed lacinia, enim vel interdum euismod, sapien lacus elementum libero, sit amet ullamcorper turpis sem quis ex.</p>\r\n\r\n<p>Maecenas id turpis a mauris gravida porta. Etiam molestie consequat lobortis. Praesent viverra sapien sit amet ligula faucibus, nec posuere est facilisis. Nam vestibulum lorem lorem, et lobortis mauris aliquet mattis. Aenean sit amet risus sit amet dolor facilisis bibendum sit amet vel lacus. Suspendisse imperdiet fringilla nisl in aliquet. Cras dapibus in risus in rutrum. Donec risus odio, tincidunt at commodo sagittis, commodo vel mi.</p>\r\n\r\n<p>Ut ac ex eu leo lobortis posuere sed eget ipsum. Maecenas pellentesque vestibulum orci, ut vulputate sem elementum id. Fusce ut ultrices nunc. Mauris ac aliquam velit. Suspendisse varius orci risus. Cras placerat, diam eu dignissim ultricies, urna ante facilisis lacus, eget fringilla enim elit a lacus. Vestibulum at consequat urna. Aliquam lobortis tellus eget nisl fringilla maximus. Nunc rutrum sem vitae pellentesque iaculis. Nullam auctor vel nunc vel varius.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'black-wallpaper-1.jpg', 1, 1, 'ECIU2R599b363749e9cUL4UDW', 1, '2017-08-21 16:36:23', '2017-12-03 17:38:37', 1),
(15, 'Noticia 6', '<p>um texto testador....</p>\r\n', '', 1, 1, 'JLNXQV5a2479aed715649QTHA', 1, '2017-12-03 20:24:46', '2017-12-03 20:24:46', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia_categoria`
--

CREATE TABLE `noticia_categoria` (
  `id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `noticia_categoria`
--

INSERT INTO `noticia_categoria` (`id`, `categoria`, `noticia`) VALUES
(60, 3, 6),
(61, 6, 6),
(62, 3, 7),
(63, 5, 7),
(64, 8, 7),
(65, 3, 15),
(66, 9, 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia_tag`
--

CREATE TABLE `noticia_tag` (
  `id` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  `noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `noticia_tag`
--

INSERT INTO `noticia_tag` (`id`, `tag`, `noticia`) VALUES
(115, 1, 6),
(116, 7, 6),
(117, 8, 6),
(118, 16, 6),
(119, 1, 7),
(120, 8, 7),
(121, 9, 7),
(122, 10, 7),
(123, 11, 7),
(124, 12, 7),
(125, 15, 7),
(126, 1, 15),
(127, 10, 15),
(128, 16, 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `option`
--

CREATE TABLE `option` (
  `id_option` int(11) NOT NULL,
  `nome_option` varchar(100) NOT NULL,
  `valor_option` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `option`
--

INSERT INTO `option` (`id_option`, `nome_option`, `valor_option`) VALUES
(3, 'manutencao', ''),
(11, 'email_principal', 'peterson.jfp@gmail.com'),
(12, 'nome_da_empresa', 'Exemplo'),
(14, 'link_rede_social_facebook', 'facebook.com.br'),
(15, 'link_rede_social_instagram', 'insta'),
(16, 'link_rede_social_twitter', 'twitter.com'),
(17, 'link_rede_social_youtube', 'youtube.com'),
(18, 'link_rede_social_gplus', 'googleplus.com'),
(19, 'link_rede_social_linkedin', 'linkedin.com'),
(20, 'email_de_boas_vindas', '<p>Bem vindo a nossa newsletter</p>\r\n\r\n<p>A partir de agora voc&ecirc; receber&aacute; em primeira m&atilde;o todas as nossas promo&ccedil;&otilde;es.</p>\r\n\r\n<p>Att.</p>\r\n\r\n<p>Gerente da loja.</p>\r\n\r\n<p><canvas :netbeans_generated=\"true\" height=\"200\" id=\"netbeans_glasspane\" style=\"position: fixed; top: 0px; left: 0px; z-index: 50000; pointer-events: none;\" width=\"1306\"></canvas></p>\r\n'),
(21, 'tags', '<!-- aqui irÃ¡ tags de rastreio como analytcs por exemplo --!>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tag`
--

INSERT INTO `tag` (`id`, `nome`, `slug`, `descricao`) VALUES
(1, 'Carro usado', 'carro-usado', ''),
(7, 'roupa', 'roupa', ''),
(8, 'moda', 'moda', ''),
(9, 'beleza', 'beleza', ''),
(10, 'chiqueza', 'chiqueza', ''),
(11, 'alto padrao', 'alto padrao', ''),
(12, 'luxo', 'luxo', ''),
(15, 'topmodel', 'topmodel', ''),
(16, 'batata frita', 'batata frita', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
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

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `login`, `senha`, `telefone`, `email`, `nivel_de_acesso`, `data_de_cadastro`, `data_de_ultimo_acesso`, `status`) VALUES
(1, 'Peter', 'admin', '$2y$10$4/dIEyC3Oz.28pMihIDPdO.6kZkpYaXXmfO3OAzvGeQOYopFyXPWm', '', 'peterson.jfp@gmail.com', 0, '2017-05-19 05:32:21', '2017-12-09 14:16:36', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visualizacoes`
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
-- Extraindo dados da tabela `visualizacoes`
--

INSERT INTO `visualizacoes` (`id`, `tipo`, `opcional_1`, `opcional_2`, `opcional_3`, `data_de_visualizacao`) VALUES
(1, 1, 0, 0, 0, '2017-12-10 06:25:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia` (`noticia`),
  ADD KEY `categoria` (`categoria`);

--
-- Indexes for table `noticia_tag`
--
ALTER TABLE `noticia_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag` (`tag`),
  ADD KEY `noticia` (`noticia`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id_option`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visualizacoes`
--
ALTER TABLE `visualizacoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `noticia_tag`
--
ALTER TABLE `noticia_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visualizacoes`
--
ALTER TABLE `visualizacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  ADD CONSTRAINT `noticia_categoria_ibfk_1` FOREIGN KEY (`noticia`) REFERENCES `noticia` (`id`),
  ADD CONSTRAINT `noticia_categoria_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`);

--
-- Limitadores para a tabela `noticia_tag`
--
ALTER TABLE `noticia_tag`
  ADD CONSTRAINT `noticia_tag_ibfk_1` FOREIGN KEY (`tag`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `noticia_tag_ibfk_2` FOREIGN KEY (`noticia`) REFERENCES `noticia` (`id`),
  ADD CONSTRAINT `noticia_tag_ibfk_3` FOREIGN KEY (`noticia`) REFERENCES `noticia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
