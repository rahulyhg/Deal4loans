<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

	function getReqemailValue($pKey){
    $titles = array(
		'2628' => 'Sonia.S@hdfcbank.com,parul.singh@deal4loans.com',
		'5204' => 'Sonia.S@hdfcbank.com,parul.singh@deal4loans.com',
		'5733' => 'Sonia.S@hdfcbank.com,parul.singh@deal4loans.com',
		'5732' => 'Amara.Krishnaiah@hdfcbank.com,parul.singh@deal4loans.com',
		'2629' => 'Shekar.Thunga@hdfcbank.com,neha.gupta@deal4loans.com',
		'6477' => 'Shekar.Thunga@hdfcbank.com,neha.gupta@deal4loans.com',
        '2627' => 'Panneer.Thambusamy@hdfcbank.com',
		'5157' => 'Panneer.Thambusamy@hdfcbank.com',
        '2626' => 'Anuradha.Vijayan@hdfcbank.com,parul.singh@deal4loans.com',
		'5725' => 'Harishkumar.R@hdfcbank.com,parul.singh@deal4loans.com',
		'5724' => 'Harishkumar.R@hdfcbank.com,parul.singh@deal4loans.com',
		'3036' => 'Harishkumar.R@hdfcbank.com,parul.singh@deal4loans.com',
		'4403' => 'jyothi.alla@hdfcbank.com,neha.gupta@deal4loans.com',
		'4804' => 'jyothi.alla@hdfcbank.com,neha.gupta@deal4loans.com',
		'5717' => 'jyothi.alla@hdfcbank.com,neha.gupta@deal4loans.com',
        '6002' => 'parul.singh@deal4loans.com'
				 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

  function getReqcityValue($pKey){
    $titles = array(
		'2628' => 'Chennai',
		'5204' => 'Chennai',
		'5733' => 'Chennai',
		'2629' => 'Hyderabad',
		'4403' => 'Hyderabad',
		'4804' => 'Hyderabad',
		'5717' => 'Hyderabad',
        '3036' => 'Bangalore',
		'2627' => 'Bangalore',
		'5157' => 'Bangalore',
        '2626' => 'Cochin',
		'5382' => 'Delhi',
		'5724' => 'Bangalore1',
		'5725' => 'Bangalore1',
		'5732' => 'Chennai1',
		'5733' => 'Chennai1'
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function retrivedataforhdfc()
{
	$session_id=session_id();
	$Today = date("Y-m-d"); 
//	$Today = "2012-01-04"; 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	$hdfcpl = array('2628','5204','2629','4403','4804','5717','3036','2627','5157','2626','5725','5724','5732','5733'); //1950,5382

 for($k=0;$k<count($hdfcpl);$k++)
		 {
	 echo $hdfcpl[$k]."<br>";

	$citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,EMI_Paid,CC_Holder, Card_Vintage FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (".$hdfcpl[$k].") and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
	$search_result=ExecQuery($citifinquery);
	$recordcount = mysql_num_rows($search_result);
	//echo "i m in else".$citifinquery."<br><br>";

	while($row_result=mysql_fetch_array($search_result))
	{	
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
			if($row_result["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($row_result["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($row_result["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($row_result["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($row_result["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}
		
	$qry1="insert into temp (session_id, name, dob, email, mobile_number, std_code, landline, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid, loan_amount, card_vintage,  ip_address, add_comment,doe) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$row_result["Mobile_Number"]."','".$row_result["Std_Code"]."', '".$row_result["Landline"]."','".$emp_status."','".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."','".$row_result["Pincode"]."','".$cc_holder."','".$row_result["Net_Salary"]."','".$row_result["Loan_Any"]."','".$emi_paid."','".$row_result["Loan_Amount"]."','".$card_vintage."','".$row_result["IP_Address"]."','".$row_result["Add_Comment"]."','".$row_result["Allocation_Date"]."')";
		$result1=ExecQuery($qry1);
		 }
	
	$emailid=getReqemailValue($hdfcpl[$k]);
	echo "<br>";
	$cityname=getReqcityValue($hdfcpl[$k]);
	echo "<br>";
	
	$qry="select name, dob AS DOB, email AS EmailID, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS NoOfEMIPaid, loan_amount AS LoanAmt, card_vintage AS CardVintage, ip_address AS IPAddress,add_comment AS comments,doe AS DateOfEntry  from temp where session_id='".$session_id."' order by doe DESC ";		
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
	$result = ExecQuery($qry);
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
		 
	}
	//$value = '"' . $header . '"' . "\t";
	while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
		if(!isset($value) || $value == ""){
		  $value = '"' . $value . '"' . "\t";
		}else{
	# important to escape any quotes to preserve them in the data.
		  $value = str_replace('"', '""', $value);
	# needed to encapsulate data in quotes because some data might be multi line.
	# the good news is that numbers remain numbers in Excel even though quoted.
		  $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	  }
	  $newdata .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	$retnewdata = str_replace("\r", "", $header);
	$retnewdata .="\n"; 
  $retnewdata .= str_replace("\r", "", $newdata);

//echo $citifincity."hello::";
$newToday = date('d')."".date('m')."".date('y');
//$newToday ="170810";

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/hdfc/hdfcpl".$cityname."".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id, $emailid,$cityname);
			 }

			
		 }
		 
	}

	function sendexcelfileattachment($emailid,$session_id,$emailid,$cityname)
	{
		//$newToday ="170810";
		$newToday = date('d')."".date('m')."".date('y');
	//echo $emailid;
	//$to = "ranjana5chauhan@gmail.com"; 
	$to = $emailid; 
	     $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Personal Loan Leads @ deal4loans.com ".$cityname."".$newToday; 
       $fileatt = "/home/deal4loans/public_html/hdfc/hdfcpl".$cityname."".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "hdfcpl".$cityname."".$newToday.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: neha.gupta@deal4loans.com,neha.gupta20n@gmail.com"."\n";
		   
        $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $message . "\n\n";
    
        $data = chunk_split( base64_encode( $data ) );
                 
        $message .= "--{$mime_boundary}\n" . 
                 "Content-Type: {$fileatttype};\n" . 
                 " name=\"{$fileattname}\"\n" . 
                 "Content-Disposition: attachment;\n" . 
                 " filename=\"{$fileattname}\"\n" . 
                 "Content-Transfer-Encoding: base64\n\n" . 
                 $data . "\n\n" . 
                 "--{$mime_boundary}--\n"; 
                 
  
     if( mail( $to, $subject, $message, $headers ) ) {
         
            echo "<p>The email was sent.</p>"; 
         
        }
        else { 
        
            echo "<p>There was an error sending the mail.</p>"; 
         
        }
	$qry1="delete from `temp` where session_id='".$session_id."'";
	$result1 = ExecQuery($qry1);
    
    }
main();
function main()
{
	retrivedataforhdfc();
}
?>