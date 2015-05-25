<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION['loggedin_user'])) {
        header("Location: login.php");
    }
?>


<html>
    <head>
        <title>Travel Experts - Your Profile</title>      
        
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    <body>     
        <?php
            require_once 'header.php';
        ?>
        <div class="pages_heading">
            <div class="container"><h1> My Profile: </h1></div>
        </div>
        
        <div class="wrap">
            <div class="container">
                <div class="lightbackground">
                    <ul> <h2> This is your account profile. You can view and edit your account details here </h2>
                        <li>Click here to View/Edit personal information</li>
                        <li>Click here to View/Edit billing details</li>
                        <li><a href="vieworders.php">Click here to View your current orders/order history</a> </li>
                    </ul>
                    
                 
                </div>
            </div>
        </div>
        
    </body>
</html>