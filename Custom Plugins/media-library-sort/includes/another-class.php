<?php 

class test
{

    public function __constructor(){
     //$this->init();
    }
    
    public function init()
    {
        
    add_shortcode('test', array($this, 'do_something'));

    }// end of init
 
    public static function do_something(){
     
    ob_start();

    


    return ob_get_clean();
    }

}// end of class

$my_plugin = new test();
$my_plugin->init();





