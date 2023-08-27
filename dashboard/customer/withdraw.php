<?php
  include('inc/session.php'); 

   // For Crypto withdrawal request 
   if (isset($_POST['send'])) {
    $account = mysqli_real_escape_string($connect, $_POST['wallet']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $amount = mysqli_real_escape_string($connect, $_POST['amount']);
    $user_id = $_SESSION['id'];
    $date = date('d/M/Y');
    $time = date('h:i:sa');
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
      $updated = mysqli_query($connect, "INSERT INTO withdrawal(user_id, account, amount, date, time) VALUES ('$user_id', '$account', '$amount', '$date', '$time')");
      if ($updated) {
          echo "<script> alert('Withdrawal Request was successfully submitted. We will get back to you as soon as possible.')</script>";
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
	
	<title>Deposit</title>
</head>
<body>
<?php require 'inc/header.php'; ?>
<main>
<button class="btn btn-success mr-4" style="float: right" onclick="import_csv()">Withdraw</button>
<div style="clear: both"></div>

<div id="fetch" class="w-100" style=" display: none;">
  
  <div class="col-md-9 mx-auto bg-white rounded p-0 mt-5">
    <h4 class="text-center px-2 pt-3">Cash Out to Bitcoin Wallet</h4> 
    <hr>
      <form action="" method="post" class="p-3">

      <label for="">Payout Wallet</label>
        <select name="" id="" class="form-control mb-2">
          <option value="">Bitcoin</option>
        </select>

        <label for="">Amount($)</label>
        <input type="number" min="100" step=".01" name="amount" required id="" class="form-control mb-2" placeholder="Amount in USD">

        <label for="">Wallet Address </label>
        <input type="text"  name="wallet" required id="" class="form-control mb-2" placeholder="Wallet Address">

       
        <label for="address">Input Password to confirm</label>
        <input type="password" name="password" class="form-control mb-2" placeholder="Input Password to confirm">

        
        <span id="clear"><button type="button" class="btn-dark btn">Cancel</button></span>
        <button type="submit" name="send" class="btn-primary btn">Send</button>
        
      </form>
  </div>
</div>

</div>
<h4 class="mt-3">Withdrawal History</h4>
<?php
    $sql = mysqli_query($connect, "SELECT * FROM withdrawal WHERE user_id = '{$_SESSION['id']}'");
    if ($sql ->num_rows<1) {
       
    
  ?>
<div class="col-md-3 mx-auto text-center">
    <img src="../../img/found.jpg" class="w-100">
    <span class="text-muted">Nothing is here</span>
</div>

  <?php }else{ ?>
    <table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th> Account </th>
                          <th> Amount </th>
                          <th> Date | <span class="text-primary">Time</span> </th>
                          <th>Status</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $n =1;
                        foreach($sql AS $key){
                        ?>
                        <tr>
                          <td><?php echo $n++; ?></td>
                          <td class="py-1">
                            <?php
                               echo  $key['account']; 
                            ?>
                            
                          </td>
                          <td>$<?php
                                echo number_format($key['amount'],2);
                          ?></td>
                          <td><?php echo $key['date']." | ".$key['time']; ?></td>
                          
                          <td>
                            
                            <?php echo $key['status']; ?>
                          </td>
                          
                        </tr>
                        <?php } ?>
                       
                    
    </table>
  <?php } ?>
</main>
                          
<!-- MAIN -->
<!-- NAVBAR -->

<?php require 'inc/footlink.php'; ?>

</body>
</html>
<script type="text/javascript">
    function import_csv() {
        var element = document.getElementById('fetch');
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>