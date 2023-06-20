<?php

session_start();

// Retrieve the username submitted by the user
$username = $_POST['username'];

//echo $username;

$db_server='localhost';
$db_user='halalmobilekitch_msuser';
$db_pass='maDItOhDPf2b';
$db_database='halalmobilekitch_mainsite';
    
// Connect to the database
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_database);
$query = "SELECT * 
          FROM cal_users 
          WHERE username='".$username."'
          AND is_approved = 1 
          LIMIT 1";

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 1) {
        header('Location: /bookings');
        exit;
}else{
        echo 'Not Authorized to View Calendar';
        echo '<br><br>';
        echo '<a href = "/calendar-login.php">Click here</a> to go back to login form';
        echo '<br><br>';
        echo '<a href = "/">Click here</a> to go back to home page';
        exit;
}














