<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <a href = "https://domain.com/dashboard/customers/">CLICK HERE</a> to go back to admin dashboard
<div id="section-0">
	<div class="container">
      <div class="page_content">
      <section class="site-main fullwidth">               
<h1 class="entry-title">Customers</h1>                                
<div class="entry-content">
<div class="admin-process">
    
  
<div id = 'customer-wrapper'>
<table width="100%" class="tablesorter">
<thead>
<tr>
<th>ID</th>
<th>username</th>
<th>Set Approved Status</th>
<th>Is Approved?</th>
</tr>
</thead>
<tbody>
<?php

// Database Connection
$db_server='localhost';
$db_user='halalmobilekitch_msuser';
$db_pass='maDItOhDPf2b';
$db_database='halalmobilekitch_mainsite';
    
// start connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_database);

//$sql = "SELECT * FROM cal_users ORDER BY uid DESC; ";


$sql = "SELECT *
FROM cal_users
JOIN customers
ON cal_users.username = customers.uname
ORDER BY uid DESC
";

$result = mysqli_query($conn, $sql); 



while ($row = mysqli_fetch_assoc($result)) { 
        $uID = $row["uid"];
        $username=$row["company_name"];

            echo "
                <tr class = ''>
                 <td>". $uID ."</td>
                 <td>". $username ."</td>
                 <td><select name='approved-select' id = 'select-approve'>
                    <option value='' disabled selected>Select an option</option>
                      <option value='1'>Approved</option>
                      <option value='0'>Not Approved</option>
                    </select>
                    <input type='hidden' id = 'client_ID' name='client_ID' value=". $uID .">
                    <div id='data-table'>
                    </div>
                    <script>
                    $(document).ready(function() {
                      $('#customer-wrapper #select-approve').on('change', function() {
                          var selectedOption = $(this).val();
                          var hiddenID = $(this).siblings('#client_ID').val();
                         
                        $.ajax({
                          url: 'https://domain.com/get_data.php',
                          type: 'POST',
                          data: { 
                            option: selectedOption,
                            hiddenID: hiddenID,
                          },
                          success: function(data) {
                            $('#data-table').html(data);
                          }
                        });
                      });
                    });
                    </script>
                </td>
                 <td class = ''>
                 <div>".($row["is_approved"] == '1' ? 'Approved' : 'Not Approved')."
                 
                 </div></td>
                 "; 
            echo "</tr>
";
}
?>







</tbody>
</table>
</div>




</div>
</div><!-- entry-content -->
</section>
</div><!-- .page_content --> 
 </div><!-- .container --> 
 </div>