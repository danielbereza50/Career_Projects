<?php
/*
    Plugin Name: 
    Plugin URI:  
    Description: Added website functionality. 
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

// https://developer.wordpress.org/resource/dashicons/

add_shortcode('compare', 'image_comparison');

function image_comparison() {
     ob_start(); 
     ?>
    		<figure class="cd-image-container">
    		<img src="/wp-content/uploads/2022/02/sunroom-complete-1.jpg" alt="Original Image">
    		<span class="cd-image-label" data-type="original">After</span>
    
    		<div class="cd-resize-img"> <!-- the resizable image on top -->
    			<img src="/wp-content/uploads/2022/02/sunroom-during.jpg" alt="Modified Image">
    			<span class="cd-image-label" data-type="modified">Before</span>
    		</div>
    
    		<span class="cd-handle"></span>
    </figure>
    	<?php
    	$html = ob_get_clean();
    	return $html;
    }
?>
<script>
	jQuery(document).ready(function($){
	//var inputList = document.querySelectorAll("[id^='patientName']");
    
    console.log( "ready!" );
	
	
    var dragging = false,
        scrolling = false,
        resizing = false;
    //cache jQuery objects
    var imageComparisonContainers = $('.cd-image-container');
    //check if the .cd-image-container is in the viewport 
    //if yes, animate it
    checkPosition(imageComparisonContainers);
    $(window).on('scroll', function(){
        if( !scrolling) {
            scrolling =  true;
            ( !window.requestAnimationFrame )
                ? setTimeout(function(){checkPosition(imageComparisonContainers);}, 100)
                : requestAnimationFrame(function(){checkPosition(imageComparisonContainers);});
        }
    });
    
    //make the .cd-handle element draggable and modify .cd-resize-img width according to its position
    imageComparisonContainers.each(function(){
        var actual = $(this);
        drags(actual.find('.cd-handle'), actual.find('.cd-resize-img'), actual, actual.find('.cd-image-label[data-type="original"]'), actual.find('.cd-image-label[data-type="modified"]'));
    });

    //upadate images label visibility
    $(window).on('resize', function(){
        if( !resizing) {
            resizing =  true;
            ( !window.requestAnimationFrame )
                ? setTimeout(function(){checkLabel(imageComparisonContainers);}, 100)
                : requestAnimationFrame(function(){checkLabel(imageComparisonContainers);});
        }
    });

    function checkPosition(container) {
        container.each(function(){
            var actualContainer = $(this);
            if( $(window).scrollTop() + $(window).height()*0.5 > actualContainer.offset().top) {
                actualContainer.addClass('is-visible');
            }
        });

        scrolling = false;
    }

    function checkLabel(container) {
        container.each(function(){
            var actual = $(this);
            updateLabel(actual.find('.cd-image-label[data-type="modified"]'), actual.find('.cd-resize-img'), 'left');
            updateLabel(actual.find('.cd-image-label[data-type="original"]'), actual.find('.cd-resize-img'), 'right');
        });

        resizing = false;
    }

    //draggable funtionality - credits to http://css-tricks.com/snippets/jquery/draggable-without-jquery-ui/
    function drags(dragElement, resizeElement, container, labelContainer, labelResizeElement) {
        dragElement.on("mousedown vmousedown", function(e) {
            dragElement.addClass('draggable');
            resizeElement.addClass('resizable');

            var dragWidth = dragElement.outerWidth(),
                xPosition = dragElement.offset().left + dragWidth - e.pageX,
                containerOffset = container.offset().left,
                containerWidth = container.outerWidth(),
                minLeft = containerOffset + 10,
                maxLeft = containerOffset + containerWidth - dragWidth - 10;
            
            dragElement.parents().on("mousemove vmousemove", function(e) {
                if( !dragging) {
                    dragging =  true;
                    ( !window.requestAnimationFrame )
                        ? setTimeout(function(){animateDraggedHandle(e, xPosition, dragWidth, minLeft, maxLeft, containerOffset, containerWidth, resizeElement, labelContainer, labelResizeElement);}, 100)
                        : requestAnimationFrame(function(){animateDraggedHandle(e, xPosition, dragWidth, minLeft, maxLeft, containerOffset, containerWidth, resizeElement, labelContainer, labelResizeElement);});
                }
            }).on("mouseup vmouseup", function(e){
                dragElement.removeClass('draggable');
                resizeElement.removeClass('resizable');
            });
            e.preventDefault();
        }).on("mouseup vmouseup", function(e) {
            dragElement.removeClass('draggable');
            resizeElement.removeClass('resizable');
        });
    }

    function animateDraggedHandle(e, xPosition, dragWidth, minLeft, maxLeft, containerOffset, containerWidth, resizeElement, labelContainer, labelResizeElement) {
        var leftValue = e.pageX + xPosition - dragWidth;   
        //constrain the draggable element to move inside his container
        if(leftValue < minLeft ) {
            leftValue = minLeft;
        } else if ( leftValue > maxLeft) {
            leftValue = maxLeft;
        }

        var widthValue = (leftValue + dragWidth/2 - containerOffset)*100/containerWidth+'%';
        
        $('.draggable').css('left', widthValue).on("mouseup vmouseup", function() {
            $(this).removeClass('draggable');
            resizeElement.removeClass('resizable');
        });

        $('.resizable').css('width', widthValue); 

        updateLabel(labelResizeElement, resizeElement, 'left');
        updateLabel(labelContainer, resizeElement, 'right');
        dragging =  false;
    }

    function updateLabel(label, resizeElement, position) {
        if(position == 'left') {
            ( label.offset().left + label.outerWidth() < resizeElement.offset().left + resizeElement.outerWidth() ) ? label.removeClass('is-hidden') : label.addClass('is-hidden') ;
        } else {
            ( label.offset().left > resizeElement.offset().left + resizeElement.outerWidth() ) ? label.removeClass('is-hidden') : label.addClass('is-hidden') ;
        }
    }
});
</script>

<style>
@media only screen and (min-width: 768px) {
  header {
    height: 6em;
    line-height: 1.6;
  }
  header h1 {
    font-size: 32px;
    font-size: 2rem;
  }
}
.cd-image-container {
  position: relative;
  width: 90%;
  max-width: 768px;
  margin: 0em auto;
	border: solid #6E1C40 5px;
}
.cd-image-container img {
  display: block;
}

.cd-image-label {
  position: absolute;
  font-weight: 500;
  letter-spacing: 1px;
  top: 0;
  right: 0;
  color: #ffffff;
  padding: 1em;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  opacity: 0;
  -webkit-transform: translateY(20px);
  -moz-transform: translateY(20px);
  -ms-transform: translateY(20px);
  -o-transform: translateY(20px);
  transform: translateY(20px);
  -webkit-transition: -webkit-transform 0.3s 0.7s, opacity 0.3s 0.7s;
  -moz-transition: -moz-transform 0.3s 0.7s, opacity 0.3s 0.7s;
  transition: transform 0.3s 0.7s, opacity 0.3s 0.7s;
}
.cd-image-label.is-hidden {
  visibility: hidden;
}
.is-visible .cd-image-label {
  opacity: 1;
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -ms-transform: translateY(0);
  -o-transform: translateY(0);
  transform: translateY(0);
}
.cd-resize-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
  overflow: hidden;
  /* Force Hardware Acceleration in WebKit */
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -ms-transform: translateZ(0);
  -o-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.cd-resize-img img {
  position: absolute;
  left: 0;
  top: 0;
  display: block;
  height: 100%;
  width: auto;
  max-width: none;
}
.cd-resize-img .cd-image-label {
  right: auto;
  left: 0;
	color:black;
}
.is-visible .cd-resize-img {
  width: 50%;
  /* bounce in animation of the modified image */
  -webkit-animation: cd-bounce-in 0.7s;
  -moz-animation: cd-bounce-in 0.7s;
  animation: cd-bounce-in 0.7s;
}
@-webkit-keyframes cd-bounce-in {
  0% {
    width: 0;
  }
  60% {
    width: 55%;
  }
  100% {
    width: 50%;
  }
}
@-moz-keyframes cd-bounce-in {
  0% {
    width: 0;
  }
  60% {
    width: 55%;
  }
  100% {
    width: 50%;
  }
}
@keyframes cd-bounce-in {
  0% {
    width: 0;
  }
  60% {
    width: 55%;
  }
  100% {
    width: 50%;
  }
}
.cd-handle {
  position: absolute;
  height: 44px;
  width: 44px;
  /* center the element */
  left: 50%;
  top: 50%;
  margin-left: -22px;
  margin-top: -22px;
  border-radius: 50%;
  background: #5E5C52 url("https://images.clickfunnels.com/09/a714400d3211e7a0bd7d7140585054/cd-arrows.svg") no-repeat center center;
  cursor: move;
  box-shadow: 0 0 0 6px rgba(0, 0, 0, 0.2), 0 0 10px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.3);
  opacity: 0;
  -webkit-transform: translate3d(0, 0, 0) scale(0);
  -moz-transform: translate3d(0, 0, 0) scale(0);
  -ms-transform: translate3d(0, 0, 0) scale(0);
  -o-transform: translate3d(0, 0, 0) scale(0);
  transform: translate3d(0, 0, 0) scale(0);
}
.cd-handle.draggable {
  /* change background color when element is active */
  background-color: #72123D;
}
.is-visible .cd-handle {
  opacity: 1;
  -webkit-transform: translate3d(0, 0, 0) scale(1);
  -moz-transform: translate3d(0, 0, 0) scale(1);
  -ms-transform: translate3d(0, 0, 0) scale(1);
  -o-transform: translate3d(0, 0, 0) scale(1);
  transform: translate3d(0, 0, 0) scale(1);
  -webkit-transition: -webkit-transform 0.3s 0.7s, opacity 0s 0.7s;
  -moz-transition: -moz-transform 0.3s 0.7s, opacity 0s 0.7s;
  transition: transform 0.3s 0.7s, opacity 0s 0.7s;
}

</style>

