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

$server_search = NULL; // Initialize page object first

class cserver_search extends cserver {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'server';

	// Page object name
	var $PageObjName = 'server_search';

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

		// Table object (server)
		if (!isset($GLOBALS["server"])) {
			$GLOBALS["server"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["server"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
						$this->Page_Terminate("serverlist.php" . "?" . $sSrchStr); // Go to list page
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
		$this->BuildSearchUrl($sSrchUrl, $this->server_id); // server_id
		$this->BuildSearchUrl($sSrchUrl, $this->server_name); // server_name
		$this->BuildSearchUrl($sSrchUrl, $this->server_hostname); // server_hostname
		$this->BuildSearchUrl($sSrchUrl, $this->server_username); // server_username
		$this->BuildSearchUrl($sSrchUrl, $this->server_password); // server_password
		$this->BuildSearchUrl($sSrchUrl, $this->server_auth_type); // server_auth_type
		$this->BuildSearchUrl($sSrchUrl, $this->server_os); // server_os
		$this->BuildSearchUrl($sSrchUrl, $this->server_file); // server_file
		$this->BuildSearchUrl($sSrchUrl, $this->server_deleted); // server_deleted
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
		// server_id

		$this->server_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_id"));
		$this->server_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_id");

		// server_name
		$this->server_name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_name"));
		$this->server_name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_name");

		// server_hostname
		$this->server_hostname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_hostname"));
		$this->server_hostname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_hostname");

		// server_username
		$this->server_username->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_username"));
		$this->server_username->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_username");

		// server_password
		$this->server_password->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_password"));
		$this->server_password->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_password");

		// server_auth_type
		$this->server_auth_type->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_auth_type"));
		$this->server_auth_type->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_auth_type");

		// server_os
		$this->server_os->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_os"));
		$this->server_os->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_os");

		// server_file
		$this->server_file->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_file"));
		$this->server_file->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_file");

		// server_deleted
		$this->server_deleted->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_deleted"));
		$this->server_deleted->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_deleted");
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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// server_id
			$this->server_id->EditCustomAttributes = "";
			$this->server_id->EditValue = ew_HtmlEncode($this->server_id->AdvancedSearch->SearchValue);
			$this->server_id->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_id->FldCaption()));

			// server_name
			$this->server_name->EditCustomAttributes = "";
			$this->server_name->EditValue = ew_HtmlEncode($this->server_name->AdvancedSearch->SearchValue);
			$this->server_name->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_name->FldCaption()));

			// server_hostname
			$this->server_hostname->EditCustomAttributes = "";
			$this->server_hostname->EditValue = $this->server_hostname->AdvancedSearch->SearchValue;
			$this->server_hostname->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_hostname->FldCaption()));

			// server_username
			$this->server_username->EditCustomAttributes = "";
			$this->server_username->EditValue = ew_HtmlEncode($this->server_username->AdvancedSearch->SearchValue);
			$this->server_username->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_username->FldCaption()));

			// server_password
			$this->server_password->EditCustomAttributes = "";
			$this->server_password->EditValue = ew_HtmlEncode($this->server_password->AdvancedSearch->SearchValue);

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
			$this->server_file->EditValue = ew_HtmlEncode($this->server_file->AdvancedSearch->SearchValue);
			$this->server_file->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_file->FldCaption()));

			// server_deleted
			$this->server_deleted->EditCustomAttributes = "";
			$this->server_deleted->EditValue = ew_HtmlEncode($this->server_deleted->AdvancedSearch->SearchValue);
			$this->server_deleted->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->server_deleted->FldCaption()));
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
		if (!ew_CheckInteger($this->server_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->server_id->FldErrMsg());
		}
		if (!ew_CheckInteger($this->server_deleted->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->server_deleted->FldErrMsg());
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
		$this->server_id->AdvancedSearch->Load();
		$this->server_name->AdvancedSearch->Load();
		$this->server_hostname->AdvancedSearch->Load();
		$this->server_username->AdvancedSearch->Load();
		$this->server_password->AdvancedSearch->Load();
		$this->server_auth_type->AdvancedSearch->Load();
		$this->server_os->AdvancedSearch->Load();
		$this->server_file->AdvancedSearch->Load();
		$this->server_deleted->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "serverlist.php", $this->TableVar);
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
if (!isset($server_search)) $server_search = new cserver_search();

// Page init
$server_search->Page_Init();

// Page main
$server_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$server_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var server_search = new ew_Page("server_search");
server_search.PageID = "search"; // Page ID
var EW_PAGE_ID = server_search.PageID; // For backward compatibility

// Form object
var fserversearch = new ew_Form("fserversearch");

// Form_CustomValidate event
fserversearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fserversearch.ValidateRequired = true;
<?php } else { ?>
fserversearch.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search
// Validate function for search

fserversearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	this.PostAutoSuggest();
	var infix = "";
	elm = this.GetElements("x" + infix + "_server_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($server->server_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_server_deleted");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($server->server_deleted->FldErrMsg()) ?>");

	// Set up row object
	ew_ElementsToRow(fobj);

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fserversearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fserversearch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
fserversearch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $server_search->ShowPageHeader(); ?>
<?php
$server_search->ShowMessage();
?>
<form name="fserversearch" id="fserversearch" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="server">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_serversearch" class="table table-bordered table-striped">
<?php if ($server->server_id->Visible) { // server_id ?>
	<tr id="r_server_id">
		<td><span id="elh_server_server_id"><?php echo $server->server_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_server_id" id="z_server_id" value="="></span></td>
		<td<?php echo $server->server_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_id" class="control-group">
<input type="text" data-field="x_server_id" name="x_server_id" id="x_server_id" placeholder="<?php echo $server->server_id->PlaceHolder ?>" value="<?php echo $server->server_id->EditValue ?>"<?php echo $server->server_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($server->server_name->Visible) { // server_name ?>
	<tr id="r_server_name">
		<td><span id="elh_server_server_name"><?php echo $server->server_name->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_server_name" id="z_server_name" value="LIKE"></span></td>
		<td<?php echo $server->server_name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_name" class="control-group">
<input type="text" data-field="x_server_name" name="x_server_name" id="x_server_name" size="30" maxlength="255" placeholder="<?php echo $server->server_name->PlaceHolder ?>" value="<?php echo $server->server_name->EditValue ?>"<?php echo $server->server_name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($server->server_hostname->Visible) { // server_hostname ?>
	<tr id="r_server_hostname">
		<td><span id="elh_server_server_hostname"><?php echo $server->server_hostname->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_server_hostname" id="z_server_hostname" value="LIKE"></span></td>
		<td<?php echo $server->server_hostname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_hostname" class="control-group">
<input type="text" data-field="x_server_hostname" name="x_server_hostname" id="x_server_hostname" placeholder="<?php echo $server->server_hostname->PlaceHolder ?>" value="<?php echo $server->server_hostname->EditValue ?>"<?php echo $server->server_hostname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($server->server_username->Visible) { // server_username ?>
	<tr id="r_server_username">
		<td><span id="elh_server_server_username"><?php echo $server->server_username->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_server_username" id="z_server_username" value="LIKE"></span></td>
		<td<?php echo $server->server_username->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_username" class="control-group">
<input type="text" data-field="x_server_username" name="x_server_username" id="x_server_username" size="30" maxlength="255" placeholder="<?php echo $server->server_username->PlaceHolder ?>" value="<?php echo $server->server_username->EditValue ?>"<?php echo $server->server_username->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($server->server_password->Visible) { // server_password ?>
	<tr id="r_server_password">
		<td><span id="elh_server_server_password"><?php echo $server->server_password->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_server_password" id="z_server_password" value="LIKE"></span></td>
		<td<?php echo $server->server_password->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_password" class="control-group">
<input type="password" data-field="x_server_password" name="x_server_password" id="x_server_password"<?php echo $server->server_password->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($server->server_auth_type->Visible) { // server_auth_type ?>
	<tr id="r_server_auth_type">
		<td><span id="elh_server_server_auth_type"><?php echo $server->server_auth_type->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_server_auth_type" id="z_server_auth_type" value="="></span></td>
		<td<?php echo $server->server_auth_type->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_auth_type" class="control-group">
<div id="tp_x_server_auth_type" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_server_auth_type" id="x_server_auth_type" value="{value}"<?php echo $server->server_auth_type->EditAttributes() ?>></div>
<div id="dsl_x_server_auth_type" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $server->server_auth_type->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($server->server_auth_type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($server->server_os->Visible) { // server_os ?>
	<tr id="r_server_os">
		<td><span id="elh_server_server_os"><?php echo $server->server_os->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_server_os" id="z_server_os" value="="></span></td>
		<td<?php echo $server->server_os->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_os" class="control-group">
<div id="tp_x_server_os" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_server_os" id="x_server_os" value="{value}"<?php echo $server->server_os->EditAttributes() ?>></div>
<div id="dsl_x_server_os" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $server->server_os->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($server->server_os->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($server->server_file->Visible) { // server_file ?>
	<tr id="r_server_file">
		<td><span id="elh_server_server_file"><?php echo $server->server_file->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_server_file" id="z_server_file" value="LIKE"></span></td>
		<td<?php echo $server->server_file->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_file" class="control-group">
<input type="text" data-field="x_server_file" name="x_server_file" id="x_server_file" placeholder="<?php echo $server->server_file->PlaceHolder ?>" value="<?php echo $server->server_file->EditValue ?>"<?php echo $server->server_file->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($server->server_deleted->Visible) { // server_deleted ?>
	<tr id="r_server_deleted">
		<td><span id="elh_server_server_deleted"><?php echo $server->server_deleted->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_server_deleted" id="z_server_deleted" value="="></span></td>
		<td<?php echo $server->server_deleted->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_server_server_deleted" class="control-group">
<input type="text" data-field="x_server_deleted" name="x_server_deleted" id="x_server_deleted" size="30" placeholder="<?php echo $server->server_deleted->PlaceHolder ?>" value="<?php echo $server->server_deleted->EditValue ?>"<?php echo $server->server_deleted->EditAttributes() ?>>
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
fserversearch.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$server_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$server_search->Page_Terminate();
?>
