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


















