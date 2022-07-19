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


INSERT INTO 'databasename'.'wp_users' ('ID', 'user_login', 'user_pass') 
VALUES ('4', 'demo', MD5('demo'));
 
INSERT INTO 'databasename'.'wp_usermeta' ('umeta_id', 'user_id', 'meta_key', 'meta_value') 
VALUES (NULL, '4', 'wp_capabilities', 'a:1:{s:13:"administrator";s:1:"1";}');
 
INSERT INTO 'databasename'.'wp_usermeta' ('umeta_id', 'user_id', 'meta_key', 'meta_value') 
VALUES (NULL, '4', 'wp_user_level', '10');


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



-- remove shortcodes from post content
UPDATE wp_posts SET post_content = REPLACE(post_content, '[shortcodename]', '' ) ;


-- update post authors
UPDATE wp_posts SET post_author=id_new_author WHERE post_author=id_old_author;

-- delete all unused taxonomies from db
DELETE FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE count = 0)


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

