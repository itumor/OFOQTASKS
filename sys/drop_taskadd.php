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

$drop_task_add = NULL; // Initialize page object first

class cdrop_task_add extends cdrop_task {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'drop_task';

	// Page object name
	var $PageObjName = 'drop_task_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("drop_tasklist.php");
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
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
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
					$this->Page_Terminate("drop_tasklist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "drop_taskview.php")
						$sReturnUrl = $this->GetViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD;  // Render add type

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
		$this->server_id_mysqladmin->CurrentValue = NULL;
		$this->server_id_mysqladmin->OldValue = $this->server_id_mysqladmin->CurrentValue;
		$this->HOSTNAME->CurrentValue = NULL;
		$this->HOSTNAME->OldValue = $this->HOSTNAME->CurrentValue;
		$this->USERNAME->CurrentValue = NULL;
		$this->USERNAME->OldValue = $this->USERNAME->CurrentValue;
		$this->PASSWORD->CurrentValue = NULL;
		$this->PASSWORD->OldValue = $this->PASSWORD->CurrentValue;
		$this->DATABASE->CurrentValue = NULL;
		$this->DATABASE->OldValue = $this->DATABASE->CurrentValue;
		$this->FILEPATH->CurrentValue = NULL;
		$this->FILEPATH->OldValue = $this->FILEPATH->CurrentValue;
		$this->FILENAME->CurrentValue = NULL;
		$this->FILENAME->OldValue = $this->FILENAME->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->server_id_mysqladmin->FldIsDetailKey) {
			$this->server_id_mysqladmin->setFormValue($objForm->GetValue("x_server_id_mysqladmin"));
		}
		if (!$this->HOSTNAME->FldIsDetailKey) {
			$this->HOSTNAME->setFormValue($objForm->GetValue("x_HOSTNAME"));
		}
		if (!$this->USERNAME->FldIsDetailKey) {
			$this->USERNAME->setFormValue($objForm->GetValue("x_USERNAME"));
		}
		if (!$this->PASSWORD->FldIsDetailKey) {
			$this->PASSWORD->setFormValue($objForm->GetValue("x_PASSWORD"));
		}
		if (!$this->DATABASE->FldIsDetailKey) {
			$this->DATABASE->setFormValue($objForm->GetValue("x_DATABASE"));
		}
		if (!$this->FILEPATH->FldIsDetailKey) {
			$this->FILEPATH->setFormValue($objForm->GetValue("x_FILEPATH"));
		}
		if (!$this->FILENAME->FldIsDetailKey) {
			$this->FILENAME->setFormValue($objForm->GetValue("x_FILENAME"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->server_id_mysqladmin->CurrentValue = $this->server_id_mysqladmin->FormValue;
		$this->HOSTNAME->CurrentValue = $this->HOSTNAME->FormValue;
		$this->USERNAME->CurrentValue = $this->USERNAME->FormValue;
		$this->PASSWORD->CurrentValue = $this->PASSWORD->FormValue;
		$this->DATABASE->CurrentValue = $this->DATABASE->FormValue;
		$this->FILEPATH->CurrentValue = $this->FILEPATH->FormValue;
		$this->FILENAME->CurrentValue = $this->FILENAME->FormValue;
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
		$this->USERNAME->setDbValue($rs->fields('USERNAME'));
		$this->PASSWORD->setDbValue($rs->fields('PASSWORD'));
		$this->DATABASE->setDbValue($rs->fields('DATABASE'));
		$this->FILEPATH->setDbValue($rs->fields('FILEPATH'));
		$this->FILENAME->setDbValue($rs->fields('FILENAME'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->server_id_mysqladmin->DbValue = $row['server_id_mysqladmin'];
		$this->HOSTNAME->DbValue = $row['HOSTNAME'];
		$this->USERNAME->DbValue = $row['USERNAME'];
		$this->PASSWORD->DbValue = $row['PASSWORD'];
		$this->DATABASE->DbValue = $row['DATABASE'];
		$this->FILEPATH->DbValue = $row['FILEPATH'];
		$this->FILENAME->DbValue = $row['FILENAME'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
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
		// id
		// server_id_mysqladmin
		// HOSTNAME
		// USERNAME
		// PASSWORD
		// DATABASE
		// FILEPATH
		// FILENAME

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// server_id_mysqladmin
			$this->server_id_mysqladmin->ViewValue = $this->server_id_mysqladmin->CurrentValue;
			$this->server_id_mysqladmin->ViewCustomAttributes = "";

			// HOSTNAME
			$this->HOSTNAME->ViewValue = $this->HOSTNAME->CurrentValue;
			$this->HOSTNAME->ViewCustomAttributes = "";

			// USERNAME
			$this->USERNAME->ViewValue = $this->USERNAME->CurrentValue;
			$this->USERNAME->ViewCustomAttributes = "";

			// PASSWORD
			$this->PASSWORD->ViewValue = $this->PASSWORD->CurrentValue;
			$this->PASSWORD->ViewCustomAttributes = "";

			// DATABASE
			$this->DATABASE->ViewValue = $this->DATABASE->CurrentValue;
			$this->DATABASE->ViewCustomAttributes = "";

			// FILEPATH
			$this->FILEPATH->ViewValue = $this->FILEPATH->CurrentValue;
			$this->FILEPATH->ViewCustomAttributes = "";

			// FILENAME
			$this->FILENAME->ViewValue = $this->FILENAME->CurrentValue;
			$this->FILENAME->ViewCustomAttributes = "";

			// server_id_mysqladmin
			$this->server_id_mysqladmin->LinkCustomAttributes = "";
			$this->server_id_mysqladmin->HrefValue = "";
			$this->server_id_mysqladmin->TooltipValue = "";

			// HOSTNAME
			$this->HOSTNAME->LinkCustomAttributes = "";
			$this->HOSTNAME->HrefValue = "";
			$this->HOSTNAME->TooltipValue = "";

			// USERNAME
			$this->USERNAME->LinkCustomAttributes = "";
			$this->USERNAME->HrefValue = "";
			$this->USERNAME->TooltipValue = "";

			// PASSWORD
			$this->PASSWORD->LinkCustomAttributes = "";
			$this->PASSWORD->HrefValue = "";
			$this->PASSWORD->TooltipValue = "";

			// DATABASE
			$this->DATABASE->LinkCustomAttributes = "";
			$this->DATABASE->HrefValue = "";
			$this->DATABASE->TooltipValue = "";

			// FILEPATH
			$this->FILEPATH->LinkCustomAttributes = "";
			$this->FILEPATH->HrefValue = "";
			$this->FILEPATH->TooltipValue = "";

			// FILENAME
			$this->FILENAME->LinkCustomAttributes = "";
			$this->FILENAME->HrefValue = "";
			$this->FILENAME->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// server_id_mysqladmin
			$this->server_id_mysqladmin->EditCustomAttributes = "";
			$this->server_id_mysqladmin->EditValue = ew_HtmlEncode($this->server_id_mysqladmin->CurrentValue);
			$this->server_id_mysqladmin->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_id_mysqladmin->FldCaption()));

			// HOSTNAME
			$this->HOSTNAME->EditCustomAttributes = "";
			$this->HOSTNAME->EditValue = ew_HtmlEncode($this->HOSTNAME->CurrentValue);
			$this->HOSTNAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->HOSTNAME->FldCaption()));

			// USERNAME
			$this->USERNAME->EditCustomAttributes = "";
			$this->USERNAME->EditValue = ew_HtmlEncode($this->USERNAME->CurrentValue);
			$this->USERNAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->USERNAME->FldCaption()));

			// PASSWORD
			$this->PASSWORD->EditCustomAttributes = "";
			$this->PASSWORD->EditValue = ew_HtmlEncode($this->PASSWORD->CurrentValue);
			$this->PASSWORD->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->PASSWORD->FldCaption()));

			// DATABASE
			$this->DATABASE->EditCustomAttributes = "";
			$this->DATABASE->EditValue = ew_HtmlEncode($this->DATABASE->CurrentValue);
			$this->DATABASE->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->DATABASE->FldCaption()));

			// FILEPATH
			$this->FILEPATH->EditCustomAttributes = "";
			$this->FILEPATH->EditValue = ew_HtmlEncode($this->FILEPATH->CurrentValue);
			$this->FILEPATH->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->FILEPATH->FldCaption()));

			// FILENAME
			$this->FILENAME->EditCustomAttributes = "";
			$this->FILENAME->EditValue = ew_HtmlEncode($this->FILENAME->CurrentValue);
			$this->FILENAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->FILENAME->FldCaption()));

			// Edit refer script
			// server_id_mysqladmin

			$this->server_id_mysqladmin->HrefValue = "";

			// HOSTNAME
			$this->HOSTNAME->HrefValue = "";

			// USERNAME
			$this->USERNAME->HrefValue = "";

			// PASSWORD
			$this->PASSWORD->HrefValue = "";

			// DATABASE
			$this->DATABASE->HrefValue = "";

			// FILEPATH
			$this->FILEPATH->HrefValue = "";

			// FILENAME
			$this->FILENAME->HrefValue = "";
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
		if (!$this->server_id_mysqladmin->FldIsDetailKey && !is_null($this->server_id_mysqladmin->FormValue) && $this->server_id_mysqladmin->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_id_mysqladmin->FldCaption());
		}
		if (!$this->HOSTNAME->FldIsDetailKey && !is_null($this->HOSTNAME->FormValue) && $this->HOSTNAME->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->HOSTNAME->FldCaption());
		}
		if (!$this->USERNAME->FldIsDetailKey && !is_null($this->USERNAME->FormValue) && $this->USERNAME->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->USERNAME->FldCaption());
		}
		if (!$this->PASSWORD->FldIsDetailKey && !is_null($this->PASSWORD->FormValue) && $this->PASSWORD->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->PASSWORD->FldCaption());
		}
		if (!$this->DATABASE->FldIsDetailKey && !is_null($this->DATABASE->FormValue) && $this->DATABASE->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->DATABASE->FldCaption());
		}
		if (!$this->FILEPATH->FldIsDetailKey && !is_null($this->FILEPATH->FormValue) && $this->FILEPATH->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->FILEPATH->FldCaption());
		}
		if (!$this->FILENAME->FldIsDetailKey && !is_null($this->FILENAME->FormValue) && $this->FILENAME->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->FILENAME->FldCaption());
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

		// server_id_mysqladmin
		$this->server_id_mysqladmin->SetDbValueDef($rsnew, $this->server_id_mysqladmin->CurrentValue, "", FALSE);

		// HOSTNAME
		$this->HOSTNAME->SetDbValueDef($rsnew, $this->HOSTNAME->CurrentValue, "", FALSE);

		// USERNAME
		$this->USERNAME->SetDbValueDef($rsnew, $this->USERNAME->CurrentValue, "", FALSE);

		// PASSWORD
		$this->PASSWORD->SetDbValueDef($rsnew, $this->PASSWORD->CurrentValue, "", FALSE);

		// DATABASE
		$this->DATABASE->SetDbValueDef($rsnew, $this->DATABASE->CurrentValue, "", FALSE);

		// FILEPATH
		$this->FILEPATH->SetDbValueDef($rsnew, $this->FILEPATH->CurrentValue, "", FALSE);

		// FILENAME
		$this->FILENAME->SetDbValueDef($rsnew, $this->FILENAME->CurrentValue, "", FALSE);

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
			$this->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $this->id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "drop_tasklist.php", $this->TableVar);
		$PageCaption = ($this->CurrentAction == "C") ? $Language->Phrase("Copy") : $Language->Phrase("Add");
		$Breadcrumb->Add("add", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
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
if (!isset($drop_task_add)) $drop_task_add = new cdrop_task_add();

// Page init
$drop_task_add->Page_Init();

// Page main
$drop_task_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$drop_task_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var drop_task_add = new ew_Page("drop_task_add");
drop_task_add.PageID = "add"; // Page ID
var EW_PAGE_ID = drop_task_add.PageID; // For backward compatibility

// Form object
var fdrop_taskadd = new ew_Form("fdrop_taskadd");

// Validate form
fdrop_taskadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_server_id_mysqladmin");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($drop_task->server_id_mysqladmin->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_HOSTNAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($drop_task->HOSTNAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_USERNAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($drop_task->USERNAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_PASSWORD");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($drop_task->PASSWORD->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_DATABASE");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($drop_task->DATABASE->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_FILEPATH");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($drop_task->FILEPATH->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_FILENAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($drop_task->FILENAME->FldCaption()) ?>");

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
fdrop_taskadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fdrop_taskadd.ValidateRequired = true;
<?php } else { ?>
fdrop_taskadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $drop_task_add->ShowPageHeader(); ?>
<?php
$drop_task_add->ShowMessage();
?>
<form name="fdrop_taskadd" id="fdrop_taskadd" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="drop_task">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_drop_taskadd" class="table table-bordered table-striped">
<?php if ($drop_task->server_id_mysqladmin->Visible) { // server_id_mysqladmin ?>
	<tr id="r_server_id_mysqladmin">
		<td><span id="elh_drop_task_server_id_mysqladmin"><?php echo $drop_task->server_id_mysqladmin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $drop_task->server_id_mysqladmin->CellAttributes() ?>>
<span id="el_drop_task_server_id_mysqladmin" class="control-group">
<input type="text" data-field="x_server_id_mysqladmin" name="x_server_id_mysqladmin" id="x_server_id_mysqladmin" size="30" maxlength="255" placeholder="<?php echo $drop_task->server_id_mysqladmin->PlaceHolder ?>" value="<?php echo $drop_task->server_id_mysqladmin->EditValue ?>"<?php echo $drop_task->server_id_mysqladmin->EditAttributes() ?>>
</span>
<?php echo $drop_task->server_id_mysqladmin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($drop_task->HOSTNAME->Visible) { // HOSTNAME ?>
	<tr id="r_HOSTNAME">
		<td><span id="elh_drop_task_HOSTNAME"><?php echo $drop_task->HOSTNAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $drop_task->HOSTNAME->CellAttributes() ?>>
<span id="el_drop_task_HOSTNAME" class="control-group">
<input type="text" data-field="x_HOSTNAME" name="x_HOSTNAME" id="x_HOSTNAME" size="30" maxlength="255" placeholder="<?php echo $drop_task->HOSTNAME->PlaceHolder ?>" value="<?php echo $drop_task->HOSTNAME->EditValue ?>"<?php echo $drop_task->HOSTNAME->EditAttributes() ?>>
</span>
<?php echo $drop_task->HOSTNAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($drop_task->USERNAME->Visible) { // USERNAME ?>
	<tr id="r_USERNAME">
		<td><span id="elh_drop_task_USERNAME"><?php echo $drop_task->USERNAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $drop_task->USERNAME->CellAttributes() ?>>
<span id="el_drop_task_USERNAME" class="control-group">
<input type="text" data-field="x_USERNAME" name="x_USERNAME" id="x_USERNAME" size="30" maxlength="255" placeholder="<?php echo $drop_task->USERNAME->PlaceHolder ?>" value="<?php echo $drop_task->USERNAME->EditValue ?>"<?php echo $drop_task->USERNAME->EditAttributes() ?>>
</span>
<?php echo $drop_task->USERNAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($drop_task->PASSWORD->Visible) { // PASSWORD ?>
	<tr id="r_PASSWORD">
		<td><span id="elh_drop_task_PASSWORD"><?php echo $drop_task->PASSWORD->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $drop_task->PASSWORD->CellAttributes() ?>>
<span id="el_drop_task_PASSWORD" class="control-group">
<input type="text" data-field="x_PASSWORD" name="x_PASSWORD" id="x_PASSWORD" size="30" maxlength="255" placeholder="<?php echo $drop_task->PASSWORD->PlaceHolder ?>" value="<?php echo $drop_task->PASSWORD->EditValue ?>"<?php echo $drop_task->PASSWORD->EditAttributes() ?>>
</span>
<?php echo $drop_task->PASSWORD->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($drop_task->DATABASE->Visible) { // DATABASE ?>
	<tr id="r_DATABASE">
		<td><span id="elh_drop_task_DATABASE"><?php echo $drop_task->DATABASE->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $drop_task->DATABASE->CellAttributes() ?>>
<span id="el_drop_task_DATABASE" class="control-group">
<input type="text" data-field="x_DATABASE" name="x_DATABASE" id="x_DATABASE" size="30" maxlength="255" placeholder="<?php echo $drop_task->DATABASE->PlaceHolder ?>" value="<?php echo $drop_task->DATABASE->EditValue ?>"<?php echo $drop_task->DATABASE->EditAttributes() ?>>
</span>
<?php echo $drop_task->DATABASE->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($drop_task->FILEPATH->Visible) { // FILEPATH ?>
	<tr id="r_FILEPATH">
		<td><span id="elh_drop_task_FILEPATH"><?php echo $drop_task->FILEPATH->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $drop_task->FILEPATH->CellAttributes() ?>>
<span id="el_drop_task_FILEPATH" class="control-group">
<input type="text" data-field="x_FILEPATH" name="x_FILEPATH" id="x_FILEPATH" size="30" maxlength="255" placeholder="<?php echo $drop_task->FILEPATH->PlaceHolder ?>" value="<?php echo $drop_task->FILEPATH->EditValue ?>"<?php echo $drop_task->FILEPATH->EditAttributes() ?>>
</span>
<?php echo $drop_task->FILEPATH->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($drop_task->FILENAME->Visible) { // FILENAME ?>
	<tr id="r_FILENAME">
		<td><span id="elh_drop_task_FILENAME"><?php echo $drop_task->FILENAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $drop_task->FILENAME->CellAttributes() ?>>
<span id="el_drop_task_FILENAME" class="control-group">
<input type="text" data-field="x_FILENAME" name="x_FILENAME" id="x_FILENAME" size="30" maxlength="255" placeholder="<?php echo $drop_task->FILENAME->PlaceHolder ?>" value="<?php echo $drop_task->FILENAME->EditValue ?>"<?php echo $drop_task->FILENAME->EditAttributes() ?>>
</span>
<?php echo $drop_task->FILENAME->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
</form>
<script type="text/javascript">
fdrop_taskadd.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$drop_task_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$drop_task_add->Page_Terminate();
?>
