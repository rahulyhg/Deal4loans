<?php
error_reporting(1);
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/hlratesnw.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
	require 'show_quotecount.php';


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
     $ydiff--;
  } elseif ($mdiff==0)
  {
    if ($ddiff < 0)
    {
        $ydiff--;
    }
  }
  return $ydiff;
}

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => 'Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

 	$ProductValue = $_REQUEST['ProductValue'];
	$strCity=$_POST['strcity'];
	$Name=$_POST['Name'];
	if(strlen($ProductValue)>1)
	{
		$ProductValue = $_REQUEST['ProductValue'];
		$strCity=$_POST['strcity'];
		$Name=$_POST['Name'];
	}
	else
	{
		$ProductValue = $_SESSION['ProductValue'];
		$strCity=$_SESSION['strcity'];
		$Name=$_SESSION['Name'];
	}


$sql = "select Mobile_Number,Email,Name,ABMMU_flag, Net_Salary, Co_Applicant_Income, Co_Applicant_Obligation, Total_Obligation, Loan_Amount, DOB, Property_Value, Property_Identified, City, City_Other,source,Employment_Status from Req_Loan_Home where RequestID='".$ProductValue."'";
	//echo $sql."<br>";
	$query = ExecQuery($sql);
	$Net_Salary = mysql_result($query,0,'Net_Salary');
	$monthly_income = ($Net_Salary /12);
	$co_monthly_income = mysql_result($query,0,'Co_Applicant_Income');
	$Co_Applicant_Obligation = mysql_result($query,0,'Co_Applicant_Obligation');
	$obligations = mysql_result($query,0,'Total_Obligation');
	$getnetAmount = ($monthly_income + $co_monthly_income);
	$loan_amount = mysql_result($query,0,'Loan_Amount');
	$dateofbirth = mysql_result($query,0,'DOB');
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	 $total_obligation  = $obligations + $Co_Applicant_Obligation;
	$property_value = mysql_result($query,0,'Property_Value');
	$Property_Identified = mysql_result($query,0,'Property_Identified');
	$netAmount=($getnetAmount - $total_obligation);
	$City =  mysql_result($query,0,'City');
	$Other_City =  mysql_result($query,0,'City_Other');
	$ABMMU_flag =  mysql_result($query,0,'ABMMU_flag');
	$full_name =  mysql_result($query,0,'Name');
	$Mobile_Number  =  mysql_result($query,0,'Mobile_Number');
	$Email  =  mysql_result($query,0,'Email');
	$source  =  mysql_result($query,0,'source');
	$Employment_Status  =  mysql_result($query,0,'Employment_Status');
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

$_SESSION['ProductValueHL'] = $ProductValue;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='//fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
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

@media screen and (max-width: 768px) {.data-middle_wrapper{ width:98%; margin:auto; background:#f0f0f0; padding:5px; border:#bababa solid thin; border-radius:10px;}
.data-middle_wrapper2{ width:98%; margin:5px auto; padding:5px 0px 0px 0px; background:#fcfbfb;}
}
-->
</style>
</head>
<body>
<!--top-->
<!--top-->
<!--logo navigation-->
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div style="clear:both; height:70px;"></div>
<div>
<div>
<div><strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com<br /><br />
    Thanks for applying Home Loan through deal4Loans.com. You will soon receive call from us to help you to find the best deal.</strong><br />
</div>
</div>
<div style="clear:both;"></div>
<div>
<div id="bodyCenter">
 <div id="nwcontainer">
<?php
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);
	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
	$Final_Bid[]= $val; 
	} 
	
	//print_r($Final_Bid);
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
<div class="overflow-width">
<table border="0" cellpadding="2" cellspacing="0" align="center" width="100%">
<tr>
  <td width="10%" height="41" align="center" bgcolor="#88a943" class="head-font-text">Bank Name</td>
  <td width="20%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Interest Rate</td>
  <td width="20%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">EMI(Per Month)</td>
  <td width="20%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Tenure</td>
  <td width="20%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Eligible Loan Amount</td>
  <td width="10%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Request for more <br>
    Information</td>
</tr>
        <?
		
for($i=0;$i<count($Final_Bid);$i++)
	{

	 if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{		 
		 $axisimg="new-images/slider/thumb/axis.jpg";
		list($axisprocfee,$axisemi,$axisinter,$axisprint_term,$axisviewLoanAmt)  = Axisbank($netAmount,$loan_amount,$age,$total_obligation,$property_value,$Employment_Status);
		
	if($axisviewLoanAmt>0 && $axisemi>0)
		{ $axisqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', 'Axis Bank', '".$axisinter."', '".$axisemi."','".$axisprint_term."', '".$axisviewLoanAmt."', Now(),'".$axisimg."')"); }
 	}
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
		 $idbiimg="";
	list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($idbiviewLoanAmt>0)
		{
			$idbiqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$idbiinter."', '".$idbiemi."', '".$idbiprint_term."', '".$idbiviewLoanAmt."', Now(),'".$idbiimg."')");
		}		
	}
			elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
			{
				list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
				if($iciciviewLoanAmt>0)
				{

					$iciciimg="new-images/slider/thumb/hfc_logo.jpg";
					$iciciqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$iciciinter."', '".$iciciactualemi."', '".$iciciprint_term."', '".$iciciviewLoanAmt."', Now(),'".$iciciimg."')");
				}
			}
			elseif($Final_Bid[$i]=="Citibank" || $Final_Bid[$i]=="Citibank")
			{
				
				list($citiemi,$citiinter,$cititerm,$citiloanamt)=Citibank_hl($netAmount,$age,$property_value,$Employment_Status); 
				//echo $citiemi." - ".$citiinter." - ".$cititerm." - ".$citiloanamt;
				if($citiloanamt>0)
				{
					$citiimg="homeimages/logo_citybank.jpg";
					$citiqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$citiinter."', '".$citiemi."', '".$cititerm."', '".$citiloanamt."', Now(),'".$citiimg."')");
				}
			}
			elseif($Final_Bid[$i]=="Bank Of Baroda" || $Final_Bid[$i]=="Bank Of Baroda")
			{echo "here";
				list($bobprocfee,$bobemi,$bobinter,$bobprint_term,$bobviewLoanAmt) =BankOfBaroda_Homeloan($netAmount,$age,$total_obligation,$property_value); 
			
				if($bobviewLoanAmt>0)
				{
					$bobimg="new-images/slider/thumb/bank-of-baroda.jpg";
					$bobqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', 'Bank Of Baroda', '9.50', '".$bobemi."','".$bobprint_term."', '".$bobviewLoanAmt."', Now(),'".$bobimg."')"); 
				}
			}
			elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank" || $Final_Bid[$i]=="HDFC Ltd")
			{
				$hdfcimg="new-images/slider/thumb/hdfc-h.jpg";
			list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
			if($hdfcviewLoanAmt>0)
			{	
				$hdfcqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$hdfcinter."', '".$hdfcemi."', '".$hdfcprint_term."', '".$hdfcviewLoanAmt."', Now(),'".$hdfcimg."')");
			}
			}
			elseif($Final_Bid[$i]=="Fedbank" || (strncmp ("Fedbank", $Final_Bid[$i],7))==0)
			{
				list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloannew($getnetAmount,$age,$obligation,$property_value,$loan_amount);
				if($federalloanamt>0)
				{
					$fedbnkimg="new-images/fedbank-nw.jpg";
					$fedbankqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$federalinter."', '".$federalemi."', '".$federalterm."', '".$federalloanamt."', Now(), '".$fedbnkimg."')");
				}				
			}
			elseif($Final_Bid[$i]=="PNB Housing Finance" || $Final_Bid[$i]=="Punjab National Bank" || $Final_Bid[$i]=="PNB housing")
			{
				$pnbimg="new-images/pnbhfl-logo1.jpg";
				list($pnbemi,$pnbinter,$pnbterm,$pnbloanamt) = PNB_Homeloan($getnetAmount,$age,$obligation,$property_value);
				if($pnbloanamt>0)
				{
					$pnbqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$pnbinter."', '".$pnbemi."', '".$pnbterm."', '".$pnbloanamt."', Now(),'".$pnbimg."')");
				}			
			}
			elseif($Final_Bid[$i]=="Tata Capital" || $Final_Bid[$i]=="TATA Capital")
			{
				$tataimg="new-images/tatacapital_pllogo.jpg";
				list($tataprocfee,$tataemi,$tatainter,$tataterm,$tataloanamt) = TATACapital_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$property_value,$Employment_Status);
				if($tataloanamt>0 && $tataloanamt>200000)
				{
					$pnbqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$tatainter."', '".$tataemi."', '".$tataterm."', '".$tataloanamt."', Now(),'".$tataimg."')");
				}			
			}
			elseif($Final_Bid[$i]=="SBI")
			{
				$sbiimg="new-images/sbi-logo-quote.jpg";
				list($sbiprocfee,$sbiemi,$sbiinter,$sbipterm,$sbiloanamt,$sbiterm) = sbi_homeloan($netAmount,$loan_amount,$age,$obligations,$City,$property_value);
				if($sbiloanamt>300000 && $sbiterm>0 && $sbiemi>0)
				{
					$sbiqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$sbiinter."', '".$sbiemi."', '".$sbipterm."', '".$sbiloanamt."', Now(),'".$sbiimg."')");
				}			
			}
			elseif($Final_Bid[$i]=="LIC Housing")
			{
				$licimg="new-images/lichfl_oct2015.jpg";
				list($licprocfee,$licemi,$licinter,$licpterm,$licloanamt,$licterm) = lic_homeloan($netAmount,$loan_amount,$age,$obligations,$City,$property_value);
				if($licloanamt>100000 && $licterm>0 && $licemi>0)
				{
					$licqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$licinter."', '".$licemi."', '".$licpterm."', '".$licloanamt."', Now(),'".$licimg."')");
				}			
			}
			elseif($Final_Bid[$i]=="Shubham Housing Finance")
			{//echo "i m here";
				list($shfmemi,$shfinter,$shfterm,$shfloanamt) = shubham_housing($getnetAmount,$age,$obligation,$property_value,$loan_amount);
				if($shfloanamt>=25000 && $shfterm>0 && $shfmemi>0)
				{
					$licqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$shfinter."', '".$shfmemi."', '".$shfterm."', '".$shfloanamt."', Now(),'')");
				}	
			}
			else
			{ 	} 
			}
			
			//for ends here 
			$hlshowquotes=ExecQuery("Select * from hl_quote_shown Where (hl_leadid=".$ProductValue.") order by hl_loanamount DESC");
			$deselect="";
		while($hlquote=mysql_fetch_array($hlshowquotes))
				 {
			if(strlen($hlquote["hl_bankname"])>2)
					 {
				$deselect.= $hlquote["hl_bankname"].",";
					 }
			if(strlen($hlquote["hl_img"])>5)
					 {
			$imagebank ='<img src="/'.$hlquote["hl_img"].'"/>';
					 }
					 else
					 {
				$imagebank=$hlquote["hl_bankname"];
					 }					
			?>
			<tr>
			 <td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $imagebank; ?></td>		  
			  <td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php 
			if($hlquote["hl_bankname"]=="Bank Of Baroda" || $hlquote["hl_bankname"]=="Bank Of Baroda")
					 {
						echo "9.05% - 9.55";
					 }
					 else
					 {
			echo $hlquote["hl_bankrate"]; } ?> %</td>
			   <td align="center" bgcolor="#ececec" class="head-font-text-b"><?php 
			if($hlquote["hl_bankname"]=="Bank Of Baroda" || $hlquote["hl_bankname"]=="Bank Of Baroda")
					 {
						$loan_amount=$hlquote["hl_loanamount"];
						$term=$hlquote["hl_banktenure"]*12;
						$interestrate1=9.05/1200;
						$interestrate2=9.55/1200;
						$actualemi1 = round($loan_amount * $interestrate1 / (1 - (pow(1/(1 + $interestrate1),$term))),0);
						$actualemi2 = round($loan_amount * $interestrate2 / (1 - (pow(1/(1 + $interestrate2),$term))),0);
						echo $bobemi = "Rs.".$actualemi1." - Rs.".$actualemi2;
					 }
					 else
					 {   
			if(strlen($hlquote["hl_bankemi"])>2) { echo "Rs.".$hlquote["hl_bankemi"];} else { echo "N.A";} } ?> </td>
			  <td align="center" bgcolor="#dedede" class="head-font-text-b"><?php if($hlquote["hl_banktenure"]>0) { echo $hlquote["hl_banktenure"]."yrs";} else { echo "N.A";} ?> </td>
			  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b"><?php if($hlquote["hl_loanamount"]>1) { echo "Rs.".abs($hlquote["hl_loanamount"]);} else { echo "N.A";} ?></td>
			 <td align="center" bgcolor="#e2e2e2">
			 <? if(($hlquote["hl_bankname"]=="Axis Bank" || $hlquote["hl_bankname"]=="Axis") && in_array("5651", $FinalBidderarr, true))
					 {
				?>
				<form action="apply_axishl_consent.php" method="POST" target="_blank" >
				<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
				<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $hlquote["hl_bankname"]; ?>">
				<input type="hidden" name="bidderid" id="bidderid" value="5651">
				<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
				</form>
				<?	 }
					 else
					 { ?>
			  <form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
			<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $hlquote["hl_bankname"]; ?>">
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
			$restOfBanks=ExecQuery("Select * from home_loan_interest_rate_chart Where (".$finalstr." and flag=1) group by bank_name");
			//echo "Select * from home_loan_interest_rate_chart Where (".$finalstr." and flag=1) group by bank_name";
			while($rstbnk=mysql_fetch_array($restOfBanks))
			{  
				//echo "here : ".$rstbnk["bank_name"]." - ".$loan_amount." - ".$age;
				list($bnkhlrates)=bankrates($rstbnk["bank_name"],$loan_amount,$age);
				if(strlen($bnkhlrates)>2)
				{
					if($rstbnk["bank_name"]=="Citibank")
					{ ?>
					<tr>
				  <td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $rstbnk["bank_name"]; ?></td>		
				  <td align="center" bgcolor="#e6e6e6" class="head-font-text-b" colspan="4">9.85% - 9.95%
			</td>
				   <td align="center" bgcolor="#e2e2e2"></td>
					</tr>
					 <? }
					else
					{
					?>
				<tr>
				<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $rstbnk["bank_name"]; ?></td>
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
            
            </div>
			<? $hlshowquotesdel=ExecQuery("Delete from hl_quote_shown Where hl_leadid=".$ProductValue.""); }
						else
		{ }?>
         </div>         
         <div style="margin-top:15px;">
         <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bgcolor="#e6edfd"><tr><td width="20%" rowspan="2" align="center" style="border:1px #FFFFFF solid;" ><table ><tr><td height="10">&nbsp;</td></tr><tr><td style="color:#000000; font-size:18px; ">Connect With Us</td></tr></table></td><td width="208" height="30" align="center" style=" color:#000000; font-size:14px; border:1px #666666 solid; border-top:1px #FFFFFF solid;"><b>Facebook</b></td><td width="169" align="center" style="color:#000000; font-size:14px; border-bottom:1px #666666 solid; "><b>Google +</b></td><td width="117" align="center" style="color:#000000; font-size:14px; border:1px #666666 solid; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;"><b>Twitter</b></td></tr><tr><td height="40" style="padding-left:20px; padding-top:10px; color:#000000; border:1px #666666 solid;"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font=tahoma&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></td><td align="center" style="padding-left:20px; color:#000000; border:1px #666666 solid;"><!-- Place this tag where you want the +1 button to render. -->
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
  <div style="margin-top:25px;" class="content_section_below"><span class="text11" style="color:#4c4c4c; width:100%;  margin-top:10px;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br />
Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates. </span></div>  
  </div>
</div>
</div></div><br />
<?php include "footer_sub_menu.php"; ?>
</body>
</html>