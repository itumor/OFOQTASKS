<?php

// Global variable for table object
$command = NULL;

//
// Table class for command
//
class ccommand extends cTable {
	var $command_id;
	var $user_id;
	var $task_id;
	var $server_id;
	var $command_input;
	var $command_output;
	var $command_status;
	var $command_log;
	var $command_time;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'command';
		$this->TableName = 'command';
		$this->TableType = 'TABLE';
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

		// command_id
		$this->command_id = new cField('command', 'command', 'x_command_id', 'command_id', '`command_id`', '`command_id`', 3, -1, FALSE, '`command_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->command_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['command_id'] = &$this->command_id;

		// user_id
		$this->user_id = new cField('command', 'command', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// task_id
		$this->task_id = new cField('command', 'command', 'x_task_id', 'task_id', '`task_id`', '`task_id`', 3, -1, FALSE, '`task_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->task_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['task_id'] = &$this->task_id;

		// server_id
		$this->server_id = new cField('command', 'command', 'x_server_id', 'server_id', '`server_id`', '`server_id`', 3, -1, FALSE, '`server_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->server_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['server_id'] = &$this->server_id;

		// command_input
		$this->command_input = new cField('command', 'command', 'x_command_input', 'command_input', '`command_input`', '`command_input`', 201, -1, FALSE, '`command_input`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['command_input'] = &$this->command_input;

		// command_output
		$this->command_output = new cField('command', 'command', 'x_command_output', 'command_output', '`command_output`', '`command_output`', 201, -1, FALSE, '`command_output`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['command_output'] = &$this->command_output;

		// command_status
		$this->command_status = new cField('command', 'command', 'x_command_status', 'command_status', '`command_status`', '`command_status`', 201, -1, FALSE, '`command_status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['command_status'] = &$this->command_status;

		// command_log
		$this->command_log = new cField('command', 'command', 'x_command_log', 'command_log', '`command_log`', '`command_log`', 201, -1, FALSE, '`command_log`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['command_log'] = &$this->command_log;

		// command_time
		$this->command_time = new cField('command', 'command', 'x_command_time', 'command_time', '`command_time`', 'DATE_FORMAT(`command_time`, \'%d/%m/%Y %H:%i:%s\')', 135, 11, FALSE, '`command_time`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->command_time->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['command_time'] = &$this->command_time;
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
		return "`command`";
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
	var $UpdateTable = "`command`";

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
			if (array_key_exists('command_id', $rs))
				ew_AddFilter($where, ew_QuotedName('command_id') . '=' . ew_QuotedValue($rs['command_id'], $this->command_id->FldDataType));
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
		return "`command_id` = @command_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->command_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@command_id@", ew_AdjustSql($this->command_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "commandlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "commandlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("commandview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("commandview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl() {
		return "commandadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("commandedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("commandadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("commanddelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->command_id->CurrentValue)) {
			$sUrl .= "command_id=" . urlencode($this->command_id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
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
			$arKeys[] = @$_GET["command_id"]; // command_id

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
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
			$this->command_id->CurrentValue = $key;
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
		$this->command_id->setDbValue($rs->fields('command_id'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->task_id->setDbValue($rs->fields('task_id'));
		$this->server_id->setDbValue($rs->fields('server_id'));
		$this->command_input->setDbValue($rs->fields('command_input'));
		$this->command_output->setDbValue($rs->fields('command_output'));
		$this->command_status->setDbValue($rs->fields('command_status'));
		$this->command_log->setDbValue($rs->fields('command_log'));
		$this->command_time->setDbValue($rs->fields('command_time'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// command_id
		// user_id
		// task_id
		// server_id
		// command_input
		// command_output
		// command_status
		// command_log
		// command_time
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
				if ($this->command_id->Exportable) $Doc->ExportCaption($this->command_id);
				if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
				if ($this->task_id->Exportable) $Doc->ExportCaption($this->task_id);
				if ($this->server_id->Exportable) $Doc->ExportCaption($this->server_id);
				if ($this->command_input->Exportable) $Doc->ExportCaption($this->command_input);
				if ($this->command_output->Exportable) $Doc->ExportCaption($this->command_output);
				if ($this->command_status->Exportable) $Doc->ExportCaption($this->command_status);
				if ($this->command_log->Exportable) $Doc->ExportCaption($this->command_log);
				if ($this->command_time->Exportable) $Doc->ExportCaption($this->command_time);
			} else {
				if ($this->command_id->Exportable) $Doc->ExportCaption($this->command_id);
				if ($this->user_id->Exportable) $Doc->ExportCaption($this->user_id);
				if ($this->task_id->Exportable) $Doc->ExportCaption($this->task_id);
				if ($this->server_id->Exportable) $Doc->ExportCaption($this->server_id);
				if ($this->command_time->Exportable) $Doc->ExportCaption($this->command_time);
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
					if ($this->command_id->Exportable) $Doc->ExportField($this->command_id);
					if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
					if ($this->task_id->Exportable) $Doc->ExportField($this->task_id);
					if ($this->server_id->Exportable) $Doc->ExportField($this->server_id);
					if ($this->command_input->Exportable) $Doc->ExportField($this->command_input);
					if ($this->command_output->Exportable) $Doc->ExportField($this->command_output);
					if ($this->command_status->Exportable) $Doc->ExportField($this->command_status);
					if ($this->command_log->Exportable) $Doc->ExportField($this->command_log);
					if ($this->command_time->Exportable) $Doc->ExportField($this->command_time);
				} else {
					if ($this->command_id->Exportable) $Doc->ExportField($this->command_id);
					if ($this->user_id->Exportable) $Doc->ExportField($this->user_id);
					if ($this->task_id->Exportable) $Doc->ExportField($this->task_id);
					if ($this->server_id->Exportable) $Doc->ExportField($this->server_id);
					if ($this->command_time->Exportable) $Doc->ExportField($this->command_time);
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
