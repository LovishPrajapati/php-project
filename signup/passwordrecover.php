<?php 
	if(empty($_SESSION))
	session_start();
	
	if(isset($_SESSION["username"])){
		header("Location:../dashboard.php");
		exit();
	}
    include '../connect.php';
    $noaccounterror = $recover ="";
    if(isset($_POST["submit"])){
    $uname = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $recover ="";

    $query = "SELECT * FROM user_data where username = '$uname'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1){ 	
        while($row = mysqli_fetch_array($result)){
            if($row["email"]== $email&&$row["phone"]== $phone){
                $recover = "Your password is:".$row["passwrd"];
			}
			else{
				$noaccounterror = "Invalid Details.";
			}
        }
    }   
	else{
		$noaccounterror = "No such user.";
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
                        <h2 class="form-title">Password Recovery</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="name" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" minlength="6" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-input" name="phone" id="phone" placeholder="Your Phone No."/>
                        </div>
                        <div class="form-group demo">
                            <?php echo $recover; ?>
                        <span class ="errormsg"><?php echo $noaccounterror; ?></span>
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Recover"/>
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


