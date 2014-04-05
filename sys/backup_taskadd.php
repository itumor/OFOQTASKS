<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "backup_taskinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$backup_task_add = NULL; // Initialize page object first

class cbackup_task_add extends cbackup_task {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'backup_task';

	// Page object name
	var $PageObjName = 'backup_task_add';

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

		// Table object (backup_task)
		if (!isset($GLOBALS["backup_task"])) {
			$GLOBALS["backup_task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["backup_task"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'backup_task', TRUE);

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
			$this->Page_Terminate("backup_tasklist.php");
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
					$this->Page_Terminate("backup_tasklist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "backup_taskview.php")
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
		$this->FILEPATH->Upload->Index = $objForm->Index;
		if ($this->FILEPATH->Upload->UploadFile()) {

			// No action required
		} else {
			echo $this->FILEPATH->Upload->Message;
			$this->Page_Terminate();
			exit();
		}
		$this->FILEPATH->CurrentValue = $this->FILEPATH->Upload->FileName;
	}

	// Load default values
	function LoadDefaultValues() {
		$this->server_id_mysqladmin->CurrentValue = NULL;
		$this->server_id_mysqladmin->OldValue = $this->server_id_mysqladmin->CurrentValue;
		$this->HOSTNAME->CurrentValue = NULL;
		$this->HOSTNAME->OldValue = $this->HOSTNAME->CurrentValue;
		$this->PASSWORD->CurrentValue = NULL;
		$this->PASSWORD->OldValue = $this->PASSWORD->CurrentValue;
		$this->DATABASE->CurrentValue = NULL;
		$this->DATABASE->OldValue = $this->DATABASE->CurrentValue;
		$this->FILEPATH->Upload->DbValue = NULL;
		$this->FILEPATH->OldValue = $this->FILEPATH->Upload->DbValue;
		$this->FILEPATH->CurrentValue = NULL; // Clear file related field
		$this->FILENAME->CurrentValue = NULL;
		$this->FILENAME->OldValue = $this->FILENAME->CurrentValue;
		$this->datetime->CurrentValue = NULL;
		$this->datetime->OldValue = $this->datetime->CurrentValue;
		$this->DBUSERNAME->CurrentValue = NULL;
		$this->DBUSERNAME->OldValue = $this->DBUSERNAME->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->server_id_mysqladmin->FldIsDetailKey) {
			$this->server_id_mysqladmin->setFormValue($objForm->GetValue("x_server_id_mysqladmin"));
		}
		if (!$this->HOSTNAME->FldIsDetailKey) {
			$this->HOSTNAME->setFormValue($objForm->GetValue("x_HOSTNAME"));
		}
		if (!$this->PASSWORD->FldIsDetailKey) {
			$this->PASSWORD->setFormValue($objForm->GetValue("x_PASSWORD"));
		}
		if (!$this->DATABASE->FldIsDetailKey) {
			$this->DATABASE->setFormValue($objForm->GetValue("x_DATABASE"));
		}
		if (!$this->FILENAME->FldIsDetailKey) {
			$this->FILENAME->setFormValue($objForm->GetValue("x_FILENAME"));
		}
		if (!$this->datetime->FldIsDetailKey) {
			$this->datetime->setFormValue($objForm->GetValue("x_datetime"));
			$this->datetime->CurrentValue = ew_UnFormatDateTime($this->datetime->CurrentValue, 0);
		}
		if (!$this->DBUSERNAME->FldIsDetailKey) {
			$this->DBUSERNAME->setFormValue($objForm->GetValue("x_DBUSERNAME"));
		}
		if (!$this->username->FldIsDetailKey) {
			$this->username->setFormValue($objForm->GetValue("x_username"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->server_id_mysqladmin->CurrentValue = $this->server_id_mysqladmin->FormValue;
		$this->HOSTNAME->CurrentValue = $this->HOSTNAME->FormValue;
		$this->PASSWORD->CurrentValue = $this->PASSWORD->FormValue;
		$this->DATABASE->CurrentValue = $this->DATABASE->FormValue;
		$this->FILENAME->CurrentValue = $this->FILENAME->FormValue;
		$this->datetime->CurrentValue = $this->datetime->FormValue;
		$this->datetime->CurrentValue = ew_UnFormatDateTime($this->datetime->CurrentValue, 0);
		$this->DBUSERNAME->CurrentValue = $this->DBUSERNAME->FormValue;
		$this->username->CurrentValue = $this->username->FormValue;
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
		$this->FILEPATH->Upload->DbValue = $rs->fields('FILEPATH');
		$this->FILENAME->setDbValue($rs->fields('FILENAME'));
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
		$this->FILEPATH->Upload->DbValue = $row['FILEPATH'];
		$this->FILENAME->DbValue = $row['FILENAME'];
		$this->datetime->DbValue = $row['datetime'];
		$this->DBUSERNAME->DbValue = $row['DBUSERNAME'];
		$this->username->DbValue = $row['username'];
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
		// PASSWORD
		// DATABASE
		// FILEPATH
		// FILENAME
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
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->HOSTNAME->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `server`";
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

			// FILEPATH
			if (!ew_Empty($this->FILEPATH->Upload->DbValue)) {
				$this->FILEPATH->ViewValue = $this->FILEPATH->Upload->DbValue;
			} else {
				$this->FILEPATH->ViewValue = "";
			}
			$this->FILEPATH->ViewCustomAttributes = "";

			// FILENAME
			$this->FILENAME->ViewValue = $this->FILENAME->CurrentValue;
			$this->FILENAME->ViewCustomAttributes = "";

			// datetime
			$this->datetime->ViewValue = $this->datetime->CurrentValue;
			$this->datetime->ViewCustomAttributes = "";

			// DBUSERNAME
			$this->DBUSERNAME->ViewValue = $this->DBUSERNAME->CurrentValue;
			$this->DBUSERNAME->ViewCustomAttributes = "";

			// username
			$this->username->ViewValue = $this->username->CurrentValue;
			$this->username->ViewCustomAttributes = "";

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

			// FILEPATH
			$this->FILEPATH->LinkCustomAttributes = "";
			$this->FILEPATH->HrefValue = "";
			$this->FILEPATH->HrefValue2 = $this->FILEPATH->UploadPath . $this->FILEPATH->Upload->DbValue;
			$this->FILEPATH->TooltipValue = "";

			// FILENAME
			$this->FILENAME->LinkCustomAttributes = "";
			$this->FILENAME->HrefValue = "";
			$this->FILENAME->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// server_id_mysqladmin
			$this->server_id_mysqladmin->EditCustomAttributes = "";
			if (trim(strval($this->server_id_mysqladmin->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id_mysqladmin->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id_mysqladmin, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->server_id_mysqladmin->EditValue = $arwrk;

			// HOSTNAME
			$this->HOSTNAME->EditCustomAttributes = "";
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->HOSTNAME, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->HOSTNAME->EditValue = $arwrk;

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
			if (!ew_Empty($this->FILEPATH->Upload->DbValue)) {
				$this->FILEPATH->EditValue = $this->FILEPATH->Upload->DbValue;
			} else {
				$this->FILEPATH->EditValue = "";
			}
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->FILEPATH);

			// FILENAME
			$this->FILENAME->EditCustomAttributes = "";
			$this->FILENAME->EditValue = ew_HtmlEncode($this->FILENAME->CurrentValue);
			$this->FILENAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->FILENAME->FldCaption()));

			// datetime
			$this->datetime->EditCustomAttributes = "";
			$this->datetime->EditValue = ew_HtmlEncode($this->datetime->CurrentValue);
			$this->datetime->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->datetime->FldCaption()));

			// DBUSERNAME
			$this->DBUSERNAME->EditCustomAttributes = "";
			$this->DBUSERNAME->EditValue = ew_HtmlEncode($this->DBUSERNAME->CurrentValue);
			$this->DBUSERNAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->DBUSERNAME->FldCaption()));

			// username
			$this->username->EditCustomAttributes = "";
			$this->username->EditValue = ew_HtmlEncode($this->username->CurrentValue);
			$this->username->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->username->FldCaption()));

			// Edit refer script
			// server_id_mysqladmin

			$this->server_id_mysqladmin->HrefValue = "";

			// HOSTNAME
			$this->HOSTNAME->HrefValue = "";

			// PASSWORD
			$this->PASSWORD->HrefValue = "";

			// DATABASE
			$this->DATABASE->HrefValue = "";

			// FILEPATH
			$this->FILEPATH->HrefValue = "";
			$this->FILEPATH->HrefValue2 = $this->FILEPATH->UploadPath . $this->FILEPATH->Upload->DbValue;

			// FILENAME
			$this->FILENAME->HrefValue = "";

			// datetime
			$this->datetime->HrefValue = "";

			// DBUSERNAME
			$this->DBUSERNAME->HrefValue = "";

			// username
			$this->username->HrefValue = "";
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
		if (!$this->PASSWORD->FldIsDetailKey && !is_null($this->PASSWORD->FormValue) && $this->PASSWORD->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->PASSWORD->FldCaption());
		}
		if (!$this->DATABASE->FldIsDetailKey && !is_null($this->DATABASE->FormValue) && $this->DATABASE->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->DATABASE->FldCaption());
		}
		if (is_null($this->FILEPATH->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->FILEPATH->FldCaption());
		}
		if (!$this->FILENAME->FldIsDetailKey && !is_null($this->FILENAME->FormValue) && $this->FILENAME->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->FILENAME->FldCaption());
		}
		if (!$this->datetime->FldIsDetailKey && !is_null($this->datetime->FormValue) && $this->datetime->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->datetime->FldCaption());
		}
		if (!$this->DBUSERNAME->FldIsDetailKey && !is_null($this->DBUSERNAME->FormValue) && $this->DBUSERNAME->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->DBUSERNAME->FldCaption());
		}
		if (!$this->username->FldIsDetailKey && !is_null($this->username->FormValue) && $this->username->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->username->FldCaption());
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

		// PASSWORD
		$this->PASSWORD->SetDbValueDef($rsnew, $this->PASSWORD->CurrentValue, "", FALSE);

		// DATABASE
		$this->DATABASE->SetDbValueDef($rsnew, $this->DATABASE->CurrentValue, "", FALSE);

		// FILEPATH
		if (!$this->FILEPATH->Upload->KeepFile) {
			if ($this->FILEPATH->Upload->FileName == "") {
				$rsnew['FILEPATH'] = NULL;
			} else {
				if ($rsold && $rsold->fields['FILEPATH'] == $this->FILEPATH->Upload->FileName) {
					$this->FILEPATH->Upload->FileName = ew_UniqueFilename($this->FILEPATH->UploadPath, $rsold->fields['FILEPATH']);
					$this->FILEPATH->Upload->DbValue = ""; // No need to delete old file
				}
				$rsnew['FILEPATH'] = $this->FILEPATH->Upload->FileName;
			}
		}

		// FILENAME
		$this->FILENAME->SetDbValueDef($rsnew, $this->FILENAME->CurrentValue, "", FALSE);

		// datetime
		$this->datetime->SetDbValueDef($rsnew, $this->datetime->CurrentValue, ew_CurrentDate(), FALSE);

		// DBUSERNAME
		$this->DBUSERNAME->SetDbValueDef($rsnew, $this->DBUSERNAME->CurrentValue, "", FALSE);

		// username
		$this->username->SetDbValueDef($rsnew, $this->username->CurrentValue, "", FALSE);
		if (!$this->FILEPATH->Upload->KeepFile) {
			if (!ew_Empty($this->FILEPATH->Upload->Value)) {
				if ($this->FILEPATH->Upload->FileName == $this->FILEPATH->Upload->DbValue) { // Overwrite if same file name
					$this->FILEPATH->Upload->DbValue = ""; // No need to delete any more
				} else {
					$rsnew['FILEPATH'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $this->FILEPATH->UploadPath), $rsnew['FILEPATH']); // Get new file name
				}
			}
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
				if (!$this->FILEPATH->Upload->KeepFile) {
					if (!ew_Empty($this->FILEPATH->Upload->Value)) {
						$this->FILEPATH->Upload->SaveToFile($this->FILEPATH->UploadPath, $rsnew['FILEPATH'], TRUE);
					}
					if ($this->FILEPATH->Upload->DbValue <> "")
						@unlink(ew_UploadPathEx(TRUE, $this->FILEPATH->OldUploadPath) . $this->FILEPATH->Upload->DbValue);
				}
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

		// FILEPATH
		ew_CleanUploadTempPath($this->FILEPATH, $this->FILEPATH->Upload->Index);
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "backup_tasklist.php", $this->TableVar);
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
if (!isset($backup_task_add)) $backup_task_add = new cbackup_task_add();

// Page init
$backup_task_add->Page_Init();

// Page main
$backup_task_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$backup_task_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var backup_task_add = new ew_Page("backup_task_add");
backup_task_add.PageID = "add"; // Page ID
var EW_PAGE_ID = backup_task_add.PageID; // For backward compatibility

// Form object
var fbackup_taskadd = new ew_Form("fbackup_taskadd");

// Validate form
fbackup_taskadd.Validate = function() {
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
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->server_id_mysqladmin->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_HOSTNAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->HOSTNAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_PASSWORD");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->PASSWORD->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_DATABASE");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->DATABASE->FldCaption()) ?>");
			felm = this.GetElements("x" + infix + "_FILEPATH");
			elm = this.GetElements("fn_x" + infix + "_FILEPATH");
			if (felm && elm && !ew_HasValue(elm))
				return this.OnError(felm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->FILEPATH->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_FILENAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->FILENAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_datetime");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->datetime->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_DBUSERNAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->DBUSERNAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_username");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($backup_task->username->FldCaption()) ?>");

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
fbackup_taskadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fbackup_taskadd.ValidateRequired = true;
<?php } else { ?>
fbackup_taskadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fbackup_taskadd.Lists["x_server_id_mysqladmin"] = {"LinkField":"x_server_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fbackup_taskadd.Lists["x_HOSTNAME"] = {"LinkField":"x_server_id","Ajax":null,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $backup_task_add->ShowPageHeader(); ?>
<?php
$backup_task_add->ShowMessage();
?>
<form name="fbackup_taskadd" id="fbackup_taskadd" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="backup_task">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_backup_taskadd" class="table table-bordered table-striped">
<?php if ($backup_task->server_id_mysqladmin->Visible) { // server_id_mysqladmin ?>
	<tr id="r_server_id_mysqladmin">
		<td><span id="elh_backup_task_server_id_mysqladmin"><?php echo $backup_task->server_id_mysqladmin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->server_id_mysqladmin->CellAttributes() ?>>
<span id="el_backup_task_server_id_mysqladmin" class="control-group">
<select data-field="x_server_id_mysqladmin" id="x_server_id_mysqladmin" name="x_server_id_mysqladmin"<?php echo $backup_task->server_id_mysqladmin->EditAttributes() ?>>
<?php
if (is_array($backup_task->server_id_mysqladmin->EditValue)) {
	$arwrk = $backup_task->server_id_mysqladmin->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($backup_task->server_id_mysqladmin->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$backup_task->Lookup_Selecting($backup_task->server_id_mysqladmin, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x_server_id_mysqladmin" id="s_x_server_id_mysqladmin" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`server_id` = {filter_value}"); ?>&t0=3">
</span>
<?php echo $backup_task->server_id_mysqladmin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($backup_task->HOSTNAME->Visible) { // HOSTNAME ?>
	<tr id="r_HOSTNAME">
		<td><span id="elh_backup_task_HOSTNAME"><?php echo $backup_task->HOSTNAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->HOSTNAME->CellAttributes() ?>>
<span id="el_backup_task_HOSTNAME" class="control-group">
<select data-field="x_HOSTNAME" id="x_HOSTNAME" name="x_HOSTNAME"<?php echo $backup_task->HOSTNAME->EditAttributes() ?>>
<?php
if (is_array($backup_task->HOSTNAME->EditValue)) {
	$arwrk = $backup_task->HOSTNAME->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($backup_task->HOSTNAME->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
fbackup_taskadd.Lists["x_HOSTNAME"].Options = <?php echo (is_array($backup_task->HOSTNAME->EditValue)) ? ew_ArrayToJson($backup_task->HOSTNAME->EditValue, 1) : "[]" ?>;
</script>
</span>
<?php echo $backup_task->HOSTNAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($backup_task->PASSWORD->Visible) { // PASSWORD ?>
	<tr id="r_PASSWORD">
		<td><span id="elh_backup_task_PASSWORD"><?php echo $backup_task->PASSWORD->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->PASSWORD->CellAttributes() ?>>
<span id="el_backup_task_PASSWORD" class="control-group">
<input type="text" data-field="x_PASSWORD" name="x_PASSWORD" id="x_PASSWORD" size="30" maxlength="255" placeholder="<?php echo $backup_task->PASSWORD->PlaceHolder ?>" value="<?php echo $backup_task->PASSWORD->EditValue ?>"<?php echo $backup_task->PASSWORD->EditAttributes() ?>>
</span>
<?php echo $backup_task->PASSWORD->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($backup_task->DATABASE->Visible) { // DATABASE ?>
	<tr id="r_DATABASE">
		<td><span id="elh_backup_task_DATABASE"><?php echo $backup_task->DATABASE->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->DATABASE->CellAttributes() ?>>
<span id="el_backup_task_DATABASE" class="control-group">
<input type="text" data-field="x_DATABASE" name="x_DATABASE" id="x_DATABASE" size="30" maxlength="255" placeholder="<?php echo $backup_task->DATABASE->PlaceHolder ?>" value="<?php echo $backup_task->DATABASE->EditValue ?>"<?php echo $backup_task->DATABASE->EditAttributes() ?>>
</span>
<?php echo $backup_task->DATABASE->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($backup_task->FILEPATH->Visible) { // FILEPATH ?>
	<tr id="r_FILEPATH">
		<td><span id="elh_backup_task_FILEPATH"><?php echo $backup_task->FILEPATH->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->FILEPATH->CellAttributes() ?>>
<span id="el_backup_task_FILEPATH" class="control-group">
<span id="fd_x_FILEPATH">
<span class="btn btn-small fileinput-button">
	<span><?php echo $Language->Phrase("ChooseFile") ?></span>
	<input type="file" data-field="x_FILEPATH" name="x_FILEPATH" id="x_FILEPATH">
</span>
<input type="hidden" name="fn_x_FILEPATH" id= "fn_x_FILEPATH" value="<?php echo $backup_task->FILEPATH->Upload->FileName ?>">
<input type="hidden" name="fa_x_FILEPATH" id= "fa_x_FILEPATH" value="0">
<input type="hidden" name="fs_x_FILEPATH" id= "fs_x_FILEPATH" value="255">
</span>
<table id="ft_x_FILEPATH" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $backup_task->FILEPATH->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($backup_task->FILENAME->Visible) { // FILENAME ?>
	<tr id="r_FILENAME">
		<td><span id="elh_backup_task_FILENAME"><?php echo $backup_task->FILENAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->FILENAME->CellAttributes() ?>>
<span id="el_backup_task_FILENAME" class="control-group">
<input type="text" data-field="x_FILENAME" name="x_FILENAME" id="x_FILENAME" size="30" maxlength="255" placeholder="<?php echo $backup_task->FILENAME->PlaceHolder ?>" value="<?php echo $backup_task->FILENAME->EditValue ?>"<?php echo $backup_task->FILENAME->EditAttributes() ?>>
</span>
<?php echo $backup_task->FILENAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($backup_task->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td><span id="elh_backup_task_datetime"><?php echo $backup_task->datetime->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->datetime->CellAttributes() ?>>
<span id="el_backup_task_datetime" class="control-group">
<input type="text" data-field="x_datetime" name="x_datetime" id="x_datetime" placeholder="<?php echo $backup_task->datetime->PlaceHolder ?>" value="<?php echo $backup_task->datetime->EditValue ?>"<?php echo $backup_task->datetime->EditAttributes() ?>>
</span>
<?php echo $backup_task->datetime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($backup_task->DBUSERNAME->Visible) { // DBUSERNAME ?>
	<tr id="r_DBUSERNAME">
		<td><span id="elh_backup_task_DBUSERNAME"><?php echo $backup_task->DBUSERNAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->DBUSERNAME->CellAttributes() ?>>
<span id="el_backup_task_DBUSERNAME" class="control-group">
<input type="text" data-field="x_DBUSERNAME" name="x_DBUSERNAME" id="x_DBUSERNAME" size="30" maxlength="255" placeholder="<?php echo $backup_task->DBUSERNAME->PlaceHolder ?>" value="<?php echo $backup_task->DBUSERNAME->EditValue ?>"<?php echo $backup_task->DBUSERNAME->EditAttributes() ?>>
</span>
<?php echo $backup_task->DBUSERNAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($backup_task->username->Visible) { // username ?>
	<tr id="r_username">
		<td><span id="elh_backup_task_username"><?php echo $backup_task->username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $backup_task->username->CellAttributes() ?>>
<span id="el_backup_task_username" class="control-group">
<input type="text" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="255" placeholder="<?php echo $backup_task->username->PlaceHolder ?>" value="<?php echo $backup_task->username->EditValue ?>"<?php echo $backup_task->username->EditAttributes() ?>>
</span>
<?php echo $backup_task->username->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
</form>
<script type="text/javascript">
fbackup_taskadd.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$backup_task_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$backup_task_add->Page_Terminate();
?>
