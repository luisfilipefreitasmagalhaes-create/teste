-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Jul-2024 às 17:37
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cervejaria56`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acompanhamentos`
--

CREATE TABLE `acompanhamentos` (
  `ID_A` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `acompanhamentos`
--

INSERT INTO `acompanhamentos` (`ID_A`, `Nome`) VALUES
(1, 'Ovo\r\n'),
(2, 'Molho especial\r\n'),
(3, 'Batata Frita\r\n'),
(4, 'Batata Frita Country\r\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `ID_C` int(11) NOT NULL,
  `Cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`ID_C`, `Cargo`) VALUES
(1, 'Garçom'),
(2, 'Cozinheiro'),
(3, 'Chefe');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empregados`
--

CREATE TABLE `empregados` (
  `ID_E` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `SobreNome` varchar(50) NOT NULL,
  `Pass` varchar(30) NOT NULL,
  `Cargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `empregados`
--

INSERT INTO `empregados` (`ID_E`, `Nome`, `SobreNome`, `Pass`, `Cargo`) VALUES
(1, 'Luis', 'Filipe', '1234', 'Chefe');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesas`
--

CREATE TABLE `mesas` (
  `ID_M` int(11) NOT NULL,
  `Descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `mesas`
--

INSERT INTO `mesas` (`ID_M`, `Descricao`) VALUES
(1, 'Mesa 1'),
(2, 'Mesa 2'),
(3, 'Mesa 3'),
(4, 'Mesa 4'),
(5, 'Mesa 5'),
(6, 'Mesa 6'),
(7, 'Mesa 7'),
(8, 'Mesa 8'),
(9, 'Mesa 9'),
(10, 'Mesa 10'),
(11, 'Mesa fora 1'),
(12, 'Mesa fora 2'),
(13, 'Mesa fora 3'),
(14, 'Balcao lg 1'),
(15, 'Balcao lg 2'),
(16, 'Balcao lg 3'),
(17, 'Balcao lg 4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pao`
--

CREATE TABLE `pao` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pao`
--

INSERT INTO `pao` (`id`, `tipo`) VALUES
(1, 'Pão Normal'),
(2, 'Pão Brioche'),
(3, 'Bolo Caco');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `ID` int(11) NOT NULL,
  `ID_F` int(10) NOT NULL,
  `ID_Mesa` int(11) NOT NULL,
  `ID_Produto` int(11) NOT NULL,
  `Obs` varchar(400) NOT NULL,
  `Estado` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`ID`, `ID_F`, `ID_Mesa`, `ID_Produto`, `Obs`, `Estado`) VALUES
(282, 1, 1, 21, '<br><strong>Tipo de Pão:</strong> Pão Normal<br><strong>Ingredientes:</strong><br>Hamburguer frango panado,<br>Queijo cheddar,<br>Cebola Frita,<br>Bacon,<br>Molho Barbacue<br><br><strong>Acompanhamentos:</strong><br>Ovo\r\n<br>Batata Frita Country\r\n<br>', 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `ID_P` int(11) NOT NULL,
  `Produto` varchar(100) NOT NULL,
  `Ingredientes` varchar(250) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`ID_P`, `Produto`, `Ingredientes`, `Tipo`, `Imagem`) VALUES
(1, 'Meio Metro', 'Hamburguer\nQueijo \nFiambre \nKetchup\n1 dose de batatas', 'hamb', 'meiometro.png'),
(2, 'Poupa ', 'Queijo \nFiambre \nBacon\nMolho 56\nbatata frita', 'hamb', 'poupa.png'),
(3, '56', 'Hamburguer\nQueijo Cheddar\nAlface\nTomate\nBacon\nBatata palha\nMolho Samurai', 'hamb', '56.png'),
(10, 'Samurai', 'Hamburguer\nQueijo Cheddar\nAlface\nTomate\nBacon\nBatata palha\nMolho Samurai', 'hamb', 'samurai.png'),
(20, 'Duplo a 56', '2 Hamburguer,\nQueijo cheddar, \nAlface,\nTomate,\nCebola Frita,\nBacon,\nMolho 56', 'hamb', 'duplo56.png'),
(21, 'Frango Panado', 'Hamburguer frango panado,\nQueijo cheddar,\nAlface,\nTomate, \nCebola Frita,\nBacon,\nMolho Barbacue', 'hamb', 'frangopanado.png'),
(22, 'Vegetariano', 'Hamburguer 100% espinafres,\nQueijo cheddar,\nAlface,\nTomate,\nCenoura,\nMaionese', 'hamb', 'vegetariano.png'),
(23, '3XL', '3 Hamburguers,\nQueijo Cheddar,\nAlface,\nTomate,\nCebola Frita,\nBacon,\nMolho 56', 'hamb', 'duplo56.png'),
(24, 'Kebab no Pão', 'Alface,\r\nTomate,\r\nMolho picante?', 'snack', 'kebabnopao.png'),
(25, 'Pão de alho em bolo do caco', '1 unidade', 'entrada', 'alhocaco.png'),
(27, 'Cheddar no Caco', '1 unidade', 'entrada', 'hamb4.png'),
(28, 'Anéis de cebola', '8 unidades', 'entrada', 'aroscebola.png'),
(29, 'Pimentos padron', '1 unidade ', 'entrada', 'pimentospadron.png'),
(30, 'Bolinhas de queijo', '8 unidades', 'entrada', 'bolinhasqueijo.png'),
(31, 'Tiras de frango', '6 unidades', 'entrada', 'tirasfrango.png'),
(32, 'Gambas Panadas', '6 unidades', 'entrada', 'gambas.png'),
(33, 'Chouriça a 56', '1 unidade', 'entrada', 'choura.png'),
(34, 'Sticks mozarella', '6 unidade', 'entrada', 'sticks.png'),
(35, 'Moelas', '1 doze', 'entrada', 'moelas.png'),
(36, 'Bolinhas de alheira', '6 unidades', 'entrada', 'bolasalheira.png'),
(37, 'Nachos', '6 unidades', 'entrada', 'nachos.png'),
(38, 'Asinhas', '6 unidades', 'entrada', 'asas.png'),
(39, 'Picadinho C/Batata Frita', 'Molho especial', 'entrada', 'picadinho.png'),
(40, 'Francesinha Normal', '', 'snack', 'francesinha.png'),
(41, 'Cachorro Normal', '', 'snack', 'cachorro2.png'),
(42, 'Tosta Especial', '', 'snack', 'tosta.png'),
(44, 'Menu Infantil ', '4 Panadinhos,\r\nBatata Frita', 'snack', 'menuinfantil.png'),
(45, 'Prego no Bolo de caco', 'Alcatra,\r\nQueijo,\r\nFiambre', 'snack', 'pregocaco.png'),
(46, 'Cachorro Especial', 'Batata Frita', 'snack', 'cachorro.png'),
(47, 'Kebab no Prato', 'Kebab,\r\nALface,\r\nTomate,\r\nBatata Frita', 'snack', 'kebabnoprato.png'),
(48, 'Prego no Prato', 'Alcatra,\r\nOvo,\r\nAlface,\r\nTomate,\r\nBatata Frita', 'snack', 'pregonoprato.png'),
(49, 'Francesinha Especial ', 'Ovo,\r\nBatata Frita', 'snack', 'francesinha.png'),
(50, 'Doce da casa', '', 'sobremesa', 'docecasa.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `ID_R` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `Dia` date NOT NULL,
  `Hora` time NOT NULL,
  `Numero_Pessoas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acompanhamentos`
--
ALTER TABLE `acompanhamentos`
  ADD PRIMARY KEY (`ID_A`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`ID_C`);

--
-- Índices para tabela `empregados`
--
ALTER TABLE `empregados`
  ADD PRIMARY KEY (`ID_E`);

--
-- Índices para tabela `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`ID_M`);

--
-- Índices para tabela `pao`
--
ALTER TABLE `pao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ID_P`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`ID_R`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acompanhamentos`
--
ALTER TABLE `acompanhamentos`
  MODIFY `ID_A` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `ID_C` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `empregados`
--
ALTER TABLE `empregados`
  MODIFY `ID_E` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `mesas`
--
ALTER TABLE `mesas`
  MODIFY `ID_M` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `pao`
--
ALTER TABLE `pao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ID_P` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `ID_R` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
