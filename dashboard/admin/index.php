<?php 
require 'inc/session.php';
$date = date('Y-m-d');
    $select = mysqli_query($connect, "SELECT * FROM investment WHERE user_id = '{$_SESSION['id']}' && DATEDIFF('$date', date) > 30 && status = 'on'");
    foreach ($select as $key) {
        $profit = $key['amount']+$key['amount']*30*0.05;
        // echo $profit;
       $up = mysqli_query($connect, "UPDATE wallet SET balance = balance+'$profit' WHERE user_id = '{$_SESSION['id']}'");

       $update_status = mysqli_query($connect, "UPDATE investment SET status = 'off' WHERE id ='{$key['id']}'");
       if ($up && $update_status) {
      echo "<script> alert('Investment Successfully Terminated. Your wallet has been credited. Thank you for investing with us.')</script>";
      echo "<script>setTimeout(function(){window.location='index'}, 0)</script>";

       }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'inc/toplink.php'; ?>
	
	<title>Admin Dashboard</title>
</head>
<body>
	
	<?php require 'inc/header.php'; ?>

		<main>
			
				<div class="dashboard">
					<div class="box">
					
							<button class="details-button w-100"><h3>No of users</h3></button>
					
						<div class="value">
                            <?php
                $sel = mysqli_query($connect, "SELECT * FROM users WHERE level = 'user'");
                
                echo $sel->num_rows;

                                
                            ?>
                        </div>
					</div>
					<div class="box">
					
							<button class="details-button"><h3>Interest Wallet Balance</h3></button>
					
						<div class="value">$<?php
                        
                $sq = mysqli_query($connect, "SELECT SUM(amount * 0.05 * (DATEDIFF('$date', date))) AS 
                             total  FROM investment WHERE DATEDIFF('$date', date) < 31");
               $rw = mysqli_fetch_array($sq);
                   echo number_format($rw['total'],2);

                                
                            ?>

                        </div>
					</div>
					<div class="box">
						
							<button class="details-button"><h3>Total Invest Balance</h3></button>
					
						<div class="value">
                        $<?php
                        
                        $sq = mysqli_query($connect, "SELECT SUM(amount+amount * 0.05 * (DATEDIFF('$date', date))) AS 
                                     total  FROM investment WHERE DATEDIFF('$date', date) < 31");
                       $rw = mysqli_fetch_array($sq);
                           echo number_format($rw['total'],2);
                     ?>
                        </div>
					</div>
					<div class="box">
						<h2>Total Deposit</h2>
						<div class="value">
                        $<?php
                        
                        $sq = mysqli_query($connect, "SELECT SUM(amount) AS 
                                     total  FROM transactions WHERE status='approved'");
                       $rw = mysqli_fetch_array($sq);
                           echo number_format($rw['total'],2);
                     ?>
                        </div>
					</div>
					<div class="box">
						<h2>Total Withdraw</h2>
						<div class="value">
                        $<?php
                        
                        $sq = mysqli_query($connect, "SELECT SUM(amount) AS 
                                     total  FROM withdrawal WHERE status='approved'");
                       $rw = mysqli_fetch_array($sq);
                           echo number_format($rw['total'],2);
                     ?>
                        </div>
					</div>
					<div class="box">
						<h2>Number of Deposit</h2>
						<div class="value">
                        <?php
                        
                        $sq = mysqli_query($connect, "SELECT * FROM transactions ");
                           echo $sq->num_rows;
                     ?>
                        </div>
					</div>
				</div>
			
			
                <div class="container">
                    <h1>Interest History</h1>
                    <?php
            $sel = mysqli_query($connect, "SELECT * FROM investment ORDER BY id DESC LIMIT 1");
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
            <h4>Latest Active Investment</h4>
            <h4> Investment Id: <?php echo $row['investment_id']; ?></h4>
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
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	<?php require 'inc/footlink.php'; ?>
	
</body>
</html>