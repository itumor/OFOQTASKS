<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "scriptinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$script_search = NULL; // Initialize page object first

class cscript_search extends cscript {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'script';

	// Page object name
	var $PageObjName = 'script_search';

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

		// Table object (script)
		if (!isset($GLOBALS["script"])) {
			$GLOBALS["script"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["script"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'script', TRUE);

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
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("scriptlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action
		$this->script_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = $objForm->GetValue("a_search");
			switch ($this->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setFailureMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $this->UrlParm($sSrchStr);
						$this->Page_Terminate("scriptlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$this->RowType = EW_ROWTYPE_SEARCH;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Build advanced search
	function BuildAdvancedSearch() {
		$sSrchUrl = "";
		$this->BuildSearchUrl($sSrchUrl, $this->script_id); // script_id
		$this->BuildSearchUrl($sSrchUrl, $this->script_name); // script_name
		$this->BuildSearchUrl($sSrchUrl, $this->script_path); // script_path
		$this->BuildSearchUrl($sSrchUrl, $this->start_range); // start_range
		$this->BuildSearchUrl($sSrchUrl, $this->end_range); // end_range
		if ($sSrchUrl <> "") $sSrchUrl .= "&";
		$sSrchUrl .= "cmd=search";
		return $sSrchUrl;
	}

	// Build search URL
	function BuildSearchUrl(&$Url, &$Fld, $OprOnly=FALSE) {
		global $objForm;
		$sWrk = "";
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $objForm->GetValue("x_$FldParm");
		$FldOpr = $objForm->GetValue("z_$FldParm");
		$FldCond = $objForm->GetValue("v_$FldParm");
		$FldVal2 = $objForm->GetValue("y_$FldParm");
		$FldOpr2 = $objForm->GetValue("w_$FldParm");
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($FldOpr == "BETWEEN") {
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal) && $this->SearchValueIsNumeric($Fld, $FldVal2));
			if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
				$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
					"&y_" . $FldParm . "=" . urlencode($FldVal2) .
					"&z_" . $FldParm . "=" . urlencode($FldOpr);
			}
		} else {
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal));
			if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {
				$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
					"&z_" . $FldParm . "=" . urlencode($FldOpr);
			} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL" || ($FldOpr <> "" && $OprOnly && ew_IsValidOpr($FldOpr, $lFldDataType))) {
				$sWrk = "z_" . $FldParm . "=" . urlencode($FldOpr);
			}
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal2));
			if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {
				if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
				$sWrk .= "y_" . $FldParm . "=" . urlencode($FldVal2) .
					"&w_" . $FldParm . "=" . urlencode($FldOpr2);
			} elseif ($FldOpr2 == "IS NULL" || $FldOpr2 == "IS NOT NULL" || ($FldOpr2 <> "" && $OprOnly && ew_IsValidOpr($FldOpr2, $lFldDataType))) {
				if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
				$sWrk .= "w_" . $FldParm . "=" . urlencode($FldOpr2);
			}
		}
		if ($sWrk <> "") {
			if ($Url <> "") $Url .= "&";
			$Url .= $sWrk;
		}
	}

	function SearchValueIsNumeric($Fld, $Value) {
		if (ew_IsFloatFormat($Fld->FldType)) $Value = ew_StrToFloat($Value);
		return is_numeric($Value);
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// script_id

		$this->script_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_script_id"));
		$this->script_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_script_id");

		// script_name
		$this->script_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_script_name"));
		$this->script_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_script_name");

		// script_path
		$this->script_path->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_script_path"));
		$this->script_path->AdvancedSearch->SearchOperator = $objForm->GetValue("z_script_path");

		// start_range
		$this->start_range->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_start_range"));
		$this->start_range->AdvancedSearch->SearchOperator = $objForm->GetValue("z_start_range");

		// end_range
		$this->end_range->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_end_range"));
		$this->end_range->AdvancedSearch->SearchOperator = $objForm->GetValue("z_end_range");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// script_id
		// script_name
		// script_path
		// start_range
		// end_range

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// script_id
			$this->script_id->EditCustomAttributes = "";
			$this->script_id->EditValue = ew_HtmlEncode($this->script_id->AdvancedSearch->SearchValue);
			$this->script_id->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->script_id->FldCaption()));

			// script_name
			$this->script_name->EditCustomAttributes = "";
			$this->script_name->EditValue = ew_HtmlEncode($this->script_name->AdvancedSearch->SearchValue);
			$this->script_name->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->script_name->FldCaption()));

			// script_path
			$this->script_path->EditCustomAttributes = "";
			$this->script_path->EditValue = ew_HtmlEncode($this->script_path->AdvancedSearch->SearchValue);
			$this->script_path->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->script_path->FldCaption()));

			// start_range
			$this->start_range->EditCustomAttributes = "";
			$this->start_range->EditValue = ew_HtmlEncode($this->start_range->AdvancedSearch->SearchValue);
			$this->start_range->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->start_range->FldCaption()));

			// end_range
			$this->end_range->EditCustomAttributes = "";
			$this->end_range->EditValue = ew_HtmlEncode($this->end_range->AdvancedSearch->SearchValue);
			$this->end_range->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->end_range->FldCaption()));
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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($this->script_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->script_id->FldErrMsg());
		}
		if (!ew_CheckInteger($this->start_range->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->start_range->FldErrMsg());
		}
		if (!ew_CheckInteger($this->end_range->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->end_range->FldErrMsg());
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->script_id->AdvancedSearch->Load();
		$this->script_name->AdvancedSearch->Load();
		$this->script_path->AdvancedSearch->Load();
		$this->start_range->AdvancedSearch->Load();
		$this->end_range->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "scriptlist.php", $this->TableVar);
		$PageCaption = $Language->Phrase("search");
		$Breadcrumb->Add("search", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", ew_CurrentUrl(), $this->TableVar);
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
if (!isset($script_search)) $script_search = new cscript_search();

// Page init
$script_search->Page_Init();

// Page main
$script_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$script_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var script_search = new ew_Page("script_search");
script_search.PageID = "search"; // Page ID
var EW_PAGE_ID = script_search.PageID; // For backward compatibility

// Form object
var fscriptsearch = new ew_Form("fscriptsearch");

// Form_CustomValidate event
fscriptsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fscriptsearch.ValidateRequired = true;
<?php } else { ?>
fscriptsearch.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search
// Validate function for search

fscriptsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	this.PostAutoSuggest();
	var infix = "";
	elm = this.GetElements("x" + infix + "_script_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($script->script_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_start_range");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($script->start_range->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_end_range");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($script->end_range->FldErrMsg()) ?>");

	// Set up row object
	ew_ElementsToRow(fobj);

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fscriptsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fscriptsearch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
fscriptsearch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $script_search->ShowPageHeader(); ?>
<?php
$script_search->ShowMessage();
?>
<form name="fscriptsearch" id="fscriptsearch" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="script">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_scriptsearch" class="table table-bordered table-striped">
<?php if ($script->script_id->Visible) { // script_id ?>
	<tr id="r_script_id">
		<td><span id="elh_script_script_id"><?php echo $script->script_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_script_id" id="z_script_id" value="="></span></td>
		<td<?php echo $script->script_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_script_script_id" class="control-group">
<input type="text" data-field="x_script_id" name="x_script_id" id="x_script_id" placeholder="<?php echo $script->script_id->PlaceHolder ?>" value="<?php echo $script->script_id->EditValue ?>"<?php echo $script->script_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($script->script_name->Visible) { // script_name ?>
	<tr id="r_script_name">
		<td><span id="elh_script_script_name"><?php echo $script->script_name->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_script_name" id="z_script_name" value="LIKE"></span></td>
		<td<?php echo $script->script_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_script_script_name" class="control-group">
<input type="text" data-field="x_script_name" name="x_script_name" id="x_script_name" size="30" maxlength="255" placeholder="<?php echo $script->script_name->PlaceHolder ?>" value="<?php echo $script->script_name->EditValue ?>"<?php echo $script->script_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($script->script_path->Visible) { // script_path ?>
	<tr id="r_script_path">
		<td><span id="elh_script_script_path"><?php echo $script->script_path->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_script_path" id="z_script_path" value="LIKE"></span></td>
		<td<?php echo $script->script_path->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_script_script_path" class="control-group">
<input type="text" data-field="x_script_path" name="x_script_path" id="x_script_path" size="30" maxlength="255" placeholder="<?php echo $script->script_path->PlaceHolder ?>" value="<?php echo $script->script_path->EditValue ?>"<?php echo $script->script_path->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($script->start_range->Visible) { // start_range ?>
	<tr id="r_start_range">
		<td><span id="elh_script_start_range"><?php echo $script->start_range->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_start_range" id="z_start_range" value="="></span></td>
		<td<?php echo $script->start_range->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_script_start_range" class="control-group">
<input type="text" data-field="x_start_range" name="x_start_range" id="x_start_range" size="30" placeholder="<?php echo $script->start_range->PlaceHolder ?>" value="<?php echo $script->start_range->EditValue ?>"<?php echo $script->start_range->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($script->end_range->Visible) { // end_range ?>
	<tr id="r_end_range">
		<td><span id="elh_script_end_range"><?php echo $script->end_range->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_end_range" id="z_end_range" value="="></span></td>
		<td<?php echo $script->end_range->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_script_end_range" class="control-group">
<input type="text" data-field="x_end_range" name="x_end_range" id="x_end_range" size="30" placeholder="<?php echo $script->end_range->PlaceHolder ?>" value="<?php echo $script->end_range->EditValue ?>"<?php echo $script->end_range->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
</table>
</td></tr></table>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
</form>
<script type="text/javascript">
fscriptsearch.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$script_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$script_search->Page_Terminate();
?>
