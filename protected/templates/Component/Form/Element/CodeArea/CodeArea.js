var editor = ace.edit("{CODE_AREA_ID}");
editor.setTheme("ace/theme/tomorrow_night");
editor.session.setMode("ace/mode/php");
editor.session.setUseSoftTabs(false);
editor.setShowPrintMargin(false);
editor.session.setValue($('#{TEXT_AREA_ID}').val());
editor.session.on('change', function() {
	$('#{TEXT_AREA_ID}').val(editor.getValue());
});
editor.setOption('enableLiveAutocompletion', true);
editor.commands.addCommand({
	name: 'Run',
	bindKey: {win: 'Ctrl-S',  mac: 'Command-S'},
	exec: function() {
		$('#{TEXT_AREA_ID}').closest('form').submit();
	}
});
editor.commands.addCommand({
	name: 'Save and Share',
	bindKey: {win: 'Ctrl-Shift-S',  mac: 'Command-Shift-S'},
	exec: function() {
		$('#btn-save').click();
	}
});