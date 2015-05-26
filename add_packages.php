<?php

    require_once 'functions.php';
?>
<!----dhtmlxCalendar v.4.2.1 Standard edition (c) Dinamenta, UAB---->
<html>
<head>
    <title>Add Vacation Package</title>
    <meta name="keywords" content="travel agency, travel, agency">
    <meta name="author" content="Tuan Quan">

    <link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="./codebase/dhtmlxcalendar.css"/>
	
	<script src="./codebase/dhtmlxcalendar.js"></script>
	<style>
		#calendar_input {
			border: 1px solid #909090;
			font-family: Tahoma;
			font-size: 12px;
		}
		#calendar_icon {
			vertical-align: middle;
			cursor: pointer;
		}
	</style>
	<script>
		var myCalendar;
		function doOnLoad() {
			myCalendar = new dhtmlXCalendarObject({input: "calendar_input", button: "calendar_icon"});
		}
	</script>
</head>
<body onload="doOnLoad();">

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
                    <tr><th colspan="2"><h2><img src="./images/logo.jpg" />Add Vacation Packages</h2> <th></tr>
                    <tr>
                        <th>Package Name: </th>
						<td><input type=\"text\" id=\"PkgName\" name=\"PkgName\" size=\"20\"></td>
					</tr>
						<th>Package Description: </th>
                        <td><input type=\"text\" id=\"PkgDesc\" name=\"PkgDesc\" size=\"50\"></td>
					</tr>

                    <tr><th>Package Start Date:</th>
						<td><input type=\"datetime\" id=\"PkgStartDate\" name=\"PkgStartDate\" size=\"10\"></td>
					</tr>

                    <tr><th>Package End Date:</th>
                        <td><input type=\"datetime\" id=\"PkgEndDate\" name=\"PkgEndDate\" size=\"10\"></td>
					</tr>

                    <tr><th>Base Price:</th>
						<td><input type=\"number\" id=\"BasePrice\" name=\"PkgBasePrice\" size=\"10\"></td>
					</tr>
                   
					<tr>
						<td colspan="2">
						<input type="submit" value="Add Now!" onClick=\"return confirm('Are you sure you want to submit?')\" />

						<input type="reset" value="Reset" onClick=\"return confirm('Are you sure you want to reset?')\" /> 
						</td>
					<tr>
				</table>
            </form>

 
        </div>
    </div>
</body>

</html>
