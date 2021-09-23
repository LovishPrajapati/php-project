<?php 
	if(empty($_SESSION))
	session_start();
	
	if(isset($_SESSION["username"])){
		header("Location:dashboard.php");
		exit();
	}
	include 'connect.php';	
	$unameerror = $upasserror = $noaccounterror = " ";

	if(isset($_POST["submit"])){

	$uname = $_POST["username"];
	$upass = $_POST["pass"];
	
    
    if(trim("$uname")==""){
        $unameerror = "Username cannot be empty";
    }

    if(trim("$upass")==""){
		$upasserror = "Password cannot be empty";
    }
    
    else{  

    $query = "SELECT * FROM user_data where username = '$uname'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1){ 	
        while($row = mysqli_fetch_array($result)){
            if($row["passwrd"]== "$upass"){
                $_SESSION["password"]="$upass";
				$_SESSION["username"]="$uname";
				$_SESSION["name"]=$row["name"];
                header("Location:dashboard.php");
				exit();
			}
			else{
				$noaccounterror = "Invalid username or password";
			}
        }
    }   
	else{
		$noaccounterror = "Invalid username or password";
        }   
	}
}
?>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
					<div class="login100-form-avatar">
						<img src="images/download.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						Login
					</span>
					<div class="wrap-input100  m-b-10" >
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
                            <i class="fa fa-user"></i>                           
                        </span>		                  		
					</div>
					
					<div class="errormsg"><?php echo  "$unameerror" ?> </div>

					<div class="wrap-input100  m-b-10" >
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="errormsg"><?php echo  "$upasserror" ?> </div>
                   
					<div class="container-login100-form-btn p-t-10">
						<input type="submit" class="login100-form-btn" value="Login" name="submit">
					</div>

					<div class="errormsg"><?php echo  "$noaccounterror" ?> </div>

					<div class="text-center w-full p-t-25 p-b-230">
						<a href="signup/passwordrecover.php" class="txt1">
							Forgot Username / Password?
						</a>
					</div>
                   
					<div class="text-center w-full">
						<a class="txt1" href="signup/index.php">
							Create new account
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	


	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>