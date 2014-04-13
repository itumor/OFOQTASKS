-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2014 at 06:07 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4732 ;

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
(4582, '2014-04-05 21:36:25', '/sys/logout.php', 'login', 'logout', '::1', '', '', '', ''),
(4583, '2014-04-05 22:07:59', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4584, '2014-04-06 04:11:34', '/sys/login.php', 'admin', 'autologin', '::1', '', '', '', ''),
(4585, '2014-04-06 04:12:11', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4586, '2014-04-06 04:12:58', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '15', '', 'stop_glassfish'),
(4587, '2014-04-06 04:12:58', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '15', '', '4'),
(4588, '2014-04-06 04:12:58', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '15', '', '15'),
(4589, '2014-04-06 04:13:32', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '16', '', 'start_glassfish'),
(4590, '2014-04-06 04:13:32', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '16', '', '4'),
(4591, '2014-04-06 04:13:32', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '16', '', '16'),
(4592, '2014-04-06 04:13:47', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '17', '', 'restart_glassfish'),
(4593, '2014-04-06 04:13:47', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '17', '', '4'),
(4594, '2014-04-06 04:13:47', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '17', '', '17'),
(4595, '2014-04-06 04:14:45', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '13', '', 'start_glassfish'),
(4596, '2014-04-06 04:14:45', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '13', '', '13'),
(4597, '2014-04-06 04:15:10', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '14', '', 'stop_glassfish'),
(4598, '2014-04-06 04:15:10', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '14', '', '14'),
(4599, '2014-04-06 04:15:25', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '15', '', 'restart glassfish'),
(4600, '2014-04-06 04:15:25', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '15', '', '15'),
(4601, '2014-04-06 04:15:43', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '16', '', '13'),
(4602, '2014-04-06 04:15:43', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '16', '', '16'),
(4603, '2014-04-06 04:15:43', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '16', '', '1'),
(4604, '2014-04-06 04:15:43', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '16', '', '16'),
(4605, '2014-04-06 04:15:53', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '17', '', '14'),
(4606, '2014-04-06 04:15:53', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '17', '', '15'),
(4607, '2014-04-06 04:15:53', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '17', '', '1'),
(4608, '2014-04-06 04:15:53', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '17', '', '17'),
(4609, '2014-04-06 04:16:03', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '18', '', '15'),
(4610, '2014-04-06 04:16:03', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '18', '', '17'),
(4611, '2014-04-06 04:16:03', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '18', '', '1'),
(4612, '2014-04-06 04:16:03', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '18', '', '18'),
(4613, '2014-04-06 04:16:32', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '17', '', 'restart glassfish'),
(4614, '2014-04-06 04:16:32', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '17', '', 'restart glassfish'),
(4615, '2014-04-06 04:16:32', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '17', '', 'restart glassfish'),
(4616, '2014-04-06 04:16:32', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '17', '', '17'),
(4617, '2014-04-06 04:16:45', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '18', '', 'start glassfish'),
(4618, '2014-04-06 04:16:45', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '18', '', 'start glassfish'),
(4619, '2014-04-06 04:16:45', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '18', '', 'start glassfish'),
(4620, '2014-04-06 04:16:45', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '18', '', '18'),
(4621, '2014-04-06 04:16:59', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '19', '', 'stop glassfish'),
(4622, '2014-04-06 04:16:59', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '19', '', 'stop glassfish'),
(4623, '2014-04-06 04:16:59', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '19', '', 'stop glassfish'),
(4624, '2014-04-06 04:16:59', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '19', '', '19'),
(4625, '2014-04-06 04:17:27', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '17', '', '17'),
(4626, '2014-04-06 04:17:27', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '17', '', '15'),
(4627, '2014-04-06 04:17:27', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '17', '', '17'),
(4628, '2014-04-06 04:17:37', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '18', '', '18'),
(4629, '2014-04-06 04:17:37', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '18', '', '13'),
(4630, '2014-04-06 04:17:37', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '18', '', '18'),
(4631, '2014-04-06 04:17:45', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '19', '', '19'),
(4632, '2014-04-06 04:17:45', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '19', '', '14'),
(4633, '2014-04-06 04:17:45', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '19', '', '19'),
(4634, '2014-04-06 04:18:02', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '17', 'DROP TABLE IF EXISTS `restart_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `restart_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_glassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_glassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4635, '2014-04-06 04:18:02', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '17', '$parameters = array(\n);\nadd_cron_task("restart glassfish",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("restart glassfish",$parameters);'),
(4636, '2014-04-06 04:18:09', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '18', 'DROP TABLE IF EXISTS `start_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `start_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_glassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `start_glassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4637, '2014-04-06 04:18:09', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '18', '$parameters = array(\n);\nadd_cron_task("start glassfish",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("start glassfish",$parameters);'),
(4638, '2014-04-06 04:18:14', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '19', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4639, '2014-04-06 04:18:14', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '19', '$parameters = array(\n);\nadd_cron_task("stop glassfish",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("stop glassfish",$parameters);'),
(4640, '2014-04-06 04:26:58', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'script_id', '15', '', '4'),
(4641, '2014-04-06 04:26:58', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_name', '15', '', 'server_id_mysqladmin'),
(4642, '2014-04-06 04:26:58', '/sys/parameteradd.php', '-1', 'A', 'parameter', 'parameter_id', '15', '', '15'),
(4643, '2014-04-06 04:30:55', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '17', 'DROP TABLE IF EXISTS `restart_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `restart_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `restart_glassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `restart_glassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4644, '2014-04-06 04:30:55', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '17', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart glassfish",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("restart glassfish",$parameters);'),
(4645, '2014-04-06 04:31:00', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '18', 'DROP TABLE IF EXISTS `start_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `start_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `start_glassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `start_glassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4646, '2014-04-06 04:31:00', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '18', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("start glassfish",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("start glassfish",$parameters);'),
(4647, '2014-04-06 04:31:13', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '19', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4648, '2014-04-06 04:31:13', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '19', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("stop glassfish",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("stop glassfish",$parameters);'),
(4649, '2014-04-06 04:32:19', '/sys/taskedit.php', '-1', 'U', 'task', 'task_name', '19', 'stop glassfish', 'stop'),
(4650, '2014-04-06 04:32:19', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '19', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4651, '2014-04-06 04:32:19', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '19', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("stop glassfish",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("stop glassfish",$parameters);'),
(4652, '2014-04-06 04:32:43', '/sys/tasklist.php', '-1', 'U', 'task', 'task_name', '19', 'stop', 'stop glassfish'),
(4653, '2014-04-07 15:24:04', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4654, '2014-04-07 15:33:31', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '20', '', 'ws'),
(4655, '2014-04-07 15:33:31', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '20', '', '1'),
(4656, '2014-04-07 15:33:31', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '20', '', '1'),
(4657, '2014-04-07 15:33:31', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '20', '', '20'),
(4658, '2014-04-07 15:33:57', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '20', '', '20'),
(4659, '2014-04-07 15:33:57', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '20', '', '3'),
(4660, '2014-04-07 15:33:57', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '20', '', '20'),
(4661, '2014-04-07 16:34:13', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(4662, '2014-04-07 16:34:19', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4663, '2014-04-07 17:24:26', '/sys/login.php', 'admin', 'autologin', '::1', '', '', '', ''),
(4664, '2014-04-08 05:29:24', '/sys/login.php', 'admin', 'autologin', '::1', '', '', '', ''),
(4665, '2014-04-08 05:34:03', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_name', '6', '', 'sendreceive'),
(4666, '2014-04-08 05:34:03', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_path', '6', '', 'sendreceive.sh'),
(4667, '2014-04-08 05:34:03', '/sys/scriptadd.php', '-1', 'A', 'script', 'start_range', '6', '', '1'),
(4668, '2014-04-08 05:34:03', '/sys/scriptadd.php', '-1', 'A', 'script', 'end_range', '6', '', '1'),
(4669, '2014-04-08 05:34:03', '/sys/scriptadd.php', '-1', 'A', 'script', 'script_id', '6', '', '6'),
(4670, '2014-04-08 05:34:34', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '18', '', 'send'),
(4671, '2014-04-08 05:34:34', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '18', '', '6'),
(4672, '2014-04-08 05:34:34', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '18', '', '18'),
(4673, '2014-04-08 05:34:45', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_name', '19', '', 'receive'),
(4674, '2014-04-08 05:34:45', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_id', '19', '', '6'),
(4675, '2014-04-08 05:34:45', '/sys/script_functionadd.php', '-1', 'A', 'script_function', 'script_function_id', '19', '', '19'),
(4676, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', '*** Batch insert begin ***', 'parameter', '', '', '', ''),
(4677, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '16', '', '6'),
(4678, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '16', '', 'server_id_mysqladmin'),
(4679, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '16', '', '16'),
(4680, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '17', '', '6'),
(4681, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '17', '', 'TARGET_FILENAME'),
(4682, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '17', '', '17'),
(4683, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '18', '', '6'),
(4684, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '18', '', 'LOCAL_PATH'),
(4685, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '18', '', '18'),
(4686, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '19', '', '6'),
(4687, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '19', '', 'REMOTE_IPAND1STLVL'),
(4688, '2014-04-08 05:37:51', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '19', '', '19'),
(4689, '2014-04-08 05:37:52', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '20', '', '6'),
(4690, '2014-04-08 05:37:52', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '20', '', 'REMOTE_REMAIN_PATH'),
(4691, '2014-04-08 05:37:52', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '20', '', '20'),
(4692, '2014-04-08 05:37:52', '/sys/parameterlist.php', '-1', '*** Batch insert successful ***', 'parameter', '', '', '', ''),
(4693, '2014-04-08 05:38:38', '/sys/parameterlist.php', '-1', '*** Batch insert begin ***', 'parameter', '', '', '', ''),
(4694, '2014-04-08 05:38:38', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '21', '', '6'),
(4695, '2014-04-08 05:38:38', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '21', '', 'REMOTE_USERNAME'),
(4696, '2014-04-08 05:38:38', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '21', '', '21'),
(4697, '2014-04-08 05:38:38', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '22', '', '6'),
(4698, '2014-04-08 05:38:38', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '22', '', 'REMOTE_PASSWORD'),
(4699, '2014-04-08 05:38:38', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '22', '', '22'),
(4700, '2014-04-08 05:38:39', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'script_id', '23', '', '6'),
(4701, '2014-04-08 05:38:39', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_name', '23', '', 'REMOTE_DOMAIN'),
(4702, '2014-04-08 05:38:39', '/sys/parameterlist.php', '-1', 'A', 'parameter', 'parameter_id', '23', '', '23'),
(4703, '2014-04-08 05:38:39', '/sys/parameterlist.php', '-1', '*** Batch insert successful ***', 'parameter', '', '', '', ''),
(4704, '2014-04-08 05:42:28', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_name', '16', '', 'send'),
(4705, '2014-04-08 05:42:28', '/sys/function_groupadd.php', '-1', 'A', 'function_group', 'function_group_id', '16', '', '16'),
(4706, '2014-04-08 05:42:41', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_id', '19', '', '16'),
(4707, '2014-04-08 05:42:41', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'script_function_id', '19', '', '18'),
(4708, '2014-04-08 05:42:41', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'priority', '19', '', '1'),
(4709, '2014-04-08 05:42:41', '/sys/function_group_relationadd.php', '-1', 'A', 'function_group_relation', 'function_group_relation_id', '19', '', '19'),
(4710, '2014-04-08 05:43:31', '/sys/taskadd.php', '-1', 'A', 'task', 'task_name', '21', '', 'send'),
(4711, '2014-04-08 05:43:31', '/sys/taskadd.php', '-1', 'A', 'task', 'sqlscript', '21', '', 'asa'),
(4712, '2014-04-08 05:43:31', '/sys/taskadd.php', '-1', 'A', 'task', 'phpscript', '21', '', 'as'),
(4713, '2014-04-08 05:43:31', '/sys/taskadd.php', '-1', 'A', 'task', 'task_id', '21', '', '21'),
(4714, '2014-04-08 05:43:46', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_id', '21', '', '21'),
(4715, '2014-04-08 05:43:46', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'function_group_id', '21', '', '16'),
(4716, '2014-04-08 05:43:46', '/sys/task_function_groupadd.php', '-1', 'A', 'task_function_group', 'task_function_group_id', '21', '', '21'),
(4717, '2014-04-08 05:44:01', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '21', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `send_task`; \r\nCREATE TABLE IF NOT EXISTS `send_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4718, '2014-04-08 05:44:01', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '21', '$parameters = array(\n);\nadd_cron_task("send",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("send",$parameters);'),
(4719, '2014-04-08 10:21:52', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4720, '2014-04-08 12:02:23', '/sys/login.php', 'admin', 'autologin', '::1', '', '', '', ''),
(4721, '2014-04-08 12:02:23', '/sys/login.php', 'admin', 'autologin', '::1', '', '', '', ''),
(4722, '2014-04-08 12:02:23', '/sys/login.php', 'admin', 'autologin', '::1', '', '', '', ''),
(4723, '2014-04-13 10:48:52', '/sys/login.php', 'admin', 'autologin', '::1', '', '', '', ''),
(4724, '2014-04-13 10:49:53', '/sys/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(4725, '2014-04-13 16:31:22', '/sys/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4726, '2014-04-13 16:43:06', '/sys/parameteredit.php', '-1', 'U', 'parameter', 'parameter_name', '15', 'server_id_mysqladmin', 'server_id_asadmin');
INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(4727, '2014-04-13 16:43:52', '/sys/tasklist.php', '-1', 'U', 'task', 'sqlscript', '19', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \r\nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4728, '2014-04-13 16:43:52', '/sys/tasklist.php', '-1', 'U', 'task', 'phpscript', '19', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("stop glassfish",$parameters);', '$parameters = array(\r\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\r\n);\r\nadd_cron_task("stop glassfish",$parameters);'),
(4729, '2014-04-13 16:55:04', '/sys/parameteredit.php', '-1', 'U', 'parameter', 'parameter_name', '16', 'server_id_mysqladmin', 'server_id_sendreceive'),
(4730, '2014-04-13 16:59:08', '/sys/taskedit.php', '-1', 'U', 'task', 'sqlscript', '21', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_sendreceive` varchar(255) NOT NULL default '''',\n`TARGET_FILENAME` varchar(255) NOT NULL default '''',\n`LOCAL_PATH` varchar(255) NOT NULL default '''',\n`REMOTE_IPAND1STLVL` varchar(255) NOT NULL default '''',\n`REMOTE_REMAIN_PATH` varchar(255) NOT NULL default '''',\n`REMOTE_USERNAME` varchar(255) NOT NULL default '''',\n`REMOTE_PASSWORD` varchar(255) NOT NULL default '''',\n`REMOTE_DOMAIN` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'DROP TABLE IF EXISTS `send_task`; \r\nCREATE TABLE IF NOT EXISTS `send_task` (\r\n`id` int(11) unsigned NOT NULL auto_increment,\r\n\r\n`username` varchar(255) NOT NULL default '''',\r\n\r\n`datetime` DATETIME NOT NULL, \r\n`server_id_sendreceive` varchar(255) NOT NULL default '''',\r\n`TARGET_FILENAME` varchar(255) NOT NULL default '''',\r\n`LOCAL_PATH` varchar(255) NOT NULL default '''',\r\n`REMOTE_IPAND1STLVL` varchar(255) NOT NULL default '''',\r\n`REMOTE_REMAIN_PATH` varchar(255) NOT NULL default '''',\r\n`REMOTE_USERNAME` varchar(255) NOT NULL default '''',\r\n`REMOTE_PASSWORD` varchar(255) NOT NULL default '''',\r\n`REMOTE_DOMAIN` varchar(255) NOT NULL default '''',\r\n\r\nPRIMARY KEY  (`id`)\r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8'),
(4731, '2014-04-13 16:59:08', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '21', '$parameters = array(\n''server_id_sendreceive''=>$rsnew["server_id_sendreceive"],\n''TARGET_FILENAME''=>$rsnew["TARGET_FILENAME"],\n''LOCAL_PATH''=>$rsnew["LOCAL_PATH"],\n''REMOTE_IPAND1STLVL''=>$rsnew["REMOTE_IPAND1STLVL"],\n''REMOTE_REMAIN_PATH''=>$rsnew["REMOTE_REMAIN_PATH"],\n''REMOTE_USERNAME''=>$rsnew["REMOTE_USERNAME"],\n''REMOTE_PASSWORD''=>$rsnew["REMOTE_PASSWORD"],\n''REMOTE_DOMAIN''=>$rsnew["REMOTE_DOMAIN"],\n);\nadd_cron_task("send",$parameters);', '$parameters = array(\r\n''server_id_sendreceive''=>$rsnew["server_id_sendreceive"],\r\n''TARGET_FILENAME''=>$rsnew["TARGET_FILENAME"],\r\n''LOCAL_PATH''=>$rsnew["LOCAL_PATH"],\r\n''REMOTE_IPAND1STLVL''=>$rsnew["REMOTE_IPAND1STLVL"],\r\n''REMOTE_REMAIN_PATH''=>$rsnew["REMOTE_REMAIN_PATH"],\r\n''REMOTE_USERNAME''=>$rsnew["REMOTE_USERNAME"],\r\n''REMOTE_PASSWORD''=>$rsnew["REMOTE_PASSWORD"],\r\n''REMOTE_DOMAIN''=>$rsnew["REMOTE_DOMAIN"],\r\n);\r\nadd_cron_task("send",$parameters);');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

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
(82, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-07 03:40:07'),
(83, NULL, 4, 3, 'mysqladmin.sh  "start" "" "" "" "" "" "" ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-04-07 03:40:07'),
(84, NULL, 19, NULL, 'asadmin.sh  "stop_glassfish" ', 'ssh login Failed', 'failed', NULL, '2014-04-13 04:48:34'),
(85, NULL, 19, 3, 'asadmin.sh  "stop_glassfish" ', 'bash: ./asadmin.sh: No such file or directory\n', 'executed', NULL, '2014-04-13 04:51:13'),
(86, NULL, 21, NULL, 'sendreceive.sh  "send" "" "1" "1" "1" "1" "1" "1" ', 'ssh login Failed', 'failed', NULL, '2014-04-13 04:57:44'),
(87, NULL, 21, NULL, 'sendreceive.sh  "send" "" "2" "3" "4" "5" "6" "7" ', 'ssh login Failed', 'failed', NULL, '2014-04-13 04:58:27'),
(88, NULL, 21, 3, 'sendreceive.sh  "send" "1" "2" "3" "4" "5" "6" "7" ', 'bash: ./sendreceive.sh: No such file or directory\n', 'executed', NULL, '2014-04-13 05:01:23'),
(89, NULL, 12, 3, 'mysqladmin.sh  "create" "" "" "" "" "" "" ', 'ERROR 1045 (28000): Access denied for user ''root''@''localhost'' (using password: NO)\n', 'executed', NULL, '2014-04-13 05:31:34'),
(90, NULL, 13, 3, 'mysqladmin.sh  "backup" "1.1.1.189" "aa" "aa" "aa" "aa" "aa" ', './mysqladmin.sh: line 39: aa/aa: No such file or directory\n', 'executed', NULL, '2014-04-13 05:42:41');

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
-- Table structure for table `function_group`
--

CREATE TABLE IF NOT EXISTS `function_group` (
  `function_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`function_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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
(13, 'start_glassfish'),
(14, 'stop_glassfish'),
(15, 'restart glassfish'),
(16, 'send');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

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
(16, 13, 16, 1),
(17, 14, 15, 1),
(18, 15, 17, 1),
(19, 16, 18, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

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
(16, 6, 'server_id_sendreceive'),
(17, 6, 'TARGET_FILENAME'),
(18, 6, 'LOCAL_PATH'),
(19, 6, 'REMOTE_IPAND1STLVL'),
(20, 6, 'REMOTE_REMAIN_PATH'),
(21, 6, 'REMOTE_USERNAME'),
(22, 6, 'REMOTE_PASSWORD'),
(23, 6, 'REMOTE_DOMAIN');

-- --------------------------------------------------------

--
-- Table structure for table `restart_glassfish_task`
--

CREATE TABLE IF NOT EXISTS `restart_glassfish_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `restart_glassfish_task`
--

INSERT INTO `restart_glassfish_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`) VALUES
(1, 'Administrator', '2014-04-06 04:25:10', '3'),
(2, 'Administrator', '2014-04-06 04:27:24', '3'),
(3, 'Administrator', '2014-04-06 04:30:09', '3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `script`
--

INSERT INTO `script` (`script_id`, `script_name`, `script_path`, `start_range`, `end_range`) VALUES
(3, 'mysqladmin', 'mysqladmin.sh', 0, 0),
(4, 'asadmin', 'asadmin.sh', 1, 1),
(5, 'glassfishadmin', 'glassfishadmin.sh', 1, 1),
(6, 'sendreceive', 'sendreceive.sh', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

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
(15, 'stop_glassfish', 4),
(16, 'start_glassfish', 4),
(17, 'restart_glassfish', 4),
(18, 'send', 6),
(19, 'receive', 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

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
(51, 16, 18),
(56, 17, 18),
(57, 18, 18),
(58, 19, 18),
(59, 20, 18),
(60, 21, 18),
(61, 22, 18),
(62, 23, 18);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `send_task`
--

INSERT INTO `send_task` (`id`, `username`, `datetime`, `server_id_sendreceive`, `TARGET_FILENAME`, `LOCAL_PATH`, `REMOTE_IPAND1STLVL`, `REMOTE_REMAIN_PATH`, `REMOTE_USERNAME`, `REMOTE_PASSWORD`, `REMOTE_DOMAIN`) VALUES
(1, 'Administrator', '2014-04-13 17:01:22', '3', '1', '2', '3', '4', '5', '6', '7');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`server_id`, `server_name`, `server_hostname`, `server_username`, `server_password`, `server_auth_type`, `server_os`, `server_file`, `server_deleted`) VALUES
(3, 'mysql189', '1.1.1.189', 'root', 'root', 'password', 'ubuntu', 'mysqladmin(1).sh', 0),
(4, 'mysql141', '1.1.1.141', 'root', 'root', 'password', 'ubuntu', 'mysqladmin(1).sh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `start_glassfish_task`
--

CREATE TABLE IF NOT EXISTS `start_glassfish_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `start_glassfish_task`
--

INSERT INTO `start_glassfish_task` (`id`, `username`, `datetime`, `server_id_mysqladmin`) VALUES
(1, 'Administrator', '2014-04-06 04:25:03', '3'),
(2, 'Administrator', '2014-04-06 04:27:16', '3'),
(3, 'Administrator', '2014-04-06 04:30:02', '3'),
(4, 'Administrator', '2014-04-13 10:49:25', '3');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
(7, 'Administrator', '2014-04-07 15:40:07', '3');

-- --------------------------------------------------------

--
-- Table structure for table `stop_glassfish_task`
--

CREATE TABLE IF NOT EXISTS `stop_glassfish_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  `server_id_asadmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stop_glassfish_task`
--

INSERT INTO `stop_glassfish_task` (`id`, `username`, `datetime`, `server_id_asadmin`) VALUES
(1, 'Administrator', '2014-04-13 16:48:33', '3'),
(2, 'Administrator', '2014-04-13 16:51:13', '3');

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
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  `sqlscript` text NOT NULL,
  `phpscript` text NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

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
(17, 'restart glassfish', 'DROP TABLE IF EXISTS `restart_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `restart_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart glassfish",$parameters);'),
(18, 'start glassfish', 'DROP TABLE IF EXISTS `start_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `start_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("start glassfish",$parameters);'),
(19, 'stop glassfish', 'DROP TABLE IF EXISTS `stop_glassfish_task`; \nCREATE TABLE IF NOT EXISTS `stop_glassfish_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_asadmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_asadmin''=>$rsnew["server_id_asadmin"],\n);\nadd_cron_task("stop glassfish",$parameters);'),
(20, 'ws', 'DROP TABLE IF EXISTS `ws_task`; \nCREATE TABLE IF NOT EXISTS `ws_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n);\nadd_cron_task("ws",$parameters);'),
(21, 'send', 'DROP TABLE IF EXISTS `send_task`; \nCREATE TABLE IF NOT EXISTS `send_task` (\n`id` int(11) unsigned NOT NULL auto_increment,\n\n`username` varchar(255) NOT NULL default '''',\n\n`datetime` DATETIME NOT NULL, \n`server_id_sendreceive` varchar(255) NOT NULL default '''',\n`TARGET_FILENAME` varchar(255) NOT NULL default '''',\n`LOCAL_PATH` varchar(255) NOT NULL default '''',\n`REMOTE_IPAND1STLVL` varchar(255) NOT NULL default '''',\n`REMOTE_REMAIN_PATH` varchar(255) NOT NULL default '''',\n`REMOTE_USERNAME` varchar(255) NOT NULL default '''',\n`REMOTE_PASSWORD` varchar(255) NOT NULL default '''',\n`REMOTE_DOMAIN` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_sendreceive''=>$rsnew["server_id_sendreceive"],\n''TARGET_FILENAME''=>$rsnew["TARGET_FILENAME"],\n''LOCAL_PATH''=>$rsnew["LOCAL_PATH"],\n''REMOTE_IPAND1STLVL''=>$rsnew["REMOTE_IPAND1STLVL"],\n''REMOTE_REMAIN_PATH''=>$rsnew["REMOTE_REMAIN_PATH"],\n''REMOTE_USERNAME''=>$rsnew["REMOTE_USERNAME"],\n''REMOTE_PASSWORD''=>$rsnew["REMOTE_PASSWORD"],\n''REMOTE_DOMAIN''=>$rsnew["REMOTE_DOMAIN"],\n);\nadd_cron_task("send",$parameters);');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

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
(17, 17, 15),
(18, 18, 13),
(19, 19, 14),
(20, 20, 3),
(21, 21, 16);

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
