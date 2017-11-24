-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 24 Novembre 2017 à 11:14
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shopbaby`
--

-- --------------------------------------------------------

--
-- Structure de la table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `total` float DEFAULT NULL COMMENT 'tổng tiền',
  `payment` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'hình thức thanh toán',
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bill` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `unit_price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `img_product`
--

CREATE TABLE `img_product` (
  `id` int(11) NOT NULL,
  `img_name` varchar(100) NOT NULL,
  `img_link` varchar(100) DEFAULT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `img_product`
--

INSERT INTO `img_product` (`id`, `img_name`, `img_link`, `id_product`) VALUES
(1, 'p5.jpg', NULL, 65),
(3, 'p7.jpg', NULL, 67),
(4, 'p8.jpg', NULL, 68),
(5, 'p9.jpg', NULL, 70),
(6, 'p10.jpg', NULL, 71),
(7, 'p8.jpg', NULL, 76),
(8, 'p8.jpg', NULL, 77);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung',
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'hình',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_type` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `unit_price` float NOT NULL,
  `promotion_price` float NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `new` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `name`, `id_type`, `description`, `unit_price`, `promotion_price`, `unit`, `created_at`, `updated_at`, `new`) VALUES
(65, 'Sơ Mi Huyền Thoại', 1, 'Áo đẹp nhất thế gian, không tim ra cái thứ 2', 2000000, 180000, 'cái', '2017-09-22 01:33:24', '2017-09-22 01:33:29', 0),
(66, 'Thun Junly', 2, 'Vip Pro dành đế bán chứ không cho', 900000, 200000, 'cái', '2017-09-21 01:42:09', '2017-09-22 01:42:14', 1),
(67, 'Khoác Kiếu Tây', 3, 'Cũng dành đế bán chứ không cho', 200000, 100000, 'cái', '2017-09-20 01:43:44', '2017-09-22 01:43:48', 0),
(68, 'Áo Thun Cao Cấp', 2, 'Bán chư ko cho', 3000000, 3000000, NULL, NULL, NULL, 1),
(70, 'Áo Thun Cao Cấp 4444', 3, 'Bán nha', 3000000, 3000000, NULL, '2017-10-16 03:04:11', NULL, 0),
(71, 'Áo Thun Cao Cấp 5555', 3, 'Bán đó', 3000000, 2800000, NULL, '2017-10-16 03:07:01', '2017-10-16 03:07:01', 0),
(72, 'Áo Thun Cao Cấp 6666', 4, 'Cho chư ko bán', 3000000, 2800000, NULL, '2017-10-16 03:08:00', '2017-10-16 03:08:00', 1),
(73, 'Nguyễn Thông Pro', 6, 'Bna cka', 3000000, 3000000, NULL, '2017-10-16 03:24:45', '2017-10-16 03:24:45', 0),
(74, 'Áo Thun Cao Cấp 7890', 1, '23232323232', 3000000, 2800000, NULL, '2017-10-16 03:24:16', '2017-10-16 03:24:16', 0),
(75, 'Áo Thun Cao Cấp 4444', 2, 'Bona', 3000000, 2800000, NULL, '2017-10-16 21:20:37', '2017-10-16 21:20:37', 1),
(76, 'Áo Thun Cao Cấp 0000', 2, 'Cho chư ko Bán', 3000000, 2800000, NULL, '2017-10-22 23:41:40', NULL, 0),
(77, 'Áo Thun Cao Cấp 9999999', 4, 'Thông nguyễn', 500000, 500000, NULL, '2017-10-22 23:46:11', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sex`
--

CREATE TABLE `sex` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `image_sex` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `sex`
--

INSERT INTO `sex` (`id`, `name`, `image_sex`) VALUES
(1, 'Men', NULL),
(2, 'Woment', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `slide`
--

INSERT INTO `slide` (`id`, `link`, `description`, `image`) VALUES
(1, '', 'Shop love', 'b1.jpg'),
(2, '', 'Shop love', 'b2.jpg'),
(3, '', 'Shop love', 'b3.jpg'),
(4, '', 'Shop love', 'b4.jpg'),
(10, 'public/img/menu.jpg', 'EEEEEEEEE', '1508491346menu.jpg'),
(11, 'public/img/xzU6n3v.jpg', '123', '1511168099xzU6n3v.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `type_products`
--

CREATE TABLE `type_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description_type` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_sex` int(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `type_products`
--

INSERT INTO `type_products` (`id`, `name_type`, `description_type`, `image`, `created_at`, `id_sex`, `updated_at`) VALUES
(1, 'Jen Xi Tin', 'Men Pro', NULL, '2017-09-22 01:34:39', 1, '2017-11-20 02:11:52'),
(2, 'Khoac Dai D', 'Women Beautifull', NULL, '2017-09-12 01:50:39', 1, '2017-11-20 02:11:12'),
(3, 'Kaki', 'Women Beautifull', NULL, '2017-10-12 07:37:34', 2, '2017-11-20 00:50:20'),
(4, 'Ao Ba Ba', 'Vipppp Pro', NULL, NULL, 1, '2017-10-19 21:53:15'),
(5, 'Ao Thun Ba Lỗ', 'Bán', NULL, NULL, 1, NULL),
(6, 'Quần Tây', 'Đẹp', NULL, '2017-10-19 04:16:05', 1, '2017-10-19 04:16:05'),
(9, 'Ao Ba Ba 2 Lỗ', 'w3school', NULL, '2017-10-19 21:49:53', 1, '2017-10-19 21:52:24'),
(10, 'Quần Tây Chất 123', 'Pro 123 12', NULL, '2017-10-19 21:51:40', 1, '2017-10-19 22:34:58');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_use` tinyint(1) NOT NULL,
  `bixoa` tinyint(1) NOT NULL,
  `remember_token` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `address`, `phone`, `type_use`, `bixoa`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Thông', 'hongthong1262137@facebook.com', 'thong2201', 'Nghệ An', NULL, 0, 0, '0', '2017-06-30 10:03:27', '2017-06-30 10:03:27');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_ibfk_1` (`id_customer`);

--
-- Index pour la table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_detail_ibfk_2` (`id_product`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `img_product`
--
ALTER TABLE `img_product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_type_foreign` (`id_type`);

--
-- Index pour la table `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_products`
--
ALTER TABLE `type_products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `img_product`
--
ALTER TABLE `img_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT pour la table `sex`
--
ALTER TABLE `sex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `type_products`
--
ALTER TABLE `type_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `type_products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
