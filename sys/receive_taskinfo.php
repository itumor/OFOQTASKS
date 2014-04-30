<?php

// Global variable for table object
$receive_task = NULL;

//
// Table class for receive_task
//
class creceive_task extends cTable {
	var $id;
	var $username;
	var $datetime;
	var $server_id_sendreceive;
	var $TARGET_FILENAME;
	var $LOCAL_PATH;
	var $REMOTE_IPAND1STLVL;
	var $REMOTE_REMAIN_PATH;
	var $REMOTE_USERNAME;
	var $REMOTE_PASSWORD;
	var $REMOTE_DOMAIN;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'receive_task';
		$this->TableName = 'receive_task';
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

		// id
		$this->id = new cField('receive_task', 'receive_task', 'x_id', 'id', '`id`', '`id`', 19, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// username
		$this->username = new cField('receive_task', 'receive_task', 'x_username', 'username', '`username`', '`username`', 200, -1, FALSE, '`username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['username'] = &$this->username;

		// datetime
		$this->datetime = new cField('receive_task', 'receive_task', 'x_datetime', 'datetime', '`datetime`', 'DATE_FORMAT(`datetime`, \'%d/%m/%Y %H:%i:%s\')', 135, -1, FALSE, '`datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['datetime'] = &$this->datetime;

		// server_id_sendreceive
		$this->server_id_sendreceive = new cField('receive_task', 'receive_task', 'x_server_id_sendreceive', 'server_id_sendreceive', '`server_id_sendreceive`', '`server_id_sendreceive`', 200, -1, FALSE, '`server_id_sendreceive`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['server_id_sendreceive'] = &$this->server_id_sendreceive;

		// TARGET_FILENAME
		$this->TARGET_FILENAME = new cField('receive_task', 'receive_task', 'x_TARGET_FILENAME', 'TARGET_FILENAME', '`TARGET_FILENAME`', '`TARGET_FILENAME`', 200, -1, FALSE, '`TARGET_FILENAME`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['TARGET_FILENAME'] = &$this->TARGET_FILENAME;

		// LOCAL_PATH
		$this->LOCAL_PATH = new cField('receive_task', 'receive_task', 'x_LOCAL_PATH', 'LOCAL_PATH', '`LOCAL_PATH`', '`LOCAL_PATH`', 200, -1, FALSE, '`LOCAL_PATH`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['LOCAL_PATH'] = &$this->LOCAL_PATH;

		// REMOTE_IPAND1STLVL
		$this->REMOTE_IPAND1STLVL = new cField('receive_task', 'receive_task', 'x_REMOTE_IPAND1STLVL', 'REMOTE_IPAND1STLVL', '`REMOTE_IPAND1STLVL`', '`REMOTE_IPAND1STLVL`', 200, -1, FALSE, '`REMOTE_IPAND1STLVL`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['REMOTE_IPAND1STLVL'] = &$this->REMOTE_IPAND1STLVL;

		// REMOTE_REMAIN_PATH
		$this->REMOTE_REMAIN_PATH = new cField('receive_task', 'receive_task', 'x_REMOTE_REMAIN_PATH', 'REMOTE_REMAIN_PATH', '`REMOTE_REMAIN_PATH`', '`REMOTE_REMAIN_PATH`', 200, -1, FALSE, '`REMOTE_REMAIN_PATH`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['REMOTE_REMAIN_PATH'] = &$this->REMOTE_REMAIN_PATH;

		// REMOTE_USERNAME
		$this->REMOTE_USERNAME = new cField('receive_task', 'receive_task', 'x_REMOTE_USERNAME', 'REMOTE_USERNAME', '`REMOTE_USERNAME`', '`REMOTE_USERNAME`', 200, -1, FALSE, '`REMOTE_USERNAME`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['REMOTE_USERNAME'] = &$this->REMOTE_USERNAME;

		// REMOTE_PASSWORD
		$this->REMOTE_PASSWORD = new cField('receive_task', 'receive_task', 'x_REMOTE_PASSWORD', 'REMOTE_PASSWORD', '`REMOTE_PASSWORD`', '`REMOTE_PASSWORD`', 200, -1, FALSE, '`REMOTE_PASSWORD`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['REMOTE_PASSWORD'] = &$this->REMOTE_PASSWORD;

		// REMOTE_DOMAIN
		$this->REMOTE_DOMAIN = new cField('receive_task', 'receive_task', 'x_REMOTE_DOMAIN', 'REMOTE_DOMAIN', '`REMOTE_DOMAIN`', '`REMOTE_DOMAIN`', 200, -1, FALSE, '`REMOTE_DOMAIN`', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['REMOTE_DOMAIN'] = &$this->REMOTE_DOMAIN;
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
		return "`receive_task`";
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
	var $UpdateTable = "`receive_task`";

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
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id') . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType));
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
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "receive_tasklist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "receive_tasklist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("receive_taskview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("receive_taskview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl() {
		return "receive_taskadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("receive_taskedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("receive_taskadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("receive_taskdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
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
			$arKeys[] = @$_GET["id"]; // id

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
			$this->id->CurrentValue = $key;
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

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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
				if ($this->id->Exportable) $Doc->ExportCaption($this->id);
				if ($this->username->Exportable) $Doc->ExportCaption($this->username);
				if ($this->datetime->Exportable) $Doc->ExportCaption($this->datetime);
				if ($this->server_id_sendreceive->Exportable) $Doc->ExportCaption($this->server_id_sendreceive);
				if ($this->TARGET_FILENAME->Exportable) $Doc->ExportCaption($this->TARGET_FILENAME);
				if ($this->LOCAL_PATH->Exportable) $Doc->ExportCaption($this->LOCAL_PATH);
				if ($this->REMOTE_IPAND1STLVL->Exportable) $Doc->ExportCaption($this->REMOTE_IPAND1STLVL);
				if ($this->REMOTE_REMAIN_PATH->Exportable) $Doc->ExportCaption($this->REMOTE_REMAIN_PATH);
				if ($this->REMOTE_USERNAME->Exportable) $Doc->ExportCaption($this->REMOTE_USERNAME);
				if ($this->REMOTE_PASSWORD->Exportable) $Doc->ExportCaption($this->REMOTE_PASSWORD);
				if ($this->REMOTE_DOMAIN->Exportable) $Doc->ExportCaption($this->REMOTE_DOMAIN);
			} else {
				if ($this->id->Exportable) $Doc->ExportCaption($this->id);
				if ($this->username->Exportable) $Doc->ExportCaption($this->username);
				if ($this->datetime->Exportable) $Doc->ExportCaption($this->datetime);
				if ($this->server_id_sendreceive->Exportable) $Doc->ExportCaption($this->server_id_sendreceive);
				if ($this->TARGET_FILENAME->Exportable) $Doc->ExportCaption($this->TARGET_FILENAME);
				if ($this->LOCAL_PATH->Exportable) $Doc->ExportCaption($this->LOCAL_PATH);
				if ($this->REMOTE_IPAND1STLVL->Exportable) $Doc->ExportCaption($this->REMOTE_IPAND1STLVL);
				if ($this->REMOTE_REMAIN_PATH->Exportable) $Doc->ExportCaption($this->REMOTE_REMAIN_PATH);
				if ($this->REMOTE_USERNAME->Exportable) $Doc->ExportCaption($this->REMOTE_USERNAME);
				if ($this->REMOTE_PASSWORD->Exportable) $Doc->ExportCaption($this->REMOTE_PASSWORD);
				if ($this->REMOTE_DOMAIN->Exportable) $Doc->ExportCaption($this->REMOTE_DOMAIN);
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
					if ($this->id->Exportable) $Doc->ExportField($this->id);
					if ($this->username->Exportable) $Doc->ExportField($this->username);
					if ($this->datetime->Exportable) $Doc->ExportField($this->datetime);
					if ($this->server_id_sendreceive->Exportable) $Doc->ExportField($this->server_id_sendreceive);
					if ($this->TARGET_FILENAME->Exportable) $Doc->ExportField($this->TARGET_FILENAME);
					if ($this->LOCAL_PATH->Exportable) $Doc->ExportField($this->LOCAL_PATH);
					if ($this->REMOTE_IPAND1STLVL->Exportable) $Doc->ExportField($this->REMOTE_IPAND1STLVL);
					if ($this->REMOTE_REMAIN_PATH->Exportable) $Doc->ExportField($this->REMOTE_REMAIN_PATH);
					if ($this->REMOTE_USERNAME->Exportable) $Doc->ExportField($this->REMOTE_USERNAME);
					if ($this->REMOTE_PASSWORD->Exportable) $Doc->ExportField($this->REMOTE_PASSWORD);
					if ($this->REMOTE_DOMAIN->Exportable) $Doc->ExportField($this->REMOTE_DOMAIN);
				} else {
					if ($this->id->Exportable) $Doc->ExportField($this->id);
					if ($this->username->Exportable) $Doc->ExportField($this->username);
					if ($this->datetime->Exportable) $Doc->ExportField($this->datetime);
					if ($this->server_id_sendreceive->Exportable) $Doc->ExportField($this->server_id_sendreceive);
					if ($this->TARGET_FILENAME->Exportable) $Doc->ExportField($this->TARGET_FILENAME);
					if ($this->LOCAL_PATH->Exportable) $Doc->ExportField($this->LOCAL_PATH);
					if ($this->REMOTE_IPAND1STLVL->Exportable) $Doc->ExportField($this->REMOTE_IPAND1STLVL);
					if ($this->REMOTE_REMAIN_PATH->Exportable) $Doc->ExportField($this->REMOTE_REMAIN_PATH);
					if ($this->REMOTE_USERNAME->Exportable) $Doc->ExportField($this->REMOTE_USERNAME);
					if ($this->REMOTE_PASSWORD->Exportable) $Doc->ExportField($this->REMOTE_PASSWORD);
					if ($this->REMOTE_DOMAIN->Exportable) $Doc->ExportField($this->REMOTE_DOMAIN);
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
