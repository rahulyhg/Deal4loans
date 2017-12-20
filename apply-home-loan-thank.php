<?php
//print_R($_POST);
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/hlratesnw.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
	require 'show_quotecount.php';

function DetermineAgeGETDOB ($YYYYMMDD_In)
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

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			$Type_Loan=$_REQUEST['Type_Loan'];
			$Reference_Code1 = $_REQUEST['Reference_Code1'];
			$ProductValue = $_REQUEST['ProductValue'];	
			$Day=$_REQUEST['day'];
			$Month=$_REQUEST['month'];
			$Year=$_REQUEST['year'];
			$DOB=$Year."-".$Month."-".$Day;
			$Gender = $_REQUEST['Gender'];
                        $Residence_Address = $_REQUEST['Residence_Address'];
			$Pincode = $_REQUEST['Pincode'];
                        $Pancard = strtoupper($_REQUEST['Pancard']);
			$Employment_Status = $_REQUEST['Employment_Status'];
			$Company_Name = $_REQUEST['Company_Name'];
			$Property_Identified = $_REQUEST['Property_Identified'];
			$Property_Loc = $_REQUEST['Property_Loc'];
			$updateProperty = $_REQUEST['updateProperty'];
			$Loan_Time = $_REQUEST['Loan_Time'];
			$RePhone = $_REQUEST['RePhone'];
			$Phone = $_REQUEST['Phone'];
			$City = $_REQUEST['City'];
			$Net_Salary = $_REQUEST['Net_Salary'];
			$Net_Salary = $_POST['Net_Salary'];
			$monthly_income = ($Net_Salary /12);
			$obligations = $_POST['obligations'];
			$co_appli = $_POST['co_appli'];
			$co_name = $_POST['co_name'];
			$dob_arr_co[] = $_POST['co_year'];
			$dob_arr_co[] = $_POST['co_month'];
			$dob_arr_co[] = $_POST['co_day'];
			$DOB_co = implode("-", $dob_arr_co);
			$co_monthly_income = $_POST['co_monthly_income'];
			$co_obligations = $_POST['co_obligations'];
			$property_value = $_POST['Property_Value'];
			$getnetAmount = ($monthly_income + $co_monthly_income);
			$total_obligation = $obligations + $co_obligations;
			$netAmount=($getnetAmount - $total_obligation);
			$currentyear=date('Y');
			$age=$currentyear-$Year;
			$Dated=ExactServerdate();

			$CheckSql = "select  Net_Salary,City,City_Other,Reference_Code,Name from Req_Loan_Home where RequestID =".$ProductValue;
			list($CheckRowNR,$CheckRow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($CheckRow)-1;
			$CheckRef = $CheckRow[$myrowcontr]['Reference_Code'];
			$Name = $CheckRow[$myrowcontr]['Name'];
			echo $City = $CheckRow[$myrowcontr]['City'];
			$Net_Salary = $CheckRow[$myrowcontr]['Net_Salary'];
			$Other_City= $CheckRow[$myrowcontr]['City_Other'];
			$monthly_income = ($Net_Salary /12);
	$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);

if($City=="Others")
{
	if(strlen($Other_City)>0)
	{
		$strCity=$Other_City;
	}
	else
	{
		$strCity=$City;
	}
}
else
{
	$strCity=$City;
}
		
			$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
			//exit();
			if($crapValue=="Put")
			{
				if (($Type_Loan=="Req_Loan_Home") || ($product=="HomeLoan"))
					{			
						$dataUpdate = array('Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$total_obligation, 'DOB'=>$DOB, 'Residence_Address'=>$Residence_Address, 'Pincode'=>$Pincode, 'Gender'=>$Gender, 'Pancard'=>$Pancard,'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Loan_Time'=>$Loan_Time, 'Budget'=>$budget);
						$wherecondition = "(RequestID=".$ProductValue.")";
						 Mainupdatefunc ('Req_Loan_Home', $dataUpdate, $wherecondition);
					}
				
			}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
		
	}//$_POST
	$_SESSION['ProductValueHL'] = $ProductValue;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<link rel="canonical" href="https://www.deal4loans.com/apply-home-loans.php"/>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">
<!-- 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
.data-middle_wrapper{ width:977px; margin:auto; background:#f0f0f0; padding:5px; border:#bababa solid thin; border-radius:10px;}
.inbox-text{ width:99%; margin:auto; background:#0f8eda; padding:10px 5px 10px 5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF; line-height:18px;}
.data-middle_wrapper2{ width:977px; margin:5px auto; padding:5px 0px 0px 0px; background:#fcfbfb;}
.head-font-text{font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF;}
.head-font-text-b{font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#000;}
-->
</style>
</head>
<body>
<!--top-->
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div style="clear:both; height:1px;"></div>
<div style="clear:both; width:960px; margin:auto;  margin-top:2px;">
<div style="clear:both; height:40px; width:960px; margin:auto; padding-top:5px;">
<div class="text3" style="float:left; width:960px; font-size:15px; color:#706F6F; text-transform:none; margin-top:10px; text-align:center;"><strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com<br /><br />
    Thanks for applying Home Loan through deal4Loans.com. You will soon receive call from us to help you to find the best deal.</strong><br />
</div>
</div>
<div style="clear:both;"></div>
<div style="width:890px; height:auto; margin-left:25px; margin-top:7px; background-color:#FFFFFF;" >
<div id="bodyCenter">
 <div id="nwcontainer">
<?php

	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);
	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
	$Final_Bid[]= $val; 
	} 
	 $FinalBidder=implode(',',$FinalBidder);
	$FinalBidderarr = explode(",",$FinalBidder);
	$realbankiD=implode(',',$realbankiD);

	if(count($FinalBidder)>0)
	{ ?>
    <div class="data-middle_wrapper">
<div class="inbox-text">The below mentioned banks are eager to give you a Home Loan.<br>
  We at deal4loans.com believe that its big financial decision that you are about to take.<br>
  To get best deal, speak to 3-4 banks mentioned below and then decide upon the best deal<br>
  This will help you get best deal &amp; save on Emi &amp; choose best product &amp; best service.<br>
</div>
<div class="data-middle_wrapper2">
<table border="0" cellpadding="2" cellspacing="0" align="center" width="950">
<tr>
  <td width="179" height="41" align="center" bgcolor="#88a943" class="head-font-text">Bank Name</td>
  <td width="214" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Interest Rate</td>
  <td width="147" height="41" align="center" bgcolor="#0172b2" class="head-font-text">EMI(Per Month)</td>
  <td width="99" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Tenure</td>
  <td width="141" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Eligible Loan Amount</td>
  <td width="146" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Request for more <br>
    Information</td>
</tr>
        <?
for($i=0;$i<count($Final_Bid);$i++)
	{
	 if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{		 
		 $axisimg="new-images/slider/thumb/axis.jpg";
		 list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($axisviewLoanAmt>0)
		{ 
	$axisqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$axisinter , "hl_bankemi"=>$axisemi , "hl_banktenure"=>$axisprint_term , "hl_loanamount"=>$axisviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $axisimg);
			$axisValue = Maininsertfunc("hl_quote_shown", $axisqry);
		 }
 	}
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
		 $idbiimg="";
	list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($idbiviewLoanAmt>0)
		{
				$idbiqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$idbiinter , "hl_bankemi"=>$idbiemi , "hl_banktenure"=>$idbiprint_term , "hl_loanamount"=>$idbiviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $idbiimg);
			$idbiValue = Maininsertfunc("hl_quote_shown", $idbiqry);
		}		
	}
			elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
			{
			list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
			if($iciciviewLoanAmt>0)
			{
				$iciciimg="new-images/slider/thumb/hfc_logo.jpg";
				$iciciqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$iciciinter , "hl_bankemi"=>$iciciactualemi , "hl_banktenure"=>$iciciprint_term , "hl_loanamount"=>$iciciviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $iciciimg);
				$iciciValue = Maininsertfunc("hl_quote_shown", $iciciqry);
			}
			}
			elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank" || $Final_Bid[$i]=="HDFC Ltd")
			{
				$hdfcimg="new-images/slider/thumb/hdfc-h.jpg";
			list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
			if($hdfcviewLoanAmt>0)
			{	
				$hdfcqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$hdfcinter , "hl_bankemi"=>$hdfcemi , "hl_banktenure"=>$hdfcprint_term , "hl_loanamount"=>$hdfcviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $hdfcimg);
				$hdfcValue = Maininsertfunc("hl_quote_shown", $hdfcqry);
			}
			}
			elseif($Final_Bid[$i]=="Fedbank" || (strncmp ("Fedbank", $Final_Bid[$i],7))==0)
			{
				list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloannew($getnetAmount,$age,$obligation,$property_value,$loan_amount);
				if($federalloanamt>0)
				{
					$fedbnkimg="new-images/fedbank-nw.jpg";
					$fedbankqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$federalinter , "hl_bankemi"=>$federalemi , "hl_banktenure"=>$federalterm , "hl_loanamount"=>$federalloanamt , "hl_dated"=>$Dated , "hl_img"=> $fedbnkimg);
					$fedValue = Maininsertfunc("hl_quote_shown", $fedbankqry);
				}				
			}
			elseif($Final_Bid[$i]=="PNB Housing Finance" || $Final_Bid[$i]=="Punjab National Bank" || $Final_Bid[$i]=="PNB housing")
			{
				$pnbimg="new-images/pnbhfl-logo1.jpg";
				list($pnbemi,$pnbinter,$pnbterm,$pnbloanamt) = PNB_Homeloan($getnetAmount,$age,$obligation,$property_value);
				if($pnbloanamt>0)
				{
					$pnbqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$pnbinter , "hl_bankemi"=>$pnbemi , "hl_banktenure"=>$pnbterm , "hl_loanamount"=>$pnbloanamt , "hl_dated"=>$Dated , "hl_img"=> $pnbimg);
					$pnbvalue = Maininsertfunc("hl_quote_shown", $pnbqry);
				}			
			}
			elseif($Final_Bid[$i]=="Tata Capital" || $Final_Bid[$i]=="TATA Capital")
			{
				$tataimg="new-images/tatacapital_pllogo.jpg";
				list($tataprocfee,$tataemi,$tatainter,$tataterm,$tataloanamt) = TATACapital_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$property_value,$Employment_Status);
				if($tataloanamt>0 && $tataloanamt>200000 && $tataemi>0 && $tataterm>0)
				{
					$tataqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$pnbinter , "hl_bankemi"=>$tataemi , "hl_banktenure"=>$tataterm , "hl_loanamount"=>$tataloanamt , "hl_dated"=>$Dated , "hl_img"=> $tataimg);
					$tatavalue = Maininsertfunc("hl_quote_shown", $tataqry);
				}			
			}
			elseif($Final_Bid[$i]=="SBI")
			{
				$sbiimg="";
				list($sbiprocfee,$sbiemi,$sbiinter,$sbiterm,$sbiloanamt,$sbiterm) = sbi_homeloan($netAmount,$loan_amount,$age,$obligations,$City,$property_value);
				if($sbiloanamt>300000 && $sbiterm>0 && $sbiemi>0)
				{
					$sbiqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$sbiinter , "hl_bankemi"=>$sbiemi , "hl_banktenure"=>$sbiterm , "hl_loanamount"=>$sbiloanamt , "hl_dated"=>$Dated , "hl_img"=> $sbiimg);
					$sbivalue = Maininsertfunc("hl_quote_shown", $sbiqry);
				}			
			}
			elseif($Final_Bid[$i]=="LIC Housing")
			{
				$licimg="new-images/lichfl_oct2015.jpg";
				list($licprocfee,$licemi,$licinter,$licpterm,$licloanamt,$licterm) = lic_homeloan($netAmount,$loan_amount,$age,$obligations,$City,$property_value);
				if($licloanamt>100000 && $licterm>0 && $licemi>0)
				{
					$licqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$licinter , "hl_bankemi"=>$licemi , "hl_banktenure"=>$licpterm , "hl_loanamount"=>$licloanamt , "hl_dated"=>$Dated , "hl_img"=> $licimg);
					$licvalue = Maininsertfunc("hl_quote_shown", $licqry);
				}			
			}
			else
			{ 	} 
			}
			//for ends here 
			$hlshowquotes="Select * from hl_quote_shown Where (hl_leadid=".$ProductValue.") order by hl_loanamount DESC";
			list($hlquotecount,$hlquote)=MainselectfuncNew($hlshowquotes,$array = array());
			$deselect="";
			for($j=0;$j<$hlquotecount;$j++)
				 {
			if(strlen($hlquote[$j]["hl_bankname"])>2)
					 {
				$deselect.= $hlquote[$j]["hl_bankname"].",";
					 }
			
			if(strlen($hlquote[$j]["hl_img"])>5)
					 {
			$imagebank ='<img src="/'.$hlquote[$j]["hl_img"].'"/>';
					 }
					 else
					 {
				$imagebank=$hlquote[$j]["hl_bankname"];
					 }
					
			?>
			<tr>
			 <td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $imagebank; ?></td>		  
			  <td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php 
			if($hlquote[$j]["hl_bankname"]=="HDFC" || $hlquote[$j]["hl_bankname"]=="HDFC Bank" || $hlquote[$j]["hl_bankname"]=="HDFC Ltd")
					 {
						echo "9.90% - 10.40";
					 }
					 else
					 {
			echo $hlquote[$j]["hl_bankrate"]; } ?> %</td>
			   <td align="center" bgcolor="#ececec" class="head-font-text-b"><?php if(strlen($hlquote[$j]["hl_bankemi"])>2) { echo "Rs.".round($hlquote[$j]["hl_bankemi"]);} else { echo "N.A";} ?> </td>
			  <td align="center" bgcolor="#dedede" class="head-font-text-b"><?php if($hlquote[$j]["hl_banktenure"]>0) { echo $hlquote[$j]["hl_banktenure"]."yrs";} else { echo "N.A";} ?> </td>
			  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b"><?php if($hlquote[$j]["hl_loanamount"]>1) { echo "Rs.".abs($hlquote[$j]["hl_loanamount"]);} else { echo "N.A";} ?></td>
			 <td align="center" bgcolor="#e2e2e2">
			  <? if(($hlquote[$j]["hl_bankname"]=="Axis Bank" || $hlquote[$j]["hl_bankname"]=="Axis") && in_array("5651", $FinalBidderarr, true))
					 {
				?>
				<form action="/apply_axishl_consent.php" method="POST" target="_blank" >
				<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
				<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $hlquote[$j]["hl_bankname"]; ?>">
				<input type="hidden" name="bidderid" id="bidderid" value="5651">
				<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
				</form>
				<?	 }
					 else
					 { ?>
			  <form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
			<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $hlquote[$j]["hl_bankname"]; ?>">
			<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
			</form>
			<? } ?>
			  </td>
		  </tr>
			<?	 }
			$deselect = substr(trim($deselect), 0, strlen(trim($deselect))-1);
			$deslectarr = explode(",",$deselect);
			$str="";
			for($p=0;$p<count($deslectarr);$p++)
				{	
				if((count($deslectarr)) - $p==1)
					{				
						$str.= "bank_name not like '%".$deslectarr[$p]."%'";
					}
					else
					{
					$str.= "bank_name not like '%".$deslectarr[$p]."%' and ";
					}
				}
				
				$finalstr="(".$str.")";
			$restOfBanks="Select * from home_loan_interest_rate_chart Where (".$finalstr." and flag=1) group by bank_name";
			list($rstbnkcount,$rstbnk)=MainselectfuncNew($restOfBanks,$array = array());
			$cntr2=0;
			//echo "Select * from home_loan_interest_rate_chart Where (".$finalstr." and flag=1) group by bank_name";
			
			for($k=0;$k<$rstbnkcount;$k++)
			{  
				//echo "here : ".$rstbnk["bank_name"]." - ".$loan_amount." - ".$age;
				list($bnkhlrates)=bankrates($rstbnk[$k]["bank_name"],$loan_amount,$age);
				if(strlen($bnkhlrates)>2)
				{
					if($rstbnk[$k]["bank_name"]=="Citibank")
					{ ?>
					<tr>
				  <td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $rstbnk[$k]["bank_name"]; ?></td>		
				  <td align="center" bgcolor="#e6e6e6" class="head-font-text-b" colspan="4">10.10% p.a. (Fixed till Sep 30, 2015)<br />
			Base Rate + 1.00% p.a. (from October 1, 2015 onwards)<br /><br />Semi Fixed Rates for bookings till Apr 30, 2014 only
			</td>
				   <td align="center" bgcolor="#e2e2e2"></td>
					</tr>
					 <? }
					else
					{
					?>
				<tr>
				<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $rstbnk[$k]["bank_name"]; ?></td>
				<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? echo $bnkhlrates; ?></td>
				<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
				  <td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
				  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>	
				<td align="center" bgcolor="#e2e2e2"></td>
		  </tr>
			<? }
				}
			}
			//echo "imhere".$deselect."<br>";
			?>
			
            </table>
			</div>
			<? $hlshowquotesdel = "Delete from hl_quote_shown Where hl_leadid=".$ProductValue."";
						$deleterowcount = Maindeletefunc($hlshowquotesdel,$array = array());
			}
						else
		{ }?>
         </div>         
         <div style="margin-top:15px;">
         <table width="850" border="1" align="center" cellpadding="2" cellspacing="0" bgcolor="#e6edfd"><tr><td width="196" rowspan="2" align="center" style="border:1px #FFFFFF solid;" ><table ><tr><td height="10">&nbsp;</td></tr><tr><td style="color:#000000; font-size:18px; ">Connect With Us</td></tr></table></td><td width="208" height="30" align="center" style=" color:#000000; font-size:14px; border:1px #666666 solid; border-top:1px #FFFFFF solid;"><b>Facebook</b></td><td width="169" align="center" style="color:#000000; font-size:14px; border-bottom:1px #666666 solid; "><b>Google +</b></td><td width="117" align="center" style="color:#000000; font-size:14px; border:1px #666666 solid; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;"><b>Twitter</b></td></tr><tr><td height="40" style="padding-left:20px; padding-top:10px; color:#000000; border:1px #666666 solid;"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font=tahoma&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></td><td align="center" style="padding-left:20px; color:#000000; border:1px #666666 solid;"><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="medium" data-href="https://plus.google.com/117667049594254872720"></div>
</td><td align="center" height="40" style="padding-left:20px; border:1px #666666 solid; border-right:1px #FFFFFF solid;"><a href="https://twitter.com/deal4loans" class="twitter-follow-button" data-show-count="false">Follow @deal4loans</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></td></tr></table></div>
<!-- Place this tag where you want the +1 button to render. -->
<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!--<div align="center" style="padding-top:20px;">     
<span style="font-size:10px;">Advertisment</span><br />
<div align="center" style="padding-top:10px;"><a href="http://www.americanexpressindia.co.in/platinumTravel.aspx?siteid=Deal4loanPlatinumTravelCard&adunit=PlatinumTravelCard_728x90SeptDec&banner=PlatinumTravelCard_SeptDec&campaign=PlatinumTravelCard&marketingagency=interactive" target="_blank" style="text-decoration:none;"><img src="new-images/cc/Amex_banner728x90oct12.jpg" width="728" height="90" border="0" /></a></div>
</div>-->
</div>
</div>
<div style="clear:both;"></div>
  <div class="content_c_mobo"> 
  <div style="margin-top:25px;" class="content_section_below"><span class="text11" style="color:#4c4c4c; width:950px;  margin-top:10px;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br />
Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates. </span></div>  
  </div>
</div>
<div style="clear:both; height:20px; width:964px; margin:auto; margin-top:10px;"></div>
</div>
<?php include "footer1.php"; ?>
</body>
</html>