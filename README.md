# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.   

* download MAMP here: https://bitnami.com/stack/mamp/installer
* download Drupal here: https://www.drupal.org/download

*My installation is pointing here: //

<b>Full Stack Engineer (MAMP, WAMP, LAMP 64 bit architecture) </b>

Operating Systems:
Mac, Windows, Linux

Drupal Cookbooks: 


list of terminal commands:

    /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
    brew install php
  
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"

    *Note, after installing composer, move to here for global use on the machine: 
    mv composer.phar /usr/local/bin/composer
    https://getcomposer.org/doc/00-intro.md
    https://stackoverflow.com/questions/11333230/how-to-run-composer-from-anywhere

    composer create-project drupal/recommended-project drupal 

    cd drupal && php -d memory_limit=256M web/core/scripts/drupal quick-start demo_umami

       

        manually go to this URL to go to startup:
        
        /drupal/web/core/install.php

        /drupal/web/

        terminal commands for core / theme / and module
        
        composer create-project drupal/recommended-project:9.3.0 "install-dir"

        https://www.drupal.org/project/project_theme
        composer require 'drupal/startup_zymphonies_theme:^2.0'

        https://www.drupal.org/project/project_module
        composer require 'drupal/commerce:^2.36'

        
        login here:
        
        /drupal/web/user/login

        db config file is /web/sites/default/settings.php

        how to reset user login:

        UPDATE drupal_users_field_data 
        SET pass='$S$Eno1EhlPNMqE2RfDOBT13tzGCAdN9PgKqJFGI.4sBSj1XgJfPH68' 
        WHERE uid = 4;

        newpasswd

        DELETE FROM drupal_cache_entity WHERE cid = 'values:user:4' 

        UPDATE `drupal_user__roles` SET `entity_id` = '4' WHERE `drupal_user__roles`.`deleted` = 0 AND `drupal_user__roles`.`entity_id` = 1 AND `drupal_user__roles`.`langcode` = 'en' AND `drupal_user__roles`.`delta` = 0; 

        How to update Druapl core:

        in root folder:

        composer update "drupal/core-*" --with-all-dependencies


        how to turn on error reporting:
        
        login to admin -> configuration ->loggin and errors
        
        
        how to clear the cache;
        
        login to admin -> configuration ->Performance
        
        
        
        *note - 
          a) modules use controller files
          b) themes use twig templates
        
        How to update PHP for MAMP
        
        1. brew update 
        2. brew upgrade php 
        3. cd /usr/loca/Cellar/php 
        4. copy folder to /MAMP/bin/PHP
        5. cd /usr/local/lib/httpd
        6. copy modules folder to new PHP version folder - example phpx.x.x
        

Development server:
http://localhost:8888/drupal/blog/web/
