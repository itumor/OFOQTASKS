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

$function_group_relation_search = NULL; // Initialize page object first

class cfunction_group_relation_search extends cfunction_group_relation {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'function_group_relation';

	// Page object name
	var $PageObjName = 'function_group_relation_search';

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

		// Table object (function_group_relation)
		if (!isset($GLOBALS["function_group_relation"])) {
			$GLOBALS["function_group_relation"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["function_group_relation"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
						$this->Page_Terminate("function_group_relationlist.php" . "?" . $sSrchStr); // Go to list page
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
		$this->BuildSearchUrl($sSrchUrl, $this->function_group_relation_id); // function_group_relation_id
		$this->BuildSearchUrl($sSrchUrl, $this->function_group_id); // function_group_id
		$this->BuildSearchUrl($sSrchUrl, $this->script_function_id); // script_function_id
		$this->BuildSearchUrl($sSrchUrl, $this->priority); // priority
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
		// function_group_relation_id

		$this->function_group_relation_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_function_group_relation_id"));
		$this->function_group_relation_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_function_group_relation_id");

		// function_group_id
		$this->function_group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_function_group_id"));
		$this->function_group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_function_group_id");

		// script_function_id
		$this->script_function_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_script_function_id"));
		$this->script_function_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_script_function_id");

		// priority
		$this->priority->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_priority"));
		$this->priority->AdvancedSearch->SearchOperator = $objForm->GetValue("z_priority");
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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// function_group_relation_id
			$this->function_group_relation_id->EditCustomAttributes = "";
			$this->function_group_relation_id->EditValue = ew_HtmlEncode($this->function_group_relation_id->AdvancedSearch->SearchValue);
			$this->function_group_relation_id->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->function_group_relation_id->FldCaption()));

			// function_group_id
			$this->function_group_id->EditCustomAttributes = "";
			if (trim(strval($this->function_group_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`function_group_id`" . ew_SearchString("=", $this->function_group_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER);
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
			if (trim(strval($this->script_function_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`script_function_id`" . ew_SearchString("=", $this->script_function_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER);
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
			$this->priority->EditValue = ew_HtmlEncode($this->priority->AdvancedSearch->SearchValue);
			$this->priority->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->priority->FldCaption()));
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
		if (!ew_CheckInteger($this->function_group_relation_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->function_group_relation_id->FldErrMsg());
		}
		if (!ew_CheckInteger($this->priority->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->priority->FldErrMsg());
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
		$this->function_group_relation_id->AdvancedSearch->Load();
		$this->function_group_id->AdvancedSearch->Load();
		$this->script_function_id->AdvancedSearch->Load();
		$this->priority->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "function_group_relationlist.php", $this->TableVar);
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
if (!isset($function_group_relation_search)) $function_group_relation_search = new cfunction_group_relation_search();

// Page init
$function_group_relation_search->Page_Init();

// Page main
$function_group_relation_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$function_group_relation_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var function_group_relation_search = new ew_Page("function_group_relation_search");
function_group_relation_search.PageID = "search"; // Page ID
var EW_PAGE_ID = function_group_relation_search.PageID; // For backward compatibility

// Form object
var ffunction_group_relationsearch = new ew_Form("ffunction_group_relationsearch");

// Form_CustomValidate event
ffunction_group_relationsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ffunction_group_relationsearch.ValidateRequired = true;
<?php } else { ?>
ffunction_group_relationsearch.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ffunction_group_relationsearch.Lists["x_function_group_id"] = {"LinkField":"x_function_group_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_function_group_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
ffunction_group_relationsearch.Lists["x_script_function_id"] = {"LinkField":"x_script_function_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_script_function_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
// Validate function for search

ffunction_group_relationsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	this.PostAutoSuggest();
	var infix = "";
	elm = this.GetElements("x" + infix + "_function_group_relation_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($function_group_relation->function_group_relation_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_priority");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($function_group_relation->priority->FldErrMsg()) ?>");

	// Set up row object
	ew_ElementsToRow(fobj);

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ffunction_group_relationsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ffunction_group_relationsearch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
ffunction_group_relationsearch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $function_group_relation_search->ShowPageHeader(); ?>
<?php
$function_group_relation_search->ShowMessage();
?>
<form name="ffunction_group_relationsearch" id="ffunction_group_relationsearch" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="function_group_relation">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_function_group_relationsearch" class="table table-bordered table-striped">
<?php if ($function_group_relation->function_group_relation_id->Visible) { // function_group_relation_id ?>
	<tr id="r_function_group_relation_id">
		<td><span id="elh_function_group_relation_function_group_relation_id"><?php echo $function_group_relation->function_group_relation_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_function_group_relation_id" id="z_function_group_relation_id" value="="></span></td>
		<td<?php echo $function_group_relation->function_group_relation_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_function_group_relation_function_group_relation_id" class="control-group">
<input type="text" data-field="x_function_group_relation_id" name="x_function_group_relation_id" id="x_function_group_relation_id" placeholder="<?php echo $function_group_relation->function_group_relation_id->PlaceHolder ?>" value="<?php echo $function_group_relation->function_group_relation_id->EditValue ?>"<?php echo $function_group_relation->function_group_relation_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($function_group_relation->function_group_id->Visible) { // function_group_id ?>
	<tr id="r_function_group_id">
		<td><span id="elh_function_group_relation_function_group_id"><?php echo $function_group_relation->function_group_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_function_group_id" id="z_function_group_id" value="="></span></td>
		<td<?php echo $function_group_relation->function_group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_function_group_relation_function_group_id" class="control-group">
<select data-field="x_function_group_id" id="x_function_group_id" name="x_function_group_id"<?php echo $function_group_relation->function_group_id->EditAttributes() ?>>
<?php
if (is_array($function_group_relation->function_group_id->EditValue)) {
	$arwrk = $function_group_relation->function_group_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($function_group_relation->function_group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($function_group_relation->script_function_id->Visible) { // script_function_id ?>
	<tr id="r_script_function_id">
		<td><span id="elh_function_group_relation_script_function_id"><?php echo $function_group_relation->script_function_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_script_function_id" id="z_script_function_id" value="="></span></td>
		<td<?php echo $function_group_relation->script_function_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_function_group_relation_script_function_id" class="control-group">
<select data-field="x_script_function_id" id="x_script_function_id" name="x_script_function_id"<?php echo $function_group_relation->script_function_id->EditAttributes() ?>>
<?php
if (is_array($function_group_relation->script_function_id->EditValue)) {
	$arwrk = $function_group_relation->script_function_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($function_group_relation->script_function_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($function_group_relation->priority->Visible) { // priority ?>
	<tr id="r_priority">
		<td><span id="elh_function_group_relation_priority"><?php echo $function_group_relation->priority->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_priority" id="z_priority" value="="></span></td>
		<td<?php echo $function_group_relation->priority->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_function_group_relation_priority" class="control-group">
<input type="text" data-field="x_priority" name="x_priority" id="x_priority" size="30" placeholder="<?php echo $function_group_relation->priority->PlaceHolder ?>" value="<?php echo $function_group_relation->priority->EditValue ?>"<?php echo $function_group_relation->priority->EditAttributes() ?>>
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
ffunction_group_relationsearch.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$function_group_relation_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$function_group_relation_search->Page_Terminate();
?>
