<?php
  include('inc/session.php'); 

  // Section to submit Crypto Transactions
if (isset($_POST['submit'])) {
  $user_id = $_SESSION['id'];
  
  $amount = mysqli_real_escape_string($connect, $_POST['amount']);
  $image = $_FILES['image']['name'];
  $date = date('d/M/Y');
  $time = date('h:i:sa');
  $tmp = $_FILES['image']['tmp_name'];
   // String of all alphanumeric character
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  // $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

// Shuffle the $str_result and returns substring
// of specified length
  $transaction_id = '#'.substr(str_shuffle($str_result),0, 20);
  $type = pathinfo("upload/$image", PATHINFO_EXTENSION);

  if($amount < 50){
    echo "<script> alert('Amount must be at least $50.')</script>";
  }elseif($_FILES['image']['size'] > 1000000) {
     echo "<script> alert('Sorry, your file size must be less than 1mb.')</script>";
     }elseif ($type != "JPG" && $type != "jpg"  && $type != "PNG" && $type != "png") {
       echo "<script> alert('Only jpg and png files are allowed')</script>";
         }else{
           $d = date('d-m-y');
             $updated = mysqli_query($connect, "INSERT INTO transactions(user_id, trans_id, amount, image, date, time) VALUES ('$user_id', '$transaction_id', '$amount', '$d $image', '$date', '$time')");
             
             if(move_uploaded_file($tmp, "../images/$d $image")){
             echo "<script> alert('Image Successfully moved')</script>";
              
             }else{
             echo "<script> alert('Image Error!  big time')</script>";

             }
             if ($updated) {
           
             echo "<script> alert('Fund Successfully added. Our team will verify and get back as soon as possible.')</script>";
             }
             else{
               echo "<script> alert('Error')</script>";
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
<div class="mt-4">	
<button class="btn btn-success mr-4" style="float: right" onclick="import_csv()">Fund Wallet</button>
<div style="clear: both"></div>

<p>
    <form method="post" enctype="multipart/form-data" class="col-md-9 mx-auto bg-white mt-3 p-3" style="display: none;" id="importer">
      
        <div class="col-md-12 text-center mb-3 border-bottom border-success">
          <h3 class="text-center">Fund Wallet</h3>
        </div>

        <div class=" col-md-12 mb-3">
            <label for="exampleInputEmail" class="font-weight-bold">Amount:</label>
            <input type="number" name="amount" min="0" required class="form-control" pattern="[0-9]{6}" step=".0001" id="min" placeholder="0" min="" onkeyup="find_amount(this.value)">
        </div>
        <div class="col-md-12 mb-3">
          <label for="" class="font-weight-bold">Send coin to:</label>
          <div class="row mx-0">
            <input type="text" readonly class="form-control" id="wallet" value="abansbabsbabadh1hqs172t78qd287e7" placeholder="Copy wallet address" style="width: 80%">
            <button type="button" class="btn btn-success" style="width: 20%" onclick="myFunction()">Copy</button>
          </div>
        </div>
        <div class="col-md-12 mb-3">
            <label for="exampleInputEmail" class="font-weight-bold" required>Upload Transaction Screenshot:</label>
            <input type="file" name="image" accept=".jpg,.png" class="form-control" required>
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
    $sql = mysqli_query($connect, "SELECT * FROM transactions WHERE user_id = '{$_SESSION['id']}' ORDER BY id DESC");
   $n = 1;
    ?>
    <table class="table table-hover table-responsive">
                      <thead>
                        <tr>
                          <th>S/N</th>
                           <th>Image</th>
                          <th> Trans Id </th>
                          <th> Date | <span class="text-primary">Time</span> </th>
                          <th> Amount (USD) </th>
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
                            <img style="width: 40px" src="../images/<?php echo $key['image']; ?>" alt="image"/>
                          </td>
                          <td>
                            <?php echo $key['trans_id']; ?>
                            
                          </td>
                          <td><?php echo $key['date']." | ".$key['time']; ?></td>
                          <td>
                            <?php echo $key['amount'];
                               
                            ?>
                            
                            
                          </td>
                          
                          <td>
                          <?php echo $key['status']; ?>
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