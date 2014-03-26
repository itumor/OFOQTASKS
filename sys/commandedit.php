<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "commandinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$command_edit = NULL; // Initialize page object first

class ccommand_edit extends ccommand {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'command';

	// Page object name
	var $PageObjName = 'command_edit';

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

		// Table object (command)
		if (!isset($GLOBALS["command"])) {
			$GLOBALS["command"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["command"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'command', TRUE);

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
			$this->Page_Terminate("commandlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action
		$this->command_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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
		if (@$_GET["command_id"] <> "") {
			$this->command_id->setQueryStringValue($_GET["command_id"]);
			$this->RecKey["command_id"] = $this->command_id->QueryStringValue;
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
			$this->Page_Terminate("commandlist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->command_id->CurrentValue) == strval($this->Recordset->fields('command_id'))) {
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
					$this->Page_Terminate("commandlist.php"); // Return to list page
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
					if (ew_GetPageName($sReturnUrl) == "commandview.php")
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
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->command_id->FldIsDetailKey)
			$this->command_id->setFormValue($objForm->GetValue("x_command_id"));
		if (!$this->user_id->FldIsDetailKey) {
			$this->user_id->setFormValue($objForm->GetValue("x_user_id"));
		}
		if (!$this->task_id->FldIsDetailKey) {
			$this->task_id->setFormValue($objForm->GetValue("x_task_id"));
		}
		if (!$this->server_id->FldIsDetailKey) {
			$this->server_id->setFormValue($objForm->GetValue("x_server_id"));
		}
		if (!$this->command_input->FldIsDetailKey) {
			$this->command_input->setFormValue($objForm->GetValue("x_command_input"));
		}
		if (!$this->command_output->FldIsDetailKey) {
			$this->command_output->setFormValue($objForm->GetValue("x_command_output"));
		}
		if (!$this->command_status->FldIsDetailKey) {
			$this->command_status->setFormValue($objForm->GetValue("x_command_status"));
		}
		if (!$this->command_log->FldIsDetailKey) {
			$this->command_log->setFormValue($objForm->GetValue("x_command_log"));
		}
		if (!$this->command_time->FldIsDetailKey) {
			$this->command_time->setFormValue($objForm->GetValue("x_command_time"));
			$this->command_time->CurrentValue = ew_UnFormatDateTime($this->command_time->CurrentValue, 11);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->command_id->CurrentValue = $this->command_id->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->task_id->CurrentValue = $this->task_id->FormValue;
		$this->server_id->CurrentValue = $this->server_id->FormValue;
		$this->command_input->CurrentValue = $this->command_input->FormValue;
		$this->command_output->CurrentValue = $this->command_output->FormValue;
		$this->command_status->CurrentValue = $this->command_status->FormValue;
		$this->command_log->CurrentValue = $this->command_log->FormValue;
		$this->command_time->CurrentValue = $this->command_time->FormValue;
		$this->command_time->CurrentValue = ew_UnFormatDateTime($this->command_time->CurrentValue, 11);
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
		$this->command_id->setDbValue($rs->fields('command_id'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->task_id->setDbValue($rs->fields('task_id'));
		$this->server_id->setDbValue($rs->fields('server_id'));
		$this->command_input->setDbValue($rs->fields('command_input'));
		$this->command_output->setDbValue($rs->fields('command_output'));
		$this->command_status->setDbValue($rs->fields('command_status'));
		$this->command_log->setDbValue($rs->fields('command_log'));
		$this->command_time->setDbValue($rs->fields('command_time'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->command_id->DbValue = $row['command_id'];
		$this->user_id->DbValue = $row['user_id'];
		$this->task_id->DbValue = $row['task_id'];
		$this->server_id->DbValue = $row['server_id'];
		$this->command_input->DbValue = $row['command_input'];
		$this->command_output->DbValue = $row['command_output'];
		$this->command_status->DbValue = $row['command_status'];
		$this->command_log->DbValue = $row['command_log'];
		$this->command_time->DbValue = $row['command_time'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// command_id
		// user_id
		// task_id
		// server_id
		// command_input
		// command_output
		// command_status
		// command_log
		// command_time

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// command_id
			$this->command_id->ViewValue = $this->command_id->CurrentValue;
			$this->command_id->ViewCustomAttributes = "";

			// user_id
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$this->user_id->ViewCustomAttributes = "";

			// task_id
			if (strval($this->task_id->CurrentValue) <> "") {
				$sFilterWrk = "`task_id`" . ew_SearchString("=", $this->task_id->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `task_id`, `task_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `task`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->task_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->task_id->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->task_id->ViewValue = $this->task_id->CurrentValue;
				}
			} else {
				$this->task_id->ViewValue = NULL;
			}
			$this->task_id->ViewCustomAttributes = "";

			// server_id
			if (strval($this->server_id->CurrentValue) <> "") {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->server_id->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->server_id->ViewValue = $this->server_id->CurrentValue;
				}
			} else {
				$this->server_id->ViewValue = NULL;
			}
			$this->server_id->ViewCustomAttributes = "";

			// command_input
			$this->command_input->ViewValue = $this->command_input->CurrentValue;
			$this->command_input->ViewCustomAttributes = "";

			// command_output
			$this->command_output->ViewValue = $this->command_output->CurrentValue;
			$this->command_output->ViewCustomAttributes = "";

			// command_status
			$this->command_status->ViewValue = $this->command_status->CurrentValue;
			$this->command_status->ViewCustomAttributes = "";

			// command_log
			$this->command_log->ViewValue = $this->command_log->CurrentValue;
			$this->command_log->ViewCustomAttributes = "";

			// command_time
			$this->command_time->ViewValue = $this->command_time->CurrentValue;
			$this->command_time->ViewValue = ew_FormatDateTime($this->command_time->ViewValue, 11);
			$this->command_time->ViewCustomAttributes = "";

			// command_id
			$this->command_id->LinkCustomAttributes = "";
			$this->command_id->HrefValue = "";
			$this->command_id->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// task_id
			$this->task_id->LinkCustomAttributes = "";
			$this->task_id->HrefValue = "";
			$this->task_id->TooltipValue = "";

			// server_id
			$this->server_id->LinkCustomAttributes = "";
			$this->server_id->HrefValue = "";
			$this->server_id->TooltipValue = "";

			// command_input
			$this->command_input->LinkCustomAttributes = "";
			$this->command_input->HrefValue = "";
			$this->command_input->TooltipValue = "";

			// command_output
			$this->command_output->LinkCustomAttributes = "";
			$this->command_output->HrefValue = "";
			$this->command_output->TooltipValue = "";

			// command_status
			$this->command_status->LinkCustomAttributes = "";
			$this->command_status->HrefValue = "";
			$this->command_status->TooltipValue = "";

			// command_log
			$this->command_log->LinkCustomAttributes = "";
			$this->command_log->HrefValue = "";
			$this->command_log->TooltipValue = "";

			// command_time
			$this->command_time->LinkCustomAttributes = "";
			$this->command_time->HrefValue = "";
			$this->command_time->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// command_id
			$this->command_id->EditCustomAttributes = "";
			$this->command_id->EditValue = $this->command_id->CurrentValue;
			$this->command_id->ViewCustomAttributes = "";

			// user_id
			// task_id

			$this->task_id->EditCustomAttributes = "";
			if (trim(strval($this->task_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`task_id`" . ew_SearchString("=", $this->task_id->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT `task_id`, `task_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `task`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->task_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->task_id->EditValue = $arwrk;

			// server_id
			$this->server_id->EditCustomAttributes = "";
			if (trim(strval($this->server_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT `server_id`, `server_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `server`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->server_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->server_id->EditValue = $arwrk;

			// command_input
			$this->command_input->EditCustomAttributes = "";
			$this->command_input->EditValue = $this->command_input->CurrentValue;
			$this->command_input->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_input->FldCaption()));

			// command_output
			$this->command_output->EditCustomAttributes = "";
			$this->command_output->EditValue = $this->command_output->CurrentValue;
			$this->command_output->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_output->FldCaption()));

			// command_status
			$this->command_status->EditCustomAttributes = "";
			$this->command_status->EditValue = $this->command_status->CurrentValue;
			$this->command_status->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_status->FldCaption()));

			// command_log
			$this->command_log->EditCustomAttributes = "";
			$this->command_log->EditValue = $this->command_log->CurrentValue;
			$this->command_log->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_log->FldCaption()));

			// command_time
			// Edit refer script
			// command_id

			$this->command_id->HrefValue = "";

			// user_id
			$this->user_id->HrefValue = "";

			// task_id
			$this->task_id->HrefValue = "";

			// server_id
			$this->server_id->HrefValue = "";

			// command_input
			$this->command_input->HrefValue = "";

			// command_output
			$this->command_output->HrefValue = "";

			// command_status
			$this->command_status->HrefValue = "";

			// command_log
			$this->command_log->HrefValue = "";

			// command_time
			$this->command_time->HrefValue = "";
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
		if (!$this->task_id->FldIsDetailKey && !is_null($this->task_id->FormValue) && $this->task_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->task_id->FldCaption());
		}
		if (!$this->server_id->FldIsDetailKey && !is_null($this->server_id->FormValue) && $this->server_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->server_id->FldCaption());
		}
		if (!$this->command_input->FldIsDetailKey && !is_null($this->command_input->FormValue) && $this->command_input->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->command_input->FldCaption());
		}
		if (!$this->command_output->FldIsDetailKey && !is_null($this->command_output->FormValue) && $this->command_output->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->command_output->FldCaption());
		}
		if (!$this->command_status->FldIsDetailKey && !is_null($this->command_status->FormValue) && $this->command_status->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->command_status->FldCaption());
		}
		if (!$this->command_log->FldIsDetailKey && !is_null($this->command_log->FormValue) && $this->command_log->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->command_log->FldCaption());
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

			// user_id
			$this->user_id->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['user_id'] = &$this->user_id->DbValue;

			// task_id
			$this->task_id->SetDbValueDef($rsnew, $this->task_id->CurrentValue, NULL, $this->task_id->ReadOnly);

			// server_id
			$this->server_id->SetDbValueDef($rsnew, $this->server_id->CurrentValue, NULL, $this->server_id->ReadOnly);

			// command_input
			$this->command_input->SetDbValueDef($rsnew, $this->command_input->CurrentValue, NULL, $this->command_input->ReadOnly);

			// command_output
			$this->command_output->SetDbValueDef($rsnew, $this->command_output->CurrentValue, NULL, $this->command_output->ReadOnly);

			// command_status
			$this->command_status->SetDbValueDef($rsnew, $this->command_status->CurrentValue, NULL, $this->command_status->ReadOnly);

			// command_log
			$this->command_log->SetDbValueDef($rsnew, $this->command_log->CurrentValue, NULL, $this->command_log->ReadOnly);

			// command_time
			$this->command_time->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['command_time'] = &$this->command_time->DbValue;

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
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "commandlist.php", $this->TableVar);
		$PageCaption = $Language->Phrase("edit");
		$Breadcrumb->Add("edit", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'command';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		if (!$this->AuditTrailOnEdit) return;
		$table = 'command';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['command_id'];

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
if (!isset($command_edit)) $command_edit = new ccommand_edit();

// Page init
$command_edit->Page_Init();

// Page main
$command_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$command_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var command_edit = new ew_Page("command_edit");
command_edit.PageID = "edit"; // Page ID
var EW_PAGE_ID = command_edit.PageID; // For backward compatibility

// Form object
var fcommandedit = new ew_Form("fcommandedit");

// Validate form
fcommandedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_task_id");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($command->task_id->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_server_id");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($command->server_id->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_command_input");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($command->command_input->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_command_output");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($command->command_output->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_command_status");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($command->command_status->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_command_log");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($command->command_log->FldCaption()) ?>");

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
fcommandedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcommandedit.ValidateRequired = true;
<?php } else { ?>
fcommandedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fcommandedit.Lists["x_task_id"] = {"LinkField":"x_task_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_task_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fcommandedit.Lists["x_server_id"] = {"LinkField":"x_server_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $command_edit->ShowPageHeader(); ?>
<?php
$command_edit->ShowMessage();
?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($command_edit->Pager)) $command_edit->Pager = new cNumericPager($command_edit->StartRec, $command_edit->DisplayRecs, $command_edit->TotalRecs, $command_edit->RecRange) ?>
<?php if ($command_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($command_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $command_edit->PageUrl() ?>start=<?php echo $command_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($command_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $command_edit->PageUrl() ?>start=<?php echo $command_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($command_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $command_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($command_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $command_edit->PageUrl() ?>start=<?php echo $command_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($command_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $command_edit->PageUrl() ?>start=<?php echo $command_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
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
<form name="fcommandedit" id="fcommandedit" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="command">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($command->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_commandedit" class="table table-bordered table-striped">
<?php if ($command->command_id->Visible) { // command_id ?>
	<tr id="r_command_id">
		<td><span id="elh_command_command_id"><?php echo $command->command_id->FldCaption() ?></span></td>
		<td<?php echo $command->command_id->CellAttributes() ?>>
<?php if ($command->CurrentAction <> "F") { ?>
<span id="el_command_command_id" class="control-group">
<span<?php echo $command->command_id->ViewAttributes() ?>>
<?php echo $command->command_id->EditValue ?></span>
</span>
<input type="hidden" data-field="x_command_id" name="x_command_id" id="x_command_id" value="<?php echo ew_HtmlEncode($command->command_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_command_command_id" class="control-group">
<span<?php echo $command->command_id->ViewAttributes() ?>>
<?php echo $command->command_id->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_command_id" name="x_command_id" id="x_command_id" value="<?php echo ew_HtmlEncode($command->command_id->FormValue) ?>">
<?php } ?>
<?php echo $command->command_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($command->task_id->Visible) { // task_id ?>
	<tr id="r_task_id">
		<td><span id="elh_command_task_id"><?php echo $command->task_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $command->task_id->CellAttributes() ?>>
<?php if ($command->CurrentAction <> "F") { ?>
<span id="el_command_task_id" class="control-group">
<select data-field="x_task_id" id="x_task_id" name="x_task_id"<?php echo $command->task_id->EditAttributes() ?>>
<?php
if (is_array($command->task_id->EditValue)) {
	$arwrk = $command->task_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($command->task_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$sSqlWrk = "SELECT `task_id`, `task_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `task`";
$sWhereWrk = "";

// Call Lookup selecting
$command->Lookup_Selecting($command->task_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x_task_id" id="s_x_task_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`task_id` = {filter_value}"); ?>&t0=3">
</span>
<?php } else { ?>
<span id="el_command_task_id" class="control-group">
<span<?php echo $command->task_id->ViewAttributes() ?>>
<?php echo $command->task_id->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_task_id" name="x_task_id" id="x_task_id" value="<?php echo ew_HtmlEncode($command->task_id->FormValue) ?>">
<?php } ?>
<?php echo $command->task_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($command->server_id->Visible) { // server_id ?>
	<tr id="r_server_id">
		<td><span id="elh_command_server_id"><?php echo $command->server_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $command->server_id->CellAttributes() ?>>
<?php if ($command->CurrentAction <> "F") { ?>
<span id="el_command_server_id" class="control-group">
<select data-field="x_server_id" id="x_server_id" name="x_server_id"<?php echo $command->server_id->EditAttributes() ?>>
<?php
if (is_array($command->server_id->EditValue)) {
	$arwrk = $command->server_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($command->server_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$command->Lookup_Selecting($command->server_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x_server_id" id="s_x_server_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`server_id` = {filter_value}"); ?>&t0=3">
</span>
<?php } else { ?>
<span id="el_command_server_id" class="control-group">
<span<?php echo $command->server_id->ViewAttributes() ?>>
<?php echo $command->server_id->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_server_id" name="x_server_id" id="x_server_id" value="<?php echo ew_HtmlEncode($command->server_id->FormValue) ?>">
<?php } ?>
<?php echo $command->server_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($command->command_input->Visible) { // command_input ?>
	<tr id="r_command_input">
		<td><span id="elh_command_command_input"><?php echo $command->command_input->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $command->command_input->CellAttributes() ?>>
<?php if ($command->CurrentAction <> "F") { ?>
<span id="el_command_command_input" class="control-group">
<textarea data-field="x_command_input" name="x_command_input" id="x_command_input" cols="35" rows="4" placeholder="<?php echo $command->command_input->PlaceHolder ?>"<?php echo $command->command_input->EditAttributes() ?>><?php echo $command->command_input->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_command_command_input" class="control-group">
<span<?php echo $command->command_input->ViewAttributes() ?>>
<?php echo $command->command_input->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_command_input" name="x_command_input" id="x_command_input" value="<?php echo ew_HtmlEncode($command->command_input->FormValue) ?>">
<?php } ?>
<?php echo $command->command_input->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($command->command_output->Visible) { // command_output ?>
	<tr id="r_command_output">
		<td><span id="elh_command_command_output"><?php echo $command->command_output->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $command->command_output->CellAttributes() ?>>
<?php if ($command->CurrentAction <> "F") { ?>
<span id="el_command_command_output" class="control-group">
<textarea data-field="x_command_output" name="x_command_output" id="x_command_output" cols="35" rows="4" placeholder="<?php echo $command->command_output->PlaceHolder ?>"<?php echo $command->command_output->EditAttributes() ?>><?php echo $command->command_output->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_command_command_output" class="control-group">
<span<?php echo $command->command_output->ViewAttributes() ?>>
<?php echo $command->command_output->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_command_output" name="x_command_output" id="x_command_output" value="<?php echo ew_HtmlEncode($command->command_output->FormValue) ?>">
<?php } ?>
<?php echo $command->command_output->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($command->command_status->Visible) { // command_status ?>
	<tr id="r_command_status">
		<td><span id="elh_command_command_status"><?php echo $command->command_status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $command->command_status->CellAttributes() ?>>
<?php if ($command->CurrentAction <> "F") { ?>
<span id="el_command_command_status" class="control-group">
<textarea data-field="x_command_status" name="x_command_status" id="x_command_status" cols="35" rows="4" placeholder="<?php echo $command->command_status->PlaceHolder ?>"<?php echo $command->command_status->EditAttributes() ?>><?php echo $command->command_status->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_command_command_status" class="control-group">
<span<?php echo $command->command_status->ViewAttributes() ?>>
<?php echo $command->command_status->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_command_status" name="x_command_status" id="x_command_status" value="<?php echo ew_HtmlEncode($command->command_status->FormValue) ?>">
<?php } ?>
<?php echo $command->command_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($command->command_log->Visible) { // command_log ?>
	<tr id="r_command_log">
		<td><span id="elh_command_command_log"><?php echo $command->command_log->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $command->command_log->CellAttributes() ?>>
<?php if ($command->CurrentAction <> "F") { ?>
<span id="el_command_command_log" class="control-group">
<textarea data-field="x_command_log" name="x_command_log" id="x_command_log" cols="35" rows="4" placeholder="<?php echo $command->command_log->PlaceHolder ?>"<?php echo $command->command_log->EditAttributes() ?>><?php echo $command->command_log->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_command_command_log" class="control-group">
<span<?php echo $command->command_log->ViewAttributes() ?>>
<?php echo $command->command_log->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_command_log" name="x_command_log" id="x_command_log" value="<?php echo ew_HtmlEncode($command->command_log->FormValue) ?>">
<?php } ?>
<?php echo $command->command_log->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<table class="ewPager">
<tr><td>
<?php if (!isset($command_edit->Pager)) $command_edit->Pager = new cNumericPager($command_edit->StartRec, $command_edit->DisplayRecs, $command_edit->TotalRecs, $command_edit->RecRange) ?>
<?php if ($command_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($command_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $command_edit->PageUrl() ?>start=<?php echo $command_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($command_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $command_edit->PageUrl() ?>start=<?php echo $command_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($command_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $command_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($command_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $command_edit->PageUrl() ?>start=<?php echo $command_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($command_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $command_edit->PageUrl() ?>start=<?php echo $command_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
</tr></tbody></table>
<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
<?php } ?>
</td>
</tr></table>
<?php if ($command->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_edit.value='F';"><?php echo $Language->Phrase("EditBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_edit.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
</form>
<script type="text/javascript">
fcommandedit.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$command_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$command_edit->Page_Terminate();
?>
