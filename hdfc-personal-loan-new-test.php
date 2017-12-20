<?php
require 'scripts/functions.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>HDFC Personal Loan</title>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-hdfc-pllist.js"></script>
<link href="css/hdfc_pl-new.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script Language="JavaScript" Type="text/javascript">
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

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var myOption;
	var i;
	
	if((Form.full_name.value=="") || (Form.full_name.value=="Name")|| (Trim(Form.full_name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.full_name.focus();
		return false;
	}
	else if(containsdigit(Form.full_name.value)==true)
	{
		alert("Name contains numbers!");
		Form.full_name.focus();
		return false;
	}
	for (var i = 0; i < Form.full_name.value.length; i++) {
	if (iChars.indexOf(Form.full_name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		Form.full_name.focus();
		return false;
	}
	}
		
			
	if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
		alert("Kindly fill in your Mobile Number!");
		Form.Phone.focus();
		return false;
	}
	 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
				  alert("Enter numeric value in ");
				  Form.Phone.focus();
				  return false;  
			}
			else if (Form.Phone.value.length < 10 )
			{
					alert("Please Enter 10 Digits"); 
					 Form.Phone.focus();
					return false;
			}
	else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
				alert("The number should start only with 9 or 8 or 7");
				Form.Phone.focus();
				return false;
			}
	if(Form.email_id.value!="Email Id")
		{
			if (!validmail(Form.email_id.value))
			{
				//alert("Please enter your valid email address!");
				Form.email_id.focus();
				return false;
			}
			
		}

	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}
	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
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
function Trim(strValue)
	{
		var j=strValue.length-1;i=0;
		while(strValue.charAt(i++)==' ');
		while(strValue.charAt(j--)==' ');
		return strValue.substr(--i,++j-i+1);
	}

	</script>
</head>
<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="965"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="77%" height="74"><img src="new-images/hdfc-pl/hdfcbank_logo.gif" width="171" height="29"></td>
            <td width="23%"><img src="new-images/hdfc-pl/deal4loans_logo.gif" width="200" height="54"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" height="290" align="left" valign="top"><img src="new-images/hdfc-pl/hdr1.gif" width="200" height="290"></td>
            <td width="187"><img src="new-images/hdfc-pl/hdr2-new.gif" width="187" height="290"></td>
            <td width="202"><img src="new-images/hdfc-pl/hdr3-new.gif" width="202" height="290"></td>
            <td width="193" align="left" valign="top"><img src="new-images/hdfc-pl/hdr4-new.gif" width="193" height="290"></td>
            <td width="183" align="left" valign="top"><img src="new-images/hdfc-pl/hdr5.gif" width="183" height="290"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="3"></td>
      </tr>
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="679" align="left" valign="top"  >
			

			<table width="679"  border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="679" valign="top" class="stepbg"><table width="655" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td height="35" align="left" valign="middle" class="stepdng">Two Steps to Know your Eligibility</td>
    </tr>
  <tr>
    <td height="65" class="steptxt" style="color:#4f4d4d; ">1. Just Fill in your Details 

      <br>
      2. Choose to Get Online Quote or Chat Online with Bank Representative</td>
    </tr>
</table>
</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
              </tr>
              <tr>
        <td height="33" bgcolor="#f6f6f6" class="hdng">Features of HDFC Bank Personal Loan</td>
              </tr>
              <tr>
                <td><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="21"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td width="522" height="35" class="blutxt" >Get cash loan upto 15 Lacs<br></td>
                    <td width="24"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td width="348" class="blutxt" >Get loans for 12 to 60 months</td>
                  </tr>
                  <tr>
                    <td width="21"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td height="35" class="blutxt" >Rate of Interest ranges between 15.5-22 %</td>
                    <td width="24"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td class="blutxt" >Repay in easy EMIs</td>
                  </tr>
                  <tr>
                    <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td height="35" class="blutxt" >No collateral requirement</td>
                    <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td class="blutxt" >Easy Documentation</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="276" height="369"  align="right" valign="top" class="rgtfrmbg"><form name="hdfc_calc" method="POST" action="hdfc-personal-loan-new-continue-test.php" onSubmit="return chkpersonalloan(document.hdfc_calc);">
              <table width="92%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr align="center">
                  <td height="55" colspan="2" class="stepdng">Apply Here </td>
                  </tr>
                <tr>
                  <td width="37%" height="29" align="left" class="boldtxt">Name</td>
                  <td width="63%" align="left"><input name="full_name" id="full_name" type="text" style="width: 145px;" tabindex="1" /></td>
                </tr>
                <tr>
                  <td height="29" align="left" class="boldtxt">Mobile</td>
                  <td align="left" class="boldtxt"><font style="font-family: verdana; font-size:10px; font-weight:normal; "> +91</font>
                      <input type="text" style="width:117px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);"  tabindex="2"/></td>
                </tr>
                <tr>
                  <td height="29" align="left" class="boldtxt">Email Id</td>
                  <td align="left"><input name="email_id" id="email_id" type="text" tabindex="3"    style="width: 145px;" /></td>
                </tr>
				<tr>
                  <td height="29" align="left" class="boldtxt">City</td>
                  <td align="left"><select name="City" id="City"  style="width: 149px; font-size:13px;" onchange="othercity1();  insertData();" tabindex="4">
                      <?=plgetCityList($City)?>
                  </select></td>
                </tr>
                <tr>
                  <td height="29" align="left" class="boldtxt"> Net Salary<br>
                      <font style="font-family: verdana; font-size:10px; font-weight:normal; ">(Per month)</font></td>
                  <td align="left"><input type="text" name="net_salary" id="net_salary" style="width:145px;" onkeyup="intOnly(this); getDigitToWords('net_salary','formatedIncome','wordIncome');" onkeypress=" getDigitToWords('net_salary','formatedIncome','wordIncome'); intOnly(this);"  onblur="getDigitToWords('net_salary','formatedIncome','wordIncome');" tabindex="5" /></td>
                </tr>
              <tr>
                    <td height="35" colspan="2"  valign="middle"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#b04c09;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#b04c09;font-Family:Verdana;text-transform: capitalize;'></span></td>
<td colspan="2"  ></td></tr>
			    <tr>
                  <td height="29" colspan="2" align="left" class="boldtxt">To get your E-approval you want to:
</td>
                  </tr>
                
                    <tr align="left">
                  <td colspan="2"  valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9%" align="left"><input type="radio" value="emi" name="approvel" style="border:0px;" tabindex="6" checked ></td>
                      <td width="91%" height="25" align="left"><font style="font-family: verdana; font-size:10px; font-weight:bold; ">Get Online Quote of Eligible Loan Amount, Rate of Interest & EMI
</font>
</td>
                    </tr>
                 
				    <tr>
                      <td align="left"><input type="radio" value="chat" name="approvel" style="border:0px;" tabindex="7"></td>
                      <td height="25" align="left"><font style="font-family: verdana; font-size:10px; font-weight:bold; ">Chat Now with Bank Representative</font>
</td>
                    </tr>
                  </table></td>
                </tr>
                <tr align="left" valign="middle">
                  <td height="35" colspan="2"><input type="checkbox" style="border:none ;" name="accept" id="accept" tabindex="8" checked="checked"><font style="font-family: verdana; font-size:10px; font-weight:normal; "> I have read the <a href="http://www.deal4loans.com/Privacy.php"  style="color:#4f4d4d; ">Privacy Policy</a> and agree to the <a href="http://www.deal4loans.com/Privacy.php" style="color:#4f4d4d; ">Terms And Condition</a></font></td>
                </tr>
                <tr align="center" valign="middle">
                  <td height="55" colspan="2"><input name="image"  value="Submit" type="image" src="new-images/hdfc-pl/get_quotesml.gif" width="129" height="35"  style="border:0px;" tabindex="9" /></td>
                </tr>
              </table>
            </form></td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="6" class="rgtshado">&nbsp;</td>
  </tr>
</table>

<!-- BEGIN LivePerson Monitor. --><script language='javascript'> var lpMTagConfig = {'lpServer' : "server.iad.liveperson.net",'lpNumber' : "18259720",'lpProtocol' : (document.location.toString().indexOf('https:')==0) ? 'https' : 'http'}; function lpAddMonitorTag(src){if(typeof(src)=='undefined'||typeof(src)=='object'){src=lpMTagConfig.lpMTagSrc?lpMTagConfig.lpMTagSrc:'/hcp/html/mTag.js';}if(src.indexOf('http')!=0){src=lpMTagConfig.lpProtocol+"://"+lpMTagConfig.lpServer+src+'?site='+lpMTagConfig.lpNumber;}else{if(src.indexOf('site=')<0){if(src.indexOf('?')<0)src=src+'?';else src=src+'&';src=src+'site='+lpMTagConfig.lpNumber;}};var s=document.createElement('script');s.setAttribute('type','text/javascript');s.setAttribute('charset','iso-8859-1');s.setAttribute('src',src);document.getElementsByTagName('head').item(0).appendChild(s);} if (window.attachEvent) window.attachEvent('onload',lpAddMonitorTag); else window.addEventListener("load",lpAddMonitorTag,false);</script><!-- END LivePerson Monitor. -->

</body>
</html>