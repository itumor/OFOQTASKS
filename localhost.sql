-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2014 at 08:51 AM
-- Server version: 5.6.16-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `generator`
--
CREATE DATABASE IF NOT EXISTS `generator` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `generator`;

-- --------------------------------------------------------

--
-- Table structure for table `audittrail`
--

CREATE TABLE IF NOT EXISTS `audittrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `audittrail`
--

INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2014-03-12 19:00:29', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2014-03-12 19:06:49', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(3, '2014-03-12 21:43:39', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4, '2014-03-12 21:48:32', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(5, '2014-03-12 22:00:39', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(6, '2014-03-12 22:00:51', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(7, '2014-03-12 22:03:22', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(8, '2014-03-12 22:03:29', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(9, '2014-03-12 22:10:45', '/sys/logout.php', 'login', 'logout', '::1', '', '', '', ''),
(10, '2014-03-12 22:13:21', '/sys/logout.php', 'login', 'logout', '::1', '', '', '', ''),
(11, '2014-03-12 22:13:26', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(12, '2014-03-12 22:26:12', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(13, '2014-03-12 22:49:32', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(14, '2014-03-12 22:50:05', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(15, '2014-03-12 22:56:30', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(16, '2014-03-12 23:01:36', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(17, '2014-03-12 23:02:02', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(18, '2014-03-12 23:19:18', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(19, '2014-03-12 23:30:23', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(20, '2014-03-13 00:52:41', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(21, '2014-03-13 06:44:50', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(22, '2014-03-13 06:46:28', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(23, '2014-03-13 06:47:18', '/sys/logout.php', 'osamagadallah', 'logout', '::1', '', '', '', ''),
(24, '2014-03-13 07:04:31', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(25, '2014-03-13 07:33:10', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(26, '2014-03-13 07:34:15', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(27, '2014-03-13 07:34:17', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(28, '2014-03-13 07:34:33', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(29, '2014-03-13 07:34:37', '/sys/logout.php', 'login', 'logout', '::1', '', '', '', ''),
(30, '2014-03-13 07:34:41', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(31, '2014-03-13 07:34:45', '/sys/logout.php', 'login', 'logout', '::1', '', '', '', ''),
(32, '2014-03-13 07:34:51', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(33, '2014-03-13 07:34:54', '/sys/logout.php', 'login', 'logout', '::1', '', '', '', ''),
(34, '2014-03-13 07:35:27', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(35, '2014-03-13 07:53:25', '/sys/login.php', 'admin', 'login', '1.1.1.116', '', '', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `command`
--

INSERT INTO `command` (`command_id`, `user_id`, `task_id`, `server_id`, `command_input`, `command_output`, `command_status`, `command_log`, `command_time`) VALUES
(1, 0, 1, 1, 'sudo mysql.sh startmysql 1.1.141 root root', 'mysql start successfully', 'completed', 'MySQL start successfully', '2014-03-12 18:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `function_group`
--

CREATE TABLE IF NOT EXISTS `function_group` (
  `function_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`function_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `function_group`
--

INSERT INTO `function_group` (`function_group_id`, `function_group_name`) VALUES
(1, 'mysql start group');

-- --------------------------------------------------------

--
-- Table structure for table `function_group_relation`
--

CREATE TABLE IF NOT EXISTS `function_group_relation` (
  `function_group_relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_group_id` int(11) NOT NULL,
  `script_function_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`function_group_relation_id`),
  KEY `script_function_id` (`script_function_id`),
  KEY `script_function_id_2` (`script_function_id`),
  KEY `function_group_id` (`function_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `function_group_relation`
--

INSERT INTO `function_group_relation` (`function_group_relation_id`, `function_group_id`, `script_function_id`, `priority`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `generator report`
--
CREATE TABLE IF NOT EXISTS `generator report` (
`task_id` int(11)
,`task_name` varchar(255)
,`task_function_group_id` int(11)
,`function_group_id` int(11)
,`function_group_name` varchar(255)
,`function_group_relation_id` int(11)
,`priority` int(11)
,`script_function_id` int(11)
,`script_function_name` varchar(255)
,`script_id` int(11)
,`script_name` varchar(255)
,`script_path` varchar(255)
,`start_range` int(11)
,`end_range` int(11)
,`parameter_id` int(11)
,`parameter_name` varchar(255)
,`function_group_id1` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `loginname` varchar(255) NOT NULL,
  `loginpassword` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Activated` varchar(255) NOT NULL DEFAULT '1',
  `Profile` text,
  `levels` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlogin`),
  UNIQUE KEY `loginname_UNIQUE` (`loginname`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idlogin`, `loginname`, `loginpassword`, `Email`, `Activated`, `Profile`, `levels`) VALUES
(2, 'login', 'd56b699830e77ba53855679cb1d252da', 'itumor@unitedofoq.com', '1', NULL, -1),
(3, 'osamagadallah', 'e10adc3949ba59abbe56e057f20f883e', 'ohemeda@unitedofoq.com', '1', NULL, -1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`parameter_id`, `script_id`, `parameter_name`) VALUES
(1, 1, 'mysqlIp'),
(2, 1, 'mysqluser'),
(3, 1, 'mysqlpassword');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `script`
--

INSERT INTO `script` (`script_id`, `script_name`, `script_path`, `start_range`, `end_range`) VALUES
(1, 'Mysql', 'Mysql.sh', 1, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `script_function`
--

INSERT INTO `script_function` (`script_function_id`, `script_function_name`, `script_id`) VALUES
(1, 'startMysql', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`server_id`, `server_name`, `server_hostname`, `server_username`, `server_password`, `server_auth_type`, `server_os`, `server_file`, `server_deleted`) VALUES
(1, 'Mysql server', '1.1.1.141', 'root', 'root', 'password', 'ubuntu', 'mysql.crt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`) VALUES
(1, 'mysql start Task');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `task_function_group`
--

INSERT INTO `task_function_group` (`task_function_group_id`, `task_id`, `function_group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlevelpermissions`
--

CREATE TABLE IF NOT EXISTS `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`userlevelid`,`tablename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlevelpermissions`
--

INSERT INTO `userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}audittrail', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}command', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}function_group', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}function_group_relation', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}generator report', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}login', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}parameter', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}Report Grouping by Task', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}script', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}script_function', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}server', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}task', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}task_function_group', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}userlevelpermissions', 0),
(0, '{3246B9FA-4C51-4733-8040-34B188FCD87E}userlevels', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE IF NOT EXISTS `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL,
  PRIMARY KEY (`userlevelid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlevels`
--

INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Structure for view `generator report`
--
DROP TABLE IF EXISTS `generator report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `generator report` AS select `task`.`task_id` AS `task_id`,`task`.`task_name` AS `task_name`,`task_function_group`.`task_function_group_id` AS `task_function_group_id`,`task_function_group`.`function_group_id` AS `function_group_id`,`function_group`.`function_group_name` AS `function_group_name`,`function_group_relation`.`function_group_relation_id` AS `function_group_relation_id`,`function_group_relation`.`priority` AS `priority`,`script_function`.`script_function_id` AS `script_function_id`,`script_function`.`script_function_name` AS `script_function_name`,`script`.`script_id` AS `script_id`,`script`.`script_name` AS `script_name`,`script`.`script_path` AS `script_path`,`script`.`start_range` AS `start_range`,`script`.`end_range` AS `end_range`,`parameter`.`parameter_id` AS `parameter_id`,`parameter`.`parameter_name` AS `parameter_name`,`function_group_relation`.`function_group_id` AS `function_group_id1` from ((((((`task` join `task_function_group` on((`task`.`task_id` = `task_function_group`.`task_id`))) join `function_group` on((`task_function_group`.`function_group_id` = `function_group`.`function_group_id`))) join `function_group_relation` on((`function_group`.`function_group_id` = `function_group_relation`.`function_group_id`))) join `script_function` on((`function_group_relation`.`script_function_id` = `script_function`.`script_function_id`))) join `script` on((`script_function`.`script_id` = `script`.`script_id`))) join `parameter` on((`script`.`script_id` = `parameter`.`script_id`))) group by `task`.`task_id`,`task`.`task_name`,`task_function_group`.`task_function_group_id`,`task_function_group`.`function_group_id`,`function_group`.`function_group_name`,`function_group_relation`.`function_group_relation_id`,`function_group_relation`.`priority`,`script_function`.`script_function_id`,`script_function`.`script_function_name`,`script`.`script_id`,`script`.`script_name`,`script`.`script_path`,`script`.`start_range`,`script`.`end_range`,`parameter`.`parameter_id`,`parameter`.`parameter_name`,`function_group_relation`.`function_group_id`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `command_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `command_ibfk_2` FOREIGN KEY (`server_id`) REFERENCES `server` (`server_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `function_group_relation`
--
ALTER TABLE `function_group_relation`
  ADD CONSTRAINT `function_group_relation_ibfk_1` FOREIGN KEY (`function_group_id`) REFERENCES `function_group` (`function_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `function_group_relation_ibfk_2` FOREIGN KEY (`script_function_id`) REFERENCES `script_function` (`script_function_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `task_function_group_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_function_group_ibfk_2` FOREIGN KEY (`function_group_id`) REFERENCES `function_group` (`function_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
