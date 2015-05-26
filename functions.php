<?php 
/*
 * Place to store all php functions. 
*/    

    //Adam - Just a function to make life eaiser whenever we need to output array
    function pre($value) {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }
    require_once 'database.php';
    
    /*
     * Function that gets all Agents By their corresponting Agency id specified
     * @return - null if query fails or returns an assosiative array when the query if sucessfull
     * @param - The agency id that you want to sort the agents by.
     */
    function getAgentsByAgencyId($agencyId) {
        $query = "SELECT * FROM `agents` WHERE AgencyId=$agencyId";
        $return = Database::selectQuery($query);
        if ($return != null) {           
            return $return;
        } else {
            return null;
        }
    }
    
    /*
     * Function to get all agencies for the database
     * @return - null if query fail or returns an assosiative array of agencies when the query if sucessfull
     */
    function getAgencies() {
        $query = "SELECT * FROM `agencies`";
        $return = Database::selectQuery($query);
        if ($return != null) {           
            return $return;
        } else {
            return null;
        }
    }
    
    /*
     * This functions checks if any fields are empty in the register page
     * @param The customer entered information (USE $_POST or $_REQUEST) data
     * @return An associative array with proper error messages as values and keys as field name
     */ 
    function checkEmptyFields($custInfo) {     
        $errorMessageIfEmpty = array(
            "CustFirstName" => "First name is empty",
            "CustLastName"  => "Last name is empty",
            "CustAddress"   => "Address is required",
            "CustCity"      => "City field is empty",
            "CustProv"      => "Province field is empty",
            "CustPostal"    => "Postal Code is empty",
            "CustCountry"   => "Country field is empty",
            "CustHomePhone" => "Home phone number is required",
            "CustBusPhone"  => "Bus/Cell phone number is required",
            "CustEmail"     => "Please enter your email",
            "username"      => "Username field is empty",
            "password"      => "Password field is empty"
        );
        
        $actualErrors = array();
        
        foreach($custInfo as $key => $value) {
            if(array_key_exists($key, $errorMessageIfEmpty)) {
                if(trim($value) == "") {
                    $actualErrors[$key] = $errorMessageIfEmpty[$key];
                } 
            }
        }    
        return $actualErrors;
    }
    
    function getCustomerByUserAndPass($username, $password) {
        $query = "SELECT * FROM `customers` WHERE `username`='$username' AND `password`='". md5($password). "'";
        $result = Database::selectQuery($query);
        if(count($result) == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    
    function tryCustomerLogin($username, $password) {
        if(getCustomerByUserAndPass($username, $password)) {
            $_SESSION['loggedin_user'] = $username;
            header("Location: profile.php");
        } else {
           return false; 
        }
    }
    
    function insertCustomer($custdata)
    {
        $sql = "insert into customers (CustFirstName, CustLastName, CustAddress, CustCity, CustProv, CustPostal, CustCountry, CustHomePhone, CustBusPhone, CustEmail, username, password) values ('$custdata[CustFirstName]', '$custdata[CustLastName]', '$custdata[CustAddress]', '$custdata[CustCity]', '$custdata[CustProv]', '$custdata[CustPostal]', '$custdata[CustCountry]', '$custdata[CustHomePhone]', '$custdata[CustBusPhone]', '$custdata[CustEmail]', '$custdata[username]', '" . md5($custdata['password']) . "')";
        $result = Database::insertQuery($sql);    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
   
    function checkUsernameExists($username) {
        $query = "SELECT * FROM `customers` WHERE username='".$username."'";
        $result = Database::selectQuery($query);
        if(count($result) == 1) {
            return true;
        } else {
            return false;
        }
    }
   /* function blah() {
        $query = "SELECT * FROM `customers`";
        $result = Database::selectQuery($query);
        $i = 0;
        
        foreach($result as $key => $value) {
            //pre($value);
            Database::insertQuery("UPDATE `customers` SET password='" .md5('password'.$i) . "' WHERE CustomerId=" . $value['CustomerId']);
            $i++;
        }
    }*/
    function logout() {
        if(session_destroy()) // Destroying All Sessions
        {
            header("Location: index.php"); // Redirecting To Home Page
        }
    }
    
    function getCustomerIdByUsername($custusername){
        $query = "SELECT CustomerId FROM `customers` WHERE username='".$custusername."'";
        $result = Database::selectQuery($query);
        
        if($result == null) {
            return null;
        } 
        if(count($result) > 1){
            return "Unexpected error";
        } else {
            return $result[0]['CustomerId'];
        }
    }
    
    function getAllCustInfoByUsername($custusername) {
        $query = "SELECT * FROM `customers` WHERE username='".$custusername."'";
        $result = Database::selectQuery($query);
        
         if($result == null) {
            return null;
        } 
        if(count($result) > 1){
            return "Unexpected error";
        } else {
            return $result[0];
        }
    }
    
    function getCcInfoByCustId($customerid) {
        $query = "SELECT * FROM `creditcards` WHERE CustomerId='".$customerid."'";
        $result = Database::selectQuery($query);
        if($result == null) {
            return null;
        } else {
            return $result[0];
        }
    }


    function getBookingsByCustomerId($customerid) {
        $query =  "SELECT * FROM `bookings` WHERE CustomerId='" . $customerid . "'";
       
        $result = Database::selectQuery($query);
        
        if($result == null) {
            return null;
        } else {
            return $result;
        }
       // pre($customerid);
    }
    
    function getBookingDetailsByBookingId($bookingid) {
        $query = "SELECT * FROM `bookingdetails` WHERE BookingId='".$bookingid."'";
        $result = Database::selectQuery($query);
        if($result == null) {
            return null;
        } else {
            return $result;
        }
    }
    
    function getBookingsByBookingDetailsId($bookingDetailsId) {
        $query = "SELECT * FROM `bookings` WHERE BookingId='".$bookingDetailsId."'";
        $result = Database::selectQuery($query);
        if($result == null) {
            return null;
        } else {
            return $result;
        }
    }
    
    function getPackageByPackageId($packageid) {
        $query = "SELECT * FROM `packages` WHERE PackageId='".$packageid."'";
        $result = Database::selectQuery($query);
        if($result == null) {
            return null;
        } else {
            return $result[0];
        }
    }
    
    function  getLastBookingIdByCustomerId($custId) {
        $query = "SELECT `BookingId` FROM bookings WHERE CustomerId='$custId' ORDER BY BookingId DESC LIMIT 1";
        $result = Database::selectQuery($query);
        if($result == null) {
            return null;
        } else {
            return $result[0];
        }
    }


    function insertCreditCard($name, $number, $expiry, $custId) {
        $query = "INSERT INTO `creditcards` (CCName, CCNumber, CCExpiry, CustomerId) VALUES ('$name', '$number', '$expiry 00:00:00', '$custId')";
        $result = Database::insertQuery($query);    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    function insertNewBooking($bookingnum, $custid, $pkgId) {
        $query = "INSERT INTO `bookings` (BookingDate, BookingNo, TravelerCount, CustomerId, PackageId) VALUES ('".date("Y-m-d H:i:s")."', '$bookingnum', '1', '$custid', '$pkgId')";
        $result = Database::insertQuery($query);    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function insertNewBookingDetail($itinum, $tripstart, $tripend, $description, $destination, $baseprice, $agcom, $bookingId) {
        $query = "INSERT INTO `bookingdetails` (ItineraryNo, TripStart, TripEnd, Description, Destination, BasePrice, AgencyCommission, BookingId) VALUES ('$itinum', '$tripstart', '$tripend', '$description', '$destination', '$baseprice', '$agcom', '$bookingId')";
        $result = Database::insertQuery($query);    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    function package_list(&$pkgName, &$pkgDesc, &$pkgStartDate, &$pkgEndDate, &$BasePrice)
    {
        $sql = "select * from packages where pkgEndDate >= now();";
        $result = Database::selectQuery($sql);
        
        $pkgName = array();
        $pkgDesc = array();
        $pkgStartDate = array();
        $pkgEndDate = array();
        $BasePrice = array();

        $i = 0;
  
        foreach($result as $a)
        {
            $pkgName[$i] = $a['PkgName'];
            $pkgDesc[$i] = $a['PkgDesc'];
            $pkgStartDate[$i] = $a['PkgStartDate'];
            $pkgEndDate[$i] = $a['PkgEndDate'];
            $BasePrice[$i] = $a['PkgBasePrice'];
            $i++;
        }
    }
?>