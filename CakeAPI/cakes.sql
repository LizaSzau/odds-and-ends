-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 02, 2021 at 10:39 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trial_cake`
--

-- --------------------------------------------------------

--
-- Table structure for table `cakes`
--

DROP TABLE IF EXISTS `cakes`;
CREATE TABLE IF NOT EXISTS `cakes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) COLLATE utf8_hungarian_ci NOT NULL,
  `confectioner` char(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `vegan` tinyint(1) NOT NULL DEFAULT '0',
  `lactose_free` tinyint(1) NOT NULL DEFAULT '0',
  `price` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_hungarian_ci,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`id`, `name`, `confectioner`, `vegan`, `lactose_free`, `price`, `description`, `updated_at`, `created_at`) VALUES
(4, 'Piskóta tekercs', 'Pista bá', 0, 0, 8000, 'Nem piskóta!', '2021-03-01 19:43:16', '2021-03-01 18:43:16'),
(6, 'Csoki torta', 'Bálint', 0, 0, 4000, 'Semmi extra, de finom.', '2021-03-01 19:43:39', '2021-03-01 18:43:39'),
(8, 'Erdei', 'A főnök', 0, 0, 9000, 'Frissen szedett szamócával.', '2021-03-01 19:44:11', '2021-03-01 18:44:11'),
(10, 'Habos babos', 'Brunesz', 0, 0, 3000, 'Nyami nyami nyam.', '2021-03-01 19:57:30', '2021-03-01 18:57:30'),
(18, 'Mákom van', 'Lucky Laci', 0, 1, 10000, NULL, '2021-03-02 11:33:28', '2021-03-02 10:33:28'),
(13, 'Garfield kedvence', 'Cilike néni', 1, 1, 8000, 'Ez igazából nem is torta, hanem lasagna.', '2021-03-01 20:00:53', '2021-03-02 10:30:31'),
(17, 'Narancs liget', 'Kötényke has', 1, 1, 9000, 'Ezt máskor is. Most módosítom. Már megint.', '2021-03-01 23:16:45', '2021-03-01 22:16:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
