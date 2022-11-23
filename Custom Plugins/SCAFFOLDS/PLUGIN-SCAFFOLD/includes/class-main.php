<?php 

// Class Name
class class1
{
    // Properties
    //var $loop_count = 0;

    // Methods
    public function __construct($loop_count)
    {
      $this->loop_count = $loop_count;
      $this->init();
    }
    
    public function init()
    {
        add_shortcode('algo', array($this, 'output_buffer'));     
    }

    public function output_buffer(){
        ob_start();
    
        require_once(__DIR__.'/../view/info.html.php');

        return ob_get_clean();
    }
}
//$my_plugin = new class1('30px','red','Object Oriented Programming');

// extends, implements, abstract
class class2 extends class1{

    public function __construct()
    {
       parent::__construct();
    }
    public function output_buffer()
    {
       parent::output_buffer();
    }
}