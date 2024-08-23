<?php
/*
 

 [get_contractor_calculator type = 'roi']
 [get_contractor_calculator type = 'cost-comparison']
 
 
 
 
 
*/

class calculators {

    public function __construct() {
        $this->init();
    }
    
    public function init() {
        add_shortcode('get_contractor_calculator', array($this, 'display_calculator'));
    }

    public function display_calculator($atts): string {
        // Extract the attributes
        $atts = shortcode_atts(array(
            'type' => 'default', // default type
        ), $atts);

        $type = $atts['type'];
		
		
		
		
		
		
        $html = '';

        // Determine which display file to include based on the type
        switch ($type) {
            case 'roi':
				
                $template = 'roi_calculator.html.php'; // Adjust the path as needed
                break;
            case 'cost-comparison':
				
                $template = 'cost_comparison_calculator.html.php'; // Adjust the path as needed
                break;
            default:
                $template = 'default_calculator.html.php'; // Optional default file
                break;
        }

		
        // Include the appropriate calculator file
        if (file_exists(__DIR__ . '/../views/' . $template)) {
            ob_start(); // Start output buffering
            include __DIR__ . '/../views/' . $template;
            $html .= ob_get_clean(); // Get the buffered output and clear the buffer
        } else {
            $html .= '<p>Calculator type not found.</p>'; // Error message if file doesn't exist
        }

		
		
		//echo plugin_dir_path(__FILE__);
		
		
		
        return $html;
    }
}
new calculators();