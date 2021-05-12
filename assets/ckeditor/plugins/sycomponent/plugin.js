CKEDITOR.plugins.add('sycomponent', {
	requires: 'widget',
	init: function(editor) {
		editor.widgets.add('sycomponent', {
			upcast: function(element) {
				return (typeof element.attributes['data-component'] !== 'undefined' && element.attributes['data-component'].length > 0) || (typeof element.attributes['data-var'] !== 'undefined' && element.attributes['data-var'].length > 0);
			},
			downcast: function(element) {
				if (typeof element.attributes['data-component'] !== 'undefined' && element.attributes['data-component'].length > 0) {
					element.setHtml('{' + element.attributes['data-component'] + '}');
					return element;
				}
				if (typeof element.attributes['data-var'] !== 'undefined' && element.attributes['data-var'].length > 0) {
					element.setHtml('{"' + element.attributes['data-var'] + '"}');
					return element;
				}
			},
			mask: true
		});
	}
});