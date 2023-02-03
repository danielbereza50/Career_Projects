<?php

add_shortcode('do_popup', 'link_popup');
function link_popup(){
	ob_start(); 
?>
<a href="#" 
	  target="popup" 
	  onclick="window.open('#','popup','width=600,height=600'); return false;">
	<div>hello world</div>
</a>
	<?php
	return ob_get_clean();
}








