add_action('wp_head', 'loading_animation');
function loading_animation(){ ?>
	
<?php	
if (!is_user_logged_in() ) { ?>
  <div class="smart-glass">
  <div class="logo">
    <div class="circle">
      <div class="circle">
          <div class="circle">
          </div>
      </div>
  </div>
    <div class="centered-logo">
		<img src = "/wp-content/uploads/2022/08/logo.png" width = "350" height = "350">
	  </div>
  </div>
  <div class="loading-text">
    Loading...
  </div>
</div>
<?php } 
}



setInterval(function(){ 
    
    jQuery('.smart-glass').fadeOut(); 
    jQuery('body').css('background', 'transparent');
    
   }, 500);




body {
  background-color: #72c3e0;
}
.smart-glass {
  background-color: #72c3e0;
  position: absolute;
  z-index:9999999999999;
  margin: auto;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
}
.logo {
  width: 288px;
  height: 288px;
  position: relative;
  margin-left: auto;
  margin-right: auto;
  margin-top: 10%;
}
.circle {
  padding: 20px;
  border: 6px solid transparent;
  border-top-color: black;
  border-radius: 50%;
  width: 100%;
  height: 100%;
  animation: connect 2.5s linear infinite;
}
.centered-logo {
  background: #FFF;
  width: 280px;
  height: 280px;
  border-radius: 100%;
  overflow: hidden;
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  margin: auto;
}
.loading-text {
  text-transform: uppercase;
  color: #FFF;
  text-align: center;
  margin: 10px 0;
  font-size: 1.4rem;
}
@keyframes connect {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}