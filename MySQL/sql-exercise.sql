SELECT * FROM `wp_posts`
WHERE `post_type` = 'post'
AND DATEDIFF(NOW(), `post_date`) > 30



-- Set up variable to delete ALL tables starting with 'temp_'
SET GROUP_CONCAT_MAX_LEN=10000;
SET @tbls = (SELECT GROUP_CONCAT(TABLE_NAME)
               FROM information_schema.TABLES
              WHERE TABLE_SCHEMA = 'my_database'
                AND TABLE_NAME LIKE 'temp_%');
SET @delStmt = CONCAT('DROP TABLE ',  @tbls);
-- SELECT @delStmt;
PREPARE stmt FROM @delStmt;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


SELECT * FROM `wp_687_posts`
WHERE `post_type` = 'post'
AND DATEDIFF(NOW(), `post_date`) > 720




/

http://localhost:8888/wordpress/

https://stackoverflow.com/questions/1589278/sql-deleting-tables-with-prefix
https://stackoverflow.com/questions/5317599/wordpress-automatically-delete-posts-that-are-x-days-old




https://www.webnots.com/how-to-import-large-mysql-database-in-mamp-using-terminal/

1. /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
2. CREATE DATABASE test_db;
3. show databases;
4. use test_db;
5. SET autocommit=0 ; source /Applications/MAMP/htdocs/test_db.sql ; COMMIT ;