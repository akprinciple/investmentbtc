<?php
  include('inc/session.php'); 

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'inc/toplink.php'; ?>
	
	<title>Investment</title>
</head>
<body>
	
	<?php require 'inc/header.php'; ?>
<main>



</div>
<h1>Deposit History</h1>
 <!--  Transactions -->
 <?php
    $sql = mysqli_query($connect, "SELECT * FROM investment ORDER BY id DESC");
   $n = 1;
    ?>
    <table class="table table-hover table-responsive">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Email</th>
                          <th> Investment Id </th>
                          <th> Amount (USD) </th>
                          <th> Date | <span class="text-primary">Time</span> </th>
                          <th>Days left</th>
                          <th>Status</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                         if ($sql ->num_rows<1) {
       
    
                          ?>
                        <div class="col-md-3 mx-auto text-center">
                            <img src="../../img/found.jpg" class="w-100">
                            <span class="text-muted">Nothing is here</span>
                        </div>
                        
                          <?php }else{
                        foreach($sql AS $key){
                        ?>
                        <tr>
                          <td><?php echo $n++; ?></td>
                          <td>
                          <?php
                              $query = mysqli_query($connect, "SELECT * FROM users WHERE id = '{$key['user_id']}'");
                              foreach($query AS $row){
                              echo $row['email'];
                              }
                              ?>
                          </td>
                          <td>
                            <?php echo $key['investment_id']; ?>
                            
                          </td>
                          <td>
                              <?php echo $key['amount'];
                               
                               ?>
                        </td>
                        <td><?php echo $key['date']." | ".$key['time']; ?></td>
                          <td>
                            <?php
                                $activation_date = date_create($key['date']);
                                $date = date("d-M-Y");
                                // echo $date;
                                $today = date_create($date);
                          
                                $diff = date_diff($activation_date,$today);
                                $days = 30-$diff->format("%R%a");
                                if ($days > 0) {
                                    echo $days;
                                }else{
                                    echo 0;
                                }
                                
                            ?>
                        </td>
                          <td>
                            
                          <?php 
                           if ($days > 0) {
                               echo $key['status']; 
                        }else{
                            echo "Off";
                        }
                        ?>
                          </td>
                          
                        </tr>
                        <?php } ?>
                       
                    
    </table>
  <?php } ?>
  
</div>

 </main>

		<!-- MAIN -->
	<!-- NAVBAR -->

	<?php require 'inc/footlink.php'; ?>
	
</body>
</html>
<script>
function myFunction() {
  // Get the text field
  var copyText = document.getElementById("wallet");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
  
  // Alert the copied text
  alert("Copied the text: " + copyText.value);
}
</script>
<script type="text/javascript">
    function import_csv() {
        var element = document.getElementById('importer');
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>