<?php
    session_start();
    require_once 'functions.php';
    if(!isset($_SESSION['loggedin_user']) || (!isset($_SESSION['slcpkgid']))) {
        header("Location: vacation_packages.php");
    }
    $packageinfo = getPackageByPackageId($_SESSION['slcpkgid']);
    if(count($_POST) > 0) {
        $message = "";
        if(empty($_POST['CCName']) || $_POST['CCNumber'] == "" || $_POST['CCExpiry'] == "") {
            $message .= "Credit Card type, number or expiration date field is empty <br/>";         
            if(!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$_POST['CCExpiry'])) {
                $message .= "Please enter the proper YYYY-MM-DD format for credit card expiration date <br/>";
            }
        } else {
            insertCreditCard($_POST['CCName'], $_POST['CCNumber'], $_POST['CCExpiry'], getCustomerIdByUsername($_SESSION['loggedin_user']));
            $newbooking = insertNewBooking(rand(), getCustomerIdByUsername($_SESSION['loggedin_user']), $_SESSION['slcpkgid']);
            if($newbooking != null) {
                insertNewBookingDetail(rand(), $packageinfo['PkgStartDate'], $packageinfo['PkgEndDate'], $packageinfo['PkgDesc'], "", $packageinfo['PkgBasePrice'], $packageinfo['PkgAgencyCommission'], getLastBookingIdByCustomerId(getCustomerIdByUsername($_SESSION['loggedin_user']))['BookingId']);
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
                                ."<tr><th>Package Start Date:</th><td>".$packageinfo['PkgStartDate']."</td></tr>"
                                ."<tr><th>Package End Date:</th><td>".$packageinfo['PkgEndDate']."</td></tr>"    
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
    </body>
</html>