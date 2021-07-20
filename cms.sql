-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 18 juil. 2021 à 22:27
-- Version du serveur :  10.3.27-MariaDB-0+deb10u1
-- Version de PHP : 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cms`
--

-- --------------------------------------------------------

--
-- Structure de la table `gojs_image`
--

CREATE TABLE `gojs_image` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `gojs_image`
--

INSERT INTO `gojs_image` (`id`, `file_name`, `user_id`, `uploaded_on`) VALUES
(70, 'uploads/products/2021-07-18_13:23:49_phpIOCg26.jpg', 29, '2021-07-18 13:23:49'),
(71, 'uploads/products/2021-07-18_14:54:42_php1eVpWE.jpg', 29, '2021-07-18 14:54:42'),
(72, 'uploads/products/2021-07-18_14:54:53_php3J0iYu.jpg', 29, '2021-07-18 14:54:53'),
(73, 'uploads/products/2021-07-18_14:54:59_phpv3HtJZ.jpg', 29, '2021-07-18 14:54:59'),
(74, 'uploads/products/2021-07-18_14:58:37_phpyQJayU.jpg', 29, '2021-07-18 14:58:37'),
(75, 'uploads/products/2021-07-18_14:58:52_phps3NPTe.jpg', 29, '2021-07-18 14:58:52'),
(76, 'uploads/products/2021-07-18_14:59:18_php3438nF.jpg', 29, '2021-07-18 14:59:18'),
(77, 'uploads/products/2021-07-18_14:59:31_phpufmOyz.jpg', 29, '2021-07-18 14:59:31'),
(78, 'uploads/products/2021-07-18_15:00:50_phpRqUgIX.jpg', 29, '2021-07-18 15:00:50'),
(79, 'uploads/products/2021-07-18_15:01:08_phpIgodkS.jpg', 29, '2021-07-18 15:01:08'),
(80, 'uploads/products/2021-07-18_15:01:26_php5yAXNz.jpg', 29, '2021-07-18 15:01:26'),
(81, 'uploads/products/2021-07-18_15:01:46_phptK8Ftg.jpg', 29, '2021-07-18 15:01:46'),
(82, 'uploads/products/2021-07-18_15:01:57_phpmcY8oo.jpg', 29, '2021-07-18 15:01:57'),
(83, 'uploads/products/2021-07-18_15:05:28_phpPPVRg7.jpg', 29, '2021-07-18 15:05:28'),
(84, 'uploads/menus/2021-07-18_15:06:48_phpRKeMJo.jpg', 29, '2021-07-18 15:06:48'),
(85, 'uploads/menus/2021-07-18_15:08:00_phpXa8WyF.jpg', 29, '2021-07-18 15:08:00');

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

--
-- Déchargement des données de la table `gojs_menu`
--

INSERT INTO `gojs_menu` (`id`, `title`, `description`, `image`, `createdAt`, `updatedAt`, `active`) VALUES
(2, 'Brunch', 'Midi de 11h à 17h', 85, '2021-06-30 14:11:30', '2021-07-18 15:08:00', 1),
(3, 'Diner', 'menu des diners', NULL, '2021-06-30 17:21:23', '2021-07-17 14:48:55', 1);

-- --------------------------------------------------------

--
-- Structure de la table `gojs_page`
--

CREATE TABLE `gojs_page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `html` longtext NOT NULL,
  `image` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gojs_page`
--

INSERT INTO `gojs_page` (`id`, `title`, `html`, `image`, `createdAt`) VALUES
(1, 'test title', 'html', 'test title', '2021-06-29'),
(2, 'test page', '<h1>ezaezae</h1><p>test content <strong>ezaeaze</strong></p>', 'test page', '2021-06-30'),
(3, 'test page', '<h1>ezaezae</h1><p>test content <strong>ezaeaze</strong></p>', 'test page', '2021-06-30'),
(4, 'page', '<p><em>ne page </em></p>', 'page', '2021-06-30'),
(5, 'page', '<p><em>ne page </em></p>', 'page', '2021-06-30'),
(6, 'zaezaezae', '<p>ezaezaezaezaezae</p>', 'zaezaezae', '2021-06-30'),
(7, 'zaezaezae', '<p>ezaezaezaezaezae</p>', 'zaezaezae', '2021-06-30'),
(8, 'azeaze', '', 'azeaze', '2021-06-30'),
(9, 'azeaze', '', 'azeaze', '2021-06-30'),
(10, 'ezaezae', '<p>azezaezaezae</p>', 'ezaezae', '2021-06-30'),
(11, 'ezaezae', '<p>azezaezaezae</p>', 'ezaezae', '2021-06-30'),
(12, 'ezaeza', '', 'ezaeza', '2021-06-30'),
(13, 'ezaeza', '', 'ezaeza', '2021-06-30'),
(14, 'ezaeza', '<p>azezaeza</p>', 'ezaeza', '2021-06-30'),
(15, 'ezaeza', '<p>azezaeza</p>', 'ezaeza', '2021-06-30'),
(16, 'ezaeza', '<p>ezaezaeza</p>', 'ezaeza', '2021-06-30'),
(17, 'ezaeza', '<p>ezaezaeza</p>', 'ezaeza', '2021-06-30'),
(18, 'ezae', '<p>ezaezae</p>', 'ezae', '2021-06-30'),
(19, 'ezae', '<p>ezaezae</p>', 'ezae', '2021-06-30'),
(20, 'azraze', '<p>azeaze</p>', 'azraze', '2021-06-30'),
(21, 'azraze', '<p>azeaze</p>', 'azraze', '2021-06-30'),
(22, 'test', '<p><strong>sssss<em>sssssss</em></strong><em>sssss</em></p>', 'test', '2021-06-30'),
(23, 'fddf', '<p>fdfd</p>', 'fddf', '2021-07-01'),
(24, 'Page !', '<p>new page</p>', 'Page !', '2021-07-01');

-- --------------------------------------------------------

--
-- Structure de la table `gojs_product`
--

CREATE TABLE `gojs_product` (
  `id` int(11) NOT NULL,
  `price` decimal(6,2) DEFAULT 0.00,
  `image` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gojs_product`
--

INSERT INTO `gojs_product` (`id`, `price`, `image`, `description`, `name`, `quantity`, `createdAt`, `updatedAt`) VALUES
(13, '2.50', 82, '33 cl', 'Canette de CocaCola', 100, '2021-07-17 17:53:07', '2021-07-18 15:01:57'),
(16, '12.90', 83, 'Gorgonzola, Comté, Mozzarela, Cheddar', 'Pizza 4 fromages', 50, '2021-07-18 15:05:28', '2021-07-18 15:05:28');

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
-- Déchargement des données de la table `gojs_user`
--

INSERT INTO `gojs_user` (`id`, `firstname`, `lastname`, `email`, `pwd`, `role`, `isDeleted`, `status`, `createdAt`, `updatedAt`, `pwdResetToken`) VALUES
(1, 'root', 'root', 'root@root.com', '$5$rounds=6666$Groupe69Salt$.6RxC0sJGSX0HNZPc9lPvo0cCatFESwRnOhtrMYgQW5', 'user', 0, 0, '2021-05-21 09:38:11', '2021-06-28 19:04:15', ''),
(29, 'Farid', 'Naderi', 'farid@mail.com', '$5$rounds=6666$Groupe69Salt$.6RxC0sJGSX0HNZPc9lPvo0cCatFESwRnOhtrMYgQW5', 'admin', 0, 0, '2021-06-24 23:18:12', '2021-07-18 17:56:50', 'f6f2ff2680c5f427dfbc1b519f7e9ee6257a6b2f'),
(31, 'Seb', 'Grd', 'seb@mail.com', '$5$rounds=6666$Groupe69Salt$kyt59O.fj3AK.mLwnHgYL/VX0.ixgZ07fzH0Ozn2Q.6', 'admin', 0, 0, '2021-06-28 06:54:42', '2021-06-30 21:58:00', ''),
(39, 'test', 'test', 'test@te.te', '$5$rounds=6666$Groupe69Salt$.6RxC0sJGSX0HNZPc9lPvo0cCatFESwRnOhtrMYgQW5', 'user', 0, 0, '2021-06-30 14:54:29', '2021-07-18 18:37:33', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3Q6ODg4OCIsImF1ZCI6ImxvY2FsaG9zdDo4ODg4IiwiaWF0IjoxNjI2NjI5ODUzLCJleHAiOjE2MjY3MTYyNTMsImRhdGEiOnsiZGF0YSI6eyJlbWFpbCI6InRlc3RAdGUudGUifX19.T6C-PokkRM7OgOnln0obnN6i4Bnuq6YUnN54gQ_L8-Q'),
(149, 'AAA', 'BBB', 'ccc@ccc.com', '$5$rounds=6666$Groupe69Salt$IEk2YiAlOgqhFIntY5RnXgQ.OIWqccG4.jCPfkLqrV7', 'admin', 0, 0, '2021-07-03 14:35:37', '2021-07-03 16:24:45', '');

--
-- Index pour les tables déchargées
--

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
  ADD KEY `image_id_fk` (`image`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `gojs_menu`
--
ALTER TABLE `gojs_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `gojs_page`
--
ALTER TABLE `gojs_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `gojs_product`
--
ALTER TABLE `gojs_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `gojs_user`
--
ALTER TABLE `gojs_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `gojs_image`
--
ALTER TABLE `gojs_image`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `gojs_user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Contraintes pour la table `gojs_menu`
--
ALTER TABLE `gojs_menu`
  ADD CONSTRAINT `image_id` FOREIGN KEY (`image`) REFERENCES `gojs_image` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `gojs_product`
--
ALTER TABLE `gojs_product`
  ADD CONSTRAINT `image_id_fk` FOREIGN KEY (`image`) REFERENCES `gojs_image` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
