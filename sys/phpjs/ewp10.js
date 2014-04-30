/**
 * JavaScript for PHPMaker 10
 * (C)2002-2013 e.World Technology Ltd.
 */
var ewAddOptDialog, ewEmailDialog, $rowindex$ = null;
var EW_TABLE_CLASSNAME = "ewTable";
var EW_GRID_CLASSNAME = "ewGrid";
var EW_TABLE_ROW_CLASSNAME = "ewTableRow";
var EW_TABLE_ALT_ROW_CLASSNAME = "ewTableAltRow";
var EW_ITEM_TEMPLATE_CLASSNAME = "ewTemplate";
var EW_ITEM_TABLE_CLASSNAME = "ewItemTable";
var EW_TABLE_LAST_ROW_CLASSNAME = "ewTableLastRow";
var EW_TABLE_LAST_COL_CLASSNAME = "ewTableLastCol";
var EW_TABLE_PREVIEW_ROW_CLASSNAME = "ewTablePreviewRow";
var EW_TABLE_EDIT_ROW_CLASSNAME = "ewTableEditRow";
var EW_TABLE_SELECT_ROW_CLASSNAME = "ewTableSelectRow";
var EW_TABLE_HIGHLIGHT_ROW_CLASSNAME = "ewTableHighlightRow";
var EW_REPORT_CONTAINER_ID = "ewContainer";
var EW_ROWTYPE_ADD = 2;
var EW_ROWTYPE_EDIT = 3;
var EW_UNFORMAT_YEAR = 50;
var ew_ClientScriptInclude = jQuery.getScript;

// Default lookup filter event
function ew_DefaultLookup(e, args) { 
	var row = args.data; // New row to be validated
	var arp = args.parents; // Parent field values
	for (var i = 0, cnt = arp.length; i < cnt; i++) { // Iterate parent values
		var p = arp[i];
		if (!p.length) // Empty parent

			//continue; // Allow
			return args.valid = false; // Disallow
		var val = row[5+i]; // Filter fields start from the 6th field
		if (!jQuery.isUndefined(val) && ew_InArray(val, p) < 0) // Filter field value not in parent field values
			return args.valid = false; // Returns false if invalid
	}
}
jQuery(document).on("addoption", ew_DefaultLookup); // Lookup filter

// Init page
jQuery(function($) {	
	$("input[data-toggle=tooltip],textarea[data-toggle=tooltip],select[data-toggle=tooltip]").each(function() { // Init titles
		var $this = $(this);
		$this.tooltip($.extend({ html: true, placement: "bottom" }, $this.data()));
	})
	$("a.ewTooltipLink").each(ew_Tooltip); // Init tooltips
	$("table." + EW_TABLE_CLASSNAME).each(ew_SetupTable); // Init tables
	$("table." + EW_GRID_CLASSNAME).each(ew_SetupGrid); // Init grids
	$.later($("textarea.editor")[0] ? 250 : 0, null, function() { // Adjust footer
		var $window = $(window), outerht = $("#ewContentTable").outerHeight();	
		$window.resize(function() {		
			$("#ewContentTable").height(Math.max(outerht, $window.height() - $("#ewHeaderRow").height() - ($("#ewMenuRow").height() || 0) - $("#ewFooterRow").height()));
		}).triggerHandler("resize");
	});
	$("input[name=pageno]").keypress(function(e) {
		if (e.which == 13) {
			var url = window.location.href, p = url.lastIndexOf(window.location.search);
			window.location = url.substr(0, p) + "?" + this.name + "=" + parseInt(this.value);
			return false;
		}
	});
	if (typeof EW_USE_JAVASCRIPT_MESSAGE != "undefined" && EW_USE_JAVASCRIPT_MESSAGE)
		ew_ShowMessage(); // Show message
});

// Attach event by element id or name
function ew_On(el, sType, fn) {
	var $ = jQuery, $el;
	if ($.isString(el)) { // String, if not "xxx([])" => selector
		$el = (!/^\w+(\[\])?$/.test(el)) ? $(el) : $("[id='" + el + "'],[name='" + el + "']");
	} else {
		$el = $(el);
	}
	$el.on(sType, fn);
}
var ewEvent = { on: ew_On }; // Backward compatibility for ewEvent.on

// Batch
function ew_Batch(el, method, o, overrides) {
	var $ = jQuery, collection = [], scope = (overrides) ? o : null;			
	el = (el && (el.tagName || el.item)) ? el : $(el).get(); // skip $(el) when possible
	if (el && method) {
		if (el.tagName || el.length === undefined) // element or not array-like 
			return method.call(scope, el, o);
		for (var i = 0; i < el.length; ++i)
			collection[collection.length] = method.call(scope || el[i], el[i], o);
	} else			
		return false;
	return collection;
}

// Select elements by selector
// Pass in a selector and an optional context (if no context is provided the root "document" is used). Runs the specified selector and returns an array of matched DOMElements.
function ew_Select(selector, context, fn) {
	var $ = jQuery, $root = $(context);
	var els = $root.find(selector).get();
	if ($.isFunction(fn)) {
		els = ew_Batch(els, fn);
	} else if ($.isString(fn)) {
		els = ew_Batch(els, new Function(fn));
	}
	return els;
}

// Filter elements by selector
// Takes in a set of DOMElements, filters them against the specified selector, and returns the results. The selector can be a full selector (e.g. "div > span.foo") and not just a fragment.
function ew_Matches(selector, set, fn) {
	var $ = jQuery, els = $(set).filter(selector).get();
	if ($.isFunction(fn)) {
		els = ew_Batch(els, fn);
	} else if ($.isString(fn)) {
		els = ew_Batch(els, new Function(fn));
	}
	return els;
}

// Page class
function ew_Page(name) {
	this.Name = name;
	this.PageID = "";
}

// Forms object/function
var ewForms = function(el) { // id or element
	if (el) {
		var $ = jQuery, id;
		if ($.isString(el)) { // id
			id = el;
		} else { // element
			id = $(ew_GetForm(el)).attr("id");
		}
		if (id) {   
			for (var i in this) {
				if (i === id)
					return this[i];
			}
		}
	}
	return undefined;
}

// Form class
function ew_Form(id) {
	var $ = jQuery;	
	this.ID = id; // Same ID as the form
	this.$Element = null;
	this.Form = null;
	this.InitSearchPanel = false; // Expanded by default

	// Toggle highlight
	this.ToggleHighlight = function(lnk, name) {
		$("span." + name).toggleClass("ewHighlightSearch");
		var $lnk = $(lnk).toggleClass("ewHideHighlight");
		$lnk.html($lnk.hasClass("ewHideHighlight") ? ewLanguage.Phrase("HideHighlight") : ewLanguage.Phrase("ShowHighlight"));
	}

	// Change search operator
	this.SrchOprChanged = function(el) {
		var form = this.GetForm(), elem = $.isString(el) ? form.elements[el] : el;
		if (!elem)
			return;
		var param = elem.id.substr(2), val = $(elem).val(), isBetween = val == "BETWEEN",
			isNullOpr = val == "IS NULL" || val == "IS NOT NULL";
		if (/^z_/.test(elem.id) && form.elements["x_" + param]) {
			form.elements["x_" + param].disabled = isNullOpr;
		} else if (/^w_/.test(elem.id) && form.elements["y_" + param]) {
			form.elements["y_" + param].disabled = isNullOpr;
		}
		$(form).find("span.btw0_" + param).toggle(!isBetween).end().find("span.btw1_" + param).toggle(isBetween)
			.find(":input").prop("disabled", !isBetween); 	
	}

	// Validate
	this.ValidateRequired = true;
	this.Validate = null;

	// Disable form
	this.DisableForm = function() {
		if (!EW_DISABLE_BUTTON_ON_SUBMIT)
			return;
		var form = this.GetForm();
		$(form).find(":submit").prop("disabled", true).addClass("disabled"); 
	}

	// Enable form
	this.EnableForm = function() {
		if (!EW_DISABLE_BUTTON_ON_SUBMIT)
			return;
		var form = this.GetForm();
		$(form).find(":submit").prop("disabled", false).removeClass("disabled");
	}

	// Submit
	this.Submit = function(action) {
		var form = this.GetForm(), $form = $(form);
		this.DisableForm();
		this.UpdateTextArea();
		if (!this.Validate || this.Validate()) {
			if (action)
				form.action = action;
			$form.find("input[name^=s_],input[name^=sv_],input[name^=q_]") // Do not submit these values
				.prop("disabled", true);
			form.submit();
		} else {
			this.EnableForm();	
		}		
		return false;
	}	

	// Check empty row
	this.EmptyRow = null;

	// Multi-page
	this.MultiPage = null;

	// Dynamic selection lists
	this.Lists = {};

	// AutoSuggests
	this.AutoSuggests = {};

	// Get the HTML form object
	this.GetForm = function() {
		if (!this.Form) {			
			this.$Element = $("#" + this.ID);
			if (this.$Element.is("form")) { // HTML form
				this.Form = this.$Element[0];
			} else if (this.$Element.is("div")) { // DIV => Grid page
				this.Form = this.$Element.closest("form")[0];	
			}
		}
		return this.Form;
	}

	// Get form element(s)
	this.GetElements = function(name) {
		var selector = "[name='" + name + "']";
		selector = "input" + selector + ",select" + selector + ",textarea" + selector + ",button" + selector;
		var $els = this.$Element.find(selector);
		return ($els.length == 0) ? null : ($els.length == 1) ? $els[0] : $els.get();
	}

	// Get Auto-Suggest unmatched item (for form submission by pressing Return)
	this.PostAutoSuggest = function() {

		// reserved
	}

	// Update dynamic selection lists
	this.UpdateOpts = function(rowindex) {
		if (rowindex === $rowindex$) // null => return, undefined => update all
			return;		
		var lists = [], form = this.GetForm();
		for (var id in this.Lists) {
			var parents = this.Lists[id].ParentFields.slice(); // Clone
			var ajax = this.Lists[id].Ajax;
			if ($.isValue(rowindex)) {
				id = id.replace(/^x_/, "x" + rowindex + "_");
				for (var i = 0, len = parents.length; i < len; i++)						
					parents[i] = parents[i].replace(/^x_/, "x" + rowindex + "_");
			}				
			if (ajax) { // Ajax 
				var pvalues = [];
				for (var i = 0, len = parents.length; i < len; i++)						
					pvalues[pvalues.length] = ew_GetOptValues(parents[i], form); // Save the initial values of the parent lists	
				lists[lists.length] = [id, pvalues, true, false];
			} else { // Non-Ajax
				ew_UpdateOpt.call(this, id, parents, null, false);	
			}   	
		}

		// Update the Ajax lists
		for (var i = 0, cnt = lists.length; i < cnt; i++)
			ew_UpdateOpt.apply(this, lists[i]);
	}

	// Create editor(s)
	this.CreateEditor = function(name) {
		var form = this.GetForm();
		$(form.elements).filter("textarea.editor").each(function(i, el) {
			var ed = $(el).data("editor");	
			if (!ed || ed.active || ed.name.indexOf("$rowindex$") > -1 || name && ed.name != name)
				return true; // Continue	
			ed.create();
			if (name)
				return false; // Break
		});
	}

	// Update textareas
	this.UpdateTextArea = function(name) {
		var form = this.GetForm();
		$(form.elements).filter("textarea.editor").each(function(i, el) {
			var ed = $(el).data("editor");	
			if (!ed || name && ed.name != name)
				return true; // Continue	
			ed.save();
			if (name)
				return false; // Break
		});
	}

	// Destroy editor(s)
	this.DestroyEditor = function(name) {
		var form = this.GetForm();
		$(form.elements).filter("textarea.editor").each(function(i, el) {
			var ed = $(el).data("editor");
			if (!ed || name && ed.name != name)
				return true; // Continue	
			ed.destroy();
			if (name)
				return false; // Break
		});
	}

	// Show error message
	this.OnError = function(el, msg) {
		return ew_OnError(this, el, msg); 
	}

	// Init file upload
	this.InitUpload = function() {
		var form = this.GetForm();
		$(form.elements).filter("input:file").each(ew_Upload);
	}

	// Init form
	this.Init = function() {
		var self = this, form = this.GetForm(), $form = $(form);
		if (!form)
			return;		

		// Check if Search panel
		var isSearch = /s(ea)?rch$/.test(this.ID);

		// Search panel
		if (isSearch && this.InitSearchPanel && !ew_HasFormData(form))
			$form.find(".accordion-toggle[href$=_SearchBody]").click();

		// Search operators
		if (isSearch) { // Search form
			$form.find("select[id^=z_]").each(function() {
				var $this = $(this).change();
				if ($this.val() != "BETWEEN")
					$form.find("#w_" + this.id.substr(2)).change();
			});
		}

		// Multi-page
		if (this.MultiPage)
			this.MultiPage.Render(this.ID);

		// DHTML editors
		this.CreateEditor();

		// Dynamic selection lists
		this.UpdateOpts();

		// Init file upload
		this.InitUpload();

		// Bind submit event
		if (this.$Element.is("form")) { // Not Grid page
			$form.submit(function(e) {
				return self.Submit();
			});
		}

		// Store form object as data
		this.$Element.data("form", this);
	}

	// Add to the global forms object	
	ewForms[this.ID] = this;
}

// Find form
function ew_GetForm(el) {
	var $ = jQuery, $el = $(el), $f = $el.closest(".ewForm");
	if (!$f[0]) // Element not inside form
		$f = $el.closest(".ewGrid").find(".ewForm");	
	return $f[0];
}

// Check search form data
function ew_HasFormData(form) {
	var $ = jQuery, els = $(form).find("[name^=x_][value!=''],[name^=y_][value!=''],[name='psearch'][value!='']").get();
	for (var i = 0, len = els.length; i < len; i++) {
		var el = els[i];
		if (el.type == "checkbox" || el.type == "radio") {
			if (el.checked)
				return true;
		} else if (el.type == "select-one" || el.type == "select-multiple") {
			if ($(el).val() != "")
				return true;
		} else if (el.type == "text" || el.type == "hidden" || el.type == "textarea") {
			return true;
		}
	}
	return false;
}

// Update a dynamic selection list
// obj {HTMLElement|array[HTMLElement]|string|array[string]} target HTML element(s) or the id of the element(s) 
// parentId {array[string]|array[array]} parent field element names or data
// async {boolean|null} async(true) or sync(false) or non-Ajax(null)
// change {boolean} trigger onchange event
function ew_UpdateOpt(obj, parentId, async, change) {
	var $ = jQuery, self = this, $this = $(this);
	var exit = function() {
		$this.dequeue();
	};	
	if (!obj || obj.length == 0)
		return exit();
	var f = (this.Form) ? this.Form : (this.form) ? this.form : null;
	if (this.form && /^x\d+_/.test(this.id)) // Has row index => grid
		f = ew_GetForm(this); // Detail grid or HTML form
	if (!f)
		return exit();
	var frm = (this.Form) ? this : ewForms[f.id];
	if (!frm)
		return exit();
	var args = $.makeArray(arguments);	
	if (this.form && $.isArray(obj) && $.isString(obj[0])) { // Array of id (onchange/onclick event)
		for (var i = 0, len = obj.length; i < len; i++)
			$this.queue($.proxy(ew_UpdateOpt, self, obj[i], parentId, async, change));
		var list = frm.Lists[this.id.replace(/^[xy]\d*_/, "x_")];
		if (list && list.AutoFill) // AutoFill
			$this.queue(function(){ ew_AutoFill(self); });
		return exit();
	}
	if ($.isString(obj))
		obj = ew_GetElements(obj, f);
	var ar = ew_GetOptValues(obj);
	var oid = ew_GetId(obj, false);
	if (!oid)
		return exit();
	var nid = oid.replace(/^([xy])(\d*)_/, "x_");
	var prefix = RegExp.$1;	
	var rowindex = RegExp.$2;
	var arp = [];
	if ($.isUndefined(parentId)) { // Parent IDs not specified, use default
		parentId = frm.Lists[nid].ParentFields.slice(); // Clone
		if (rowindex != "") {
			for (var i = 0, len = parentId.length; i < len; i++)
				parentId[i] = parentId[i].replace(/^x_/, "x" + rowindex + "_");
		} else if (prefix == "y") {

//			for (var i = 0, len = parentId.length; i < len; i++) {
//				var yid = parentId[i].replace(/^x_/, "y_");
//				var yobj = ew_GetElements(yid, f);
//				if (yobj.type || yobj.length > 0) // Has y_* parent
//					parentId[i] = yid; // Changes with y_* parent
//			}

		}
	}
	if ($.isArray(parentId) && parentId.length > 0) {
		if ($.isArray(parentId[0])) { // Array of array => data
			arp = parentId;
		} else if ($.isString(parentId[0])) { // Array of string => Parent IDs
			for (var i = 0, len = parentId.length; i < len; i++)
				arp[arp.length] = ew_GetOptValues(parentId[i], f);				
		}
	}
	if (!ew_IsAutoSuggest(obj)) // Do not clear Auto-Suggest
		ew_ClearOpt(obj);
	var addOpt = function(aResults) {
		for (var i = 0, cnt = aResults.length; i < cnt; i++) {
			var args = {data: aResults[i], parents: arp, valid: true, name: ew_GetId(obj), form: f};			
			$(document).trigger("addoption", [args]);			
			if (args.valid)
				ew_NewOpt(obj, aResults[i], f);
		}
		if (!obj.options && obj.length) { // Radio/Checkbox list
			ew_RenderOpt(obj, f);
			obj = ew_GetElements(oid, f); // Update the list
		}
		ew_SelectOpt(obj, ar);
		if (change !== false)
			$(obj).first().change();
	}
	if ($.isUndefined(async)) // Async not specified, use default
		async = frm.Lists[nid].Ajax;
	if (!$.isBoolean(async)) { // Non-Ajax
		var ds = frm.Lists[nid].Options;
		addOpt(ds);
		if (/s(ea)?rch$/.test(f.id) && prefix == "x") { // Search form
			args[0] = oid.replace(/^x_/, "y_");
			ew_UpdateOpt.apply(this, args); // Update the y_* element
		}
		return exit();
	} else { // Ajax		
		var name = ew_GetId(obj), data = $(f).find("#s_" + name).val();
		if (!data)
			return exit();
		data += "&type=updateopt&name=" + name; // Name of the target element 
		if (ew_IsAutoSuggest(obj) && this.Form) // Auto-Suggest (init form or auto-fill)
			data += "&v0=" + encodeURIComponent(ar[0]); // Filter by the current value
		for (var i = 0, cnt = arp.length; i < cnt; i++) // Filter by parent fields
			data += "&v" + (i+1) + "=" + encodeURIComponent(arp[i].join(","));
		$.post(EW_LOOKUP_FILE_NAME, data, function(result) {
			addOpt(result || []);
		}, "json").always(function() {
			$this.dequeue();
		});
		if (/s(ea)?rch$/.test(f.id) && prefix == "x") { // Search form
			args[0] = oid.replace(/^x_/, "y_");
			ew_UpdateOpt.apply(this, args); // Update the y_* element
		}		
	}	
}

// ew_Language class
function ew_Language(obj) {
	this.obj = obj;
	this.Phrase = function(id) {
		return this.obj[id.toLowerCase()];
	};
}

// Apply client side template to a DIV
function ew_ApplyTemplate(divId, tmplId) {
	var $ = jQuery, $tmpl = $("#" + tmplId);
	if (!$.views || !$tmpl[0])
		return;
	if (!$tmpl.attr("type")) // Not script
		$tmpl.attr("type", "text/html");
	var args = {data: {}, id: divId, template: tmplId, enabled: true};
	$(document).trigger("rendertemplate", [args]);
	if (args.enabled)
		$("#" + divId).html($tmpl.render(args.data));
}

// Render client side template and return the rendered HTML
function ew_RenderTemplate(tmplId) {
	var $ = jQuery, $tmpl = $("#" + tmplId);
	if (!$.views || !$tmpl[0])
		return;
	if (!$tmpl.attr("type")) // Not script
		$tmpl.attr("type", "text/html");
	var args = {data: {}, template: tmplId};
	$(document).trigger("rendertemplate", [args])
	return $tmpl.render(args.data);
}

// Show template
function ew_ShowTemplates(classname) {
	var $ = jQuery;
	$("script" + ((classname) ? "." + classname : "") + "[type='text/html']").each(function() {
		$scr = $(this);		
		if (/^\s*(<td[\s\S]*>[\s\S]*<\/td>)\s*$/i.test($scr.html())) { // Table cells
			$scr.next().before($("<table><tr>" + RegExp.$1 + "</tr></table>").find("tr:first > td"));
		} else {
			$(this).after($("<span></span>").addClass($scr.attr("class")).html($scr.html()));
		}
		$scr.closest(".ewTable").show();
		$scr.closest(".ewGrid").show();
	});
}

// Check if boolean value is true
function ew_ConvertToBool(value) {
	return ew_InArray(value.toLowerCase(), ["1", "y", "t"]) > -1;
}

// Check if element value changed
function ew_ValueChanged(fobj, infix, fld, bool) {
	var $ = jQuery;
	var nelm = ew_GetElement("x" + infix + "_" + fld, fobj);
	var oelm = ew_GetElement("o" + infix + "_" + fld, fobj); // Hidden element
	var foelm = ew_GetElement("fo" + infix + "_" + fld, fobj); // Hidden element
	if (!oelm && (!nelm || $.isArray(nelm) && nelm.length == 0))
		return false;
	var getvalue = function(obj) {
		return ew_GetOptValues(obj).join(",");	
	}		
	if (oelm && nelm) {
		if (bool) {
			if (ew_ConvertToBool(getvalue(oelm)) === ew_ConvertToBool(getvalue(nelm)))
				return false;
		} else {
			if (foelm) {
				if (getvalue(foelm) == getvalue(nelm))
					return false;
			} else {
				if (getvalue(oelm) == getvalue(nelm))
					return false;
			}
		}
	}
	return true;
}

// Readonly textarea
function ew_ReadOnlyTextArea(ta, w, h) {
	if (!ta || !ta.parentNode)
		return;
	var $ = jQuery, $ta = $(ta).hide().prop("readOnly", true);
	var $div = $("<div></div>").addClass("ewReadOnlyTextArea").width(w).height(h).appendTo($ta.parent());
	var $handle = $("<div></div>").addClass("ewResizeHandle").appendTo($div);
	var $div2 = $("<div></div>").html($ta.val()).addClass("ewReadOnlyTextAreaData uneditable-textarea").appendTo($div);
	$div2.height($div.height() - 5);
	$div.drag("start", function(ev, dd) {
			dd.width = $(this).width();
			dd.height = $(this).height();
		}).drag(function(ev, dd) {
			$(this).css({
				width: Math.max(20, dd.width + dd.deltaX),
				height: Math.max(20, dd.height + dd.deltaY)
			});
			$div2.height($div.height() - 5);
		}, { handle: ".ewResizeHandle" });
}

// Get a value from querystring
function ew_Get(key, query) {
	query = query || window.location.search; 
	var re = /(?:\?|&)([^&=]+)=?([^&]*)/g;
	var decodeRE = /\+/g;
	var decode = function(str) {
		return decodeURIComponent(str.replace(decodeRE, " "));
	};
	var params = {}, e;
	while (e = re.exec(query)) { 
		var k = decode(e[1]), v = decode(e[2]);
		if (k.substring(k.length - 2) === "[]")
		k = k.substring(0, k.length - 2);
		(params[k] || (params[k] = [])).push(v);
	}
	return params[key];
}

// Submit language form
function ew_SubmitLanguageForm(f) {
	if (!f || !f.language || !f.language.value)
		return;
	var url = window.location.href;
	if (window.location.search) {
		var query = window.location.search;
		var param = {};			
		query.replace(/(?:\?|&)([^&=]*)=?([^&]*)/g, function ($0, $1, $2) {
			if ($1)
				param[$1] = $2;
		});
		param["language"] = encodeURIComponent(f.language.value);
		var q = "?";
		for (var i in param)
			q += i + "=" + param[i] + "&";
		q = q.substr(0, q.length-1);
		var p = url.lastIndexOf(window.location.search);
		url = url.substr(0, p) + q;			
	} else {
		url += "?language=" + encodeURIComponent(f.language.value);
	}
	window.location = url;
}

// Submit selected records for update/delete/custom action
function ew_SubmitSelected(f, url, msg, action) {
	if (!f)
		return;
	if (!ew_KeySelected(f)) {
		alert(ewLanguage.Phrase("NoRecordSelected"));
	} else {
		if ((msg) ? ew_Confirm(msg) : true) {
			var $ = jQuery, $f = $(f);
			if (action)
				$("<input/>").attr({ type: "hidden", name: "useraction" }).val(action).appendTo($f);
			$f.prop("action", url).submit();
		}
	}
}

// Submit selected records for export
function ew_SubmitSelectedExport(f, a, val) {
	if (!f)
		return;
	if (!ew_KeySelected(f)) {
		alert(ewLanguage.Phrase("NoRecordSelected"));
	} else {
		if (f.exporttype && val)
			f.exporttype.value = val;
		f.submit();
	}
}

// Remove spaces
function ew_RemoveSpaces(value) {
	return (/^(<(p|br)\/?>(&nbsp;)?(<\/p>)?)?$/i.test(value.replace(/\s/g, ""))) ? "" : value;
}

// Check if hidden text area (DHTML editor)
function ew_IsHiddenTextArea(el) {
	var $ = jQuery, $el = $(el);
	return (el && $el.is(":hidden") && $el.data("editor"));
}

// Check if hidden textbox (Auto-Suggest)
function ew_IsAutoSuggest(el) {
	var $ = jQuery, $el = $(el);
	return (el && $el.is(":hidden") && $el.data("typeahead"));	
}

// Get AutoSuggest instance
function ew_GetAutoSuggest(el) {
	return ewForms(el).AutoSuggests[el.id];
}

// Show error message
function ew_OnError(frm, el, msg) {
	alert(msg);
	if (frm) {
		if (frm.MultiPage) { // Multi-page
			frm.MultiPage.GotoPageByElement(el);
		} else if (frm.$Element.is("div")) { // Multiple Master/Detail
			var $pane = frm.$Element.closest(".tab-pane");
			if ($pane[0] && !$pane.hasClass("active"))
				$pane.closest(".tabbable").find("a[data-toggle=tab][href='#" + $pane.attr("id") + "']").click();
		}
	}
	jQuery.later(100, this, "ew_SetFocus", el); // Focus later to make sure editors are created
	return false;
}

// Set focus
function ew_SetFocus(obj) {
	if (!obj)
		return;
	var $ = jQuery, $obj = $(obj);
	if (ew_IsHiddenTextArea(obj)) { // DHTML editor
		return $obj.data("editor").focus();
	} else if (!obj.options && obj.length) { // Radio/Checkbox list 	
		obj = $obj.filter("[value!='{value}']")[0];
	} else if (ew_IsAutoSuggest(obj)) { // Auto-Suggest
		obj = ew_GetAutoSuggest(obj).input; 
	}	
	var $cg = $obj.closest(".control-group").addClass("error");
	$obj.focus().select().one("click keypress", function() {
		$cg.removeClass("error");
	});
}

// Check if object has value
function ew_HasValue(obj) {
	return ew_GetOptValues(obj).join("") != "";
}

// Get Ctrl key for multiple column sort
function ew_Sort(e, url, type) {
	if (type == 2 && e.ctrlKey)
		url += "&ctrl=1";
	location = url;
	return true;
}

// Confirm message
function ew_Confirm(msg) {
	return confirm(msg);
}

// Confirm Delete Message
function ew_ConfirmDelete(msg, el) {
	var del = confirm(msg);
	if (!del)
		ew_ClearDelete(el); // Clear delete status
	return del;
}

// Check if any key selected // PHP
function ew_KeySelected(f) {
	return jQuery(f).find("input:checkbox[name='key_m[]']:checked", f).length > 0;
}

// Select all key
function ew_SelectAllKey(cb) {
	ew_SelectAll(cb);
	var $ = jQuery, tbl = $(cb).closest("." + EW_TABLE_CLASSNAME)[0];
	if (!tbl)
		return;
	$(tbl.tBodies).each(function() {
		$(this.rows).each(function(i, r) {
			var $r = $(r);
			if ($r.is(":not(." + EW_ITEM_TEMPLATE_CLASSNAME + "):not(." + EW_TABLE_PREVIEW_ROW_CLASSNAME + ")")) {
				$r.data({ selected: cb.checked, checked: cb.checked });
				ew_SetColor(i, r);
			}
		});
	});
}

// Select all related checkboxes
function ew_SelectAll(cb)	{
	if (!cb || !cb.form)
		return;
	$(cb.form.elements).filter("input:checkbox[name^=" + cb.name + "_], :checkbox[name=" + cb.name + "]").not(cb).prop("checked", cb.checked); 	
}

// Update selected checkbox
function ew_UpdateSelected(f) {
	return jQuery(f).find("input:checkbox[name^=u_]:checked").length > 0;
}

// Add class to table row
function ew_AddClass(row, classname) {
	var $ = jQuery, $row = $(row)
	if (!$row.data("bgcolor"))
		$row.data("bgcolor", $row.css("backgroundColor"));
	if (!$row.data("color"))
		$row.data("color", $row.css("color"));
	$row.css("backgroundColor", "").css("color", "").addClass(classname);
}

// Remove class from table row
function ew_RemoveClass(row, classname) {
	var $ = jQuery, $row = $(row).removeClass(classname);
	if ($row.data("bgcolor"))
		$row.css("backgroundColor", $row.data("bgcolor"));
	if ($row.data("color"))
		$row.css("color", $row.data("color"));
}

// Appy function to sibling rows
function ew_UpdateRow(row, fn) {
	var $ = jQuery, $row = $(row), index = $row.data("rowindex");
	if (!row || !$.isFunction(fn))
		return;
	fn(-1, row);	
	if (index) {
		$row.prevUntil("tr[data-rowindex!='" + index + "']").each(fn);
		$row.nextUntil("tr[data-rowindex!='" + index + "']").each(fn);
	}
}

// Set mouse over color
function ew_MouseOver(e) {
	var $ = jQuery, $this = $(this);
	if (!$this.data("selected") && ew_InArray($this.data("rowtype"), [EW_ROWTYPE_ADD, EW_ROWTYPE_EDIT]) == -1) {
		var $tbl = $this.closest("." + EW_TABLE_CLASSNAME);
		if (!$tbl[0])
			return;
		ew_UpdateRow(this, function(i, r) {
			$(r).addClass($tbl.data("rowhighlightclass") || EW_TABLE_HIGHLIGHT_ROW_CLASSNAME);
		});
	}
}

// Set mouse out color
function ew_MouseOut(e) {
	var $ = jQuery, $this = $(this);
	if (!$this.data("selected") && ew_InArray($this.data("rowtype"), [EW_ROWTYPE_ADD, EW_ROWTYPE_EDIT]) == -1)
		ew_UpdateRow(this, ew_SetColor);
}

// Set selected row color
function ew_Click(e) {
	var $ = jQuery, $this = $(this), tbl = $this.closest("." + EW_TABLE_CLASSNAME)[0],
		$target = $(e.target);
	if (!tbl || $target.hasClass("btn") || $target.hasClass("ewPreviewRowImage") || $target.is(":input"))
		return;	
	if (!$this.data("checked")) {
		var selected = $this.data("selected");
		ew_ClearSelected(tbl); // Clear all other selected rows		
		ew_UpdateRow(this, function(i, r) {
			$(r).data("selected", !selected); // Toggle
			ew_SetColor(i, r);
		});
	}
}

// Set row color
function ew_SetColor(index, row) {
	var $ = jQuery, $row = $(row), $tbl = $row.closest("." + EW_TABLE_CLASSNAME);
	if (!$tbl[0])
		return;
	if ($row.data("selected")) {
		$row.removeClass($tbl.data("rowhighlightclass") || EW_TABLE_HIGHLIGHT_ROW_CLASSNAME)
			.removeClass($tbl.data("roweditclass") || EW_TABLE_EDIT_ROW_CLASSNAME)
			.addClass($tbl.data("rowselectclass") || EW_TABLE_SELECT_ROW_CLASSNAME);
	} else if (ew_InArray($row.data("rowtype"), [EW_ROWTYPE_ADD, EW_ROWTYPE_EDIT]) > -1) {
		$row.removeClass($tbl.data("rowselectclass") || EW_TABLE_SELECT_ROW_CLASSNAME)
			.removeClass($tbl.data("rowhighlightclass") || EW_TABLE_HIGHLIGHT_ROW_CLASSNAME)
			.addClass($tbl.data("roweditclass") || EW_TABLE_EDIT_ROW_CLASSNAME);
	} else {
		$row.removeClass($tbl.data("rowselectclass") || EW_TABLE_SELECT_ROW_CLASSNAME)
			.removeClass($tbl.data("roweditclass") || EW_TABLE_EDIT_ROW_CLASSNAME)
			.removeClass($tbl.data("rowhighlightclass") || EW_TABLE_HIGHLIGHT_ROW_CLASSNAME);
	}
}

// Clear selected rows color
function ew_ClearSelected(tbl) {
	var $ = jQuery;
	$(tbl.rows).each(function(i, r) {
		var $r = $(r); 	
		if (!$r.data("checked") && $r.data("selected")) {
			$r.data("selected", false);
			ew_SetColor(i, r);
		}
	});	
}

// Clear all row delete status
function ew_ClearDelete(el) {
	var $ = jQuery, $el = $(el), tbl = $el.closest("." + EW_TABLE_CLASSNAME)[0];
	if (!tbl)
		return;
	ew_UpdateRow($el.closest(".ewTable > tbody > tr")[0], function(i, r) {
		var $r = $(r);
		$r.data("selected", $r.data("checked"));
	});
}

// Click single delete link
function ew_ClickDelete(el) {
	var $ = jQuery, $el = $(el), tbl = $el.closest("." + EW_TABLE_CLASSNAME)[0];
	if (!tbl)
		return;		
	ew_ClearSelected(tbl);
	ew_UpdateRow($el.closest(".ewTable > tbody > tr")[0], function(i, r) {
		$(r).data("selected", true);
		ew_SetColor(i, r);
	});
}

// Stop propagation
function ew_StopPropagation(e) {
	if (e.stopPropagation) {
		e.stopPropagation();
	} else {
		e.cancelBubble = true;
	}
}

// Click multiple checkbox
function ew_ClickMultiCheckbox(e, cb) {
	var $ = jQuery, $cb = $(cb), tbl = $cb.closest("." + EW_TABLE_CLASSNAME)[0];
	if (!tbl)
		return;
	ew_ClearSelected(tbl);
	ew_UpdateRow($cb.closest(".ewTable > tbody > tr")[0], function(i, r) {
		$(r).data("checked", cb.checked).data("selected", cb.checked).find("input:checkbox[name='key_m[]']").each(function() {
			if (this != cb) this.checked = cb.checked;
		});
		ew_SetColor(i, r);
	});
	ew_StopPropagation(e);
}

// Setup table
function ew_SetupTable(index, tbl, force) {
	var $ = jQuery, $tbl = $(tbl), $rows = $(tbl.rows);
	if (!tbl || !tbl.rows || !force && $tbl.data("isset") || tbl.tBodies.length == 0)
		return;	
	var n = $rows.filter("[data-rowindex=1]").length || $rows.filter("[data-rowindex=0]").length || 1; // Alternate color every n rows
	var rows = $rows.filter(":not(." + EW_ITEM_TEMPLATE_CLASSNAME + ")").map(function() {
		$(this.cells).removeClass(EW_TABLE_LAST_ROW_CLASSNAME).last().addClass(EW_TABLE_LAST_COL_CLASSNAME); // Cell of last column
		return this;
	}).get();
	if (rows.length) {
		for (var i = 1; i <= n; i++) {
			var r = rows[rows.length - i];
			$(r.cells).each(function() {
				if (this.rowSpan == i) // Cell of last row
					$(this).addClass(EW_TABLE_LAST_ROW_CLASSNAME);	
			});
		}
	}
	var form = $tbl.closest("form")[0];
	var attach = form && $(form.elements).filter("input#a_list:not([value^=grid])").length > 0; 
	rows = $(tbl.tBodies[tbl.tBodies.length - 1].rows).filter(":not(." + EW_ITEM_TEMPLATE_CLASSNAME + "):not(." + EW_TABLE_PREVIEW_ROW_CLASSNAME + ")")
		.each(function() {
			var $r = $(this);
			if (attach && !$r.data("isset")) {
				if (ew_InArray($r.data("rowtype"), [EW_ROWTYPE_ADD, EW_ROWTYPE_EDIT]) > -1) // Add/Edit row
					$r.on("mouseover", function() {this.edit = true;}).addClass(EW_TABLE_EDIT_ROW_CLASSNAME);
				$r.on("mouseover", ew_MouseOver).on("mouseout", ew_MouseOut).on("click", ew_Click);
				$r.data("isset", true);
			}
			return r;
		}); // Use last TBODY (avoid Opera bug)
	$(rows).each(function(i) {
		var sw = i % (2 * n) < n;
		$(this).toggleClass(EW_TABLE_ROW_CLASSNAME, sw).toggleClass(EW_TABLE_ALT_ROW_CLASSNAME, !sw);
	});	
	ew_SetupGrid(index, $tbl.closest("." + EW_GRID_CLASSNAME)[0], force);
	$tbl.data("isset", true);
}

// Transpose a vertical table to horizontal
function ew_Transpose(tbl) {
	var $ = jQuery, $tbl = $(tbl), $rows = $tbl.find("tbody").detach().children("tr");
	$tbl.removeClass("table table-bordered table-striped").addClass("ewTable ewTableSeparate")
		.append('<thead><tr class="ewTableHeader"></tr></thead><tbody><tr></tr></tbody>')
		.wrap('<table cellspacing="0" class="ewGrid"><tbody><tr><td class="ewGridContent"></td></tr></tbody></table>');
	var $tr1 = $tbl.find("thead > tr"), $tr2 = $tbl.find("tbody > tr"); 
	$rows.each(function() {
		var $this = $(this);
		$this.find("td:first").appendTo($tr1);
		$this.find("td:last").appendTo($tr2);
	});	
	ew_SetupTable(-1, $tbl[0]);
}

// Reflow for mobile
function ew_Reflow() {
	if (!EW_IS_MOBILE)
		return;
	var $ = jQuery;
	$(".ewGrid .table:first-child, .ewBasicSearch, .ewForm:has(div.control-group)").each(function() {
		$el = $(this);
		if ($el.is("table.table")) {
			var $p = $el.parent();
			$el.hide().find("tr[id^=r_] > td").each(function() {
				var $this = $(this);
				if ($this.is(":first-child")) {
					$this.wrapInner("<div></div>").contents().first().addClass("ewLabelRow").appendTo($p).find("> label").addClass("pull-left");
				} else if ($this.is(":last-child")) {
					var $div = $this.wrapInner("<div></div>").contents().first().addClass("ewInputRow").appendTo($p);
					$div.find(".ewSearchCond, .ewSearchOperator").wrap('<div class="ewLabelRow pull-left"></div>');
					$div.find(".control-group").wrap('<div style="clear: both;"></div>');
				} else {
					$this.contents().appendTo($p.find(".ewLabelRow:last"));
				}
			});
		} else if ($el.is(".ewBasicSearch")) {		
			$el.find(".ewRow:has(.ewCell)").each(function() {
				var $p = $(this);
				$p.find(".ewCell").hide().each(function() {
					var $this = $(this);			
					$("<div></div>").append($this.find(".ewSearchCaption:first")).addClass("ewLabelRow").appendTo($p);
					$this.find(".ewSearchOperator:first").appendTo($p.find(".ewLabelRow:last"));
					$("<div></div>").append($this.contents()).addClass("ewInputRow").appendTo($p);
				});			
			});
		} else if ($el.is(".ewForm")) {
			$(this).removeClass("form-horizontal");
		}
	});	
}

// Setup grid
function ew_SetupGrid(index, grid, force) {
	var $ = jQuery, $grid = $(grid);
	if (!grid || !force && $grid.data("isset"))
		return;
	var multi = $grid.find("table.ewMultiColumnTable").length, rowcnt; 
	if (multi) {
		rowcnt = $grid.find("td[data-rowindex]").length;
	} else {	
		rowcnt = $grid.find("table." + EW_TABLE_CLASSNAME + " > tbody:first > tr:not(." + EW_TABLE_PREVIEW_ROW_CLASSNAME + ", ." + EW_ITEM_TEMPLATE_CLASSNAME + ")").length;
	}
	var $divupper = $grid.find("div.ewGridUpperPanel");
	var $divmiddle = $grid.find("div.ewGridMiddlePanel");
	var $divlower = $grid.find("div.ewGridLowerPanel");
	var noborder = !multi && rowcnt == 0; 
	if ($divupper[0] && $divlower[0]) {
		$divlower.toggleClass("hide", rowcnt == 0);
		$divupper.toggleClass("ewNoBorderBottom", noborder);
	} else if ($divupper[0] && !$divlower[0]) {
		$divupper.toggleClass("ewNoBorderBottom", noborder);		
	} else if ($divlower[0] && !$divupper[0]) {
		$divlower.toggleClass("ewNoBorderTop", noborder);
	}
	$grid.data("isset", true);
}

// Add a row to grid // Requires IE >= 9
function ew_AddGridRow(el) {
	var $ = jQuery, $grid = $(el).closest("." + EW_GRID_CLASSNAME),
		$tbl = $grid.find("table." + EW_TABLE_CLASSNAME),
		$tpl = $tbl.find("tr." + EW_ITEM_TEMPLATE_CLASSNAME);
	if (!el || !$grid[0] || !$tbl[0] || !$tpl[0])
		return;
	var $lastrow = $($tbl[0].rows).last().removeClass(EW_TABLE_LAST_ROW_CLASSNAME);
	var $row = $tpl.clone(true).removeClass(EW_ITEM_TEMPLATE_CLASSNAME);
	var $form = $grid.find("div.ewForm[id^=f][id$=grid]");
	if (!$form[0])
		$form = $grid.find("form.ewForm[id^=f][id$=list]");
    var suffix = ($form.is("div")) ? "_" + $form.attr("id") : "";
    var $elkeycnt = $form.find("#key_count" + suffix);
	var keycnt = parseInt($elkeycnt.val(), 10) + 1;	
	$row.attr({ "id": "r" + keycnt + $row.attr("id").substring(2), "data-rowindex": keycnt });
	var $els = $tpl.find("script:contains('$rowindex$')"); // Get scripts with rowindex	
	$row.children("td").each(function() {
		this.innerHTML = this.innerHTML.replace(/\$rowindex\$/g, keycnt); // Replace row index
	});
	$elkeycnt.val(keycnt).after($("<input>").attr({
		type: "hidden",
		id: "k" + keycnt + "_action" + suffix,
		name: "k" + keycnt + "_action" + suffix,
		value: "insert"
	}));
	$lastrow.after($row); 
	var frm = $form.data("form");
	if (frm) {
		frm.CreateEditor();
		frm.InitUpload();
	}
	$els.each(function() {
		ew_AddScript(this.text.replace(/\$rowindex\$/g, keycnt));
	});
	ew_SetupTable(-1, $tbl[0], true);
}

// Delete a row from grid
function ew_DeleteGridRow(el, infix) {
	var $ = jQuery, $grid = $(el).closest("." + EW_GRID_CLASSNAME),
		$row = $(el).closest("tr"), $tbl = $row.closest("." + EW_TABLE_CLASSNAME);
	if (!el || !$grid[0] || !$row[0] || !$tbl[0])
		return;
	var rowidx = parseInt($row.data("rowindex"), 10);	
	var $form = $grid.find("div.ewForm[id^=f][id$=grid]");
	if (!$form[0])
		$form = $grid.find("form.ewForm[id^=f][id$=list]");
	var frm = $form.data("form");
	if (!$form[0] || !frm)
		return;
	var suffix = ($form.is("div")) ? "_" + $form.attr("id") : "";
    var keycntname = "#key_count" + suffix;
    var $elkeycnt = $form.find(keycntname);
	var cf = ($.isFunction(frm.EmptyRow)) ? !frm.EmptyRow(infix) : true;
	if (cf && !confirm(ewLanguage.Phrase("DeleteConfirmMsg")))
		return;
	$row.remove();
	ew_SetupTable(-1, $tbl[0], true);
	if (rowidx > 0) {
		var $keyact = $form.find("#k" + rowidx + "_action" + suffix);
		if ($keyact[0]) {
			$keyact.val(($keyact.val() == "insert") ? "insertdelete" : "delete");
		} else {
			$form.find(keycntname).after($("<input>").attr({
				type: "hidden",
				id: "k" + rowidx + "_action" + suffix,
				name: "k" + rowidx + "_action" + suffix,
				value: "delete"
			}));
		}
		return true;
	}
	return false;
}

// HTML encode text
function ew_HtmlEncode(text) {
	var str = String(text);
	str = str.replace(/&/g, '&amp');
	str = str.replace(/\"/g, '&quot;');
	str = str.replace(/</g, '&lt;');
	str = str.replace(/>/g, '&gt;'); 
	return str;
}

// Clear search form
function ew_ClearForm(form){
	var $ = jQuery;
	$(form).find("[id^=x_],[id^=y_]").each(function() {
		if (this.type == "checkbox" || this.type == "radio") {
			this.checked = false;
		} else if (this.type == "select-one") {
			this.selectedIndex = 0;
		} else if (this.type == "select-multiple") {
			$(this).find("option").prop("selected", false);
		} else if (this.type == "text" || this.type == "textarea") {
			this.value = "";
		}
	});
}

// Multi-Page
function ew_MultiPage(formid, els) {
	var $ = jQuery, self = this;
	this.FormID = formid;
	this.PageIndex = 1;
	this.MaxPageIndex = 0;
	this.MinPageIndex = 0;
	this.Elements = els || [];
	this.$Pages = null;
	this.SubmitButton = null;
	this.LastPageSubmit = false;
	this.HideDisabledButton = true;

	// Init
	this.Init = function() {
		$.each(this.Elements, function(i, el) { 		
			if (el[1] > self.MaxPageIndex)
				self.MaxPageIndex = el[1]; 
		});	
		this.MinPageIndex = this.MaxPageIndex;
		$.each(this.Elements, function(i, el) {
			if (el[1] < self.MinPageIndex)
				self.MinPageIndex = el[1];  
		});
	}

	// Show page	
	this.ShowPage = function() {
		this.EnableButtons();
	}

	// Enable buttons
	this.EnableButtons = function() {
		if (this.SubmitButton) {
			var $btn = $(this.SubmitButton);
			var disabled = this.LastPageSubmit && this.PageIndex != this.MaxPageIndex || false; 
			$btn.prop("disabled", disabled).toggleClass("disabled", disabled);
			if ($btn.prop("disabled") && this.HideDisabledButton) {
				$btn.hide();
			} else {
				$btn.show();	
			}
		}
	}

	// Get page index by element ID
	this.GetPageIndexByElementId = function(elemid) {
		for (var i = 0, len = this.Elements.length; i < len; i++) {
			if (this.Elements[i][0] == elemid)
				return this.Elements[i][1];
		}
		return -1;
	}

	// Goto page by index
	this.GotoPageByIndex = function(pageIndex) {
		if (pageIndex < this.MinPageIndex || pageIndex > this.MaxPageIndex)
			return; 
		if (this.PageIndex != pageIndex)			
			this.$Pages.eq(pageIndex - 1).click();
	}

	// Goto page by element
	this.GotoPageByElement = function(elem) {
		if (!elem)
			return;
		var id = (!elem.type && elem[0]) ? elem[0].id : elem.id;
		if (id == "")
			return;	
		var pageIndex = this.GetPageIndexByElementId(id);
		if (pageIndex > 0)
			this.GotoPageByIndex(pageIndex);
	}

	// Render 
	this.Render = function(id) {
		var $ = jQuery, self = this, $mp = $("#" + id);		
		self.Init(); // Multi-page initialization
		self.SubmitButton = $mp.find("#btnAction")[0];
		var $tabs = $mp.find("[data-toggle=tab]");
		if ($tabs[0]) {
			this.$Pages = $tabs;
			$tabs.on("shown", function(e) {
				self.PageIndex = $tabs.index(e.target) + 1;
				self.ShowPage();
			}).each(function() {
				if ($(this).parent("li").hasClass("active")) {
					self.PageIndex = $tabs.index(this) + 1;
					self.ShowPage();
					return false;
				}
			});
			return;
		}
		var $collapses = $mp.find("[data-toggle=collapse]");
		if ($collapses[0]) {
			this.$Pages = $collapses;
			var $bodies = $collapses.parent().next(); 
			$bodies.on("shown", function(e) {
				self.PageIndex = $bodies.index(e.target) + 1;
				self.ShowPage();
			}).each(function() {
				if ($(this).hasClass("in")) {
					self.PageIndex = $bodies.index(this) + 1;
					self.ShowPage();
					return false;
				}
			});
		}
	}
}

// Get form element(s) as single element or array of radio/checkbox
function ew_GetElements(name, root) {
	var $ = jQuery, root = $.isString(root) ? "#" + root : root, selector = "[name='" + name + "']";
	selector = "input" + selector + ",select" + selector + ",textarea" + selector + ",button" + selector;
	var $els = (root) ? $(root).find(selector) : $(selector); // Exclude template element
	if ($els.length == 1 && $els.is(":not(:checkbox):not(:radio)"))
		return $els[0];
	return $els.get();
}

// Get first element (not necessarily form element)
function ew_GetElement(name, root) {
	var $ = jQuery, root = $.isString(root) ? "#" + root : root,
		selector = "#" + name.replace(/([\$\[\]])/g, "\\$1") + ",[name='" + name + "']";
	return (root) ? $(root).find(selector)[0] : $(selector).first()[0];
}

// Check if same text
function ew_SameText(o1, o2) {
	return (String(o1).toLowerCase() == String(o2).toLowerCase());
}

// Check if same string
function ew_SameStr(o1, o2) {
	return (String(o1) == String(o2));
}

// Check if an element is in array
function ew_InArray(el, ar) {
	if (!ar)
		return -1;	
	for (var i = 0, len = ar.length; i < len; i++) {
		if (ew_SameStr(ar[i], el))
			return i;
	}		
	return -1;
}

// Get existing selected values as an array
function ew_GetOptValues(el, form) {
	var $ = jQuery, obj = ($.isString(el)) ? ew_GetElements(el, form) : el;
	if (obj.options) { // Selection list
		return $(obj).find("option:selected[value!='']").map(function() {
			return this.value;
		}).get();
	} else if ($.isNumber(obj.length)) { // Radio/Checkbox list, or element not found
		return $(obj).filter(":checked[value!='{value}']").map(function() {
			return this.value;
		}).get();
	} else { // text/hidden
		return [obj.value];	
	}	
}

// Clear existing options
function ew_ClearOpt(obj) {
	if (obj.options) { // Selection list
		var lo = (obj.type == "select-multiple") ? 0 : 1;
		for (var i = obj.length - 1; i >= lo; i--)
			obj.options[i] = null;
	} else if (obj.length) { // Radio/Checkbox list
		var $ = jQuery, id = ew_GetId(obj),
			p = ew_GetElement("dsl_" + id, obj[0].form);
		$(p).data("options", []).find("table." + EW_ITEM_TABLE_CLASSNAME).remove();
	} else if (ew_IsAutoSuggest(obj)) {
		var o = ew_GetAutoSuggest(obj);
		o._options = [];
		o.input.value = "";
		obj.value = "";
	}
}

// Get the name or id of an element
// remove {boolean} remove square brackets, default: true
function ew_GetId(el, remove) {
	var $ = jQuery, id = "";
	if ($.isString(el)) {
		id = el;
	} else {
		id = $(el).attr("name") || $(el).attr("id"); // Use name first (id may have suffix)
	}
	if (remove !== false && /\[\]$/.test(id)) // Ends with []
		id = id.substr(0, id.length-2); 	
	return id;
}

// Get display value separator
function ew_ValueSeparator(index, obj) {
	return ", ";
}

// Create combobox option 
function ew_NewOpt(obj, ar, f) {
	var $ = jQuery, args = {data: ar, id: ew_GetId(obj), form: f};
	$(document).trigger("newoption", [args]);	
	ar = args.data;
	var value = ar[0];
	var text = ar[1];	
	for (var i = 2; i <= 4; i++) {
		if (ar[i] && ar[i] != "") {
			if (text != "")
				text += ew_ValueSeparator(i-1, obj);
			text += ar[i];
		}
	}
	if (obj.options) { // Selection list
		obj.options[obj.length] = new Option(text, value, false, false);
	} else if (obj.length) { // Radio/Checkbox list
		var $ = jQuery, $p = $(ew_GetElement("dsl_" + ew_GetId(obj), f)), opts = $p.data("options"); // Parent element		
		if ($p[0] && opts)
			opts[opts.length] = {val:value, lbl:text};
	} else if (ew_IsAutoSuggest(obj)) { // Auto-Suggest
		var o = ew_GetAutoSuggest(obj);
		o._options[o._options.length] = {val:value, lbl:text};
	}
	return text;
}

// Render the options
function ew_RenderOpt(obj, f) {
	var id = ew_GetId(obj); 
	var $ = jQuery, p = ew_GetElement("dsl_" + id, f), $p = $(p); // Parent element	
	if (!p || !$p.data("options"))
		return;
	var t = ew_GetElement("tp_" + id, f); 	
	if (!t)
		return;
	var cols = parseInt($p.data("repeatcolumn"), 10) || 5;
	var $tpl = $(t).contents(), opts = $p.data("options"), type = $tpl.attr("type"),
		$tbl = $("<table class=\"" + EW_ITEM_TABLE_CLASSNAME + "\"></table>"), $tr;
	if (opts && opts.length) {
		for (var i = 0, cnt = opts.length; i < cnt; i++) {
			if (i % cols == 0)
				$tr = $("<tr></tr>");
			var $el = $tpl.clone(true).val(opts[i].val);
			var $lbl = $("<label class=\"" + type + "\">" + opts[i].lbl + "</label>").prepend($el.attr("id", $el.attr("id") + "_" + i));				
			$("<td></td>").append($lbl).appendTo($tr);
			if (i % cols == cols - 1) {
				$tbl.append($tr);
			} else if (i == cnt - 1) { // Last
				for (var j = (i % cols) + 1; j < cols; j++)
					$tr.append("<td>&nbsp;</td>");
				$tbl.append($tr);
			} 		
		}
		$p.append($tbl);		
	}
	$p.data("options", []);		
}

// Select combobox option
function ew_SelectOpt(obj, value_array) {
	if (!obj || !value_array)
		return;
	var $ = jQuery;
	if (obj.options) { // Selection list
		$(obj).val(value_array);
		if (obj.type == "select-one" && obj.selectedIndex == -1)
			obj.selectedIndex = 0; // Make sure an option is selected (IE)
	} else if (obj.length) { // Radio/Checkbox list
		if (obj.length == 1 && obj[0].type == "checkbox" && obj[0].value != "{value}") { // Assume boolean field // P802
			obj[0].checked = (ew_ConvertToBool(obj[0].value) === ew_ConvertToBool(value_array[0]));
		} else {
			$(obj).val(value_array);
		}
	} else if (ew_IsAutoSuggest(obj) && value_array.length == 1) {
		var o = ew_GetAutoSuggest(obj);
		for (var i = 0, len = o._options.length; i < len; i++) {
			if (o._options[i].val == value_array[0]) {
				obj.value = o._options[i].val;
				o.input.value = o._options[i].lbl;
				break;
			}
		}
	} else if (obj.type) {
		obj.value = value_array.join(",");
	}

	// Auto-select if only one option
	function isAutoSelect(el) {
		if (!$(el).data("autoselect")) // data-autoselect="false"
			return false;
		var form = ew_GetForm(el);
		if (form) {
			if (/s(ea)?rch$/.test(form.id)) // Search forms
				return false;
			var nid = el.id.replace(/^([xy])(\d*)_/, "x_");
			if (nid in ewForms[form.id].Lists && ewForms[form.id].Lists[nid].ParentFields.length == 0) // No parent fields
				return false;
			return true;
		}
		return false;
	} 
	if (obj.options) { // Selection List
		if (obj.type == "select-one" && obj.options.length == 2 && !obj.options[1].selected && isAutoSelect(obj)) {
			obj.options[1].selected = true;
		} else if (obj.type == "select-multiple" && obj.options.length == 1 && !obj.options[0].selected && isAutoSelect(obj)) {
			obj.options[0].selected = true;
		}
	} else if (obj.length) { // Radio/Checkbox list
		if (obj.length == 2 && isAutoSelect(obj[1]))
			obj[1].checked = true;
	} else if (ew_IsAutoSuggest(obj)) {
		var o = ew_GetAutoSuggest(obj);
		if (o._options.length == 1 && isAutoSelect(obj)) {
			obj.value = o._options[0].val;
			o.input.value = o._options[0].lbl;
		}
	}
}

// Auto-Suggest
function ew_AutoSuggest(elValue, frm, forceSelection, maxEntries) {
	var nid = elValue.replace(/^[xy](\d*|\$rowindex\$)_/, "x_");
	var rowindex = RegExp.$1;
	var oEmpty = {ac:{}}; // Empty Auto-Suggest object
	if (rowindex == "$rowindex$")
		return oEmpty;
	var form = frm.GetForm(); 
	var elInput = ew_GetElement("sv_" + elValue, form);
	if (!elInput)
		return oEmpty;
	var elContainer = ew_GetElement("sc_" + elValue, form);
	var elSQL = ew_GetElement("q_" + elValue, form);
	var elMessage = ew_GetElement("em_" + elValue, form);	
	var elParent = frm.Lists[nid].ParentFields.slice(); // Clone
	for (var i = 0, len = elParent.length; i < len; i++)
		elParent[i] = elParent[i].replace(/^x_/, "x" + rowindex + "_");
	this.input = elInput;
	this.element = ew_GetElement(elValue, form);
	this._options = [];
	var self = this, $ = jQuery, $input = $(this.input), $element = $(this.element);

	// Format display value (Note: Override this function if link field <> display field)
	this.formatResult = function(ar) {
		return ar[0];
	};

	// Generate request
	this.generateRequest = function(sQuery) {
		var data = elSQL.value;
		if (elParent.length > 0) {
			for (var i = 0, len = elParent.length; i < len; i++) {
				var arp = ew_GetOptValues(elParent[i], form);
				data += "&v" + (i+1) + "=" + encodeURIComponent(arp.join(","));
			}
		}
		return "type=autosuggest&name=" + this.element.name + "&q=" + sQuery + "&" + data; 
	};

	// Set the selected item to the actual value field
	this.setValue = function(v) {
		v = v || $input.val();
		var ar = jQuery.grep($input.data("results"), function(item) {
			return item[item.length - 1] == v;
		});
		if (ar.length == 0) { // No results
			if (forceSelection && v) { // Query not empty						
				$input.val("").closest(".control-group").addClass("error");
				$(elMessage).show();
				$element.val("").change();
				return;
			}
		} else {
			var i = $input.data("typeahead").$menu.find('.active').index();
			v = $input.data("results")[i][0];
		}				
		$element.val(v).change();
	};

	// Create Typeahead	
	$input.prop("autocomplete", "off").typeahead({	
		minLength: 1,
		items: maxEntries,

		// matcher
		matcher: function(item) {
	      return true;
	    },

		// sorter
		sorter: function (items) {
			return items;
		},

		// source
		source: function(query, process) {
			$.post(EW_LOOKUP_FILE_NAME, self.generateRequest(query), function(data) {
				$input.data("results", data || []);
				var ar = $.map($input.data("results"), function(item) {
					return item[item.length] = self.formatResult(item);
				});
				if (ar.length == 0)
					$input.data("typeahead").$menu.html("");
				process(ar);
			}, "json");		
		},

		// updater
		updater: function(item) {
			self.setValue(item);
			return item;
		}		
	}).blur(function(e) {
		if ($input.data("typeahead").shown)
			return;
		self.setValue();
	}).focus(function(e) {
		$input.closest(".control-group").removeClass("error");
		$(elMessage).hide();
	});
	this.ac = $input.data("typeahead");
	$element.data("typeahead", true);
}

// Execute JavaScript in HTML loaded by Ajax
function ew_ExecScript(html, id) {
	var ar, i = 0, re = /<script([^>]*)>([\s\S]*?)<\/script\s*>/ig;
	while ((ar = re.exec(html)) != null) {
		var text = RegExp.$2;
		if (/(\s+type\s*=\s*['"]*(text|application)\/(java|ecma)script['"]*)|^((?!\s+type\s*=).)*$/i.test(RegExp.$1))
			ew_AddScript(text, "scr_" + id + "_" + i++);
	}
}

// Strip JavaScript in HTML loaded by Ajax
function ew_StripScript(html) {
	var ar, re = /<script([^>]*)>([\s\S]*?)<\/script\s*>/ig;
	var str = html;
	while ((ar = re.exec(html)) != null) {
		var text = RegExp.lastMatch;
		if (/(\s+type\s*=\s*['"]*(text|application)\/(java|ecma)script['"]*)|^((?!\s+type\s*=).)*$/i.test(RegExp.$1))
			str = str.replace(text, "");
	}
	return str;
}

// Add SCRIPT tag
function ew_AddScript(text, id) {
	var scr = document.createElement("SCRIPT");
	if (id)
		scr.id = id;
	scr.type = "text/javascript";
	scr.text = text;
	return document.body.appendChild(scr); // Do not use jQuery so it can be removed
}

// Remove JavaScript added by Ajax
function ew_RemoveScript(id) {
	if (id)
		jQuery("script[id^='scr_" + id + "_']").remove();
}

// Get form elements as object, property is HTML element or array of HTML element (deprecated) 
function ew_ElementsToRow(fobj) {
	var $ = jQuery, $fobj = $(fobj), infix = $fobj.data("rowindex");
	infix = $.isValue(infix) ? infix : "";
	var	row = { "index": infix };
	$fobj.find("[name^=x" + infix + "_]").each(function() {
		var elname = "x_" + this.name.substr(infix.length + 2); // Use original element name x_fieldname([])
		if ($.isObject(row[elname])) { // Already exists
			if ($.isArray(row[elname])) {
				row[elname][row[elname].length] = this; // Add to array
			} else {
				row[elname] = [row[elname], this]; // Convert to array
			}
		} else {
			row[elname] = this;
		}
	});
	return row;
}

// Get form elements as object, property is field value(s)
function ew_GetRow(fobj) {
	var $ = jQuery, $fobj = $(fobj), infix = $fobj.data("rowindex");
	infix = $.isValue(infix) ? infix : "";
	var	row = { "_index": infix }; // Add "_" prefix
	var ar = $fobj.find("[name^=x" + infix + "_]").serializeArray();
	$.each(ar, function() {
		var elname = this.name.substr(infix.length + 2).replace(/\[\]$/, ""); // Remove "x_" prefix and "[]" prefix
		if ($.isValue(row[elname])) { // Already exists
			if ($.isArray(row[elname])) {
				row[elname][row[elname].length] = this.value; // Add to array
			} else {
				row[elname] = [row[elname], this.value]; // Convert to array
			}
		} else {
			row[elname] = this.value;
		}
	});
	return row;
}

//  Add Option success handler
function ew_AddOptSuccess(data) {
	var $ = jQuery, $dlg = ewAddOptDialog, results;
	if (!$dlg)
		return;
	if (data) {
		try { 	
			results = $.parseJSON(data);
		} catch(e) {}
	}		
	if (results && results.length > 0) {
		var result = results[0];
		var el = $dlg.data("args").el; // HTML element
		var prefix = "x_";
		if (el.match(/^(x\d+_)/)) // Check row index
			prefix = RegExp.$1;
		var _fixname = function(name) {
			return name.replace(/^x_/, prefix);
		}
		var frm = ewForms($dlg.data("args").lnk); // ew_Form object
		$dlg.modal("hide");
		var form = frm.Form; // HTML form object				
		var obj = ew_GetElements(el, form);
		if (obj) {
			var name = el.replace(prefix, "x_");
			var lf = frm.Lists[name].LinkField;
			var dfs = frm.Lists[name].DisplayFields;
			var ffs = frm.Lists[name].FilterFields;
			var pfs = frm.Lists[name].ParentFields;			
			var lfv = (lf != "") ? result[lf] : "";
			var row = [lfv];
			for (var i = 0, len = dfs.length; i < len; i++)				
				row[row.length] = (dfs[i] in result) ? result[dfs[i]] : "";
			for (var i = 0, len = ffs.length; i < len; i++)				
				row[row.length] = (ffs[i] in result) ? result[ffs[i]] : "";
			if (lfv && dfs.length > 0 && row[1]) {
				var id = ew_GetId(el, false);
				if (frm.Lists[id.replace(prefix, "x_")].Ajax === null) { // Non-Ajax	 
					var ar = frm.Lists[id].Options; 					
					ar[ar.length] = row;
				}

				// Get the parent field values
				var arp = [];
				for (var i = 0, len = pfs.length; i < len; i++)
					arp[arp.length] = ew_GetOptValues(_fixname(pfs[i]), form);
				var args = {data: row, parents: arp, valid: true, id: ew_GetId(obj), form: form};
				$(document).trigger("addoption", [args]);				
				if (args.valid) { // Add the new option
					var vals = [];
					if (!obj.options && obj.length) { // Radio/Checkbox list
						var p = ew_GetElement("dsl_" + ew_GetId(obj), form); // Container element
						if (!p)
							return;
						vals = $(obj).filter(":checked").map(function(){ return this.value; }).get();						
						ew_ClearOpt(obj);
						$(p).data("options", $(obj).filter("[value!='{value}']").map(function() {
							return {val: this.value, lbl: (this.nextSibling) ? this.nextSibling.nodeValue : ""};
						}).get());				
					}
					var txt = ew_NewOpt(obj, row, form);
					if (obj.options) {
						obj.options[obj.options.length-1].selected = true;
						$(obj).change().focus();
					} else if (obj.length) { // Radio/Checkbox list					
						ew_RenderOpt(obj, form);
						obj = ew_GetElements(id, form); // Update the list
						if (vals.length > 0)
							ew_SelectOpt(obj, vals);	
						if (obj.length > 0) {
							var el = obj[obj.length-1];
							if (el.type == "checkbox" || el.type == "radio")
								$(el).click(); // Select new option and trigger click event 
							el.focus();
						}
					} else if (ew_IsAutoSuggest(obj)) {
						var o = ew_GetAutoSuggest(obj);
						$(obj).val(lfv).change();
						$(o.input).val(txt).focus();
					}
				}
			}
		}
	} else {
		var msg, $div = $dlg.find("div.ewMessageDialog").html(""),
			$div2 = $("<div></div>").html(data).find("div.ewMessageDialog");
		if ($div2[0]) {
			msg = $div2.html();
		} else {
			msg = data;
			if (!msg || $.trim(msg) == "")
				msg = ewLanguage.Phrase("InsertFailed");
			msg = "<p class=\"text-error\">" + msg + "</p>";			
		}
		$div.html(msg).show();
	}
}

// Hide Add Option dialog
function ew_AddOptDialogHide() {
	if ($dlg = ewAddOptDialog) {		
		ew_RemoveScript($dlg.data("args").el);
		$dlg.removeData("args").find(".modal-body form").data("form").DestroyEditor();
		$dlg.find(".modal-body").html("");
		$dlg.find(".modal-footer .btn-primary").unbind();
	}
}

// Modal Start Drag event
function ew_ModalDragStart(ev, dd) {
	var $ = jQuery, $this = $(this), $body = $("body");
	dd.limit = $body.offset();
	dd.limit.bottom = dd.limit.top + $body.outerHeight() - $this.outerHeight();
	dd.limit.right = dd.limit.left + $body.outerWidth() - $this.outerWidth();
}

// Modal Drag event
function ew_ModalDrag(ev, dd){
	var $ = jQuery, $this = $(this), m = parseInt($this.css("margin-left"), 10); // Handle margin-left of modal				
	$this.css({									
		top: Math.min(dd.limit.bottom, Math.max(dd.limit.top, dd.offsetY)),
		left: Math.min(dd.limit.right - m, Math.max(dd.limit.left - m, dd.offsetX - m))
	});
}

// Show Add Option dialog
// argument object properties:
// frm {object} ew_Form object
// lnk {HTMLElement} add option anchor element
// el {string} form element name
// url {string} URL of the Add form 
function ew_AddOptDialogShow(args) {
	var $ = jQuery, $dlg = ewAddOptDialog || $("#ewAddOptDialog")
		.on("hidden", ew_AddOptDialogHide)
		.drag("start", ew_ModalDragStart)
		.drag(ew_ModalDrag, { handle: ".modal-header" });

	// fail
	var _fail = function(o) {
		$dlg.modal("hide");
		alert("Server Error " + o.status + ": " + o.statusText);
	}

	// submit
	var _submit = function() {
		var $dlg = ewAddOptDialog;
		var form = $dlg.find(".modal-body form")[0];
		var frm = ewForms[form.id];
		frm.UpdateTextArea();
		if (frm.Validate()) {
			frm.DestroyEditor();
			$.post(form.action, $(form).serialize(), ew_AddOptSuccess).fail(_fail);				
		}
	}
	$dlg.modal("hide");
	$dlg.data("args", args);
	var success = function(data) {
		var frm = ewForms(args.lnk);
		var prefix = "x_";
		if (args.el.match(/^(x\d+_)/)) // Contains row index
			prefix = RegExp.$1;		
		var name = args.el.replace(prefix, "x_");
		var pf = frm.Lists[name].ParentFields;
		var ff = frm.Lists[name].FilterFields;
		var form = frm.Form;
		var ar = [];
		for (var i = 0, len = pf.length; i < len; i++) {			
			var obj = ew_GetElements(pf[i].replace(/^x_/, prefix), form); // Get the parent field value
			ar[ar.length] = ew_GetOptValues(obj);
		}
		$dlg.find(".modal-header h3").html($(args.lnk).text());
		$dlg.find(".modal-body").html(ew_StripScript(data));
		var form = $dlg.find(".modal-body form")[0];			
		if (form) { // Set the filter field value
			for (var i = 0, len = ar.length; i < len; i++) {
				var el = form.elements[ff[i]];
				if (el)
					ew_SelectOpt(el, ar[i]);
			}
		}		
		ewAddOptDialog = $dlg.modal("show");
		$dlg.find(".modal-footer .btn-primary").click(_submit).focus();		
		ew_ExecScript(data, args.el);
	};
	$.get(args.url, success).fail(_fail);
}

// Auto-fill
function ew_AutoFill(el) {
	var $ = jQuery, f = el.form;
	if (!f)
		return;
	var ar = ew_GetOptValues(el);
	var id = ew_GetId(el);	
	var sf = ew_GetElement("sf_" + id, f);
	if (!sf || sf.value == "")
		return;
	var dn = ew_GetElement("ln_" + id, f);
	if (!dn || dn.value == "")
		return;
	var dest_array = dn.value.split(",");
	var success = function(data) {		
		var results = data || "";
		var result = (results) ? results[0] : [];
		for (var j = 0; j < dest_array.length; j++) {
			var destEl = ew_GetElements(dest_array[j], f);
			if (destEl) {
				var val = ($.isValue(result[j])) ? result[j] : "";
				var args = {result: result, data: val, form: f, name: id, target: dest_array[j], cancel: false, trigger: true};
				$(el).trigger("autofill", [args]); // Fire event
				if (args.cancel)
					continue;
				val = args.data; // Process the value
				if (destEl.options || destEl.length && destEl[0].type == "radio") { // Selection/Radio list
					ew_SelectOpt(destEl, val.split(","));
				} else if (destEl.length && destEl[0].type == "checkbox") { // Checkbox list
					ew_SelectOpt(destEl, val.split(","));
				} else if (ew_IsAutoSuggest(destEl)) { // Auto-Suggest
					destEl.value = val;
					ew_GetAutoSuggest(destEl).input.value = val;
					ew_UpdateOpt.call(ewForms[f.id], destEl);
				} else if (ew_IsHiddenTextArea(destEl)) { // DHTML editor
					destEl.value = val;
					$(destEl).data("editor").update();
				} else {
					destEl.value = val;
				}
				if (args.trigger)
					$(destEl).change();
			}
		}
	};
	if (ar.length > 0 && ar[0] != "") {		
		var data = { type: "autofill", form: f.id, name: id, target: dn.value, q: ar[0], s: sf.value };
		$.post(EW_LOOKUP_FILE_NAME, data, success, "json");
	} else {
		success();
	}
}

// Setup tooltip links
function ew_Tooltip(i, el) {
	var $ = jQuery, $this = $(el), $tt = $("#" + $this.data("tooltip-id")),
		trig = $this.data("trigger") || "hover", dir = $this.data("placement") || "right"; // dir = "left|right"
	if (!$tt[0] || $.trim($tt.text()) == "" && !$tt.find("img[src!='']")[0])
		return;		
	if (!$this.data("popover")) {
		$this.popover({
			html: true,
			placement: dir,
			trigger: trig,
			delay: 100,
			container: $("#ewTooltip")[0],
			content: $tt.html()			
		}).on("show", function(e) {
			var $tip = $this.data("popover").tip();
			if (wd = $this.data("tooltip-width")) // Set width before show	
				$tip.css("max-width", parseInt(wd, 10) + "px");		
		}).on("shown", function(e) {
			if (dir != "left" && dir != "right")
				return;
			var $target = $(e.target), tw = $target.width(), th = $target.height(),
				$document = $(document), $body = $(document.body), $tip = $this.data("popover").tip(),
				w = $tip.width(), tp = $tip.position();
			var bottom = $document.scrollTop() + $body.outerHeight() - $tip.outerHeight();			
			tp.top = Math.max($document.scrollTop(), Math.min(bottom, tp.top));
			$tip.css("top", tp.top + "px"); // Move
			var $arrow = $tip.find(".arrow");
			var top = $target.position().top - tp.top + th / 2 - $arrow.height();
			var mintop = (parseInt($tip.css("border-top-left-radius"), 10) || 6) - parseInt($arrow.css("margin-top"), 10);
			var maxtop = $tip.height() - mintop - $arrow.height();
			$arrow.css("top", Math.max(mintop, Math.min(top, maxtop)) + "px");	
		});
	}	
}

// Show dialog for email sending
// argument object members:
// lnk {string} email link id
// hdr {string} dialog header
// url {string} URL of the email script
// f {HTMLElement} form
// key {object} key as object
// sel {boolean} exported selected
function ew_EmailDialogShow(oArg) {
	var $ = jQuery, $dlg = ewEmailDialog || $("#ewEmailDialog")
		.drag("start", ew_ModalDragStart)
		.drag(ew_ModalDrag, { handle: ".modal-header" });
	if (!$dlg)
		return;
	if (oArg.sel && !ew_KeySelected(oArg.f)) {
		alert(ewLanguage.Phrase("NoRecordSelected"));
		return;
	}
	var $f = $dlg.find(".modal-body form");
	var frm = $f.data("form"); 
	if (!frm) {
		frm = new ew_Form($f.attr("id"));
		frm.Validate = function() {
			var elm, fobj = this.GetForm(); 
			elm = fobj.elements["sender"];
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterSenderEmail"));
			if (elm && !ew_CheckEmailList(elm.value, 1))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperSenderEmail"));
			elm = fobj.elements["recipient"];
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRecipientEmail"));
			if (elm && !ew_CheckEmailList(elm.value, EW_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperRecipientEmail"));
			elm = fobj.elements["cc"];
			if (elm && !ew_CheckEmailList(elm.value, EW_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperCcEmail"));
			elm = fobj.elements["bcc"];
			if (elm && !ew_CheckEmailList(elm.value, EW_MAX_EMAIL_RECIPIENT))
				return this.OnError(elm, ewLanguage.Phrase("EnterProperBccEmail"));
			elm = fobj.elements["subject"];
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterSubject"));
			return true;
		};
		frm.Submit = function() {
			if (!this.Validate())
				return false;
			var qs = $f.serialize(), data = "";
			if (oArg.f && oArg.sel) // If export selected
				data = $(oArg.f).find("input:checkbox[name='key_m[]']:checked").serialize();
			if (oArg.key)
				qs += "&" + $.param(oArg.key);	
			$.post(oArg.f.action + "?" + qs, data, function(result) {
				ew_ShowMessage(result);
			});
			return true;
		};
		$f.data("form", frm);
	}
	$dlg.modal("hide").find(".modal-header h3").html(oArg.hdr);
	$dlg.find(".modal-footer .btn-primary").unbind().click(function(e) {
		e.preventDefault();
		if (frm.Submit())
			$dlg.modal("hide");
	});
	ewEmailDialog = $dlg.modal("show");
}

// Ajax query
// Prerequisite: Output encrypted SQL by Client Script or Startup Script, e.g.
// var sql = "<?php echo ew_Encrypt("SELECT xxx FROM xxx WHERE xxx = '{query_value}'") ?>";
// where "{query_value}" will be replaced by runtime value.
// s {string} Encrypted SQL
// data {string|object} string to replace to replace "{query_value}" in SQL, or
//     object (e.g. {"q": xxx, "q1": xxx, "q2": yyy}) to replace additional values "{query_value_n}" in SQL
// callback {function} callback function for async request (see http://api.jquery.com/jQuery.post/), empty for sync request
// Note: Return value is string or array of string.
function ew_Ajax(sql, data, callback) {
	if (!sql)
		return undefined;
	var $ = jQuery, obj = { s: sql };
	obj = $.extend(obj, ($.isObject(data)) ? data : { q: data });			
	if ($.isFunction(callback)) { // Async
		$.post(EW_LOOKUP_FILE_NAME, obj, callback, "json");
	} else { // Sync
		var result = $.ajax({ async: false, type: "POST", data: obj }).responseText;
		var aResults = $.parseJSON(result);	      

		// Check if single row or single value
		if (aResults.length == 1) { // Single row
			aResults = aResults[0];
			if ($.isArray(aResults) && aResults.length == 1) { // Single column
				return aResults[0]; // Return a value
			} else {
				return aResults; // Return a row
			}	
		}
		return aResults;
	}
}

// Toggle search operator
function ew_ToggleSrchOpr(id, value) {
	var el = this.form.elements[id];
	if (!el)
		return;
	el.value = (el.value != value) ? value : "=";
}

// Validators
// Check US Date format (mm/dd/yyyy)
function ew_CheckUSDate(object_value) {
	return ew_CheckDateEx(object_value, "us", EW_DATE_SEPARATOR);
}

// Check US Date format (mm/dd/yy)
function ew_CheckShortUSDate(object_value) {
	return ew_CheckDateEx(object_value, "usshort", EW_DATE_SEPARATOR);
}

// Check Date format (yyyy/mm/dd)
function ew_CheckDate(object_value) {
	return ew_CheckDateEx(object_value, "std", EW_DATE_SEPARATOR);
}

// Check Date format (yy/mm/dd)
function ew_CheckShortDate(object_value) {
	return ew_CheckDateEx(object_value, "stdshort", EW_DATE_SEPARATOR);
}

// Check Euro Date format (dd/mm/yyyy)
function ew_CheckEuroDate(object_value) {
	return ew_CheckDateEx(object_value, "euro", EW_DATE_SEPARATOR);
}

// Check Euro Date format (dd/mm/yy)
function ew_CheckShortEuroDate(object_value) {
	return ew_CheckDateEx(object_value, "euroshort", EW_DATE_SEPARATOR);
}

// Check date format
// format: std/stdshort/us/usshort/euro/euroshort
function ew_CheckDateEx(value, format, sep) {
	if (!value || value.length == "")
		return true;
	while (value.indexOf("  ") > -1)
		value = value.replace(/  /g, " ");
	value = value.replace(/^\s*|\s*$/g, "");
	var arDT = value.split(" ");
	if (arDT.length > 0) {
		var re, sYear, sMonth, sDay;
		re = /^(\d{4})-([0][1-9]|[1][0-2])-([0][1-9]|[1|2]\d|[3][0|1])$/;
		if (ar = re.exec(arDT[0])) {
			sYear = ar[1];
			sMonth = ar[2];
			sDay = ar[3];
		} else {
			var wrksep = "\\" + sep;
			switch (format) {
				case "std":
					re = new RegExp("^(\\d{4})" + wrksep + "([0]?[1-9]|[1][0-2])" + wrksep + "([0]?[1-9]|[1|2]\\d|[3][0|1])$");
					break;
				case "stdshort":
					re = new RegExp("^(\\d{2})" + wrksep + "([0]?[1-9]|[1][0-2])" + wrksep + "([0]?[1-9]|[1|2]\\d|[3][0|1])$");
					break;
				case "us":
					re = new RegExp("^([0]?[1-9]|[1][0-2])" + wrksep + "([0]?[1-9]|[1|2]\\d|[3][0|1])" + wrksep + "(\\d{4})$");
					break;
				case "usshort":
					re = new RegExp("^([0]?[1-9]|[1][0-2])" + wrksep + "([0]?[1-9]|[1|2]\\d|[3][0|1])" + wrksep + "(\\d{2})$");
					break;
				case "euro":
					re = new RegExp("^([0]?[1-9]|[1|2]\\d|[3][0|1])" + wrksep + "([0]?[1-9]|[1][0-2])" + wrksep + "(\\d{4})$");
					break;
				case "euroshort":
					re = new RegExp("^([0]?[1-9]|[1|2]\\d|[3][0|1])" + wrksep + "([0]?[1-9]|[1][0-2])" + wrksep + "(\\d{2})$");
					break;
			}
			if (!re.test(arDT[0]))
				return false;
			var arD = arDT[0].split(sep);
			switch (format) {
				case "std":
				case "stdshort":
					sYear = ew_UnformatYear(arD[0]);
					sMonth = arD[1];
					sDay = arD[2];
					break;
				case "us":
				case "usshort":
					sYear = ew_UnformatYear(arD[2]);
					sMonth = arD[0];
					sDay = arD[1];
					break;
				case "euro":
				case "euroshort":
					sYear = ew_UnformatYear(arD[2]);
					sMonth = arD[1];
					sDay = arD[0];
					break;
			}
		}
		if (!ew_CheckDay(sYear, sMonth, sDay))
			return false;
	}
	if (arDT.length > 1 && !ew_CheckTime(arDT[1]))
		return false;
	return true;
}

// Unformat 2 digit year to 4 digit year
function ew_UnformatYear(yr) {
	if (yr.length == 2)
		return (yr > EW_UNFORMAT_YEAR) ? "19" + yr : "20" + yr;
	return yr;
}

// Check day
function ew_CheckDay(checkYear, checkMonth, checkDay) {
	checkYear = parseInt(checkYear, 10);
	checkMonth = parseInt(checkMonth, 10);
	checkDay = parseInt(checkDay, 10);
	var maxDay = (ew_InArray(checkMonth, [4, 6, 9, 11]) > -1) ? 30 : 31;
	if (checkMonth == 2)
		maxDay = (checkYear % 4 > 0 || checkYear % 100 == 0 && checkYear % 400 > 0) ? 28 : 29;
	return ew_CheckRange(checkDay, 1, maxDay);
}

// Check integer
function ew_CheckInteger(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	if (object_value.indexOf(EW_DECIMAL_POINT) > -1)
		return false;
	return ew_CheckNumber(object_value);
}

// Check number
function ew_CheckNumber(object_value) {
	object_value = String(object_value);
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = new RegExp("^[+-]?(\\d{1,3}(" + ((EW_THOUSANDS_SEP) ? "\\" + EW_THOUSANDS_SEP + "?" : "") + "\\d{3})*(\\" +
		EW_DECIMAL_POINT + "\\d+)?|\\" + EW_DECIMAL_POINT + "\\d+)$");
	return re.test(object_value);
}

// Convert to float
function ew_StrToFloat(object_value) {
	object_value = String(object_value);
	if (EW_THOUSANDS_SEP != "") {
		var re = new RegExp("\\" + EW_THOUSANDS_SEP, "g");
		object_value = object_value.replace(re, "");
	}
	if (EW_DECIMAL_POINT != "")
		object_value = object_value.replace(EW_DECIMAL_POINT, ".");
	return parseFloat(object_value);
}

// Convert string (yyyy-mm-dd hh:mm:ss) to date object
function ew_StrToDate(object_value) {
	var re = /^(\d{4})-([0][1-9]|[1][0-2])-([0][1-9]|[1|2]\d|[3][0|1]) (?:(0\d|1\d|2[0-3]):([0-5]\d):([0-5]\d))?$/;
	var ar = object_value.replace(re, "$1 $2 $3 $4 $5 $6").split(" ");
	return new Date(ar[0], ar[1]-1, ar[2], ar[3], ar[4], ar[5]);
}

// Check range
function ew_CheckRange(object_value, min_value, max_value) {
	if (!object_value || object_value.length == 0)
		return true;
	var $ = jQuery;
	if ($.isNumber(min_value) || $.isNumber(max_value)) { // Number
		if (ew_CheckNumber(object_value))
			object_value = ew_StrToFloat(object_value);
	}
	if (!$.isNull(min_value) && object_value < min_value)
		return false;
	if (!$.isNull(max_value) && object_value > max_value)
		return false;
	return true;
}

// Check time
function ew_CheckTime(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^(0\d|1\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/;
	return re.test(object_value);
}

// Check phone
function ew_CheckPhone(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^\(\d{3}\) ?\d{3}( |-)?\d{4}|^\d{3}( |-)?\d{3}( |-)?\d{4}$/;
	return re.test(object_value);
}

// Check zip
function ew_CheckZip(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^\d{5}$|^\d{5}-\d{4}$/;
	return re.test(object_value);
}

// Check credit card
function ew_CheckCreditCard(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	var creditcard_string = object_value.replace(/\D/g, "");	
	if (creditcard_string.length == 0)
		return false;
	var doubledigit = creditcard_string.length % 2 == 1 ? false : true;
	var tempdigit, checkdigit = 0;
	for (var i = 0, len = creditcard_string.length; i < len; i++) {
		tempdigit = parseInt(creditcard_string.charAt(i), 10);
		if (doubledigit) {
			tempdigit *= 2;
			checkdigit += (tempdigit % 10);			
			if (tempdigit / 10 >= 1.0)
				checkdigit++;			
			doubledigit = false;
		}	else {
			checkdigit += tempdigit;
			doubledigit = true;
		}
	}		
	return (checkdigit % 10 == 0);
}

// Check social security number
function ew_CheckSSC(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^(?!000)([0-6]\d{2}|7([0-6]\d|7[012]))([ -]?)(?!00)\d\d\3(?!0000)\d{4}$/;
	return re.test(object_value);
}

// Check emails
function ew_CheckEmailList(object_value, email_cnt) {
	if (!object_value || object_value.length == 0)
		return true;
	var arEmails = object_value.replace(/,/g, ";").split(";");
	for (var i = 0, len = arEmails.length; i < len; i++) {
		if (email_cnt > 0 && len > email_cnt)
			return false;
		if (!ew_CheckEmail(arEmails[i]))
			return false;
	}
	return true;
}

// Check email
function ew_CheckEmail(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^[\w.%+-]+@[\w.-]+\.[A-Z]{2,6}$/i;
	return re.test(object_value);
}

// Check GUID {xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx}
function ew_CheckGUID(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	object_value = object_value.replace(/^\s*|\s*$/g, "");
	var re = /^\{\w{8}-\w{4}-\w{4}-\w{4}-\w{12}\}$/;
	var re2 = /^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/;
	return re.test(object_value) || re2.test(object_value);
}

// Check file extension
function ew_CheckFileType(object_value) {
	if (!object_value || object_value.length == 0)
		return true;
	if (!EW_UPLOAD_ALLOWED_FILE_EXT)
		return true;
	if (EW_UPLOAD_ALLOWED_FILE_EXT.replace(/^\s*|\s*$/g, "") == "")
		return true;	
	var exts = EW_UPLOAD_ALLOWED_FILE_EXT.toLowerCase().split(",");
	var ext = object_value.substr(object_value.lastIndexOf(".") + 1).toLowerCase();
	return (ew_InArray(ext, exts) > -1); 
}

// Check by regular expression
function ew_CheckByRegEx(object_value, pattern) {
	if (!object_value || object_value.length == 0)
		return true;
	return (object_value.match(pattern)) ? true : false;
}

// Show message dialog
function ew_ShowMessage(msg) {
	var $ = jQuery, $div = $("div.ewMessageDialog:first");
	var html = msg || ($div.length ? (EW_IS_MOBILE ? $div.text() : $div.html()) : "");
	if ($.trim(html) == "")
		return;
	if (EW_IS_MOBILE) {
		alert(html);
	} else {
	var $dlg = $("#ewMsgBox");
	$dlg.find(".modal-body").html(html);
	$dlg.modal("show");
}
}

// Random number
function ew_Random() {
	return Math.floor(Math.random() * 100001) + 100000;
}

// File upload
function ew_Upload(index, input) {
	var $ = jQuery, $input = $(input);
	if ($input.data("blueimpFileupload"))
		return;
	var id = $input.attr("name"), nid = id.replace(/\$/g, "\\$"),
		multiple = $input.is("[multiple]"), $p = $input.closest(".control-group"), ro = ($p.find(".btn").css("display") == "none"),
		$ft = $p.find("#ft_" + nid), $fn = $p.find("#fn_" + nid), $fa = $p.find("#fa_" + nid), $fs = $p.find("#fs_" + nid);
	var _done = function(e, data) {		
		var name = data.result.files[0].name;
		var ar = (multiple) ? ($fn.val() ? $fn.val().split(",") : []) : [];
		ar[ar.length] = name;
		$fn.val(ar.join(","));
		$fa.val("0");
		if (!multiple) // Remove other entries if not multiple upload
			$ft.find("tr:not(:last)").remove();		
	}
	var _deleted = function(e, data) {
		var param = {}, url = $(e.originalEvent.target).data("url");
		if (url)			
			url.replace(/(?:\?|&)([^&=]*)=?([^&]*)/g, function ($0, $1, $2) {
				if ($1)
					param[$1] = $2;
			});
		if (param["file"]) {
			var name = param["file"];
			var ar = $fn.val() ? $fn.val().split(",") : [];
			$.each(ar, function(i, value) {
				if (value == decodeURIComponent(name)) {
					ar.splice(i, 1);
					return false;
				}
			});
			$fn.val(ar.join(","));
			$fa.val("0");
		}		
	}
	var _change = function(e, data) {
		var ar = $fn.val() ? $fn.val().split(",") : [];
		for (var i = 0; i < data.files.length; i++) 		
			ar[ar.length] = data.files[i].name;
		var cnt = data.fileInput.data("maxfilecount");		
		if ($.isNumber(cnt) && ar.length > cnt) {
			alert(ewLanguage.Phrase("UploadErrMsgMaxNumberOfFiles"));
			return false;	
		} 
		var l = parseInt($fs.val(), 10);
		if ($.isNumber(l) && l > 0 && ar.join(",").length > l) {
			alert(ewLanguage.Phrase("UploadErrMsgMaxFileLength"));
			return false;	
		}	
	}
	var _confirmDelete = function(e) {
		if (!multiple && $fn.val()) {
			if (!confirm(ewLanguage.Phrase("UploadOverwrite"))) {
				e.preventDefault();
				e.stopPropagation();
			}
		}
	}
	var _uploadTemplate = function(o) {
		var $rows = $();
		$.each(o.files, function(index, file) {
			var $row = $('<tr class="template-upload fade">' +
				'<td class="preview"><span class="fade"></span></td>' +
				'<td class="name"></td>' +
				'<td class="size"></td>' +
				(file.error ? '<td class="error text-error" colspan="2"></td>' : '<td><div class="progress">' +
				'<div class="bar" style="width: 0%;"></div></div></td>' +
				'<td><button type="button" class="btn btn-small start">' + ewLanguage.Phrase("UploadStart") + '</button></td>') +
				'<td><button type="button" class="btn btn-small cancel">' + ewLanguage.Phrase("UploadCancel") + '</button></td></tr>');
			$row.find(".name").text(file.name);
			$row.find(".size").text(o.formatFileSize(file.size));
			$row.find(".start").click(_confirmDelete);			
			$row.find(".error").text(file.error);
			$rows = $rows.add($row);
		});
		return $rows;
	}
	var _downloadTemplate = function(o) {
		var $rows = $();
		$.each(o.files, function(index, file) {
			var $row = $('<tr class="template-download fade">' +
				(file.error ? '<td></td><td class="name"></td>' +
				'<td class="size"></td><td class="error text-error" colspan="2"></td>' :
				'<td class="preview"></td>' +
				'<td class="name"><a></a></td>' +
				'<td class="size"></td><td colspan="2"></td>') +
				(ro ? '' : '<td><button type="button" class="btn btn-small delete">' + ewLanguage.Phrase("UploadDelete") + '</button></td>') +
				'</tr>');
			$row.find(".size").text(o.formatFileSize(file.size));
			if (file.error) {
				$row.find(".name").text(file.name);
				$row.find(".error").text(file.error);
			} else {
				var $a = $row.find(".name a").text(file.name);
				if (file.url)
					$a.attr("href", file.url).attr("target", "_blank");
				if (file.thumbnail_url) {
					$row.find(".preview").append('<a><img width="' + EW_UPLOAD_THUMBNAIL_WIDTH + '"></a>')
						.find("img").prop("src", file.thumbnail_url);
				}
				$row.find(".delete")
					.attr("data-type", file.delete_type)
					.attr("data-url", file.delete_url);
			}
			$rows = $rows.add($row);
		});
		return $rows;
	}
	var _changed = function() {
		$ft.css("margin-top", $ft.find("tr")[0] ? "10px" : "0");
	}

	// Hide input button if readonly
	var form = ew_GetForm(input), $form = $(form);
	var readonly = $form.find("#a_confirm").val() == "F";
	if (readonly)
		$form.find("span.fileinput-button").hide();
	$input.fileupload({			
		url: EW_UPLOAD_URL,
		autoUpload: true, // Comment out to disable auto upload
		loadImageFileTypes: /^image\/(gif|jpe?g|png)$/i,
		acceptFileTypes: new RegExp('\.(' + EW_UPLOAD_ALLOWED_FILE_EXT.replace(/,/g, '|') + ')$', 'i'),
		maxFileSize: EW_MAX_FILE_SIZE,
		filesContainer: $ft,
		formData: {id: id, replace: (multiple ? "0" : "1")},
		uploadTemplateId: null,
		downloadTemplateId: null,
		uploadTemplate: _uploadTemplate,
		downloadTemplate: _downloadTemplate,
		previewMaxWidth: EW_UPLOAD_THUMBNAIL_WIDTH,
		previewMaxHeight: EW_UPLOAD_THUMBNAIL_HEIGHT,
		dropZone: $p,
		pasteZone: $p
	}).on("fileuploaddone", _done).on("fileuploaddestroy", _deleted).on("fileuploadchange", _change)	
		.on("fileuploadadded fileuploadfinished fileuploaddestroyed", _changed);
	if ($fn.val())
		$.ajax({				
			url: EW_UPLOAD_URL,
			data: { id: id },
			dataType: "json",
			context: this,
			success: function(result) {
				if (result && result[id])
					$input.fileupload("option", "done").call(input, null, { result: { files: result[id] } }); // Use "files"	
				if (readonly) // Hide delete button if readonly
					$ft.find("td.delete").hide();
			}
		});
}

/**
* Parse a UA string. Called at instantiation to populate jQuery.ua
* Based on http://yuilibrary.com/yui/docs/api/files/yui_js_yui-ua.js.html
*
* @param {String} [subUA=navigator.userAgent] UA string to parse
* @return {Object} The UA object
*/

function ew_UserAgent(subUA) {
	var numberify = function(s) {
			var c = 0;
			return parseFloat(s.replace(/\./g, function() {
				return (c++ === 1) ? '' : '.';
			}));
		},
		win = window,
		nav = win && win.navigator,
		o = {

		/**
		 * Internet Explorer version number or 0.  Example: 6
		 * @property ie
		 * @type float
		 * @static
		 */
		ie: 0,

		/**
		 * Opera version number or 0.  Example: 9.2
		 * @property opera
		 * @type float
		 * @static
		 */
		opera: 0,

		/**
		 * Gecko engine revision number.  Will evaluate to 1 if Gecko
		 * is detected but the revision could not be found. Other browsers
		 * will be 0.  Example: 1.8
		 * <pre>
		 * Firefox 1.0.0.4: 1.7.8   <-- Reports 1.7
		 * Firefox 1.5.0.9: 1.8.0.9 <-- 1.8
		 * Firefox 2.0.0.3: 1.8.1.3 <-- 1.81
		 * Firefox 3.0   <-- 1.9
		 * Firefox 3.5   <-- 1.91
		 * </pre>
		 * @property gecko
		 * @type float
		 * @static
		 */
		gecko: 0,

		/**
		 * AppleWebKit version.  KHTML browsers that are not WebKit browsers
		 * will evaluate to 1, other browsers 0.  Example: 418.9
		 * <pre>
		 * Safari 1.3.2 (312.6): 312.8.1 <-- Reports 312.8 -- currently the
		 *                                   latest available for Mac OSX 10.3.
		 * Safari 2.0.2:         416     <-- hasOwnProperty introduced
		 * Safari 2.0.4:         418     <-- preventDefault fixed
		 * Safari 2.0.4 (419.3): 418.9.1 <-- One version of Safari may run
		 *                                   different versions of webkit
		 * Safari 2.0.4 (419.3): 419     <-- Tiger installations that have been
		 *                                   updated, but not updated
		 *                                   to the latest patch.
		 * Webkit 212 nightly:   522+    <-- Safari 3.0 precursor (with native
		 * SVG and many major issues fixed).
		 * Safari 3.0.4 (523.12) 523.12  <-- First Tiger release - automatic
		 * update from 2.x via the 10.4.11 OS patch.
		 * Webkit nightly 1/2008:525+    <-- Supports DOMContentLoaded event.
		 *                                   yahoo.com user agent hack removed.
		 * </pre>
		 * http://en.wikipedia.org/wiki/Safari_version_history
		 * @property webkit
		 * @type float
		 * @static
		 */
		webkit: 0,

		/**
		 * Safari will be detected as webkit, but this property will also
		 * be populated with the Safari version number
		 * @property safari
		 * @type float
		 * @static
		 */
		safari: 0,

		/**
		 * Chrome will be detected as webkit, but this property will also
		 * be populated with the Chrome version number
		 * @property chrome
		 * @type float
		 * @static
		 */
		chrome: 0,

		/**
		 * The mobile property will be set to a string containing any relevant
		 * user agent information when a modern mobile browser is detected.
		 * Currently limited to Safari on the iPhone/iPod Touch, Nokia N-series
		 * devices with the WebKit-based browser, and Opera Mini.
		 * @property mobile
		 * @type string
		 * @default null
		 * @static
		 */
		mobile: null,

		/**
		 * Adobe AIR version number or 0.  Only populated if webkit is detected.
		 * Example: 1.0
		 * @property air
		 * @type float
		 */
		air: 0,

		/**
		 * PhantomJS version number or 0.  Only populated if webkit is detected.
		 * Example: 1.0
		 * @property phantomjs
		 * @type float
		 */
		phantomjs: 0,

		/**
		 * Detects Apple iPad's OS version
		 * @property ipad
		 * @type float
		 * @static
		 */
		ipad: 0,

		/**
		 * Detects Apple iPhone's OS version
		 * @property iphone
		 * @type float
		 * @static
		 */
		iphone: 0,

		/**
		 * Detects Apples iPod's OS version
		 * @property ipod
		 * @type float
		 * @static
		 */
		ipod: 0,

		/**
		 * General truthy check for iPad, iPhone or iPod
		 * @property ios
		 * @type Boolean
		 * @default null
		 * @static
		 */
		ios: null,

		/**
		 * Detects Googles Android OS version
		 * @property android
		 * @type float
		 * @static
		 */
		android: 0,

		/**
		 * Detects Kindle Silk
		 * @property silk
		 * @type float
		 * @static
		 */
		silk: 0,

		/**
		 * Detects Kindle Silk Acceleration
		 * @property accel
		 * @type Boolean
		 * @static
		 */
		accel: false,

		/**
		 * Detects Palms WebOS version
		 * @property webos
		 * @type float
		 * @static
		 */
		webos: 0,

		/**
		 * Google Caja version number or 0.
		 * @property caja
		 * @type float
		 */
		caja: nav && nav.cajaVersion,

		/**
		 * Set to true if the page appears to be in SSL
		 * @property secure
		 * @type boolean
		 * @static
		 */
		secure: false,

		/**
		 * The operating system.  Currently only detecting windows or macintosh
		 * @property os
		 * @type string
		 * @default null
		 * @static
		 */
		os: null,

		/**
		 * The Nodejs Version
		 * @property nodejs
		 * @type float
		 * @default 0
		 * @static
		 */
		nodejs: 0,

		/**
		* Window8/IE10 Application host environment
		* @property winjs
		* @type Boolean
		* @static
		*/
		winjs: !!((typeof Windows !== "undefined") && Windows.System),

		/**
		* Are touch/msPointer events available on this device
		* @property touchEnabled
		* @type Boolean
		* @static
		*/
		touchEnabled: false
	},
	ua = subUA || nav && nav.userAgent,
	loc = win && win.location,
	href = loc && loc.href,
	m;

	/**
	* The User Agent string that was parsed
	* @property userAgent
	* @type String
	* @static
	*/
	o.userAgent = ua;
	o.secure = href && (href.toLowerCase().indexOf('https') === 0);
	if (ua) {
		if ((/windows|win32/i).test(ua)) {
			o.os = 'windows';
		} else if ((/macintosh|mac_powerpc/i).test(ua)) {
			o.os = 'macintosh';
		} else if ((/android/i).test(ua)) {
			o.os = 'android';
		} else if ((/symbos/i).test(ua)) {
			o.os = 'symbos';
		} else if ((/linux/i).test(ua)) {
			o.os = 'linux';
		} else if ((/rhino/i).test(ua)) {
			o.os = 'rhino';
		}

		// Modern KHTML browsers should qualify as Safari X-Grade
		if ((/KHTML/).test(ua)) {
			o.webkit = 1;
		}
		if ((/IEMobile|XBLWP7/).test(ua)) {
			o.mobile = 'windows';
		}
		if ((/Fennec/).test(ua)) {
			o.mobile = 'gecko';
		}

		// Modern WebKit browsers are at least X-Grade
		m = ua.match(/AppleWebKit\/([^\s]*)/);
		if (m && m[1]) {
			o.webkit = numberify(m[1]);
			o.safari = o.webkit;
			if (/PhantomJS/.test(ua)) {
				m = ua.match(/PhantomJS\/([^\s]*)/);
				if (m && m[1]) {
					o.phantomjs = numberify(m[1]);
				}
			}

			// Mobile browser check
			if (/ Mobile\//.test(ua) || (/iPad|iPod|iPhone/).test(ua)) {
				o.mobile = 'Apple'; // iPhone or iPod Touch
				m = ua.match(/OS ([^\s]*)/);
				if (m && m[1]) {
					m = numberify(m[1].replace('_', '.'));
				}
				o.ios = m;
				o.os = 'ios';
				o.ipad = o.ipod = o.iphone = 0;
				m = ua.match(/iPad|iPod|iPhone/);
				if (m && m[0]) {
					o[m[0].toLowerCase()] = o.ios;
				}
			} else {
				m = ua.match(/NokiaN[^\/]*|webOS\/\d\.\d/);
				if (m) {

					// Nokia N-series, webOS, ex: NokiaN95
					o.mobile = m[0];
				}
				if (/webOS/.test(ua)) {
					o.mobile = 'WebOS';
					m = ua.match(/webOS\/([^\s]*);/);
					if (m && m[1]) {
						o.webos = numberify(m[1]);
					}
				}
				if (/ Android/.test(ua)) {
					if (/Mobile/.test(ua)) {
						o.mobile = 'Android';
					}
					m = ua.match(/Android ([^\s]*);/);
					if (m && m[1]) {
						o.android = numberify(m[1]);
					}
				}
				if (/Silk/.test(ua)) {
					m = ua.match(/Silk\/([^\s]*)\)/);
					if (m && m[1]) {
						o.silk = numberify(m[1]);
					}
					if (!o.android) {
						o.android = 2.34; //Hack for desktop mode in Kindle
						o.os = 'Android';
					}
					if (/Accelerated=true/.test(ua)) {
						o.accel = true;
					}
				}
			}
			m = ua.match(/(Chrome|CrMo|CriOS)\/([^\s]*)/);
			if (m && m[1] && m[2]) {
				o.chrome = numberify(m[2]); // Chrome
				o.safari = 0; //Reset safari back to 0
				if (m[1] === 'CrMo') {
					o.mobile = 'chrome';
				}
			} else {
				m = ua.match(/AdobeAIR\/([^\s]*)/);
				if (m) {
					o.air = m[0]; // Adobe AIR 1.0 or better
				}
			}
		}
		if (!o.webkit) { // not webkit

// @todo check Opera/8.01 (J2ME/MIDP; Opera Mini/2.0.4509/1316; fi; U; ssr)
			if (/Opera/.test(ua)) {
				m = ua.match(/Opera[\s\/]([^\s]*)/);
				if (m && m[1]) {
					o.opera = numberify(m[1]);
				}
				m = ua.match(/Version\/([^\s]*)/);
				if (m && m[1]) {
					o.opera = numberify(m[1]); // opera 10+
				}
				if (/Opera Mobi/.test(ua)) {
					o.mobile = 'opera';
					m = ua.replace('Opera Mobi', '').match(/Opera ([^\s]*)/);
					if (m && m[1]) {
						o.opera = numberify(m[1]);
					}
				}
				m = ua.match(/Opera Mini[^;]*/);
				if (m) {
					o.mobile = m[0]; // ex: Opera Mini/2.0.4509/1316
				}
			} else { // not opera or webkit
				m = ua.match(/MSIE\s([^;]*)/);
				if (m && m[1]) {
					o.ie = numberify(m[1]);
				} else { // not opera, webkit, or ie
					m = ua.match(/Gecko\/([^\s]*)/);
					if (m) {
						o.gecko = 1; // Gecko detected, look for revision
						m = ua.match(/rv:([^\s\)]*)/);
						if (m && m[1]) {
							o.gecko = numberify(m[1]);
						}
					}
				}
			}
		}
	}

	//Check for known properties to tell if touch events are enabled on this device or if
	//the number of MSPointer touchpoints on this device is greater than 0.

	if (win && nav && !(o.chrome && o.chrome < 6)) {
		o.touchEnabled = (("ontouchstart" in win) || (("msMaxTouchPoints" in nav) && (nav.msMaxTouchPoints > 0)));
	}

	//It was a parsed UA, do not assign the global value.
	if (!subUA) {
		if (typeof process === 'object') {
			if (process.versions && process.versions.node) {

				//NodeJS
				o.os = process.platform;
				o.nodejs = numberify(process.versions.node);
			}
		}
	}
	return o;
}

// Extend jQuery
jQuery.extend({
	isBoolean: function(o) {
		return typeof o === 'boolean';
	},
	isNull: function(o) {
		return o === null;
	},
	isNumber: function(o) {
		return typeof o === 'number' && isFinite(o);
	},
	isObject: function(o) {
		return (o && (typeof o === 'object' || this.isFunction(o))) || false;
	},
	isString: function(o) {
		return typeof o === 'string';
	},
	isUndefined: function(o) {
		return typeof o === 'undefined';
	},
	isValue: function(o) {
		return (this.isObject(o) || this.isString(o) || this.isNumber(o) || this.isBoolean(o));
	},
	isDate: function(o) {
		return this.type(o) === 'date' && o.toString() !== 'Invalid Date' && !isNaN(o);
	},
	later: function(when, o, fn, data, periodic) {
		when = when || 0;
		o = o || {};
		var m = fn, d = data, f, r;
		if (this.isString(fn))
			m = o[fn];
		if (!m)
			return;
		if (!this.isUndefined(data) && !this.isArray(d))
			d = [data];
		f = function() {
			m.apply(o, d || []);
		};
		r = (periodic) ? setInterval(f, when) : setTimeout(f, when);
		return {
			interval: periodic,
			cancel: function() {
				if (this.interval) {
					clearInterval(r);
				} else {
					clearTimeout(r);
				}
			}
		};
	},
	ua: ew_UserAgent()
});

/*! 
 * jquery.event.drag - v 2.2
 * Copyright (c) 2010 Three Dub Media - http://threedubmedia.com
 * Open Source MIT License - http://threedubmedia.com/code/license
 */
(function( $ ){

// add the jquery instance method
$.fn.drag = function( str, arg, opts ){

	// figure out the event type
	var type = typeof str == "string" ? str : "",

	// figure out the event handler...
	fn = jQuery.isFunction( str ) ? str : jQuery.isFunction( arg ) ? arg : null;

	// fix the event type
	if ( type.indexOf("drag") !== 0 ) 
		type = "drag"+ type;

	// were options passed
	opts = ( str == fn ? arg : opts ) || {};

	// trigger or bind event handler
	return fn ? this.bind( type, opts, fn ) : this.trigger( type );
};

// local refs (increase compression)
var $event = $.event, 
$special = $event.special,

// configure the drag special event 
drag = $special.drag = {

	// these are the default settings
	defaults: {
		which: 1, // mouse button pressed to start drag sequence
		distance: 0, // distance dragged before dragstart
		not: ':input', // selector to suppress dragging on target elements
		handle: null, // selector to match handle target elements
		relative: false, // true to use "position", false to use "offset"
		drop: true, // false to suppress drop events, true or selector to allow
		click: false // false to suppress click events after dragend (no proxy)
	},

	// the key name for stored drag data
	datakey: "dragdata",

	// prevent bubbling for better performance
	noBubble: true,

	// count bound related events
	add: function( obj ){ 

		// read the interaction data
		var data = $.data( this, drag.datakey ),

		// read any passed options 
		opts = obj.data || {};

		// count another realted event
		data.related += 1;

		// extend data options bound with this event
		// don't iterate "opts" in case it is a node 

		$.each( drag.defaults, function( key, def ){
			if ( opts[ key ] !== undefined )
				data[ key ] = opts[ key ];
		});
	},

	// forget unbound related events
	remove: function(){
		$.data( this, drag.datakey ).related -= 1;
	},

	// configure interaction, capture settings
	setup: function(){

		// check for related events
		if ( $.data( this, drag.datakey ) ) 
			return;

		// initialize the drag data with copied defaults
		var data = $.extend({ related:0 }, drag.defaults );

		// store the interaction data
		$.data( this, drag.datakey, data );

		// bind the mousedown event, which starts drag interactions
		$event.add( this, "touchstart mousedown", drag.init, data );

		// prevent image dragging in IE...
		if ( this.attachEvent ) 
			this.attachEvent("ondragstart", drag.dontstart ); 
	},

	// destroy configured interaction
	teardown: function(){
		var data = $.data( this, drag.datakey ) || {};

		// check for related events
		if ( data.related ) 
			return;

		// remove the stored data
		$.removeData( this, drag.datakey );

		// remove the mousedown event
		$event.remove( this, "touchstart mousedown", drag.init );

		// enable text selection
		drag.textselect( true ); 

		// un-prevent image dragging in IE...
		if ( this.detachEvent ) 
			this.detachEvent("ondragstart", drag.dontstart ); 
	},

	// initialize the interaction
	init: function( event ){ 

		// sorry, only one touch at a time
		if ( drag.touched ) 
			return;

		// the drag/drop interaction data
		var dd = event.data, results;

		// check the which directive
		if ( event.which != 0 && dd.which > 0 && event.which != dd.which ) 
			return; 

		// check for suppressed selector
		if ( $( event.target ).is( dd.not ) ) 
			return;

		// check for handle selector
		if ( dd.handle && !$( event.target ).closest( dd.handle, event.currentTarget ).length ) 
			return;
		drag.touched = event.type == 'touchstart' ? this : null;
		dd.propagates = 1;
		dd.mousedown = this;
		dd.interactions = [ drag.interaction( this, dd ) ];
		dd.target = event.target;
		dd.pageX = event.pageX;
		dd.pageY = event.pageY;
		dd.dragging = null;

		// handle draginit event... 
		results = drag.hijack( event, "draginit", dd );

		// early cancel
		if ( !dd.propagates )
			return;

		// flatten the result set
		results = drag.flatten( results );

		// insert new interaction elements
		if ( results && results.length ){
			dd.interactions = [];
			$.each( results, function(){
				dd.interactions.push( drag.interaction( this, dd ) );
			});
		}

		// remember how many interactions are propagating
		dd.propagates = dd.interactions.length;

		// locate and init the drop targets
		if ( dd.drop !== false && $special.drop ) 
			$special.drop.handler( event, dd );

		// disable text selection
		drag.textselect( false ); 

		// bind additional events...
		if ( drag.touched )
			$event.add( drag.touched, "touchmove touchend", drag.handler, dd );
		else 
			$event.add( document, "mousemove mouseup", drag.handler, dd );

		// helps prevent text selection or scrolling
		if ( !drag.touched || dd.live )
			return false;
	},	

	// returns an interaction object
	interaction: function( elem, dd ){
		var offset = $( elem )[ dd.relative ? "position" : "offset" ]() || { top:0, left:0 };
		return {
			drag: elem, 
			callback: new drag.callback(), 
			droppable: [],
			offset: offset
		};
	},

	// handle drag-releatd DOM events
	handler: function( event ){ 

		// read the data before hijacking anything
		var dd = event.data;	

		// handle various events
		switch ( event.type ){

			// mousemove, check distance, start dragging
			case !dd.dragging && 'touchmove': 
				event.preventDefault();
			case !dd.dragging && 'mousemove':

				//  drag tolerance, x?+ y?= distance?
				if ( Math.pow(  event.pageX-dd.pageX, 2 ) + Math.pow(  event.pageY-dd.pageY, 2 ) < Math.pow( dd.distance, 2 ) ) 
					break; // distance tolerance not reached
				event.target = dd.target; // force target from "mousedown" event (fix distance issue)
				drag.hijack( event, "dragstart", dd ); // trigger "dragstart"
				if ( dd.propagates ) // "dragstart" not rejected
					dd.dragging = true; // activate interaction

			// mousemove, dragging
			case 'touchmove':
				event.preventDefault();
			case 'mousemove':
				if ( dd.dragging ){

					// trigger "drag"		
					drag.hijack( event, "drag", dd );
					if ( dd.propagates ){

						// manage drop events
						if ( dd.drop !== false && $special.drop )
							$special.drop.handler( event, dd ); // "dropstart", "dropend"							
						break; // "drag" not rejected, stop		
					}
					event.type = "mouseup"; // helps "drop" handler behave
				}

			// mouseup, stop dragging
			case 'touchend': 
			case 'mouseup': 
			default:
				if ( drag.touched )
					$event.remove( drag.touched, "touchmove touchend", drag.handler ); // remove touch events
				else 
					$event.remove( document, "mousemove mouseup", drag.handler ); // remove page events	
				if ( dd.dragging ){
					if ( dd.drop !== false && $special.drop )
						$special.drop.handler( event, dd ); // "drop"
					drag.hijack( event, "dragend", dd ); // trigger "dragend"	
				}
				drag.textselect( true ); // enable text selection

				// if suppressing click events...
				if ( dd.click === false && dd.dragging )
					$.data( dd.mousedown, "suppress.click", new Date().getTime() + 5 );
				dd.dragging = drag.touched = false; // deactivate element	
				break;
		}
	},

	// re-use event object for custom events
	hijack: function( event, type, dd, x, elem ){

		// not configured
		if ( !dd ) 
			return;

		// remember the original event and type
		var orig = { event:event.originalEvent, type:event.type },

		// is the event drag related or drog related?
		mode = type.indexOf("drop") ? "drag" : "drop",

		// iteration vars
		result, i = x || 0, ia, $elems, callback,
		len = !isNaN( x ) ? x : dd.interactions.length;

		// modify the event type
		event.type = type;

		// remove the original event
		event.originalEvent = null;

		// initialize the results
		dd.results = [];

		// handle each interacted element
		do if ( ia = dd.interactions[ i ] ){

			// validate the interaction
			if ( type !== "dragend" && ia.cancelled )
				continue;

			// set the dragdrop properties on the event object
			callback = drag.properties( event, dd, ia );

			// prepare for more results
			ia.results = [];

			// handle each element
			$( elem || ia[ mode ] || dd.droppable ).each(function( p, subject ){

				// identify drag or drop targets individually
				callback.target = subject;

				// force propagtion of the custom event
				event.isPropagationStopped = function(){ return false; };

				// handle the event	
				result = subject ? $event.dispatch.call( subject, event, callback ) : null;

				// stop the drag interaction for this element
				if ( result === false ){
					if ( mode == "drag" ){
						ia.cancelled = true;
						dd.propagates -= 1;
					}
					if ( type == "drop" ){
						ia[ mode ][p] = null;
					}
				}

				// assign any dropinit elements
				else if ( type == "dropinit" )
					ia.droppable.push( drag.element( result ) || subject );

				// accept a returned proxy element 
				if ( type == "dragstart" )
					ia.proxy = $( drag.element( result ) || ia.drag )[0];

				// remember this result	
				ia.results.push( result );

				// forget the event result, for recycling
				delete event.result;

				// break on cancelled handler
				if ( type !== "dropinit" )
					return result;
			});	

			// flatten the results	
			dd.results[ i ] = drag.flatten( ia.results );	

			// accept a set of valid drop targets
			if ( type == "dropinit" )
				ia.droppable = drag.flatten( ia.droppable );

			// locate drop targets
			if ( type == "dragstart" && !ia.cancelled )
				callback.update(); 
		}
		while ( ++i < len )

		// restore the original event & type
		event.type = orig.type;
		event.originalEvent = orig.event;

		// return all handler results
		return drag.flatten( dd.results );
	},

	// extend the callback object with drag/drop properties...
	properties: function( event, dd, ia ){		
		var obj = ia.callback;

		// elements
		obj.drag = ia.drag;
		obj.proxy = ia.proxy || ia.drag;

		// starting mouse position
		obj.startX = dd.pageX;
		obj.startY = dd.pageY;

		// current distance dragged
		obj.deltaX = event.pageX - dd.pageX;
		obj.deltaY = event.pageY - dd.pageY;

		// original element position
		obj.originalX = ia.offset.left;
		obj.originalY = ia.offset.top;

		// adjusted element position
		obj.offsetX = obj.originalX + obj.deltaX; 
		obj.offsetY = obj.originalY + obj.deltaY;

		// assign the drop targets information
		obj.drop = drag.flatten( ( ia.drop || [] ).slice() );
		obj.available = drag.flatten( ( ia.droppable || [] ).slice() );
		return obj;	
	},

	// determine is the argument is an element or jquery instance
	element: function( arg ){
		if ( arg && ( arg.jquery || arg.nodeType == 1 ) )
			return arg;
	},

	// flatten nested jquery objects and arrays into a single dimension array
	flatten: function( arr ){
		return $.map( arr, function( member ){
			return member && member.jquery ? $.makeArray( member ) : 
				member && member.length ? drag.flatten( member ) : member;
		});
	},

	// toggles text selection attributes ON (true) or OFF (false)
	textselect: function( bool ){ 
		$( document )[ bool ? "unbind" : "bind" ]("selectstart", drag.dontstart )
			.css("MozUserSelect", bool ? "" : "none" );

		// .attr("unselectable", bool ? "off" : "on" )
		document.unselectable = bool ? "off" : "on"; 
	},

	// suppress "selectstart" and "ondragstart" events
	dontstart: function(){ 
		return false; 
	},

	// a callback instance contructor
	callback: function(){}
};

// callback methods
drag.callback.prototype = {
	update: function(){
		if ( $special.drop && this.available.length )
			$.each( this.available, function( i ){
				$special.drop.locate( this, i );
			});
	}
};

// patch $.event.$dispatch to allow suppressing clicks
var $dispatch = $event.dispatch;
$event.dispatch = function( event ){
	if ( $.data( this, "suppress."+ event.type ) - new Date().getTime() > 0 ){
		$.removeData( this, "suppress."+ event.type );
		return;
	}
	return $dispatch.apply( this, arguments );
};

// event fix hooks for touch events...
var touchHooks = 
$event.fixHooks.touchstart = 
$event.fixHooks.touchmove = 
$event.fixHooks.touchend =
$event.fixHooks.touchcancel = {
	props: "clientX clientY pageX pageY screenX screenY".split( " " ),
	filter: function( event, orig ) {
		if ( orig ){
			var touched = ( orig.touches && orig.touches[0] )
				|| ( orig.changedTouches && orig.changedTouches[0] )
				|| null; 

			// iOS webkit: touchstart, touchmove, touchend
			if ( touched ) 
				$.each( touchHooks.props, function( i, prop ){
					event[ prop ] = touched[ prop ];
				});
		}
		return event;
	}
};

// share the same special event configuration with related events...
$special.draginit = $special.dragstart = $special.dragend = drag;
})( jQuery );

//
// JavaScript for PHPMaker 10
// (C)2002-2013 e.World Technology Ltd.
//
// Dates and Numbers based on YUI 3: http://yuilibrary.com/yui/docs/datatype/
//

/**
 * Pad a number with leading spaces, zeroes or something else
 * @method xPad
 * @param x {Number}	The number to be padded
 * @param pad {String}  The character to pad the number with
 * @param r {Number}	(optional) The base of the pad, eg, 10 implies to two digits, 100 implies to 3 digits.
 * @private
 */
var xPad=function (x, pad, r)
{
	if(typeof r === "undefined")
	{
		r=10;
	}
	pad = pad + ""; 
	for( ; parseInt(x, 10)<r && r>1; r/=10) {
		x = pad + x;
	}
	return x.toString();
};

//
// Date
//

var ewDate = Dt = {
	formats: {
		a: function (d, l) { return l.a[d.getDay()]; },
		A: function (d, l) { return l.A[d.getDay()]; },
		b: function (d, l) { return l.b[d.getMonth()]; },
		B: function (d, l) { return l.B[d.getMonth()]; },
		C: function (d) { return xPad(parseInt(d.getFullYear()/100, 10), 0); },
		d: ["getDate", "0"],
		e: ["getDate", " "],
		g: function (d) { return xPad(parseInt(Dt.formats.G(d)%100, 10), 0); },
		G: function (d) {
				var y = d.getFullYear();
				var V = parseInt(Dt.formats.V(d), 10);
				var W = parseInt(Dt.formats.W(d), 10);
				if(W > V) {
					y++;
				} else if(W===0 && V>=52) {
					y--;
				}
				return y;
			},
		H: ["getHours", "0"],
		I: function (d) { var I=d.getHours()%12; return xPad(I===0?12:I, 0); },
		j: function (d) {
				var gmd_1 = new Date("" + d.getFullYear() + "/1/1 GMT");
				var gmdate = new Date("" + d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate() + " GMT");
				var ms = gmdate - gmd_1;
				var doy = parseInt(ms/60000/60/24, 10)+1;
				return xPad(doy, 0, 100);
			},
		k: ["getHours", " "],
		l: function (d) { var I=d.getHours()%12; return xPad(I===0?12:I, " "); },
		m: function (d) { return xPad(d.getMonth()+1, 0); },
		M: ["getMinutes", "0"],
		p: function (d, l) { return l.p[d.getHours() >= 12 ? 1 : 0 ]; },
		P: function (d, l) { return l.P[d.getHours() >= 12 ? 1 : 0 ]; },
		s: function (d, l) { return parseInt(d.getTime()/1000, 10); },
		S: ["getSeconds", "0"],
		u: function (d) { var dow = d.getDay(); return dow===0?7:dow; },
		U: function (d) {
				var doy = parseInt(Dt.formats.j(d), 10);
				var rdow = 6-d.getDay();
				var woy = parseInt((doy+rdow)/7, 10);
				return xPad(woy, 0);
			},
		V: function (d) {
				var woy = parseInt(Dt.formats.W(d), 10);
				var dow1_1 = (new Date("" + d.getFullYear() + "/1/1")).getDay();

				// First week is 01 and not 00 as in the case of %U and %W,
				// so we add 1 to the final result except if day 1 of the year
				// is a Monday (then %W returns 01).
				// We also need to subtract 1 if the day 1 of the year is 
				// Friday-Sunday, so the resulting equation becomes:

				var idow = woy + (dow1_1 > 4 || dow1_1 <= 1 ? 0 : 1);
				if(idow === 53 && (new Date("" + d.getFullYear() + "/12/31")).getDay() < 4)
				{
					idow = 1;
				}
				else if(idow === 0)
				{
					idow = Dt.formats.V(new Date("" + (d.getFullYear()-1) + "/12/31"));
				}
				return xPad(idow, 0);
			},
		w: "getDay",
		W: function (d) {
				var doy = parseInt(Dt.formats.j(d), 10);
				var rdow = 7-Dt.formats.u(d);
				var woy = parseInt((doy+rdow)/7, 10);
				return xPad(woy, 0, 10);
			},
		y: function (d) { return xPad(d.getFullYear()%100, 0); },
		Y: "getFullYear",
		z: function (d) {
				var o = d.getTimezoneOffset();
				var H = xPad(parseInt(Math.abs(o/60), 10), 0);
				var M = xPad(Math.abs(o%60), 0);
				return (o>0?"-":"+") + H + M;
			},
		Z: function (d) {
			var tz = d.toString().replace(/^.*:\d\d( GMT[+-]\d+)? \(?([A-Za-z ]+)\)?\d*$/, "$2").replace(/[a-z ]/g, "");
			if(tz.length > 4) {
				tz = Dt.formats.z(d);
			}
			return tz;
		},
		"%": function (d) { return "%"; }
	},
	aggregates: {
		c: "locale",
		D: "%m/%d/%y",
		F: "%Y-%m-%d",
		h: "%b",
		n: "\n",
		r: "%I:%M:%S %p",
		R: "%H:%M",
		t: "\t",
		T: "%H:%M:%S",
		x: "locale",
		X: "locale"

		//"+": "%a %b %e %T %Z %Y"
	},
	resources: { // *** Note: Customize ewDate.resources in client side events
		a:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],
		A:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
		b:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
		B:["January","February","March","April","May","June","July","August","September","October","November","December"],
		c:"%a, %b %d, %Y %l:%M:%S %p %Z",
		p:["AM","PM"],
		P:["am","pm"],
		x:"%m/%d/%y",
		X:"%l:%M:%S %p"
	},	

	 /**
	 * Takes a native JavaScript Date and formats it as a string for display to user.
	 *
	 * @for Date
	 * @method format
	 * @param oDate {Date} Date.
	 * @param oConfig {Object} (Optional) Object literal of configuration values:
	 *  <dl>
	 *   <dt>format {HTML} (Optional)</dt>
	 *   <dd>
	 *   <p>
	 *   Any strftime string is supported, such as "%I:%M:%S %p". strftime has several format specifiers defined by the Open group at 
	 *   <a href="http://www.opengroup.org/onlinepubs/007908799/xsh/strftime.html">http://www.opengroup.org/onlinepubs/007908799/xsh/strftime.html</a>
	 *   PHP added a few of its own, defined at <a href="http://www.php.net/strftime">http://www.php.net/strftime</a>
	 *   </p>
	 *   <p>
	 *   This javascript implementation supports all the PHP specifiers and a few more.  The full list is below.
	 *   </p>
	 *   <p>
	 *   If not specified, it defaults to the ISO 8601 standard date format: %Y-%m-%d.
	 *   </p>
	 *   <dl>
	 *	<dt>%a</dt> <dd>abbreviated weekday name according to the current locale</dd>
	 *	<dt>%A</dt> <dd>full weekday name according to the current locale</dd>
	 *	<dt>%b</dt> <dd>abbreviated month name according to the current locale</dd>
	 *	<dt>%B</dt> <dd>full month name according to the current locale</dd>
	 *	<dt>%c</dt> <dd>preferred date and time representation for the current locale</dd>
	 *	<dt>%C</dt> <dd>century number (the year divided by 100 and truncated to an integer, range 00 to 99)</dd>
	 *	<dt>%d</dt> <dd>day of the month as a decimal number (range 01 to 31)</dd>
	 *	<dt>%D</dt> <dd>same as %m/%d/%y</dd>
	 *	<dt>%e</dt> <dd>day of the month as a decimal number, a single digit is preceded by a space (range " 1" to "31")</dd>
	 *	<dt>%F</dt> <dd>same as %Y-%m-%d (ISO 8601 date format)</dd>
	 *	<dt>%g</dt> <dd>like %G, but without the century</dd>
	 *	<dt>%G</dt> <dd>The 4-digit year corresponding to the ISO week number</dd>
	 *	<dt>%h</dt> <dd>same as %b</dd>
	 *	<dt>%H</dt> <dd>hour as a decimal number using a 24-hour clock (range 00 to 23)</dd>
	 *	<dt>%I</dt> <dd>hour as a decimal number using a 12-hour clock (range 01 to 12)</dd>
	 *	<dt>%j</dt> <dd>day of the year as a decimal number (range 001 to 366)</dd>
	 *	<dt>%k</dt> <dd>hour as a decimal number using a 24-hour clock (range 0 to 23); single digits are preceded by a blank. (See also %H.)</dd>
	 *	<dt>%l</dt> <dd>hour as a decimal number using a 12-hour clock (range 1 to 12); single digits are preceded by a blank. (See also %I.) </dd>
	 *	<dt>%m</dt> <dd>month as a decimal number (range 01 to 12)</dd>
	 *	<dt>%M</dt> <dd>minute as a decimal number</dd>
	 *	<dt>%n</dt> <dd>newline character</dd>
	 *	<dt>%p</dt> <dd>either "AM" or "PM" according to the given time value, or the corresponding strings for the current locale</dd>
	 *	<dt>%P</dt> <dd>like %p, but lower case</dd>
	 *	<dt>%r</dt> <dd>time in a.m. and p.m. notation equal to %I:%M:%S %p</dd>
	 *	<dt>%R</dt> <dd>time in 24 hour notation equal to %H:%M</dd>
	 *	<dt>%s</dt> <dd>number of seconds since the Epoch, ie, since 1970-01-01 00:00:00 UTC</dd>
	 *	<dt>%S</dt> <dd>second as a decimal number</dd>
	 *	<dt>%t</dt> <dd>tab character</dd>
	 *	<dt>%T</dt> <dd>current time, equal to %H:%M:%S</dd>
	 *	<dt>%u</dt> <dd>weekday as a decimal number [1,7], with 1 representing Monday</dd>
	 *	<dt>%U</dt> <dd>week number of the current year as a decimal number, starting with the
	 *			first Sunday as the first day of the first week</dd>
	 *	<dt>%V</dt> <dd>The ISO 8601:1988 week number of the current year as a decimal number,
	 *			range 01 to 53, where week 1 is the first week that has at least 4 days
	 *			in the current year, and with Monday as the first day of the week.</dd>
	 *	<dt>%w</dt> <dd>day of the week as a decimal, Sunday being 0</dd>
	 *	<dt>%W</dt> <dd>week number of the current year as a decimal number, starting with the
	 *			first Monday as the first day of the first week</dd>
	 *	<dt>%x</dt> <dd>preferred date representation for the current locale without the time</dd>
	 *	<dt>%X</dt> <dd>preferred time representation for the current locale without the date</dd>
	 *	<dt>%y</dt> <dd>year as a decimal number without a century (range 00 to 99)</dd>
	 *	<dt>%Y</dt> <dd>year as a decimal number including the century</dd>
	 *	<dt>%z</dt> <dd>numerical time zone representation</dd>
	 *	<dt>%Z</dt> <dd>time zone name or abbreviation</dd>
	 *	<dt>%%</dt> <dd>a literal "%" character</dd>
	 *   </dl>
	 *  </dd>
	 * </dl>
	 * @return {HTML} Formatted date for display.
	 */
	format : function (oDate, oConfig) {
		oConfig = oConfig || {};
		if(!jQuery.isDate(oDate)) {
			return jQuery.isValue(oDate) ? oDate : "";
		}
		var format, resources, compatMode, sLocale, LOCALE;
        format = oConfig.format || "%Y-%m-%d";
        resources = Dt.resources; //***
		var replace_aggs = function (m0, m1) {
			if (compatMode && m1 === "r") {
			    return resources[m1];
			}
			var f = Dt.aggregates[m1];
			return (f === "locale" ? resources[m1] : f);
		};
		var replace_formats = function (m0, m1) {
			var f = Dt.formats[m1];
			switch($.type(f)) {
				case "string":					// string => built in date function
					return oDate[f]();
				case "function":				// function => our own function
					return f.call(oDate, oDate, resources);
				case "array":					// built in function with padding
					if($.type(f[0]) === "string") {
						return xPad(oDate[f[0]](), f[1]);
					} // no break; (fall through to default:)
				default:
					return m1;
			}
		};

		// First replace aggregates (run in a loop because an agg may be made up of other aggs)
		while(format.match(/%[cDFhnrRtTxX]/)) {
			format = format.replace(/%([cDFhnrRtTxX])/g, replace_aggs);
		}

		// Now replace formats (do not run in a loop otherwise %%a will be replace with the value of %a)
		var str = format.replace(/%([aAbBCdegGHIjklmMpPsSuUVwWyYzZ%])/g, replace_formats);
		replace_aggs = replace_formats = undefined;
		return str;
	},	

	/**
	 * Checks whether a native JavaScript Date contains a valid value.
	 * @for Date
	 * @method isValidDate
	 * @param oDate {Date} Date in the month for which the number of days is desired.
	 * @return {Boolean} True if the date argument contains a valid value.
	 */
	 isValidDate : function (oDate) {
		if(jQuery.isDate(oDate) && (isFinite(oDate)) && (oDate != "Invalid Date") && !isNaN(oDate) && (oDate != null)) {
            return true;
        }
        else {
            return false;
        }
	},

	/**
	 * Checks whether two dates correspond to the same date and time.
	 * @for Date
	 * @method areEqual
	 * @param aDate {Date} The first date to compare.
	 * @param bDate {Date} The second date to compare.
	 * @return {Boolean} True if the two dates correspond to the same
	 * date and time.
	 */	
	areEqual : function (aDate, bDate) {
		return (this.isValidDate(aDate) && this.isValidDate(bDate) && (aDate.getTime() == bDate.getTime()));	
	},

	/**
	 * Checks whether the first date comes later than the second.
	 * @for Date
	 * @method isGreater
	 * @param aDate {Date} The first date to compare.
	 * @param bDate {Date} The second date to compare.
	 * @return {Boolean} True if the first date is later than the second.
	 */	
    isGreater : function (aDate, bDate) {
    	return (this.isValidDate(aDate) && this.isValidDate(bDate) && (aDate.getTime() > bDate.getTime()));
    },

	/**
	 * Checks whether the first date comes later than or is the same as
	 * the second.
	 * @for Date
	 * @method isGreaterOrEqual
	 * @param aDate {Date} The first date to compare.
	 * @param bDate {Date} The second date to compare.
	 * @return {Boolean} True if the first date is later than or 
	 * the same as the second.
	 */	
    isGreaterOrEqual : function (aDate, bDate) {
    	return (this.isValidDate(aDate) && this.isValidDate(bDate) && (aDate.getTime() >= bDate.getTime()));
    },

    /**
	 * Checks whether the date is between two other given dates.
	 * @for Date
	 * @method isInRange
	 * @param aDate {Date} The date to check
	 * @param bDate {Date} Lower bound of the range.
	 * @param cDate {Date} Higher bound of the range.
	 * @return {Boolean} True if the date is between the two other given dates.
	 */	
    isInRange : function (aDate, bDate, cDate) {
    	return (this.isGreaterOrEqual(aDate, bDate) && this.isGreaterOrEqual(cDate, aDate));
    },

	/**
	 * Adds a specified number of days to the given date.
	 * @for Date
	 * @method addDays
	 * @param oDate {Date} The date to add days to.
	 * @param numDays {Number} The number of days to add (can be negative)
	 * @return {Date} A new Date with the specified number of days
	 * added to the original date.
	 */	
	addDays : function (oDate, numDays) {
		return new Date(oDate.getTime() + 86400000*numDays);
	},

	/**
	 * Adds a specified number of months to the given date.
	 * @for Date
	 * @method addMonths
	 * @param oDate {Date} The date to add months to.
	 * @param numMonths {Number} The number of months to add (can be negative)
	 * @return {Date} A new Date with the specified number of months
	 * added to the original date.
	 */	
	addMonths : function (oDate, numMonths) {
		var newYear = oDate.getFullYear();
		var newMonth = oDate.getMonth() + numMonths;		
		newYear  = Math.floor(newYear + newMonth / 12);
		newMonth = (newMonth % 12 + 12) % 12;
		var newDate = new Date (oDate.getTime());
		newDate.setFullYear(newYear);
		newDate.setMonth(newMonth);
		return newDate;
	},

	/**
	 * Adds a specified number of years to the given date.
	 * @for Date
	 * @method addYears
	 * @param oDate {Date} The date to add years to.
	 * @param numYears {Number} The number of years to add (can be negative)
	 * @return {Date} A new Date with the specified number of years
	 * added to the original date.
	 */	
	addYears : function (oDate, numYears) {
		var newYear = oDate.getFullYear() + numYears;
		var newDate = new Date(oDate.getTime());
		newDate.setFullYear(newYear);
		return newDate;
	},

	/**
	 * Lists all dates in a given month.
	 * @for Date
	 * @method listOfDatesInMonth
	 * @param oDate {Date} The date corresponding to the month for
	 * which a list of dates is required.
	 * @return {Array} An `Array` of `Date`s from a given month.
	 */	
    listOfDatesInMonth : function (oDate) {
       if (!this.isValidDate(oDate)) {
       	 return [];
       }
       var daysInMonth = this.daysInMonth(oDate),
           year        = oDate.getFullYear(),
           month       = oDate.getMonth(),
           output      = [];
       for (var day = 1; day <= daysInMonth; day++) {
       	   output.push(new Date(year, month, day, 12, 0, 0));
       }
       return output;
    },

	/**
	 * Takes a native JavaScript Date and returns the number of days
	 * in the month that the given date belongs to.
	 * @for Date
	 * @method daysInMonth
	 * @param oDate {Date} Date in the month for which the number 
	 * of days is desired.
	 * @return {Number} A number (either 28, 29, 30 or 31) of days 
	 * in the given month.
	 */
	 daysInMonth : function (oDate) {
		if (!this.isValidDate(oDate)) {
			return 0;
		}
		var mon = oDate.getMonth();
		var lengths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		if (mon != 1) {
			return lengths[mon];
		}
		else {
			var year = oDate.getFullYear();
			if (year%400 === 0) {
			       return 29;
			}	
			else if (year%100 === 0) {
				   return 28;
			}
			else if (year%4 === 0) {
			       return 29;
			}
			else {
			       return 28;
		    }
	   } 
	},

	/**
     * Converts data to type Date.
     *
     * @method parse
     * @param data {Date|Number|String} date object, timestamp (string or number), or string parsable by Date.parse
     * @return {Date} a Date object or null if unable to parse
     */
    parse: function(data) {
        var val = new Date(+data || data);
        if (jQuery.isDate(val)) {
            return val;
        } else {
            return null;
        }
    }
};

//
// Number
//

var ewNumber = {

     /**
     * Takes a Number and formats to string for display to user.
     *
     * @method format
     * @param data {Number} Number.
     * @param config {Object} (Optional) Optional configuration values:
     *  <dl>
     *   <dt>prefix {HTML}</dd>
     *   <dd>String prepended before each number, like a currency designator "$"</dd>
     *   <dt>decimalPlaces {Number}</dd>
     *   <dd>Number of decimal places to round. Must be a number 0 to 20.</dd>
     *   <dt>decimalSeparator {HTML}</dd>
     *   <dd>Decimal separator</dd>
     *   <dt>thousandsSeparator {HTML}</dd>
     *   <dd>Thousands separator</dd>
     *   <dt>suffix {HTML}</dd>
     *   <dd>String appended after each number, like " items" (note the space)</dd>
     *  </dl>
     * @return {HTML} Formatted number for display. Note, the following values
     * return as "": null, undefined, NaN, "".
     */
    format: function(data, config) {
        if(jQuery.isNumber(data)) {
            config = config || {};
            var isNeg = (data < 0),
                output = data + "",
                decPlaces = config.decimalPlaces,
                decSep = config.decimalSeparator || ".",
                thouSep = config.thousandsSeparator,
                decIndex,
                newOutput, count, i;

            // Decimal precision
            if(jQuery.isNumber(decPlaces) && (decPlaces >= 0) && (decPlaces <= 20)) {

                // Round to the correct decimal place
                output = data.toFixed(decPlaces);
            }

            // Decimal separator
            if(decSep !== "."){
                output = output.replace(".", decSep);
            }

            // Add the thousands separator
            if(thouSep) {

                // Find the dot or where it would be
                decIndex = output.lastIndexOf(decSep);
                decIndex = (decIndex > -1) ? decIndex : output.length;

                // Start with the dot and everything to the right
                newOutput = output.substring(decIndex);

                // Working left, every third time add a separator, every time add a digit
                for (count = 0, i=decIndex; i>0; i--) {
                    if ((count%3 === 0) && (i !== decIndex) && (!isNeg || (i > 1))) {
                        newOutput = thouSep + newOutput;
                    }
                    newOutput = output.charAt(i-1) + newOutput;
                    count++;
                }
                output = newOutput;
            }

            // Prepend prefix
            output = (config.prefix) ? config.prefix + output : output;

            // Append suffix
            output = (config.suffix) ? output + config.suffix : output;
            return output;
        }

        // Not a Number, just return as string
        else {
            return (jQuery.isValue(data) && data.toString) ? data.toString() : "";
        }
    },

    /**
     * Converts data to type Number.
     *
     * @method parse
     * @param data {String | Number | Boolean} Data to convert. The following
     * values return as null: null, undefined, NaN, "".
     * @return {Number} A number, or null.
     */
    parse: function(data) {
        var number = (data === null || data === "") ? data : +data;
        if(jQuery.isNumber(number)) {
            return number;
        }
        else {
            return null;
        }
    }
}
