<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "glassfishtuning_taskinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$glassfishtuning_task_delete = NULL; // Initialize page object first

class cglassfishtuning_task_delete extends cglassfishtuning_task {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'glassfishtuning_task';

	// Page object name
	var $PageObjName = 'glassfishtuning_task_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

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
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
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

		// Table object (glassfishtuning_task)
		if (!isset($GLOBALS["glassfishtuning_task"])) {
			$GLOBALS["glassfishtuning_task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["glassfishtuning_task"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'glassfishtuning_task', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
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
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("glassfishtuning_tasklist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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

		// Page Unload event
		$this->Page_Unload();

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("glassfishtuning_tasklist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in glassfishtuning_task class, glassfishtuning_taskinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} else {
			$this->CurrentAction = "D"; // Delete record directly
		}
		switch ($this->CurrentAction) {
			case "D": // Delete
				$this->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // Delete rows
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($this->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn;

		// Call Recordset Selecting event
		$this->Recordset_Selecting($this->CurrentFilter);

		// Load List page SQL
		$sSql = $this->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->username->setDbValue($rs->fields('username'));
		$this->datetime->setDbValue($rs->fields('datetime'));
		$this->server_id_glassfishscript->setDbValue($rs->fields('server_id_glassfishscript'));
		$this->glassfishfolder->setDbValue($rs->fields('glassfishfolder'));
		$this->domainname->setDbValue($rs->fields('domainname'));
		$this->JVMHEAPSIZE->setDbValue($rs->fields('JVMHEAPSIZE'));
		$this->JVMHEAPSIZEXMN->setDbValue($rs->fields('JVMHEAPSIZEXMN'));
		$this->JVMPARALLELGCTHREADS->setDbValue($rs->fields('JVMPARALLELGCTHREADS'));
		$this->MAXTHREADPOOLSIZE->setDbValue($rs->fields('MAXTHREADPOOLSIZE'));
		$this->LargePageSizeInBytes->setDbValue($rs->fields('LargePageSizeInBytes'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->username->DbValue = $row['username'];
		$this->datetime->DbValue = $row['datetime'];
		$this->server_id_glassfishscript->DbValue = $row['server_id_glassfishscript'];
		$this->glassfishfolder->DbValue = $row['glassfishfolder'];
		$this->domainname->DbValue = $row['domainname'];
		$this->JVMHEAPSIZE->DbValue = $row['JVMHEAPSIZE'];
		$this->JVMHEAPSIZEXMN->DbValue = $row['JVMHEAPSIZEXMN'];
		$this->JVMPARALLELGCTHREADS->DbValue = $row['JVMPARALLELGCTHREADS'];
		$this->MAXTHREADPOOLSIZE->DbValue = $row['MAXTHREADPOOLSIZE'];
		$this->LargePageSizeInBytes->DbValue = $row['LargePageSizeInBytes'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// username
		// datetime
		// server_id_glassfishscript
		// glassfishfolder
		// domainname
		// JVMHEAPSIZE
		// JVMHEAPSIZEXMN
		// JVMPARALLELGCTHREADS
		// MAXTHREADPOOLSIZE
		// LargePageSizeInBytes

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// username
			$this->username->ViewValue = $this->username->CurrentValue;
			$this->username->ViewCustomAttributes = "";

			// datetime
			$this->datetime->ViewValue = $this->datetime->CurrentValue;
			$this->datetime->ViewCustomAttributes = "";

			// server_id_glassfishscript
			if (strval($this->server_id_glassfishscript->CurrentValue) <> "") {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id_glassfishscript->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id_glassfishscript, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->server_id_glassfishscript->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->server_id_glassfishscript->ViewValue = $this->server_id_glassfishscript->CurrentValue;
				}
			} else {
				$this->server_id_glassfishscript->ViewValue = NULL;
			}
			$this->server_id_glassfishscript->ViewCustomAttributes = "";

			// glassfishfolder
			$this->glassfishfolder->ViewValue = $this->glassfishfolder->CurrentValue;
			$this->glassfishfolder->ViewCustomAttributes = "";

			// domainname
			$this->domainname->ViewValue = $this->domainname->CurrentValue;
			$this->domainname->ViewCustomAttributes = "";

			// JVMHEAPSIZE
			$this->JVMHEAPSIZE->ViewValue = $this->JVMHEAPSIZE->CurrentValue;
			$this->JVMHEAPSIZE->ViewCustomAttributes = "";

			// JVMHEAPSIZEXMN
			$this->JVMHEAPSIZEXMN->ViewValue = $this->JVMHEAPSIZEXMN->CurrentValue;
			$this->JVMHEAPSIZEXMN->ViewCustomAttributes = "";

			// JVMPARALLELGCTHREADS
			$this->JVMPARALLELGCTHREADS->ViewValue = $this->JVMPARALLELGCTHREADS->CurrentValue;
			$this->JVMPARALLELGCTHREADS->ViewCustomAttributes = "";

			// MAXTHREADPOOLSIZE
			$this->MAXTHREADPOOLSIZE->ViewValue = $this->MAXTHREADPOOLSIZE->CurrentValue;
			$this->MAXTHREADPOOLSIZE->ViewCustomAttributes = "";

			// LargePageSizeInBytes
			$this->LargePageSizeInBytes->ViewValue = $this->LargePageSizeInBytes->CurrentValue;
			$this->LargePageSizeInBytes->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";
			$this->username->TooltipValue = "";

			// datetime
			$this->datetime->LinkCustomAttributes = "";
			$this->datetime->HrefValue = "";
			$this->datetime->TooltipValue = "";

			// server_id_glassfishscript
			$this->server_id_glassfishscript->LinkCustomAttributes = "";
			$this->server_id_glassfishscript->HrefValue = "";
			$this->server_id_glassfishscript->TooltipValue = "";

			// glassfishfolder
			$this->glassfishfolder->LinkCustomAttributes = "";
			$this->glassfishfolder->HrefValue = "";
			$this->glassfishfolder->TooltipValue = "";

			// domainname
			$this->domainname->LinkCustomAttributes = "";
			$this->domainname->HrefValue = "";
			$this->domainname->TooltipValue = "";

			// JVMHEAPSIZE
			$this->JVMHEAPSIZE->LinkCustomAttributes = "";
			$this->JVMHEAPSIZE->HrefValue = "";
			$this->JVMHEAPSIZE->TooltipValue = "";

			// JVMHEAPSIZEXMN
			$this->JVMHEAPSIZEXMN->LinkCustomAttributes = "";
			$this->JVMHEAPSIZEXMN->HrefValue = "";
			$this->JVMHEAPSIZEXMN->TooltipValue = "";

			// JVMPARALLELGCTHREADS
			$this->JVMPARALLELGCTHREADS->LinkCustomAttributes = "";
			$this->JVMPARALLELGCTHREADS->HrefValue = "";
			$this->JVMPARALLELGCTHREADS->TooltipValue = "";

			// MAXTHREADPOOLSIZE
			$this->MAXTHREADPOOLSIZE->LinkCustomAttributes = "";
			$this->MAXTHREADPOOLSIZE->HrefValue = "";
			$this->MAXTHREADPOOLSIZE->TooltipValue = "";

			// LargePageSizeInBytes
			$this->LargePageSizeInBytes->LinkCustomAttributes = "";
			$this->LargePageSizeInBytes->HrefValue = "";
			$this->LargePageSizeInBytes->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$this->LoadDbValues($row);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "glassfishtuning_tasklist.php", $this->TableVar);
		$PageCaption = $Language->Phrase("delete");
		$Breadcrumb->Add("delete", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
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
if (!isset($glassfishtuning_task_delete)) $glassfishtuning_task_delete = new cglassfishtuning_task_delete();

// Page init
$glassfishtuning_task_delete->Page_Init();

// Page main
$glassfishtuning_task_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$glassfishtuning_task_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var glassfishtuning_task_delete = new ew_Page("glassfishtuning_task_delete");
glassfishtuning_task_delete.PageID = "delete"; // Page ID
var EW_PAGE_ID = glassfishtuning_task_delete.PageID; // For backward compatibility

// Form object
var fglassfishtuning_taskdelete = new ew_Form("fglassfishtuning_taskdelete");

// Form_CustomValidate event
fglassfishtuning_taskdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fglassfishtuning_taskdelete.ValidateRequired = true;
<?php } else { ?>
fglassfishtuning_taskdelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fglassfishtuning_taskdelete.Lists["x_server_id_glassfishscript"] = {"LinkField":"x_server_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php

// Load records for display
if ($glassfishtuning_task_delete->Recordset = $glassfishtuning_task_delete->LoadRecordset())
	$glassfishtuning_task_deleteTotalRecs = $glassfishtuning_task_delete->Recordset->RecordCount(); // Get record count
if ($glassfishtuning_task_deleteTotalRecs <= 0) { // No record found, exit
	if ($glassfishtuning_task_delete->Recordset)
		$glassfishtuning_task_delete->Recordset->Close();
	$glassfishtuning_task_delete->Page_Terminate("glassfishtuning_tasklist.php"); // Return to list
}
?>
<?php $Breadcrumb->Render(); ?>
<?php $glassfishtuning_task_delete->ShowPageHeader(); ?>
<?php
$glassfishtuning_task_delete->ShowMessage();
?>
<form name="fglassfishtuning_taskdelete" id="fglassfishtuning_taskdelete" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="glassfishtuning_task">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($glassfishtuning_task_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="tbl_glassfishtuning_taskdelete" class="ewTable ewTableSeparate">
<?php echo $glassfishtuning_task->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($glassfishtuning_task->id->Visible) { // id ?>
		<td><span id="elh_glassfishtuning_task_id" class="glassfishtuning_task_id"><?php echo $glassfishtuning_task->id->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->username->Visible) { // username ?>
		<td><span id="elh_glassfishtuning_task_username" class="glassfishtuning_task_username"><?php echo $glassfishtuning_task->username->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->datetime->Visible) { // datetime ?>
		<td><span id="elh_glassfishtuning_task_datetime" class="glassfishtuning_task_datetime"><?php echo $glassfishtuning_task->datetime->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->server_id_glassfishscript->Visible) { // server_id_glassfishscript ?>
		<td><span id="elh_glassfishtuning_task_server_id_glassfishscript" class="glassfishtuning_task_server_id_glassfishscript"><?php echo $glassfishtuning_task->server_id_glassfishscript->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->glassfishfolder->Visible) { // glassfishfolder ?>
		<td><span id="elh_glassfishtuning_task_glassfishfolder" class="glassfishtuning_task_glassfishfolder"><?php echo $glassfishtuning_task->glassfishfolder->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->domainname->Visible) { // domainname ?>
		<td><span id="elh_glassfishtuning_task_domainname" class="glassfishtuning_task_domainname"><?php echo $glassfishtuning_task->domainname->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->JVMHEAPSIZE->Visible) { // JVMHEAPSIZE ?>
		<td><span id="elh_glassfishtuning_task_JVMHEAPSIZE" class="glassfishtuning_task_JVMHEAPSIZE"><?php echo $glassfishtuning_task->JVMHEAPSIZE->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->JVMHEAPSIZEXMN->Visible) { // JVMHEAPSIZEXMN ?>
		<td><span id="elh_glassfishtuning_task_JVMHEAPSIZEXMN" class="glassfishtuning_task_JVMHEAPSIZEXMN"><?php echo $glassfishtuning_task->JVMHEAPSIZEXMN->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->JVMPARALLELGCTHREADS->Visible) { // JVMPARALLELGCTHREADS ?>
		<td><span id="elh_glassfishtuning_task_JVMPARALLELGCTHREADS" class="glassfishtuning_task_JVMPARALLELGCTHREADS"><?php echo $glassfishtuning_task->JVMPARALLELGCTHREADS->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->MAXTHREADPOOLSIZE->Visible) { // MAXTHREADPOOLSIZE ?>
		<td><span id="elh_glassfishtuning_task_MAXTHREADPOOLSIZE" class="glassfishtuning_task_MAXTHREADPOOLSIZE"><?php echo $glassfishtuning_task->MAXTHREADPOOLSIZE->FldCaption() ?></span></td>
<?php } ?>
<?php if ($glassfishtuning_task->LargePageSizeInBytes->Visible) { // LargePageSizeInBytes ?>
		<td><span id="elh_glassfishtuning_task_LargePageSizeInBytes" class="glassfishtuning_task_LargePageSizeInBytes"><?php echo $glassfishtuning_task->LargePageSizeInBytes->FldCaption() ?></span></td>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$glassfishtuning_task_delete->RecCnt = 0;
$i = 0;
while (!$glassfishtuning_task_delete->Recordset->EOF) {
	$glassfishtuning_task_delete->RecCnt++;
	$glassfishtuning_task_delete->RowCnt++;

	// Set row properties
	$glassfishtuning_task->ResetAttrs();
	$glassfishtuning_task->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$glassfishtuning_task_delete->LoadRowValues($glassfishtuning_task_delete->Recordset);

	// Render row
	$glassfishtuning_task_delete->RenderRow();
?>
	<tr<?php echo $glassfishtuning_task->RowAttributes() ?>>
<?php if ($glassfishtuning_task->id->Visible) { // id ?>
		<td<?php echo $glassfishtuning_task->id->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_id" class="control-group glassfishtuning_task_id">
<span<?php echo $glassfishtuning_task->id->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->username->Visible) { // username ?>
		<td<?php echo $glassfishtuning_task->username->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_username" class="control-group glassfishtuning_task_username">
<span<?php echo $glassfishtuning_task->username->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->username->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->datetime->Visible) { // datetime ?>
		<td<?php echo $glassfishtuning_task->datetime->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_datetime" class="control-group glassfishtuning_task_datetime">
<span<?php echo $glassfishtuning_task->datetime->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->datetime->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->server_id_glassfishscript->Visible) { // server_id_glassfishscript ?>
		<td<?php echo $glassfishtuning_task->server_id_glassfishscript->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_server_id_glassfishscript" class="control-group glassfishtuning_task_server_id_glassfishscript">
<span<?php echo $glassfishtuning_task->server_id_glassfishscript->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->server_id_glassfishscript->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->glassfishfolder->Visible) { // glassfishfolder ?>
		<td<?php echo $glassfishtuning_task->glassfishfolder->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_glassfishfolder" class="control-group glassfishtuning_task_glassfishfolder">
<span<?php echo $glassfishtuning_task->glassfishfolder->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->glassfishfolder->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->domainname->Visible) { // domainname ?>
		<td<?php echo $glassfishtuning_task->domainname->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_domainname" class="control-group glassfishtuning_task_domainname">
<span<?php echo $glassfishtuning_task->domainname->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->domainname->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->JVMHEAPSIZE->Visible) { // JVMHEAPSIZE ?>
		<td<?php echo $glassfishtuning_task->JVMHEAPSIZE->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_JVMHEAPSIZE" class="control-group glassfishtuning_task_JVMHEAPSIZE">
<span<?php echo $glassfishtuning_task->JVMHEAPSIZE->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->JVMHEAPSIZE->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->JVMHEAPSIZEXMN->Visible) { // JVMHEAPSIZEXMN ?>
		<td<?php echo $glassfishtuning_task->JVMHEAPSIZEXMN->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_JVMHEAPSIZEXMN" class="control-group glassfishtuning_task_JVMHEAPSIZEXMN">
<span<?php echo $glassfishtuning_task->JVMHEAPSIZEXMN->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->JVMHEAPSIZEXMN->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->JVMPARALLELGCTHREADS->Visible) { // JVMPARALLELGCTHREADS ?>
		<td<?php echo $glassfishtuning_task->JVMPARALLELGCTHREADS->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_JVMPARALLELGCTHREADS" class="control-group glassfishtuning_task_JVMPARALLELGCTHREADS">
<span<?php echo $glassfishtuning_task->JVMPARALLELGCTHREADS->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->JVMPARALLELGCTHREADS->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->MAXTHREADPOOLSIZE->Visible) { // MAXTHREADPOOLSIZE ?>
		<td<?php echo $glassfishtuning_task->MAXTHREADPOOLSIZE->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_MAXTHREADPOOLSIZE" class="control-group glassfishtuning_task_MAXTHREADPOOLSIZE">
<span<?php echo $glassfishtuning_task->MAXTHREADPOOLSIZE->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->MAXTHREADPOOLSIZE->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($glassfishtuning_task->LargePageSizeInBytes->Visible) { // LargePageSizeInBytes ?>
		<td<?php echo $glassfishtuning_task->LargePageSizeInBytes->CellAttributes() ?>>
<span id="el<?php echo $glassfishtuning_task_delete->RowCnt ?>_glassfishtuning_task_LargePageSizeInBytes" class="control-group glassfishtuning_task_LargePageSizeInBytes">
<span<?php echo $glassfishtuning_task->LargePageSizeInBytes->ViewAttributes() ?>>
<?php echo $glassfishtuning_task->LargePageSizeInBytes->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$glassfishtuning_task_delete->Recordset->MoveNext();
}
$glassfishtuning_task_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<div class="btn-group ewButtonGroup">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fglassfishtuning_taskdelete.Init();
</script>
<?php
$glassfishtuning_task_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$glassfishtuning_task_delete->Page_Terminate();
?>
