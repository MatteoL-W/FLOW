-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 16 déc. 2020 à 16:57
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mini_fb`
--

-- --------------------------------------------------------

--
-- Structure de la table `ecrit`
--

DROP TABLE IF EXISTS `ecrit`;
CREATE TABLE IF NOT EXISTS `ecrit` (
  `idEcrit` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text DEFAULT NULL,
  `dateEcrit` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `idAuteur` int(11) NOT NULL,
  `idAmi` int(11) NOT NULL,
  PRIMARY KEY (`idEcrit`),
  UNIQUE KEY `id` (`idEcrit`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ecrit`
--

INSERT INTO `ecrit` (`idEcrit`, `contenu`, `dateEcrit`, `image`, `idAuteur`, `idAmi`) VALUES
(7, 'Ce fil d\'actualité diffuse vos posts, les posts de vos amis, les posts dans les livres d\'or, ainsi que les posts où vos amis sont les auteurs. Ce dernier point permet à un utilisateur de pouvoir élargir sa liste d\'amis !\r\n', '2020-12-14 16:27:17', '', 63, 62),
(9, 'Le <b>système de like</b> est également disponible.<br>\r\n<b>Cliquez sur &quot;1 personne a aimé ce post&quot;</b> pour découvrir qui est-ce ! (cette fonction est disponible lorsqu\'il y a au moins un like)', '2020-12-14 16:28:25', '', 62, 62),
(11, 'Vous pouvez ajouter des sons en .mp3 sans aucun problème sur flow !', '2020-12-14 16:29:13', 'andruhappilyneverafterfreedownload.mp3', 62, 62),
(12, 'Vous pouvez également ajouter des images à vos posts. <b>Cliquez sur les aperçus</b> pour les ouvrir<br>en plein écran.', '2020-12-14 16:30:04', '1f914.png', 62, 62),
(13, 'Vous pouvez ajouter des amis en recherchant des <b>noms ou intérêts</b> sur la page &quot;Mes amis&quot;.<br>Vous pouvez aussi ajouter une personne depuis son profil en cliquant sur l\'icone ajouter,<br> proche de son avatar.<br>La fonction pour bannir un ami se fait au même emplacement.', '2020-12-14 16:30:34', '', 63, 62),
(14, 'La gestion des amis se déroulent dans la page &quot;Mes amis&quot;.<br> En cliquant sur voir plus, la liste d\'amis s\'incrémentent par 5.', '2020-12-14 16:30:43', '', 62, 62),
(15, 'Le système de post sur FLOW est assez spécial. Chaque utilisateur dispose d\'un <b>livre d\'or</b> sur son profil<br> (cliquez sur la flèche à droite). Ce livre d\'or sera complété par les posts de vos amis.', '2020-12-14 16:30:51', '', 62, 62),
(16, 'Pour suivre le didacticiel, merci de <b>lire les courts posts ci-dessous</b>. ! :D<br>\r\n\r\nN\'hésitez pas à essayer les fonctionnalités !', '2020-12-14 16:30:57', '', 63, 62),
(17, 'Cliquez sur <b>\"Voir Plus\"</b> pour afficher plus de posts sans recharger la page !', '2020-12-14 16:30:25', '', 62, 62);

-- --------------------------------------------------------

--
-- Structure de la table `lien`
--

DROP TABLE IF EXISTS `lien`;
CREATE TABLE IF NOT EXISTS `lien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur1` int(11) NOT NULL,
  `idUtilisateur2` int(11) NOT NULL,
  `etat` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lien`
--

INSERT INTO `lien` (`id`, `idUtilisateur1`, `idUtilisateur2`, `etat`) VALUES
(1, 63, 62, 'ami'),
(2, 65, 62, 'attente'),
(3, 62, 66, 'attente'),
(4, 69, 62, 'ami'),
(5, 70, 62, 'ami'),
(6, 71, 62, 'ami'),
(7, 72, 62, 'ami'),
(8, 73, 62, 'ami');

-- --------------------------------------------------------

--
-- Structure de la table `post_like`
--

DROP TABLE IF EXISTS `post_like`;
CREATE TABLE IF NOT EXISTS `post_like` (
  `idLike` int(11) NOT NULL AUTO_INCREMENT,
  `idPost` int(11) NOT NULL,
  `idPostAuteur` int(11) NOT NULL,
  `idLikeur` int(11) NOT NULL,
  PRIMARY KEY (`idLike`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post_like`
--

INSERT INTO `post_like` (`idLike`, `idPost`, `idPostAuteur`, `idLikeur`) VALUES
(1, 8, 62, 62),
(2, 9, 62, 62),
(3, 16, 62, 62),
(4, 16, 63, 63),
(6, 7, 63, 63);

-- --------------------------------------------------------

--
-- Structure de la table `reseaux`
--

DROP TABLE IF EXISTS `reseaux`;
CREATE TABLE IF NOT EXISTS `reseaux` (
  `idUser` int(11) NOT NULL,
  `soundcloud` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `behance` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `pinterest` varchar(100) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reseaux`
--

INSERT INTO `reseaux` (`idUser`, `soundcloud`, `youtube`, `behance`, `instagram`, `twitter`, `facebook`, `pinterest`) VALUES
(62, '', '', '', '', '', '', ''),
(63, '', '', '', '', '', '', ''),
(65, '', '', '', '', '', '', ''),
(66, '', '', '', '', '', '', ''),
(67, '', '', '', '', '', '', ''),
(69, '', '', '', '', '', '', ''),
(70, '', '', '', '', '', '', ''),
(71, '', '', '', '', '', '', ''),
(72, '', '', '', '', '', '', ''),
(73, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `remember` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'ressources/logo-flow.jpg',
  `date_naissance` date NOT NULL,
  `banniere` varchar(400) NOT NULL DEFAULT 'ressources/banniere.png',
  `interets` varchar(50) NOT NULL,
  `biographie` text NOT NULL DEFAULT 'Voici ma biographie !',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `mdp`, `email`, `remember`, `avatar`, `date_naissance`, `banniere`, `interets`, `biographie`) VALUES
(62, 'didac', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'didacticiel@gmail.com', '', 'tokyo_top04-1.jpg', '2010-01-30', 'tokyo_top04-1.jpg', 'didacticiel, développement web', 'Bonjour ! Bienvenue sur votre page !\r\nPour modifier votre bannière, rendez-vous dans &quot;mon compte&quot; puis changer la bannière en cliquant sur celle-ci. Vous devez valider le changement en cliquant sur &quot;Prendre en compte la modification de la bannière&quot;.\r\n\r\nCi-dessous seront écris les réseaux-sociaux que vous avez fournis.'),
(63, 'test', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'test1@gmail.com', '', 'unknown.png', '2010-01-30', 'banniere-defaut.png', 'testeur, test', 'Je suis nouveau sur Flow!'),
(65, 'test2', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'test2@gmail.com', '', '20201124_175430.jpg', '2010-01-30', 'banniere-defaut.png', 'testeur, tuto', 'Je suis nouveau sur Flow!'),
(66, 'test3', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'test3@gmail.com', '', 'nujabes_distance.png', '2010-01-30', 'banniere-defaut.png', 'web', 'Je suis nouveau sur Flow!'),
(67, 'filler1', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'poubelle1@gmail.com', '', 'Artist’s_impression_of_the_quasar_3C_279.jpg', '2010-01-30', 'banniere-defaut.png', '', 'Je suis nouveau sur Flow!'),
(69, 'filler2', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'filler2@gmail.com', '', 'Artist’s_impression_of_the_quasar_3C_279.jpg', '2010-01-30', 'banniere-defaut.png', '', 'Je suis nouveau sur Flow!'),
(70, 'filler3', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'filler3@gmail.com', '', 'Artist’s_impression_of_the_quasar_3C_279.jpg', '2010-01-30', 'banniere-defaut.png', '', 'Je suis nouveau sur Flow!'),
(71, 'filler4', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'filler4@gmail.com', '', 'Artist’s_impression_of_the_quasar_3C_279.jpg', '2010-01-30', 'banniere-defaut.png', '', 'Je suis nouveau sur Flow!'),
(72, 'filler5', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'filler5@gmail.com', '', 'Artist’s_impression_of_the_quasar_3C_279.jpg', '2010-01-30', 'banniere-defaut.png', '', 'Je suis nouveau sur Flow!'),
(73, 'filler6', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'filler6@gmail.com', '', 'Artist’s_impression_of_the_quasar_3C_279.jpg', '2010-01-30', 'banniere-defaut.png', '', 'Je suis nouveau sur Flow!');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reseaux`
--
ALTER TABLE `reseaux`
  ADD CONSTRAINT `reseaux_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
