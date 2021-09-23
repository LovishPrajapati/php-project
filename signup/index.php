<?php 
    if(empty($_SESSION)){
        session_start();
    }

    require_once '../connect.php';
    $name = $address = $email = $phone = $password = $repass = $username="";
    $nameerr = $addresserr = $emailerr = $phoneerr = $passworderr = $repasserr = $passmatch = $usernameerr= "";
    $status = "";

    if(isset($_POST['submit'])){
       $username = trim($_POST["username"]);
       $address = trim($_POST["address"]);  
       $name = trim($_POST["name"]);
       $email = trim($_POST["email"]);
       $phone = trim($_POST["phone"]);
       $password = trim($_POST["password"]);
       $repass = trim($_POST["re_password"]);


        if($username==""){ 
            $usernameerr="Username cannot be empty.";
        }
        elseif(!preg_match("/^[a-zA-Z0-9_ ]*$/",$username)){
                $usernameerr = "Only letters,underscore and white space allowed.";
        }

        if($name==""){
            $nameerr = "Name cannot be empty.";
        }
        elseif(!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameerr = "Only letters and white space allowed.";
            }

        if($email==""){
            $emailerr = "Email cannot be empty.";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerr = "Invalid email format.";
        }
            
        if($phone==""){
            $phoneerr = "Phone cannot be empty.";
        }
        elseif(!preg_match("/^[1-9][0-9]{9}$/",$phone)){
            $phoneerr = "Invalid phone format.";
        }
            
        if($password==""){
            $passworderr = "Password cannot be empty.";
        }

        if($repass==""){
            $repasserr = "Enter password again.";
        }

        if($password!=$repass){
            $passmatch = "Password not matched.";
        }
        else{
            $query1 = "SELECT * FROM user_data where username ='$username'";
            $result1 = mysqli_query($conn,$query1);
            if(mysqli_num_rows($result1)==1){
                while($row = mysqli_fetch_array($result1)){
                    if($row['username']=="$username" && $row['phone']==$phone && $row['email']=="$email"){
                        $usernameerr = "Username already exists.";
                    }
                }
            }
            else{
            $query = "INSERT INTO `user_data`(`username`, `name`, `address`, `email`, `phone`, `passwrd`) 
            VALUES (\"$username\",\"$name\",\"$address\",\"$email\",$phone,\"$password\")";
            $result = mysqli_query($conn,$query);
            if($result){
                $status = "Account created successfully!!";
            }
            else{
                $status = "Failed";
            }
        }
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="signup-form">
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="name" placeholder="Username" />
                            <span class ="errormsg"><?php echo $usernameerr; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name" />
                            <span class ="errormsg"><?php echo $nameerr; ?></span>
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-input" name="address" id="address" placeholder="Your Address"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" minlength="6" name="email" id="email" placeholder="Your Email"/>
                            <span class ="errormsg"><?php echo $emailerr; ?></span>
                        </div>
                         <div class="form-group">
                            <input type="tel" class="form-input" name="phone" id="phone" placeholder="Your Phone No."/>
                            <span class ="errormsg"><?php echo $phoneerr; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            <span class ="errormsg"><?php echo $passworderr; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
                            <span toggle="#re_password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            <span class ="errormsg"><?php echo $repasserr; ?></span>
                            <span class ="errormsg"><?php echo $passmatch; ?></span>
                        </div>
                       
                        <div class="form-group demo">
                        <span style="color:red,font-size=18px;"><?php echo $status; ?></span>
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                        
                    <p class="loginhere">
                        Have already an account ? <a href="../index.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>