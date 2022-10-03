<?php 

class CSVExport
{
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
	$query = "SELECT p.ID as order_id,
    p.post_date, 
    oi.order_item_name,

    max( CASE WHEN pm.meta_key = '_billing_email' and p.ID = pm.post_id THEN pm.meta_value END ) as billing_email,
    max( CASE WHEN pm.meta_key = '_billing_first_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_first_name,
    max( CASE WHEN pm.meta_key = '_billing_last_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_last_name,
    max( CASE WHEN pm.meta_key = '_billing_address_1' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_address_1,
    max( CASE WHEN pm.meta_key = '_billing_address_2' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_address_2,
    max( CASE WHEN pm.meta_key = '_billing_city' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_city,
    max( CASE WHEN pm.meta_key = '_billing_state' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_state,
    max( CASE WHEN pm.meta_key = '_billing_postcode' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_postcode,
    
    max( CASE WHEN pm.meta_key = '_order_total' and p.ID = pm.post_id THEN pm.meta_value END ) as order_total,
    
    max( CASE WHEN ot.meta_key = 'Enter student/staff first name' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as First,
    max( CASE WHEN ot.meta_key = 'Enter student/staff last name' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as Last,
    max( CASE WHEN ot.meta_key = 'Enter Grade (or N/A)' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as Grade,
    max( CASE WHEN ot.meta_key = 'Homeroom/Homebase' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as Homeroom,
    max( CASE WHEN ot.meta_key = 'Schools/Offices' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as Schools


    FROM wpbx_posts p 
    join wpbx_postmeta pm on p.ID = pm.post_id
	
    join wpbx_woocommerce_order_items oi on p.ID = oi.order_id
    join wpbx_woocommerce_order_itemmeta ot on oi.order_item_id = ot.order_item_id 

    where
    post_type = 'shop_order'
    AND
    oi.order_item_type = 'line_item' 

group by
    p.ID";
	
	$result = $wpdb->get_results($query);

	//print_r($result);

	$i = 0;
	if (count($result) > 0) {
		foreach ($result as $key => $value) {
			
			$csv_output = $csv_output . $value->Field. "";
			
		//$csv_output .= "\n";
		//print_r($csv_output);
	}

	$query = "SELECT p.ID as order_id,
    p.post_date, 
    oi.order_item_name,

    max( CASE WHEN pm.meta_key = '_billing_email' and p.ID = pm.post_id THEN pm.meta_value END ) as billing_email,
    max( CASE WHEN pm.meta_key = '_billing_first_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_first_name,
    max( CASE WHEN pm.meta_key = '_billing_last_name' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_last_name,
    max( CASE WHEN pm.meta_key = '_billing_address_1' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_address_1,
    max( CASE WHEN pm.meta_key = '_billing_address_2' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_address_2,
    max( CASE WHEN pm.meta_key = '_billing_city' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_city,
    max( CASE WHEN pm.meta_key = '_billing_state' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_state,
    max( CASE WHEN pm.meta_key = '_billing_postcode' and p.ID = pm.post_id THEN pm.meta_value END ) as _billing_postcode,
    
    max( CASE WHEN pm.meta_key = '_order_total' and p.ID = pm.post_id THEN pm.meta_value END ) as order_total,
    
    max( CASE WHEN ot.meta_key = 'Enter student/staff first name' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as First,
    max( CASE WHEN ot.meta_key = 'Enter student/staff last name' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as Last,
    max( CASE WHEN ot.meta_key = 'Enter Grade (or N/A)' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as Grade,
    max( CASE WHEN ot.meta_key = 'Homeroom/Homebase' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as Homeroom,
    max( CASE WHEN ot.meta_key = 'Schools/Offices' and oi.order_item_id = ot.order_item_id THEN ot.meta_value END ) as Schools


    FROM wpbx_posts p 
    join wpbx_postmeta pm on p.ID = pm.post_id
    
	join wpbx_woocommerce_order_items oi on p.ID = oi.order_id
    join wpbx_woocommerce_order_itemmeta ot on oi.order_item_id = ot.order_item_id 

    where
    post_type = 'shop_order'
    AND
    oi.order_item_type = 'line_item' 

group by
    p.ID";

		$table_head = array( 'Order ID', 'Order Date', 'Order Item Name', 'Billing Email', 'Billing First Name', 'Billing Last Name', 'Billing Address 1', 'Billing Address 2', 'Billing City', 'Billing State', 'Billing Postcode', 'Order Total', 'First', 'Last', 'Grade','Homeroom', 'Schools', ' ', ' ', ' ', ' ', ' ', ' ');
		
		$values = $wpdb->get_results($query);
		
		if (count($values)>0) {
			
			$csv_output .= implode( $table_head, ',' );
			$csv_output .= "\n";
			
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




