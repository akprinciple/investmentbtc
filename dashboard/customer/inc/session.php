<?php 
  session_start();
  require '../inc/config.php';
  if (isset($_SESSION['id'])&&isset($_SESSION['email'])&&isset($_SESSION['password'])) {
  $user_check = $_SESSION['id'];
  $user_email = $_SESSION['email'];
  $user_password = $_SESSION['password'];


  $ses_sql = mysqli_query($connect, "SELECT * FROM users WHERE id = '$user_check' && email = '$user_email' && password = '$user_password'");
  $ses_row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
  $login_id = $ses_row['id'];
  $ses_count = mysqli_num_rows($ses_sql);
  if ($ses_count < 1) {
    header("location: ../index?error");
    }
  
  $_SESSION['id'] = $ses_row['id'];
  $_SESSION['email'] = $ses_row['email'];
  }elseif (!isset($_SESSION['id']) && !isset($_SESSION['email']) && !isset($_SESSION['password'])) {
  header("location: ../index");
  }

  
//   $_SESSION[''] = $ses_row[''];
?>