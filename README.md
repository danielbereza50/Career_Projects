# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.   

* download MAMP here: https://bitnami.com/stack/mamp/installer
* download Laravel here: https://laravel.com/docs/4.2

*My installation is pointing here: http://localhost/Laravel/public/

<b>Full Stack Engineer (MAMP, WAMP, LAMP 64 bit architecture) - Laravel</b>

Operating Systems:
Mac, Windows, Linux

Laravel Cookbooks: 

https://www.youtube.com/watch?v=HdXj8X0ysZc

https://laravel.com/docs/4.2

https://macpaw.com/how-to/access-bin-folder-mac

https://brew.sh/

https://stackoverflow.com/questions/29329999/mcrypt-php-extension-required-on-mac-os-x

** Edit files in Ubantu

https://vitux.com/how-to-edit-config-files-in-ubuntu/

** Save and Edit sudo nano bash scripts

https://apple.stackexchange.com/questions/52461/how-to-save-and-exit-nano-bash-profile-in-terminal

Note: 


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

        composer global require "laravel/installer=~1.1"

        cd /Applications/MAMP/htdocs/  
        composer create-project laravel/laravel=4.1.27 laravel --prefer-dist

        composer install





Go here in web browser:
127.0.0.1:8000








* great Laravel templates:

https://www.creative-tim.com/blog/web-design/free-dashboards-templates-laravel/

https://github.com/the-control-group/voyager
