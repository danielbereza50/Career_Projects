</div><!--end of wrapper -->
<div class = "footer">
   <div id="site-info">
      <!--Start of row with (n) columns-->
      <div class="row">
         <div class="column">
       <a href = "/"><img src="/" class = "theLogo" alt = ""></a>
         </div>
         <div class="column" >
            <div class = "services">SERVICES</div>
       <div class = "theHR">
        <hr style="width: 100%;color: #ebebeb;">
        </div>
       <div class = "navHolder2">
               <?php 
                  wp_nav_menu(array( 'theme_location' => 'footer1-menu',
                                     'menu_class'     => 'footer1-menu',     
                              )); 
                  ?>
            </div>
         </div>
         <div class="column">
       <div class = "information">INFORMATION</div>
       <div class = "theHR">
        <hr style="width: 100%;color: #ebebeb;">
        </div>
            <div class = "navHolder3">
               <?php 
                  wp_nav_menu(array( 'theme_location' => 'footer2-menu',
                                     'menu_class'     => 'footer2-menu',     
                              )); 
                  ?>
            </div>
         </div>
     <div class="column">
       <div class = "information">RESOURCES</div>
       <div class = "theHR">
        <hr style="width: 100%;color: #ebebeb;">
        </div>
            <div class = "navHolder3">
               <?php 
                  wp_nav_menu(array( 'theme_location' => 'footer3-menu',
                                     'menu_class'     => 'footer3-menu',     
                              )); 
                  ?>
            </div>
         </div> 
         <div class="column">
            <div class = "contact">CONTACT</div>
       <div class = "theHR">
        <hr style="width: 100%;color: #ebebeb;">
        </div>
     <div class = "footertxt">xxxxxxxxxxxxx <br></div>
            <a href = "https://www.google.com/maps/place/" target="_blank"><div class = "footertxt2">xxxxxxxxxxxxx,</div>
        <div class = "footertxt3">xxxxxxxxxxxxxxxx</div></a><br>
       <div class = "footertxt4"><a href="tel:xxx-xxx-xxx"> Tel: xxx-xxx-xxx</a></div>
       <div class = "footertxt4"><a href="tel:xxx-xxx-xxx"> Fax: xxx-xxx-xxx</a></div>
      <div class = "footertxt5"><a href="mailto:">Email: </a></div>  
         </div>
      </div>
      <!--End of row with columns-->
     <hr style=" width: 70%;color: lightgray; ">
     <div class = "copyright"><?php echo date('Y');?>© All Rights Reserved. xxxxxxxxxxxxxxxxxxxx, all rights reserved. | <a href = "#" target="_blank">xxxxxxxxxxxxxxxxxxxx</a></div>
   </div>
   <!-- #site-info -->
</div> 
</div>    
<?php wp_footer(); ?>
</body>
</html>

