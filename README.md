# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.

* download MAMP here: https://bitnami.com/stack/mamp/installer
* download WordPress here: https://wordpress.org/download/

*My installation is pointing here: http://localhost/WordPress

<div><b>Full Stack Engineer (MAMP, WAMP, LAMP 64 bit architecture) - WordPress</b></div>
<br>
<div>Operating Systems:</div>
<div>Mac, Windows, Linux</div>
<br>
WordPress Cookbooks: 

* Documentation: https://www.wpbeginner.com/wp-tutorials/how-to-move-live-wordpress-site-to-local-server/

* Recommend the WP-CLI over a GUI

* Documentation: https://wp-cli.org/
* https://developer.wordpress.org/cli/commands/

* note - IP address followed by port number for MySQL server in config

Example: 

/** MySQL hostname */

define( 'DB_HOST', '127.0.0.1:8889' );

* 2 servers - (Apache, MySQL)

* Apache uses port 80

* Nginx uses port 8888

* MySQL uses port 8889

1st method
- The entire WP Install can be accessed through the theme's folder for that specific website - just install on the server via download of the master here on git and connect the wp-config for the MySQL db.  Create a new database and user with it's own username and password and place that in the three "define statements" in the config.

example:

define( 'DB_NAME', 'the_db_name' );

/** MySQL database username */

define( 'DB_USER', 'the_user_name' );

/** MySQL database password */

define( 'DB_PASSWORD', 'the_user_password' );

// Some hosting providers require this value

/** MySQL hostname */

define( 'DB_HOST', 'localhost' );

Import the .sql file from the root directory of the theme's folder, and then import via phpmyadmin (Unix Socket) and file upload, zip format perferred

Update your db with : 

UPDATE wp_options SET option_value = replace(option_value, 'http://www.example.com', 'http://localhost/test-site') WHERE option_name = 'home' OR option_name = 'siteurl';
  
UPDATE wp_posts SET post_content = replace(post_content, 'http://www.example.com', 'http://localhost/test-site');
  
UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://www.example.com','http://localhost/test-site');

- For a particular Plugin or Widget build - a directory will be specified in that folder

<div>Computer Networks:</div>
<div>*If pointing over from another remote host, be sure to swap put the "A" Records of the website. </div>

<div>The other DNS records are:</div>
<div>AAAA, CNAME, MX, NS, SOA, and TXT</div>

https://digital.com/web-hosting/who-is/

<div>WP Core Functions:</div>
<div>https://developer.wordpress.org/reference/functions/</div>
<br>
<div>* To install a library, cd into your plugin's folder and use composer using the WP-CLI</div>

<br>
<div>WP REST API:</div>

<div>https://developer.wordpress.org/rest-api/</div>

<div>Append the website URL with(functionality comes with WP Core):</div>
<div>"headless CMS"</div>
<div>website_name/wp-json/wp/v2/users</div>
<div>From terminal use: curl -X GET http://localhost/WordPress/wp-json/wp/v2/pages</div>
<div>https://www.hostinger.com/tutorials/wordpress-rest-api</div>
<div>After installing .phar file in theme's folder: https://make.wordpress.org/cli/handbook/installing/</div>
<div>GET: With this method, you can fetch information from the server.</div>
<div>POST: This enables you to send information to the server in question.</div>
<div>PUT: With the put method, you can edit and update existing data.</div>
<div>DELETE: This enables you to delete information.</div>

<div>to see this endpoint for all of the pages for the theme</div>
<br>

For Project Management:

https://kanbanflow.com/

https://asana.com/

https://basecamp.com/

https://slack.com/

https://activecollab.com/

https://trello.com/en-US


SVN Repos for published plugins:

https://plugins.svn.wordpress.org/

https://gpldl.com/

https://codecanyon.net/tags/laravel


1. Contract Work I did:

Custom Themes + SEO work via
* https://developers.google.com/speed/pagespeed/insights/
* https://www.seoptimer.com
* https://wave.webaim.org/
* https://analytics.google.com/analytics/web/
* https://search.google.com/search-console/welcome
* https://search.google.com/test/mobile-friendly
* https://www.bing.com/webmasters/
* https://www.google.com/recaptcha/admin/site/349560113
* https://meet.google.com/
* https://www.lambdatest.com/
* https://www.syncedlocalmarketing.com/
* https://gtmetrix.com/

Other Links:
* https://drive.google.com/drive/my-drive
* https://console.developers.google.com/
* https://www.cloudways.com/blog/post-smtp-mailer-fork-of-wordpress-postman-smtp-plugin/?id=339490
* https://support.google.com/webmasters/answer/6065812
* https://ahrefs.com/blog/why-is-my-website-not-showing-up-on-google/
* http://pajhome.org.uk/crypt/md5/
* https://whatismyipaddress.com/ - IPv4
* https://www.whatsmyip.org/
* https://stock.adobe.com/
* https://phoenixnap.com/kb/how-to-flush-dns-cache
* https://tinypng.com/
* http://beautifytools.com/php-beautifier.php
* https://beautifytools.com/scss-compiler.php
* https://paiza.io/en/projects/new
* https://www.freeformatter.com/html-formatter.html
* https://www.pdf2go.com/edit-pdf
* https://dnschecker.org/
* https://passwordsgenerator.net/
* https://fontsfree.net/
* https://bulkresizephotos.com/en
* https://loremipsum.io/
* https://smallpdf.com/edit-pdf
* https://zapier.com/
* https://vimeo.com/
* https://www.bizcardmaker.com/
* https://www.speedtest.net/
* https://copilot.github.com/


Learning resources:

https://www.khanacademy.org/computing/computer-programming

https://www.linkedin.com/learning/topics/python


Other Popular CMS systems:

Joombla - https://downloads.joomla.org/us/

Drupal - https://www.drupal.org/download


Woocommerce template structure: 

https://docs.woocommerce.com/document/template-structure/

Woocommerce hook list:

https://premmerce.com/woocommerce-hooks-guide/


Web Servers:

1. Apache

2. Internet Information Services (IIS)

3. nginx


JavaScript - client-side and server-side

https://1loc.dev/

https://www.tutorialspoint.com/online_javascript_editor.php

Python - server-side

https://www.codabrainy.com/en/python-compiler/

https://www.w3schools.com/python/python_classes.asp


Great SEO references:

site:yourwebsite.com

site:yourwebsite.com/a-page-you-want-to-show-up-in-google

yourwebsite.com/sitemap.xml

yourwebsite.com/page-sitemap.xml

yourwebsite.com/robots.txt


1. https://www.contentkingapp.com/academy/robotstxt/#what-is-a-robots-txt-file

2. https://betterstudio.com/blog/search-console-fails-to-fetch-sitemap/


Great Article:
https://medium.com/@rtheunissen/efficient-data-structures-for-php-7-9dda7af674cd

Common Website hosts:

https://identity.wpengine.com/

https://app.getflywheel.com/login

https://www.networksolutions.com/my-account/account-center/login

https://login.ionos.com/

https://login.siteground.com/users?lang=en

https://id.cpanel.net/

https://portal.hostgator.com/login

https://cloud.digitalocean.com/login

https://login.yahoosmallbusiness.com/login

https://sso.godaddy.com/

https://secure.fatcow.com/secure/login.bml

https://my.bluehost.com/web-hosting/cplogin

https://www.wix.com/

https://wpx.net/clientarea/

<hr>

Company:

Go Viral Marketing 

- Team GVM

https://www.godaddy.com/

https://goviralmarketing.com

Staging Solutions:


Deployed Solutions:

http://transitionallifecounselingandconsultation.com

https://sjfmc.org

http://acertainwork.org

<hr>

Company:

EDG eAdvertising Solutions

- Team EDG

Fully Secure Connections:

https://www.godaddy.com/

https://edgeadvertisingsolutions.com:2083

https://www.howeyweb.com

Staging Solutions:

Deployed Solutions:

https://cfbhgroup.com

https://customerfirstconstruction.com

https://completehomeimprovementcontractors.com/

https://imacscontrols.com

https://fishercustomdesigns.com

https://silveradoairsystems.com

https://techi-usa.com

https://garrettsmillag.org

https://silveradomechanicalservices.com

https://threebrothersusa.com

https://keystonerolloff.com

https://mistymints.org

https://www.kismetcafe21784.com/home

http://www.thinkbignets.com/

https://dbtoftowson.com

<hr>

<hr>

Company:

4Biz Graphics, LLC

- Team 4Biz

https://www.networksolutions.com/

http://4bizgraphics.com

Staging Solutions:

http://s854226310.onlinehome.us/

http://www.canitllc.com/

Deployed Solutions:

http://puertovallartausa.net/

https://wolcottct.org

http://vistapak.com

http://foodsafetyconsults.com

http://laydonindustries.com

http://essexautoclub.org

http://greatbeginningsdaycarecenter.com

<hr>
http://urgentcarecentersct.com

<hr>

Company:

CounselingWise

- Team Page1Pros

https://login.siteground.com/

https://wpx.net/clientarea/

https://www.staging.counselingwise.com/

https://counselingwise.com


Staging Solutions:

https://cwdevel2.com/olivebranchtherapygroup/

https://cwdevel2.com/clauidawagner/


Deployed Solutions:

https://therapybloglibrary.com

https://mauihacks.com

https://ouranimalconnection.com/

<hr>

https://www.olivebranchtherapygroup.com/

<hr>

Company:

212 Creative, LLC 

- Team 212

https://daniel.212development.com/

https://login.siteground.com

https://templates.212creative.com/

https://jdwebsitedevelopment.com

https://shop.212creative.com

https://212creative.com


framework: Divi

Staging Solutions:

http://testsite.212development.com/adapp

https://ourtown3d.com/newbaltimore

https://ourtown3d.com/stclair

https://staging3.pickerplace.com/

https://staging2.goodygreetings.com/

http://staging2.atlessdraincleaning.com/

https://staging4.midwestaerotech.com/

https://delirious-brass.flywheelstaging.com/test/

Deployed Solutions:

https://twinsurance.net

http://hangrykits.com/

https://mygpea.org

https://bowlguard.com

https://jacar-systems.com

https://parrotsnaturally.com

https://strictlyvtwin.com

https://innisfail.ca

https://alexisabramson.com

http://skissausage.com/

https://goldentouchconcierge.com/

https://homeproshowcase.com/

https://lessonsinanutshell.com/

https://marinecityhealthandfitness.com

https://lighthousebiblenb.com

https://presidentiallawncaresolutions.com/

https://inoacusa.com/

<hr>

https://pickerplace.com/

https://atlessdraincleaning.com/

https://midwestaerotech.com/

https://hanna.ca/

https://anothercastlegames.com/

<hr>


Company:

Digital Meets Print

- Team DMP

Unified Layer -

https://portal.hostgator.com/login

https://digitalmeetsprint.com/

framework: Divi

Staging Solutions:

http://starcarwashnj.com/

http://egsnewjersey.com/

Deployed Solutions:

<hr>


<hr>
