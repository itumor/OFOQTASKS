-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2014 at 01:04 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4436 ;

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
(4435, '2014-04-03 10:11:45', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_id', '5', '', '5');

-- --------------------------------------------------------

--
-- Table structure for table `backup_task`
--

CREATE TABLE IF NOT EXISTS `backup_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `USERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `backup_task`
--

INSERT INTO `backup_task` (`id`, `server_id_mysqladmin`, `HOSTNAME`, `USERNAME`, `PASSWORD`, `DATABASE`, `FILEPATH`, `FILENAME`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

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
(39, NULL, 4, 3, 'mysqladmin.sh  start       ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-30 09:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `create_task`
--

CREATE TABLE IF NOT EXISTS `create_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `USERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `drop_task`
--

CREATE TABLE IF NOT EXISTS `drop_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `USERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `function_group`
--

INSERT INTO `function_group` (`function_group_id`, `function_group_name`) VALUES
(3, 'start'),
(4, 'restart'),
(5, 'list'),
(6, 'stop'),
(7, 'drop'),
(8, 'create'),
(9, 'backup'),
(10, 'update'),
(11, 'restore');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `function_group_relation`
--

INSERT INTO `function_group_relation` (`function_group_relation_id`, `function_group_id`, `script_function_id`, `priority`) VALUES
(4, 3, 6, 1),
(5, 4, 7, 1),
(6, 5, 8, 1),
(7, 5, 6, 2),
(9, 6, 9, 1),
(10, 7, 10, 1),
(11, 8, 11, 1),
(12, 9, 12, 1),
(13, 10, 13, 1),
(14, 11, 14, 1);

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
-- Table structure for table `listandstart_task`
--

CREATE TABLE IF NOT EXISTS `listandstart_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `USERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `listandstart_task`
--

INSERT INTO `listandstart_task` (`id`, `server_id_mysqladmin`, `HOSTNAME`, `USERNAME`, `PASSWORD`) VALUES
(1, '3', '1.1.1.189', 'root', 'root'),
(2, '3', '1.1.1.189', 'root', 'root'),
(3, '3', '1.1.1.189', 'root', 'root'),
(4, '3', '1.1.1.189', 'root', 'root'),
(5, '3', '1.1.1.189', 'root', 'root');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

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
(14, 3, 'FILENAME');

-- --------------------------------------------------------

--
-- Table structure for table `restart_task`
--

CREATE TABLE IF NOT EXISTS `restart_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `restart_task`
--

INSERT INTO `restart_task` (`id`, `server_id_mysqladmin`) VALUES
(1, '3'),
(2, '3'),
(3, '3'),
(4, '3'),
(5, '3'),
(6, '3'),
(7, '3'),
(8, '3');

-- --------------------------------------------------------

--
-- Table structure for table `restore_task`
--

CREATE TABLE IF NOT EXISTS `restore_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `USERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `script`
--

INSERT INTO `script` (`script_id`, `script_name`, `script_path`, `start_range`, `end_range`) VALUES
(3, 'mysqladmin', 'mysqladmin.sh', 0, 0),
(4, 'asadmin', 'asadmin.sh', 1, 1),
(5, 'glassfishadmin', 'glassfishadmin.sh', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

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
(14, 'restore', 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`server_id`, `server_name`, `server_hostname`, `server_username`, `server_password`, `server_auth_type`, `server_os`, `server_file`, `server_deleted`) VALUES
(3, 'mysql189', '1.1.1.189', 'root', 'root', 'password', 'ubuntu', 'mysqladmin(1).sh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `start_task`
--

CREATE TABLE IF NOT EXISTS `start_task` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stop_task`
--

CREATE TABLE IF NOT EXISTS `stop_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `USERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `sqlscript`, `phpscript`) VALUES
(4, 'start', 'DROP TABLE IF EXISTS `start_task`; \nCREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`DBUSERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''DBUSERNAME''=>$rsnew["DBUSERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("start",$parameters);'),
(6, 'restart', 'CREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("restart",$parameters);'),
(9, 'listandstart', 'CREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("listandstart",$parameters);'),
(10, 'stop', 'CREATE TABLE IF NOT EXISTS `stop_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("stop",$parameters);'),
(11, 'drop', 'CREATE TABLE IF NOT EXISTS `drop_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("drop",$parameters);'),
(12, 'create', 'CREATE TABLE IF NOT EXISTS `create_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("create",$parameters);'),
(13, 'backup', 'CREATE TABLE IF NOT EXISTS `backup_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("backup",$parameters);'),
(14, 'update', 'CREATE TABLE IF NOT EXISTS `update_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("update",$parameters);'),
(15, 'restore', 'CREATE TABLE IF NOT EXISTS `restore_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n`DATABASE` varchar(255) NOT NULL default '''',\n`FILEPATH` varchar(255) NOT NULL default '''',\n`FILENAME` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n''DATABASE''=>$rsnew["DATABASE"],\n''FILEPATH''=>$rsnew["FILEPATH"],\n''FILENAME''=>$rsnew["FILENAME"],\n);\nadd_cron_task("restore",$parameters);');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `task_function_group`
--

INSERT INTO `task_function_group` (`task_function_group_id`, `task_id`, `function_group_id`) VALUES
(4, 4, 3),
(7, 4, 3),
(8, 6, 3),
(6, 6, 4),
(9, 9, 5),
(10, 10, 6),
(11, 11, 7),
(12, 12, 8),
(13, 13, 9),
(14, 14, 10),
(15, 15, 11);

-- --------------------------------------------------------

--
-- Table structure for table `update_task`
--

CREATE TABLE IF NOT EXISTS `update_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  `HOSTNAME` varchar(255) NOT NULL DEFAULT '',
  `USERNAME` varchar(255) NOT NULL DEFAULT '',
  `PASSWORD` varchar(255) NOT NULL DEFAULT '',
  `DATABASE` varchar(255) NOT NULL DEFAULT '',
  `FILEPATH` varchar(255) NOT NULL DEFAULT '',
  `FILENAME` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
