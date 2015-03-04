-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2015 at 12:33 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oinvoices`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_control`
--

CREATE TABLE IF NOT EXISTS `access_control` (
`id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '2',
  `controller` varchar(60) NOT NULL,
  `method` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `group_id`, `controller`, `method`) VALUES
(1, 2, 'customer', 'add'),
(3, 2, 'auth', '*'),
(8, 2, 'company', '*');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `tblaccount`
--

CREATE TABLE IF NOT EXISTS `tblaccount` (
`id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `system_acc` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaccount`
--

INSERT INTO `tblaccount` (`id`, `name`, `status`, `system_acc`) VALUES
(1, 'Investment', 1, 1),
(2, 'Expense', 1, 0),
(3, 'Invoice', 1, 1),
(4, 'Payment', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE IF NOT EXISTS `tblcompany` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `attn_name` varchar(60) NOT NULL,
  `address1` varchar(512) NOT NULL,
  `address2` varchar(512) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `registration_no` varchar(60) NOT NULL,
  `VAT_no` varchar(60) NOT NULL,
  `footer_notes` varchar(1024) DEFAULT NULL,
  `logo` varchar(256) NOT NULL DEFAULT '_assets/img/logo.png'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `name`, `attn_name`, `address1`, `address2`, `postcode`, `email`, `phone`, `fax`, `registration_no`, `VAT_no`, `footer_notes`, `logo`) VALUES
(1, 'Abdul manan', 'khan', 'Peshawar Mall Tower', 'Saddr Cannt', '25000', 'admin@admin.com', '03339787451', '465465465464', 'ab1230ACD', '87878ACa3', 'a quick brown fox jumps over the lazy dog\r\na quick brwon fox jumps over the lazy dog\r\na quick brown fox jumps over the lazy dog\r\na quick brwon fox jumps over the lazy dog\r\n', '_assets/images/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblcurrency`
--

CREATE TABLE IF NOT EXISTS `tblcurrency` (
`id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(12) NOT NULL,
  `symbol_right` varchar(12) NOT NULL,
  `decimal_place` char(1) NOT NULL,
  `value` float(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `default` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcurrency`
--

INSERT INTO `tblcurrency` (`id`, `title`, `code`, `symbol_left`, `symbol_right`, `decimal_place`, `value`, `status`, `date_modified`, `default`) VALUES
(2, 'AUD', 'AUD', '$', 'AUD', '2', 1.00000000, 1, '2014-12-25 13:15:04', 0),
(5, 'Rate', 'RT', '@', 'RT', '1', 1.00000000, 1, '2014-12-31 14:08:47', 1),
(6, 'Pond', '007', 'Brt', '%', '0', 10.00000000, 1, '2014-12-31 14:10:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE IF NOT EXISTS `tblcustomer` (
`id` int(11) NOT NULL,
  `company_name` varchar(512) DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `attn_name` varchar(60) NOT NULL,
  `address` varchar(512) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`id`, `company_name`, `name`, `attn_name`, `address`, `phone`, `email`) VALUES
(1, 'Itinq Soft', 'Ikram Khan', 'Afridi', 'Peshawar Saddar Cannt Pakistan dara adam khel koche bazar pakistan karache lahore fasalabad', '03332525252', 'admin@admin.com'),
(2, 'Pakistan State Oil', 'Ali', 'abc', 'Sango landi bala Peshawar', '0345', 'azam@yahoo.com'),
(3, 'Afridi', 'Abdul Manan', 'abc', 'peshawar', '0345912121', 'abdulmanan7@hotmail.com'),
(4, 'Hushyar ', 'Mohammad Ali', 'XYZ123#', 'Dara adam khel', '0333456789', 'ishfaqkhan@gmail.com'),
(5, 'shokat khanam', 'Azmat Khan', 'AABBc', 'Landi kotal ', '0333956542', 'Azmat@yahoo.com'),
(6, 'JSoftwares', 'shafiq', 'AVR', 'Peshawar', '132132131', 'admin@atsohight.com'),
(7, 'Lucky Cekis', 'Zaman khan', 'AND', 'Peshawar Saddar Cannt Pakistan', '123123123123', 'admin@adminin.com'),
(8, 'R-sheen', 'Keramat shah', 'ARz', 'Noshehra', '123123123', 'dama@admin.com'),
(10, 'Deans Soft', 'Sherafat', 'ADf', 'Lhor', '1243123123', 'asdf@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE IF NOT EXISTS `tblinvoice` (
`id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_attn_name` varchar(60) NOT NULL,
  `company_address1` varchar(512) NOT NULL,
  `company_address2` varchar(512) DEFAULT NULL,
  `company_postcode` varchar(10) DEFAULT NULL,
  `company_email` varchar(60) NOT NULL,
  `company_phone` varchar(15) NOT NULL,
  `company_fax` varchar(15) DEFAULT NULL,
  `company_registration_no` varchar(60) NOT NULL,
  `company_VAT_no` varchar(60) NOT NULL,
  `customer_company_name` varchar(512) DEFAULT NULL,
  `customer_name` varchar(60) NOT NULL,
  `customer_attn_name` varchar(60) NOT NULL,
  `customer_address` varchar(512) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(40) NOT NULL,
  `currency_name` varchar(30) NOT NULL,
  `currency_symbol_left` varchar(12) NOT NULL,
  `currency_symbol_right` varchar(12) NOT NULL,
  `total` varchar(60) NOT NULL,
  `subtotal` varchar(60) NOT NULL,
  `totaltax` varchar(60) NOT NULL,
  `current_time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified_ts` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`id`, `customer_id`, `currency_id`, `company_id`, `company_name`, `company_attn_name`, `company_address1`, `company_address2`, `company_postcode`, `company_email`, `company_phone`, `company_fax`, `company_registration_no`, `company_VAT_no`, `customer_company_name`, `customer_name`, `customer_attn_name`, `customer_address`, `customer_phone`, `customer_email`, `currency_name`, `currency_symbol_left`, `currency_symbol_right`, `total`, `subtotal`, `totaltax`, `current_time_stamp`, `last_modified_ts`) VALUES
(59, 6, 2, 1, 'Abdul manan', 'khan', 'Peshawar Mall Tower', 'Saddr Cannt', '25000', 'admin@admin.com', '03339787451', '465465465464', 'ab1230ACD', '87878ACa3', 'JSoftwares', 'shafiq', 'AVR', 'Peshawar', '132132131', 'admin@atsohight.com', 'AUD', '$', 'AUD', '997.8', '852', '145.8', '2014-12-30 12:12:03', '2014-12-30 13:12:03'),
(62, 3, 2, 1, 'Abdul manan', 'khan', 'Peshawar Mall Tower', 'Saddr Cannt', '25000', 'admin@admin.com', '03339787451', '465465465464', 'ab1230ACD', '87878ACa3', 'Afridi', 'Abdul Manan', 'abc', 'peshawar', '0345912121', 'abdulmanan7@hotmail.com', 'AUD', '$', 'AUD', '517.5', '450', '67.5', '2015-01-01 13:15:35', '2015-01-01 14:15:35'),
(63, 7, 6, 1, 'Abdul manan', 'khan', 'Peshawar Mall Tower', 'Saddr Cannt', '25000', 'admin@admin.com', '03339787451', '465465465464', 'ab1230ACD', '87878ACa3', 'Lucky Cekis', 'Zaman khan', 'AND', 'Peshawar Saddar Cannt Pakistan', '123123123123', 'admin@adminin.com', 'Pond', 'Brt', '%', '345', '300', '45', '2015-01-01 13:15:59', '2015-01-01 14:15:59'),
(64, 1, 2, 1, 'Abdul manan', 'khan', 'Peshawar Mall Tower', 'Saddr Cannt', '25000', 'admin@admin.com', '03339787451', '465465465464', 'ab1230ACD', '87878ACa3', 'Itinq Soft', 'Ikram Khan', 'Afridi', 'Peshawar Saddar Cannt Pakistan', '03332525252', 'admin@admin.com', 'AUD', '$', 'AUD', '16704', '14460', '2244', '2015-01-02 10:18:40', '2015-01-02 11:20:31'),
(65, 1, 2, 1, 'Abdul manan', 'khan', 'Peshawar Mall Tower', 'Saddr Cannt', '25000', 'admin@admin.com', '03339787451', '465465465464', 'ab1230ACD', '87878ACa3', 'Itinq Soft', 'Ikram Khan', 'Afridi', 'Peshawar Saddar Cannt Pakistan dara adam khel koche bazar pakistan karache lahore fasalabad', '03332525252', 'admin@admin.com', 'AUD', '$', 'AUD', '13800', '12000', '1800', '2015-01-02 12:26:09', '2015-01-02 13:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice_details`
--

CREATE TABLE IF NOT EXISTS `tblinvoice_details` (
`id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `tax_type_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_type_percentage` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_total` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblinvoice_details`
--

INSERT INTO `tblinvoice_details` (`id`, `invoice_id`, `product_id`, `product_name`, `price`, `quantity`, `tax_type_id`, `tax_type_name`, `tax_type_percentage`, `product_description`, `product_total`) VALUES
(116, 59, 5, 'Water melion', '120', '4.1', 3, 'VAT-15%', '15.00', 'use like a bootle of water', '565.8'),
(117, 59, 5, 'Water melion', '120', '3', 5, 'Sales Tax 20%', '20.00', 'good product', '432'),
(129, 62, 7, 'Ananas', '150', '3', 3, 'VAT-15%', '15.00', '', '517.5'),
(130, 63, 3, 'Orange', '100', '3', 3, 'VAT-15%', '15.00', '', '345'),
(135, 64, 2, 'Apple', '4000', '3', 3, 'VAT-15%', '15.00', 'Some thig is better then nothing ', '13800'),
(136, 64, 5, 'Water', '120', '3', 3, 'VAT-15%', '15.00', '', '414'),
(137, 64, 9, 'Anar', '500', '3', 5, 'Sales Tax 20%', '20.00', 'Some thig is better then nothing ', '1800'),
(138, 64, 1, 'Banana', '200', '3', 3, 'VAT-15%', '15.00', 'Some thig is better then nothing ', '690'),
(139, 65, 2, 'Apple ', '4000', '3', 3, 'VAT-15%', '15.00', 'teray mast mast do nain ', '13800');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE IF NOT EXISTS `tblproducts` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `notes` varchar(256) NOT NULL DEFAULT 'No Notes Added Yet.',
  `price` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `name`, `type`, `notes`, `price`) VALUES
(1, 'Banana', 2, 'Banana is Great Food in Summer.', '200'),
(2, 'Apple ', 2, 'Apple is Nice and Good Fruit .in all Seasons ', '4000'),
(3, 'Orange', 2, 'This fruit is Full of Vitamins C...Great Fruit for Kids ', '100'),
(5, 'Water melion', 1, 'Full of Water Fruit', '120'),
(7, 'Ananas', 2, 'Great Fruit ', '150'),
(8, 'Laptop', 1, 'Core i7 16GB Ram 1TB SSD Hardrive.', '800'),
(9, 'Anar', 2, 'Red Color Fruit', '500'),
(10, 'Flash Drive', 1, '1 Gb HP', '300');

-- --------------------------------------------------------

--
-- Table structure for table `tbltaxtype`
--

CREATE TABLE IF NOT EXISTS `tbltaxtype` (
`id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` float(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbltaxtype`
--

INSERT INTO `tbltaxtype` (`id`, `name`, `percentage`) VALUES
(3, 'VAT-15%', 15.00),
(5, 'Sales Tax 20%', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2y$08$oJS8/132sr1rb7wNjr3dq.Uwcfi.Ca86h4ix57L7VWuoned1ggG.K', '', 'admin@admin.com', '', 'cLBOSqFI0pvk0IbU.5C4bu0b28d2210ff7b47f78', 1417585146, 'C/lK7EO6OvUFLx90/aeNue', 1268889823, 1420546002, 1, 'admi', 'n', 'admin', '0'),
(2, '127.0.0.1', 'abdul manan', '$2y$08$hAl/ReLn0hKjDIluzbiFCeG1ZlU8/Pp4OThL02779P.fw8bZox/T6', NULL, 'admin@example.com', NULL, NULL, NULL, '1hGa7u4f/a63AUEm9wrTjO', 1417586192, 1419402763, 1, 'abdul', 'manan', 'afridi', '03112212121'),
(3, '127.0.0.1', 'ali afridi', '$2y$08$ELbhkfNuFkVciK0nBVXj7eKQ8JV/xBXYWuRCW4f/1AHCjQs4Fidpi', NULL, 'abdulmanan7@hotmail.com', NULL, NULL, NULL, NULL, 1417609520, 1418364623, 1, 'ali', 'afridi', 'itinq soft', '03132213131');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(8, 1, 1),
(9, 1, 2),
(7, 2, 1),
(6, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_control`
--
ALTER TABLE `access_control`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblaccount`
--
ALTER TABLE `tblaccount`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcurrency`
--
ALTER TABLE `tblcurrency`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblinvoice_details`
--
ALTER TABLE `tblinvoice_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltaxtype`
--
ALTER TABLE `tbltaxtype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_control`
--
ALTER TABLE `access_control`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblaccount`
--
ALTER TABLE `tblaccount`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcurrency`
--
ALTER TABLE `tblcurrency`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tblinvoice_details`
--
ALTER TABLE `tblinvoice_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbltaxtype`
--
ALTER TABLE `tbltaxtype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
