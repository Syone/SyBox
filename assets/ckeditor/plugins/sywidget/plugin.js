CKEDITOR.plugins.add('sywidget', {
	requires: 'widget',
	init: function(editor) {
		editor.widgets.add('sywidget', {
			upcast: function(element) {
				if (element.hasClass('sywidget')) {
					element.attributes['data-sywidget-html'] = element.getHtml();
					return true;
				}
				return false;
			},
			downcast: function(element) {
				if (typeof element.attributes['data-sywidget-html'] !== 'undefined') {
					element.setHtml(element.attributes['data-sywidget-html']);
					delete element.attributes['data-sywidget-html'];
					return element;
				}
			},
			mask: true
		});
	}
});