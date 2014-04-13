<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "userfn10.php" ?>
<?php
	ew_Header(TRUE);
	$conn = ew_Connect();
	$Language = new cLanguage();

	// Security
	$Security = new cAdvancedSecurity();
	if (!$Security->IsLoggedIn()) $Security->AutoLogin();
	$Security->LoadUserLevel(); // Load User Level
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $Language->Phrase("MobileMenu") ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo ew_jQueryFile("jquery.mobile-%v.min.css") ?>">
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<link rel="stylesheet" type="text/css" href="phpcss/ewmobile.css">
<script type="text/javascript" src="<?php echo ew_jQueryFile("jquery-%v.min.js") ?>"></script>
<script type="text/javascript">

	//$(document).bind("mobileinit", function() {
	//	jQuery.mobile.ajaxEnabled = false;
	//	jQuery.mobile.ignoreContentEnabled = true;
	//});

</script>
<script type="text/javascript" src="<?php echo ew_jQueryFile("jquery.mobile-%v.min.js") ?>"></script>
<meta name="generator" content="PHPMaker v10.0.1">
</head>
<body>
<div data-role="page">
	<div data-role="header">
		<h1><?php echo $Language->ProjectPhrase("BodyTitle") ?></h1>
	</div>
	<div data-role="content">
<?php $RootMenu = new cMenu("RootMenu", TRUE); ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(79, $Language->MenuPhrase("79", "MenuText"), "send_tasklist.php", -1, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}send_task'), FALSE);
$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(41, $Language->MenuPhrase("41", "MenuText"), "start_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}start_task'), FALSE);
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "serverlist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}server'), FALSE);
$RootMenu->AddMenuItem(65, $Language->MenuPhrase("65", "MenuText"), "http://localhost/sys/ofoq_tasks/do_cron.php", 15, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(73, $Language->MenuPhrase("73", "MenuText"), "update_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}update_task'), FALSE);
$RootMenu->AddMenuItem(72, $Language->MenuPhrase("72", "MenuText"), "stop_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}stop_task'), FALSE);
$RootMenu->AddMenuItem(71, $Language->MenuPhrase("71", "MenuText"), "restore_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}restore_task'), FALSE);
$RootMenu->AddMenuItem(70, $Language->MenuPhrase("70", "MenuText"), "drop_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}drop_task'), FALSE);
$RootMenu->AddMenuItem(69, $Language->MenuPhrase("69", "MenuText"), "create_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}create_task'), FALSE);
$RootMenu->AddMenuItem(68, $Language->MenuPhrase("68", "MenuText"), "backup_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}backup_task'), FALSE);
$RootMenu->AddMenuItem(66, $Language->MenuPhrase("66", "MenuText"), "restart_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}restart_task'), FALSE);
$RootMenu->AddMenuItem(67, $Language->MenuPhrase("67", "MenuText"), "listandstart_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}listandstart_task'), FALSE);
$RootMenu->AddMenuItem(75, $Language->MenuPhrase("75", "MenuText"), "list_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}list_task'), FALSE);
$RootMenu->AddMenuItem(78, $Language->MenuPhrase("78", "MenuText"), "stop_glassfish_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}stop_glassfish_task'), FALSE);
$RootMenu->AddMenuItem(77, $Language->MenuPhrase("77", "MenuText"), "start_glassfish_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}start_glassfish_task'), FALSE);
$RootMenu->AddMenuItem(76, $Language->MenuPhrase("76", "MenuText"), "restart_glassfish_tasklist.php", 15, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}restart_glassfish_task'), FALSE);
$RootMenu->AddMenuItem(37, $Language->MenuPhrase("37", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(18, $Language->MenuPhrase("18", "MenuText"), "generator_reportlist.php", 37, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}generator report'), FALSE);
$RootMenu->AddMenuItem(19, $Language->MenuPhrase("19", "MenuText"), "Report_Grouping_by_Taskreport.php", 37, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}Report Grouping by Task'), FALSE);
$RootMenu->AddMenuItem(38, $Language->MenuPhrase("38", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(17, $Language->MenuPhrase("17", "MenuText"), "_loginlist.php", 38, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}login'), FALSE);
$RootMenu->AddMenuItem(40, $Language->MenuPhrase("40", "MenuText"), "userlevelslist.php", 38, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE);
$RootMenu->AddMenuItem(39, $Language->MenuPhrase("39", "MenuText"), "userlevelpermissionslist.php", 38, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE);
$RootMenu->AddMenuItem(16, $Language->MenuPhrase("16", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(11, $Language->MenuPhrase("11", "MenuText"), "", 16, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "scriptlist.php", 11, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}script'), FALSE);
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "script_functionlist.php", 11, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}script_function'), FALSE);
$RootMenu->AddMenuItem(4, $Language->MenuPhrase("4", "MenuText"), "parameterlist.php", 11, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}parameter'), FALSE);
$RootMenu->AddMenuItem(74, $Language->MenuPhrase("74", "MenuText"), "script_function_parameter_relationlist.php", 11, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}script_function_parameter_relation'), FALSE);
$RootMenu->AddMenuItem(12, $Language->MenuPhrase("12", "MenuText"), "", 16, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "function_grouplist.php", 12, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}function_group'), FALSE);
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "function_group_relationlist.php", 12, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}function_group_relation'), FALSE);
$RootMenu->AddMenuItem(14, $Language->MenuPhrase("14", "MenuText"), "", 16, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "tasklist.php", 14, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}task'), FALSE);
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "task_function_grouplist.php", 14, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}task_function_group'), FALSE);
$RootMenu->AddMenuItem(13, $Language->MenuPhrase("13", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "commandlist.php", 13, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}command'), FALSE);
$RootMenu->AddMenuItem(10, $Language->MenuPhrase("10", "MenuText"), "audittraillist.php", 13, "", AllowListMenu('{3246B9FA-4C51-4733-8040-34B188FCD87E}audittrail'), FALSE);
$RootMenu->AddMenuItem(-2, $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
	</div><!-- /content -->
</div><!-- /page -->
</body>
</html>
<?php

	 // Close connection
	$conn->Close();
?>
