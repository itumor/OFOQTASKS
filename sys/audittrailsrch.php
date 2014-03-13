<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "audittrailinfo.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$audittrail_search = NULL; // Initialize page object first

class caudittrail_search extends caudittrail {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'audittrail';

	// Page object name
	var $PageObjName = 'audittrail_search';

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

		// Table object (audittrail)
		if (!isset($GLOBALS["audittrail"])) {
			$GLOBALS["audittrail"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["audittrail"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'audittrail', TRUE);

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
						$this->Page_Terminate("audittraillist.php" . "?" . $sSrchStr); // Go to list page
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
		$this->BuildSearchUrl($sSrchUrl, $this->id); // id
		$this->BuildSearchUrl($sSrchUrl, $this->datetime); // datetime
		$this->BuildSearchUrl($sSrchUrl, $this->script); // script
		$this->BuildSearchUrl($sSrchUrl, $this->user); // user
		$this->BuildSearchUrl($sSrchUrl, $this->action); // action
		$this->BuildSearchUrl($sSrchUrl, $this->_table); // table
		$this->BuildSearchUrl($sSrchUrl, $this->_field); // field
		$this->BuildSearchUrl($sSrchUrl, $this->keyvalue); // keyvalue
		$this->BuildSearchUrl($sSrchUrl, $this->oldvalue); // oldvalue
		$this->BuildSearchUrl($sSrchUrl, $this->newvalue); // newvalue
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
		// id

		$this->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$this->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// datetime
		$this->datetime->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_datetime"));
		$this->datetime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_datetime");

		// script
		$this->script->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_script"));
		$this->script->AdvancedSearch->SearchOperator = $objForm->GetValue("z_script");

		// user
		$this->user->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_user"));
		$this->user->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user");

		// action
		$this->action->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_action"));
		$this->action->AdvancedSearch->SearchOperator = $objForm->GetValue("z_action");

		// table
		$this->_table->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x__table"));
		$this->_table->AdvancedSearch->SearchOperator = $objForm->GetValue("z__table");

		// field
		$this->_field->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x__field"));
		$this->_field->AdvancedSearch->SearchOperator = $objForm->GetValue("z__field");

		// keyvalue
		$this->keyvalue->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_keyvalue"));
		$this->keyvalue->AdvancedSearch->SearchOperator = $objForm->GetValue("z_keyvalue");

		// oldvalue
		$this->oldvalue->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_oldvalue"));
		$this->oldvalue->AdvancedSearch->SearchOperator = $objForm->GetValue("z_oldvalue");

		// newvalue
		$this->newvalue->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_newvalue"));
		$this->newvalue->AdvancedSearch->SearchOperator = $objForm->GetValue("z_newvalue");
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
		// datetime
		// script
		// user
		// action
		// table
		// field
		// keyvalue
		// oldvalue
		// newvalue

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// datetime
			$this->datetime->ViewValue = $this->datetime->CurrentValue;
			$this->datetime->ViewCustomAttributes = "";

			// script
			$this->script->ViewValue = $this->script->CurrentValue;
			$this->script->ViewCustomAttributes = "";

			// user
			$this->user->ViewValue = $this->user->CurrentValue;
			$this->user->ViewCustomAttributes = "";

			// action
			$this->action->ViewValue = $this->action->CurrentValue;
			$this->action->ViewCustomAttributes = "";

			// table
			$this->_table->ViewValue = $this->_table->CurrentValue;
			$this->_table->ViewCustomAttributes = "";

			// field
			$this->_field->ViewValue = $this->_field->CurrentValue;
			$this->_field->ViewCustomAttributes = "";

			// keyvalue
			$this->keyvalue->ViewValue = $this->keyvalue->CurrentValue;
			$this->keyvalue->ViewCustomAttributes = "";

			// oldvalue
			$this->oldvalue->ViewValue = $this->oldvalue->CurrentValue;
			$this->oldvalue->ViewCustomAttributes = "";

			// newvalue
			$this->newvalue->ViewValue = $this->newvalue->CurrentValue;
			$this->newvalue->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// datetime
			$this->datetime->LinkCustomAttributes = "";
			$this->datetime->HrefValue = "";
			$this->datetime->TooltipValue = "";

			// script
			$this->script->LinkCustomAttributes = "";
			$this->script->HrefValue = "";
			$this->script->TooltipValue = "";

			// user
			$this->user->LinkCustomAttributes = "";
			$this->user->HrefValue = "";
			$this->user->TooltipValue = "";

			// action
			$this->action->LinkCustomAttributes = "";
			$this->action->HrefValue = "";
			$this->action->TooltipValue = "";

			// table
			$this->_table->LinkCustomAttributes = "";
			$this->_table->HrefValue = "";
			$this->_table->TooltipValue = "";

			// field
			$this->_field->LinkCustomAttributes = "";
			$this->_field->HrefValue = "";
			$this->_field->TooltipValue = "";

			// keyvalue
			$this->keyvalue->LinkCustomAttributes = "";
			$this->keyvalue->HrefValue = "";
			$this->keyvalue->TooltipValue = "";

			// oldvalue
			$this->oldvalue->LinkCustomAttributes = "";
			$this->oldvalue->HrefValue = "";
			$this->oldvalue->TooltipValue = "";

			// newvalue
			$this->newvalue->LinkCustomAttributes = "";
			$this->newvalue->HrefValue = "";
			$this->newvalue->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = ew_HtmlEncode($this->id->AdvancedSearch->SearchValue);
			$this->id->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->id->FldCaption()));

			// datetime
			$this->datetime->EditCustomAttributes = "";
			$this->datetime->EditValue = ew_HtmlEncode(ew_UnFormatDateTime($this->datetime->AdvancedSearch->SearchValue, 0));
			$this->datetime->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->datetime->FldCaption()));

			// script
			$this->script->EditCustomAttributes = "";
			$this->script->EditValue = ew_HtmlEncode($this->script->AdvancedSearch->SearchValue);
			$this->script->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->script->FldCaption()));

			// user
			$this->user->EditCustomAttributes = "";
			$this->user->EditValue = ew_HtmlEncode($this->user->AdvancedSearch->SearchValue);
			$this->user->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->user->FldCaption()));

			// action
			$this->action->EditCustomAttributes = "";
			$this->action->EditValue = ew_HtmlEncode($this->action->AdvancedSearch->SearchValue);
			$this->action->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->action->FldCaption()));

			// table
			$this->_table->EditCustomAttributes = "";
			$this->_table->EditValue = ew_HtmlEncode($this->_table->AdvancedSearch->SearchValue);
			$this->_table->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->_table->FldCaption()));

			// field
			$this->_field->EditCustomAttributes = "";
			$this->_field->EditValue = ew_HtmlEncode($this->_field->AdvancedSearch->SearchValue);
			$this->_field->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->_field->FldCaption()));

			// keyvalue
			$this->keyvalue->EditCustomAttributes = "";
			$this->keyvalue->EditValue = $this->keyvalue->AdvancedSearch->SearchValue;
			$this->keyvalue->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->keyvalue->FldCaption()));

			// oldvalue
			$this->oldvalue->EditCustomAttributes = "";
			$this->oldvalue->EditValue = $this->oldvalue->AdvancedSearch->SearchValue;
			$this->oldvalue->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->oldvalue->FldCaption()));

			// newvalue
			$this->newvalue->EditCustomAttributes = "";
			$this->newvalue->EditValue = $this->newvalue->AdvancedSearch->SearchValue;
			$this->newvalue->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->newvalue->FldCaption()));
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
		if (!ew_CheckInteger($this->id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->id->FldErrMsg());
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
		$this->id->AdvancedSearch->Load();
		$this->datetime->AdvancedSearch->Load();
		$this->script->AdvancedSearch->Load();
		$this->user->AdvancedSearch->Load();
		$this->action->AdvancedSearch->Load();
		$this->_table->AdvancedSearch->Load();
		$this->_field->AdvancedSearch->Load();
		$this->keyvalue->AdvancedSearch->Load();
		$this->oldvalue->AdvancedSearch->Load();
		$this->newvalue->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "audittraillist.php", $this->TableVar);
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
if (!isset($audittrail_search)) $audittrail_search = new caudittrail_search();

// Page init
$audittrail_search->Page_Init();

// Page main
$audittrail_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var audittrail_search = new ew_Page("audittrail_search");
audittrail_search.PageID = "search"; // Page ID
var EW_PAGE_ID = audittrail_search.PageID; // For backward compatibility

// Form object
var faudittrailsearch = new ew_Form("faudittrailsearch");

// Form_CustomValidate event
faudittrailsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
faudittrailsearch.ValidateRequired = true;
<?php } else { ?>
faudittrailsearch.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search
// Validate function for search

faudittrailsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	this.PostAutoSuggest();
	var infix = "";
	elm = this.GetElements("x" + infix + "_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($audittrail->id->FldErrMsg()) ?>");

	// Set up row object
	ew_ElementsToRow(fobj);

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
faudittrailsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
faudittrailsearch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
faudittrailsearch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $audittrail_search->ShowPageHeader(); ?>
<?php
$audittrail_search->ShowMessage();
?>
<form name="faudittrailsearch" id="faudittrailsearch" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="audittrail">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_audittrailsearch" class="table table-bordered table-striped">
<?php if ($audittrail->id->Visible) { // id ?>
	<tr id="r_id">
		<td><span id="elh_audittrail_id"><?php echo $audittrail->id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $audittrail->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail_id" class="control-group">
<input type="text" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo $audittrail->id->PlaceHolder ?>" value="<?php echo $audittrail->id->EditValue ?>"<?php echo $audittrail->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td><span id="elh_audittrail_datetime"><?php echo $audittrail->datetime->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_datetime" id="z_datetime" value="="></span></td>
		<td<?php echo $audittrail->datetime->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail_datetime" class="control-group">
<input type="text" data-field="x_datetime" name="x_datetime" id="x_datetime" placeholder="<?php echo $audittrail->datetime->PlaceHolder ?>" value="<?php echo $audittrail->datetime->EditValue ?>"<?php echo $audittrail->datetime->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
	<tr id="r_script">
		<td><span id="elh_audittrail_script"><?php echo $audittrail->script->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_script" id="z_script" value="LIKE"></span></td>
		<td<?php echo $audittrail->script->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail_script" class="control-group">
<input type="text" data-field="x_script" name="x_script" id="x_script" size="30" maxlength="255" placeholder="<?php echo $audittrail->script->PlaceHolder ?>" value="<?php echo $audittrail->script->EditValue ?>"<?php echo $audittrail->script->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
	<tr id="r_user">
		<td><span id="elh_audittrail_user"><?php echo $audittrail->user->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_user" id="z_user" value="LIKE"></span></td>
		<td<?php echo $audittrail->user->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail_user" class="control-group">
<input type="text" data-field="x_user" name="x_user" id="x_user" size="30" maxlength="255" placeholder="<?php echo $audittrail->user->PlaceHolder ?>" value="<?php echo $audittrail->user->EditValue ?>"<?php echo $audittrail->user->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->action->Visible) { // action ?>
	<tr id="r_action">
		<td><span id="elh_audittrail_action"><?php echo $audittrail->action->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_action" id="z_action" value="LIKE"></span></td>
		<td<?php echo $audittrail->action->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail_action" class="control-group">
<input type="text" data-field="x_action" name="x_action" id="x_action" size="30" maxlength="255" placeholder="<?php echo $audittrail->action->PlaceHolder ?>" value="<?php echo $audittrail->action->EditValue ?>"<?php echo $audittrail->action->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->_table->Visible) { // table ?>
	<tr id="r__table">
		<td><span id="elh_audittrail__table"><?php echo $audittrail->_table->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z__table" id="z__table" value="LIKE"></span></td>
		<td<?php echo $audittrail->_table->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail__table" class="control-group">
<input type="text" data-field="x__table" name="x__table" id="x__table" size="30" maxlength="255" placeholder="<?php echo $audittrail->_table->PlaceHolder ?>" value="<?php echo $audittrail->_table->EditValue ?>"<?php echo $audittrail->_table->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->_field->Visible) { // field ?>
	<tr id="r__field">
		<td><span id="elh_audittrail__field"><?php echo $audittrail->_field->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z__field" id="z__field" value="LIKE"></span></td>
		<td<?php echo $audittrail->_field->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail__field" class="control-group">
<input type="text" data-field="x__field" name="x__field" id="x__field" size="30" maxlength="255" placeholder="<?php echo $audittrail->_field->PlaceHolder ?>" value="<?php echo $audittrail->_field->EditValue ?>"<?php echo $audittrail->_field->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->keyvalue->Visible) { // keyvalue ?>
	<tr id="r_keyvalue">
		<td><span id="elh_audittrail_keyvalue"><?php echo $audittrail->keyvalue->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_keyvalue" id="z_keyvalue" value="LIKE"></span></td>
		<td<?php echo $audittrail->keyvalue->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail_keyvalue" class="control-group">
<input type="text" data-field="x_keyvalue" name="x_keyvalue" id="x_keyvalue" placeholder="<?php echo $audittrail->keyvalue->PlaceHolder ?>" value="<?php echo $audittrail->keyvalue->EditValue ?>"<?php echo $audittrail->keyvalue->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->oldvalue->Visible) { // oldvalue ?>
	<tr id="r_oldvalue">
		<td><span id="elh_audittrail_oldvalue"><?php echo $audittrail->oldvalue->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_oldvalue" id="z_oldvalue" value="LIKE"></span></td>
		<td<?php echo $audittrail->oldvalue->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail_oldvalue" class="control-group">
<input type="text" data-field="x_oldvalue" name="x_oldvalue" id="x_oldvalue" placeholder="<?php echo $audittrail->oldvalue->PlaceHolder ?>" value="<?php echo $audittrail->oldvalue->EditValue ?>"<?php echo $audittrail->oldvalue->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($audittrail->newvalue->Visible) { // newvalue ?>
	<tr id="r_newvalue">
		<td><span id="elh_audittrail_newvalue"><?php echo $audittrail->newvalue->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_newvalue" id="z_newvalue" value="LIKE"></span></td>
		<td<?php echo $audittrail->newvalue->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_audittrail_newvalue" class="control-group">
<input type="text" data-field="x_newvalue" name="x_newvalue" id="x_newvalue" placeholder="<?php echo $audittrail->newvalue->PlaceHolder ?>" value="<?php echo $audittrail->newvalue->EditValue ?>"<?php echo $audittrail->newvalue->EditAttributes() ?>>
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
faudittrailsearch.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$audittrail_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$audittrail_search->Page_Terminate();
?>
