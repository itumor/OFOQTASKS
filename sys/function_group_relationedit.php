<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "function_group_relationinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$function_group_relation_edit = NULL; // Initialize page object first

class cfunction_group_relation_edit extends cfunction_group_relation {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'function_group_relation';

	// Page object name
	var $PageObjName = 'function_group_relation_edit';

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

		// Table object (function_group_relation)
		if (!isset($GLOBALS["function_group_relation"])) {
			$GLOBALS["function_group_relation"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["function_group_relation"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'function_group_relation', TRUE);

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
		$this->function_group_relation_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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
		if (@$_GET["function_group_relation_id"] <> "") {
			$this->function_group_relation_id->setQueryStringValue($_GET["function_group_relation_id"]);
			$this->RecKey["function_group_relation_id"] = $this->function_group_relation_id->QueryStringValue;
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
			$this->Page_Terminate("function_group_relationlist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->function_group_relation_id->CurrentValue) == strval($this->Recordset->fields('function_group_relation_id'))) {
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
					$this->Page_Terminate("function_group_relationlist.php"); // Return to list page
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
					if (ew_GetPageName($sReturnUrl) == "function_group_relationview.php")
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
		if (!$this->function_group_relation_id->FldIsDetailKey)
			$this->function_group_relation_id->setFormValue($objForm->GetValue("x_function_group_relation_id"));
		if (!$this->function_group_id->FldIsDetailKey) {
			$this->function_group_id->setFormValue($objForm->GetValue("x_function_group_id"));
		}
		if (!$this->script_function_id->FldIsDetailKey) {
			$this->script_function_id->setFormValue($objForm->GetValue("x_script_function_id"));
		}
		if (!$this->priority->FldIsDetailKey) {
			$this->priority->setFormValue($objForm->GetValue("x_priority"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->function_group_relation_id->CurrentValue = $this->function_group_relation_id->FormValue;
		$this->function_group_id->CurrentValue = $this->function_group_id->FormValue;
		$this->script_function_id->CurrentValue = $this->script_function_id->FormValue;
		$this->priority->CurrentValue = $this->priority->FormValue;
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
		$this->function_group_relation_id->setDbValue($rs->fields('function_group_relation_id'));
		$this->function_group_id->setDbValue($rs->fields('function_group_id'));
		$this->script_function_id->setDbValue($rs->fields('script_function_id'));
		$this->priority->setDbValue($rs->fields('priority'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->function_group_relation_id->DbValue = $row['function_group_relation_id'];
		$this->function_group_id->DbValue = $row['function_group_id'];
		$this->script_function_id->DbValue = $row['script_function_id'];
		$this->priority->DbValue = $row['priority'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// function_group_relation_id
		// function_group_id
		// script_function_id
		// priority

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// function_group_relation_id
			$this->function_group_relation_id->ViewValue = $this->function_group_relation_id->CurrentValue;
			$this->function_group_relation_id->ViewCustomAttributes = "";

			// function_group_id
			if (strval($this->function_group_id->CurrentValue) <> "") {
				$sFilterWrk = "`function_group_id`" . ew_SearchString("=", $this->function_group_id->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `function_group_id`, `function_group_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `function_group`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->function_group_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->function_group_id->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->function_group_id->ViewValue = $this->function_group_id->CurrentValue;
				}
			} else {
				$this->function_group_id->ViewValue = NULL;
			}
			$this->function_group_id->ViewCustomAttributes = "";

			// script_function_id
			if (strval($this->script_function_id->CurrentValue) <> "") {
				$sFilterWrk = "`script_function_id`" . ew_SearchString("=", $this->script_function_id->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `script_function_id`, `script_function_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `script_function`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->script_function_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->script_function_id->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->script_function_id->ViewValue = $this->script_function_id->CurrentValue;
				}
			} else {
				$this->script_function_id->ViewValue = NULL;
			}
			$this->script_function_id->ViewCustomAttributes = "";

			// priority
			$this->priority->ViewValue = $this->priority->CurrentValue;
			$this->priority->ViewCustomAttributes = "";

			// function_group_relation_id
			$this->function_group_relation_id->LinkCustomAttributes = "";
			$this->function_group_relation_id->HrefValue = "";
			$this->function_group_relation_id->TooltipValue = "";

			// function_group_id
			$this->function_group_id->LinkCustomAttributes = "";
			$this->function_group_id->HrefValue = "";
			$this->function_group_id->TooltipValue = "";

			// script_function_id
			$this->script_function_id->LinkCustomAttributes = "";
			$this->script_function_id->HrefValue = "";
			$this->script_function_id->TooltipValue = "";

			// priority
			$this->priority->LinkCustomAttributes = "";
			$this->priority->HrefValue = "";
			$this->priority->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// function_group_relation_id
			$this->function_group_relation_id->EditCustomAttributes = "";
			$this->function_group_relation_id->EditValue = $this->function_group_relation_id->CurrentValue;
			$this->function_group_relation_id->ViewCustomAttributes = "";

			// function_group_id
			$this->function_group_id->EditCustomAttributes = "";
			if (trim(strval($this->function_group_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`function_group_id`" . ew_SearchString("=", $this->function_group_id->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT `function_group_id`, `function_group_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `function_group`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->function_group_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->function_group_id->EditValue = $arwrk;

			// script_function_id
			$this->script_function_id->EditCustomAttributes = "";
			if (trim(strval($this->script_function_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`script_function_id`" . ew_SearchString("=", $this->script_function_id->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT `script_function_id`, `script_function_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `script_function`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->script_function_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->script_function_id->EditValue = $arwrk;

			// priority
			$this->priority->EditCustomAttributes = "";
			$this->priority->EditValue = ew_HtmlEncode($this->priority->CurrentValue);
			$this->priority->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->priority->FldCaption()));

			// Edit refer script
			// function_group_relation_id

			$this->function_group_relation_id->HrefValue = "";

			// function_group_id
			$this->function_group_id->HrefValue = "";

			// script_function_id
			$this->script_function_id->HrefValue = "";

			// priority
			$this->priority->HrefValue = "";
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
		if (!$this->function_group_id->FldIsDetailKey && !is_null($this->function_group_id->FormValue) && $this->function_group_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->function_group_id->FldCaption());
		}
		if (!$this->script_function_id->FldIsDetailKey && !is_null($this->script_function_id->FormValue) && $this->script_function_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->script_function_id->FldCaption());
		}
		if (!$this->priority->FldIsDetailKey && !is_null($this->priority->FormValue) && $this->priority->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $this->priority->FldCaption());
		}
		if (!ew_CheckInteger($this->priority->FormValue)) {
			ew_AddMessage($gsFormError, $this->priority->FldErrMsg());
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

			// function_group_id
			$this->function_group_id->SetDbValueDef($rsnew, $this->function_group_id->CurrentValue, 0, $this->function_group_id->ReadOnly);

			// script_function_id
			$this->script_function_id->SetDbValueDef($rsnew, $this->script_function_id->CurrentValue, 0, $this->script_function_id->ReadOnly);

			// priority
			$this->priority->SetDbValueDef($rsnew, $this->priority->CurrentValue, 0, $this->priority->ReadOnly);

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
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "function_group_relationlist.php", $this->TableVar);
		$PageCaption = $Language->Phrase("edit");
		$Breadcrumb->Add("edit", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'function_group_relation';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		if (!$this->AuditTrailOnEdit) return;
		$table = 'function_group_relation';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['function_group_relation_id'];

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
if (!isset($function_group_relation_edit)) $function_group_relation_edit = new cfunction_group_relation_edit();

// Page init
$function_group_relation_edit->Page_Init();

// Page main
$function_group_relation_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$function_group_relation_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var function_group_relation_edit = new ew_Page("function_group_relation_edit");
function_group_relation_edit.PageID = "edit"; // Page ID
var EW_PAGE_ID = function_group_relation_edit.PageID; // For backward compatibility

// Form object
var ffunction_group_relationedit = new ew_Form("ffunction_group_relationedit");

// Validate form
ffunction_group_relationedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_function_group_id");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($function_group_relation->function_group_id->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_script_function_id");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($function_group_relation->script_function_id->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_priority");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($function_group_relation->priority->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_priority");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($function_group_relation->priority->FldErrMsg()) ?>");

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
ffunction_group_relationedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ffunction_group_relationedit.ValidateRequired = true;
<?php } else { ?>
ffunction_group_relationedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ffunction_group_relationedit.Lists["x_function_group_id"] = {"LinkField":"x_function_group_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_function_group_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
ffunction_group_relationedit.Lists["x_script_function_id"] = {"LinkField":"x_script_function_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_script_function_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $function_group_relation_edit->ShowPageHeader(); ?>
<?php
$function_group_relation_edit->ShowMessage();
?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($function_group_relation_edit->Pager)) $function_group_relation_edit->Pager = new cNumericPager($function_group_relation_edit->StartRec, $function_group_relation_edit->DisplayRecs, $function_group_relation_edit->TotalRecs, $function_group_relation_edit->RecRange) ?>
<?php if ($function_group_relation_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($function_group_relation_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $function_group_relation_edit->PageUrl() ?>start=<?php echo $function_group_relation_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($function_group_relation_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $function_group_relation_edit->PageUrl() ?>start=<?php echo $function_group_relation_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($function_group_relation_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $function_group_relation_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($function_group_relation_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $function_group_relation_edit->PageUrl() ?>start=<?php echo $function_group_relation_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($function_group_relation_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $function_group_relation_edit->PageUrl() ?>start=<?php echo $function_group_relation_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
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
<form name="ffunction_group_relationedit" id="ffunction_group_relationedit" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="function_group_relation">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($function_group_relation->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_function_group_relationedit" class="table table-bordered table-striped">
<?php if ($function_group_relation->function_group_relation_id->Visible) { // function_group_relation_id ?>
	<tr id="r_function_group_relation_id">
		<td><span id="elh_function_group_relation_function_group_relation_id"><?php echo $function_group_relation->function_group_relation_id->FldCaption() ?></span></td>
		<td<?php echo $function_group_relation->function_group_relation_id->CellAttributes() ?>>
<?php if ($function_group_relation->CurrentAction <> "F") { ?>
<span id="el_function_group_relation_function_group_relation_id" class="control-group">
<span<?php echo $function_group_relation->function_group_relation_id->ViewAttributes() ?>>
<?php echo $function_group_relation->function_group_relation_id->EditValue ?></span>
</span>
<input type="hidden" data-field="x_function_group_relation_id" name="x_function_group_relation_id" id="x_function_group_relation_id" value="<?php echo ew_HtmlEncode($function_group_relation->function_group_relation_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_function_group_relation_function_group_relation_id" class="control-group">
<span<?php echo $function_group_relation->function_group_relation_id->ViewAttributes() ?>>
<?php echo $function_group_relation->function_group_relation_id->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_function_group_relation_id" name="x_function_group_relation_id" id="x_function_group_relation_id" value="<?php echo ew_HtmlEncode($function_group_relation->function_group_relation_id->FormValue) ?>">
<?php } ?>
<?php echo $function_group_relation->function_group_relation_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($function_group_relation->function_group_id->Visible) { // function_group_id ?>
	<tr id="r_function_group_id">
		<td><span id="elh_function_group_relation_function_group_id"><?php echo $function_group_relation->function_group_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $function_group_relation->function_group_id->CellAttributes() ?>>
<?php if ($function_group_relation->CurrentAction <> "F") { ?>
<span id="el_function_group_relation_function_group_id" class="control-group">
<select data-field="x_function_group_id" id="x_function_group_id" name="x_function_group_id"<?php echo $function_group_relation->function_group_id->EditAttributes() ?>>
<?php
if (is_array($function_group_relation->function_group_id->EditValue)) {
	$arwrk = $function_group_relation->function_group_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($function_group_relation->function_group_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$sSqlWrk = "SELECT `function_group_id`, `function_group_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `function_group`";
$sWhereWrk = "";

// Call Lookup selecting
$function_group_relation->Lookup_Selecting($function_group_relation->function_group_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x_function_group_id" id="s_x_function_group_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`function_group_id` = {filter_value}"); ?>&t0=3">
</span>
<?php } else { ?>
<span id="el_function_group_relation_function_group_id" class="control-group">
<span<?php echo $function_group_relation->function_group_id->ViewAttributes() ?>>
<?php echo $function_group_relation->function_group_id->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_function_group_id" name="x_function_group_id" id="x_function_group_id" value="<?php echo ew_HtmlEncode($function_group_relation->function_group_id->FormValue) ?>">
<?php } ?>
<?php echo $function_group_relation->function_group_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($function_group_relation->script_function_id->Visible) { // script_function_id ?>
	<tr id="r_script_function_id">
		<td><span id="elh_function_group_relation_script_function_id"><?php echo $function_group_relation->script_function_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $function_group_relation->script_function_id->CellAttributes() ?>>
<?php if ($function_group_relation->CurrentAction <> "F") { ?>
<span id="el_function_group_relation_script_function_id" class="control-group">
<select data-field="x_script_function_id" id="x_script_function_id" name="x_script_function_id"<?php echo $function_group_relation->script_function_id->EditAttributes() ?>>
<?php
if (is_array($function_group_relation->script_function_id->EditValue)) {
	$arwrk = $function_group_relation->script_function_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($function_group_relation->script_function_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$sSqlWrk = "SELECT `script_function_id`, `script_function_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `script_function`";
$sWhereWrk = "";

// Call Lookup selecting
$function_group_relation->Lookup_Selecting($function_group_relation->script_function_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x_script_function_id" id="s_x_script_function_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`script_function_id` = {filter_value}"); ?>&t0=3">
</span>
<?php } else { ?>
<span id="el_function_group_relation_script_function_id" class="control-group">
<span<?php echo $function_group_relation->script_function_id->ViewAttributes() ?>>
<?php echo $function_group_relation->script_function_id->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_script_function_id" name="x_script_function_id" id="x_script_function_id" value="<?php echo ew_HtmlEncode($function_group_relation->script_function_id->FormValue) ?>">
<?php } ?>
<?php echo $function_group_relation->script_function_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($function_group_relation->priority->Visible) { // priority ?>
	<tr id="r_priority">
		<td><span id="elh_function_group_relation_priority"><?php echo $function_group_relation->priority->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $function_group_relation->priority->CellAttributes() ?>>
<?php if ($function_group_relation->CurrentAction <> "F") { ?>
<span id="el_function_group_relation_priority" class="control-group">
<input type="text" data-field="x_priority" name="x_priority" id="x_priority" size="30" placeholder="<?php echo $function_group_relation->priority->PlaceHolder ?>" value="<?php echo $function_group_relation->priority->EditValue ?>"<?php echo $function_group_relation->priority->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_function_group_relation_priority" class="control-group">
<span<?php echo $function_group_relation->priority->ViewAttributes() ?>>
<?php echo $function_group_relation->priority->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_priority" name="x_priority" id="x_priority" value="<?php echo ew_HtmlEncode($function_group_relation->priority->FormValue) ?>">
<?php } ?>
<?php echo $function_group_relation->priority->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<table class="ewPager">
<tr><td>
<?php if (!isset($function_group_relation_edit->Pager)) $function_group_relation_edit->Pager = new cNumericPager($function_group_relation_edit->StartRec, $function_group_relation_edit->DisplayRecs, $function_group_relation_edit->TotalRecs, $function_group_relation_edit->RecRange) ?>
<?php if ($function_group_relation_edit->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($function_group_relation_edit->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $function_group_relation_edit->PageUrl() ?>start=<?php echo $function_group_relation_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($function_group_relation_edit->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $function_group_relation_edit->PageUrl() ?>start=<?php echo $function_group_relation_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($function_group_relation_edit->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $function_group_relation_edit->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($function_group_relation_edit->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $function_group_relation_edit->PageUrl() ?>start=<?php echo $function_group_relation_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($function_group_relation_edit->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $function_group_relation_edit->PageUrl() ?>start=<?php echo $function_group_relation_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
</tr></tbody></table>
<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
<?php } ?>
</td>
</tr></table>
<?php if ($function_group_relation->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_edit.value='F';"><?php echo $Language->Phrase("EditBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_edit.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
</form>
<script type="text/javascript">
ffunction_group_relationedit.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$function_group_relation_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$function_group_relation_edit->Page_Terminate();
?>
