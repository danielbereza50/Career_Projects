<?php
//echo 'ffffff';

// Database Connection
$db_server='localhost';
$db_user='halalmobilekitch_msuser';
$db_pass='maDItOhDPf2b';
$db_database='halalmobilekitch_mainsite';
    
// start connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_database);

echo $selectedOption = $_POST['option'];
echo '   ';
echo $ID = $_POST['hiddenID'];

//$sql = "SELECT * FROM `customers`;";
//$sql = "UPDATE customers SET is_approved = '0' WHERE id = 244; ";


//$sql1 = "UPDATE customers SET is_approved = '" . $selectedOption . "' WHERE id = " . $ID;
//$result1 = mysqli_query($conn, $sql1);

$sql2 = "UPDATE cal_users SET is_approved = '" . $selectedOption . "' WHERE uid = " . $ID;
$result2 = mysqli_query($conn, $sql2);


// Check for errors and process the result set
if (!$result2) {
    echo "Error: " . mysqli_error($conn);
} else {
    while ($row = mysqli_fetch_assoc($result2)) {
        // Do something with the data in $row
    }
}

// Close the database connection
mysqli_close($conn);



?>
<script>

location.reload();

</script>
