<?php
    session_start();
    if(isset($_SESSION['loggedin_user'])) {
        header("Location: profile.php");
    }
    if(!empty($_POST)) {
        require_once 'functions.php';
        $message = "";
        if(!tryCustomerLogin($_POST['username'], $_POST['password'])) {
            $message = "Invalid username or password";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts - Customer Login</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    <body>
        <?php
            require_once 'header.php';
        ?>
        
        <div class="pages_heading">
            <div class="container"><h1> CUSTOMER LOGIN: </h1></div>
        </div>
        
        <div class="wrap">
            <div class="container">
                <form name="customer_login_form" method="post">
                    <table>
                        <tr>
                            <th colspan="2"> <h2>Please enter your username and password</h2></th>
                        </tr>
                        <tr>
                            <th>Username: </th>
                            <td> <input type="text" name="username"/> </td>
                        </tr>

                         <tr>
                            <th>Password: </th>
                            <td> <input type="password" name="password"/> </td>
                        </tr>
                        
                        <?php
                            if(isset($message)) {
                                echo("<rr><td colspan='2' class='errmessage'>$message</td></tr>");
                            }
                        ?>
                        
                       
                    </table>                
                    <div class="center"> <input type="submit" value="Login" />   </div>
                </form>
                <div class="lightbackground"> <a href="Register.php"><h4>Don't have an account? Click here to register!</h4></a> </div>
            </div>
        </div>
    </body>
</html>