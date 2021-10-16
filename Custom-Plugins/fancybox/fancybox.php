<?php

add_shortcode('document1','lightbox1');
add_shortcode('document2','lightbox2');
add_shortcode('document3','lightbox3');
add_shortcode('document4','lightbox4');
add_shortcode('document5','lightbox5');

add_shortcode('video1','lightbox6');
add_shortcode('video2','lightbox7');
add_shortcode('video3','lightbox8');


function lightbox1(){
   ob_start();
	
$value34 = get_field('solution_ref_doc_1');
		
if($value34)
{
			?>
<a class="iframe" rel="group" href="<?php the_field('solution_ref_doc_1'); ?>"><?php echo the_field('solution_ref_doc_1')?></a>
<?php
}
	$html = ob_get_clean();
	return $html;
}

function lightbox2(){
   ob_start();
	
$value35 = get_field('solution_ref_doc_2');
		
if($value35)
{
			?>
<a class="iframe" rel="group" href="<?php the_field('solution_ref_doc_2'); ?>"><?php echo the_field('solution_ref_doc_2')?></a>
<?php
}
	$html = ob_get_clean();
	return $html;
}


function lightbox3(){
   ob_start();
	
$value36 = get_field('solution_ref_doc_3');
		
if($value36)
{
			?>
<a class="iframe" rel="group" href="<?php the_field('solution_ref_doc_3'); ?>"><?php echo the_field('solution_ref_doc_3')?></a>
<?php
}
	$html = ob_get_clean();
	return $html;
}


function lightbox4(){
   ob_start();
	
$value37 = get_field('solution_ref_doc_4');
		
if($value37)
{
			?>
<a class="iframe" rel="group" href="<?php the_field('solution_ref_doc_4'); ?>"><?php echo the_field('solution_ref_doc_4')?></a>
<?php
}
	$html = ob_get_clean();
	return $html;
}


function lightbox5(){
   ob_start();
	
$value38 = get_field('solution_ref_doc_5');
		
if($value38)
{
			?>
<a class="iframe" rel="group" href="<?php the_field('solution_ref_doc_5'); ?>"><?php echo the_field('solution_ref_doc_5')?></a>
<?php
}
	$html = ob_get_clean();
	return $html;
}


function lightbox6(){
   ob_start();
	
$value39 = get_field('video_1');
		
if($value39)
{
			?>
<a class="iframe" rel="group" href="<?php the_field('video_1'); ?>"><?php echo the_field('video_1')?></a>
<?php
}
	$html = ob_get_clean();
	return $html;
}

function lightbox7(){
   ob_start();
	
$value40 = get_field('video_2');
		
if($value40)
{
			?>
<a class="iframe" rel="group" href="<?php the_field('video_2'); ?>"><?php echo the_field('video_2')?></a>
<?php
}
	$html = ob_get_clean();
	return $html;
}


function lightbox8(){
   ob_start();
	
$value41 = get_field('video_3');
		
if($value41)
{
			?>
<a class="iframe" rel="group" href="<?php the_field('video_3'); ?>"><?php echo the_field('video_3')?></a>
<?php
}
	$html = ob_get_clean();
	return $html;
}


<script>

// A $( document ).ready() block.
jQuery( document ).ready(function() {

//var inputList = document.querySelectorAll("[id^='patientName']");
    
console.log( "ready!" );
	
jQuery("a.iframe").fancybox({
'width': 640, 
'height': 480,
'type': 'iframe'
});




});
</script>

