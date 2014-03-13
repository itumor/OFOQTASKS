<?php

// Global variable for table object
$server = NULL;

//
// Table class for server
//
class cserver extends cTable {
	var $server_id;
	var $server_name;
	var $server_hostname;
	var $server_username;
	var $server_password;
	var $server_auth_type;
	var $server_os;
	var $server_file;
	var $server_deleted;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'server';
		$this->TableName = 'server';
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

		// server_id
		$this->server_id = new cField('server', 'server', 'x_server_id', 'server_id', '`server_id`', '`server_id`', 3, -1, FALSE, '`server_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->server_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['server_id'] = &$this->server_id;

		// server_name
		$this->server_name = new cField('server', 'server', 'x_server_name', 'server_name', '`server_name`', '`server_name`', 200, -1, FALSE, '`server_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['server_name'] = &$this->server_name;

		// server_hostname
		$this->server_hostname = new cField('server', 'server', 'x_server_hostname', 'server_hostname', '`server_hostname`', '`server_hostname`', 201, -1, FALSE, '`server_hostname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['server_hostname'] = &$this->server_hostname;

		// server_username
		$this->server_username = new cField('server', 'server', 'x_server_username', 'server_username', '`server_username`', '`server_username`', 200, -1, FALSE, '`server_username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['server_username'] = &$this->server_username;

		// server_password
		$this->server_password = new cField('server', 'server', 'x_server_password', 'server_password', '`server_password`', '`server_password`', 201, -1, FALSE, '`server_password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['server_password'] = &$this->server_password;

		// server_auth_type
		$this->server_auth_type = new cField('server', 'server', 'x_server_auth_type', 'server_auth_type', '`server_auth_type`', '`server_auth_type`', 202, -1, FALSE, '`server_auth_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['server_auth_type'] = &$this->server_auth_type;

		// server_os
		$this->server_os = new cField('server', 'server', 'x_server_os', 'server_os', '`server_os`', '`server_os`', 202, -1, FALSE, '`server_os`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['server_os'] = &$this->server_os;

		// server_file
		$this->server_file = new cField('server', 'server', 'x_server_file', 'server_file', '`server_file`', '`server_file`', 201, -1, TRUE, '`server_file`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['server_file'] = &$this->server_file;

		// server_deleted
		$this->server_deleted = new cField('server', 'server', 'x_server_deleted', 'server_deleted', '`server_deleted`', '`server_deleted`', 16, -1, FALSE, '`server_deleted`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->server_deleted->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['server_deleted'] = &$this->server_deleted;
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
		return "`server`";
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
	var $UpdateTable = "`server`";

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
			if (array_key_exists('server_id', $rs))
				ew_AddFilter($where, ew_QuotedName('server_id') . '=' . ew_QuotedValue($rs['server_id'], $this->server_id->FldDataType));
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
		return "`server_id` = @server_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->server_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@server_id@", ew_AdjustSql($this->server_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "serverlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "serverlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("serverview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("serverview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl() {
		return "serveradd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("serveredit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("serveradd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("serverdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->server_id->CurrentValue)) {
			$sUrl .= "server_id=" . urlencode($this->server_id->CurrentValue);
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
			$arKeys[] = @$_GET["server_id"]; // server_id

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
			$this->server_id->CurrentValue = $key;
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
		$this->server_id->setDbValue($rs->fields('server_id'));
		$this->server_name->setDbValue($rs->fields('server_name'));
		$this->server_hostname->setDbValue($rs->fields('server_hostname'));
		$this->server_username->setDbValue($rs->fields('server_username'));
		$this->server_password->setDbValue($rs->fields('server_password'));
		$this->server_auth_type->setDbValue($rs->fields('server_auth_type'));
		$this->server_os->setDbValue($rs->fields('server_os'));
		$this->server_file->Upload->DbValue = $rs->fields('server_file');
		$this->server_deleted->setDbValue($rs->fields('server_deleted'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// server_id
		// server_name
		// server_hostname
		// server_username
		// server_password
		// server_auth_type
		// server_os
		// server_file
		// server_deleted
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
				if ($this->server_id->Exportable) $Doc->ExportCaption($this->server_id);
				if ($this->server_name->Exportable) $Doc->ExportCaption($this->server_name);
				if ($this->server_hostname->Exportable) $Doc->ExportCaption($this->server_hostname);
				if ($this->server_username->Exportable) $Doc->ExportCaption($this->server_username);
				if ($this->server_password->Exportable) $Doc->ExportCaption($this->server_password);
				if ($this->server_auth_type->Exportable) $Doc->ExportCaption($this->server_auth_type);
				if ($this->server_os->Exportable) $Doc->ExportCaption($this->server_os);
				if ($this->server_file->Exportable) $Doc->ExportCaption($this->server_file);
				if ($this->server_deleted->Exportable) $Doc->ExportCaption($this->server_deleted);
			} else {
				if ($this->server_id->Exportable) $Doc->ExportCaption($this->server_id);
				if ($this->server_name->Exportable) $Doc->ExportCaption($this->server_name);
				if ($this->server_username->Exportable) $Doc->ExportCaption($this->server_username);
				if ($this->server_auth_type->Exportable) $Doc->ExportCaption($this->server_auth_type);
				if ($this->server_os->Exportable) $Doc->ExportCaption($this->server_os);
				if ($this->server_deleted->Exportable) $Doc->ExportCaption($this->server_deleted);
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
					if ($this->server_id->Exportable) $Doc->ExportField($this->server_id);
					if ($this->server_name->Exportable) $Doc->ExportField($this->server_name);
					if ($this->server_hostname->Exportable) $Doc->ExportField($this->server_hostname);
					if ($this->server_username->Exportable) $Doc->ExportField($this->server_username);
					if ($this->server_password->Exportable) $Doc->ExportField($this->server_password);
					if ($this->server_auth_type->Exportable) $Doc->ExportField($this->server_auth_type);
					if ($this->server_os->Exportable) $Doc->ExportField($this->server_os);
					if ($this->server_file->Exportable) $Doc->ExportField($this->server_file);
					if ($this->server_deleted->Exportable) $Doc->ExportField($this->server_deleted);
				} else {
					if ($this->server_id->Exportable) $Doc->ExportField($this->server_id);
					if ($this->server_name->Exportable) $Doc->ExportField($this->server_name);
					if ($this->server_username->Exportable) $Doc->ExportField($this->server_username);
					if ($this->server_auth_type->Exportable) $Doc->ExportField($this->server_auth_type);
					if ($this->server_os->Exportable) $Doc->ExportField($this->server_os);
					if ($this->server_deleted->Exportable) $Doc->ExportField($this->server_deleted);
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
