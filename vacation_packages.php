<!--
 * Vacation Package selection page
 * Allows the customer to select which package they would like to order. Dynamically created and validated for start/end dates.
 *
 * Written by: Tuan - 18-May - Last Edited: 26-May
 * Last edited by Adam: 24-May (I added the session information)
 * OOSD APR 23 2015 - Threaded Project Workshop 1 - Team 5
-->

<?php
    session_start();
    require_once 'functions.php';
    if(count($_POST) > 0) {
        $message;
        if(isset($_POST['PkgName'])) {
            if(isset($_SESSION['loggedin_user'])) {
                $_SESSION['slcpkgid'] = ($_POST['PkgName'] + 1);
                header("Location: order.php");
            } else {
                header("Location: custlogin.php");
            }
        } else {
            $message = "Please select a package";
        }
    }
?>

<html>
<head>
    <title>Vacation Package</title>
    <meta name="keywords" content="travel agency, travel, agency">
    <meta name="author" content="Tuan Quan">

    <link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>

  <?php
	require_once("header.php");
   ?>
   <div class="pages_heading">
            <div class="container"><h1> OUR PACKAGES: </h1></div>
        </div>
   
    <div class="wrap">
        <div class="container">	
            <form name="packages" method="post">
                <table>
                    <tr><th colspan="2"><h2><img src="./images/logo.jpg" />Vacation Packages</h2> <th></tr>
                    <tr>
                        <th>Package Name: </th>
                        <td><select name="PkgName" id="select1" onchange="changePackage()">
                                <option value="" disabled selected>Select your vacation package</option>
				<?php
                                    $pkgName_array = array();
                                    $pkgDesc_array = array();
                                    $pkgStartDate_array = array();
                                    $pkgEndDate_array = array();
                                    $BasePrice_array = array();

                                    package_list($pkgName_array, $pkgDesc_array, $pkgStartDate_array,$pkgEndDate_array, $BasePrice_array);

                                    for ($i=0; $i < count($pkgName_array); $i++)
                                    {
                                        print ("<option value= \"$i\">$pkgName_array[$i]" . "</option>");
                                    }

                                    print("\r\n       </select></td></tr>");

                                    print("\r\n  <tr><th>Package Description:</th>");

                                    print("\r\n  <td><input readonly type=\"text\" id=\"PkgDesc\" name=\"PkgDesc\" size=\"50\"></td></tr> ");

                                    print("\r\n  <tr><th>Package Start Date:</th>");

                                    print("\r\n  <td><input readonly type=\"datetime\" id=\"PkgStartDate\" name=\"PkgStartDate\" size=\"10\"></td></tr> ");

                                    print("\r\n  <tr><th>Package End Date:</th> ");
                                    print("\r\n  <td><input readonly type=\"datetime\" id=\"PkgEndDate\" name=\"PkgEndDate\" size=\"10\"></td></tr>");

                                    print("\r\n  <tr><th>Base Price:</th><td>$<input readonly type=\"number\" id=\"BasePrice\" name=\"PkgBasePrice\" size=\"10\"></td></tr>");
                                    if(isset($message)) {
                                        print("<tr> <td colspan='2' class='errmessage'>".$message."</td> </tr>");
                                    }
                                    print("\r\n  </table>");

                                    print("\r\n <input type=\"submit\" value=\"Book Now!\" onClick=\"return confirm('Are you sure you want to submit?')\" /> ");

                                    //print("\r\n <input type=\"reset\" value=\"Reset\" onClick=\"return confirm('Are you sure you want to reset?')\" /> ");

                                    print("\r\n  </form>");

                                    print("\r\n <script>");
                                    print("\r\n function changePackage() {");

                                    print("\r\n var index_value = document.getElementById('select1').selectedIndex;");

                                    // Package Description
                                    print ("\r\n var pkgDesc = [");
                                    for ($i=0; $i < count($pkgDesc_array) - 1; $i++)
                                    {
                                       print ("\"" . $pkgDesc_array[$i] . "\",");
                                    }
                                    print ("\"" . $pkgDesc_array[$i] . "\"];");

                                    print("\r\n document.getElementById('PkgDesc').value = pkgDesc[index_value -1];");

                                    // Start Date
                                    print ("\r\n var pkgStartDate = [");
                                    for ($i=0; $i < count($pkgStartDate_array) - 1; $i++)
                                    {
                                       print ("\"" . chop($pkgStartDate_array[$i], "00:00:00") . "\",");
                                    }
                                    print ("\"" . chop($pkgStartDate_array[$i], "00:00:00") . "\"];");

                                    print("\r\n document.getElementById('PkgStartDate').value = pkgStartDate[index_value -1];");

                                    // End Date
                                    print ("\r\n var pkgEndDate = [");
                                    for ($i=0; $i < count($pkgEndDate_array) - 1; $i++)
                                    {
                                       print ("\"" . chop($pkgEndDate_array[$i], "00:00:00") . "\",");
                                    }
                                    print ("\"" . chop($pkgEndDate_array[$i], "00:00:00") . "\"];");

                                    print("\r\n document.getElementById('PkgEndDate').value = pkgEndDate[index_value -1];");

                                    // Based Price
                                    print ("\r\n var BasePrice= [");
                                    for ($i=0; $i < count($BasePrice_array) - 1; $i++)
                                    {
                                       print ("\"" . $BasePrice_array[$i] . "\",");
                                    }
                                    print ("\"" . $BasePrice_array[$i] . "\"];");
                                    print("\r\n document.getElementById('BasePrice').value = BasePrice[index_value -1];");
									
									// Check if start date is less than current date
									
									print("\r\n var today = new Date();");
	
									print("\r\n var secondValue = document.getElementById('PkgStartDate').value;");
		
									print("\r\n var secondValue = secondValue.substring(0,10);");
		
									print("\r\n var secondValue = secondValue.split('-');");
									print("\r\n var secondDate = new Date(secondValue[0],secondValue[1]-1,secondValue[2]);");
	
							echo ("if (today > secondDate) " 
								. "{"   
								. " document.getElementById('PkgStartDate').className = \"startDateMessage \"; }"
								. " else { document.getElementById('PkgStartDate').className = \"\";}"
								);

                                    print("\r\n  } ");
                                    print("\r\n  </script>");


                                ?>
        </div>
    </div>
    <?php
        require_once 'footer.php';
    ?>
</body>

</html>
