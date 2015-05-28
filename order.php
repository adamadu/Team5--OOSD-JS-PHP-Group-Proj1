<!--
 * Order Page
 * This is the page the customer sees after they click book now in the packages page. 
 * It displays all the necessary information and allows the customer to enter their CC info here
 * Written by: Adam - Last edited: 28-May
 * OOSD APR 23 2015 - Threaded Project Workshop 1 - Team 5
-->

<?php
    session_start();
    require_once 'functions.php';
    if(!isset($_SESSION['loggedin_user']) || (!isset($_SESSION['slcpkgid']))) {
        header("Location: vacation_packages.php");
    }
    $packageinfo = getPackageByPackageId($_SESSION['slcpkgid']);
    if(count($_POST) > 0) {
        $message = "";
        pre($_POST);
        if(empty($_POST['CCName']) || $_POST['CCNumber'] == "" || $_POST['CCExpiry'] == "" || $_POST['TripStart'] == "" || $_POST['TripEnd'] == "") {
            $message .= "Credit Card type, number, trip start, trip end or expiration date field is empty <br/>";         
            if(!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$_POST['CCExpiry'])) {
                $message .= "Please enter the proper YYYY-MM-DD format for credit card expiration date <br/>";
            }
            if(!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$_POST['TripStart'])) {
                $message .= "Please enter the proper YYYY-MM-DD format for Trip Start date <br/>";
            }
            if(!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$_POST['TripEnd'])) {
                $message .= "Please enter the proper YYYY-MM-DD format for Trip End date <br/>";
            }  
            if($_POST['TripStart'] < date("Y-m-d H:i:s")) {
                $message .= "Error in start date: It is before todays date. Please enter a date after todays date <br/>";
            }   
            if($_POST['TripEnd'] < $_POST['TripStart']) {
                $message .= "Error in trip end date: It is before trip start date. Please enter a valid end date <br/>";    
            }
        } else {
            insertCreditCard($_POST['CCName'], $_POST['CCNumber'], $_POST['CCExpiry'], getCustomerIdByUsername($_SESSION['loggedin_user']));
            $newbooking = insertNewBooking(rand(), getCustomerIdByUsername($_SESSION['loggedin_user']), $_SESSION['slcpkgid']);
            if($newbooking != null) {
                insertNewBookingDetail(rand(), $_POST['TripStart'], $_POST['TripEnd'], $packageinfo['PkgDesc'], "", $packageinfo['PkgBasePrice'], $packageinfo['PkgAgencyCommission'], getLastBookingIdByCustomerId(getCustomerIdByUsername($_SESSION['loggedin_user']))['BookingId']);
                unset($_SESSION['slcpkgid']);
                header("Location: vieworders.php"); 
            }
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts - Confirm Order</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    <body>
        <?php
            require_once 'header.php';
        ?>
        
        <div class="pages_heading">
            <div class="container"><h1> CONFIRM ORDER: </h1></div>
        </div>
        
        <div class="wrap">
            <div class="container">
                <form name="" method="post">
                    <table>
                        <tr>
                            <th colspan="2"> <h2>Please confirm your booking details</h2></th>
                        </tr>
                        <?php
                          
                            $custinfo = getAllCustInfoByUsername($_SESSION['loggedin_user']);
                            
                            echo("<tr><th colspan='2'><h3>Personal Details:</h3></th>"
                                ."<tr><th>Your Full Name:</th><td>".$custinfo['CustFirstName']." ". $custinfo['CustLastName']. "</td></tr>"
                                ."<tr><th>Your Full Address:</th><td>".$custinfo['CustAddress'].", ".$custinfo['CustCity'].", ".$custinfo['CustProv'].", ".$custinfo['CustPostal'].", ".$custinfo['CustCountry']."</td></tr>"
                                ."<tr><th>Home/Cell Phone:</th><td>".$custinfo['CustHomePhone']." / ".$custinfo['CustBusPhone']."</td></tr>"
                                ."<tr><th>Your Email:</th><td>".$custinfo['CustEmail']."</td></tr>"
                                    
                                ."<tr><th colspan='2'><h3>Package Details:</h3></th>"
                                ."<tr><th>Selected Package:</th><td>".$packageinfo['PkgName']."</td></tr>"
                                ."<tr><th>Package Detail:</th><td>".$packageinfo['PkgDesc']."</td></tr>"
                               // ."<tr><th>Package Start Date:</th><td>".$packageinfo['PkgStartDate']."</td></tr>"
                               // ."<tr><th>Package End Date:</th><td>".$packageinfo['PkgEndDate']."</td></tr>"    
                                ."<tr><th>Trip Start Date:</th><td><input type='date' name='TripStart'>(YYYY-MM-DD)</td></tr>"
                                ."<tr><th>Trip End Date:</th><td><input type='date' name='TripEnd'>(YYYY-MM-DD)</td></tr>"  
                                ."<tr><th>Package Price:</th><td>$".$packageinfo['PkgBasePrice']."</td></tr>"        
                                    
                                ."<tr><th colspan='2'><h3>Payment Details:</h3></th>");              
                            echo("<tr><th>Credit Card Type:</th><td><input type='radio' name='CCName' value='MC'/>Master Card<br/><input type='radio' name='CCName' value='VISA'>VISA<br/>"
                            ."<input type='radio' name='CCName' value='AMEX'>AMEX<br/><input type='radio' name='CCName' value='Diners'/>Diners<br/></td></tr>"
                            ."<tr><th>Credit Card Number:</th><td><input type='number' name='CCNumber' size='50'></td></tr>"
                            ."<tr><th>Credit Card Expiry:</th><td><input type='date' name='CCExpiry'/>(YYYY-MM-DD)</td></tr>");  
                           
                            if(isset($message)) {
                                echo "<div class='errmessage'>".$message."</div>";                              
                            }        
                        ?>
                    </table>                
                    <div class="center"> <input type="submit" value="Confirm!" />   </div>
                </form> 
            </div>
        </div>
        <?php
            require 'footer.php';
        ?>
    </body>
</html>