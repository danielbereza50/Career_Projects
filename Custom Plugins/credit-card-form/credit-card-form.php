Credit Card String Patterns:

	
	// http://www.thunderdata.com/category/using-phps-preg_match-to-parse-credit-card-data-from-magnetic-swipe-readers/
	$swipe_pattern = '/^(%B)([0-9]{16})\^([a-zA-Z-s]*)\/([a-zA-Z-s]*)\s\^([0-9]{2})([0-9]{2})(.)*?$/';
	// %B4444666734442743^JOHN/DOE ^2604444902003330000000131000000?;4400666733322743=26042033320033900100?
	
	<?php
	
	if(isset($_POST['submit'])){
		preg_match($swipe_pattern, $_POST['card_value'],  $match);
		//if(preg_match($swipe_pattern, $_POST['card_value'],  $match)){
			/*
		    echo "Card: ", $match[2]; // 0 is the entire string
			echo '<br>';
			echo "First Name: ", $match[4]; 
			echo '<br>';
			echo "Last Name: ", $match[3]; 
			echo '<br>';
			echo "Expiration: ", $match[6]."".$match[5]; 
			*/
	    //}
	}
	?>
	<form method="post" action="">
		<span style='required'>*</span> - Indicates required field.
	<div class='fields'>Card Number</div>
		<div>
		  <input type=text name='card_value' value = "" onkeydown="return noenter(event)">
		  <span style='required'>*</span>
		</div>
	<div class='fields'>Entered Card Number </div>
		<div>
			<input type=text name='previous_card_value' value = "<?php echo $match[2] ?>" disabled>
		</div>
	<div class='fields'>First Name</div>
		<div>
		 <input type=text name='first_name' value = "<?php echo $match[3] ?>" disabled>
	</div>	
	<div class='fields'>Last Name</div>
		<div>
			<input type=text name='last_name' value = "<?php echo $match[4] ?>" disabled>
		</div>
	<div class='fields'>Expiration</div>
		<div>
			<input type=text name='expiration' value = "<?php echo $match[6]."/".$match[5] ?>" disabled>
		</div>
	<div>	
		<input type="submit" value="Extract" name = "submit">
	</div>
	</form>
	<script>
	
	function noenter(e) {
		var key;      
		if(window.event)
			key = window.event.keyCode; //IE
		else
			key = e.which; //firefox      

			return (key != 13);
		}
	</script>
	<?php