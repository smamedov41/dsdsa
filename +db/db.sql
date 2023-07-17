-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 18, 2019 at 09:31 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fizuli_shalsetgroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_admins`
--

DROP TABLE IF EXISTS `cms_admins`;
CREATE TABLE `cms_admins` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `role` text,
  `creator_id` int(3) UNSIGNED DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_admins`
--

INSERT INTO `cms_admins` (`id`, `name`, `login`, `password`, `role`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, 'Fizuli Movlamov', 'fizuli', '$2y$10$rwzNPqs1N0.292kzqkcMIeEe.cyO87dge0/keGlXrgojMNtYvendq', '{\"index\":[\"list\"],\"pages\":[\"list\",\"add\",\"edit\",\"delete\"],\"news\":[\"list\",\"add\",\"edit\",\"delete\"],\"projects\":[\"list\",\"add\",\"edit\",\"delete\"],\"slider\":[\"list\",\"add\",\"edit\",\"delete\"],\"certificates\":[\"list\",\"add\",\"edit\",\"delete\"],\"partners\":[\"list\",\"add\",\"edit\",\"delete\"],\"staff\":[\"list\",\"add\",\"edit\",\"delete\"],\"cv\":[\"list\",\"delete\"],\"contact\":[\"list\",\"delete\"],\"settings\":[\"list\",\"add\",\"edit\",\"delete\"],\"langwords\":[\"list\"],\"admin\":[\"list\",\"add\",\"edit\",\"delete\"]}', 1, '2017-09-01 15:57:46', '2019-12-18 09:17:14', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_admin_antibrut`
--

DROP TABLE IF EXISTS `cms_admin_antibrut`;
CREATE TABLE `cms_admin_antibrut` (
  `id` int(11) NOT NULL,
  `input` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `cms_certificates`
--

DROP TABLE IF EXISTS `cms_certificates`;
CREATE TABLE `cms_certificates` (
  `id` int(11) UNSIGNED NOT NULL,
  `secret_id` varchar(50) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_certificates`
--

INSERT INTO `cms_certificates` (`id`, `secret_id`, `photo`, `post_date`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, 'edf1028ac673eb44ed2f1d3b250ead2b', NULL, NULL, 1, '2019-11-29 10:44:55', '2019-11-29 10:44:55', '2', '2'),
(2, '44bce3816cc3dcf53812bdb0b23b928d', NULL, NULL, 1, '2019-11-29 10:51:00', '2019-11-29 12:36:41', '2', '2'),
(3, '5ae3244590edb6d9f316ce1a69de050e', NULL, NULL, 1, '2019-11-29 11:17:15', '2019-11-29 12:36:30', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_certificates_photo`
--

DROP TABLE IF EXISTS `cms_certificates_photo`;
CREATE TABLE `cms_certificates_photo` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` varchar(50) NOT NULL DEFAULT '0',
  `secret_id` varchar(50) DEFAULT NULL,
  `ordering` int(11) UNSIGNED NOT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_certificates_photo`
--

INSERT INTO `cms_certificates_photo` (`id`, `p_id`, `secret_id`, `ordering`, `thumb`, `photo`, `create_date`) VALUES
(1, '0', 'bd5a141f9f4c81488b078a03689ec2c9', 1, '8ab69b5766a2a2077397491d441f8d081575007735-thumb.jpg', '8ab69b5766a2a2077397491d441f8d081575007735-photo.jpg', '2019-11-29 10:08:56'),
(2, '0', 'bd5a141f9f4c81488b078a03689ec2c9', 2, '0a49971ee89519083c3e7b7d699922b71575007736-thumb.jpg', '0a49971ee89519083c3e7b7d699922b71575007736-photo.jpg', '2019-11-29 10:09:00'),
(3, '0', 'bd5a141f9f4c81488b078a03689ec2c9', 3, '7b3bf10512482db001f0759119b1a1661575007740-thumb.jpg', '7b3bf10512482db001f0759119b1a1661575007740-photo.jpg', '2019-11-29 10:09:04'),
(4, '1', 'edf1028ac673eb44ed2f1d3b250ead2b', 1, '8ab69b5766a2a2077397491d441f8d081575009874-thumb.jpg', '8ab69b5766a2a2077397491d441f8d081575009874-photo.jpg', '2019-11-29 10:44:35'),
(5, '1', 'edf1028ac673eb44ed2f1d3b250ead2b', 2, '0a49971ee89519083c3e7b7d699922b71575009875-thumb.jpg', '0a49971ee89519083c3e7b7d699922b71575009875-photo.jpg', '2019-11-29 10:44:39'),
(6, '1', 'edf1028ac673eb44ed2f1d3b250ead2b', 3, '7b3bf10512482db001f0759119b1a1661575009879-thumb.jpg', '7b3bf10512482db001f0759119b1a1661575009879-photo.jpg', '2019-11-29 10:44:44'),
(7, '2', '44bce3816cc3dcf53812bdb0b23b928d', 1, '3180be554471a13500a0824973dab7531575010244-thumb.jpg', '3180be554471a13500a0824973dab7531575010244-photo.jpg', '2019-11-29 10:50:48'),
(8, '2', '44bce3816cc3dcf53812bdb0b23b928d', 2, 'be165c3224f7f99888316a5a8b212bd51575010248-thumb.jpg', 'be165c3224f7f99888316a5a8b212bd51575010248-photo.jpg', '2019-11-29 10:50:52'),
(9, '2', '44bce3816cc3dcf53812bdb0b23b928d', 3, '2ce01043a7bf0d509564b9c78cfad0611575010252-thumb.jpg', '2ce01043a7bf0d509564b9c78cfad0611575010252-photo.jpg', '2019-11-29 10:50:56'),
(10, '3', '5ae3244590edb6d9f316ce1a69de050e', 1, 'ad3f9aefeadb8a443f8d589bd22756911575011562-thumb.jpg', 'ad3f9aefeadb8a443f8d589bd22756911575011562-photo.jpg', '2019-11-29 11:12:46'),
(11, '3', '5ae3244590edb6d9f316ce1a69de050e', 2, '4627f38a76adca8db4df4629e2bf04c51575011566-thumb.jpg', '4627f38a76adca8db4df4629e2bf04c51575011566-photo.jpg', '2019-11-29 11:12:50'),
(12, '3', '5ae3244590edb6d9f316ce1a69de050e', 3, 'b9df45b85c2f96190de1f6bd80ca08b41575011570-thumb.jpg', 'b9df45b85c2f96190de1f6bd80ca08b41575011570-photo.jpg', '2019-11-29 11:12:53'),
(13, '3', '5ae3244590edb6d9f316ce1a69de050e', 4, '0bd11f5065a73b613bcd6e819a6d67461575011573-thumb.jpg', '0bd11f5065a73b613bcd6e819a6d67461575011573-photo.jpg', '2019-11-29 11:12:57'),
(14, '3', '5ae3244590edb6d9f316ce1a69de050e', 5, '5da630e9d25d4378115f380b02c3f2a81575011577-thumb.jpg', '5da630e9d25d4378115f380b02c3f2a81575011577-photo.jpg', '2019-11-29 11:13:01'),
(15, '3', '5ae3244590edb6d9f316ce1a69de050e', 6, 'b49e1f014ae3e022a183eec16fe4471c1575011581-thumb.jpg', 'b49e1f014ae3e022a183eec16fe4471c1575011581-photo.jpg', '2019-11-29 11:13:05'),
(16, '3', '5ae3244590edb6d9f316ce1a69de050e', 7, 'f477f819e0ec4df2621f28feb88976d41575011585-thumb.jpg', 'f477f819e0ec4df2621f28feb88976d41575011585-photo.jpg', '2019-11-29 11:13:09'),
(17, '3', '5ae3244590edb6d9f316ce1a69de050e', 8, '6b6dc37fef8bfd3951ee06464f45794f1575011589-thumb.jpg', '6b6dc37fef8bfd3951ee06464f45794f1575011589-photo.jpg', '2019-11-29 11:13:13'),
(18, '3', '5ae3244590edb6d9f316ce1a69de050e', 9, 'd8d9a54f2edca64a48598aa388ff9fca1575011593-thumb.jpg', 'd8d9a54f2edca64a48598aa388ff9fca1575011593-photo.jpg', '2019-11-29 11:13:17'),
(19, '3', '5ae3244590edb6d9f316ce1a69de050e', 10, 'b972be51b18af7426f588349c35abc991575011597-thumb.jpg', 'b972be51b18af7426f588349c35abc991575011597-photo.jpg', '2019-11-29 11:13:21'),
(20, '3', '5ae3244590edb6d9f316ce1a69de050e', 11, 'f31f0db8db7a30864f89600855125b221575011601-thumb.jpg', 'f31f0db8db7a30864f89600855125b221575011601-photo.jpg', '2019-11-29 11:13:25'),
(21, '3', '5ae3244590edb6d9f316ce1a69de050e', 12, '1e7d0226e347a7aa247efe6ac95f23d61575011605-thumb.jpg', '1e7d0226e347a7aa247efe6ac95f23d61575011605-photo.jpg', '2019-11-29 11:13:29'),
(22, '3', '5ae3244590edb6d9f316ce1a69de050e', 13, '952e205c8deb57a3246a9b09434ba03f1575011609-thumb.jpg', '952e205c8deb57a3246a9b09434ba03f1575011609-photo.jpg', '2019-11-29 11:13:33'),
(23, '3', '5ae3244590edb6d9f316ce1a69de050e', 14, 'c64ae70f46529385b4ad7b94b07ac87b1575011613-thumb.jpg', 'c64ae70f46529385b4ad7b94b07ac87b1575011613-photo.jpg', '2019-11-29 11:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `cms_certificates_text`
--

DROP TABLE IF EXISTS `cms_certificates_text`;
CREATE TABLE `cms_certificates_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `text` longtext,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_certificates_text`
--

INSERT INTO `cms_certificates_text` (`id`, `p_id`, `title`, `subtitle`, `text`, `lang`) VALUES
(1, 1, 'Lisensiyalar', NULL, '<p>“SHALSET GROUP” Məhdud Məsuliyyətli Cəmiyyətinin “Tikintisinə icazə tələb olunan bina və qurğuların tikinti-quraşdırma işlərini” həyata keçirilməsi haqqında “LİSENZİYASI” və “LİSENZİYANIN ƏLAVƏSİ”<br /></p>', 'az'),
(2, 1, 'Lisensiyalar', NULL, '<p>“SHALSET GROUP” Məhdud Məsuliyyətli Cəmiyyətinin “Tikintisinə icazə tələb olunan bina və qurğuların tikinti-quraşdırma işlərini” həyata keçirilməsi haqqında “LİSENZİYASI” və “LİSENZİYANIN ƏLAVƏSİ”<br /></p>', 'en'),
(3, 1, 'Lisensiyalar', NULL, '<p>“SHALSET GROUP” Məhdud Məsuliyyətli Cəmiyyətinin “Tikintisinə icazə tələb olunan bina və qurğuların tikinti-quraşdırma işlərini” həyata keçirilməsi haqqında “LİSENZİYASI” və “LİSENZİYANIN ƏLAVƏSİ”<br /></p>', 'ru'),
(22, 3, 'Hündürlükdə işləmə sertifikatları', NULL, '<p>12.3. hündürlüyü 65 metrədək<br />12.4. hündürlüyü 65 metr və daha çox</p>', 'az'),
(23, 3, '', NULL, '', 'en'),
(24, 3, '', NULL, '', 'ru'),
(25, 2, 'İSO beynəlxalq sertifikatlar', NULL, '<p>İSO 9001-2015 \"Keyfiyyət menecment sistemi.\" <br />İSO 45001:2015 \"Peşə sağlamlığı və təhlükəsizliyinin idarəedilməsi sistemi.\" <br />İSO 14001-2015 \"Ətraf mühiti idarəetmə sistemi\". </p><div><br /></div>', 'az'),
(26, 2, 'İSO beynəlxalq sertifikatlar', NULL, '<p>İSO 9001-2015 \"Keyfiyyət menecment sistemi.\" </p><p>İSO 45001:2015 \"Peşə sağlamlığı və təhlükəsizliyinin idarəedilməsi sistemi.\" </p><p>İSO 14001-2015 \"Ətraf mühiti idarəetmə sistemi\". </p><div><br /></div>', 'en'),
(27, 2, 'İSO beynəlxalq sertifikatlar', NULL, '<p>İSO 9001-2015 \"Keyfiyyət menecment sistemi.\" </p><p>İSO 45001:2015 \"Peşə sağlamlığı və təhlükəsizliyinin idarəedilməsi sistemi.\" </p><p>İSO 14001-2015 \"Ətraf mühiti idarəetmə sistemi\". </p><div><br /></div>', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `cms_contact`
--

DROP TABLE IF EXISTS `cms_contact`;
CREATE TABLE `cms_contact` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `msg` text,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `cms_cv`
--

DROP TABLE IF EXISTS `cms_cv`;
CREATE TABLE `cms_cv` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `father` varchar(255) DEFAULT NULL,
  `birthday` varchar(50) DEFAULT NULL,
  `mob_phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `cms_galleryphoto`
--

DROP TABLE IF EXISTS `cms_galleryphoto`;
CREATE TABLE `cms_galleryphoto` (
  `id` int(11) UNSIGNED NOT NULL,
  `secret_id` varchar(50) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_galleryphoto`
--

INSERT INTO `cms_galleryphoto` (`id`, `secret_id`, `photo`, `post_date`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, '9944d715ab9fbcd178076b716df776a1', NULL, '2019-08-02', 1, '2019-08-02 11:45:22', '2019-08-02 12:01:44', '2', '2'),
(2, '0361689935c4f92ce85a0fc8791b48e7', NULL, '2019-08-01', 1, '2019-08-02 12:16:20', '2019-08-02 12:16:20', '2', '2'),
(3, 'de07c9fe1a5d65ee19049b54b49e82d5', NULL, '2019-08-01', 1, '2019-08-02 12:17:00', '2019-08-02 12:17:00', '2', '2'),
(4, '078d280f0e4c859fcaf4a47c0085d42e', NULL, '2019-08-01', 1, '2019-08-02 12:17:48', '2019-08-02 12:17:48', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_galleryphoto_photo`
--

DROP TABLE IF EXISTS `cms_galleryphoto_photo`;
CREATE TABLE `cms_galleryphoto_photo` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` varchar(50) NOT NULL DEFAULT '0',
  `secret_id` varchar(50) DEFAULT NULL,
  `ordering` int(11) UNSIGNED NOT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_galleryphoto_photo`
--

INSERT INTO `cms_galleryphoto_photo` (`id`, `p_id`, `secret_id`, `ordering`, `thumb`, `photo`, `create_date`) VALUES
(16, '1', '9944d715ab9fbcd178076b716df776a1', 1, '2b50e8bb26b7031d9e1e1f537d1883f81564732897-thumb.jpg', '2b50e8bb26b7031d9e1e1f537d1883f81564732897-photo.jpg', '2019-08-02 12:01:37'),
(17, '1', '9944d715ab9fbcd178076b716df776a1', 2, 'c3dc57de6aa40c8456713cc1857759e91564732897-thumb.jpg', 'c3dc57de6aa40c8456713cc1857759e91564732897-photo.jpg', '2019-08-02 12:01:37'),
(18, '1', '9944d715ab9fbcd178076b716df776a1', 3, 'a09b14f17b7912855914b905eb97d4971564732897-thumb.jpg', 'a09b14f17b7912855914b905eb97d4971564732897-photo.jpg', '2019-08-02 12:01:38'),
(19, '1', '9944d715ab9fbcd178076b716df776a1', 4, '4a02d2ea0b112384b5bd96c65f5e806a1564732898-thumb.jpg', '4a02d2ea0b112384b5bd96c65f5e806a1564732898-photo.jpg', '2019-08-02 12:01:38'),
(20, '1', '9944d715ab9fbcd178076b716df776a1', 5, '90865a0809f1987539b349c02e0633c81564732898-thumb.jpg', '90865a0809f1987539b349c02e0633c81564732898-photo.jpg', '2019-08-02 12:01:39'),
(21, '1', '9944d715ab9fbcd178076b716df776a1', 6, '52cae52f7e923bb39c76e83735d0b7161564732899-thumb.jpg', '52cae52f7e923bb39c76e83735d0b7161564732899-photo.jpg', '2019-08-02 12:01:39'),
(22, '2', '0361689935c4f92ce85a0fc8791b48e7', 1, '2d1ae74b8ae674bc0c54ba6ece9b74d91564733775-thumb.jpg', '2d1ae74b8ae674bc0c54ba6ece9b74d91564733775-photo.jpg', '2019-08-02 12:16:15'),
(23, '2', '0361689935c4f92ce85a0fc8791b48e7', 2, '3777a4c19b37dd651b45788d1af506111564733775-thumb.jpg', '3777a4c19b37dd651b45788d1af506111564733775-photo.jpg', '2019-08-02 12:16:16'),
(24, '2', '0361689935c4f92ce85a0fc8791b48e7', 3, '6a5e08fff412e88fde05b5fe681e1f131564733776-thumb.jpg', '6a5e08fff412e88fde05b5fe681e1f131564733776-photo.jpg', '2019-08-02 12:16:16'),
(25, '3', 'de07c9fe1a5d65ee19049b54b49e82d5', 1, '4ef2d809a41479712bfb67b82df2363c1564733817-thumb.jpg', '4ef2d809a41479712bfb67b82df2363c1564733817-photo.jpg', '2019-08-02 12:16:57'),
(26, '3', 'de07c9fe1a5d65ee19049b54b49e82d5', 2, 'e4b96dd72a6e323b86892ee469f812551564733817-thumb.jpg', 'e4b96dd72a6e323b86892ee469f812551564733817-photo.jpg', '2019-08-02 12:16:58'),
(27, '3', 'de07c9fe1a5d65ee19049b54b49e82d5', 3, '3b790eca5bd4a0b69de74c8e949c85f51564733818-thumb.jpg', '3b790eca5bd4a0b69de74c8e949c85f51564733818-photo.jpg', '2019-08-02 12:16:58'),
(28, '4', '078d280f0e4c859fcaf4a47c0085d42e', 1, 'cd2aa798b106e527dbb439e23f0018051564733835-thumb.jpg', 'cd2aa798b106e527dbb439e23f0018051564733835-photo.jpg', '2019-08-02 12:17:16'),
(29, '4', '078d280f0e4c859fcaf4a47c0085d42e', 2, '2b50e8bb26b7031d9e1e1f537d1883f81564733841-thumb.jpg', '2b50e8bb26b7031d9e1e1f537d1883f81564733841-photo.jpg', '2019-08-02 12:17:22'),
(30, '4', '078d280f0e4c859fcaf4a47c0085d42e', 3, 'c3dc57de6aa40c8456713cc1857759e91564733842-thumb.jpg', 'c3dc57de6aa40c8456713cc1857759e91564733842-photo.jpg', '2019-08-02 12:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `cms_galleryphoto_text`
--

DROP TABLE IF EXISTS `cms_galleryphoto_text`;
CREATE TABLE `cms_galleryphoto_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `text` longtext,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_galleryphoto_text`
--

INSERT INTO `cms_galleryphoto_text` (`id`, `p_id`, `title`, `subtitle`, `text`, `lang`) VALUES
(55, 1, 'Xocalı Soyqırımına həsr olumuş yarış keçirildi', NULL, 'Fevral ayının 26- da Binəqədi İcra Hakimiyyətinin və Azərbaycan Atıcılıq Federasiyasının dəstəyi ilə Respublika Stend Atıcılığı İdman Kompleksində Xocalı soyqırımına həsr olunmuş Binəqədi rayon məktəblər arası yarış keçirildi. Yarışda 16 məktənin şagirdləri iştirak etdi.Qaliblər kubok və medallarla təltif olundular.', 'az'),
(56, 1, 'Xocalı Soyqırımına həsr olumuş yarış keçirildi', NULL, 'Fevral ayının 26- da Binəqədi İcra Hakimiyyətinin və Azərbaycan Atıcılıq Federasiyasının dəstəyi ilə Respublika Stend Atıcılığı İdman Kompleksində Xocalı soyqırımına həsr olunmuş Binəqədi rayon məktəblər arası yarış keçirildi. Yarışda 16 məktənin şagirdləri iştirak etdi.Qaliblər kubok və medallarla təltif olundular.', 'en'),
(57, 1, 'Xocalı Soyqırımına həsr olumuş yarış keçirildi', NULL, 'Fevral ayının 26- da Binəqədi İcra Hakimiyyətinin və Azərbaycan Atıcılıq Federasiyasının dəstəyi ilə Respublika Stend Atıcılığı İdman Kompleksində Xocalı soyqırımına həsr olunmuş Binəqədi rayon məktəblər arası yarış keçirildi. Yarışda 16 məktənin şagirdləri iştirak etdi.Qaliblər kubok və medallarla təltif olundular.', 'ru'),
(58, 2, 'Ümummilli lider Heydər Əliyevin xatirəsinə həsr olunmuş atıcılığın sportinq növü üzrə “Qızıl patron” turniri keçirilmişdir', NULL, '<p class=\"MsoNormal\" style=\"margin-bottom:1rem;line-height:23px;\"><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Mayın 5-də ümummilli lider Heydər Əliyevin xatirəsinə həsr olunmuş atıcılığın sportinq növü üzrə “Qızıl patron” turniri keçirilmişdir.<span class=\"apple-converted-space\"> </span></span></p><p class=\"MsoNormal\" style=\"margin-bottom:1rem;line-height:23px;\"><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Respublika Stend Atıcılığı İdman Kompleksində keçirilən turnird</span><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">ə 30 idmançı mübarizə aparırdı. Yarışda 95 xal toplayan İlham Mahmudov fəxri kürsünün ən yüksək pilləsinə yüksəlmişdir. İbrahim Həsənov 92 xalla 2-ci,   Rauf Sadıxov və Sergey Aqafanov (hər ikisi 88 xal) isə 3-cü yerə sahib olmuşlar.</span><br /><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Turnirin qalibinə “Qızıl patron”, mükafatçılara isə medallar, Gənclər və İdman Nazirliyinin diplomu və xatirə hədiyyələri təqdim edilmişdir. </span></p>', 'az'),
(59, 2, 'Ümummilli lider Heydər Əliyevin xatirəsinə həsr olunmuş atıcılığın sportinq növü üzrə “Qızıl patron” turniri keçirilmişdir', NULL, '<p class=\"MsoNormal\" style=\"margin-bottom:1rem;line-height:23px;\"><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Mayın 5-də ümummilli lider Heydər Əliyevin xatirəsinə həsr olunmuş atıcılığın sportinq növü üzrə “Qızıl patron” turniri keçirilmişdir.<span class=\"apple-converted-space\"> </span></span></p><p class=\"MsoNormal\" style=\"margin-bottom:1rem;line-height:23px;\"><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Respublika Stend Atıcılığı İdman Kompleksində keçirilən turnird</span><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">ə 30 idmançı mübarizə aparırdı. Yarışda 95 xal toplayan İlham Mahmudov fəxri kürsünün ən yüksək pilləsinə yüksəlmişdir. İbrahim Həsənov 92 xalla 2-ci,   Rauf Sadıxov və Sergey Aqafanov (hər ikisi 88 xal) isə 3-cü yerə sahib olmuşlar.</span><br /><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Turnirin qalibinə “Qızıl patron”, mükafatçılara isə medallar, Gənclər və İdman Nazirliyinin diplomu və xatirə hədiyyələri təqdim edilmişdir. </span></p>', 'en'),
(60, 2, 'Ümummilli lider Heydər Əliyevin xatirəsinə həsr olunmuş atıcılığın sportinq növü üzrə “Qızıl patron” turniri keçirilmişdir', NULL, '<p class=\"MsoNormal\" style=\"margin-bottom:1rem;line-height:23px;\"><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Mayın 5-də ümummilli lider Heydər Əliyevin xatirəsinə həsr olunmuş atıcılığın sportinq növü üzrə “Qızıl patron” turniri keçirilmişdir.<span class=\"apple-converted-space\"> </span></span></p><p class=\"MsoNormal\" style=\"margin-bottom:1rem;line-height:23px;\"><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Respublika Stend Atıcılığı İdman Kompleksində keçirilən turnird</span><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">ə 30 idmançı mübarizə aparırdı. Yarışda 95 xal toplayan İlham Mahmudov fəxri kürsünün ən yüksək pilləsinə yüksəlmişdir. İbrahim Həsənov 92 xalla 2-ci,   Rauf Sadıxov və Sergey Aqafanov (hər ikisi 88 xal) isə 3-cü yerə sahib olmuşlar.</span><br /><span style=\"background-image:none;background-position:0% 0%;background-repeat:repeat;background-attachment:scroll;\">Turnirin qalibinə “Qızıl patron”, mükafatçılara isə medallar, Gənclər və İdman Nazirliyinin diplomu və xatirə hədiyyələri təqdim edilmişdir. </span></p>', 'ru'),
(61, 3, 'Güllə atıcılığı üzrə turnirin qalibləri müəyyənləşmişdir', NULL, '<p>Fevral ayının 17-də Finladiyanın Viermuyaki şəhərində keçirilən Avropa çempionatının gənclər arasındakı mübarizədə qalibləri müəyyənləşmişdir.<br />Qadınların mübarizəsində Polşalı atıcı Tomala Joanna 381 xal yığaraq 1-ci yeri tutmuşdur.<br />Qeyd edək ki, Azərbaycanı təmsil edən gənc atıcımız Səmədova Nazmina 351 xal yığaraq 48-ci yerdə qərarlaşmışdir.<br /></p>', 'az'),
(62, 3, 'Güllə atıcılığı üzrə turnirin qalibləri müəyyənləşmişdir', NULL, '<p>Fevral ayının 17-də Finladiyanın Viermuyaki şəhərində keçirilən Avropa çempionatının gənclər arasındakı mübarizədə qalibləri müəyyənləşmişdir.<br />Qadınların mübarizəsində Polşalı atıcı Tomala Joanna 381 xal yığaraq 1-ci yeri tutmuşdur.<br />Qeyd edək ki, Azərbaycanı təmsil edən gənc atıcımız Səmədova Nazmina 351 xal yığaraq 48-ci yerdə qərarlaşmışdir.<br /></p>', 'en'),
(63, 3, 'Güllə atıcılığı üzrə turnirin qalibləri müəyyənləşmişdir', NULL, '<p>Fevral ayının 17-də Finladiyanın Viermuyaki şəhərində keçirilən Avropa çempionatının gənclər arasındakı mübarizədə qalibləri müəyyənləşmişdir.<br />Qadınların mübarizəsində Polşalı atıcı Tomala Joanna 381 xal yığaraq 1-ci yeri tutmuşdur.<br />Qeyd edək ki, Azərbaycanı təmsil edən gənc atıcımız Səmədova Nazmina 351 xal yığaraq 48-ci yerdə qərarlaşmışdir.<br /></p>', 'ru'),
(64, 4, 'Avropa çempionatının açılış mərasimi oldu.', NULL, '<p style=\"margin-bottom:1rem;line-height:23px;\">Fevralın 15-də Finlandiyanın Vierumyaki şəhərində 10 metr məsafəyə atəş açma üzrə gənclər və böyüklər arasında Avropa çempionatı keçiriləcəkdir.<br />Yarışda böyüklərin mübarizəsində Azərbaycanı Afina Yay Olimpiya Oyunlarının bürünc mükafatçısı, məşqçi İradə Aşumova, Nigar Bağırova, Zərifə Qasımova, Ruslan Lunyov və Rəsul Məmmədov təmsil edəcəklər. Gənclərin yarışında isə idmançımız Nərminə Səmədova mübarizə aparacaqdır.<br />Çempionatda 45 ölkədən 654 idmançı iştirak edəcəkdir.<br />Yarış fevralın 20-dək davam edəcəkdir.</p><div><br /></div>', 'az'),
(65, 4, 'Avropa çempionatının açılış mərasimi oldu.', NULL, '<p style=\"margin-bottom:1rem;line-height:23px;\">Fevralın 15-də Finlandiyanın Vierumyaki şəhərində 10 metr məsafəyə atəş açma üzrə gənclər və böyüklər arasında Avropa çempionatı keçiriləcəkdir.<br />Yarışda böyüklərin mübarizəsində Azərbaycanı Afina Yay Olimpiya Oyunlarının bürünc mükafatçısı, məşqçi İradə Aşumova, Nigar Bağırova, Zərifə Qasımova, Ruslan Lunyov və Rəsul Məmmədov təmsil edəcəklər. Gənclərin yarışında isə idmançımız Nərminə Səmədova mübarizə aparacaqdır.<br />Çempionatda 45 ölkədən 654 idmançı iştirak edəcəkdir.<br />Yarış fevralın 20-dək davam edəcəkdir.</p><div><br /></div>', 'en'),
(66, 4, 'Avropa çempionatının açılış mərasimi oldu.', NULL, '<p style=\"margin-bottom:1rem;line-height:23px;\">Fevralın 15-də Finlandiyanın Vierumyaki şəhərində 10 metr məsafəyə atəş açma üzrə gənclər və böyüklər arasında Avropa çempionatı keçiriləcəkdir.<br />Yarışda böyüklərin mübarizəsində Azərbaycanı Afina Yay Olimpiya Oyunlarının bürünc mükafatçısı, məşqçi İradə Aşumova, Nigar Bağırova, Zərifə Qasımova, Ruslan Lunyov və Rəsul Məmmədov təmsil edəcəklər. Gənclərin yarışında isə idmançımız Nərminə Səmədova mübarizə aparacaqdır.<br />Çempionatda 45 ölkədən 654 idmançı iştirak edəcəkdir.<br />Yarış fevralın 20-dək davam edəcəkdir.</p><div><br /></div>', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `cms_langwords`
--

DROP TABLE IF EXISTS `cms_langwords`;
CREATE TABLE `cms_langwords` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(250) NOT NULL,
  `az` text,
  `file` text,
  `creator_id` int(3) UNSIGNED NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

DROP TABLE IF EXISTS `cms_pages`;
CREATE TABLE `cms_pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ordering` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `static_page` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `target` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `parent`, `ordering`, `static_page`, `target`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, 0, 1, 0, 0, 1, '2019-11-26 09:40:22', '2019-11-26 09:40:22', '2', '2'),
(2, 1, 2, 0, 0, 1, '2019-11-26 09:40:36', '2019-11-26 17:26:37', '2', '2'),
(3, 1, 3, 1, 0, 1, '2019-11-26 09:42:35', '2019-11-26 15:16:00', '2', '2'),
(4, 1, 4, 1, 0, 1, '2019-11-26 09:56:30', '2019-11-26 11:52:35', '2', '2'),
(5, 1, 5, 1, 0, 1, '2019-11-26 09:56:55', '2019-11-26 11:49:34', '2', '2'),
(6, 2, 2, 0, 0, 1, '2019-11-26 10:57:03', '2019-12-16 16:51:28', '1', '2'),
(7, 2, 3, 1, 0, 1, '2019-11-26 10:57:35', '2019-11-29 10:26:46', '2', '2'),
(8, 2, 4, 1, 0, 1, '2019-11-26 10:58:03', '2019-12-02 08:45:29', '2', '2'),
(9, 1, 1, 0, 0, 1, '2019-11-26 11:30:12', '2019-11-26 11:30:31', '2', '2'),
(10, 2, 1, 1, 0, 1, '2019-11-26 11:31:40', '2019-11-30 11:00:15', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages_text`
--

DROP TABLE IF EXISTS `cms_pages_text`;
CREATE TABLE `cms_pages_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `text` longtext,
  `link` varchar(255) DEFAULT NULL,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_pages_text`
--

INSERT INTO `cms_pages_text` (`id`, `p_id`, `slug`, `title`, `subtitle`, `text`, `link`, `lang`) VALUES
(1, 1, 'top-menu', 'TOP MENU', '', '', '', 'az'),
(2, 1, 'top-menu', 'TOP MENU', '', '', '', 'en'),
(3, 1, 'top-menu', 'TOP MENU', '', '', '', 'ru'),
(19, 6, 'idare-heyyeti', 'İdarə heyyəti', '', '', '', 'az'),
(20, 6, 'idare-heyyeti', 'İdarə heyyəti', '', '', '', 'en'),
(21, 6, 'idare-heyyeti', 'İdarə heyyəti', '', '', '', 'ru'),
(34, 9, 'ana-sehife', 'Ana səhifə', '', '', '/az', 'az'),
(35, 9, 'ana-sehife', 'Ana səhifə', '', '', '/en', 'en'),
(36, 9, 'ana-sehife', 'Ana səhifə', '', '', '/ru', 'ru'),
(43, 5, 'contacts', 'Əlaqə', 'Bizimlə əlaqə', '', '', 'az'),
(44, 5, 'contacts', 'Əlaqə', 'Bizimlə əlaqə', '', '', 'en'),
(45, 5, 'contacts', 'Əlaqə', 'Bizimlə əlaqə', '', '', 'ru'),
(46, 4, 'news', 'Xəbərlər', '', '', '', 'az'),
(47, 4, 'news', 'Xəbərlər', '', '', '', 'en'),
(48, 4, 'news', 'Xəbərlər', '', '', '', 'ru'),
(52, 3, 'projects', 'Layihələr', 'Layihələrimiz', '', '', 'az'),
(53, 3, 'projects', 'Layihələr', '', '', '', 'en'),
(54, 3, 'projects', 'Layihələr', '', '', '', 'ru'),
(55, 2, 'haqqimizda', 'Haqqımızda', '', '', '#', 'az'),
(56, 2, 'haqqimizda', 'Haqqımızda', '', '', '#', 'en'),
(57, 2, 'haqqimizda', 'Haqqımızda', '', '', '#', 'ru'),
(61, 7, 'certificates', 'Sertifikatlar', 'Lisenziya və sertifikatlar', '', '', 'az'),
(62, 7, 'certificates', 'Sertifikatlar', 'Lisenziya və sertifikatlar', '', '', 'en'),
(63, 7, 'certificates', 'Sertifikatlar', 'Lisenziya və sertifikatlar', '', '', 'ru'),
(91, 10, 'about', 'Şirkət haqqında', 'Şirkətin fəaliyyət sahəsi və ümumi məlumat', '<p>\"Shalset Group\" MMC tikinti sektorunda Azərbaycan Respublikasının qanunvericiliyinə uyğun fəaliyyət göstərən və bu\r\n    sektorda özünü keyfiyyətli işlərlə doğrultmuş tikinti şirkətidir. Azərbaycan Respublikasının İqtisadiyyat nazirliyi\r\n    tərəfindən verilmiş lisenziya əsasında “Shalset Group” Məhdud Məsuliyyətli Cəmiyyətinə fəaliyyəti üzrə\r\n    görülməsinə icazə verilən işlər:</p>\r\n<ul>\r\n    <li>1. Xüsusi torpaq işləri\r\n        <ul>\r\n            <li>1.1 Ankerlərin bərkidilməsi və binaların “torpaqda divar” üsulu ilə tikilməsi</li>\r\n            <li>1.2 Enmə quyularının və kessonların qurulması</li>\r\n        </ul>\r\n    </li>\r\n    <li>2. Beton və dəmir-beton konstruksiyaların quraşdırılması</li>\r\n    <li>3. Metal konstruksiyaların quraşdırılması</li>\r\n    <li>4. Ağac konstruksiyaların quraşdırılması</li>\r\n    <li>5. Fasad işləri</li>\r\n    <li>7. Mühəndis kommunikasiya və şəbəkələrinin qurulması işləri</li>\r\n    <li>8. Hidro-texniki işlər\r\n        <ul>\r\n            <li>8.1 Sualtı-texniki işlər</li>\r\n            <li>8.2 Dambaların (torpaq bəndələrin) tikintisi</li>\r\n            <li>8.3 Limanların tikintisi</li>\r\n            <li>8.4 Pirslərin tikintisi</li>\r\n            <li>8.5 Sahilbərkitmə işləri</li>\r\n            <li>8.6 Su anbarları</li>\r\n        </ul>\r\n    </li>\r\n    <li>9. Yol tikintisi\r\n        <ul>\r\n            <li>9.1 Avtomobil yolları</li>\r\n            <li>9.2 Aerodlamların uçuş-emmə zolaqları</li>\r\n            <li>9.3 Elektrik sərnişin nəqliyyat (tramvay,troleybus və hava-kanat ) xətləri yolları</li>\r\n            <li>9.5 Dəmiryol xətləri</li>\r\n        </ul>\r\n    </li>\r\n    <li>10. Körpülərin, estakandaların və yol ötürücülərin tikintisi</li>\r\n    <li>11. Xüsusi qurğuların tikintisi və quraşdırılması\r\n        <ul>\r\n            <li>11.3 Elektrik ötürücü xətləri</li>\r\n        </ul>\r\n    </li>\r\n    <li>12. Sənayə və mülki obyektlərin tikintisi\r\n        <ul>\r\n            <li>12.1 Aşırımı 24 metrədək</li>\r\n            <li>12.2 Aşırımı 24 metr və daha çox</li>\r\n            <li>12.3 Hündürlüyü 65 metrədək</li>\r\n            <li>12.4 Hündürlüyü 65 metr və daha çox</li>\r\n            <li>12.5 Tutumu 5 min nəfərədək</li>\r\n            <li>12.6 Tutumu 5 min və daha çox</li></ul></li></ul>', '', 'az'),
(92, 10, 'about', 'Şirkət haqqında', 'Şirkət haqqında', '', '', 'en'),
(93, 10, 'about', 'Şirkət haqqında', 'Şirkət haqqında', '', '', 'ru'),
(94, 8, 'cv', 'Vakansiya', '', '', '', 'az'),
(95, 8, 'cv', 'Vakansiya', '', '', '', 'en'),
(96, 8, 'cv', 'Vakansiya', '', '', '', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `cms_partners`
--

DROP TABLE IF EXISTS `cms_partners`;
CREATE TABLE `cms_partners` (
  `id` int(11) UNSIGNED NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `ordering` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_partners`
--

INSERT INTO `cms_partners` (`id`, `photo`, `ordering`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, 'partners-1-2810259.png', 1, 1, '2019-12-02 11:34:30', '2019-12-16 15:54:44', '2', '2'),
(2, 'partners-2-6980738.png', 2, 1, '2019-12-02 11:37:42', '2019-12-02 12:08:33', '2', '2'),
(3, 'partners-3-7856972.png', 4, 1, '2019-12-02 11:37:50', '2019-12-16 15:55:36', '2', '2'),
(4, 'partners-4-2008642.png', 3, 1, '2019-12-02 11:37:56', '2019-12-16 15:55:36', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_partners_text`
--

DROP TABLE IF EXISTS `cms_partners_text`;
CREATE TABLE `cms_partners_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `link` text,
  `text` longtext,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_partners_text`
--

INSERT INTO `cms_partners_text` (`id`, `p_id`, `title`, `subtitle`, `link`, `text`, `lang`) VALUES
(4, 2, 'HTM', '', '', NULL, 'az'),
(5, 2, 'HTM', '', '', NULL, 'en'),
(6, 2, 'HTM', '', '', NULL, 'ru'),
(22, 3, 'Megalink', '', 'http://megalink.az/', NULL, 'az'),
(23, 3, 'Megalink', '', 'http://megalink.az/', NULL, 'en'),
(24, 3, 'Megalink', '', 'http://megalink.az/', NULL, 'ru'),
(25, 4, 'SOCAR', '', 'http://socar.az/', NULL, 'az'),
(26, 4, 'SOCAR', '', 'http://socar.az/', NULL, 'en'),
(27, 4, 'SOCAR', '', 'http://socar.az/', NULL, 'ru'),
(31, 1, 'Fiber Net', '', 'http://www.fiber.net.az/', NULL, 'az'),
(32, 1, 'Fiber Net', '', 'http://www.fiber.net.az/', NULL, 'en'),
(33, 1, 'Fiber Net', '', 'http://www.fiber.net.az/', NULL, 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `cms_posts`
--

DROP TABLE IF EXISTS `cms_posts`;
CREATE TABLE `cms_posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_posts`
--

INSERT INTO `cms_posts` (`id`, `photo`, `post_date`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, 'news-1-4078289.jpg', '2019-12-01', 1, '2019-12-18 09:31:38', '2019-12-18 09:37:28', '2', '2'),
(2, 'news-2-1284679.jpg', '2019-12-02', 1, '2019-12-18 09:35:46', '2019-12-18 09:38:25', '2', '2'),
(3, 'news-3-9027113.jpg', '2016-11-27', 1, '2019-12-18 09:41:12', '2019-12-18 09:41:12', '2', '2'),
(4, 'news-4-6971917.jpg', '2019-12-04', 1, '2019-12-18 09:45:43', '2019-12-18 09:45:43', '2', '2'),
(5, 'news-5-3583456.jpeg', '2019-12-05', 1, '2019-12-18 09:47:20', '2019-12-18 09:47:20', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_posts_text`
--

DROP TABLE IF EXISTS `cms_posts_text`;
CREATE TABLE `cms_posts_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `text` longtext,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_posts_text`
--

INSERT INTO `cms_posts_text` (`id`, `p_id`, `title`, `subtitle`, `text`, `lang`) VALUES
(7, 1, '&quot;Azərikimya&quot; İB-nin “Etilen-polietilen” zavodu', '&quot;Azərikimya&quot; İB-nin “Etilen-polietilen” zavodunun 26 saylı “Su təchizatı, su soyutma və kanalizasiya” sahəsinin məşəl qurğusunun əsaslı təmiri işlərini başa çatdırılıb', '<p>\"Azərikimya\" İB-nin “Etilen-polietilen” zavodunun 26 saylı “Su təchizatı, su soyutma və kanalizasiya” sahəsinin məşəl qurğusunun əsaslı təmiri işləri başa çatdırılıb.</p><p><br /></p><p>H = 120m-lik məşəl qurğusunun əsaslı təmir zamanı görülən işlərin ardıcıllığı:</p><ul><li>Məşəl qülləsində metal səthlərin təmizlənməsi və rənglənməsi üçün 2 ədəd elektriklə işləyən səbətin quraşdırılması və istifadə edilməsi.</li><li>Məşəl qülləsində avadanlıqların, metal konstruksiyanın və boyaların qaldırılıb-endirilməsi üçün 2 ədəd yerdən idarə olunan elektriklə işləyən lebyotkanın quraşdırılması və istifadə edilməsi.</li><li>Məşələ qalxan pilləkən və xidməti meydançaların təmiri habelə xidmət meydançası və pilləkənin dəyişdirilən hissələrinin yerə endirilməsi, yeni quraşdırılacaq metal konstruksiyanın qaldırılması.</li><li>Məşəl qülləsində tac başlığının sökülüb yenisi ilə əvəz edilməsi, yəni 120m hündürlükdən sökülmüş tac başlığının yerə endirilməsi və yenidən 120m hündürlüyə qaldırılaraq quraşdırılma işlərinin görülməsi.</li><li>Məşələ gedən 12 atm buxar xəttinin sökülməsi və quraşdırılması.</li><li>Məşəl qülləsinin metal karkasının metal konstruksiyasının çürümüş yerlərinin dəyişdirilməsi, dəyişdirilən metal karkasın borularının yerə endirilməsi və yeni quraşdırılacaq boruların qaldırılması.</li><li>Məşəl qülləsində metalkonstruksiyasının və borularının səthinin korroziyadan və köhnə boyadan təmizlənməsi, 70 mikron qalınlığında Epoksi-Poliamid tərkibli qalın qat astar boya ilə rənglənməsi (Epoksi-Poliamid tərkibli qalın qat astar boya, sərtləşdirici və tiner daxil)</li><li>Məşəl qurğusunda metalkonstruksiyasının və borularının səthinin 2 qat ümumi qalınlığı 100 mikron olmaqla iki komponentli, Akrilik-Poliizosiyanat əsaslı çox parlaq qırmızı rəng sonqat boya ilə rənglənməsi (qırmızı və ağ rəng).</li></ul><p><br /></p><p><b>Sifarişçi: SOCAR “Azərkimya” İstehsalat Birliyi</b></p><div><br /></div>', 'az'),
(8, 1, '', '', '', 'en'),
(9, 1, '', '', '', 'ru'),
(16, 2, 'Metanol zavodunda yarımstansiya binasının damının təmir işləri', 'Metanol zavodunda yarımstansiya binasının damının təmir olunması', '<p>Socar-ın metanol zavodunda 35/6/0,4 kV-luq yarımstansiya binasında damın təmir olunması, membran izolə qatının istifadə olunması və sınaqdan keçirilmə mərhələsi.<br /></p>', 'az'),
(17, 2, '', '', '', 'en'),
(18, 2, '', '', '', 'ru'),
(19, 3, 'Gölməçələrin neft şlamından təmizlənməsi', 'Suraxanı, Sabunçu rayonları ərazisində gölməçələrin neft şlamından təmizlənməsi', '<p>Obyekt: Suraxanı, Sabunçu rayonları ərazisində gölməçələrin neft şlamından təmizlənməsi</p><p><br /></p><p>19 iyul 2016 ildən- 27 noyabr 2016 ilə kimi </p><p>İş həcmi – 350.000 m3</p><p>Gölməçələr- Layihə üzrə  № 2;4;5;8;9;13;14;19;20</p><p><br /></p><p>Suraxanı və Sabunçu rayonlarında ərazisində yerləşən Neft gölməçələrin şlamdan təmizlənməsi Layihəsi çərçivəsində “HTM HOLDİNQ” MMC qrafikə uyğun 4 ay ərzində işləri yüksək səviyyədə təşkil etmiş və bütün gölməçələrdən şlamı təmizləyərək yeni yaradılmış ümumi tutumu 500.000 m3 olan ümumi anbara daşınmışdır. Obyektlər qrafikə uyğun olaraq vaxtında və yüksək keyfiyyətlə sifarişçiyə təhvil verilmişdir.</p><p><br /></p><p>Sifarişçi: “AzNef İB”</p>', 'az'),
(20, 3, '', '', '', 'en'),
(21, 3, '', '', '', 'ru'),
(22, 4, 'Heydər Əliyev adına Hava limanına gedən avtomobil yolu', 'Drenaj sisteminin quraşdırılması', '<p>\"Heydər Əliyev adına Hava limanına gedən avtomobil yolunun Bakı olimpiya stadionunun qarşısından keçən hissəsində SOCAR-ın müəssisələrinə məxsus boru kəmərlərinin keçdiyi yeraltı tuneldə drenaj sisteminin quraşdırılması\" obyekti üzrə boru xətlərinin ətrafına metal qəfəsin quraşdırılma işləri başa çatdırılmışdır.</p><p><br /></p><p>Metal qəfəsin quraşdırılma işləri zamanı, metal karkasın vı dayaqların qurulması, metal çərçivələrin düzəldilməsi, çərçivələrdən qoruyucu konstruksiyanın qəfəsin düzəldilməsi, bünövrə altı torpağın götürülməsi və çınqıldan hazırlıq qatı, perimetr boyu çərçivələrin altının beton bünövrə kəmərin düzəldilməsi, metal konstruksiyaların pasdan təmizlənərək antipasla boyanması, sintetik yağlı boya ilə boyanması, metal çərçivəli torlu qapının düzəldilməsi və quraşdırılması və sahəyə qəfəsliyin içinə çınqıl qatının verilməsi(10sm) işləri qrafik üzrə vaxtında və keyfiyyətli şəkildə təhvil verilmişdir.<br /></p><p><br /></p><p><b>Sifarişçi: Heydər Əliyev adına Neft Emalı Zavodu</b><br /></p><div><br /></div>', 'az'),
(23, 4, '', '', '', 'en'),
(24, 4, '', '', '', 'ru'),
(25, 5, '“Azərkimya” İB-nin “Etilen-polietilen” zavodu', '“Azərkimya” İB-nin “Etilen-polietilen” zavodunun Etilen istehsalatının 1 saylı “Piroliz” sahəsində dəmir-beton tüstü borusunun rənglənməsi işləri başa çatdırılıb.', '<p>“Azərkimya” İB-nin “Etilen-polietilen” zavodunun Etilen istehsalatının 1 saylı “Piroliz” sahəsində dəmir-beton tüstü borusunun rənglənməsi işləri başa çatdırılıb.</p><p><br /></p><p>H=120m-lik dəmir-beton tüstü borusunda görülən işlərin ardıcıllığı:</p><ul><li>Dəmir-beton tüstü borusunun səthinin təmizlənməsi və boyanması üçün 2 ədəd elektrik səbətinin quraşdırılması.</li><li>Boyaların və alətlərin qaldırılıb-endirilməsi üçün 2 ədəd yerdən idarə olunan elektrik lebyotkanın quraşdırılması və istifadəsi.</li><li>Dəmir-beton tüstü borusunun səthinin yanmış və qopmuş köhnə emulsiya boyasından təmizlənərək nahamar vəziyyətə gətirilməsi.</li><li>Dəmir-beton tüstü borusunun səthində çatlamış və qopmuş hissələrin odadavamlı xüsusi suvaq məhlulu ilə suvaq olunması.</li><li>40 mikron qalınlığında epoksid qətran əsaslı astar qat boya ilə rənglənməsi.</li><li>120 mikron qalınlığında 2 dəfə akrilik poliüretan qətran əsaslı parlaq boya ilə rənglənməsi(ağ və qırmızı rənglər).</li><li>Xidməti meydançanın və məhəccərlərindəki köhnə boyanın qopmuş hissələrinin təmizlənməsi və 70 mikron qalınlığında xüsusi akrilik Epoksi-Poliamid tərkibli qrunt boya ilə rənglənməsi, həmçinin pilləkən və xidmət meydançasının metal konstruksiyalarının 2 qat ümumi qalınlığı 100 mikron olmaqla Akrilik-Poliizosiyanat əsaslı xüsusi akrilik qırmızı son qat boya ilə rənglənməsi.</li></ul><p><br /></p><p><b>Sifarişçi: SOCAR “Azərkimya” İstehsalat Birliyi</b></p>', 'az'),
(26, 5, '', '', '', 'en'),
(27, 5, '', '', '', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `cms_projects`
--

DROP TABLE IF EXISTS `cms_projects`;
CREATE TABLE `cms_projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `secret_id` varchar(50) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_projects`
--

INSERT INTO `cms_projects` (`id`, `secret_id`, `photo`, `post_date`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, '38a926a398f0c5c8f44ad2db76659ed4', NULL, '2019-11-01', 1, '2019-11-30 08:32:08', '2019-11-30 08:47:08', '2', '2'),
(2, '2db9c61a9de7b406e6d10556acddec5a', NULL, '2019-11-07', 1, '2019-11-30 08:40:15', '2019-11-30 08:46:41', '2', '2'),
(3, '386e141c749f5d7704bf157013c5324e', NULL, '2019-11-14', 1, '2019-11-30 08:46:30', '2019-11-30 08:48:33', '2', '2'),
(4, '56ef5d2a6e4a2006cca6c54188aba112', NULL, '2019-11-14', 1, '2019-11-30 08:57:21', '2019-11-30 08:58:47', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_projects_photo`
--

DROP TABLE IF EXISTS `cms_projects_photo`;
CREATE TABLE `cms_projects_photo` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` varchar(50) NOT NULL DEFAULT '0',
  `secret_id` varchar(50) DEFAULT NULL,
  `ordering` int(11) UNSIGNED NOT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_projects_photo`
--

INSERT INTO `cms_projects_photo` (`id`, `p_id`, `secret_id`, `ordering`, `thumb`, `photo`, `create_date`) VALUES
(1, '1', '38a926a398f0c5c8f44ad2db76659ed4', 1, '4f5031d53ff589046050bb4c43d711f21575088170-thumb.jpg', '4f5031d53ff589046050bb4c43d711f21575088170-photo.jpg', '2019-11-30 08:29:31'),
(2, '1', '38a926a398f0c5c8f44ad2db76659ed4', 2, '8f4f39af57a30c2476db3b7b21eb391e1575088171-thumb.jpg', '8f4f39af57a30c2476db3b7b21eb391e1575088171-photo.jpg', '2019-11-30 08:29:33'),
(3, '1', '38a926a398f0c5c8f44ad2db76659ed4', 3, '73f581684c7723e812692a34e14120721575088173-thumb.jpg', '73f581684c7723e812692a34e14120721575088173-photo.jpg', '2019-11-30 08:29:35'),
(4, '1', '38a926a398f0c5c8f44ad2db76659ed4', 4, 'b92c3fa5f514bf596c841658aaedf07d1575088194-thumb.jpg', 'b92c3fa5f514bf596c841658aaedf07d1575088194-photo.jpg', '2019-11-30 08:29:55'),
(5, '1', '38a926a398f0c5c8f44ad2db76659ed4', 5, 'e520eb73fee52e17ee636b58c36c22991575088195-thumb.jpg', 'e520eb73fee52e17ee636b58c36c22991575088195-photo.jpg', '2019-11-30 08:29:57'),
(6, '1', '38a926a398f0c5c8f44ad2db76659ed4', 6, '767c0a3ca64772833eef4645bceea5e71575088197-thumb.jpg', '767c0a3ca64772833eef4645bceea5e71575088197-photo.jpg', '2019-11-30 08:29:59'),
(7, '1', '38a926a398f0c5c8f44ad2db76659ed4', 7, '172415c4807cf8f71a9f43bf17b1b9211575088199-thumb.jpg', '172415c4807cf8f71a9f43bf17b1b9211575088199-photo.jpg', '2019-11-30 08:30:01'),
(8, '1', '38a926a398f0c5c8f44ad2db76659ed4', 8, 'ea85c62449b5ab5a690ec8d5940b7ee01575088201-thumb.jpg', 'ea85c62449b5ab5a690ec8d5940b7ee01575088201-photo.jpg', '2019-11-30 08:30:03'),
(9, '1', '38a926a398f0c5c8f44ad2db76659ed4', 9, '0b9d2a4e0bbfde879b9129a436627d751575088203-thumb.jpg', '0b9d2a4e0bbfde879b9129a436627d751575088203-photo.jpg', '2019-11-30 08:30:05'),
(10, '1', '38a926a398f0c5c8f44ad2db76659ed4', 10, '892b7f1533f1d696a760214843c314b01575088205-thumb.jpg', '892b7f1533f1d696a760214843c314b01575088205-photo.jpg', '2019-11-30 08:30:06'),
(11, '1', '38a926a398f0c5c8f44ad2db76659ed4', 11, '1f010c3943ba6b2dee51b8841e8cf9ec1575088206-thumb.jpg', '1f010c3943ba6b2dee51b8841e8cf9ec1575088206-photo.jpg', '2019-11-30 08:30:08'),
(12, '1', '38a926a398f0c5c8f44ad2db76659ed4', 12, '1717204027b016a80779185e2e6e07fa1575088230-thumb.jpg', '1717204027b016a80779185e2e6e07fa1575088230-photo.jpg', '2019-11-30 08:30:32'),
(13, '1', '38a926a398f0c5c8f44ad2db76659ed4', 13, 'b396a33ee90fea21312f386bd769f3ef1575088232-thumb.jpg', 'b396a33ee90fea21312f386bd769f3ef1575088232-photo.jpg', '2019-11-30 08:30:34'),
(14, '1', '38a926a398f0c5c8f44ad2db76659ed4', 14, 'bf7366f960f06df008e58b711e8c233b1575088234-thumb.jpg', 'bf7366f960f06df008e58b711e8c233b1575088234-photo.jpg', '2019-11-30 08:30:36'),
(15, '1', '38a926a398f0c5c8f44ad2db76659ed4', 15, '5979ed7da549c9057d6013b4e960d2381575088236-thumb.jpg', '5979ed7da549c9057d6013b4e960d2381575088236-photo.jpg', '2019-11-30 08:30:37'),
(16, '1', '38a926a398f0c5c8f44ad2db76659ed4', 16, '6e2b00f841df182f0e8f0e836c6cf2cf1575088263-thumb.jpg', '6e2b00f841df182f0e8f0e836c6cf2cf1575088263-photo.jpg', '2019-11-30 08:31:04'),
(17, '1', '38a926a398f0c5c8f44ad2db76659ed4', 17, 'a2e067f06d82594a55f32cefa74f5c2f1575088264-thumb.jpg', 'a2e067f06d82594a55f32cefa74f5c2f1575088264-photo.jpg', '2019-11-30 08:31:06'),
(18, '1', '38a926a398f0c5c8f44ad2db76659ed4', 18, '33e8a15d4c2322f27852dc1445d23f6a1575088266-thumb.jpg', '33e8a15d4c2322f27852dc1445d23f6a1575088266-photo.jpg', '2019-11-30 08:31:07'),
(19, '1', '38a926a398f0c5c8f44ad2db76659ed4', 19, '48034458757ff3782de31327790c1e511575088267-thumb.jpg', '48034458757ff3782de31327790c1e511575088267-photo.jpg', '2019-11-30 08:31:10'),
(20, '1', '38a926a398f0c5c8f44ad2db76659ed4', 20, '3d3b51e749f59dd1fbdf0dad0e75f7961575088270-thumb.jpg', '3d3b51e749f59dd1fbdf0dad0e75f7961575088270-photo.jpg', '2019-11-30 08:31:11'),
(21, '1', '38a926a398f0c5c8f44ad2db76659ed4', 21, '3045b2d439b850cde82a488e6dc9b14d1575088271-thumb.jpg', '3045b2d439b850cde82a488e6dc9b14d1575088271-photo.jpg', '2019-11-30 08:31:13'),
(22, '1', '38a926a398f0c5c8f44ad2db76659ed4', 22, 'd1049a3ec24fbd6a2db3c4f97f0a75011575088311-thumb.jpg', 'd1049a3ec24fbd6a2db3c4f97f0a75011575088311-photo.jpg', '2019-11-30 08:31:53'),
(23, '1', '38a926a398f0c5c8f44ad2db76659ed4', 23, 'bb75a8245aebb3ac24a4563ad0bab5d91575088313-thumb.jpg', 'bb75a8245aebb3ac24a4563ad0bab5d91575088313-photo.jpg', '2019-11-30 08:31:55'),
(24, '1', '38a926a398f0c5c8f44ad2db76659ed4', 24, '562e38b618396eddcdb607b173843fb61575088315-thumb.jpg', '562e38b618396eddcdb607b173843fb61575088315-photo.jpg', '2019-11-30 08:31:57'),
(25, '1', '38a926a398f0c5c8f44ad2db76659ed4', 25, '973eca9f4641859a2cd3a40afbaab2b11575088317-thumb.jpg', '973eca9f4641859a2cd3a40afbaab2b11575088317-photo.jpg', '2019-11-30 08:31:59'),
(26, '1', '38a926a398f0c5c8f44ad2db76659ed4', 26, '5a3df9b4928931d1706795e7829aebb01575088319-thumb.jpg', '5a3df9b4928931d1706795e7829aebb01575088319-photo.jpg', '2019-11-30 08:32:01'),
(27, '1', '38a926a398f0c5c8f44ad2db76659ed4', 27, 'c3608905cc4ba7ecad5b47e69613e0481575088321-thumb.jpg', 'c3608905cc4ba7ecad5b47e69613e0481575088321-photo.jpg', '2019-11-30 08:32:03'),
(28, '1', '38a926a398f0c5c8f44ad2db76659ed4', 28, 'd8dc1bfb375fce85caa187942d02a1f91575088323-thumb.jpg', 'd8dc1bfb375fce85caa187942d02a1f91575088323-photo.jpg', '2019-11-30 08:32:05'),
(29, '2', '2db9c61a9de7b406e6d10556acddec5a', 1, '7747916f0c241d58951e02a0cb55a7991575088756-thumb.jpg', '7747916f0c241d58951e02a0cb55a7991575088756-photo.jpg', '2019-11-30 08:39:18'),
(30, '2', '2db9c61a9de7b406e6d10556acddec5a', 2, '55095e1db5311148515b426432fc73f51575088758-thumb.jpg', '55095e1db5311148515b426432fc73f51575088758-photo.jpg', '2019-11-30 08:39:20'),
(31, '2', '2db9c61a9de7b406e6d10556acddec5a', 3, '78735de48cb1500a8a605664948e3b5f1575088760-thumb.jpg', '78735de48cb1500a8a605664948e3b5f1575088760-photo.jpg', '2019-11-30 08:39:22'),
(32, '2', '2db9c61a9de7b406e6d10556acddec5a', 4, '84437fc34417238e0da570e40025ddc31575088762-thumb.jpg', '84437fc34417238e0da570e40025ddc31575088762-photo.jpg', '2019-11-30 08:39:25'),
(33, '2', '2db9c61a9de7b406e6d10556acddec5a', 5, 'db8c66e1815c086b6323b61f26b1bd7a1575088765-thumb.jpg', 'db8c66e1815c086b6323b61f26b1bd7a1575088765-photo.jpg', '2019-11-30 08:39:27'),
(34, '2', '2db9c61a9de7b406e6d10556acddec5a', 6, 'b709d8ddbabaa51d246c4140e6be6e491575088767-thumb.jpg', 'b709d8ddbabaa51d246c4140e6be6e491575088767-photo.jpg', '2019-11-30 08:39:29'),
(35, '2', '2db9c61a9de7b406e6d10556acddec5a', 7, 'e89642cbfdac79ec673301d30b02d4331575088769-thumb.jpg', 'e89642cbfdac79ec673301d30b02d4331575088769-photo.jpg', '2019-11-30 08:39:31'),
(36, '2', '2db9c61a9de7b406e6d10556acddec5a', 8, '7e4fc14444b786dcf847fe947969e0021575088771-thumb.jpg', '7e4fc14444b786dcf847fe947969e0021575088771-photo.jpg', '2019-11-30 08:39:33'),
(37, '2', '2db9c61a9de7b406e6d10556acddec5a', 9, '5795be35f38f9e0dd0d282892f781dc11575088773-thumb.jpg', '5795be35f38f9e0dd0d282892f781dc11575088773-photo.jpg', '2019-11-30 08:39:35'),
(38, '2', '2db9c61a9de7b406e6d10556acddec5a', 10, '0e15418eb54834e971719fdb3a97c23b1575088775-thumb.jpg', '0e15418eb54834e971719fdb3a97c23b1575088775-photo.jpg', '2019-11-30 08:39:37'),
(39, '2', '2db9c61a9de7b406e6d10556acddec5a', 11, '0566f44b2e735b4decab21cd4b66e8b81575088791-thumb.jpg', '0566f44b2e735b4decab21cd4b66e8b81575088791-photo.jpg', '2019-11-30 08:39:53'),
(40, '2', '2db9c61a9de7b406e6d10556acddec5a', 12, '0e51c20a2f720c5d4b2c4cd93b17b03d1575088793-thumb.jpg', '0e51c20a2f720c5d4b2c4cd93b17b03d1575088793-photo.jpg', '2019-11-30 08:39:55'),
(41, '2', '2db9c61a9de7b406e6d10556acddec5a', 13, '796860ad6486701f01f777198a8f1f8a1575088795-thumb.jpg', '796860ad6486701f01f777198a8f1f8a1575088795-photo.jpg', '2019-11-30 08:39:57'),
(42, '2', '2db9c61a9de7b406e6d10556acddec5a', 14, '9a9c1fa1923850485e5bc575f8dc41a41575088797-thumb.jpg', '9a9c1fa1923850485e5bc575f8dc41a41575088797-photo.jpg', '2019-11-30 08:39:58'),
(43, '2', '2db9c61a9de7b406e6d10556acddec5a', 15, '8d5e43235f3ea0c2d89efb482a78ab811575088798-thumb.jpg', '8d5e43235f3ea0c2d89efb482a78ab811575088798-photo.jpg', '2019-11-30 08:40:00'),
(44, '2', '2db9c61a9de7b406e6d10556acddec5a', 16, 'aea877ccc4a002937d7c3d1c133877c41575088800-thumb.jpg', 'aea877ccc4a002937d7c3d1c133877c41575088800-photo.jpg', '2019-11-30 08:40:02'),
(45, '2', '2db9c61a9de7b406e6d10556acddec5a', 17, '26f76b561541537f61660d3d09f8c4831575088802-thumb.jpg', '26f76b561541537f61660d3d09f8c4831575088802-photo.jpg', '2019-11-30 08:40:04'),
(46, '2', '2db9c61a9de7b406e6d10556acddec5a', 18, '2e7345df7c2179ae92ebbd1ac3ed1dca1575088804-thumb.jpg', '2e7345df7c2179ae92ebbd1ac3ed1dca1575088804-photo.jpg', '2019-11-30 08:40:06'),
(47, '2', '2db9c61a9de7b406e6d10556acddec5a', 19, '2f144ccc356a50966ae5d4d534c9d7f81575088806-thumb.jpg', '2f144ccc356a50966ae5d4d534c9d7f81575088806-photo.jpg', '2019-11-30 08:40:08'),
(48, '2', '2db9c61a9de7b406e6d10556acddec5a', 20, '01e49774cdd55bd3d6876b4ac5b0479f1575088808-thumb.jpg', '01e49774cdd55bd3d6876b4ac5b0479f1575088808-photo.jpg', '2019-11-30 08:40:10'),
(49, '3', '386e141c749f5d7704bf157013c5324e', 1, '199ac3f60a14bcc6c13ac978144a24c01575089098-thumb.jpg', '199ac3f60a14bcc6c13ac978144a24c01575089098-photo.jpg', '2019-11-30 08:45:00'),
(50, '3', '386e141c749f5d7704bf157013c5324e', 2, '39368b8e007e977e8ea9149d4f8f6b6e1575089100-thumb.jpg', '39368b8e007e977e8ea9149d4f8f6b6e1575089100-photo.jpg', '2019-11-30 08:45:02'),
(51, '3', '386e141c749f5d7704bf157013c5324e', 3, '1007eac924e14d791b6117aac7a9d5201575089102-thumb.jpg', '1007eac924e14d791b6117aac7a9d5201575089102-photo.jpg', '2019-11-30 08:45:04'),
(52, '3', '386e141c749f5d7704bf157013c5324e', 4, '70c2149325c35d03615a9d01a0f7faa11575089104-thumb.jpg', '70c2149325c35d03615a9d01a0f7faa11575089104-photo.jpg', '2019-11-30 08:45:05'),
(53, '3', '386e141c749f5d7704bf157013c5324e', 5, '4f06ff3d50a7b7c8bbfadc9c49b8a82c1575089105-thumb.jpg', '4f06ff3d50a7b7c8bbfadc9c49b8a82c1575089105-photo.jpg', '2019-11-30 08:45:07'),
(54, '3', '386e141c749f5d7704bf157013c5324e', 6, 'd15353cacac852e63ce20a18679f904a1575089107-thumb.jpg', 'd15353cacac852e63ce20a18679f904a1575089107-photo.jpg', '2019-11-30 08:45:09'),
(55, '3', '386e141c749f5d7704bf157013c5324e', 7, '30998e38556c6b6c2ab023aafeb81eb11575089109-thumb.jpg', '30998e38556c6b6c2ab023aafeb81eb11575089109-photo.jpg', '2019-11-30 08:45:11'),
(56, '3', '386e141c749f5d7704bf157013c5324e', 8, '309c908c1671ca9ce42c69a0ccd570c01575089111-thumb.jpg', '309c908c1671ca9ce42c69a0ccd570c01575089111-photo.jpg', '2019-11-30 08:45:13'),
(57, '3', '386e141c749f5d7704bf157013c5324e', 9, '31f314fdb1c9080504e12832f4e5459d1575089126-thumb.jpg', '31f314fdb1c9080504e12832f4e5459d1575089126-photo.jpg', '2019-11-30 08:45:29'),
(58, '3', '386e141c749f5d7704bf157013c5324e', 10, '30e025e816963ee8494402bade0834ab1575089129-thumb.jpg', '30e025e816963ee8494402bade0834ab1575089129-photo.jpg', '2019-11-30 08:45:30'),
(59, '3', '386e141c749f5d7704bf157013c5324e', 11, '2dd938dbf699100cc6df3abaf30ab18d1575089130-thumb.jpg', '2dd938dbf699100cc6df3abaf30ab18d1575089130-photo.jpg', '2019-11-30 08:45:32'),
(60, '3', '386e141c749f5d7704bf157013c5324e', 12, '3f4af2625854d487890673eaf4055c3c1575089132-thumb.jpg', '3f4af2625854d487890673eaf4055c3c1575089132-photo.jpg', '2019-11-30 08:45:34'),
(61, '3', '386e141c749f5d7704bf157013c5324e', 13, '045d45ad676d323ea6151e573becbad11575089134-thumb.jpg', '045d45ad676d323ea6151e573becbad11575089134-photo.jpg', '2019-11-30 08:45:36'),
(62, '3', '386e141c749f5d7704bf157013c5324e', 14, 'fd014daefb904a3764310a347b30fbf71575089136-thumb.jpg', 'fd014daefb904a3764310a347b30fbf71575089136-photo.jpg', '2019-11-30 08:45:38'),
(63, '3', '386e141c749f5d7704bf157013c5324e', 15, '1f8a86dcf15e34f6c1d03aa749904dd41575089138-thumb.jpg', '1f8a86dcf15e34f6c1d03aa749904dd41575089138-photo.jpg', '2019-11-30 08:45:39'),
(64, '3', '386e141c749f5d7704bf157013c5324e', 16, 'bb3df5459117c7f91b6f021b92bb21601575089151-thumb.jpg', 'bb3df5459117c7f91b6f021b92bb21601575089151-photo.jpg', '2019-11-30 08:45:53'),
(65, '3', '386e141c749f5d7704bf157013c5324e', 17, '01d829a5f5adb45746696ecaa209adec1575089153-thumb.jpg', '01d829a5f5adb45746696ecaa209adec1575089153-photo.jpg', '2019-11-30 08:45:55'),
(66, '3', '386e141c749f5d7704bf157013c5324e', 18, 'bb5709596f65176e4384f0ec6b08ccea1575089155-thumb.jpg', 'bb5709596f65176e4384f0ec6b08ccea1575089155-photo.jpg', '2019-11-30 08:45:56'),
(67, '3', '386e141c749f5d7704bf157013c5324e', 19, '17bebccea4d879f6ce52fbfcb3a8eb941575089156-thumb.jpg', '17bebccea4d879f6ce52fbfcb3a8eb941575089156-photo.jpg', '2019-11-30 08:45:58'),
(68, '3', '386e141c749f5d7704bf157013c5324e', 20, '42cbd1c3a08d31249f360ea0fb802ec61575089158-thumb.jpg', '42cbd1c3a08d31249f360ea0fb802ec61575089158-photo.jpg', '2019-11-30 08:46:00'),
(69, '3', '386e141c749f5d7704bf157013c5324e', 21, 'f1a6b4d2e4b8e7c65565722103c610d21575089160-thumb.jpg', 'f1a6b4d2e4b8e7c65565722103c610d21575089160-photo.jpg', '2019-11-30 08:46:02'),
(70, '3', '386e141c749f5d7704bf157013c5324e', 22, '58e785e1090c1a30c1c252e3616859481575089162-thumb.jpg', '58e785e1090c1a30c1c252e3616859481575089162-photo.jpg', '2019-11-30 08:46:04'),
(71, '3', '386e141c749f5d7704bf157013c5324e', 23, '8e3538901a6e13c6dcfbf0be057f89a41575089175-thumb.jpg', '8e3538901a6e13c6dcfbf0be057f89a41575089175-photo.jpg', '2019-11-30 08:46:17'),
(72, '3', '386e141c749f5d7704bf157013c5324e', 24, 'b23adaf1fcd2e11dac8e1d37dc097f511575089177-thumb.jpg', 'b23adaf1fcd2e11dac8e1d37dc097f511575089177-photo.jpg', '2019-11-30 08:46:19'),
(73, '3', '386e141c749f5d7704bf157013c5324e', 25, '62e3901daff3d7aa8d6bfe4cbfd3b1e61575089179-thumb.jpg', '62e3901daff3d7aa8d6bfe4cbfd3b1e61575089179-photo.jpg', '2019-11-30 08:46:21'),
(74, '3', '386e141c749f5d7704bf157013c5324e', 26, '3ae96f4a05775876e71cf9ab1fcc6f801575089181-thumb.jpg', '3ae96f4a05775876e71cf9ab1fcc6f801575089181-photo.jpg', '2019-11-30 08:46:22'),
(75, '4', '56ef5d2a6e4a2006cca6c54188aba112', 1, '0c5d31d456c117c06c80e87ef46e6d0c1575089623-thumb.jpg', '0c5d31d456c117c06c80e87ef46e6d0c1575089623-photo.jpg', '2019-11-30 08:53:44'),
(76, '4', '56ef5d2a6e4a2006cca6c54188aba112', 2, '87a7c3faeaa7adc2788b9d5368ce10261575089639-thumb.jpg', '87a7c3faeaa7adc2788b9d5368ce10261575089639-photo.jpg', '2019-11-30 08:54:01'),
(77, '4', '56ef5d2a6e4a2006cca6c54188aba112', 3, 'c92c78e175f95334439718054fcfe6611575089641-thumb.jpg', 'c92c78e175f95334439718054fcfe6611575089641-photo.jpg', '2019-11-30 08:54:03'),
(78, '4', '56ef5d2a6e4a2006cca6c54188aba112', 4, '9faacd9266e88cf053577db2e140ad981575089643-thumb.jpg', '9faacd9266e88cf053577db2e140ad981575089643-photo.jpg', '2019-11-30 08:54:04'),
(79, '4', '56ef5d2a6e4a2006cca6c54188aba112', 5, 'f9b9ab0550894be5bad9e093d5ad21d11575089644-thumb.jpg', 'f9b9ab0550894be5bad9e093d5ad21d11575089644-photo.jpg', '2019-11-30 08:54:06'),
(80, '4', '56ef5d2a6e4a2006cca6c54188aba112', 6, 'ba7f26bdad4abb291f195a10e35d70d01575089646-thumb.jpg', 'ba7f26bdad4abb291f195a10e35d70d01575089646-photo.jpg', '2019-11-30 08:54:07'),
(81, '4', '56ef5d2a6e4a2006cca6c54188aba112', 7, 'fecfab26a2ae215f1f0e52ffeca9442f1575089647-thumb.jpg', 'fecfab26a2ae215f1f0e52ffeca9442f1575089647-photo.jpg', '2019-11-30 08:54:09'),
(82, '4', '56ef5d2a6e4a2006cca6c54188aba112', 8, '28da284bc2e0df289d3196fc192e75681575089649-thumb.jpg', '28da284bc2e0df289d3196fc192e75681575089649-photo.jpg', '2019-11-30 08:54:10'),
(83, '4', '56ef5d2a6e4a2006cca6c54188aba112', 9, '1d56a2b4480ac83af7aff4de102d7abd1575089650-thumb.jpg', '1d56a2b4480ac83af7aff4de102d7abd1575089650-photo.jpg', '2019-11-30 08:54:12'),
(84, '4', '56ef5d2a6e4a2006cca6c54188aba112', 10, '0456a257d1e1115223c6c2b8b73e35241575089652-thumb.jpg', '0456a257d1e1115223c6c2b8b73e35241575089652-photo.jpg', '2019-11-30 08:54:13'),
(85, '4', '56ef5d2a6e4a2006cca6c54188aba112', 11, 'bff1ede2cbe5a9751083409122752e861575089667-thumb.jpg', 'bff1ede2cbe5a9751083409122752e861575089667-photo.jpg', '2019-11-30 08:54:28'),
(86, '4', '56ef5d2a6e4a2006cca6c54188aba112', 12, 'ef5fbe5d41a3e8e51699b64c202c081e1575089668-thumb.jpg', 'ef5fbe5d41a3e8e51699b64c202c081e1575089668-photo.jpg', '2019-11-30 08:54:30'),
(87, '4', '56ef5d2a6e4a2006cca6c54188aba112', 13, '075807bec2ebf96485ec54e7b07d5ffa1575089670-thumb.jpg', '075807bec2ebf96485ec54e7b07d5ffa1575089670-photo.jpg', '2019-11-30 08:54:31'),
(88, '4', '56ef5d2a6e4a2006cca6c54188aba112', 14, 'd829012b848b0d67af6c09e79352d1231575089671-thumb.jpg', 'd829012b848b0d67af6c09e79352d1231575089671-photo.jpg', '2019-11-30 08:54:33'),
(89, '4', '56ef5d2a6e4a2006cca6c54188aba112', 15, '43efce0d0878c7e86f42ebcece9a5c5f1575089673-thumb.jpg', '43efce0d0878c7e86f42ebcece9a5c5f1575089673-photo.jpg', '2019-11-30 08:54:34'),
(90, '4', '56ef5d2a6e4a2006cca6c54188aba112', 16, 'ee4cc26ebe1935d912dd4a73db0e535e1575089674-thumb.jpg', 'ee4cc26ebe1935d912dd4a73db0e535e1575089674-photo.jpg', '2019-11-30 08:54:36'),
(91, '4', '56ef5d2a6e4a2006cca6c54188aba112', 17, '6532842875c705cd0268e9bc4052f06e1575089676-thumb.jpg', '6532842875c705cd0268e9bc4052f06e1575089676-photo.jpg', '2019-11-30 08:54:37'),
(92, '4', '56ef5d2a6e4a2006cca6c54188aba112', 18, '6bd3fa59b3434b9fc839ba26eadd08f61575089677-thumb.jpg', '6bd3fa59b3434b9fc839ba26eadd08f61575089677-photo.jpg', '2019-11-30 08:54:39'),
(93, '4', '56ef5d2a6e4a2006cca6c54188aba112', 19, 'b585658ce9918a92a42cd399989909261575089693-thumb.jpg', 'b585658ce9918a92a42cd399989909261575089693-photo.jpg', '2019-11-30 08:54:55'),
(94, '4', '56ef5d2a6e4a2006cca6c54188aba112', 20, '11d140e32c8db6d6e8ddd94788aad7491575089695-thumb.jpg', '11d140e32c8db6d6e8ddd94788aad7491575089695-photo.jpg', '2019-11-30 08:54:57'),
(95, '4', '56ef5d2a6e4a2006cca6c54188aba112', 21, '31b6105d0d114f6b10817eedbf8e89fb1575089697-thumb.jpg', '31b6105d0d114f6b10817eedbf8e89fb1575089697-photo.jpg', '2019-11-30 08:54:58'),
(96, '4', '56ef5d2a6e4a2006cca6c54188aba112', 22, 'f46d9f29021c9b7f2cc77ef216b767331575089698-thumb.jpg', 'f46d9f29021c9b7f2cc77ef216b767331575089698-photo.jpg', '2019-11-30 08:55:00'),
(97, '4', '56ef5d2a6e4a2006cca6c54188aba112', 23, '22cfd998baf80d34d1b4c649307140161575089700-thumb.jpg', '22cfd998baf80d34d1b4c649307140161575089700-photo.jpg', '2019-11-30 08:55:01'),
(98, '4', '56ef5d2a6e4a2006cca6c54188aba112', 24, '2bb0d4e96e54ceb9c882c323e813361d1575089701-thumb.jpg', '2bb0d4e96e54ceb9c882c323e813361d1575089701-photo.jpg', '2019-11-30 08:55:03'),
(99, '4', '56ef5d2a6e4a2006cca6c54188aba112', 25, '4e7dc4ec6eec1f5c49ddc79e012967e21575089703-thumb.jpg', '4e7dc4ec6eec1f5c49ddc79e012967e21575089703-photo.jpg', '2019-11-30 08:55:04'),
(100, '4', '56ef5d2a6e4a2006cca6c54188aba112', 26, '72821760f9957c20decb13e6b30270091575089704-thumb.jpg', '72821760f9957c20decb13e6b30270091575089704-photo.jpg', '2019-11-30 08:55:06'),
(101, '4', '56ef5d2a6e4a2006cca6c54188aba112', 27, '06a6fb298eb2a19349949a819ad88fe91575089706-thumb.jpg', '06a6fb298eb2a19349949a819ad88fe91575089706-photo.jpg', '2019-11-30 08:55:07'),
(102, '4', '56ef5d2a6e4a2006cca6c54188aba112', 28, 'ccef380e4fd4fe70e1294d1108ea5af71575089707-thumb.jpg', 'ccef380e4fd4fe70e1294d1108ea5af71575089707-photo.jpg', '2019-11-30 08:55:09'),
(103, '4', '56ef5d2a6e4a2006cca6c54188aba112', 29, '901c0ff7783c6e5c52aefa787af3ed051575089729-thumb.jpg', '901c0ff7783c6e5c52aefa787af3ed051575089729-photo.jpg', '2019-11-30 08:55:31'),
(104, '4', '56ef5d2a6e4a2006cca6c54188aba112', 30, '773c72e9bd51a6ffc08a4c74d80b10661575089731-thumb.jpg', '773c72e9bd51a6ffc08a4c74d80b10661575089731-photo.jpg', '2019-11-30 08:55:32'),
(105, '4', '56ef5d2a6e4a2006cca6c54188aba112', 31, 'ef20b2c0aab431166315eb97334f62ae1575089732-thumb.jpg', 'ef20b2c0aab431166315eb97334f62ae1575089732-photo.jpg', '2019-11-30 08:55:34'),
(106, '4', '56ef5d2a6e4a2006cca6c54188aba112', 32, '5ef7e933866878577b36b56e4c4c51991575089734-thumb.jpg', '5ef7e933866878577b36b56e4c4c51991575089734-photo.jpg', '2019-11-30 08:55:35'),
(107, '4', '56ef5d2a6e4a2006cca6c54188aba112', 33, 'b5c092b3f97b2ac1a5c3a0d75198e2831575089735-thumb.jpg', 'b5c092b3f97b2ac1a5c3a0d75198e2831575089735-photo.jpg', '2019-11-30 08:55:37'),
(108, '4', '56ef5d2a6e4a2006cca6c54188aba112', 34, '2e4731b12bd9ff8a53fa8565d2a71c7f1575089737-thumb.jpg', '2e4731b12bd9ff8a53fa8565d2a71c7f1575089737-photo.jpg', '2019-11-30 08:55:38'),
(109, '4', '56ef5d2a6e4a2006cca6c54188aba112', 35, 'ab274a307c6e93aa891a8e3fdc4563101575089738-thumb.jpg', 'ab274a307c6e93aa891a8e3fdc4563101575089738-photo.jpg', '2019-11-30 08:55:40'),
(110, '4', '56ef5d2a6e4a2006cca6c54188aba112', 36, '0b17e6f2429acd8e5732601da9a4f74f1575089740-thumb.jpg', '0b17e6f2429acd8e5732601da9a4f74f1575089740-photo.jpg', '2019-11-30 08:55:41'),
(111, '4', '56ef5d2a6e4a2006cca6c54188aba112', 37, '3736ef96db42bc03d8d7cf6b3f86efae1575089741-thumb.jpg', '3736ef96db42bc03d8d7cf6b3f86efae1575089741-photo.jpg', '2019-11-30 08:55:43'),
(112, '4', '56ef5d2a6e4a2006cca6c54188aba112', 38, '8565167164c0fa9f38fbac1a58f1bc9f1575089743-thumb.jpg', '8565167164c0fa9f38fbac1a58f1bc9f1575089743-photo.jpg', '2019-11-30 08:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `cms_projects_text`
--

DROP TABLE IF EXISTS `cms_projects_text`;
CREATE TABLE `cms_projects_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `text` longtext,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_projects_text`
--

INSERT INTO `cms_projects_text` (`id`, `p_id`, `title`, `subtitle`, `text`, `lang`) VALUES
(10, 2, 'SOCAR-ın Metanol Zavodunun yarımstansiya binasının damının təmir', NULL, '<p>SOCAR-ın Metanol Zavodunda 35/6/0,4 kV-luq yarımstansiya binasının damının təmir işləri</p><p><b>Sifarişçi:</b> Azərbaycan Dövlət Neft Şirkətinin “Metanol Zavodu”</p>', 'az'),
(11, 2, '', NULL, '', 'en'),
(12, 2, '', NULL, '', 'ru'),
(16, 1, '“Su təchizatı, su soyutma və kanalizasiya” sahəsinin məşəl qurğusunun əsaslı təmiri', NULL, '<p>\"Azərikimya\" İB-nin “Etilen-polietilen” zavodunun 26 saylı “Su təchizatı, su soyutma və kanalizasiya” sahəsinin məşəl qurğusunun əsaslı təmiri işlərinin LOT 3 </p><p><b>Sifarişçi:</b> SOCAR “Azərkimya” İstehsalat Birliyi</p>', 'az'),
(17, 1, '', NULL, '', 'en'),
(18, 1, '', NULL, '', 'ru'),
(25, 3, '“Etilen-polietilen” zavodunun dəmir-beton tüstü borusunun rənglənməsi', NULL, '<p>\"Azərikimya\" İB-nin \"Etilen-polietilen\" zavodunun Etilen istehsalatının 1 saylı \"Piroliz\" sahəsinndə dəmir-beton tüstü borusunun rənglənməsi işləri LOT 4</p><p><b>Sifarişçi: </b>SOCAR “Azərkimya” İstehsalat Birliyi </p><p>Hündürlüyü 120 metr olan dəmir-beton tüstü borusunun səthinin yanmış və qopmuş köhnə emulsiya boyasından, və həmçinin səthinin təmizlənməsi, dəmir-beton tüstü borusunun səthinin çatlamış və qopmuş hissələrinin odadavamlı xüsusi suvaq məhlulu ilə suvaq olunması, tüstü borusunda pilləkən və xidməti meydançaların metal konstruksiyasının təmiri, xüsusi akrilik Epoksi-Poliamid tərkibli qrunt boya və  Akrilik poliüretan qətran əsaslı ağ və qırmızı rəng boya ilə rənglənməsi.</p><p>Dəmir-beton tüstü borusuna aid bütün işlər qrafik üzrə tam vaxtında və keyfiyyətli başa çatdırılmışdır.</p>', 'az'),
(26, 3, '', NULL, '', 'en'),
(27, 3, '', NULL, '', 'ru'),
(31, 4, 'Yeraltı tuneldə drenaj sisteminin quraşdırılması', NULL, '<p>Heydər Əliyev adına Hava limanına gedən avtomobil yolunun Bakı olimpiya stadionunun qarşısından keçən hissəsində SOCAR-ın müəssisələrinə məxsus boru kəmərlərinin keçdiyi yeraltı tuneldə drenaj sisteminin quraşdırılması obyekti üzrə boru xətlərinin ətrafına metal qəfəsin quraşdırılma işləri</p><p><b>Sifarişçi:</b> Heydər Əliyev adına Neft Emalı Zavodu</p>', 'az'),
(32, 4, '', NULL, '', 'en'),
(33, 4, '', NULL, '', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `cms_settings`
--

DROP TABLE IF EXISTS `cms_settings`;
CREATE TABLE `cms_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_settings`
--

INSERT INTO `cms_settings` (`id`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, 1, '2019-11-19 11:26:04', '2019-11-26 09:37:58', '2', '2'),
(2, 1, '2019-11-19 11:26:29', '2019-11-19 11:26:29', '2', '2'),
(3, 1, '2019-11-19 11:26:51', '2019-11-19 11:26:51', '2', '2'),
(4, 1, '2019-11-26 10:26:36', '2019-11-26 10:28:18', '2', '2'),
(5, 1, '2019-11-26 10:28:45', '2019-11-26 10:53:02', '2', '2'),
(6, 1, '2019-11-26 10:29:47', '2019-11-26 10:29:47', '2', '2'),
(7, 1, '2019-12-16 17:15:54', '2019-12-16 17:26:10', '2', '2'),
(8, 1, '2019-12-16 17:25:29', '2019-12-17 12:54:28', '2', '2'),
(9, 1, '2019-12-16 17:30:08', '2019-12-16 17:30:08', '2', '2'),
(10, 1, '2019-12-16 17:30:32', '2019-12-16 17:30:32', '2', '2'),
(11, 1, '2019-12-16 17:31:00', '2019-12-16 17:31:00', '2', '2'),
(12, 1, '2019-12-16 17:37:08', '2019-12-16 17:37:08', '2', '2'),
(13, 1, '2019-12-17 15:39:59', '2019-12-17 15:39:59', '2', '2'),
(14, 1, '2019-12-17 15:40:22', '2019-12-17 15:40:22', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_settings_text`
--

DROP TABLE IF EXISTS `cms_settings_text`;
CREATE TABLE `cms_settings_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_settings_text`
--

INSERT INTO `cms_settings_text` (`id`, `p_id`, `title`, `text`, `lang`) VALUES
(4, 2, 'Description AZ', 'Description', 'az'),
(5, 2, 'Description EN', 'Description', 'en'),
(6, 2, 'Description RU', 'Description', 'ru'),
(7, 3, 'Keywords AZ', 'Keywords', 'az'),
(8, 3, 'Keywords EN', 'Keywords', 'en'),
(9, 3, 'Keywords RU', 'Keywords', 'ru'),
(10, 1, 'Title AZ', 'SHALSET GROUP', 'az'),
(11, 1, 'Title EN', 'SHALSET GROUP', 'en'),
(12, 1, 'Title RU', 'SHALSET GROUP', 'ru'),
(16, 4, 'Telefon nömrəsi (Header)', '+994 12 493 36 84', 'az'),
(17, 4, 'Telefon nömrəsi (Header)', '+994 12 493 36 84', 'en'),
(18, 4, 'Telefon nömrəsi (Header)', '+994 12 493 36 84', 'ru'),
(22, 6, 'Ünvan (Header)', 'Bakı, Nizami küç. 196', 'az'),
(23, 6, 'Ünvan (Header)', 'Bakı, Nizami küç. 196', 'en'),
(24, 6, 'Ünvan (Header)', 'Bakı, Nizami küç. 196', 'ru'),
(25, 5, 'İş saatları (Header)', 'Baz. ert. - Cümə 09:00 - 18:00', 'az'),
(26, 5, 'İş saatları (Header)', 'Baz. ert. - Cümə 09:00 - 18:00', 'en'),
(27, 5, 'İş saatları (Header)', 'Baz. ert. - Cümə 09:00 - 18:00', 'ru'),
(37, 7, 'Footer text', 'Shalset Group MMC tikinti sektorunda Azərbaycan Respublikasının qanunvericiliyinə uyğun fəaliyyət göstərən tikinti şirkətidir.', 'az'),
(38, 7, 'Footer text', 'Shalset Group MMC tikinti sektorunda Azərbaycan Respublikasının qanunvericiliyinə uyğun fəaliyyət göstərən və bu sektorda özünü keyfiyyətli işlərlə doğrultmuş tikinti şirkətidir.', 'en'),
(39, 7, 'Footer text', 'Shalset Group MMC tikinti sektorunda Azərbaycan Respublikasının qanunvericiliyinə uyğun fəaliyyət göstərən və bu sektorda özünü keyfiyyətli işlərlə doğrultmuş tikinti şirkətidir.', 'ru'),
(40, 9, 'Social icon - Facebook', 'https://www.facebook.com/', 'az'),
(41, 9, 'Social icon - Facebook', 'https://www.facebook.com/', 'en'),
(42, 9, 'Social icon - Facebook', 'https://www.facebook.com/', 'ru'),
(43, 10, 'Social icon - Twiiter', 'https://twitter.com/', 'az'),
(44, 10, 'Social icon - Twiiter', 'https://twitter.com/', 'en'),
(45, 10, 'Social icon - Twiiter', 'https://twitter.com/', 'ru'),
(46, 11, 'Social icon - Instagram', 'https://www.instagram.com', 'az'),
(47, 11, 'Social icon - Instagram', 'https://www.instagram.com', 'en'),
(48, 11, 'Social icon - Instagram', 'https://www.instagram.com', 'ru'),
(49, 12, 'Contact Map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.447193094151!2d49.85063421525909!3d40.37678036599235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307da9b5ec7de9%3A0x5079e7588be4885a!2zMTk2IE5pemFtaSBLw7zDp8mZc2ksIEJha8SxLCBBemVyYmFpamFu!5e0!3m2!1sen!2s!4v1576503365336!5m2!1sen!2s', 'az'),
(50, 12, 'Contact Map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.447193094151!2d49.85063421525909!3d40.37678036599235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307da9b5ec7de9%3A0x5079e7588be4885a!2zMTk2IE5pemFtaSBLw7zDp8mZc2ksIEJha8SxLCBBemVyYmFpamFu!5e0!3m2!1sen!2s!4v1576503365336!5m2!1sen!2s', 'en'),
(51, 12, 'Contact Map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.447193094151!2d49.85063421525909!3d40.37678036599235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307da9b5ec7de9%3A0x5079e7588be4885a!2zMTk2IE5pemFtaSBLw7zDp8mZc2ksIEJha8SxLCBBemVyYmFpamFu!5e0!3m2!1sen!2s!4v1576503365336!5m2!1sen!2s', 'ru'),
(52, 8, 'Email', 'info@example.com', 'az'),
(53, 8, 'Email', 'info@example.com', 'en'),
(54, 8, 'Email', 'info@example.com', 'ru'),
(55, 13, 'Contact form email', 'f.movlamov@gmail.com', 'az'),
(56, 13, 'Contact form email', 'f.movlamov@gmail.com', 'en'),
(57, 13, 'Contact form email', 'f.movlamov@gmail.com', 'ru'),
(58, 14, 'CV form email', 'f.movlamov@gmail.com', 'az'),
(59, 14, 'CV form email', 'f.movlamov@gmail.com', 'en'),
(60, 14, 'CV form email', 'f.movlamov@gmail.com', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `cms_slider`
--

DROP TABLE IF EXISTS `cms_slider`;
CREATE TABLE `cms_slider` (
  `id` int(11) UNSIGNED NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `ordering` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_slider`
--

INSERT INTO `cms_slider` (`id`, `photo`, `ordering`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, 'slider-1-8048051.jpg', 2, 1, '2019-11-27 10:41:19', '2019-11-27 12:24:17', '2', '2'),
(2, 'slider-2-2820800.jpg', 1, 1, '2019-11-27 10:42:22', '2019-12-16 15:52:11', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_slider_text`
--

DROP TABLE IF EXISTS `cms_slider_text`;
CREATE TABLE `cms_slider_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `link` text,
  `text` longtext,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_slider_text`
--

INSERT INTO `cms_slider_text` (`id`, `p_id`, `title`, `subtitle`, `link`, `text`, `lang`) VALUES
(7, 1, 'Damın təmir olunması', 'Metanol', 'http://shalsetgroup.local/az/projects', NULL, 'az'),
(8, 1, '', '', '', NULL, 'en'),
(9, 1, '', '', '', NULL, 'ru'),
(13, 2, 'Neft gölməçələrin', 'şlamdan təmizlənməsi', '', NULL, 'az'),
(14, 2, '', '', '', NULL, 'en'),
(15, 2, '', '', '', NULL, 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `cms_staff`
--

DROP TABLE IF EXISTS `cms_staff`;
CREATE TABLE `cms_staff` (
  `id` int(11) UNSIGNED NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `ordering` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `creator_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `deleted` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_staff`
--

INSERT INTO `cms_staff` (`id`, `photo`, `ordering`, `creator_id`, `create_date`, `update_date`, `status`, `deleted`) VALUES
(1, 'staff-1-5619665.jpeg', 1, 1, '2019-12-16 15:36:01', '2019-12-16 15:48:31', '2', '2'),
(2, 'staff-2-4752093.jpeg', 2, 1, '2019-12-16 15:38:24', '2019-12-16 15:48:31', '2', '2'),
(3, 'staff-3-7453668.jpeg', 3, 1, '2019-12-16 15:39:12', '2019-12-16 15:39:12', '2', '2'),
(4, 'staff-4-7890485.jpeg', 4, 1, '2019-12-16 15:39:33', '2019-12-16 15:39:33', '2', '2'),
(5, 'staff-5-2248103.jpeg', 5, 1, '2019-12-16 15:39:47', '2019-12-16 15:39:47', '2', '2'),
(6, 'staff-6-7604072.jpeg', 6, 1, '2019-12-16 15:40:02', '2019-12-16 15:40:02', '2', '2'),
(7, 'staff-7-3438410.jpeg', 7, 1, '2019-12-16 15:40:17', '2019-12-16 15:40:17', '2', '2'),
(8, 'staff-8-1362206.jpeg', 8, 1, '2019-12-16 15:40:29', '2019-12-16 15:41:35', '2', '2'),
(9, 'staff-9-9380920.jpeg', 9, 1, '2019-12-16 15:40:45', '2019-12-16 15:41:35', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `cms_staff_text`
--

DROP TABLE IF EXISTS `cms_staff_text`;
CREATE TABLE `cms_staff_text` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `text` longtext,
  `lang` enum('az','ru','en') NOT NULL DEFAULT 'az'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cms_staff_text`
--

INSERT INTO `cms_staff_text` (`id`, `p_id`, `title`, `subtitle`, `position`, `text`, `lang`) VALUES
(4, 2, 'Tayıbov Şahbaz', '', 'Baş mühəndis', NULL, 'az'),
(5, 2, '', '', '', NULL, 'en'),
(6, 2, '', '', '', NULL, 'ru'),
(10, 3, 'Muxtarov Murad', '', 'Memar Dizayner', NULL, 'az'),
(11, 3, '', '', '', NULL, 'en'),
(12, 3, '', '', '', NULL, 'ru'),
(13, 4, 'Süleymanov Elman', '', 'ƏMTT', NULL, 'az'),
(14, 4, '', '', '', NULL, 'en'),
(15, 4, '', '', '', NULL, 'ru'),
(16, 5, 'Nurullayev Rasim', '', 'Layihə rəhbəri', NULL, 'az'),
(17, 5, '', '', '', NULL, 'en'),
(18, 5, '', '', '', NULL, 'ru'),
(19, 6, 'Yaqubov Rafail', '', 'Sahə rəisi', NULL, 'az'),
(20, 6, '', '', '', NULL, 'en'),
(21, 6, '', '', '', NULL, 'ru'),
(22, 7, 'Babayeva Fatimə', '', 'Ofis-meneceri', NULL, 'az'),
(23, 7, '', '', '', NULL, 'en'),
(24, 7, '', '', '', NULL, 'ru'),
(25, 8, 'Bağırov Zaur', '', 'Təchizat', NULL, 'az'),
(26, 8, '', '', '', NULL, 'en'),
(27, 8, '', '', '', NULL, 'ru'),
(34, 9, 'Həmidov Səlahəddin', '', 'İş icraçısı', NULL, 'az'),
(35, 9, '', '', '', NULL, 'en'),
(36, 9, '', '', '', NULL, 'ru'),
(40, 1, 'Verdiyeva Şəlalə', '', 'Direktor müavini', NULL, 'az'),
(41, 1, '', '', '', NULL, 'en'),
(42, 1, '', '', '', NULL, 'ru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_admins`
--
ALTER TABLE `cms_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_password` (`login`,`password`),
  ADD KEY `status` (`status`),
  ADD KEY `deleted` (`deleted`);

--
-- Indexes for table `cms_admin_antibrut`
--
ALTER TABLE `cms_admin_antibrut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_certificates`
--
ALTER TABLE `cms_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_certificates_photo`
--
ALTER TABLE `cms_certificates_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `secret_id` (`secret_id`);

--
-- Indexes for table `cms_certificates_text`
--
ALTER TABLE `cms_certificates_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `cms_contact`
--
ALTER TABLE `cms_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`);

--
-- Indexes for table `cms_cv`
--
ALTER TABLE `cms_cv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`);

--
-- Indexes for table `cms_galleryphoto`
--
ALTER TABLE `cms_galleryphoto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_galleryphoto_photo`
--
ALTER TABLE `cms_galleryphoto_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `secret_id` (`secret_id`);

--
-- Indexes for table `cms_galleryphoto_text`
--
ALTER TABLE `cms_galleryphoto_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `cms_langwords`
--
ALTER TABLE `cms_langwords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`),
  ADD KEY `status` (`status`),
  ADD KEY `deleted` (`deleted`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_pages_text`
--
ALTER TABLE `cms_pages_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `cms_partners`
--
ALTER TABLE `cms_partners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_partners_text`
--
ALTER TABLE `cms_partners_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `cms_posts`
--
ALTER TABLE `cms_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_posts_text`
--
ALTER TABLE `cms_posts_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `cms_projects`
--
ALTER TABLE `cms_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_projects_photo`
--
ALTER TABLE `cms_projects_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `secret_id` (`secret_id`);

--
-- Indexes for table `cms_projects_text`
--
ALTER TABLE `cms_projects_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `cms_settings`
--
ALTER TABLE `cms_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_settings_text`
--
ALTER TABLE `cms_settings_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `cms_slider`
--
ALTER TABLE `cms_slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_slider_text`
--
ALTER TABLE `cms_slider_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `cms_staff`
--
ALTER TABLE `cms_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_staff_text`
--
ALTER TABLE `cms_staff_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`),
  ADD KEY `p_id` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_admins`
--
ALTER TABLE `cms_admins`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_admin_antibrut`
--
ALTER TABLE `cms_admin_antibrut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_certificates`
--
ALTER TABLE `cms_certificates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_certificates_photo`
--
ALTER TABLE `cms_certificates_photo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cms_certificates_text`
--
ALTER TABLE `cms_certificates_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cms_contact`
--
ALTER TABLE `cms_contact`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_cv`
--
ALTER TABLE `cms_cv`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_galleryphoto`
--
ALTER TABLE `cms_galleryphoto`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms_galleryphoto_photo`
--
ALTER TABLE `cms_galleryphoto_photo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cms_galleryphoto_text`
--
ALTER TABLE `cms_galleryphoto_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `cms_langwords`
--
ALTER TABLE `cms_langwords`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cms_pages_text`
--
ALTER TABLE `cms_pages_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `cms_partners`
--
ALTER TABLE `cms_partners`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms_partners_text`
--
ALTER TABLE `cms_partners_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cms_posts`
--
ALTER TABLE `cms_posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms_posts_text`
--
ALTER TABLE `cms_posts_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cms_projects`
--
ALTER TABLE `cms_projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms_projects_photo`
--
ALTER TABLE `cms_projects_photo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `cms_projects_text`
--
ALTER TABLE `cms_projects_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cms_settings`
--
ALTER TABLE `cms_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cms_settings_text`
--
ALTER TABLE `cms_settings_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `cms_slider`
--
ALTER TABLE `cms_slider`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_slider_text`
--
ALTER TABLE `cms_slider_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cms_staff`
--
ALTER TABLE `cms_staff`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cms_staff_text`
--
ALTER TABLE `cms_staff_text`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
