<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "script_function_parameter_relationinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$script_function_parameter_relation_list = NULL; // Initialize page object first

class cscript_function_parameter_relation_list extends cscript_function_parameter_relation {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'script_function_parameter_relation';

	// Page object name
	var $PageObjName = 'script_function_parameter_relation_list';

	// Grid form hidden field names
	var $FormName = 'fscript_function_parameter_relationlist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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

		// Table object (script_function_parameter_relation)
		if (!isset($GLOBALS["script_function_parameter_relation"])) {
			$GLOBALS["script_function_parameter_relation"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["script_function_parameter_relation"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "script_function_parameter_relationadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "script_function_parameter_relationdelete.php";
		$this->MultiUpdateUrl = "script_function_parameter_relationupdate.php";

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'script_function_parameter_relation', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "span";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "span";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "span";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $this->Export; // Get export parameter, used in header
		$gsExportFile = $this->TableVar; // Get export file, used in header
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
		$this->script_function_parameter_relation->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Setup other options
		$this->SetupOtherOptions();

		// Set "checkbox" visible
		if (count($this->CustomActions) > 0)
			$this->ListOptions->Items["checkbox"]->Visible = TRUE;

		// Update url if printer friendly for Pdf
		if ($this->PrinterFriendlyForPdf)
			$this->ExportOptions->Items["pdf"]->Body = str_replace($this->ExportPdfUrl, $this->ExportPrintUrl . "&pdf=1", $this->ExportOptions->Items["pdf"]->Body);
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();
		if ($this->Export == "print" && @$_GET["pdf"] == "1") { // Printer friendly version and with pdf=1 in URL parameters
			$pdf = new cExportPdf($GLOBALS["Table"]);
			$pdf->Text = ob_get_contents(); // Set the content as the HTML of current page (printer friendly version)
			ob_end_clean();
			$pdf->Export();
		}

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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process custom action first
			$this->ProcessCustomAction();

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			$this->SetupBreadcrumb();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$this->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($this->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($this->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($this->CurrentAction == "add" || $this->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($this->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($this->CurrentAction == "gridupdate" || $this->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit") {
						if ($this->ValidateGridForm()) {
							$this->GridUpdate();
						} else {
							$this->setFailureMessage($gsFormError);
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridedit"; // Stay in Grid Edit mode
						}
					}

					// Inline Update
					if (($this->CurrentAction == "update" || $this->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($this->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($this->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$this->GridInsert();
						} else {
							$this->setFailureMessage($gsFormError);
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
				}
			}

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide export options
			if ($this->Export <> "" || $this->CurrentAction <> "")
				$this->ExportOptions->HideAllOptions();

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";

		// Export data only
		if (in_array($this->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		$this->setKey("script_function_parameter_relation", ""); // Clear inline edit key
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $Language;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["script_function_parameter_relation"] <> "") {
			$this->script_function_parameter_relation->setQueryStringValue($_GET["script_function_parameter_relation"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("script_function_parameter_relation", $this->script_function_parameter_relation->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;
			$rowkey = strval($objForm->GetValue("k_key"));
			if ($this->SetupKeyValues($rowkey)) { // Set up key values
				if ($this->CheckInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$bInlineUpdate = $this->EditRow(); // Update record
				} else {
					$bInlineUpdate = FALSE;
				}
			}
		}
		if ($bInlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {

		//CheckInlineEditKey = True
		if (strval($this->getKey("script_function_parameter_relation")) <> strval($this->script_function_parameter_relation->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $Language;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		if ($this->CurrentAction == "copy") {
			if (@$_GET["script_function_parameter_relation"] <> "") {
				$this->script_function_parameter_relation->setQueryStringValue($_GET["script_function_parameter_relation"]);
				$this->setKey("script_function_parameter_relation", $this->script_function_parameter_relation->CurrentValue); // Set up key
			} else {
				$this->setKey("script_function_parameter_relation", ""); // Clear key
				$this->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError;
		$this->LoadOldRecord(); // Load old recordset
		$objForm->Index = 0;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setFailureMessage($gsFormError); // Set validation error message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$this->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow($this->OldRecordset)) { // Add record
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $this->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->script_function_parameter_relation->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->script_function_parameter_relation->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
					$sKey .= $this->script_function_parameter_relation->CurrentValue;

					// Add filter for this record
					$sFilter = $this->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$bGridInsert = FALSE;
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $sWrkFilter;
			$sSql = $this->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set up insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_parameter_id") && $objForm->HasValue("o_parameter_id") && $this->parameter_id->CurrentValue <> $this->parameter_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_script_function_id") && $objForm->HasValue("o_script_function_id") && $this->script_function_id->CurrentValue <> $this->script_function_id->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->script_function_parameter_relation); // script_function_parameter_relation
			$this->UpdateSort($this->parameter_id); // parameter_id
			$this->UpdateSort($this->script_function_id); // script_function_id
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->SqlOrderBy() <> "") {
				$sOrderBy = $this->SqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->script_function_parameter_relation->setSort("");
				$this->parameter_id->setSort("");
				$this->script_function_id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = TRUE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = TRUE;
		$item->Header = "<label class=\"checkbox\"><input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\"></label>";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		$this->ListOptions->ButtonClass = "btn-small"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		if (($this->CurrentAction == "add" || $this->CurrentAction == "copy") && $this->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a class=\"ewGridLink ewInlineInsert\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit();\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a class=\"ewGridLink ewInlineCancel\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		if ($this->CurrentAction == "edit" && $this->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a class=\"ewGridLink ewInlineUpdate\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . ew_GetHashUrl($this->PageName(), $this->PageObjName . "_row_" . $this->RowCnt) . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ewGridLink ewInlineCancel\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->script_function_parameter_relation->CurrentValue) . "\">";
			return;
		}

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		if ($Security->CanView())
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewLink")) . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		else
			$oListOpt->Body = "";

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<span class=\"ewSeparator\">&nbsp;|&nbsp;</span>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineEdit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . ew_HtmlEncode(ew_GetHashUrl($this->InlineEditUrl, $this->PageObjName . "_row_" . $this->RowCnt)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		if ($Security->CanAdd()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CopyLink")) . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
			$oListOpt->Body .= "<span class=\"ewSeparator\">&nbsp;|&nbsp;</span>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineCopy\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineCopyUrl) . "\">" . $Language->Phrase("InlineCopyLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<label class=\"checkbox\"><input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->script_function_parameter_relation->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event, this);'></label>";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->script_function_parameter_relation->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$item->Body = "<a class=\"ewAddEdit ewAdd\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Inline Add
		$item = &$option->Add("inlineadd");
		$item->Body = "<a class=\"ewAddEdit ewInlineAdd\" href=\"" . ew_HtmlEncode($this->InlineAddUrl) . "\">" .$Language->Phrase("InlineAddLink") . "</a>";
		$item->Visible = ($this->InlineAddUrl <> "" && $Security->CanAdd());
		$item = &$option->Add("gridadd");
		$item->Body = "<a class=\"ewAddEdit ewGridAdd\" href=\"" . ew_HtmlEncode($this->GridAddUrl) . "\">" . $Language->Phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->CanAdd());

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->Add("gridedit");
		$item->Body = "<a class=\"ewAddEdit ewGridEdit\" href=\"" . ew_HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->CanEdit());
		$option = $options["action"];

		// Add multi delete
		$item = &$option->Add("multidelete");
		$item->Body = "<a class=\"ewAction ewMultiDelete\" href=\"\" onclick=\"ew_SubmitSelected(document.fscript_function_parameter_relationlist, '" . $this->MultiDeleteUrl . "', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;\">" . $Language->Phrase("DeleteSelectedLink") . "</a>";
		$item->Visible = ($Security->CanDelete());

		// Set up options default
		foreach ($options as &$option) {
			$option->UseDropDownButton = TRUE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-small"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "gridedit") { // Not grid add/edit mode
			$option = &$options["action"];
			foreach ($this->CustomActions as $action => $name) {

				// Add custom action
				$item = &$option->Add("custom_" . $action);
				$item->Body = "<a class=\"ewAction ewCustomAction\" href=\"\" onclick=\"ew_SubmitSelected(document.fscript_function_parameter_relationlist, '" . ew_CurrentUrl() . "', null, '" . $action . "');return false;\">" . $name . "</a>";
			}

			// Hide grid edit, multi-delete and multi-update
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$item = &$option->GetItem("multidelete");
				if ($item) $item->Visible = FALSE;
				$item = &$option->GetItem("multiupdate");
				if ($item) $item->Visible = FALSE;
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->HideAllOptions();
			if ($this->CurrentAction == "gridadd") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;

				// Add grid insert
				$item = &$option->Add("gridinsert");
				$item->Body = "<a class=\"ewAction ewGridInsert\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit();\">" . $Language->Phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->Add("gridcancel");
				$item->Body = "<a class=\"ewAction ewGridCancel\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
			if ($this->CurrentAction == "gridedit") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
					$item = &$option->Add("gridsave");
					$item->Body = "<a class=\"ewAction ewGridSave\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit();\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->Add("gridcancel");
					$item->Body = "<a class=\"ewAction ewGridCancel\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process custom action
	function ProcessCustomAction() {
		global $conn, $Language, $Security;
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$rsuser = ($rs) ? $rs->GetRows() : array();
			if ($rs)
				$rs->Close();

			// Call row custom action event
			if (count($rsuser) > 0) {
				$conn->BeginTrans();
				foreach ($rsuser as $row) {
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $UserAction, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $UserAction, $Language->Phrase("CustomActionCancelled")));
					}
				}
			}
		}
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load default values
	function LoadDefaultValues() {
		$this->script_function_parameter_relation->CurrentValue = NULL;
		$this->script_function_parameter_relation->OldValue = $this->script_function_parameter_relation->CurrentValue;
		$this->parameter_id->CurrentValue = NULL;
		$this->parameter_id->OldValue = $this->parameter_id->CurrentValue;
		$this->script_function_id->CurrentValue = NULL;
		$this->script_function_id->OldValue = $this->script_function_id->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->script_function_parameter_relation->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->script_function_parameter_relation->setFormValue($objForm->GetValue("x_script_function_parameter_relation"));
		if (!$this->parameter_id->FldIsDetailKey) {
			$this->parameter_id->setFormValue($objForm->GetValue("x_parameter_id"));
		}
		$this->parameter_id->setOldValue($objForm->GetValue("o_parameter_id"));
		if (!$this->script_function_id->FldIsDetailKey) {
			$this->script_function_id->setFormValue($objForm->GetValue("x_script_function_id"));
		}
		$this->script_function_id->setOldValue($objForm->GetValue("o_script_function_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->script_function_parameter_relation->CurrentValue = $this->script_function_parameter_relation->FormValue;
		$this->parameter_id->CurrentValue = $this->parameter_id->FormValue;
		$this->script_function_id->CurrentValue = $this->script_function_id->FormValue;
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
		$this->script_function_parameter_relation->setDbValue($rs->fields('script_function_parameter_relation'));
		$this->parameter_id->setDbValue($rs->fields('parameter_id'));
		$this->script_function_id->setDbValue($rs->fields('script_function_id'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->script_function_parameter_relation->DbValue = $row['script_function_parameter_relation'];
		$this->parameter_id->DbValue = $row['parameter_id'];
		$this->script_function_id->DbValue = $row['script_function_id'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("script_function_parameter_relation")) <> "")
			$this->script_function_parameter_relation->CurrentValue = $this->getKey("script_function_parameter_relation"); // script_function_parameter_relation
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// script_function_parameter_relation
		// parameter_id
		// script_function_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// script_function_parameter_relation
			$this->script_function_parameter_relation->ViewValue = $this->script_function_parameter_relation->CurrentValue;
			$this->script_function_parameter_relation->ViewCustomAttributes = "";

			// parameter_id
			if (strval($this->parameter_id->CurrentValue) <> "") {
				$sFilterWrk = "`parameter_id`" . ew_SearchString("=", $this->parameter_id->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `parameter_id`, `parameter_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `parameter`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->parameter_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->parameter_id->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->parameter_id->ViewValue = $this->parameter_id->CurrentValue;
				}
			} else {
				$this->parameter_id->ViewValue = NULL;
			}
			$this->parameter_id->ViewCustomAttributes = "";

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

			// script_function_parameter_relation
			$this->script_function_parameter_relation->LinkCustomAttributes = "";
			$this->script_function_parameter_relation->HrefValue = "";
			$this->script_function_parameter_relation->TooltipValue = "";

			// parameter_id
			$this->parameter_id->LinkCustomAttributes = "";
			$this->parameter_id->HrefValue = "";
			$this->parameter_id->TooltipValue = "";

			// script_function_id
			$this->script_function_id->LinkCustomAttributes = "";
			$this->script_function_id->HrefValue = "";
			$this->script_function_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// script_function_parameter_relation
			// parameter_id

			$this->parameter_id->EditCustomAttributes = "";
			if (trim(strval($this->parameter_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`parameter_id`" . ew_SearchString("=", $this->parameter_id->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT `parameter_id`, `parameter_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `parameter`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->parameter_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->parameter_id->EditValue = $arwrk;

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

			// Edit refer script
			// script_function_parameter_relation

			$this->script_function_parameter_relation->HrefValue = "";

			// parameter_id
			$this->parameter_id->HrefValue = "";

			// script_function_id
			$this->script_function_id->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// script_function_parameter_relation
			$this->script_function_parameter_relation->EditCustomAttributes = "";
			$this->script_function_parameter_relation->EditValue = $this->script_function_parameter_relation->CurrentValue;
			$this->script_function_parameter_relation->ViewCustomAttributes = "";

			// parameter_id
			$this->parameter_id->EditCustomAttributes = "";
			if (trim(strval($this->parameter_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`parameter_id`" . ew_SearchString("=", $this->parameter_id->CurrentValue, EW_DATATYPE_NUMBER);
			}
			$sSqlWrk = "SELECT `parameter_id`, `parameter_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `parameter`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->parameter_id, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->parameter_id->EditValue = $arwrk;

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

			// Edit refer script
			// script_function_parameter_relation

			$this->script_function_parameter_relation->HrefValue = "";

			// parameter_id
			$this->parameter_id->HrefValue = "";

			// script_function_id
			$this->script_function_id->HrefValue = "";
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['script_function_parameter_relation'];
				$this->LoadDbValues($row);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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

			// parameter_id
			$this->parameter_id->SetDbValueDef($rsnew, $this->parameter_id->CurrentValue, NULL, $this->parameter_id->ReadOnly);

			// script_function_id
			$this->script_function_id->SetDbValueDef($rsnew, $this->script_function_id->CurrentValue, NULL, $this->script_function_id->ReadOnly);

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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security;

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// parameter_id
		$this->parameter_id->SetDbValueDef($rsnew, $this->parameter_id->CurrentValue, NULL, FALSE);

		// script_function_id
		$this->script_function_id->SetDbValueDef($rsnew, $this->script_function_id->CurrentValue, NULL, FALSE);

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
			$this->script_function_parameter_relation->setDbValue($conn->Insert_ID());
			$rsnew['script_function_parameter_relation'] = $this->script_function_parameter_relation->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$item->Body = "<a id=\"emf_script_function_parameter_relation\" href=\"javascript:void(0);\" class=\"ewExportLink ewEmail\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_script_function_parameter_relation',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fscript_function_parameter_relationlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$ExportDoc = ew_ExportDocument($this, "h");
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$ExportDoc->Text .= $sHeader;
		$this->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$ExportDoc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Export header and footer
		$ExportDoc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($this->Export == "email") {
			echo $this->ExportEmail($ExportDoc->Text);
		} else {
			$ExportDoc->Export();
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $gTmpImages, $Language;
		$sSender = @$_GET["sender"];
		$sRecipient = @$_GET["recipient"];
		$sCc = @$_GET["cc"];
		$sBcc = @$_GET["bcc"];
		$sContentType = @$_GET["contenttype"];

		// Subject
		$sSubject = ew_StripSlashes(@$_GET["subject"]);
		$sEmailSubject = $sSubject;

		// Message
		$sContent = ew_StripSlashes(@$_GET["message"]);
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			return "<p class=\"text-error\">" . $Language->Phrase("EnterSenderEmail") . "</p>";
		}
		if (!ew_CheckEmail($sSender)) {
			return "<p class=\"text-error\">" . $Language->Phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-error\">" . $Language->Phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-error\">" . $Language->Phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-error\">" . $Language->Phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-error\">" . $Language->Phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		$Email->Charset = EW_EMAIL_CHARSET;
		if ($sEmailMessage <> "") {
			$sEmailMessage = ew_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		if ($sContentType == "url") {
			$sUrl = ew_ConvertFullUrl(ew_CurrentPage() . "?" . $this->ExportQueryString());
			$sEmailMessage .= $sUrl; // Send URL only
		} else {
			foreach ($gTmpImages as $tmpimage)
				$Email->AddEmbeddedImage($tmpimage);
			$sEmailMessage .= $EmailContent; // Send HTML
		}
		$Email->Content = $sEmailMessage; // Content
		$EventArgs = array();
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->Phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-error\">" . $Email->SendErrDescription . "</p>";
		}
	}

	// Export QueryString
	function ExportQueryString() {

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		// Build QueryString for pager

		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . urlencode($this->getRecordsPerPage()) . "&" . EW_TABLE_START_REC . "=" . urlencode($this->getStartRecordNumber());
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		$FldSearchValue = $Fld->AdvancedSearch->getValue("x");
		$FldParm = substr($Fld->FldVar,2);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . urlencode($FldSearchValue) .
				"&z_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("z"));
		}
		$FldSearchValue2 = $Fld->AdvancedSearch->getValue("y");
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("v")) .
				"&y_" . $FldParm . "=" . urlencode($FldSearchValue2) .
				"&w_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("w"));
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$url = ew_CurrentUrl();
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", $url, $this->TableVar);
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($script_function_parameter_relation_list)) $script_function_parameter_relation_list = new cscript_function_parameter_relation_list();

// Page init
$script_function_parameter_relation_list->Page_Init();

// Page main
$script_function_parameter_relation_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$script_function_parameter_relation_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($script_function_parameter_relation->Export == "") { ?>
<script type="text/javascript">

// Page object
var script_function_parameter_relation_list = new ew_Page("script_function_parameter_relation_list");
script_function_parameter_relation_list.PageID = "list"; // Page ID
var EW_PAGE_ID = script_function_parameter_relation_list.PageID; // For backward compatibility

// Form object
var fscript_function_parameter_relationlist = new ew_Form("fscript_function_parameter_relationlist");
fscript_function_parameter_relationlist.FormKeyCountName = '<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>';

// Validate form
fscript_function_parameter_relationlist.Validate = function() {
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
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;

			// Set up row object
			ew_ElementsToRow(fobj);

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		alert(ewLanguage.Phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
fscript_function_parameter_relationlist.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "parameter_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "script_function_id", false)) return false;
	return true;
}

// Form_CustomValidate event
fscript_function_parameter_relationlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fscript_function_parameter_relationlist.ValidateRequired = true;
<?php } else { ?>
fscript_function_parameter_relationlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fscript_function_parameter_relationlist.Lists["x_parameter_id"] = {"LinkField":"x_parameter_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_parameter_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fscript_function_parameter_relationlist.Lists["x_script_function_id"] = {"LinkField":"x_script_function_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_script_function_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($script_function_parameter_relation->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($script_function_parameter_relation_list->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $script_function_parameter_relation_list->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
if ($script_function_parameter_relation->CurrentAction == "gridadd") {
	$script_function_parameter_relation->CurrentFilter = "0=1";
	$script_function_parameter_relation_list->StartRec = 1;
	$script_function_parameter_relation_list->DisplayRecs = $script_function_parameter_relation->GridAddRowCount;
	$script_function_parameter_relation_list->TotalRecs = $script_function_parameter_relation_list->DisplayRecs;
	$script_function_parameter_relation_list->StopRec = $script_function_parameter_relation_list->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$script_function_parameter_relation_list->TotalRecs = $script_function_parameter_relation->SelectRecordCount();
	} else {
		if ($script_function_parameter_relation_list->Recordset = $script_function_parameter_relation_list->LoadRecordset())
			$script_function_parameter_relation_list->TotalRecs = $script_function_parameter_relation_list->Recordset->RecordCount();
	}
	$script_function_parameter_relation_list->StartRec = 1;
	if ($script_function_parameter_relation_list->DisplayRecs <= 0 || ($script_function_parameter_relation->Export <> "" && $script_function_parameter_relation->ExportAll)) // Display all records
		$script_function_parameter_relation_list->DisplayRecs = $script_function_parameter_relation_list->TotalRecs;
	if (!($script_function_parameter_relation->Export <> "" && $script_function_parameter_relation->ExportAll))
		$script_function_parameter_relation_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$script_function_parameter_relation_list->Recordset = $script_function_parameter_relation_list->LoadRecordset($script_function_parameter_relation_list->StartRec-1, $script_function_parameter_relation_list->DisplayRecs);
}
$script_function_parameter_relation_list->RenderOtherOptions();
?>
<?php $script_function_parameter_relation_list->ShowPageHeader(); ?>
<?php
$script_function_parameter_relation_list->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($script_function_parameter_relation->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($script_function_parameter_relation->CurrentAction <> "gridadd" && $script_function_parameter_relation->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($script_function_parameter_relation_list->Pager)) $script_function_parameter_relation_list->Pager = new cNumericPager($script_function_parameter_relation_list->StartRec, $script_function_parameter_relation_list->DisplayRecs, $script_function_parameter_relation_list->TotalRecs, $script_function_parameter_relation_list->RecRange) ?>
<?php if ($script_function_parameter_relation_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($script_function_parameter_relation_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $script_function_parameter_relation_list->PageUrl() ?>start=<?php echo $script_function_parameter_relation_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($script_function_parameter_relation_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $script_function_parameter_relation_list->PageUrl() ?>start=<?php echo $script_function_parameter_relation_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($script_function_parameter_relation_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $script_function_parameter_relation_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($script_function_parameter_relation_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $script_function_parameter_relation_list->PageUrl() ?>start=<?php echo $script_function_parameter_relation_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($script_function_parameter_relation_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $script_function_parameter_relation_list->PageUrl() ?>start=<?php echo $script_function_parameter_relation_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($script_function_parameter_relation_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $script_function_parameter_relation_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $script_function_parameter_relation_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $script_function_parameter_relation_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($script_function_parameter_relation_list->SearchWhere == "0=101") { ?>
	<p><?php echo $Language->Phrase("EnterSearchCriteria") ?></p>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
	<?php } ?>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoPermission") ?></p>
	<?php } ?>
<?php } ?>
</td>
<?php if ($script_function_parameter_relation_list->TotalRecs > 0) { ?>
<td>
	&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="t" value="script_function_parameter_relation">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="input-small" onchange="this.form.submit();">
<option value="10"<?php if ($script_function_parameter_relation_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($script_function_parameter_relation_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($script_function_parameter_relation_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($script_function_parameter_relation_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($script_function_parameter_relation->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</td>
<?php } ?>
</tr></table>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($script_function_parameter_relation_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
</div>
<?php } ?>
<form name="fscript_function_parameter_relationlist" id="fscript_function_parameter_relationlist" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="script_function_parameter_relation">
<div id="gmp_script_function_parameter_relation" class="ewGridMiddlePanel">
<?php if ($script_function_parameter_relation_list->TotalRecs > 0 || $script_function_parameter_relation->CurrentAction == "add" || $script_function_parameter_relation->CurrentAction == "copy") { ?>
<table id="tbl_script_function_parameter_relationlist" class="ewTable ewTableSeparate">
<?php echo $script_function_parameter_relation->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$script_function_parameter_relation_list->RenderListOptions();

// Render list options (header, left)
$script_function_parameter_relation_list->ListOptions->Render("header", "left");
?>
<?php if ($script_function_parameter_relation->script_function_parameter_relation->Visible) { // script_function_parameter_relation ?>
	<?php if ($script_function_parameter_relation->SortUrl($script_function_parameter_relation->script_function_parameter_relation) == "") { ?>
		<td><div id="elh_script_function_parameter_relation_script_function_parameter_relation" class="script_function_parameter_relation_script_function_parameter_relation"><div class="ewTableHeaderCaption"><?php echo $script_function_parameter_relation->script_function_parameter_relation->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $script_function_parameter_relation->SortUrl($script_function_parameter_relation->script_function_parameter_relation) ?>',1);"><div id="elh_script_function_parameter_relation_script_function_parameter_relation" class="script_function_parameter_relation_script_function_parameter_relation">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $script_function_parameter_relation->script_function_parameter_relation->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($script_function_parameter_relation->script_function_parameter_relation->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($script_function_parameter_relation->script_function_parameter_relation->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($script_function_parameter_relation->parameter_id->Visible) { // parameter_id ?>
	<?php if ($script_function_parameter_relation->SortUrl($script_function_parameter_relation->parameter_id) == "") { ?>
		<td><div id="elh_script_function_parameter_relation_parameter_id" class="script_function_parameter_relation_parameter_id"><div class="ewTableHeaderCaption"><?php echo $script_function_parameter_relation->parameter_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $script_function_parameter_relation->SortUrl($script_function_parameter_relation->parameter_id) ?>',1);"><div id="elh_script_function_parameter_relation_parameter_id" class="script_function_parameter_relation_parameter_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $script_function_parameter_relation->parameter_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($script_function_parameter_relation->parameter_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($script_function_parameter_relation->parameter_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($script_function_parameter_relation->script_function_id->Visible) { // script_function_id ?>
	<?php if ($script_function_parameter_relation->SortUrl($script_function_parameter_relation->script_function_id) == "") { ?>
		<td><div id="elh_script_function_parameter_relation_script_function_id" class="script_function_parameter_relation_script_function_id"><div class="ewTableHeaderCaption"><?php echo $script_function_parameter_relation->script_function_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $script_function_parameter_relation->SortUrl($script_function_parameter_relation->script_function_id) ?>',1);"><div id="elh_script_function_parameter_relation_script_function_id" class="script_function_parameter_relation_script_function_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $script_function_parameter_relation->script_function_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($script_function_parameter_relation->script_function_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($script_function_parameter_relation->script_function_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$script_function_parameter_relation_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($script_function_parameter_relation->CurrentAction == "add" || $script_function_parameter_relation->CurrentAction == "copy") {
		$script_function_parameter_relation_list->RowIndex = 0;
		$script_function_parameter_relation_list->KeyCount = $script_function_parameter_relation_list->RowIndex;
		if ($script_function_parameter_relation->CurrentAction == "copy" && !$script_function_parameter_relation_list->LoadRow())
				$script_function_parameter_relation->CurrentAction = "add";
		if ($script_function_parameter_relation->CurrentAction == "add")
			$script_function_parameter_relation_list->LoadDefaultValues();
		if ($script_function_parameter_relation->EventCancelled) // Insert failed
			$script_function_parameter_relation_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$script_function_parameter_relation->ResetAttrs();
		$script_function_parameter_relation->RowAttrs = array_merge($script_function_parameter_relation->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_script_function_parameter_relation', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$script_function_parameter_relation->RowType = EW_ROWTYPE_ADD;

		// Render row
		$script_function_parameter_relation_list->RenderRow();

		// Render list options
		$script_function_parameter_relation_list->RenderListOptions();
		$script_function_parameter_relation_list->StartRowCnt = 0;
?>
	<tr<?php echo $script_function_parameter_relation->RowAttributes() ?>>
<?php

// Render list options (body, left)
$script_function_parameter_relation_list->ListOptions->Render("body", "left", $script_function_parameter_relation_list->RowCnt);
?>
	<?php if ($script_function_parameter_relation->script_function_parameter_relation->Visible) { // script_function_parameter_relation ?>
		<td>
<input type="hidden" data-field="x_script_function_parameter_relation" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_parameter_relation" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_parameter_relation" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->script_function_parameter_relation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($script_function_parameter_relation->parameter_id->Visible) { // parameter_id ?>
		<td>
<span id="el<?php echo $script_function_parameter_relation_list->RowCnt ?>_script_function_parameter_relation_parameter_id" class="control-group script_function_parameter_relation_parameter_id">
<select data-field="x_parameter_id" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id"<?php echo $script_function_parameter_relation->parameter_id->EditAttributes() ?>>
<?php
if (is_array($script_function_parameter_relation->parameter_id->EditValue)) {
	$arwrk = $script_function_parameter_relation->parameter_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($script_function_parameter_relation->parameter_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $script_function_parameter_relation->parameter_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `parameter_id`, `parameter_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `parameter`";
$sWhereWrk = "";

// Call Lookup selecting
$script_function_parameter_relation->Lookup_Selecting($script_function_parameter_relation->parameter_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" id="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`parameter_id` = {filter_value}"); ?>&t0=3">
</span>
<input type="hidden" data-field="x_parameter_id" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->parameter_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($script_function_parameter_relation->script_function_id->Visible) { // script_function_id ?>
		<td>
<span id="el<?php echo $script_function_parameter_relation_list->RowCnt ?>_script_function_parameter_relation_script_function_id" class="control-group script_function_parameter_relation_script_function_id">
<select data-field="x_script_function_id" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id"<?php echo $script_function_parameter_relation->script_function_id->EditAttributes() ?>>
<?php
if (is_array($script_function_parameter_relation->script_function_id->EditValue)) {
	$arwrk = $script_function_parameter_relation->script_function_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($script_function_parameter_relation->script_function_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $script_function_parameter_relation->script_function_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `script_function_id`, `script_function_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `script_function`";
$sWhereWrk = "";

// Call Lookup selecting
$script_function_parameter_relation->Lookup_Selecting($script_function_parameter_relation->script_function_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" id="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`script_function_id` = {filter_value}"); ?>&t0=3">
</span>
<input type="hidden" data-field="x_script_function_id" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->script_function_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$script_function_parameter_relation_list->ListOptions->Render("body", "right", $script_function_parameter_relation_list->RowCnt);
?>
<script type="text/javascript">
fscript_function_parameter_relationlist.UpdateOpts(<?php echo $script_function_parameter_relation_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($script_function_parameter_relation->ExportAll && $script_function_parameter_relation->Export <> "") {
	$script_function_parameter_relation_list->StopRec = $script_function_parameter_relation_list->TotalRecs;
} else {

	// Set the last record to display
	if ($script_function_parameter_relation_list->TotalRecs > $script_function_parameter_relation_list->StartRec + $script_function_parameter_relation_list->DisplayRecs - 1)
		$script_function_parameter_relation_list->StopRec = $script_function_parameter_relation_list->StartRec + $script_function_parameter_relation_list->DisplayRecs - 1;
	else
		$script_function_parameter_relation_list->StopRec = $script_function_parameter_relation_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($script_function_parameter_relation_list->FormKeyCountName) && ($script_function_parameter_relation->CurrentAction == "gridadd" || $script_function_parameter_relation->CurrentAction == "gridedit" || $script_function_parameter_relation->CurrentAction == "F")) {
		$script_function_parameter_relation_list->KeyCount = $objForm->GetValue($script_function_parameter_relation_list->FormKeyCountName);
		$script_function_parameter_relation_list->StopRec = $script_function_parameter_relation_list->StartRec + $script_function_parameter_relation_list->KeyCount - 1;
	}
}
$script_function_parameter_relation_list->RecCnt = $script_function_parameter_relation_list->StartRec - 1;
if ($script_function_parameter_relation_list->Recordset && !$script_function_parameter_relation_list->Recordset->EOF) {
	$script_function_parameter_relation_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $script_function_parameter_relation_list->StartRec > 1)
		$script_function_parameter_relation_list->Recordset->Move($script_function_parameter_relation_list->StartRec - 1);
} elseif (!$script_function_parameter_relation->AllowAddDeleteRow && $script_function_parameter_relation_list->StopRec == 0) {
	$script_function_parameter_relation_list->StopRec = $script_function_parameter_relation->GridAddRowCount;
}

// Initialize aggregate
$script_function_parameter_relation->RowType = EW_ROWTYPE_AGGREGATEINIT;
$script_function_parameter_relation->ResetAttrs();
$script_function_parameter_relation_list->RenderRow();
$script_function_parameter_relation_list->EditRowCnt = 0;
if ($script_function_parameter_relation->CurrentAction == "edit")
	$script_function_parameter_relation_list->RowIndex = 1;
if ($script_function_parameter_relation->CurrentAction == "gridadd")
	$script_function_parameter_relation_list->RowIndex = 0;
if ($script_function_parameter_relation->CurrentAction == "gridedit")
	$script_function_parameter_relation_list->RowIndex = 0;
while ($script_function_parameter_relation_list->RecCnt < $script_function_parameter_relation_list->StopRec) {
	$script_function_parameter_relation_list->RecCnt++;
	if (intval($script_function_parameter_relation_list->RecCnt) >= intval($script_function_parameter_relation_list->StartRec)) {
		$script_function_parameter_relation_list->RowCnt++;
		if ($script_function_parameter_relation->CurrentAction == "gridadd" || $script_function_parameter_relation->CurrentAction == "gridedit" || $script_function_parameter_relation->CurrentAction == "F") {
			$script_function_parameter_relation_list->RowIndex++;
			$objForm->Index = $script_function_parameter_relation_list->RowIndex;
			if ($objForm->HasValue($script_function_parameter_relation_list->FormActionName))
				$script_function_parameter_relation_list->RowAction = strval($objForm->GetValue($script_function_parameter_relation_list->FormActionName));
			elseif ($script_function_parameter_relation->CurrentAction == "gridadd")
				$script_function_parameter_relation_list->RowAction = "insert";
			else
				$script_function_parameter_relation_list->RowAction = "";
		}

		// Set up key count
		$script_function_parameter_relation_list->KeyCount = $script_function_parameter_relation_list->RowIndex;

		// Init row class and style
		$script_function_parameter_relation->ResetAttrs();
		$script_function_parameter_relation->CssClass = "";
		if ($script_function_parameter_relation->CurrentAction == "gridadd") {
			$script_function_parameter_relation_list->LoadDefaultValues(); // Load default values
		} else {
			$script_function_parameter_relation_list->LoadRowValues($script_function_parameter_relation_list->Recordset); // Load row values
		}
		$script_function_parameter_relation->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($script_function_parameter_relation->CurrentAction == "gridadd") // Grid add
			$script_function_parameter_relation->RowType = EW_ROWTYPE_ADD; // Render add
		if ($script_function_parameter_relation->CurrentAction == "gridadd" && $script_function_parameter_relation->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$script_function_parameter_relation_list->RestoreCurrentRowFormValues($script_function_parameter_relation_list->RowIndex); // Restore form values
		if ($script_function_parameter_relation->CurrentAction == "edit") {
			if ($script_function_parameter_relation_list->CheckInlineEditKey() && $script_function_parameter_relation_list->EditRowCnt == 0) { // Inline edit
				$script_function_parameter_relation->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($script_function_parameter_relation->CurrentAction == "gridedit") { // Grid edit
			if ($script_function_parameter_relation->EventCancelled) {
				$script_function_parameter_relation_list->RestoreCurrentRowFormValues($script_function_parameter_relation_list->RowIndex); // Restore form values
			}
			if ($script_function_parameter_relation_list->RowAction == "insert")
				$script_function_parameter_relation->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$script_function_parameter_relation->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($script_function_parameter_relation->CurrentAction == "edit" && $script_function_parameter_relation->RowType == EW_ROWTYPE_EDIT && $script_function_parameter_relation->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$script_function_parameter_relation_list->RestoreFormValues(); // Restore form values
		}
		if ($script_function_parameter_relation->CurrentAction == "gridedit" && ($script_function_parameter_relation->RowType == EW_ROWTYPE_EDIT || $script_function_parameter_relation->RowType == EW_ROWTYPE_ADD) && $script_function_parameter_relation->EventCancelled) // Update failed
			$script_function_parameter_relation_list->RestoreCurrentRowFormValues($script_function_parameter_relation_list->RowIndex); // Restore form values
		if ($script_function_parameter_relation->RowType == EW_ROWTYPE_EDIT) // Edit row
			$script_function_parameter_relation_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$script_function_parameter_relation->RowAttrs = array_merge($script_function_parameter_relation->RowAttrs, array('data-rowindex'=>$script_function_parameter_relation_list->RowCnt, 'id'=>'r' . $script_function_parameter_relation_list->RowCnt . '_script_function_parameter_relation', 'data-rowtype'=>$script_function_parameter_relation->RowType));

		// Render row
		$script_function_parameter_relation_list->RenderRow();

		// Render list options
		$script_function_parameter_relation_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($script_function_parameter_relation_list->RowAction <> "delete" && $script_function_parameter_relation_list->RowAction <> "insertdelete" && !($script_function_parameter_relation_list->RowAction == "insert" && $script_function_parameter_relation->CurrentAction == "F" && $script_function_parameter_relation_list->EmptyRow())) {
?>
	<tr<?php echo $script_function_parameter_relation->RowAttributes() ?>>
<?php

// Render list options (body, left)
$script_function_parameter_relation_list->ListOptions->Render("body", "left", $script_function_parameter_relation_list->RowCnt);
?>
	<?php if ($script_function_parameter_relation->script_function_parameter_relation->Visible) { // script_function_parameter_relation ?>
		<td<?php echo $script_function_parameter_relation->script_function_parameter_relation->CellAttributes() ?>>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-field="x_script_function_parameter_relation" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_parameter_relation" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_parameter_relation" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->script_function_parameter_relation->OldValue) ?>">
<?php } ?>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $script_function_parameter_relation_list->RowCnt ?>_script_function_parameter_relation_script_function_parameter_relation" class="control-group script_function_parameter_relation_script_function_parameter_relation">
<span<?php echo $script_function_parameter_relation->script_function_parameter_relation->ViewAttributes() ?>>
<?php echo $script_function_parameter_relation->script_function_parameter_relation->EditValue ?></span>
</span>
<input type="hidden" data-field="x_script_function_parameter_relation" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_parameter_relation" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_parameter_relation" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->script_function_parameter_relation->CurrentValue) ?>">
<?php } ?>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $script_function_parameter_relation->script_function_parameter_relation->ViewAttributes() ?>>
<?php echo $script_function_parameter_relation->script_function_parameter_relation->ListViewValue() ?></span>
<?php } ?>
<a id="<?php echo $script_function_parameter_relation_list->PageObjName . "_row_" . $script_function_parameter_relation_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($script_function_parameter_relation->parameter_id->Visible) { // parameter_id ?>
		<td<?php echo $script_function_parameter_relation->parameter_id->CellAttributes() ?>>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $script_function_parameter_relation_list->RowCnt ?>_script_function_parameter_relation_parameter_id" class="control-group script_function_parameter_relation_parameter_id">
<select data-field="x_parameter_id" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id"<?php echo $script_function_parameter_relation->parameter_id->EditAttributes() ?>>
<?php
if (is_array($script_function_parameter_relation->parameter_id->EditValue)) {
	$arwrk = $script_function_parameter_relation->parameter_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($script_function_parameter_relation->parameter_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $script_function_parameter_relation->parameter_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `parameter_id`, `parameter_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `parameter`";
$sWhereWrk = "";

// Call Lookup selecting
$script_function_parameter_relation->Lookup_Selecting($script_function_parameter_relation->parameter_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" id="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`parameter_id` = {filter_value}"); ?>&t0=3">
</span>
<input type="hidden" data-field="x_parameter_id" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->parameter_id->OldValue) ?>">
<?php } ?>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $script_function_parameter_relation_list->RowCnt ?>_script_function_parameter_relation_parameter_id" class="control-group script_function_parameter_relation_parameter_id">
<select data-field="x_parameter_id" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id"<?php echo $script_function_parameter_relation->parameter_id->EditAttributes() ?>>
<?php
if (is_array($script_function_parameter_relation->parameter_id->EditValue)) {
	$arwrk = $script_function_parameter_relation->parameter_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($script_function_parameter_relation->parameter_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $script_function_parameter_relation->parameter_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `parameter_id`, `parameter_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `parameter`";
$sWhereWrk = "";

// Call Lookup selecting
$script_function_parameter_relation->Lookup_Selecting($script_function_parameter_relation->parameter_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" id="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`parameter_id` = {filter_value}"); ?>&t0=3">
</span>
<?php } ?>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $script_function_parameter_relation->parameter_id->ViewAttributes() ?>>
<?php echo $script_function_parameter_relation->parameter_id->ListViewValue() ?></span>
<?php } ?>
<a id="<?php echo $script_function_parameter_relation_list->PageObjName . "_row_" . $script_function_parameter_relation_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($script_function_parameter_relation->script_function_id->Visible) { // script_function_id ?>
		<td<?php echo $script_function_parameter_relation->script_function_id->CellAttributes() ?>>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $script_function_parameter_relation_list->RowCnt ?>_script_function_parameter_relation_script_function_id" class="control-group script_function_parameter_relation_script_function_id">
<select data-field="x_script_function_id" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id"<?php echo $script_function_parameter_relation->script_function_id->EditAttributes() ?>>
<?php
if (is_array($script_function_parameter_relation->script_function_id->EditValue)) {
	$arwrk = $script_function_parameter_relation->script_function_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($script_function_parameter_relation->script_function_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $script_function_parameter_relation->script_function_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `script_function_id`, `script_function_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `script_function`";
$sWhereWrk = "";

// Call Lookup selecting
$script_function_parameter_relation->Lookup_Selecting($script_function_parameter_relation->script_function_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" id="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`script_function_id` = {filter_value}"); ?>&t0=3">
</span>
<input type="hidden" data-field="x_script_function_id" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->script_function_id->OldValue) ?>">
<?php } ?>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $script_function_parameter_relation_list->RowCnt ?>_script_function_parameter_relation_script_function_id" class="control-group script_function_parameter_relation_script_function_id">
<select data-field="x_script_function_id" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id"<?php echo $script_function_parameter_relation->script_function_id->EditAttributes() ?>>
<?php
if (is_array($script_function_parameter_relation->script_function_id->EditValue)) {
	$arwrk = $script_function_parameter_relation->script_function_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($script_function_parameter_relation->script_function_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $script_function_parameter_relation->script_function_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `script_function_id`, `script_function_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `script_function`";
$sWhereWrk = "";

// Call Lookup selecting
$script_function_parameter_relation->Lookup_Selecting($script_function_parameter_relation->script_function_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" id="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`script_function_id` = {filter_value}"); ?>&t0=3">
</span>
<?php } ?>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $script_function_parameter_relation->script_function_id->ViewAttributes() ?>>
<?php echo $script_function_parameter_relation->script_function_id->ListViewValue() ?></span>
<?php } ?>
<a id="<?php echo $script_function_parameter_relation_list->PageObjName . "_row_" . $script_function_parameter_relation_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$script_function_parameter_relation_list->ListOptions->Render("body", "right", $script_function_parameter_relation_list->RowCnt);
?>
	</tr>
<?php if ($script_function_parameter_relation->RowType == EW_ROWTYPE_ADD || $script_function_parameter_relation->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fscript_function_parameter_relationlist.UpdateOpts(<?php echo $script_function_parameter_relation_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($script_function_parameter_relation->CurrentAction <> "gridadd")
		if (!$script_function_parameter_relation_list->Recordset->EOF) $script_function_parameter_relation_list->Recordset->MoveNext();
}
?>
<?php
	if ($script_function_parameter_relation->CurrentAction == "gridadd" || $script_function_parameter_relation->CurrentAction == "gridedit") {
		$script_function_parameter_relation_list->RowIndex = '$rowindex$';
		$script_function_parameter_relation_list->LoadDefaultValues();

		// Set row properties
		$script_function_parameter_relation->ResetAttrs();
		$script_function_parameter_relation->RowAttrs = array_merge($script_function_parameter_relation->RowAttrs, array('data-rowindex'=>$script_function_parameter_relation_list->RowIndex, 'id'=>'r0_script_function_parameter_relation', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($script_function_parameter_relation->RowAttrs["class"], "ewTemplate");
		$script_function_parameter_relation->RowType = EW_ROWTYPE_ADD;

		// Render row
		$script_function_parameter_relation_list->RenderRow();

		// Render list options
		$script_function_parameter_relation_list->RenderListOptions();
		$script_function_parameter_relation_list->StartRowCnt = 0;
?>
	<tr<?php echo $script_function_parameter_relation->RowAttributes() ?>>
<?php

// Render list options (body, left)
$script_function_parameter_relation_list->ListOptions->Render("body", "left", $script_function_parameter_relation_list->RowIndex);
?>
	<?php if ($script_function_parameter_relation->script_function_parameter_relation->Visible) { // script_function_parameter_relation ?>
		<td>
<input type="hidden" data-field="x_script_function_parameter_relation" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_parameter_relation" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_parameter_relation" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->script_function_parameter_relation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($script_function_parameter_relation->parameter_id->Visible) { // parameter_id ?>
		<td>
<span id="el$rowindex$_script_function_parameter_relation_parameter_id" class="control-group script_function_parameter_relation_parameter_id">
<select data-field="x_parameter_id" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id"<?php echo $script_function_parameter_relation->parameter_id->EditAttributes() ?>>
<?php
if (is_array($script_function_parameter_relation->parameter_id->EditValue)) {
	$arwrk = $script_function_parameter_relation->parameter_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($script_function_parameter_relation->parameter_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $script_function_parameter_relation->parameter_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `parameter_id`, `parameter_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `parameter`";
$sWhereWrk = "";

// Call Lookup selecting
$script_function_parameter_relation->Lookup_Selecting($script_function_parameter_relation->parameter_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" id="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`parameter_id` = {filter_value}"); ?>&t0=3">
</span>
<input type="hidden" data-field="x_parameter_id" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_parameter_id" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->parameter_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($script_function_parameter_relation->script_function_id->Visible) { // script_function_id ?>
		<td>
<span id="el$rowindex$_script_function_parameter_relation_script_function_id" class="control-group script_function_parameter_relation_script_function_id">
<select data-field="x_script_function_id" id="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" name="x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id"<?php echo $script_function_parameter_relation->script_function_id->EditAttributes() ?>>
<?php
if (is_array($script_function_parameter_relation->script_function_id->EditValue)) {
	$arwrk = $script_function_parameter_relation->script_function_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($script_function_parameter_relation->script_function_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $script_function_parameter_relation->script_function_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `script_function_id`, `script_function_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `script_function`";
$sWhereWrk = "";

// Call Lookup selecting
$script_function_parameter_relation->Lookup_Selecting($script_function_parameter_relation->script_function_id, $sWhereWrk);
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
?>
<input type="hidden" name="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" id="s_x<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" value="s=<?php echo ew_Encrypt($sSqlWrk) ?>&f0=<?php echo ew_Encrypt("`script_function_id` = {filter_value}"); ?>&t0=3">
</span>
<input type="hidden" data-field="x_script_function_id" name="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" id="o<?php echo $script_function_parameter_relation_list->RowIndex ?>_script_function_id" value="<?php echo ew_HtmlEncode($script_function_parameter_relation->script_function_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$script_function_parameter_relation_list->ListOptions->Render("body", "right", $script_function_parameter_relation_list->RowCnt);
?>
<script type="text/javascript">
fscript_function_parameter_relationlist.UpdateOpts(<?php echo $script_function_parameter_relation_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($script_function_parameter_relation->CurrentAction == "add" || $script_function_parameter_relation->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>" id="<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>" value="<?php echo $script_function_parameter_relation_list->KeyCount ?>">
<?php } ?>
<?php if ($script_function_parameter_relation->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>" id="<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>" value="<?php echo $script_function_parameter_relation_list->KeyCount ?>">
<?php echo $script_function_parameter_relation_list->MultiSelectKey ?>
<?php } ?>
<?php if ($script_function_parameter_relation->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>" id="<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>" value="<?php echo $script_function_parameter_relation_list->KeyCount ?>">
<?php } ?>
<?php if ($script_function_parameter_relation->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>" id="<?php echo $script_function_parameter_relation_list->FormKeyCountName ?>" value="<?php echo $script_function_parameter_relation_list->KeyCount ?>">
<?php echo $script_function_parameter_relation_list->MultiSelectKey ?>
<?php } ?>
<?php if ($script_function_parameter_relation->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($script_function_parameter_relation_list->Recordset)
	$script_function_parameter_relation_list->Recordset->Close();
?>
<?php if ($script_function_parameter_relation_list->TotalRecs > 0) { ?>
<?php if ($script_function_parameter_relation->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($script_function_parameter_relation->CurrentAction <> "gridadd" && $script_function_parameter_relation->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($script_function_parameter_relation_list->Pager)) $script_function_parameter_relation_list->Pager = new cNumericPager($script_function_parameter_relation_list->StartRec, $script_function_parameter_relation_list->DisplayRecs, $script_function_parameter_relation_list->TotalRecs, $script_function_parameter_relation_list->RecRange) ?>
<?php if ($script_function_parameter_relation_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($script_function_parameter_relation_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $script_function_parameter_relation_list->PageUrl() ?>start=<?php echo $script_function_parameter_relation_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($script_function_parameter_relation_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $script_function_parameter_relation_list->PageUrl() ?>start=<?php echo $script_function_parameter_relation_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($script_function_parameter_relation_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $script_function_parameter_relation_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($script_function_parameter_relation_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $script_function_parameter_relation_list->PageUrl() ?>start=<?php echo $script_function_parameter_relation_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($script_function_parameter_relation_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $script_function_parameter_relation_list->PageUrl() ?>start=<?php echo $script_function_parameter_relation_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($script_function_parameter_relation_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $script_function_parameter_relation_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $script_function_parameter_relation_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $script_function_parameter_relation_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($script_function_parameter_relation_list->SearchWhere == "0=101") { ?>
	<p><?php echo $Language->Phrase("EnterSearchCriteria") ?></p>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
	<?php } ?>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoPermission") ?></p>
	<?php } ?>
<?php } ?>
</td>
<?php if ($script_function_parameter_relation_list->TotalRecs > 0) { ?>
<td>
	&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="t" value="script_function_parameter_relation">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="input-small" onchange="this.form.submit();">
<option value="10"<?php if ($script_function_parameter_relation_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($script_function_parameter_relation_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($script_function_parameter_relation_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($script_function_parameter_relation_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($script_function_parameter_relation->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</td>
<?php } ?>
</tr></table>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($script_function_parameter_relation_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($script_function_parameter_relation->Export == "") { ?>
<script type="text/javascript">
fscript_function_parameter_relationlist.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php } ?>
<?php
$script_function_parameter_relation_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($script_function_parameter_relation->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$script_function_parameter_relation_list->Page_Terminate();
?>
