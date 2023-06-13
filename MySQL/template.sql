UPDATE wp_options
SET option_value = replace(option_value, 'oldurl.com', 'newurl.com') 
WHERE option_name = 'home' 
OR option_name = 'siteurl';

UPDATE wp_posts 
SET guid = replace(guid, 'oldurl.com','newurl.com');

UPDATE wp_posts 
SET post_content = replace(post_content, 'oldurl.com', 'newurl.com');

UPDATE wp_postmeta 
SET meta_value = replace(meta_value,'oldurl.com','newurl.com');


INSERT INTO `db`.`wphc_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) 
VALUES ('10', 'john', MD5('T%Iyg(GViXfmmtbYxZ)9ycQE'), 'Your Name', 'test@example.com', 'http://www.example.com/', '2022-09-01 00:00:00', '', '0', 'Your Name');
  
INSERT INTO `db`.`wphc_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) 
VALUES (20, '10', 'wp_capabilities', 'a:1:{s:13:"administrator";s:1:"1";}');
  
INSERT INTO `db`.`wphc_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) 
VALUES (21, '10', 'wp_user_level', '10');


DELETE FROM wp_woocommerce_order_itemmeta;
DELETE FROM wp_woocommerce_order_items;
DELETE FROM wp_comments WHERE comment_type = 'order_note';
DELETE FROM wp_postmeta WHERE post_id IN ( SELECT ID FROM wp_posts WHERE post_type = 'shop_order' );
DELETE FROM wp_posts WHERE post_type = 'shop_order';



SELECT p.`ID`, 
       p.`post_title`   AS coupon_code, 
       p.`post_excerpt` AS coupon_description, 
       Max(CASE WHEN pm.meta_key = 'discount_type'      AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS discount_type,          -- Discount type 
       Max(CASE WHEN pm.meta_key = 'coupon_amount'      AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS coupon_amount,          -- Coupon amount 
       Max(CASE WHEN pm.meta_key = 'free_shipping'      AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS free_shipping,          -- Allow free shipping 
       Max(CASE WHEN pm.meta_key = 'expiry_date'        AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS expiry_date,                -- Coupon expiry date 
       Max(CASE WHEN pm.meta_key = 'minimum_amount'     AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS minimum_amount,         -- Minimum spend 
       Max(CASE WHEN pm.meta_key = 'maximum_amount'     AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS maximum_amount,         -- Maximum spend 
       Max(CASE WHEN pm.meta_key = 'individual_use'     AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS individual_use,         -- Individual use only 
       Max(CASE WHEN pm.meta_key = 'exclude_sale_items' AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS exclude_sale_items,         -- Exclude sale items 
       Max(CASE WHEN pm.meta_key = 'product_ids'    AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS product_ids,                -- Products 
       Max(CASE WHEN pm.meta_key = 'exclude_product_ids'AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS exclude_product_ids,        -- Exclude products 
       Max(CASE WHEN pm.meta_key = 'product_categories' AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS product_categories,             -- Product categories 
       Max(CASE WHEN pm.meta_key = 'exclude_product_categories' AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS exclude_product_categories,-- Exclude Product categories 
       Max(CASE WHEN pm.meta_key = 'customer_email'     AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS customer_email,         -- Email restrictions 
       Max(CASE WHEN pm.meta_key = 'usage_limit'    AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS usage_limit,                -- Usage limit per coupon 
       Max(CASE WHEN pm.meta_key = 'usage_limit_per_user'   AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS usage_limit_per_user,   -- Usage limit per user 
       Max(CASE WHEN pm.meta_key = 'usage_count'    AND  p.`ID` = pm.`post_id` THEN pm.`meta_value` END) AS total_usaged                   -- Usage count 
FROM   `wpjh_posts` AS p 
       INNER JOIN `wpjh_postmeta` AS pm ON  p.`ID` = pm.`post_id` 
WHERE  p.`post_type` = 'shop_coupon' 
       AND p.`post_status` = 'publish' 
GROUP  BY p.`ID` 
ORDER  BY p.`ID` ASC;



-- remove text strings from post content, examples:
UPDATE wp_posts SET post_content = REPLACE(post_content, '[shortcodename]', '' ) ;
UPDATE wp_posts SET post_content = REPLACE(post_content, '1 Minute Read |', '' ) ;

-- update post authors
UPDATE wp_posts SET post_author=id_new_author WHERE post_author=id_old_author;

-- delete all unused taxonomies from db
DELETE FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE count = 0)


REPAIR TABLE wphc_actionscheduler_claims
DELETE FROM wphc_actionscheduler_logs where log_date_gmt < '2022-09-08 00:50:38'

SELECT t.*, tt.*
FROM rmb_terms AS t 
INNER JOIN rmb_term_taxonomy AS tt ON tt.term_id = t.term_id 
INNER JOIN rmb_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
WHERE tt.taxonomy IN ('product_cat') 
AND tr.object_id IN (11892)



SELECT ID, `post_date` ,  `post_title` ,  `post_content` ,  `guid` FROM  `rmb_posts` as post
INNER JOIN rmb_term_relationships rs ON rs.object_id = post.ID 
WHERE  `post_type` =  "post" 
AND  `post_status` =  "publish"
AND rs.term_taxonomy_id  = 1 
ORDER BY post_date DESC LIMIT 5




              -- joins comments, posts, users and usermeta tables
                SELECT DISTINCT `post_title` AS Product, 
                   m1.meta_value AS 'First_Name',
                   m2.meta_value AS 'Last_Name',
                  `display_name` AS 'Customer_Name', 
                  `comment_author_email` AS 'Customer_Email', 
                  `comment_date` , 
                  `comment_content` AS 'Comment' 

                  FROM wp_comments as c

                  INNER JOIN `wp_posts` as p ON c.comment_post_ID = p.ID 
                  INNER JOIN `wp_users` as u ON c.comment_author = u.user_login

                  INNER JOIN `wp_usermeta` as m1 ON c.user_id = m1.user_id
                  INNER JOIN `wp_usermeta` as m2 ON c.user_id = m2.user_id


                  WHERE c.comment_author != 'WooCommerce' 
                  AND m1.meta_key = 'first_name'
                   AND m2.meta_key = 'last_name'
                  AND c.comment_approved = '1'
                  AND c.comment_date >= '2023-01-01 05:44:43'
                  ORDER BY c.`comment_date` DESC




SELECT order_id, post_date, oim.meta_value 
FROM wp_posts AS p 
JOIN wp_woocommerce_order_items AS oi ON p.ID = oi.order_id 
JOIN wp_woocommerce_order_itemmeta AS oim ON oi.order_item_id = oim.order_item_id 
WHERE oim.meta_key = 'Items' 
AND oim.meta_value REGEXP '^\'product\' title™ - lorum ipsum &times' 
OR oim.meta_value REGEXP '^product title™ - lorum ipsum'

// List of all zip codes and lat, long
// https://gist.github.com/erichurst/7882666

SELECT wp67_users.*,
			um1.meta_value as role,
	       	um2.meta_value as lat,
	        um3.meta_value as lng,

3959 * acos( cos( radians("42.3600825") ) * cos( radians( um2.meta_value ) ) * cos( radians ( um3.meta_value ) - radians("-71.0588801") )
            + sin( radians("42.3600825") ) * sin( radians ( um2.meta_value ) ) )  as 'distance'
	     
FROM wp67_users
LEFT JOIN wp67_usermeta AS um1 ON (um1.user_id = wp67_users.ID AND um1.meta_key='wp67_capabilities')
LEFT JOIN wp67_usermeta AS um2 ON (um2.user_id = wp67_users.ID AND um2.meta_key='guide_lat')
LEFT JOIN wp67_usermeta AS um3 ON (um3.user_id = wp67_users.ID AND um3.meta_key='guide_lng')
AND um1.meta_value LIKE '%guide%'	

HAVING distance < 50 or distance < 0


SELECT c.*
FROM wp_comments as c                
INNER JOIN `wp_posts` as p ON c.comment_post_ID = p.ID
WHERE c.comment_type = 'review'
AND p.post_title = ''


DELETE c.*
FROM wp_comments as c                
INNER JOIN `wp_posts` as p ON c.comment_post_ID = p.ID
WHERE c.comment_type = 'review'
AND p.post_title = ''

    SELECT u.ID,
	    firstname.meta_value as first_name, 
	    lastname.meta_value as last_name, 
	    billing_address_1.meta_value as billing_address_1, 
	    billing_city.meta_value as billing_city, 
	    billing_state.meta_value as billing_state, 
	    billing_postcode.meta_value as billing_postcode, 
	    billing_country.meta_value as billing_country, 
	    billing_email.meta_value as billing_email, 
	    billing_phone.meta_value as billing_phone, 
	    wp67_capabilities.meta_value as wp67_capabilities

    FROM wp67_users u
    
    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'first_name') as firstname ON u.ID = firstname.user_id
    
    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'last_name') as lastname ON u.ID = lastname.user_id
  
    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'billing_address_1') as billing_address_1 ON u.ID = billing_address_1.user_id

    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'billing_city') as billing_city ON u.ID = billing_city.user_id

    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'billing_state') as billing_state ON u.ID = billing_state.user_id

    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'billing_postcode') as billing_postcode ON u.ID = billing_postcode.user_id

    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'billing_country') as billing_country ON u.ID = billing_country.user_id

    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'billing_email') as billing_email ON u.ID = billing_email.user_id

    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'billing_phone') as billing_phone ON u.ID = billing_phone.user_id

    INNER JOIN (SELECT user_id, meta_value FROM wp67_usermeta WHERE meta_key = 'wp67_capabilities' AND wp67_usermeta.meta_value LIKE '%guide%') as wp67_capabilities ON u.ID = wp67_capabilities.user_id

    ORDER BY u.user_registered DESC






	how to view low performing products in woo:

	SELECT oi.order_item_name AS product_name,
	       Sum(oim2.meta_value) AS total_count
	FROM   wp_posts p
	       INNER JOIN wp_woocommerce_order_items oi
		       ON p.id = oi.order_id
	       INNER JOIN wp_woocommerce_order_itemmeta oim
		       ON oi.order_item_id = oim.order_item_id
			  AND oim.meta_key = '_product_id'
	       INNER JOIN wp_woocommerce_order_itemmeta oim2
		       ON oi.order_item_id = oim2.order_item_id
			  AND oim2.meta_key = '_qty'
	WHERE  p.post_type = 'shop_order'
	       AND p.post_status IN ( 'wc-completed', 'wc-processing' )
	       AND oi.order_item_type = 'line_item'
	GROUP  BY oim.meta_value
	ORDER  BY total_count ASC 


	// ASP.NET SQL Server

	-- Create the Orders table
	CREATE TABLE Orders (
	    OrderID INT PRIMARY KEY
	);

	-- Create the OrderDetails table with a foreign key constraint
	CREATE TABLE OrderDetails (
	    OrderDetailID INT PRIMARY KEY,
	    OrderID INT,
	    Details VARCHAR(100),
	    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE
	);

	-- Insert sample data
	INSERT INTO Orders (OrderID) VALUES (1), (2);

	INSERT INTO OrderDetails (OrderDetailID, OrderID, Details) VALUES
	(101, 1, 'Order 1 - Detail 1'),
	(102, 1, 'Order 1 - Detail 2'),
	(103, 2, 'Order 2 - Detail 1');

	-- Delete an order
	DELETE FROM Orders WHERE OrderID = 1;







