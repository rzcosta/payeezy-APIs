<?php
include"lphp.php";
$newphp=new lphp;
$xml =" <order>		
		<orderoptions>
			<ordertype>SALE</ordertype>
		</orderoptions>
		<merchantinfo>
			<configfile>1909215966</configfile>
		</merchantinfo>
		<creditcard>
			<cardnumber>4111111111111111</cardnumber>
			<cardexpmonth>01</cardexpmonth>
			<cardexpyear>22</cardexpyear>
			<cvmvalue>123</cvmvalue>
			<cvmindicator>provided</cvmindicator>
		</creditcard>
        <payment>
            <chargetotal>99.99</chargetotal>
        </payment>
		<billing>
			<name>Hank Scorpio</name>
			<company>Not Sketchy LLC</company>
			<address1>4564 Fake Street</address1>
			<city>Caldeum</city>
			<state>AL</state>
			<zip>12345</zip>
			<country>US</country>
		</billing>
		<transactiondetails>
			<oid>ITSANORDER</oid>
			<ponumber>STILLANORDER</ponumber>
			<invoice_number>ORDER</invoice_number>
			<recurring>Yes</recurring>
		</transactiondetails>	
		<periodic>
			<action>SUBMIT</action>
			<installments>23</installments>
			<threshold>3</threshold>
			<periodicity>d7</periodicity>
			<startdate>immediate</startdate>
		</periodic>	
    </order>";

	$myorder["host"]      = "staging.linkpt.net"; 
	$myorder["port"]      = "1129";
	$myorder["keyfile"]    = realpath("1909215966.pem"); 
	$myorder["xml"]       = $xml;


	$result = $newphp->curl_process($myorder); 

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