(function() {
	// Go to top button
	$('#top-btn').on('transitionend', function() {
		if ($(this).css('bottom') !== '-100px') return;
		$(this).hide();
	});

	function setScrollTop() {
		var timer;
		$(window).one('scroll.app', function() {
			if (timer) {
				window.clearTimeout(timer);
			}
			timer = window.setTimeout(function() {
				if (($(window).scrollTop() < 1000)) {
					$('#top-btn').css('bottom', '-100px');
				} else {
					$('#top-btn').show();
					$('#top-btn').css('bottom', '10px');
				}
				setScrollTop();
			}, 500);
		});
	}
	setScrollTop();

	$('#top-btn').click(function(e) {
		e.preventDefault();
		window.scroll({top: 0, left: 0, behavior: 'smooth'});
	});

	// Autosize textarea
	$('body').on('focus change', 'textarea', function(){
		if ($(this).hasClass('cke_source')) return;
		autosize(this);
		autosize.update(this);
	});

	// Tooltips
	new bootstrap.Tooltip(document.body, {
		selector: '[data-bs-title]'
	});

	$('body').on('click touchend', 'button[data-bs-title]:not(.copy-url)', function(e) {
		var tooltip = bootstrap.Tooltip.getInstance(this);
		tooltip.dispose();
	});

	// Multi modal
	$('.modal').on('hidden.bs.modal', function() {
		if ($('.modal:visible').length > 0) {
			$('body').addClass('modal-open');
		}
	});

	// Code editor
	$('#code_editor').submit(function() {
		$(this).find('input[name="title"]').val($('#title').text().substring(0, 254));
		$(this).find('input[name="description"]').val($('#description').html());
	});
})();