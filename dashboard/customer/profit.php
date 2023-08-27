<?php
  include('inc/session.php'); 
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
    <h1>Interest History</h1>



		<!-- MAIN -->

        <?php
            $sel = mysqli_query($connect, "SELECT * FROM investment WHERE user_id= '{$_SESSION['id']}' ORDER BY id DESC");
            $n = 1;
            while($row=mysqli_fetch_array($sel)){

                $activation_date = date_create($row['date']);
                $date = date("Y-m-d");
                // echo $date;
                $today = date_create($date);
          
                $diff = date_diff($activation_date,$today);
                $days = $diff->format("%R%a");
                if ($days >30) {
                    $days_left = 30;
                }else {
                    $days_left = $days;
                }
                
           
        ?>
        <div style="display: flex; justify-content: space-between;">

            <h4>(<?php echo $n++; ?>) Investment Id: <?php echo $row['investment_id']; ?></h4>
            <h4>Date Invested: <?php echo $row['date']; ?></h4>
        </div>
    <table class="table table-striped table-responsive mt-3">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Amount($)</th>
                    <th>Post Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <?php
                for ($x = 1; $x <= $days_left; $x++) {
            ?>
        <tr>
            <td><?php echo $x; ?></td>
            <td>
                <?php
                    $originalDate = $row['date']; // Replace this with your original date
                    $daysToAdd = $x; // Number of days to add
                    
                    $newDate = date('Y-m-d', strtotime($originalDate . ' + ' . $daysToAdd . ' days'));
                    
                    
                    echo $newDate;
                    
                ?>
            </td>
            <td><?php echo number_format($row['amount']*0.05,2); ?></td>
            <td><?php echo number_format($row['amount']*0.05*$x,2); ?></td>
            <td>Deposited</td>
        </tr>

<?php } ?>
    </table>

<?php } ?>
</main>
	<!-- NAVBAR -->

	<?php require 'inc/footlink.php'; ?>
	
</body>
</html>
