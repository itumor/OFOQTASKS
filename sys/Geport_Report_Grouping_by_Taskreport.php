<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php

// Global variable for table object
$Geport_Report_Grouping_by_Task = NULL;

//
// Table class for Geport Report Grouping by Task
//
class cGeport_Report_Grouping_by_Task extends cTableBase {
	var $task_id;
	var $task_name;
	var $task_function_group_id;
	var $function_group_id;
	var $function_group_name;
	var $function_group_relation_id;
	var $priority;
	var $script_function_id;
	var $script_function_name;
	var $script_id;
	var $script_name;
	var $script_path;
	var $start_range;
	var $end_range;
	var $parameter_id;
	var $parameter_name;
	var $function_group_id1;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'Geport_Report_Grouping_by_Task';
		$this->TableName = 'Geport Report Grouping by Task';
		$this->TableType = 'REPORT';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->PrinterFriendlyForPdf = TRUE;
		$this->UserIDAllowSecurity = 0; // User ID Allow

		// task_id
		$this->task_id = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_task_id', 'task_id', '`task_id`', '`task_id`', 3, -1, FALSE, '`task_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->task_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['task_id'] = &$this->task_id;

		// task_name
		$this->task_name = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_task_name', 'task_name', '`task_name`', '`task_name`', 200, -1, FALSE, '`task_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['task_name'] = &$this->task_name;

		// task_function_group_id
		$this->task_function_group_id = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_task_function_group_id', 'task_function_group_id', '`task_function_group_id`', '`task_function_group_id`', 3, -1, FALSE, '`task_function_group_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->task_function_group_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['task_function_group_id'] = &$this->task_function_group_id;

		// function_group_id
		$this->function_group_id = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_function_group_id', 'function_group_id', '`function_group_id`', '`function_group_id`', 3, -1, FALSE, '`function_group_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->function_group_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['function_group_id'] = &$this->function_group_id;

		// function_group_name
		$this->function_group_name = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_function_group_name', 'function_group_name', '`function_group_name`', '`function_group_name`', 200, -1, FALSE, '`function_group_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['function_group_name'] = &$this->function_group_name;

		// function_group_relation_id
		$this->function_group_relation_id = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_function_group_relation_id', 'function_group_relation_id', '`function_group_relation_id`', '`function_group_relation_id`', 3, -1, FALSE, '`function_group_relation_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->function_group_relation_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['function_group_relation_id'] = &$this->function_group_relation_id;

		// priority
		$this->priority = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_priority', 'priority', '`priority`', '`priority`', 3, -1, FALSE, '`priority`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->priority->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['priority'] = &$this->priority;

		// script_function_id
		$this->script_function_id = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_script_function_id', 'script_function_id', '`script_function_id`', '`script_function_id`', 3, -1, FALSE, '`script_function_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->script_function_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['script_function_id'] = &$this->script_function_id;

		// script_function_name
		$this->script_function_name = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_script_function_name', 'script_function_name', '`script_function_name`', '`script_function_name`', 200, -1, FALSE, '`script_function_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['script_function_name'] = &$this->script_function_name;

		// script_id
		$this->script_id = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_script_id', 'script_id', '`script_id`', '`script_id`', 3, -1, FALSE, '`script_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->script_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['script_id'] = &$this->script_id;

		// script_name
		$this->script_name = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_script_name', 'script_name', '`script_name`', '`script_name`', 200, -1, FALSE, '`script_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['script_name'] = &$this->script_name;

		// script_path
		$this->script_path = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_script_path', 'script_path', '`script_path`', '`script_path`', 200, -1, TRUE, '`script_path`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['script_path'] = &$this->script_path;

		// start_range
		$this->start_range = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_start_range', 'start_range', '`start_range`', '`start_range`', 3, -1, FALSE, '`start_range`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->start_range->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['start_range'] = &$this->start_range;

		// end_range
		$this->end_range = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_end_range', 'end_range', '`end_range`', '`end_range`', 3, -1, FALSE, '`end_range`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->end_range->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['end_range'] = &$this->end_range;

		// parameter_id
		$this->parameter_id = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_parameter_id', 'parameter_id', '`parameter_id`', '`parameter_id`', 3, -1, FALSE, '`parameter_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->parameter_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['parameter_id'] = &$this->parameter_id;

		// parameter_name
		$this->parameter_name = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_parameter_name', 'parameter_name', '`parameter_name`', '`parameter_name`', 200, -1, FALSE, '`parameter_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['parameter_name'] = &$this->parameter_name;

		// function_group_id1
		$this->function_group_id1 = new cField('Geport_Report_Grouping_by_Task', 'Geport Report Grouping by Task', 'x_function_group_id1', 'function_group_id1', '`function_group_id1`', '`function_group_id1`', 3, -1, FALSE, '`function_group_id1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->function_group_id1->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['function_group_id1'] = &$this->function_group_id1;
	}

	// Report group level SQL
	function SqlGroupSelect() { // Select
		return "SELECT DISTINCT `task_name` FROM `generator report`";
	}

	function SqlGroupWhere() { // Where
		return "";
	}

	function SqlGroupGroupBy() { // Group By
		return "";
	}

	function SqlGroupHaving() { // Having
		return "";
	}

	function SqlGroupOrderBy() { // Order By
		return "`task_name` ASC";
	}

	// Report detail level SQL
	function SqlDetailSelect() { // Select
		return "SELECT * FROM `generator report`";
	}

	function SqlDetailWhere() { // Where
		return "";
	}

	function SqlDetailGroupBy() { // Group By
		return "";
	}

	function SqlDetailHaving() { // Having
		return "";
	}

	function SqlDetailOrderBy() { // Order By
		return "`task_id` ASC";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (@$this->PageID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Report group SQL
	function GroupSQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = "";
		return ew_BuildSelectSql($this->SqlGroupSelect(), $this->SqlGroupWhere(),
			 $this->SqlGroupGroupBy(), $this->SqlGroupHaving(),
			 $this->SqlGroupOrderBy(), $sFilter, $sSort);
	}

	// Report detail SQL
	function DetailSQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = "";
		return ew_BuildSelectSql($this->SqlDetailSelect(), $this->SqlDetailWhere(),
			$this->SqlDetailGroupBy(), $this->SqlDetailHaving(),
			$this->SqlDetailOrderBy(), $sFilter, $sSort);
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "Geport_Report_Grouping_by_Taskreport.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "Geport_Report_Grouping_by_Taskreport.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("", $this->UrlParm($parm));
		else
			return $this->KeyUrl("", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl() {
		return "";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$Geport_Report_Grouping_by_Task_report = NULL; // Initialize page object first

class cGeport_Report_Grouping_by_Task_report extends cGeport_Report_Grouping_by_Task {

	// Page ID
	var $PageID = 'report';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'Geport Report Grouping by Task';

	// Page object name
	var $PageObjName = 'Geport_Report_Grouping_by_Task_report';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$hidden = TRUE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-error ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<table class=\"ewStdTable\"><tr><td><div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div></td></tr></table>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		return TRUE;
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language, $UserAgent;

		// User agent
		$UserAgent = ew_UserAgent();
		$GLOBALS["Page"] = &$this;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (Geport_Report_Grouping_by_Task)
		if (!isset($GLOBALS["Geport_Report_Grouping_by_Task"])) {
			$GLOBALS["Geport_Report_Grouping_by_Task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Geport_Report_Grouping_by_Task"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'report', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Geport Report Grouping by Task', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->TagClassName = "ewExportOption";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
		}
		$gsExport = $this->Export; // Get export parameter, used in header
		$gsExportFile = $this->TableVar; // Get export file, used in header
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action

		// Setup export options
		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;
		global $EW_EXPORT_REPORT;

		// Page Unload event
		$this->Page_Unload();

		// Export
		if ($this->Export <> "" && array_key_exists($this->Export, $EW_EXPORT_REPORT)) {
			$sContent = ob_get_contents();
			$fn = $EW_EXPORT_REPORT[$this->Export];
			$this->$fn($sContent);
			if ($this->Export == "email") { // Email
				ob_end_clean();
				$conn->Close(); // Close connection
				header("Location: " . ew_CurrentPage());
				exit();
			}
		}

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $ExportOptions; // Export options
	var $RecCnt = 0;
	var $ReportSql = "";
	var $ReportFilter = "";
	var $DefaultFilter = "";
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $MasterRecordExists;
	var $Command;
	var $DtlRecordCount;
	var $ReportGroups;
	var $ReportCounts;
	var $LevelBreak;
	var $ReportTotals;
	var $ReportMaxs;
	var $ReportMins;
	var $Recordset;
	var $DetailRecordset;
	var $RecordExists;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;
		$this->ReportGroups = &ew_InitArray(2, NULL);
		$this->ReportCounts = &ew_InitArray(2, 0);
		$this->LevelBreak = &ew_InitArray(2, FALSE);
		$this->ReportTotals = &ew_Init2DArray(2, 17, 0);
		$this->ReportMaxs = &ew_Init2DArray(2, 17, 0);
		$this->ReportMins = &ew_Init2DArray(2, 17, 0);

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Check level break
	function ChkLvlBreak() {
		$this->LevelBreak[1] = FALSE;
		if ($this->RecCnt == 0) { // Start Or End of Recordset
			$this->LevelBreak[1] = TRUE;
		} else {
			if (!ew_CompareValue($this->task_name->CurrentValue, $this->ReportGroups[0])) {
				$this->LevelBreak[1] = TRUE;
			}
		}
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// task_id
		// task_name
		// task_function_group_id
		// function_group_id
		// function_group_name
		// function_group_relation_id
		// priority
		// script_function_id
		// script_function_name
		// script_id
		// script_name
		// script_path
		// start_range
		// end_range
		// parameter_id
		// parameter_name
		// function_group_id1

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// task_id
			$this->task_id->ViewValue = $this->task_id->CurrentValue;
			$this->task_id->ViewCustomAttributes = "";

			// task_name
			$this->task_name->ViewValue = $this->task_name->CurrentValue;
			$this->task_name->ViewCustomAttributes = "";

			// task_function_group_id
			$this->task_function_group_id->ViewValue = $this->task_function_group_id->CurrentValue;
			$this->task_function_group_id->ViewCustomAttributes = "";

			// function_group_id
			if (strval($this->function_group_id->CurrentValue) <> "") {
				$sFilterWrk = "`function_group_id`" . ew_SearchString("=", $this->function_group_id->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `function_group_id`, `function_group_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `function_group`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->function_group_id->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->function_group_id->ViewValue = $this->function_group_id->CurrentValue;
				}
			} else {
				$this->function_group_id->ViewValue = NULL;
			}
			$this->function_group_id->ViewCustomAttributes = "";

			// function_group_name
			$this->function_group_name->ViewValue = $this->function_group_name->CurrentValue;
			$this->function_group_name->ViewCustomAttributes = "";

			// function_group_relation_id
			$this->function_group_relation_id->ViewValue = $this->function_group_relation_id->CurrentValue;
			$this->function_group_relation_id->ViewCustomAttributes = "";

			// priority
			$this->priority->ViewValue = $this->priority->CurrentValue;
			$this->priority->ViewCustomAttributes = "";

			// script_function_id
			$this->script_function_id->ViewValue = $this->script_function_id->CurrentValue;
			$this->script_function_id->ViewCustomAttributes = "";

			// script_function_name
			$this->script_function_name->ViewValue = $this->script_function_name->CurrentValue;
			$this->script_function_name->ViewCustomAttributes = "";

			// script_id
			$this->script_id->ViewValue = $this->script_id->CurrentValue;
			$this->script_id->ViewCustomAttributes = "";

			// script_name
			$this->script_name->ViewValue = $this->script_name->CurrentValue;
			$this->script_name->ViewCustomAttributes = "";

			// script_path
			if (!ew_Empty($this->script_path->Upload->DbValue)) {
				$this->script_path->ViewValue = $this->script_path->Upload->DbValue;
			} else {
				$this->script_path->ViewValue = "";
			}
			$this->script_path->ViewCustomAttributes = "";

			// start_range
			$this->start_range->ViewValue = $this->start_range->CurrentValue;
			$this->start_range->ViewCustomAttributes = "";

			// end_range
			$this->end_range->ViewValue = $this->end_range->CurrentValue;
			$this->end_range->ViewCustomAttributes = "";

			// parameter_id
			$this->parameter_id->ViewValue = $this->parameter_id->CurrentValue;
			$this->parameter_id->ViewCustomAttributes = "";

			// parameter_name
			$this->parameter_name->ViewValue = $this->parameter_name->CurrentValue;
			$this->parameter_name->ViewCustomAttributes = "";

			// function_group_id1
			if (strval($this->function_group_id1->CurrentValue) <> "") {
				$sFilterWrk = "`function_group_id`" . ew_SearchString("=", $this->function_group_id1->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `function_group_id`, `function_group_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `function_group`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->function_group_id1->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->function_group_id1->ViewValue = $this->function_group_id1->CurrentValue;
				}
			} else {
				$this->function_group_id1->ViewValue = NULL;
			}
			$this->function_group_id1->ViewCustomAttributes = "";

			// task_id
			$this->task_id->LinkCustomAttributes = "";
			$this->task_id->HrefValue = "";
			$this->task_id->TooltipValue = "";

			// task_name
			$this->task_name->LinkCustomAttributes = "";
			$this->task_name->HrefValue = "";
			$this->task_name->TooltipValue = "";

			// task_function_group_id
			$this->task_function_group_id->LinkCustomAttributes = "";
			$this->task_function_group_id->HrefValue = "";
			$this->task_function_group_id->TooltipValue = "";

			// function_group_id
			$this->function_group_id->LinkCustomAttributes = "";
			$this->function_group_id->HrefValue = "";
			$this->function_group_id->TooltipValue = "";

			// function_group_name
			$this->function_group_name->LinkCustomAttributes = "";
			$this->function_group_name->HrefValue = "";
			$this->function_group_name->TooltipValue = "";

			// function_group_relation_id
			$this->function_group_relation_id->LinkCustomAttributes = "";
			$this->function_group_relation_id->HrefValue = "";
			$this->function_group_relation_id->TooltipValue = "";

			// priority
			$this->priority->LinkCustomAttributes = "";
			$this->priority->HrefValue = "";
			$this->priority->TooltipValue = "";

			// script_function_id
			$this->script_function_id->LinkCustomAttributes = "";
			$this->script_function_id->HrefValue = "";
			$this->script_function_id->TooltipValue = "";

			// script_function_name
			$this->script_function_name->LinkCustomAttributes = "";
			$this->script_function_name->HrefValue = "";
			$this->script_function_name->TooltipValue = "";

			// script_id
			$this->script_id->LinkCustomAttributes = "";
			$this->script_id->HrefValue = "";
			$this->script_id->TooltipValue = "";

			// script_name
			$this->script_name->LinkCustomAttributes = "";
			$this->script_name->HrefValue = "";
			$this->script_name->TooltipValue = "";

			// script_path
			$this->script_path->LinkCustomAttributes = "";
			$this->script_path->HrefValue = "";
			$this->script_path->HrefValue2 = $this->script_path->UploadPath . $this->script_path->Upload->DbValue;
			$this->script_path->TooltipValue = "";

			// start_range
			$this->start_range->LinkCustomAttributes = "";
			$this->start_range->HrefValue = "";
			$this->start_range->TooltipValue = "";

			// end_range
			$this->end_range->LinkCustomAttributes = "";
			$this->end_range->HrefValue = "";
			$this->end_range->TooltipValue = "";

			// parameter_id
			$this->parameter_id->LinkCustomAttributes = "";
			$this->parameter_id->HrefValue = "";
			$this->parameter_id->TooltipValue = "";

			// parameter_name
			$this->parameter_name->LinkCustomAttributes = "";
			$this->parameter_name->HrefValue = "";
			$this->parameter_name->TooltipValue = "";

			// function_group_id1
			$this->function_group_id1->LinkCustomAttributes = "";
			$this->function_group_id1->HrefValue = "";
			$this->function_group_id1->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$url = ew_CurrentUrl();
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("report", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", $url, $this->TableVar);
	}

	// Export report to HTML
	function ExportReportHtml($html) {

		//global $gsExportFile;
		//header('Content-Type: text/html' . (EW_CHARSET <> '' ? ';charset=' . EW_CHARSET : ''));
		//header('Content-Disposition: attachment; filename=' . $gsExportFile . '.html');
		//echo $html;

	}

	// Export report to WORD
	function ExportReportWord($html) {
		global $gsExportFile;
		header('Content-Type: application/vnd.ms-word' . (EW_CHARSET <> '' ? ';charset=' . EW_CHARSET : ''));
		header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
		echo $html;
	}

	// Export report to EXCEL
	function ExportReportExcel($html) {
		global $gsExportFile;
		header('Content-Type: application/vnd.ms-excel' . (EW_CHARSET <> '' ? ';charset=' . EW_CHARSET : ''));
		header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
		echo $html;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($Geport_Report_Grouping_by_Task_report)) $Geport_Report_Grouping_by_Task_report = new cGeport_Report_Grouping_by_Task_report();

// Page init
$Geport_Report_Grouping_by_Task_report->Page_Init();

// Page main
$Geport_Report_Grouping_by_Task_report->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Geport_Report_Grouping_by_Task_report->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($Geport_Report_Grouping_by_Task->Export == "") { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($Geport_Report_Grouping_by_Task->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php
$Geport_Report_Grouping_by_Task_report->DefaultFilter = "";
$Geport_Report_Grouping_by_Task_report->ReportFilter = $Geport_Report_Grouping_by_Task_report->DefaultFilter;
if ($Geport_Report_Grouping_by_Task_report->DbDetailFilter <> "") {
	if ($Geport_Report_Grouping_by_Task_report->ReportFilter <> "") $Geport_Report_Grouping_by_Task_report->ReportFilter .= " AND ";
	$Geport_Report_Grouping_by_Task_report->ReportFilter .= "(" . $Geport_Report_Grouping_by_Task_report->DbDetailFilter . ")";
}

// Set up filter and load Group level sql
$Geport_Report_Grouping_by_Task->CurrentFilter = $Geport_Report_Grouping_by_Task_report->ReportFilter;
$Geport_Report_Grouping_by_Task_report->ReportSql = $Geport_Report_Grouping_by_Task->GroupSQL();

// Load recordset
$Geport_Report_Grouping_by_Task_report->Recordset = $conn->Execute($Geport_Report_Grouping_by_Task_report->ReportSql);
$Geport_Report_Grouping_by_Task_report->RecordExists = !$Geport_Report_Grouping_by_Task_report->Recordset->EOF;
?>
<?php if ($Geport_Report_Grouping_by_Task->Export == "") { ?>
<?php if ($Geport_Report_Grouping_by_Task_report->RecordExists) { ?>
<div class="ewViewExportOptions"><?php $Geport_Report_Grouping_by_Task_report->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $Geport_Report_Grouping_by_Task_report->ShowPageHeader(); ?>
<form method="post">
<table class="ewReportTable">
<?php

// Get First Row
if ($Geport_Report_Grouping_by_Task_report->RecordExists) {
	$Geport_Report_Grouping_by_Task->task_name->setDbValue($Geport_Report_Grouping_by_Task_report->Recordset->fields('task_name'));
	$Geport_Report_Grouping_by_Task_report->ReportGroups[0] = $Geport_Report_Grouping_by_Task->task_name->DbValue;
}
$Geport_Report_Grouping_by_Task_report->RecCnt = 0;
$Geport_Report_Grouping_by_Task_report->ReportCounts[0] = 0;
$Geport_Report_Grouping_by_Task_report->ChkLvlBreak();
while (!$Geport_Report_Grouping_by_Task_report->Recordset->EOF) {

	// Render for view
	$Geport_Report_Grouping_by_Task->RowType = EW_ROWTYPE_VIEW;
	$Geport_Report_Grouping_by_Task->ResetAttrs();
	$Geport_Report_Grouping_by_Task_report->RenderRow();

	// Show group headers
	if ($Geport_Report_Grouping_by_Task_report->LevelBreak[1]) { // Reset counter and aggregation
?>
	<tr><td class="ewGroupField"><?php echo $Geport_Report_Grouping_by_Task->task_name->FldCaption() ?></td>
	<td colspan=16 class="ewGroupName">
<span<?php echo $Geport_Report_Grouping_by_Task->task_name->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->task_name->ViewValue ?></span>
</td></tr>
<?php
	}

	// Get detail records
	$Geport_Report_Grouping_by_Task_report->ReportFilter = $Geport_Report_Grouping_by_Task_report->DefaultFilter;
	if ($Geport_Report_Grouping_by_Task_report->ReportFilter <> "") $Geport_Report_Grouping_by_Task_report->ReportFilter .= " AND ";
	if (is_null($Geport_Report_Grouping_by_Task->task_name->CurrentValue)) {
		$Geport_Report_Grouping_by_Task_report->ReportFilter .= "(`task_name` IS NULL)";
	} else {
		$Geport_Report_Grouping_by_Task_report->ReportFilter .= "(`task_name` = '" . ew_AdjustSql($Geport_Report_Grouping_by_Task->task_name->CurrentValue) . "')";
	}
	if ($Geport_Report_Grouping_by_Task_report->DbDetailFilter <> "") {
		if ($Geport_Report_Grouping_by_Task_report->ReportFilter <> "")
			$Geport_Report_Grouping_by_Task_report->ReportFilter .= " AND ";
		$Geport_Report_Grouping_by_Task_report->ReportFilter .= "(" . $Geport_Report_Grouping_by_Task_report->DbDetailFilter . ")";
	}

	// Set up detail SQL
	$Geport_Report_Grouping_by_Task->CurrentFilter = $Geport_Report_Grouping_by_Task_report->ReportFilter;
	$Geport_Report_Grouping_by_Task_report->ReportSql = $Geport_Report_Grouping_by_Task->DetailSQL();

	// Load detail records
	$Geport_Report_Grouping_by_Task_report->DetailRecordset = $conn->Execute($Geport_Report_Grouping_by_Task_report->ReportSql);
	$Geport_Report_Grouping_by_Task_report->DtlRecordCount = $Geport_Report_Grouping_by_Task_report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$Geport_Report_Grouping_by_Task_report->DetailRecordset->EOF) {
		$Geport_Report_Grouping_by_Task_report->RecCnt++;
	}
	if ($Geport_Report_Grouping_by_Task_report->RecCnt == 1) {
		$Geport_Report_Grouping_by_Task_report->ReportCounts[0] = 0;
	}
	for ($i = 1; $i <= 1; $i++) {
		if ($Geport_Report_Grouping_by_Task_report->LevelBreak[$i]) { // Reset counter and aggregation
			$Geport_Report_Grouping_by_Task_report->ReportCounts[$i] = 0;
		}
	}
	$Geport_Report_Grouping_by_Task_report->ReportCounts[0] += $Geport_Report_Grouping_by_Task_report->DtlRecordCount;
	$Geport_Report_Grouping_by_Task_report->ReportCounts[1] += $Geport_Report_Grouping_by_Task_report->DtlRecordCount;
	if ($Geport_Report_Grouping_by_Task_report->RecordExists) {
?>
	<tr>
		<td><div class="ewGroupIndent"></div></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->task_id->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->task_function_group_id->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->function_group_id->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->function_group_name->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->function_group_relation_id->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->priority->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->script_function_id->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->script_function_name->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->script_id->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->script_name->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->script_path->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->start_range->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->end_range->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->parameter_id->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->parameter_name->FldCaption() ?></td>
		<td class="ewGroupHeader"><?php echo $Geport_Report_Grouping_by_Task->function_group_id1->FldCaption() ?></td>
	</tr>
<?php
	}
	while (!$Geport_Report_Grouping_by_Task_report->DetailRecordset->EOF) {
		$Geport_Report_Grouping_by_Task->task_id->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('task_id'));
		$Geport_Report_Grouping_by_Task->task_function_group_id->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('task_function_group_id'));
		$Geport_Report_Grouping_by_Task->function_group_id->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('function_group_id'));
		$Geport_Report_Grouping_by_Task->function_group_name->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('function_group_name'));
		$Geport_Report_Grouping_by_Task->function_group_relation_id->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('function_group_relation_id'));
		$Geport_Report_Grouping_by_Task->priority->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('priority'));
		$Geport_Report_Grouping_by_Task->script_function_id->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('script_function_id'));
		$Geport_Report_Grouping_by_Task->script_function_name->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('script_function_name'));
		$Geport_Report_Grouping_by_Task->script_id->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('script_id'));
		$Geport_Report_Grouping_by_Task->script_name->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('script_name'));
		$Geport_Report_Grouping_by_Task->script_path->Upload->DbValue = $Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('script_path');
		$Geport_Report_Grouping_by_Task->start_range->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('start_range'));
		$Geport_Report_Grouping_by_Task->end_range->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('end_range'));
		$Geport_Report_Grouping_by_Task->parameter_id->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('parameter_id'));
		$Geport_Report_Grouping_by_Task->parameter_name->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('parameter_name'));
		$Geport_Report_Grouping_by_Task->function_group_id1->setDbValue($Geport_Report_Grouping_by_Task_report->DetailRecordset->fields('function_group_id1'));

		// Render for view
		$Geport_Report_Grouping_by_Task->RowType = EW_ROWTYPE_VIEW;
		$Geport_Report_Grouping_by_Task->ResetAttrs();
		$Geport_Report_Grouping_by_Task_report->RenderRow();
?>
	<tr>
		<td><div class="ewGroupIndent"></div></td>
		<td<?php echo $Geport_Report_Grouping_by_Task->task_id->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->task_id->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->task_id->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->task_function_group_id->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->task_function_group_id->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->task_function_group_id->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->function_group_id->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->function_group_id->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->function_group_id->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->function_group_name->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->function_group_name->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->function_group_name->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->function_group_relation_id->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->function_group_relation_id->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->function_group_relation_id->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->priority->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->priority->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->priority->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->script_function_id->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->script_function_id->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->script_function_id->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->script_function_name->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->script_function_name->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->script_function_name->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->script_id->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->script_id->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->script_id->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->script_name->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->script_name->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->script_name->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->script_path->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->script_path->ViewAttributes() ?>>
<?php if ($Geport_Report_Grouping_by_Task->Export == "word" || $Geport_Report_Grouping_by_Task->Export == "excel") { ?>
<?php if ($Geport_Report_Grouping_by_Task->script_path->HrefValue2 <> "" && !empty($Geport_Report_Grouping_by_Task->script_path->Upload->DbValue)) { ?>
<a href="<?php echo ew_ConvertFullUrl($Geport_Report_Grouping_by_Task->script_path->HrefValue2) ?>"><?php echo $Geport_Report_Grouping_by_Task->script_path->FldCaption() ?></a>
<?php } ?>
<?php } elseif ($Geport_Report_Grouping_by_Task->script_path->LinkAttributes() <> "") { ?>
<?php if (!empty($Geport_Report_Grouping_by_Task->script_path->Upload->DbValue)) { ?>
<?php echo $Geport_Report_Grouping_by_Task->script_path->ViewValue ?>
<?php } elseif (!in_array($Geport_Report_Grouping_by_Task->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($Geport_Report_Grouping_by_Task->script_path->Upload->DbValue)) { ?>
<?php echo $Geport_Report_Grouping_by_Task->script_path->ViewValue ?>
<?php } elseif (!in_array($Geport_Report_Grouping_by_Task->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->start_range->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->start_range->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->start_range->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->end_range->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->end_range->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->end_range->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->parameter_id->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->parameter_id->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->parameter_id->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->parameter_name->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->parameter_name->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->parameter_name->ViewValue ?></span>
</td>
		<td<?php echo $Geport_Report_Grouping_by_Task->function_group_id1->CellAttributes() ?>>
<span<?php echo $Geport_Report_Grouping_by_Task->function_group_id1->ViewAttributes() ?>>
<?php echo $Geport_Report_Grouping_by_Task->function_group_id1->ViewValue ?></span>
</td>
	</tr>
<?php
		$Geport_Report_Grouping_by_Task_report->DetailRecordset->MoveNext();
	}
	$Geport_Report_Grouping_by_Task_report->DetailRecordset->Close();

	// Save old group data
	$Geport_Report_Grouping_by_Task_report->ReportGroups[0] = $Geport_Report_Grouping_by_Task->task_name->CurrentValue;

	// Get next record
	$Geport_Report_Grouping_by_Task_report->Recordset->MoveNext();
	if ($Geport_Report_Grouping_by_Task_report->Recordset->EOF) {
		$Geport_Report_Grouping_by_Task_report->RecCnt = 0; // EOF, force all level breaks
	} else {
		$Geport_Report_Grouping_by_Task->task_name->setDbValue($Geport_Report_Grouping_by_Task_report->Recordset->fields('task_name'));
	}
	$Geport_Report_Grouping_by_Task_report->ChkLvlBreak();

	// Show footers
	if ($Geport_Report_Grouping_by_Task_report->LevelBreak[1]) {
		$Geport_Report_Grouping_by_Task->task_name->CurrentValue = $Geport_Report_Grouping_by_Task_report->ReportGroups[0];

		// Render row for view
		$Geport_Report_Grouping_by_Task->RowType = EW_ROWTYPE_VIEW;
		$Geport_Report_Grouping_by_Task->ResetAttrs();
		$Geport_Report_Grouping_by_Task_report->RenderRow();
		$Geport_Report_Grouping_by_Task->task_name->CurrentValue = $Geport_Report_Grouping_by_Task->task_name->DbValue;
?>
	<tr><td colspan=17 class="ewGroupSummary"><?php echo $Language->Phrase("RptSumHead") ?>&nbsp;<?php echo $Geport_Report_Grouping_by_Task->task_name->FldCaption() ?>:&nbsp;<?php echo $Geport_Report_Grouping_by_Task->task_name->ViewValue ?> (<?php echo ew_FormatNumber($Geport_Report_Grouping_by_Task_report->ReportCounts[1],0) ?> <?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
	<tr><td colspan=17>&nbsp;<br></td></tr>
<?php
}
}

// Close recordset
$Geport_Report_Grouping_by_Task_report->Recordset->Close();
?>
<?php if ($Geport_Report_Grouping_by_Task_report->RecordExists) { ?>
	<tr><td colspan=17>&nbsp;<br></td></tr>
	<tr><td colspan=17 class="ewGrandSummary"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo ew_FormatNumber($Geport_Report_Grouping_by_Task_report->ReportCounts[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
<?php if ($Geport_Report_Grouping_by_Task_report->RecordExists) { ?>
	<tr><td colspan=17>&nbsp;<br></td></tr>
<?php } else { ?>
	<tr><td><?php echo $Language->Phrase("NoRecord") ?></td></tr>
<?php } ?>
</table>
</form>
<?php
$Geport_Report_Grouping_by_Task_report->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($Geport_Report_Grouping_by_Task->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Geport_Report_Grouping_by_Task_report->Page_Terminate();
?>
