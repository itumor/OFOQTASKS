-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2014 at 09:18 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4266 ;

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
(4265, '2014-03-26 21:11:58', '/sys/taskedit.php', '-1', 'U', 'task', 'phpscript', '9', '$parameters = array(\n);\nadd_cron_task("listandstart",$parameters);', '$parameters = array(\r\n);\r\nadd_cron_task("listandstart",$parameters);');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

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
(23, NULL, 9, 3, 'mysqladmin.sh  start 1.1.1.189 root root ', 'start: Job is already running: mysql\n', 'executed', NULL, '2014-03-26 09:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `function_group`
--

CREATE TABLE IF NOT EXISTS `function_group` (
  `function_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`function_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `function_group`
--

INSERT INTO `function_group` (`function_group_id`, `function_group_name`) VALUES
(3, 'start'),
(4, 'restart'),
(5, 'list');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `function_group_relation`
--

INSERT INTO `function_group_relation` (`function_group_relation_id`, `function_group_id`, `script_function_id`, `priority`) VALUES
(4, 3, 6, 1),
(5, 4, 7, 1),
(6, 5, 8, 1),
(7, 5, 6, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `listandstart_task`
--

INSERT INTO `listandstart_task` (`id`, `server_id_mysqladmin`, `HOSTNAME`, `USERNAME`, `PASSWORD`) VALUES
(1, '3', '1.1.1.189', 'root', 'root');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`parameter_id`, `script_id`, `parameter_name`) VALUES
(8, 3, 'server_id_mysqladmin'),
(9, 3, 'HOSTNAME'),
(10, 3, 'USERNAME'),
(11, 3, 'PASSWORD');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `script`
--

INSERT INTO `script` (`script_id`, `script_name`, `script_path`, `start_range`, `end_range`) VALUES
(3, 'mysqladmin', 'mysqladmin.sh', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `script_function`
--

INSERT INTO `script_function` (`script_function_id`, `script_function_name`, `script_id`) VALUES
(6, 'start', 3),
(7, 'restart', 3),
(8, 'list', 3);

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
  `server_id_mysqladmin` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `start_task`
--

INSERT INTO `start_task` (`id`, `server_id_mysqladmin`) VALUES
(1, '3'),
(2, '3'),
(3, '3'),
(4, '3'),
(5, '3'),
(6, '3'),
(7, '3'),
(8, '3'),
(9, '3'),
(10, '3'),
(11, '3'),
(12, '3'),
(13, '3'),
(14, '3'),
(15, '3'),
(16, '3'),
(17, '3'),
(18, '3'),
(19, '3'),
(20, '3'),
(21, '3'),
(22, '3'),
(23, '3'),
(24, '3'),
(25, '3'),
(26, '3'),
(27, '3'),
(28, '3'),
(29, '3'),
(30, '3'),
(31, '3'),
(32, '3'),
(33, '3'),
(34, '3'),
(35, '3'),
(36, '3'),
(37, '3'),
(38, '3'),
(39, '3'),
(40, '3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `sqlscript`, `phpscript`) VALUES
(4, 'start', 'CREATE TABLE IF NOT EXISTS `start_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("start","$parameters");'),
(6, 'restart', 'CREATE TABLE IF NOT EXISTS `restart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n);\nadd_cron_task("restart",$parameters);'),
(7, 'add new t', 'CREATE TABLE IF NOT EXISTS `add_new_t_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n);\nadd_cron_task("add new t","$parameters");'),
(8, 'start1', 'CREATE TABLE IF NOT EXISTS `start1_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n);\nadd_cron_task("start1","$parameters");'),
(9, 'listandstart', 'CREATE TABLE IF NOT EXISTS `listandstart_task` (\n`id` int(11) unsigned NOT NULL auto_increment, \n`server_id_mysqladmin` varchar(255) NOT NULL default '''',\n`HOSTNAME` varchar(255) NOT NULL default '''',\n`USERNAME` varchar(255) NOT NULL default '''',\n`PASSWORD` varchar(255) NOT NULL default '''',\n\nPRIMARY KEY  (`id`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8', '$parameters = array(\n''server_id_mysqladmin''=>$rsnew["server_id_mysqladmin"],\n''HOSTNAME''=>$rsnew["HOSTNAME"],\n''USERNAME''=>$rsnew["USERNAME"],\n''PASSWORD''=>$rsnew["PASSWORD"],\n);\nadd_cron_task("listandstart",$parameters);');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `task_function_group`
--

INSERT INTO `task_function_group` (`task_function_group_id`, `task_id`, `function_group_id`) VALUES
(4, 4, 3),
(7, 4, 3),
(8, 6, 3),
(6, 6, 4),
(9, 9, 5);

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
