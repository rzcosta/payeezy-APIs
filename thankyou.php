
<!-- 
   ################################################################################################
   # This code was written by Ryan Z. Costa in May 2016 as a practice and exercise in HTML & Css. #
   # This is purely for educational purposes and the images used in this page are not mine.       #
   # This is not for business purposes, only personal use and educational practice.               # 
   ################################################################################################
-->
<?php include("/working code/Connect 2/hash.php"); ?> 
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title> Dev Site</title>
	<meta name="practice" content="Javascript">
	<meta name="Ryan C" content="RZwebsolutions">
	<link rel="stylesheet" type="text/css" href="css/960_12_col.css">
</head>

<style>
body {
		background-image: url("images/bg.png")!important;
	}
</style>

<body>


<div class="container_12 clearfix">

<!--static  navbars  start--> 
<div id="header" class="grid_12">
			<img src="images/logo.png" id="upperlogo"/>
				<div id="nav">
					<ul> 
						<li id="navStyle"><a href="index.html">Home</a> </li>
						<li id="navStyle"><a href="order.php">Connect 2.0</a> </li>
						<li id="navStyle"><a href="https://rzwebsolutions.com/webstore/">Woocommerce</a> </li>
						<li id="navStyle"><a href="equid.html">EQUID</a> </li>
						<li id="navStyle"><a href="recurring.html">Recurring</a> </li>
					</ul>
				</div>
		</div>
			
<!-- static navbar end --> 


<!-- fixed navbar start --> 

		<div id="header" class="grid_12">

<div class="orderForm1">	<?php
echo "<pre>"; print_r($_POST) ;  echo "</pre>";
?></div>

		</div>
	
<!-- fixed navbar end -->



<!-- feature start--> 




<!-- footer begin --> 

					<div id="footer" class="grid_12">
						<p id="cpyright" >
						&copy; Copyright 2016</p> 
										<img src="images/facebook.png" id="socialButtons" >
										<img src="images/twitter.png" id="socialButtons" >
										<img src="images/reddit.png" id="socialButtons"> 
										<img src="images/pintrest.png" id="socialButtons">
										
										
	
	<!-- search bar start --> 
			<form action="action_page.php">
			<input type="search" id="searchbar">
			<input type="submit" id="searchbutton">
			</form>
</div>
<!-- footer end --> 

	</div><!-- .container_12 -->
	</body>
	</html>