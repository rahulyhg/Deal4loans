<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	//echo "last in serted id".$last_id;
	$getCitySql = "select * from Req_Loan_Car where RequestID='".$last_id."'";
	list($Getnum,$ArrRow)=Mainselectfunc($getCitySql,$array = array());
	
	//$getCityQuery = ExecQuery($getCitySql);
	$City = $ArrRow['City'];
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>car motor loans India| compare apply Deal4loans</title>
<meta name="keywords" content="car loans India, Motor Loans India, apply for car loans, car loans eligibility, car loans documents">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans,loan against property, loans against property, loan providers and credit cards. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}

.bldtxt{
font-weight:bold;
color:#4f4d4d;
}


.txt ul{
	margin:0px 0px 0px 2px;
	padding:0px 0px 0px 2px;
}

.txt ul li{
	background: url(images/cl/arrow.gif) no-repeat 0px 4px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}

</style>
<Script Language="JavaScript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
	function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			     
               
       }

       return true;
}
	function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
			     
               
       }

       return true;
}
function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

return true;
}


function submitform(Form)
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
alert("Kindly enter your Date of Birth");
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}
else if((Form.year.value < "1948") || (Form.year.value >"1992"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}

if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}

if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.focus();
return false;
}
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}
if(Form.Employment_Status.selectedIndex==0)
{

	alert("Please select Employment Status to Continue");
	Form.Employment_Status.focus();
	return false;
}

if(Form.Car_Type.selectedIndex==0)
{
	alert("Please enter Car Type  to Continue");
	Form.Car_Type.focus();
	return false;
}

if((Form.Loan_Amount.value==''))
{
	alert("Please enter Loan amount to Continue");
	Form.Loan_Amount.focus();
	return false;
}
if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
}
}

function containsdigit(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
{
return true;
}
}
return false;
}
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
{
return true;
}
}
return false;
}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}
function validateemailv2(email)
{
// a very simple email validation checking.
// you can add more complex email checking if it helps
var splitted = email.match("^(.+)@(.+)$");
if(splitted == null) return false;
if(splitted[1] != null )
{
var regexp_user=/^\"?[\w-_\.]*\"?$/;
if(splitted[1].match(regexp_user) == null) return false;
}
if(splitted[2] != null)
{
var regexp_domain=/^[\w-\.]*\.[a-za-z]{2,4}$/;
if(splitted[2].match(regexp_domain) == null)
{
var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
if(splitted[2].match(regexp_ip) == null) return false;
}// if
return true;
}
return false;
}
function othercity1()
{
if(document.loan_form.City.value=='Others')
{
document.loan_form.City_Other.disabled=false;
}
else
{document.loan_form.City_Other.disabled=true;
}
}


function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}


function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}



function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
</script>
  <script>
		

function adddiv()
{
	//alert("hello");
	var ni = document.getElementById('addRows');
	//if(ni.innerHTML=="")
	//{
		ni.innerHTML = '<table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr><td height="100">&nbsp;</td></tr></table>';
	//}
	
}



</script>

</head>
<body>
<table width="1004" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="200" height="194" align="left" valign="top"><img src="images/cl/hdr1.gif" width="200" height="194"></td>
                <td width="207" align="left" valign="top"><img src="images/cl/hdr2.gif" width="207" height="194"></td>
                <td width="264"><img src="images/cl/hdr3.gif" width="264" height="194"></td>
              </tr>
              <tr>
                <td width="200" height="193" align="left" valign="top"><img src="images/cl/hdr5.gif" width="200" height="193"></td>
                <td width="207" align="left" valign="top"><img src="images/cl/hdr6.gif" width="207" height="193"></td>
                <td width="264" align="left" valign="top"><img src="images/cl/hdr7.gif" width="264" height="193"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td style="padding-left:5px; padding-top:5px; "><table width="100%" bgcolor="#f7f8f8"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" align="left"><table width="99%" align="right"  border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td width="122" height="30" align="left"><img src="images/cl/tst.gif" width="122" height="23"></td>
              </tr>
              <tr>
                <td align="left">Its good that you have broken down the complex components of loan(s) into such easy reads with key points<br>
                  highlighted.... that I can now close out my Car Loan requirement in a more informed manner.... Thanks again. </td>
              </tr>
              <tr>
                <td height="22" align="right" style="padding-right:8px; font-weight:bold; ">- By Pranav </td>
              </tr>
              <tr>
                <td height="30" align="left"><img src="images/cl/tips.gif" width="152" height="23"></td>
              </tr>
              <tr>
                <td align="left" class="txt"><ul>
                  <li>Compare per month emi and processing fee.</li>
                  <li>Discounts and other free bees.</li>
                  <li>Check for whether your bank has tie up with The car Dealer of your choice.</li>
                  <li> Any discounts on Car Insurance.</li>
                  <li> Documents required and disbursal period.</li>
                </ul></td>
              </tr>
              <tr>
                <td height="30" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" id="addRows"></td>
              </tr>
            </table></td>
  </tr>
</table>
</td>
          </tr>
        </table></td>
        <td width="334" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="333" height="194" align="left" valign="top"><img src="images/cl/hdr4.gif" width="333" height="194"></td>
          </tr>
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="317" align="center" valign="top" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2; ">
<form name="loan_form" method="post" action="insert-car-loan-values.php" onSubmit="return submitform(document.loan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Car"><input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>"><input type="hidden" name="source" value="CLQuickapply">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="QArequestid" id="QArequestid" value="<? echo $last_id; ?>">
<input type="hidden" name="Phone" id="Phone" value="<? echo $mobile; ?>">
<input type="hidden" name="Name" id="Name" value="<? echo $name; ?>">
<div align="center" style="color:#FF0000; font-weight:bold;"><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></div>
<table width="92%"  border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
	<td width="40%">&nbsp;</td>
	<td width="60%">&nbsp;</td>
  </tr>
 
  <tr>
	<td height="26" align="left" class="bldtxt">Date of Birth </td>
	<td align="left"><input name="day" value="dd" type="text" id="day" style="width:38px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');">
			<input name="month" id="month" style="width:38px;" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"  onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');">
			<input name="year" type="text" id="year" value="yyyy" style="width:52px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');">	</td>
  </tr>
    <tr>
	<td height="26" align="left" class="bldtxt">City</td>
	<td align="left"><select size="1" align="left" style="width:142px;"  name="City" id="City" onChange="othercity1(this); insertData();" >
           <?=getCityList1($City)?>
         </select></td>
  </tr>
  <tr>
	<td height="26" align="left" class="bldtxt">Other City </td>
	<td align="left"><input style="width:140px;"  disabled value="Other City"  onfocus="this.select();" name="City_Other"  onBlur="onBlurDefault(this,'Other City');"></td>
  </tr>
  <tr>
	<td height="26" align="left" class="bldtxt">Pincode</td>
	<td align="left"><input type="text"  value="" name="Pincode" style="width:140px; " onFocus="this.select();"  maxlength="6" ></td>
  </tr>
  <tr>
    <td height="26" align="left" class="bldtxt">Occupation</td>
    <td align="left"><select  style="width:142px;"   name="Employment_Status" onChange="insertData();">
				<option selected value="-1">Employment Status</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select></td>
  </tr>
  
  <tr>
    <td   colspan="2" align="left" > <span id='formatedIncome' style='font-size:11px;
			font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
			font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
  <tr>
    <td height="26" align="left" class="bldtxt">Interested in </td>
    <td align="left"><select align="left" style="width:142px;"   name="Car_Type">
				<option selected value="-1">Interested In</option>
				<option  value="1">New Car</option>
				<option value="0">UsedCar</option>
				</select></td>
  </tr>
  <tr>
    <td height="26" align="left" class="bldtxt">Car Model </td>
    <td align="left"><input style="width:140px;" value="" name="Car_Model"  id="Car_Model" onFocus="this.select();" ></td>
  </tr>
   <tr>
    <td height="26" align="left" class="bldtxt">Loan Amount </td>
    <td align="left"><input name="Loan_Amount" id="Loan_Amount" tabindex="14" type="text" style="width:140px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /></td>
  </tr>
   <tr>
<td colspan="2" align="left"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
                     
    <tr>
    <td height="50" colspan="2" align="left" style="font-size:9px;"><input type="hidden" name="Activate" id="Activate" ><input type="checkbox"  name="accept" style="border:none; " checked> I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
    </tr>
	<tr>
	   <td  colspan="2" align="left" style="padding:5px;"> <div id="getibibo"></div></td>
		 </tr>
	  <tr>
    <td height="35" colspan="2" align="center" valign="middle"><input  type="image" src="images/cl/quote.gif" style="border: 0px;"></td>
    </tr>
	
</table>
</form>
				</td>
                <td width="14" height="193" align="left" valign="top"><img src="images/cl/rgt-strp.gif" width="14" height="193">
				<img src="images/spacer.gif" width="10" height="209" style=" background-color:#f7f8f8;"></td>
              </tr>
              <tr>
                <td width="319" height="21" align="center" valign="top"  ><img src="images/cl/frm-btm.gif" width="319" height="21"></td>
                <td   align="left" valign="top"><img src="images/spacer.gif" width="10" height="21" style=" background-color:#f7f8f8;"></td>
              </tr>
              <tr>
                <td height="30" align="center" valign="top" bgcolor="#f7f8f8"  >&nbsp;</td>
                <td   align="left" valign="top"><img src="images/spacer.gif" width="10" height="30" style=" background-color:#f7f8f8;"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>
    <tr>
                <td width="319" height="21" align="center" valign="top"  ><img src="images/cl/frm-btm.gif" width="319" height="21"></td>
                <td   align="left" valign="top"><img src="images/spacer.gif" width="10" height="21" style=" background-color:#f7f8f8;"></td>
              </tr>
              <tr>
                <td height="30" align="center" valign="top" bgcolor="#f7f8f8"  >&nbsp;</td>
                <td   align="left" valign="top"><img src="images/spacer.gif" width="10" height="30" style=" background-color:#f7f8f8;"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>