# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.   

* download MAMP here: https://bitnami.com/stack/mamp/installer
* download Drupal here: https://www.drupal.org/download

*My installation is pointing here: //

<b>Full Stack Engineer (MAMP, WAMP, LAMP 64 bit architecture) - Django</b>

Operating Systems:
Mac, Windows, Linux

Drupal Cookbooks: 


list of terminal commands:

      /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
      brew install php

      composer create-project drupal/recommended-project drupal 

	cd drupal && php -d memory_limit=256M web/core/scripts/drupal quick-start demo_umami


db config file is /web/sites/default/settings.php


Development server:
http://localhost:8888/drupal/blog/web/
