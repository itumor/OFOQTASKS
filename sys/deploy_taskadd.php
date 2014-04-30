<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "deploy_taskinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$deploy_task_add = NULL; // Initialize page object first

class cdeploy_task_add extends cdeploy_task {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'deploy_task';

	// Page object name
	var $PageObjName = 'deploy_task_add';

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

		// Table object (deploy_task)
		if (!isset($GLOBALS["deploy_task"])) {
			$GLOBALS["deploy_task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["deploy_task"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'deploy_task', TRUE);

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
			$this->Page_Terminate("deploy_tasklist.php");
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
					$this->Page_Terminate("deploy_tasklist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "deploy_taskview.php")
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
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
		$this->datetime->CurrentValue = NULL;
		$this->datetime->OldValue = $this->datetime->CurrentValue;
		$this->server_id_asadmin->CurrentValue = NULL;
		$this->server_id_asadmin->OldValue = $this->server_id_asadmin->CurrentValue;
		$this->GLUSERNAME->CurrentValue = NULL;
		$this->GLUSERNAME->OldValue = $this->GLUSERNAME->CurrentValue;
		$this->PASSFILE->CurrentValue = NULL;
		$this->PASSFILE->OldValue = $this->PASSFILE->CurrentValue;
		$this->APPFL_NM->CurrentValue = NULL;
		$this->APPFL_NM->OldValue = $this->APPFL_NM->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->username->FldIsDetailKey) {
			$this->username->setFormValue($objForm->GetValue("x_username"));
		}
		if (!$this->datetime->FldIsDetailKey) {
			$this->datetime->setFormValue($objForm->GetValue("x_datetime"));
			$this->datetime->CurrentValue = ew_UnFormatDateTime($this->datetime->CurrentValue, 0);
		}
		if (!$this->server_id_asadmin->FldIsDetailKey) {
			$this->server_id_asadmin->setFormValue($objForm->GetValue("x_server_id_asadmin"));
		}
		if (!$this->GLUSERNAME->FldIsDetailKey) {
			$this->GLUSERNAME->setFormValue($objForm->GetValue("x_GLUSERNAME"));
		}
		if (!$this->PASSFILE->FldIsDetailKey) {
			$this->PASSFILE->setFormValue($objForm->GetValue("x_PASSFILE"));
		}
		if (!$this->APPFL_NM->FldIsDetailKey) {
			$this->APPFL_NM->setFormValue($objForm->GetValue("x_APPFL_NM"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->username->CurrentValue = $this->username->FormValue;
		$this->datetime->CurrentValue = $this->datetime->FormValue;
		$this->datetime->CurrentValue = ew_UnFormatDateTime($this->datetime->CurrentValue, 0);
		$this->server_id_asadmin->CurrentValue = $this->server_id_asadmin->FormValue;
		$this->GLUSERNAME->CurrentValue = $this->GLUSERNAME->FormValue;
		$this->PASSFILE->CurrentValue = $this->PASSFILE->FormValue;
		$this->APPFL_NM->CurrentValue = $this->APPFL_NM->FormValue;
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
		$this->server_id_asadmin->setDbValue($rs->fields('server_id_asadmin'));
		$this->GLUSERNAME->setDbValue($rs->fields('GLUSERNAME'));
		$this->PASSFILE->setDbValue($rs->fields('PASSFILE'));
		$this->APPFL_NM->setDbValue($rs->fields('APPFL_NM'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->username->DbValue = $row['username'];
		$this->datetime->DbValue = $row['datetime'];
		$this->server_id_asadmin->DbValue = $row['server_id_asadmin'];
		$this->GLUSERNAME->DbValue = $row['GLUSERNAME'];
		$this->PASSFILE->DbValue = $row['PASSFILE'];
		$this->APPFL_NM->DbValue = $row['APPFL_NM'];
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
		// username
		// datetime
		// server_id_asadmin
		// GLUSERNAME
		// PASSFILE
		// APPFL_NM

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

			// server_id_asadmin
			if (strval($this->server_id_asadmin->CurrentValue) <> "") {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id_asadmin->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id_asadmin, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->server_id_asadmin->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->server_id_asadmin->ViewValue = $this->server_id_asadmin->CurrentValue;
				}
			} else {
				$this->server_id_asadmin->ViewValue = NULL;
			}
			$this->server_id_asadmin->ViewCustomAttributes = "";

			// GLUSERNAME
			$this->GLUSERNAME->ViewValue = $this->GLUSERNAME->CurrentValue;
			$this->GLUSERNAME->ViewCustomAttributes = "";

			// PASSFILE
			$this->PASSFILE->ViewValue = $this->PASSFILE->CurrentValue;
			$this->PASSFILE->ViewCustomAttributes = "";

			// APPFL_NM
			$this->APPFL_NM->ViewValue = $this->APPFL_NM->CurrentValue;
			$this->APPFL_NM->ViewCustomAttributes = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";
			$this->username->TooltipValue = "";

			// datetime
			$this->datetime->LinkCustomAttributes = "";
			$this->datetime->HrefValue = "";
			$this->datetime->TooltipValue = "";

			// server_id_asadmin
			$this->server_id_asadmin->LinkCustomAttributes = "";
			$this->server_id_asadmin->HrefValue = "";
			$this->server_id_asadmin->TooltipValue = "";

			// GLUSERNAME
			$this->GLUSERNAME->LinkCustomAttributes = "";
			$this->GLUSERNAME->HrefValue = "";
			$this->GLUSERNAME->TooltipValue = "";

			// PASSFILE
			$this->PASSFILE->LinkCustomAttributes = "";
			$this->PASSFILE->HrefValue = "";
			$this->PASSFILE->TooltipValue = "";

			// APPFL_NM
			$this->APPFL_NM->LinkCustomAttributes = "";
			$this->APPFL_NM->HrefValue = "";
			$this->APPFL_NM->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// username
			// datetime
			// server_id_asadmin

			$this->server_id_asadmin->EditCustomAttributes = "";
			if (trim(strval($this->server_id_asadmin->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id_asadmin->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id_asadmin, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->server_id_asadmin->EditValue = $arwrk;

			// GLUSERNAME
			$this->GLUSERNAME->EditCustomAttributes = "";
			$this->GLUSERNAME->EditValue = ew_HtmlEncode($this->GLUSERNAME->CurrentValue);
			$this->GLUSERNAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->GLUSERNAME->FldCaption()));

			// PASSFILE
			$this->PASSFILE->EditCustomAttributes = "";
			$this->PASSFILE->EditValue = ew_HtmlEncode($this->PASSFILE->CurrentValue);
			$this->PASSFILE->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->PASSFILE->FldCaption()));

			// APPFL_NM
			$this->APPFL_NM->EditCustomAttributes = "";
			$this->APPFL_NM->EditValue = ew_HtmlEncode($this->APPFL_NM->CurrentValue);
			$this->APPFL_NM->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->APPFL_NM->FldCaption()));

			// Edit refer script
			// username

			$this->username->HrefValue = "";

			// datetime
			$this->datetime->HrefValue = "";

			// server_id_asadmin
			$this->server_id_asadmin->HrefValue = "";

			// GLUSERNAME
			$this->GLUSERNAME->HrefValue = "";

			// PASSFILE
			$this->PASSFILE->HrefValue = "";

			// APPFL_NM
			$this->APPFL_NM->HrefValue = "";
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
		if (!$this->server_id_asadmin->FldIsDetailKey && !is_null($this->server_id_asadmin->FormValue) && $this->server_id_asadmin->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_id_asadmin->FldCaption());
		}
		if (!$this->GLUSERNAME->FldIsDetailKey && !is_null($this->GLUSERNAME->FormValue) && $this->GLUSERNAME->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->GLUSERNAME->FldCaption());
		}
		if (!$this->PASSFILE->FldIsDetailKey && !is_null($this->PASSFILE->FormValue) && $this->PASSFILE->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->PASSFILE->FldCaption());
		}
		if (!$this->APPFL_NM->FldIsDetailKey && !is_null($this->APPFL_NM->FormValue) && $this->APPFL_NM->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->APPFL_NM->FldCaption());
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

		// username
		$this->username->SetDbValueDef($rsnew, CurrentUserName(), "");
		$rsnew['username'] = &$this->username->DbValue;

		// datetime
		$this->datetime->SetDbValueDef($rsnew, ew_CurrentDateTime(), ew_CurrentDate());
		$rsnew['datetime'] = &$this->datetime->DbValue;

		// server_id_asadmin
		$this->server_id_asadmin->SetDbValueDef($rsnew, $this->server_id_asadmin->CurrentValue, "", FALSE);

		// GLUSERNAME
		$this->GLUSERNAME->SetDbValueDef($rsnew, $this->GLUSERNAME->CurrentValue, "", FALSE);

		// PASSFILE
		$this->PASSFILE->SetDbValueDef($rsnew, $this->PASSFILE->CurrentValue, "", FALSE);

		// APPFL_NM
		$this->APPFL_NM->SetDbValueDef($rsnew, $this->APPFL_NM->CurrentValue, "", FALSE);

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
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "deploy_tasklist.php", $this->TableVar);
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
if (!isset($deploy_task_add)) $deploy_task_add = new cdeploy_task_add();

// Page init
$deploy_task_add->Page_Init();

// Page main
$deploy_task_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deploy_task_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var deploy_task_add = new ew_Page("deploy_task_add");
deploy_task_add.PageID = "add"; // Page ID
var EW_PAGE_ID = deploy_task_add.PageID; // For backward compatibility

// Form object
var fdeploy_taskadd = new ew_Form("fdeploy_taskadd");

// Validate form
fdeploy_taskadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_server_id_asadmin");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($deploy_task->server_id_asadmin->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_GLUSERNAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($deploy_task->GLUSERNAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_PASSFILE");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($deploy_task->PASSFILE->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_APPFL_NM");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($deploy_task->APPFL_NM->FldCaption()) ?>");

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
fdeploy_taskadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fdeploy_taskadd.ValidateRequired = true;
<?php } else { ?>
fdeploy_taskadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fdeploy_taskadd.Lists["x_server_id_asadmin"] = {"LinkField":"x_server_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $deploy_task_add->ShowPageHeader(); ?>
<?php
$deploy_task_add->ShowMessage();
?>
<form name="fdeploy_taskadd" id="fdeploy_taskadd" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="deploy_task">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_deploy_taskadd" class="table table-bordered table-striped">
<?php if ($deploy_task->server_id_asadmin->Visible) { // server_id_asadmin ?>
	<tr id="r_server_id_asadmin">
		<td><span id="elh_deploy_task_server_id_asadmin"><?php echo $deploy_task->server_id_asadmin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $deploy_task->server_id_asadmin->CellAttributes() ?>>
<span id="el_deploy_task_server_id_asadmin" class="control-group">
<select data-field="x_server_id_asadmin" id="x_server_id_asadmin" name="x_server_id_asadmin"<?php echo $deploy_task->server_id_asadmin->EditAttributes() ?>>
<?php
if (is_array($deploy_task->server_id_asadmin->EditValue)) {
	$arwrk = $deploy_task->server_id_asadmin->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($deploy_task->server_id_asadmin->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `server`";
$sWhereWrk = "";

// Call Lookup selecting
$deploy_task->Lookup_Selecting($deploy_task->server_id_asadmin, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x_server_id_asadmin" id="s_x_server_id_asadmin" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`server_id` = {filter_value}"); ?>&t0=3">
</span>
<?php echo $deploy_task->server_id_asadmin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($deploy_task->GLUSERNAME->Visible) { // GLUSERNAME ?>
	<tr id="r_GLUSERNAME">
		<td><span id="elh_deploy_task_GLUSERNAME"><?php echo $deploy_task->GLUSERNAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $deploy_task->GLUSERNAME->CellAttributes() ?>>
<span id="el_deploy_task_GLUSERNAME" class="control-group">
<input type="text" data-field="x_GLUSERNAME" name="x_GLUSERNAME" id="x_GLUSERNAME" size="30" maxlength="255" placeholder="<?php echo $deploy_task->GLUSERNAME->PlaceHolder ?>" value="<?php echo $deploy_task->GLUSERNAME->EditValue ?>"<?php echo $deploy_task->GLUSERNAME->EditAttributes() ?>>
</span>
<?php echo $deploy_task->GLUSERNAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($deploy_task->PASSFILE->Visible) { // PASSFILE ?>
	<tr id="r_PASSFILE">
		<td><span id="elh_deploy_task_PASSFILE"><?php echo $deploy_task->PASSFILE->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $deploy_task->PASSFILE->CellAttributes() ?>>
<span id="el_deploy_task_PASSFILE" class="control-group">
<input type="text" data-field="x_PASSFILE" name="x_PASSFILE" id="x_PASSFILE" size="30" maxlength="255" placeholder="<?php echo $deploy_task->PASSFILE->PlaceHolder ?>" value="<?php echo $deploy_task->PASSFILE->EditValue ?>"<?php echo $deploy_task->PASSFILE->EditAttributes() ?>>
</span>
<?php echo $deploy_task->PASSFILE->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($deploy_task->APPFL_NM->Visible) { // APPFL_NM ?>
	<tr id="r_APPFL_NM">
		<td><span id="elh_deploy_task_APPFL_NM"><?php echo $deploy_task->APPFL_NM->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $deploy_task->APPFL_NM->CellAttributes() ?>>
<span id="el_deploy_task_APPFL_NM" class="control-group">
<input type="text" data-field="x_APPFL_NM" name="x_APPFL_NM" id="x_APPFL_NM" size="30" maxlength="255" placeholder="<?php echo $deploy_task->APPFL_NM->PlaceHolder ?>" value="<?php echo $deploy_task->APPFL_NM->EditValue ?>"<?php echo $deploy_task->APPFL_NM->EditAttributes() ?>>
</span>
<?php echo $deploy_task->APPFL_NM->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
</form>
<script type="text/javascript">
fdeploy_taskadd.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$deploy_task_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$deploy_task_add->Page_Terminate();
?>
