-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 24 Novembre 2015 à 01:38
-- Version du serveur :  5.6.17-log
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gites`
--

-- --------------------------------------------------------

--
-- Structure de la table `ext_log_entries`
--

CREATE TABLE IF NOT EXISTS `ext_log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`object_class`),
  KEY `log_date_lookup_idx` (`logged_at`),
  KEY `log_user_lookup_idx` (`username`),
  KEY `log_version_lookup_idx` (`object_id`,`object_class`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ext_translations`
--

CREATE TABLE IF NOT EXISTS `ext_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gites`
--

CREATE TABLE IF NOT EXISTS `gites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `epis` int(11) NOT NULL,
  `personnes` int(11) NOT NULL,
  `chambres` int(11) NOT NULL,
  `surface` int(11) NOT NULL,
  `animaux_acceptes` tinyint(1) NOT NULL,
  `cv_acceptes` tinyint(1) NOT NULL,
  `url_dispo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_tarif` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_map` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `equipements` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `vignette_id` int(11) DEFAULT NULL,
  `description_courte` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E8A1B4257D16298B` (`vignette_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Contenu de la table `gites`
--

INSERT INTO `gites` (`id`, `nom`, `ville`, `epis`, `personnes`, `chambres`, `surface`, `animaux_acceptes`, `cv_acceptes`, `url_dispo`, `url_tarif`, `url_map`, `equipements`, `description`, `vignette_id`, `description_courte`) VALUES
(16, 'Les Rosiers', 'Odeillo - Font-Romeu', 3, 6, 3, 136, 1, 1, 'http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html', 'http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html', 'http://www.gites-galte.fr/gites-ruraux-cerdagne/_situation_fontromeu.html?height=680&width=640', '<p>Rez-de-chauss&eacute;e :</p>\r\n\r\n<p>Jardin avec barbecue, garage, cellier &eacute;quip&eacute; d&#39;une machine &agrave; laver, d&#39;un s&egrave;che linge et d&#39;une table de ping-pong.</p>\r\n\r\n<p>1er &eacute;tage :</p>\r\n\r\n<p>Jardin d&#39;hiver, cuisine (vaisselle, micro-ondes, cafeti&egrave;re, lave-vaisselle), salon avec chemin&eacute;e, salle &agrave; manger avec t&eacute;l&eacute; et lecteur DVD, WC.</p>\r\n\r\n<p>2e &eacute;tage :</p>\r\n\r\n<p>2 chambres doubles (grand lit) donnant sur une terrasse, une chambre avec 2 lits simples superpos&eacute;s, une salle de bain avec douche et WC.</p>', '<p>Grande maison de caract&egrave;res stiu&eacute;e au village d&#39;odeillo, commune de font-romeu, &agrave; 5km des d&eacute;parts de randonn&eacute;es et des pistes de ski, &agrave; 10mn des sources d&#39;eaux chaudes, 15mn de l&#39;Espagne et 40mn de la principaut&eacute; d&#39;Andoore, et 1h de la plaine du roussillon et de Perpignan</p>', 20, '<p>description rapide pour la homepage</p>'),
(17, 'Les Jonquilles', 'Saint piette del forcats', 2, 4, 2, 50, 1, 1, 'http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html', 'http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html', 'http://www.gites-galte.fr/gites-ruraux-cerdagne/_situation_fontromeu.html?height=680&width=640', 'Rez-de-chaussée :\r\n                Jardin avec barbecue, garage, cellier équipé d''une machine à laver,\r\n                d''un sèche linge et d''une table de ping-pong.\r\n\r\n                    1er étage :\r\n                Jardin d''hiver, cuisine (vaisselle, micro-ondes, cafetière,\r\n                lave-vaisselle), salon avec cheminée, salle à manger avec télé\r\n                et lecteur DVD, WC.\r\n\r\n                2e étage :\r\n                2 chambres doubles (grand lit) donnant sur une terrasse,\r\n                une chambre avec 2 lits simples superposés, une salle de bain\r\n                avec douche et WC.', 'Grande maison de caractères stiuée au village d''odeillo,\r\n                                commune de font-romeu, à 5km des départs de randonnées et des pistes de ski,\r\n                                à 10mn des sources d''eaux chaudes, 15mn de l''Espagne et 40mn de la principauté d''Andoore,\r\n                            et 1h de la plaine du roussillon et de Perpignan', 4, ''),
(18, 'Les Coquelicots', 'Saint pierre del forcats', 2, 4, 2, 50, 1, 1, 'http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html', 'http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html', 'http://www.gites-galte.fr/gites-ruraux-cerdagne/_situation_fontromeu.html?height=680&width=640', 'Rez-de-chaussée :\r\n                Jardin avec barbecue, garage, cellier équipé d''une machine à laver,\r\n                d''un sèche linge et d''une table de ping-pong.\r\n\r\n                    1er étage :\r\n                Jardin d''hiver, cuisine (vaisselle, micro-ondes, cafetière,\r\n                lave-vaisselle), salon avec cheminée, salle à manger avec télé\r\n                et lecteur DVD, WC.\r\n\r\n                2e étage :\r\n                2 chambres doubles (grand lit) donnant sur une terrasse,\r\n                une chambre avec 2 lits simples superposés, une salle de bain\r\n                avec douche et WC.', 'Grande maison de caractères stiuée au village d''odeillo,\r\n                                commune de font-romeu, à 5km des départs de randonnées et des pistes de ski,\r\n                                à 10mn des sources d''eaux chaudes, 15mn de l''Espagne et 40mn de la principauté d''Andoore,\r\n                            et 1h de la plaine du roussillon et de Perpignan', 21, '');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gite_id` int(11) NOT NULL,
  `ordre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ABED8E08652CAE9B` (`gite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id`, `name`, `path`, `gite_id`, `ordre`) VALUES
(4, 'le four', 'toto.jpeg', 16, 2),
(20, 'la cuisine équipée', 'ba0e5b6e569aaf84ed876726a47a6da8a2c84381.jpeg', 17, 2),
(21, 'le tapis', '6afc94dbc675b3aef364acc3cdd8d25390f738ef.jpeg', 18, 2);

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deletedAt` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `titleChanged` datetime DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2074E575989D9B62` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `deletedAt`, `created`, `updated`, `titleChanged`, `slug`, `titre`, `contenu`) VALUES
(11, NULL, '2015-11-20 22:55:02', '2015-11-20 22:55:02', NULL, '2015-11-20-22-55-cgv', 'CGV', '<div class="row">\r\n                <h4>Item Brand and Category</h4>\r\n                <h5>AB29837 CGV Model</h5>\r\n                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry ''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n            </div>\r\n            <div class="row">\r\n                <h4>Item Brand and Category</h4>\r\n                <h5>AB29837 Item Model</h5>\r\n                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n            </div>\r\n            <div class="row">\r\n                <h4>Item Brand and Category</h4>\r\n                <h5>AB29837 Item Model</h5>\r\n                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n            </div>'),
(12, NULL, '2015-11-20 22:55:02', '2015-11-20 22:55:02', NULL, '2015-11-20-22-55-mentions-l-gales', 'Mentions l', '<div class="row">\r\n                <h4>Item Brand and Category</h4>\r\n                <h5>AB29837 MENTIONS Model</h5>\r\n                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry ''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n            </div>\r\n            <div class="row">\r\n                <h4>Item Brand and Category</h4>\r\n                <h5>AB29837 Item Model</h5>\r\n                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n            </div>\r\n            <div class="row">\r\n                <h4>Item Brand and Category</h4>\r\n                <h5>AB29837 Item Model</h5>\r\n                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n            </div>');

-- --------------------------------------------------------

--
-- Structure de la table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `soustitre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lienStyle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Date_parution_debut` date NOT NULL,
  `Date_parution_fin` date NOT NULL,
  `ordre` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `slides`
--

INSERT INTO `slides` (`id`, `titre`, `soustitre`, `lien`, `lienStyle`, `Date_parution_debut`, `Date_parution_fin`, `ordre`, `path`, `url`) VALUES
(1, 'Bienvenue aux gîtes Neige et Soleil', 'Entre mer Méditerrannée et pics enneigés... Découvrez les Pyrénées Orientales', 'Réservation en ligne', 'btn btn-success', '2010-01-01', '2020-04-04', 1, 'odeillo-four-solaire.png', 'http://www.gites-de-france-66.com/location-vacances-Gite-a-Saint-pierre-dels-forcats-Pyrenees-Orientales-118801.html'),
(2, 'Richesse du patrrimoine naturel', 'Des kilomètres de sentiers balisés font des Pyrénées Orientales un véritable paradis pour les randonneurs', 'Contactez-nous', 'btn-primary', '2010-01-01', '2020-01-01', 2, 'cerdagne-lac2---Copie.png.png', ''),
(3, '40 ans d''accueil Catalan', 'Jean-Pierre et Marie-Claire Galté seront heureux de vous accueillir dans l''un de leurs 3 gîtes ruraux en Cerdagne', 'Plus de photos', 'btn-success', '2010-01-01', '2020-01-01', 3, 'gite-rural-cerdagne-galte.png', ''),
(4, 'Sports d''hiver', '400 kilomètres de pistes de ski à découvrir de Novembre à Mars', 'Nos disponibiltés', 'btn-primary', '2010-01-01', '2016-03-10', 4, 'four_solaire_neige_fontromeu.jpg', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_497B315E92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_497B315EA0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(11, 'davi', 'benjamin', 'benjamin@gmail.com', 'benjamin@gmail.com', 1, '1vg2ogstksm8kgkow4s4c8s84o4sgws', '$2y$13$1vg2ogstksm8kgkow4s4cueUxzzVSiw2cwgTRlJme3FJtlNTo/hTS', '2015-11-22 01:16:51', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL),
(12, 'mathilde', 'mathilde', 'mathilde@gmail.com', 'mathilde@gmail.com', 1, 'p00nmnki5hcwgow0gck44ccgskg00k4', '$2y$13$p00nmnki5hcwgow0gck44OMZMQlR12mTefTWp8Ea4XD/2EddS1EKS', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(16, 'david', 'david', 'david.gerard@ed-creatives.fr', 'david.gerard@ed-creatives.fr', 1, '74rhbtj0y1wk4skcc4480so0ocwc040', '$2y$13$74rhbtj0y1wk4skcc4480eHB9tKRbLtPbULY89j7xCjgwNerC5.cC', '2015-11-23 23:26:36', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `gites`
--
ALTER TABLE `gites`
  ADD CONSTRAINT `FK_E8A1B4257D16298B` FOREIGN KEY (`vignette_id`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_ABED8E08652CAE9B` FOREIGN KEY (`gite_id`) REFERENCES `gites` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
