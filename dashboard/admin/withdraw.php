<?php
  include('inc/session.php'); 
  if (isset($_POST['submit'])) {
    $identity = $_POST['id'];
    $user = $_POST['user_id'];
    $stat = $_POST['status'];
 
    
    if ($stat == "delete") {
          
          $approve = mysqli_query($connect, "DELETE FROM withdrawal WHERE id = '$identity'");
          if ($approve) {
        echo "<script> alert('Withdrawal Request Successfully Deleted')</script>";
        echo "<script>setTimeout(function(){window.location='cashout'}, 100)</script>";
        
          }
      }else{
        $approval= mysqli_query($connect, "UPDATE withdrawal SET status ='$stat' WHERE id = '{$identity}'");
        if ($stat == "approved"){
          $amount = $_POST['amount'];
          $up =  mysqli_query($connect, "UPDATE wallet SET balance = balance-'$amount' WHERE user_id = '{$user}'");
        }
        if ($approval) {
            echo "<script> alert('Action was Successful')</script>";
              }
              
       } 
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'inc/toplink.php'; ?>
	
	<title>Withdrawal Request</title>
</head>
<body>
<?php require 'inc/header.php'; ?>
<main>

<h4 class="mt-3">Withdrawal History</h4>
<?php
    $sql = mysqli_query($connect, "SELECT * FROM withdrawal ORDER BY id DESC");
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
                          <th>User Email</th>
                          <th>Wallet Address </th>
                          <th> Amount </th>
                          <th>Wallet Balance</th>
                          <th> Date | <span class="text-primary">Time</span> </th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $n =1;
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
                            
                          <td class="py-1">
                            <?php
                               echo  $key['account']; 
                            ?>
                            
                          </td>
                          <td>$<?php
                                echo number_format($key['amount'],2);
                          ?></td>
                          <td>
                              $<?php
                                  $query = mysqli_query($connect, "SELECT * FROM wallet WHERE user_id = '{$key['user_id']}'");
                                  foreach($query AS $row){
                                  echo number_format($row['balance'],2);
                                  }
                                  ?>
                              </td>
                          <td><?php echo $key['date']." | ".$key['time']; ?></td>
                          
                          <td>
                            
                            <?php echo $key['status']; ?>
                          </td>
                          <td>
                          <?php if($key['status']=='pending'){ ?>
                          <form method="post">
                        <input type="hidden" name="id" value="<?php echo $key['id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $key['user_id']; ?>">
                        <input type="hidden" name="amount" value="<?php echo $key['amount']; ?>">
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" name="submit" class="btn btn-success">Approve</button>
                     </form>
                     <?php } ?>
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