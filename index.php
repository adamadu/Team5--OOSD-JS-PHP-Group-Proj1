<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Travel Experts</title>      
        <!-- jQuery library (served from Google) -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <!-- bxSlider Javascript file -->
        <script src="bxslider/jquery.bxslider.min.js"></script>
        <!-- bxSlider CSS file -->
        <link href="bxslider/jquery.bxslider.css" rel="stylesheet" />
        
        <link rel="stylesheet" href="style.css" type="text/css"/>
        
      <!--  <meta name="viewport" content="initial-scale=1, maximum-scale=1"> -->

    </head>
    <body>
      
        <?php
            require_once 'header.php';
        ?>
        
        <div class="banner">
            <div class="banner_image"> 
                <div class="banner_text">
                    <h1>Welcome to Travel Experts!</h1>
                    <h4>Your source for friendly, affordable and professional travel services!</h4>
                </div>        
            </div>
         <div class="slider">
            <ul class="bxslider">
                <li><h2>Test1</h2><p>"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old."</p></li>
                <li><h2>Test2</h2></li>
                <li><h2>Test3</h2></li>
              </ul>
            <script>
                $('.bxslider').bxSlider({
                    mode: 'horizontal',
                    auto: true,
                    pause: '6000'
                });
            </script>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <h1>About Us:</h1>
            </div>
        </div>
    </body>
</html>