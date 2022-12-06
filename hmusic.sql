-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 juil. 2020 à 05:59
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hmusic`
--

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(45) DEFAULT NULL,
  `artist_biography` text DEFAULT NULL,
  `artist_details` varchar(45) DEFAULT NULL,
  `artist_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `artist_biography`, `artist_details`, `artist_photo`) VALUES
(1, 'Eddy kenzo', 'Edrisah Musuuza, known professionally as Eddy', NULL, '1592126820_66799837321181_eddy_kenzo.jpeg'),
(3, 'Bebe Cool', 'Bebe Cool is an African reggae and ragga musi', NULL, '1592129400_3978146945942_WxhdSuakJ4wZhi6atGkW2Qyt.jpeg'),
(4, 'Sheebah Karungi', 'Sheebah Karungi is a Ugandan recording artist', NULL, '1592129479_31892627593739_howwebiz_88e723f97cde9c8b7eb0aaaabcacbe51_1464525504_cover.jpg'),
(5, 'Jizzle', 'Jizzle was influenced by artist like Lil Wayn', NULL, '1592902550_15623277316181_IMG_1965.jpeg'),
(6, 'St. Brikama Boyo', 'ST Da Gambian Dream or Brikama Boyo was Born ', NULL, '1593167104_83132164437012_boyo.png'),
(7, 'Apass', 'Alexander Bagonza, better known by his stage ', NULL, '1593167348_9697153643255_song_pic_(1).png'),
(8, 'Chamsia Sagaf', 'Chamsia Sagaf (born 1955) is a Comoros singer', NULL, '1594049894_53755335761047_Chamsia-Sagaf.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `downloads`
--

CREATE TABLE `downloads` (
  `download_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `download_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `song_mp3` text DEFAULT NULL,
  `song_photo` text DEFAULT NULL,
  `song_date` text DEFAULT NULL,
  `aritst_id` varchar(35) DEFAULT NULL,
  `song_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`song_id`, `song_mp3`, `song_photo`, `song_date`, `aritst_id`, `song_name`) VALUES
(12, '1594313558_76984949380544_1593167375_54137122780950_Eddy_Kenzo_-_Tweyagale_.mp3', '1594313612_3327764631838_1592131027_41742619472167_maxresdefault.jpg', NULL, '1', 'Tweyaagale');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `reg_date` varchar(45) DEFAULT NULL,
  `last_seen` varchar(45) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `reg_date`, `last_seen`, `photo`) VALUES
(1, 'haddy1', '$2y$10$Zt12am7RJv/ZR7ZrS.2kIONx4VZJ7deAhsLV74', 'Hadijatou', NULL, NULL, '1591095139', ''),
(2, 'admin_2', '$2y$10$T1yu8zxLMJQg8.FPrQPpLuIUFxyuTihfCFihtM', 'Hamoud', NULL, NULL, '1591522035', ''),
(3, 'admin_3', '$2y$10$hbW2BB4zqvUBQybzW8jh2e6v.j4NSBO.irP.YM', 'Hamoud', NULL, NULL, '1591525236', ''),
(4, 'admin_4', '$2y$10$a3AHQtlfWeaUks.bEA2TQebLZ9i5MiT557HmJb', 'Biirah', NULL, NULL, '1591525821', ''),
(5, 'admin_5', '$2y$10$dstP./.91eJNNoNwpsXlBOl98dRQqdyA8JOu9p', 'Hadijatou', NULL, NULL, '1591526196', ''),
(6, 'haddy6', '$2y$10$K2LQuWSph7BQZCUE2Hkj0u7JmXsCJZC1AosX6D', 'Hadijatou', NULL, NULL, '1591952978', ''),
(7, 'haddy7', '$2y$10$Sq9VYUX9Dp8ta5HzwWTdbuP6vU8fPu33YMmTx2eWjTRhEQSOB8vPK', 'haddy', NULL, NULL, '1591953667', '');

-- --------------------------------------------------------

--
-- Structure de la table `views`
--

CREATE TABLE `views` (
  `view_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `view_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `views`
--

INSERT INTO `views` (`view_id`, `user_id`, `song_id`, `view_time`) VALUES
(37, 7, 12, '1594313565'),
(38, 7, 12, '1594313619'),
(39, 7, 12, '1594313634');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Index pour la table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`download_id`);

--
-- Index pour la table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`view_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `views`
--
ALTER TABLE `views`
  MODIFY `view_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
