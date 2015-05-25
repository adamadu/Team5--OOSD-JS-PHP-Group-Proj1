<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION['loggedin_user'])) {
        header("Location: login.php");
    } else {
        require_once 'functions.php';  
        $prevBooking = array();
        $currBooking = array();
        
        $custBookings = getBookingsByCustomerId(getCustomerIdByUsername($_SESSION['loggedin_user']));
        
        if(count($custBookings) > 0) {
            foreach($custBookings as $custbookingindex => $bookingfield) {
                $bookingdetails = getBookingDetailsByBookingId($bookingfield['BookingId']);   
                if(is_array($bookingdetails)) {
                    foreach($bookingdetails as $detailsindex => $detailsfield) {
                        if($detailsfield['TripEnd'] < date("Y-m-d H:i:s")) {
                            $prevBooking[] = $detailsfield;   
                        } else {
                            $currBooking[] = $detailsfield;
                        }
                    }
                }
            }
        }
        //pre($currBooking);
       // pre($prevBooking);
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
            <div class="container"><h1> My Orders: </h1></div>
        </div>
        
        <div class="wrap">
            <div class="container">                 
                <h2>Current Bookings:</h2>
                <table>               
                    <?php
                        if(count($currBooking)> 0) {
                            echo "<tr>
                                    <th>Booking No.</th>
                                    <th>Booking Date</th>
                                    <th>Description</th>
                                    <th>Destination</th>
                                    <th>Trip Start (YYYY/MM/DD)</th>
                                    <th>Trip End (YYYY/MM/DD)</th>
                                </tr>";
                            
                            foreach($currBooking as $ckey => $cvalue) {
                                $test = getBookingsByBookingDetailsId($cvalue['BookingId']);
                                foreach($test as $tkey => $tvalue) {
                                    echo "<tr> <td>". $tvalue['BookingNo'] ."</td> <td>".$tvalue['BookingDate']."</td>";
                                }
                                echo "<td>".$cvalue['Description']."</td><td>".$cvalue['Destination']."</td><td>".chop($cvalue['TripStart'], "00:00:00")."</td><td>".chop($cvalue['TripEnd'], "00:00:00")."</td></tr>";
                            }
                        } else {
                            echo "<tr><th>You dont have any current bookings</th></tr>";
                        }  
                    ?>
                </table>         
                <h2>Previous Bookings:</h2>
                <table>               
                    <?php
                       if(count($prevBooking)> 0) {
                            echo "<tr>
                                    <th>Booking No.</th>
                                    <th>Booking Date</th>
                                    <th>Description</th>
                                    <th>Destination</th>
                                    <th>Trip Start (YYYY/MM/DD)</th>
                                    <th>Trip End (YYYY/MM/DD)</th>
                                </tr>";
                            
                            foreach($prevBooking as $ckey => $cvalue) {
                                $test = getBookingsByBookingDetailsId($cvalue['BookingId']);
                                foreach($test as $tkey => $tvalue) {
                                    echo "<tr> <td>". $tvalue['BookingNo'] ."</td> <td>".$tvalue['BookingDate']."</td>";
                                }
                                echo "<td>".$cvalue['Description']."</td><td>".$cvalue['Destination']."</td><td>".chop($cvalue['TripStart'],"00:00:00")."</td><td>".chop($cvalue['TripEnd'],"00:00:00")."</td></tr>";
                            }
                        } else {
                             echo "<tr><th>You dont have any previous bookings</th></tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
            
    </body>
</html>