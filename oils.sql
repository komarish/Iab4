-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 20 2022 г., 16:53
-- Версия сервера: 5.7.33
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `oils`
--

-- --------------------------------------------------------

--
-- Структура таблицы `combinations`
--

CREATE TABLE `combinations` (
  `comb_id` int(11) NOT NULL COMMENT 'id сочетания',
  `oil_1` int(11) NOT NULL COMMENT 'id первого масла',
  `oil_2` int(11) NOT NULL COMMENT 'id второго масла'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `combinations`
--

INSERT INTO `combinations` (`comb_id`, `oil_1`, `oil_2`) VALUES
(1, 1, 17),
(2, 1, 14),
(3, 1, 18),
(4, 1, 11),
(5, 1, 22),
(6, 1, 15),
(7, 1, 19),
(8, 1, 29),
(9, 1, 30),
(10, 1, 13),
(11, 2, 20),
(12, 2, 8),
(13, 2, 15),
(14, 2, 17),
(15, 2, 34),
(16, 2, 3),
(17, 2, 5),
(18, 2, 35),
(19, 3, 22),
(20, 3, 10),
(21, 3, 11),
(22, 3, 21),
(23, 3, 14),
(25, 3, 17),
(26, 4, 27),
(27, 4, 32),
(28, 4, 9),
(29, 4, 21),
(30, 4, 6),
(31, 4, 24),
(32, 4, 8),
(33, 9, 1),
(34, 9, 2),
(35, 9, 3),
(36, 9, 4),
(37, 9, 5),
(38, 9, 6),
(39, 9, 7),
(40, 9, 8),
(41, 9, 10),
(42, 9, 11),
(43, 9, 12),
(44, 9, 13),
(45, 9, 14),
(46, 9, 15),
(47, 9, 16),
(48, 9, 17),
(49, 9, 18),
(50, 9, 19),
(51, 9, 20),
(52, 9, 21),
(53, 9, 22),
(54, 9, 23),
(55, 9, 25),
(56, 9, 27),
(57, 9, 26),
(58, 9, 28),
(59, 9, 29),
(60, 9, 30),
(61, 9, 31),
(62, 9, 32),
(63, 9, 33),
(64, 9, 34),
(65, 9, 35),
(66, 5, 18),
(67, 5, 14),
(68, 5, 13),
(69, 6, 18),
(70, 6, 24),
(71, 6, 14),
(72, 6, 32),
(73, 6, 10),
(74, 6, 8),
(75, 6, 17),
(76, 6, 22),
(77, 6, 13),
(78, 6, 30),
(79, 7, 32),
(80, 7, 10),
(81, 7, 8),
(82, 7, 4),
(83, 8, 33),
(84, 8, 21),
(85, 8, 16),
(86, 8, 18),
(87, 8, 11),
(88, 8, 10),
(89, 8, 17),
(90, 8, 28),
(91, 8, 35),
(92, 8, 24),
(93, 10, 22),
(94, 10, 32),
(95, 10, 5),
(96, 10, 33),
(97, 10, 14),
(98, 10, 18),
(99, 10, 17),
(100, 10, 25),
(101, 10, 28),
(102, 10, 19),
(103, 10, 29),
(104, 10, 21),
(105, 10, 13),
(106, 10, 34),
(107, 10, 35),
(108, 10, 16),
(109, 10, 20),
(110, 10, 30),
(111, 10, 11),
(112, 8, 2),
(113, 3, 2),
(114, 5, 2),
(115, 10, 3),
(116, 8, 9),
(117, 6, 4),
(118, 8, 4),
(119, 10, 9),
(120, 1, 9),
(121, 2, 9),
(122, 3, 9),
(123, 5, 9),
(124, 3, 5),
(125, 6, 9),
(126, 8, 6),
(127, 8, 7),
(128, 4, 7),
(129, 10, 8),
(130, 5, 10),
(131, 10, 1),
(132, 7, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `effects`
--

CREATE TABLE `effects` (
  `effect_id` int(11) NOT NULL,
  `effect_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `effects`
--

INSERT INTO `effects` (`effect_id`, `effect_name`) VALUES
(1, 'освежающее'),
(2, 'стимулирующее'),
(3, 'очищающее'),
(4, 'гармонизирующее'),
(5, 'расслабляющее'),
(6, 'успокаивающее'),
(7, 'укрепляющее'),
(8, 'антистрессовое'),
(9, 'чувственное');

-- --------------------------------------------------------

--
-- Структура таблицы `essense`
--

CREATE TABLE `essense` (
  `oil_id` int(11) NOT NULL COMMENT 'id масла',
  `oil_name` tinytext NOT NULL COMMENT 'Наименование масла',
  `description` text COMMENT 'Описание масла',
  `volatility` int(11) DEFAULT NULL COMMENT 'Летучесть',
  `group` int(11) DEFAULT NULL COMMENT 'Принадлежность к группе',
  `effects` tinytext COMMENT 'Воздействие на организм'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Масла и их свойства';

--
-- Дамп данных таблицы `essense`
--

INSERT INTO `essense` (`oil_id`, `oil_name`, `description`, `volatility`, `group`, `effects`) VALUES
(1, 'лемонграсс', NULL, 3, 3, '2,8,9'),
(2, 'ваниль', NULL, 1, 5, '4,5,6'),
(3, 'кедр', NULL, 1, 4, '4,5,7'),
(4, 'корица', NULL, 1, 5, '3,6,7'),
(5, 'гиацинт', NULL, 2, 1, '8,9'),
(6, 'мята', NULL, 2, 2, '1,2,7'),
(7, 'чайное дерево', NULL, 3, 4, '3,7'),
(8, 'гвоздика', NULL, 1, 5, '2,7,8,9'),
(9, 'лаванда', NULL, 2, 1, '1,2,3,7,8'),
(10, 'бергамот', NULL, 3, 3, '8,9'),
(11, 'шалфей', NULL, 2, 2, '2,3,7'),
(12, 'черная смородина', NULL, 2, 8, '7,8,9'),
(13, 'нероли', NULL, 1, 1, '4,6,9'),
(14, 'жасмин', NULL, 1, 1, '4,6,8,9'),
(15, 'анис', NULL, 3, 5, '4,7,8'),
(16, 'роза', NULL, 2, 1, '3,4,9'),
(17, 'имбирь', NULL, 1, 5, '2,3,7'),
(18, 'иланг-иланг', NULL, 1, 7, '2,4,9'),
(19, 'ладан', NULL, 1, 6, '6,7,8'),
(20, 'сандал', NULL, 1, 7, '4,5,9'),
(21, 'можжевельник', NULL, 2, 4, '2,7,8'),
(22, 'апельсин сладкий', NULL, 3, 3, '1,3,4,5,9'),
(23, 'полынь горькая', NULL, 3, 2, '2,8'),
(24, 'розмарин', NULL, 2, 2, '2,7'),
(25, 'ирис', NULL, 2, 1, '5,6'),
(26, 'пальмароза', NULL, NULL, NULL, NULL),
(27, 'эвкалипт', NULL, 3, 4, '1,3,6'),
(28, 'лимон', NULL, 3, 3, '1,2,3,7'),
(29, 'мимоза', NULL, 2, 1, '4,6,8'),
(30, 'чабрец', NULL, 2, 2, '3,4,7'),
(31, 'вербена', NULL, 3, 2, '2,7'),
(32, 'герань', NULL, 2, 1, '3,4,6,8,9'),
(33, 'грейпфрут', NULL, 3, 3, '2,4,8,9'),
(34, 'пачули', NULL, 1, 7, '8,9'),
(35, 'пихта', NULL, 2, 4, '1,3,7');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL COMMENT 'id группы масел',
  `group_name` tinytext NOT NULL COMMENT 'Наименование группы'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, 'цветочные'),
(2, 'травяные'),
(3, 'цитрусовые'),
(4, 'древесные'),
(5, 'пряные'),
(6, 'смоляные'),
(7, 'экзотические'),
(8, 'фруктовые');

-- --------------------------------------------------------

--
-- Структура таблицы `ingredients`
--

CREATE TABLE `ingredients` (
  `recipe_id` int(11) NOT NULL COMMENT 'id рецепта',
  `oil` tinytext NOT NULL COMMENT 'наименования масла в рецепте',
  `quantity` int(255) NOT NULL COMMENT 'количество (в каплях)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ingredients`
--

INSERT INTO `ingredients` (`recipe_id`, `oil`, `quantity`) VALUES
(1, 'иланг-иланг', 3),
(1, 'нероли', 4),
(1, 'герань', 2),
(2, 'пихта', 3),
(2, 'мандарин', 3),
(2, 'ель', 2),
(4, 'бергамот', 4),
(4, 'мята', 2),
(4, 'имбирь', 3),
(5, 'мелисса', 3),
(5, 'пачули', 3),
(5, 'миндаль горький', 2),
(6, 'бергамот', 4),
(6, 'пачули', 2),
(6, 'ладан', 1),
(7, 'бергамот', 3),
(7, 'мята', 3),
(7, 'имбирь', 5),
(7, 'апельсин', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL COMMENT 'id рецепта',
  `recipe_name` tinytext NOT NULL COMMENT 'название рецепта',
  `verified` int(255) DEFAULT NULL COMMENT 'прошел ли проверку'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `recipe_name`, `verified`) VALUES
(1, 'Летние грёзы', 1),
(2, 'Зимняя сказка', 1),
(4, 'Зимний вечер', 1),
(5, 'Осеннее настроение', 1),
(6, 'Осенний дым', 0),
(7, 'Предновогоднее', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `volatility`
--

CREATE TABLE `volatility` (
  `volat_id` int(11) NOT NULL COMMENT 'id летучести',
  `volat_name` tinytext NOT NULL COMMENT 'Степень летучести'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `volatility`
--

INSERT INTO `volatility` (`volat_id`, `volat_name`) VALUES
(1, 'низкая'),
(2, 'средняя'),
(3, 'высокая');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `combinations`
--
ALTER TABLE `combinations`
  ADD PRIMARY KEY (`comb_id`),
  ADD KEY `oil_left` (`oil_1`),
  ADD KEY `oil_right` (`oil_2`);

--
-- Индексы таблицы `effects`
--
ALTER TABLE `effects`
  ADD PRIMARY KEY (`effect_id`);

--
-- Индексы таблицы `essense`
--
ALTER TABLE `essense`
  ADD PRIMARY KEY (`oil_id`) USING BTREE,
  ADD KEY `volat` (`volatility`),
  ADD KEY `group` (`group`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Индексы таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD KEY `ingr_foreign_key` (`recipe_id`);

--
-- Индексы таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Индексы таблицы `volatility`
--
ALTER TABLE `volatility`
  ADD PRIMARY KEY (`volat_id`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `combinations`
--
ALTER TABLE `combinations`
  MODIFY `comb_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id сочетания', AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT для таблицы `essense`
--
ALTER TABLE `essense`
  MODIFY `oil_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id масла', AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id рецепта', AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `combinations`
--
ALTER TABLE `combinations`
  ADD CONSTRAINT `oil_left` FOREIGN KEY (`oil_1`) REFERENCES `essense` (`oil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oil_right` FOREIGN KEY (`oil_2`) REFERENCES `essense` (`oil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `essense`
--
ALTER TABLE `essense`
  ADD CONSTRAINT `group` FOREIGN KEY (`group`) REFERENCES `groups` (`group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `volat` FOREIGN KEY (`volatility`) REFERENCES `volatility` (`volat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingr_foreign_key` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
