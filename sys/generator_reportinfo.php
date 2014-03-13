<?php

// Global variable for table object
$generator_report = NULL;

//
// Table class for generator report
//
class cgenerator_report extends cTable {
	var $task_id;
	var $task_name;
	var $task_function_group_id;
	var $function_group_id;
	var $function_group_name;
	var $function_group_relation_id;
	var $priority;
	var $script_function_id;
	var $script_function_name;
	var $script_id;
	var $script_name;
	var $script_path;
	var $start_range;
	var $end_range;
	var $parameter_id;
	var $parameter_name;
	var $function_group_id1;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'generator_report';
		$this->TableName = 'generator report';
		$this->TableType = 'VIEW';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// task_id
		$this->task_id = new cField('generator_report', 'generator report', 'x_task_id', 'task_id', '`task_id`', '`task_id`', 3, -1, FALSE, '`task_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->task_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['task_id'] = &$this->task_id;

		// task_name
		$this->task_name = new cField('generator_report', 'generator report', 'x_task_name', 'task_name', '`task_name`', '`task_name`', 200, -1, FALSE, '`task_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['task_name'] = &$this->task_name;

		// task_function_group_id
		$this->task_function_group_id = new cField('generator_report', 'generator report', 'x_task_function_group_id', 'task_function_group_id', '`task_function_group_id`', '`task_function_group_id`', 3, -1, FALSE, '`task_function_group_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->task_function_group_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['task_function_group_id'] = &$this->task_function_group_id;

		// function_group_id
		$this->function_group_id = new cField('generator_report', 'generator report', 'x_function_group_id', 'function_group_id', '`function_group_id`', '`function_group_id`', 3, -1, FALSE, '`function_group_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->function_group_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['function_group_id'] = &$this->function_group_id;

		// function_group_name
		$this->function_group_name = new cField('generator_report', 'generator report', 'x_function_group_name', 'function_group_name', '`function_group_name`', '`function_group_name`', 200, -1, FALSE, '`function_group_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['function_group_name'] = &$this->function_group_name;

		// function_group_relation_id
		$this->function_group_relation_id = new cField('generator_report', 'generator report', 'x_function_group_relation_id', 'function_group_relation_id', '`function_group_relation_id`', '`function_group_relation_id`', 3, -1, FALSE, '`function_group_relation_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->function_group_relation_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['function_group_relation_id'] = &$this->function_group_relation_id;

		// priority
		$this->priority = new cField('generator_report', 'generator report', 'x_priority', 'priority', '`priority`', '`priority`', 3, -1, FALSE, '`priority`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->priority->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['priority'] = &$this->priority;

		// script_function_id
		$this->script_function_id = new cField('generator_report', 'generator report', 'x_script_function_id', 'script_function_id', '`script_function_id`', '`script_function_id`', 3, -1, FALSE, '`script_function_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->script_function_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['script_function_id'] = &$this->script_function_id;

		// script_function_name
		$this->script_function_name = new cField('generator_report', 'generator report', 'x_script_function_name', 'script_function_name', '`script_function_name`', '`script_function_name`', 200, -1, FALSE, '`script_function_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['script_function_name'] = &$this->script_function_name;

		// script_id
		$this->script_id = new cField('generator_report', 'generator report', 'x_script_id', 'script_id', '`script_id`', '`script_id`', 3, -1, FALSE, '`script_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->script_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['script_id'] = &$this->script_id;

		// script_name
		$this->script_name = new cField('generator_report', 'generator report', 'x_script_name', 'script_name', '`script_name`', '`script_name`', 200, -1, FALSE, '`script_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['script_name'] = &$this->script_name;

		// script_path
		$this->script_path = new cField('generator_report', 'generator report', 'x_script_path', 'script_path', '`script_path`', '`script_path`', 200, -1, TRUE, '`script_path`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['script_path'] = &$this->script_path;

		// start_range
		$this->start_range = new cField('generator_report', 'generator report', 'x_start_range', 'start_range', '`start_range`', '`start_range`', 3, -1, FALSE, '`start_range`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->start_range->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['start_range'] = &$this->start_range;

		// end_range
		$this->end_range = new cField('generator_report', 'generator report', 'x_end_range', 'end_range', '`end_range`', '`end_range`', 3, -1, FALSE, '`end_range`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->end_range->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['end_range'] = &$this->end_range;

		// parameter_id
		$this->parameter_id = new cField('generator_report', 'generator report', 'x_parameter_id', 'parameter_id', '`parameter_id`', '`parameter_id`', 3, -1, FALSE, '`parameter_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->parameter_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['parameter_id'] = &$this->parameter_id;

		// parameter_name
		$this->parameter_name = new cField('generator_report', 'generator report', 'x_parameter_name', 'parameter_name', '`parameter_name`', '`parameter_name`', 200, -1, FALSE, '`parameter_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['parameter_name'] = &$this->parameter_name;

		// function_group_id1
		$this->function_group_id1 = new cField('generator_report', 'generator report', 'x_function_group_id1', 'function_group_id1', '`function_group_id1`', '`function_group_id1`', 3, -1, FALSE, '`function_group_id1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->function_group_id1->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['function_group_id1'] = &$this->function_group_id1;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`generator report`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (@$this->PageID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->SqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Update Table
	var $UpdateTable = "`generator report`";

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		global $conn;
		return $conn->Execute($this->InsertSQL($rs));
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "") {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = $this->CurrentFilter;
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL) {
		global $conn;
		return $conn->Execute($this->UpdateSQL($rs, $where));
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "") {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if ($rs) {
		}
		$filter = $this->CurrentFilter;
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "") {
		global $conn;
		return $conn->Execute($this->DeleteSQL($rs, $where));
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "generator_reportlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "generator_reportlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("generator_reportview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("generator_reportview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl() {
		return "generator_reportadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("generator_reportedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("generator_reportadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("generator_reportdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
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

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
				if ($this->task_id->Exportable) $Doc->ExportCaption($this->task_id);
				if ($this->task_name->Exportable) $Doc->ExportCaption($this->task_name);
				if ($this->task_function_group_id->Exportable) $Doc->ExportCaption($this->task_function_group_id);
				if ($this->function_group_id->Exportable) $Doc->ExportCaption($this->function_group_id);
				if ($this->function_group_name->Exportable) $Doc->ExportCaption($this->function_group_name);
				if ($this->function_group_relation_id->Exportable) $Doc->ExportCaption($this->function_group_relation_id);
				if ($this->priority->Exportable) $Doc->ExportCaption($this->priority);
				if ($this->script_function_id->Exportable) $Doc->ExportCaption($this->script_function_id);
				if ($this->script_function_name->Exportable) $Doc->ExportCaption($this->script_function_name);
				if ($this->script_id->Exportable) $Doc->ExportCaption($this->script_id);
				if ($this->script_name->Exportable) $Doc->ExportCaption($this->script_name);
				if ($this->script_path->Exportable) $Doc->ExportCaption($this->script_path);
				if ($this->start_range->Exportable) $Doc->ExportCaption($this->start_range);
				if ($this->end_range->Exportable) $Doc->ExportCaption($this->end_range);
				if ($this->parameter_id->Exportable) $Doc->ExportCaption($this->parameter_id);
				if ($this->parameter_name->Exportable) $Doc->ExportCaption($this->parameter_name);
				if ($this->function_group_id1->Exportable) $Doc->ExportCaption($this->function_group_id1);
			} else {
				if ($this->task_id->Exportable) $Doc->ExportCaption($this->task_id);
				if ($this->task_name->Exportable) $Doc->ExportCaption($this->task_name);
				if ($this->task_function_group_id->Exportable) $Doc->ExportCaption($this->task_function_group_id);
				if ($this->function_group_id->Exportable) $Doc->ExportCaption($this->function_group_id);
				if ($this->function_group_name->Exportable) $Doc->ExportCaption($this->function_group_name);
				if ($this->function_group_relation_id->Exportable) $Doc->ExportCaption($this->function_group_relation_id);
				if ($this->priority->Exportable) $Doc->ExportCaption($this->priority);
				if ($this->script_function_id->Exportable) $Doc->ExportCaption($this->script_function_id);
				if ($this->script_function_name->Exportable) $Doc->ExportCaption($this->script_function_name);
				if ($this->script_id->Exportable) $Doc->ExportCaption($this->script_id);
				if ($this->script_name->Exportable) $Doc->ExportCaption($this->script_name);
				if ($this->script_path->Exportable) $Doc->ExportCaption($this->script_path);
				if ($this->start_range->Exportable) $Doc->ExportCaption($this->start_range);
				if ($this->end_range->Exportable) $Doc->ExportCaption($this->end_range);
				if ($this->parameter_id->Exportable) $Doc->ExportCaption($this->parameter_id);
				if ($this->parameter_name->Exportable) $Doc->ExportCaption($this->parameter_name);
				if ($this->function_group_id1->Exportable) $Doc->ExportCaption($this->function_group_id1);
			}
			$Doc->EndExportRow();
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					if ($this->task_id->Exportable) $Doc->ExportField($this->task_id);
					if ($this->task_name->Exportable) $Doc->ExportField($this->task_name);
					if ($this->task_function_group_id->Exportable) $Doc->ExportField($this->task_function_group_id);
					if ($this->function_group_id->Exportable) $Doc->ExportField($this->function_group_id);
					if ($this->function_group_name->Exportable) $Doc->ExportField($this->function_group_name);
					if ($this->function_group_relation_id->Exportable) $Doc->ExportField($this->function_group_relation_id);
					if ($this->priority->Exportable) $Doc->ExportField($this->priority);
					if ($this->script_function_id->Exportable) $Doc->ExportField($this->script_function_id);
					if ($this->script_function_name->Exportable) $Doc->ExportField($this->script_function_name);
					if ($this->script_id->Exportable) $Doc->ExportField($this->script_id);
					if ($this->script_name->Exportable) $Doc->ExportField($this->script_name);
					if ($this->script_path->Exportable) $Doc->ExportField($this->script_path);
					if ($this->start_range->Exportable) $Doc->ExportField($this->start_range);
					if ($this->end_range->Exportable) $Doc->ExportField($this->end_range);
					if ($this->parameter_id->Exportable) $Doc->ExportField($this->parameter_id);
					if ($this->parameter_name->Exportable) $Doc->ExportField($this->parameter_name);
					if ($this->function_group_id1->Exportable) $Doc->ExportField($this->function_group_id1);
				} else {
					if ($this->task_id->Exportable) $Doc->ExportField($this->task_id);
					if ($this->task_name->Exportable) $Doc->ExportField($this->task_name);
					if ($this->task_function_group_id->Exportable) $Doc->ExportField($this->task_function_group_id);
					if ($this->function_group_id->Exportable) $Doc->ExportField($this->function_group_id);
					if ($this->function_group_name->Exportable) $Doc->ExportField($this->function_group_name);
					if ($this->function_group_relation_id->Exportable) $Doc->ExportField($this->function_group_relation_id);
					if ($this->priority->Exportable) $Doc->ExportField($this->priority);
					if ($this->script_function_id->Exportable) $Doc->ExportField($this->script_function_id);
					if ($this->script_function_name->Exportable) $Doc->ExportField($this->script_function_name);
					if ($this->script_id->Exportable) $Doc->ExportField($this->script_id);
					if ($this->script_name->Exportable) $Doc->ExportField($this->script_name);
					if ($this->script_path->Exportable) $Doc->ExportField($this->script_path);
					if ($this->start_range->Exportable) $Doc->ExportField($this->start_range);
					if ($this->end_range->Exportable) $Doc->ExportField($this->end_range);
					if ($this->parameter_id->Exportable) $Doc->ExportField($this->parameter_id);
					if ($this->parameter_name->Exportable) $Doc->ExportField($this->parameter_name);
					if ($this->function_group_id1->Exportable) $Doc->ExportField($this->function_group_id1);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
