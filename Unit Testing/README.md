How to use Unit Testing in WP:

1. Install PHP Unit:

$ wget https://phar.phpunit.de/phpunit.phar

$ chmod +x phpunit.phar

$ mv phpunit.phar /usr/local/bin/phpunit


2. Create dummy plugin

$ cd wp-simple-plugin

$ mkdir tests

$ mkdir tests/phpunit

$ mkdir tests/phpunit/tests

// or create all directories recursively

$ mkdir -p tests/phpunit/tests 

3. Install WP Tests Library

$ cd wp-simple-plugin

$ cd tests/phpunit

$ svn co https://develop.svn.wordpress.org/trunk/tests/phpunit/includes/






https://www.codetab.org/tutorial/wordpress-plugin-development/unit-test/plugin-unit-testing/
https://www.smashingmagazine.com/2017/12/automated-testing-wordpress-plugins-phpunit/









