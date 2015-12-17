-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2015 at 03:52 AM
-- Server version: 5.0.95
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sneezy`
--

-- --------------------------------------------------------

--
-- Table structure for table `Environment`
--

CREATE TABLE IF NOT EXISTS `Environment` (
  `EnvironmentId` int(11) NOT NULL auto_increment,
  `EnvironmentTypeId` int(11) NOT NULL,
  `EnvironmentDate` datetime NOT NULL,
  `EnvironmentNote` text,
  `IsDeleted` tinyint(1) NOT NULL default '0',
  `PersonId` int(11) default NULL,
  `EnvironmentAmount` varchar(250) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `EnvironmentType`
--

CREATE TABLE IF NOT EXISTS `EnvironmentType` (
  `EnvironmentTypeId` int(11) NOT NULL auto_increment,
  `EnvironmentName` varchar(250) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL default '0',
  `UserId` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Feedback`
--

CREATE TABLE IF NOT EXISTS `Feedback` (
  `FeedbackId` int(11) NOT NULL auto_increment,
  `Feedback` text NOT NULL,
  `FeedbackDate` datetime NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Food`
--

CREATE TABLE IF NOT EXISTS `Food` (
  `FoodId` int(11) NOT NULL auto_increment,
  `FoodTypeId` int(11) NOT NULL,
  `FoodDate` datetime NOT NULL,
  `FoodNote` text,
  `IsDeleted` tinyint(1) NOT NULL default '0',
  `PersonId` int(11) default NULL,
  `FoodAmount` varchar(250) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `FoodType`
--

CREATE TABLE IF NOT EXISTS `FoodType` (
  `FoodTypeId` int(11) NOT NULL auto_increment,
  `FoodLongName` varchar(250) default NULL,
  `FoodName` varchar(255) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL default '0',
  `Water` float default NULL,
  `Energ_Kcal` float default NULL,
  `Protein` float default NULL,
  `Lipid_Tot` float default NULL,
  `Ash` float default NULL,
  `Carbohydrt` float default NULL,
  `Fiber_TD` float default NULL,
  `Sugar_Tot` float default NULL,
  `Calcium` float default NULL,
  `Iron` float default NULL,
  `Magnesium` float default NULL,
  `Phosphorus` float default NULL,
  `Potassium` float default NULL,
  `Sodium` float default NULL,
  `Zinc` float default NULL,
  `Copper` float default NULL,
  `Manganese` float default NULL,
  `Selenium` float default NULL,
  `Vit_C` float default NULL,
  `Thiamin` float default NULL,
  `Riboflavin` float default NULL,
  `Niacin` float default NULL,
  `Panto_Acid` float default NULL,
  `Vit_B6` float default NULL,
  `Folate_Tot` float default NULL,
  `Folic_Acid` float default NULL,
  `Food_Folate` float default NULL,
  `Folate_DFE` float default NULL,
  `Choline_Tot` float default NULL,
  `Vit_B12` float default NULL,
  `Vit_A_IU` float default NULL,
  `Vit_A_RAE` float default NULL,
  `Retinol` float default NULL,
  `Alpha_Carot` float default NULL,
  `Beta_Carot` float default NULL,
  `Beta_Crypt` float default NULL,
  `Lycopene` float default NULL,
  `LutPlusZea` float default NULL,
  `Vit_E` float default NULL,
  `Vit_D_mcg` float default NULL,
  `ViVit_D_IU` float default NULL,
  `Vit_K` float default NULL,
  `Fat_Sat` float default NULL,
  `Fat_Mono` float default NULL,
  `Fat_Poly` float default NULL,
  `Cholestrl` float default NULL,
  `GmWt_1` float default NULL,
  `GmWt_Desc1` text,
  `GmWt_2` float default NULL,
  `GmWt_Desc2` text,
  `Refuse_Pct` float default NULL,
  `UserId` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE IF NOT EXISTS `Person` (
  `PersonId` int(11) NOT NULL auto_increment,
  `PersonName` varchar(250) NOT NULL,
  `IsDefault` tinyint(4) NOT NULL default '0',
  `PersonNote` text,
  `CreateDate` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `UserId` int(11) NOT NULL COMMENT 'Add FK to User Table',
  `IsDeleted` tinyint(4) NOT NULL default '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PollenFile`
--

CREATE TABLE IF NOT EXISTS `PollenFile` (
  `FileDate` datetime NOT NULL,
  `AllergyReport` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Reaction`
--

CREATE TABLE IF NOT EXISTS `Reaction` (
  `ReactionId` int(11) NOT NULL auto_increment,
  `ReactionTypeId` int(11) NOT NULL,
  `ReactionDate` datetime NOT NULL,
  `ReactionNote` text,
  `IsDeleted` tinyint(1) NOT NULL default '0',
  `PersonId` int(11) default NULL,
  `ReactionAmount` varchar(250) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ReactionType`
--

CREATE TABLE IF NOT EXISTS `ReactionType` (
  `ReactionTypeId` int(11) NOT NULL auto_increment,
  `ReactionName` varchar(250) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL default '0',
  `UserId` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Treatment`
--

CREATE TABLE IF NOT EXISTS `Treatment` (
  `TreatmentId` int(11) NOT NULL auto_increment,
  `TreatmentTypeId` int(11) NOT NULL,
  `TreatmentDate` datetime NOT NULL,
  `TreatmentNote` text,
  `IsDeleted` tinyint(1) NOT NULL default '0',
  `PersonId` int(11) default NULL,
  `TreatmentAmount` varchar(250) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TreatmentType`
--

CREATE TABLE IF NOT EXISTS `TreatmentType` (
  `TreatmentTypeId` int(11) NOT NULL auto_increment,
  `TreatmentName` varchar(250) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL default '0',
  `UserId` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TypeMergeHistory`
--

CREATE TABLE IF NOT EXISTS `TypeMergeHistory` (
  `TypeMergeHistoryId` int(11) NOT NULL auto_increment,
  `MergeTable` varchar(200) NOT NULL,
  `TableId` int(11) NOT NULL,
  `ToTypeId` int(11) NOT NULL,
  `FromTypeId` int(11) NOT NULL,
  `MergeDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) default NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) default NULL,
  `forgotten_password_code` varchar(40) default NULL,
  `forgotten_password_time` int(11) unsigned default NULL,
  `remember_code` varchar(40) default NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  `company` varchar(100) default NULL,
  `phone` varchar(20) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Environment`
--
ALTER TABLE `Environment`
  ADD PRIMARY KEY  (`EnvironmentId`),
  ADD KEY `UserId` (`PersonId`);

--
-- Indexes for table `EnvironmentType`
--
ALTER TABLE `EnvironmentType`
  ADD PRIMARY KEY  (`EnvironmentTypeId`),
  ADD UNIQUE KEY `EnvironmentName` (`EnvironmentName`,`UserId`);

--
-- Indexes for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY  (`FeedbackId`);

--
-- Indexes for table `Food`
--
ALTER TABLE `Food`
  ADD PRIMARY KEY  (`FoodId`),
  ADD KEY `UserId` (`PersonId`);

--
-- Indexes for table `FoodType`
--
ALTER TABLE `FoodType`
  ADD PRIMARY KEY  (`FoodTypeId`),
  ADD UNIQUE KEY `IX_Food_FoodName` (`FoodName`,`UserId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY  (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY  (`id`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY  (`PersonId`),
  ADD KEY `PersonName` (`PersonName`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `Reaction`
--
ALTER TABLE `Reaction`
  ADD PRIMARY KEY  (`ReactionId`),
  ADD KEY `UserId` (`PersonId`);

--
-- Indexes for table `ReactionType`
--
ALTER TABLE `ReactionType`
  ADD PRIMARY KEY  (`ReactionTypeId`),
  ADD UNIQUE KEY `ReactionName` (`ReactionName`,`UserId`);

--
-- Indexes for table `Treatment`
--
ALTER TABLE `Treatment`
  ADD PRIMARY KEY  (`TreatmentId`),
  ADD KEY `UserId` (`PersonId`);

--
-- Indexes for table `TreatmentType`
--
ALTER TABLE `TreatmentType`
  ADD PRIMARY KEY  (`TreatmentTypeId`),
  ADD UNIQUE KEY `MedicineName` (`TreatmentName`,`UserId`);

--
-- Indexes for table `TypeMergeHistory`
--
ALTER TABLE `TypeMergeHistory`
  ADD PRIMARY KEY  (`TypeMergeHistoryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY  (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY  (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Environment`
--
ALTER TABLE `Environment`;
--
-- AUTO_INCREMENT for table `EnvironmentType`
--
ALTER TABLE `EnvironmentType`;
--
-- AUTO_INCREMENT for table `Feedback`
--
ALTER TABLE `Feedback`;
--
-- AUTO_INCREMENT for table `Food`
--
ALTER TABLE `Food`;
--
-- AUTO_INCREMENT for table `FoodType`
--
ALTER TABLE `FoodType`;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`;
--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`;
--
-- AUTO_INCREMENT for table `Reaction`
--
ALTER TABLE `Reaction`;
--
-- AUTO_INCREMENT for table `ReactionType`
--
ALTER TABLE `ReactionType`;
--
-- AUTO_INCREMENT for table `Treatment`
--
ALTER TABLE `Treatment`;
--
-- AUTO_INCREMENT for table `TreatmentType`
--
ALTER TABLE `TreatmentType`;
--
-- AUTO_INCREMENT for table `TypeMergeHistory`
--
ALTER TABLE `TypeMergeHistory`;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`;
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
