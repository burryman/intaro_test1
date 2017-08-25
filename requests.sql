-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 25 2017 г., 10:43
-- Версия сервера: 5.7.19-0ubuntu0.16.04.1
-- Версия PHP: 7.0.22-2+ubuntu16.04.1+deb.sury.org+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `requests`
--

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `description` varchar(128) NOT NULL,
  `image_url` varchar(128) NOT NULL,
  `creator_id` int(50) NOT NULL,
  `slug` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `title`, `phone`, `description`, `image_url`, `creator_id`, `slug`) VALUES
(24, 'Первая заявка юзера1', '12345', 'Первая проблема юзера1', 'http://site.local/uploads/1765795497599fcf854165a.png', 5, 'pervaya-zayavka-yuzera1'),
(25, 'Вторая заявка юзера1', '12345', 'Вторая проблема юзера1', 'http://site.local/uploads/498162194599fcf9a4e891.png', 5, 'vtoraya-zayavka-yuzera1'),
(26, 'Первая заявка юзера2', '54321', 'Первая проблема юзера2', 'http://site.local/uploads/1613876112599fcfe12669b.png', 6, 'pervaya-zayavka-yuzera2'),
(27, 'Вторая заявка юзера2', '54321', 'Вторая проблема юзера2', 'http://site.local/uploads/576893725599fcff6d88de.png', 6, 'vtoraya-zayavka-yuzera2');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `admin`, `created`, `modified`, `status`) VALUES
(4, 'Админ', 'Админ', 'admin@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 1, '2017-08-24 16:03:47', '2017-08-24 16:03:47', '1'),
(5, 'Юзер', 'Юзер', 'user1@gmail.com', '24c9e15e52afc47c225b757e7bee1f9d', 0, '2017-08-24 16:05:32', '2017-08-24 16:05:32', '1'),
(6, 'Юзер2', 'Юзер2', 'user2@gmail.com', '7e58d63b60197ceb55a1c487989a3720', 0, '2017-08-24 16:22:42', '2017-08-24 16:22:42', '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `id_3` (`id`),
  ADD UNIQUE KEY `id_4` (`id`),
  ADD UNIQUE KEY `id_5` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
