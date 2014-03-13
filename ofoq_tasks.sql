-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2014 at 06:52 PM
-- Server version: 5.5.34-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ofoq_tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE IF NOT EXISTS `command` (
  `command_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `command_input` text NOT NULL,
  `command_output` text NOT NULL,
  `command_status` text NOT NULL,
  `command_log` text NOT NULL,
  `command_time` datetime NOT NULL,
  PRIMARY KEY (`command_id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `function_group`
--

CREATE TABLE IF NOT EXISTS `function_group` (
  `function_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`function_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `function_group_relation`
--

CREATE TABLE IF NOT EXISTS `function_group_relation` (
  `function_group_relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_group_id` int(11) NOT NULL,
  `script_function_id` int(11) NOT NULL,
  PRIMARY KEY (`function_group_relation_id`),
  KEY `script_function_id` (`script_function_id`),
  KEY `script_function_id_2` (`script_function_id`),
  KEY `function_group_id` (`function_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE IF NOT EXISTS `parameter` (
  `parameter_id` int(11) NOT NULL AUTO_INCREMENT,
  `script_id` int(11) NOT NULL,
  `parameter_name` varchar(255) NOT NULL,
  PRIMARY KEY (`parameter_id`),
  KEY `script_id` (`script_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `script`
--

CREATE TABLE IF NOT EXISTS `script` (
  `script_id` int(11) NOT NULL AUTO_INCREMENT,
  `script_name` varchar(255) NOT NULL,
  `script_path` varchar(255) NOT NULL,
  `start_range` int(11) NOT NULL,
  `end_range` int(11) NOT NULL,
  PRIMARY KEY (`script_id`),
  UNIQUE KEY `script_name` (`script_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `script_function`
--

CREATE TABLE IF NOT EXISTS `script_function` (
  `script_function_id` int(11) NOT NULL AUTO_INCREMENT,
  `script_function_name` varchar(255) NOT NULL,
  `script_id` int(11) NOT NULL,
  PRIMARY KEY (`script_function_id`),
  KEY `script_id` (`script_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `server_id` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(255) NOT NULL,
  `server_hostname` text NOT NULL,
  `server_username` varchar(255) NOT NULL,
  `server_password` text NOT NULL,
  `server_auth_type` enum('password','file') NOT NULL,
  `server_os` enum('ubuntu','windows') NOT NULL,
  `server_file` text NOT NULL,
  `server_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `task_function_group`
--

CREATE TABLE IF NOT EXISTS `task_function_group` (
  `task_function_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `function_group_id` int(11) NOT NULL,
  PRIMARY KEY (`task_function_group_id`),
  KEY `task_id` (`task_id`,`function_group_id`),
  KEY `function_group_id` (`function_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `command_ibfk_2` FOREIGN KEY (`server_id`) REFERENCES `server` (`server_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `command_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `function_group_relation`
--
ALTER TABLE `function_group_relation`
  ADD CONSTRAINT `function_group_relation_ibfk_2` FOREIGN KEY (`script_function_id`) REFERENCES `script_function` (`script_function_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `function_group_relation_ibfk_1` FOREIGN KEY (`function_group_id`) REFERENCES `function_group` (`function_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parameter`
--
ALTER TABLE `parameter`
  ADD CONSTRAINT `parameter_ibfk_1` FOREIGN KEY (`script_id`) REFERENCES `script` (`script_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `script_function`
--
ALTER TABLE `script_function`
  ADD CONSTRAINT `script_function_ibfk_1` FOREIGN KEY (`script_id`) REFERENCES `script` (`script_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_function_group`
--
ALTER TABLE `task_function_group`
  ADD CONSTRAINT `task_function_group_ibfk_2` FOREIGN KEY (`function_group_id`) REFERENCES `function_group` (`function_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_function_group_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
