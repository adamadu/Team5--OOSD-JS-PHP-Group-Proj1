<?php
    session_start();
    require_once 'functions.php';
    if(!isset($_SESSION['loggedin_user'])) {
        header("Location: index.php");
    } else {
        logout();
    }
   
?>
