<?

# PASS_XML.pl - example of how to send and recieve an XML string
#
# In this sample, the merchant would be doing their own XML encoding/decoding
#
# This sample does only a minimal SALE transaction, but it can be
# used as an example of passing in larger XML strings for more complex
# transactions. Any of the included LinkPoint XML sample files could be 
# passed in as an XML string here. 
#
# Copyright 2003 LinkPoint International, Inc. All Rights Reserved.
# 
# This software is the proprietary information of LinkPoint International, Inc.  
# Use is subject to license terms.

	
	include"lphp.php";
	$mylphp=new lphp;


/*	The formatting of the XML in this sample is only for example 
	purposes and human-readability; in real life it would typically
	be all one long unbroken line. */
	$xml ="
		<order>
			<merchantinfo>
				<configfile>1909812854</configfile>
			</merchantinfo>
			<oderoptions>
				<odertype>sale</ordertype>
				<result>good</result>
			</oderoptions>
			<payment>
				<chargetotal>1.00</chargetotal>
			</payment>
			<creditcard>
				<cardnumber>4005550000000019</cardnumber>
				<cardexpmonth>10</cardexpmonth>
				<cardexpyear>17</cardexpyear>
				<Cvmvalue>123</Cvmvalue>
				<Cvmindicator>provided</Cvmindicator>
			</creditcard>
			<billing>
				<bName>John Doe</bName>
				<bAddress1>1211 Test Street</bAddress1>
				<bState>PA</bState>
				<bZip>55555</bZip>
				<bPhone>5555555555</bPhone>
				<bEmail>kormakr.myron@firstdata.com</bEmail>
				<bAddrnum>1211</bAddrnum>
				<bUserid>bob</bUserid>
			</billing>
			<shipping>
				<sName>Jeff Dhamer</sName>
				<sAddress1>1523 Dhamer way</sAddress1>
				<sCity>Tyrone</sCity>
				<sState>PA</sState>
				<sZip>16686</sZip>
				<sCountry>US</sCountry>
				<sPhone>1234567891</sPhone>
				<sEmail>kormakr.myron@firstdata.com</sEmail>
				<sweight>15</sweight>
				<sItems>15</sItems>
				
		</order>
			";

	$myorder["host"]      = "staging.linkpt.net"; 
	$myorder["port"]      = "1129";
	$myorder["keyfile"]   = realpath("1909812854.pem"); # change this to the name and location of your certificate file
	$myorder["xml"]       = $xml;
//  $myorder["debugging"] = "true"; # for development only; not intended for production use


  # Send transaction. Use one of two possible methods #
//	$result = $mylphp->process($myorder);		# use shared library model
	$result = $mylphp->curl_process($myorder);  # use curl methods

	if (strlen($result) < 2)    # no response
	{
		$result = "<r_error>Could not execute curl.</r_error>"; 
	}
    echo "Response: $result\n";

	# Process the XML from here.... 
	

	
	# Or OPTIONALLY - you could convert XML response to a readable array
	preg_match_all ("/<(.*?)>(.*?)\</", $result, $outarr, PREG_SET_ORDER);
	
	$n = 0;
	while (isset($outarr[$n]))
	{
		$retarr[$outarr[$n][1]] = strip_tags($outarr[$n][0]);
		$n++; 
	}

	# and then look at it like this
	while (list($key, $value) = each($retarr))
		echo "$key = $value \n";
	# and use the hash elements that you need
?>
