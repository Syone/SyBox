CKEDITOR.addTemplates('websyte', {
	imagesPath: '/assets/ckeditor/',
	templates: [
		{
			title: 'Jumbotron',
			image: 'jumbotron.gif',
			description: 'Build around the jumbotron with some basic grid columns.',
			html: '<div class="container pt-1">'+
			'<div class="jumbotron">'+
				'<h1>Hello, world!</h1>'+
				'<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>'+
				'<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>'+
			'</div>'+
			'<div class="row">'+
				'<div class="col-md-4">'+
					'<h2>Heading</h2>'+
					'<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>'+
					'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
				'</div>'+
				'<div class="col-md-4">'+
					'<h2>Heading</h2>'+
					'<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>'+
					'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
				'</div>'+
				'<div class="col-md-4">'+
					'<h2>Heading</h2>'+
					'<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>'+
					'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
				'</div>'+
			'</div>'+
			'</div>'
		},
		{
			title: 'Full Jumbotron',
			image: 'full-jumbotron.gif',
			description: 'Build around the full width jumbotron with some basic grid columns.',
			html: '<div class="jumbotron">'+
				'<div class="container">'+
					'<h1>Hello, world!</h1>'+
					'<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>'+
					'<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>'+
				'</div>'+
			'</div>'+
			'<div class="container">'+
				'<div class="row">'+
					'<div class="col-md-4">'+
						'<h2>Heading</h2>'+
						'<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>'+
						'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
					'</div>'+
					'<div class="col-md-4">'+
						'<h2>Heading</h2>'+
						'<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>'+
						'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
					'</div>'+
					'<div class="col-md-4">'+
						'<h2>Heading</h2>'+
						'<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>'+
						'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
					'</div>'+
				'</div>'+
			'</div>'
		},
		{
			title: 'Carousel',
			image: 'carousel.gif',
			description: 'Customize the carousel, then add some new components.',
			html: '<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom:50px">'+
				'<ol class="carousel-indicators">'+
					'<li data-target="#myCarousel" data-slide-to="0" class="active"></li>'+
					'<li data-target="#myCarousel" data-slide-to="1"></li>'+
					'<li data-target="#myCarousel" data-slide-to="2"></li>'+
				'</ol>'+
				'<div class="carousel-inner" role="listbox">'+
					'<div class="item active">'+
						'<img src="http://lorempixel.com/1920/480/nature/1" alt="First slide">'+
						'<div class="container">'+
							'<div class="carousel-caption">'+
								'<h1>Example headline.</h1>'+
								'<p>Note: If you\'re viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>'+
								'<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="item">'+
						'<img src="http://lorempixel.com/1920/480/nature/2" alt="Second slide">'+
						'<div class="container">'+
							'<div class="carousel-caption">'+
								'<h1>Another example headline.</h1>'+
								'<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>'+
								'<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="item">'+
						'<img src="http://lorempixel.com/1920/480/nature/3" alt="Third slide">'+
						'<div class="container">'+
							'<div class="carousel-caption">'+
								'<h1>One more for good measure.</h1>'+
								'<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>'+
								'<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">'+
					'<span class="glyphicon glyphicon-chevron-left" aria-hidden="true">&nbsp;</span>'+
					'<span class="sr-only">Previous</span>'+
				'</a>'+
				'<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">'+
					'<span class="glyphicon glyphicon-chevron-right" aria-hidden="true">&nbsp;</span>'+
					'<span class="sr-only">Next</span>'+
				'</a>'+
			'</div>'+
			'<div class="container">'+
				'<div class="row text-center">'+
					'<div class="col-lg-4">'+
						'<img class="rounded-circle" src="http://lorempixel.com/140/140/nature/4" alt="Generic placeholder image" style="width: 140px; height: 140px;">'+
						'<h2>Heading</h2>'+
						'<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>'+
						'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
					'</div>'+
						'<div class="col-lg-4">'+
						'<img class="rounded-circle" src="http://lorempixel.com/140/140/nature/5" alt="Generic placeholder image" style="width: 140px; height: 140px;">'+
						'<h2>Heading</h2>'+
						'<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>'+
						'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
					'</div>'+
					'<div class="col-lg-4">'+
						'<img class="rounded-circle" src="http://lorempixel.com/140/140/nature/6" alt="Generic placeholder image" style="width: 140px; height: 140px;">'+
						'<h2>Heading</h2>'+
						'<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>'+
						'<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>'+
					'</div>'+
				'</div>'+
			'</div>'
		}
	]
});
