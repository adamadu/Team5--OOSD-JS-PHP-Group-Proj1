<!--
 * Logout Page
 * Allows the logged in user to logout. Prob don't need this (could just do it in a function)
 * Written by: Adam - Last edited: 22-May
 * OOSD APR 23 2015 - Threaded Project Workshop 1 - Team 5
-->

<?php
    session_start();
    require_once 'functions.php';
    if(!isset($_SESSION['loggedin_user'])) {
        header("Location: index.php");
    } else {
        logout();
    }
   
?>
