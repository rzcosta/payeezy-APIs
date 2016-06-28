<?php
/**
* First Data Global Gateway e4℠
*
* Copyright (c) 2004.  All Rights Reserved.
*
* YOUR RIGHTS WITH RESPECT TO THIS SOFTWARE IS GOVERNED BY THE
* TERMS AND CONDITIONS SET FORTH IN THE CORRESPONDING EULA.
*
* Last Updated: May 8, 2006 ----------------- Modified October 5, 2012 by Aaron Sears
*
* A PHP server is required for this sample code and can be downloaded from http://www.php.net 
* PHP 5.1.2 was used for this code.
*
* PHP Extensions required:	
*		php_openssl.dll 		- allows the use of https connections
*								- required files:
*									libeay32.dll	- included in the PHP 5.1.2 package
*									ssleay32.dll	- inlcuded in the PHP 5.1.2 package
*		php_openssl.dll should be inside the 'ext' directory under the PHP installation directory and the required 
*		dependancies are in the root of the PHP installation directory.
* 		The dependencies should be placed in a directory which is part of the windows path or placed in the 'system32' of 
*		the Windows installation directory.
*		php_openssl.dll extension should be enabled in the PHP.ini file used to setup the PHP server.											
*
*		php_soap.dll			- allows the soap communication with the transaction server.
*
*		php_soap.dll should be inside the 'ext' directory under the PHP installation directory.
*		php_soap.dll extension should be enabled in the PHP.ini file used to setup the PHP server.															
*
* For setup of PHP server and activation of PHP extensions please refer to the installation manual included in the 
* PHP 5.1.2 package download.
**/

class SoapClientHMAC extends SoapClient {
  public function __doRequest($request, $location, $action, $version, $one_way = NULL) {
	global $context;
	$hmackey = "ccXZur6p9QjkkoGmje1KPCwq6BuKsJhk"; // <-- Insert your HMAC key here
	$keyid = "322745"; // <-- Insert the Key ID here
	$hashtime = date("c");
	$hashstr = "POST\ntext/xml; charset=utf-8\n" . sha1($request) . "\n" . $hashtime . "\n" . parse_url($location,PHP_URL_PATH);
	$authstr = base64_encode(hash_hmac("sha1",$hashstr,$hmackey,TRUE));
	if (version_compare(PHP_VERSION, '5.3.11') == -1) {
		ini_set("user_agent", "PHP-SOAP/" . PHP_VERSION . "\r\nAuthorization: GGE4_API " . $keyid . ":" . $authstr . "\r\nx-gge4-date: " . $hashtime . "\r\nx-gge4-content-sha1: " . sha1($request));
	} else {
		stream_context_set_option($context,array("http" => array("header" => "authorization: GGE4_API " . $keyid . ":" . $authstr . "\r\nx-gge4-date: " . $hashtime . "\r\nx-gge4-content-sha1: " . sha1($request))));
	}
    return parent::__doRequest($request, $location, $action, $version, $one_way);
  }
  
  public function SoapClientHMAC($wsdl, $options = NULL) {
	global $context;
	$context = stream_context_create();
	$options['stream_context'] = $context;
	return parent::SoapClient($wsdl, $options);
  }
}

$trxnProperties = array(
  "User_Name"=>"",
  "Secure_AuthResult"=>"",
  "Ecommerce_Flag"=>"",
  "XID"=>"",
  "ExactID"=>$_POST["ddlPOS_ExactID"],				    //Payment Gateway
  "CAVV"=>"",
  "Password"=>"grN8ie6ftPaNM3SoZBIVisyx9Q6s8EO0",					                //Gateway Password
  "CAVV_Algorithm"=>"",
  "Transaction_Type"=>$_POST["ddlPOS_Transaction_Type"],//Transaction Code I.E. Purchase="00" Pre-Authorization="01" etc.
  "Reference_No"=>$_POST["tbPOS_Reference_No"],
  "Customer_Ref"=>$_POST["tbPOS_Customer_Ref"],
  "Reference_3"=>$_POST["tbPOS_Reference_3"],
  "Client_IP"=>"",					                    //This value is only used for fraud investigation.
  "Client_Email"=>$_POST["tb_Client_Email"],			//This value is only used for fraud investigation.
  "Language"=>$_POST["ddlPOS_Language"],				//English="en" French="fr"
  "Card_Number"=>$_POST["tbPOS_Card_Number"],		    //For Testing, Use Test#s VISA="4111111111111111" MasterCard="5500000000000004" etc.
  "Expiry_Date"=>$_POST["ddlPOS_Expiry_Date_Month"] . $_POST["ddlPOS_Expiry_Date_Year"],//This value should be in the format MM/YY.
  "CardHoldersName"=>$_POST["tbPOS_CardHoldersName"],
  "Track1"=>"",
  "Track2"=>"",
  "Authorization_Num"=>$_POST["tbPOS_Authorization_Num"],
  "Transaction_Tag"=>$_POST["tbPOS_Transaction_Tag"],
  "DollarAmount"=>$_POST["tbPOS_DollarAmount"],
  "VerificationStr1"=>$_POST["tbPOS_VerificationStr1"],
  "VerificationStr2"=>"",
  "CVD_Presence_Ind"=>"",
  "Secure_AuthRequired"=>"",
  "Currency"=>"",
  "PartialRedemption"=>"",
  "TransarmorToken"=>$_POST["tbPOS_TransarmorToken"],
  "CardType"=>$_POST["tbPOS_CardType"],
  "BankAccountNumber"=>$_POST["tbPOS_BankAccountNumber"],
  "BankRoutingNumber"=>$_POST["tbPOS_BankRoutingNumber"],
  "CustomerName"=>$_POST["tbPOS_CustomerName"],
  "CustomerIDType"=>$_POST["tbPOS_CustomerIDType"],
  "Client_Email"=>$_POST["tbPOS_Client_Email"],
  "Address1"=>$_POST["tbPOS_Address1"],
  "City"=>$_POST["tbPOS_City"],
  "State"=>$_POST["tbPOS_State"],
  "Zip"=>$_POST["tbPOS_Zip"],
  "CountryCode"=>$_POST["tbPOS_CountryCode"],
  "PhoneNumber"=>$_POST["tbPOS_PhoneNumber"],
  "PhoneType"=>$_POST["tbPOS_PhoneType"],
  "CheckNumber"=>$_POST["tbPOS_CheckNumber"],
  "CheckType"=>$_POST["tbPOS_CheckType"],
  // Level 2 fields 
 // "ZipCode"=>$_POST["tbPOS_ZipCode"],
 // "Tax1Amount"=>$_POST["tbPOS_Tax1Amount"],
  //"Tax1Number"=>$_POST["tbPOS_Tax1Number"],
  //"Tax2Amount"=>$_POST["tbPOS_Tax2Amount"],
//"Tax2Number"=>$_POST["tbPOS_Tax2Number"],
  
 // "SurchargeAmount"=>$_POST["tbPOS_SurchargeAmount"],	//Used for debit transactions only
  //"PAN"=>$_POST["tbPOS_PAN"]							//Used for debit transactions only
  );


$client = new SoapClientHMAC("https://api.demo.globalgatewaye4.firstdata.com/transaction/v14/wsdl");
$trxnResult = $client->SendAndCommitCheck
($trxnProperties);


//if(@$client->fault){
    // there was a fault, inform
  //  print "<B>FAULT:  Code: {$client->faultcode} <BR />";
  //  print "String: {$client->faultstring} </B>";
 //   $trxnResult["CTR"] = "There was an error while processing. No TRANSACTION DATA IN CTR!";
//}
//Uncomment the following commented code to display the full results.

//echo "<H3><U>Transaction Properties BEFORE Processing</U></H3>";
//echo "<TABLE border='0'>\n";
//echo " <TR><TD><B>Property</B></TD><TD><B>Value</B></TD></TR>\n";
foreach($trxnProperties as $key=>$value){
//    echo " <TR><TD>$key</TD><TD>:$value</TD></TR>\n";
}
//echo "</TABLE>\n";

//echo "<H3><U>Transaction Properties AFTER Processing</U></H3>";
//echo "<TABLE border='0'>\n";
//echo " <TR><TD><B>Property</B></TD><TD><B>Value</B></TD></TR>\n";
foreach($trxnResult as $key=>$value){
    $value = nl2br($value);
   // echo " <TR><TD valign='top'>$key</TD><TD>:$value</TD></TR>\n";
}
//echo "</TABLE>\n";


// kill object
unset($client);
?>
<!-- 
   ################################################################################################
   # This code was written by Ryan Z. Costa in May 2016 as a practice and exercise in HTML & Css. #
   # This is purely for educational purposes and the images used in this page are not mine.       #
   # This is not for business purposes, only personal use and educational practice.               # 
   ################################################################################################
-->

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

	

	
	
	
	
<!-- static navbar end --> 


<!-- fixed navbar start --> 

		<div id="header" class="grid_12">
			<img src="images/logo.png" id="upperlogo"/>
				<div id="nav">
					<ul> 
						<li id="navStyle"><a href="index.html">Home</a> </li>
						<li id="navStyle"><a href="order.php">Connect 2.0</a> </li>
						<li id="navStyle"><a href="https://rzwebsolutions.com/webstore/">Woocommerce</a> </li>
						<li id="navStyle"><a href="equid.html">EQUID</a> </li>
						<li id="navStyle"><a href="recurring.html">Recurring</a> </li>
						<li id="navStyle"><a href="telecheck.html">Telecheck</a> </li>
					</ul>
				</div>
		</div>
		
<!-- fixed navbar end -->

<div  class="grid_12" id="telecheck2">
	
						<?php 
							foreach($trxnResult as $key=>$value){
								if ($key == "CTR") {
								    $value = nl2br($value);
									print $value;
								}
							}
						?>
						</br>
 <button onclick="myFunction()">Print this page</button>
</div>


		
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
	<script>
function myFunction() {
    window.print();
}
</script>
	</body>
	</html>