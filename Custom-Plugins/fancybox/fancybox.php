  
<a href="#" data-fancybox="group" data-caption="">
  <p>Click here</p>
</a>

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	// Fancybox Stylesheet
		wp_enqueue_style( 'fancybox-style', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );

		/// Fancybox Script
		wp_enqueue_script( 'fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '3.5.7', true );
	
}

	jQuery('[data-fancybox]').fancybox({
	  // Options will go here
	  buttons : [
		'close'
	  ],
	  wheel : false,
	  transitionEffect: "slide",
	   // thumbs          : false,
	  // hash            : false,
	  loop            : true,
	  // keyboard        : true,
	  toolbar         : false,
	  // animationEffect : false,
	  // arrows          : true,
	  clickContent    : false
	});