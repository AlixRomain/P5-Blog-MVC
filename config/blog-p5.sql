-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 18 mars 2021 à 09:38
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
-- Base de données :  `blog-p5`
--

-- --------------------------------------------------------

--
-- Structure de la table `blogpost`
--

DROP TABLE IF EXISTS `blogpost`;
CREATE TABLE IF NOT EXISTS `blogpost` (
  `id_blogPost` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `chapo` tinytext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `dateCreate` datetime NOT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `publish` tinyint(4) NOT NULL,
  `actif` tinyint(4) NOT NULL,
  `id_author` int(11) NOT NULL,
  PRIMARY KEY (`id_blogPost`,`id_author`),
  KEY `fk_blogPost_user_idx` (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `blogpost`
--

INSERT INTO `blogpost` (`id_blogPost`, `title`, `chapo`, `content`, `dateCreate`, `dateUpdate`, `publish`, `actif`, `id_author`) VALUES
(1, 'REACT, c’est quoi ?', 'Pourquoi nous avons décidé d’utiliser React pour nos sites internet.', 'React est une bibliothèque dans la catégorie de frameworks frontend, qui ne gère que l’interface d’un site.\r\nMais avant de commencer les hostilités… un framework frontend, qu’est-ce que c’est ? Il s’agit d’un ensemble de logiciels qui servent à créer des interfaces utilisateurs, comme les applications web ou mobiles. L’objectif du « framework front » fournir une solution prête à l’emploi pour le développement de ces applications. Parmi les plus utilisés, on retrouve Angular, Ember, Vue.js ou encore React et bien d’autres.', '2021-03-09 04:09:00', '2021-03-09 04:09:00', 1, 1, 1),
(2, 'Le deuxième Blog post', 'C\'est pour voir comment ça rend quand y\'en a plus d\'un.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2021-03-09 03:16:00', NULL, 1, 0, 1),
(69, 'Ruby on Rails', '5 raisons de choisir ce framework pour vos développements web', 'De tous les frameworks utiles pour vos développements web, s’il y en a bien un que nous vous conseillons d’utiliser c’est le Ruby on Rails.\r\nAppelé aussi RoR ou tout simplement Rails, ce langage de programmation a déjà conquis de nombreux professionnels. Et pour cause, il est doté de conventions qui accélèrent le processus de développement.\r\nMais ce n’est évidemment pas le seul atout de ce framework. Dans cet article, nous allons évoquer les autres raisons qui devraient vous convaincre d’apprendre et d’utiliser le Ruby on Rails.\r\n\r\nLorsqu’on souhaite apprendre un nouveau langage de programmation ou que l’on souhaite intégrer ce dernier dans des projets, il est important de s’assurer qu’une documentation solide existe. Cette dernière doit vous permettre de palier à vos problèmes de développement.\r\n\r\nRuby on Rails dispose d’une réelle documentation en ligne qui a l’avantage de couvrir les différentes versions du framework. Autre point fort, les utilisateurs sont invités à compléter les différentes sections s’ils constatent des erreurs ou si des informations semblent manquantes.', '2021-03-12 11:15:10', '2021-03-12 11:15:10', 1, 1, 1),
(70, 'Python ou PHP: Une comparaison complète', 'Python ou PHP: découvrez les différences et les similitudes. Suivez ce tutoriel Python ou PHP pour savoir lequel est le meilleur: Python ou PHP ?', 'Si vous souhaitez commencer à apprendre la programmation et essayez de choisir entre deux langages spécifiques, des comparaisons comme celle-ci PHP VS Python peuvent facilement vous aider à vous décider et vous orienter dans la bonne direction. Le domaine de l’informatique peut être un domaine difficile à pénétrer, mais les récompenses reconnues qu’il confère incitent encore beaucoup de gens à essayer. Avec autant de ressources différentes disponibles ces jours-ci, vous avez une très bonne chance de commencer avec une langue que vous allez vraiment aimer et de vous frayer un chemin à partir de là.', '2021-03-12 11:32:40', '2021-03-12 11:32:40', 1, 1, 1),
(71, 'Le Web de demain', 'Le Web vient de souffler ses 30 bougies. Après l’euphorie des premières années, l’image du Web s’est nettement ternie. Le temps d’un &quot;nouveau Web&quot; est-il advenu ?', 'La célébration du trentième anniversaire de la naissance du World Wide Web aura au moins permis que l’on se remémore les grandes étapes de cette technologie qui fait désormais totalement partie de notre quotidien. En ce mois de mars 1989, rien n’était gagné pour Tim Berners-Lee, physicien britannique employé au CERN (conseil européen pour la recherche nucléaire), lorsqu’il eut l’idée de relier des informations grâce à des liens renvoyant les uns vers les autres. Son supérieur hiérarchique annota son projet d\'un prémonitoire &quot;vague, mais excitant&quot;. Une année plus tard, la première page Web était créée.', '2021-03-12 11:33:50', '2021-03-12 11:33:50', 1, 1, 1),
(72, 'dgrgrgrg', 'ththht', 'thtthtthht', '2021-03-12 16:27:26', NULL, 0, 1, 1),
(73, 'Laravel et Symfony', 'quelles sont les principales différences ?', 'Quand il s\'agit de développement web à un rythme rapide sans compromettre l\'expérience utilisateur et l\'excellence de l\'interface utilisateur, la plupart des développeurs optent pour les frameworks PHP. Aujourd’hui, deux frameworks, à savoir, Laravel et Symfony ont attiré l\'attention de nombreux développeurs web en raison d\'une série d\'avantages allant de la vitesse de développement, à la performance, la courbe d\'apprentissage, la flexibilité, l\'évolutivité et plusieurs autres facteurs. \r\n\r\nIl y a beaucoup de développeurs PHP qui sont encore confus à l\'idée de faire un choix entre ces deux frameworks PHP pour leur projet de développement web. Compte tenu du fait que les deux sont dotés de capacités sophistiquées, faire un tel choix est un peu difficile. C\'est précisément la raison pour laquelle nous allons faire une comparaison approfondie de ces deux cadres populaires pour le développement web.\r\n\r\nSi vous avez besoin d’un développeur PHP pour votre prochain projet de développement web, il est important de connaître les complexités de ces deux frameworks et leurs différences. Commençons par l\'essentiel et expliquons chacun de ces cadres et leurs avantages respectifs séparément avant d\'aller comparer leurs similitudes et leurs différences.', '2021-03-18 09:22:42', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext DEFAULT NULL,
  `dateCreate` datetime NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `actif` tinyint(4) NOT NULL,
  `id_blogPost` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  PRIMARY KEY (`id_comment`,`id_blogPost`,`id_author`),
  KEY `fk_comment_blogPost1_idx` (`id_blogPost`),
  KEY `fk_comment_user1_idx` (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `dateCreate`, `publish`, `actif`, `id_blogPost`, `id_author`) VALUES
(1, 'C\'est juste un commentaire pour critiquer, parceque j\'aime bien ramener ma fraise sur des sujets.', '2021-03-10 02:05:00', 1, 1, 1, 2),
(2, 'J\'aime bien ce qu\'il raconte c\'est super continue comme ça!', '2021-03-10 00:00:00', 1, 1, 1, 1),
(3, 'Yeah Congratulation! Vive le Php c\'est le meilleur langage.', '2021-03-10 00:00:00', 1, 1, 1, 2),
(4, 'Je sui sun fnejfnjrnfjrf,j Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2021-03-10 00:00:00', 1, 1, 2, 2),
(15, 'Je suis un commentaire', '2021-03-12 11:36:28', 1, 1, 69, 1),
(16, 'j\'aime le nougat', '2021-03-12 11:37:50', 1, 1, 69, 1),
(17, 'Encore un commentaire test', '2021-03-12 13:54:21', 0, 0, 1, 1),
(18, 'C\'est cool ta vie!', '2021-03-12 15:58:29', 1, 1, 69, 1),
(19, 'C\'est pas faut', '2021-03-13 15:53:07', 0, 0, 70, 1),
(20, 'Je suis le commentaire d\'un utilisateur authentifié', '2021-03-14 11:19:33', 0, 1, 71, 1),
(21, 'Incroyable c\'est fou', '2021-03-14 12:10:20', 1, 1, 69, 1),
(22, 'Amazing', '2021-03-14 12:10:36', 0, 1, 70, 1),
(23, 'Perfect', '2021-03-14 12:11:26', 1, 1, 1, 1),
(24, 'Moi, je trouve que Laravel est une hérésie, et que l\'on devrait bannir toute leur communauté.', '2021-03-18 09:26:51', 1, 1, 73, 1),
(25, 'C\'était un grand moment, j\'en ai presque ma petite larme.', '2021-03-18 09:28:09', 1, 1, 71, 1),
(26, 'PhP, je ne le répéterais jamais assez, PHP est le seul langage digne des dieux.', '2021-03-18 09:29:19', 1, 1, 70, 1),
(27, 'React, c\'est la bibliothèque que l\'on se doit de connaître!!', '2021-03-18 09:30:32', 1, 1, 1, 1),
(28, 'Un très bel article !', '2021-03-18 09:35:50', 0, 1, 73, 1),
(29, 'Tout à fait d\'accord avec ça !', '2021-03-18 09:37:01', 0, 1, 70, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `pseudo` varchar(45) DEFAULT NULL,
  `devise` tinytext DEFAULT NULL,
  `rank` varchar(65) DEFAULT NULL,
  `rgpd` tinyint(4) DEFAULT NULL,
  `dateRgpd` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `dateTokenExpire` datetime DEFAULT NULL,
  `actif` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `pseudo_UNIQUE` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstName`, `lastName`, `email`, `password`, `pseudo`, `devise`, `rank`, `rgpd`, `dateRgpd`, `token`, `dateTokenExpire`, `actif`) VALUES
(1, 'Alix', 'Romain', 'toto@toto.com', '$2y$10$DRIfmrovTcn6AAFqdW4.f.KOX7LBGK84uaoaA7.tlLdxitz9ffG4.', 'Clavier-Vapeur', 'Php...what else?', 'ADMIN', 1, '2021-03-09 00:00:00', '16159867983512508', '2021-03-17 14:28:18', 1),
(2, 'Barbe', 'Remi', 'tata@tata.com', '$2y$10$DRIfmrovTcn6AAFqdW4.f.KOX7LBGK84uaoaA7.tlLdxitz9ffG4.', 'Born to be a noob', 'Je suis née pour développer', 'UTILISATEUR', 1, '2021-03-09 00:00:00', NULL, NULL, 1),
(3, 'alix ro', 'romain', 'toto@totu.com', '$2y$10$dq8EZWA9pCccRgtKdM4jXeP7FeR3KPd2rAB7BWvRr02tmYsPEFzcS', 'cvfrvfb', 'tbtbtt', 'UTILISATEUR', 1, '2021-03-15 15:51:13', '16158876346236067', '2021-03-16 10:55:34', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `blogpost`
--
ALTER TABLE `blogpost`
  ADD CONSTRAINT `fk_blogPost_user` FOREIGN KEY (`id_author`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_blogPost1` FOREIGN KEY (`id_blogPost`) REFERENCES `blogpost` (`id_blogPost`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comment_user1` FOREIGN KEY (`id_author`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
