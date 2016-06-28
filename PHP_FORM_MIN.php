<?php
echo"<html><head><title>PHP_FORM_MAX.php LinkPoint Sample </title></head><body><br>";

	include"lphp.php";
	$mylphp=new lphp;

	# constants
	$myorder["host"]       = "staging.linkpt.net";
	$myorder["port"]       = "1129";
	$myorder["keyfile"]    = realpath("1909808769.pem"); # Change this to the name and location of your certificate file 
	$myorder["configfile"] = "1909808769";        # Change this to your store number 

	
	$myorder["ordertype"]   	= $_POST["ordertype"];
	$myorder["oid"]         	= $_POST["oid"];
	//$myorder["tdate"] 			= $_POST["tdate"];
	$myorder["cardnumber"] 		= $_POST["cardnumber"];
	$myorder["cardexpmonth"]	= $_POST["cardexpmonth"];
	$myorder["cardexpyear"] 	= $_POST["cardexpyear"];
	$myorder["chargetotal"] 	= $_POST["chargetotal"];
	$myorder["recurring"] 	= $_POST["recurring"];
	$myorder["installments"] 	= $_POST["installments"];
	$myorder["periodicity"] 	= $_POST["periodicity"];
	$myorder["startdate"] 	= $_POST["startdate"];
	$myorder["threshold"] 	= $_POST["threshold"];

	if ($_POST["debugging"])
		$myorder["debugging"]="true"; 


#   Send transaction. Use one of two possible methods 
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
		
		echo "</table><br>\n";
	}
?>

</body></html>
