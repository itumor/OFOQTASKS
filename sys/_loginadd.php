<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$p_login_add = NULL; // Initialize page object first

class cp_login_add extends c_login {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'login';

	// Page object name
	var $PageObjName = 'p_login_add';

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

		// Table object (_login)
		if (!isset($GLOBALS["_login"])) {
			$GLOBALS["_login"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["_login"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'login', TRUE);

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
			$this->Page_Terminate("_loginlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("_loginlist.php");
		}

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
			if (@$_GET["idlogin"] != "") {
				$this->idlogin->setQueryStringValue($_GET["idlogin"]);
				$this->setKey("idlogin", $this->idlogin->CurrentValue); // Set up key
			} else {
				$this->setKey("idlogin", ""); // Clear key
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
					$this->Page_Terminate("_loginlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "_loginview.php")
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
		$this->loginname->CurrentValue = NULL;
		$this->loginname->OldValue = $this->loginname->CurrentValue;
		$this->loginpassword->CurrentValue = NULL;
		$this->loginpassword->OldValue = $this->loginpassword->CurrentValue;
		$this->_Email->CurrentValue = NULL;
		$this->_Email->OldValue = $this->_Email->CurrentValue;
		$this->Activated->CurrentValue = "1";
		$this->Profile->CurrentValue = NULL;
		$this->Profile->OldValue = $this->Profile->CurrentValue;
		$this->levels->CurrentValue = NULL;
		$this->levels->OldValue = $this->levels->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->loginname->FldIsDetailKey) {
			$this->loginname->setFormValue($objForm->GetValue("x_loginname"));
		}
		if (!$this->loginpassword->FldIsDetailKey) {
			$this->loginpassword->setFormValue($objForm->GetValue("x_loginpassword"));
		}
		if (!$this->_Email->FldIsDetailKey) {
			$this->_Email->setFormValue($objForm->GetValue("x__Email"));
		}
		if (!$this->Activated->FldIsDetailKey) {
			$this->Activated->setFormValue($objForm->GetValue("x_Activated"));
		}
		if (!$this->Profile->FldIsDetailKey) {
			$this->Profile->setFormValue($objForm->GetValue("x_Profile"));
		}
		if (!$this->levels->FldIsDetailKey) {
			$this->levels->setFormValue($objForm->GetValue("x_levels"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->loginname->CurrentValue = $this->loginname->FormValue;
		$this->loginpassword->CurrentValue = $this->loginpassword->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->Activated->CurrentValue = $this->Activated->FormValue;
		$this->Profile->CurrentValue = $this->Profile->FormValue;
		$this->levels->CurrentValue = $this->levels->FormValue;
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

		// Check if valid user id
		if ($res) {
			$res = $this->ShowOptionLink('add');
			if (!$res) {
				$sUserIdMsg = $Language->Phrase("NoPermission");
				$this->setFailureMessage($sUserIdMsg);
			}
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
		$this->idlogin->setDbValue($rs->fields('idlogin'));
		$this->loginname->setDbValue($rs->fields('loginname'));
		$this->loginpassword->setDbValue($rs->fields('loginpassword'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->Activated->setDbValue($rs->fields('Activated'));
		$this->Profile->setDbValue($rs->fields('Profile'));
		$this->levels->setDbValue($rs->fields('levels'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idlogin->DbValue = $row['idlogin'];
		$this->loginname->DbValue = $row['loginname'];
		$this->loginpassword->DbValue = $row['loginpassword'];
		$this->_Email->DbValue = $row['Email'];
		$this->Activated->DbValue = $row['Activated'];
		$this->Profile->DbValue = $row['Profile'];
		$this->levels->DbValue = $row['levels'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("idlogin")) <> "")
			$this->idlogin->CurrentValue = $this->getKey("idlogin"); // idlogin
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
		// idlogin
		// loginname
		// loginpassword
		// Email
		// Activated
		// Profile
		// levels

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// idlogin
			$this->idlogin->ViewValue = $this->idlogin->CurrentValue;
			$this->idlogin->ViewCustomAttributes = "";

			// loginname
			$this->loginname->ViewValue = $this->loginname->CurrentValue;
			$this->loginname->ViewCustomAttributes = "";

			// loginpassword
			$this->loginpassword->ViewValue = "********";
			$this->loginpassword->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Activated
			$this->Activated->ViewValue = $this->Activated->CurrentValue;
			$this->Activated->ViewCustomAttributes = "";

			// Profile
			$this->Profile->ViewValue = $this->Profile->CurrentValue;
			$this->Profile->ViewCustomAttributes = "";

			// levels
			if ($Security->CanAdmin()) { // System admin
			if (strval($this->levels->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->levels->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->levels, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->levels->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->levels->ViewValue = $this->levels->CurrentValue;
				}
			} else {
				$this->levels->ViewValue = NULL;
			}
			} else {
				$this->levels->ViewValue = "********";
			}
			$this->levels->ViewCustomAttributes = "";

			// loginname
			$this->loginname->LinkCustomAttributes = "";
			$this->loginname->HrefValue = "";
			$this->loginname->TooltipValue = "";

			// loginpassword
			$this->loginpassword->LinkCustomAttributes = "";
			$this->loginpassword->HrefValue = "";
			$this->loginpassword->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Activated
			$this->Activated->LinkCustomAttributes = "";
			$this->Activated->HrefValue = "";
			$this->Activated->TooltipValue = "";

			// Profile
			$this->Profile->LinkCustomAttributes = "";
			$this->Profile->HrefValue = "";
			$this->Profile->TooltipValue = "";

			// levels
			$this->levels->LinkCustomAttributes = "";
			$this->levels->HrefValue = "";
			$this->levels->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// loginname
			$this->loginname->EditCustomAttributes = "";
			$this->loginname->EditValue = ew_HtmlEncode($this->loginname->CurrentValue);
			$this->loginname->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->loginname->FldCaption()));

			// loginpassword
			$this->loginpassword->EditCustomAttributes = "";
			$this->loginpassword->EditValue = ew_HtmlEncode($this->loginpassword->CurrentValue);

			// Email
			$this->_Email->EditCustomAttributes = "";
			$this->_Email->EditValue = ew_HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->_Email->FldCaption()));

			// Activated
			$this->Activated->EditCustomAttributes = "";
			$this->Activated->EditValue = ew_HtmlEncode($this->Activated->CurrentValue);
			$this->Activated->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->Activated->FldCaption()));

			// Profile
			$this->Profile->EditCustomAttributes = "";
			$this->Profile->EditValue = $this->Profile->CurrentValue;
			$this->Profile->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->Profile->FldCaption()));

			// levels
			$this->levels->EditCustomAttributes = "";
			if (!$Security->CanAdmin()) { // System admin
				$this->levels->EditValue = "********";
			} else {
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->levels, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->levels->EditValue = $arwrk;
			}

			// Edit refer script
			// loginname

			$this->loginname->HrefValue = "";

			// loginpassword
			$this->loginpassword->HrefValue = "";

			// Email
			$this->_Email->HrefValue = "";

			// Activated
			$this->Activated->HrefValue = "";

			// Profile
			$this->Profile->HrefValue = "";

			// levels
			$this->levels->HrefValue = "";
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
		if (!$this->loginname->FldIsDetailKey && !is_null($this->loginname->FormValue) && $this->loginname->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->loginname->FldCaption());
		}
		if (!$this->loginpassword->FldIsDetailKey && !is_null($this->loginpassword->FormValue) && $this->loginpassword->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->loginpassword->FldCaption());
		}
		if (!$this->_Email->FldIsDetailKey && !is_null($this->_Email->FormValue) && $this->_Email->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->_Email->FldCaption());
		}
		if (!$this->Activated->FldIsDetailKey && !is_null($this->Activated->FormValue) && $this->Activated->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->Activated->FldCaption());
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
		if ($this->loginname->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(loginname = '" . ew_AdjustSql($this->loginname->CurrentValue) . "')";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->loginname->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->loginname->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($this->_Email->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(Email = '" . ew_AdjustSql($this->_Email->CurrentValue) . "')";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->_Email->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->_Email->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// loginname
		$this->loginname->SetDbValueDef($rsnew, $this->loginname->CurrentValue, "", FALSE);

		// loginpassword
		$this->loginpassword->SetDbValueDef($rsnew, $this->loginpassword->CurrentValue, "", FALSE);

		// Email
		$this->_Email->SetDbValueDef($rsnew, $this->_Email->CurrentValue, "", FALSE);

		// Activated
		$this->Activated->SetDbValueDef($rsnew, $this->Activated->CurrentValue, "", strval($this->Activated->CurrentValue) == "");

		// Profile
		$this->Profile->SetDbValueDef($rsnew, $this->Profile->CurrentValue, NULL, FALSE);

		// levels
		if ($Security->CanAdmin()) { // System admin
		$this->levels->SetDbValueDef($rsnew, $this->levels->CurrentValue, NULL, FALSE);
		}

		// idlogin
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
			$this->idlogin->setDbValue($conn->Insert_ID());
			$rsnew['idlogin'] = $this->idlogin->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Show link optionally based on User ID
	function ShowOptionLink($id = "") {
		global $Security;
		if ($Security->IsLoggedIn() && !$Security->IsAdmin() && !$this->UserIDAllow($id))
			return $Security->IsValidUserID($this->idlogin->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "_loginlist.php", $this->TableVar);
		$PageCaption = ($this->CurrentAction == "C") ? $Language->Phrase("Copy") : $Language->Phrase("Add");
		$Breadcrumb->Add("add", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'login';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		if (!$this->AuditTrailOnAdd) return;
		$table = 'login';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['idlogin'];

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
if (!isset($p_login_add)) $p_login_add = new cp_login_add();

// Page init
$p_login_add->Page_Init();

// Page main
$p_login_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$p_login_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var p_login_add = new ew_Page("p_login_add");
p_login_add.PageID = "add"; // Page ID
var EW_PAGE_ID = p_login_add.PageID; // For backward compatibility

// Form object
var f_loginadd = new ew_Form("f_loginadd");

// Validate form
f_loginadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_loginname");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($_login->loginname->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_loginpassword");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($_login->loginpassword->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "__Email");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($_login->_Email->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_Activated");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($_login->Activated->FldCaption()) ?>");

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
f_loginadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
f_loginadd.ValidateRequired = true;
<?php } else { ?>
f_loginadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
f_loginadd.Lists["x_levels"] = {"LinkField":"x_userlevelid","Ajax":null,"AutoFill":false,"DisplayFields":["x_userlevelname","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $p_login_add->ShowPageHeader(); ?>
<?php
$p_login_add->ShowMessage();
?>
<form name="f_loginadd" id="f_loginadd" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="_login">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($_login->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl__loginadd" class="table table-bordered table-striped">
<?php if ($_login->loginname->Visible) { // loginname ?>
	<tr id="r_loginname">
		<td><span id="elh__login_loginname"><?php echo $_login->loginname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $_login->loginname->CellAttributes() ?>>
<?php if ($_login->CurrentAction <> "F") { ?>
<span id="el__login_loginname" class="control-group">
<input type="text" data-field="x_loginname" name="x_loginname" id="x_loginname" size="30" maxlength="255" placeholder="<?php echo $_login->loginname->PlaceHolder ?>" value="<?php echo $_login->loginname->EditValue ?>"<?php echo $_login->loginname->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el__login_loginname" class="control-group">
<span<?php echo $_login->loginname->ViewAttributes() ?>>
<?php echo $_login->loginname->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_loginname" name="x_loginname" id="x_loginname" value="<?php echo ew_HtmlEncode($_login->loginname->FormValue) ?>">
<?php } ?>
<?php echo $_login->loginname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($_login->loginpassword->Visible) { // loginpassword ?>
	<tr id="r_loginpassword">
		<td><span id="elh__login_loginpassword"><?php echo $_login->loginpassword->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $_login->loginpassword->CellAttributes() ?>>
<?php if ($_login->CurrentAction <> "F") { ?>
<span id="el__login_loginpassword" class="control-group">
<input type="password" data-field="x_loginpassword" name="x_loginpassword" id="x_loginpassword" size="30" maxlength="255"<?php echo $_login->loginpassword->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el__login_loginpassword" class="control-group">
<span<?php echo $_login->loginpassword->ViewAttributes() ?>>
<?php echo $_login->loginpassword->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_loginpassword" name="x_loginpassword" id="x_loginpassword" value="<?php echo ew_HtmlEncode($_login->loginpassword->FormValue) ?>">
<?php } ?>
<?php echo $_login->loginpassword->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($_login->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td><span id="elh__login__Email"><?php echo $_login->_Email->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $_login->_Email->CellAttributes() ?>>
<?php if ($_login->CurrentAction <> "F") { ?>
<span id="el__login__Email" class="control-group">
<input type="text" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo $_login->_Email->PlaceHolder ?>" value="<?php echo $_login->_Email->EditValue ?>"<?php echo $_login->_Email->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el__login__Email" class="control-group">
<span<?php echo $_login->_Email->ViewAttributes() ?>>
<?php echo $_login->_Email->ViewValue ?></span>
</span>
<input type="hidden" data-field="x__Email" name="x__Email" id="x__Email" value="<?php echo ew_HtmlEncode($_login->_Email->FormValue) ?>">
<?php } ?>
<?php echo $_login->_Email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($_login->Activated->Visible) { // Activated ?>
	<tr id="r_Activated">
		<td><span id="elh__login_Activated"><?php echo $_login->Activated->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $_login->Activated->CellAttributes() ?>>
<?php if ($_login->CurrentAction <> "F") { ?>
<span id="el__login_Activated" class="control-group">
<input type="text" data-field="x_Activated" name="x_Activated" id="x_Activated" size="30" maxlength="255" placeholder="<?php echo $_login->Activated->PlaceHolder ?>" value="<?php echo $_login->Activated->EditValue ?>"<?php echo $_login->Activated->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el__login_Activated" class="control-group">
<span<?php echo $_login->Activated->ViewAttributes() ?>>
<?php echo $_login->Activated->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_Activated" name="x_Activated" id="x_Activated" value="<?php echo ew_HtmlEncode($_login->Activated->FormValue) ?>">
<?php } ?>
<?php echo $_login->Activated->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($_login->Profile->Visible) { // Profile ?>
	<tr id="r_Profile">
		<td><span id="elh__login_Profile"><?php echo $_login->Profile->FldCaption() ?></span></td>
		<td<?php echo $_login->Profile->CellAttributes() ?>>
<?php if ($_login->CurrentAction <> "F") { ?>
<span id="el__login_Profile" class="control-group">
<textarea data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo $_login->Profile->PlaceHolder ?>"<?php echo $_login->Profile->EditAttributes() ?>><?php echo $_login->Profile->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el__login_Profile" class="control-group">
<span<?php echo $_login->Profile->ViewAttributes() ?>>
<?php echo $_login->Profile->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_Profile" name="x_Profile" id="x_Profile" value="<?php echo ew_HtmlEncode($_login->Profile->FormValue) ?>">
<?php } ?>
<?php echo $_login->Profile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($_login->levels->Visible) { // levels ?>
	<tr id="r_levels">
		<td><span id="elh__login_levels"><?php echo $_login->levels->FldCaption() ?></span></td>
		<td<?php echo $_login->levels->CellAttributes() ?>>
<?php if ($_login->CurrentAction <> "F") { ?>
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<span id="el__login_levels" class="control-group">
<?php echo $_login->levels->EditValue ?>
</span>
<?php } else { ?>
<span id="el__login_levels" class="control-group">
<select data-field="x_levels" id="x_levels" name="x_levels"<?php echo $_login->levels->EditAttributes() ?>>
<?php
if (is_array($_login->levels->EditValue)) {
	$arwrk = $_login->levels->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($_login->levels->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<script type="text/javascript">
f_loginadd.Lists["x_levels"].Options = <?php echo (is_array($_login->levels->EditValue)) ? ew_ArrayToJson($_login->levels->EditValue, 1) : "[]" ?>;
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el__login_levels" class="control-group">
<span<?php echo $_login->levels->ViewAttributes() ?>>
<?php echo $_login->levels->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_levels" name="x_levels" id="x_levels" value="<?php echo ew_HtmlEncode($_login->levels->FormValue) ?>">
<?php } ?>
<?php echo $_login->levels->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<?php if ($_login->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_add.value='F';"><?php echo $Language->Phrase("AddBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_add.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
</form>
<script type="text/javascript">
f_loginadd.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$p_login_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$p_login_add->Page_Terminate();
?>
