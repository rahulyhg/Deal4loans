<?php require 'scripts/db_init.php';  $Citydetails = $_REQUEST['q']; ?><option value="">Select Pincode</option><?php $getPinSql = "SELECT * FROM sbi_cc_city_state_list WHERE city like '%".$Citydetails."%'"; list($numRowsCarName, $getCarNameQuery) = MainselectfuncNew($getPinSql,$array = array()); for($cN=0;$cN<$numRowsCarName;$cN++) { 	$Pincode = $getCarNameQuery[$cN]['pincode'];	?> 	<option value="<?php echo $Pincode; ?>"><?php echo $Pincode; ?></option><?php } ?>