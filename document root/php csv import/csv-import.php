<?php

// cal_events
// cal_occurances

// Get the current date and time as a string
$current_date_string = date('Y-m-d H:i:s');

// Create a new DateTime object from the current date/time string
$current_datetime = new DateTime($current_date_string);

// Display the current date/time in a different format
$time = $current_datetime->format('Y-m-d H:i:s');

// Database Connection
$db_server='localhost';
$db_user='halalmobilekitch_msuser';
$db_pass='maDItOhDPf2b';
$db_database='halalmobilekitch_mainsite';
    
// start connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_database);

// Query the database to get the maximum value of the column
$max_query = mysqli_query($conn, "SELECT MAX(`eid`) AS max_value FROM cal_events");
$max_row = mysqli_fetch_assoc($max_query);
$max_value = $max_row['max_value'];

// Increment the maximum value by 1
$next_eid = $max_value + 1;


// Query the database to get the maximum value of the column
$max_query1 = mysqli_query($conn, "SELECT MAX(`oid`) AS max_value FROM cal_occurrences");
$max_row1 = mysqli_fetch_assoc($max_query1);
$max_value1 = $max_row1['max_value'];

// Increment the maximum value by 1
$next_oid = $max_value1 + 1;


// Check if a file was uploaded
if(isset($_FILES['csv_file'])) {
//if(isset($_POST['submit'])) {
    // Check if the file is a CSV file
    $file_ext = strtolower(pathinfo($_FILES['csv_file']['name'], PATHINFO_EXTENSION));
    if($file_ext != "csv") {
        $error_msg = "Please upload a CSV file.";
    }
    else {
        // Open uploaded CSV file with read-only mode
        $file = fopen($_FILES['csv_file']['tmp_name'], "r");

        // Skip the header row
        fgetcsv($file);

    

        // Check if the connection to the database was successful
        if(!$conn) {
            $error_msg = "Could not connect to database: " . mysqli_connect_error();
        }
        else {
             // Loop through the CSV rows
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                // Escape special characters and insert the data into the first table
                // 10 columns
                // mysqli_real_escape_string($conn, $data[7]) . "', '" .
                //old:
                // $data[3]
                // $data[4]
                // $data[14]
                // $data[15]
                
                 // $data[0]
                 // $data[1]
                 // $data[2]
                 // $data[3]
                 
                 
               $sql1 = "INSERT INTO cal_events (eid, cid, owner, subject, description, readonly, catid, ctime, mtime, full_booking) VALUES ('" . mysqli_real_escape_string($conn, $next_eid++) . "', '" . mysqli_real_escape_string($conn, 1) . "', '" . mysqli_real_escape_string($conn, 1) . "', '" . mysqli_real_escape_string($conn, $data[0]) . "', '" . mysqli_real_escape_string($conn, $data[1]) . "', '" . mysqli_real_escape_string($conn, 0) . "', '" . mysqli_real_escape_string($conn, 1) . "', '" . mysqli_real_escape_string($conn, $time) . "', '" . mysqli_real_escape_string($conn, NULL) . "', '" . mysqli_real_escape_string($conn, 1) . 
               
               
               
               "')";
               
                $start_date = $data[2];
                $end_date = $data[3];
                
                $sql = "SELECT * FROM cal_occurrences WHERE start_ts = '$start_date'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo 'Some of the times have been taken, records have been skipped';
                    echo '<br>';
                    continue;
        
                }
               
                if(!mysqli_query($conn, $sql1)) {
                    $error_msg = "Error inserting row into first table: " . mysqli_error($conn);
                    break;
                }
                // Create a DateTime object from the datetime string
                $datetime_str = $data[2];
                $datetime_str2 = $data[3];
                $datetime = new DateTime($datetime_str);
                $datetime2 = new DateTime($datetime_str2);
                
                // Extract the date as a string in 'Y-m-d' format
                $date_str_start = $datetime->format('Y-m-d');
                $date_str_end = $datetime2->format('Y-m-d');
                
                // Escape special characters and insert the data into the second table
                $sql2 = "INSERT INTO cal_occurrences (oid, eid, start_date, end_date, start_ts, end_ts, time_type) VALUES ('" . mysqli_real_escape_string($conn, $next_oid++) . "', '" . mysqli_real_escape_string($conn, ($next_eid-1)) . "', '" . mysqli_real_escape_string($conn, $date_str_start) . "', '" . mysqli_real_escape_string($conn, $date_str_end) . "', '" . mysqli_real_escape_string($conn, $data[2]) . "', '" . mysqli_real_escape_string($conn, $data[3]) . "', '" . mysqli_real_escape_string($conn, 0) . 
                
                
                
                "')";
                
                
                
                if(!mysqli_query($conn, $sql2)) {
                    $error_msg = "Error inserting row into second table: " . mysqli_error($conn);
                    break;
                }
                
                
            }

            // Close the CSV file and database connection
            fclose($file);
            mysqli_close($conn);

            // Check if there was an error inserting a row
            if(isset($error_msg)) {
                $error_msg = "Data could not be imported: " . $error_msg;
            }
            else {
                echo 'Data import successful';
                echo '<br>';
                echo '<a href = "https://halalmobilekitchen.com/dashboard">Click here</a> to go back to admin dashboard';
                // Redirect to a success page
                //header("Location: success.php");
                exit;
            }
        }
    }

    // If there was an error, display the error message
    if(isset($error_msg)) {
        echo $error_msg;
    }
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>CSV File Upload</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <?php
        /*
        $date = '2023-05-04 10:00:00';
        
        $sql = "SELECT * FROM cal_occurrences WHERE start_ts = '$date'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo 'Time has been taken, please select another slot';

        }
      */
        ?>
        <a href = "https://halalmobilekitchen.com/example-halal.csv">CLICK HERE</a> to download sample csv file for review to see how data has to be formatted
        <br> <br>
        <a href = "https://halalmobilekitchen.com/dashboard">CLICK HERE</a> to go back to admin dashboard
        <div class = "">
            Here is an example date time following military time  - 
            2023-05-22 9:34:52<br><br>
            YYYY-MM-DD HH:MM:SS<br><br>
            This is for 9:34:52 AM<br><br>
            
            <!--Fields that say 'leave empt'y are to be left alone<br><br>
            Only field values changed from sample should be 'subject', 'description', 'start_ts', and 'end_ts'<br><br>-->
        </div>
       
        <label for="csv_file">Choose a CSV file to upload to calendar:</label>
        <input type="file" name="csv_file" id="csv_file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
