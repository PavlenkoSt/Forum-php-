-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 23 2021 г., 19:11
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Forum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'IT-технологии'),
(2, 'Здоровье'),
(3, 'Литература'),
(4, 'Философия и психология'),
(5, 'Астрономия'),
(6, 'Другое');

-- --------------------------------------------------------

--
-- Структура таблицы `discusses`
--

CREATE TABLE `discusses` (
  `id` int(11) NOT NULL,
  `discuss` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `admin_true` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `discusses`
--

INSERT INTO `discusses` (`id`, `discuss`, `category_id`, `author_id`, `date`, `admin_true`) VALUES
(11, 'Как испечь торт?', 6, 22, '2021-02-23', 1),
(13, 'Как спасти мир от самого себя?', 1, 22, '2021-02-23', 1),
(14, 'Как удачно выйти замуж?', 1, 35, '2021-02-23', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `message`) VALUES
(9, 'У меня есть яйца, мука и руки.'),
(12, 'Уйти в айти!'),
(13, 'Помогите срочно! Мне уже 25!'),
(14, 'И духовка где-то валяется!'),
(19, 'Помогите ребята!'),
(20, 'Берешь яйца и взбиваешь, потом мукой присыпь и можно есть.'),
(21, 'Шутка!)'),
(22, 'Или в кулинарию!)'),
(26, 'Одно другому не мешает.)))'),
(27, 'Шутница однако.))');

-- --------------------------------------------------------

--
-- Структура таблицы `mess_of_diss`
--

CREATE TABLE `mess_of_diss` (
  `id` int(11) NOT NULL,
  `diss_id` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mess_of_diss`
--

INSERT INTO `mess_of_diss` (`id`, `diss_id`, `mess_id`, `author_id`, `date`) VALUES
(4, 11, 9, 22, '2021-02-23'),
(7, 13, 12, 22, '2021-02-23'),
(8, 14, 13, 35, '2021-02-23'),
(9, 11, 14, 22, '2021-02-23'),
(10, 11, 19, 22, '2021-02-23'),
(11, 11, 20, 35, '2021-02-23'),
(12, 11, 21, 35, '2021-02-23'),
(13, 13, 22, 35, '2021-02-23'),
(17, 13, 26, 22, '2021-02-23'),
(18, 11, 27, 22, '2021-02-23');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `status`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(32) NOT NULL,
  `dateBirth` date NOT NULL,
  `registrationDate` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `banned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `dateBirth`, `registrationDate`, `status_id`, `banned`) VALUES
(22, 'admin', '$2y$10$kTKbzOo2xlFUf./ASszps.G/r0bqGvz7dF2raguJH49UxcOoG6NFK', 'v@mail.com', '2013-06-06', '2021-02-21', 2, 0),
(35, 'Julia', '$2y$10$DEqcDfClk8h0ogdTiSB3J.BgKmo..XqSG1r3ZdVljueHd0.kEXAF.', 'v@mail.com', '2021-02-05', '2021-02-22', 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `discusses`
--
ALTER TABLE `discusses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mess_of_diss`
--
ALTER TABLE `mess_of_diss`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `discusses`
--
ALTER TABLE `discusses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `mess_of_diss`
--
ALTER TABLE `mess_of_diss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
