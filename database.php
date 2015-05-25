<?php
/*
 * @author Adam Robinson - May 20-2015
 * I wrote this helper database class to avoid re-typing
 * mysqli connection information everytime we need to query the database.
 * I decided to make this all static (cannot instantiate)
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
    
    //Cannot insert prepared statements
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