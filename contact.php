<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Travel Experts - Contact Us</title> 
        
      
        
        <script src="http://maps.googleapis.com/maps/api/js"></script>
        <script>
            function initialize() {
                var location1 = new google.maps.LatLng(51.046286,-114.088560);
                var mapProp = {
                  center:location1,
                  zoom:10,
                  mapTypeId:google.maps.MapTypeId.ROADMAP
                };
                var marker=new google.maps.Marker({
                    position:location1,
                });
                var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
       
                marker.setMap(map);
        
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
          <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    
    <body>
        <?php
            require_once 'header.php';
        ?>
        
        <div class="pages_heading">
            <div class="container"><h1> CONTACT US: </h1></div>
        </div>
        <div class='wrap'>
            
        <?php
        require_once 'functions.php';
            if (getAgencies() != null) {
                
                $agencies = getAgencies();
                
                foreach($agencies as $agency => $value) {                 
                    $agentsById = getAgentsByAgencyId($value['AgencyId']);
                    $agentsString = "";
                    foreach($agentsById as $name => $info) {
                        //pre($info);
                        $agentsString .= "<tr> "
                                . "<td>". $info['AgtFirstName'] ."</td> "
                                . "<td>". $info['AgtLastName'] ."</td> "
                                . "<td>". $info['AgtBusPhone'] ."</td> "
                                . "<td>". $info['AgtEmail'] ."</td> "
                                . "<td>". $info['AgtPosition'] ."</td> "
                                . "</tr>";
                    }
                    echo("                            
                        <div class='container'>
                            <div class='agencymap'>
                                <div class='agency'>
                                <table>
                                    <tr>
                                        <th colspan='2'><h2> Agency #". $value['AgencyId'] . "</h2></th>
                                    </tr>
                                    <tr>
                                        <th> Address: </th>
                                        <td>". $value['AgncyAddress'] ."</td>
                                    </tr>
                                    <tr>
                                        <th> City: </th>
                                        <td>". $value['AgncyCity'] ."</td>
                                    </tr>
                                    <tr>
                                        <th> Province: </th>
                                        <td>". $value['AgncyProv'] ."</td>
                                    </tr>
                                    <tr>
                                        <th> Postal: </th>
                                        <td>". $value['AgncyPostal'] ."</td>
                                    </tr>
                                    <tr>
                                        <th> Country: </th>
                                        <td>". $value['AgncyCountry'] ."</td>
                                    </tr>
                                    <tr>
                                        <th> Phone: </th>
                                        <td>". $value['AgncyPhone'] ."</td>
                                    </tr>
                                    <tr>
                                        <th> Fax: </th>
                                        <td>". $value['AgncyFax'] ."</td>
                                    </tr>
                                </table>
                            </div>
                            <div id='googleMap'></div>
                            <div style='clear:both'></div>
                            </div>
                            <div class='agents'>
                                <table>
                                    <tr>
                                        <th colspan='5'> <h2> Agents at this location </h2> </th>
                                    </tr>
                                    <tr>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Phone Number: </th>
                                        <th> Email </th>
                                        <th> Position </th>
                                    </tr>
                                " . $agentsString . "   
                                </table>
                            </div>
                        </div>
                    ");                                    
                }
            }
        ?>
        </div>
    </body>
</html>