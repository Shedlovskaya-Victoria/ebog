-- Adminer 4.8.1 MySQL 8.0.34-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Article`;
CREATE TABLE `Article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Article` (`id`, `title`, `image`, `content`) VALUES
(1,	'Smaile text',	'https://www.google.com/url?sa=i&url=https%3A%2F%2Fru.freepik.com%2Fphotos%2F%25D1%2581%25D0%25BC%25D0%25B5%25D1%2585&psig=AOvVaw3BUdYltj48KzJ7OuU2Wwez&ust=1697873301032000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCLiNmIqNhIIDFQAAAAAdAAAAABAE',	'Content Content'),
(2,	'Two state',	'/img/2.jpeg',	'content 3'),
(3,	'Third state',	'/img/1.png',	'content 4');

-- 2023-11-14 06:18:05
