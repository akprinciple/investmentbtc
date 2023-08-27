<?php
session_start();
require "inc/config.php";
$msg = "";
    if (isset($_POST['register'])) {
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $phone = mysqli_real_escape_string($connect, $_POST['phone']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);
        $c_password = mysqli_real_escape_string($connect, $_POST['c_password']);
        $token = md5($email).rand(1000, 9999);
        $date= date('d/M/Y');
        
        if ($password != $c_password) {
        $msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>Confirm Your Password!</div>";
        }
        else{
        $mail = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($mail) > 0) {
        $msg = "<div class='p-2 rounded text-danger text-center mb-2 mt-2'>The Email has been registered!</div>";
            
        }else{
        
        
        
        $sql = "INSERT INTO users(email, password, phone, token, date) VALUES ('$email', '$password', '$phone', '$token', '$date')";
        $query = mysqli_query($connect, $sql);
       
        if ($query) {
        $fetch = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
        $vet = mysqli_fetch_array($fetch);
        $id = $vet['id'];
        $update = mysqli_query($connect, "INSERT INTO wallet (user_id, balance) VALUES ('$id', 0)");

       
        $_SESSION['id'] = $vet['id'];
        $_SESSION['email'] = $vet['email'];
        $_SESSION['password'] = $vet['password'];
   header('location: customer/index');

        }
    }
}        
}


if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    date_default_timezone_set('Africa/Lagos');
    $date = date('M d, Y');
    $time = date('h:i:sa');

    $sql = "SELECT * FROM users WHERE email = '{$email}' && password = '{$password}'";
    $query = mysqli_query($connect, $sql);
    $counts = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    if ($counts > 0) {
    
    

        
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $id = $row['id'];
        $update = mysqli_query($connect, "INSERT INTO login (user_id, date, time) VALUES ('$id', '$date', '$time')");
        
        if ($row['level'] == "admin") {
        header('location: admin');
            
        }elseif ($row['level'] == "user"){
        header('location: customer');
        }else{
        header('location: index');
        }
        
     
    }
    else{
        echo "<script>alert('Wrong email or password')</script>";
    }
}
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style4.css">
	<link href="../img/favicon.ico" rel="icon">

    <style>
        .hero{
    height: 100%;
    width: 100%;
    background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(img/banner.jpg);
    background-position: center;
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <center><?php echo $msg; ?></center>
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log in</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
         
            <form id="login" class="input-group" method="post">
             <input type="email" name="email" class="input-field" placeholder="Email" required>   
             <input type="password" name="password" class="input-field" placeholder="Enter Password" required>  
             <input type="checkbox" name="" class="chech-box"><span>Remember Password</span>
             <button type="submit" name="login" class="submit-btn"> Log in</button>
            </form>
            <form id="register" class="input-group" method="post">
                <input type="email" name="email" class="input-field" placeholder="Email Id" required>   
                <input type="text" name="phone" class="input-field" placeholder="Phone Number" required>   
                <input type="password" name="password" class="input-field" placeholder="Enter Password" required>  
                <input type="password" name="c_password" class="input-field" placeholder="Confirm Password" required>  
                <button type="submit" name="register" class="submit-btn">Register</button>
               </form>
        </div>
    </div>

    <script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");

    function register(){
        x.style.left = "-400px"
        y.style.left = "50px"
        z.style.left = "110px"
    }

    
    function login(){
        x.style.left = "50px"
        y.style.left = "450px"
        z.style.left = "0"
    }



    </script>
    


</body>
</html>