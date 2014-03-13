<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "serverinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$server_edit = NULL; // Initialize page object first

class cserver_edit extends cserver {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'server';

	// Page object name
	var $PageObjName = 'server_edit';

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

		// Table object (server)
		if (!isset($GLOBALS["server"])) {
			$GLOBALS["server"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["server"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'server', TRUE);

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

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action
		$this->server_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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
		if (@$_GET["server_id"] <> "") {
			$this->server_id->setQueryStringValue($_GET["server_id"]);
			$this->RecKey["server_id"] = $this->server_id->QueryStringValue;
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
			$this->Page_Terminate("serverlist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->server_id->CurrentValue) == strval($this->Recordset->fields('server_id'))) {
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
					$this->Page_Terminate("serverlist.php"); // Return to list page
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
					if (ew_GetPageName($sReturnUrl) == "serverview.php")
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
		$this->server_file->Upload->Index = $objForm->Index;
		if ($this->server_file->Upload->UploadFile()) {

			// No action required
		} else {
			echo $this->server_file->Upload->Message;
			$this->Page_Terminate();
			exit();
		}
		$this->server_file->CurrentValue = $this->server_file->Upload->FileName;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->server_id->FldIsDetailKey)
			$this->server_id->setFormValue($objForm->GetValue("x_server_id"));
		if (!$this->server_name->FldIsDetailKey) {
			$this->server_name->setFormValue($objForm->GetValue("x_server_name"));
		}
		if (!$this->server_hostname->FldIsDetailKey) {
			$this->server_hostname->setFormValue($objForm->GetValue("x_server_hostname"));
		}
		if (!$this->server_username->FldIsDetailKey) {
			$this->server_username->setFormValue($objForm->GetValue("x_server_username"));
		}
		if (!$this->server_password->FldIsDetailKey) {
			$this->server_password->setFormValue($objForm->GetValue("x_server_password"));
		}
		if (!$this->server_auth_type->FldIsDetailKey) {
			$this->server_auth_type->setFormValue($objForm->GetValue("x_server_auth_type"));
		}
		if (!$this->server_os->FldIsDetailKey) {
			$this->server_os->setFormValue($objForm->GetValue("x_server_os"));
		}
		if (!$this->server_deleted->FldIsDetailKey) {
			$this->server_deleted->setFormValue($objForm->GetValue("x_server_deleted"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->server_id->CurrentValue = $this->server_id->FormValue;
		$this->server_name->CurrentValue = $this->server_name->FormValue;
		$this->server_hostname->CurrentValue = $this->server_hostname->FormValue;
		$this->server_username->CurrentValue = $this->server_username->FormValue;
		$this->server_password->CurrentValue = $this->server_password->FormValue;
		$this->server_auth_type->CurrentValue = $this->server_auth_type->FormValue;
		$this->server_os->CurrentValue = $this->server_os->FormValue;
		$this->server_deleted->CurrentValue = $this->server_deleted->FormValue;
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
		$this->server_id->setDbValue($rs->fields('server_id'));
		$this->server_name->setDbValue($rs->fields('server_name'));
		$this->server_hostname->setDbValue($rs->fields('server_hostname'));
		$this->server_username->setDbValue($rs->fields('server_username'));
		$this->server_password->setDbValue($rs->fields('server_password'));
		$this->server_auth_type->setDbValue($rs->fields('server_auth_type'));
		$this->server_os->setDbValue($rs->fields('server_os'));
		$this->server_file->Upload->DbValue = $rs->fields('server_file');
		$this->server_deleted->setDbValue($rs->fields('server_deleted'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->server_id->DbValue = $row['server_id'];
		$this->server_name->DbValue = $row['server_name'];
		$this->server_hostname->DbValue = $row['server_hostname'];
		$this->server_username->DbValue = $row['server_username'];
		$this->server_password->DbValue = $row['server_password'];
		$this->server_auth_type->DbValue = $row['server_auth_type'];
		$this->server_os->DbValue = $row['server_os'];
		$this->server_file->Upload->DbValue = $row['server_file'];
		$this->server_deleted->DbValue = $row['server_deleted'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// server_id
		// server_name
		// server_hostname
		// server_username
		// server_password
		// server_auth_type
		// server_os
		// server_file
		// server_deleted

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// server_id
			$this->server_id->ViewValue = $this->server_id->CurrentValue;
			$this->server_id->ViewCustomAttributes = "";

			// server_name
			$this->server_name->ViewValue = $this->server_name->CurrentValue;
			$this->server_name->ViewCustomAttributes = "";

			// server_hostname
			$this->server_hostname->ViewValue = $this->server_hostname->CurrentValue;
			$this->server_hostname->ViewCustomAttributes = "";

			// server_username
			$this->server_username->ViewValue = $this->server_username->CurrentValue;
			$this->server_username->ViewCustomAttributes = "";

			// server_password
			$this->server_password->ViewValue = "********";
			$this->server_password->ViewCustomAttributes = "";

			// server_auth_type
			if (strval($this->server_auth_type->CurrentValue) <> "") {
				switch ($this->server_auth_type->CurrentValue) {
					case $this->server_auth_type->FldTagValue(1):
						$this->server_auth_type->ViewValue = $this->server_auth_type->FldTagCaption(1) <> "" ? $this->server_auth_type->FldTagCaption(1) : $this->server_auth_type->CurrentValue;
						break;
					case $this->server_auth_type->FldTagValue(2):
						$this->server_auth_type->ViewValue = $this->server_auth_type->FldTagCaption(2) <> "" ? $this->server_auth_type->FldTagCaption(2) : $this->server_auth_type->CurrentValue;
						break;
					default:
						$this->server_auth_type->ViewValue = $this->server_auth_type->CurrentValue;
				}
			} else {
				$this->server_auth_type->ViewValue = NULL;
			}
			$this->server_auth_type->ViewCustomAttributes = "";

			// server_os
			if (strval($this->server_os->CurrentValue) <> "") {
				switch ($this->server_os->CurrentValue) {
					case $this->server_os->FldTagValue(1):
						$this->server_os->ViewValue = $this->server_os->FldTagCaption(1) <> "" ? $this->server_os->FldTagCaption(1) : $this->server_os->CurrentValue;
						break;
					case $this->server_os->FldTagValue(2):
						$this->server_os->ViewValue = $this->server_os->FldTagCaption(2) <> "" ? $this->server_os->FldTagCaption(2) : $this->server_os->CurrentValue;
						break;
					default:
						$this->server_os->ViewValue = $this->server_os->CurrentValue;
				}
			} else {
				$this->server_os->ViewValue = NULL;
			}
			$this->server_os->ViewCustomAttributes = "";

			// server_file
			if (!ew_Empty($this->server_file->Upload->DbValue)) {
				$this->server_file->ViewValue = $this->server_file->Upload->DbValue;
			} else {
				$this->server_file->ViewValue = "";
			}
			$this->server_file->ViewCustomAttributes = "";

			// server_deleted
			$this->server_deleted->ViewValue = $this->server_deleted->CurrentValue;
			$this->server_deleted->ViewCustomAttributes = "";

			// server_id
			$this->server_id->LinkCustomAttributes = "";
			$this->server_id->HrefValue = "";
			$this->server_id->TooltipValue = "";

			// server_name
			$this->server_name->LinkCustomAttributes = "";
			$this->server_name->HrefValue = "";
			$this->server_name->TooltipValue = "";

			// server_hostname
			$this->server_hostname->LinkCustomAttributes = "";
			$this->server_hostname->HrefValue = "";
			$this->server_hostname->TooltipValue = "";

			// server_username
			$this->server_username->LinkCustomAttributes = "";
			$this->server_username->HrefValue = "";
			$this->server_username->TooltipValue = "";

			// server_password
			$this->server_password->LinkCustomAttributes = "";
			$this->server_password->HrefValue = "";
			$this->server_password->TooltipValue = "";

			// server_auth_type
			$this->server_auth_type->LinkCustomAttributes = "";
			$this->server_auth_type->HrefValue = "";
			$this->server_auth_type->TooltipValue = "";

			// server_os
			$this->server_os->LinkCustomAttributes = "";
			$this->server_os->HrefValue = "";
			$this->server_os->TooltipValue = "";

			// server_file
			$this->server_file->LinkCustomAttributes = "";
			$this->server_file->HrefValue = "";
			$this->server_file->HrefValue2 = $this->server_file->UploadPath . $this->server_file->Upload->DbValue;
			$this->server_file->TooltipValue = "";

			// server_deleted
			$this->server_deleted->LinkCustomAttributes = "";
			$this->server_deleted->HrefValue = "";
			$this->server_deleted->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// server_id
			$this->server_id->EditCustomAttributes = "";
			$this->server_id->EditValue = $this->server_id->CurrentValue;
			$this->server_id->ViewCustomAttributes = "";

			// server_name
			$this->server_name->EditCustomAttributes = "";
			$this->server_name->EditValue = ew_HtmlEncode($this->server_name->CurrentValue);
			$this->server_name->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_name->FldCaption()));

			// server_hostname
			$this->server_hostname->EditCustomAttributes = "";
			$this->server_hostname->EditValue = $this->server_hostname->CurrentValue;
			$this->server_hostname->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_hostname->FldCaption()));

			// server_username
			$this->server_username->EditCustomAttributes = "";
			$this->server_username->EditValue = ew_HtmlEncode($this->server_username->CurrentValue);
			$this->server_username->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_username->FldCaption()));

			// server_password
			$this->server_password->EditCustomAttributes = "";
			$this->server_password->EditValue = ew_HtmlEncode($this->server_password->CurrentValue);

			// server_auth_type
			$this->server_auth_type->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array($this->server_auth_type->FldTagValue(1), $this->server_auth_type->FldTagCaption(1) <> "" ? $this->server_auth_type->FldTagCaption(1) : $this->server_auth_type->FldTagValue(1));
			$arwrk[] = array($this->server_auth_type->FldTagValue(2), $this->server_auth_type->FldTagCaption(2) <> "" ? $this->server_auth_type->FldTagCaption(2) : $this->server_auth_type->FldTagValue(2));
			$this->server_auth_type->EditValue = $arwrk;

			// server_os
			$this->server_os->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array($this->server_os->FldTagValue(1), $this->server_os->FldTagCaption(1) <> "" ? $this->server_os->FldTagCaption(1) : $this->server_os->FldTagValue(1));
			$arwrk[] = array($this->server_os->FldTagValue(2), $this->server_os->FldTagCaption(2) <> "" ? $this->server_os->FldTagCaption(2) : $this->server_os->FldTagValue(2));
			$this->server_os->EditValue = $arwrk;

			// server_file
			$this->server_file->EditCustomAttributes = "";
			if (!ew_Empty($this->server_file->Upload->DbValue)) {
				$this->server_file->EditValue = $this->server_file->Upload->DbValue;
			} else {
				$this->server_file->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->server_file);

			// server_deleted
			$this->server_deleted->EditCustomAttributes = "";
			$this->server_deleted->EditValue = ew_HtmlEncode($this->server_deleted->CurrentValue);
			$this->server_deleted->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_deleted->FldCaption()));

			// Edit refer script
			// server_id

			$this->server_id->HrefValue = "";

			// server_name
			$this->server_name->HrefValue = "";

			// server_hostname
			$this->server_hostname->HrefValue = "";

			// server_username
			$this->server_username->HrefValue = "";

			// server_password
			$this->server_password->HrefValue = "";

			// server_auth_type
			$this->server_auth_type->HrefValue = "";

			// server_os
			$this->server_os->HrefValue = "";

			// server_file
			$this->server_file->HrefValue = "";
			$this->server_file->HrefValue2 = $this->server_file->UploadPath . $this->server_file->Upload->DbValue;

			// server_deleted
			$this->server_deleted->HrefValue = "";
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
		if (!$this->server_name->FldIsDetailKey && !is_null($this->server_name->FormValue) && $this->server_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_name->FldCaption());
		}
		if (!$this->server_hostname->FldIsDetailKey && !is_null($this->server_hostname->FormValue) && $this->server_hostname->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_hostname->FldCaption());
		}
		if (!$this->server_username->FldIsDetailKey && !is_null($this->server_username->FormValue) && $this->server_username->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_username->FldCaption());
		}
		if (!$this->server_password->FldIsDetailKey && !is_null($this->server_password->FormValue) && $this->server_password->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_password->FldCaption());
		}
		if ($this->server_auth_type->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_auth_type->FldCaption());
		}
		if ($this->server_os->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_os->FldCaption());
		}
		if (is_null($this->server_file->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_file->FldCaption());
		}
		if (!$this->server_deleted->FldIsDetailKey && !is_null($this->server_deleted->FormValue) && $this->server_deleted->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_deleted->FldCaption());
		}
		if (!ew_CheckInteger($this->server_deleted->FormValue)) {
			ew_AddMessage($gsFormError, $this->server_deleted->FldErrMsg());
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

			// server_name
			$this->server_name->SetDbValueDef($rsnew, $this->server_name->CurrentValue, "", $this->server_name->ReadOnly);

			// server_hostname
			$this->server_hostname->SetDbValueDef($rsnew, $this->server_hostname->CurrentValue, "", $this->server_hostname->ReadOnly);

			// server_username
			$this->server_username->SetDbValueDef($rsnew, $this->server_username->CurrentValue, "", $this->server_username->ReadOnly);

			// server_password
			$this->server_password->SetDbValueDef($rsnew, $this->server_password->CurrentValue, "", $this->server_password->ReadOnly);

			// server_auth_type
			$this->server_auth_type->SetDbValueDef($rsnew, $this->server_auth_type->CurrentValue, "", $this->server_auth_type->ReadOnly);

			// server_os
			$this->server_os->SetDbValueDef($rsnew, $this->server_os->CurrentValue, "", $this->server_os->ReadOnly);

			// server_file
			if (!($this->server_file->ReadOnly) && !$this->server_file->Upload->KeepFile) {
				$this->server_file->Upload->DbValue = $rs->fields('server_file'); // Get original value
				if ($this->server_file->Upload->FileName == "") {
					$rsnew['server_file'] = NULL;
				} else {
					$rsnew['server_file'] = $this->server_file->Upload->FileName;
				}
			}

			// server_deleted
			$this->server_deleted->SetDbValueDef($rsnew, $this->server_deleted->CurrentValue, 0, $this->server_deleted->ReadOnly);
			if (!$this->server_file->Upload->KeepFile) {
				if (!ew_Empty($this->server_file->Upload->Value)) {
					if ($this->server_file->Upload->FileName == $this->server_file->Upload->DbValue) { // Overwrite if same file name
						$this->server_file->Upload->DbValue = ""; // No need to delete any more
					} else {
						$rsnew['server_file'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $this->server_file->UploadPath), $rsnew['server_file']); // Get new file name
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
					if (!$this->server_file->Upload->KeepFile) {
						if (!ew_Empty($this->server_file->Upload->Value)) {
							$this->server_file->Upload->SaveToFile($this->server_file->UploadPath, $rsnew['server_file'], TRUE);
						}
						if ($this->server_file->Upload->DbValue <> "")
							@unlink(ew_UploadPathEx(TRUE, $this->server_file->OldUploadPath) . $this->server_file->Upload->DbValue);
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

		// server_file
		ew_CleanUploadTempPath($this->server_file, $this->server_file->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "serverlist.php", $this->TableVar);
		$PageCaption = $Language->Phrase("edit");
		$Breadcrumb->Add("edit", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'server';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		if (!$this->AuditTrailOnEdit) return;
		$table = 'server';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['server_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
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
if (!isset($server_edit)) $server_edit = new cserver_edit();

// Page init
$server_edit->Page_Init();

// Page main
$server_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$server_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var server_edit = new ew_Page("server_edit");
server_edit.PageID = "edit"; // Page ID
var EW_PAGE_ID = server_edit.PageID; // For backward compatibility

// Form object
var fserveredit = new ew_Form("fserveredit");

// Validate form
fserveredit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_server_name");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($server->server_name->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_server_hostname");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($server->server_hostname->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_server_username");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($server->server_username->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_server_password");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($server->server_password->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_server_auth_type");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($server->server_auth_type->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_server_os");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($server->server_os->FldCaption()) ?>");
			felm = this.GetElements("x" + infix + "_server_file");
			elm = this.GetElements("fn_x" + infix + "_server_file");
			if (felm && elm && !ew_HasValue(elm))
				return this.OnError(felm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($server->server_file->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_server_deleted");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($server->server_deleted->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_server_deleted");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($server->server_deleted->FldErrMsg()) ?>");

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
fserveredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fserveredit.ValidateRequired = true;
<?php } else { ?>
fserveredit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $server_edit->ShowPageHeader(); ?>
<?php
$server_edit->ShowMessage();
?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($server_edit->Pager)) $server_edit->Pager = new cNumericPager($server_edit->StartRec, $server_edit->DisplayRecs, $server_edit->TotalRecs, $server_edit->RecRange) ?>
<?php if ($server_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($server_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $server_edit->PageUrl() ?>start=<?php echo $server_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($server_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $server_edit->PageUrl() ?>start=<?php echo $server_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($server_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $server_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($server_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $server_edit->PageUrl() ?>start=<?php echo $server_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($server_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $server_edit->PageUrl() ?>start=<?php echo $server_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
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
<form name="fserveredit" id="fserveredit" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="server">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($server->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_serveredit" class="table table-bordered table-striped">
<?php if ($server->server_id->Visible) { // server_id ?>
	<tr id="r_server_id">
		<td><span id="elh_server_server_id"><?php echo $server->server_id->FldCaption() ?></span></td>
		<td<?php echo $server->server_id->CellAttributes() ?>>
<?php if ($server->CurrentAction <> "F") { ?>
<span id="el_server_server_id" class="control-group">
<span<?php echo $server->server_id->ViewAttributes() ?>>
<?php echo $server->server_id->EditValue ?></span>
</span>
<input type="hidden" data-field="x_server_id" name="x_server_id" id="x_server_id" value="<?php echo ew_HtmlEncode($server->server_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_server_server_id" class="control-group">
<span<?php echo $server->server_id->ViewAttributes() ?>>
<?php echo $server->server_id->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_id" name="x_server_id" id="x_server_id" value="<?php echo ew_HtmlEncode($server->server_id->FormValue) ?>">
<?php } ?>
<?php echo $server->server_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($server->server_name->Visible) { // server_name ?>
	<tr id="r_server_name">
		<td><span id="elh_server_server_name"><?php echo $server->server_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $server->server_name->CellAttributes() ?>>
<?php if ($server->CurrentAction <> "F") { ?>
<span id="el_server_server_name" class="control-group">
<input type="text" data-field="x_server_name" name="x_server_name" id="x_server_name" size="30" maxlength="255" placeholder="<?php echo $server->server_name->PlaceHolder ?>" value="<?php echo $server->server_name->EditValue ?>"<?php echo $server->server_name->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_server_server_name" class="control-group">
<span<?php echo $server->server_name->ViewAttributes() ?>>
<?php echo $server->server_name->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_name" name="x_server_name" id="x_server_name" value="<?php echo ew_HtmlEncode($server->server_name->FormValue) ?>">
<?php } ?>
<?php echo $server->server_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($server->server_hostname->Visible) { // server_hostname ?>
	<tr id="r_server_hostname">
		<td><span id="elh_server_server_hostname"><?php echo $server->server_hostname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $server->server_hostname->CellAttributes() ?>>
<?php if ($server->CurrentAction <> "F") { ?>
<span id="el_server_server_hostname" class="control-group">
<textarea data-field="x_server_hostname" name="x_server_hostname" id="x_server_hostname" cols="35" rows="4" placeholder="<?php echo $server->server_hostname->PlaceHolder ?>"<?php echo $server->server_hostname->EditAttributes() ?>><?php echo $server->server_hostname->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_server_server_hostname" class="control-group">
<span<?php echo $server->server_hostname->ViewAttributes() ?>>
<?php echo $server->server_hostname->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_hostname" name="x_server_hostname" id="x_server_hostname" value="<?php echo ew_HtmlEncode($server->server_hostname->FormValue) ?>">
<?php } ?>
<?php echo $server->server_hostname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($server->server_username->Visible) { // server_username ?>
	<tr id="r_server_username">
		<td><span id="elh_server_server_username"><?php echo $server->server_username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $server->server_username->CellAttributes() ?>>
<?php if ($server->CurrentAction <> "F") { ?>
<span id="el_server_server_username" class="control-group">
<input type="text" data-field="x_server_username" name="x_server_username" id="x_server_username" size="30" maxlength="255" placeholder="<?php echo $server->server_username->PlaceHolder ?>" value="<?php echo $server->server_username->EditValue ?>"<?php echo $server->server_username->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_server_server_username" class="control-group">
<span<?php echo $server->server_username->ViewAttributes() ?>>
<?php echo $server->server_username->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_username" name="x_server_username" id="x_server_username" value="<?php echo ew_HtmlEncode($server->server_username->FormValue) ?>">
<?php } ?>
<?php echo $server->server_username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($server->server_password->Visible) { // server_password ?>
	<tr id="r_server_password">
		<td><span id="elh_server_server_password"><?php echo $server->server_password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $server->server_password->CellAttributes() ?>>
<?php if ($server->CurrentAction <> "F") { ?>
<span id="el_server_server_password" class="control-group">
<input type="password" data-field="x_server_password" name="x_server_password" id="x_server_password" value="<?php echo $server->server_password->EditValue ?>"<?php echo $server->server_password->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_server_server_password" class="control-group">
<span<?php echo $server->server_password->ViewAttributes() ?>>
<?php echo $server->server_password->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_password" name="x_server_password" id="x_server_password" value="<?php echo ew_HtmlEncode($server->server_password->FormValue) ?>">
<?php } ?>
<?php echo $server->server_password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($server->server_auth_type->Visible) { // server_auth_type ?>
	<tr id="r_server_auth_type">
		<td><span id="elh_server_server_auth_type"><?php echo $server->server_auth_type->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $server->server_auth_type->CellAttributes() ?>>
<?php if ($server->CurrentAction <> "F") { ?>
<span id="el_server_server_auth_type" class="control-group">
<div id="tp_x_server_auth_type" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_server_auth_type" id="x_server_auth_type" value="{value}"<?php echo $server->server_auth_type->EditAttributes() ?>></div>
<div id="dsl_x_server_auth_type" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $server->server_auth_type->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($server->server_auth_type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label class="radio"><input type="radio" data-field="x_server_auth_type" name="x_server_auth_type" id="x_server_auth_type_<?php echo $rowcntwrk ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $server->server_auth_type->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span>
<?php } else { ?>
<span id="el_server_server_auth_type" class="control-group">
<span<?php echo $server->server_auth_type->ViewAttributes() ?>>
<?php echo $server->server_auth_type->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_auth_type" name="x_server_auth_type" id="x_server_auth_type" value="<?php echo ew_HtmlEncode($server->server_auth_type->FormValue) ?>">
<?php } ?>
<?php echo $server->server_auth_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($server->server_os->Visible) { // server_os ?>
	<tr id="r_server_os">
		<td><span id="elh_server_server_os"><?php echo $server->server_os->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $server->server_os->CellAttributes() ?>>
<?php if ($server->CurrentAction <> "F") { ?>
<span id="el_server_server_os" class="control-group">
<div id="tp_x_server_os" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_server_os" id="x_server_os" value="{value}"<?php echo $server->server_os->EditAttributes() ?>></div>
<div id="dsl_x_server_os" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $server->server_os->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($server->server_os->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label class="radio"><input type="radio" data-field="x_server_os" name="x_server_os" id="x_server_os_<?php echo $rowcntwrk ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $server->server_os->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span>
<?php } else { ?>
<span id="el_server_server_os" class="control-group">
<span<?php echo $server->server_os->ViewAttributes() ?>>
<?php echo $server->server_os->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_os" name="x_server_os" id="x_server_os" value="<?php echo ew_HtmlEncode($server->server_os->FormValue) ?>">
<?php } ?>
<?php echo $server->server_os->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($server->server_file->Visible) { // server_file ?>
	<tr id="r_server_file">
		<td><span id="elh_server_server_file"><?php echo $server->server_file->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $server->server_file->CellAttributes() ?>>
<span id="el_server_server_file" class="control-group">
<span id="fd_x_server_file">
<span class="btn btn-small fileinput-button">
	<span><?php echo $Language->Phrase("ChooseFile") ?></span>
	<input type="file" data-field="x_server_file" name="x_server_file" id="x_server_file">
</span>
<input type="hidden" name="fn_x_server_file" id= "fn_x_server_file" value="<?php echo $server->server_file->Upload->FileName ?>">
<?php if (@$_POST["fa_x_server_file"] == "0") { ?>
<input type="hidden" name="fa_x_server_file" id= "fa_x_server_file" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_server_file" id= "fa_x_server_file" value="1">
<?php } ?>
<input type="hidden" name="fs_x_server_file" id= "fs_x_server_file" value="0">
</span>
<table id="ft_x_server_file" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $server->server_file->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($server->server_deleted->Visible) { // server_deleted ?>
	<tr id="r_server_deleted">
		<td><span id="elh_server_server_deleted"><?php echo $server->server_deleted->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $server->server_deleted->CellAttributes() ?>>
<?php if ($server->CurrentAction <> "F") { ?>
<span id="el_server_server_deleted" class="control-group">
<input type="text" data-field="x_server_deleted" name="x_server_deleted" id="x_server_deleted" size="30" placeholder="<?php echo $server->server_deleted->PlaceHolder ?>" value="<?php echo $server->server_deleted->EditValue ?>"<?php echo $server->server_deleted->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_server_server_deleted" class="control-group">
<span<?php echo $server->server_deleted->ViewAttributes() ?>>
<?php echo $server->server_deleted->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_deleted" name="x_server_deleted" id="x_server_deleted" value="<?php echo ew_HtmlEncode($server->server_deleted->FormValue) ?>">
<?php } ?>
<?php echo $server->server_deleted->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<table class="ewPager">
<tr><td>
<?php if (!isset($server_edit->Pager)) $server_edit->Pager = new cNumericPager($server_edit->StartRec, $server_edit->DisplayRecs, $server_edit->TotalRecs, $server_edit->RecRange) ?>
<?php if ($server_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($server_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $server_edit->PageUrl() ?>start=<?php echo $server_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($server_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $server_edit->PageUrl() ?>start=<?php echo $server_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($server_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $server_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($server_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $server_edit->PageUrl() ?>start=<?php echo $server_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($server_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $server_edit->PageUrl() ?>start=<?php echo $server_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
</tr></tbody></table>
<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
<?php } ?>
</td>
</tr></table>
<?php if ($server->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_edit.value='F';"><?php echo $Language->Phrase("EditBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_edit.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
</form>
<script type="text/javascript">
fserveredit.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$server_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$server_edit->Page_Terminate();
?>
