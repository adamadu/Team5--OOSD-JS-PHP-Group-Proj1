<!--
 * Customer Registration Page
 * Allows the customer to create an account
 *
 * Written by: Sam - 18-May
 * Last edited by Adam: 24-May (i added the session/actual login functionality
 * OOSD APR 23 2015 - Threaded Project Workshop 1 - Team 5
-->

<?php
    session_start();
    if(isset($_SESSION['loggedin_user'])) {
        header("Location: index.php");
    }

    if(!empty($_REQUEST)) 
    {
        require_once 'functions.php';  
        $message = "";
        $emptyfields = checkEmptyFields($_REQUEST);
        if(empty($emptyfields)) 
        {
            if(!checkUsernameExists($_REQUEST['username'])) 
            {
                if(insertCustomer($_REQUEST)) 
                {
                    tryCustomerLogin($_REQUEST['username'], $_REQUEST['password']);
                } 
                else 
                {
                    $message = "Sorry. An Error has occured. Please try again <br/>";
                } 
            } 
            else 
            {
                $_REQUEST['username'] = "";
                $message = "Username you picked already exists <br/>";
            }
        }
    }
    
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts - Register Account</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <script src="jsFuctions.js"></script>
    </head>
    <body>
        <?php
            require_once 'header.php';
        ?>
        
        <div class="pages_heading">
            <div class="container"><h1> ACCOUNT REGISTRATION: </h1></div>
        </div>
        
        <div class="wrap">
            <div class="container">
                <form id="register" method="post" name="custRegForm" action="">
                    <table>
                           
                    <tr>
                        <th colspan="2"> <h2>Please fill in the below fields: </h2> </th>
                    </tr>
                    <tr>
                        <th>First Name:</th>
                        <td> <input type="text" name="CustFirstName" value="<?php echo isset($_REQUEST['CustFirstName'])? $_REQUEST['CustFirstName'] : "" ?>"/> </td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td> <input type="text" name="CustLastName" value="<?php echo isset($_REQUEST['CustLastName'])? $_REQUEST['CustLastName'] : "" ?>"/> </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td> <input type="text" name="CustAddress" size="40" value="<?php echo isset($_REQUEST['CustAddress'])? $_REQUEST['CustAddress'] : "" ?>"/> </td>
                    </tr>
                    <tr>
                        <th>City:</th>
                        <td> <input type="text" name="CustCity" size="20" value="<?php echo isset($_REQUEST['CustCity'])? $_REQUEST['CustCity'] : "" ?>"/> </td>
                    </tr>
                    <tr>
                        <th>Province:</th>
                        <td> <input type="text" name="CustProv" size="2" maxlength="2"  value="<?php echo isset($_REQUEST['CustProv'])? $_REQUEST['CustProv'] : "" ?>"/> </td>
                    </tr>
                    <tr>
                        <th>Postal Code:</th>
                        <td> <input type="text" name="CustPostal" size="10" maxlength="7" value="<?php echo isset($_REQUEST['CustPostal'])? $_REQUEST['CustPostal'] : "" ?>"/> </td>
                    </tr>
                    <tr>
                        <th>Country:</th>
                        <td> <input type="text" name="CustCountry" size="20" value="<?php echo isset($_REQUEST['CustCountry'])? $_REQUEST['CustCountry'] : "" ?>"/> </td>
                    </tr>
                    
                    <tr>
                        <th>Home Phone:</th>
                        <td> <input type="text" name="CustHomePhone" size="40" value="<?php echo isset($_REQUEST['CustHomePhone'])? $_REQUEST['CustHomePhone'] : "" ?>"/></td>
                    </tr>
                    <tr>
                        <th>Bus Phone:</th>
                        <td> <input type="text" name="CustBusPhone" size="40" value="<?php echo isset($_REQUEST['CustBusPhone'])? $_REQUEST['CustBusPhone'] : "" ?>"/></td>
                    </tr>    
                    <tr>
                        <th>Email address:</th>
                        <td> <input type="email" name="CustEmail" size="40" value="<?php echo isset($_REQUEST['CustEmail'])? $_REQUEST['CustEmail'] : "" ?>"/> </td>
                    </tr>
                   
                    <tr>
                        <th>Username:</th>
                        <td> <input type="text" name="username" size="30" value="<?php echo isset($_REQUEST['username'])? $_REQUEST['username'] : "" ?>"/> </td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td> <input type="password" name="password" size="30" value="<?php echo isset($_REQUEST['password'])? $_REQUEST['password'] : "" ?>"/> </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" id="errorMessage" class="errmessage">
                            <?php
                                if(isset($emptyfields)) 
                                {
                                    foreach ($emptyfields as $key => $value) 
                                    {
                                        echo $value . "<br/>";
                                    }
                                } 
                                if(isset($message)) 
                                {
                                    echo $message;
                                }                                
                            ?>
                        </td>
                    </tr>
                    </table>
                    <div class="center">	
                        <input type="submit"  value="Register" onclick="return jsValidate()" />
                        <input type="reset"  value="Reset" onclick="return confirm('Are you sure you want to reset all the fields?')"		
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            require 'footer.php';
        ?>
    </body>
</html>
