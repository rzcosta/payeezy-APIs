
<!-- 
   ################################################################################################
   # This code was written by Ryan Z. Costa in May 2016 as a practice and exercise in HTML & Css. #
   # This is purely for educational purposes and the images used in this page are not mine.       #
   # This is not for business purposes, only personal use and educational practice.               # 
   ################################################################################################
-->
<?php include("hash.php"); ?> 
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
<div class="orderForm"><script type="text/javascript"> 
function forward(){ 
var identifier = '<?php echo $_REQUEST["identifier"]; ?>'; 
if(identifier){ 
/* For Merchant Test Environment (CTE) */ 
document.redirectForm.action="https://connect.merchanttest.firstdataglobalgateway.com/IPGConnect/gateway/processing"; 
/* For Production Environment (PROD) */ 
//document.redirectForm.action="https://connect.firstdataglobalgateway.com/IPGConnect/gateway/processing"; 
document.redirectForm.submit(); 
} 
} 
</script> 
<BODY onLoad="forward()"> 
<?php if ($_REQUEST["identifier"]== NULL ) { ?> 
<P> 
<H1>Order Form </H1> 
<!--<FORM action="/connect_p.php" method=post name="mainform"><BR>--> 
<FORM action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="mainform"><BR> 
<TABLE border=0> 
<TBODY> 
<TR> 
<TD>Transaction Type</TD> 
<TD> 
<INPUT type=radio CHECKED value=sale name=txntype>Sale<BR> 
<INPUT type=radio value=preauth name=txntype>Authorize Only<BR> 
<INPUT type=radio value=postauth name=txntype>Ticket Only<BR> 
<INPUT type=radio value=void name=txntype>Void<BR> 
</TD> 
</TR> 
<TR> 
<TD>* Credit Card Type</TD> 
<TD><SELECT size=1 name=paymentMethod> <OPTION value=V selected>Visa</OPTION> 
<OPTION value=M>MasterCard</OPTION> <OPTION value=A>American 
Express</OPTION> <OPTION value=D>Discover</OPTION> <OPTION value=J>JCB</OPTION> <OPTION value=9>Check</OPTION> 
<OPTION value="">Other</OPTION> 
</SELECT></TD> 
<TR> 
<TR> 
<TD>* Payment Mode:</TD> 
<TD><SELECT name=mode> <OPTION 
value=fullpay>PayOnly</OPTION> <OPTION value=""></OPTION></SELECT> </TD></TR> 
<TR> 
<TD>Transaction Origin</TD> 
<TD> 
<INPUT type=radio CHECKED value=ECI name=trxOrigin>ECI<BR> 
</TD> 
</TR> 
<TR> 
<TD>OrderId</TD> 
<td> 
<input type="text" name="oid" value=""/> 
</td> 
</TR> 
<tr> 
<td>Transaction Date</td> 
<td> 
<input type="text" name="tdate" value=""/> 
</td> 
</tr> 
<TR> 
<TD>* Charge Total:</TD> 
<TD><INPUT value=0.00 name=chargetotal> </TD></TR> 
<TR> 
<TD>* Sub Total:</TD> 
<TD><INPUT value=0.00 name=subtotal> </TD></TR> 
<TR> 
<TD></TD></TR> 
<TR> 
<TD></TD></TR> 
<TR> 
<TD align=middle colSpan=2><INPUT type=submit value="Submit This shit" name=submitBtn></TD></TR></TBODY></TABLE> 
<input type="hidden" name="identifier" value="true" /> 
</FORM> 
<?php } else {?> 
<FORM method="post" id="redirectForm" name="redirectForm"> 
<?php 
$mode = $_REQUEST["mode"]; 
$chargetotal = $_REQUEST["chargetotal"]; 
$subtotal = $_REQUEST["subtotal"]; 
?> 
<input type="hidden" name="timezone" value="<?php echo getTimezone() ?>" /> 
<input type="hidden" name="authenticateTransaction" value="false" /> 
<input size="50" type="hidden" name="paymentMethod" value="<?php echo $_REQUEST["paymentMethod"] ?>"/> 
<input size="50" type="hidden" name="txntype" value="<?php echo $_REQUEST["txntype"] ?>"/> 
<input size="50" type="hidden" name="txndatetime" value="<?php echo getDateTime() ?>" /> 
<input size="50" type="hidden" name="hash" value="<?php echo createHash($chargetotal) ?>" /> 
<input size="50" type="hidden" name="mode" value="<?php echo $mode ?>"/> 
<input size="50" type="hidden" name="storename" value="<?php echo getStorename() ?>"/> 
<input size="50" type="hidden" name="chargetotal" value="<?php echo $chargetotal ?>"/> 
<input size="50" type="hidden" name="subtotal" value="<?php echo $subtotal ?>"/> 
<input size="50" type="hidden" name="trxOrigin" value="<?php echo $_REQUEST["trxOrigin"] ?>"/> 
<input size="50" type="hidden" name="oid" value="<?php echo $_REQUEST["oid"] ?>"/> 
<input size="50" type="hidden" name="tdate" value="<?php echo $_REQUEST["tdate"] ?>"/> 
</FORM> 
<?php } ?> 
		</div>
</div>		
<!-- fixed navbar end -->



<!-- feature start--> 

<div class="grid_12" id=slidehow>


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