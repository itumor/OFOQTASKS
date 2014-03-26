<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "scriptinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$script_edit = NULL; // Initialize page object first

class cscript_edit extends cscript {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'script';

	// Page object name
	var $PageObjName = 'script_edit';

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
	var $AuditTrailOnEdit = TRUE;

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

		// Table object (script)
		if (!isset($GLOBALS["script"])) {
			$GLOBALS["script"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["script"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'script', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("scriptlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action
		$this->script_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Load key from QueryString
		if (@$_GET["script_id"] <> "") {
			$this->script_id->setQueryStringValue($_GET["script_id"]);
			$this->RecKey["script_id"] = $this->script_id->QueryStringValue;
		} else {
			$bLoadCurrentRecord = TRUE;
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("scriptlist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->script_id->CurrentValue) == strval($this->Recordset->fields('script_id'))) {
					$this->setStartRecordNumber($this->StartRec); // Save record position
					$bMatchRecord = TRUE;
					break;
				} else {
					$this->StartRec++;
					$this->Recordset->MoveNext();
				}
			}
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$bMatchRecord) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("scriptlist.php"); // Return to list page
				} else {
					$this->LoadRowValues($this->Recordset); // Load row values
				}
				break;
			Case "U": // Update
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "scriptview.php")
						$sReturnUrl = $this->GetViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		if ($this->CurrentAction == "F") { // Confirm page
			$this->RowType = EW_ROWTYPE_VIEW; // Render as View
		} else {
			$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		}
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm;

		// Get upload data
		$this->script_path->Upload->Index = $objForm->Index;
		if ($this->script_path->Upload->UploadFile()) {

			// No action required
		} else {
			echo $this->script_path->Upload->Message;
			$this->Page_Terminate();
			exit();
		}
		$this->script_path->CurrentValue = $this->script_path->Upload->FileName;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->script_id->FldIsDetailKey)
			$this->script_id->setFormValue($objForm->GetValue("x_script_id"));
		if (!$this->script_name->FldIsDetailKey) {
			$this->script_name->setFormValue($objForm->GetValue("x_script_name"));
		}
		if (!$this->start_range->FldIsDetailKey) {
			$this->start_range->setFormValue($objForm->GetValue("x_start_range"));
		}
		if (!$this->end_range->FldIsDetailKey) {
			$this->end_range->setFormValue($objForm->GetValue("x_end_range"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->script_id->CurrentValue = $this->script_id->FormValue;
		$this->script_name->CurrentValue = $this->script_name->FormValue;
		$this->start_range->CurrentValue = $this->start_range->FormValue;
		$this->end_range->CurrentValue = $this->end_range->FormValue;
	}

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
		$this->script_id->setDbValue($rs->fields('script_id'));
		$this->script_name->setDbValue($rs->fields('script_name'));
		$this->script_path->Upload->DbValue = $rs->fields('script_path');
		$this->start_range->setDbValue($rs->fields('start_range'));
		$this->end_range->setDbValue($rs->fields('end_range'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->script_id->DbValue = $row['script_id'];
		$this->script_name->DbValue = $row['script_name'];
		$this->script_path->Upload->DbValue = $row['script_path'];
		$this->start_range->DbValue = $row['start_range'];
		$this->end_range->DbValue = $row['end_range'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// script_id
		// script_name
		// script_path
		// start_range
		// end_range

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// script_id
			$this->script_id->EditCustomAttributes = "";
			$this->script_id->EditValue = $this->script_id->CurrentValue;
			$this->script_id->ViewCustomAttributes = "";

			// script_name
			$this->script_name->EditCustomAttributes = "";
			$this->script_name->EditValue = ew_HtmlEncode($this->script_name->CurrentValue);
			$this->script_name->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->script_name->FldCaption()));

			// script_path
			$this->script_path->EditCustomAttributes = "";
			if (!ew_Empty($this->script_path->Upload->DbValue)) {
				$this->script_path->EditValue = $this->script_path->Upload->DbValue;
			} else {
				$this->script_path->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->script_path);

			// start_range
			$this->start_range->EditCustomAttributes = "";
			$this->start_range->EditValue = ew_HtmlEncode($this->start_range->CurrentValue);
			$this->start_range->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->start_range->FldCaption()));

			// end_range
			$this->end_range->EditCustomAttributes = "";
			$this->end_range->EditValue = ew_HtmlEncode($this->end_range->CurrentValue);
			$this->end_range->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->end_range->FldCaption()));

			// Edit refer script
			// script_id

			$this->script_id->HrefValue = "";

			// script_name
			$this->script_name->HrefValue = "";

			// script_path
			$this->script_path->HrefValue = "";
			$this->script_path->HrefValue2 = $this->script_path->UploadPath . $this->script_path->Upload->DbValue;

			// start_range
			$this->start_range->HrefValue = "";

			// end_range
			$this->end_range->HrefValue = "";
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
		if (!$this->script_name->FldIsDetailKey && !is_null($this->script_name->FormValue) && $this->script_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->script_name->FldCaption());
		}
		if (is_null($this->script_path->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->script_path->FldCaption());
		}
		if (!$this->start_range->FldIsDetailKey && !is_null($this->start_range->FormValue) && $this->start_range->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->start_range->FldCaption());
		}
		if (!ew_CheckInteger($this->start_range->FormValue)) {
			ew_AddMessage($gsFormError, $this->start_range->FldErrMsg());
		}
		if (!$this->end_range->FldIsDetailKey && !is_null($this->end_range->FormValue) && $this->end_range->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->end_range->FldCaption());
		}
		if (!ew_CheckInteger($this->end_range->FormValue)) {
			ew_AddMessage($gsFormError, $this->end_range->FldErrMsg());
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();
			if ($this->script_name->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`script_name` = '" . ew_AdjustSql($this->script_name->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->script_name->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->script_name->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// script_name
			$this->script_name->SetDbValueDef($rsnew, $this->script_name->CurrentValue, "", $this->script_name->ReadOnly);

			// script_path
			if (!($this->script_path->ReadOnly) && !$this->script_path->Upload->KeepFile) {
				$this->script_path->Upload->DbValue = $rs->fields('script_path'); // Get original value
				if ($this->script_path->Upload->FileName == "") {
					$rsnew['script_path'] = NULL;
				} else {
					$rsnew['script_path'] = $this->script_path->Upload->FileName;
				}
			}

			// start_range
			$this->start_range->SetDbValueDef($rsnew, $this->start_range->CurrentValue, 0, $this->start_range->ReadOnly);

			// end_range
			$this->end_range->SetDbValueDef($rsnew, $this->end_range->CurrentValue, 0, $this->end_range->ReadOnly);
			if (!$this->script_path->Upload->KeepFile) {
				if (!ew_Empty($this->script_path->Upload->Value)) {
					if ($this->script_path->Upload->FileName == $this->script_path->Upload->DbValue) { // Overwrite if same file name
						$this->script_path->Upload->DbValue = ""; // No need to delete any more
					} else {
						$rsnew['script_path'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $this->script_path->UploadPath), $rsnew['script_path']); // Get new file name
					}
				}
			}

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
					if (!$this->script_path->Upload->KeepFile) {
						if (!ew_Empty($this->script_path->Upload->Value)) {
							$this->script_path->Upload->SaveToFile($this->script_path->UploadPath, $rsnew['script_path'], TRUE);
						}
						if ($this->script_path->Upload->DbValue <> "")
							@unlink(ew_UploadPathEx(TRUE, $this->script_path->OldUploadPath) . $this->script_path->Upload->DbValue);
					}
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// script_path
		ew_CleanUploadTempPath($this->script_path, $this->script_path->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "scriptlist.php", $this->TableVar);
		$PageCaption = $Language->Phrase("edit");
		$Breadcrumb->Add("edit", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'script';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		if (!$this->AuditTrailOnEdit) return;
		$table = 'script';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['script_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
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
if (!isset($script_edit)) $script_edit = new cscript_edit();

// Page init
$script_edit->Page_Init();

// Page main
$script_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$script_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var script_edit = new ew_Page("script_edit");
script_edit.PageID = "edit"; // Page ID
var EW_PAGE_ID = script_edit.PageID; // For backward compatibility

// Form object
var fscriptedit = new ew_Form("fscriptedit");

// Validate form
fscriptedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_script_name");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($script->script_name->FldCaption()) ?>");
			felm = this.GetElements("x" + infix + "_script_path");
			elm = this.GetElements("fn_x" + infix + "_script_path");
			if (felm && elm && !ew_HasValue(elm))
				return this.OnError(felm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($script->script_path->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_start_range");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($script->start_range->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_start_range");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($script->start_range->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_end_range");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($script->end_range->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_end_range");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($script->end_range->FldErrMsg()) ?>");

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
fscriptedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fscriptedit.ValidateRequired = true;
<?php } else { ?>
fscriptedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $script_edit->ShowPageHeader(); ?>
<?php
$script_edit->ShowMessage();
?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($script_edit->Pager)) $script_edit->Pager = new cNumericPager($script_edit->StartRec, $script_edit->DisplayRecs, $script_edit->TotalRecs, $script_edit->RecRange) ?>
<?php if ($script_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($script_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $script_edit->PageUrl() ?>start=<?php echo $script_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($script_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $script_edit->PageUrl() ?>start=<?php echo $script_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($script_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $script_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($script_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $script_edit->PageUrl() ?>start=<?php echo $script_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($script_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $script_edit->PageUrl() ?>start=<?php echo $script_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
</tr></tbody></table>
<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
<?php } ?>
</td>
</tr></table>
</form>
<form name="fscriptedit" id="fscriptedit" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="script">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($script->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_scriptedit" class="table table-bordered table-striped">
<?php if ($script->script_id->Visible) { // script_id ?>
	<tr id="r_script_id">
		<td><span id="elh_script_script_id"><?php echo $script->script_id->FldCaption() ?></span></td>
		<td<?php echo $script->script_id->CellAttributes() ?>>
<?php if ($script->CurrentAction <> "F") { ?>
<span id="el_script_script_id" class="control-group">
<span<?php echo $script->script_id->ViewAttributes() ?>>
<?php echo $script->script_id->EditValue ?></span>
</span>
<input type="hidden" data-field="x_script_id" name="x_script_id" id="x_script_id" value="<?php echo ew_HtmlEncode($script->script_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_script_script_id" class="control-group">
<span<?php echo $script->script_id->ViewAttributes() ?>>
<?php echo $script->script_id->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_script_id" name="x_script_id" id="x_script_id" value="<?php echo ew_HtmlEncode($script->script_id->FormValue) ?>">
<?php } ?>
<?php echo $script->script_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($script->script_name->Visible) { // script_name ?>
	<tr id="r_script_name">
		<td><span id="elh_script_script_name"><?php echo $script->script_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $script->script_name->CellAttributes() ?>>
<?php if ($script->CurrentAction <> "F") { ?>
<span id="el_script_script_name" class="control-group">
<input type="text" data-field="x_script_name" name="x_script_name" id="x_script_name" size="30" maxlength="255" placeholder="<?php echo $script->script_name->PlaceHolder ?>" value="<?php echo $script->script_name->EditValue ?>"<?php echo $script->script_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_script_script_name" class="control-group">
<span<?php echo $script->script_name->ViewAttributes() ?>>
<?php echo $script->script_name->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_script_name" name="x_script_name" id="x_script_name" value="<?php echo ew_HtmlEncode($script->script_name->FormValue) ?>">
<?php } ?>
<?php echo $script->script_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($script->script_path->Visible) { // script_path ?>
	<tr id="r_script_path">
		<td><span id="elh_script_script_path"><?php echo $script->script_path->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $script->script_path->CellAttributes() ?>>
<span id="el_script_script_path" class="control-group">
<span id="fd_x_script_path">
<span class="btn btn-small fileinput-button">
	<span><?php echo $Language->Phrase("ChooseFile") ?></span>
	<input type="file" data-field="x_script_path" name="x_script_path" id="x_script_path">
</span>
<input type="hidden" name="fn_x_script_path" id= "fn_x_script_path" value="<?php echo $script->script_path->Upload->FileName ?>">
<?php if (@$_POST["fa_x_script_path"] == "0") { ?>
<input type="hidden" name="fa_x_script_path" id= "fa_x_script_path" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_script_path" id= "fa_x_script_path" value="1">
<?php } ?>
<input type="hidden" name="fs_x_script_path" id= "fs_x_script_path" value="255">
</span>
<table id="ft_x_script_path" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $script->script_path->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($script->start_range->Visible) { // start_range ?>
	<tr id="r_start_range">
		<td><span id="elh_script_start_range"><?php echo $script->start_range->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $script->start_range->CellAttributes() ?>>
<?php if ($script->CurrentAction <> "F") { ?>
<span id="el_script_start_range" class="control-group">
<input type="text" data-field="x_start_range" name="x_start_range" id="x_start_range" size="30" placeholder="<?php echo $script->start_range->PlaceHolder ?>" value="<?php echo $script->start_range->EditValue ?>"<?php echo $script->start_range->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_script_start_range" class="control-group">
<span<?php echo $script->start_range->ViewAttributes() ?>>
<?php echo $script->start_range->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_start_range" name="x_start_range" id="x_start_range" value="<?php echo ew_HtmlEncode($script->start_range->FormValue) ?>">
<?php } ?>
<?php echo $script->start_range->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($script->end_range->Visible) { // end_range ?>
	<tr id="r_end_range">
		<td><span id="elh_script_end_range"><?php echo $script->end_range->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $script->end_range->CellAttributes() ?>>
<?php if ($script->CurrentAction <> "F") { ?>
<span id="el_script_end_range" class="control-group">
<input type="text" data-field="x_end_range" name="x_end_range" id="x_end_range" size="30" placeholder="<?php echo $script->end_range->PlaceHolder ?>" value="<?php echo $script->end_range->EditValue ?>"<?php echo $script->end_range->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_script_end_range" class="control-group">
<span<?php echo $script->end_range->ViewAttributes() ?>>
<?php echo $script->end_range->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_end_range" name="x_end_range" id="x_end_range" value="<?php echo ew_HtmlEncode($script->end_range->FormValue) ?>">
<?php } ?>
<?php echo $script->end_range->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<table class="ewPager">
<tr><td>
<?php if (!isset($script_edit->Pager)) $script_edit->Pager = new cNumericPager($script_edit->StartRec, $script_edit->DisplayRecs, $script_edit->TotalRecs, $script_edit->RecRange) ?>
<?php if ($script_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($script_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $script_edit->PageUrl() ?>start=<?php echo $script_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($script_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $script_edit->PageUrl() ?>start=<?php echo $script_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($script_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $script_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($script_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $script_edit->PageUrl() ?>start=<?php echo $script_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($script_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $script_edit->PageUrl() ?>start=<?php echo $script_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
</tr></tbody></table>
<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
<?php } ?>
</td>
</tr></table>
<?php if ($script->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_edit.value='F';"><?php echo $Language->Phrase("EditBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_edit.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
</form>
<script type="text/javascript">
fscriptedit.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$script_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$script_edit->Page_Terminate();
?>
