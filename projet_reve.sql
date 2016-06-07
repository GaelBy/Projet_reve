-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 07 Juin 2016 à 11:48
-- Version du serveur: 5.5.47-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet_reve`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE IF NOT EXISTS `adresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `nom` varchar(15) NOT NULL,
  `numero` varchar(7) NOT NULL,
  `rue` varchar(31) NOT NULL,
  `ville` varchar(31) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `type_adresse` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `adresses`
--

INSERT INTO `adresses` (`id`, `id_user`, `nom`, `numero`, `rue`, `ville`, `code_postal`, `type_adresse`) VALUES
(2, 9, 'dummy', '1', 'rue bidon', 'noville', 0, 'facturation'),
(3, 10, 'dummy', '1', 'rue bidon', 'noville', 0, 'facturation'),
(4, 10, 'dummy', '1', 'rue bidon', 'noville', 0, 'livraison'),
(5, 2, 'dummy', '1', 'rue bidon', 'noville', 0, 'facturation'),
(6, 2, 'dummy', '1', 'rue bidon', 'noville', 0, 'livraison');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_author` int(10) unsigned NOT NULL,
  `id_produit` int(10) unsigned NOT NULL,
  `content` varchar(1023) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` int(11) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_author` (`id_author`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`id`, `id_author`, `id_produit`, `content`, `date`, `note`, `statut`) VALUES
(1, 2, 1, 'trop cool !', '2016-06-06 12:54:23', 5, 1),
(2, 2, 2, 'super produit trop top', '2016-06-06 15:02:20', 5, 1),
(3, 2, 3, 'C''est nul !!', '2016-06-07 08:48:04', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(127) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `image` varchar(255) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `description`, `nom`, `image`, `statut`) VALUES
(2, 'RÃªves pour homme', 'Homme', 'http://localhost/developpement/php/projet_reve/public/images/man_dream.jpg', 1),
(3, 'RÃªves pour femme', 'Femme', 'http://localhost/developpement/php/projet_reve/public/images/woman_dream.jpg', 1),
(4, 'RÃªves pour enfant', 'Enfants', 'http://localhost/developpement/php/projet_reve/public/images/children_dream.jpg', 1),
(5, 'RÃªves pour tout le monde', 'Tous publics', 'http://localhost/developpement/php/projet_reve/public/images/allpublic_dream.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `link_panier_produits`
--

CREATE TABLE IF NOT EXISTS `link_panier_produits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_panier` int(10) unsigned NOT NULL,
  `id_produit` int(10) unsigned NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_panier` (`id_panier`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Contenu de la table `link_panier_produits`
--

INSERT INTO `link_panier_produits` (`id`, `id_panier`, `id_produit`, `quantite`) VALUES
(17, 23, 1, 4),
(18, 24, 2, 1),
(23, 25, 2, 2),
(64, 26, 2, 2),
(65, 26, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` varchar(15) NOT NULL,
  `nbre_produits` int(11) NOT NULL,
  `prix` float NOT NULL,
  `poids` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id`, `id_user`, `date`, `statut`, `nbre_produits`, `prix`, `poids`) VALUES
(6, 10, '2016-06-01 12:04:13', 'en cours', 0, 0, 0),
(7, 10, '2016-06-01 12:05:40', 'en cours', 0, 0, 0),
(8, 10, '2016-06-01 12:06:09', 'en cours', 0, 0, 0),
(9, 10, '2016-06-01 12:07:09', 'en cours', 0, 0, 0),
(10, 10, '2016-06-01 12:09:40', 'en cours', 0, 0, 0),
(11, 10, '2016-06-01 12:09:56', 'en cours', 0, 0, 0),
(12, 10, '2016-06-01 12:10:51', 'en cours', 0, 0, 0),
(13, 10, '2016-06-01 12:12:03', 'en cours', 0, 0, 0),
(14, 10, '2016-06-01 12:13:05', 'en cours', 0, 0, 0),
(15, 10, '2016-06-01 12:14:01', 'en cours', 0, 0, 0),
(16, 10, '2016-06-01 12:16:16', 'en cours', 0, 0, 0),
(17, 10, '2016-06-01 12:16:35', 'en cours', 0, 0, 0),
(18, 10, '2016-06-01 12:17:19', 'en cours', 0, 0, 0),
(19, 10, '2016-06-01 12:19:39', 'en cours', 1, 660, 23),
(20, 10, '2016-06-01 14:00:48', 'en cours', 24, 1502, 26),
(21, 10, '2016-06-02 07:03:14', 'en cours', 1, 60, 1),
(22, 2, '2016-06-02 07:20:47', 'en cours', 1, 724, 14),
(23, 2, '2016-06-06 11:30:44', 'valide', 3, 3.48, 3),
(24, 2, '2016-06-06 14:09:34', 'valide', 1, 0, 0),
(25, 2, '2016-06-07 07:59:04', 'valide', 1, 1.16, 1),
(26, 2, '2016-06-07 08:14:36', 'valide', 2, 6.96, 4);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sub_category` int(10) unsigned NOT NULL,
  `reference` varchar(15) NOT NULL,
  `stock` int(11) NOT NULL,
  `prix_uni_ht` float NOT NULL,
  `tva` float NOT NULL,
  `description` varchar(2047) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nom` varchar(31) NOT NULL,
  `poids_uni` float NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `moyenne` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sub_category` (`id_sub_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id`, `id_sub_category`, `reference`, `stock`, `prix_uni_ht`, `tva`, `description`, `image`, `nom`, `poids_uni`, `statut`, `moyenne`) VALUES
(1, 3, 'zd9830fr', 37, 1, 0.16, 'gagner la coupe du monde', 'http://localhost/developpement/php/projet_reve/public/images/homme/legendes_sport/legendes_sport4.jpg', 'zidane', 1, 1, 5),
(2, 4, 'spm001kr', 7, 1, 0.16, 'cape et collants', 'http://localhost/developpement/php/projet_reve/public/images/homme/super_heros_homme/super_heros_homme4.jpg', 'superman', 1, 1, 5),
(3, 5, 'CL11NES', 44, 2, 0.16, 'Devenez un grand acteur', 'http://localhost/developpement/php/projet_reve/public/images/homme/celebrites_homme/celebrites_homme3.jpeg', 'Clooney', 1, 1, 1),
(4, 6, 'NMT001', 10, 1, 0.16, 'Ce produit n''est pas disponible', 'http://localhost', 'test statut', 1, 0, 0),
(5, 3, 'AIR3JDNBL', 10, 5, 0.16, 'Envolez-vous sur le terrain de basket', 'http://localhost/developpement/php/projet_reve/public/images/homme/legendes_sport/legendes_sport1.jpeg', 'Jordan', 1, 1, 0),
(6, 3, 'BXM10KO', 50, 5, 0.16, 'Soyez le roi du ring', 'http://localhost/developpement/php/projet_reve/public/images/homme/legendes_sport/legendes_sport2.jpg', 'Mohamed Ali', 2, 1, 0),
(7, 4, 'BAT01DC', 52, 4, 0.16, 'Veillez sur Gotham City', 'http://localhost/developpement/php/projet_reve/public/images/homme/super_heros_homme/super_heros_homme1.jpg', 'Batman', 1, 1, 0),
(8, 6, 'VOL66MGM', 8, 2, 0.16, 'Visitez Pompei', 'http://localhost/developpement/php/projet_reve/public/images/homme/cauchemars_homme/cauchemars_homme4.jpg', 'Volcan', 3, 1, 0),
(9, 7, 'WDBCH02', 22, 3, 0.16, 'Soyez deux sur une ile paradisiaque', 'http://localhost/developpement/php/projet_reve/public/images/femme/mariage_et_lune_de_miel/mariage_et_lune_de_miel2.jpg', 'Voyage plage', 1, 1, 0),
(10, 8, 'ACC20SLD', 50, 1.5, 0.16, 'Sacs, bijoux, et plus encore', 'http://localhost/developpement/php/projet_reve/public/images/femme/shopping/shopping3.jpg', 'Accessoires', 1, 1, 0),
(11, 11, 'STRK12Fe', 60, 2, 0.16, 'Sauve le monde en armure', 'http://localhost/developpement/php/projet_reve/public/images/enfants/super_heros_enfant/super_heros_enfant2.jpg', 'Iron Man', 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_category` int(10) unsigned NOT NULL,
  `nom` varchar(15) NOT NULL,
  `description` varchar(127) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `id_category`, `nom`, `description`, `statut`) VALUES
(3, 2, 'Sport', 'Je suis un sportif', 1),
(4, 2, 'Super hÃ©ros', 'Pour sauver le monde', 1),
(5, 2, 'SÃ©duction', 'Je suis un beau gosse', 1),
(6, 2, 'Cauchemards', 'Pour avoir peur', 1),
(7, 3, 'Prince charmant', 'Pour trouver le prince charmant', 1),
(8, 3, 'Pretty woman', 'BeautÃ© et rÃ©ussite', 1),
(9, 3, 'CÃ©lÃ©britÃ©s', 'Tout le monde me connait', 1),
(10, 3, 'Cauchemards', 'Pour avoir peur', 1),
(11, 4, 'Super hÃ©ros', 'Pour sauver le monde', 1),
(12, 4, 'HÃ©ros TV', 'Deviens le hÃ©ros de ta sÃ©rie prÃ©fÃ©rÃ©e', 1),
(13, 4, 'RoyautÃ©', 'Pour Ãªtre un prince ou une princesse', 1),
(14, 4, 'Bonbons', 'Pour les petits gourmands', 1),
(15, 5, 'Social', 'Pour la rÃ©ussite sociale', 1),
(16, 5, 'Maison', 'Essayez la vie de chateau', 1),
(17, 5, 'Finance', 'Pour la rÃ©ussite financiÃ¨re', 1),
(18, 5, 'Voyages', 'DÃ©couvrez le monde', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(15) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `email` varchar(31) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_naissance` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `telephone` varchar(15) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `sexe` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `date_inscription`, `date_naissance`, `telephone`, `statut`, `sexe`, `login`, `admin`) VALUES
(2, 'Benay', 'Gael', 'a.bc@fake.com', '$2y$08$CnrWgg6hVLjBcfKgqbSFAOVIH7pVu0CX9eJ1k/wEkIwcxKWZtQaQ.', '2016-05-31 10:10:55', '0000-00-00 00:00:00', '0606060606', 1, 1, 'Gael', 1),
(6, 'toto', 'toto', 'toto@toto.to', '$2y$08$FZ9dd83D3er2dOtM1OMDKehE54CU28kRYf/RQrLHeNdyYSOuOgehC', '2016-05-31 11:33:13', '0000-00-00 00:00:00', '0101010101', 1, 1, 'toto', 0),
(7, 'user', 'dummy', 'dummy.user@fake.com', '$2y$08$aRPc/ELKujpJKlwMUrRCh.mnlXbW/Xv72Q.H.TcTwyIiFBUe1u2Ji', '2016-06-01 11:57:58', '0000-00-00 00:00:00', '0101010101', 1, 1, 'dummy', 0),
(8, 'user', 'dummy', 'dummy.user@fake.com', '$2y$08$/WHDrYbv3fUE3RiiUJDNyujTdXwE0ixNH7saHS6SWbPra/NcVONXi', '2016-06-01 11:58:50', '0000-00-00 00:00:00', '0101010101', 1, 1, 'dummy', 0),
(9, 'user', 'dummy', 'dummy.user@fake.com', '$2y$08$LFGnf1/6wrRY0YJipgwizOJ7PIEhJkJidhiC//vIsVQsfBs8DCxoO', '2016-06-01 11:59:39', '0000-00-00 00:00:00', '0101010101', 1, 1, 'dummy', 0),
(10, 'user', 'dummy', 'dummy.user@fake.com', '$2y$08$opLQq4ljnxeT4ncy37xJj.iadozjAq0e0cgWHPijCiVv4tALVR9jy', '2016-06-01 12:01:41', '0000-00-00 00:00:00', '0101010101', 1, 1, 'dummy', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `link_panier_produits`
--
ALTER TABLE `link_panier_produits`
  ADD CONSTRAINT `link_panier_produits_ibfk_1` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_panier_produits_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`id_sub_category`) REFERENCES `sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
