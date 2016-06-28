<?
echo"<html><head><title>PHP_FORM_MIN.php LinkPoint Sample </title></head><body><br>";

/*
<!---------------------------------------------------------------------------------
* PHP_FORM_MIN.php - A form processing example showing the minimum 
* number of possible fields for a credit card SALE transaction.
*
* This script processes form data passed in from PHP_FORM_MIN.html
*
*
* Copyright 2003 LinkPoint International, Inc. All Rights Reserved.
* 
* This software is the proprietary information of LinkPoint International, Inc.  
* Use is subject to license terms.
*

		This program is based on the sample SALE_MININFO.php
		
		Depending on your server setup, this script may need to
		be placed in the cgi-bin directory, and the path in the
		calling file PHP_FORM_MIN.html may need to be adjusted
		accordingly.

		NOTE: older versions of PHP and in cases where the PHP.INI
		entry is NOT "register_globals = Off", form data can be
		accessed simply by using the form-field name as a varaible
		name, eg. $myorder["host"] = $host, instead of using the 
		global $_POST[] array as we do here. Passing form fields 
		as demonstrated here provides a higher level of security.

------------------------------------------------------------------------------------>
*/
	include"lphp.php"
	$mylphp=new lphp;

	# constants
	$myorder["host"]       = "staging.linkpt.net";
	$myorder["port"]       = "1129";
	$myorder["keyfile"]    = realpath("1909296826.pem"); # Change this to the name and location of your certificate file 
	$myorder["configfile"] = "1909296826";        # Change this to your store number 

	# form data
	$myorder["cardnumber"]    = $_POST["cardnumber"];
	$myorder["cardexpmonth"]  = $_POST["cardexpmonth"];
	$myorder["cardexpyear"]   = $_POST["cardexpyear"];
	$myorder["chargetotal"]   = $_POST["chargetotal"];
	$myorder["ordertype"]     = $_POST["ordertype"];
	
	/*$myorder["name"]     = $_POST["name"];
	$myorder["company"]  = $_POST["company"];
	$myorder["address1"] = $_POST["address1"];
	$myorder["address2"] = $_POST["address2"];
	$myorder["city"]     = $_POST["city"];
	$myorder["state"]    = $_POST["state"];
	$myorder["country"]  = $_POST["country"];
	$myorder["phone"]    = $_POST["phone"];
	$myorder["fax"]      = $_POST["fax"];
	$myorder["email"]    = $_POST["email"];
	$myorder["addrnum"]  = $_POST["addrnum"];
	$myorder["zip"]      = $_POST["zip"];
	*/
	
	// if ($_POST["periodic"]==true)
		// $myorder["ordertype"] = "PREAUTH";
		// $myorder["action"]       = "SUBMIT";
		// $myorder["installments"] = "3";
		// $myorder["threshold"]    = "3";
		// $myorder["startdate"]    = "immediate";
		// $myorder["periodicity"]  = "monthly"; 
	
	// if ($_POST["cancel"]==true)
		// $myorder["action"] = "CANCEL";
		// $myorder["oid"]  = $_POST["oid"];
		
	
	if ($_POST["debugging"])
		$myorder["debugging"]="true";

  # Send transaction. Use one of two possible methods  #
//	$result = $mylphp->process($myorder);       # use shared library model
	$result = $mylphp->curl_process($myorder);  # use curl methods

	if ($result["r_approved"] != "APPROVED")    // transaction failed, print the reason
	{
		print "Status:  $result[r_approved]<br>\n";
		print "Error:  $result[r_error]<br><br>\n";
	}
	else	// success
	{		
		print "Status: $result[r_approved]<br>\n";
		print "Transaction Code: $result[r_code]<br><br>\n";
	}

# if verbose output has been checked,
# print complete server response to a table
	if ($_POST["verbose"])
	{
		echo "<table border=1>";

		while (list($key, $value) = each($result))
		{
			# print the returned hash 
			echo "<tr>";
			echo "<td>" . htmlspecialchars($key) . "</td>";
			echo "<td><b>" . htmlspecialchars($value) . "</b></td>";
			echo "</tr>";
		}	
			
		echo "</TABLE><br>\n";
	}
	if ($result["r_avs"]!="YYYM")
		$myorder["host"]       = "secure.linkpt.net";
		$myorder["port"]       = "1129";
		$myorder["keyfile"]    = realpath("1909296826.pem"); # Change this to the name and location of your certificate file 
		$myorder["configfile"] = "1909296826";        # Change this to your store number 
		$myorder["ordertype"] = "VOID";
		$myorder["oid"]  = $result["r_ordernum"];
		// if ($_POST["periodic"]==true)
			// $myorder["cardnumber"]    = $_POST["cardnumber"];
			// $myorder["cardexpmonth"]  = $_POST["cardexpmonth"];
			// $myorder["cardexpyear"]   = $_POST["cardexpyear"];
			// $myorder["chargetotal"]   = $_POST["chargetotal"];
			// $myorder["action"]       = "CANCEL";
		print "VOIDING <br>";
		 # Send transaction. Use one of two possible methods  #

		$result = $mylphp->curl_process($myorder);  # use curl methods

		if ($result["r_approved"] != "APPROVED")    // transaction failed, print the reason
		{
			print "Status:  $result[r_approved]<br>\n";
			print "Error:  $result[r_error]<br><br>\n";
		}
		else	// success
		{		
			print "Status: $result[r_approved]<br>\n";
			print "Transaction Code: $result[r_code]<br><br>\n";
		}

?> 

</body></html>
