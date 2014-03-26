<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "_logininfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$p_login_search = NULL; // Initialize page object first

class cp_login_search extends c_login {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'login';

	// Page object name
	var $PageObjName = 'p_login_search';

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

		// Table object (_login)
		if (!isset($GLOBALS["_login"])) {
			$GLOBALS["_login"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["_login"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'login', TRUE);

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
			$this->Page_Terminate("_loginlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate("_loginlist.php");
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action
		$this->idlogin->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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
						$this->Page_Terminate("_loginlist.php" . "?" . $sSrchStr); // Go to list page
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
		$this->BuildSearchUrl($sSrchUrl, $this->idlogin); // idlogin
		$this->BuildSearchUrl($sSrchUrl, $this->loginname); // loginname
		$this->BuildSearchUrl($sSrchUrl, $this->loginpassword); // loginpassword
		$this->BuildSearchUrl($sSrchUrl, $this->_Email); // Email
		$this->BuildSearchUrl($sSrchUrl, $this->Activated); // Activated
		$this->BuildSearchUrl($sSrchUrl, $this->Profile); // Profile
		$this->BuildSearchUrl($sSrchUrl, $this->levels); // levels
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
		// idlogin

		$this->idlogin->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_idlogin"));
		$this->idlogin->AdvancedSearch->SearchOperator = $objForm->GetValue("z_idlogin");

		// loginname
		$this->loginname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_loginname"));
		$this->loginname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_loginname");

		// loginpassword
		$this->loginpassword->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_loginpassword"));
		$this->loginpassword->AdvancedSearch->SearchOperator = $objForm->GetValue("z_loginpassword");

		// Email
		$this->_Email->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x__Email"));
		$this->_Email->AdvancedSearch->SearchOperator = $objForm->GetValue("z__Email");

		// Activated
		$this->Activated->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Activated"));
		$this->Activated->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Activated");

		// Profile
		$this->Profile->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Profile"));
		$this->Profile->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Profile");

		// levels
		$this->levels->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_levels"));
		$this->levels->AdvancedSearch->SearchOperator = $objForm->GetValue("z_levels");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// idlogin
		// loginname
		// loginpassword
		// Email
		// Activated
		// Profile
		// levels

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// idlogin
			$this->idlogin->ViewValue = $this->idlogin->CurrentValue;
			$this->idlogin->ViewCustomAttributes = "";

			// loginname
			$this->loginname->ViewValue = $this->loginname->CurrentValue;
			$this->loginname->ViewCustomAttributes = "";

			// loginpassword
			$this->loginpassword->ViewValue = "********";
			$this->loginpassword->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Activated
			$this->Activated->ViewValue = $this->Activated->CurrentValue;
			$this->Activated->ViewCustomAttributes = "";

			// Profile
			$this->Profile->ViewValue = $this->Profile->CurrentValue;
			$this->Profile->ViewCustomAttributes = "";

			// levels
			if ($Security->CanAdmin()) { // System admin
			if (strval($this->levels->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->levels->CurrentValue, EW_DATATYPE_NUMBER);
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->levels, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->levels->ViewValue = $rswrk->fields('DispFld');
					$rswrk->Close();
				} else {
					$this->levels->ViewValue = $this->levels->CurrentValue;
				}
			} else {
				$this->levels->ViewValue = NULL;
			}
			} else {
				$this->levels->ViewValue = "********";
			}
			$this->levels->ViewCustomAttributes = "";

			// idlogin
			$this->idlogin->LinkCustomAttributes = "";
			$this->idlogin->HrefValue = "";
			$this->idlogin->TooltipValue = "";

			// loginname
			$this->loginname->LinkCustomAttributes = "";
			$this->loginname->HrefValue = "";
			$this->loginname->TooltipValue = "";

			// loginpassword
			$this->loginpassword->LinkCustomAttributes = "";
			$this->loginpassword->HrefValue = "";
			$this->loginpassword->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Activated
			$this->Activated->LinkCustomAttributes = "";
			$this->Activated->HrefValue = "";
			$this->Activated->TooltipValue = "";

			// Profile
			$this->Profile->LinkCustomAttributes = "";
			$this->Profile->HrefValue = "";
			$this->Profile->TooltipValue = "";

			// levels
			$this->levels->LinkCustomAttributes = "";
			$this->levels->HrefValue = "";
			$this->levels->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// idlogin
			$this->idlogin->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn() && !$this->UserIDAllow("search")) { // Non system admin
				$this->idlogin->AdvancedSearch->SearchValue = CurrentUserID();
			$this->idlogin->EditValue = $this->idlogin->AdvancedSearch->SearchValue;
			$this->idlogin->ViewCustomAttributes = "";
			} else {
			$this->idlogin->EditValue = ew_HtmlEncode($this->idlogin->AdvancedSearch->SearchValue);
			$this->idlogin->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->idlogin->FldCaption()));
			}

			// loginname
			$this->loginname->EditCustomAttributes = "";
			$this->loginname->EditValue = ew_HtmlEncode($this->loginname->AdvancedSearch->SearchValue);
			$this->loginname->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->loginname->FldCaption()));

			// loginpassword
			$this->loginpassword->EditCustomAttributes = "";
			$this->loginpassword->EditValue = ew_HtmlEncode($this->loginpassword->AdvancedSearch->SearchValue);

			// Email
			$this->_Email->EditCustomAttributes = "";
			$this->_Email->EditValue = ew_HtmlEncode($this->_Email->AdvancedSearch->SearchValue);
			$this->_Email->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->_Email->FldCaption()));

			// Activated
			$this->Activated->EditCustomAttributes = "";
			$this->Activated->EditValue = ew_HtmlEncode($this->Activated->AdvancedSearch->SearchValue);
			$this->Activated->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->Activated->FldCaption()));

			// Profile
			$this->Profile->EditCustomAttributes = "";
			$this->Profile->EditValue = $this->Profile->AdvancedSearch->SearchValue;
			$this->Profile->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->Profile->FldCaption()));

			// levels
			$this->levels->EditCustomAttributes = "";
			if (!$Security->CanAdmin()) { // System admin
				$this->levels->EditValue = "********";
			} else {
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				ew_AddFilter($sWhereWrk, $sFilterWrk);
			}

			// Call Lookup selecting
			$this->Lookup_Selecting($this->levels, $sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", "", "", "", "", "", ""));
			$this->levels->EditValue = $arwrk;
			}
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
		if (!ew_CheckInteger($this->idlogin->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->idlogin->FldErrMsg());
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
		$this->idlogin->AdvancedSearch->Load();
		$this->loginname->AdvancedSearch->Load();
		$this->loginpassword->AdvancedSearch->Load();
		$this->_Email->AdvancedSearch->Load();
		$this->Activated->AdvancedSearch->Load();
		$this->Profile->AdvancedSearch->Load();
		$this->levels->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "_loginlist.php", $this->TableVar);
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
if (!isset($p_login_search)) $p_login_search = new cp_login_search();

// Page init
$p_login_search->Page_Init();

// Page main
$p_login_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$p_login_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var p_login_search = new ew_Page("p_login_search");
p_login_search.PageID = "search"; // Page ID
var EW_PAGE_ID = p_login_search.PageID; // For backward compatibility

// Form object
var f_loginsearch = new ew_Form("f_loginsearch");

// Form_CustomValidate event
f_loginsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
f_loginsearch.ValidateRequired = true;
<?php } else { ?>
f_loginsearch.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
f_loginsearch.Lists["x_levels"] = {"LinkField":"x_userlevelid","Ajax":null,"AutoFill":false,"DisplayFields":["x_userlevelname","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
// Validate function for search

f_loginsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	this.PostAutoSuggest();
	var infix = "";
	elm = this.GetElements("x" + infix + "_idlogin");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($_login->idlogin->FldErrMsg()) ?>");

	// Set up row object
	ew_ElementsToRow(fobj);

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
f_loginsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
f_loginsearch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
f_loginsearch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $p_login_search->ShowPageHeader(); ?>
<?php
$p_login_search->ShowMessage();
?>
<form name="f_loginsearch" id="f_loginsearch" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="_login">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl__loginsearch" class="table table-bordered table-striped">
<?php if ($_login->idlogin->Visible) { // idlogin ?>
	<tr id="r_idlogin">
		<td><span id="elh__login_idlogin"><?php echo $_login->idlogin->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_idlogin" id="z_idlogin" value="="></span></td>
		<td<?php echo $_login->idlogin->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el__login_idlogin" class="control-group">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn() && !$_login->UserIDAllow("search")) { // Non system admin ?>
<span<?php echo $_login->idlogin->ViewAttributes() ?>>
<?php echo $_login->idlogin->EditValue ?></span>
<input type="hidden" data-field="x_idlogin" name="x_idlogin" id="x_idlogin" value="<?php echo ew_HtmlEncode($_login->idlogin->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<input type="text" data-field="x_idlogin" name="x_idlogin" id="x_idlogin" size="30" placeholder="<?php echo $_login->idlogin->PlaceHolder ?>" value="<?php echo $_login->idlogin->EditValue ?>"<?php echo $_login->idlogin->EditAttributes() ?>>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($_login->loginname->Visible) { // loginname ?>
	<tr id="r_loginname">
		<td><span id="elh__login_loginname"><?php echo $_login->loginname->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_loginname" id="z_loginname" value="LIKE"></span></td>
		<td<?php echo $_login->loginname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el__login_loginname" class="control-group">
<input type="text" data-field="x_loginname" name="x_loginname" id="x_loginname" size="30" maxlength="255" placeholder="<?php echo $_login->loginname->PlaceHolder ?>" value="<?php echo $_login->loginname->EditValue ?>"<?php echo $_login->loginname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($_login->loginpassword->Visible) { // loginpassword ?>
	<tr id="r_loginpassword">
		<td><span id="elh__login_loginpassword"><?php echo $_login->loginpassword->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_loginpassword" id="z_loginpassword" value="LIKE"></span></td>
		<td<?php echo $_login->loginpassword->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el__login_loginpassword" class="control-group">
<input type="password" data-field="x_loginpassword" name="x_loginpassword" id="x_loginpassword" size="30" maxlength="255"<?php echo $_login->loginpassword->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($_login->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td><span id="elh__login__Email"><?php echo $_login->_Email->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z__Email" id="z__Email" value="LIKE"></span></td>
		<td<?php echo $_login->_Email->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el__login__Email" class="control-group">
<input type="text" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo $_login->_Email->PlaceHolder ?>" value="<?php echo $_login->_Email->EditValue ?>"<?php echo $_login->_Email->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($_login->Activated->Visible) { // Activated ?>
	<tr id="r_Activated">
		<td><span id="elh__login_Activated"><?php echo $_login->Activated->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Activated" id="z_Activated" value="LIKE"></span></td>
		<td<?php echo $_login->Activated->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el__login_Activated" class="control-group">
<input type="text" data-field="x_Activated" name="x_Activated" id="x_Activated" size="30" maxlength="255" placeholder="<?php echo $_login->Activated->PlaceHolder ?>" value="<?php echo $_login->Activated->EditValue ?>"<?php echo $_login->Activated->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($_login->Profile->Visible) { // Profile ?>
	<tr id="r_Profile">
		<td><span id="elh__login_Profile"><?php echo $_login->Profile->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Profile" id="z_Profile" value="LIKE"></span></td>
		<td<?php echo $_login->Profile->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el__login_Profile" class="control-group">
<input type="text" data-field="x_Profile" name="x_Profile" id="x_Profile" size="30" maxlength="255" placeholder="<?php echo $_login->Profile->PlaceHolder ?>" value="<?php echo $_login->Profile->EditValue ?>"<?php echo $_login->Profile->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($_login->levels->Visible) { // levels ?>
	<tr id="r_levels">
		<td><span id="elh__login_levels"><?php echo $_login->levels->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_levels" id="z_levels" value="="></span></td>
		<td<?php echo $_login->levels->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el__login_levels" class="control-group">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<?php echo $_login->levels->EditValue ?>
<?php } else { ?>
<select data-field="x_levels" id="x_levels" name="x_levels"<?php echo $_login->levels->EditAttributes() ?>>
<?php
if (is_array($_login->levels->EditValue)) {
	$arwrk = $_login->levels->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($_login->levels->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
f_loginsearch.Lists["x_levels"].Options = <?php echo (is_array($_login->levels->EditValue)) ? ew_ArrayToJson($_login->levels->EditValue, 1) : "[]" ?>;
</script>
<?php } ?>
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
f_loginsearch.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$p_login_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$p_login_search->Page_Terminate();
?>
