-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2017 at 05:56 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `housingdistribution`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(10) UNSIGNED NOT NULL,
  `houseName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `houseName`, `comments`, `created_at`, `updated_at`) VALUES
(1, 'HA3', 'This house is only for professors. ', '2016-11-09 18:07:42', '2016-11-09 18:07:42'),
(2, 'HA2', 'This house is only for staffs', '2016-11-09 18:11:08', '2016-11-09 18:11:08'),
(3, 'HA7', 'This house is only for staffs. ', '2016-11-19 06:43:15', '2016-11-19 06:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `allotments`
--

CREATE TABLE `allotments` (
  `id` int(10) UNSIGNED NOT NULL,
  `houseName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `houseType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allotmentStatus` enum('alloted','free','advertised') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `houseDescription` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `allotments`
--

INSERT INTO `allotments` (`id`, `houseName`, `houseType`, `allotmentStatus`, `user_id`, `created_at`, `updated_at`, `houseDescription`) VALUES
(1, 'HA1', 'Banglow', 'free', 0, '2016-10-28 12:06:04', '2016-10-28 12:06:04', 'sss'),
(2, 'HA2', 'Banglow', 'advertised', 0, '2016-10-29 01:28:58', '2016-11-09 18:11:08', 'ss'),
(3, 'HA3', 'Quarter', 'advertised', 0, '2016-10-29 01:29:10', '2016-10-29 01:29:10', 'ss'),
(4, 'HA4', '0', 'free', 0, '2016-11-01 08:38:11', '2016-11-01 08:38:11', 'assss'),
(5, 'HA5', '0', 'free', 0, '2016-11-01 08:38:11', '2016-11-01 08:38:11', 'assss'),
(6, 'HA6', '0', 'free', 0, '2016-11-01 08:38:11', '2016-11-01 08:38:11', 'assss'),
(7, 'HA7', 'Banglow', 'advertised', 1104014, '2016-11-01 08:40:50', '2016-11-19 08:09:42', 'SSSSS'),
(8, 'HA8', '0', 'free', 0, '2016-11-01 08:43:00', '2016-11-01 08:43:00', '111'),
(9, 'HA8', 'Mess', 'free', 0, '2016-11-19 09:30:14', '2016-11-19 09:30:14', '34 square feet. Full house');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_10_05_205943_create_users_table', 1),
('2016_10_05_220640_add_userid_to_users_table', 2),
('2016_10_05_220744_add_userid_to_users_table', 3),
('2016_10_05_221109_add_userid_to_users_table', 4),
('2016_10_05_234727_add_status_to_users_table', 5),
('2016_10_05_235019_add_status_to_the_users_table', 6),
('2016_10_06_052110_create_allotments_table', 7),
('2016_10_21_111601_add_point_to_the_users_table', 8),
('2016_10_23_135937_add_remembertoken_to_users', 9),
('2016_10_28_173212_add_housedes_to_allotments_table', 10),
('2016_11_09_114847_create_advertisement_table', 11),
('2016_11_09_160403_create_advertisements_table', 12),
('2016_11_09_231123_create_advertisements_table', 13),
('2016_11_09_232120_create_requests_table', 14),
('2016_11_09_235240_create_user_requests_table', 15),
('2016_11_19_082203_create_notifications_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `from`, `to`, `created_at`, `updated_at`) VALUES
(8, 'Sorry! Your request for HA3 was not accepted.', 'admin', '1104014', '2016-11-19 09:18:04', '2016-11-19 09:18:04'),
(9, 'Sorry! Your request for HA2 was not accepted.', 'admin', '1104014', '2016-11-19 09:18:22', '2016-11-19 09:18:22'),
(10, 'Sorry! Your request for HA3 was not accepted.', 'admin', '1104113', '2016-11-19 09:21:53', '2016-11-19 09:21:53'),
(11, 'Sorry! Your request for HA3 was not accepted.', 'admin', '1104331', '2016-11-19 09:22:40', '2016-11-19 09:22:40'),
(12, 'Your request has been accepted. You are now a verified user', 'admin', '1104102', '2016-11-19 23:23:24', '2016-11-19 23:23:24'),
(13, 'Hello Admin. How are you?', '1104102', 'admin', '2016-11-19 23:24:12', '2016-11-19 23:24:12'),
(14, 'Hello admin.', '1104102', 'admin', '2016-11-20 00:24:15', '2016-11-20 00:24:15'),
(15, 'Your request has been accepted. You are now a verified user', 'admin', '1104013', '2016-11-20 00:26:53', '2016-11-20 00:26:53'),
(16, 'Your request has been accepted. You are now a verified user', 'admin', '1104110', '2017-02-08 09:08:01', '2017-02-08 09:08:01'),
(17, 'Your request has been accepted. You are now a verified user', 'admin', '1104010', '2017-02-23 11:16:04', '2017-02-23 11:16:04'),
(18, 'Your request has been accepted. You are now a verified user', 'admin', '1104016', '2017-02-23 11:17:57', '2017-02-23 11:17:57'),
(19, 'Your request has been accepted. You are now a verified user', 'admin', '1104012', '2017-04-18 09:38:19', '2017-04-18 09:38:19'),
(20, 'Hello Dear Admin.', '1104012', 'admin', '2017-04-18 09:38:50', '2017-04-18 09:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `presentDesignation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pdJoiningDate` date NOT NULL,
  `pdJoiningTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payScale` int(11) NOT NULL,
  `firstDesignation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstJoiningDate` date NOT NULL,
  `maritalStatus` enum('Married','Unmarried','Divorced') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unmarried',
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Verified','Not Verified') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Verified',
  `point` int(255) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `presentDesignation`, `pdJoiningDate`, `pdJoiningTime`, `payScale`, `firstDesignation`, `firstJoiningDate`, `maritalStatus`, `department`, `phone`, `created_at`, `updated_at`, `userID`, `status`, `point`, `remember_token`) VALUES
(77, 'Mr. Abdul', '81dc9bdb52d04dc20036dbd8313ed055', 'Staff', '2016-12-31', 'pm', 4, 'Lecturer', '2010-12-31', 'Married', 'CSE', '01923455667', '2016-11-01 12:10:04', '2016-11-02 14:32:04', '1104003', 'Verified', 40, NULL),
(78, 'Shamsul Arefin', '$2y$10$Q6eLLjSqesG0UpROtFHLGOi75p2RHLJijpoj88rcX8BkwgIgiP2ai', 'Lecturer', '2015-12-28', 'am', 6, 'Lecturer', '2014-01-31', 'Married', 'EEE', '01923455667', '2016-11-01 22:51:55', '2016-11-22 13:51:19', '1104331', 'Verified', 60, 'T7yRXl3ArwiYzm4TCWbM0NkoR4OBeKL8JZk4SbC2mVjigJlI5VibPxc5LaQm'),
(79, 'Kamal Hossain', '$2y$10$JwIOCm6GmWoc6rFAtiTf.eyVO7uJ0wbFH4k/UcjPyQan/JDDpQFA2', 'Professor', '2015-12-31', 'am', 1, 'Lecturer', '2009-11-29', 'Married', 'EEE', '01923455667', '2016-11-02 00:28:15', '2016-11-19 07:01:04', '1104004', 'Verified', 80, 'wU3HXN1VchogK1Bx2uJYqM413oAFWhqLQRwp0Dz22oYaozNhLqEGRLGRLkPu'),
(81, 'Abdur Rahim', '$2y$10$nspV1bf/bRCYoPIMsqPYaOtGK8L1DCzetvwxbyifdQuVCjRpOLg/2', 'Staff', '2011-10-30', 'am', 3, 'Staff', '2011-10-30', 'Married', 'EEE', '01923455667', '2016-11-02 00:36:52', '2016-11-02 00:37:33', '1104006', 'Not Verified', 40, '75kn6aBwHvFmGXvqJEi1TABxuLseVzLCtrfOxRVPlQhEDqd8ncrEg8q1TLB3'),
(82, 'Abdur Rafiq', '$2y$10$b5GSsMdYkcuTv4Aak0DAyu94vCixvwbKhicTG3DhWeDVexQOMRlQm', 'Staff', '2015-12-29', 'am', 3, 'Staff', '2015-12-29', 'Married', 'EEE', '01923455667', '2016-11-02 00:41:36', '2016-11-02 00:42:15', '1104007', 'Not Verified', 40, 'yni3Hg7JFmOinwcP7desV9x0BluaeHcZJeG3G9IQrrtC7e3MQjr0kyQ7s7PV'),
(83, 'Abdur Rishad', '$2y$10$vlCtectMzCGqGWdHVjK0jOS437RF1lJh0baCPiY.EromkHXYDPgmW', 'Staff', '2015-12-30', 'am', 3, 'Staff', '2014-12-31', 'Married', 'EEE', '01923455667', '2016-11-02 00:49:42', '2016-11-02 00:59:12', '1104008', 'Not Verified', 40, 'CnD8esnoaDE2BL1dGvQdnG4fs6CJltlt4sX9b07WgvtoNF3fQ6zN1klvIMes'),
(84, 'Mashiat Ferris', '$2y$10$ceGlgbaBf0kRkrFAU294pegbcFg.b0/9CNoj2Q1ndUzj9kQG3dKlC', 'Staff', '2016-12-31', 'am', 2, 'Staff', '2013-12-30', 'Divorced', 'EEE', '01923455667', '2016-11-02 01:00:44', '2016-11-02 01:04:08', '1104009', 'Not Verified', 40, '0AVlftSkChVIFwyFz58uw1YxwEJHSl1US8HL5NUtuqnPnp2ntMNFXE0X3pJg'),
(85, 'Mashiat Karim', '$2y$10$KyCMI092hplUW7v.blyE1OcHasw2Ji2EzVQ3.UUrYewqL5.jAU0yC', 'Staff', '2015-12-29', 'am', 3, 'Staff', '2014-12-29', 'Married', 'EEE', '01923455667', '2016-11-02 01:04:47', '2017-02-23 11:16:18', '1104010', 'Verified', 40, 'mxOCNksnSjCSzxQflmnbeYaqyD7vIzxa1bujhtT352cD4DYtGiCHEr2SrEaV'),
(86, 'Abdullah Al Noman', '$2y$10$mGeqKVdUfpf56Pl2kugPb.jMAI72tcAHPoTmWxUtRykhtbNGDMFny', 'Professor', '2016-12-31', 'am', 1, 'Professor', '2016-12-31', 'Married', 'EEE', '01923455667', '2016-11-02 01:06:39', '2016-11-02 01:07:14', '1104011', 'Not Verified', 100, 'VsxzIgkCtZbIlHz81w4w3KPuslTB5caYWT8Z2DWZZdphBPqtGNXeN1D4M5WH'),
(87, 'Abdullah Al Sabir', '$2y$10$6ekE8SCC0V4E0Elb3p3HEODttu2Gs88iQ/cuA8rRoySUcv52FZrPS', 'Staff', '2015-12-30', 'am', 3, 'Staff', '2015-01-31', 'Divorced', 'EEE', '01923455667', '2016-11-02 01:10:09', '2017-05-22 02:35:31', '1104012', 'Verified', 40, 'QM0GqAM9ddeHMnoGIGSaH3EZttly0Jh0e57hclPHZZkcFunTLbcP2qbRrbJs'),
(88, 'Utpal Nandi', '$2y$10$74gvLrEaj84bE.Jz0GzcPOaV7zMFMlSy/Ge52mewh0nVWjvHJFjI2', 'Professor', '2015-11-30', 'pm', 6, 'Lecturer', '2000-11-29', 'Married', 'CSE', '01923455667', '2016-11-04 06:13:20', '2016-11-20 00:26:55', '1104013', 'Verified', 70, 'UHkXQXom80Wz4TlqMnixdwZbkL3VqN8MvEY0k1036OCCB3q4uC6TbZMliwHe'),
(89, 'John Smith', '$2y$10$Quu4.7u4BXBoU62PYQsmeuu38/UKI/iIpmgIKL19wOy/ark2ZYU7G', 'Lecturer', '2014-11-10', 'am', 4, 'Lecturer', '2010-10-05', 'Unmarried', 'EEE', '01831234567', '2016-11-05 02:14:44', '2016-11-19 09:19:44', '1104014', 'Verified', 60, 'WUQKQwQ6iEoHM3suG6riGEa8L0SW5OWQ6jENkFtzkMYJTX8ZRYhc3CdovSIs'),
(90, 'Abdul Hasan', '$2y$10$g3J0LXGolVCc4yL71oVQLej4cq3JwrSlHPkQA6n2RNy/QzqbsxRDW', 'Staff', '2013-11-29', 'am', 4, 'Staff', '2007-10-30', 'Married', 'EEE', '01923455667', '2016-11-05 07:10:53', '2016-11-19 06:39:48', '1104015', 'Verified', 40, 'pkGrNPossFxFT5EBX9g7UeSqsNmOMLCC6W4p4xqSiEIohhuH2BCvYrdkUF9K'),
(91, 'Kefayat Kabir', '$2y$10$8otHGf5IoKr91Kp6hvXmB.22irEzQiT/jHh/AN4Koyxao5rhr3xf.', 'Assistant Professor', '2015-11-30', 'pm', 6, 'Lecturer', '2011-11-30', 'Married', 'ME', '01923455667', '2016-11-05 16:22:28', '2017-02-23 11:35:14', '1104016', 'Verified', 60, 'scOzQiKRanDzsghlOsn8E8Qnyafol3UqFOow69AoYYaqGHWoNh9sVMKpoXLz'),
(92, 'Osman Goni', '$2y$10$IRNQD4MxntONYTAwlMqeZ.2pUwP/VSjMMUZdkgVvIUCih7PUfCKYm', 'Lecturer', '2015-11-28', 'am', 4, 'Lecturer', '2010-12-29', 'Unmarried', 'Security', '01923455667', '2016-11-09 16:22:31', '2016-11-19 00:59:10', '1104113', 'Verified', 60, 'wOs0XX56uMUKmtjHq9EG5YgK6YLGTOBC1i1d6QxNBXi6SzyWP1Ep1RrdM3TY'),
(93, 'Biman Saha', '$2y$10$HG6ysK9QwMFnMqxZogdQiOH6KvdvbcS4rw44Nz6xfqIztC4W.qdG6', 'Professor', '2014-11-27', 'am', 5, 'Lecturer', '2004-10-27', 'Unmarried', 'CSE', '01831234567', '2016-11-19 23:10:09', '2017-05-02 17:21:54', '1104102', 'Verified', 80, 'IqKXU6qEB4PAFD2FMPnpNy5gnDBFGNDVy8II2icLHACj8mJSE3FDICKdzc1k'),
(94, 'Sakibur Rahaman', '$2y$10$GfN6oFKrDul0l4JRFiNIOeVQ52UURz1TU6pa4LIjfbpwZggO9KfTu', 'Lecturer', '2015-11-29', 'am', 4, 'Assistant Professor', '2017-02-03', 'Married', 'CSE`', '01812394922', '2017-02-08 08:50:35', '2017-03-23 15:24:12', '1104110', 'Verified', 70, 'jrCHyQUjUBn2XYPhclVeL1W2NFqdGKtWfnIC34XShAnqZvjTUNUJGt9VVlzb');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `houseName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `houseName`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'HA2', 1104001, '2016-11-17 23:44:13', '2016-11-17 23:44:13'),
(2, 'HA3', 1104001, '2016-11-18 09:19:47', '2016-11-18 09:19:47'),
(3, 'HA3', 1104083, '2016-11-18 14:24:18', '2016-11-18 14:24:18'),
(6, 'HA7', 1104004, '2016-11-19 07:01:01', '2016-11-19 07:01:01'),
(10, 'HA7', 1104102, '2016-11-19 23:23:52', '2016-11-19 23:23:52'),
(11, 'HA3', 1104102, '2016-11-20 00:23:40', '2016-11-20 00:23:40'),
(12, 'HA3', 1104016, '2017-02-23 11:18:37', '2017-02-23 11:18:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allotments`
--
ALTER TABLE `allotments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `allotments`
--
ALTER TABLE `allotments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
