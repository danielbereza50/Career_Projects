
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link             
 * @since             1.0.0
 * @package           
 *
 * @wordpress-plugin
 * Plugin Name:       
 * Plugin URI:        
 * Description:       
 * Version:           1.0.0
 * Author:            
 * Author URI:       
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       trn
 * Domain Path:       /languages
 */


//namespace test;

//include __DIR__.'/includes/class-web-hook.php';

/**
 * Autoload Classes
 */

//require_once(PLUGIN_NAME_DIR . 'inc/libraries/autoloader.php');

require_once( 'fpdf185/fpdf.php' ); // include the FPDF library

include __DIR__.'/includes/class-print-pdf.php';








