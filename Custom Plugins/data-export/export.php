<?php 

class CSVExport
{

	/**
	* Constructor
*/
	public function __construct()
	{
		if(isset($_GET['download_report']))
		{
			$csv = $this->generate_csv();

			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private", false);
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"orders.csv\";" );
			header("Content-Transfer-Encoding: binary");

			echo $csv;
			exit;
		}

		add_action('admin_menu', array($this, 'admin_menu'));
		add_filter('query_vars', array($this, 'query_vars'));
		add_action('parse_request', array($this, 'parse_request'));
	}

	/**
	* Add extra menu items for admins
	*/
	public function admin_menu()
	{
		add_menu_page('Download Report', 'Download Orders', 'manage_options', 'download_report', array($this, 'download_report'),"dashicons-welcome-view-site");
	}

	/**
	* Allow for custom query variables
*/
	public function query_vars($query_vars)
	{
		$query_vars[] = 'download_report';
		return $query_vars;
	}

	/**
	* Parse the request
*/
	public function parse_request(&$wp)
	{
		if(array_key_exists('download_report', $wp->query_vars))
		{
			$this->download_report();
			exit;
		}
	}

	/**
	* Download report
*/
	public function download_report()
	{
		echo '<div class="wrap">';
		echo '<div id="icon-tools" class="icon32">
	</div>';
	echo '<a href='.site_url().'/wp-admin/admin.php?download_report'.'  <h2>Download Orders</h2>';

}

/**
* Converting data to CSV
*/
public function generate_csv()
{
	global $wpdb;
	$csv_output = '';
	$query = "SELECT * FROM wp32_posts WHERE post_type LIKE 'shop_subscription'";
	$result = $wpdb->get_results($query);


	$i = 0;
	if (count($result) > 0) {
		foreach ($result as $key => $value) {
			
			$csv_output = $csv_output . $value->Field. "";
			
		//$csv_output .= "\n";
		//print_r($csv_output);
	}

	$query = "SELECT * FROM wp32_posts WHERE post_type LIKE 'shop_subscription'";
	$values = $wpdb->get_results($query);

	if (count($values)>0) {
		foreach ($values as $key => $value) {
			foreach ($value as $k => $v) {
			
				$csv_output .= $v.",";
				
			}
			$csv_output .= "\n";
		}
	}

}

return $csv_output;

}
}

$csvExport = new CSVExport();

class CSVImport
{


// import 
// https://stackoverflow.com/questions/37178702/import-orders-from-excel-file-in-woocommerce
// $query = "INSERT INTO 'wp32_posts' ('umeta_id', 'user_id', 'meta_key', 'meta_value') 
// VALUES (NULL, '4', 'wp_user_level', '10')";

}


$CSVImport = new CSVImport();


/*

To delete orders: 


DELETE FROM wp5s_woocommerce_order_itemmeta;
DELETE FROM wp5s_woocommerce_order_items;
DELETE FROM wp5s_comments WHERE comment_type = 'order_note';
DELETE FROM wp5s_postmeta WHERE post_id IN ( SELECT ID FROM wp5s_posts WHERE post_type = 'shop_order' );
DELETE FROM wp5s_posts WHERE post_type = 'shop_order';


To delete subscriptions:

DELETE FROM wp5s_woocommerce_order_itemmeta;
DELETE FROM wp5s_woocommerce_order_items;
DELETE FROM wp5s_comments WHERE comment_type = 'order_note';
DELETE FROM wp5s_postmeta WHERE post_id IN ( SELECT ID FROM wp5s_posts WHERE post_type = 'shop_subscription' );
DELETE FROM wp5s_posts WHERE post_type = 'shop_subscription';



*/




