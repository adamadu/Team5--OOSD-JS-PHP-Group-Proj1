<?php
/*
 * Written by Adam Robinson - May 20-2015
 * I wrote this helper database class to avoid re-typing mysqli connection information everytime we need to query the database.
 * This class is pure static (cannot instantiate)
 * OOSD APR 23 2015 - Threaded Project Workshop 1 - Team 5
 */
class Database {
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $name = "travelexperts";
    
    private static function connect() {
        mysqli_report(MYSQLI_REPORT_STRICT);
        $connection = false;
        try {
            $connection = mysqli_connect(self::$host, self::$user, self::$pass, self::$name);
        } catch (Exception $ex) {
          
        }
        return $connection;
    }
    
    private static function closeConn($connection) {
        mysqli_close($connection);
    }
    
    /*
     * This function will (1)open a connection (2)run a select query on the database
     * (3) Return the result as an assosiative array (4) close the connection
     */
    public static function selectQuery($queryString) {
        $connection = self::connect();
        $return = null;
        if($connection != false) {
             try {
                $result = mysqli_query($connection, $queryString); 
                if ($result)  {
                    $return = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    mysqli_free_result($result);
                } else {
                    //throw new Exception;
                    echo 'Unable to fetch result' .  mysqli_error($connection);
                }    
            } catch (Exception $ex) {echo $ex;}  
            self::closeConn($connection);
        }     
        return $return;
    }
    
    /*
     * This function will (1)open a connection (2)run an INSERT or UPDATE query on the database
     * (3) Return the result as true(it was sucessfull) or false (unsucessfull) (4) close the connection
     */
    //Note - Cannot insert prepared statements
    public static function insertQuery($queryString) {
        $connection = self::connect();
        $return = false;
        if($connection != false) {
            try {
                $result = mysqli_query($connection, $queryString); 
                if($result) {
                    $return = true;
                } else {
                    echo mysqli_error($connection);
                }
            } catch (Exception $ex) {
                echo $ex;
            }
            self::closeConn($connection);
        }
        return $return;
    }   
}

?>