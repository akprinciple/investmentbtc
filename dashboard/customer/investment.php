<?php
  include('inc/session.php'); 

   // For Investment 
   if (isset($_POST['submit'])) {
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $amount = mysqli_real_escape_string($connect, $_POST['amount']);
    $user_id = $_SESSION['id'];
    $date = date('Y-m-d');
    $time = date('h:i:sa');

   // String of all alphanumeric character
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  // $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

// Shuffle the $str_result and returns substring
// of specified length
    $investment_id = '#'.substr(str_shuffle($str_result),0, 10);
    $select = mysqli_query($connect, "SELECT balance FROM wallet WHERE user_id = '{$_SESSION['id']}'");
    $rw = mysqli_fetch_array($select);
    $balance = $rw['balance'];
    if ($password != $_SESSION['password']) {
      echo "<script> alert('Wrong Password')</script>";
    }
    elseif ($balance < $amount) {
      echo "<script> alert('You do not have enough amount in your wallet!')</script>";
    }
    else{
      
        $updated = mysqli_query($connect, "INSERT INTO investment(user_id, amount, investment_id, date, time) VALUES ('$user_id', '$amount', '$investment_id', '$date', '$time')");
      if ($updated) {
        $subtract = mysqli_query($connect, "UPDATE wallet SET balance = balance-'$amount' WHERE user_id = '{$_SESSION['id']}'");
          echo "<script> alert('Thank you for investing. Your investment will last for 30 days.')</script>";
      }else{
           echo "<script> alert('The system encountered an error. Please try again later.')</script>";
           }
          }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'inc/toplink.php'; ?>
	
	<title>Profit History</title>
</head>
<body>
	
	<?php require 'inc/header.php'; ?>
<main>
<div class="mt-4">	
<button class="btn btn-success mr-4" style="float: right" onclick="import_csv()">Click to Invest</button>
<div style="clear: both"></div>

<p>
    <form method="post" enctype="multipart/form-data" class="col-md-9 mx-auto bg-white mt-3 p-3" style="display: none;" id="importer">
      
        <div class="col-md-12 text-center mb-3 border-bottom border-success">
          <h3 class="text-center">Invest Now</h3>
        </div>

        <div class=" col-md-12 mb-3">
            <label for="exampleInputEmail" class="font-weight-bold">Investment Plan</label>
            <select name="amount" class="form-control" id="">
                <option disabled selected>Select Investment Plan</option>
                <option value="500">$500</option>
                <option value="1000">$1000</option>
                <option value="1500">$1500</option>
                <option value="2000">$2000</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
        <label for="address">Input Password to confirm</label>
        <input type="password" name="password" class="form-control mb-2" placeholder="Input Password to confirm">

        </div>
        
        <div class="mr-2 mb-3 ">
            <button name="submit" type="submit" class="btn btn-block btn-success  btn-lg font-weight-medium auth-form-btn" >Submit</button>
        </div>
    </form>
  </p>
</div>
<h1>Deposit History</h1>
 <!--  Transactions -->
 <?php
    $sql = mysqli_query($connect, "SELECT * FROM investment WHERE user_id = '{$_SESSION['id']}' ORDER BY id DESC");
   $n = 1;
    ?>
    <table class="table table-hover table-responsive">
                      <thead>
                        <tr>
                          <th>S/N</th>
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