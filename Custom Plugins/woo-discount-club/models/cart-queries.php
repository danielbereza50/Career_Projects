<?php

	$sql_users = $wpdb->prepare(
			"SELECT
				orders.ID AS order_id,
				orders.post_date AS order_date,
				user_meta.meta_value AS user_id,
				user_meta.meta_value AS order_value,
				SUM(CASE WHEN total.meta_key = '_order_total' THEN total.meta_value ELSE 0 END) AS total_spent
			FROM $wpdb->posts AS orders
			JOIN $wpdb->postmeta AS user_meta ON orders.ID = user_meta.post_id
			LEFT JOIN $wpdb->postmeta AS total ON orders.ID = total.post_id
			WHERE orders.post_type IN ('shop_order', 'shop_order_refund')
			 AND (
				orders.post_status = 'wc-processing' OR
				orders.post_status = 'wc-completed' OR
				orders.post_status = 'wc-on-hold'  -- Include 'On hold' status
			)
			AND user_meta.meta_key = '_customer_user'
			AND user_meta.meta_value = %d
			AND DATE(orders.post_date) >= DATE(CONCAT(YEAR(CURDATE()), '-01-01'))
			GROUP BY order_id, order_date, user_id, order_value
			ORDER BY order_date DESC",
			$user_id
		);

		$results_users = $wpdb->get_results($sql_users);

		/*
			 echo '<pre>';
				print_r($results_users);
			 echo '</pre>';
		*/

		$totalSpent = 0; // Initialize the total spent variable
		if ($results_users) {
			foreach ($results_users as $row) {
				// Access the query results here
				$order_id = $row->order_id;
				$order_date = $row->order_date;
				$user_id = $row->user_id;
				$order_value = $row->order_value;
				//echo '<br>';
				$total_spent_final += $row->total_spent; // Add to the total spent

			}
		} else {
			// No results found
		}


