<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "send_taskinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$send_task_delete = NULL; // Initialize page object first

class csend_task_delete extends csend_task {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'send_task';

	// Page object name
	var $PageObjName = 'send_task_delete';

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

		// Table object (send_task)
		if (!isset($GLOBALS["send_task"])) {
			$GLOBALS["send_task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["send_task"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'send_task', TRUE);

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
			$this->Page_Terminate("send_tasklist.php");
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
			$this->Page_Terminate("send_tasklist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in send_task class, send_taskinfo.php

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
		$this->server_id_sendreceive->setDbValue($rs->fields('server_id_sendreceive'));
		$this->TARGET_FILENAME->setDbValue($rs->fields('TARGET_FILENAME'));
		$this->LOCAL_PATH->setDbValue($rs->fields('LOCAL_PATH'));
		$this->REMOTE_IPAND1STLVL->setDbValue($rs->fields('REMOTE_IPAND1STLVL'));
		$this->REMOTE_REMAIN_PATH->setDbValue($rs->fields('REMOTE_REMAIN_PATH'));
		$this->REMOTE_USERNAME->setDbValue($rs->fields('REMOTE_USERNAME'));
		$this->REMOTE_PASSWORD->setDbValue($rs->fields('REMOTE_PASSWORD'));
		$this->REMOTE_DOMAIN->setDbValue($rs->fields('REMOTE_DOMAIN'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->username->DbValue = $row['username'];
		$this->datetime->DbValue = $row['datetime'];
		$this->server_id_sendreceive->DbValue = $row['server_id_sendreceive'];
		$this->TARGET_FILENAME->DbValue = $row['TARGET_FILENAME'];
		$this->LOCAL_PATH->DbValue = $row['LOCAL_PATH'];
		$this->REMOTE_IPAND1STLVL->DbValue = $row['REMOTE_IPAND1STLVL'];
		$this->REMOTE_REMAIN_PATH->DbValue = $row['REMOTE_REMAIN_PATH'];
		$this->REMOTE_USERNAME->DbValue = $row['REMOTE_USERNAME'];
		$this->REMOTE_PASSWORD->DbValue = $row['REMOTE_PASSWORD'];
		$this->REMOTE_DOMAIN->DbValue = $row['REMOTE_DOMAIN'];
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
		// server_id_sendreceive
		// TARGET_FILENAME
		// LOCAL_PATH
		// REMOTE_IPAND1STLVL
		// REMOTE_REMAIN_PATH
		// REMOTE_USERNAME
		// REMOTE_PASSWORD
		// REMOTE_DOMAIN

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

			// server_id_sendreceive
			if (strval($this->server_id_sendreceive->CurrentValue) <> "") {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id_sendreceive->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id_sendreceive, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->server_id_sendreceive->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->server_id_sendreceive->ViewValue = $this->server_id_sendreceive->CurrentValue;
				}
			} else {
				$this->server_id_sendreceive->ViewValue = NULL;
			}
			$this->server_id_sendreceive->ViewCustomAttributes = "";

			// TARGET_FILENAME
			$this->TARGET_FILENAME->ViewValue = $this->TARGET_FILENAME->CurrentValue;
			$this->TARGET_FILENAME->ViewCustomAttributes = "";

			// LOCAL_PATH
			$this->LOCAL_PATH->ViewValue = $this->LOCAL_PATH->CurrentValue;
			$this->LOCAL_PATH->ViewCustomAttributes = "";

			// REMOTE_IPAND1STLVL
			$this->REMOTE_IPAND1STLVL->ViewValue = $this->REMOTE_IPAND1STLVL->CurrentValue;
			$this->REMOTE_IPAND1STLVL->ViewCustomAttributes = "";

			// REMOTE_REMAIN_PATH
			$this->REMOTE_REMAIN_PATH->ViewValue = $this->REMOTE_REMAIN_PATH->CurrentValue;
			$this->REMOTE_REMAIN_PATH->ViewCustomAttributes = "";

			// REMOTE_USERNAME
			$this->REMOTE_USERNAME->ViewValue = $this->REMOTE_USERNAME->CurrentValue;
			$this->REMOTE_USERNAME->ViewCustomAttributes = "";

			// REMOTE_PASSWORD
			$this->REMOTE_PASSWORD->ViewValue = $this->REMOTE_PASSWORD->CurrentValue;
			$this->REMOTE_PASSWORD->ViewCustomAttributes = "";

			// REMOTE_DOMAIN
			$this->REMOTE_DOMAIN->ViewValue = $this->REMOTE_DOMAIN->CurrentValue;
			$this->REMOTE_DOMAIN->ViewCustomAttributes = "";

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

			// server_id_sendreceive
			$this->server_id_sendreceive->LinkCustomAttributes = "";
			$this->server_id_sendreceive->HrefValue = "";
			$this->server_id_sendreceive->TooltipValue = "";

			// TARGET_FILENAME
			$this->TARGET_FILENAME->LinkCustomAttributes = "";
			$this->TARGET_FILENAME->HrefValue = "";
			$this->TARGET_FILENAME->TooltipValue = "";

			// LOCAL_PATH
			$this->LOCAL_PATH->LinkCustomAttributes = "";
			$this->LOCAL_PATH->HrefValue = "";
			$this->LOCAL_PATH->TooltipValue = "";

			// REMOTE_IPAND1STLVL
			$this->REMOTE_IPAND1STLVL->LinkCustomAttributes = "";
			$this->REMOTE_IPAND1STLVL->HrefValue = "";
			$this->REMOTE_IPAND1STLVL->TooltipValue = "";

			// REMOTE_REMAIN_PATH
			$this->REMOTE_REMAIN_PATH->LinkCustomAttributes = "";
			$this->REMOTE_REMAIN_PATH->HrefValue = "";
			$this->REMOTE_REMAIN_PATH->TooltipValue = "";

			// REMOTE_USERNAME
			$this->REMOTE_USERNAME->LinkCustomAttributes = "";
			$this->REMOTE_USERNAME->HrefValue = "";
			$this->REMOTE_USERNAME->TooltipValue = "";

			// REMOTE_PASSWORD
			$this->REMOTE_PASSWORD->LinkCustomAttributes = "";
			$this->REMOTE_PASSWORD->HrefValue = "";
			$this->REMOTE_PASSWORD->TooltipValue = "";

			// REMOTE_DOMAIN
			$this->REMOTE_DOMAIN->LinkCustomAttributes = "";
			$this->REMOTE_DOMAIN->HrefValue = "";
			$this->REMOTE_DOMAIN->TooltipValue = "";
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
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "send_tasklist.php", $this->TableVar);
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
if (!isset($send_task_delete)) $send_task_delete = new csend_task_delete();

// Page init
$send_task_delete->Page_Init();

// Page main
$send_task_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$send_task_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var send_task_delete = new ew_Page("send_task_delete");
send_task_delete.PageID = "delete"; // Page ID
var EW_PAGE_ID = send_task_delete.PageID; // For backward compatibility

// Form object
var fsend_taskdelete = new ew_Form("fsend_taskdelete");

// Form_CustomValidate event
fsend_taskdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fsend_taskdelete.ValidateRequired = true;
<?php } else { ?>
fsend_taskdelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fsend_taskdelete.Lists["x_server_id_sendreceive"] = {"LinkField":"x_server_id","Ajax":null,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php

// Load records for display
if ($send_task_delete->Recordset = $send_task_delete->LoadRecordset())
	$send_task_deleteTotalRecs = $send_task_delete->Recordset->RecordCount(); // Get record count
if ($send_task_deleteTotalRecs <= 0) { // No record found, exit
	if ($send_task_delete->Recordset)
		$send_task_delete->Recordset->Close();
	$send_task_delete->Page_Terminate("send_tasklist.php"); // Return to list
}
?>
<?php $Breadcrumb->Render(); ?>
<?php $send_task_delete->ShowPageHeader(); ?>
<?php
$send_task_delete->ShowMessage();
?>
<form name="fsend_taskdelete" id="fsend_taskdelete" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="send_task">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($send_task_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="tbl_send_taskdelete" class="ewTable ewTableSeparate">
<?php echo $send_task->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($send_task->id->Visible) { // id ?>
		<td><span id="elh_send_task_id" class="send_task_id"><?php echo $send_task->id->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->username->Visible) { // username ?>
		<td><span id="elh_send_task_username" class="send_task_username"><?php echo $send_task->username->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->datetime->Visible) { // datetime ?>
		<td><span id="elh_send_task_datetime" class="send_task_datetime"><?php echo $send_task->datetime->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->server_id_sendreceive->Visible) { // server_id_sendreceive ?>
		<td><span id="elh_send_task_server_id_sendreceive" class="send_task_server_id_sendreceive"><?php echo $send_task->server_id_sendreceive->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->TARGET_FILENAME->Visible) { // TARGET_FILENAME ?>
		<td><span id="elh_send_task_TARGET_FILENAME" class="send_task_TARGET_FILENAME"><?php echo $send_task->TARGET_FILENAME->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->LOCAL_PATH->Visible) { // LOCAL_PATH ?>
		<td><span id="elh_send_task_LOCAL_PATH" class="send_task_LOCAL_PATH"><?php echo $send_task->LOCAL_PATH->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->REMOTE_IPAND1STLVL->Visible) { // REMOTE_IPAND1STLVL ?>
		<td><span id="elh_send_task_REMOTE_IPAND1STLVL" class="send_task_REMOTE_IPAND1STLVL"><?php echo $send_task->REMOTE_IPAND1STLVL->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->REMOTE_REMAIN_PATH->Visible) { // REMOTE_REMAIN_PATH ?>
		<td><span id="elh_send_task_REMOTE_REMAIN_PATH" class="send_task_REMOTE_REMAIN_PATH"><?php echo $send_task->REMOTE_REMAIN_PATH->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->REMOTE_USERNAME->Visible) { // REMOTE_USERNAME ?>
		<td><span id="elh_send_task_REMOTE_USERNAME" class="send_task_REMOTE_USERNAME"><?php echo $send_task->REMOTE_USERNAME->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->REMOTE_PASSWORD->Visible) { // REMOTE_PASSWORD ?>
		<td><span id="elh_send_task_REMOTE_PASSWORD" class="send_task_REMOTE_PASSWORD"><?php echo $send_task->REMOTE_PASSWORD->FldCaption() ?></span></td>
<?php } ?>
<?php if ($send_task->REMOTE_DOMAIN->Visible) { // REMOTE_DOMAIN ?>
		<td><span id="elh_send_task_REMOTE_DOMAIN" class="send_task_REMOTE_DOMAIN"><?php echo $send_task->REMOTE_DOMAIN->FldCaption() ?></span></td>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$send_task_delete->RecCnt = 0;
$i = 0;
while (!$send_task_delete->Recordset->EOF) {
	$send_task_delete->RecCnt++;
	$send_task_delete->RowCnt++;

	// Set row properties
	$send_task->ResetAttrs();
	$send_task->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$send_task_delete->LoadRowValues($send_task_delete->Recordset);

	// Render row
	$send_task_delete->RenderRow();
?>
	<tr<?php echo $send_task->RowAttributes() ?>>
<?php if ($send_task->id->Visible) { // id ?>
		<td<?php echo $send_task->id->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_id" class="control-group send_task_id">
<span<?php echo $send_task->id->ViewAttributes() ?>>
<?php echo $send_task->id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->username->Visible) { // username ?>
		<td<?php echo $send_task->username->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_username" class="control-group send_task_username">
<span<?php echo $send_task->username->ViewAttributes() ?>>
<?php echo $send_task->username->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->datetime->Visible) { // datetime ?>
		<td<?php echo $send_task->datetime->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_datetime" class="control-group send_task_datetime">
<span<?php echo $send_task->datetime->ViewAttributes() ?>>
<?php echo $send_task->datetime->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->server_id_sendreceive->Visible) { // server_id_sendreceive ?>
		<td<?php echo $send_task->server_id_sendreceive->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_server_id_sendreceive" class="control-group send_task_server_id_sendreceive">
<span<?php echo $send_task->server_id_sendreceive->ViewAttributes() ?>>
<?php echo $send_task->server_id_sendreceive->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->TARGET_FILENAME->Visible) { // TARGET_FILENAME ?>
		<td<?php echo $send_task->TARGET_FILENAME->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_TARGET_FILENAME" class="control-group send_task_TARGET_FILENAME">
<span<?php echo $send_task->TARGET_FILENAME->ViewAttributes() ?>>
<?php echo $send_task->TARGET_FILENAME->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->LOCAL_PATH->Visible) { // LOCAL_PATH ?>
		<td<?php echo $send_task->LOCAL_PATH->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_LOCAL_PATH" class="control-group send_task_LOCAL_PATH">
<span<?php echo $send_task->LOCAL_PATH->ViewAttributes() ?>>
<?php echo $send_task->LOCAL_PATH->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->REMOTE_IPAND1STLVL->Visible) { // REMOTE_IPAND1STLVL ?>
		<td<?php echo $send_task->REMOTE_IPAND1STLVL->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_REMOTE_IPAND1STLVL" class="control-group send_task_REMOTE_IPAND1STLVL">
<span<?php echo $send_task->REMOTE_IPAND1STLVL->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_IPAND1STLVL->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->REMOTE_REMAIN_PATH->Visible) { // REMOTE_REMAIN_PATH ?>
		<td<?php echo $send_task->REMOTE_REMAIN_PATH->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_REMOTE_REMAIN_PATH" class="control-group send_task_REMOTE_REMAIN_PATH">
<span<?php echo $send_task->REMOTE_REMAIN_PATH->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_REMAIN_PATH->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->REMOTE_USERNAME->Visible) { // REMOTE_USERNAME ?>
		<td<?php echo $send_task->REMOTE_USERNAME->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_REMOTE_USERNAME" class="control-group send_task_REMOTE_USERNAME">
<span<?php echo $send_task->REMOTE_USERNAME->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_USERNAME->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->REMOTE_PASSWORD->Visible) { // REMOTE_PASSWORD ?>
		<td<?php echo $send_task->REMOTE_PASSWORD->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_REMOTE_PASSWORD" class="control-group send_task_REMOTE_PASSWORD">
<span<?php echo $send_task->REMOTE_PASSWORD->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_PASSWORD->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($send_task->REMOTE_DOMAIN->Visible) { // REMOTE_DOMAIN ?>
		<td<?php echo $send_task->REMOTE_DOMAIN->CellAttributes() ?>>
<span id="el<?php echo $send_task_delete->RowCnt ?>_send_task_REMOTE_DOMAIN" class="control-group send_task_REMOTE_DOMAIN">
<span<?php echo $send_task->REMOTE_DOMAIN->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_DOMAIN->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$send_task_delete->Recordset->MoveNext();
}
$send_task_delete->Recordset->Close();
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
fsend_taskdelete.Init();
</script>
<?php
$send_task_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$send_task_delete->Page_Terminate();
?>
