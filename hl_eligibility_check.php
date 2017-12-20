<?php
$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
else { $IP=$IP_Remote;	}

if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168")
{
}
else
{
	exit();
}

require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfunc.php';
require 'scripts/home_loan_eligibility_function.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

session_start();
$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid =$_REQUEST['Bid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$hlname = $_POST["hlname"];
		$hlrequestid = $_POST["hlrequestid"];
		$producttype=2;
		$fm_subcategory=$_POST['fm_subcategory'];
		$reg_year=$_POST['reg_year'];
		$reg_month=$_POST['reg_month'];
		$tataaig_home=$_POST['Tataaig_Home'];
		$purchase_date=$reg_month."-".$reg_year;
		$tataaig_health=$_POST["Tataaig_Health"];
		$tataaig_auto=$_POST["Tataaig_Auto"];
		$renewal_date= $_POST['renewal_date'];
		$bidderid_details = $_SESSION['bidderid_details'];
		$hlemail = $_POST["hlemail"];
		$hladd_comment = $_POST["hladd_comment"];
		$hlmobile = $_POST["hlmobile"];
		$hlstd_code = $_POST["hlstd_code"];
		$hllandline = $_POST["hllandline"];
		$hlother_city = $_POST["hlother_city"];
		$hldate = $_POST["Dated"];
		$day = $_POST["day"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$hldob = $year."-".$month."-".$day;
		$which_khatha = $_POST["which_khatha"];
		$hlemployment_status = $_POST["hlemployment_status"];
		$hllandline_o = $_POST["hllandline_o"];
		$hlstd_code_o = $_POST["hlstd_code_o"];
		$hlnet_salary = $_POST["hlnet_salary"];
		$hlresiaddress = $_POST["hlresiaddress"];
		$hlpincode = $_POST["hlpincode"];
		$hlloanamt = $_POST["hlloanamt"];
		$hlcity = $_POST["hlcity"];
		$hlloantime = $_POST["hlloantime"];
		$hlbudget = $_POST["hlbudget"];
		$hlproperty_loc = $_POST["hlproperty_loc"];
		$hlproperty_identified = $_POST["hlproperty_identified"];
		$hlfeedback = $_POST["hlfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$Bidder_Id = $_REQUEST['BidderId'];
		$hlcompany_name = $_REQUEST['hlcompany_name'];
		$selectbidderID=$_REQUEST['selectbidderID'];
		$selectbidderID=explode(',',$selectbidderID);
	//	print_r($selectbidderID);
		$realbankID=$_REQUEST['realbankID'];
		$realbankID=explode(',',$realbankID);
		//print_r($realbankID);
		$Accidental_Insurance = $_REQUEST['Accidental_Insurance'];
	$hlProperty_Value = $_REQUEST['hlProperty_Value'];
	$hlTotal_Obligation = $_REQUEST['hlTotal_Obligation'];
	$hlCo_Applicant_Name = $_REQUEST['hlCo_Applicant_Name'];
	$hlCo_Applicant_DOB = $_REQUEST['hlCo_Applicant_DOB'];
	$hlCo_Applicant_Income = $_REQUEST['hlCo_Applicant_Income'];
	$hlCo_Applicant_Obligation = $_REQUEST['hlCo_Applicant_Obligation'];
	$want_personal_loan = $_REQUEST['want_personal_loan'];
	$want_Lap = $_REQUEST['want_Lap'];
	$Existing_Bank = $_REQUEST['hl_Existing_Bank'];
	$Existing_ROI = $_REQUEST['hl_Existing_ROI'];
	$Existing_Loan = $_REQUEST['hl_Existing_Loan'];

///////Get common bidder NAme//////////////////////////
	$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 

$Final_Bid ="";

	if($hlemployment_status =="Salaried")
	{
			$hlemp_stat=1;
	}
	elseif ($hlemployment_status =="Self Employed")
	{
		$hlemp_stat=0;
	}
	else
	{
		$hlemp_stat=0;
	}
		
	if(strlen($Final_Bid)>0)
		{
		$updatelead="Update Req_Loan_Home set CC_Bank='$which_khatha',Existing_Bank='$Existing_Bank',Existing_Loan='$Existing_Loan',Existing_ROI='$Existing_ROI',Property_Value='$hlProperty_Value',Co_Applicant_Name='$hlCo_Applicant_Name',Co_Applicant_DOB='$hlCo_Applicant_DOB',Co_Applicant_Income='$hlCo_Applicant_Income' ,Co_Applicant_Obligation='$hlCo_Applicant_Obligation',Total_Obligation='$hlTotal_Obligation',Tataaig_Home='$tataaig_home', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',Company_Name='$hlcompany_name', Name='$hlname',Email='$hlemail', Mobile_Number='$hlmobile',Employment_Status='$hlemployment_status', Std_Code='$hlstd_code',Landline='$hllandline',Std_Code_O='$hlstd_code_o',Landline_O='$hllandline_o',City='$hlcity',City_Other='$hlcity_other',Net_Salary='$hlnet_salary',Residence_Address='$hlresiaddress',Pincode='$hlpincode',Property_Identified='$hlproperty_identified',Loan_Time='$hlloantime',Loan_Amount='$hlloanamt',Budget='$hlbudget',Property_Loc='$hlproperty_loc',Bidderid_Details='$Final_Bid',Allocated='$Allocated',DOB='$hldob', Add_Comment='$hladd_comment',Accidental_Insurance='$Accidental_Insurance',City_Other='$hlother_city', Dated=Now() where RequestID=".$post;
		}
		else
		{
			$updatelead="Update Req_Loan_Home set CC_Bank='$which_khatha',Existing_Bank='$Existing_Bank',Existing_Loan='$Existing_Loan',Existing_ROI='$Existing_ROI',Property_Value='$hlProperty_Value',Co_Applicant_Name='$hlCo_Applicant_Name',Co_Applicant_DOB='$hlCo_Applicant_DOB',Co_Applicant_Income='$hlCo_Applicant_Income' ,Co_Applicant_Obligation='$hlCo_Applicant_Obligation',Total_Obligation='$hlTotal_Obligation',Tataaig_Home='$tataaig_home', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',Company_Name='$hlcompany_name', Name='$hlname',Email='$hlemail', Mobile_Number='$hlmobile',Employment_Status='$hlemployment_status', Std_Code='$hlstd_code',Landline='$hllandline',Std_Code_O='$hlstd_code_o',Landline_O='$hllandline_o',City='$hlcity',City_Other='$hlcity_other',Net_Salary='$hlnet_salary',Residence_Address='$hlresiaddress',Pincode='$hlpincode',Property_Identified='$hlproperty_identified',Loan_Time='$hlloantime',Loan_Amount='$hlloanamt',Budget='$hlbudget',Property_Loc='$hlproperty_loc',DOB='$hldob', Add_Comment='$hladd_comment',Accidental_Insurance='$Accidental_Insurance',City_Other='$hlother_city',Dated=Now()  where RequestID=".$post;
		}
		//echo "query".$updatelead;
		$updateleadresult=ExecQuery($updatelead);
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script language="javascript" type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
<script>
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function insertTemp()
		{
			var new_type = document.getElementById('CCmailertype').value;
			var new_request = document.getElementById('hlrequestid').value;
			var new_name = document.getElementById('hlname').value;
			var new_email = document.getElementById('hlemail').value;
			if((new_name!=""))
			{
				var queryString = "?Name=" + new_name + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
				//alert(queryString); 
				ajaxRequest.open("GET", "sendHlemail.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{						
						var ajaxDisplay = document.getElementById('CCajaxDiv');
						ajaxDisplay.innerHTML = "sent";
					}
				}

				ajaxRequest.send(null); 
			 }
		}

function insertHLTemp()
		{
			var new_type = document.getElementById('HLmailertype').value;
			var new_request = document.getElementById('hlrequestid').value;
			var new_name = document.getElementById('hlname').value;
			var new_email = document.getElementById('hlemail').value;
		
			if((new_name!=""))
			{
				var queryString = "?Name=" + new_name + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
				//alert(queryString); 
				ajaxRequest.open("GET", "sendHlemail.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						var ajaxDisplay = document.getElementById('HLajaxDiv');
						ajaxDisplay.innerHTML = "sent";
					}
				}
				ajaxRequest.send(null); 
			 }
		}
	window.onload = ajaxFunction;
</script>
<script>
function chkhomeloan(Form)
{
	var space=/^[\ ]*$/;
	var num=/^[0-9]*$/;

	//alert("hello");
	if((Form.day.value!="") && (Form.month.value!="") && (Form.year.value!=""))
	{
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
else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("this month Cannot have 31st Day");Form.day.select();
return false;
}
else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}

else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}
	}
}
</script>
<STYLE>
a
{
	cursor:pointer;
}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}
</style>
</head>
<body >
<p align="center"><b>Home loan Lead Details </b></p>
<?php 
 $viewqry="select CC_Bank,Creative, Referral_Flag,Property_Value,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income ,Co_Applicant_Obligation,Total_Obligation,Req_Loan_Home.checked_bidders,Req_Loan_Home.Tataaig_Home,Req_Loan_Home.Tataaig_Auto,Req_Loan_Home.Tataaig_Health,Req_Loan_Home.Company_Name, Req_Loan_Home.Dated,Req_Loan_Home.Name,Req_Loan_Home.Accidental_Insurance,Req_Loan_Home.source,Req_Loan_Home.Add_Comment,Req_Loan_Home.Landline,Req_Loan_Home.Std_Code,Req_Loan_Home.Residence_Address,Req_Loan_Home.Net_Salary,Req_Loan_Home.Sms_Sent,Req_Loan_Home.Email_Sent,Req_Loan_Home.Landline_O,Req_Loan_Home.Std_Code_O,Req_Loan_Home.Mobile_Number,Req_Loan_Home.Employment_Status,Req_Loan_Home.City,Req_Loan_Home.City_Other, Req_Loan_Home.PL_Bank, Req_Loan_Home.Loan_Amount, Req_Loan_Home.Email,Req_Loan_Home.DOB,Req_Loan_Home.Budget,Req_Loan_Home.Property_Loc,Req_Loan_Home.Pincode,Req_Loan_Home.Loan_Time,Req_Loan_Home.Hl_mailer,Req_Loan_Home.Property_Identified,Req_Feedback_HL.Feedback,Req_Feedback_HL.BidderID,Req_Feedback_HL.Followup_Date,Req_Loan_Home.Bidderid_Details,Req_Loan_Home.Existing_Loan,Req_Loan_Home.Existing_Bank ,Req_Loan_Home.Existing_ROI from Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_HL.BidderID in (732,812,460,207,64,72) where Req_Loan_Home.RequestID=".$post." "; 
//echo "dd".$qry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$Tataaig_Home=  mysql_result($viewlead,0,'Tataaig_Home');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$Hl_mailer = mysql_result($viewlead,0,'Hl_mailer');
$Dated = mysql_result($viewlead,0,'Dated');
$Tataaig_Health=  mysql_result($viewlead,0,'Tataaig_Health');
$Tataaig_Auto=  mysql_result($viewlead,0,'Tataaig_Auto');
$Mobile = mysql_result($viewlead,0,'Mobile_Number');
$Landline = mysql_result($viewlead,0,'Landline');
$Landline_O = mysql_result($viewlead,0,'Landline_O');
$Std_Code = mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
$Residence_Address = mysql_result($viewlead,0,'Residence_Address');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
$Email = mysql_result($viewlead,0,'Email');
$source = mysql_result($viewlead,0,'source');
$add_comment = mysql_result($viewlead,0,'Add_Comment');
$Pincode = mysql_result($viewlead,0,'Pincode');
$Property_Loc = mysql_result($viewlead,0,'Property_Loc');
$Loan_Time = mysql_result($viewlead,0,'Loan_Time');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$Email_Sent = mysql_result($viewlead,0,'Email_Sent');
$Sms_Sent = mysql_result($viewlead,0,'Sms_Sent');
$Budget = mysql_result($viewlead,0,'Budget'); 
$CC_Bank = mysql_result($viewlead,0,'CC_Bank'); 
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
$Property_Identified = mysql_result($viewlead,0,'Property_Identified');
$DOB = @mysql_result($viewlead,0,'DOB');
$Accidental_Insurance = @mysql_result($viewlead,0,'Accidental_Insurance');
$checked_bidders = @mysql_result($viewlead,0,'checked_bidders');
$checked_bidders = explode(",",$checked_bidders);
$Property_Value = mysql_result($viewlead,0,'Property_Value');
$Co_Applicant_Name = @mysql_result($viewlead,0,'Co_Applicant_Name');
$Co_Applicant_DOB = @mysql_result($viewlead,0,'Co_Applicant_DOB');
$Co_Applicant_Income = @mysql_result($viewlead,0,'Co_Applicant_Income');
$Co_Applicant_Obligation = @mysql_result($viewlead,0,'Co_Applicant_Obligation');
$Total_Obligation = @mysql_result($viewlead,0,'Total_Obligation');
$Referral_Flag = @mysql_result($viewlead,0,'Referral_Flag');
if($Referral_Flag==0)
{
	$Referral_Flag = @mysql_result($viewlead,0,'Creative');
}
$PL_Bank = @mysql_result($viewlead,0,'PL_Bank');
$Existing_Bank = @mysql_result($viewlead,0,'Existing_Bank');
$Existing_ROI = @mysql_result($viewlead,0,'Existing_ROI');
$Existing_Loan = @mysql_result($viewlead,0,'Existing_Loan');

list($year,$mm,$dd) = split('[-]', $DOB);

$monthly_income = $Net_Salary/12;

	$getnetAmount = ($monthly_income + $Co_Applicant_Income);
		$total_obligation = $Total_Obligation + $Co_Applicant_Obligation;
		$netAmount=($getnetAmount - $total_obligation);
		$dateofbirth = str_replace("-","", $DOB);
		$dateofbirth = DetermineAgeFromDOB($dateofbirth);
		$tenorPossible = 60 - $dateofbirth;

if($City=="Others")
	{
		$calcity=$City_Other;
		}
		else
	{
		$calcity=$City;
	}
 ?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" onSubmit="return chkhomeloan(document.loan_form);">
<input type="hidden" name="bidderid_details" value="<? echo $Bidderid_Details;?>">
<input type="hidden" name="BidderId" value="<? echo $bidid;?>">
<input type="hidden" name="hlrequestid" id="hlrequestid" value="<? echo $post;?>">
<input type="hidden" name="Dated" value="<? echo $Dated;?>">
<table style='border:1px dotted #9C9A9C;'width="700" height="80%" align="center" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Balance Transfer</b></td></tr>
<tr>
	<td width="25%"><b>Existing Bank</b></td>
	<td width="25%"><input type="text" name="hl_Existing_Bank" id="hl_Existing_Bank" value="<?php echo $Existing_Bank; ?>"></td>
	<td ><b>Existing Loan </b></td>
	<td ><input type="text" name="hl_Existing_Loan" id="hl_Existing_Loan" value="<?php echo $Existing_Loan; ?>"></td>
</tr>
<tr>
	<td width="25%"><b>Existing ROI</b></td>
	<td width="25%"><input type="text" name="hl_Existing_ROI" id="hl_Existing_ROI" value="<?php echo $Existing_ROI; ?>"></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr><tr>	<td ><b>Name</b>
	</td>
	<td ><input type="text" name="hlname" id="hlname" value="<? echo $Name;?>"> </td>
<td ><b>Email id</b></td>
	<td ><input type="text" name="hlemail" id="hlemail" value="<? echo $Email;?>"></td>
	</tr>
<tr>
	<td width="25%"><b>Mobile</b></td>
	<td width="25%">+91<input type="text" name="hlmobile" size="15" value="<? echo $Mobile;?>"></td>
	<td ><b>DOB </b></td>
	<td ><input type="text" name="day" id="day" value="<? echo $dd;?>" size="2" maxlength="2">-<input type="text" name="month" id="month" value="<? echo $mm;?>" size="2" maxlength="2">-<input type="text" name="year" id="year" value="<? echo $year;?>" size="4" maxlength="4">(dd-mm-yyyy)</td>
</tr>
<tr>
	<td><b>Residence No.</b></td>
	<td><input type="text" name="hlstd_code" size="2" value="<? echo $Std_Code;?>" >-<input type="text" name="hllandline" size="10" value="<?echo $Landline;?>"></td>
	
	<td ><b>Office No.</b></td>
	<td ><input type="text" name="hlstd_code_o"  size="2" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="hllandline_o" size="10" value="<?echo $Landline_O;?>"></td>
  </tr>
<tr>
	<td ><b>City</b></td>
	<td><!--<input type="text" name="hlcity" id="hlcity" value="<?echo $City;?>"></textarea>--><select size="1" name="hlcity" > <?=getCityList($City)?></select></td>
	<td ><b>Pincode</b></td>
	<td ><input type="text" name="hlpincode" size="10" value="<? echo $Pincode;?>" id="hlpincode"></td>
</tr>
<tr>
	<td ><b>Residence Address</b></td>
	<td  ><textarea  name="hlresiaddress" rows="2" cols="18"><? echo $Residence_Address;?></textarea></td>
	<td ><b>Other City</b></td>
	<td><!--<input type="text" name="hlcity" id="hlcity" value="<?echo $City;?>"></textarea>--><input type="text" name="hlother_city" id="hlother_city" value="<? echo $City_Other;?>"> </td>
</tr>
<tr><td><b>Source</b></td>
		<td><? echo $source; ?></td>
		<?php
		
		if(strlen($PL_Bank)>0)
		{
		?>
        <td ><strong>Clicked Bank
		</strong></td>
        <td>
        <?php
		echo $PL_Bank;
		
        ?>        </td>
		<?php
		}
        else
		{
		?>
		<td  colspan="2">		</td>
		
        <?php
		}
	       ?>
    </td></tr>
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Employment Details</b></td></tr>
<tr>
	<td><b>Employment Status</b></td>
	<td><select name="hlemployment_status" id="hlemployment_status">
		<option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
		<option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>	</td>
	<td ><b>Annual Income</b></td>
	<td><input type="text" name="hlnet_salary" id="hlnet_salary" value="<? echo $Net_Salary;?>"  onKeyUp="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" onKeyPress=" getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');"></td>
</tr>
<tr><td><b>Company Name</b></td><td><input type="text" name="hlcompany_name" id="hlcompany_name" value="<? echo $Company_Name?>"></td><td colspan="2"></td></tr>
<tr>
<td colspan="2">&nbsp;</td>
	<td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Other Details</b></td></tr>
<tr>
	<td><b>Loan Amount</b></td>
	<td><input type="text" name="hlloanamt" id="hlloanamt" value="<? echo $Loan_Amount;?>" onKeyUp="getDigitToWords('hlloanamt','formatedloan','wordloan');" onKeyPress="getDigitToWords('hlloanamt','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('hlloanamt','formatedloan','wordloan');"></td>
<td ><b>Loan Time</b></td>
	<td ><select name="hlloantime" >
	<option value="-1" <? if (($Loan_Time==-1) || ($Loan_Time=="")) { echo "selected";}?>>Please select</option>
    	<OPTION value="15 days" <? if($Loan_Time =="15 days"){echo "selected"; }?>>15 days</OPTION>
	<OPTION value="1 month" <? if($Loan_Time =="1 month"){echo "selected"; }?>>1 months</OPTION>
	<OPTION value="2 months" <? if($Loan_Time =="2 months"){echo "selected"; }?>>2 months</OPTION>
	<OPTION value="3 months" <? if($Loan_Time =="3 months"){echo "selected"; }?>>3 months</OPTION>
	<OPTION value="3 months above" <? if($Loan_Time =="3 months above"){echo "selected"; }?>>more than 3 months</OPTION>
	</SELECT>	</td>
</tr>
<tr>
	<td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td><b>Property Identified</b></td>

	<td ><input type="radio" name="hlproperty_identified" <? if($Property_Identified==1){ echo "checked";}?> value="1">Yes<input type="radio" name="hlproperty_identified" <? if($Property_Identified==0){echo "checked";}?> value="0">No</td>
	<td><b>Property Location</b></td>
	<td ><input type="text" name="hlproperty_loc" value="<? echo  $Property_Loc;?>"></td>
</tr>
<tr>
	<td><b>Property Value</b></td>
<td><input type="text" name="hlProperty_Value" id="hlProperty_Value" value="<? echo $Property_Value; ?>"></td>
	<td><b>Total Obligation</b></td>
<td><input type="text" name="hlTotal_Obligation" id="hlTotal_Obligation" value="<? echo $Total_Obligation; ?>"></td>
</tr>
<? if($Property_Loc=="Bangalore")
{ ?>
<tr>
<td>Which Khatha ?</td>
<td><select Name="which_khatha" id="which_khatha"><option value="">Select</option><option value="1" <? if($CC_Bank==1) { echo "Selected";}?>>A Khatha</option><option value="2" <? if($CC_Bank==2) { echo "Selected";}?>>B Khatha</option></select></td>
	<td colspan="2"></td>
</tr>
<? } ?>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Co applicant Details</b></td></tr>
	<tr>
	<td><b>Co Applicant Name:</b></td>
<td><input type="text" name="hlCo_Applicant_Name" id="hlCo_Applicant_Name" value="<? echo $Co_Applicant_Name; ?>"></td>
	<td ><b>Co-Applicant DOB</b></td><td><input type="text" name="hlCo_Applicant_DOB" id="hlCo_Applicant_DOB" value="<? echo $Co_Applicant_DOB; ?>"></td>
</tr>
<tr>
	<td><b>Co Monthly Income:</b></td>
<td><input type="text" name="hlCo_Applicant_Income" id="hlCo_Applicant_Income" value="<? echo $Co_Applicant_Income; ?>"></td>
	<td ><b>Co Applicant Obligation</b></td><td><input type="text" name="hlCo_Applicant_Obligation" id="hlCo_Applicant_Obligation" value="<? echo $Co_Applicant_Obligation; ?>"></td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Bidder Details</b></td></tr>
<? if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}
//echo $City;?>
<tr><td><b>Eligible for Bidders</b></td><td id="check" colspan="2"><? if(strlen($Bidderid_Details)>0){?> already send<? } else {?><? list($FinalBidder,$finalBidderName)= geteligibleBiddersList("Req_Loan_Home",$post,$City,$Referral_Flag,$source);
   for($i=0;$i<count($FinalBidder);$i++)
			{
	   if($Property_Loc=="Bangalore" && ($FinalBidder[$i]==4266 || $FinalBidder[$i]==4285 || $FinalBidder[$i]==4328 || $FinalBidder[$i]==4341 || $FinalBidder[$i]==4383 || $FinalBidder[$i]==4424 || $FinalBidder[$i]==4489) && $CC_Bank!=1) // Add Bidders for Khatha B
				{
				}
				else
				{
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].") ";
		echo "&nbsp;";
			}
}
}
	?></td></tr>
		<tr><td class="fontstyle"><b>Bidders Choosen by Customer</b><td colspan="3">
<?php
for($cb=0;$cb<count($checked_bidders);$cb++)
{
	$getcheckedname=ExecQuery("select Bidder_Name from Bidders_List where BidderID=".$checked_bidders[$cb]." and Reply_Type=2");

	while($row = mysql_fetch_array($getcheckedname))
	{
	$getchoosenbidders[]=$row['Bidder_Name'];
	}
}
$getchoosenbidders= implode(",",$getchoosenbidders);
?>
<? echo $getchoosenbidders;?></td>
</tr>
<tr><td colspan="4"><table border="1">
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Month)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Eligible Loan Amt</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Lac)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Total Interest Amt</b></td></tr>
<? 
$finalBidderName_unique = array_unique($finalBidderName);
$finalBidderName_unique1=implode(",",$finalBidderName_unique);
$finalBidderName = explode(",",$finalBidderName_unique1);
for($ij=0;$ij<count($finalBidderName);$ij++)
{
	if($finalBidderName[$ij]=="HDFC" || $finalBidderName[$ij]=="HDFC Bank")
		{
			list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan(
	$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
		?>
		 <tr> 
		 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $hdfcinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $hdfcemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($hdfcprint_term); ?> yrs.</b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($hdfcviewLoanAmt); ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $hdfcperlacemi; ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
   $hdfcinterestfortwoyr= (($hdfcsemi * 24));
   $remingterm=$hdfcterm - 24;
   $hdfcgetinterestamt=(($hdfcactualemi * $remingterm)); 
   $hdfctotalinterestamt= (($hdfcinterestfortwoyr + $hdfcgetinterestamt) - $hdfcloan_amount);
   echo abs($hdfctotalinterestamt); ?></td>
   </tr>
   <?
		}
		elseif($finalBidderName[$ij]=="ICICI" || $finalBidderName[$ij]=="ICICI Bank")
		{
		list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan(
	$netAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value); 
		?>
			<tr>
					 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><? echo $iciciinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs <? echo $iciciactualemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($iciciprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $iciciperlacemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php $iciciinterestfortwoyr= ($icicisemi * 24);			
 $remingterm=$iciciterm - 24; 							   
						   $icicigetinterestamt=(($iciciactualemi * $remingterm));
						  $icicitotalinterestamt= (($iciciinterestfortwoyr + $icicigetinterestamt) - $iciciviewLoanAmt);
							 echo abs($icicitotalinterestamt); ?></td>
							 </tr>
							 <?
	}
		elseif($finalBidderName[$ij]=="LIC Housing")
		{
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan(
	$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
	?>
	<tr>
			 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $licinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $licemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($licprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($licviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $licperlacemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php $licgetinterestamt=(($licemi * $licterm)); echo $licgetinterestamt; ?></td>
	</tr>
	<?
		}
		elseif($finalBidderName[$ij]=="IDBI")
		{
			list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan(
	$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
		?>
		 <tr>
		 		 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo "8.25%(Fixed for 2 yrs)".abs($idbiinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $idbiemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($idbiprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $idbiperlacemifortwo."(Fixed For 2 yrs)".abs($idbiperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 										   $idbiinterestfortwoyr= ($idbisemi * 24);
							   $remingterm=$idbiterm - 24;
						   $idbigetinterestamt=($idbiactualemi * $remingterm); 
						   $idbitotalinterestamt= ( ($idbiinterestfortwoyr + $idbigetinterestamt) - $idbiviewLoanAmt);
						   echo abs($idbitotalinterestamt); ?></td>
						   </tr>
						   <?
		}
	   elseif($finalBidderName[$ij]=="Axis Bank")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
		?>	
		<tr>
				 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><?php echo abs($axisinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo $axisemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><?php echo abs($axisprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo abs($axisviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo abs($axisperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php 
							      //$axisinterestfortwoyr= ($axissemi * 12);
							   $axisremingterm=$axisterm;
						   $axisgetinterestamt=(($axisactualemi * $axisremingterm)); 
						   $axistotalinterestamt= (($axisgetinterestamt) - $axisviewLoanAmt);
						    echo abs($axistotalinterestamt); ?></td>
							</tr>
							<?
	}
elseif($finalBidderName[$ij]=="First Blue Home Finance" || $finalBidderName[$ij]=="First Blue" || (strncmp ("First", $finalBidderName[$ij],5))==0)
	{
	if($Employment_Status==0)
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSE($getnetAmount,$dateofbirth,$total_obligation,$Property_Value,$Property_Identified);
		}
		else
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSal($getnetAmount,$dateofbirth,$total_obligation,$Property_Value,$Property_Identified);
		}
?>
<tr>
				 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><?php echo $frstblinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs <?php echo $frstblactualemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><?php echo $frstblterm; ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo abs($frstblloan_amount); ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo abs($perlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php 
							      ?></td>
							</tr>
	  <?
}
} 
?>
</table>
</td></tr>
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Add Feedback</b></td></tr>
<tr>
	<td><b>Feedback</b></td>
	<td>
    <?php
	//echo "select FeedbackID, Feedback from Req_Feedback_HL where AllRequestID='".$post."' and BidderID='3635' AND Reply_Type=2";
	$getFedbackQuery = ExecQuery("select FeedbackID, Feedback, Followup_Date from Req_Feedback_HL where AllRequestID='".$post."' and BidderID='3635' AND Reply_Type=2");
	$num_rows = mysql_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			echo $Feedback3635 = mysql_result($getFedbackQuery,0,'Feedback');
			$originalFeedback = $Feedback_c;
	echo "<br>";
			$followup_date3635 = mysql_result($getFedbackQuery,0,'Followup_Date');
		}
	?>
    <select name="hlfeedback" id="feedback">
		<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
	<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	</select>	</td>
	<td><b>Follow Up Date</b></td>
	<td><?php  echo $followup_date3635; ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<tr><td><b>Source</b></td>
		<td><? echo $source; ?></td><td><b>Send SMS</b></td>
<td><input type="button" name="sms" onClick="window.open('sendsms-email.php?Mobile=<? echo $Mobile;?>&RequestID=<? echo urlencode($post);?>&pro=2')" value="SendSMS"></td></tr>
	<tr><td colspan="2"><input type="checkbox" name="want_personal_loan" id="want_personal_loan" value="1" style="border:none;">
	  <b>  Want Personal Loan</b><br><br>
	  <input type="checkbox" name="want_Lap" id="want_Lap" value="1" style="border:none;">
	  <b>  Want Loan Against Property</b>
	  </td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="hladd_comment" id="hladd_comment" ><? echo $add_comment; ?></textarea></td>
	</tr> 
<tr><td colspan="4">&nbsp;</td></tr>
 <tr>
     <td colspan="4" align="center"><br><input type="submit" class="bluebutton" value="Submit">    </td>
  </tr>
</table>
</form>
</body>
</html>