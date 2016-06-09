-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 09 Juin 2016 à 14:52
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `adresses`
--

INSERT INTO `adresses` (`id`, `id_user`, `nom`, `numero`, `rue`, `ville`, `code_postal`, `type_adresse`) VALUES
(2, 9, 'dummy', '1', 'rue bidon', 'noville', 0, 'facturation'),
(3, 10, 'dummy', '1', 'rue bidon', 'noville', 0, 'facturation'),
(4, 10, 'dummy', '1', 'rue bidon', 'noville', 0, 'livraison'),
(5, 2, 'dummy', '1', 'rue bidon', 'noville', 0, 'facturation'),
(6, 2, 'dummy', '1', 'rue bidon', 'noville', 0, 'livraison'),
(7, 11, 'mouloud', '1', 'mouloud', 'mouloud', 0, 'facturation'),
(8, 11, 'mouloud', '1', 'mouloud', 'mouloud', 0, 'livraison'),
(9, 12, 'mouloud', '1', 'mouloud', 'mouloud', 0, 'facturation'),
(10, 12, 'mouloud', '1', 'mouloud', 'mouloud', 0, 'livraison');

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
(2, 'Rêves pour hommes', 'Homme', 'http://localhost/developpement/php/projet_reve/public/images/man_dream.jpg', 1),
(3, 'Rêves pour femme', 'Femme', 'http://localhost/developpement/php/projet_reve/public/images/woman_dream.jpg', 1),
(4, 'Rêves pour enfants', 'Enfants', 'http://localhost/developpement/php/projet_reve/public/images/children_dream.jpg', 1),
(5, 'Rêves pour tout le monde', 'Tous publics', 'http://localhost/developpement/php/projet_reve/public/images/allpublic_dream.jpg', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Contenu de la table `link_panier_produits`
--

INSERT INTO `link_panier_produits` (`id`, `id_panier`, `id_produit`, `quantite`) VALUES
(110, 33, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id`, `id_user`, `date`, `statut`, `nbre_produits`, `prix`, `poids`) VALUES
(33, 12, '2016-06-09 12:18:38', 'Paye', 1, 1.16, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id`, `id_sub_category`, `reference`, `stock`, `prix_uni_ht`, `tva`, `description`, `image`, `nom`, `poids_uni`, `statut`, `moyenne`) VALUES
(1, 3, 'Ref: zd9830fr', 32, 99, 0.16, 'Gagne la Coupe du Monde en devenant Zizou!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/legendes_sport/legendes_sport4.jpg', 'Zinedine Zidane', 1, 1, 5),
(2, 4, 'Ref: spm001kr', 59, 199, 0.16, 'Sauve le monde en cape et collants!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/super_heros_homme/super_heros_homme4.jpg', 'Superman', 1, 1, 5),
(3, 5, 'Ref: CL11NES', 44, 89, 0.16, 'What else?', 'http://localhost/developpement/php/projet_reve/public/images/homme/celebrites_homme/celebrites_homme3.jpeg', 'George Clooney', 1, 1, 1),
(5, 3, 'Ref: AIR3JDNBL', 10, 599, 0.16, 'Envole-toi sur un terrain de basket!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/legendes_sport/legendes_sport1.jpeg', 'Michael Jordan', 1, 1, 0),
(6, 3, 'Ref: BXM10KO', 50, 199, 0.16, 'Deviens le roi du ring!!', 'public/images/homme/legendes_sport/legendes_sport2.jpg', 'Muhammad Ali', 2, 1, 0),
(7, 4, 'Ref: BAT01DC', 52, 79, 0.16, 'Veille sur Gotham City!', 'http://localhost/developpement/php/projet_reve/public/images/homme/super_heros_homme/super_heros_homme1.jpg', 'Batman', 1, 1, 0),
(8, 6, 'Ref: VOL66MGM', 8, 1499, 0.16, 'Dans le coeur du volcan!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/cauchemars_homme/cauchemars_homme4.jpg', 'Volcan', 3, 1, 0),
(9, 9, 'Ref: WDBCH02', 22, 7999, 0.16, 'Profite d''une lune de miel magique!', 'http://localhost/developpement/php/projet_reve/public/images/femme/mariage_et_lune_de_miel/mariage_et_lune_de_miel2.jpg', 'Lune de miel de rÃªve', 1, 1, 0),
(10, 8, 'Ref: ACC20SLD', 50, 499, 0.16, 'Sacs, bijoux, et plus encore', 'http://localhost/developpement/php/projet_reve/public/images/femme/shopping/shopping3.jpg', 'Accessoires', 1, 0, 0),
(11, 11, 'Ref: STRK12Fe', 60, 129, 0.16, 'Sauve le monde en armure!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/super_heros_enfant/super_heros_enfant2.jpg', 'Iron Man', 2, 1, 0),
(12, 3, 'Ref: rg6565fed', 10, 269, 0.16, 'Jeu, set & match!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/legendes_sport/legendes_sport3.jpeg', 'Roger Federer', 1, 1, 0),
(13, 4, 'Ref: hulk12345', 10, 569, 0.16, 'Subis la colere de Hulk!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/super_heros_homme/super_heros_homme2.jpg', 'Incroyable Hulk', 20, 1, 0),
(14, 4, 'Ref: spider9857', 23, 125, 0.16, 'Sois pret à tisser ta toile!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/super_heros_homme/super_heros_homme3.jpeg', 'Spiderman', 7, 1, 0),
(15, 5, 'Ref: pacino6565', 17, 349, 0.16, 'Deviens une legende du 7eme art!', 'http://localhost/developpement/php/projet_reve/public/images/homme/celebrites_homme/celebrites_homme1.jpg', 'Al Pacino', 18, 1, 0),
(16, 5, 'Ref: pitt5656', 21, 659, 0.16, 'Tourne dans les plus grands films!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/celebrites_homme/celebrites_homme2.jpeg', 'Brad Pitt', 32, 1, 0),
(17, 5, 'Ref: leonardo98', 78, 559, 0.16, 'Deviens le chouchou de ces dames!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/celebrites_homme/celebrites_homme5.jpg', 'Leonardo DiCaprio', 15, 1, 0),
(18, 6, 'Ref: earthqua65', 5, 2999, 0.16, 'En avant les secousses!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/cauchemars_homme/cauchemars_homme1.jpg', 'Earthquake', 18, 1, 0),
(19, 6, 'Ref: prison654', 6, 75, 0.16, 'Peur de finir derriere les barreaux?', 'http://localhost/developpement/php/projet_reve/public/images/homme/cauchemars_homme/cauchemars_homme2.jpg', 'Prison', 6, 1, 0),
(20, 6, 'Ref: tsunamis5', 5, 9999, 0.16, 'Provoque un raz-de-maree!!', 'http://localhost/developpement/php/projet_reve/public/images/homme/cauchemars_homme/cauchemars_homme3.jpeg', 'Tsunamis', 7, 1, 0),
(21, 7, 'Ref: bijoux568', 67, 1799, 0.16, 'Brille de mille feux avec les plus belles parures!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/shopping/shopping1.jpg', 'Bijoux', 1, 1, 0),
(22, 7, 'Ref: chaussu36', 87, 199, 0.16, 'Chausse les plus grandes marques!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/shopping/shopping2.jpeg', 'Chaussures', 2, 1, 0),
(23, 7, 'Ref: sacs6586', 33, 399, 0.16, 'Porte les sacs des plus grands createurs!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/shopping/shopping3.jpg', 'Sacs Ã  main', 3, 1, 0),
(24, 7, 'Ref: smartp356', 8, 899, 0.16, 'Profite de la toute derniere technologie!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/shopping/shopping4.jpg', 'Smartphones', 1, 1, 0),
(25, 8, 'Ref: angelina45', 2, 4999, 0.16, 'Adopte des petits Cambodgiens!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/celebrites_femme/celebrites_femme1.jpg', 'Angelina Jolie', 30, 1, 0),
(26, 8, 'Ref: beyonce65', 5, 5799, 0.16, 'Fais danser la foule!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/celebrites_femme/celebrites_femme2.jpg', 'Beyonce', 50, 1, 0),
(27, 8, 'Ref: emma3547', 4, 5199, 0.16, 'Deviens Emma Watson d''un coup de baguette magique!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/celebrites_femme/celebrites_femme3.jpg', 'Emma Watson', 45, 1, 0),
(28, 8, 'Ref: taylor', 3, 499, 0.16, 'Deviens une star de la pop!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/celebrites_femme/celebrites_femme5.jpeg', 'Taylor Swift', 50, 1, 0),
(29, 9, 'Ref: lunel354', 8, 7999, 0.16, 'Vis une experience inoubliable!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/mariage_et_lune_de_miel/mariage_et_lune_de_miel1.jpg', 'Lune de miel de luxe', 5, 1, 0),
(30, 9, 'Ref: mariage354', 6, 9999, 0.16, 'Qui n''a jamais reve de se marier devant des paysages aussi sublimes?', 'http://localhost/developpement/php/projet_reve/public/images/femme/mariage_et_lune_de_miel/mariage_et_lune_de_miel5.jpg', 'Mariage sur la plage', 1, 1, 0),
(31, 9, 'Ref: mariage357', 3, 5999, 0.16, 'Envie d''un mariage dans un cadre verdoyant?', 'http://localhost/developpement/php/projet_reve/public/images/femme/mariage_et_lune_de_miel/mariage_et_lune_de_miel3.jpg', 'Mariage montagne', 1, 1, 0),
(32, 10, 'Ref: accident35', 3, 899, 0.16, 'Envie de faire peur a la belle-mere?', 'http://localhost/developpement/php/projet_reve/public/images/femme/cauchemars_femme/cauchemars_femme1.jpeg', 'Accidents', 999, 1, 0),
(33, 10, 'Ref: agression3', 8, 199, 0.16, 'Envie de se defouler sur la belle-mere?', 'http://localhost/developpement/php/projet_reve/public/images/femme/cauchemars_femme/cauchemars_femme2.jpg', 'Agressions', 76, 1, 0),
(34, 10, 'Ref: cafards32', 18325898, 0.3, 0.16, 'Besoin de proteines?', 'http://localhost/developpement/php/projet_reve/public/images/femme/cauchemars_femme/cauchemars_femme3.jpg', 'Cafards', 0.001, 1, 0),
(35, 10, 'Ref: serpents65', 156, 150, 0.16, 'Effrayez vos amis en devenant un animal Ã  sang froid!!', 'http://localhost/developpement/php/projet_reve/public/images/femme/cauchemars_femme/cauchemars_femme4.jpg', 'Serpents', 0.3, 1, 0),
(36, 11, 'Ref: captain32', 89, 599, 0.16, 'Pret Ã  diriger les Avengers?', 'http://localhost/developpement/php/projet_reve/public/images/enfants/super_heros_enfant/super_heros_enfant1.jpg', 'Captain America', 10, 1, 0),
(37, 11, 'Ref: thor35365', 5, 299, 0.16, 'Deviens le Dieu de la Foudre!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/super_heros_enfant/super_heros_enfant3.jpg', 'Thor - Dieu de la Foudre', 9, 1, 0),
(38, 11, 'Ref: wolve35835', 4, 799, 0.16, 'Sois pret Ã  sortir tes griffes!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/super_heros_enfant/super_heros_enfant4.jpg', 'Wolverine', 3, 1, 0),
(39, 13, 'Ref: disney354', 78, 99, 0.16, 'Vis le monde merveilleux de Disney!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/parcs_et_evasion/parcs_et_evasion1.jpeg', 'Disneyland Paris', 1, 1, 0),
(40, 13, 'Ref: europa3689', 75, 40, 0.16, 'Visite le plus beau parc d''attraction d''Europe!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/parcs_et_evasion/parcs_et_evasion2.jpg', 'Europa Park', 1, 1, 0),
(41, 13, 'Ref: asterix25', 124, 50, 0.16, 'Ils sont fous ces romains!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/parcs_et_evasion/parcs_et_evasion5.jpg', 'Parc AstÃ©rix', 1, 1, 0),
(42, 13, 'Ref: zoo35835', 86, 30, 0.16, 'Un des plus beaux parcs zoologiques d''Europe!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/parcs_et_evasion/parcs_et_evasion6.jpg', 'Zoo d''AmnÃ©ville', 1, 1, 0),
(43, 12, 'Ref: barbie3553', 18, 300, 0.16, 'Si tu peux le rever, tu peux le devenir!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/heros_animes/heros_animes1.jpg', 'Barbie', 4, 1, 0),
(44, 12, 'Ref: reine6565', 356, 79, 0.16, 'Liberee, delivree, tu peux devenir comme moi desormais!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/heros_animes/heros_animes2.jpeg', 'La Reine des Neiges', 2, 1, 0),
(45, 12, 'Ref: shrek6868', 9, 79, 0.16, 'Deviens le roi des ogres...et l''ami des Ã¢nes!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/heros_animes/heros_animes3.jpeg', 'Shrek', 300, 1, 0),
(46, 12, 'Ref: simpsons58', 56, 49, 0.16, 'Fais partie de la famille la plus dejantee de Springfield!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/heros_animes/heros_animes4.jpeg', 'Les Simpsons', 50, 1, 0),
(47, 14, 'Ref: tagada5356', 124, 3, 0.16, 'Depeche-toi de ramener ta fraise!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/bonbons/bonbons1.jpg', 'Fraises Tagada', 1, 1, 0),
(48, 14, 'Ref: kinder353', 64, 2, 0.16, 'Les Kinder Surprise c''est comme la vie: on sait jamais sur quoi on va tomber!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/bonbons/bonbons2.jpg', 'Kinder Surprise', 1, 1, 0),
(49, 14, 'Ref: tetes5336', 59, 1.5, 0.16, 'Les tetes brulees, le bonbon qui t''arrache la tete!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/bonbons/bonbons3.jpg', 'Les TÃªtes BrÃ»lÃ©es', 1, 1, 0),
(50, 14, 'Ref: mms353658', 214, 2, 0.16, 'Faites la fete aux cacahuetes!!', 'http://localhost/developpement/php/projet_reve/public/images/enfants/bonbons/bonbons4.jpg', 'M&M''s', 1, 1, 0),
(51, 15, 'Ref: amis5676', 56, 45, 0.16, 'Fais le plein d''amis!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/reussite_sociale/reussite_sociale5.jpg', 'Se faire des amis', 5, 1, 0),
(52, 15, 'Ref: famille354', 48, 199, 0.16, 'Lave ton linge sale en famille!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/reussite_sociale/reussite_sociale4.jpg', 'Fonder une famille', 50, 1, 0),
(53, 15, 'Ref: patron3574', 21, 499, 0.16, 'C''est qui le patron?', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/reussite_sociale/reussite_sociale2.jpg', 'Devenir patron', 20, 1, 0),
(54, 15, 'Ref: travail35', 45, 299, 0.16, 'Gravis tous les echelons professionnels!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/reussite_sociale/reussite_sociale1.jpg', 'RÃ©ussir au travail', 45, 1, 0),
(55, 16, 'Ref: la654654', 1, 15000000, 0.16, 'A toi la vie dans la Cite des Anges!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/maison_reve/maison_reve1.jpg', 'Maison Ã  Los Angeles', 1, 1, 0),
(56, 16, 'Ref: miami6545', 1, 15000000, 0.16, 'A toi la vie Ã  South Beach!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/maison_reve/maison_reve2.jpg', 'Maison Ã  Miami', 1, 1, 0),
(57, 16, 'Ref: rio75575', 1, 15000000, 0.16, 'A toi la vie Ã  Rio de Janeiro!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/maison_reve/maison_reve4.jpg', 'Maison Ã  Rio', 1, 1, 0),
(58, 16, 'Ref: shangai654', 1, 15000000, 0.16, 'A toi la vie Ã  Shangai!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/maison_reve/maison_reve3.jpeg', 'Maison Ã  ShangaÃ¯', 1, 1, 0),
(59, 17, 'Ref: finance564', 22, 15000, 0.16, 'Compte tes pieces d''or!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/reussite_financiere/reussite_financiere5.jpg', 'RÃ©ussir financiÃ¨rement', 3, 1, 0),
(60, 18, 'Ref: chine6545', 4, 999, 0.16, 'Explore la Grande Muraille!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/voyage/voyage1.jpg', 'Voyage en Chine', 1, 1, 0),
(61, 18, 'Ref: usa5645', 4, 1699, 0.16, 'A la conquete de l''ouest americain!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/voyage/voyage6.jpg', 'Voyage USA', 1, 1, 0),
(62, 18, 'Ref: rome687', 4, 499, 0.16, 'Decouvre le Colisee!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/voyage/voyage3.jpg', 'Voyage Ã  Rome', 1, 1, 0),
(63, 18, 'Ref: inde564', 4, 1499, 0.16, 'A la decouverte du Taj Mahal!!', 'http://localhost/developpement/php/projet_reve/public/images/tous_publics/voyage/voyage5.jpg', 'Voyage en Inde', 1, 1, 0);

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
(3, 2, 'Legendes sport', 'Deviens une legende du sport!!', 1),
(4, 2, 'Super heros', 'Sauve le monde!!', 1),
(5, 2, 'Celebrites', 'Deviens celebre!!', 1),
(6, 2, 'Cauchemars', 'Envie de faire peur a quelqu''un?', 1),
(7, 3, 'Shopping', 'Fais-toi plaisir!!', 1),
(8, 3, 'Celebrites', 'Deviens adulee dans le monde entier!!', 1),
(9, 3, 'Mariage de reve', 'Marie-toi dans des endroits paradisiaques!', 1),
(10, 3, 'Cauchemars', 'Besoin de grands frissons?', 1),
(11, 4, 'Super Heros', 'Pret a sauver l''humanite?', 1),
(12, 4, 'Heros TV', 'Deviens le heros de ta serie preferee!!', 1),
(13, 4, 'Parcs loisirs', 'Amuse-toi comme un petit fou!', 1),
(14, 4, 'Bonbons', 'Pour les petits gourmands', 1),
(15, 5, 'Social', 'Pour la reussite sociale', 1),
(16, 5, 'Maison', 'Mene la vie de chateau!!', 1),
(17, 5, 'Finance', 'Pour la reussite financiere', 1),
(18, 5, 'Voyages', 'Decouvre le monde!!', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `date_inscription`, `date_naissance`, `telephone`, `statut`, `sexe`, `login`, `admin`) VALUES
(2, 'Benay', 'Gael', 'a.bc@fake.com', '$2y$08$CnrWgg6hVLjBcfKgqbSFAOVIH7pVu0CX9eJ1k/wEkIwcxKWZtQaQ.', '2016-05-31 10:10:55', '0000-00-00 00:00:00', '0606060606', 1, 1, 'Gael', 1),
(6, 'toto', 'toto', 'toto@toto.to', '$2y$08$FZ9dd83D3er2dOtM1OMDKehE54CU28kRYf/RQrLHeNdyYSOuOgehC', '2016-05-31 11:33:13', '0000-00-00 00:00:00', '0101010101', 1, 1, 'toto', 0),
(7, 'user', 'dummy', 'dummy.user@fake.com', '$2y$08$aRPc/ELKujpJKlwMUrRCh.mnlXbW/Xv72Q.H.TcTwyIiFBUe1u2Ji', '2016-06-01 11:57:58', '0000-00-00 00:00:00', '0101010101', 1, 1, 'dummy', 0),
(8, 'user', 'dummy', 'dummy.user@fake.com', '$2y$08$/WHDrYbv3fUE3RiiUJDNyujTdXwE0ixNH7saHS6SWbPra/NcVONXi', '2016-06-01 11:58:50', '0000-00-00 00:00:00', '0101010101', 1, 1, 'dummy', 0),
(9, 'user', 'dummy', 'dummy.user@fake.com', '$2y$08$LFGnf1/6wrRY0YJipgwizOJ7PIEhJkJidhiC//vIsVQsfBs8DCxoO', '2016-06-01 11:59:39', '0000-00-00 00:00:00', '0101010101', 1, 1, 'dummy', 0),
(10, 'user', 'dummy', 'dummy.user@fake.com', '$2y$08$opLQq4ljnxeT4ncy37xJj.iadozjAq0e0cgWHPijCiVv4tALVR9jy', '2016-06-01 12:01:41', '0000-00-00 00:00:00', '0101010101', 1, 1, 'dummy', 0),
(11, 'mouloud', 'mouloud', 'mouloud@mouloud.fr', '$2y$08$PCAv89Ekb5P80kZ.AgG3feFWk0gzP/WtO3znN6qTTQ63Qm/WbtUeK', '2016-06-07 09:52:03', '0000-00-00 00:00:00', '0101010101', 1, 1, 'mouloud', 1),
(12, 'kris', 'kris', 'kris@kris.fr', '$2y$08$R9VTZDUnXAF37M9.QkK4o.44p3I4iotik2mT4.MK7Dxv/ktQtqY9G', '2016-06-08 11:22:19', '0000-00-00 00:00:00', '0101010101', 1, 1, 'kris', 0);

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
