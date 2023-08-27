
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style4.css">

</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log in</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
         
            <form id="login" class="input-group">
             <input type="text" class="input-field" placeholder="User Id" required>   
             <input type="text" class="input-field" placeholder="Enter Password" required>  
             <input type="checkbox" class="chech-box"><span>Remember Password</span>
             <button type="submit" class="submit-btn"> Log in</button>
            </form>
            <form id="register" class="input-group">
                <input type="text" class="input-field" placeholder="User Id" required>   
                <input type="email" class="input-field" placeholder="Email Id" required>   
                <input type="text" class="input-field" placeholder="Enter Password" required>  
                <button type="submit" class="submit-btn">Register</button>
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