# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.

* download MAMP here: https://bitnami.com/stack/mamp/installer
* download WordPress here: https://wordpress.org/download/

"WordPress Pages"

/wp-login.php?action=logout

*My installation is pointing here: http://localhost/WordPress
	
	MySQL Server detail:
	
	Host 	localhost / 127.0.0.1 (depending on language and/or connection method used)
	Port 	8889
	Username 	root
	Password 	root
	Socket 	/Applications/MAMP/tmp/mysql/mysql.sock
	db name: 4444



<div><b>Full Stack Engineer (MAMP, WAMP, LAMP 64 bit architecture) - WordPress</b></div>
<br>
<div>Operating Systems:</div>
<div>Mac, Windows, Linux</div>
<br>

	Responsive email markup:

	 // Get cart contents HTML using WooCommerce functions
	    ob_start();
			include(get_stylesheet_directory() . '/woocommerce/cart/desktop-cart.php');
	    $cart_contents_desktop = ob_get_clean();
		
	// Get output from another file
	ob_start();
		include(get_stylesheet_directory() . '/woocommerce/cart/mobile-cart.php');
	$cart_contents_mobile = ob_get_clean();
 

	 // Prepare the email subject and message
    $subject .= 'Request A Quote';
 
	$message .= '<html>';
	$message .= '<head>';
	$message .= '<meta charset="UTF-8">';
	$message .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
	$message .= '<style>
								b { 
									display:block; 
								} 
								strong{
									display:none;
								}
							    @media screen and (max-width: 980px) { 
									b { 
										display:none; 
									} 
									strong{
										display:block;
									}
						}
						</style>';
	$message .= '</head>';
	$message .= '<body style="font-family: Arial, sans-serif; padding: 20px; background-color: #f8f8f8;">';
		$message .= '<b>';
				$message .= $cart_contents_desktop;
		$message .= '</b>';

		$message .= '<strong>';
					$message .= $cart_contents_mobile;
		$message .= '</strong>';
	
	
	$message .= '</body>';
	$message .= '</html>';

	 // Set the email headers to indicate HTML content
   	$headers[] = 'Content-Type: text/html; charset=UTF-8';

	$recipients = ['',''];
	// Send the email to multiple recipients
	$sent = wp_mail($recipients, $subject, $message, $headers);


	Use AI for WordPress Applications:
   
        * note - here are the core programming concepts:
	
	   Variables: Variables are used to store and manipulate data. They have a name, a type, and a value.


       Data Types: Data types define the kind of data that can be stored and manipulated. Common data types include 
       integers, floating-point numbers, strings, booleans, arrays, and objects.

       Data Structures: Data structures provide ways to organize and store data efficiently. Examples include 
       arrays, lists, stacks, queues, and trees.

       Algorithms: Algorithms are step-by-step procedures for solving specific problems. They define 
       the logic and sequence of operations to achieve a desired outcome.

       Functions: Functions are blocks of reusable code that perform specific tasks. They accept
       input parameters and can return values.

       Control Structures: Control structures determine the flow of execution in a program. They include 
       conditionals (if-else statements, switch statements), 
       loops (for loops, while loops), and branching (break, continue).

       Operators: Operators perform operations on data, such as
       arithmetic operations (+, -, *, /), logical operations (&&, ||, !), and comparison operations (>, <, ==).

       Input/Output: Input/Output (I/O) refers to the process of receiving input from the user or external
       sources and producing output. This can include
       reading/writing to files, printing to the console, or interacting with network services.

       Error Handling: Error handling involves identifying and dealing with errors or exceptions
       that may occur during program execution. This includes
       try-catch blocks, exception handling, and error messages.

       Modularization: Modularization involves breaking down a program into smaller, manageable modules or functions. 
       This promotes code reusability, maintainability, and readability.
	
	now it's a matter of just changing the syntax and language-specific features
	

	* two ways you can deal with reundancy:

	1. stored information in data structure then construct a loop
	2. create 'helper' methods to deal 
	3. include a file in a repeated loop
 	    - types of variables to use in a loop, 
       	a. count
		b. flag


	Questions to ask yourself:
 	1. What can be imporved aesthetically?
         i.e.
	  - are sections too busy (add white-space to break it up)
   	  - maybe turn sections into sliders or carousels?
          - change design from image based to css
	  - fonts can be changed to look cursive or artsy
   	  - color palette be changed to look more appealing?
      	  - maybe add motion to the graphics
  	2. Can the functionality be improved to help with conversions? i.e. page speed 
 
 
	main programming lanugages used for web:  
	
	client-side: HTML, CSS, JavaScript, 
	
	server-side: PHP, Python, Ruby, Java, C#, JavaScript

	basic question structure:
	
	{programming language}{framework-name}{requirements} where to include the files

	sample question:
	wordpress gutenburg wp.blocks.registerBlockType to create a new gutebnurg block
	with vanilla javascript that allows me to change text color


 	development:
	https://chat.openai.com/chat
 	https://claude.ai/


 	design: 
  	sample query: I want a 5 section landing page design and the category is ' automotive '
	https://wepik.com/ai-generate?prompt=



	https://themeisle.com/blog/chatgpt-alternative/#google-bard-alternative
 
	https://bard.google.com/
	https://app.writesonic.com/login
 
 	https://toolbaz.com/writer/chat-gpt-alternative





 
	
	*note - most plugins can usually be a single class (structure) file with 3-4 methods
 
       1) write method definintions that fulfill functional requirements
	2) encapsulate those methods in a class
 	3) start applying other O-O principals, such as 
   	inheritance and polymorphism to those class methods to help eliminate redundancy 
        and keep the code clean and organized.
     

	Example try catch block

	try {
	    // Code that may throw an exception

	    // Example: Division by zero
	    $result = 10 / 0;

	    // ... more code ...

	    // If an exception is thrown, the code below this line will not be executed
	    echo "This line will not be reached if an exception occurs.";
	} catch (Exception $e) {
	    // Handle the exception

	    // Example: Print the error message
	    echo "An exception occurred: " . $e->getMessage();
	}


Mac command to bypass content protect:

CMD + OPTION + I

WordPress Cookbooks: 

* Documentation: https://www.wpbeginner.com/wp-tutorials/how-to-move-live-wordpress-site-to-local-server/

* Recommend the WP-CLI over a GUI

* Documentation: https://wp-cli.org/
* https://developer.wordpress.org/cli/commands/

* note - IP address followed by port number for MySQL server in config

	PHP Compiler Online:

	https://www.w3schools.com/php/phptryit.asp?filename=tryphp_compiler


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

/* or */

define( 'DB_HOST', 'db.hosting-data.io' );

Import the .sql file from the root directory of the theme's folder, and then import via phpmyadmin (Unix Socket) and file upload, zip format perferred

Update your db with : 

UPDATE wp_options SET option_value = replace(option_value, 'http://www.example.com', 'http://localhost/test-site') WHERE option_name = 'home' OR option_name = 'siteurl';
  
UPDATE wp_posts SET post_content = replace(post_content, 'http://www.example.com', 'http://localhost/test-site');
  
UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://www.example.com','http://localhost/test-site');

- For a particular Plugin or Widget build - a directory will be specified in that folder

<div>Computer Networks:</div>
<div>*If pointing over from another remote host, be sure to swap put the "A" Records of the website. </div>

    Example:

    Site IP

    000.000.000.000
    
    Propegation Checker:

    https://www.whatsmydns.net/

    Check for register:
    
    https://www.whois.com/whois/{domain-name}

<div>The other DNS records are:</div>
<div>AAAA, CNAME, MX, NS, SOA, and TXT</div>


       Host company A) registrar
       Host company B) hosting package 
	
       could be a domain forward, if that is the case, then park the second domain 

	*files and database are in root domain


	DNS checklist:
 	1) Email - MX
  	2) Files
   	3) Database

	1. Is the domain used for email? Check DNS records for both hosting companies, register and hosting package
 	   If no, then just update DNS on new host
     	   If yes, login to their current hosting and recreate mx records from there 

	Cancel 2FA
	https://uk.godaddy.com/help/cancel-2-step-verification-7628


	SSL Auto Renew:
	https://www.a2hosting.com/kb/cpanel/cpanel-security-features/reconfiguring-autossl-on-domains/


	Type:	CNAME
	Name:	www
	Value:	domain.com
	



	Common DNS error message:

	Only one MX record can use the expected priority value.

	You can only have one spf record

	gmail:
 
 	TXT 	
	v=spf1 include:_spf.google.com ~all 
	
 
	Example MX Record:

	Name
	blank

	TTL
	24 hours


	Priority
	0

	Destination:

	url-com.mail.protection.outlook.com.

	Other Samples:

 	john.doe@domain.com


	If you ever need to verify that you are receiving emails, please check if your DNS settings match what's listed below.
	
	Log on to your hosting provider or third-party domain name system manager (usually the same place you bought your domain)

 	delete existing MX, add CNAME and TXT
 
	Locate the CNAMEs and set the following:
	Name	Target
	autodiscover	autodiscover.outlook.com
	email	email.secureserver.net
	
	Locate the MX and set the following:
	Host	Priority	Target
	@	0	domain-com.mail.protection.outlook.com
	
	Locate the TXT and set the following:
	Name	TXT Value
	@	NETORG1111111111.onmicrosoft.com
	@	v=spf1 include:secureserver.net -all
	
	Note: Making these changes means you'll stop receiving email to any account previously set up on this domain.
	Example: a2 and godaddy
 	domain is registered on godaddy, transferred to a2, 
  	so plugin in the two DNS records on godaddy from a2, plugin the 5 above mail records on a2 from godaddy


	* outlook has outgoing and incoming server ports to be set with mail.domain.com
 


    DNS Server examples:

    ns1.domain.net

    ns2.domain.net

    example 1:  
    
    web host 1 is godaddy
    web host 2 is network solutions
    web host 3 is a2

    domain is registered with godaddy, but files are on network solutions
    to not distrupt email service, create domain.com on a2 with same domain name, insert A record @ document root over on network solutions

    godaddy has network solutions dns records, but networks solutions has an A record that points to a2


    example 2:
    
    web host 1 is siteground
    web host 2 is hostgator
    
    domain is registered with siteground, but files are on hostgator
    not taking into account email service, create account on hostgator with same name and swap dns records over on siteground


    DNS servers change everything, just change A record @ root and www, ***take note of old dns before change 
    or re-create ALL DNS records


  	IP and Name Servers

	Site IP
	
	xx.xxx.xx.xxx
 
	
	Name Servers
	
	ns1.domain.net
	
	ns2.domain.net
    
    

	Create an invoice 
	
	1.https://app.invoicesimple.com
	2. [payp](https://www.paypal.com/)

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

[https://gpldl.com/](https://gpldl.com/premium-wordpress-woocommerce-for-free/)

https://www.gplplus.com/

https://codecanyon.net/tags/laravel

https://account.envato.com/google/authenticate?to=codecanyon

https://themeforest.net/

https://www.templatemonster.com/wordpress-themes.php

https://www.jqueryscript.net/

	Test Credit Card Numbers:

	https://developer.paypal.com/api/nvp-soap/payflow/payflow-pro/payflow-pro-testing/
	
	https://www.simplify.com/commerce/docs/testing/test-card-numbers
	
	5555 5555 5555 4444
	
	09/99

	999
	
	06010


Payment Gateway Reminders:


  1. Verfication code needed for api credentials
  2. Required billing input fields on web form (map the following fields in a stream)

     a) Email 	

     b) Address 	

     c) Address 2 	

     d) City 	

     e) State 	

     f) Zip 	

     g) Country 	

     h) Phone 


Popular Payment Gateways:

	https://www.paypal.com/signin
  
  	https://venmo.com/account/sign-in
	
	https://login.authorize.net/

 	Factor 4 Gift Cards

 	https://myprogramadmin.com/employee/sign-in

  	https://factor4gift.com/
	
	https://www.clover.com/dashboard/login
	
	https://dashboard.stripe.com/login
	
	https://squareup.com/login?return_to=%2Fhelp%2Fus%2Fen%2Farticle%2F5062-sign-in-and-out-of-square-point-of-sale
	
	
Shipping and Live Rates:

	* https://www.shipstation.com/
	* https://www.ups.com/us/en/global.page



	WordPress block data format:

	<!-- wp:block {"ref":1119} /-->

	<!-- wp:block {"ref":985} /-->
	




.htaccess reminders:


# How to force https connection 

	Before # BEGIN WordPress.
	RewriteEngine On
	RewriteCond %{HTTPS} !=on
	RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301,NE]
	Header always set Content-Security-Policy "upgrade-insecure-requests;"



<IfModule mod_rewrite.c>
  
      RewriteEngine On
  
      RewriteBase /

      RewriteCond %{HTTPS}        =on   [OR]
  
      RewriteCond %{HTTP_HOST}    !^domain\.com$
  
      RewriteRule ^(.*)$          "http://domain.com/$1" [R=301,L]

      RewriteRule ^index\.php$ - [L]
  
      RewriteCond %{REQUEST_FILENAME} !-f
  
      RewriteCond %{REQUEST_FILENAME} !-d
  
      RewriteRule . /index.php [L]
</IfModule>

https://www.lambdatest.com/

[https://appetize.io/demo?device=iphone14pro&osVersion=16.2&record=true](https://appetize.io/)

JS for different OS's

For others:

onClick="function()" 

For iOS:

ontouchstart="function()"

Import resources via CDN examples:

      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.swipebox/1.4.4/js/jquery.swipebox.min.js"></script>

       WP Example:
       
       action-> wp_enqueue_scripts
	
	// Fancybox Stylesheet
	wp_enqueue_style( 'fancybox-style', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );

	/// Fancybox Script
	wp_enqueue_script( 'fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '3.5.7', true );

	// bootstrap Stylesheet
	wp_enqueue_style( 'bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css' );

	/// Fancybox Script
	wp_enqueue_script( 'bootstrap-script-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js', array(), '3.5.7', true );
	
	
	***Download any here:

	https://cdnjs.com/libraries


Relevant Links:

* https://developers.google.com/speed/pagespeed/insights/
* https://accessibe.com/accessscan
* https://analytics.google.com/analytics/web/
  - mark-up up the product / service, each page has $ value
  >  Pages and screens: Page title and screen class 
* https://tagmanager.google.com/#/home
* https://search.google.com/search-console/welcome
  
* https://drive.google.com/drive/my-drive
* https://one.google.com/storage/management?utm_source=sheets&utm_medium=web&utm_campaign=editor_banner&utm_content=hard_cap

* https://myaccount.google.com/permissions
* https://console.developers.google.com/
* https://console.cloud.google.com/home/dashboard
* https://www.unixtimestamp.com/
* https://fontello.com/

////////////////////////////////////////////////////////

* https://rainstreamweb.com/
* https://www.alignable.com
* https://my.yoast.com/login
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
* https://gtmetrix.com/
* https://anywebp.com/convert-to-webp.html
* https://www.nslookup.io/website-to-ip-lookup/

SEO links:

https://web-toolbox.dev/en/tools/heading-extractor

https://www.semrush.com/


How to convert wordpress website to an Android or Apple app:

https://www.wpbeginner.com/showcase/best-plugins-to-convert-wordpress-into-mobile-app/

	Convert files to web pages:
	
	* https://www.online-convert.com

Other Links:
* https://www.cloudways.com/blog/post-smtp-mailer-fork-of-wordpress-postman-smtp-plugin/?id=339490

		-> https://console.cloud.google.com/home/dashboard
		-> SMTP Project
		-> APIs and Services -> Credentials
		-> Web Client 1 -> Edit
		-> Add URIs

How to:


	https://knowledge.workspace.google.com/kb/how-to-update-your-mx-records-to-work-with-gmail-000005563
 
	1. Create new project here: https://console.cloud.google.com/
	
	2. Install Gmail API
	
	3. Default email server: smtp.gmail.com
	
	3. Get credentials for the following
		a)  Authorized JavaScript origins 
		b)  Authorized redirect URIs 
		c)  Client ID
		d)  Client secret
		
	4. Publish Gmail App -  OAuth consent screen 	


	Or through web host:

	Create a new email account:

	Incoming Server: / Outgoing Server: mail.domain.com
	SMTP Username: johndoe
	SMTP Email: password
 
 	Encryption: None
	Authentication: On
 	Auto TLS Off
 
 
	SMTP Port: 587
	IMAP Port: 993
 	POP3 Port: 995

	web form from email address:
	admin@domain.com


	* test smtp connection: https://www.gmass.co/smtp-test
 
	* https://mxtoolbox.com/
	Example SPF, DKIM, MX, CNAME, DMARC records:

	SPF:

	Name:
	domain.com.

	value:
	v=spf1 +ip4:xx.xx.xx.xx +include:spf.a2hosting.com +include:secureserver.net -all

	DKIM:
	Name:
	default._domainkey.domain.com.

	value:
	v=DKIM1; k=rsa; p=xxxxxxxxxxxxx;
	
	Type:
	CNAME

	value:
	domain.com
	
	Type:
	MX
	
	Value:
	Priority: 0
	Destination: mail.omittinnovativesolutions.org


	DMARC:
	
	 _dmarc.domain.org.

	v=DMARC1; p=none; fo=1; rua=mailto:info@domain.org 



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
* https://www.sejda.com/sign-pdf
* https://products.aspose.app/words/replace/pdf
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
* https://videocandy.com/compress-video.html
* https://online-video-cutter.com/
* https://products.aspose.app/words/parser
* https://www.desmos.com/scientific
* https://www.omnicalculator.com/other/aspect-ratio
* https://www.canva.com/
* https://www.image-map.net/
* https://onlinetexttools.com/extract-text-from-html
* https://brandfolder.com/workbench/extract-text-from-image
* https://codepen.io/jpgninja/full/RMNdNM/
* https://cornercase.info/common-divi-icons/
* https://www.elegantthemes.com/blog/resources/elegant-icon-font
* https://www.sodawebmedia.com/insights/how-to-create-a-wordpress-account-via-mysql/
* https://login.mailchimp.com/
* https://www.docfly.com/pdf-form-creator
* https://www.figma.com/
* https://www.photopea.com/
* https://cleanup.pictures/
* https://wellsaidlabs.com/
* https://fonts.google.com/
* https://products.aspose.app/cells/conversion/sql-to-excel
* https://developers.facebook.com/tools/debug/
* https://www.the-qrcode-generator.com/
* https://loading.io/
* https://www.pdf2go.com/
* https://samplelib.com/sample-mp4.html

	For video editing:
	* note - speed up motion, crop out audio
	* https://clideo.com/editor/


		Mailchimp
		
		Login -> Email Templates -> Edit Arrow -> Create Campaign


		How to change account settings:

		reseller WHM > Account functions > Modify an account : and updated Max SQL Databases limit to 5. 
		

		How to add custom fonts to divi:

		https://www.villeteikko.com/custom-fonts-divi/
		

		Upload .otf file:

		https://www.fontsquirrel.com/tools/webfont-generator


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

	Regular Expression Redirect:
	
	https://isaac.tips/redirect-urls-using-regex/

	^/product/(.*)
	https://www.domain.com/page


    PHP Time Zones:

    https://www.php.net/manual/en/timezones.php
    
    example: 
    
    $date = new DateTime("now", new DateTimeZone('time_zone') );
	  
    $full_date = $date->format('Y-m-d H:i:s');

    echo $full_date;
    
    How to format object output:
    example:

    $sql_users = $wpdb->prepare(
		"
  
  		SELECT
			*
		FROM table 1
		JOIN table 2
		LEFT JOIN table 3
		WHERE orders.post_type IN ('shop_order', 'shop_order_refund')
		AND (orders.post_status = 'wc-processing' OR orders.post_status = 'wc-completed')
		AND user_meta.meta_key = '_customer_user'
		AND user_meta.meta_value = %d
		AND DATE(orders.post_date) >= DATE(CONCAT(YEAR(CURDATE()), '-01-01'))
		GROUP BY order_id, order_date, user_id, order_value
		ORDER BY order_date DESC
  
  		",
		$user_id

  		
	);

	$results_users = $wpdb->get_results($sql_users);
	
	 echo '<pre>';
		print_r($results_users);
	 echo '</pre>';


	    $obj = new my_class(); 
		
	     echo '<pre>';
	        print_r($obj);
	     echo '</pre>';

//////////////////////////////

Learning resources:

https://www.khanacademy.org/computing/computer-programming

https://www.linkedin.com/learning/topics/python


Other Popular CMS systems:

Joombla - https://downloads.joomla.org/us/

Drupal - https://www.drupal.org/download

Zen Cart - https://www.zen-cart.com/index.php

debug: /public_html/store/logs/myDEBUG-1608266247-976821.log


Open Cart -  https://www.opencart.com/



Woocommerce template structure: 

https://docs.woocommerce.com/document/template-structure/

Woocommerce hook list:

https://premmerce.com/woocommerce-hooks-guide/


	Web Servers:
	
	careful with server requests:
	
	the admin-ajax.php is getting hammered by a high amount of requests, 
	
	CPU usage gets maxed out



1. Apache

2. Internet Information Services (IIS) - Windows Server

3. nginx


Public Folder / File Permission

776


JavaScript - client-side(DOM manipulations) and server-side(database operations etc...)

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

https://www.smarterasp.net/index

https://aws.amazon.com/account/

https://s3.console.aws.amazon.com/s3/buckets?region=us-east-1
