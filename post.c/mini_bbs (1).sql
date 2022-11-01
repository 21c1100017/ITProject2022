-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-10-22 11:28:53
-- サーバのバージョン： 10.4.25-MariaDB
-- PHP のバージョン: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

//ダンプは入れなくてもいい。西島


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `mini_bbs`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `follow`
--

INSERT INTO `follow` (`id`, `follow_id`, `follower_id`, `created_at`) VALUES
(66, 8, 9, '2022-10-22 16:38:10'),
(69, 5, 9, '2022-10-22 16:38:19'),
(73, 1, 9, '2022-10-22 18:06:45'),
(74, 2, 9, '2022-10-22 18:08:22'),
(75, 7, 9, '2022-10-22 18:18:43'),
(76, 10, 9, '2022-10-22 18:18:50'),
(77, 6, 9, '2022-10-22 18:19:09'),
(78, 3, 9, '2022-10-22 18:19:14'),
(81, 9, 8, '2022-10-22 18:26:44'),
(84, 7, 8, '2022-10-22 18:27:28'),
(86, 2, 8, '2022-10-22 18:27:32');

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `picture`, `created`, `modified`) VALUES
(1, 'aaaaa', 'aaaaa', '$2y$10$khjG1RuhtEpZY.TJAhKC4ecV5.vj8TZ5FRzcRAimFsIbA8cP69zxi', '20220706115510血界戦線　アイコン.jpg', '2022-07-06 18:55:12', '2022-07-06 00:55:12'),
(2, 'ccccc', 'ccccc', '$2y$10$jXAoCFRGC6B0LXJZ6JNjHu8NO9qayAbbzk8kgNXvO8MB8jMHUOoM2', '20220706120042血界戦線　アイコン.jpg', '2022-07-06 19:00:44', '2022-07-06 01:00:44'),
(3, 'ttttt', 'ttttt', '$2y$10$y87jPhMGIsVJjrvZB1CK..TPS7RHoc18lcqJNZLar1IfANagm79uO', '20220709075345血界戦線　アイコン.jpg', '2022-07-09 14:53:46', '2022-07-08 20:53:46'),
(5, 'ddddd', 'dddd', '$2y$10$uZn2R3.MdUgublTzc6lzvOoN/amdebcdIuqXc7pHm7jXG2HZjpaja', '20221011082446adores.jpg', '2022-10-11 15:24:48', '2022-10-11 06:24:48'),
(6, 'iiiiiii', 'iiiiiii', '$2y$10$lIR1tX89EUOJb8aLNjCDX.tSJl83tBBfmRWhXg9M7tzU4k.twQpSm', '20221011082828adores.jpg', '2022-10-11 15:28:29', '2022-10-11 06:28:29'),
(7, 'inadakazuya', 'inaina', '$2y$10$GJq8KccaHPU2f3gnT8UMDupOtjPOKtD.dAyMa276F3IYHcA.DCPh6', '20221011111035事故画.jpg', '2022-10-11 18:10:41', '2022-10-11 09:10:41'),
(8, 'sssssss', 'sssssss', '$2y$10$i3YsiN1lyzub.UoD4TGFROn0SoJJmnctrMz7gP7GIKpMX1rpfJf9i', '20221018054310', '2022-10-18 12:43:13', '2022-10-18 03:43:13'),
(9, 'adoado', 'adoado', '$2y$10$df.IN3cfv2vU3iV0oStyoOISuBHeEddsyfytIN4XuNQf7VJwBgLXi', '20221018060647adores.jpg', '2022-10-18 13:06:48', '2022-10-18 04:06:48'),
(10, 'qqqqqqq', 'qqqqqqq', '$2y$10$Tmp8aT7DZU.7cT6jPLia6.RmM4ea0qrTsVBah329JWjNwF1VZkKFO', '20221018070835', '2022-10-18 14:08:38', '2022-10-18 05:08:38');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `token` text NOT NULL,
  `insert_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `user_token`
--

INSERT INTO `user_token` (`id`, `token`, `insert_date`) VALUES
(0, '42vcqv3a4v9qk95fd7nhkus69d', '2022-07-06 11:55:21'),
(3, 'il0qcvknbf34s6243hmcvd6qv0', '2022-07-09 08:22:38'),
(8, 'irt895j1kp7h7kj31acd8rhbg3', '2022-10-18 05:43:23'),
(8, 'rsfe3q43pfov9kavqgt56bisli', '2022-10-18 06:08:46');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- テーブルの AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
