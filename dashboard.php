<?php
require_once 'connect.php';

if(empty($_SESSION)){
    session_start();
}
if(!isset($_SESSION["username"])){
    header("Location:index.php");
    exit();
}

?>

<html>
    <head>
        <title>User account</title>
        <link type="text/css" href="css/main.css" rel="stylesheet">
    </head>
        <body id="body-bg">
            <div class="header">
                <div id="header-title">
                    PHP PROJECT
                </div>
            </div>
            <div class="uid">
                <div id="txt"> Welcome <?php echo $_SESSION["name"];?> <a href = "logout.php"> Logout </a><a href = "signup/reset.php"> Reset password </a></div>
            </div>

            <div id="mem-name">
                <h3>Team Members:</h3><br>
                Lovish Kumar Prajapati(1175)<br>
                Gopal(1187)<br>
                Jyoti Srivastav(1169)
            </div>
       
       
    </body>
</html>