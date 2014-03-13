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

$command_search = NULL; // Initialize page object first

class ccommand_search extends ccommand {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = "{3246B9FA-4C51-4733-8040-34B188FCD87E}";

	// Table name
	var $TableName = 'command';

	// Page object name
	var $PageObjName = 'command_search';

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

		// Table object (command)
		if (!isset($GLOBALS["command"])) {
			$GLOBALS["command"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["command"];
		}

		// Table object (_login)
		if (!isset($GLOBALS['_login'])) $GLOBALS['_login'] = new c_login();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
						$this->Page_Terminate("commandlist.php" . "?" . $sSrchStr); // Go to list page
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
		$this->BuildSearchUrl($sSrchUrl, $this->command_id); // command_id
		$this->BuildSearchUrl($sSrchUrl, $this->user_id); // user_id
		$this->BuildSearchUrl($sSrchUrl, $this->task_id); // task_id
		$this->BuildSearchUrl($sSrchUrl, $this->server_id); // server_id
		$this->BuildSearchUrl($sSrchUrl, $this->command_input); // command_input
		$this->BuildSearchUrl($sSrchUrl, $this->command_output); // command_output
		$this->BuildSearchUrl($sSrchUrl, $this->command_status); // command_status
		$this->BuildSearchUrl($sSrchUrl, $this->command_log); // command_log
		$this->BuildSearchUrl($sSrchUrl, $this->command_time); // command_time
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
		// command_id

		$this->command_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_command_id"));
		$this->command_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_command_id");

		// user_id
		$this->user_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_user_id"));
		$this->user_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_id");

		// task_id
		$this->task_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_task_id"));
		$this->task_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_task_id");

		// server_id
		$this->server_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_server_id"));
		$this->server_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_server_id");

		// command_input
		$this->command_input->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_command_input"));
		$this->command_input->AdvancedSearch->SearchOperator = $objForm->GetValue("z_command_input");

		// command_output
		$this->command_output->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_command_output"));
		$this->command_output->AdvancedSearch->SearchOperator = $objForm->GetValue("z_command_output");

		// command_status
		$this->command_status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_command_status"));
		$this->command_status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_command_status");

		// command_log
		$this->command_log->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_command_log"));
		$this->command_log->AdvancedSearch->SearchOperator = $objForm->GetValue("z_command_log");

		// command_time
		$this->command_time->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_command_time"));
		$this->command_time->AdvancedSearch->SearchOperator = $objForm->GetValue("z_command_time");
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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// command_id
			$this->command_id->EditCustomAttributes = "";
			$this->command_id->EditValue = ew_HtmlEncode($this->command_id->AdvancedSearch->SearchValue);
			$this->command_id->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_id->FldCaption()));

			// user_id
			$this->user_id->EditCustomAttributes = "";
			$this->user_id->EditValue = ew_HtmlEncode($this->user_id->AdvancedSearch->SearchValue);
			$this->user_id->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->user_id->FldCaption()));

			// task_id
			$this->task_id->EditCustomAttributes = "";
			if (trim(strval($this->task_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`task_id`" . ew_SearchString("=", $this->task_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER);
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
			if (trim(strval($this->server_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`server_id`" . ew_SearchString("=", $this->server_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER);
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
			$this->command_input->EditValue = $this->command_input->AdvancedSearch->SearchValue;
			$this->command_input->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_input->FldCaption()));

			// command_output
			$this->command_output->EditCustomAttributes = "";
			$this->command_output->EditValue = $this->command_output->AdvancedSearch->SearchValue;
			$this->command_output->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_output->FldCaption()));

			// command_status
			$this->command_status->EditCustomAttributes = "";
			$this->command_status->EditValue = $this->command_status->AdvancedSearch->SearchValue;
			$this->command_status->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_status->FldCaption()));

			// command_log
			$this->command_log->EditCustomAttributes = "";
			$this->command_log->EditValue = $this->command_log->AdvancedSearch->SearchValue;
			$this->command_log->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_log->FldCaption()));

			// command_time
			$this->command_time->EditCustomAttributes = "";
			$this->command_time->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->command_time->AdvancedSearch->SearchValue, 11), 11));
			$this->command_time->PlaceHolder = ew_HtmlEncode(ew_RemoveHtml($this->command_time->FldCaption()));
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
		if (!ew_CheckInteger($this->command_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->command_id->FldErrMsg());
		}
		if (!ew_CheckInteger($this->user_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->user_id->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->command_time->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->command_time->FldErrMsg());
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
		$this->command_id->AdvancedSearch->Load();
		$this->user_id->AdvancedSearch->Load();
		$this->task_id->AdvancedSearch->Load();
		$this->server_id->AdvancedSearch->Load();
		$this->command_input->AdvancedSearch->Load();
		$this->command_output->AdvancedSearch->Load();
		$this->command_status->AdvancedSearch->Load();
		$this->command_log->AdvancedSearch->Load();
		$this->command_time->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", "commandlist.php", $this->TableVar);
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
if (!isset($command_search)) $command_search = new ccommand_search();

// Page init
$command_search->Page_Init();

// Page main
$command_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$command_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var command_search = new ew_Page("command_search");
command_search.PageID = "search"; // Page ID
var EW_PAGE_ID = command_search.PageID; // For backward compatibility

// Form object
var fcommandsearch = new ew_Form("fcommandsearch");

// Form_CustomValidate event
fcommandsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcommandsearch.ValidateRequired = true;
<?php } else { ?>
fcommandsearch.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fcommandsearch.Lists["x_task_id"] = {"LinkField":"x_task_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_task_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};
fcommandsearch.Lists["x_server_id"] = {"LinkField":"x_server_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_server_name","","",""],"ParentFields":[],"FilterFields":[],"Options":[]};

// Form object for search
// Validate function for search

fcommandsearch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	this.PostAutoSuggest();
	var infix = "";
	elm = this.GetElements("x" + infix + "_command_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($command->command_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_user_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($command->user_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_command_time");
	if (elm && !ew_CheckEuroDate(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($command->command_time->FldErrMsg()) ?>");

	// Set up row object
	ew_ElementsToRow(fobj);

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fcommandsearch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcommandsearch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
fcommandsearch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php $command_search->ShowPageHeader(); ?>
<?php
$command_search->ShowMessage();
?>
<form name="fcommandsearch" id="fcommandsearch" class="ewForm form-inline" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="command">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td>
<table id="tbl_commandsearch" class="table table-bordered table-striped">
<?php if ($command->command_id->Visible) { // command_id ?>
	<tr id="r_command_id">
		<td><span id="elh_command_command_id"><?php echo $command->command_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_command_id" id="z_command_id" value="="></span></td>
		<td<?php echo $command->command_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_command_id" class="control-group">
<input type="text" data-field="x_command_id" name="x_command_id" id="x_command_id" placeholder="<?php echo $command->command_id->PlaceHolder ?>" value="<?php echo $command->command_id->EditValue ?>"<?php echo $command->command_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($command->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td><span id="elh_command_user_id"><?php echo $command->user_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></span></td>
		<td<?php echo $command->user_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_user_id" class="control-group">
<input type="text" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?php echo $command->user_id->PlaceHolder ?>" value="<?php echo $command->user_id->EditValue ?>"<?php echo $command->user_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($command->task_id->Visible) { // task_id ?>
	<tr id="r_task_id">
		<td><span id="elh_command_task_id"><?php echo $command->task_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_task_id" id="z_task_id" value="="></span></td>
		<td<?php echo $command->task_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_task_id" class="control-group">
<select data-field="x_task_id" id="x_task_id" name="x_task_id"<?php echo $command->task_id->EditAttributes() ?>>
<?php
if (is_array($command->task_id->EditValue)) {
	$arwrk = $command->task_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($command->task_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($command->server_id->Visible) { // server_id ?>
	<tr id="r_server_id">
		<td><span id="elh_command_server_id"><?php echo $command->server_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_server_id" id="z_server_id" value="="></span></td>
		<td<?php echo $command->server_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_server_id" class="control-group">
<select data-field="x_server_id" id="x_server_id" name="x_server_id"<?php echo $command->server_id->EditAttributes() ?>>
<?php
if (is_array($command->server_id->EditValue)) {
	$arwrk = $command->server_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($command->server_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($command->command_input->Visible) { // command_input ?>
	<tr id="r_command_input">
		<td><span id="elh_command_command_input"><?php echo $command->command_input->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_command_input" id="z_command_input" value="LIKE"></span></td>
		<td<?php echo $command->command_input->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_command_input" class="control-group">
<input type="text" data-field="x_command_input" name="x_command_input" id="x_command_input" placeholder="<?php echo $command->command_input->PlaceHolder ?>" value="<?php echo $command->command_input->EditValue ?>"<?php echo $command->command_input->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($command->command_output->Visible) { // command_output ?>
	<tr id="r_command_output">
		<td><span id="elh_command_command_output"><?php echo $command->command_output->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_command_output" id="z_command_output" value="LIKE"></span></td>
		<td<?php echo $command->command_output->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_command_output" class="control-group">
<input type="text" data-field="x_command_output" name="x_command_output" id="x_command_output" placeholder="<?php echo $command->command_output->PlaceHolder ?>" value="<?php echo $command->command_output->EditValue ?>"<?php echo $command->command_output->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($command->command_status->Visible) { // command_status ?>
	<tr id="r_command_status">
		<td><span id="elh_command_command_status"><?php echo $command->command_status->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_command_status" id="z_command_status" value="LIKE"></span></td>
		<td<?php echo $command->command_status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_command_status" class="control-group">
<input type="text" data-field="x_command_status" name="x_command_status" id="x_command_status" placeholder="<?php echo $command->command_status->PlaceHolder ?>" value="<?php echo $command->command_status->EditValue ?>"<?php echo $command->command_status->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($command->command_log->Visible) { // command_log ?>
	<tr id="r_command_log">
		<td><span id="elh_command_command_log"><?php echo $command->command_log->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_command_log" id="z_command_log" value="LIKE"></span></td>
		<td<?php echo $command->command_log->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_command_log" class="control-group">
<input type="text" data-field="x_command_log" name="x_command_log" id="x_command_log" placeholder="<?php echo $command->command_log->PlaceHolder ?>" value="<?php echo $command->command_log->EditValue ?>"<?php echo $command->command_log->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php if ($command->command_time->Visible) { // command_time ?>
	<tr id="r_command_time">
		<td><span id="elh_command_command_time"><?php echo $command->command_time->FldCaption() ?></span></td>
		<td><span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_command_time" id="z_command_time" value="="></span></td>
		<td<?php echo $command->command_time->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span id="el_command_command_time" class="control-group">
<input type="text" data-field="x_command_time" name="x_command_time" id="x_command_time" placeholder="<?php echo $command->command_time->PlaceHolder ?>" value="<?php echo $command->command_time->EditValue ?>"<?php echo $command->command_time->EditAttributes() ?>>
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
fcommandsearch.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$command_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$command_search->Page_Terminate();
?>
