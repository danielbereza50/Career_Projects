<?php 

// Class Name
class class1
{
    // Properties
    private $var1;
    private $var2;
    private $var3;

    // Methods
    public function __construct($var1,$var2,$var3)
    {
      $this->var1 = $var1;
      $this->var2 = $var2;
      $this->var3 = $var3;
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