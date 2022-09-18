<?php

// [menu name="main"]
add_shortcode('menu', 'print_menu_shortcode');
function print_menu_shortcode($atts, $content = null) {
	extract(shortcode_atts(array( 'name' => null, 
								 'class' => null ), 
						   		$atts ));
	
	return wp_nav_menu( array( 'menu' => $name, 
							  'menu_class' => 'menuclass', 
							  'echo' => false 
						) );
}

add_shortcode( 'nav', 'navigation' );
function navigation() {
		ob_start();
	?>
<nav id="desktop">
    <?php echo do_shortcode('[menu name="main"]'); ?>
</nav>
<nav id="mobile"><button id="toggle-nav-mobile"><i class="fa fa-bars"></i></button>
    <ul class="display-none" id="mobile-ul">
       <?php echo do_shortcode('[menu name="main"]'); ?>
    </ul>
</nav>
	<?php
	$html = ob_get_clean();
	return $html;
}


// A $( document ).ready() block.
jQuery( document ).ready(function() {

	//var inputList = document.querySelectorAll("[id^='patientName']");
    
    //console.log( "ready!" );
	
	
	const hamburgerButton = document.getElementById('toggle-nav-mobile');
	const mobileUl = document.getElementById('mobile-ul');

	const toggleHideUl = function() {
  		mobileUl.classList.toggle("display-none");
	};

	hamburgerButton.addEventListener('click', toggleHideUl);
	
	
});


/**/
#desktop {
  background-color: transparent;
  padding: 1em; 
}
#desktop ul {
    text-align: right;
    list-style: none;
    margin: 0;
    padding: 0; 
}
#desktop li {
    display: inline;
    padding: 2%; 
}
@media (max-width: 35em) {
    #desktop {
      display: none; 
	} 
}
#toggle-nav-mobile {
  display: block;
  max-width: 100%;
  margin: 0 auto;
	background: #FFA500;
}
@media (min-width: 35em) {
    #toggle-nav-mobile {
      display: none; 
	} 
}
.display-none {
  display: none; 
}
#mobile ul {
  text-align: center;
  list-style: none;
  padding: 0; 
}
@media (min-width: 35em) {
  #mobile {
    display: none; 
	} 
}
/**/