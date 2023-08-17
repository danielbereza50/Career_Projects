# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.   

* download MAMP here: https://bitnami.com/stack/mamp/installer
* download Drupal here: https://www.drupal.org/download

*My installation is pointing here: //

<b>Full Stack Engineer (MAMP, WAMP, LAMP 64 bit architecture) </b>

Operating Systems:
Mac, Windows, Linux

Magento Cookbooks: 


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


    To get access keys, go here: https://marketplace.magento.com/
    Account > My Profile > Access Keys

    composer config --global http-basic.repo.magento.com <public-key> <private-key>


    cd path/to/magento/project


    composer create-project --repository-url=https://repo.magento.com/ magento/project-community-edition magento2








    
