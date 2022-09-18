<?php

# Every class should have a single purpose, all of it's functions satisfying a single goal	
# SIMPLE design pattern, amongst others
# algorithmic run time efficiency

class database {
    public function databaseFunctions() {
		
        global $wpdb;
		
		// use prepare for cybersecurity
		$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM testblob"));

if(!empty($results))                        // Checking if $results have some values or not
{    
    echo "<table width='100%' border='0'>"; // Adding <table> and <tbody> tag outside foreach loop so that it wont create again and again
    echo "<tbody>";      
	
	//this just prints out in a table, perhaps learn to do more with the MySQL DB
    foreach($results as $row){   
		
    $userip = $row->image_id;               //putting the user_ip field value in variable to use it later in update query
    
	echo "<tr>";                           // Adding rows of table inside foreach loop
		
	// have the nodes point to table fields in the MySQL database	
    echo "<th>ID</th>" . "<td>" . $row->image_type . "</td>";
    echo "</tr>";
    echo "<td colspan='2'><hr size='1'></td>";
    echo "<tr>";        
    echo "<th>User IP</th>" . "<td>" . $row->image . "</td>";   //fetching data from user_ip field
    echo "</tr>";
    echo "<td colspan='2'><hr size='1'></td>";
    echo "<tr>";        
    echo "<th>Post ID</th>" . "<td>" . $row->post_id . "</td>";
    echo "</tr>";
    echo "<td colspan='2'><hr size='1'></td>";
    echo "<tr>";        
    echo "<th>Time</th>" . "<td>" . $row->time . "</td>";
    echo "</tr>";
    echo "<td colspan='2'><hr size='1'></td>";
    }
    echo "</tbody>";
    echo "</table>"; 

}	
    }   
}










