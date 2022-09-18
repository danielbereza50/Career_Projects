<?php 

class test
{
    public function __constructor(){
     // construct stuff here
    }
    
    public function init()
    {
        add_shortcode('test', array($this, 'do_something'));     
    }// end of init
 
    public function do_something(){
    ob_start();



    return ob_get_clean();
}// end of do_something

}// end of class

$my_plugin = new test();
$my_plugin -> init();





