https://www.md5hashgenerator.com/


  $pass = 'password';
	
	$salt = 's+(_a*';
	$pass = md5($pass.$salt);



https://www.devglan.com/online-tools/aes-encryption-decryption
256 bits
CBC Mode


Key: ? 

* note if SSL expires on site or if domain chamges, apps are going to have to be reconnected to site, example, shipstation


How to add recaptca v3 to a web form to help prevent carding attack:

https://cloud.google.com/recaptcha-enterprise/docs/instrument-web-pages
https://www.youtube.com/watch?v=nzj4VZD0Xik


https://wpforms.com/docs/setting-up-akismet-anti-spam-protection/


$encrypt_key_1='qJgscx9OSrv7F7Ed50o0LN1XhTlOxhW4';
$encrypt_key_2='i3LCWT07vnilpZ1oQZmrNAZoYK90CvJ3';
$encrypt_key_3='2YIh4DctaAipjQ6OFLxKzdFceHzaEiom';



function login($post) {
	global $site_ID;


	#$sql="SELECT uname, upass, uqID, ID, is_admin  FROM customers WHERE uname='".escape($post['username'])."' LIMIT 1";
	
	$sql="SELECT `uname`, `upass`, `uqID`, `ID`, `is_admin`
	FROM `customers` 
	WHERE `upass` = '".escape($post['password'])."' 
	AND `uname` = '".escape($post['username'])."' LIMIT 1";
	
	//print_r($sql);
	
	$return=query($sql);
	$test = $return[0]['upass'];
	
	if (count($return) > 0) {
	#$s=runDecryptionProtocol($return[0]['uqID']);
	#$p=decrypt($return[0]['upass'], $s);
	
	if ($test == $post['password']) {
	$_SESSION['logged_in']=true;
	$_SESSION['is_admin']=$return[0]['is_admin'];
	$_SESSION['member_id']=$return[0]['ID'];
	return 1;	
	} else {
	return 0;	
	}
}


}


function encrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
}
 
function decrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
	
}

function runDecryptionProtocol($uqID) {
    global $encrypt_key_1;
    global $encrypt_key_2;
    global $encrypt_key_3;	
    	// To retrieve the value, take the key in the customer uqID and decrypt using key 1 and re-encrypt usig key 2, search salt database using new encrypted key 
    	//and the take the  return value and decrypt using key 3. That value is now your salt to decrypt information with.
    
    $uqID_decrypt=decrypt($uqID, $encrypt_key_1);
    
    $salt_srch=$uqID_decrypt;
    $sql="SELECT s FROM ss WHERE uID='".escape($salt_srch)."' LIMIT 1";
    
    $return=query($sql);
    $salt=decrypt(decrypt($return[0]["s"], $encrypt_key_3),$encrypt_key_2);
    return $salt;
}


$db_server = 'xxx';
$db_user = 'xxx';
$db_pass = 'xxx';
$db_database = 'xxx';

// Start the connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$uqIDs = array();

// Execute the query to fetch uqID values
$query = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if ($result) {
    // Create an HTML table
    echo '<table>';
    echo '<tr>
        <th style = "text-align: left;">First Name</th>
        <th style = "text-align: left;">Last Name</th>
        <th style = "text-align: left;">Username</th>
        <th style = "text-align: left;">Password</th>
	<th style = "text-align: left;">MD5</th>
        <th style = "text-align: left;">Email</th>
        <th style = "text-align: left;">Phone</th>
    </tr>';

    // Fetch the rows and display in the table
    while ($row = mysqli_fetch_assoc($result)) {
        $uqID = $row['uqID'];

        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $uname = $row['uname'];
        $password = $row['upass'];
        
        $email = $row['email'];
        $phone = $row['phone'];
        
        $decryptedValue = runDecryptionProtocol($uqID);
        $password = decrypt($password, $decryptedValue);
        $email = decrypt($email, $decryptedValue);
        $phone = decrypt($phone, $decryptedValue);
        $hash = md5($password);
        
        
        
        echo '<tr>';
        
        echo '<td>' . $first_name . '</td>';
        echo '<td>' . $last_name . '</td>';
        echo '<td>' . $uname . '</td>';
        echo '<td>' . $password . '</td>';
	echo '<td>' . $hash . '</td>';
        echo '<td>' . $email . '</td>';
        echo '<td>' . $phone . '</td>';
        
        echo '</tr>';
    }

    // Close the HTML table
    echo '</table>';

    // Free the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($conn);




server-side security:

    Keep WordPress Core, Themes, and Plugins Updated: Regularly update all components of your WordPress installation to the latest versions. Outdated software is often vulnerable to attacks.

    Strong Passwords: Ensure that you and your users use strong and unique passwords. Weak passwords can be easily exploited by hackers.

    Limit Login Attempts: Implement restrictions on the number of login attempts to prevent brute-force attacks.

    Secure File Permissions: Set appropriate file and directory permissions to prevent unauthorized access to critical files.

    Disable Directory Listing: Make sure directory listing is disabled to prevent exposing sensitive information.

    Use HTTPS: Encrypt data transmitted between the server and clients by using HTTPS.

    Protect WP-Admin: Restrict access to the WP-admin directory by IP or via HTTP authentication.

    Protect wp-config.php: Move the wp-config.php file one directory above the WordPress root and restrict access to it.

    Disable XML-RPC: If not needed, disable XML-RPC as it can be a target for some attacks.

    Implement Web Application Firewall (WAF): Set up a WAF to filter and block malicious traffic before it reaches your server.

    Regular Backups: Regularly back up your website to a secure location to ensure quick recovery in case of a security breach.

By implementing these server-side security measures, you can significantly enhance the security of your WordPress website without relying on additional plugins.






