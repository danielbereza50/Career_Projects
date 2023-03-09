<?php
add_action('wp_head', 'smooth_scroll');
function smooth_scroll() { 
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
	jQuery(document).ready(function(){
// Select all links with hashes
jQuery('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
    // On-page links
  .not('[href="#0"]')
  .click(function(event) {
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = jQuery(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        jQuery('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = jQuery(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
	
// stick header
		
$(window).scroll(function(){
	  var sticky = $('.site-header');
	  var logo = $('.custom-logo');
		//console.log(logo);
		  scroll = $(window).scrollTop();
	  if (scroll >= 100){
		  sticky.addClass('fixed');
		  logo.addClass('small-width');
	  }else{ 
		  sticky.removeClass('fixed');
		  logo.removeClass('small-width');
	}}
);
		
		
});	
</script>

<?php
}

add_shortcode( 'top', 'back_to_top' );
function back_to_top()
    {
	 {
			ob_start();
		?>

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  window.scrollTo({
	               top: 0, 
				   behavior: 'smooth'}
 );
}
</script>

<style>
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: #D1CE6D;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
.fixed {
  position: fixed;
  top:0; 
	left:0;
  width: 100%; 
}
.small-width{
	max-width: 100px !important;
}	
</style>
	
<?php
		return ob_get_clean();
    }
	}
















