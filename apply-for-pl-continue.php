<?php	
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'hrAppFunction.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	
	
	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	
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

	
$getCompany_Name = $Company_Name;
		list($year,$month,$day) = split('[-]', $DOB);

$currentyear=date('Y');
$age=$currentyear-$year;

		$leadid = $_SESSION['leadid'];

$sql = "select City_Other,City,Salary_Drawn,Residential_Status, Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
list($CheckNumRows,$plrow)=Mainselectfunc($sql,$array = array());

		
		
		$getCompany_Name = $plrow['Company_Name'];
		$City = $plrow['City'];
		$Name = $plrow['Name'];
		$DOB = $plrow['DOB'];
		$Net_Salary = $plrow['Net_Salary'];
		$Other_City = $plrow['City_Other'];	
		$Salary_Drawn = $plrow['Salary_Drawn'];	
		$Residential_Status = $plrow['Residential_Status'];	

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


//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;

//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;
//echo "Net_Salary: ".$Net_Salary."<br>";
$monthsalary =$Net_Salary/12;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you</title>

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
-->
</style>
<style>
table {border-collapse:collapse;border-spacing:0;}

#bodyCenter #nwcontainer{background:url("http://www.deal4loans.com/new-images/container-bg.png") repeat-x; clear:both; width:850px; min-height:437px; padding:29px 10px 10px 10px;}
#bodyCenter #nwcontainer p strong{font:bold 14px Arial, Helvetica, sans-serif; color:#000; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer p{font:normal 12px Arial, Helvetica, sans-serif; color:#5c5e5e; line-height:18px; clear:both; text-align:center;}

#bodyCenter #nwcontainer #data{clear:both; margin:28px 0 15px 0;}
#bodyCenter #nwcontainer #data table{width:846px; margin:0 auto; position:relative;}
#bodyCenter #nwcontainer #data table tr{}
#bodyCenter #nwcontainer #data table tr th{font:bold 12px Arial, Helvetica, sans-serif; color:#3b5586; background:url("http://www.deal4loans.com/new-images/li-bg.jpg") repeat-x; height:33px; padding:3px 0 0 0;}
#bodyCenter #nwcontainer #data table tr th.bank{background:url("http://www.deal4loans.com/new-images/bank-name.png") no-repeat; width:116px;}
#bodyCenter #nwcontainer #data table tr td{border-bottom:2px solid #fff!important; height:80px;}
#bodyCenter #nwcontainer #data table tr td.banks{background:#f1f1f1; width:116px; text-align:center; padding:30px 0 0 0; height:50px; font:bold 10px Arial, Helvetica, sans-serif;}
#bodyCenter #nwcontainer #data table tr td.i-rate{background:#e7e6e6; text-align:center; font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:149px; }
#bodyCenter #nwcontainer #data table tr td.emi{background:#ececec; text-align:center;font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:161px; padding:0 0 0 5px;}
#bodyCenter #nwcontainer #data table tr td.tenure{text-align:center; font:bold 12px Arial, Helvetica, sans-serif; color:#706f6f; width:61px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/tenure-bg.jpg") repeat-y; text-align:center; }
#bodyCenter #nwcontainer #data table tr td.loan{text-align:left; font:bold 12px Arial, Helvetica, sans-serif; color:#706f6f; width:134px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/loan-bg.jpg") repeat-y; text-align:center;}
#bodyCenter #nwcontainer #data table tr td.info{text-align:left; font:bold 13px Arial, Helvetica, sans-serif; color:#bf2228; width:100px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/information.jpg") repeat-y; text-align:center; }
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div style="margin:auto; width:970px; height:5px; background-color:#88a943; margin-top:1px;"></div>
<div style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center" style="color:#FF0000;">
<?php 
$Is_Valid=1;
if($Is_Valid==1)
		{
	//echo "entered";
	//echo "<br>";
//echo $leadid.", ".$strCity;
list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);

$arrFinal_Bid = "";
		while (list ($key,$val) = @each($FinalBidder)) { 
			$arrFinal_Bid[]= $val; 
		} 

$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 

	$strFinal_Bid=implode(',',$arrFinal_Bid);
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
//print_r($strFinal_Bid);

if($leadid>0 && (strlen($strFinal_Bid)>0) && (($Salary_Drawn==2) || ($Salary_Drawn==3)) )
	{
//	echo "entered";
$arrfinal_bidders="";
$getbankid="";
for($i=0;$i<count($arrFinal_Bid);$i++)
		{	
			if(((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton")) && ($Residential_Status==1 || $Residential_Status==3 || $Residential_Status==4 || $Residential_Status==5))
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];
			}
			else if(((strncmp ("Citifinancial", $Final_Bid[$i],12))==0 || ($Final_Bid[$i]=="Citifinancial")))
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];
			}
			

		}
		//print_r($arrfinal_bidders);
		//print_r($getbankid);


		$getarrfinal_bidders=implode(',',$arrfinal_bidders);

	if(strlen($getarrfinal_bidders)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}

if(strlen($getarrfinal_bidders)>1)
{
	//$qry1="Update Req_Loan_Personal SET Bidderid_Details='".$getarrfinal_bidders."',Allocated='".$Allocated."', Direct_Allocation=1 Where RequestID=".$leadid;
	
	$DataArray = array("Bidderid_Details"=>$getarrfinal_bidders, "Allocated"=>$Allocated, "Direct_Allocation"=>1);
	$wherecondition ="RequestID=".$leadid;
	Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
	
	//$result1 = ExecQuery($qry1);
}
		else
		{
			$product="Personal Loan";	
				$feedback="Not Eligible";
				$plname = $Name;
					include "scripts/feedbackmailerscript.php";

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testing4use@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
		if(($feedback=="Not Eligible") && (strlen($Email)>0))
		{
			mail($Email,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
		}

		}

		
		}
		else
			{
			$product="Personal Loan";	
				$feedback="Not Eligible";
				$plname = $Name;
					include "scripts/feedbackmailerscript.php";

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testing4use@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
		if(($feedback=="Not Eligible") && (strlen($Email)>0))
		{
			mail($Email,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
		}

			}
		}

	

if ($leadid>0 && $Is_Valid==1 && (($Salary_Drawn==2) || ($Salary_Drawn==3)))
 {?>

 <?

 $getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
 
 list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());
 
 //echo $getcompany;
//$getcompanyresult = ExecQuery($getcompany);
//$grow=mysql_fetch_array($getcompanyresult);
//$recordcount = mysql_num_rows($getcompanyresult);
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$barclayscategory= $grow["barclays"];
$stanccategory = $grow["standard_chartered"];

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


if(count($FinalBidder)>0 && (strlen($strFinal_Bid)>1))
	 {
	?>
      <p><strong>Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a call from us to negotiate better.</strong></p>
	<div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px; color:#000000;"><b>Your application has been scanned under below mentioned Banks for Personal Loan Eligibility:<br />
<table><tr><td style="color:#000000;">&nbsp; 1) &nbsp;</td>
<td width="97"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" height="26"/></td>
<td style="color:#000000;">&nbsp;&nbsp; 2) &nbsp;</td>
<td width="86"> <img src="http://www.deal4loans.com/new-images/thnk-axis.gif" /></td>
<td  style="color:#000000;">&nbsp;&nbsp; 3) &nbsp;</td>
<td width="74"> <img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" /></td>
<td style="color:#000000;">&nbsp;&nbsp; 4) &nbsp;</td>
<td width="56"> <img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg" /></td>
<td style="color:#000000;">&nbsp;&nbsp;5)&nbsp;</td>
<td width="100"><img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="100" height="35" /></td>
</tr></table>
<font style="color:#000000;">--------------------------------------------------------------------------------------------------------------------------------------------<br /></font>
We have found as per your details you are eligibile for :<br /><br />

</b></div>
<div id="data" align="center">
<table border="0" cellpadding="2" cellspacing="0" align="center">
  <tr>
    <th width="50" class="bank">&nbsp;</th>
    <th width="167">Interest Rate</th>
    <th width="189">Emi (per Month)</th>
    <th width="46">Tenure</th>
    <th width="83">Eligible Loan<br /> 
      Amount</th>
    <th width="154">Request for more<br /> 
      Information</th>
  </tr>

	  <? 
   
if(count($FinalBidder)>0)
	 {
	?>
   
     <?
$getrespf="";
$getrespf="";
$getidpf="";
$actual_ident_proof="";
$actual_residence_proof="";
$actual_income_proof="";
$getinpf="";
$getdocpf="";
for($i=0;$i<count($arrfinal_bidders);$i++)
			{
	if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='')
	{

	}
	else if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Citibank")) && $citicategory=='')
	{

	}
	else
				{ $shownToBidders_Arr[] = $Final_Bid[$i];
//echo $Final_Bid[$i];
		//
		$sqlDoc = "select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'";
		
list($recordcount,$myrow)=Mainselectfunc($sqlDoc,$array = array());

if($recordcount>0)
				{
		$identification_prf=$myrow["identification_proof"];
	$residence_prf=$myrow["residence_proof"];
	$income_prf=$myrow["income_proof"];
	$document_prf=$myrow["document_proof"];
//echo $document_prf."<br>";
	$arrid_pf=explode(",",$identification_prf);
	$arrres_pf=explode(",",$residence_prf);
	$arrinc_pf=explode(",",$income_prf);
	$arrdoc_pf=explode(",",$document_prf);


$getidpf=array_intersect($Document_proof,$arrid_pf);
$getrespf=array_intersect($Document_proof,$arrres_pf);
$getinpf=array_intersect($Document_proof,$arrinc_pf);
$getdocpf=array_intersect($Document_proof,$arrdoc_pf);


}
?>
         <tr align="center">
<!--//add Bank alogos-->
<?
	if(($getbankid[$i]=="HDFC Bank") || ($getbankid[$i]=="HDFC"))
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />';
	}
else if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
		{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-fulrtn.jpg" />';
	}
	else if($getbankid[$i]=="Kotak")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif"  />';

	}
	else if($getbankid[$i]=="Citibank")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" />';
	
	}
	else if($getbankid[$i]=="Barclays Finance" || (strncmp ("Barclays", $getbankid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg"/>';
	
	}
	else if($getbankid[$i]=="Standard Chartered" || (strncmp ("Standard", $getbankid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg"/>';
	
	}
	else
		{
		$imagebank='';
		}
	
	?>
          <td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /></td>
	
    
	<? if(($getbankid[$i]=="HDFC Bank") || ($getbankid[$i]=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $hdfcinterestrate; ?></td>
		<td class="emi">Rs. <? echo $hdfcgetemicalc; ?></td>
		<td class="tenure"><? echo $hdfcterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $hdfcgetloanamout; ?></td>

	<?
		}
	else
		{?>
  <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
	<?	}
		//echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	else if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $fullertoninterestrate; ?></td>
		<td class="emi">Rs. <? echo $fullertongetemicalc; ?></td>
		<td class="tenure"><? echo $fullertonterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $fullertongetloanamout; ?></td>
	<?
		}
	else
		{?>
   <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
		<? }
		
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
	?>

	  <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
		
	<? //echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif((($getbankid[$i]=="CITIBANK") ||  ($getbankid[$i]=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlacemi)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory,$getCompany_Name);
	if($citigetloanamout>0)
		{
		?>
		<td class="i-rate"><? echo $citiinterestrate; ?></td>
		<td class="emi">Rs. <? echo $citigetemicalc; ?></td>
		<td class="tenure"><? echo $cititerm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $citigetloanamout; ?></td>

	<?
		}
	else
		{
		?>
 <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
		<? }

	}
	elseif($getbankid[$i]=="Barclays")
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $barclayinterestrate; ?></td>
		<td class="emi">Rs. <? echo $barclaygetemicalc; ?></td>
		<td class="tenure"><? echo $barclayterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $barclaygetloanamout; ?></td>
		<?
		}
	else
		{?>
  <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
		<? }
	}
	else
	{
	?>
	
   <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
		<? 
		
	}
	?>
    <td width="141">
    <?php
	
	if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
		{
		
    ?>
        <form action="get-instantquote-submit.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		  <input type="hidden" name="max_loan_amount" value="<?php echo $fullertongetloanamout ; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $fullertongetemicalc ; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $fullertonterm ; ?>" />
            <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
    
    <?php
	}
	else
	{
	?>
    <form action="apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
     <?php } ?> 
                   </td>
  </tr>
  <?
			}} ?>
			 <tr>
            <td colspan="6" align="right" style="font:bold 11px Arial, Helvetica, sans-serif;"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
          </tr>
</table>
</div>
 <? 	$shownToBidders_Str = implode(",",$shownToBidders_Arr);
 if($leadid>0)
		 {
	///$updtepltbl="Update Req_Loan_Personal Set checked_bidders='".$shownToBidders_Str."' where RequestID='".$leadid."'";
 //echo $getcompany;
//$updtepltblresult = ExecQuery($updtepltbl);

	$DataArray = array("checked_bidders"=>$shownToBidders_Str);
	$wherecondition ="RequestID='".$leadid."';
	Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
 }
	
	
	
	
	 }
 	 }	 

	 else
	 {?>
    <p><strong>Thanks for applying Personal Loan through Deal4loans.com.</strong></p>
 <p>
 <div align="left">
<span style="float:left; color:#000000; padding-left:4px;line-height:16px;">
<strong>Dear Customer</strong>,<br />
Thank you for choosing Deal4Loans.com as your preferred Personal Financial Solution partner.<br />
We have run pass through your loan application with following banks HDFC, ICICI, Axis, Fullerton, Standard Chartered & ING Vysya.<br />
We are sorry to inform you that currently there are no offers matching as per your profile.<br />
Our teams are continuously working towards getting better deals for our customers.<br />
</span></div>
</p>
	 <? }

      }
	   else
	 {?>
     <p><strong>Thanks for applying Personal Loan through Deal4loans.com.</strong></p>
 <p>
 <div align="left">
<span style="float:left; color:#000000; padding-left:4px;line-height:16px;">
<strong>Dear Customer</strong>,<br />
Thank you for choosing Deal4Loans.com as your preferred Personal Financial Solution partner.<br />
We have run pass through your loan application with following banks HDFC, ICICI, Axis, Fullerton, Standard Chartered & ING Vysya.<br />
We are sorry to inform you that currently there are no offers matching as per your profile.<br />
Our teams are continuously working towards getting better deals for our customers.<br />
</span></div>
</p>
	 <? }
	  ?>
   </div>
</div>
</div>
</div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>