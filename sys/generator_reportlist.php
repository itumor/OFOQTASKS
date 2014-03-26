<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "generator_reportinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$generator_report_list = NULL; // Initialize page object first

class cgenerator_report_list extends cgenerator_report {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'generator report';

	// Page object name
	var $PageObjName = 'generator_report_list';

	// Grid form hidden field names
	var $FormName = 'fgenerator_reportlist';
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

		// Table object (generator_report)
		if (!isset($GLOBALS["generator_report"])) {
			$GLOBALS["generator_report"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["generator_report"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "generator_reportadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "generator_reportdelete.php";
		$this->MultiUpdateUrl = "generator_reportupdate.php";

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'generator report', TRUE);

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

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session if not searching / reset
			if ($this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} else {
			$this->SearchWhere = $this->getSearchWhere();
		}

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
		if (count($arrKeyFlds) >= 0) {
		}
		return TRUE;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->task_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->function_group_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->script_function_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->script_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->script_path, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->parameter_name, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		if ($Keyword == EW_NULL_VALUE) {
			$sWrk = $Fld->FldExpression . " IS NULL";
		} elseif ($Keyword == EW_NOT_NULL_VALUE) {
			$sWrk = $Fld->FldExpression . " IS NOT NULL";
		} else {
			$sFldExpression = ($Fld->FldVirtualExpression <> $Fld->FldExpression) ? $Fld->FldVirtualExpression : $Fld->FldBasicSearchExpression;
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $this->BasicSearch->Keyword;
		$sSearchType = $this->BasicSearch->Type;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "=") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
			$this->Command = "search";
		}
		if ($this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->task_id); // task_id
			$this->UpdateSort($this->task_name); // task_name
			$this->UpdateSort($this->task_function_group_id); // task_function_group_id
			$this->UpdateSort($this->function_group_id); // function_group_id
			$this->UpdateSort($this->function_group_name); // function_group_name
			$this->UpdateSort($this->function_group_relation_id); // function_group_relation_id
			$this->UpdateSort($this->priority); // priority
			$this->UpdateSort($this->script_function_id); // script_function_id
			$this->UpdateSort($this->script_function_name); // script_function_name
			$this->UpdateSort($this->script_id); // script_id
			$this->UpdateSort($this->script_name); // script_name
			$this->UpdateSort($this->script_path); // script_path
			$this->UpdateSort($this->start_range); // start_range
			$this->UpdateSort($this->end_range); // end_range
			$this->UpdateSort($this->parameter_id); // parameter_id
			$this->UpdateSort($this->parameter_name); // parameter_name
			$this->UpdateSort($this->function_group_id1); // function_group_id1
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->task_id->setSort("");
				$this->task_name->setSort("");
				$this->task_function_group_id->setSort("");
				$this->function_group_id->setSort("");
				$this->function_group_name->setSort("");
				$this->function_group_relation_id->setSort("");
				$this->priority->setSort("");
				$this->script_function_id->setSort("");
				$this->script_function_name->setSort("");
				$this->script_id->setSort("");
				$this->script_name->setSort("");
				$this->script_path->setSort("");
				$this->start_range->setSort("");
				$this->end_range->setSort("");
				$this->parameter_id->setSort("");
				$this->parameter_name->setSort("");
				$this->function_group_id1->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
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

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

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
			$option = &$options["action"];
			foreach ($this->CustomActions as $action => $name) {

				// Add custom action
				$item = &$option->Add("custom_" . $action);
				$item->Body = "<a class=\"ewAction ewCustomAction\" href=\"\" onclick=\"ew_SubmitSelected(document.fgenerator_reportlist, '" . ew_CurrentUrl() . "', null, '" . $action . "');return false;\">" . $name . "</a>";
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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		$this->task_id->setDbValue($rs->fields('task_id'));
		$this->task_name->setDbValue($rs->fields('task_name'));
		$this->task_function_group_id->setDbValue($rs->fields('task_function_group_id'));
		$this->function_group_id->setDbValue($rs->fields('function_group_id'));
		$this->function_group_name->setDbValue($rs->fields('function_group_name'));
		$this->function_group_relation_id->setDbValue($rs->fields('function_group_relation_id'));
		$this->priority->setDbValue($rs->fields('priority'));
		$this->script_function_id->setDbValue($rs->fields('script_function_id'));
		$this->script_function_name->setDbValue($rs->fields('script_function_name'));
		$this->script_id->setDbValue($rs->fields('script_id'));
		$this->script_name->setDbValue($rs->fields('script_name'));
		$this->script_path->Upload->DbValue = $rs->fields('script_path');
		$this->start_range->setDbValue($rs->fields('start_range'));
		$this->end_range->setDbValue($rs->fields('end_range'));
		$this->parameter_id->setDbValue($rs->fields('parameter_id'));
		$this->parameter_name->setDbValue($rs->fields('parameter_name'));
		$this->function_group_id1->setDbValue($rs->fields('function_group_id1'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->task_id->DbValue = $row['task_id'];
		$this->task_name->DbValue = $row['task_name'];
		$this->task_function_group_id->DbValue = $row['task_function_group_id'];
		$this->function_group_id->DbValue = $row['function_group_id'];
		$this->function_group_name->DbValue = $row['function_group_name'];
		$this->function_group_relation_id->DbValue = $row['function_group_relation_id'];
		$this->priority->DbValue = $row['priority'];
		$this->script_function_id->DbValue = $row['script_function_id'];
		$this->script_function_name->DbValue = $row['script_function_name'];
		$this->script_id->DbValue = $row['script_id'];
		$this->script_name->DbValue = $row['script_name'];
		$this->script_path->Upload->DbValue = $row['script_path'];
		$this->start_range->DbValue = $row['start_range'];
		$this->end_range->DbValue = $row['end_range'];
		$this->parameter_id->DbValue = $row['parameter_id'];
		$this->parameter_name->DbValue = $row['parameter_name'];
		$this->function_group_id1->DbValue = $row['function_group_id1'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;

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
		// task_id
		// task_name
		// task_function_group_id
		// function_group_id
		// function_group_name
		// function_group_relation_id
		// priority
		// script_function_id
		// script_function_name
		// script_id
		// script_name
		// script_path
		// start_range
		// end_range
		// parameter_id
		// parameter_name
		// function_group_id1

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// task_id
			$this->task_id->ViewValue = $this->task_id->CurrentValue;
			$this->task_id->ViewCustomAttributes = "";

			// task_name
			$this->task_name->ViewValue = $this->task_name->CurrentValue;
			$this->task_name->ViewCustomAttributes = "";

			// task_function_group_id
			$this->task_function_group_id->ViewValue = $this->task_function_group_id->CurrentValue;
			$this->task_function_group_id->ViewCustomAttributes = "";

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

			// function_group_name
			$this->function_group_name->ViewValue = $this->function_group_name->CurrentValue;
			$this->function_group_name->ViewCustomAttributes = "";

			// function_group_relation_id
			$this->function_group_relation_id->ViewValue = $this->function_group_relation_id->CurrentValue;
			$this->function_group_relation_id->ViewCustomAttributes = "";

			// priority
			$this->priority->ViewValue = $this->priority->CurrentValue;
			$this->priority->ViewCustomAttributes = "";

			// script_function_id
			$this->script_function_id->ViewValue = $this->script_function_id->CurrentValue;
			$this->script_function_id->ViewCustomAttributes = "";

			// script_function_name
			$this->script_function_name->ViewValue = $this->script_function_name->CurrentValue;
			$this->script_function_name->ViewCustomAttributes = "";

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

			// parameter_id
			$this->parameter_id->ViewValue = $this->parameter_id->CurrentValue;
			$this->parameter_id->ViewCustomAttributes = "";

			// parameter_name
			$this->parameter_name->ViewValue = $this->parameter_name->CurrentValue;
			$this->parameter_name->ViewCustomAttributes = "";

			// function_group_id1
			if (strval($this->function_group_id1->CurrentValue) <> "") {
				$sFilterWrk = "`function_group_id`" . ew_SearchString("=", $this->function_group_id1->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `function_group_id`, `function_group_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `function_group`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->function_group_id1, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->function_group_id1->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->function_group_id1->ViewValue = $this->function_group_id1->CurrentValue;
				}
			} else {
				$this->function_group_id1->ViewValue = NULL;
			}
			$this->function_group_id1->ViewCustomAttributes = "";

			// task_id
			$this->task_id->LinkCustomAttributes = "";
			$this->task_id->HrefValue = "";
			$this->task_id->TooltipValue = "";

			// task_name
			$this->task_name->LinkCustomAttributes = "";
			$this->task_name->HrefValue = "";
			$this->task_name->TooltipValue = "";

			// task_function_group_id
			$this->task_function_group_id->LinkCustomAttributes = "";
			$this->task_function_group_id->HrefValue = "";
			$this->task_function_group_id->TooltipValue = "";

			// function_group_id
			$this->function_group_id->LinkCustomAttributes = "";
			$this->function_group_id->HrefValue = "";
			$this->function_group_id->TooltipValue = "";

			// function_group_name
			$this->function_group_name->LinkCustomAttributes = "";
			$this->function_group_name->HrefValue = "";
			$this->function_group_name->TooltipValue = "";

			// function_group_relation_id
			$this->function_group_relation_id->LinkCustomAttributes = "";
			$this->function_group_relation_id->HrefValue = "";
			$this->function_group_relation_id->TooltipValue = "";

			// priority
			$this->priority->LinkCustomAttributes = "";
			$this->priority->HrefValue = "";
			$this->priority->TooltipValue = "";

			// script_function_id
			$this->script_function_id->LinkCustomAttributes = "";
			$this->script_function_id->HrefValue = "";
			$this->script_function_id->TooltipValue = "";

			// script_function_name
			$this->script_function_name->LinkCustomAttributes = "";
			$this->script_function_name->HrefValue = "";
			$this->script_function_name->TooltipValue = "";

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

			// parameter_id
			$this->parameter_id->LinkCustomAttributes = "";
			$this->parameter_id->HrefValue = "";
			$this->parameter_id->TooltipValue = "";

			// parameter_name
			$this->parameter_name->LinkCustomAttributes = "";
			$this->parameter_name->HrefValue = "";
			$this->parameter_name->TooltipValue = "";

			// function_group_id1
			$this->function_group_id1->LinkCustomAttributes = "";
			$this->function_group_id1->HrefValue = "";
			$this->function_group_id1->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$item->Body = "<a id=\"emf_generator_report\" href=\"javascript:void(0);\" class=\"ewExportLink ewEmail\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_generator_report',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fgenerator_reportlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
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
		if ($this->BasicSearch->getKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . urlencode($this->BasicSearch->getKeyword()) . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . urlencode($this->BasicSearch->getType());
		}

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
if (!isset($generator_report_list)) $generator_report_list = new cgenerator_report_list();

// Page init
$generator_report_list->Page_Init();

// Page main
$generator_report_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$generator_report_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($generator_report->Export == "") { ?>
<script type="text/javascript">

// Page object
var generator_report_list = new ew_Page("generator_report_list");
generator_report_list.PageID = "list"; // Page ID
var EW_PAGE_ID = generator_report_list.PageID; // For backward compatibility

// Form object
var fgenerator_reportlist = new ew_Form("fgenerator_reportlist");
fgenerator_reportlist.FormKeyCountName = '<?php echo $generator_report_list->FormKeyCountName ?>';

// Form_CustomValidate event
fgenerator_reportlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fgenerator_reportlist.ValidateRequired = true;
<?php } else { ?>
fgenerator_reportlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fgenerator_reportlist.Lists["x_function_group_id"] = {"LinkField":"x_function_group_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_function_group_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fgenerator_reportlist.Lists["x_function_group_id1"] = {"LinkField":"x_function_group_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_function_group_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
var fgenerator_reportlistsrch = new ew_Form("fgenerator_reportlistsrch");

// Init search panel as collapsed
if (fgenerator_reportlistsrch) fgenerator_reportlistsrch.InitSearchPanel = true;
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($generator_report->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($generator_report_list->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $generator_report_list->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$generator_report_list->TotalRecs = $generator_report->SelectRecordCount();
	} else {
		if ($generator_report_list->Recordset = $generator_report_list->LoadRecordset())
			$generator_report_list->TotalRecs = $generator_report_list->Recordset->RecordCount();
	}
	$generator_report_list->StartRec = 1;
	if ($generator_report_list->DisplayRecs <= 0 || ($generator_report->Export <> "" && $generator_report->ExportAll)) // Display all records
		$generator_report_list->DisplayRecs = $generator_report_list->TotalRecs;
	if (!($generator_report->Export <> "" && $generator_report->ExportAll))
		$generator_report_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$generator_report_list->Recordset = $generator_report_list->LoadRecordset($generator_report_list->StartRec-1, $generator_report_list->DisplayRecs);
$generator_report_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($generator_report->Export == "" && $generator_report->CurrentAction == "") { ?>
<form name="fgenerator_reportlistsrch" id="fgenerator_reportlistsrch" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>">
<table class="ewSearchTable"><tr><td>
<div class="accordion" id="fgenerator_reportlistsrch_SearchGroup">
	<div class="accordion-group">
		<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#fgenerator_reportlistsrch_SearchGroup" href="#fgenerator_reportlistsrch_SearchBody"><?php echo $Language->Phrase("Search") ?></a>
		</div>
		<div id="fgenerator_reportlistsrch_SearchBody" class="accordion-body collapse in">
			<div class="accordion-inner">
<div id="fgenerator_reportlistsrch_SearchPanel">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="generator_report">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="btn-group ewButtonGroup">
	<div class="input-append">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="input-large" value="<?php echo ew_HtmlEncode($generator_report_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo $Language->Phrase("Search") ?>">
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
	</div>
	</div>
	<div class="btn-group ewButtonGroup">
	<a class="btn ewShowAll" href="<?php echo $generator_report_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>
</div>
<div id="xsr_2" class="ewRow">
	<label class="inline radio ewRadio" style="white-space: nowrap;"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="="<?php if ($generator_report_list->BasicSearch->getType() == "=") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>
	<label class="inline radio ewRadio" style="white-space: nowrap;"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($generator_report_list->BasicSearch->getType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>
	<label class="inline radio ewRadio" style="white-space: nowrap;"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($generator_report_list->BasicSearch->getType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</div>
			</div>
		</div>
	</div>
</div>
</td></tr></table>
</form>
<?php } ?>
<?php } ?>
<?php $generator_report_list->ShowPageHeader(); ?>
<?php
$generator_report_list->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($generator_report->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($generator_report->CurrentAction <> "gridadd" && $generator_report->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($generator_report_list->Pager)) $generator_report_list->Pager = new cNumericPager($generator_report_list->StartRec, $generator_report_list->DisplayRecs, $generator_report_list->TotalRecs, $generator_report_list->RecRange) ?>
<?php if ($generator_report_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($generator_report_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $generator_report_list->PageUrl() ?>start=<?php echo $generator_report_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($generator_report_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $generator_report_list->PageUrl() ?>start=<?php echo $generator_report_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($generator_report_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $generator_report_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($generator_report_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $generator_report_list->PageUrl() ?>start=<?php echo $generator_report_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($generator_report_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $generator_report_list->PageUrl() ?>start=<?php echo $generator_report_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($generator_report_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $generator_report_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $generator_report_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $generator_report_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($generator_report_list->SearchWhere == "0=101") { ?>
	<p><?php echo $Language->Phrase("EnterSearchCriteria") ?></p>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
	<?php } ?>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoPermission") ?></p>
	<?php } ?>
<?php } ?>
</td>
<?php if ($generator_report_list->TotalRecs > 0) { ?>
<td>
	&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="t" value="generator_report">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="input-small" onchange="this.form.submit();">
<option value="10"<?php if ($generator_report_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($generator_report_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($generator_report_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($generator_report_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($generator_report->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</td>
<?php } ?>
</tr></table>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($generator_report_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
</div>
<?php } ?>
<form name="fgenerator_reportlist" id="fgenerator_reportlist" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="generator_report">
<div id="gmp_generator_report" class="ewGridMiddlePanel">
<?php if ($generator_report_list->TotalRecs > 0) { ?>
<table id="tbl_generator_reportlist" class="ewTable ewTableSeparate">
<?php echo $generator_report->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$generator_report_list->RenderListOptions();

// Render list options (header, left)
$generator_report_list->ListOptions->Render("header", "left");
?>
<?php if ($generator_report->task_id->Visible) { // task_id ?>
	<?php if ($generator_report->SortUrl($generator_report->task_id) == "") { ?>
		<td><div id="elh_generator_report_task_id" class="generator_report_task_id"><div class="ewTableHeaderCaption"><?php echo $generator_report->task_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->task_id) ?>',1);"><div id="elh_generator_report_task_id" class="generator_report_task_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->task_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->task_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->task_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->task_name->Visible) { // task_name ?>
	<?php if ($generator_report->SortUrl($generator_report->task_name) == "") { ?>
		<td><div id="elh_generator_report_task_name" class="generator_report_task_name"><div class="ewTableHeaderCaption"><?php echo $generator_report->task_name->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->task_name) ?>',1);"><div id="elh_generator_report_task_name" class="generator_report_task_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->task_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->task_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->task_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->task_function_group_id->Visible) { // task_function_group_id ?>
	<?php if ($generator_report->SortUrl($generator_report->task_function_group_id) == "") { ?>
		<td><div id="elh_generator_report_task_function_group_id" class="generator_report_task_function_group_id"><div class="ewTableHeaderCaption"><?php echo $generator_report->task_function_group_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->task_function_group_id) ?>',1);"><div id="elh_generator_report_task_function_group_id" class="generator_report_task_function_group_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->task_function_group_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->task_function_group_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->task_function_group_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->function_group_id->Visible) { // function_group_id ?>
	<?php if ($generator_report->SortUrl($generator_report->function_group_id) == "") { ?>
		<td><div id="elh_generator_report_function_group_id" class="generator_report_function_group_id"><div class="ewTableHeaderCaption"><?php echo $generator_report->function_group_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->function_group_id) ?>',1);"><div id="elh_generator_report_function_group_id" class="generator_report_function_group_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->function_group_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->function_group_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->function_group_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->function_group_name->Visible) { // function_group_name ?>
	<?php if ($generator_report->SortUrl($generator_report->function_group_name) == "") { ?>
		<td><div id="elh_generator_report_function_group_name" class="generator_report_function_group_name"><div class="ewTableHeaderCaption"><?php echo $generator_report->function_group_name->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->function_group_name) ?>',1);"><div id="elh_generator_report_function_group_name" class="generator_report_function_group_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->function_group_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->function_group_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->function_group_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->function_group_relation_id->Visible) { // function_group_relation_id ?>
	<?php if ($generator_report->SortUrl($generator_report->function_group_relation_id) == "") { ?>
		<td><div id="elh_generator_report_function_group_relation_id" class="generator_report_function_group_relation_id"><div class="ewTableHeaderCaption"><?php echo $generator_report->function_group_relation_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->function_group_relation_id) ?>',1);"><div id="elh_generator_report_function_group_relation_id" class="generator_report_function_group_relation_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->function_group_relation_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->function_group_relation_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->function_group_relation_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->priority->Visible) { // priority ?>
	<?php if ($generator_report->SortUrl($generator_report->priority) == "") { ?>
		<td><div id="elh_generator_report_priority" class="generator_report_priority"><div class="ewTableHeaderCaption"><?php echo $generator_report->priority->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->priority) ?>',1);"><div id="elh_generator_report_priority" class="generator_report_priority">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->priority->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->priority->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->priority->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->script_function_id->Visible) { // script_function_id ?>
	<?php if ($generator_report->SortUrl($generator_report->script_function_id) == "") { ?>
		<td><div id="elh_generator_report_script_function_id" class="generator_report_script_function_id"><div class="ewTableHeaderCaption"><?php echo $generator_report->script_function_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->script_function_id) ?>',1);"><div id="elh_generator_report_script_function_id" class="generator_report_script_function_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->script_function_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->script_function_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->script_function_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->script_function_name->Visible) { // script_function_name ?>
	<?php if ($generator_report->SortUrl($generator_report->script_function_name) == "") { ?>
		<td><div id="elh_generator_report_script_function_name" class="generator_report_script_function_name"><div class="ewTableHeaderCaption"><?php echo $generator_report->script_function_name->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->script_function_name) ?>',1);"><div id="elh_generator_report_script_function_name" class="generator_report_script_function_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->script_function_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->script_function_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->script_function_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->script_id->Visible) { // script_id ?>
	<?php if ($generator_report->SortUrl($generator_report->script_id) == "") { ?>
		<td><div id="elh_generator_report_script_id" class="generator_report_script_id"><div class="ewTableHeaderCaption"><?php echo $generator_report->script_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->script_id) ?>',1);"><div id="elh_generator_report_script_id" class="generator_report_script_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->script_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->script_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->script_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->script_name->Visible) { // script_name ?>
	<?php if ($generator_report->SortUrl($generator_report->script_name) == "") { ?>
		<td><div id="elh_generator_report_script_name" class="generator_report_script_name"><div class="ewTableHeaderCaption"><?php echo $generator_report->script_name->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->script_name) ?>',1);"><div id="elh_generator_report_script_name" class="generator_report_script_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->script_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->script_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->script_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->script_path->Visible) { // script_path ?>
	<?php if ($generator_report->SortUrl($generator_report->script_path) == "") { ?>
		<td><div id="elh_generator_report_script_path" class="generator_report_script_path"><div class="ewTableHeaderCaption"><?php echo $generator_report->script_path->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->script_path) ?>',1);"><div id="elh_generator_report_script_path" class="generator_report_script_path">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->script_path->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->script_path->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->script_path->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->start_range->Visible) { // start_range ?>
	<?php if ($generator_report->SortUrl($generator_report->start_range) == "") { ?>
		<td><div id="elh_generator_report_start_range" class="generator_report_start_range"><div class="ewTableHeaderCaption"><?php echo $generator_report->start_range->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->start_range) ?>',1);"><div id="elh_generator_report_start_range" class="generator_report_start_range">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->start_range->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->start_range->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->start_range->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->end_range->Visible) { // end_range ?>
	<?php if ($generator_report->SortUrl($generator_report->end_range) == "") { ?>
		<td><div id="elh_generator_report_end_range" class="generator_report_end_range"><div class="ewTableHeaderCaption"><?php echo $generator_report->end_range->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->end_range) ?>',1);"><div id="elh_generator_report_end_range" class="generator_report_end_range">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->end_range->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->end_range->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->end_range->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->parameter_id->Visible) { // parameter_id ?>
	<?php if ($generator_report->SortUrl($generator_report->parameter_id) == "") { ?>
		<td><div id="elh_generator_report_parameter_id" class="generator_report_parameter_id"><div class="ewTableHeaderCaption"><?php echo $generator_report->parameter_id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->parameter_id) ?>',1);"><div id="elh_generator_report_parameter_id" class="generator_report_parameter_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->parameter_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->parameter_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->parameter_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->parameter_name->Visible) { // parameter_name ?>
	<?php if ($generator_report->SortUrl($generator_report->parameter_name) == "") { ?>
		<td><div id="elh_generator_report_parameter_name" class="generator_report_parameter_name"><div class="ewTableHeaderCaption"><?php echo $generator_report->parameter_name->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->parameter_name) ?>',1);"><div id="elh_generator_report_parameter_name" class="generator_report_parameter_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->parameter_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->parameter_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->parameter_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($generator_report->function_group_id1->Visible) { // function_group_id1 ?>
	<?php if ($generator_report->SortUrl($generator_report->function_group_id1) == "") { ?>
		<td><div id="elh_generator_report_function_group_id1" class="generator_report_function_group_id1"><div class="ewTableHeaderCaption"><?php echo $generator_report->function_group_id1->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $generator_report->SortUrl($generator_report->function_group_id1) ?>',1);"><div id="elh_generator_report_function_group_id1" class="generator_report_function_group_id1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $generator_report->function_group_id1->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($generator_report->function_group_id1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($generator_report->function_group_id1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$generator_report_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($generator_report->ExportAll && $generator_report->Export <> "") {
	$generator_report_list->StopRec = $generator_report_list->TotalRecs;
} else {

	// Set the last record to display
	if ($generator_report_list->TotalRecs > $generator_report_list->StartRec + $generator_report_list->DisplayRecs - 1)
		$generator_report_list->StopRec = $generator_report_list->StartRec + $generator_report_list->DisplayRecs - 1;
	else
		$generator_report_list->StopRec = $generator_report_list->TotalRecs;
}
$generator_report_list->RecCnt = $generator_report_list->StartRec - 1;
if ($generator_report_list->Recordset && !$generator_report_list->Recordset->EOF) {
	$generator_report_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $generator_report_list->StartRec > 1)
		$generator_report_list->Recordset->Move($generator_report_list->StartRec - 1);
} elseif (!$generator_report->AllowAddDeleteRow && $generator_report_list->StopRec == 0) {
	$generator_report_list->StopRec = $generator_report->GridAddRowCount;
}

// Initialize aggregate
$generator_report->RowType = EW_ROWTYPE_AGGREGATEINIT;
$generator_report->ResetAttrs();
$generator_report_list->RenderRow();
while ($generator_report_list->RecCnt < $generator_report_list->StopRec) {
	$generator_report_list->RecCnt++;
	if (intval($generator_report_list->RecCnt) >= intval($generator_report_list->StartRec)) {
		$generator_report_list->RowCnt++;

		// Set up key count
		$generator_report_list->KeyCount = $generator_report_list->RowIndex;

		// Init row class and style
		$generator_report->ResetAttrs();
		$generator_report->CssClass = "";
		if ($generator_report->CurrentAction == "gridadd") {
		} else {
			$generator_report_list->LoadRowValues($generator_report_list->Recordset); // Load row values
		}
		$generator_report->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$generator_report->RowAttrs = array_merge($generator_report->RowAttrs, array('data-rowindex'=>$generator_report_list->RowCnt, 'id'=>'r' . $generator_report_list->RowCnt . '_generator_report', 'data-rowtype'=>$generator_report->RowType));

		// Render row
		$generator_report_list->RenderRow();

		// Render list options
		$generator_report_list->RenderListOptions();
?>
	<tr<?php echo $generator_report->RowAttributes() ?>>
<?php

// Render list options (body, left)
$generator_report_list->ListOptions->Render("body", "left", $generator_report_list->RowCnt);
?>
	<?php if ($generator_report->task_id->Visible) { // task_id ?>
		<td<?php echo $generator_report->task_id->CellAttributes() ?>>
<span<?php echo $generator_report->task_id->ViewAttributes() ?>>
<?php echo $generator_report->task_id->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->task_name->Visible) { // task_name ?>
		<td<?php echo $generator_report->task_name->CellAttributes() ?>>
<span<?php echo $generator_report->task_name->ViewAttributes() ?>>
<?php echo $generator_report->task_name->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->task_function_group_id->Visible) { // task_function_group_id ?>
		<td<?php echo $generator_report->task_function_group_id->CellAttributes() ?>>
<span<?php echo $generator_report->task_function_group_id->ViewAttributes() ?>>
<?php echo $generator_report->task_function_group_id->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->function_group_id->Visible) { // function_group_id ?>
		<td<?php echo $generator_report->function_group_id->CellAttributes() ?>>
<span<?php echo $generator_report->function_group_id->ViewAttributes() ?>>
<?php echo $generator_report->function_group_id->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->function_group_name->Visible) { // function_group_name ?>
		<td<?php echo $generator_report->function_group_name->CellAttributes() ?>>
<span<?php echo $generator_report->function_group_name->ViewAttributes() ?>>
<?php echo $generator_report->function_group_name->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->function_group_relation_id->Visible) { // function_group_relation_id ?>
		<td<?php echo $generator_report->function_group_relation_id->CellAttributes() ?>>
<span<?php echo $generator_report->function_group_relation_id->ViewAttributes() ?>>
<?php echo $generator_report->function_group_relation_id->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->priority->Visible) { // priority ?>
		<td<?php echo $generator_report->priority->CellAttributes() ?>>
<span<?php echo $generator_report->priority->ViewAttributes() ?>>
<?php echo $generator_report->priority->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->script_function_id->Visible) { // script_function_id ?>
		<td<?php echo $generator_report->script_function_id->CellAttributes() ?>>
<span<?php echo $generator_report->script_function_id->ViewAttributes() ?>>
<?php echo $generator_report->script_function_id->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->script_function_name->Visible) { // script_function_name ?>
		<td<?php echo $generator_report->script_function_name->CellAttributes() ?>>
<span<?php echo $generator_report->script_function_name->ViewAttributes() ?>>
<?php echo $generator_report->script_function_name->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->script_id->Visible) { // script_id ?>
		<td<?php echo $generator_report->script_id->CellAttributes() ?>>
<span<?php echo $generator_report->script_id->ViewAttributes() ?>>
<?php echo $generator_report->script_id->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->script_name->Visible) { // script_name ?>
		<td<?php echo $generator_report->script_name->CellAttributes() ?>>
<span<?php echo $generator_report->script_name->ViewAttributes() ?>>
<?php echo $generator_report->script_name->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->script_path->Visible) { // script_path ?>
		<td<?php echo $generator_report->script_path->CellAttributes() ?>>
<span<?php echo $generator_report->script_path->ViewAttributes() ?>>
<?php if ($generator_report->script_path->LinkAttributes() <> "") { ?>
<?php if (!empty($generator_report->script_path->Upload->DbValue)) { ?>
<?php echo $generator_report->script_path->ListViewValue() ?>
<?php } elseif (!in_array($generator_report->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($generator_report->script_path->Upload->DbValue)) { ?>
<?php echo $generator_report->script_path->ListViewValue() ?>
<?php } elseif (!in_array($generator_report->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->start_range->Visible) { // start_range ?>
		<td<?php echo $generator_report->start_range->CellAttributes() ?>>
<span<?php echo $generator_report->start_range->ViewAttributes() ?>>
<?php echo $generator_report->start_range->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->end_range->Visible) { // end_range ?>
		<td<?php echo $generator_report->end_range->CellAttributes() ?>>
<span<?php echo $generator_report->end_range->ViewAttributes() ?>>
<?php echo $generator_report->end_range->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->parameter_id->Visible) { // parameter_id ?>
		<td<?php echo $generator_report->parameter_id->CellAttributes() ?>>
<span<?php echo $generator_report->parameter_id->ViewAttributes() ?>>
<?php echo $generator_report->parameter_id->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->parameter_name->Visible) { // parameter_name ?>
		<td<?php echo $generator_report->parameter_name->CellAttributes() ?>>
<span<?php echo $generator_report->parameter_name->ViewAttributes() ?>>
<?php echo $generator_report->parameter_name->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($generator_report->function_group_id1->Visible) { // function_group_id1 ?>
		<td<?php echo $generator_report->function_group_id1->CellAttributes() ?>>
<span<?php echo $generator_report->function_group_id1->ViewAttributes() ?>>
<?php echo $generator_report->function_group_id1->ListViewValue() ?></span>
<a id="<?php echo $generator_report_list->PageObjName . "_row_" . $generator_report_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$generator_report_list->ListOptions->Render("body", "right", $generator_report_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($generator_report->CurrentAction <> "gridadd")
		$generator_report_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($generator_report->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($generator_report_list->Recordset)
	$generator_report_list->Recordset->Close();
?>
<?php if ($generator_report_list->TotalRecs > 0) { ?>
<?php if ($generator_report->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($generator_report->CurrentAction <> "gridadd" && $generator_report->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($generator_report_list->Pager)) $generator_report_list->Pager = new cNumericPager($generator_report_list->StartRec, $generator_report_list->DisplayRecs, $generator_report_list->TotalRecs, $generator_report_list->RecRange) ?>
<?php if ($generator_report_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($generator_report_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $generator_report_list->PageUrl() ?>start=<?php echo $generator_report_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($generator_report_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $generator_report_list->PageUrl() ?>start=<?php echo $generator_report_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($generator_report_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $generator_report_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($generator_report_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $generator_report_list->PageUrl() ?>start=<?php echo $generator_report_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($generator_report_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $generator_report_list->PageUrl() ?>start=<?php echo $generator_report_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($generator_report_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $generator_report_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $generator_report_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $generator_report_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($generator_report_list->SearchWhere == "0=101") { ?>
	<p><?php echo $Language->Phrase("EnterSearchCriteria") ?></p>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
	<?php } ?>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoPermission") ?></p>
	<?php } ?>
<?php } ?>
</td>
<?php if ($generator_report_list->TotalRecs > 0) { ?>
<td>
	&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="t" value="generator_report">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="input-small" onchange="this.form.submit();">
<option value="10"<?php if ($generator_report_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($generator_report_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($generator_report_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($generator_report_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($generator_report->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</td>
<?php } ?>
</tr></table>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($generator_report_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($generator_report->Export == "") { ?>
<script type="text/javascript">
fgenerator_reportlistsrch.Init();
fgenerator_reportlist.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php } ?>
<?php
$generator_report_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($generator_report->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$generator_report_list->Page_Terminate();
?>
