<?php

$sql_30 = "

			SELECT p.ID, p.post_title, MAX(CAST(pm.meta_value AS SIGNED)) AS total_sales, MAX(price.meta_value) AS product_price
			FROM wp_posts AS p
			JOIN wp_postmeta AS pm ON p.ID = pm.post_id
			LEFT JOIN wp_postmeta AS price ON p.ID = price.post_id AND price.meta_key = '_price'
			WHERE p.post_type = 'product'
			AND p.post_status = 'publish'
			AND pm.meta_key = 'total_sales'
			AND price.meta_value > 0 -- Exclude products with a price of 0
			AND p.ID IN (21, 905,526, 752, 982, 485, 1631, 803, 632, 1285, 900, 503, 1004, 7362, 6916, 2616, 411, 877, 971, 1200,1115, 989, 1479, 11222, 1169, 720, 993, 1488, 3611, 511, 1191, 7506, 2591, 838, 1970, 1171, 4916, 1330, 955) -- Include the specified product IDs
			GROUP BY p.ID, p.post_title
			ORDER BY total_sales DESC;



		";
				
		$sql_20 = "

			SELECT p.ID, p.post_title, MAX(CAST(pm.meta_value AS SIGNED)) AS total_sales, MAX(price.meta_value) AS product_price
			FROM wp_posts AS p
			JOIN wp_postmeta AS pm ON p.ID = pm.post_id
			LEFT JOIN wp_postmeta AS price ON p.ID = price.post_id AND price.meta_key = '_price'
			WHERE p.post_type = 'product'
			AND p.post_status = 'publish'
			AND pm.meta_key = 'total_sales'
			AND price.meta_value > 0 -- Exclude products with a price of 0
			AND p.ID IN (2161, 2266, 1480, 1701, 8725, 1048, 20979, 418, 36, 2232, 1232, 1945, 6965, 7121, 7689, 4386, 3658, 400) -- Include the specified product IDs
			GROUP BY p.ID, p.post_title
			ORDER BY total_sales DESC;


		";
		
		$sql_10 = "

			SELECT p.ID, p.post_title, MAX(CAST(pm.meta_value AS SIGNED)) AS total_sales, MAX(price.meta_value) AS product_price
			FROM wp_posts AS p
			JOIN wp_postmeta AS pm ON p.ID = pm.post_id
			LEFT JOIN wp_postmeta AS price ON p.ID = price.post_id AND price.meta_key = '_price'
			WHERE p.post_type = 'product'
			AND p.post_status = 'publish'
			AND pm.meta_key = 'total_sales'
			AND price.meta_value > 0 -- Exclude products with a price of 0
			AND p.ID IN (1278, 1140, 687, 31, 1114, 1437, 664, 4229, 10105, 1242 ,11124, 3731, 872, 729, 5808, 812, 1708) -- Include the specified product IDs
			GROUP BY p.ID, p.post_title
			ORDER BY total_sales DESC;


		";
		$results_30 = $wpdb->get_results($sql_30);
		$results_20 = $wpdb->get_results($sql_20);
		$results_10 = $wpdb->get_results($sql_10);