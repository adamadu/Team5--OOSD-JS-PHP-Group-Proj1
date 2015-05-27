<!--
 * Main page that the customer first sees
 * Written by: Adam - Last edited: 26-May
 * OOSD APR 23 2015 - Threaded Project Workshop 1 - Team 5
-->


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
                <li><h2>Highlight Review 1</h2><p>"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old."</p></li>
                <li><h2>Highlight Review 2</h2><p>"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old."</p></li>
                <li><h2>Highlight Review 2</h2><p>"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old."</p></li>
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
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <div class="aboutcontainer">
                    <div class='aboutimage'> <img src="images/piggy-bank.jpg"> </div>
                    <div class='abouttext'>
                        <h2>Affordable Packages</h2>
                        <p>With our ongoing special offers on packages, booking the perfect trip won't break the bank. </p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                 </div>    
                  <div class="aboutcontainer">  
                    <div class='aboutimage'> <img src="images/beach-girl.jpg"> </div>              
                    <div class='abouttext'>
                        <h2>Plan your dream Vacation</h2>
                        <p> Browse our packages and plan your trip just the way you want to. </p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                  </div>   
               
               <!-- <div class="aboutimage">
                    <img src="images/beach-girl.jpg">
                </div>-->
            </div>
        </div>
        
       <?php
       require_once 'footer.php';
       ?>
    </body>
</html>