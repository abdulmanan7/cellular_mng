-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2015 at 12:15 PM
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
`id` int(11) unsigned NOT NULL,
  `group_id` int(100) NOT NULL DEFAULT '2',
  `controller` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `group_id`, `controller`, `method`) VALUES
(1, 1, 'auth', '*'),
(2, 1, 'company', '*');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `company_id`, `name`, `description`) VALUES
(1, 1, 'admin', 'Administrator'),
(2, 1, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` mediumint(8) unsigned NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(3);

-- --------------------------------------------------------

--
-- Table structure for table `tblaccount`
--

CREATE TABLE IF NOT EXISTS `tblaccount` (
`id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `system_acc` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblaccount`
--

INSERT INTO `tblaccount` (`id`, `company_id`, `name`, `status`, `system_acc`) VALUES
(1, 1, 'Investment', 1, 1),
(2, 1, 'Invoice', 1, 1),
(3, 1, 'Payment', 1, 1),
(4, 1, 'Expense', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE IF NOT EXISTS `tblcompany` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attn_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `postcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_no` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VAT_no` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_notes` text COLLATE utf8_unicode_ci,
  `logo` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '_assets/img/logo.png'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `name`, `country`, `city`, `attn_name`, `address1`, `address2`, `postcode`, `email`, `phone`, `fax`, `registration_no`, `VAT_no`, `footer_notes`, `logo`) VALUES
(1, 'Afridi', NULL, NULL, 'Khan', 'Peshawar Mall Tower Sadar Cantt.', 'Pakistan ', '25000', 'admin@ithinq.net', '091200000000', '09100012000', 'B786AA', 'T92RtmQ', 'lorem lorem lorem lorem lorem lorem lorem ', '_assets/images/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblcurrency`
--

CREATE TABLE IF NOT EXISTS `tblcurrency` (
`id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_left` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol_right` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decimal_place` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` decimal(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcurrency`
--

INSERT INTO `tblcurrency` (`id`, `company_id`, `title`, `code`, `symbol_left`, `symbol_right`, `decimal_place`, `value`, `status`, `default`, `date_modified`) VALUES
(1, 1, 'USD', 'ANY', '$', 'USD', '1.0000000', '1.00000000', 1, 1, '2014-12-19 14:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE IF NOT EXISTS `tblcustomer` (
`id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `company_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT '',
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `attn_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`id`, `company_id`, `company_name`, `name`, `attn_name`, `address`, `phone`, `email`) VALUES
(1, 1, 'Ithinq', 'Abdul Manan', 'AD3309B', 'Terah Bagh Medain Pakistan', '034554210120', 'admin@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE IF NOT EXISTS `tblinvoice` (
`id` int(11) unsigned NOT NULL,
  `customer_id` int(11) unsigned NOT NULL,
  `currency_id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_attn_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `company_address1` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `company_address2` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_postcode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `company_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_fax` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_registration_no` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_VAT_no` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_company_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `customer_attn_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `currency_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `currency_symbol_left` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_symbol_right` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `totaltax` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `current_time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified_ts` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice_details`
--

CREATE TABLE IF NOT EXISTS `tblinvoice_details` (
`id` int(11) unsigned NOT NULL,
  `invoice_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tax_type_id` int(11) unsigned NOT NULL,
  `tax_type_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tax_type_percentage` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8_unicode_ci,
  `product_total` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice_status`
--

CREATE TABLE IF NOT EXISTS `tblinvoice_status` (
  `invoice_id` int(11) unsigned NOT NULL,
  `invoice_statuses_id` int(11) unsigned NOT NULL,
  `comment` varchar(256) COLLATE utf8_unicode_ci DEFAULT 'no comment attached',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice_statuses`
--

CREATE TABLE IF NOT EXISTS `tblinvoice_statuses` (
`id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `is_enable` tinyint(1) NOT NULL,
  `is_default` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblinvoice_statuses`
--

INSERT INTO `tblinvoice_statuses` (`id`, `company_id`, `name`, `is_system`, `is_enable`, `is_default`) VALUES
(1, 1, 'Demo', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE IF NOT EXISTS `tblproducts` (
`id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `price` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `company_id`, `name`, `type`, `price`, `notes`) VALUES
(1, 1, 'Banana', 2, '140', 'Good friut of all seasons.'),
(2, 1, 'Dell Laptop', 2, '56000', 'Core i5 ,4GB of Ram ,1TB hard Drive ,1 Year Local Warrenty'),
(3, 1, 'Rent A car Management System', 1, '5000', 'User Friendly Easy to use with 3 months Support.');

-- --------------------------------------------------------

--
-- Table structure for table `tbltaxtype`
--

CREATE TABLE IF NOT EXISTS `tbltaxtype` (
`id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `percentage` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbltaxtype`
--

INSERT INTO `tbltaxtype` (`id`, `company_id`, `name`, `percentage`) VALUES
(1, 1, 'VAT-15%', '15.00'),
(2, 1, 'Sale Tax 20%', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` mediumint(8) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 1, 0x32313330373036343333, 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, 1, 0x32313330373036343333, 'admin', '$2y$08$oJS8/132sr1rb7wNjr3dq.Uwcfi.Ca86h4ix57L7VWuoned1ggG.K', '', 'admin', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '00');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

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
-- Indexes for table `tblinvoice_statuses`
--
ALTER TABLE `tblinvoice_statuses`
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
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_control`
--
ALTER TABLE `access_control`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblaccount`
--
ALTER TABLE `tblaccount`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcurrency`
--
ALTER TABLE `tblcurrency`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblinvoice_details`
--
ALTER TABLE `tblinvoice_details`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblinvoice_statuses`
--
ALTER TABLE `tblinvoice_statuses`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbltaxtype`
--
ALTER TABLE `tbltaxtype`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
