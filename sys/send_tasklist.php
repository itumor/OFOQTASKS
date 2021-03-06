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

$send_task_list = NULL; // Initialize page object first

class csend_task_list extends csend_task {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'send_task';

	// Page object name
	var $PageObjName = 'send_task_list';

	// Grid form hidden field names
	var $FormName = 'fsend_tasklist';
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

		// Table object (send_task)
		if (!isset($GLOBALS["send_task"])) {
			$GLOBALS["send_task"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["send_task"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "send_taskadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "send_taskdelete.php";
		$this->MultiUpdateUrl = "send_taskupdate.php";

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'send_task', TRUE);

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
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->username->Visible = !$this->IsAddOrEdit();
		$this->datetime->Visible = !$this->IsAddOrEdit();

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
		if (count($arrKeyFlds) >= 1) {
			$this->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->username, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->server_id_sendreceive, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->TARGET_FILENAME, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->LOCAL_PATH, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->REMOTE_IPAND1STLVL, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->REMOTE_REMAIN_PATH, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->REMOTE_USERNAME, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->REMOTE_PASSWORD, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $this->REMOTE_DOMAIN, $Keyword);
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
			$this->UpdateSort($this->id); // id
			$this->UpdateSort($this->username); // username
			$this->UpdateSort($this->datetime); // datetime
			$this->UpdateSort($this->server_id_sendreceive); // server_id_sendreceive
			$this->UpdateSort($this->TARGET_FILENAME); // TARGET_FILENAME
			$this->UpdateSort($this->LOCAL_PATH); // LOCAL_PATH
			$this->UpdateSort($this->REMOTE_IPAND1STLVL); // REMOTE_IPAND1STLVL
			$this->UpdateSort($this->REMOTE_REMAIN_PATH); // REMOTE_REMAIN_PATH
			$this->UpdateSort($this->REMOTE_USERNAME); // REMOTE_USERNAME
			$this->UpdateSort($this->REMOTE_PASSWORD); // REMOTE_PASSWORD
			$this->UpdateSort($this->REMOTE_DOMAIN); // REMOTE_DOMAIN
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
				$this->id->setSort("");
				$this->username->setSort("");
				$this->datetime->setSort("");
				$this->server_id_sendreceive->setSort("");
				$this->TARGET_FILENAME->setSort("");
				$this->LOCAL_PATH->setSort("");
				$this->REMOTE_IPAND1STLVL->setSort("");
				$this->REMOTE_REMAIN_PATH->setSort("");
				$this->REMOTE_USERNAME->setSort("");
				$this->REMOTE_PASSWORD->setSort("");
				$this->REMOTE_DOMAIN->setSort("");
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
		} else {
			$oListOpt->Body = "";
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		if ($Security->CanAdd()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CopyLink")) . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<label class=\"checkbox\"><input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event, this);'></label>";
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
		$option = $options["action"];

		// Add multi delete
		$item = &$option->Add("multidelete");
		$item->Body = "<a class=\"ewAction ewMultiDelete\" href=\"\" onclick=\"ew_SubmitSelected(document.fsend_tasklist, '" . $this->MultiDeleteUrl . "', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;\">" . $Language->Phrase("DeleteSelectedLink") . "</a>";
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
			$option = &$options["action"];
			foreach ($this->CustomActions as $action => $name) {

				// Add custom action
				$item = &$option->Add("custom_" . $action);
				$item->Body = "<a class=\"ewAction ewCustomAction\" href=\"\" onclick=\"ew_SubmitSelected(document.fsend_tasklist, '" . ew_CurrentUrl() . "', null, '" . $action . "');return false;\">" . $name . "</a>";
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

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
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$item->Body = "<a id=\"emf_send_task\" href=\"javascript:void(0);\" class=\"ewExportLink ewEmail\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_send_task',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fsend_tasklist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
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
if (!isset($send_task_list)) $send_task_list = new csend_task_list();

// Page init
$send_task_list->Page_Init();

// Page main
$send_task_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$send_task_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($send_task->Export == "") { ?>
<script type="text/javascript">

// Page object
var send_task_list = new ew_Page("send_task_list");
send_task_list.PageID = "list"; // Page ID
var EW_PAGE_ID = send_task_list.PageID; // For backward compatibility

// Form object
var fsend_tasklist = new ew_Form("fsend_tasklist");
fsend_tasklist.FormKeyCountName = '<?php echo $send_task_list->FormKeyCountName ?>';

// Form_CustomValidate event
fsend_tasklist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fsend_tasklist.ValidateRequired = true;
<?php } else { ?>
fsend_tasklist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fsend_tasklist.Lists["x_server_id_sendreceive"] = {"LinkField":"x_server_id","Ajax":null,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
var fsend_tasklistsrch = new ew_Form("fsend_tasklistsrch");

// Init search panel as collapsed
if (fsend_tasklistsrch) fsend_tasklistsrch.InitSearchPanel = true;
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($send_task->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($send_task_list->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $send_task_list->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$send_task_list->TotalRecs = $send_task->SelectRecordCount();
	} else {
		if ($send_task_list->Recordset = $send_task_list->LoadRecordset())
			$send_task_list->TotalRecs = $send_task_list->Recordset->RecordCount();
	}
	$send_task_list->StartRec = 1;
	if ($send_task_list->DisplayRecs <= 0 || ($send_task->Export <> "" && $send_task->ExportAll)) // Display all records
		$send_task_list->DisplayRecs = $send_task_list->TotalRecs;
	if (!($send_task->Export <> "" && $send_task->ExportAll))
		$send_task_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$send_task_list->Recordset = $send_task_list->LoadRecordset($send_task_list->StartRec-1, $send_task_list->DisplayRecs);
$send_task_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($send_task->Export == "" && $send_task->CurrentAction == "") { ?>
<form name="fsend_tasklistsrch" id="fsend_tasklistsrch" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>">
<table class="ewSearchTable"><tr><td>
<div class="accordion" id="fsend_tasklistsrch_SearchGroup">
	<div class="accordion-group">
		<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#fsend_tasklistsrch_SearchGroup" href="#fsend_tasklistsrch_SearchBody"><?php echo $Language->Phrase("Search") ?></a>
		</div>
		<div id="fsend_tasklistsrch_SearchBody" class="accordion-body collapse in">
			<div class="accordion-inner">
<div id="fsend_tasklistsrch_SearchPanel">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="send_task">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="btn-group ewButtonGroup">
	<div class="input-append">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="input-large" value="<?php echo ew_HtmlEncode($send_task_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo $Language->Phrase("Search") ?>">
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
	</div>
	</div>
	<div class="btn-group ewButtonGroup">
	<a class="btn ewShowAll" href="<?php echo $send_task_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>
</div>
<div id="xsr_2" class="ewRow">
	<label class="inline radio ewRadio" style="white-space: nowrap;"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="="<?php if ($send_task_list->BasicSearch->getType() == "=") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>
	<label class="inline radio ewRadio" style="white-space: nowrap;"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($send_task_list->BasicSearch->getType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>
	<label class="inline radio ewRadio" style="white-space: nowrap;"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($send_task_list->BasicSearch->getType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
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
<?php $send_task_list->ShowPageHeader(); ?>
<?php
$send_task_list->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($send_task->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($send_task->CurrentAction <> "gridadd" && $send_task->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($send_task_list->Pager)) $send_task_list->Pager = new cNumericPager($send_task_list->StartRec, $send_task_list->DisplayRecs, $send_task_list->TotalRecs, $send_task_list->RecRange) ?>
<?php if ($send_task_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($send_task_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $send_task_list->PageUrl() ?>start=<?php echo $send_task_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($send_task_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $send_task_list->PageUrl() ?>start=<?php echo $send_task_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($send_task_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $send_task_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($send_task_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $send_task_list->PageUrl() ?>start=<?php echo $send_task_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($send_task_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $send_task_list->PageUrl() ?>start=<?php echo $send_task_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($send_task_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $send_task_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $send_task_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $send_task_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($send_task_list->SearchWhere == "0=101") { ?>
	<p><?php echo $Language->Phrase("EnterSearchCriteria") ?></p>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
	<?php } ?>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoPermission") ?></p>
	<?php } ?>
<?php } ?>
</td>
<?php if ($send_task_list->TotalRecs > 0) { ?>
<td>
	&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="t" value="send_task">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="input-small" onchange="this.form.submit();">
<option value="10"<?php if ($send_task_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($send_task_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($send_task_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($send_task_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($send_task->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</td>
<?php } ?>
</tr></table>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($send_task_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
</div>
<?php } ?>
<form name="fsend_tasklist" id="fsend_tasklist" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="send_task">
<div id="gmp_send_task" class="ewGridMiddlePanel">
<?php if ($send_task_list->TotalRecs > 0) { ?>
<table id="tbl_send_tasklist" class="ewTable ewTableSeparate">
<?php echo $send_task->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$send_task_list->RenderListOptions();

// Render list options (header, left)
$send_task_list->ListOptions->Render("header", "left");
?>
<?php if ($send_task->id->Visible) { // id ?>
	<?php if ($send_task->SortUrl($send_task->id) == "") { ?>
		<td><div id="elh_send_task_id" class="send_task_id"><div class="ewTableHeaderCaption"><?php echo $send_task->id->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->id) ?>',1);"><div id="elh_send_task_id" class="send_task_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($send_task->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->username->Visible) { // username ?>
	<?php if ($send_task->SortUrl($send_task->username) == "") { ?>
		<td><div id="elh_send_task_username" class="send_task_username"><div class="ewTableHeaderCaption"><?php echo $send_task->username->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->username) ?>',1);"><div id="elh_send_task_username" class="send_task_username">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($send_task->username->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->username->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->datetime->Visible) { // datetime ?>
	<?php if ($send_task->SortUrl($send_task->datetime) == "") { ?>
		<td><div id="elh_send_task_datetime" class="send_task_datetime"><div class="ewTableHeaderCaption"><?php echo $send_task->datetime->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->datetime) ?>',1);"><div id="elh_send_task_datetime" class="send_task_datetime">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->datetime->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($send_task->datetime->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->datetime->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->server_id_sendreceive->Visible) { // server_id_sendreceive ?>
	<?php if ($send_task->SortUrl($send_task->server_id_sendreceive) == "") { ?>
		<td><div id="elh_send_task_server_id_sendreceive" class="send_task_server_id_sendreceive"><div class="ewTableHeaderCaption"><?php echo $send_task->server_id_sendreceive->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->server_id_sendreceive) ?>',1);"><div id="elh_send_task_server_id_sendreceive" class="send_task_server_id_sendreceive">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->server_id_sendreceive->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($send_task->server_id_sendreceive->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->server_id_sendreceive->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->TARGET_FILENAME->Visible) { // TARGET_FILENAME ?>
	<?php if ($send_task->SortUrl($send_task->TARGET_FILENAME) == "") { ?>
		<td><div id="elh_send_task_TARGET_FILENAME" class="send_task_TARGET_FILENAME"><div class="ewTableHeaderCaption"><?php echo $send_task->TARGET_FILENAME->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->TARGET_FILENAME) ?>',1);"><div id="elh_send_task_TARGET_FILENAME" class="send_task_TARGET_FILENAME">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->TARGET_FILENAME->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($send_task->TARGET_FILENAME->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->TARGET_FILENAME->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->LOCAL_PATH->Visible) { // LOCAL_PATH ?>
	<?php if ($send_task->SortUrl($send_task->LOCAL_PATH) == "") { ?>
		<td><div id="elh_send_task_LOCAL_PATH" class="send_task_LOCAL_PATH"><div class="ewTableHeaderCaption"><?php echo $send_task->LOCAL_PATH->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->LOCAL_PATH) ?>',1);"><div id="elh_send_task_LOCAL_PATH" class="send_task_LOCAL_PATH">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->LOCAL_PATH->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($send_task->LOCAL_PATH->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->LOCAL_PATH->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->REMOTE_IPAND1STLVL->Visible) { // REMOTE_IPAND1STLVL ?>
	<?php if ($send_task->SortUrl($send_task->REMOTE_IPAND1STLVL) == "") { ?>
		<td><div id="elh_send_task_REMOTE_IPAND1STLVL" class="send_task_REMOTE_IPAND1STLVL"><div class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_IPAND1STLVL->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->REMOTE_IPAND1STLVL) ?>',1);"><div id="elh_send_task_REMOTE_IPAND1STLVL" class="send_task_REMOTE_IPAND1STLVL">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_IPAND1STLVL->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($send_task->REMOTE_IPAND1STLVL->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->REMOTE_IPAND1STLVL->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->REMOTE_REMAIN_PATH->Visible) { // REMOTE_REMAIN_PATH ?>
	<?php if ($send_task->SortUrl($send_task->REMOTE_REMAIN_PATH) == "") { ?>
		<td><div id="elh_send_task_REMOTE_REMAIN_PATH" class="send_task_REMOTE_REMAIN_PATH"><div class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_REMAIN_PATH->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->REMOTE_REMAIN_PATH) ?>',1);"><div id="elh_send_task_REMOTE_REMAIN_PATH" class="send_task_REMOTE_REMAIN_PATH">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_REMAIN_PATH->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($send_task->REMOTE_REMAIN_PATH->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->REMOTE_REMAIN_PATH->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->REMOTE_USERNAME->Visible) { // REMOTE_USERNAME ?>
	<?php if ($send_task->SortUrl($send_task->REMOTE_USERNAME) == "") { ?>
		<td><div id="elh_send_task_REMOTE_USERNAME" class="send_task_REMOTE_USERNAME"><div class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_USERNAME->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->REMOTE_USERNAME) ?>',1);"><div id="elh_send_task_REMOTE_USERNAME" class="send_task_REMOTE_USERNAME">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_USERNAME->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($send_task->REMOTE_USERNAME->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->REMOTE_USERNAME->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->REMOTE_PASSWORD->Visible) { // REMOTE_PASSWORD ?>
	<?php if ($send_task->SortUrl($send_task->REMOTE_PASSWORD) == "") { ?>
		<td><div id="elh_send_task_REMOTE_PASSWORD" class="send_task_REMOTE_PASSWORD"><div class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_PASSWORD->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->REMOTE_PASSWORD) ?>',1);"><div id="elh_send_task_REMOTE_PASSWORD" class="send_task_REMOTE_PASSWORD">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_PASSWORD->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($send_task->REMOTE_PASSWORD->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->REMOTE_PASSWORD->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($send_task->REMOTE_DOMAIN->Visible) { // REMOTE_DOMAIN ?>
	<?php if ($send_task->SortUrl($send_task->REMOTE_DOMAIN) == "") { ?>
		<td><div id="elh_send_task_REMOTE_DOMAIN" class="send_task_REMOTE_DOMAIN"><div class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_DOMAIN->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $send_task->SortUrl($send_task->REMOTE_DOMAIN) ?>',1);"><div id="elh_send_task_REMOTE_DOMAIN" class="send_task_REMOTE_DOMAIN">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $send_task->REMOTE_DOMAIN->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($send_task->REMOTE_DOMAIN->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($send_task->REMOTE_DOMAIN->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$send_task_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($send_task->ExportAll && $send_task->Export <> "") {
	$send_task_list->StopRec = $send_task_list->TotalRecs;
} else {

	// Set the last record to display
	if ($send_task_list->TotalRecs > $send_task_list->StartRec + $send_task_list->DisplayRecs - 1)
		$send_task_list->StopRec = $send_task_list->StartRec + $send_task_list->DisplayRecs - 1;
	else
		$send_task_list->StopRec = $send_task_list->TotalRecs;
}
$send_task_list->RecCnt = $send_task_list->StartRec - 1;
if ($send_task_list->Recordset && !$send_task_list->Recordset->EOF) {
	$send_task_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $send_task_list->StartRec > 1)
		$send_task_list->Recordset->Move($send_task_list->StartRec - 1);
} elseif (!$send_task->AllowAddDeleteRow && $send_task_list->StopRec == 0) {
	$send_task_list->StopRec = $send_task->GridAddRowCount;
}

// Initialize aggregate
$send_task->RowType = EW_ROWTYPE_AGGREGATEINIT;
$send_task->ResetAttrs();
$send_task_list->RenderRow();
while ($send_task_list->RecCnt < $send_task_list->StopRec) {
	$send_task_list->RecCnt++;
	if (intval($send_task_list->RecCnt) >= intval($send_task_list->StartRec)) {
		$send_task_list->RowCnt++;

		// Set up key count
		$send_task_list->KeyCount = $send_task_list->RowIndex;

		// Init row class and style
		$send_task->ResetAttrs();
		$send_task->CssClass = "";
		if ($send_task->CurrentAction == "gridadd") {
		} else {
			$send_task_list->LoadRowValues($send_task_list->Recordset); // Load row values
		}
		$send_task->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$send_task->RowAttrs = array_merge($send_task->RowAttrs, array('data-rowindex'=>$send_task_list->RowCnt, 'id'=>'r' . $send_task_list->RowCnt . '_send_task', 'data-rowtype'=>$send_task->RowType));

		// Render row
		$send_task_list->RenderRow();

		// Render list options
		$send_task_list->RenderListOptions();
?>
	<tr<?php echo $send_task->RowAttributes() ?>>
<?php

// Render list options (body, left)
$send_task_list->ListOptions->Render("body", "left", $send_task_list->RowCnt);
?>
	<?php if ($send_task->id->Visible) { // id ?>
		<td<?php echo $send_task->id->CellAttributes() ?>>
<span<?php echo $send_task->id->ViewAttributes() ?>>
<?php echo $send_task->id->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->username->Visible) { // username ?>
		<td<?php echo $send_task->username->CellAttributes() ?>>
<span<?php echo $send_task->username->ViewAttributes() ?>>
<?php echo $send_task->username->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->datetime->Visible) { // datetime ?>
		<td<?php echo $send_task->datetime->CellAttributes() ?>>
<span<?php echo $send_task->datetime->ViewAttributes() ?>>
<?php echo $send_task->datetime->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->server_id_sendreceive->Visible) { // server_id_sendreceive ?>
		<td<?php echo $send_task->server_id_sendreceive->CellAttributes() ?>>
<span<?php echo $send_task->server_id_sendreceive->ViewAttributes() ?>>
<?php echo $send_task->server_id_sendreceive->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->TARGET_FILENAME->Visible) { // TARGET_FILENAME ?>
		<td<?php echo $send_task->TARGET_FILENAME->CellAttributes() ?>>
<span<?php echo $send_task->TARGET_FILENAME->ViewAttributes() ?>>
<?php echo $send_task->TARGET_FILENAME->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->LOCAL_PATH->Visible) { // LOCAL_PATH ?>
		<td<?php echo $send_task->LOCAL_PATH->CellAttributes() ?>>
<span<?php echo $send_task->LOCAL_PATH->ViewAttributes() ?>>
<?php echo $send_task->LOCAL_PATH->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->REMOTE_IPAND1STLVL->Visible) { // REMOTE_IPAND1STLVL ?>
		<td<?php echo $send_task->REMOTE_IPAND1STLVL->CellAttributes() ?>>
<span<?php echo $send_task->REMOTE_IPAND1STLVL->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_IPAND1STLVL->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->REMOTE_REMAIN_PATH->Visible) { // REMOTE_REMAIN_PATH ?>
		<td<?php echo $send_task->REMOTE_REMAIN_PATH->CellAttributes() ?>>
<span<?php echo $send_task->REMOTE_REMAIN_PATH->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_REMAIN_PATH->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->REMOTE_USERNAME->Visible) { // REMOTE_USERNAME ?>
		<td<?php echo $send_task->REMOTE_USERNAME->CellAttributes() ?>>
<span<?php echo $send_task->REMOTE_USERNAME->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_USERNAME->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->REMOTE_PASSWORD->Visible) { // REMOTE_PASSWORD ?>
		<td<?php echo $send_task->REMOTE_PASSWORD->CellAttributes() ?>>
<span<?php echo $send_task->REMOTE_PASSWORD->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_PASSWORD->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($send_task->REMOTE_DOMAIN->Visible) { // REMOTE_DOMAIN ?>
		<td<?php echo $send_task->REMOTE_DOMAIN->CellAttributes() ?>>
<span<?php echo $send_task->REMOTE_DOMAIN->ViewAttributes() ?>>
<?php echo $send_task->REMOTE_DOMAIN->ListViewValue() ?></span>
<a id="<?php echo $send_task_list->PageObjName . "_row_" . $send_task_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$send_task_list->ListOptions->Render("body", "right", $send_task_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($send_task->CurrentAction <> "gridadd")
		$send_task_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($send_task->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($send_task_list->Recordset)
	$send_task_list->Recordset->Close();
?>
<?php if ($send_task_list->TotalRecs > 0) { ?>
<?php if ($send_task->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($send_task->CurrentAction <> "gridadd" && $send_task->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($send_task_list->Pager)) $send_task_list->Pager = new cNumericPager($send_task_list->StartRec, $send_task_list->DisplayRecs, $send_task_list->TotalRecs, $send_task_list->RecRange) ?>
<?php if ($send_task_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($send_task_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $send_task_list->PageUrl() ?>start=<?php echo $send_task_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($send_task_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $send_task_list->PageUrl() ?>start=<?php echo $send_task_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($send_task_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $send_task_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($send_task_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $send_task_list->PageUrl() ?>start=<?php echo $send_task_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($send_task_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $send_task_list->PageUrl() ?>start=<?php echo $send_task_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($send_task_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $send_task_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $send_task_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $send_task_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($send_task_list->SearchWhere == "0=101") { ?>
	<p><?php echo $Language->Phrase("EnterSearchCriteria") ?></p>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
	<?php } ?>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoPermission") ?></p>
	<?php } ?>
<?php } ?>
</td>
<?php if ($send_task_list->TotalRecs > 0) { ?>
<td>
	&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="t" value="send_task">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="input-small" onchange="this.form.submit();">
<option value="10"<?php if ($send_task_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($send_task_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($send_task_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($send_task_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($send_task->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</td>
<?php } ?>
</tr></table>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($send_task_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($send_task->Export == "") { ?>
<script type="text/javascript">
fsend_tasklistsrch.Init();
fsend_tasklist.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php } ?>
<?php
$send_task_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($send_task->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$send_task_list->Page_Terminate();
?>
