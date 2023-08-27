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
             if ($updated) {
               move_uploaded_file($tmp, "../images/$d $image");
           
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

  
    <!-- All Transactions -->
    <section class="p-3 bg-white shadow" style="border-top: 3px solid #6640b2">
      <h4 class="text-center mt-3">Transactions</h4>
      <hr>
      
      <table class="table table-bordered table-striped">
        <thead class="font-weight-bold">
          <tr  class="text-center">
            <th>S/N</th>
            <th>Email</th>
            <th>Transaction Id</th>
            
            <th class="text-center">Amount(USD)</th>
            <th class="text-center">Date | Time</th>
            <th class="text-center">Status</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            
              $sql = mysqli_query($connect, "SELECT * FROM transactions ORDER BY id DESC LIMIT 50");
            
            if ($sql->num_rows < 1) {
              echo "
              <div class='col-md-3 mx-auto text-center'>
                <img src='../../img/found.jpg' class='w-100'>
                <span class='text-muted'>Nothing is here</span>
                </div>
              ";
            }
            $n = 1;
            foreach($sql AS $key){
          ?>
          <tr>
            <td id="line">
                
                <?php echo $n++;?>
            </td>
            <td>
            <?php
                $query = mysqli_query($connect, "SELECT * FROM users WHERE id = '{$key['user_id']}'");
                foreach($query AS $row){
                echo $row['email'];
                }
                ?>
            </td>
            <td><?php echo $key['trans_id'];?></td>
            
            </td>
            <td class="text-center"><?php echo number_format($key['amount'],2);?></td>
            <td class="text-center"><?php echo $key['date']. " <br> ".$key['time'];?></td>
            
            <td class="text-center"><?php echo $key['status'];?></td>
            <td>
             
            <!-- Edit Button -->
              <a href="view_deposit?trans_id=<?php echo md5($key['id']); ?>" title="View and Approve Section" class="btn btn-success mdi mdi-eye p-2">View</a>
             <!-- Delete Button -->
              <!-- <span class="btn btn-danger p-2 mdi mdi-trash-can" title="Delete Subcategory" id="del<?php echo $key['id']; ?>"></span> -->
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>

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