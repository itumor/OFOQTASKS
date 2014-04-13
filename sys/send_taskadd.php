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

$send_task_add = NULL; // Initialize page object first

class csend_task_add extends csend_task {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'send_task';

	// Page object name
	var $PageObjName = 'send_task_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("send_tasklist.php");
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
					$this->Page_Terminate("send_tasklist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "send_taskview.php")
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
		$this->server_id_sendreceive->CurrentValue = NULL;
		$this->server_id_sendreceive->OldValue = $this->server_id_sendreceive->CurrentValue;
		$this->TARGET_FILENAME->CurrentValue = NULL;
		$this->TARGET_FILENAME->OldValue = $this->TARGET_FILENAME->CurrentValue;
		$this->LOCAL_PATH->CurrentValue = NULL;
		$this->LOCAL_PATH->OldValue = $this->LOCAL_PATH->CurrentValue;
		$this->REMOTE_IPAND1STLVL->CurrentValue = NULL;
		$this->REMOTE_IPAND1STLVL->OldValue = $this->REMOTE_IPAND1STLVL->CurrentValue;
		$this->REMOTE_REMAIN_PATH->CurrentValue = NULL;
		$this->REMOTE_REMAIN_PATH->OldValue = $this->REMOTE_REMAIN_PATH->CurrentValue;
		$this->REMOTE_USERNAME->CurrentValue = NULL;
		$this->REMOTE_USERNAME->OldValue = $this->REMOTE_USERNAME->CurrentValue;
		$this->REMOTE_PASSWORD->CurrentValue = NULL;
		$this->REMOTE_PASSWORD->OldValue = $this->REMOTE_PASSWORD->CurrentValue;
		$this->REMOTE_DOMAIN->CurrentValue = NULL;
		$this->REMOTE_DOMAIN->OldValue = $this->REMOTE_DOMAIN->CurrentValue;
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
		if (!$this->server_id_sendreceive->FldIsDetailKey) {
			$this->server_id_sendreceive->setFormValue($objForm->GetValue("x_server_id_sendreceive"));
		}
		if (!$this->TARGET_FILENAME->FldIsDetailKey) {
			$this->TARGET_FILENAME->setFormValue($objForm->GetValue("x_TARGET_FILENAME"));
		}
		if (!$this->LOCAL_PATH->FldIsDetailKey) {
			$this->LOCAL_PATH->setFormValue($objForm->GetValue("x_LOCAL_PATH"));
		}
		if (!$this->REMOTE_IPAND1STLVL->FldIsDetailKey) {
			$this->REMOTE_IPAND1STLVL->setFormValue($objForm->GetValue("x_REMOTE_IPAND1STLVL"));
		}
		if (!$this->REMOTE_REMAIN_PATH->FldIsDetailKey) {
			$this->REMOTE_REMAIN_PATH->setFormValue($objForm->GetValue("x_REMOTE_REMAIN_PATH"));
		}
		if (!$this->REMOTE_USERNAME->FldIsDetailKey) {
			$this->REMOTE_USERNAME->setFormValue($objForm->GetValue("x_REMOTE_USERNAME"));
		}
		if (!$this->REMOTE_PASSWORD->FldIsDetailKey) {
			$this->REMOTE_PASSWORD->setFormValue($objForm->GetValue("x_REMOTE_PASSWORD"));
		}
		if (!$this->REMOTE_DOMAIN->FldIsDetailKey) {
			$this->REMOTE_DOMAIN->setFormValue($objForm->GetValue("x_REMOTE_DOMAIN"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->username->CurrentValue = $this->username->FormValue;
		$this->datetime->CurrentValue = $this->datetime->FormValue;
		$this->datetime->CurrentValue = ew_UnFormatDateTime($this->datetime->CurrentValue, 0);
		$this->server_id_sendreceive->CurrentValue = $this->server_id_sendreceive->FormValue;
		$this->TARGET_FILENAME->CurrentValue = $this->TARGET_FILENAME->FormValue;
		$this->LOCAL_PATH->CurrentValue = $this->LOCAL_PATH->FormValue;
		$this->REMOTE_IPAND1STLVL->CurrentValue = $this->REMOTE_IPAND1STLVL->FormValue;
		$this->REMOTE_REMAIN_PATH->CurrentValue = $this->REMOTE_REMAIN_PATH->FormValue;
		$this->REMOTE_USERNAME->CurrentValue = $this->REMOTE_USERNAME->FormValue;
		$this->REMOTE_PASSWORD->CurrentValue = $this->REMOTE_PASSWORD->FormValue;
		$this->REMOTE_DOMAIN->CurrentValue = $this->REMOTE_DOMAIN->FormValue;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// username
			// datetime
			// server_id_sendreceive

			$this->server_id_sendreceive->EditCustomAttributes = "";
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id_sendreceive, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->server_id_sendreceive->EditValue = $arwrk;

			// TARGET_FILENAME
			$this->TARGET_FILENAME->EditCustomAttributes = "";
			$this->TARGET_FILENAME->EditValue = ew_HtmlEncode($this->TARGET_FILENAME->CurrentValue);
			$this->TARGET_FILENAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->TARGET_FILENAME->FldCaption()));

			// LOCAL_PATH
			$this->LOCAL_PATH->EditCustomAttributes = "";
			$this->LOCAL_PATH->EditValue = ew_HtmlEncode($this->LOCAL_PATH->CurrentValue);
			$this->LOCAL_PATH->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->LOCAL_PATH->FldCaption()));

			// REMOTE_IPAND1STLVL
			$this->REMOTE_IPAND1STLVL->EditCustomAttributes = "";
			$this->REMOTE_IPAND1STLVL->EditValue = ew_HtmlEncode($this->REMOTE_IPAND1STLVL->CurrentValue);
			$this->REMOTE_IPAND1STLVL->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->REMOTE_IPAND1STLVL->FldCaption()));

			// REMOTE_REMAIN_PATH
			$this->REMOTE_REMAIN_PATH->EditCustomAttributes = "";
			$this->REMOTE_REMAIN_PATH->EditValue = ew_HtmlEncode($this->REMOTE_REMAIN_PATH->CurrentValue);
			$this->REMOTE_REMAIN_PATH->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->REMOTE_REMAIN_PATH->FldCaption()));

			// REMOTE_USERNAME
			$this->REMOTE_USERNAME->EditCustomAttributes = "";
			$this->REMOTE_USERNAME->EditValue = ew_HtmlEncode($this->REMOTE_USERNAME->CurrentValue);
			$this->REMOTE_USERNAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->REMOTE_USERNAME->FldCaption()));

			// REMOTE_PASSWORD
			$this->REMOTE_PASSWORD->EditCustomAttributes = "";
			$this->REMOTE_PASSWORD->EditValue = ew_HtmlEncode($this->REMOTE_PASSWORD->CurrentValue);
			$this->REMOTE_PASSWORD->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->REMOTE_PASSWORD->FldCaption()));

			// REMOTE_DOMAIN
			$this->REMOTE_DOMAIN->EditCustomAttributes = "";
			$this->REMOTE_DOMAIN->EditValue = ew_HtmlEncode($this->REMOTE_DOMAIN->CurrentValue);
			$this->REMOTE_DOMAIN->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->REMOTE_DOMAIN->FldCaption()));

			// Edit refer script
			// username

			$this->username->HrefValue = "";

			// datetime
			$this->datetime->HrefValue = "";

			// server_id_sendreceive
			$this->server_id_sendreceive->HrefValue = "";

			// TARGET_FILENAME
			$this->TARGET_FILENAME->HrefValue = "";

			// LOCAL_PATH
			$this->LOCAL_PATH->HrefValue = "";

			// REMOTE_IPAND1STLVL
			$this->REMOTE_IPAND1STLVL->HrefValue = "";

			// REMOTE_REMAIN_PATH
			$this->REMOTE_REMAIN_PATH->HrefValue = "";

			// REMOTE_USERNAME
			$this->REMOTE_USERNAME->HrefValue = "";

			// REMOTE_PASSWORD
			$this->REMOTE_PASSWORD->HrefValue = "";

			// REMOTE_DOMAIN
			$this->REMOTE_DOMAIN->HrefValue = "";
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
		if (!$this->server_id_sendreceive->FldIsDetailKey && !is_null($this->server_id_sendreceive->FormValue) && $this->server_id_sendreceive->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_id_sendreceive->FldCaption());
		}
		if (!$this->TARGET_FILENAME->FldIsDetailKey && !is_null($this->TARGET_FILENAME->FormValue) && $this->TARGET_FILENAME->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->TARGET_FILENAME->FldCaption());
		}
		if (!$this->LOCAL_PATH->FldIsDetailKey && !is_null($this->LOCAL_PATH->FormValue) && $this->LOCAL_PATH->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->LOCAL_PATH->FldCaption());
		}
		if (!$this->REMOTE_IPAND1STLVL->FldIsDetailKey && !is_null($this->REMOTE_IPAND1STLVL->FormValue) && $this->REMOTE_IPAND1STLVL->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->REMOTE_IPAND1STLVL->FldCaption());
		}
		if (!$this->REMOTE_REMAIN_PATH->FldIsDetailKey && !is_null($this->REMOTE_REMAIN_PATH->FormValue) && $this->REMOTE_REMAIN_PATH->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->REMOTE_REMAIN_PATH->FldCaption());
		}
		if (!$this->REMOTE_USERNAME->FldIsDetailKey && !is_null($this->REMOTE_USERNAME->FormValue) && $this->REMOTE_USERNAME->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->REMOTE_USERNAME->FldCaption());
		}
		if (!$this->REMOTE_PASSWORD->FldIsDetailKey && !is_null($this->REMOTE_PASSWORD->FormValue) && $this->REMOTE_PASSWORD->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->REMOTE_PASSWORD->FldCaption());
		}
		if (!$this->REMOTE_DOMAIN->FldIsDetailKey && !is_null($this->REMOTE_DOMAIN->FormValue) && $this->REMOTE_DOMAIN->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->REMOTE_DOMAIN->FldCaption());
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

		// server_id_sendreceive
		$this->server_id_sendreceive->SetDbValueDef($rsnew, $this->server_id_sendreceive->CurrentValue, "", FALSE);

		// TARGET_FILENAME
		$this->TARGET_FILENAME->SetDbValueDef($rsnew, $this->TARGET_FILENAME->CurrentValue, "", FALSE);

		// LOCAL_PATH
		$this->LOCAL_PATH->SetDbValueDef($rsnew, $this->LOCAL_PATH->CurrentValue, "", FALSE);

		// REMOTE_IPAND1STLVL
		$this->REMOTE_IPAND1STLVL->SetDbValueDef($rsnew, $this->REMOTE_IPAND1STLVL->CurrentValue, "", FALSE);

		// REMOTE_REMAIN_PATH
		$this->REMOTE_REMAIN_PATH->SetDbValueDef($rsnew, $this->REMOTE_REMAIN_PATH->CurrentValue, "", FALSE);

		// REMOTE_USERNAME
		$this->REMOTE_USERNAME->SetDbValueDef($rsnew, $this->REMOTE_USERNAME->CurrentValue, "", FALSE);

		// REMOTE_PASSWORD
		$this->REMOTE_PASSWORD->SetDbValueDef($rsnew, $this->REMOTE_PASSWORD->CurrentValue, "", FALSE);

		// REMOTE_DOMAIN
		$this->REMOTE_DOMAIN->SetDbValueDef($rsnew, $this->REMOTE_DOMAIN->CurrentValue, "", FALSE);

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
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "send_tasklist.php", $this->TableVar);
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
if (!isset($send_task_add)) $send_task_add = new csend_task_add();

// Page init
$send_task_add->Page_Init();

// Page main
$send_task_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$send_task_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var send_task_add = new ew_Page("send_task_add");
send_task_add.PageID = "add"; // Page ID
var EW_PAGE_ID = send_task_add.PageID; // For backward compatibility

// Form object
var fsend_taskadd = new ew_Form("fsend_taskadd");

// Validate form
fsend_taskadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_server_id_sendreceive");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($send_task->server_id_sendreceive->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_TARGET_FILENAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($send_task->TARGET_FILENAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_LOCAL_PATH");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($send_task->LOCAL_PATH->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_REMOTE_IPAND1STLVL");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($send_task->REMOTE_IPAND1STLVL->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_REMOTE_REMAIN_PATH");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($send_task->REMOTE_REMAIN_PATH->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_REMOTE_USERNAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($send_task->REMOTE_USERNAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_REMOTE_PASSWORD");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($send_task->REMOTE_PASSWORD->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_REMOTE_DOMAIN");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($send_task->REMOTE_DOMAIN->FldCaption()) ?>");

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
fsend_taskadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fsend_taskadd.ValidateRequired = true;
<?php } else { ?>
fsend_taskadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fsend_taskadd.Lists["x_server_id_sendreceive"] = {"LinkField":"x_server_id","Ajax":null,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $send_task_add->ShowPageHeader(); ?>
<?php
$send_task_add->ShowMessage();
?>
<form name="fsend_taskadd" id="fsend_taskadd" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="send_task">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_send_taskadd" class="table table-bordered table-striped">
<?php if ($send_task->server_id_sendreceive->Visible) { // server_id_sendreceive ?>
	<tr id="r_server_id_sendreceive">
		<td><span id="elh_send_task_server_id_sendreceive"><?php echo $send_task->server_id_sendreceive->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $send_task->server_id_sendreceive->CellAttributes() ?>>
<span id="el_send_task_server_id_sendreceive" class="control-group">
<select data-field="x_server_id_sendreceive" id="x_server_id_sendreceive" name="x_server_id_sendreceive"<?php echo $send_task->server_id_sendreceive->EditAttributes() ?>>
<?php
if (is_array($send_task->server_id_sendreceive->EditValue)) {
	$arwrk = $send_task->server_id_sendreceive->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($send_task->server_id_sendreceive->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
fsend_taskadd.Lists["x_server_id_sendreceive"].Options = <?php echo (is_array($send_task->server_id_sendreceive->EditValue)) ? ew_ArrayToJson($send_task->server_id_sendreceive->EditValue, 1) : "[]" ?>;
</script>
</span>
<?php echo $send_task->server_id_sendreceive->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($send_task->TARGET_FILENAME->Visible) { // TARGET_FILENAME ?>
	<tr id="r_TARGET_FILENAME">
		<td><span id="elh_send_task_TARGET_FILENAME"><?php echo $send_task->TARGET_FILENAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $send_task->TARGET_FILENAME->CellAttributes() ?>>
<span id="el_send_task_TARGET_FILENAME" class="control-group">
<input type="text" data-field="x_TARGET_FILENAME" name="x_TARGET_FILENAME" id="x_TARGET_FILENAME" size="30" maxlength="255" placeholder="<?php echo $send_task->TARGET_FILENAME->PlaceHolder ?>" value="<?php echo $send_task->TARGET_FILENAME->EditValue ?>"<?php echo $send_task->TARGET_FILENAME->EditAttributes() ?>>
</span>
<?php echo $send_task->TARGET_FILENAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($send_task->LOCAL_PATH->Visible) { // LOCAL_PATH ?>
	<tr id="r_LOCAL_PATH">
		<td><span id="elh_send_task_LOCAL_PATH"><?php echo $send_task->LOCAL_PATH->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $send_task->LOCAL_PATH->CellAttributes() ?>>
<span id="el_send_task_LOCAL_PATH" class="control-group">
<input type="text" data-field="x_LOCAL_PATH" name="x_LOCAL_PATH" id="x_LOCAL_PATH" size="30" maxlength="255" placeholder="<?php echo $send_task->LOCAL_PATH->PlaceHolder ?>" value="<?php echo $send_task->LOCAL_PATH->EditValue ?>"<?php echo $send_task->LOCAL_PATH->EditAttributes() ?>>
</span>
<?php echo $send_task->LOCAL_PATH->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($send_task->REMOTE_IPAND1STLVL->Visible) { // REMOTE_IPAND1STLVL ?>
	<tr id="r_REMOTE_IPAND1STLVL">
		<td><span id="elh_send_task_REMOTE_IPAND1STLVL"><?php echo $send_task->REMOTE_IPAND1STLVL->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $send_task->REMOTE_IPAND1STLVL->CellAttributes() ?>>
<span id="el_send_task_REMOTE_IPAND1STLVL" class="control-group">
<input type="text" data-field="x_REMOTE_IPAND1STLVL" name="x_REMOTE_IPAND1STLVL" id="x_REMOTE_IPAND1STLVL" size="30" maxlength="255" placeholder="<?php echo $send_task->REMOTE_IPAND1STLVL->PlaceHolder ?>" value="<?php echo $send_task->REMOTE_IPAND1STLVL->EditValue ?>"<?php echo $send_task->REMOTE_IPAND1STLVL->EditAttributes() ?>>
</span>
<?php echo $send_task->REMOTE_IPAND1STLVL->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($send_task->REMOTE_REMAIN_PATH->Visible) { // REMOTE_REMAIN_PATH ?>
	<tr id="r_REMOTE_REMAIN_PATH">
		<td><span id="elh_send_task_REMOTE_REMAIN_PATH"><?php echo $send_task->REMOTE_REMAIN_PATH->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $send_task->REMOTE_REMAIN_PATH->CellAttributes() ?>>
<span id="el_send_task_REMOTE_REMAIN_PATH" class="control-group">
<input type="text" data-field="x_REMOTE_REMAIN_PATH" name="x_REMOTE_REMAIN_PATH" id="x_REMOTE_REMAIN_PATH" size="30" maxlength="255" placeholder="<?php echo $send_task->REMOTE_REMAIN_PATH->PlaceHolder ?>" value="<?php echo $send_task->REMOTE_REMAIN_PATH->EditValue ?>"<?php echo $send_task->REMOTE_REMAIN_PATH->EditAttributes() ?>>
</span>
<?php echo $send_task->REMOTE_REMAIN_PATH->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($send_task->REMOTE_USERNAME->Visible) { // REMOTE_USERNAME ?>
	<tr id="r_REMOTE_USERNAME">
		<td><span id="elh_send_task_REMOTE_USERNAME"><?php echo $send_task->REMOTE_USERNAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $send_task->REMOTE_USERNAME->CellAttributes() ?>>
<span id="el_send_task_REMOTE_USERNAME" class="control-group">
<input type="text" data-field="x_REMOTE_USERNAME" name="x_REMOTE_USERNAME" id="x_REMOTE_USERNAME" size="30" maxlength="255" placeholder="<?php echo $send_task->REMOTE_USERNAME->PlaceHolder ?>" value="<?php echo $send_task->REMOTE_USERNAME->EditValue ?>"<?php echo $send_task->REMOTE_USERNAME->EditAttributes() ?>>
</span>
<?php echo $send_task->REMOTE_USERNAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($send_task->REMOTE_PASSWORD->Visible) { // REMOTE_PASSWORD ?>
	<tr id="r_REMOTE_PASSWORD">
		<td><span id="elh_send_task_REMOTE_PASSWORD"><?php echo $send_task->REMOTE_PASSWORD->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $send_task->REMOTE_PASSWORD->CellAttributes() ?>>
<span id="el_send_task_REMOTE_PASSWORD" class="control-group">
<input type="text" data-field="x_REMOTE_PASSWORD" name="x_REMOTE_PASSWORD" id="x_REMOTE_PASSWORD" size="30" maxlength="255" placeholder="<?php echo $send_task->REMOTE_PASSWORD->PlaceHolder ?>" value="<?php echo $send_task->REMOTE_PASSWORD->EditValue ?>"<?php echo $send_task->REMOTE_PASSWORD->EditAttributes() ?>>
</span>
<?php echo $send_task->REMOTE_PASSWORD->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($send_task->REMOTE_DOMAIN->Visible) { // REMOTE_DOMAIN ?>
	<tr id="r_REMOTE_DOMAIN">
		<td><span id="elh_send_task_REMOTE_DOMAIN"><?php echo $send_task->REMOTE_DOMAIN->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $send_task->REMOTE_DOMAIN->CellAttributes() ?>>
<span id="el_send_task_REMOTE_DOMAIN" class="control-group">
<input type="text" data-field="x_REMOTE_DOMAIN" name="x_REMOTE_DOMAIN" id="x_REMOTE_DOMAIN" size="30" maxlength="255" placeholder="<?php echo $send_task->REMOTE_DOMAIN->PlaceHolder ?>" value="<?php echo $send_task->REMOTE_DOMAIN->EditValue ?>"<?php echo $send_task->REMOTE_DOMAIN->EditAttributes() ?>>
</span>
<?php echo $send_task->REMOTE_DOMAIN->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
</form>
<script type="text/javascript">
fsend_taskadd.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$send_task_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$send_task_add->Page_Terminate();
?>
