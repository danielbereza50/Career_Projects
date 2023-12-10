<?php

class Controllers {

	
	
    public function __construct() {
	   
        add_action('template_redirect', array($this, 'do_calculator'));
	    add_action('template_redirect', array($this, 'do_incidents'));
	   
    }
	public function do_calculator() {
        $url = esc_url_raw(home_url(add_query_arg(array(), parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))));
        $path = trim(parse_url($url, PHP_URL_PATH), '/');
        if ($path == "calculator") {
			
            // Instantiate the CalculatorForm class
            $calculator_form_instance = new CalculatorForm();
            
            // Call the get_calculator_form method
            $calculator_form_instance->get_calculator_form();
			
            exit();
        }
    }
	public function do_incidents() {
        $url = esc_url_raw(home_url(add_query_arg(array(), parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))));
        $path = trim(parse_url($url, PHP_URL_PATH), '/');
        if ($path == "haz-mat-incident") {
		
            $Incidents = new Incidents();
            $Incidents->get_incident_table();
			
            exit();
        }
    }
	
	
	
	
	
	
	
	
}
// Instantiate the class
$Controllers = new Controllers();