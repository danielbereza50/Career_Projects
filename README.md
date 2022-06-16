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

Mac command to bypass content protect:

CMD + OPTION + I

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

https://whois.domaintools.com/

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

Register an LLC:

https://www.zenbusiness.com/d/login

For Project Management:

https://kanbanflow.com/

https://asana.com/

https://www.getrodeo.io/

https://basecamp.com/

https://slack.com/

https://www.teamwork.com/

https://activecollab.com/

https://redbooth.com/

https://trello.com/en-US


SVN Repos for published plugins:

https://plugins.svn.wordpress.org/

https://gpldl.com/

https://codecanyon.net/tags/laravel

https://account.envato.com/google/authenticate?to=codecanyon

https://themeforest.net/

https://www.templatemonster.com/wordpress-themes.php

https://www.jqueryscript.net/

1. Contract Work I did:

Custom Themes + SEO work via
* https://developers.google.com/speed/pagespeed/insights/
* https://analytics.google.com/analytics/web/
* https://tagmanager.google.com/#/home
* https://search.google.com/search-console/welcome
* https://drive.google.com/drive/my-drive
* https://console.developers.google.com/
* https://console.cloud.google.com/home/dashboard

////////////////////////////////////////////////////////

* https://www.wordtracker.com
* https://www.semrush.com/login/?src=header&redirect_to=%2F
* https://ahrefs.com/backlink-checker
* https://www.seoptimer.com
* https://rainstreamweb.com/
* https://www.alignable.com
* https://my.yoast.com/login
* https://login.buffer.com/login
* https://cloudconvert.com/png-to-webp
* https://wave.webaim.org/

------------------------------------------------------
* https://www.bing.com/webmasters/
* https://webmaster.yandex.com/sites/add/
* https://www.seomandarin.com/baidu-webmaster-tools
------------------------------------------------------
* https://search.google.com/test/mobile-friendly
* https://www.google.com/recaptcha/admin/site/349560113
* https://meet.google.com/
* https://www.lambdatest.com/
* https://www.syncedlocalmarketing.com/
* https://gtmetrix.com/

Other Links:
* https://www.cloudways.com/blog/post-smtp-mailer-fork-of-wordpress-postman-smtp-plugin/?id=339490
* https://support.google.com/webmasters/answer/6065812
* https://ahrefs.com/blog/why-is-my-website-not-showing-up-on-google/
* http://pajhome.org.uk/crypt/md5/
* https://whatismyipaddress.com/ - IPv4
* https://www.whatsmyip.org/
* https://stock.adobe.com/search/free
* https://www.smugmug.com/
* https://www.elegantthemes.com/blog/resources/elegant-icon-font
* https://phoenixnap.com/kb/how-to-flush-dns-cache
* https://tinypng.com/
* http://beautifytools.com/php-beautifier.php
* https://beautifytools.com/scss-compiler.php
* https://paiza.io/en/projects/new
* https://www.freeformatter.com/html-formatter.html
* https://documentcloud.adobe.com/us/en/
* https://dnschecker.org/
* https://passwordsgenerator.net/
* https://fontsfree.net/
* https://redketchup.io/bulk-image-resizer
* https://loremipsum.io/
* https://smallpdf.com/edit-pdf
* https://zapier.com/
* https://vimeo.com/
* https://www.bizcardmaker.com/
* https://www.speedtest.net/
* https://copilot.github.com/
* https://www.flaticon.com/
* https://www.blindtextgenerator.com/lorem-ipsum
* https://pinetools.com/colorize-image
* http://www.ajaxload.info/
* https://codesandbox.io/s/
* https://infoheap.com/online-react-jsx-to-javascript/
* https://gridbyexample.com/examples/
* https://www.veed.io/video-compressor
* https://mxtoolbox.com/
* https://products.aspose.app/words/parser
* https://online-video-cutter.com/

gmail queries: older_than:3y

Web Host Increase Limits:

MultiPHP INI Editor:

max_execution_time: 180

max_input_time: 600 

max_input_vars: 5000

memory_limit: 512M

post_max_size: 128M

session.gc_maxlifetime: 1440

upload_max_filesize: 512M


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

* note - some hosting providers use two-factor authentication

https://platform.cloudways.com/

https://identity.wpengine.com/

https://app.getflywheel.com/login

https://www.networksolutions.com/my-account/account-center/login

https://www.networksolutions.com/domain-name-registration/index.jsp

https://login.ionos.com/

https://mail.ionos.com/

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

https://account.squarespace.com

<hr>

Company:

Go Viral Marketing 

- Team GVM

https://www.godaddy.com/

https://goviralmarketing.com

Staging Solutions:

https://dev.goviralmarketing.com/ef-2020-report/

http://www.goviralmarketing.com/goodmotherbirthing/

Deployed Solutions:

https://sjfmc.org

http://transitionallifecounselingandconsultation.com

http://acertainwork.org

<hr>

http://goodmotherbirthing.com/

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

http://www.canitllc.com/

https://www.greaternewbritainchamber.org/

http://murphyscure.4bizgraphics.com/

http://newbritaindd.4bizgraphics.com/

https://3h3.3ea.myftpupload.com/

http://donsagarino.com/

https://tboxusa.net/

https://worthingtonwinery.net/

Deployed Solutions:

https://eesc-ct.com/

https://wolcottct.org

http://vistapak.com

http://foodsafetyconsults.com

http://laydonindustries.com

http://essexautoclub.org

http://greatbeginningsdaycarecenter.com

https://urgentcarecentersct.com

http://monsignorbojnowskimanor.org/

https://greaternewbritainchamber.com/

http://www.newbritaindd.com/

<hr>

http://murphyscure.com/

https://tboxusa.com/

https://4sharpcorners.com/

https://worthingtonwinery.com/

<hr>

Company:

212 Creative, LLC 

- Team 212

////////////////////////////////////////

https://www.siteground.com/kb/point-website-domain-siteground/

https://login.siteground.com

https://www.sourcetreeapp.com/

https://bitbucket.org/212creative

////////////////////////////////////////

https://templates.212creative.com/

https://shop.212creative.com/templates/

https://jdwebsitedevelopment.com

https://shop.212creative.com

https://212creative.com


framework: Divi

Staging Solutions:

https://ourtown3d.com/newbaltimore

https://ourtown3d.com/stclair

////////////////////////////////////////

http://jmgllc.212development.com/

https://legaldir.212development.com/lawfirms-directory/

////////////////////////////////////////

https://www.staging18.forestbathingfinder.com/

http://pfl.212development.com

http://testsite.212development.com/adapp

https://staging2.lessonsinanutshell.com/

https://harmless.212development.com/

http://c2ctestapp.212development.com/trimmingapp

https://beeandblooms.212development.com/

https://gch.212development.com/

http://dm.212development.com/

http://brynmorgan.212staging.net/

https://aps.212staging.net/

https://munictpl.212staging.net/

http://testsite.212development.com/valcalcapp

https://mcb.212staging.net/

https://provost.212staging.net/

https://tnt.212staging.net/

https://talentbureau.212staging.net/

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

https://marinecityhealthandfitness.com

https://lighthousebiblenb.com

https://presidentiallawncaresolutions.com/

https://inoacusa.com/

https://goodygreetings.com/

https://midwestaerotech.com/

https://atlessdraincleaning.com/

https://julieswreathboutique.com/

https://pickerplace.com/

https://anothercastlegames.com/

https://www.brassringlearning.com/

https://lessonsinanutshell.com/

https://selfesteemshop.com/

https://www.rvadventure-usa.com/

https://hh.huronpointe.org

https://staff.innisfail.ca/

https://c2c-solutions.com/trimmingapp

https://allpurposesanitation.org/

https://www.gracecentersofhope.org/

https://beeandblooms.com/

https://dmtreeservice.com/

<hr>

https://provost.ca/

https://talentbureau.com/

https://shoptntparts.com/store

<hr>


Company:

Digital Meets Print, LLC

- Team DMP

Unified Layer -

https://portal.hostgator.com/login

https://162.215.220.1:2087/

https://www.nbprintdesign.com/

https://digitalmeetsprint.com/

https://nlxmiddlesexnj.com/

http://santllc.com/

framework: Divi

Staging Solutions:

http://awmartinrestoration.com

https://rnspizzagrill.com

http://corbansolutions.net/

https://lakenelsonmemorialpark.com/

https://www.vitalabstract.com

http://oldetimeautorepair.com/

https://agkacademy.com/

https://coastalcupsoccer.com/

http://romalandscape.com/

https://griffintacticalsolutionsllc.com/

////////////////////////////////////////

https://njmintel.com/

https://kwakwanifunding.com/

https://heartsnhand.org/

https://backyardexperiencellc.com

https://3tscouriers.com/

Deployed Solutions:

https://starcarwashnj.com/

https://swiftsocceracademynj.com/

https://egsnewjersey.com/

https://spiceisleflavasinc.com/

https://www.adamsathleticclub.com/

https://claudiasproperties.com/

<hr>

https://www.kwakwanicapital.com/

https://www.thebackyardexperiencellc.com/

https://hhtnj.net/

https://www.corbansolutions.com/

https://awmartin.com/

https://rhythmandspicejagrill.com/

https://www.centurymotorcars.com/

https://www.cmcautocenter.com/

https://romalandscapedesign.com/

https://cornerstonepavingmasonry.com/

https://renewalsolutionsinc.com/

<hr>

Company:

EyeBenders, LLC

- Team EB

https://digital.com/best-web-hosting/who-is/

https://www.networksolutions.com/my-account/account-center/login

https://www.namecheap.com/myaccount/login/

https://customers.site5.com/index.php?rp=/login

https://my.a2hosting.com/clientarea.php

https://eyebenders.com/

Staging Solutions:

http://omitttradeschool.eyebenders.org/

https://omittinnovativesolutions.eyebenders.org/

http://ohfp.eyebenders.org/

Deployed Solutions:

https://www.ncbrewsmusic.com/

https://liftconnection.org/

https://lochnorman.com/

http://www.investorfriendlymoneylender.com/

<hr>

https://www.omitttradeschool.com/

https://omittinnovativesolutions.org/

http://omitttrainingacademy.com/

http://ohfp.org/

http://kristincoke.com/

