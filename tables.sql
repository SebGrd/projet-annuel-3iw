-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 13 juil. 2021 à 01:21
-- Version du serveur :  10.3.27-MariaDB-0+deb10u1
-- Version de PHP : 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `cms`
--
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cms`;

-- --------------------------------------------------------

--
-- Structure de la table `gojs_image`
--

CREATE TABLE `gojs_image` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `gojs_menu`
--

CREATE TABLE `gojs_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gojs_page`
--

CREATE TABLE `gojs_page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `html` longtext NOT NULL,
  `image` text NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gojs_product`
--

CREATE TABLE `gojs_product` (
  `id` int(11) NOT NULL,
  `price` decimal(6,2) DEFAULT 0.00,
  `image` blob DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `gojs_quantity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gojs_setting`
--

CREATE TABLE `gojs_setting` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bottom_text` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `logo` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gojs_unit`
--

CREATE TABLE `gojs_unit` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gojs_user`
--

CREATE TABLE `gojs_user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(55) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(320) CHARACTER SET utf8 NOT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 NOT NULL,
  `role` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT 'user',
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `pwdResetToken` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Index pour la table `gojs_image`
--
ALTER TABLE `gojs_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Index pour la table `gojs_menu`
--
ALTER TABLE `gojs_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_id` (`image`);

--
-- Index pour la table `gojs_page`
--
ALTER TABLE `gojs_page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gojs_product`
--
ALTER TABLE `gojs_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gojs_product_gojs_quantity1_idx` (`gojs_quantity_id`);

--
-- Index pour la table `gojs_setting`
--
ALTER TABLE `gojs_setting`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gojs_unit`
--
ALTER TABLE `gojs_unit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gojs_user`
--
ALTER TABLE `gojs_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `gojs_image`
--
ALTER TABLE `gojs_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `gojs_menu`
--
ALTER TABLE `gojs_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `gojs_page`
--
ALTER TABLE `gojs_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `gojs_product`
--
ALTER TABLE `gojs_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gojs_setting`
--
ALTER TABLE `gojs_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gojs_unit`
--
ALTER TABLE `gojs_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gojs_user`
--
ALTER TABLE `gojs_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `gojs_image`
--
ALTER TABLE `gojs_image`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `gojs_user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `gojs_menu`
--
ALTER TABLE `gojs_menu`
  ADD CONSTRAINT `image_id` FOREIGN KEY (`image`) REFERENCES `gojs_image` (`id`);

--
-- Contraintes pour la table `gojs_product`
--
ALTER TABLE `gojs_product`
  ADD CONSTRAINT `fk_gojs_product_gojs_quantity1` FOREIGN KEY (`gojs_quantity_id`) REFERENCES `gojs_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
