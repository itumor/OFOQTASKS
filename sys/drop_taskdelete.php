<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "drop_taskinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$drop_task_delete = NULL; // Initialize page object first

class cdrop_task_delete extends cdrop_task {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'drop_task';

	// Page object name
	var $PageObjName = 'drop_task_delete';

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

		// Table object (drop_task)
		if (!isset($GLOBALS["drop_task"])) {
			$GLOBALS["drop_task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["drop_task"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'drop_task', TRUE);

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
			$this->Page_Terminate("drop_tasklist.php");
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
			$this->Page_Terminate("drop_tasklist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in drop_task class, drop_taskinfo.php

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
		$this->server_id_mysqladmin->setDbValue($rs->fields('server_id_mysqladmin'));
		$this->HOSTNAME->setDbValue($rs->fields('HOSTNAME'));
		$this->PASSWORD->setDbValue($rs->fields('PASSWORD'));
		$this->DATABASE->setDbValue($rs->fields('DATABASE'));
		$this->datetime->setDbValue($rs->fields('datetime'));
		$this->DBUSERNAME->setDbValue($rs->fields('DBUSERNAME'));
		$this->username->setDbValue($rs->fields('username'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->server_id_mysqladmin->DbValue = $row['server_id_mysqladmin'];
		$this->HOSTNAME->DbValue = $row['HOSTNAME'];
		$this->PASSWORD->DbValue = $row['PASSWORD'];
		$this->DATABASE->DbValue = $row['DATABASE'];
		$this->datetime->DbValue = $row['datetime'];
		$this->DBUSERNAME->DbValue = $row['DBUSERNAME'];
		$this->username->DbValue = $row['username'];
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
		// server_id_mysqladmin
		// HOSTNAME
		// PASSWORD
		// DATABASE
		// datetime
		// DBUSERNAME
		// username

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// server_id_mysqladmin
			if (strval($this->server_id_mysqladmin->CurrentValue) <> "") {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id_mysqladmin->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id_mysqladmin, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->server_id_mysqladmin->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->server_id_mysqladmin->ViewValue = $this->server_id_mysqladmin->CurrentValue;
				}
			} else {
				$this->server_id_mysqladmin->ViewValue = NULL;
			}
			$this->server_id_mysqladmin->ViewCustomAttributes = "";

			// HOSTNAME
			if (strval($this->HOSTNAME->CurrentValue) <> "") {
				$sFilterWrk = "`server_hostname`" . ew_SearchString("=", $this->HOSTNAME->CurrentValue, EW_DATATYPE_STRING);
			$sSqlWrk = "SELECT `server_hostname`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->HOSTNAME, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->HOSTNAME->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->HOSTNAME->ViewValue = $this->HOSTNAME->CurrentValue;
				}
			} else {
				$this->HOSTNAME->ViewValue = NULL;
			}
			$this->HOSTNAME->ViewCustomAttributes = "";

			// PASSWORD
			$this->PASSWORD->ViewValue = $this->PASSWORD->CurrentValue;
			$this->PASSWORD->ViewCustomAttributes = "";

			// DATABASE
			$this->DATABASE->ViewValue = $this->DATABASE->CurrentValue;
			$this->DATABASE->ViewCustomAttributes = "";

			// datetime
			$this->datetime->ViewValue = $this->datetime->CurrentValue;
			$this->datetime->ViewCustomAttributes = "";

			// DBUSERNAME
			$this->DBUSERNAME->ViewValue = $this->DBUSERNAME->CurrentValue;
			$this->DBUSERNAME->ViewCustomAttributes = "";

			// username
			$this->username->ViewValue = $this->username->CurrentValue;
			$this->username->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// server_id_mysqladmin
			$this->server_id_mysqladmin->LinkCustomAttributes = "";
			$this->server_id_mysqladmin->HrefValue = "";
			$this->server_id_mysqladmin->TooltipValue = "";

			// HOSTNAME
			$this->HOSTNAME->LinkCustomAttributes = "";
			$this->HOSTNAME->HrefValue = "";
			$this->HOSTNAME->TooltipValue = "";

			// PASSWORD
			$this->PASSWORD->LinkCustomAttributes = "";
			$this->PASSWORD->HrefValue = "";
			$this->PASSWORD->TooltipValue = "";

			// DATABASE
			$this->DATABASE->LinkCustomAttributes = "";
			$this->DATABASE->HrefValue = "";
			$this->DATABASE->TooltipValue = "";

			// datetime
			$this->datetime->LinkCustomAttributes = "";
			$this->datetime->HrefValue = "";
			$this->datetime->TooltipValue = "";

			// DBUSERNAME
			$this->DBUSERNAME->LinkCustomAttributes = "";
			$this->DBUSERNAME->HrefValue = "";
			$this->DBUSERNAME->TooltipValue = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";
			$this->username->TooltipValue = "";
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
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "drop_tasklist.php", $this->TableVar);
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
if (!isset($drop_task_delete)) $drop_task_delete = new cdrop_task_delete();

// Page init
$drop_task_delete->Page_Init();

// Page main
$drop_task_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$drop_task_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var drop_task_delete = new ew_Page("drop_task_delete");
drop_task_delete.PageID = "delete"; // Page ID
var EW_PAGE_ID = drop_task_delete.PageID; // For backward compatibility

// Form object
var fdrop_taskdelete = new ew_Form("fdrop_taskdelete");

// Form_CustomValidate event
fdrop_taskdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fdrop_taskdelete.ValidateRequired = true;
<?php } else { ?>
fdrop_taskdelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fdrop_taskdelete.Lists["x_server_id_mysqladmin"] = {"LinkField":"x_server_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fdrop_taskdelete.Lists["x_HOSTNAME"] = {"LinkField":"x_server_hostname","Ajax":true,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php

// Load records for display
if ($drop_task_delete->Recordset = $drop_task_delete->LoadRecordset())
	$drop_task_deleteTotalRecs = $drop_task_delete->Recordset->RecordCount(); // Get record count
if ($drop_task_deleteTotalRecs <= 0) { // No record found, exit
	if ($drop_task_delete->Recordset)
		$drop_task_delete->Recordset->Close();
	$drop_task_delete->Page_Terminate("drop_tasklist.php"); // Return to list
}
?>
<?php $Breadcrumb->Render(); ?>
<?php $drop_task_delete->ShowPageHeader(); ?>
<?php
$drop_task_delete->ShowMessage();
?>
<form name="fdrop_taskdelete" id="fdrop_taskdelete" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="drop_task">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($drop_task_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="tbl_drop_taskdelete" class="ewTable ewTableSeparate">
<?php echo $drop_task->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($drop_task->id->Visible) { // id ?>
		<td><span id="elh_drop_task_id" class="drop_task_id"><?php echo $drop_task->id->FldCaption() ?></span></td>
<?php } ?>
<?php if ($drop_task->server_id_mysqladmin->Visible) { // server_id_mysqladmin ?>
		<td><span id="elh_drop_task_server_id_mysqladmin" class="drop_task_server_id_mysqladmin"><?php echo $drop_task->server_id_mysqladmin->FldCaption() ?></span></td>
<?php } ?>
<?php if ($drop_task->HOSTNAME->Visible) { // HOSTNAME ?>
		<td><span id="elh_drop_task_HOSTNAME" class="drop_task_HOSTNAME"><?php echo $drop_task->HOSTNAME->FldCaption() ?></span></td>
<?php } ?>
<?php if ($drop_task->PASSWORD->Visible) { // PASSWORD ?>
		<td><span id="elh_drop_task_PASSWORD" class="drop_task_PASSWORD"><?php echo $drop_task->PASSWORD->FldCaption() ?></span></td>
<?php } ?>
<?php if ($drop_task->DATABASE->Visible) { // DATABASE ?>
		<td><span id="elh_drop_task_DATABASE" class="drop_task_DATABASE"><?php echo $drop_task->DATABASE->FldCaption() ?></span></td>
<?php } ?>
<?php if ($drop_task->datetime->Visible) { // datetime ?>
		<td><span id="elh_drop_task_datetime" class="drop_task_datetime"><?php echo $drop_task->datetime->FldCaption() ?></span></td>
<?php } ?>
<?php if ($drop_task->DBUSERNAME->Visible) { // DBUSERNAME ?>
		<td><span id="elh_drop_task_DBUSERNAME" class="drop_task_DBUSERNAME"><?php echo $drop_task->DBUSERNAME->FldCaption() ?></span></td>
<?php } ?>
<?php if ($drop_task->username->Visible) { // username ?>
		<td><span id="elh_drop_task_username" class="drop_task_username"><?php echo $drop_task->username->FldCaption() ?></span></td>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$drop_task_delete->RecCnt = 0;
$i = 0;
while (!$drop_task_delete->Recordset->EOF) {
	$drop_task_delete->RecCnt++;
	$drop_task_delete->RowCnt++;

	// Set row properties
	$drop_task->ResetAttrs();
	$drop_task->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$drop_task_delete->LoadRowValues($drop_task_delete->Recordset);

	// Render row
	$drop_task_delete->RenderRow();
?>
	<tr<?php echo $drop_task->RowAttributes() ?>>
<?php if ($drop_task->id->Visible) { // id ?>
		<td<?php echo $drop_task->id->CellAttributes() ?>>
<span id="el<?php echo $drop_task_delete->RowCnt ?>_drop_task_id" class="control-group drop_task_id">
<span<?php echo $drop_task->id->ViewAttributes() ?>>
<?php echo $drop_task->id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($drop_task->server_id_mysqladmin->Visible) { // server_id_mysqladmin ?>
		<td<?php echo $drop_task->server_id_mysqladmin->CellAttributes() ?>>
<span id="el<?php echo $drop_task_delete->RowCnt ?>_drop_task_server_id_mysqladmin" class="control-group drop_task_server_id_mysqladmin">
<span<?php echo $drop_task->server_id_mysqladmin->ViewAttributes() ?>>
<?php echo $drop_task->server_id_mysqladmin->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($drop_task->HOSTNAME->Visible) { // HOSTNAME ?>
		<td<?php echo $drop_task->HOSTNAME->CellAttributes() ?>>
<span id="el<?php echo $drop_task_delete->RowCnt ?>_drop_task_HOSTNAME" class="control-group drop_task_HOSTNAME">
<span<?php echo $drop_task->HOSTNAME->ViewAttributes() ?>>
<?php echo $drop_task->HOSTNAME->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($drop_task->PASSWORD->Visible) { // PASSWORD ?>
		<td<?php echo $drop_task->PASSWORD->CellAttributes() ?>>
<span id="el<?php echo $drop_task_delete->RowCnt ?>_drop_task_PASSWORD" class="control-group drop_task_PASSWORD">
<span<?php echo $drop_task->PASSWORD->ViewAttributes() ?>>
<?php echo $drop_task->PASSWORD->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($drop_task->DATABASE->Visible) { // DATABASE ?>
		<td<?php echo $drop_task->DATABASE->CellAttributes() ?>>
<span id="el<?php echo $drop_task_delete->RowCnt ?>_drop_task_DATABASE" class="control-group drop_task_DATABASE">
<span<?php echo $drop_task->DATABASE->ViewAttributes() ?>>
<?php echo $drop_task->DATABASE->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($drop_task->datetime->Visible) { // datetime ?>
		<td<?php echo $drop_task->datetime->CellAttributes() ?>>
<span id="el<?php echo $drop_task_delete->RowCnt ?>_drop_task_datetime" class="control-group drop_task_datetime">
<span<?php echo $drop_task->datetime->ViewAttributes() ?>>
<?php echo $drop_task->datetime->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($drop_task->DBUSERNAME->Visible) { // DBUSERNAME ?>
		<td<?php echo $drop_task->DBUSERNAME->CellAttributes() ?>>
<span id="el<?php echo $drop_task_delete->RowCnt ?>_drop_task_DBUSERNAME" class="control-group drop_task_DBUSERNAME">
<span<?php echo $drop_task->DBUSERNAME->ViewAttributes() ?>>
<?php echo $drop_task->DBUSERNAME->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($drop_task->username->Visible) { // username ?>
		<td<?php echo $drop_task->username->CellAttributes() ?>>
<span id="el<?php echo $drop_task_delete->RowCnt ?>_drop_task_username" class="control-group drop_task_username">
<span<?php echo $drop_task->username->ViewAttributes() ?>>
<?php echo $drop_task->username->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$drop_task_delete->Recordset->MoveNext();
}
$drop_task_delete->Recordset->Close();
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
fdrop_taskdelete.Init();
</script>
<?php
$drop_task_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$drop_task_delete->Page_Terminate();
?>
