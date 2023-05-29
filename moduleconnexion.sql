-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 29 mai 2023 à 08:11
-- Version du serveur : 8.0.32
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moduleconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) CHARACTER SET ascii NOT NULL,
  `firstname` varchar(255) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET ascii NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COMMENT='Ma table user';

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `firstname`, `lastname`, `password`) VALUES
(1, 'luke', 'Luke', 'Skywalker', '$2y$10$UkO.KZpjk7BXLj2tRDgHquekiHuaZUBBFiOR7iieOgixPO8YKh2bm'),
(2, 'admin', 'admin', 'admin', 'admin'),
(8, 'harry', 'Harry', 'Potter', '$2y$10$FrL0NDKP83C3g0.KIEEUquv3IqcdJNLGB6VGc4EOS71p0C7w6YwLq'),
(9, 'ali', 'djambae', 'djambae', '$2y$10$26/Jvsl/PWQFBdDC0EJUa.LJtjlWQgkfQ4FM6BOWuvXgp2EdBpq22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
