<?php 
	if(empty($_SESSION))
	session_start();
    
    if(!isset($_SESSION["username"])){
        header("Location:index.php");
        exit();
    }

    include '../connect.php';
    $noaccounterror = $recover ="";
    
    if(isset($_POST["submit"])){
    $uname = $_SESSION["username"];
    $password = trim($_POST["password"]);
    $re_password = trim($_POST["re_password"]);
    $recover ="";
    
    if($password==$re_password){
    $query = "UPDATE `user_data` SET `passwrd`= '$password' WHERE username='$uname'";
    $result = mysqli_query($conn,$query);
    $recover = "Success...!!";
    unset($_SESSION['username']);
    }
    else{
			$noaccounterror = "Password didn't matched.";
		}
    }   
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recover</title>

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
                    <form method="POST" class="signup-form" id="signup-form" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
                        <h2 class="form-title">Password Reset</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="New Password" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="re_password" id="re_password" placeholder="Confirm Password" />
                        </div>
                        <div class="form-group demo">
                            <?php echo $recover; ?>
                        <span class ="errormsg"><?php echo $noaccounterror; ?></span>
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Reset"/>
                        </div>
                        <p class="loginhere">
                        <a href="../index.php" class="loginhere-link">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>
</html>