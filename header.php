<?php

    if(!isset($_SESSION['loggedin_user'])) {
         print("
            <div class='header'>
                <div class='container'>
                    <div class='header_content'>
                        <div class='logo'> 
                            <a href='index.php'> 
                                <img src='images/main_logo1.png'>
                            </a>
                        </div>
                        <div class='nav_links'>
                            <ul>
                                <li><a href='index.php'>Home</a> </li>
                                <li><a href='vacation_packages.php'>Packages</a> </li>
                                <li><a href='register.php'>Register</a> </li>                               
                                <li><a href='contact.php'>Contact Us</a> </li>
                                <li><a href='custlogin.php'>Login</a> </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <div class='clearboth'></div>
            </div>
            ");
    } else {
         print("
            <div class='header'>
                <div class='container'>
                    <div class='header_content'>
                        <div class='logo'> 
                            <a href='index.php'> 
                                <img src='images/main_logo1.png'>
                            </a>
                        </div>
                        <div class='nav_links'>
                            <ul>
                                <li><a href='index.php'>Home</a> </li>
                                <li><a href='vacation_packages.php'>Packages</a> </li>
                                <li><a href='profile.php'>My Profile</a> </li>                               
                                <li><a href='contact.php'>Contact Us</a> </li>
                                <li><a href='vieworders.php'>My Orders</a> </li>
                                <li><a href='logout.php'>Log Out</a> </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <div class='clearboth'></div>
            </div>
        ");
    }
  
?>