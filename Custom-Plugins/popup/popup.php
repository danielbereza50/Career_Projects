<?php
// [schedule-an-appointment]
add_shortcode('schedule-an-appointment', 'do_popup');
function do_popup(){
	ob_start();
// for other element's css on the page, such as rows or columns
// position: relative;
// z-index: 1;
?>
<!-- Trigger/Open The Modal -->
<button id="myBtn">Submit a Booking</button>
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <?php echo do_shortcode('[booking type=1 nummonths=3 form_type=standard]'); ?>
  </div>
</div>
	<?php
	$html = ob_get_clean();
	return $html;
} 




<script>

// A $( document ).ready() block.
jQuery( document ).ready(function() {

//var inputList = document.querySelectorAll("[id^='patientName']");
    
console.log( "ready!" );
	
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

console.log(modal);
console.log(btn);
console.log(span);
	
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}




});

</script>