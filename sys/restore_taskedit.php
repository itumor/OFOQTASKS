<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "restore_taskinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$restore_task_edit = NULL; // Initialize page object first

class crestore_task_edit extends crestore_task {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'restore_task';

	// Page object name
	var $PageObjName = 'restore_task_edit';

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

		// Table object (restore_task)
		if (!isset($GLOBALS["restore_task"])) {
			$GLOBALS["restore_task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["restore_task"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'restore_task', TRUE);

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
			$this->Page_Terminate("restore_tasklist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();
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
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
			$this->RecKey["id"] = $this->id->QueryStringValue;
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
			$this->Page_Terminate("restore_tasklist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->id->CurrentValue) == strval($this->Recordset->fields('id'))) {
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
					$this->Page_Terminate("restore_tasklist.php"); // Return to list page
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
					if (ew_GetPageName($sReturnUrl) == "restore_taskview.php")
						$sReturnUrl = $this->GetViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
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
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
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
		if (!$this->FILEPATH->FldIsDetailKey) {
			$this->FILEPATH->setFormValue($objForm->GetValue("x_FILEPATH"));
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
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->server_id_mysqladmin->CurrentValue = $this->server_id_mysqladmin->FormValue;
		$this->HOSTNAME->CurrentValue = $this->HOSTNAME->FormValue;
		$this->PASSWORD->CurrentValue = $this->PASSWORD->FormValue;
		$this->DATABASE->CurrentValue = $this->DATABASE->FormValue;
		$this->FILEPATH->CurrentValue = $this->FILEPATH->FormValue;
		$this->FILENAME->CurrentValue = $this->FILENAME->FormValue;
		$this->datetime->CurrentValue = $this->datetime->FormValue;
		$this->datetime->CurrentValue = ew_UnFormatDateTime($this->datetime->CurrentValue, 0);
		$this->DBUSERNAME->CurrentValue = $this->DBUSERNAME->FormValue;
		$this->username->CurrentValue = $this->username->FormValue;
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
		$this->id->setDbValue($rs->fields('id'));
		$this->server_id_mysqladmin->setDbValue($rs->fields('server_id_mysqladmin'));
		$this->HOSTNAME->setDbValue($rs->fields('HOSTNAME'));
		$this->PASSWORD->setDbValue($rs->fields('PASSWORD'));
		$this->DATABASE->setDbValue($rs->fields('DATABASE'));
		$this->FILEPATH->setDbValue($rs->fields('FILEPATH'));
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
		$this->FILEPATH->DbValue = $row['FILEPATH'];
		$this->FILENAME->DbValue = $row['FILENAME'];
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
			$this->server_id_mysqladmin->ViewValue = $this->server_id_mysqladmin->CurrentValue;
			$this->server_id_mysqladmin->ViewCustomAttributes = "";

			// HOSTNAME
			$this->HOSTNAME->ViewValue = $this->HOSTNAME->CurrentValue;
			$this->HOSTNAME->ViewCustomAttributes = "";

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

			// FILEPATH
			$this->FILEPATH->LinkCustomAttributes = "";
			$this->FILEPATH->HrefValue = "";
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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// server_id_mysqladmin
			$this->server_id_mysqladmin->EditCustomAttributes = "";
			$this->server_id_mysqladmin->EditValue = ew_HtmlEncode($this->server_id_mysqladmin->CurrentValue);
			$this->server_id_mysqladmin->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_id_mysqladmin->FldCaption()));

			// HOSTNAME
			$this->HOSTNAME->EditCustomAttributes = "";
			$this->HOSTNAME->EditValue = ew_HtmlEncode($this->HOSTNAME->CurrentValue);
			$this->HOSTNAME->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->HOSTNAME->FldCaption()));

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
			// id

			$this->id->HrefValue = "";

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
		if (!$this->FILEPATH->FldIsDetailKey && !is_null($this->FILEPATH->FormValue) && $this->FILEPATH->FormValue == "") {
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();
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

			// server_id_mysqladmin
			$this->server_id_mysqladmin->SetDbValueDef($rsnew, $this->server_id_mysqladmin->CurrentValue, "", $this->server_id_mysqladmin->ReadOnly);

			// HOSTNAME
			$this->HOSTNAME->SetDbValueDef($rsnew, $this->HOSTNAME->CurrentValue, "", $this->HOSTNAME->ReadOnly);

			// PASSWORD
			$this->PASSWORD->SetDbValueDef($rsnew, $this->PASSWORD->CurrentValue, "", $this->PASSWORD->ReadOnly);

			// DATABASE
			$this->DATABASE->SetDbValueDef($rsnew, $this->DATABASE->CurrentValue, "", $this->DATABASE->ReadOnly);

			// FILEPATH
			$this->FILEPATH->SetDbValueDef($rsnew, $this->FILEPATH->CurrentValue, "", $this->FILEPATH->ReadOnly);

			// FILENAME
			$this->FILENAME->SetDbValueDef($rsnew, $this->FILENAME->CurrentValue, "", $this->FILENAME->ReadOnly);

			// datetime
			$this->datetime->SetDbValueDef($rsnew, $this->datetime->CurrentValue, ew_CurrentDate(), $this->datetime->ReadOnly);

			// DBUSERNAME
			$this->DBUSERNAME->SetDbValueDef($rsnew, $this->DBUSERNAME->CurrentValue, "", $this->DBUSERNAME->ReadOnly);

			// username
			$this->username->SetDbValueDef($rsnew, $this->username->CurrentValue, "", $this->username->ReadOnly);

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
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "restore_tasklist.php", $this->TableVar);
		$PageCaption = $Language->Phrase("edit");
		$Breadcrumb->Add("edit", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
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
if (!isset($restore_task_edit)) $restore_task_edit = new crestore_task_edit();

// Page init
$restore_task_edit->Page_Init();

// Page main
$restore_task_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$restore_task_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var restore_task_edit = new ew_Page("restore_task_edit");
restore_task_edit.PageID = "edit"; // Page ID
var EW_PAGE_ID = restore_task_edit.PageID; // For backward compatibility

// Form object
var frestore_taskedit = new ew_Form("frestore_taskedit");

// Validate form
frestore_taskedit.Validate = function() {
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
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->server_id_mysqladmin->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_HOSTNAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->HOSTNAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_PASSWORD");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->PASSWORD->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_DATABASE");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->DATABASE->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_FILEPATH");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->FILEPATH->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_FILENAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->FILENAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_datetime");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->datetime->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_DBUSERNAME");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->DBUSERNAME->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_username");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($restore_task->username->FldCaption()) ?>");

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
frestore_taskedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
frestore_taskedit.ValidateRequired = true;
<?php } else { ?>
frestore_taskedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $restore_task_edit->ShowPageHeader(); ?>
<?php
$restore_task_edit->ShowMessage();
?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($restore_task_edit->Pager)) $restore_task_edit->Pager = new cNumericPager($restore_task_edit->StartRec, $restore_task_edit->DisplayRecs, $restore_task_edit->TotalRecs, $restore_task_edit->RecRange) ?>
<?php if ($restore_task_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($restore_task_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $restore_task_edit->PageUrl() ?>start=<?php echo $restore_task_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($restore_task_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $restore_task_edit->PageUrl() ?>start=<?php echo $restore_task_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($restore_task_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $restore_task_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($restore_task_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $restore_task_edit->PageUrl() ?>start=<?php echo $restore_task_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($restore_task_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $restore_task_edit->PageUrl() ?>start=<?php echo $restore_task_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
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
<form name="frestore_taskedit" id="frestore_taskedit" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="restore_task">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_restore_taskedit" class="table table-bordered table-striped">
<?php if ($restore_task->id->Visible) { // id ?>
	<tr id="r_id">
		<td><span id="elh_restore_task_id"><?php echo $restore_task->id->FldCaption() ?></span></td>
		<td<?php echo $restore_task->id->CellAttributes() ?>>
<span id="el_restore_task_id" class="control-group">
<span<?php echo $restore_task->id->ViewAttributes() ?>>
<?php echo $restore_task->id->EditValue ?></span>
</span>
<input type="hidden" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($restore_task->id->CurrentValue) ?>">
<?php echo $restore_task->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->server_id_mysqladmin->Visible) { // server_id_mysqladmin ?>
	<tr id="r_server_id_mysqladmin">
		<td><span id="elh_restore_task_server_id_mysqladmin"><?php echo $restore_task->server_id_mysqladmin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->server_id_mysqladmin->CellAttributes() ?>>
<span id="el_restore_task_server_id_mysqladmin" class="control-group">
<input type="text" data-field="x_server_id_mysqladmin" name="x_server_id_mysqladmin" id="x_server_id_mysqladmin" size="30" maxlength="255" placeholder="<?php echo $restore_task->server_id_mysqladmin->PlaceHolder ?>" value="<?php echo $restore_task->server_id_mysqladmin->EditValue ?>"<?php echo $restore_task->server_id_mysqladmin->EditAttributes() ?>>
</span>
<?php echo $restore_task->server_id_mysqladmin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->HOSTNAME->Visible) { // HOSTNAME ?>
	<tr id="r_HOSTNAME">
		<td><span id="elh_restore_task_HOSTNAME"><?php echo $restore_task->HOSTNAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->HOSTNAME->CellAttributes() ?>>
<span id="el_restore_task_HOSTNAME" class="control-group">
<input type="text" data-field="x_HOSTNAME" name="x_HOSTNAME" id="x_HOSTNAME" size="30" maxlength="255" placeholder="<?php echo $restore_task->HOSTNAME->PlaceHolder ?>" value="<?php echo $restore_task->HOSTNAME->EditValue ?>"<?php echo $restore_task->HOSTNAME->EditAttributes() ?>>
</span>
<?php echo $restore_task->HOSTNAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->PASSWORD->Visible) { // PASSWORD ?>
	<tr id="r_PASSWORD">
		<td><span id="elh_restore_task_PASSWORD"><?php echo $restore_task->PASSWORD->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->PASSWORD->CellAttributes() ?>>
<span id="el_restore_task_PASSWORD" class="control-group">
<input type="text" data-field="x_PASSWORD" name="x_PASSWORD" id="x_PASSWORD" size="30" maxlength="255" placeholder="<?php echo $restore_task->PASSWORD->PlaceHolder ?>" value="<?php echo $restore_task->PASSWORD->EditValue ?>"<?php echo $restore_task->PASSWORD->EditAttributes() ?>>
</span>
<?php echo $restore_task->PASSWORD->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->DATABASE->Visible) { // DATABASE ?>
	<tr id="r_DATABASE">
		<td><span id="elh_restore_task_DATABASE"><?php echo $restore_task->DATABASE->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->DATABASE->CellAttributes() ?>>
<span id="el_restore_task_DATABASE" class="control-group">
<input type="text" data-field="x_DATABASE" name="x_DATABASE" id="x_DATABASE" size="30" maxlength="255" placeholder="<?php echo $restore_task->DATABASE->PlaceHolder ?>" value="<?php echo $restore_task->DATABASE->EditValue ?>"<?php echo $restore_task->DATABASE->EditAttributes() ?>>
</span>
<?php echo $restore_task->DATABASE->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->FILEPATH->Visible) { // FILEPATH ?>
	<tr id="r_FILEPATH">
		<td><span id="elh_restore_task_FILEPATH"><?php echo $restore_task->FILEPATH->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->FILEPATH->CellAttributes() ?>>
<span id="el_restore_task_FILEPATH" class="control-group">
<input type="text" data-field="x_FILEPATH" name="x_FILEPATH" id="x_FILEPATH" size="30" maxlength="255" placeholder="<?php echo $restore_task->FILEPATH->PlaceHolder ?>" value="<?php echo $restore_task->FILEPATH->EditValue ?>"<?php echo $restore_task->FILEPATH->EditAttributes() ?>>
</span>
<?php echo $restore_task->FILEPATH->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->FILENAME->Visible) { // FILENAME ?>
	<tr id="r_FILENAME">
		<td><span id="elh_restore_task_FILENAME"><?php echo $restore_task->FILENAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->FILENAME->CellAttributes() ?>>
<span id="el_restore_task_FILENAME" class="control-group">
<input type="text" data-field="x_FILENAME" name="x_FILENAME" id="x_FILENAME" size="30" maxlength="255" placeholder="<?php echo $restore_task->FILENAME->PlaceHolder ?>" value="<?php echo $restore_task->FILENAME->EditValue ?>"<?php echo $restore_task->FILENAME->EditAttributes() ?>>
</span>
<?php echo $restore_task->FILENAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td><span id="elh_restore_task_datetime"><?php echo $restore_task->datetime->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->datetime->CellAttributes() ?>>
<span id="el_restore_task_datetime" class="control-group">
<input type="text" data-field="x_datetime" name="x_datetime" id="x_datetime" placeholder="<?php echo $restore_task->datetime->PlaceHolder ?>" value="<?php echo $restore_task->datetime->EditValue ?>"<?php echo $restore_task->datetime->EditAttributes() ?>>
</span>
<?php echo $restore_task->datetime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->DBUSERNAME->Visible) { // DBUSERNAME ?>
	<tr id="r_DBUSERNAME">
		<td><span id="elh_restore_task_DBUSERNAME"><?php echo $restore_task->DBUSERNAME->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->DBUSERNAME->CellAttributes() ?>>
<span id="el_restore_task_DBUSERNAME" class="control-group">
<input type="text" data-field="x_DBUSERNAME" name="x_DBUSERNAME" id="x_DBUSERNAME" size="30" maxlength="255" placeholder="<?php echo $restore_task->DBUSERNAME->PlaceHolder ?>" value="<?php echo $restore_task->DBUSERNAME->EditValue ?>"<?php echo $restore_task->DBUSERNAME->EditAttributes() ?>>
</span>
<?php echo $restore_task->DBUSERNAME->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($restore_task->username->Visible) { // username ?>
	<tr id="r_username">
		<td><span id="elh_restore_task_username"><?php echo $restore_task->username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $restore_task->username->CellAttributes() ?>>
<span id="el_restore_task_username" class="control-group">
<input type="text" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="255" placeholder="<?php echo $restore_task->username->PlaceHolder ?>" value="<?php echo $restore_task->username->EditValue ?>"<?php echo $restore_task->username->EditAttributes() ?>>
</span>
<?php echo $restore_task->username->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<table class="ewPager">
<tr><td>
<?php if (!isset($restore_task_edit->Pager)) $restore_task_edit->Pager = new cNumericPager($restore_task_edit->StartRec, $restore_task_edit->DisplayRecs, $restore_task_edit->TotalRecs, $restore_task_edit->RecRange) ?>
<?php if ($restore_task_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($restore_task_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $restore_task_edit->PageUrl() ?>start=<?php echo $restore_task_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($restore_task_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $restore_task_edit->PageUrl() ?>start=<?php echo $restore_task_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($restore_task_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $restore_task_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($restore_task_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $restore_task_edit->PageUrl() ?>start=<?php echo $restore_task_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($restore_task_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $restore_task_edit->PageUrl() ?>start=<?php echo $restore_task_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
</tr></tbody></table>
<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
<?php } ?>
</td>
</tr></table>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("EditBtn") ?></button>
</form>
<script type="text/javascript">
frestore_taskedit.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$restore_task_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$restore_task_edit->Page_Terminate();
?>
