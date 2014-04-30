-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2014 at 12:57 PM
-- Server version: 5.6.17-log
-- PHP Version: 5.4.12

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
-- Table structure for table `addpool_task`
--

CREATE TABLE IF NOT EXISTS `addpool_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishadmin` varchar(255) NOT NULL DEFAULT '',
  `GLUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSFILE` varchar(255) NOT NULL DEFAULT '',
  `JDBCNAME` varchar(255) NOT NULL DEFAULT '',
  `DBS_JDBC` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `addresource_task`
--

CREATE TABLE IF NOT EXISTS `addresource_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishadmin` varchar(255) NOT NULL DEFAULT '',
  `GLUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSFILE` varchar(255) NOT NULL DEFAULT '',
  `JDBCNAME` varchar(255) NOT NULL DEFAULT '',
  `DBS_JDBC` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5216 ;

--
-- Dumping data for table `audittrail`
--

INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(4144, '2014-03-26 16:15:19', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(4145, '2014-03-26 16:15:20', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(4146, '2014-03-26 16:15:29', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(4147, '2014-03-26 16:24:32', '/sys/taskadd.php', '2', 'A', 'task', 'task_name', '4', '', 'drop mysql'),
(4148, '2014-03-26 16:24:32', '/sys/taskadd.php', '2', 'A', 'task', 'task_id', '4', '', '4'),
(4149, '2014-03-26 16:27:33', '/sys/scriptadd.php', '2', 'A', 'script', 'script_name', '3', '', 'mysqladmin'),
(4150, '2014-03-26 16:27:33', '/sys/scriptadd.php', '2', 'A', 'script', 'script_path', '3', '', 'mysqladmin.sh'),
(4151, '2014-03-26 16:27:33', '/sys/scriptadd.php', '2', 'A', 'script', 'start_range', '3', '', '0'),
(4152, '2014-03-26 16:27:33', '/sys/scriptadd.php', '2', 'A', 'script', 'end_range', '3', '', '0'),
(4153, '2014-03-26 16:27:33', '/sys/scriptadd.php', '2', 'A', 'script', 'script_id', '3', '', '3'),
(4154, '2014-03-26 16:27:49', '/sys/script_functionadd.php', '2', 'A', 'script_function', 'script_function_name', '6', '', 'start'),
(4155, '2014-03-26 16:27:49', '/sys/script_functionadd.php', '2', 'A', 'script_function', 'script_id', '6', '', '3'),
(4156, '2014-03-26 16:27:49', '/sys/script_functionadd.php', '2', 'A', 'script_function', 'script_function_id', '6', '', '6'),
(4157, '2014-03-26 16:28:02', '/sys/function_groupadd.php', '2', 'A', 'function_group', 'function_group_name', '3', '', 'start'),
(4158, '2014-03-26 16:28:02', '/sys/function_groupadd.php', '2', 'A', 'function_group', 'function_group_id', '3', '', '3'),
(4159, '2014-03-26 16:28:39', '/sys/function_group_relationadd.php', '2', 'A', 'function_group_relation', 'function_group_id', '4', '', '3'),
(4160, '2014-03-26 16:28:39', '/sys/function_group_relationadd.php', '2', 'A', 'function_group_relation', 'script_function_id', '4', '', '6'),
(4161, '2014-03-26 16:28:39', '/sys/function_group_relationadd.php', '2', 'A', 'function_group_relation', 'priority', '4', '', '1'),
(4162, '2014-03-26 16:28:39', '/sys/function_group_relationadd.php', '2', 'A', 'function_group_relation', 'function_group_relation_id', '4', '', '4'),
(4163, '2014-03-26 16:28:53', '/sys/taskedit.php', '2', 'U', 'task', 'task_name', '4', 'drop mysql', 'start'),
(4164, '2014-03-26 16:29:02', '/sys/task_function_groupadd.php', '2', 'A', 'task_function_group', 'task_id', '4', '', '4'),
(4165, '2014-03-26 16:29:02', '/sys/task_function_groupadd.php', '2', 'A', 'task_function_group', 'function_group_id', '4', '', '3'),
(4166, '2014-03-26 16:29:02', '/sys/task_function_groupadd.php', '2', 'A', 'task_function_group', 'task_function_group_id', '4', '', '4'),
(4167, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_name', '3', '', 'mysql189'),
(4168, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_hostname', '3', '', '1.1.1.189'),
(4169, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_username', '3', '', 'root'),
(4170, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_password', '3', '', 'ROOT'),
(4171, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_auth_type', '3', '', 'password'),
(4172, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_os', '3', '', 'ubuntu'),
(4173, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_file', '3', '', 'mysqladmin(1).sh'),
(4174, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_deleted', '3', '', '0'),
(4175, '2014-03-26 16:30:09', '/sys/serveradd.php', '2', 'A', 'server', 'server_id', '3', '', '3'),
(4176, '2014-03-26 16:31:56', '/sys/parameteradd.php', '2', 'A', 'parameter', 'script_id', '8', '', '3'),
(4177, '2014-03-26 16:31:56', '/sys/parameteradd.php', '2', 'A', 'parameter', 'parameter_name', '8', '', 'server_id_mysqladmin'),
(4178, '2014-03-26 16:31:56', '/sys/parameteradd.php', '2', 'A', 'parameter', 'parameter_id', '8', '', '8'),
(4179, '2014-03-26 19:03:21', '/sys/logout.php', 'login', 'logout', '::1', '', '', '', ''),
(4180, '2014-03-26 19:13:35', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4181, '2014-03-26 19:16:37', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '7', '', 'restart'),
(4182, '2014-03-26 19:16:37', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '7', '', '3'),
(4183, '2014-03-26 19:16:37', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '7', '', '7'),
(4184, '2014-03-26 19:17:11', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '4', '', 'restart'),
(4185, '2014-03-26 19:17:11', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '4', '', '4'),
(4186, '2014-03-26 19:17:31', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '5', '', '4'),
(4187, '2014-03-26 19:17:31', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '5', '', '7'),
(4188, '2014-03-26 19:17:31', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '5', '', '1'),
(4189, '2014-03-26 19:17:31', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '5', '', '5'),
(4190, '2014-03-26 19:18:28', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '5', '', 'restart'),
(4191, '2014-03-26 19:18:28', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '5', '', '1'),
(4192, '2014-03-26 19:18:28', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '5', '', '1'),
(4193, '2014-03-26 19:18:28', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '5', '', '5'),
(4194, '2014-03-26 19:19:39', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '5', '', '5'),
(4195, '2014-03-26 19:19:39', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '5', '', '4'),
(4196, '2014-03-26 19:19:39', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '5', '', '5'),
(4197, '2014-03-26 19:20:04', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '5', 'CREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4198, '2014-03-26 19:20:04', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '5', '$parameters = array(\n);\nadd_cron_task("restart","$parameters");', '$parameters = array(\r\n);\r\nadd_cron_task("restart","$parameters");'),
(4199, '2014-03-26 19:20:44', '/sys/taskdelete.php', '-1', '*** Batch delete begin ***', 'task', '', '', '', ''),
(4200, '2014-03-26 19:20:45', '/sys/taskdelete.php', '-1', 'D', 'task', 'task_id', '5', '5', ''),
(4201, '2014-03-26 19:20:45', '/sys/taskdelete.php', '-1', 'D', 'task', 'task_name', '5', 'restart', ''),
(4202, '2014-03-26 19:20:45', '/sys/taskdelete.php', '-1', 'D', 'task', 'sqlscript', '5', 'CREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', ''),
(4203, '2014-03-26 19:20:45', '/sys/taskdelete.php', '-1', 'D', 'task', 'phpscript', '5', '$parameters = array(\r\n);\r\nadd_cron_task("restart","$parameters");', ''),
(4204, '2014-03-26 19:20:45', '/sys/taskdelete.php', '-1', '*** Batch delete successful ***', 'task', '', '', '', ''),
(4205, '2014-03-26 19:21:08', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '6', '', '4'),
(4206, '2014-03-26 19:21:08', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '6', '', '4'),
(4207, '2014-03-26 19:21:08', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '6', '', '6'),
(4208, '2014-03-26 19:21:22', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '6', '', 'restart'),
(4209, '2014-03-26 19:21:22', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '6', '', '1'),
(4210, '2014-03-26 19:21:22', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '6', '', '1'),
(4211, '2014-03-26 19:21:22', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '6', '', '6'),
(4212, '2014-03-26 19:22:49', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '7', '', 'add new t'),
(4213, '2014-03-26 19:22:49', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '7', '', 'sa'),
(4214, '2014-03-26 19:22:49', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '7', '', 'as'),
(4215, '2014-03-26 19:22:49', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '7', '', '7'),
(4216, '2014-03-26 19:32:30', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'CREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4217, '2014-03-26 19:32:30', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n);\nadd_cron_task("restart","$parameters");', '$parameters = array(\r\n);\r\nadd_cron_task("restart","$parameters");'),
(4218, '2014-03-26 19:33:22', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '7', '', '4'),
(4219, '2014-03-26 19:33:22', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '7', '', '3'),
(4220, '2014-03-26 19:33:22', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '7', '', '7'),
(4221, '2014-03-26 19:33:39', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '8', '', 'start'),
(4222, '2014-03-26 19:33:39', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '8', '', 'a'),
(4223, '2014-03-26 19:33:39', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '8', '', 'sasas'),
(4224, '2014-03-26 19:33:39', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '8', '', '8'),
(4225, '2014-03-26 19:33:58', '/sys/taskedit.php', '-1', 'U', 'task', 'task_name', '8', 'start', 'start1'),
(4226, '2014-03-26 19:36:43', '/sys/task_function_groupedit.php', '-1', 'U', 'task_function_group', 'task_id', '6', '4', '6'),
(4227, '2014-03-26 19:37:00', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'CREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4228, '2014-03-26 19:37:00', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n);\nadd_cron_task("restart","$parameters");', '$parameters = array(\r\n);\r\nadd_cron_task("restart","$parameters");'),
(4229, '2014-03-26 19:38:13', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '8', '', '6'),
(4230, '2014-03-26 19:38:13', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '8', '', '3'),
(4231, '2014-03-26 19:38:13', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '8', '', '8'),
(4232, '2014-03-26 19:38:25', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'CREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4233, '2014-03-26 19:38:25', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart","$parameters");', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("restart","$parameters");'),
(4234, '2014-03-26 21:07:53', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '8', '', 'list'),
(4235, '2014-03-26 21:07:53', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '8', '', '3'),
(4236, '2014-03-26 21:07:53', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '8', '', '8'),
(4237, '2014-03-26 21:08:22', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '9', '', '3'),
(4238, '2014-03-26 21:08:22', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '9', '', 'USERNAME'),
(4239, '2014-03-26 21:08:22', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '9', '', '9'),
(4240, '2014-03-26 21:08:40', '/sys/parameteredit.php', '-1', 'U', 'parameter', 'parameter_name', '9', 'USERNAME', 'HOSTNAME'),
(4241, '2014-03-26 21:09:10', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '10', '', '3'),
(4242, '2014-03-26 21:09:10', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '10', '', 'USERNAME'),
(4243, '2014-03-26 21:09:10', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '10', '', '10'),
(4244, '2014-03-26 21:09:20', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '11', '', '3'),
(4245, '2014-03-26 21:09:20', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '11', '', 'PASSWORD'),
(4246, '2014-03-26 21:09:20', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '11', '', '11'),
(4247, '2014-03-26 21:09:38', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '5', '', 'list'),
(4248, '2014-03-26 21:09:38', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '5', '', '5'),
(4249, '2014-03-26 21:09:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '6', '', '5'),
(4250, '2014-03-26 21:09:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '6', '', '8'),
(4251, '2014-03-26 21:09:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '6', '', '1'),
(4252, '2014-03-26 21:09:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '6', '', '6'),
(4253, '2014-03-26 21:10:14', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '7', '', '5'),
(4254, '2014-03-26 21:10:14', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '7', '', '6'),
(4255, '2014-03-26 21:10:14', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '7', '', '2'),
(4256, '2014-03-26 21:10:14', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '7', '', '7'),
(4257, '2014-03-26 21:10:40', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '9', '', 'listandstart'),
(4258, '2014-03-26 21:10:40', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '9', '', 'a'),
(4259, '2014-03-26 21:10:40', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '9', '', 'aa'),
(4260, '2014-03-26 21:10:40', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '9', '', '9'),
(4261, '2014-03-26 21:10:57', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '9', '', '9'),
(4262, '2014-03-26 21:10:57', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '9', '', '5'),
(4263, '2014-03-26 21:10:57', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '9', '', '9'),
(4264, '2014-03-26 21:11:58', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '9', 'CREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `listandstart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4265, '2014-03-26 21:11:58', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("listandstart",$parameters);'),
(4266, '2014-03-26 21:34:21', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4267, '2014-03-26 21:39:30', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4268, '2014-03-27 07:51:03', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4269, '2014-03-27 16:51:50', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4270, '2014-03-30 07:00:57', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4271, '2014-03-30 07:32:11', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '12', '', '3'),
(4272, '2014-03-30 07:32:11', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '12', '', 'DATABASE'),
(4273, '2014-03-30 07:32:11', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '12', '', '12'),
(4274, '2014-03-30 07:32:27', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '13', '', '3'),
(4275, '2014-03-30 07:32:27', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '13', '', 'FILEPATH'),
(4276, '2014-03-30 07:32:27', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '13', '', '13'),
(4277, '2014-03-30 07:32:43', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '14', '', '3'),
(4278, '2014-03-30 07:32:43', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '14', '', 'FILENAME'),
(4279, '2014-03-30 07:32:43', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '14', '', '14'),
(4280, '2014-03-30 07:33:36', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '9', '', 'stop'),
(4281, '2014-03-30 07:33:36', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '9', '', '3'),
(4282, '2014-03-30 07:33:36', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '9', '', '9'),
(4283, '2014-03-30 07:33:50', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '10', '', 'drop'),
(4284, '2014-03-30 07:33:50', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '10', '', '3'),
(4285, '2014-03-30 07:33:50', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '10', '', '10'),
(4286, '2014-03-30 07:34:59', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '11', '', 'create'),
(4287, '2014-03-30 07:34:59', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '11', '', '3'),
(4288, '2014-03-30 07:34:59', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '11', '', '11'),
(4289, '2014-03-30 07:35:13', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '12', '', 'backup'),
(4290, '2014-03-30 07:35:13', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '12', '', '3'),
(4291, '2014-03-30 07:35:13', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '12', '', '12'),
(4292, '2014-03-30 07:35:27', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '13', '', 'update'),
(4293, '2014-03-30 07:35:27', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '13', '', '3'),
(4294, '2014-03-30 07:35:27', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '13', '', '13'),
(4295, '2014-03-30 07:35:40', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '14', '', 'restore'),
(4296, '2014-03-30 07:35:40', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '14', '', '3'),
(4297, '2014-03-30 07:35:40', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '14', '', '14'),
(4298, '2014-03-30 07:36:46', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '6', '', 'stop'),
(4299, '2014-03-30 07:36:46', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '6', '', '6'),
(4300, '2014-03-30 07:37:02', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '7', '', 'drop'),
(4301, '2014-03-30 07:37:02', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '7', '', '7'),
(4302, '2014-03-30 07:37:14', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '8', '', 'create'),
(4303, '2014-03-30 07:37:14', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '8', '', '8'),
(4304, '2014-03-30 07:37:25', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '9', '', 'backup'),
(4305, '2014-03-30 07:37:25', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '9', '', '9'),
(4306, '2014-03-30 07:37:36', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '10', '', 'update'),
(4307, '2014-03-30 07:37:36', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '10', '', '10'),
(4308, '2014-03-30 07:37:47', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '11', '', 'restore'),
(4309, '2014-03-30 07:37:47', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '11', '', '11'),
(4310, '2014-03-30 07:38:06', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '8', '', '3'),
(4311, '2014-03-30 07:38:06', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '8', '', '6'),
(4312, '2014-03-30 07:38:06', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '8', '', '1'),
(4313, '2014-03-30 07:38:06', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '8', '', '8'),
(4314, '2014-03-30 07:38:15', '/sys/function_group_relationdelete.php', '-1', '*** Batch delete begin ***', 'function_group_relation', '', '', '', ''),
(4315, '2014-03-30 07:38:15', '/sys/function_group_relationdelete.php', '-1', 'D', 'function_group_relation', 'function_group_relation_id', '8', '8', ''),
(4316, '2014-03-30 07:38:15', '/sys/function_group_relationdelete.php', '-1', 'D', 'function_group_relation', 'function_group_id', '8', '3', ''),
(4317, '2014-03-30 07:38:15', '/sys/function_group_relationdelete.php', '-1', 'D', 'function_group_relation', 'script_function_id', '8', '6', ''),
(4318, '2014-03-30 07:38:15', '/sys/function_group_relationdelete.php', '-1', 'D', 'function_group_relation', 'priority', '8', '1', ''),
(4319, '2014-03-30 07:38:15', '/sys/function_group_relationdelete.php', '-1', '*** Batch delete successful ***', 'function_group_relation', '', '', '', ''),
(4320, '2014-03-30 08:05:17', '/sys/login.php', 'admin', 'login', '1.1.1.157', '', '', '', ''),
(4321, '2014-03-30 08:07:04', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4322, '2014-03-30 08:47:04', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4323, '2014-03-30 08:47:50', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '9', '', '6'),
(4324, '2014-03-30 08:47:50', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '9', '', '9'),
(4325, '2014-03-30 08:47:50', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '9', '', '1'),
(4326, '2014-03-30 08:47:50', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '9', '', '9'),
(4327, '2014-03-30 08:48:00', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '10', '', '7'),
(4328, '2014-03-30 08:48:00', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '10', '', '10'),
(4329, '2014-03-30 08:48:00', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '10', '', '1'),
(4330, '2014-03-30 08:48:00', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '10', '', '10'),
(4331, '2014-03-30 08:48:10', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '11', '', '8'),
(4332, '2014-03-30 08:48:10', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '11', '', '11'),
(4333, '2014-03-30 08:48:10', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '11', '', '1'),
(4334, '2014-03-30 08:48:10', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '11', '', '11'),
(4335, '2014-03-30 08:48:19', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '12', '', '9'),
(4336, '2014-03-30 08:48:19', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '12', '', '12'),
(4337, '2014-03-30 08:48:19', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '12', '', '1'),
(4338, '2014-03-30 08:48:19', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '12', '', '12'),
(4339, '2014-03-30 08:48:30', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '13', '', '10'),
(4340, '2014-03-30 08:48:30', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '13', '', '13'),
(4341, '2014-03-30 08:48:30', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '13', '', '1'),
(4342, '2014-03-30 08:48:30', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '13', '', '13'),
(4343, '2014-03-30 08:48:39', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '14', '', '11'),
(4344, '2014-03-30 08:48:39', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '14', '', '14'),
(4345, '2014-03-30 08:48:39', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '14', '', '1'),
(4346, '2014-03-30 08:48:39', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '14', '', '14'),
(4347, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', '*** Batch delete begin ***', 'task', '', '', '', ''),
(4348, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', 'D', 'task', 'task_id', '7', '7', ''),
(4349, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', 'D', 'task', 'task_name', '7', 'add new t', ''),
(4350, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', 'D', 'task', 'sqlscript', '7', 'CREATE TABLE IF NOT EXISTS `add_new_t_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', ''),
(4351, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', 'D', 'task', 'phpscript', '7', '$parameters = array(\n);\nadd_cron_task("add new t","$parameters");', ''),
(4352, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', 'D', 'task', 'task_id', '8', '8', ''),
(4353, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', 'D', 'task', 'task_name', '8', 'start1', ''),
(4354, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', 'D', 'task', 'sqlscript', '8', 'CREATE TABLE IF NOT EXISTS `start1_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', ''),
(4355, '2014-03-30 08:49:01', '/sys/taskdelete.php', '-1', 'D', 'task', 'phpscript', '8', '$parameters = array(\n);\nadd_cron_task("start1","$parameters");', ''),
(4356, '2014-03-30 08:49:02', '/sys/taskdelete.php', '-1', '*** Batch delete successful ***', 'task', '', '', '', ''),
(4357, '2014-03-30 08:49:25', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '10', '', 'stop'),
(4358, '2014-03-30 08:49:25', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '10', '', 'stop'),
(4359, '2014-03-30 08:49:25', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '10', '', 'stop'),
(4360, '2014-03-30 08:49:25', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '10', '', '10'),
(4361, '2014-03-30 08:49:35', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '11', '', 'drop'),
(4362, '2014-03-30 08:49:35', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '11', '', 'drop'),
(4363, '2014-03-30 08:49:35', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '11', '', 'drop'),
(4364, '2014-03-30 08:49:35', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '11', '', '11'),
(4365, '2014-03-30 08:49:46', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '12', '', 'create'),
(4366, '2014-03-30 08:49:46', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '12', '', 'create'),
(4367, '2014-03-30 08:49:46', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '12', '', 'create'),
(4368, '2014-03-30 08:49:46', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '12', '', '12'),
(4369, '2014-03-30 08:49:54', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '13', '', 'backup'),
(4370, '2014-03-30 08:49:54', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '13', '', 'backup'),
(4371, '2014-03-30 08:49:54', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '13', '', 'backup'),
(4372, '2014-03-30 08:49:54', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '13', '', '13'),
(4373, '2014-03-30 08:50:03', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '14', '', 'update'),
(4374, '2014-03-30 08:50:03', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '14', '', 'update'),
(4375, '2014-03-30 08:50:03', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '14', '', 'update'),
(4376, '2014-03-30 08:50:03', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '14', '', '14'),
(4377, '2014-03-30 08:50:12', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '15', '', 'restore'),
(4378, '2014-03-30 08:50:12', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '15', '', 'restore'),
(4379, '2014-03-30 08:50:12', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '15', '', 'restore'),
(4380, '2014-03-30 08:50:12', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '15', '', '15'),
(4381, '2014-03-30 08:50:34', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '10', '', '10'),
(4382, '2014-03-30 08:50:34', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '10', '', '6'),
(4383, '2014-03-30 08:50:34', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '10', '', '10'),
(4384, '2014-03-30 08:50:43', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '11', '', '11'),
(4385, '2014-03-30 08:50:43', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '11', '', '7'),
(4386, '2014-03-30 08:50:43', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '11', '', '11'),
(4387, '2014-03-30 08:50:51', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '12', '', '12'),
(4388, '2014-03-30 08:50:51', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '12', '', '8'),
(4389, '2014-03-30 08:50:51', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '12', '', '12'),
(4390, '2014-03-30 08:51:00', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '13', '', '13'),
(4391, '2014-03-30 08:51:00', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '13', '', '9'),
(4392, '2014-03-30 08:51:00', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '13', '', '13'),
(4393, '2014-03-30 08:51:10', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '14', '', '14'),
(4394, '2014-03-30 08:51:10', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '14', '', '10'),
(4395, '2014-03-30 08:51:10', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '14', '', '14'),
(4396, '2014-03-30 08:51:18', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '15', '', '15'),
(4397, '2014-03-30 08:51:18', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '15', '', '11'),
(4398, '2014-03-30 08:51:18', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '15', '', '15'),
(4399, '2014-03-30 08:51:45', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '10', 'CREATE TABLE IF NOT EXISTS `stop_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `stop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4400, '2014-03-30 08:51:45', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '10', '$parameters = array(\n);\nadd_cron_task("stop",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("stop",$parameters);'),
(4401, '2014-03-30 08:51:56', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '11', 'CREATE TABLE IF NOT EXISTS `drop_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `drop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4402, '2014-03-30 08:51:56', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '11', '$parameters = array(\n);\nadd_cron_task("drop",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("drop",$parameters);'),
(4403, '2014-03-30 08:52:05', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '12', 'CREATE TABLE IF NOT EXISTS `create_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `create_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4404, '2014-03-30 08:52:05', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '12', '$parameters = array(\n);\nadd_cron_task("create",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("create",$parameters);'),
(4405, '2014-03-30 08:52:12', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '13', 'CREATE TABLE IF NOT EXISTS `backup_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `backup_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4406, '2014-03-30 08:52:12', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '13', '$parameters = array(\n);\nadd_cron_task("backup",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("backup",$parameters);'),
(4407, '2014-03-30 08:52:19', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '14', 'CREATE TABLE IF NOT EXISTS `update_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `update_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4408, '2014-03-30 08:52:19', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '14', '$parameters = array(\n);\nadd_cron_task("update",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("update",$parameters);'),
(4409, '2014-03-30 08:52:26', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '15', 'CREATE TABLE IF NOT EXISTS `restore_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `restore_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4410, '2014-03-30 08:52:26', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '15', '$parameters = array(\n);\nadd_cron_task("restore",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("restore",$parameters);'),
(4411, '2014-03-30 08:54:33', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4412, '2014-03-30 08:59:54', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'CREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4413, '2014-03-30 08:59:54', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4414, '2014-03-30 09:00:31', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'CREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4415, '2014-03-30 09:00:31', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4416, '2014-03-30 09:53:37', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(4417, '2014-03-30 09:55:45', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4418, '2014-03-30 10:20:54', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4419, '2014-03-31 08:41:09', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4420, '2014-03-31 08:41:38', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'CREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4421, '2014-03-31 08:41:38', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4422, '2014-03-31 08:44:34', '/sys/parameteredit.php', '-1', 'U', 'parameter', 'parameter_name', '10', 'USERNAME', 'DBUSERNAME'),
(4423, '2014-03-31 08:44:50', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4424, '2014-03-31 08:44:50', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4425, '2014-04-03 10:09:32', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4426, '2014-04-03 10:11:13', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_name', '4', '', 'asadmin'),
(4427, '2014-04-03 10:11:13', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_path', '4', '', 'asadmin.sh'),
(4428, '2014-04-03 10:11:13', '/sys/scriptadd.php', '-1', 'A', 'script', 'start_range', '4', '', '1'),
(4429, '2014-04-03 10:11:13', '/sys/scriptadd.php', '-1', 'A', 'script', 'end_range', '4', '', '1'),
(4430, '2014-04-03 10:11:13', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_id', '4', '', '4'),
(4431, '2014-04-03 10:11:45', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_name', '5', '', 'glassfishadmin'),
(4432, '2014-04-03 10:11:45', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_path', '5', '', 'glassfishadmin.sh'),
(4433, '2014-04-03 10:11:45', '/sys/scriptadd.php', '-1', 'A', 'script', 'start_range', '5', '', '1'),
(4434, '2014-04-03 10:11:45', '/sys/scriptadd.php', '-1', 'A', 'script', 'end_range', '5', '', '1'),
(4435, '2014-04-03 10:11:45', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_id', '5', '', '5'),
(4436, '2014-04-03 13:15:52', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4437, '2014-04-03 13:18:04', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4438, '2014-04-03 13:18:04', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4439, '2014-04-03 13:20:19', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8');
INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(4440, '2014-04-03 13:20:19', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4441, '2014-04-03 13:21:11', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4442, '2014-04-03 13:21:11', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("start",$parameters);'),
(4443, '2014-04-03 13:22:05', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4444, '2014-04-03 13:22:05', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("start",$parameters);'),
(4445, '2014-04-03 13:25:39', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4446, '2014-04-03 13:25:39', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("start",$parameters);'),
(4447, '2014-04-03 13:25:59', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4448, '2014-04-03 13:25:59', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("start",$parameters);'),
(4449, '2014-04-03 13:26:34', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4450, '2014-04-03 13:26:34', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("start",$parameters);'),
(4451, '2014-04-03 13:27:17', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'CREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4452, '2014-04-03 13:27:17', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4453, '2014-04-03 13:31:57', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4454, '2014-04-03 13:31:57', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("start",$parameters);'),
(4455, '2014-04-03 16:51:33', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4456, '2014-04-03 16:52:06', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4457, '2014-04-03 16:52:06', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("start",$parameters);'),
(4458, '2014-04-03 16:52:43', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4459, '2014-04-03 16:52:43', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4460, '2014-04-03 16:52:59', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4461, '2014-04-03 16:52:59', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4462, '2014-04-03 16:53:51', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4463, '2014-04-03 16:53:51', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4464, '2014-04-03 16:55:35', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4465, '2014-04-03 16:55:35', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4466, '2014-04-03 16:55:50', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4467, '2014-04-03 16:55:50', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4468, '2014-04-03 16:56:00', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '10', 'CREATE TABLE IF NOT EXISTS `stop_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `stop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4469, '2014-04-03 16:56:00', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '10', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("stop",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("stop",$parameters);'),
(4470, '2014-04-03 16:57:40', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4471, '2014-04-03 16:57:40', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4472, '2014-04-03 16:57:49', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '9', 'CREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `listandstart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4473, '2014-04-03 16:57:49', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("listandstart",$parameters);'),
(4474, '2014-04-03 16:58:01', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4475, '2014-04-03 16:58:01', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4476, '2014-04-03 16:59:23', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4480, '2014-04-03 17:14:21', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4481, '2014-04-03 17:14:21', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4482, '2014-04-03 17:14:26', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4483, '2014-04-03 17:14:26', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4484, '2014-04-03 17:14:34', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '9', 'DROP TABLE IF EXISTS `listandstart_task`; \nCREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `listandstart_task`; \r\nCREATE TABLE IF NOT EXISTS `listandstart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4485, '2014-04-03 17:14:34', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n);\r\nadd_cron_task("listandstart",$parameters);'),
(4486, '2014-04-03 17:14:44', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '10', 'DROP TABLE IF EXISTS `stop_task`; \nCREATE TABLE IF NOT EXISTS `stop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `stop_task`; \r\nCREATE TABLE IF NOT EXISTS `stop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4487, '2014-04-03 17:14:44', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '10', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("stop",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("stop",$parameters);'),
(4488, '2014-04-03 17:14:49', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '11', 'CREATE TABLE IF NOT EXISTS `drop_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `drop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4489, '2014-04-03 17:14:49', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '11', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("drop",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("drop",$parameters);'),
(4490, '2014-04-03 17:14:59', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '15', 'CREATE TABLE IF NOT EXISTS `restore_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `restore_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4491, '2014-04-03 17:14:59', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '15', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("restore",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("restore",$parameters);'),
(4492, '2014-04-03 17:15:15', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '15', 'DROP TABLE IF EXISTS `restore_task`; \nCREATE TABLE IF NOT EXISTS `restore_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restore_task`; \r\nCREATE TABLE IF NOT EXISTS `restore_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4493, '2014-04-03 17:15:15', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '15', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("restore",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("restore",$parameters);'),
(4497, '2014-04-03 17:17:19', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4498, '2014-04-03 17:17:19', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4499, '2014-04-03 17:17:30', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4500, '2014-04-03 17:17:30', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4501, '2014-04-03 17:17:47', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4502, '2014-04-03 17:17:47', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4503, '2014-04-03 17:17:53', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '6', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4504, '2014-04-03 17:17:53', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '6', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("restart",$parameters);'),
(4505, '2014-04-03 17:18:00', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '9', 'DROP TABLE IF EXISTS `listandstart_task`; \nCREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `listandstart_task`; \r\nCREATE TABLE IF NOT EXISTS `listandstart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4506, '2014-04-03 17:18:00', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n);\r\nadd_cron_task("listandstart",$parameters);'),
(4507, '2014-04-03 17:18:07', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '9', 'DROP TABLE IF EXISTS `listandstart_task`; \nCREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `listandstart_task`; \r\nCREATE TABLE IF NOT EXISTS `listandstart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4508, '2014-04-03 17:18:07', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n);\r\nadd_cron_task("listandstart",$parameters);'),
(4509, '2014-04-03 17:18:12', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '10', 'DROP TABLE IF EXISTS `stop_task`; \nCREATE TABLE IF NOT EXISTS `stop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `stop_task`; \r\nCREATE TABLE IF NOT EXISTS `stop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4510, '2014-04-03 17:18:12', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '10', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("stop",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("stop",$parameters);'),
(4511, '2014-04-03 17:18:17', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '11', 'DROP TABLE IF EXISTS `drop_task`; \nCREATE TABLE IF NOT EXISTS `drop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `drop_task`; \r\nCREATE TABLE IF NOT EXISTS `drop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4512, '2014-04-03 17:18:17', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '11', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n);\nadd_cron_task("drop",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n);\r\nadd_cron_task("drop",$parameters);'),
(4513, '2014-04-03 17:18:22', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '12', 'CREATE TABLE IF NOT EXISTS `create_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `create_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4514, '2014-04-03 17:18:22', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '12', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("create",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("create",$parameters);'),
(4515, '2014-04-03 17:18:26', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '13', 'CREATE TABLE IF NOT EXISTS `backup_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `backup_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4516, '2014-04-03 17:18:26', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '13', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("backup",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("backup",$parameters);'),
(4517, '2014-04-03 17:18:31', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '14', 'CREATE TABLE IF NOT EXISTS `update_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'CREATE TABLE IF NOT EXISTS `update_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4518, '2014-04-03 17:18:31', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '14', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("update",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("update",$parameters);');
INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(4519, '2014-04-03 17:18:36', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '15', 'DROP TABLE IF EXISTS `restore_task`; \nCREATE TABLE IF NOT EXISTS `restore_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restore_task`; \r\nCREATE TABLE IF NOT EXISTS `restore_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4520, '2014-04-03 17:18:36', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '15', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("restore",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("restore",$parameters);'),
(4521, '2014-04-03 18:55:51', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4522, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_name', '4', '', 'mysql141'),
(4523, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_hostname', '4', '', '1.1.1.141'),
(4524, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_username', '4', '', 'root'),
(4525, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_password', '4', '', 'root'),
(4526, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_auth_type', '4', '', 'password'),
(4527, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_os', '4', '', 'ubuntu'),
(4528, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_file', '4', '', 'mysqladmin(1).sh'),
(4529, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_deleted', '4', '', '0'),
(4530, '2014-04-03 19:11:07', '/sys/serveradd.php', '-1', 'A', 'server', 'server_id', '4', '', '4'),
(4531, '2014-04-03 21:22:07', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4532, '2014-04-05 08:37:52', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4533, '2014-04-05 18:31:51', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4534, '2014-04-05 18:40:05', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(4535, '2014-04-05 19:12:44', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4536, '2014-04-05 19:13:44', '/sys/taskedit.php', '-1', 'U', 'task', 'task_name', '4', 'start', 'StartMysqlServer'),
(4537, '2014-04-05 19:13:44', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_task`; \r\nCREATE TABLE IF NOT EXISTS `start_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4538, '2014-04-05 19:13:44', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("start",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("start",$parameters);'),
(4539, '2014-04-05 19:14:00', '/sys/taskedit.php', '-1', 'U', 'task', 'task_name', '4', 'StartMysqlServer', 'start'),
(4540, '2014-04-05 19:14:00', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '4', 'DROP TABLE IF EXISTS `StartMysqlServer_task`; \nCREATE TABLE IF NOT EXISTS `StartMysqlServer_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `StartMysqlServer_task`; \r\nCREATE TABLE IF NOT EXISTS `StartMysqlServer_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4541, '2014-04-05 19:14:00', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '4', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("StartMysqlServer",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("StartMysqlServer",$parameters);'),
(4542, '2014-04-05 19:22:08', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '9', 'DROP TABLE IF EXISTS `listandstart_task`; \nCREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `listandstart_task`; \r\nCREATE TABLE IF NOT EXISTS `listandstart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4543, '2014-04-05 19:22:08', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n);\r\nadd_cron_task("listandstart",$parameters);'),
(4544, '2014-04-05 19:22:20', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '9', 'DROP TABLE IF EXISTS `listandstart_task`; \nCREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `listandstart_task`; \r\nCREATE TABLE IF NOT EXISTS `listandstart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4545, '2014-04-05 19:22:20', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n);\r\nadd_cron_task("listandstart",$parameters);'),
(4546, '2014-04-05 19:26:16', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '9', 'DROP TABLE IF EXISTS `listandstart_task`; \nCREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `listandstart_task`; \r\nCREATE TABLE IF NOT EXISTS `listandstart_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4547, '2014-04-05 19:26:16', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n);\r\nadd_cron_task("listandstart",$parameters);'),
(4548, '2014-04-05 19:27:04', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '16', '', 'list'),
(4549, '2014-04-05 19:27:04', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '16', '', 'list'),
(4550, '2014-04-05 19:27:04', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '16', '', 'list'),
(4551, '2014-04-05 19:27:04', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '16', '', '16'),
(4552, '2014-04-05 19:29:29', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '12', '', 'list'),
(4553, '2014-04-05 19:29:29', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '12', '', '12'),
(4554, '2014-04-05 19:29:39', '/sys/function_groupdelete.php', '-1', '*** Batch delete begin ***', 'function_group', '', '', '', ''),
(4555, '2014-04-05 19:29:39', '/sys/function_groupdelete.php', '-1', 'D', 'function_group', 'function_group_id', '5', '5', ''),
(4556, '2014-04-05 19:29:39', '/sys/function_groupdelete.php', '-1', 'D', 'function_group', 'function_group_name', '5', 'list', ''),
(4557, '2014-04-05 19:29:39', '/sys/function_groupdelete.php', '-1', '*** Batch delete successful ***', 'function_group', '', '', '', ''),
(4558, '2014-04-05 19:29:55', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '15', '', '12'),
(4559, '2014-04-05 19:29:55', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '15', '', '8'),
(4560, '2014-04-05 19:29:55', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '15', '', '1'),
(4561, '2014-04-05 19:29:55', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '15', '', '15'),
(4562, '2014-04-05 19:30:15', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '16', '', '16'),
(4563, '2014-04-05 19:30:15', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '16', '', '12'),
(4564, '2014-04-05 19:30:15', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '16', '', '16'),
(4565, '2014-04-05 19:30:26', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '16', 'DROP TABLE IF EXISTS `list_task`; \nCREATE TABLE IF NOT EXISTS `list_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `list_task`; \r\nCREATE TABLE IF NOT EXISTS `list_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4566, '2014-04-05 19:30:26', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '16', '$parameters = array(\n);\nadd_cron_task("list",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("list",$parameters);'),
(4567, '2014-04-05 20:03:52', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4568, '2014-04-05 20:41:40', '/sys/login.php', 'login', 'login', '::1', '', '', '', ''),
(4569, '2014-04-05 20:43:39', '/sys/taskedit.php', '2', 'U', 'task', 'sqlscript', '13', 'DROP TABLE IF EXISTS `backup_task`; \nCREATE TABLE IF NOT EXISTS `backup_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `backup_task`; \r\nCREATE TABLE IF NOT EXISTS `backup_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4570, '2014-04-05 20:43:39', '/sys/taskedit.php', '2', 'U', 'task', 'phpscript', '13', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("backup",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("backup",$parameters);'),
(4571, '2014-04-05 20:45:06', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4572, '2014-04-05 20:57:03', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '12', 'DROP TABLE IF EXISTS `create_task`; \nCREATE TABLE IF NOT EXISTS `create_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `create_task`; \r\nCREATE TABLE IF NOT EXISTS `create_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4573, '2014-04-05 20:57:03', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '12', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n);\nadd_cron_task("create",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n);\r\nadd_cron_task("create",$parameters);'),
(4574, '2014-04-05 21:03:01', '/sys/taskedit.php', '2', 'U', 'task', 'sqlscript', '11', 'DROP TABLE IF EXISTS `drop_task`; \nCREATE TABLE IF NOT EXISTS `drop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `drop_task`; \r\nCREATE TABLE IF NOT EXISTS `drop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4575, '2014-04-05 21:03:01', '/sys/taskedit.php', '2', 'U', 'task', 'phpscript', '11', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n);\nadd_cron_task("drop",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n);\r\nadd_cron_task("drop",$parameters);'),
(4576, '2014-04-05 21:05:09', '/sys/taskedit.php', '2', 'U', 'task', 'sqlscript', '15', 'DROP TABLE IF EXISTS `restore_task`; \nCREATE TABLE IF NOT EXISTS `restore_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restore_task`; \r\nCREATE TABLE IF NOT EXISTS `restore_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4577, '2014-04-05 21:05:09', '/sys/taskedit.php', '2', 'U', 'task', 'phpscript', '15', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("restore",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("restore",$parameters);'),
(4578, '2014-04-05 21:06:56', '/sys/taskedit.php', '2', 'U', 'task', 'sqlscript', '10', 'DROP TABLE IF EXISTS `stop_task`; \nCREATE TABLE IF NOT EXISTS `stop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `stop_task`; \r\nCREATE TABLE IF NOT EXISTS `stop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4579, '2014-04-05 21:06:56', '/sys/taskedit.php', '2', 'U', 'task', 'phpscript', '10', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("stop",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("stop",$parameters);'),
(4580, '2014-04-05 21:08:41', '/sys/taskedit.php', '2', 'U', 'task', 'sqlscript', '14', 'DROP TABLE IF EXISTS `update_task`; \nCREATE TABLE IF NOT EXISTS `update_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `update_task`; \r\nCREATE TABLE IF NOT EXISTS `update_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n`HOSTNAME` varchar(255) NOT NULL default '''',\r\n`DBUSERNAME` varchar(255) NOT NULL default '''',\r\n`PASSWORD` varchar(255) NOT NULL default '''',\r\n`DATABASE` varchar(255) NOT NULL default '''',\r\n`FILEPATH` varchar(255) NOT NULL default '''',\r\n`FILENAME` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4581, '2014-04-05 21:08:41', '/sys/taskedit.php', '2', 'U', 'task', 'phpscript', '14', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("update",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n''HOSTNAME''=>$rsnew["HOSTNAME"],\r\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\r\n''PASSWORD''=>$rsnew["PASSWORD"],\r\n''DATABASE''=>$rsnew["DATABASE"],\r\n''FILEPATH''=>$rsnew["FILEPATH"],\r\n''FILENAME''=>$rsnew["FILENAME"],\r\n);\r\nadd_cron_task("update",$parameters);'),
(4582, '2014-04-15 11:55:45', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4583, '2014-04-15 12:00:12', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4584, '2014-04-15 15:00:23', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4585, '2014-04-15 22:57:07', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4586, '2014-04-28 09:17:12', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4587, '2014-04-28 09:24:30', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '15', '', 'stopglassfish'),
(4588, '2014-04-28 09:24:30', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '15', '', '4'),
(4589, '2014-04-28 09:24:30', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '15', '', '15'),
(4590, '2014-04-28 09:24:43', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '16', '', 'startglassfish'),
(4591, '2014-04-28 09:24:43', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '16', '', '4'),
(4592, '2014-04-28 09:24:43', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '16', '', '16'),
(4593, '2014-04-28 09:24:51', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '17', '', 'restartglassfish'),
(4594, '2014-04-28 09:24:51', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '17', '', '4'),
(4595, '2014-04-28 09:24:51', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '17', '', '17'),
(4596, '2014-04-28 09:25:08', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '18', '', 'deploy'),
(4597, '2014-04-28 09:25:08', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '18', '', '4'),
(4598, '2014-04-28 09:25:08', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '18', '', '18'),
(4599, '2014-04-28 09:25:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '19', '', 'undeploy'),
(4600, '2014-04-28 09:25:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '19', '', '4'),
(4601, '2014-04-28 09:25:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '19', '', '19'),
(4602, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', '*** Batch insert begin ***', 'parameter', '', '', '', ''),
(4603, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '15', '', '4'),
(4604, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '15', '', 'server_id_asadmin'),
(4605, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '15', '', '15'),
(4606, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '16', '', '4'),
(4607, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '16', '', 'USERNAME'),
(4608, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '16', '', '16'),
(4609, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '17', '', '4'),
(4610, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '17', '', 'PASSFILE'),
(4611, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '17', '', '17'),
(4612, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '18', '', '4'),
(4613, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '18', '', 'APPFL_NM'),
(4614, '2014-04-28 09:26:46', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '18', '', '18'),
(4615, '2014-04-28 09:26:47', '/sys/parameterlist.php', '-1', '*** Batch insert successful ***', 'parameter', '', '', '', ''),
(4616, '2014-04-28 09:36:50', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '13', '', 'stopglassfish'),
(4617, '2014-04-28 09:36:50', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '13', '', '13'),
(4618, '2014-04-28 09:37:00', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '14', '', 'startglassfish'),
(4619, '2014-04-28 09:37:00', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '14', '', '14'),
(4620, '2014-04-28 09:37:07', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '15', '', 'restartglassfish'),
(4621, '2014-04-28 09:37:07', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '15', '', '15'),
(4622, '2014-04-28 09:37:18', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '16', '', 'deploy'),
(4623, '2014-04-28 09:37:18', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '16', '', '16'),
(4624, '2014-04-28 09:37:32', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '17', '', 'undeploy'),
(4625, '2014-04-28 09:37:32', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '17', '', '17'),
(4626, '2014-04-28 09:38:02', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '16', '', '13'),
(4627, '2014-04-28 09:38:02', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '16', '', '15'),
(4628, '2014-04-28 09:38:02', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '16', '', '1'),
(4629, '2014-04-28 09:38:02', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '16', '', '16'),
(4630, '2014-04-28 09:38:12', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '17', '', '14'),
(4631, '2014-04-28 09:38:12', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '17', '', '16'),
(4632, '2014-04-28 09:38:12', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '17', '', '1'),
(4633, '2014-04-28 09:38:12', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '17', '', '17'),
(4634, '2014-04-28 09:38:26', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '18', '', '15'),
(4635, '2014-04-28 09:38:26', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '18', '', '17'),
(4636, '2014-04-28 09:38:26', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '18', '', '1'),
(4637, '2014-04-28 09:38:26', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '18', '', '18'),
(4638, '2014-04-28 09:38:37', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '19', '', '16'),
(4639, '2014-04-28 09:38:37', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '19', '', '18'),
(4640, '2014-04-28 09:38:37', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '19', '', '1'),
(4641, '2014-04-28 09:38:37', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '19', '', '19'),
(4642, '2014-04-28 09:38:47', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '20', '', '17'),
(4643, '2014-04-28 09:38:47', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '20', '', '19'),
(4644, '2014-04-28 09:38:47', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '20', '', '1'),
(4645, '2014-04-28 09:38:47', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '20', '', '20'),
(4646, '2014-04-28 09:39:50', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '17', '', 'stopglassfish'),
(4647, '2014-04-28 09:39:50', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '17', '', 'stopglassfish'),
(4648, '2014-04-28 09:39:50', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '17', '', 'stopglassfish'),
(4649, '2014-04-28 09:39:50', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '17', '', '17'),
(4650, '2014-04-28 09:40:04', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '18', '', 'startglassfish'),
(4651, '2014-04-28 09:40:04', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '18', '', 'startglassfish'),
(4652, '2014-04-28 09:40:04', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '18', '', 'startglassfish'),
(4653, '2014-04-28 09:40:04', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '18', '', '18'),
(4654, '2014-04-28 09:40:14', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '19', '', 'restartglassfish'),
(4655, '2014-04-28 09:40:14', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '19', '', 'restartglassfish'),
(4656, '2014-04-28 09:40:14', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '19', '', 'restartglassfish'),
(4657, '2014-04-28 09:40:14', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '19', '', '19'),
(4658, '2014-04-28 09:40:23', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '20', '', 'deploy'),
(4659, '2014-04-28 09:40:23', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '20', '', 'deploy'),
(4660, '2014-04-28 09:40:23', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '20', '', 'deploy'),
(4661, '2014-04-28 09:40:23', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '20', '', '20'),
(4662, '2014-04-28 09:40:33', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '21', '', 'undeploy'),
(4663, '2014-04-28 09:40:33', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '21', '', 'undeploy'),
(4664, '2014-04-28 09:40:33', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '21', '', 'undeploy'),
(4665, '2014-04-28 09:40:33', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '21', '', '21'),
(4666, '2014-04-28 09:40:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '17', '', '17'),
(4667, '2014-04-28 09:40:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '17', '', '13'),
(4668, '2014-04-28 09:40:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '17', '', '17'),
(4669, '2014-04-28 09:41:00', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '18', '', '18'),
(4670, '2014-04-28 09:41:00', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '18', '', '14'),
(4671, '2014-04-28 09:41:00', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '18', '', '18'),
(4672, '2014-04-28 09:41:14', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '19', '', '19'),
(4673, '2014-04-28 09:41:14', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '19', '', '15'),
(4674, '2014-04-28 09:41:14', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '19', '', '19'),
(4675, '2014-04-28 09:41:26', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '20', '', '20'),
(4676, '2014-04-28 09:41:26', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '20', '', '16'),
(4677, '2014-04-28 09:41:26', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '20', '', '20'),
(4678, '2014-04-28 09:41:36', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '21', '', '21'),
(4679, '2014-04-28 09:41:36', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '21', '', '17'),
(4680, '2014-04-28 09:41:36', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '21', '', '21'),
(4681, '2014-04-28 09:42:30', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '17', 'DROP TABLE IF EXISTS `stopglassfish_task`; \nCREATE TABLE IF NOT EXISTS `stopglassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `stopglassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `stopglassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4682, '2014-04-28 09:42:30', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '17', '$parameters = array(\n);\nadd_cron_task("stopglassfish",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("stopglassfish",$parameters);'),
(4683, '2014-04-28 09:42:56', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '18', 'DROP TABLE IF EXISTS `startglassfish_task`; \nCREATE TABLE IF NOT EXISTS `startglassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `startglassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `startglassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4684, '2014-04-28 09:42:56', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '18', '$parameters = array(\n);\nadd_cron_task("startglassfish",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("startglassfish",$parameters);'),
(4685, '2014-04-28 09:43:02', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '19', 'DROP TABLE IF EXISTS `restartglassfish_task`; \nCREATE TABLE IF NOT EXISTS `restartglassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restartglassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `restartglassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4686, '2014-04-28 09:43:02', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '19', '$parameters = array(\n);\nadd_cron_task("restartglassfish",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("restartglassfish",$parameters);'),
(4687, '2014-04-28 09:43:07', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '20', 'DROP TABLE IF EXISTS `deploy_task`; \nCREATE TABLE IF NOT EXISTS `deploy_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `deploy_task`; \r\nCREATE TABLE IF NOT EXISTS `deploy_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4688, '2014-04-28 09:43:07', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '20', '$parameters = array(\n);\nadd_cron_task("deploy",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("deploy",$parameters);'),
(4689, '2014-04-28 09:43:13', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '21', 'DROP TABLE IF EXISTS `undeploy_task`; \nCREATE TABLE IF NOT EXISTS `undeploy_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `undeploy_task`; \r\nCREATE TABLE IF NOT EXISTS `undeploy_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4690, '2014-04-28 09:43:13', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '21', '$parameters = array(\n);\nadd_cron_task("undeploy",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("undeploy",$parameters);'),
(4691, '2014-04-28 09:47:18', '/sys/parameterlist.php', '-1', 'U', 'parameter', 'parameter_name', '16', 'USERNAME', 'GLUSERNAME'),
(4692, '2014-04-28 09:47:36', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '20', 'DROP TABLE IF EXISTS `deploy_task`; \nCREATE TABLE IF NOT EXISTS `deploy_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_asadmin` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSFILE` varchar(255) NOT NULL default '''',\n`APPFL_NM` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `deploy_task`; \r\nCREATE TABLE IF NOT EXISTS `deploy_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_asadmin` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSFILE` varchar(255) NOT NULL default '''',\r\n`APPFL_NM` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4693, '2014-04-28 09:47:36', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '20', '$parameters = array(\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSFILE''=>$rsnew["PASSFILE"],\n''APPFL_NM''=>$rsnew["APPFL_NM"],\n);\nadd_cron_task("deploy",$parameters);', '$parameters = array(\r\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSFILE''=>$rsnew["PASSFILE"],\r\n''APPFL_NM''=>$rsnew["APPFL_NM"],\r\n);\r\nadd_cron_task("deploy",$parameters);'),
(4694, '2014-04-28 09:47:59', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '21', 'DROP TABLE IF EXISTS `undeploy_task`; \nCREATE TABLE IF NOT EXISTS `undeploy_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_asadmin` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSFILE` varchar(255) NOT NULL default '''',\n`APPFL_NM` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `undeploy_task`; \r\nCREATE TABLE IF NOT EXISTS `undeploy_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_asadmin` varchar(255) NOT NULL default '''',\r\n`USERNAME` varchar(255) NOT NULL default '''',\r\n`PASSFILE` varchar(255) NOT NULL default '''',\r\n`APPFL_NM` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4695, '2014-04-28 09:47:59', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '21', '$parameters = array(\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSFILE''=>$rsnew["PASSFILE"],\n''APPFL_NM''=>$rsnew["APPFL_NM"],\n);\nadd_cron_task("undeploy",$parameters);', '$parameters = array(\r\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\r\n''USERNAME''=>$rsnew["USERNAME"],\r\n''PASSFILE''=>$rsnew["PASSFILE"],\r\n''APPFL_NM''=>$rsnew["APPFL_NM"],\r\n);\r\nadd_cron_task("undeploy",$parameters);'),
(4696, '2014-04-28 09:55:30', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4697, '2014-04-28 10:41:19', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_name', '6', '', 'sendreceive'),
(4698, '2014-04-28 10:41:19', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_path', '6', '', 'sendreceive(1).sh'),
(4699, '2014-04-28 10:41:19', '/sys/scriptadd.php', '-1', 'A', 'script', 'start_range', '6', '', '1'),
(4700, '2014-04-28 10:41:19', '/sys/scriptadd.php', '-1', 'A', 'script', 'end_range', '6', '', '1'),
(4701, '2014-04-28 10:41:19', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_id', '6', '', '6'),
(4702, '2014-04-28 10:42:11', '/sys/scriptedit.php', '-1', 'U', 'script', 'script_path', '6', 'sendreceive(1).sh', 'sendreceive.sh'),
(4703, '2014-04-28 10:53:04', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '20', '', 'send'),
(4704, '2014-04-28 10:53:04', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '20', '', '6'),
(4705, '2014-04-28 10:53:04', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '20', '', '20'),
(4706, '2014-04-28 10:53:12', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '21', '', 'receive'),
(4707, '2014-04-28 10:53:12', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '21', '', '6'),
(4708, '2014-04-28 10:53:12', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '21', '', '21'),
(4709, '2014-04-28 10:55:20', '/sys/parameterlist.php', '-1', '*** Batch insert begin ***', 'parameter', '', '', '', ''),
(4710, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '19', '', '6'),
(4711, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '19', '', 'server_id_sendreceive'),
(4712, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '19', '', '19'),
(4713, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '20', '', '6'),
(4714, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '20', '', 'TARGET_FILENAME'),
(4715, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '20', '', '20'),
(4716, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '21', '', '6'),
(4717, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '21', '', 'LOCAL_PATH'),
(4718, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '21', '', '21'),
(4719, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '22', '', '6'),
(4720, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '22', '', 'REMOTE_IPAND1STLVL'),
(4721, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '22', '', '22'),
(4722, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '23', '', '6'),
(4723, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '23', '', 'REMOTE_REMAIN_PATH'),
(4724, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '23', '', '23'),
(4725, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '24', '', '6'),
(4726, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '24', '', 'REMOTE_USERNAME'),
(4727, '2014-04-28 10:55:21', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '24', '', '24'),
(4728, '2014-04-28 10:55:22', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '25', '', '6');
INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(4729, '2014-04-28 10:55:22', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '25', '', 'REMOTE_PASSWORD'),
(4730, '2014-04-28 10:55:22', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '25', '', '25'),
(4731, '2014-04-28 10:55:22', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '26', '', '6'),
(4732, '2014-04-28 10:55:22', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '26', '', 'REMOTE_DOMAIN'),
(4733, '2014-04-28 10:55:22', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '26', '', '26'),
(4734, '2014-04-28 10:55:22', '/sys/parameterlist.php', '-1', '*** Batch insert successful ***', 'parameter', '', '', '', ''),
(4735, '2014-04-28 10:57:46', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '18', '', 'send'),
(4736, '2014-04-28 10:57:46', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '18', '', '18'),
(4737, '2014-04-28 10:57:53', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '19', '', 'receive'),
(4738, '2014-04-28 10:57:53', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '19', '', '19'),
(4739, '2014-04-28 10:58:32', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '21', '', '18'),
(4740, '2014-04-28 10:58:32', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '21', '', '20'),
(4741, '2014-04-28 10:58:32', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '21', '', '1'),
(4742, '2014-04-28 10:58:32', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '21', '', '21'),
(4743, '2014-04-28 10:58:42', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '22', '', '19'),
(4744, '2014-04-28 10:58:42', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '22', '', '21'),
(4745, '2014-04-28 10:58:42', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '22', '', '1'),
(4746, '2014-04-28 10:58:42', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '22', '', '22'),
(4747, '2014-04-28 10:59:12', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '22', '', 'send'),
(4748, '2014-04-28 10:59:12', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '22', '', 'send'),
(4749, '2014-04-28 10:59:12', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '22', '', 'send'),
(4750, '2014-04-28 10:59:12', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '22', '', '22'),
(4751, '2014-04-28 10:59:21', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '23', '', 'receive'),
(4752, '2014-04-28 10:59:21', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '23', '', 'receive'),
(4753, '2014-04-28 10:59:21', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '23', '', 'receive'),
(4754, '2014-04-28 10:59:21', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '23', '', '23'),
(4755, '2014-04-28 10:59:33', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '22', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `send_task`; \r\nCREATE TABLE IF NOT EXISTS `send_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4756, '2014-04-28 10:59:33', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '22', '$parameters = array(\n);\nadd_cron_task("send",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("send",$parameters);'),
(4757, '2014-04-28 10:59:40', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '23', 'DROP TABLE IF EXISTS `receive_task`; \nCREATE TABLE IF NOT EXISTS `receive_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `receive_task`; \r\nCREATE TABLE IF NOT EXISTS `receive_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4758, '2014-04-28 10:59:40', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '23', '$parameters = array(\n);\nadd_cron_task("receive",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("receive",$parameters);'),
(4759, '2014-04-28 10:59:50', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '22', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `send_task`; \r\nCREATE TABLE IF NOT EXISTS `send_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4760, '2014-04-28 10:59:50', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '22', '$parameters = array(\n);\nadd_cron_task("send",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("send",$parameters);'),
(4761, '2014-04-28 11:00:19', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '22', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `send_task`; \r\nCREATE TABLE IF NOT EXISTS `send_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4762, '2014-04-28 11:00:19', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '22', '$parameters = array(\n);\nadd_cron_task("send",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("send",$parameters);'),
(4763, '2014-04-28 11:00:27', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '23', 'DROP TABLE IF EXISTS `receive_task`; \nCREATE TABLE IF NOT EXISTS `receive_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `receive_task`; \r\nCREATE TABLE IF NOT EXISTS `receive_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4764, '2014-04-28 11:00:27', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '23', '$parameters = array(\n);\nadd_cron_task("receive",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("receive",$parameters);'),
(4765, '2014-04-28 11:00:54', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '23', 'DROP TABLE IF EXISTS `receive_task`; \nCREATE TABLE IF NOT EXISTS `receive_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `receive_task`; \r\nCREATE TABLE IF NOT EXISTS `receive_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4766, '2014-04-28 11:00:54', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '23', '$parameters = array(\n);\nadd_cron_task("receive",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("receive",$parameters);'),
(4767, '2014-04-28 11:05:22', '/sys/parameterdelete.php', '-1', '*** Batch delete begin ***', 'parameter', '', '', '', ''),
(4768, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_id', '19', '19', ''),
(4769, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'script_id', '19', '6', ''),
(4770, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_name', '19', 'server_id_sendreceive', ''),
(4771, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_id', '20', '20', ''),
(4772, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'script_id', '20', '6', ''),
(4773, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_name', '20', 'TARGET_FILENAME', ''),
(4774, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_id', '21', '21', ''),
(4775, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'script_id', '21', '6', ''),
(4776, '2014-04-28 11:05:23', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_name', '21', 'LOCAL_PATH', ''),
(4777, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_id', '22', '22', ''),
(4778, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'script_id', '22', '6', ''),
(4779, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_name', '22', 'REMOTE_IPAND1STLVL', ''),
(4780, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_id', '23', '23', ''),
(4781, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'script_id', '23', '6', ''),
(4782, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_name', '23', 'REMOTE_REMAIN_PATH', ''),
(4783, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_id', '24', '24', ''),
(4784, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'script_id', '24', '6', ''),
(4785, '2014-04-28 11:05:24', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_name', '24', 'REMOTE_USERNAME', ''),
(4786, '2014-04-28 11:05:25', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_id', '25', '25', ''),
(4787, '2014-04-28 11:05:25', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'script_id', '25', '6', ''),
(4788, '2014-04-28 11:05:25', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_name', '25', 'REMOTE_PASSWORD', ''),
(4789, '2014-04-28 11:05:25', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_id', '26', '26', ''),
(4790, '2014-04-28 11:05:25', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'script_id', '26', '6', ''),
(4791, '2014-04-28 11:05:25', '/sys/parameterdelete.php', '-1', 'D', 'parameter', 'parameter_name', '26', 'REMOTE_DOMAIN', ''),
(4792, '2014-04-28 11:05:25', '/sys/parameterdelete.php', '-1', '*** Batch delete successful ***', 'parameter', '', '', '', ''),
(4793, '2014-04-28 11:05:55', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '27', '', '6'),
(4794, '2014-04-28 11:05:55', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '27', '', 'server_id_sendreceive'),
(4795, '2014-04-28 11:05:55', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '27', '', '27'),
(4796, '2014-04-28 11:06:14', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '28', '', '6'),
(4797, '2014-04-28 11:06:14', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '28', '', 'TARGET_FILENAME'),
(4798, '2014-04-28 11:06:14', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '28', '', '28'),
(4799, '2014-04-28 11:06:47', '/sys/parameterlist.php', '-1', '*** Batch insert begin ***', 'parameter', '', '', '', ''),
(4800, '2014-04-28 11:06:47', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '29', '', '6'),
(4801, '2014-04-28 11:06:47', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '29', '', 'LOCAL_PATH'),
(4802, '2014-04-28 11:06:47', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '29', '', '29'),
(4803, '2014-04-28 11:06:47', '/sys/parameterlist.php', '-1', '*** Batch insert successful ***', 'parameter', '', '', '', ''),
(4804, '2014-04-28 11:07:04', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '30', '', '6'),
(4805, '2014-04-28 11:07:04', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '30', '', 'REMOTE_IPAND1STLVL'),
(4806, '2014-04-28 11:07:04', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '30', '', '30'),
(4807, '2014-04-28 11:07:15', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '31', '', '6'),
(4808, '2014-04-28 11:07:15', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '31', '', 'REMOTE_REMAIN_PATH'),
(4809, '2014-04-28 11:07:15', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '31', '', '31'),
(4810, '2014-04-28 11:07:27', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '32', '', '6'),
(4811, '2014-04-28 11:07:27', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '32', '', 'REMOTE_USERNAME'),
(4812, '2014-04-28 11:07:27', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '32', '', '32'),
(4813, '2014-04-28 11:07:34', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '33', '', '6'),
(4814, '2014-04-28 11:07:34', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '33', '', 'REMOTE_PASSWORD'),
(4815, '2014-04-28 11:07:34', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '33', '', '33'),
(4816, '2014-04-28 11:07:43', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '34', '', '6'),
(4817, '2014-04-28 11:07:43', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '34', '', 'REMOTE_DOMAIN'),
(4818, '2014-04-28 11:07:43', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '34', '', '34'),
(4819, '2014-04-28 11:08:49', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '22', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `send_task`; \r\nCREATE TABLE IF NOT EXISTS `send_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4820, '2014-04-28 11:08:49', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '22', '$parameters = array(\n);\nadd_cron_task("send",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("send",$parameters);'),
(4821, '2014-04-28 11:08:59', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '22', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `send_task`; \r\nCREATE TABLE IF NOT EXISTS `send_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4822, '2014-04-28 11:08:59', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '22', '$parameters = array(\n);\nadd_cron_task("send",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("send",$parameters);'),
(4823, '2014-04-28 11:09:40', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '22', '', '22'),
(4824, '2014-04-28 11:09:40', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '22', '', '18'),
(4825, '2014-04-28 11:09:40', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '22', '', '22'),
(4826, '2014-04-28 11:09:52', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '23', '', '23'),
(4827, '2014-04-28 11:09:52', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '23', '', '19'),
(4828, '2014-04-28 11:09:52', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '23', '', '23'),
(4829, '2014-04-28 11:10:02', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '22', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `send_task`; \r\nCREATE TABLE IF NOT EXISTS `send_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4830, '2014-04-28 11:10:02', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '22', '$parameters = array(\n);\nadd_cron_task("send",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("send",$parameters);'),
(4831, '2014-04-28 11:20:25', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '23', 'DROP TABLE IF EXISTS `receive_task`; \nCREATE TABLE IF NOT EXISTS `receive_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `receive_task`; \r\nCREATE TABLE IF NOT EXISTS `receive_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4832, '2014-04-28 11:20:25', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '23', '$parameters = array(\n);\nadd_cron_task("receive",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("receive",$parameters);'),
(4833, '2014-04-28 12:56:17', '/sys/login.php', 'admin', 'login', '1.1.2.19', '', '', '', ''),
(4834, '2014-04-28 13:05:46', '/sys/logout.php', 'Administrator', 'logout', '1.1.2.19', '', '', '', ''),
(4835, '2014-04-28 13:06:34', '/sys/login.php', 'admin', 'login', '1.1.2.19', '', '', '', ''),
(4836, '2014-04-28 14:05:18', '/sys/login.php', 'admin', 'login', '1.1.1.121', '', '', '', ''),
(4837, '2014-04-28 14:07:10', '/sys/logout.php', 'Administrator', 'logout', '1.1.1.121', '', '', '', ''),
(4838, '2014-04-29 11:22:05', '/sys/login.php', 'admin', 'login', '1.1.1.146', '', '', '', ''),
(4839, '2014-04-29 12:33:47', '/sys/login.php', 'admin', 'login', '1.1.1.121', '', '', '', ''),
(4840, '2014-04-29 13:55:09', '/sys/logout.php', 'Administrator', 'logout', '1.1.2.19', '', '', '', ''),
(4841, '2014-04-29 13:55:47', '/sys/login.php', 'admin', 'login', '1.1.2.19', '', '', '', ''),
(4842, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_name', '5', '', '1.1.2.51'),
(4843, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_hostname', '5', '', '1.1.2.51'),
(4844, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_username', '5', '', 'root'),
(4845, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_password', '5', '', 'root'),
(4846, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_auth_type', '5', '', 'password'),
(4847, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_os', '5', '', 'ubuntu'),
(4848, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_file', '5', '', 'Daily Activity Sheet - 06-Jan-2014.xls'),
(4849, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_deleted', '5', '', '0'),
(4850, '2014-04-29 14:01:24', '/sys/serveradd.php', '-1', 'A', 'server', 'server_id', '5', '', '5'),
(4851, '2014-04-29 14:12:06', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_name', '7', '', 'mysqlscript'),
(4852, '2014-04-29 14:12:06', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_path', '7', '', 'mysqlscript.sh'),
(4853, '2014-04-29 14:12:06', '/sys/scriptadd.php', '-1', 'A', 'script', 'start_range', '7', '', '0'),
(4854, '2014-04-29 14:12:06', '/sys/scriptadd.php', '-1', 'A', 'script', 'end_range', '7', '', '0'),
(4855, '2014-04-29 14:12:06', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_id', '7', '', '7'),
(4856, '2014-04-29 14:12:49', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '22', '', 'installmysql'),
(4857, '2014-04-29 14:12:49', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '22', '', '7'),
(4858, '2014-04-29 14:12:49', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '22', '', '22'),
(4859, '2014-04-29 14:14:40', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '35', '', '7'),
(4860, '2014-04-29 14:14:40', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '35', '', 'server_id_mysqlscript'),
(4861, '2014-04-29 14:14:40', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '35', '', '35'),
(4862, '2014-04-29 14:15:24', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '36', '', '7'),
(4863, '2014-04-29 14:15:24', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '36', '', 'rootpass'),
(4864, '2014-04-29 14:15:24', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '36', '', '36'),
(4865, '2014-04-29 14:16:42', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '20', '', 'installmysql'),
(4866, '2014-04-29 14:16:42', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '20', '', '20'),
(4867, '2014-04-29 14:16:56', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '23', '', '20'),
(4868, '2014-04-29 14:16:56', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '23', '', '22'),
(4869, '2014-04-29 14:16:56', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '23', '', '1'),
(4870, '2014-04-29 14:16:56', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '23', '', '23'),
(4871, '2014-04-29 14:17:14', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '24', '', 'installmysql'),
(4872, '2014-04-29 14:17:14', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '24', '', 'installmysql'),
(4873, '2014-04-29 14:17:14', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '24', '', 'installmysql'),
(4874, '2014-04-29 14:17:14', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '24', '', '24'),
(4875, '2014-04-29 14:18:40', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '24', '', '24'),
(4876, '2014-04-29 14:18:40', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '24', '', '20'),
(4877, '2014-04-29 14:18:40', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '24', '', '24'),
(4878, '2014-04-29 14:18:54', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '24', 'DROP TABLE IF EXISTS `installmysql_task`; \nCREATE TABLE IF NOT EXISTS `installmysql_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `installmysql_task`; \r\nCREATE TABLE IF NOT EXISTS `installmysql_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4879, '2014-04-29 14:18:54', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '24', '$parameters = array(\n);\nadd_cron_task("installmysql",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("installmysql",$parameters);'),
(4880, '2014-04-29 14:33:08', '/sys/login.php', 'admin', 'login', '1.1.2.19', '', '', '', ''),
(4881, '2014-04-30 10:15:13', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4882, '2014-04-30 10:31:56', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '23', '', 'addpool'),
(4883, '2014-04-30 10:31:56', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '23', '', '5'),
(4884, '2014-04-30 10:31:56', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '23', '', '23'),
(4885, '2014-04-30 10:32:15', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '24', '', 'deletepool'),
(4886, '2014-04-30 10:32:15', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '24', '', '5'),
(4887, '2014-04-30 10:32:15', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '24', '', '24'),
(4888, '2014-04-30 10:32:28', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '25', '', 'addresource'),
(4889, '2014-04-30 10:32:28', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '25', '', '5'),
(4890, '2014-04-30 10:32:28', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '25', '', '25'),
(4891, '2014-04-30 10:32:41', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '26', '', 'deleteresource'),
(4892, '2014-04-30 10:32:41', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '26', '', '5'),
(4893, '2014-04-30 10:32:41', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '26', '', '26'),
(4894, '2014-04-30 10:33:16', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '37', '', '5'),
(4895, '2014-04-30 10:33:16', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '37', '', 'server_id_glassfishadmin'),
(4896, '2014-04-30 10:33:16', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '37', '', '37'),
(4897, '2014-04-30 10:34:26', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '38', '', '5'),
(4898, '2014-04-30 10:34:26', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '38', '', 'GLUSERNAME'),
(4899, '2014-04-30 10:34:26', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '38', '', '38'),
(4900, '2014-04-30 10:34:40', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '39', '', '5'),
(4901, '2014-04-30 10:34:40', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '39', '', 'PASSFILE'),
(4902, '2014-04-30 10:34:40', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '39', '', '39'),
(4903, '2014-04-30 10:35:02', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '40', '', '5'),
(4904, '2014-04-30 10:35:02', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '40', '', 'JDBCNAME'),
(4905, '2014-04-30 10:35:02', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '40', '', '40'),
(4906, '2014-04-30 10:35:19', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '41', '', '5'),
(4907, '2014-04-30 10:35:19', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '41', '', 'DBS_JDBC'),
(4908, '2014-04-30 10:35:19', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '41', '', '41'),
(4909, '2014-04-30 10:51:52', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '21', '', 'addpool'),
(4910, '2014-04-30 10:51:52', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '21', '', '21'),
(4911, '2014-04-30 10:52:01', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '22', '', 'deletepool'),
(4912, '2014-04-30 10:52:01', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '22', '', '22'),
(4913, '2014-04-30 10:52:10', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '23', '', 'addresource'),
(4914, '2014-04-30 10:52:10', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '23', '', '23'),
(4915, '2014-04-30 10:52:20', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '24', '', 'deleteresource'),
(4916, '2014-04-30 10:52:20', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '24', '', '24'),
(4917, '2014-04-30 10:52:47', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '24', '', '21'),
(4918, '2014-04-30 10:52:47', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '24', '', '23'),
(4919, '2014-04-30 10:52:47', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '24', '', '1'),
(4920, '2014-04-30 10:52:47', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '24', '', '24'),
(4921, '2014-04-30 10:52:59', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '25', '', '22'),
(4922, '2014-04-30 10:52:59', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '25', '', '24'),
(4923, '2014-04-30 10:52:59', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '25', '', '1'),
(4924, '2014-04-30 10:52:59', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '25', '', '25'),
(4925, '2014-04-30 10:53:11', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '26', '', '23'),
(4926, '2014-04-30 10:53:11', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '26', '', '25'),
(4927, '2014-04-30 10:53:11', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '26', '', '1'),
(4928, '2014-04-30 10:53:11', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '26', '', '26'),
(4929, '2014-04-30 10:53:35', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '27', '', '24'),
(4930, '2014-04-30 10:53:35', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '27', '', '26'),
(4931, '2014-04-30 10:53:35', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '27', '', '1'),
(4932, '2014-04-30 10:53:35', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '27', '', '27'),
(4933, '2014-04-30 10:54:19', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '25', '', 'addpool'),
(4934, '2014-04-30 10:54:19', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '25', '', 'addpool'),
(4935, '2014-04-30 10:54:19', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '25', '', 'addpool'),
(4936, '2014-04-30 10:54:19', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '25', '', '25'),
(4937, '2014-04-30 10:54:28', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '26', '', 'deletepool'),
(4938, '2014-04-30 10:54:28', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '26', '', 'deletepool'),
(4939, '2014-04-30 10:54:28', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '26', '', 'deletepool'),
(4940, '2014-04-30 10:54:28', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '26', '', '26'),
(4941, '2014-04-30 10:54:40', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '27', '', 'addresource'),
(4942, '2014-04-30 10:54:40', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '27', '', 'addresource'),
(4943, '2014-04-30 10:54:40', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '27', '', 'addresource'),
(4944, '2014-04-30 10:54:40', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '27', '', '27'),
(4945, '2014-04-30 10:54:57', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '28', '', 'deleteresource'),
(4946, '2014-04-30 10:54:57', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '28', '', 'deleteresource'),
(4947, '2014-04-30 10:54:57', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '28', '', 'deleteresource'),
(4948, '2014-04-30 10:54:57', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '28', '', '28'),
(4949, '2014-04-30 10:55:20', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '25', '', '25'),
(4950, '2014-04-30 10:55:20', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '25', '', '21'),
(4951, '2014-04-30 10:55:20', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '25', '', '25'),
(4952, '2014-04-30 10:55:31', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '26', '', '26'),
(4953, '2014-04-30 10:55:31', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '26', '', '22'),
(4954, '2014-04-30 10:55:31', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '26', '', '26'),
(4955, '2014-04-30 10:55:42', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '27', '', '27'),
(4956, '2014-04-30 10:55:42', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '27', '', '23'),
(4957, '2014-04-30 10:55:42', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '27', '', '27'),
(4958, '2014-04-30 10:55:52', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '28', '', '28'),
(4959, '2014-04-30 10:55:52', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '28', '', '24'),
(4960, '2014-04-30 10:55:52', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '28', '', '28'),
(4961, '2014-04-30 10:58:36', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '25', 'DROP TABLE IF EXISTS `addpool_task`; \nCREATE TABLE IF NOT EXISTS `addpool_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `addpool_task`; \r\nCREATE TABLE IF NOT EXISTS `addpool_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4962, '2014-04-30 10:58:36', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '25', '$parameters = array(\n);\nadd_cron_task("addpool",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("addpool",$parameters);'),
(4963, '2014-04-30 10:58:47', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '26', 'DROP TABLE IF EXISTS `deletepool_task`; \nCREATE TABLE IF NOT EXISTS `deletepool_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `deletepool_task`; \r\nCREATE TABLE IF NOT EXISTS `deletepool_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4964, '2014-04-30 10:58:47', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '26', '$parameters = array(\n);\nadd_cron_task("deletepool",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("deletepool",$parameters);'),
(4965, '2014-04-30 10:59:03', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '27', 'DROP TABLE IF EXISTS `addresource_task`; \nCREATE TABLE IF NOT EXISTS `addresource_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `addresource_task`; \r\nCREATE TABLE IF NOT EXISTS `addresource_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4966, '2014-04-30 10:59:03', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '27', '$parameters = array(\n);\nadd_cron_task("addresource",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("addresource",$parameters);'),
(4967, '2014-04-30 10:59:11', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '28', 'DROP TABLE IF EXISTS `deleteresource_task`; \nCREATE TABLE IF NOT EXISTS `deleteresource_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `deleteresource_task`; \r\nCREATE TABLE IF NOT EXISTS `deleteresource_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4968, '2014-04-30 10:59:11', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '28', '$parameters = array(\n);\nadd_cron_task("deleteresource",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("deleteresource",$parameters);'),
(4969, '2014-04-30 11:32:59', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '27', '', 'installworkbench'),
(4970, '2014-04-30 11:32:59', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '27', '', '7'),
(4971, '2014-04-30 11:32:59', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '27', '', '27'),
(4972, '2014-04-30 11:33:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '28', '', 'configmysqlremote'),
(4973, '2014-04-30 11:33:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '28', '', '7'),
(4974, '2014-04-30 11:33:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '28', '', '28'),
(4975, '2014-04-30 11:33:26', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '29', '', 'configmysqlvars'),
(4976, '2014-04-30 11:33:26', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '29', '', '7'),
(4977, '2014-04-30 11:33:26', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '29', '', '29'),
(4978, '2014-04-30 11:40:29', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '30', '', 'installworkbench'),
(4979, '2014-04-30 11:40:29', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '30', '', '7'),
(4980, '2014-04-30 11:40:29', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '30', '', '30'),
(4981, '2014-04-30 11:40:52', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '31', '', 'configmysqlremote'),
(4982, '2014-04-30 11:40:52', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '31', '', '7'),
(4983, '2014-04-30 11:40:52', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '31', '', '31'),
(4984, '2014-04-30 11:41:00', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '32', '', 'configmysqlvars'),
(4985, '2014-04-30 11:41:00', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '32', '', '7'),
(4986, '2014-04-30 11:41:00', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '32', '', '32'),
(4987, '2014-04-30 11:45:04', '/sys/parameterlist.php', '-1', '*** Batch insert begin ***', 'parameter', '', '', '', ''),
(4988, '2014-04-30 11:45:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '42', '', '7'),
(4989, '2014-04-30 11:45:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '42', '', 'keybuffer'),
(4990, '2014-04-30 11:45:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '42', '', '42'),
(4991, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '43', '', '7'),
(4992, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '43', '', 'maxallowedpacket'),
(4993, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '43', '', '43'),
(4994, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '44', '', '7'),
(4995, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '44', '', 'threadstack'),
(4996, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '44', '', '44'),
(4997, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '45', '', '7'),
(4998, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '45', '', 'threadcachesize'),
(4999, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '45', '', '45'),
(5000, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '46', '', '7'),
(5001, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '46', '', 'maxconnections'),
(5002, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '46', '', '46'),
(5003, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '47', '', '7'),
(5004, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '47', '', 'tablecache'),
(5005, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '47', '', '47'),
(5006, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '48', '', '7'),
(5007, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '48', '', 'querycachelimit'),
(5008, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '48', '', '48'),
(5009, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '49', '', '7'),
(5010, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '49', '', 'querycachesize'),
(5011, '2014-04-30 11:45:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '49', '', '49'),
(5012, '2014-04-30 11:45:06', '/sys/parameterlist.php', '-1', '*** Batch insert successful ***', 'parameter', '', '', '', ''),
(5013, '2014-04-30 11:51:28', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '25', '', 'installworkbench'),
(5014, '2014-04-30 11:51:28', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '25', '', '25'),
(5015, '2014-04-30 11:51:37', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '26', '', 'configmysqlremote'),
(5016, '2014-04-30 11:51:37', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '26', '', '26'),
(5017, '2014-04-30 11:51:46', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '27', '', 'configmysqlvars'),
(5018, '2014-04-30 11:51:46', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '27', '', '27'),
(5019, '2014-04-30 11:52:52', '/sys/script_functiondelete.php', '-1', '*** Batch delete begin ***', 'script_function', '', '', '', ''),
(5020, '2014-04-30 11:52:52', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_function_id', '31', '31', ''),
(5021, '2014-04-30 11:52:52', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_function_name', '31', 'configmysqlremote', ''),
(5022, '2014-04-30 11:52:52', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_id', '31', '7', ''),
(5023, '2014-04-30 11:52:52', '/sys/script_functiondelete.php', '-1', '*** Batch delete successful ***', 'script_function', '', '', '', ''),
(5024, '2014-04-30 11:53:17', '/sys/script_functiondelete.php', '-1', '*** Batch delete begin ***', 'script_function', '', '', '', ''),
(5025, '2014-04-30 11:53:17', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_function_id', '32', '32', ''),
(5026, '2014-04-30 11:53:17', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_function_name', '32', 'configmysqlvars', ''),
(5027, '2014-04-30 11:53:17', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_id', '32', '7', ''),
(5028, '2014-04-30 11:53:17', '/sys/script_functiondelete.php', '-1', '*** Batch delete successful ***', 'script_function', '', '', '', ''),
(5029, '2014-04-30 11:53:33', '/sys/script_functiondelete.php', '-1', '*** Batch delete begin ***', 'script_function', '', '', '', ''),
(5030, '2014-04-30 11:53:33', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_function_id', '30', '30', ''),
(5031, '2014-04-30 11:53:33', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_function_name', '30', 'installworkbench', ''),
(5032, '2014-04-30 11:53:33', '/sys/script_functiondelete.php', '-1', 'D', 'script_function', 'script_id', '30', '7', ''),
(5033, '2014-04-30 11:53:33', '/sys/script_functiondelete.php', '-1', '*** Batch delete successful ***', 'script_function', '', '', '', ''),
(5034, '2014-04-30 11:53:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '28', '', '25'),
(5035, '2014-04-30 11:53:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '28', '', '27'),
(5036, '2014-04-30 11:53:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '28', '', '1'),
(5037, '2014-04-30 11:53:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '28', '', '28'),
(5038, '2014-04-30 11:54:28', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '29', '', '26'),
(5039, '2014-04-30 11:54:28', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '29', '', '28'),
(5040, '2014-04-30 11:54:28', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '29', '', '1'),
(5041, '2014-04-30 11:54:28', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '29', '', '29'),
(5042, '2014-04-30 11:55:00', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '30', '', '27'),
(5043, '2014-04-30 11:55:00', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '30', '', '29'),
(5044, '2014-04-30 11:55:00', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '30', '', '1'),
(5045, '2014-04-30 11:55:00', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '30', '', '30'),
(5046, '2014-04-30 12:00:48', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '29', '', 'installworkbench'),
(5047, '2014-04-30 12:00:48', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '29', '', 'installworkbench'),
(5048, '2014-04-30 12:00:48', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '29', '', 'installworkbench'),
(5049, '2014-04-30 12:00:48', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '29', '', '29'),
(5050, '2014-04-30 12:00:58', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '30', '', 'configmysqlremote'),
(5051, '2014-04-30 12:00:58', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '30', '', 'configmysqlremote'),
(5052, '2014-04-30 12:00:58', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '30', '', 'configmysqlremote'),
(5053, '2014-04-30 12:00:58', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '30', '', '30'),
(5054, '2014-04-30 12:01:07', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '31', '', 'configmysqlvars'),
(5055, '2014-04-30 12:01:07', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '31', '', 'configmysqlvars'),
(5056, '2014-04-30 12:01:07', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '31', '', 'configmysqlvars'),
(5057, '2014-04-30 12:01:07', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '31', '', '31'),
(5058, '2014-04-30 12:01:31', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '29', '', '29'),
(5059, '2014-04-30 12:01:31', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '29', '', '25');
INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(5060, '2014-04-30 12:01:31', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '29', '', '29'),
(5061, '2014-04-30 12:01:41', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '30', '', '30'),
(5062, '2014-04-30 12:01:41', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '30', '', '26'),
(5063, '2014-04-30 12:01:41', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '30', '', '30'),
(5064, '2014-04-30 12:01:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '31', '', '31'),
(5065, '2014-04-30 12:01:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '31', '', '27'),
(5066, '2014-04-30 12:01:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '31', '', '31'),
(5067, '2014-04-30 12:02:14', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '29', 'DROP TABLE IF EXISTS `installworkbench_task`; \nCREATE TABLE IF NOT EXISTS `installworkbench_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `installworkbench_task`; \r\nCREATE TABLE IF NOT EXISTS `installworkbench_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5068, '2014-04-30 12:02:14', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '29', '$parameters = array(\n);\nadd_cron_task("installworkbench",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("installworkbench",$parameters);'),
(5069, '2014-04-30 12:02:35', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '30', 'DROP TABLE IF EXISTS `configmysqlremote_task`; \nCREATE TABLE IF NOT EXISTS `configmysqlremote_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `configmysqlremote_task`; \r\nCREATE TABLE IF NOT EXISTS `configmysqlremote_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5070, '2014-04-30 12:02:35', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '30', '$parameters = array(\n);\nadd_cron_task("configmysqlremote",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("configmysqlremote",$parameters);'),
(5071, '2014-04-30 12:05:03', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '29', 'DROP TABLE IF EXISTS `installworkbench_task`; \nCREATE TABLE IF NOT EXISTS `installworkbench_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `installworkbench_task`; \r\nCREATE TABLE IF NOT EXISTS `installworkbench_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5072, '2014-04-30 12:05:03', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '29', '$parameters = array(\n);\nadd_cron_task("installworkbench",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("installworkbench",$parameters);'),
(5073, '2014-04-30 12:05:57', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '30', 'DROP TABLE IF EXISTS `configmysqlremote_task`; \nCREATE TABLE IF NOT EXISTS `configmysqlremote_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `configmysqlremote_task`; \r\nCREATE TABLE IF NOT EXISTS `configmysqlremote_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5074, '2014-04-30 12:05:57', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '30', '$parameters = array(\n);\nadd_cron_task("configmysqlremote",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("configmysqlremote",$parameters);'),
(5075, '2014-04-30 12:16:04', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_name', '8', '', 'glassfishscript'),
(5076, '2014-04-30 12:16:04', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_path', '8', '', 'glassfishscript.sh'),
(5077, '2014-04-30 12:16:04', '/sys/scriptadd.php', '-1', 'A', 'script', 'start_range', '8', '', '0'),
(5078, '2014-04-30 12:16:04', '/sys/scriptadd.php', '-1', 'A', 'script', 'end_range', '8', '', '0'),
(5079, '2014-04-30 12:16:04', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_id', '8', '', '8'),
(5080, '2014-04-30 12:16:58', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '33', '', 'installglassfish'),
(5081, '2014-04-30 12:16:58', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '33', '', '8'),
(5082, '2014-04-30 12:16:58', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '33', '', '33'),
(5083, '2014-04-30 12:17:43', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '34', '', 'tmpgs'),
(5084, '2014-04-30 12:17:43', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '34', '', '8'),
(5085, '2014-04-30 12:17:43', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '34', '', '34'),
(5086, '2014-04-30 12:17:54', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '35', '', 'fabsprop'),
(5087, '2014-04-30 12:17:54', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '35', '', '8'),
(5088, '2014-04-30 12:17:54', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '35', '', '35'),
(5089, '2014-04-30 12:18:07', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '36', '', 'glassfishtuning'),
(5090, '2014-04-30 12:18:07', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '36', '', '8'),
(5091, '2014-04-30 12:18:07', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '36', '', '36'),
(5092, '2014-04-30 12:18:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '37', '', 'editportalext'),
(5093, '2014-04-30 12:18:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '37', '', '8'),
(5094, '2014-04-30 12:18:18', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '37', '', '37'),
(5095, '2014-04-30 12:19:23', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '50', '', '8'),
(5096, '2014-04-30 12:19:23', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '50', '', 'server_id_glassfishscript'),
(5097, '2014-04-30 12:19:23', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '50', '', '50'),
(5098, '2014-04-30 12:23:04', '/sys/parameterlist.php', '-1', '*** Batch insert begin ***', 'parameter', '', '', '', ''),
(5099, '2014-04-30 12:23:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '51', '', '8'),
(5100, '2014-04-30 12:23:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '51', '', 'glassfishfolder'),
(5101, '2014-04-30 12:23:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '51', '', '51'),
(5102, '2014-04-30 12:23:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '52', '', '8'),
(5103, '2014-04-30 12:23:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '52', '', 'adminpassword'),
(5104, '2014-04-30 12:23:04', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '52', '', '52'),
(5105, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '53', '', '8'),
(5106, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '53', '', 'domainname'),
(5107, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '53', '', '53'),
(5108, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '54', '', '8'),
(5109, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '54', '', 'liferaydbip'),
(5110, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '54', '', '54'),
(5111, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '55', '', '8'),
(5112, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '55', '', 'liferaydbname'),
(5113, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '55', '', '55'),
(5114, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '56', '', '8'),
(5115, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '56', '', 'liferaydbuser'),
(5116, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '56', '', '56'),
(5117, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '57', '', '8'),
(5118, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '57', '', 'liferaydbpass'),
(5119, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '57', '', '57'),
(5120, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '58', '', '8'),
(5121, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '58', '', 'JVMHEAPSIZE'),
(5122, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '58', '', '58'),
(5123, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '59', '', '8'),
(5124, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '59', '', 'JVMHEAPSIZEXMN'),
(5125, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '59', '', '59'),
(5126, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '60', '', '8'),
(5127, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '60', '', 'JVMPARALLELGCTHREADS'),
(5128, '2014-04-30 12:23:05', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '60', '', '60'),
(5129, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '61', '', '8'),
(5130, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '61', '', 'MAXTHREADPOOLSIZE'),
(5131, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '61', '', '61'),
(5132, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '62', '', '8'),
(5133, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '62', '', 'LargePageSizeInBytes'),
(5134, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '62', '', '62'),
(5135, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '63', '', '8'),
(5136, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '63', '', 'contextname_value'),
(5137, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '63', '', '63'),
(5138, '2014-04-30 12:23:06', '/sys/parameterlist.php', '-1', '*** Batch insert successful ***', 'parameter', '', '', '', ''),
(5139, '2014-04-30 12:34:07', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '28', '', 'installglassfish'),
(5140, '2014-04-30 12:34:07', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '28', '', '28'),
(5141, '2014-04-30 12:34:15', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '29', '', 'tmpgs'),
(5142, '2014-04-30 12:34:15', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '29', '', '29'),
(5143, '2014-04-30 12:34:20', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '30', '', 'fabsprop'),
(5144, '2014-04-30 12:34:20', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '30', '', '30'),
(5145, '2014-04-30 12:34:28', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '31', '', 'glassfishtuning'),
(5146, '2014-04-30 12:34:28', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '31', '', '31'),
(5147, '2014-04-30 12:34:36', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '32', '', 'editportalext'),
(5148, '2014-04-30 12:34:36', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '32', '', '32'),
(5149, '2014-04-30 12:34:51', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '31', '', '28'),
(5150, '2014-04-30 12:34:51', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '31', '', '33'),
(5151, '2014-04-30 12:34:51', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '31', '', '1'),
(5152, '2014-04-30 12:34:51', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '31', '', '31'),
(5153, '2014-04-30 12:35:24', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '32', '', '29'),
(5154, '2014-04-30 12:35:24', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '32', '', '34'),
(5155, '2014-04-30 12:35:24', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '32', '', '1'),
(5156, '2014-04-30 12:35:24', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '32', '', '32'),
(5157, '2014-04-30 12:36:29', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '33', '', '30'),
(5158, '2014-04-30 12:36:29', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '33', '', '35'),
(5159, '2014-04-30 12:36:29', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '33', '', '1'),
(5160, '2014-04-30 12:36:29', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '33', '', '33'),
(5161, '2014-04-30 12:36:39', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '34', '', '31'),
(5162, '2014-04-30 12:36:39', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '34', '', '36'),
(5163, '2014-04-30 12:36:39', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '34', '', '1'),
(5164, '2014-04-30 12:36:39', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '34', '', '34'),
(5165, '2014-04-30 12:36:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '35', '', '32'),
(5166, '2014-04-30 12:36:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '35', '', '37'),
(5167, '2014-04-30 12:36:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '35', '', '1'),
(5168, '2014-04-30 12:36:57', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '35', '', '35'),
(5169, '2014-04-30 12:37:42', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '32', '', 'installglassfish'),
(5170, '2014-04-30 12:37:42', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '32', '', 'installglassfish'),
(5171, '2014-04-30 12:37:42', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '32', '', 'installglassfish'),
(5172, '2014-04-30 12:37:42', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '32', '', '32'),
(5173, '2014-04-30 12:37:53', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '33', '', 'tmpgs'),
(5174, '2014-04-30 12:37:53', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '33', '', 'tmpgs'),
(5175, '2014-04-30 12:37:53', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '33', '', 'tmpgs'),
(5176, '2014-04-30 12:37:53', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '33', '', '33'),
(5177, '2014-04-30 12:38:02', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '34', '', 'fabsprop'),
(5178, '2014-04-30 12:38:02', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '34', '', 'fabsprop'),
(5179, '2014-04-30 12:38:02', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '34', '', 'fabsprop'),
(5180, '2014-04-30 12:38:02', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '34', '', '34'),
(5181, '2014-04-30 12:38:13', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '35', '', 'glassfishtuning'),
(5182, '2014-04-30 12:38:13', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '35', '', 'glassfishtuning'),
(5183, '2014-04-30 12:38:13', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '35', '', 'glassfishtuning'),
(5184, '2014-04-30 12:38:13', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '35', '', '35'),
(5185, '2014-04-30 12:38:24', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '36', '', 'editportalext'),
(5186, '2014-04-30 12:38:24', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '36', '', 'editportalext'),
(5187, '2014-04-30 12:38:24', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '36', '', 'editportalext'),
(5188, '2014-04-30 12:38:24', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '36', '', '36'),
(5189, '2014-04-30 12:38:42', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '32', '', '32'),
(5190, '2014-04-30 12:38:42', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '32', '', '28'),
(5191, '2014-04-30 12:38:42', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '32', '', '32'),
(5192, '2014-04-30 12:38:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '33', '', '33'),
(5193, '2014-04-30 12:38:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '33', '', '29'),
(5194, '2014-04-30 12:38:53', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '33', '', '33'),
(5195, '2014-04-30 12:39:11', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '34', '', '34'),
(5196, '2014-04-30 12:39:11', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '34', '', '30'),
(5197, '2014-04-30 12:39:11', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '34', '', '34'),
(5198, '2014-04-30 12:39:24', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '35', '', '35'),
(5199, '2014-04-30 12:39:24', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '35', '', '31'),
(5200, '2014-04-30 12:39:24', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '35', '', '35'),
(5201, '2014-04-30 12:39:35', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '36', '', '36'),
(5202, '2014-04-30 12:39:35', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '36', '', '32'),
(5203, '2014-04-30 12:39:35', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '36', '', '36'),
(5204, '2014-04-30 12:39:55', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '32', 'DROP TABLE IF EXISTS `installglassfish_task`; \nCREATE TABLE IF NOT EXISTS `installglassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `installglassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `installglassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5205, '2014-04-30 12:39:55', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '32', '$parameters = array(\n);\nadd_cron_task("installglassfish",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("installglassfish",$parameters);'),
(5206, '2014-04-30 12:40:14', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '33', 'DROP TABLE IF EXISTS `tmpgs_task`; \nCREATE TABLE IF NOT EXISTS `tmpgs_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `tmpgs_task`; \r\nCREATE TABLE IF NOT EXISTS `tmpgs_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5207, '2014-04-30 12:40:14', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '33', '$parameters = array(\n);\nadd_cron_task("tmpgs",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("tmpgs",$parameters);'),
(5208, '2014-04-30 12:40:23', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '34', 'DROP TABLE IF EXISTS `fabsprop_task`; \nCREATE TABLE IF NOT EXISTS `fabsprop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `fabsprop_task`; \r\nCREATE TABLE IF NOT EXISTS `fabsprop_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5209, '2014-04-30 12:40:23', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '34', '$parameters = array(\n);\nadd_cron_task("fabsprop",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("fabsprop",$parameters);'),
(5210, '2014-04-30 12:40:29', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '35', 'DROP TABLE IF EXISTS `glassfishtuning_task`; \nCREATE TABLE IF NOT EXISTS `glassfishtuning_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `glassfishtuning_task`; \r\nCREATE TABLE IF NOT EXISTS `glassfishtuning_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5211, '2014-04-30 12:40:29', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '35', '$parameters = array(\n);\nadd_cron_task("glassfishtuning",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("glassfishtuning",$parameters);'),
(5212, '2014-04-30 12:40:37', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '36', 'DROP TABLE IF EXISTS `editportalext_task`; \nCREATE TABLE IF NOT EXISTS `editportalext_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `editportalext_task`; \r\nCREATE TABLE IF NOT EXISTS `editportalext_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5213, '2014-04-30 12:40:37', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '36', '$parameters = array(\n);\nadd_cron_task("editportalext",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("editportalext",$parameters);'),
(5214, '2014-04-30 12:42:52', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '36', 'DROP TABLE IF EXISTS `editportalext_task`; \nCREATE TABLE IF NOT EXISTS `editportalext_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishscript` varchar(255) NOT NULL default '''',\n`glassfishfolder` varchar(255) NOT NULL default '''',\n`domainname` varchar(255) NOT NULL default '''',\n`liferaydbip` varchar(255) NOT NULL default '''',\n`liferaydbname` varchar(255) NOT NULL default '''',\n`liferaydbuser` varchar(255) NOT NULL default '''',\n`liferaydbpass` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `editportalext_task`; \r\nCREATE TABLE IF NOT EXISTS `editportalext_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_glassfishscript` varchar(255) NOT NULL default '''',\r\n`glassfishfolder` varchar(255) NOT NULL default '''',\r\n`domainname` varchar(255) NOT NULL default '''',\r\n`liferaydbip` varchar(255) NOT NULL default '''',\r\n`liferaydbname` varchar(255) NOT NULL default '''',\r\n`liferaydbuser` varchar(255) NOT NULL default '''',\r\n`liferaydbpass` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(5215, '2014-04-30 12:42:52', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '36', '$parameters = array(\n''server_id_glassfishscript''=>$rsnew["server_id_glassfishscript"],\n''glassfishfolder''=>$rsnew["glassfishfolder"],\n''domainname''=>$rsnew["domainname"],\n''liferaydbip''=>$rsnew["liferaydbip"],\n''liferaydbname''=>$rsnew["liferaydbname"],\n''liferaydbuser''=>$rsnew["liferaydbuser"],\n''liferaydbpass''=>$rsnew["liferaydbpass"],\n);\nadd_cron_task("editportalext",$parameters);', '$parameters = array(\r\n''server_id_glassfishscript''=>$rsnew["server_id_glassfishscript"],\r\n''glassfishfolder''=>$rsnew["glassfishfolder"],\r\n''domainname''=>$rsnew["domainname"],\r\n''liferaydbip''=>$rsnew["liferaydbip"],\r\n''liferaydbname''=>$rsnew["liferaydbname"],\r\n''liferaydbuser''=>$rsnew["liferaydbuser"],\r\n''liferaydbpass''=>$rsnew["liferaydbpass"],\r\n);\r\nadd_cron_task("editportalext",$parameters);');

-- --------------------------------------------------------

--
-- Table structure for table `backup_task`
--

CREATE TABLE IF NOT EXISTS `backup_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `DBUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `backup_task`
--

INSERT INTO `backup_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`, `HOSTNAME`, `DBUSERNAME`, `PASSWORD`, `DATABASE`, `FILEPATH`, `FILENAME`) VALUES
(1, 'Administrator', '2014-04-05 20:46:26', '3', '1.1.1.189', 'root', 'root', 'mysql', '1.JPG', 'huma'),
(2, 'Administrator', '2014-04-05 20:46:48', '3', '1.1.1.189', 'root', 'root', 'mysql', '1.JPG', 'huma'),
(3, 'Administrator', '2014-04-05 20:49:26', '3', '1.1.1.189', 'root', 'root', 'mysql', '/', 'huma'),
(4, 'Administrator', '2014-04-05 20:50:22', '3', '1.1.1.189', 'root', 'root', 'fabscent', '/', 'huma'),
(5, 'Administrator', '2014-04-13 17:38:23', '3', '1.1.1.189', 'aa', 'aa', 'aa', 'aa', 'aa'),
(6, 'Administrator', '2014-04-13 17:42:40', '3', '1.1.1.189', 'aa', 'aa', 'aa', 'aa', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE IF NOT EXISTS `command` (
  `command_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `server_id` int(11) DEFAULT NULL,
  `command_input` text,
  `command_output` text,
  `command_status` text,
  `command_log` text,
  `command_time` datetime DEFAULT NULL,
  PRIMARY KEY (`command_id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `command`
--

INSERT INTO `command` (`command_id`, `user_id`, `task_id`, `server_id`, `command_input`, `command_output`, `command_status`, `command_log`, `command_time`) VALUES
(2, NULL, NULL, NULL, 'mysqladmin.sh  start ', 'ssh login Failed', 'failed', NULL, NULL),
(3, NULL, 4, 3, 'mysqladmin.sh  start ', 'ssh login Failed', 'failed', NULL, '2014-03-26 05:21:53'),
(4, NULL, 4, 3, 'mysqladmin.sh  start ', 'ssh login Failed', 'failed', NULL, '2014-03-26 05:22:16'),
(5, NULL, 4, 3, 'mysqladmin.sh  start ', 'ssh login Failed', 'failed', NULL, '2014-03-26 05:23:12'),
(6, NULL, 4, 3, 'mysqladmin.sh  start ', 'bash: mysqladmin.sh: command not found\n', 'executed', NULL, '2014-03-26 05:26:55'),
(7, NULL, 4, 3, 'mysqladmin.sh  start ', 'bash: mysqladmin.sh: command not found\n', 'executed', NULL, '2014-03-26 05:29:41'),
(8, NULL, 4, 3, 'mysqladmin.sh  start ', 'bash: mysqladmin.sh: command not found\n', 'executed', NULL, '2014-03-26 05:31:30'),
(9, NULL, 4, 3, 'mysqladmin.sh  start ', 'bash: mysqladmin.sh: command not found\n', 'executed', NULL, '2014-03-26 05:44:12'),
(10, NULL, 4, 3, './mysqladmin.sh  start ', 'bash: ./mysqladmin.sh: Permission denied\n', 'executed', NULL, '2014-03-26 05:45:47'),
(11, NULL, 4, 3, './mysqladmin.sh  start ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 05:47:12'),
(12, NULL, 4, 3, './mysqladmin.sh  start ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 07:14:02'),
(13, NULL, 4, 3, './mysqladmin.sh  start ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 07:15:09'),
(14, NULL, 6, 3, 'mysqladmin.sh  start ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 07:56:31'),
(15, NULL, 6, 3, 'mysqladmin.sh  start ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 07:58:59'),
(16, NULL, 6, 3, 'mysqladmin.sh  start ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 08:00:57'),
(17, NULL, 6, 3, 'mysqladmin.sh  restart ', 'mysql stop/waiting\nmysql start/running, process 1527\n', 'executed', NULL, '2014-03-26 08:00:57'),
(18, NULL, 6, 3, 'mysqladmin.sh  start ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 08:01:19'),
(19, NULL, 6, 3, 'mysqladmin.sh  restart ', 'mysql stop/waiting\nmysql start/running, process 1891\n', 'executed', NULL, '2014-03-26 08:01:19'),
(20, NULL, 6, 3, 'mysqladmin.sh  start ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 09:06:07'),
(21, NULL, 6, 3, 'mysqladmin.sh  restart ', 'mysql stop/waiting\nmysql start/running, process 4492\n', 'executed', NULL, '2014-03-26 09:06:07'),
(22, NULL, 9, 3, 'mysqladmin.sh  list 1.1.1.189 root root ', 'Database\ninformation_schema\nadminsys\ncentamazon\ncentedp\ncentscb\nedparty\nedparty2\nfabs\nfabscent\nfabssystem\nfabstest\nfabsuniversaldbidgeneration\nfabsuniversaldbidgeneration105\nfabsuniversaldbidgeneration2\nfabsuniversaldbidgenerationmarwa\njbpm-118\njbpm-74\nlegal\nlegalcent\nliferay\nliferay131\nliferay196\nliferay44\nliferaydemo\nliferayedp\nliferaylegal\nliferaymibrahim\nliferaynada\nliferaynagy\nliferayopenldap\nliferaysherif\nliferaywiki\nmeladcent\nmeladotms\nmikedb\nmysql\nmysqlmysql\nnavigation_menu\notms1052export\notms152nada\notms81\notmsadly\notmsadly2\notmscent\notmscent105\notmscentmarwa\notmscentnagy\notmsmarwa\notmsnagy\nperformance_schema\nwehda241t2\n', 'executed', NULL, '2014-03-26 09:15:16'),
(23, NULL, 9, 3, 'mysqladmin.sh  start 1.1.1.189 root root ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 09:15:17'),
(24, NULL, 9, 3, 'mysqladmin.sh  list 1.1.1.189 root root ', 'Database\ninformation_schema\nadminsys\ncentamazon\ncentedp\ncentscb\nedparty\nedparty2\nfabs\nfabscent\nfabslogging\nfabssystem\nfabstest\nfabsuniversaldbidgeneration\nfabsuniversaldbidgeneration105\nfabsuniversaldbidgeneration2\nfabsuniversaldbidgenerationmarwa\njbpm-118\njbpm-74\nlegal\nlegalcent\nliferay\nliferay131\nliferay196\nliferay44\nliferaydemo\nliferayedp\nliferaylegal\nliferaymibrahim\nliferaynada\nliferaynagy\nliferayopenldap\nliferaysherif\nliferaywiki\nmeladcent\nmeladotms\nmikedb\nmysql\nmysqlmysql\nnavigation_menu\notms1052export\notms152nada\notms81\notmsadly\notmsadly2\notmscent\notmscent105\notmscentmarwa\notmscentnagy\notmsmarwa\notmsnagy\nperformance_schema\nwehda241t2\n', 'executed', NULL, '2014-03-27 04:52:04'),
(25, NULL, 9, 3, 'mysqladmin.sh  start 1.1.1.189 root root ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-27 04:52:04'),
(26, NULL, 9, 3, 'mysqladmin.sh  list 1.1.1.189 root root    ', 'Database\ninformation_schema\nadminsys\ncentamazon\ncentedp\ncentscb\nedparty\nedparty2\nfabs\nfabscent\nfabslogging\nfabssystem\nfabstest\nfabsuniversaldbidgeneration\nfabsuniversaldbidgeneration105\nfabsuniversaldbidgeneration2\nfabsuniversaldbidgenerationmarwa\njbpm-118\njbpm-74\nlegal\nlegalcent\nliferay\nliferay131\nliferay196\nliferay44\nliferaydemo\nliferayedp\nliferaylegal\nliferaymibrahim\nliferaynada\nliferaynagy\nliferayopenldap\nliferaysherif\nliferaywiki\nmeladcent\nmeladotms\nmikedb\nmysql\nmysqlmysql\nnavigation_menu\notms1052export\notms152nada\notms81\notmsadly\notmsadly2\notmscent\notmscent105\notmscentmarwa\notmscentnagy\notmsmarwa\notmsnagy\nperformance_schema\nwehda241t2\n', 'executed', NULL, '2014-03-30 07:38:39'),
(27, NULL, 9, 3, 'mysqladmin.sh  start 1.1.1.189 root root    ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 07:38:39'),
(28, NULL, 9, 3, 'mysqladmin.sh  list 1.1.1.189 root root    ', 'Database\ninformation_schema\nadminsys\ncentamazon\ncentedp\ncentscb\nedparty\nedparty2\nfabs\nfabscent\nfabslogging\nfabssystem\nfabstest\nfabsuniversaldbidgeneration\nfabsuniversaldbidgeneration105\nfabsuniversaldbidgeneration2\nfabsuniversaldbidgenerationmarwa\njbpm-118\njbpm-74\nlegal\nlegalcent\nliferay\nliferay131\nliferay196\nliferay44\nliferaydemo\nliferayedp\nliferaylegal\nliferaymibrahim\nliferaynada\nliferaynagy\nliferayopenldap\nliferaysherif\nliferaywiki\nmeladcent\nmeladotms\nmikedb\nmysql\nmysqlmysql\nnavigation_menu\notms1052export\notms152nada\notms81\notmsadly\notmsadly2\notmscent\notmscent105\notmscentmarwa\notmscentnagy\notmsmarwa\notmsnagy\nperformance_schema\nwehda241t2\n', 'executed', NULL, '2014-03-30 08:06:06'),
(29, NULL, 9, 3, 'mysqladmin.sh  start 1.1.1.189 root root    ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 08:06:06'),
(30, NULL, 4, 3, 'mysqladmin.sh  start       ', 'ssh login Failed', 'failed', NULL, '2014-03-30 08:14:10'),
(31, NULL, 4, 3, 'mysqladmin.sh  start       ', 'ssh login Failed', 'failed', NULL, '2014-03-30 08:14:10'),
(32, NULL, 9, 3, 'mysqladmin.sh  list 1.1.1.189 root root    ', 'Database\ninformation_schema\nadminsys\ncentamazon\ncentedp\ncentscb\nedparty\nedparty2\nfabs\nfabscent\nfabslogging\nfabssystem\nfabstest\nfabsuniversaldbidgeneration\nfabsuniversaldbidgeneration105\nfabsuniversaldbidgeneration2\nfabsuniversaldbidgenerationmarwa\njbpm-118\njbpm-74\nlegal\nlegalcent\nliferay\nliferay131\nliferay196\nliferay44\nliferaydemo\nliferayedp\nliferaylegal\nliferaymibrahim\nliferaynada\nliferaynagy\nliferayopenldap\nliferaysherif\nliferaywiki\nmeladcent\nmeladotms\nmikedb\nmysql\nmysqlmysql\nnavigation_menu\notms1052export\notms152nada\notms81\notmsadly\notmsadly2\notmscent\notmscent105\notmscentmarwa\notmscentnagy\notmsmarwa\notmsnagy\nperformance_schema\nwehda241t2\n', 'executed', NULL, '2014-03-30 08:14:52'),
(33, NULL, 9, 3, 'mysqladmin.sh  start 1.1.1.189 root root    ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 08:14:52'),
(34, NULL, 4, 3, 'mysqladmin.sh  start       ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 08:15:40'),
(35, NULL, 4, 3, 'mysqladmin.sh  start       ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 08:15:40'),
(36, NULL, 4, 3, 'mysqladmin.sh  start       ', 'ssh login Failed', 'failed', NULL, '2014-03-30 09:07:28'),
(37, NULL, 4, 3, 'mysqladmin.sh  start       ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 09:07:28'),
(38, NULL, 4, 3, 'mysqladmin.sh  start       ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 09:08:36'),
(39, NULL, 4, 3, 'mysqladmin.sh  start       ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 09:08:36'),
(40, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-03 06:31:30'),
(41, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-03 06:31:30'),
(42, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-03 07:11:18'),
(43, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-03 07:11:18'),
(44, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-03 07:14:07'),
(45, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-03 07:14:07'),
(46, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 06:32:10'),
(47, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 06:32:10'),
(48, NULL, 6, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 07:15:26'),
(49, NULL, 6, 3, 'mysqladmin.sh  "restart" "" "" "" "" "" "" ', 'mysql stop/waiting\nmysql start/running, process 30801\n', 'executed', NULL, '2014-04-05 07:15:26'),
(50, NULL, 9, 3, 'mysqladmin.sh  "list" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-05 07:20:50'),
(51, NULL, 9, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 07:20:50'),
(52, NULL, 9, 3, 'mysqladmin.sh  "list" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-05 07:24:03'),
(53, NULL, 9, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 07:24:03'),
(54, NULL, 16, 3, 'mysqladmin.sh  "list" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-05 07:33:35'),
(55, NULL, 16, 3, 'mysqladmin.sh  "list" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-05 08:10:16'),
(56, NULL, 16, 3, 'mysqladmin.sh  "list" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-05 08:11:09'),
(57, NULL, 16, 3, 'mysqladmin.sh  "list" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-05 08:14:43'),
(58, NULL, 16, 3, 'mysqladmin.sh  "list" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-05 08:15:30'),
(59, NULL, 16, 3, 'mysqladmin.sh  "list" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-05 08:21:03'),
(60, NULL, 16, 3, 'mysqladmin.sh  "list" "3" "" "root" "" "root" "" "" "" "" "" "" "" ', 'ERROR 2003 (HY000): Can''t connect to MySQL server on ''3'' (22)\n', 'executed', NULL, '2014-04-05 08:22:54'),
(61, NULL, 16, 3, 'mysqladmin.sh  "list" "3" "root" "root" "" "" "" ', 'ERROR 2003 (HY000): Can''t connect to MySQL server on ''3'' (22)\n', 'executed', NULL, '2014-04-05 08:23:54'),
(62, NULL, 16, 3, 'mysqladmin.sh  "list" "3" "root" "root" "" "" "" ', 'ERROR 2003 (HY000): Can''t connect to MySQL server on ''3'' (22)\n', 'executed', NULL, '2014-04-05 08:31:59'),
(63, NULL, 16, 3, 'mysqladmin.sh  "list" "1.1.1.189" "root" "root" "" "" "" ', 'Database\ninformation_schema\nadminsys\ncentamazon\ncentedp\ncentscb\nedparty\nedparty2\nfabs\nfabscent\nfabslogging\nfabssystem\nfabstest\nfabsuniversaldbidgeneration\nfabsuniversaldbidgeneration105\nfabsuniversaldbidgeneration2\nfabsuniversaldbidgenerationmarwa\njbpm-118\njbpm-74\nlegal\nlegalcent\nliferay\nliferay131\nliferay196\nliferay44\nliferaydemo\nliferayedp\nliferaylegal\nliferaymibrahim\nliferaynada\nliferaynagy\nliferayod\nliferayopenldap\nliferaysherif\nliferaywiki\nmeladcent\nmeladotms\nmikedb\nmysql\nmysqlmysql\nnavigation_menu\nod\nodcent\notms1052export\notms152nada\notms81\notmsadly\notmsadly2\notmscent\notmscent105\notmscentmarwa\notmscentnagy\notmsmarwa\notmsnagy\nperformance_schema\nwehda241t2\n', 'executed', NULL, '2014-04-05 08:33:03'),
(64, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 08:41:47'),
(65, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 08:41:47'),
(66, NULL, 13, 3, 'mysqladmin.sh  "backup" "1.1.1.189" "root" "root" "mysql" "1.JPG" "huma" ', './mysqladmin.sh: line 39: 1.JPG/huma: No such file or directory\n', 'executed', NULL, '2014-04-05 08:46:26'),
(67, NULL, 13, 3, 'mysqladmin.sh  "backup" "1.1.1.189" "root" "root" "mysql" "1.JPG" "huma" ', './mysqladmin.sh: line 39: 1.JPG/huma: No such file or directory\n', 'executed', NULL, '2014-04-05 08:46:48'),
(68, NULL, 13, 3, 'mysqladmin.sh  "backup" "1.1.1.189" "root" "root" "mysql" "/" "huma" ', '-- Warning: Skipping the data of table mysql.event. Specify the --events option explicitly.\n', 'executed', NULL, '2014-04-05 08:49:26'),
(69, NULL, 13, 3, 'mysqladmin.sh  "backup" "1.1.1.189" "root" "root" "fabscent" "/" "huma" ', '', 'executed', NULL, '2014-04-05 08:50:22'),
(70, NULL, 12, 3, 'mysqladmin.sh  "create" "1.1.1.189" "root" "root" "humatest" "" "" ', 'ssh login Failed', 'failed', NULL, '2014-04-05 08:57:55'),
(71, NULL, 12, 3, 'mysqladmin.sh  "create" "1.1.1.189" "root" "root" "humatest" "" "" ', 'ssh login Failed', 'failed', NULL, '2014-04-05 08:58:58'),
(72, NULL, 12, 3, 'mysqladmin.sh  "create" "1.1.1.189" "root" "root" "huma123" "" "" ', '', 'executed', NULL, '2014-04-05 09:01:43'),
(73, NULL, 16, 3, 'mysqladmin.sh  "list" "1.1.1.189" "root" "root" "" "" "" ', 'Database\ninformation_schema\nadminsys\ncentamazon\ncentedp\ncentscb\nedparty\nedparty2\nfabs\nfabscent\nfabslogging\nfabssystem\nfabstest\nfabsuniversaldbidgeneration\nfabsuniversaldbidgeneration105\nfabsuniversaldbidgeneration2\nfabsuniversaldbidgenerationmarwa\nhuma123\njbpm-118\njbpm-74\nlegal\nlegalcent\nliferay\nliferay131\nliferay196\nliferay44\nliferaydemo\nliferayedp\nliferaylegal\nliferaymibrahim\nliferaynada\nliferaynagy\nliferayod\nliferayopenldap\nliferaysherif\nliferaywiki\nmeladcent\nmeladotms\nmikedb\nmysql\nmysqlmysql\nnavigation_menu\nod\nodcent\notms1052export\notms152nada\notms81\notmsadly\notmsadly2\notmscent\notmscent105\notmscentmarwa\notmscentnagy\notmsmarwa\notmsnagy\nperformance_schema\nwehda241t2\n', 'executed', NULL, '2014-04-05 09:02:19'),
(74, NULL, 15, 3, 'mysqladmin.sh  "restore" "1.1.1.189" "root" "root" "huma123" "/" "1(1).JPG" ', './mysqladmin.sh: line 43: //1(1).JPG: No such file or directory\n', 'executed', NULL, '2014-04-05 09:11:09'),
(75, NULL, 11, 3, 'mysqladmin.sh  "drop" "1.1.1.189" "root" "root" "huma123" "" "" ', '', 'executed', NULL, '2014-04-05 09:11:24'),
(76, NULL, 6, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 09:11:36'),
(77, NULL, 6, 3, 'mysqladmin.sh  "restart" "" "" "" "" "" "" ', 'mysql stop/waiting\nmysql start/running, process 4577\n', 'executed', NULL, '2014-04-05 09:11:36'),
(78, NULL, 10, 3, 'mysqladmin.sh  "stop" "" "" "" "" "" "" ', 'mysql stop/waiting\n', 'executed', NULL, '2014-04-05 09:11:44'),
(79, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'mysql start/running, process 4936\n', 'executed', NULL, '2014-04-05 09:11:51'),
(80, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-05 09:11:51'),
(81, NULL, 14, 3, 'mysqladmin.sh  "update" "1.1.1.189" "root" "root" "huma123" "2.jpg" "4.jpg" ', './mysqladmin.sh: line 43: 2.jpg/4.jpg: No such file or directory\n', 'executed', NULL, '2014-04-05 09:12:09'),
(82, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-15 03:01:07'),
(83, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-15 03:01:07'),
(84, NULL, 22, 3, 'sendreceive.sh  "send" "1" "11" "1" "1" "1" "1" "1" ', 'bash: ./sendreceive.sh: No such file or directory\n', 'executed', NULL, '2014-04-29 11:52:41'),
(85, NULL, 22, 3, 'sendreceive.sh  "send" "huma" "C:\\wamp\\www\\sys\\upload" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'bash: ./sendreceive.sh: No such file or directory\n', 'executed', NULL, '2014-04-29 11:54:48'),
(86, NULL, 22, 3, 'sendreceive.sh  "send" "huma" "C:\\wamp\\www\\sys\\upload" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'bash: ./sendreceive.sh: Permission denied\n', 'executed', NULL, '2014-04-29 12:00:49'),
(87, NULL, 22, 3, 'sendreceive.sh  "send" "huma" "C:\\wamp\\www\\sys\\upload" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', './sendreceive.sh: line 16: cd: C:\\wamp\\www\\sys\\upload: No such file or directory\nDomain=[WORKGROUP] OS=[Unix] Server=[Samba 3.6.9]\nhuma does not exist\n', 'executed', NULL, '2014-04-29 12:01:51'),
(88, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue DriverScanner 2014 4.0.12.rar" "/" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'Domain=[WORKGROUP] OS=[Unix] Server=[Samba 3.6.9]\nUniblue does not exist\n', 'executed', NULL, '2014-04-29 12:03:35'),
(89, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue.rar" "/" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'Domain=[WORKGROUP] OS=[Unix] Server=[Samba 3.6.9]\nUniblue.rar does not exist\n', 'executed', NULL, '2014-04-29 12:07:00'),
(90, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue.rar" "/" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'Domain=[WORKGROUP] OS=[Unix] Server=[Samba 3.6.9]\nUniblue.rar does not exist\n', 'executed', NULL, '2014-04-29 12:08:04'),
(91, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue.rar" "/root" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'Domain=[WORKGROUP] OS=[Unix] Server=[Samba 3.6.9]\nputting file Uniblue.rar as \\Uniblue.rar (134591.3 kb/s) (average 134591.5 kb/s)\n', 'executed', NULL, '2014-04-29 12:09:21'),
(92, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue.rar" "/root" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'Domain=[WORKGROUP] OS=[Unix] Server=[Samba 3.6.9]\nputting file Uniblue.rar as \\Uniblue.rar (136339.3 kb/s) (average 136339.4 kb/s)\n', 'executed', NULL, '2014-04-29 12:10:34'),
(93, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue XXXXXXXXXXXX.rar" "/root" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'Domain=[WORKGROUP] OS=[Unix] Server=[Samba 3.6.9]\nUniblue does not exist\n', 'executed', NULL, '2014-04-29 12:12:02'),
(94, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue XXXXXXXXXXXX.rar" "/root" "1.1.1.189/allusers" "/" "lap" "lap" "lap" ', 'Domain=[WORKGROUP] OS=[Unix] Server=[Samba 3.6.9]\nUniblue does not exist\n', 'executed', NULL, '2014-04-29 12:21:16'),
(95, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue.rar" "/root" "1.1.1.39/upload" "/" "administrator" "Abc@123456" "1.1.1.39" ', 'Domain=[AUTOMATIONSYSTE] OS=[Windows Server 2012 R2 Datacenter Evaluation 9600] Server=[Windows Server 2012 R2 Datacenter Evaluation 6.3]\nUniblue.rar does not exist\n', 'executed', NULL, '2014-04-29 12:39:25'),
(96, NULL, 22, 3, 'sendreceive.sh  "send" "huma" "/root" "1.1.1.39/upload" "/" "administrator" "Abc@123456" "1.1.1.39" ', 'Domain=[AUTOMATIONSYSTE] OS=[Windows Server 2012 R2 Datacenter Evaluation 9600] Server=[Windows Server 2012 R2 Datacenter Evaluation 6.3]\nhuma does not exist\n', 'executed', NULL, '2014-04-29 12:40:29'),
(97, NULL, 22, 3, 'sendreceive.sh  "send" "Uniblue.rar" "/root" "1.1.1.39/upload" "/" "administrator" "Abc@123456" "1.1.1.39" ', 'Domain=[AUTOMATIONSYSTE] OS=[Windows Server 2012 R2 Datacenter Evaluation 9600] Server=[Windows Server 2012 R2 Datacenter Evaluation 6.3]\nputting file Uniblue.rar as \\Uniblue.rar (7245.1 kb/s) (average 7245.1 kb/s)\n', 'executed', NULL, '2014-04-29 12:42:56'),
(98, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-29 02:03:58'),
(99, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-29 02:03:58'),
(100, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: Permission denied\n', 'executed', NULL, '2014-04-29 02:07:26'),
(101, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: Permission denied\n', 'executed', NULL, '2014-04-29 02:07:26'),
(102, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-29 02:08:33'),
(103, NULL, 4, 4, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-29 02:08:33'),
(104, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'ssh login Failed', 'failed', NULL, '2014-04-29 02:39:13'),
(105, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'ssh login Failed', 'failed', NULL, '2014-04-29 02:41:57'),
(106, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'bash: ./mysqlscript.sh: No such file or directory\n', 'executed', NULL, '2014-04-29 02:46:53'),
(107, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'bash: ./mysqlscript.sh: Permission denied\n', 'executed', NULL, '2014-04-29 02:50:17'),
(108, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'Reading package lists...\nBuilding dependency tree...\nReading state information...\nThe following extra packages will be installed:\n  libhtml-template-perl libterm-readkey-perl mysql-client-5.5 mysql-common\n  mysql-server-core-5.5\nSuggested packages:\n  libipc-sharedcache-perl tinyca mailx\nThe following NEW packages will be installed:\n  libhtml-template-perl libterm-readkey-perl mysql-server-5.5\n  mysql-server-core-5.5\nThe following packages will be upgraded:\n  mysql-client-5.5 mysql-common\n2 upgraded, 4 newly installed, 0 to remove and 695 not upgraded.\nNeed to get 23.3 MB/23.4 MB of archives.\nAfter this operation, 53.4 MB of additional disk space will be used.\nWARNING: The following packages cannot be authenticated!\n  libterm-readkey-perl libhtml-template-perl\nE: There are problems and -y was used without --force-yes\n', 'executed', NULL, '2014-04-29 02:50:47'),
(109, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'Reading package lists...\nBuilding dependency tree...\nReading state information...\nThe following extra packages will be installed:\n  libhtml-template-perl libterm-readkey-perl mysql-client-5.5 mysql-common\n  mysql-server-core-5.5\nSuggested packages:\n  libipc-sharedcache-perl tinyca mailx\nThe following NEW packages will be installed:\n  libhtml-template-perl libterm-readkey-perl mysql-server-5.5\n  mysql-server-core-5.5\nThe following packages will be upgraded:\n  mysql-client-5.5 mysql-common\n2 upgraded, 4 newly installed, 0 to remove and 695 not upgraded.\nNeed to get 23.3 MB/23.4 MB of archives.\nAfter this operation, 53.4 MB of additional disk space will be used.\nWARNING: The following packages cannot be authenticated!\n  libterm-readkey-perl libhtml-template-perl\nGet:1 http://eg.archive.ubuntu.com/ubuntu/ precise-updates/main mysql-common all 5.5.37-0ubuntu0.12.04.1 [13.3 kB]\nGet:2 http://eg.archive.ubuntu.com/ubuntu/ precise-updates/main mysql-client-5.5 amd64 5.5.37-0ubuntu0.12.04.1 [8,338 kB]\nGet:3 http://eg.archive.ubuntu.com/ubuntu/ precise-updates/main mysql-server-core-5.5 amd64 5.5.37-0ubuntu0.12.04.1 [6,085 kB]\nGet:4 http://eg.archive.ubuntu.com/ubuntu/ precise-updates/main mysql-server-5.5 amd64 5.5.37-0ubuntu0.12.04.1 [8,840 kB]\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\ndpkg-preconfigure: unable to re-open stdin: \nFetched 23.3 MB in 4min 4s (95.3 kB/s)\n(Reading database ... 143772 files and directories currently installed.)\nPreparing to replace mysql-common 5.5.29-0ubuntu0.12.04.2 (using .../mysql-common_5.5.37-0ubuntu0.12.04.1_all.deb) ...\nUnpacking replacement mysql-common ...\nSelecting previously unselected package libterm-readkey-perl.\nUnpacking libterm-readkey-perl (from .../libterm-readkey-perl_2.30-4build3_amd64.deb) ...\nPreparing to replace mysql-client-5.5 5.5.29-0ubuntu0.12.04.2 (using .../mysql-client-5.5_5.5.37-0ubuntu0.12.04.1_amd64.deb) ...\nUnpacking replacement mysql-client-5.5 ...\nSelecting previously unselected package mysql-server-core-5.5.\nUnpacking mysql-server-core-5.5 (from .../mysql-server-core-5.5_5.5.37-0ubuntu0.12.04.1_amd64.deb) ...\nProcessing triggers for man-db ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\nSetting up mysql-common (5.5.37-0ubuntu0.12.04.1) ...\nSelecting previously unselected package mysql-server-5.5.\n(Reading database ... 143872 files and directories currently installed.)\nUnpacking mysql-server-5.5 (from .../mysql-server-5.5_5.5.37-0ubuntu0.12.04.1_amd64.deb) ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\nSelecting previously unselected package libhtml-template-perl.\nUnpacking libhtml-template-perl (from .../libhtml-template-perl_2.10-1_all.deb) ...\nProcessing triggers for ureadahead ...\nProcessing triggers for man-db ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\nSetting up libterm-readkey-perl (2.30-4build3) ...\nSetting up mysql-client-5.5 (5.5.37-0ubuntu0.12.04.1) ...\nSetting up mysql-server-core-5.5 (5.5.37-0ubuntu0.12.04.1) ...\nSetting up mysql-server-5.5 (5.5.37-0ubuntu0.12.04.1) ...\nInstalling new version of config file /etc/apparmor.d/usr.sbin.mysqld ...\nInstalling new version of config file /etc/init/mysql.conf ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\n140429 17:17:23 [Note] Plugin ''FEDERATED'' is disabled.\n140429 17:17:23 InnoDB: The InnoDB memory heap is disabled\n140429 17:17:23 InnoDB: Mutexes and rw_locks use GCC atomic builtins\n140429 17:17:23 InnoDB: Compressed tables use zlib 1.2.3.4\n140429 17:17:23 InnoDB: Initializing buffer pool, size = 128.0M\n140429 17:17:23 InnoDB: Completed initialization of buffer pool\n140429 17:17:23 InnoDB: highest supported file format is Barracuda.\n140429 17:17:23  InnoDB: Waiting for the background threads to start\n140429 17:17:24 InnoDB: 5.5.37 started; log sequence number 9546214378\n140429 17:17:24  InnoDB: Starting shutdown...\n140429 17:17:24  InnoDB: Shutdown completed; log sequence number 9546214378\nstart: Job failed to start\ninvoke-rc.d: initscript mysql, action "start" failed.\ndpkg: error processing mysql-server-5.5 (--configure):\n subprocess installed post-installation script returned error exit status 1\nSetting up libhtml-template-perl (2.10-1) ...\nErrors were encountered while processing:\n mysql-server-5.5\nE: Sub-process /usr/bin/dpkg returned an error code (1)\n', 'executed', NULL, '2014-04-29 03:12:55'),
(110, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'Reading package lists...\nBuilding dependency tree...\nReading state information...\nSuggested packages:\n  tinyca mailx\nThe following NEW packages will be installed:\n  mysql-server-5.5\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\ndpkg-preconfigure: unable to re-open stdin: \n0 upgraded, 1 newly installed, 0 to remove and 695 not upgraded.\nNeed to get 0 B/8,840 kB of archives.\nAfter this operation, 32.7 MB of additional disk space will be used.\nSelecting previously unselected package mysql-server-5.5.\n(Reading database ... 143874 files and directories currently installed.)\nUnpacking mysql-server-5.5 (from .../mysql-server-5.5_5.5.37-0ubuntu0.12.04.1_amd64.deb) ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\negrep: /etc/mysql/: No such file or directory\nProcessing triggers for ureadahead ...\nProcessing triggers for man-db ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\nSetting up mysql-server-5.5 (5.5.37-0ubuntu0.12.04.1) ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\n140429 17:30:08 [Note] Plugin ''FEDERATED'' is disabled.\n140429 17:30:08 InnoDB: The InnoDB memory heap is disabled\n140429 17:30:08 InnoDB: Mutexes and rw_locks use GCC atomic builtins\n140429 17:30:08 InnoDB: Compressed tables use zlib 1.2.3.4\n140429 17:30:08 InnoDB: Initializing buffer pool, size = 128.0M\n140429 17:30:08 InnoDB: Completed initialization of buffer pool\n140429 17:30:08 InnoDB: highest supported file format is Barracuda.\n140429 17:30:08  InnoDB: Waiting for the background threads to start\n140429 17:30:09 InnoDB: 5.5.37 started; log sequence number 1595675\n140429 17:30:09 [ERROR] /usr/sbin/mysqld: Can''t find file: ''./mysql/user.frm'' (errno: 13)\nERROR: 1017  Can''t find file: ''./mysql/user.frm'' (errno: 13)\n140429 17:30:09 [ERROR] Aborting\n\n140429 17:30:09  InnoDB: Starting shutdown...\n140429 17:30:09  InnoDB: Shutdown completed; log sequence number 1595675\n140429 17:30:09 [Note] /usr/sbin/mysqld: Shutdown complete\n\nstart: Job failed to start\ninvoke-rc.d: initscript mysql, action "start" failed.\nConfiguring mysql-server-5.5\n----------------------------\n\nUnable to set password for the MySQL "root" user\n\nAn error occurred while setting the password for the MySQL administrative user. \nThis may have happened because the account already has a password, or because of\na communication problem with the MySQL server.\n\nYou should check the account''s password after the package installation.\n\nPlease read the /usr/share/doc/mysql-server-5.5/README.Debian file for more \ninformation.\n\ndpkg: error processing mysql-server-5.5 (--configure):\n subprocess installed post-installation script returned error exit status 1\nErrors were encountered while processing:\n mysql-server-5.5\nE: Sub-process /usr/bin/dpkg returned an error code (1)\n', 'executed', NULL, '2014-04-29 03:29:37'),
(111, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'Reading package lists...\nBuilding dependency tree...\nReading state information...\nmysql-server-5.5 is already the newest version.\n0 upgraded, 0 newly installed, 0 to remove and 695 not upgraded.\n1 not fully installed or removed.\nAfter this operation, 0 B of additional disk space will be used.\nSetting up mysql-server-5.5 (5.5.37-0ubuntu0.12.04.1) ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\n140429 17:31:30 [Note] Plugin ''FEDERATED'' is disabled.\n140429 17:31:30 InnoDB: The InnoDB memory heap is disabled\n140429 17:31:30 InnoDB: Mutexes and rw_locks use GCC atomic builtins\n140429 17:31:30 InnoDB: Compressed tables use zlib 1.2.3.4\n140429 17:31:30 InnoDB: Initializing buffer pool, size = 128.0M\n140429 17:31:30 InnoDB: Completed initialization of buffer pool\n140429 17:31:30 InnoDB: highest supported file format is Barracuda.\n140429 17:31:30  InnoDB: Waiting for the background threads to start\n140429 17:31:31 InnoDB: 5.5.37 started; log sequence number 1595675\n140429 17:31:31  InnoDB: Starting shutdown...\n140429 17:31:32  InnoDB: Shutdown completed; log sequence number 1595675\nstart: Job failed to start\ninvoke-rc.d: initscript mysql, action "start" failed.\ndpkg: error processing mysql-server-5.5 (--configure):\n subprocess installed post-installation script returned error exit status 1\nErrors were encountered while processing:\n mysql-server-5.5\nE: Sub-process /usr/bin/dpkg returned an error code (1)\n', 'executed', NULL, '2014-04-29 03:30:57'),
(112, NULL, 24, 5, 'mysqlscript.sh  "installmysql" "root" ', 'Reading package lists...\nBuilding dependency tree...\nReading state information...\nmysql-server-5.5 is already the newest version.\n0 upgraded, 0 newly installed, 0 to remove and 695 not upgraded.\n2 not fully installed or removed.\nAfter this operation, 0 B of additional disk space will be used.\nSetting up mysql-server-5.5 (5.5.37-0ubuntu0.12.04.1) ...\ndebconf: unable to initialize frontend: Dialog\ndebconf: (Dialog frontend will not work on a dumb terminal, an emacs shell buffer, or without a controlling terminal.)\ndebconf: falling back to frontend: Readline\ndebconf: unable to initialize frontend: Readline\ndebconf: (This frontend requires a controlling tty.)\ndebconf: falling back to frontend: Teletype\n140430 12:16:04 [Note] Plugin ''FEDERATED'' is disabled.\n140430 12:16:04 InnoDB: The InnoDB memory heap is disabled\n140430 12:16:04 InnoDB: Mutexes and rw_locks use GCC atomic builtins\n140430 12:16:04 InnoDB: Compressed tables use zlib 1.2.3.4\n140430 12:16:04 InnoDB: Initializing buffer pool, size = 128.0M\n140430 12:16:04 InnoDB: Completed initialization of buffer pool\n140430 12:16:04 InnoDB: highest supported file format is Barracuda.\n140430 12:16:04  InnoDB: Waiting for the background threads to start\n140430 12:16:05 InnoDB: 5.5.37 started; log sequence number 1595675\nERROR: 1146  Table ''mysql.user'' doesn''t exist\n140430 12:16:05 [ERROR] Aborting\n\n140430 12:16:05  InnoDB: Starting shutdown...\n140430 12:16:05  InnoDB: Shutdown completed; log sequence number 1595675\n140430 12:16:05 [Note] /usr/sbin/mysqld: Shutdown complete\n\nstart: Job failed to start\ninvoke-rc.d: initscript mysql, action "start" failed.\nConfiguring mysql-server-5.5\n----------------------------\n\nUnable to set password for the MySQL "root" user\n\nAn error occurred while setting the password for the MySQL administrative user. \nThis may have happened because the account already has a password, or because of\na communication problem with the MySQL server.\n\nYou should check the account''s password after the package installation.\n\nPlease read the /usr/share/doc/mysql-server-5.5/README.Debian file for more \ninformation.\n\ndpkg: error processing mysql-server-5.5 (--configure):\n subprocess installed post-installation script returned error exit status 1\ndpkg: dependency problems prevent configuration of mysql-server:\n mysql-server depends on mysql-server-5.5; however:\n  Package mysql-server-5.5 is not configured yet.\ndpkg: error processing mysql-server (--configure):\n dependency problems - leaving unconfigured\nNo apport report written because the error message indicates its a followup error from a previous failure.\nErrors were encountered while processing:\n mysql-server-5.5\n mysql-server\nE: Sub-process /usr/bin/dpkg returned an error code (1)\n', 'executed', NULL, '2014-04-30 10:15:24'),
(113, NULL, 4, 5, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-30 10:17:48'),
(114, NULL, 4, 5, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'bash: ./mysqladmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-30 10:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `create_task`
--

CREATE TABLE IF NOT EXISTS `create_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `DBUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `create_task`
--

INSERT INTO `create_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`, `HOSTNAME`, `DBUSERNAME`, `PASSWORD`, `DATABASE`) VALUES
(1, 'Administrator', '2014-04-05 20:56:30', '3', '1.1.1.189', 'root', 'root', 'humatest'),
(2, 'Administrator', '2014-04-05 20:57:55', '3', '1.1.1.189', 'root', 'root', 'humatest'),
(3, 'Administrator', '2014-04-05 20:58:58', '3', '1.1.1.189', 'root', 'root', 'humatest'),
(4, 'Administrator', '2014-04-05 21:01:43', '3', '1.1.1.189', 'root', 'root', 'huma123'),
(5, 'Administrator', '2014-04-13 17:31:34', '3', '1.1.1.189', 'root', 'root', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `deletepool_task`
--

CREATE TABLE IF NOT EXISTS `deletepool_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishadmin` varchar(255) NOT NULL DEFAULT '',
  `GLUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSFILE` varchar(255) NOT NULL DEFAULT '',
  `JDBCNAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `deleteresource_task`
--

CREATE TABLE IF NOT EXISTS `deleteresource_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishadmin` varchar(255) NOT NULL DEFAULT '',
  `GLUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSFILE` varchar(255) NOT NULL DEFAULT '',
  `JDBCNAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `deploy_task`
--

CREATE TABLE IF NOT EXISTS `deploy_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_asadmin` varchar(255) NOT NULL DEFAULT '',
  `GLUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSFILE` varchar(255) NOT NULL DEFAULT '',
  `APPFL_NM` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `drop_task`
--

CREATE TABLE IF NOT EXISTS `drop_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `DBUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `drop_task`
--

INSERT INTO `drop_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`, `HOSTNAME`, `DBUSERNAME`, `PASSWORD`, `DATABASE`) VALUES
(1, 'Administrator', '2014-04-05 21:11:24', '3', '1.1.1.189', 'root', 'root', 'huma123');

-- --------------------------------------------------------

--
-- Table structure for table `editportalext_task`
--

CREATE TABLE IF NOT EXISTS `editportalext_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishscript` varchar(255) NOT NULL DEFAULT '',
  `glassfishfolder` varchar(255) NOT NULL DEFAULT '',
  `domainname` varchar(255) NOT NULL DEFAULT '',
  `liferaydbip` varchar(255) NOT NULL DEFAULT '',
  `liferaydbname` varchar(255) NOT NULL DEFAULT '',
  `liferaydbuser` varchar(255) NOT NULL DEFAULT '',
  `liferaydbpass` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fabsprop_task`
--

CREATE TABLE IF NOT EXISTS `fabsprop_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishscript` varchar(255) NOT NULL DEFAULT '',
  `glassfishfolder` varchar(255) NOT NULL DEFAULT '',
  `domainname` varchar(255) NOT NULL DEFAULT '',
  `contextname_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `function_group`
--

CREATE TABLE IF NOT EXISTS `function_group` (
  `function_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`function_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `function_group`
--

INSERT INTO `function_group` (`function_group_id`, `function_group_name`) VALUES
(3, 'start'),
(4, 'restart'),
(6, 'stop'),
(7, 'drop'),
(8, 'create'),
(9, 'backup'),
(10, 'update'),
(11, 'restore'),
(12, 'list'),
(13, 'stopglassfish'),
(14, 'startglassfish'),
(15, 'restartglassfish'),
(16, 'deploy'),
(17, 'undeploy'),
(18, 'send'),
(19, 'receive'),
(20, 'installmysql'),
(21, 'addpool'),
(22, 'deletepool'),
(23, 'addresource'),
(24, 'deleteresource'),
(25, 'installworkbench'),
(26, 'configmysqlremote'),
(27, 'configmysqlvars'),
(28, 'installglassfish'),
(29, 'tmpgs'),
(30, 'fabsprop'),
(31, 'glassfishtuning'),
(32, 'editportalext');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `function_group_relation`
--

INSERT INTO `function_group_relation` (`function_group_relation_id`, `function_group_id`, `script_function_id`, `priority`) VALUES
(4, 3, 6, 1),
(5, 4, 7, 1),
(9, 6, 9, 1),
(10, 7, 10, 1),
(11, 8, 11, 1),
(12, 9, 12, 1),
(13, 10, 13, 1),
(14, 11, 14, 1),
(15, 12, 8, 1),
(16, 13, 15, 1),
(17, 14, 16, 1),
(18, 15, 17, 1),
(19, 16, 18, 1),
(20, 17, 19, 1),
(21, 18, 20, 1),
(22, 19, 21, 1),
(23, 20, 22, 1),
(24, 21, 23, 1),
(25, 22, 24, 1),
(26, 23, 25, 1),
(27, 24, 26, 1),
(28, 25, 27, 1),
(29, 26, 28, 1),
(30, 27, 29, 1),
(31, 28, 33, 1),
(32, 29, 34, 1),
(33, 30, 35, 1),
(34, 31, 36, 1),
(35, 32, 37, 1);

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
-- Table structure for table `glassfishtuning_task`
--

CREATE TABLE IF NOT EXISTS `glassfishtuning_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishscript` varchar(255) NOT NULL DEFAULT '',
  `glassfishfolder` varchar(255) NOT NULL DEFAULT '',
  `domainname` varchar(255) NOT NULL DEFAULT '',
  `JVMHEAPSIZE` varchar(255) NOT NULL DEFAULT '',
  `JVMHEAPSIZEXMN` varchar(255) NOT NULL DEFAULT '',
  `JVMPARALLELGCTHREADS` varchar(255) NOT NULL DEFAULT '',
  `MAXTHREADPOOLSIZE` varchar(255) NOT NULL DEFAULT '',
  `LargePageSizeInBytes` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `installglassfish_task`
--

CREATE TABLE IF NOT EXISTS `installglassfish_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishscript` varchar(255) NOT NULL DEFAULT '',
  `glassfishfolder` varchar(255) NOT NULL DEFAULT '',
  `adminpassword` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `installmysql_task`
--

CREATE TABLE IF NOT EXISTS `installmysql_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqlscript` varchar(255) NOT NULL DEFAULT '',
  `rootpass` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `installmysql_task`
--

INSERT INTO `installmysql_task` (`id`, `username`, `datetime`, `server_id_mysqlscript`, `rootpass`) VALUES
(1, 'Administrator', '2014-04-29 14:36:03', '5', 'root'),
(2, 'Administrator', '2014-04-29 14:36:26', '5', 'root'),
(3, 'Administrator', '2014-04-29 14:39:13', '5', 'root'),
(4, 'Administrator', '2014-04-29 14:41:57', '5', 'root'),
(5, 'Administrator', '2014-04-29 14:46:53', '5', 'root'),
(6, 'Administrator', '2014-04-29 14:50:17', '5', 'root'),
(7, 'Administrator', '2014-04-29 14:50:47', '5', 'root'),
(8, 'Administrator', '2014-04-29 15:12:55', '5', 'root'),
(9, 'Administrator', '2014-04-29 15:29:37', '5', 'root'),
(10, 'Administrator', '2014-04-29 15:30:57', '5', 'root'),
(11, 'Administrator', '2014-04-30 10:15:24', '5', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `list_task`
--

CREATE TABLE IF NOT EXISTS `list_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `DBUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `list_task`
--

INSERT INTO `list_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`, `HOSTNAME`, `DBUSERNAME`, `PASSWORD`) VALUES
(1, 'Administrator', '2014-04-05 19:33:35', '3', '3', 'root', 'root'),
(2, 'Administrator', '2014-04-05 19:38:11', '3', '3', 'root', 'root'),
(3, 'Administrator', '2014-04-05 19:38:24', '3', '3', 'root', 'root'),
(4, 'Administrator', '2014-04-05 20:10:16', '3', '3', 'root', 'root'),
(5, 'Administrator', '2014-04-05 20:11:09', '3', '3', 'root', 'root'),
(6, 'Administrator', '2014-04-05 20:11:45', '3', '3', 'root', 'root'),
(7, 'Administrator', '2014-04-05 20:15:28', '3', '3', 'root', 'root'),
(8, 'Administrator', '2014-04-05 20:16:07', '3', '3', 'root', 'root'),
(9, 'Administrator', '2014-04-05 20:19:09', '3', '3', 'root', 'root'),
(10, 'Administrator', '2014-04-05 20:22:12', '3', '3', 'root', 'root'),
(11, 'Administrator', '2014-04-05 20:23:53', '3', '3', 'root', 'root'),
(12, 'Administrator', '2014-04-05 20:31:59', '3', '3', 'root', 'root'),
(13, 'Administrator', '2014-04-05 20:33:02', '3', '1.1.1.189', 'root', 'root'),
(14, 'Administrator', '2014-04-05 21:02:18', '3', '1.1.1.189', 'root', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `listandstart_task`
--

CREATE TABLE IF NOT EXISTS `listandstart_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `DBUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `listandstart_task`
--

INSERT INTO `listandstart_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`, `HOSTNAME`, `DBUSERNAME`, `PASSWORD`) VALUES
(1, '', '2014-04-05 19:20:50', '3', '1.1.1.189', 'root', 'root'),
(2, '', '2014-04-05 19:24:03', '3', '1.1.1.189', 'root', 'root');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`parameter_id`, `script_id`, `parameter_name`) VALUES
(8, 3, 'server_id_mysqladmin'),
(9, 3, 'HOSTNAME'),
(10, 3, 'DBUSERNAME'),
(11, 3, 'PASSWORD'),
(12, 3, 'DATABASE'),
(13, 3, 'FILEPATH'),
(14, 3, 'FILENAME'),
(15, 4, 'server_id_asadmin'),
(16, 4, 'GLUSERNAME'),
(17, 4, 'PASSFILE'),
(18, 4, 'APPFL_NM'),
(27, 6, 'server_id_sendreceive'),
(28, 6, 'TARGET_FILENAME'),
(29, 6, 'LOCAL_PATH'),
(30, 6, 'REMOTE_IPAND1STLVL'),
(31, 6, 'REMOTE_REMAIN_PATH'),
(32, 6, 'REMOTE_USERNAME'),
(33, 6, 'REMOTE_PASSWORD'),
(34, 6, 'REMOTE_DOMAIN'),
(35, 7, 'server_id_mysqlscript'),
(36, 7, 'rootpass'),
(37, 5, 'server_id_glassfishadmin'),
(38, 5, 'GLUSERNAME'),
(39, 5, 'PASSFILE'),
(40, 5, 'JDBCNAME'),
(41, 5, 'DBS_JDBC'),
(42, 7, 'keybuffer'),
(43, 7, 'maxallowedpacket'),
(44, 7, 'threadstack'),
(45, 7, 'threadcachesize'),
(46, 7, 'maxconnections'),
(47, 7, 'tablecache'),
(48, 7, 'querycachelimit'),
(49, 7, 'querycachesize'),
(50, 8, 'server_id_glassfishscript'),
(51, 8, 'glassfishfolder'),
(52, 8, 'adminpassword'),
(53, 8, 'domainname'),
(54, 8, 'liferaydbip'),
(55, 8, 'liferaydbname'),
(56, 8, 'liferaydbuser'),
(57, 8, 'liferaydbpass'),
(58, 8, 'JVMHEAPSIZE'),
(59, 8, 'JVMHEAPSIZEXMN'),
(60, 8, 'JVMPARALLELGCTHREADS'),
(61, 8, 'MAXTHREADPOOLSIZE'),
(62, 8, 'LargePageSizeInBytes'),
(63, 8, 'contextname_value');

-- --------------------------------------------------------

--
-- Table structure for table `receive_task`
--

CREATE TABLE IF NOT EXISTS `receive_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_sendreceive` varchar(255) NOT NULL DEFAULT '',
  `TARGET_FILENAME` varchar(255) NOT NULL DEFAULT '',
  `LOCAL_PATH` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_IPAND1STLVL` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_REMAIN_PATH` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_USERNAME` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_DOMAIN` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `receive_task`
--

INSERT INTO `receive_task` (`id`, `username`, `datetime`, `server_id_sendreceive`, `TARGET_FILENAME`, `LOCAL_PATH`, `REMOTE_IPAND1STLVL`, `REMOTE_REMAIN_PATH`, `REMOTE_USERNAME`, `REMOTE_PASSWORD`, `REMOTE_DOMAIN`) VALUES
(1, 'Administrator', '2014-04-29 11:51:54', '3', 'Uniblue DriverScanner 2014 4.0.12.rar', 'C:\\wamp\\www\\sys\\upload', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap');

-- --------------------------------------------------------

--
-- Table structure for table `restart_task`
--

CREATE TABLE IF NOT EXISTS `restart_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `restart_task`
--

INSERT INTO `restart_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`) VALUES
(1, 'Administrator', '2014-04-05 19:15:26', '3'),
(2, 'Administrator', '2014-04-05 21:11:36', '3');

-- --------------------------------------------------------

--
-- Table structure for table `restartglassfish_task`
--

CREATE TABLE IF NOT EXISTS `restartglassfish_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_asadmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `restore_task`
--

CREATE TABLE IF NOT EXISTS `restore_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `DBUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `restore_task`
--

INSERT INTO `restore_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`, `HOSTNAME`, `DBUSERNAME`, `PASSWORD`, `DATABASE`, `FILEPATH`, `FILENAME`) VALUES
(1, 'Administrator', '2014-04-05 21:11:08', '3', '1.1.1.189', 'root', 'root', 'huma123', '/', '1(1).JPG');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `script`
--

INSERT INTO `script` (`script_id`, `script_name`, `script_path`, `start_range`, `end_range`) VALUES
(3, 'mysqladmin', 'mysqladmin.sh', 0, 0),
(4, 'asadmin', 'asadmin.sh', 1, 1),
(5, 'glassfishadmin', 'glassfishadmin.sh', 1, 1),
(6, 'sendreceive', 'sendreceive.sh', 1, 1),
(7, 'mysqlscript', 'mysqlscript.sh', 0, 0),
(8, 'glassfishscript', 'glassfishscript.sh', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `script_function`
--

INSERT INTO `script_function` (`script_function_id`, `script_function_name`, `script_id`) VALUES
(6, 'start', 3),
(7, 'restart', 3),
(8, 'list', 3),
(9, 'stop', 3),
(10, 'drop', 3),
(11, 'create', 3),
(12, 'backup', 3),
(13, 'update', 3),
(14, 'restore', 3),
(15, 'stopglassfish', 4),
(16, 'startglassfish', 4),
(17, 'restartglassfish', 4),
(18, 'deploy', 4),
(19, 'undeploy', 4),
(20, 'send', 6),
(21, 'receive', 6),
(22, 'installmysql', 7),
(23, 'addpool', 5),
(24, 'deletepool', 5),
(25, 'addresource', 5),
(26, 'deleteresource', 5),
(27, 'installworkbench', 7),
(28, 'configmysqlremote', 7),
(29, 'configmysqlvars', 7),
(33, 'installglassfish', 8),
(34, 'tmpgs', 8),
(35, 'fabsprop', 8),
(36, 'glassfishtuning', 8),
(37, 'editportalext', 8);

-- --------------------------------------------------------

--
-- Table structure for table `script_function_parameter_relation`
--

CREATE TABLE IF NOT EXISTS `script_function_parameter_relation` (
  `script_function_parameter_relation` int(11) NOT NULL AUTO_INCREMENT,
  `parameter_id` int(11) DEFAULT NULL,
  `script_function_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`script_function_parameter_relation`),
  KEY `parameter_id` (`parameter_id`,`script_function_id`),
  KEY `script_function_id` (`script_function_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=149 ;

--
-- Dumping data for table `script_function_parameter_relation`
--

INSERT INTO `script_function_parameter_relation` (`script_function_parameter_relation`, `parameter_id`, `script_function_id`) VALUES
(5, 8, 6),
(6, 8, 7),
(44, 8, 8),
(7, 8, 9),
(12, 8, 10),
(17, 8, 11),
(22, 8, 12),
(30, 8, 13),
(37, 8, 14),
(45, 9, 8),
(13, 9, 10),
(18, 9, 11),
(23, 9, 12),
(31, 9, 13),
(38, 9, 14),
(46, 10, 8),
(14, 10, 10),
(19, 10, 11),
(24, 10, 12),
(32, 10, 13),
(39, 10, 14),
(47, 11, 8),
(15, 11, 10),
(20, 11, 11),
(25, 11, 12),
(33, 11, 13),
(40, 11, 14),
(16, 12, 10),
(21, 12, 11),
(26, 12, 12),
(34, 12, 13),
(41, 12, 14),
(27, 13, 12),
(35, 13, 13),
(42, 13, 14),
(29, 14, 12),
(36, 14, 13),
(43, 14, 14),
(48, 15, 15),
(49, 15, 16),
(50, 15, 17),
(51, 15, 18),
(55, 15, 19),
(52, 16, 18),
(56, 16, 19),
(53, 17, 18),
(57, 17, 19),
(54, 18, 18),
(58, 18, 19),
(75, 27, 20),
(83, 27, 21),
(76, 28, 20),
(84, 28, 21),
(77, 29, 20),
(85, 29, 21),
(78, 30, 20),
(86, 30, 21),
(79, 31, 20),
(87, 31, 21),
(80, 32, 20),
(88, 32, 21),
(81, 33, 20),
(89, 33, 21),
(82, 34, 20),
(90, 34, 21),
(91, 35, 22),
(122, 35, 27),
(123, 35, 28),
(92, 36, 22),
(93, 37, 23),
(98, 37, 24),
(102, 37, 25),
(107, 37, 26),
(94, 38, 23),
(99, 38, 24),
(103, 38, 25),
(108, 38, 26),
(95, 39, 23),
(100, 39, 24),
(104, 39, 25),
(109, 39, 26),
(96, 40, 23),
(101, 40, 24),
(105, 40, 25),
(110, 40, 26),
(97, 41, 23),
(106, 41, 25),
(124, 50, 33),
(127, 50, 34),
(130, 50, 35),
(133, 50, 36),
(142, 50, 37),
(125, 51, 33),
(128, 51, 34),
(131, 51, 35),
(134, 51, 36),
(143, 51, 37),
(126, 52, 33),
(129, 53, 34),
(132, 53, 35),
(135, 53, 36),
(144, 53, 37),
(145, 54, 37),
(146, 55, 37),
(147, 56, 37),
(148, 57, 37),
(137, 58, 36),
(138, 59, 36),
(139, 60, 36),
(140, 61, 36),
(141, 62, 36),
(136, 63, 35);

-- --------------------------------------------------------

--
-- Table structure for table `send_task`
--

CREATE TABLE IF NOT EXISTS `send_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_sendreceive` varchar(255) NOT NULL DEFAULT '',
  `TARGET_FILENAME` varchar(255) NOT NULL DEFAULT '',
  `LOCAL_PATH` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_IPAND1STLVL` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_REMAIN_PATH` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_USERNAME` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `REMOTE_DOMAIN` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `send_task`
--

INSERT INTO `send_task` (`id`, `username`, `datetime`, `server_id_sendreceive`, `TARGET_FILENAME`, `LOCAL_PATH`, `REMOTE_IPAND1STLVL`, `REMOTE_REMAIN_PATH`, `REMOTE_USERNAME`, `REMOTE_PASSWORD`, `REMOTE_DOMAIN`) VALUES
(1, 'Administrator', '2014-04-29 11:52:41', '3', '1', '11', '1', '1', '1', '1', '1'),
(2, 'Administrator', '2014-04-29 11:54:48', '3', 'huma', 'C:\\wamp\\www\\sys\\upload', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(3, 'Administrator', '2014-04-29 12:00:49', '3', 'huma', 'C:\\wamp\\www\\sys\\upload', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(4, 'Administrator', '2014-04-29 12:01:50', '3', 'huma', 'C:\\wamp\\www\\sys\\upload', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(5, 'Administrator', '2014-04-29 12:03:35', '3', 'Uniblue DriverScanner 2014 4.0.12.rar', '/', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(6, 'Administrator', '2014-04-29 12:07:00', '3', 'Uniblue.rar', '/', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(7, 'Administrator', '2014-04-29 12:08:04', '3', 'Uniblue.rar', '/', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(8, 'Administrator', '2014-04-29 12:09:21', '3', 'Uniblue.rar', '/root', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(9, 'Administrator', '2014-04-29 12:10:34', '3', 'Uniblue.rar', '/root', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(10, 'Administrator', '2014-04-29 12:12:02', '3', 'Uniblue XXXXXXXXXXXX.rar', '/root', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(11, 'Administrator', '2014-04-29 12:21:16', '3', 'Uniblue XXXXXXXXXXXX.rar', '/root', '1.1.1.189/allusers', '/', 'lap', 'lap', 'lap'),
(12, 'Administrator', '2014-04-29 12:39:25', '3', 'Uniblue.rar', '/root', '1.1.1.39/upload', '/', 'administrator', 'Abc@123456', '1.1.1.39'),
(13, 'Administrator', '2014-04-29 12:40:28', '3', 'huma', '/root', '1.1.1.39/upload', '/', 'administrator', 'Abc@123456', '1.1.1.39'),
(14, 'Administrator', '2014-04-29 12:42:56', '3', 'Uniblue.rar', '/root', '1.1.1.39/upload', '/', 'administrator', 'Abc@123456', '1.1.1.39');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`server_id`, `server_name`, `server_hostname`, `server_username`, `server_password`, `server_auth_type`, `server_os`, `server_file`, `server_deleted`) VALUES
(3, 'mysql189', '1.1.1.189', 'root', 'root', 'password', 'ubuntu', 'mysqladmin(1).sh', 0),
(4, 'mysql141', '1.1.1.141', 'root', 'root', 'password', 'ubuntu', 'mysqladmin(1).sh', 0),
(5, '1.1.2.51', '1.1.2.51', 'root', 'root', 'password', 'ubuntu', 'Daily Activity Sheet - 06-Jan-2014.xls', 0);

-- --------------------------------------------------------

--
-- Table structure for table `start_task`
--

CREATE TABLE IF NOT EXISTS `start_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `start_task`
--

INSERT INTO `start_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`) VALUES
(1, 'Administrator', '2014-04-03 18:31:30', '3'),
(2, 'Administrator', '2014-04-03 19:11:18', '4'),
(3, 'Administrator', '2014-04-03 19:14:06', '4'),
(4, 'Administrator', '2014-04-05 18:32:10', '3'),
(5, 'login', '2014-04-05 20:41:47', '3'),
(6, 'Administrator', '2014-04-05 21:11:51', '3'),
(7, 'Administrator', '2014-04-07 15:40:07', '3'),
(8, 'Administrator', '2014-04-14 18:15:28', '3'),
(9, 'Administrator', '2014-04-15 15:01:06', '3'),
(10, 'Administrator', '2014-04-29 14:03:58', '4'),
(11, 'Administrator', '2014-04-29 14:07:26', '4'),
(12, 'Administrator', '2014-04-29 14:08:33', '4'),
(13, 'Administrator', '2014-04-30 10:17:48', '5');

-- --------------------------------------------------------

--
-- Table structure for table `stop_task`
--

CREATE TABLE IF NOT EXISTS `stop_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stop_task`
--

INSERT INTO `stop_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`) VALUES
(1, 'Administrator', '2014-04-05 21:11:44', '3');

-- --------------------------------------------------------

--
-- Table structure for table `stopglassfish_task`
--

CREATE TABLE IF NOT EXISTS `stopglassfish_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_asadmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  `sqlscript` text NOT NULL,
  `phpscript` text NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `sqlscript`, `phpscript`) VALUES
(4, 'start', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("start",$parameters);'),
(6, 'restart', 'DROP TABLE IF EXISTS `restart_task`; \nCREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart",$parameters);'),
(9, 'listandstart', 'DROP TABLE IF EXISTS `listandstart_task`; \nCREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("listandstart",$parameters);'),
(10, 'stop', 'DROP TABLE IF EXISTS `stop_task`; \nCREATE TABLE IF NOT EXISTS `stop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("stop",$parameters);'),
(11, 'drop', 'DROP TABLE IF EXISTS `drop_task`; \nCREATE TABLE IF NOT EXISTS `drop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n);\nadd_cron_task("drop",$parameters);'),
(12, 'create', 'DROP TABLE IF EXISTS `create_task`; \nCREATE TABLE IF NOT EXISTS `create_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n);\nadd_cron_task("create",$parameters);'),
(13, 'backup', 'DROP TABLE IF EXISTS `backup_task`; \nCREATE TABLE IF NOT EXISTS `backup_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("backup",$parameters);'),
(14, 'update', 'DROP TABLE IF EXISTS `update_task`; \nCREATE TABLE IF NOT EXISTS `update_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("update",$parameters);'),
(15, 'restore', 'DROP TABLE IF EXISTS `restore_task`; \nCREATE TABLE IF NOT EXISTS `restore_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("restore",$parameters);'),
(16, 'list', 'DROP TABLE IF EXISTS `list_task`; \nCREATE TABLE IF NOT EXISTS `list_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("list",$parameters);'),
(17, 'stopglassfish', 'DROP TABLE IF EXISTS `stopglassfish_task`; \nCREATE TABLE IF NOT EXISTS `stopglassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_asadmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\n);\nadd_cron_task("stopglassfish",$parameters);'),
(18, 'startglassfish', 'DROP TABLE IF EXISTS `startglassfish_task`; \nCREATE TABLE IF NOT EXISTS `startglassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_asadmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\n);\nadd_cron_task("startglassfish",$parameters);'),
(19, 'restartglassfish', 'DROP TABLE IF EXISTS `restartglassfish_task`; \nCREATE TABLE IF NOT EXISTS `restartglassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_asadmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\n);\nadd_cron_task("restartglassfish",$parameters);'),
(20, 'deploy', 'DROP TABLE IF EXISTS `deploy_task`; \nCREATE TABLE IF NOT EXISTS `deploy_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_asadmin` varchar(255) NOT NULL default '''',\n`GLUSERNAME` varchar(255) NOT NULL default '''',\n`PASSFILE` varchar(255) NOT NULL default '''',\n`APPFL_NM` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\n''GLUSERNAME''=>$rsnew["GLUSERNAME"],\n''PASSFILE''=>$rsnew["PASSFILE"],\n''APPFL_NM''=>$rsnew["APPFL_NM"],\n);\nadd_cron_task("deploy",$parameters);'),
(21, 'undeploy', 'DROP TABLE IF EXISTS `undeploy_task`; \nCREATE TABLE IF NOT EXISTS `undeploy_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_asadmin` varchar(255) NOT NULL default '''',\n`GLUSERNAME` varchar(255) NOT NULL default '''',\n`PASSFILE` varchar(255) NOT NULL default '''',\n`APPFL_NM` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\n''GLUSERNAME''=>$rsnew["GLUSERNAME"],\n''PASSFILE''=>$rsnew["PASSFILE"],\n''APPFL_NM''=>$rsnew["APPFL_NM"],\n);\nadd_cron_task("undeploy",$parameters);'),
(22, 'send', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_sendreceive` varchar(255) NOT NULL default '''',\n`TARGET_FILENAME` varchar(255) NOT NULL default '''',\n`LOCAL_PATH` varchar(255) NOT NULL default '''',\n`REMOTE_IPAND1STLVL` varchar(255) NOT NULL default '''',\n`REMOTE_REMAIN_PATH` varchar(255) NOT NULL default '''',\n`REMOTE_USERNAME` varchar(255) NOT NULL default '''',\n`REMOTE_PASSWORD` varchar(255) NOT NULL default '''',\n`REMOTE_DOMAIN` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_sendreceive''=>$rsnew["server_id_sendreceive"],\n''TARGET_FILENAME''=>$rsnew["TARGET_FILENAME"],\n''LOCAL_PATH''=>$rsnew["LOCAL_PATH"],\n''REMOTE_IPAND1STLVL''=>$rsnew["REMOTE_IPAND1STLVL"],\n''REMOTE_REMAIN_PATH''=>$rsnew["REMOTE_REMAIN_PATH"],\n''REMOTE_USERNAME''=>$rsnew["REMOTE_USERNAME"],\n''REMOTE_PASSWORD''=>$rsnew["REMOTE_PASSWORD"],\n''REMOTE_DOMAIN''=>$rsnew["REMOTE_DOMAIN"],\n);\nadd_cron_task("send",$parameters);'),
(23, 'receive', 'DROP TABLE IF EXISTS `receive_task`; \nCREATE TABLE IF NOT EXISTS `receive_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_sendreceive` varchar(255) NOT NULL default '''',\n`TARGET_FILENAME` varchar(255) NOT NULL default '''',\n`LOCAL_PATH` varchar(255) NOT NULL default '''',\n`REMOTE_IPAND1STLVL` varchar(255) NOT NULL default '''',\n`REMOTE_REMAIN_PATH` varchar(255) NOT NULL default '''',\n`REMOTE_USERNAME` varchar(255) NOT NULL default '''',\n`REMOTE_PASSWORD` varchar(255) NOT NULL default '''',\n`REMOTE_DOMAIN` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_sendreceive''=>$rsnew["server_id_sendreceive"],\n''TARGET_FILENAME''=>$rsnew["TARGET_FILENAME"],\n''LOCAL_PATH''=>$rsnew["LOCAL_PATH"],\n''REMOTE_IPAND1STLVL''=>$rsnew["REMOTE_IPAND1STLVL"],\n''REMOTE_REMAIN_PATH''=>$rsnew["REMOTE_REMAIN_PATH"],\n''REMOTE_USERNAME''=>$rsnew["REMOTE_USERNAME"],\n''REMOTE_PASSWORD''=>$rsnew["REMOTE_PASSWORD"],\n''REMOTE_DOMAIN''=>$rsnew["REMOTE_DOMAIN"],\n);\nadd_cron_task("receive",$parameters);'),
(24, 'installmysql', 'DROP TABLE IF EXISTS `installmysql_task`; \nCREATE TABLE IF NOT EXISTS `installmysql_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqlscript` varchar(255) NOT NULL default '''',\n`rootpass` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqlscript''=>$rsnew["server_id_mysqlscript"],\n''rootpass''=>$rsnew["rootpass"],\n);\nadd_cron_task("installmysql",$parameters);'),
(25, 'addpool', 'DROP TABLE IF EXISTS `addpool_task`; \nCREATE TABLE IF NOT EXISTS `addpool_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishadmin` varchar(255) NOT NULL default '''',\n`GLUSERNAME` varchar(255) NOT NULL default '''',\n`PASSFILE` varchar(255) NOT NULL default '''',\n`JDBCNAME` varchar(255) NOT NULL default '''',\n`DBS_JDBC` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishadmin''=>$rsnew["server_id_glassfishadmin"],\n''GLUSERNAME''=>$rsnew["GLUSERNAME"],\n''PASSFILE''=>$rsnew["PASSFILE"],\n''JDBCNAME''=>$rsnew["JDBCNAME"],\n''DBS_JDBC''=>$rsnew["DBS_JDBC"],\n);\nadd_cron_task("addpool",$parameters);'),
(26, 'deletepool', 'DROP TABLE IF EXISTS `deletepool_task`; \nCREATE TABLE IF NOT EXISTS `deletepool_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishadmin` varchar(255) NOT NULL default '''',\n`GLUSERNAME` varchar(255) NOT NULL default '''',\n`PASSFILE` varchar(255) NOT NULL default '''',\n`JDBCNAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishadmin''=>$rsnew["server_id_glassfishadmin"],\n''GLUSERNAME''=>$rsnew["GLUSERNAME"],\n''PASSFILE''=>$rsnew["PASSFILE"],\n''JDBCNAME''=>$rsnew["JDBCNAME"],\n);\nadd_cron_task("deletepool",$parameters);'),
(27, 'addresource', 'DROP TABLE IF EXISTS `addresource_task`; \nCREATE TABLE IF NOT EXISTS `addresource_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishadmin` varchar(255) NOT NULL default '''',\n`GLUSERNAME` varchar(255) NOT NULL default '''',\n`PASSFILE` varchar(255) NOT NULL default '''',\n`JDBCNAME` varchar(255) NOT NULL default '''',\n`DBS_JDBC` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishadmin''=>$rsnew["server_id_glassfishadmin"],\n''GLUSERNAME''=>$rsnew["GLUSERNAME"],\n''PASSFILE''=>$rsnew["PASSFILE"],\n''JDBCNAME''=>$rsnew["JDBCNAME"],\n''DBS_JDBC''=>$rsnew["DBS_JDBC"],\n);\nadd_cron_task("addresource",$parameters);'),
(28, 'deleteresource', 'DROP TABLE IF EXISTS `deleteresource_task`; \nCREATE TABLE IF NOT EXISTS `deleteresource_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishadmin` varchar(255) NOT NULL default '''',\n`GLUSERNAME` varchar(255) NOT NULL default '''',\n`PASSFILE` varchar(255) NOT NULL default '''',\n`JDBCNAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishadmin''=>$rsnew["server_id_glassfishadmin"],\n''GLUSERNAME''=>$rsnew["GLUSERNAME"],\n''PASSFILE''=>$rsnew["PASSFILE"],\n''JDBCNAME''=>$rsnew["JDBCNAME"],\n);\nadd_cron_task("deleteresource",$parameters);'),
(29, 'installworkbench', 'DROP TABLE IF EXISTS `installworkbench_task`; \nCREATE TABLE IF NOT EXISTS `installworkbench_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqlscript` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqlscript''=>$rsnew["server_id_mysqlscript"],\n);\nadd_cron_task("installworkbench",$parameters);'),
(30, 'configmysqlremote', 'DROP TABLE IF EXISTS `configmysqlremote_task`; \nCREATE TABLE IF NOT EXISTS `configmysqlremote_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqlscript` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqlscript''=>$rsnew["server_id_mysqlscript"],\n);\nadd_cron_task("configmysqlremote",$parameters);'),
(31, 'configmysqlvars', 'DROP TABLE IF EXISTS `configmysqlvars_task`; \nCREATE TABLE IF NOT EXISTS `configmysqlvars_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n);\nadd_cron_task("configmysqlvars",$parameters);'),
(32, 'installglassfish', 'DROP TABLE IF EXISTS `installglassfish_task`; \nCREATE TABLE IF NOT EXISTS `installglassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishscript` varchar(255) NOT NULL default '''',\n`glassfishfolder` varchar(255) NOT NULL default '''',\n`adminpassword` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishscript''=>$rsnew["server_id_glassfishscript"],\n''glassfishfolder''=>$rsnew["glassfishfolder"],\n''adminpassword''=>$rsnew["adminpassword"],\n);\nadd_cron_task("installglassfish",$parameters);'),
(33, 'tmpgs', 'DROP TABLE IF EXISTS `tmpgs_task`; \nCREATE TABLE IF NOT EXISTS `tmpgs_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishscript` varchar(255) NOT NULL default '''',\n`glassfishfolder` varchar(255) NOT NULL default '''',\n`domainname` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishscript''=>$rsnew["server_id_glassfishscript"],\n''glassfishfolder''=>$rsnew["glassfishfolder"],\n''domainname''=>$rsnew["domainname"],\n);\nadd_cron_task("tmpgs",$parameters);'),
(34, 'fabsprop', 'DROP TABLE IF EXISTS `fabsprop_task`; \nCREATE TABLE IF NOT EXISTS `fabsprop_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishscript` varchar(255) NOT NULL default '''',\n`glassfishfolder` varchar(255) NOT NULL default '''',\n`domainname` varchar(255) NOT NULL default '''',\n`contextname_value` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishscript''=>$rsnew["server_id_glassfishscript"],\n''glassfishfolder''=>$rsnew["glassfishfolder"],\n''domainname''=>$rsnew["domainname"],\n''contextname_value''=>$rsnew["contextname_value"],\n);\nadd_cron_task("fabsprop",$parameters);'),
(35, 'glassfishtuning', 'DROP TABLE IF EXISTS `glassfishtuning_task`; \nCREATE TABLE IF NOT EXISTS `glassfishtuning_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishscript` varchar(255) NOT NULL default '''',\n`glassfishfolder` varchar(255) NOT NULL default '''',\n`domainname` varchar(255) NOT NULL default '''',\n`JVMHEAPSIZE` varchar(255) NOT NULL default '''',\n`JVMHEAPSIZEXMN` varchar(255) NOT NULL default '''',\n`JVMPARALLELGCTHREADS` varchar(255) NOT NULL default '''',\n`MAXTHREADPOOLSIZE` varchar(255) NOT NULL default '''',\n`LargePageSizeInBytes` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishscript''=>$rsnew["server_id_glassfishscript"],\n''glassfishfolder''=>$rsnew["glassfishfolder"],\n''domainname''=>$rsnew["domainname"],\n''JVMHEAPSIZE''=>$rsnew["JVMHEAPSIZE"],\n''JVMHEAPSIZEXMN''=>$rsnew["JVMHEAPSIZEXMN"],\n''JVMPARALLELGCTHREADS''=>$rsnew["JVMPARALLELGCTHREADS"],\n''MAXTHREADPOOLSIZE''=>$rsnew["MAXTHREADPOOLSIZE"],\n''LargePageSizeInBytes''=>$rsnew["LargePageSizeInBytes"],\n);\nadd_cron_task("glassfishtuning",$parameters);'),
(36, 'editportalext', 'DROP TABLE IF EXISTS `editportalext_task`; \nCREATE TABLE IF NOT EXISTS `editportalext_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_glassfishscript` varchar(255) NOT NULL default '''',\n`glassfishfolder` varchar(255) NOT NULL default '''',\n`domainname` varchar(255) NOT NULL default '''',\n`liferaydbip` varchar(255) NOT NULL default '''',\n`liferaydbname` varchar(255) NOT NULL default '''',\n`liferaydbuser` varchar(255) NOT NULL default '''',\n`liferaydbpass` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_glassfishscript''=>$rsnew["server_id_glassfishscript"],\n''glassfishfolder''=>$rsnew["glassfishfolder"],\n''domainname''=>$rsnew["domainname"],\n''liferaydbip''=>$rsnew["liferaydbip"],\n''liferaydbname''=>$rsnew["liferaydbname"],\n''liferaydbuser''=>$rsnew["liferaydbuser"],\n''liferaydbpass''=>$rsnew["liferaydbpass"],\n);\nadd_cron_task("editportalext",$parameters);');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `task_function_group`
--

INSERT INTO `task_function_group` (`task_function_group_id`, `task_id`, `function_group_id`) VALUES
(4, 4, 3),
(7, 4, 3),
(8, 6, 3),
(6, 6, 4),
(10, 10, 6),
(11, 11, 7),
(12, 12, 8),
(13, 13, 9),
(14, 14, 10),
(15, 15, 11),
(16, 16, 12),
(17, 17, 13),
(18, 18, 14),
(19, 19, 15),
(20, 20, 16),
(21, 21, 17),
(22, 22, 18),
(23, 23, 19),
(24, 24, 20),
(25, 25, 21),
(26, 26, 22),
(27, 27, 23),
(28, 28, 24),
(29, 29, 25),
(30, 30, 26),
(31, 31, 27),
(32, 32, 28),
(33, 33, 29),
(34, 34, 30),
(35, 35, 31),
(36, 36, 32);

-- --------------------------------------------------------

--
-- Table structure for table `tmpgs_task`
--

CREATE TABLE IF NOT EXISTS `tmpgs_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_glassfishscript` varchar(255) NOT NULL DEFAULT '',
  `glassfishfolder` varchar(255) NOT NULL DEFAULT '',
  `domainname` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `undeploy_task`
--

CREATE TABLE IF NOT EXISTS `undeploy_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_asadmin` varchar(255) NOT NULL DEFAULT '',
  `GLUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSFILE` varchar(255) NOT NULL DEFAULT '',
  `APPFL_NM` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `update_task`
--

CREATE TABLE IF NOT EXISTS `update_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `DBUSERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `update_task`
--

INSERT INTO `update_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`, `HOSTNAME`, `DBUSERNAME`, `PASSWORD`, `DATABASE`, `FILEPATH`, `FILENAME`) VALUES
(1, 'Administrator', '2014-04-05 21:12:08', '3', '1.1.1.189', 'root', 'root', 'huma123', '2.jpg', '4.jpg');

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
-- Constraints for table `script_function_parameter_relation`
--
ALTER TABLE `script_function_parameter_relation`
  ADD CONSTRAINT `script_function_parameter_relation_ibfk_1` FOREIGN KEY (`parameter_id`) REFERENCES `parameter` (`parameter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `script_function_parameter_relation_ibfk_2` FOREIGN KEY (`script_function_id`) REFERENCES `script_function` (`script_function_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_function_group`
--
ALTER TABLE `task_function_group`
  ADD CONSTRAINT `task_function_group_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_function_group_ibfk_2` FOREIGN KEY (`function_group_id`) REFERENCES `function_group` (`function_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
