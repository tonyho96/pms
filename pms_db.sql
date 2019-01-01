-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 06, 2018 lúc 05:22 AM
-- Phiên bản máy phục vụ: 5.7.19
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pms_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homepage_setting`
--

DROP TABLE IF EXISTS `homepage_setting`;
CREATE TABLE IF NOT EXISTS `homepage_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paragraph_1` text NOT NULL,
  `paragraph_2` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `homepage_setting`
--

INSERT INTO `homepage_setting` (`id`, `paragraph_1`, `paragraph_2`) VALUES
(1, 'Planning to paint your house? Any paint project requires you to shop and choose a variety of paints to apply to the different areas such as walls, ceiling, trims, etc. After the big job is done, how do you keep track of the paint colors and types that you used?</br>Some people collect paint chips and make annotations on them of the areas where they were applied. Others use a notebook to keep track of paint colors, types, and areas of a project... <a href =\"#\"><i>Read More</i></a>', 'This is the new Text Box    <a href =\"#\"><i>Read More</i></a>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `I-ID` int(11) NOT NULL AUTO_INCREMENT,
  `I-Name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `I-Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `I-R-ID` int(11) DEFAULT NULL,
  `I-PI-ID` int(11) DEFAULT NULL,
  `I-Comment` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `USER_ID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`I-ID`),
  KEY `I_R_ID_idx` (`I-R-ID`),
  KEY `I_PI_ID_idx` (`I-PI-ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `items`
--

INSERT INTO `items` (`I-ID`, `I-Name`, `I-Description`, `I-R-ID`, `I-PI-ID`, `I-Comment`, `USER_ID`) VALUES
(1, 'Item 1', 'Description 1', 5, 1, 'drdfgdfsdfasdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdafsddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 3),
(2, 'Item 2', 'Description 2', 5, 2, 'Comment 2', 3),
(3, 'Item 1', 'Description 1', 6, 3, 'Comment 1', 3),
(4, 'Item 2', 'Description 2', 6, 4, 'Commnt 2', 3),
(7, 'Item 3', 'Description 3', 5, 7, 'Comment 3', 3),
(8, 'Item 4', 'Description 4', 5, 8, 'Comments 4', 3),
(9, 'Walls', 'Kitchen Walls', 5, 9, 'Describe all details for kitchen walls', 3),
(10, 'Window Trim ', 'Kitchen Window Trim ', 5, 10, 'Describe all details for Kitchen Windows Trim ', 3),
(11, 'P3-Item', 'test', 9, 11, 'test', 3),
(12, 'Walls', 'All Walls', 5, 12, 'Wall colors - Except accent wall', 2),
(14, 'sds', 'dsd', 11, 16, 'sds', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `labels`
--

DROP TABLE IF EXISTS `labels`;
CREATE TABLE IF NOT EXISTS `labels` (
  `L-ID` int(11) NOT NULL AUTO_INCREMENT,
  `L-Name` varchar(45) DEFAULT NULL,
  `L-I-ID` int(11) DEFAULT NULL,
  `L-Image-Pos` int(11) DEFAULT NULL,
  `L-Comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`L-ID`),
  KEY `fk_labels_items_idx` (`L-I-ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `labels`
--

INSERT INTO `labels` (`L-ID`, `L-Name`, `L-I-ID`, `L-Image-Pos`, `L-Comment`) VALUES
(1, 'Label 1', 7, 3, 'Comment 1'),
(2, 'Label 2', 7, 1, 'Comment 3'),
(3, 'Label 3', 7, 4, 'Comment 1'),
(4, 'Label 4', 8, 4, 'Comment 2'),
(5, 'Label 5', 7, 1, 'Comment 2'),
(6, 'Label 6', 8, 4, 'Comment 1'),
(7, 'Label 7', 7, 1, 'Comment 2'),
(8, 'Label 8', 8, 4, 'Comment 2'),
(9, 'aaa', 2, 1, 'Comment 1'),
(10, 'New', 11, 1, 'new'),
(11, 'U1 Kitchen Walls', 12, 1, 'Kitchen Walls  '),
(12, 'U1 Bath Walls', 3, 3, 'Bath Walls  ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paint_infos`
--

DROP TABLE IF EXISTS `paint_infos`;
CREATE TABLE IF NOT EXISTS `paint_infos` (
  `PI-ID` int(11) NOT NULL AUTO_INCREMENT,
  `PI-PaintName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-Color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-Type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-Manufacturer` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-PaintID` int(11) DEFAULT NULL,
  `PI-Picture1` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-Picture2` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-Picture3` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-Picture4` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-Quant-Buy` int(11) DEFAULT NULL,
  `PI-Quant-Used` int(11) DEFAULT NULL,
  `PI-Quant-Remain` int(11) DEFAULT NULL,
  `PI-Cost` int(11) DEFAULT NULL,
  `PI-Unit` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PI-PaintComments` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`PI-ID`),
  KEY `PI-PaintName` (`PI-PaintName`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `paint_infos`
--

INSERT INTO `paint_infos` (`PI-ID`, `PI-PaintName`, `PI-Color`, `PI-Type`, `PI-Manufacturer`, `PI-PaintID`, `PI-Picture1`, `PI-Picture2`, `PI-Picture3`, `PI-Picture4`, `PI-Quant-Buy`, `PI-Quant-Used`, `PI-Quant-Remain`, `PI-Cost`, `PI-Unit`, `PI-PaintComments`) VALUES
(1, 'Paint Name 1', 'Color 1', 'Type 1', '', 0, '/uploads/12b6654f1d2b32b15574da1b7a267304Vendor-Label-1523421556.jpg', '/uploads/90743f1bac2b16ca61ac5739625839b8Vendor-Label-1523421556.jpg', '/uploads/ee9c29cb9a1ccae5c4cb505ad8703cb1Vendor-Label-1523421556.jpg', '/uploads/fa17f42612bef4672b5b8c6fc90887caVendor-Label-1523421556.jpg', 0, 2, 3, 4, '', ''),
(2, 'Paint Name 2', 'color 2', 'type 2', NULL, NULL, '/uploads/281a10c29bd07e18f40074912cdb2bb56bab55ab-0793-4ae8-94f0-9971ad25087d.jpg', NULL, NULL, NULL, NULL, 1, 2, 3, NULL, NULL),
(3, 'Paint Name 1', 'Color 1', 'Type 1', NULL, NULL, '/uploads/b5b5de85447dedca268a74f58db0c425Capture.PNG', '/uploads/e4e675d14da1417f0013fc30bff43f02pexels-photo-355296.jpeg', '/uploads/3415fdd6a8268aed9b365dd079f01c9apexels-photo-257360.jpeg', NULL, NULL, 5, 6, 7, NULL, NULL),
(4, 'Paint Name 2', 'color 2', 'Type 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 9, 10, NULL, NULL),
(7, 'Paint Name 3', 'Color 3', 'Type 3', NULL, NULL, '/uploads/14bf94497d3880a56b62ce523a9389eaIMG_28022018_230943_0.png', '', '/uploads/e6389c045f4d9b053e2faec351bf5209IMG_01032018_214336_0.png', '/uploads/6b38f6808774a958f8b1a80f63b05d8fIMG_26022018_181944_0.png', NULL, 2, 5, 4, NULL, NULL),
(8, 'Paint Name 4', 'Color 4', 'Type 4', NULL, NULL, '', '', '', '/uploads/de53fab1b0810530b49df76db53eb09aIMG_01032018_214336_0.png', NULL, 6, 4, 5, NULL, NULL),
(9, 'Benjamin Moore ', 'Blue', 'Acrylic', NULL, NULL, '', '', '', '', NULL, 2, 1, 25, NULL, NULL),
(10, 'Benjamin Moore', 'White', 'Acrylic Eggshell', NULL, NULL, '/uploads/f812aec9fc54c3fbb625bcec5dc0b0a4Vendor Label.jpg', '/uploads/4da297ec0beea4151bfd627c1978bc30pos3.jpg', '', '', NULL, 2, 1, 25, NULL, NULL),
(11, 'Paint 3', 'red', '123', 'IBM', 123, '/uploads/aa6969596a8c56c84ad07b87332497d4IBM-banner.jpg', '', '', '', 1, 1, 1, 20, '122', '1211'),
(12, 'Peach Cream', 'Peach', 'Acrylic', 'Benjamin More', 132, '/uploads/19cd55972724a1573dc89031c19eea89Vendor Label.jpg', '', '', '', 4, 3, 1, 25, 'Gal', 'Test Wall Item'),
(13, 'dsdsd', 'sd', 'sd', 'sd', 0, '', '', '', '', 1212, 1212, 23, 121212, '121', '212'),
(14, '1w', 'ew111', '1', '1', 1, '', '', '', '', 1, 1, 1, 1, '1', '1'),
(16, 'dsds', 'dsd', '1', 'sad', 1, '', '', '', '', 1, 1, 1, 1, '111', '11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `P-ID` int(11) NOT NULL AUTO_INCREMENT,
  `P-Name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `P-Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `P-Type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `P-Date` datetime DEFAULT NULL,
  `P-NumUnits` int(11) DEFAULT NULL,
  `P-Comments` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `USER_ID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`P-ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `projects`
--

INSERT INTO `projects` (`P-ID`, `P-Name`, `P-Description`, `P-Type`, `P-Date`, `P-NumUnits`, `P-Comments`, `USER_ID`) VALUES
(2, 'Project 1', 'Description 1', 'Type 1', '2018-02-24 00:00:00', NULL, 'Comment 1', 3),
(3, 'Project 2', 'Description 2', 'Type 2', '2018-02-25 00:00:00', NULL, 'Comment 2', 3),
(4, 'Project 3', 'Description 3', 'Type 3', '2018-02-26 00:00:00', NULL, 'Comment 3', 3),
(5, 'Print 3', 'Print 3', 'p3', '2018-03-20 00:00:00', NULL, '123', 3),
(9, 'sd', 'sdsd', 'sdsd', '2018-06-05 00:00:00', NULL, 'sd', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `R-ID` int(11) NOT NULL AUTO_INCREMENT,
  `R-Name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `R-Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `R-Comments` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `R-U-ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`R-ID`),
  KEY `R_U_ID_idx` (`R-U-ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`R-ID`, `R-Name`, `R-Description`, `R-Comments`, `R-U-ID`) VALUES
(5, 'Room 1', 'Description 1', 'Comment 1', 1),
(6, 'Room 2', 'Description 2', 'Comment 2', 1),
(7, 'Room 1', 'Description 1', 'Comment 1', 2),
(8, 'Room 2', 'Description 2', 'Comment 2', 2),
(9, 'P3-U-R', 'test', 'test', 4),
(11, 'sds', 'dsdsd', 'sd', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `templates`
--

DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) NOT NULL,
  `template_url` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `label_width` float NOT NULL,
  `label_height` float NOT NULL,
  `vertical_margin` float NOT NULL,
  `horizontal_margin` float NOT NULL,
  `USER_ID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `templates`
--

INSERT INTO `templates` (`id`, `template_name`, `template_url`, `unit`, `label_width`, `label_height`, `vertical_margin`, `horizontal_margin`, `USER_ID`) VALUES
(9, 'Template 1c', 'http://pms.cidevserver.tk/print-template/Label-Template-1526311069.jpg', 'cm', 5.6, 8, 0.55, 0.3, 5),
(10, 'Template 1d', 'http://pms.cidevserver.tk/print-template/Label-Template-1525670017.jpg', 'cm', 6, 8, 0.6, 0.5, 2),
(11, 'Template test', 'http://pms.cidevserver.tk/print-template/Label-Template-1525696867.png', 'cm', 6, 8, 0.6, 0.5, 2),
(12, 'sd', 'http://pms.test/print-template/Label-Template-1528986847.jpg', 'cm', 6, 8, 0.6, 0.5, 2),
(13, 'Template 1a', 'http://pms.cidevserver.tk/print-template/Label-Template-1532360601.jpg', 'cm', 6, 8, 0.6, 0.5, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `U-ID` int(11) NOT NULL AUTO_INCREMENT,
  `U-Name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `U-Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `U-Comments` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `U-P-ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`U-ID`),
  KEY `P_ID_idx` (`U-P-ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `units`
--

INSERT INTO `units` (`U-ID`, `U-Name`, `U-Description`, `U-Comments`, `U-P-ID`) VALUES
(1, 'Unit 1', 'Description 1', NULL, 2),
(2, 'Unit 2', 'Description 2', NULL, 2),
(3, 'Unit 1', 'Description 1', NULL, 3),
(4, 'P3-Unit', 'test', NULL, 5),
(7, 'sd', 'sds', NULL, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_working` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL DEFAULT '0',
  `team` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `is_working`, `is_approved`, `team`) VALUES
(2, 'user1', 'user1@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, NULL, NULL, 0, 0, 1),
(3, 'test', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, NULL, NULL, 0, 0, 1),
(4, 'test', 'asd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, NULL, NULL, 0, 0, 1),
(5, 'admin', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL, NULL, 0, 0, 1),
(6, 'user2', 'user2@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, NULL, NULL, 0, 0, 1),
(7, 'User1', 'ronbrisard@yahoo.com', '3f49830222dbe53a80229a87ed12ffa2', 0, 'cabe25f64d7591b3', NULL, NULL, 0, 0, 1),
(8, 'test1 user', 'test1@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '3ec7a80ff9e7bc38', NULL, NULL, 0, 0, 1),
(9, 'test', 'ysscwebsite@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '3f2ace2da43becc4', NULL, NULL, 0, 0, 1),
(10, 'test10', 'test10@mailinator.com', 'c33367701511b4f6020ec61ded352059', 0, '4660fceba800a387', NULL, NULL, 0, 0, 1),
(11, 'Tom Jones', 'tomejones@mailinator.com', 'fcd62153ed6518d78d394f6fcf51d1a1', 0, NULL, NULL, NULL, 0, 0, 1);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_I_PI_ID_PI_ID` FOREIGN KEY (`I-PI-ID`) REFERENCES `paint_infos` (`PI-ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `I_R_ID` FOREIGN KEY (`I-R-ID`) REFERENCES `rooms` (`R-ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_items_users` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `labels`
--
ALTER TABLE `labels`
  ADD CONSTRAINT `fk_labels_items` FOREIGN KEY (`L-I-ID`) REFERENCES `items` (`I-ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_users` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `R_U_ID` FOREIGN KEY (`R-U-ID`) REFERENCES `units` (`U-ID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `fk_templates_users` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `U-P-ID` FOREIGN KEY (`U-P-ID`) REFERENCES `projects` (`P-ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
