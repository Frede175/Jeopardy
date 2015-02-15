<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'Oops! An unknown error happened.';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Jeopardy: Registration Success</title>
        <link rel="stylesheet" href="css/index.css"/>
        <link rel="stylesheet" href="css/error.css"/>
        <LINK REL="SHORTCUT ICON" HREF="images/logo.png">
    </head>
    <body>
        <div id="header">
            <div id="nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="make.php">Make</a></li>
                    <li><a href="Jeopardy.php">Play</a></li>
                    <li><a href="About.php">About</a></li>
                    <img class="right" src="images/logo.png" id="logo">
                    <a class="right" id="signup" href="register.php">Sign up</a>
                    <a class="right" id="login" href="login.php">Login</a>
                </ul>
            </div>
        </div>

        <div id="content">
            <h1>There was a problem</h1>
            <p class="error"><?php echo $error; ?></p>  
        </div>
    </body>
</html>