<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "taskinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$task_add = NULL; // Initialize page object first

class ctask_add extends ctask {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'task';

	// Page object name
	var $PageObjName = 'task_add';

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
	var $AuditTrailOnAdd = TRUE;

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

		// Table object (task)
		if (!isset($GLOBALS["task"])) {
			$GLOBALS["task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["task"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'task', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("tasklist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["task_id"] != "") {
				$this->task_id->setQueryStringValue($_GET["task_id"]);
				$this->setKey("task_id", $this->task_id->CurrentValue); // Set up key
			} else {
				$this->setKey("task_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tasklist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "taskview.php")
						$sReturnUrl = $this->GetViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		if ($this->CurrentAction == "F") { // Confirm page
		  $this->RowType = EW_ROWTYPE_VIEW; // Render view type
		} else {
		  $this->RowType = EW_ROWTYPE_ADD; // Render add type
		}

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->task_name->CurrentValue = NULL;
		$this->task_name->OldValue = $this->task_name->CurrentValue;
		$this->sqlscript->CurrentValue = NULL;
		$this->sqlscript->OldValue = $this->sqlscript->CurrentValue;
		$this->phpscript->CurrentValue = NULL;
		$this->phpscript->OldValue = $this->phpscript->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->task_name->FldIsDetailKey) {
			$this->task_name->setFormValue($objForm->GetValue("x_task_name"));
		}
		if (!$this->sqlscript->FldIsDetailKey) {
			$this->sqlscript->setFormValue($objForm->GetValue("x_sqlscript"));
		}
		if (!$this->phpscript->FldIsDetailKey) {
			$this->phpscript->setFormValue($objForm->GetValue("x_phpscript"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->task_name->CurrentValue = $this->task_name->FormValue;
		$this->sqlscript->CurrentValue = $this->sqlscript->FormValue;
		$this->phpscript->CurrentValue = $this->phpscript->FormValue;
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
		$this->task_id->setDbValue($rs->fields('task_id'));
		$this->task_name->setDbValue($rs->fields('task_name'));
		$this->sqlscript->setDbValue($rs->fields('sqlscript'));
		$this->phpscript->setDbValue($rs->fields('phpscript'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->task_id->DbValue = $row['task_id'];
		$this->task_name->DbValue = $row['task_name'];
		$this->sqlscript->DbValue = $row['sqlscript'];
		$this->phpscript->DbValue = $row['phpscript'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("task_id")) <> "")
			$this->task_id->CurrentValue = $this->getKey("task_id"); // task_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		// sqlscript
		// phpscript

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// task_id
			$this->task_id->ViewValue = $this->task_id->CurrentValue;
			$this->task_id->ViewCustomAttributes = "";

			// task_name
			$this->task_name->ViewValue = $this->task_name->CurrentValue;
			$this->task_name->ViewCustomAttributes = "";

			// sqlscript
			$this->sqlscript->ViewValue = $this->sqlscript->CurrentValue;
			$this->sqlscript->ViewCustomAttributes = "";

			// phpscript
			$this->phpscript->ViewValue = $this->phpscript->CurrentValue;
			$this->phpscript->ViewCustomAttributes = "";

			// task_name
			$this->task_name->LinkCustomAttributes = "";
			$this->task_name->HrefValue = "";
			$this->task_name->TooltipValue = "";

			// sqlscript
			$this->sqlscript->LinkCustomAttributes = "";
			$this->sqlscript->HrefValue = "";
			$this->sqlscript->TooltipValue = "";

			// phpscript
			$this->phpscript->LinkCustomAttributes = "";
			$this->phpscript->HrefValue = "";
			$this->phpscript->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// task_name
			$this->task_name->EditCustomAttributes = "";
			$this->task_name->EditValue = ew_HtmlEncode($this->task_name->CurrentValue);
			$this->task_name->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->task_name->FldCaption()));

			// sqlscript
			$this->sqlscript->EditCustomAttributes = "";
			$this->sqlscript->EditValue = $this->sqlscript->CurrentValue;
			$this->sqlscript->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->sqlscript->FldCaption()));

			// phpscript
			$this->phpscript->EditCustomAttributes = "";
			$this->phpscript->EditValue = $this->phpscript->CurrentValue;
			$this->phpscript->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->phpscript->FldCaption()));

			// Edit refer script
			// task_name

			$this->task_name->HrefValue = "";

			// sqlscript
			$this->sqlscript->HrefValue = "";

			// phpscript
			$this->phpscript->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->task_name->FldIsDetailKey && !is_null($this->task_name->FormValue) && $this->task_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->task_name->FldCaption());
		}
		if (!$this->sqlscript->FldIsDetailKey && !is_null($this->sqlscript->FormValue) && $this->sqlscript->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->sqlscript->FldCaption());
		}
		if (!$this->phpscript->FldIsDetailKey && !is_null($this->phpscript->FormValue) && $this->phpscript->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->phpscript->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security;

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// task_name
		$this->task_name->SetDbValueDef($rsnew, $this->task_name->CurrentValue, "", FALSE);

		// sqlscript
		$this->sqlscript->SetDbValueDef($rsnew, $this->sqlscript->CurrentValue, "", FALSE);

		// phpscript
		$this->phpscript->SetDbValueDef($rsnew, $this->phpscript->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$this->task_id->setDbValue($conn->Insert_ID());
			$rsnew['task_id'] = $this->task_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "tasklist.php", $this->TableVar);
		$PageCaption = ($this->CurrentAction == "C") ? $Language->Phrase("Copy") : $Language->Phrase("Add");
		$Breadcrumb->Add("add", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'task';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		if (!$this->AuditTrailOnAdd) return;
		$table = 'task';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['task_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if ($this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($task_add)) $task_add = new ctask_add();

// Page init
$task_add->Page_Init();

// Page main
$task_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$task_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var task_add = new ew_Page("task_add");
task_add.PageID = "add"; // Page ID
var EW_PAGE_ID = task_add.PageID; // For backward compatibility

// Form object
var ftaskadd = new ew_Form("ftaskadd");

// Validate form
ftaskadd.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	this.PostAutoSuggest();
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_task_name");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($task->task_name->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_sqlscript");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($task->sqlscript->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_phpscript");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($task->phpscript->FldCaption()) ?>");

			// Set up row object
			ew_ElementsToRow(fobj);

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftaskadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ftaskadd.ValidateRequired = true;
<?php } else { ?>
ftaskadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $task_add->ShowPageHeader(); ?>
<?php
$task_add->ShowMessage();
?>
<form name="ftaskadd" id="ftaskadd" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="task">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($task->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_taskadd" class="table table-bordered table-striped">
<?php if ($task->task_name->Visible) { // task_name ?>
	<tr id="r_task_name">
		<td><span id="elh_task_task_name"><?php echo $task->task_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $task->task_name->CellAttributes() ?>>
<?php if ($task->CurrentAction <> "F") { ?>
<span id="el_task_task_name" class="control-group">
<input type="text" data-field="x_task_name" name="x_task_name" id="x_task_name" size="30" maxlength="255" placeholder="<?php echo $task->task_name->PlaceHolder ?>" value="<?php echo $task->task_name->EditValue ?>"<?php echo $task->task_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_task_task_name" class="control-group">
<span<?php echo $task->task_name->ViewAttributes() ?>>
<?php echo $task->task_name->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_task_name" name="x_task_name" id="x_task_name" value="<?php echo ew_HtmlEncode($task->task_name->FormValue) ?>">
<?php } ?>
<?php echo $task->task_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($task->sqlscript->Visible) { // sqlscript ?>
	<tr id="r_sqlscript">
		<td><span id="elh_task_sqlscript"><?php echo $task->sqlscript->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $task->sqlscript->CellAttributes() ?>>
<?php if ($task->CurrentAction <> "F") { ?>
<span id="el_task_sqlscript" class="control-group">
<textarea data-field="x_sqlscript" name="x_sqlscript" id="x_sqlscript" cols="35" rows="4" placeholder="<?php echo $task->sqlscript->PlaceHolder ?>"<?php echo $task->sqlscript->EditAttributes() ?>><?php echo $task->sqlscript->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_task_sqlscript" class="control-group">
<span<?php echo $task->sqlscript->ViewAttributes() ?>>
<?php echo $task->sqlscript->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_sqlscript" name="x_sqlscript" id="x_sqlscript" value="<?php echo ew_HtmlEncode($task->sqlscript->FormValue) ?>">
<?php } ?>
<?php echo $task->sqlscript->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($task->phpscript->Visible) { // phpscript ?>
	<tr id="r_phpscript">
		<td><span id="elh_task_phpscript"><?php echo $task->phpscript->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $task->phpscript->CellAttributes() ?>>
<?php if ($task->CurrentAction <> "F") { ?>
<span id="el_task_phpscript" class="control-group">
<textarea data-field="x_phpscript" name="x_phpscript" id="x_phpscript" cols="35" rows="4" placeholder="<?php echo $task->phpscript->PlaceHolder ?>"<?php echo $task->phpscript->EditAttributes() ?>><?php echo $task->phpscript->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_task_phpscript" class="control-group">
<span<?php echo $task->phpscript->ViewAttributes() ?>>
<?php echo $task->phpscript->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_phpscript" name="x_phpscript" id="x_phpscript" value="<?php echo ew_HtmlEncode($task->phpscript->FormValue) ?>">
<?php } ?>
<?php echo $task->phpscript->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<?php if ($task->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_add.value='F';"><?php echo $Language->Phrase("AddBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_add.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
</form>
<script type="text/javascript">
ftaskadd.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$task_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$task_add->Page_Terminate();
?>
