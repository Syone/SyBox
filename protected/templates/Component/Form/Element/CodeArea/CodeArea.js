var CodeMirror_{CODE_AREA_ID} = (function() {
	return CodeMirror.fromTextArea(document.getElementById("{CODE_AREA_ID}"), {
		mode: "application/x-httpd-php",
		lineNumbers: true,
		indentUnit: 4,
		indentWithTabs: true,
		enterMode: "keep",
		tabMode: "shift",
		theme: "eclipse",
		matchBrackets: true,
		autoCloseBrackets: true,
		extraKeys: {
			"Shift-Ctrl-C": "toggleComment",
			"Ctrl-R": function() {$('#btn-run').click()},
			"Ctrl-S": function() {$('#btn-save').click()}
		}
	});
})();

