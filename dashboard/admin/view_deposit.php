<?php
  include('inc/session.php'); 
  if (isset($_POST['submit'])) {
    $identity = $_POST['id'];
    $stat = $_POST['status'];
    
    if ($stat == "delete") {
          $app = mysqli_query($connect, "SELECT * FROM transactions WHERE id = '$identity'");
          $row = mysqli_fetch_array($app);
          $image = $row['image'];
          if ($image != "") {
            unlink("../images/$image");
          }
          $approve = mysqli_query($connect, "DELETE FROM transactions WHERE id = '$identity'");
          if ($approve) {
        echo "<script> alert('Transaction Successfully Deleted')</script>";
        echo "<script>setTimeout(function(){window.location='deposit'}, 100)</script>";
        // echo "<script>setTimeout(function(){window.history.back()}, 1000)</script>";

          }
      }else{
      
          if ($stat == "approved"){
            $amount = $_POST['amount'];
           $user_id = $_POST['user_id'];

            $up =  mysqli_query($connect, "UPDATE wallet SET balance = balance+'$amount' WHERE user_id = '{$user_id}'");
            if ($up) {
           
            echo "<script> alert('.$amount.')</script>";
            }
          }
        $approval= mysqli_query($connect, "UPDATE transactions SET status ='$stat' WHERE id = '{$identity}'");
          if ($approval) {
            // echo "<script> alert('Action was Successful')</script>";
            // echo "<script>setTimeout(function(){window.location='transactions'}, 1000)</script>";
              }
       } 
    //    if($approval){
    //       header('location: subcategories?#line'.$id);
    //     }else{
    //     echo "<script> alert('Error')</script>";
      
    //   }
      
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
<main class="">

<?php
        if (isset($_GET['trans_id'])) {
            $id = $_GET['trans_id'];
            $sql = mysqli_query($connect, "SELECT * FROM transactions WHERE md5(id) = '{$id}'");
            foreach ($sql as $key) {
               
                ?>
            <h4 class="p-2">View Deposit</h4>

            <div class="shadow bg-white row mx-3" style="border-top: 3px solid green; ">     
                
                  <div class="col-md-6 mb-2 p-2 border-bottom text-capitalize <?php if($key['status']=='rejected'){echo 'text-danger';}elseif($key['status']=='approved'){echo 'text-success';} ?>">
                    <b>status:</b> <?php echo $key['status']; ?>
                  </div>
                  <div class="col-md-6 mb-2 p-2 border-bottom row justify-content-end">
                     <?php 
                    if($key['status'] == 'pending'){ ?>
                        <form method="post">
                        <input type="hidden" name="id" value="<?php echo $key['id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $key['user_id']; ?>">
                        <input type="hidden" name="status" value="approved">
                        <input type="hidden" name="amount" value="<?php echo $key['amount']; ?>">
                        <button type="submit" name="submit" class="btn btn-primary">Approve</button>
                     </form>
                     <form method="post" class="">
                        <input type="hidden" name="id" value="<?php echo $key['id']; ?>">
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" name="submit" class="btn btn-dark mx-1">Reject</button>
                     </form>
                     <form method="post" class="">
                        <input type="hidden" name="id" value="<?php echo $key['id']; ?>">
                        <input type="hidden" name="status" value="delete">
                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                     </form>
                        <?php }elseif($key['status'] == 'rejected'){ ?>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $key['id']; ?>">
                        <input type="hidden" name="status" value="approved">
                        <input type="hidden" name="user_id" value="<?php echo $key['user_id']; ?>">
                        <input type="hidden" name="amount" value="<?php echo $key['amount']; ?>">
                        <button type="submit" name="submit" class="btn btn-primary">Approve</button>
                     </form>
                    <form method="post" class="">
                        <input type="hidden" name="id" value="<?php echo $key['id']; ?>">
                        <input type="hidden" name="status" value="delete">
                        <button type="submit" name="submit" class="btn btn-danger mx-1">Delete</button>
                     </form>
                        <?php } ?>
                  </div>
                  <div class="col-md-6">
                  <?php if ($key['image'] == '') {
                    echo "<h4 class='mt-5'>Preview not Available</h4>";
                  }else{  ?>
                    <img src="../images/<?php echo $key['image']; ?>" alt="" class="w-100"> 
                  <?php } ?>

                  </div>
                 <div class="col-md-6">
                    
                   
                    <b class="mt-2 d-block">Amount</b>
                    <div class="border-top border-bottom p-2 text-right text-uppercase">
                        USD <?php 
                        
                        echo number_format($key['amount'],2);
                         ?>
                    </div>
                    
                    <b class="mt-2 d-block">Transaction Id</b>
                    <div class="border-top border-bottom p-2 text-right text-uppercase">
                        <?php 
                        echo $key['trans_id'];
                        ?>
                    </div>
                    
                
                    <b class="mt-2 d-block">Customer's Email</b>
                    <div class="border-top border-bottom p-2 text-right text-uppercase">
                        <?php 
                        $select = mysqli_query($connect, "SELECT * FROM users WHERE id = '{$key['user_id']}'");
                        $rw = mysqli_fetch_array($select);
                        echo $rw['email']; ?>
                    </div>
                    <b class="mt-2 d-block">Date & Time</b>
                    <div class="border-top border-bottom p-2 text-right text-uppercase">
                        <?php 
                        echo $key['date']. " ".$key['time'];
                        ?>
                    </div>
                </div>
            </div>
                  <?php
                }
            }
        
    ?>
 
   

 </main>

		<!-- MAIN -->
	<!-- NAVBAR -->

	<?php require 'inc/footlink.php'; ?>
	
</body>
</html>
<script>
