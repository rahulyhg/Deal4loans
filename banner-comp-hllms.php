<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	session_start();
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

	$Email =  trim($_POST["Email"]);
	$PWD =  trim($_POST["PWD"]);
	if(isset($PWD) && isset($Email))
	{
			if($Email=="komli@d4l.com" && $PWD=="komli")
			{
				$_SESSION["Comp_Source"] = "komli";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "komli";
			}
			elseif($Email=="adchakra_hl@d4l.com" && $PWD=="compaign1")
		{ //$PWD=="adchakra"
			$_SESSION["Comp_Source"] = "Adchakra";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Adchakra";
		}
			elseif($Email=="admagnet_hl@d4l.com" && $PWD=="admagnethl")
		{
			$_SESSION["Comp_Source"] = "admagnet";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Admagnet";
		}
			elseif($Email=="clovedigital_hl@d4l.com" && $PWD=="compaign1")
		{ //$PWD=="clovedigital"
			$_SESSION["Comp_Source"] = "clove_network";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Clovedigital";
		}
			elseif($Email=="tyroo_hl@d4l.com" && $PWD=="compaign1")
		{ //$PWD=="tyroohl"
			$_SESSION["Comp_Source"] = "tyroo";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "tyroo";
		}
			elseif($Email=="ibibo_hl@d4l.com" && $PWD=="ibibohl")
		{
			$_SESSION["Comp_Source"] = "ibibohl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "IBIBO";
		}
		elseif($Email=="netcore_hl@d4l.com"  && $PWD=="netcorehl")
			{
				$_SESSION["Comp_Source"] = "netcorehl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Netcore";
			}	
			else
		{
			global $Msg;
			$Msg =  "** You are not Authorized. Please try again **";
		}

			
		  		 $strDir = dir_name();
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner-comp-hllmsview.php");
			exit;
	
		}
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
	}
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />


    
   <style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}

.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
</style>
  <Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Email, 'Email', 4))
	{
		return false;
	}
	var str=theFrm.Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
					return false;
					}
	if(!checkData(theFrm.PWD, 'Password', 3))
		return false;
	return true;
    }
 </Script>
 <body style="margin:0px; padding:0px; background-color:#45B2D8;">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse" valign="top">
	 <tr bgcolor="#FFFFFF">
	 <Td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="323" height="93" align="left" valign="top"><img src="images/logo.gif"  /></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="67" align="right" bgcolor="#C6E3F2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></Td>
   </tr>
	 <tr>
		<td style="padding-top:15px;">
			<table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
		
		  </table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td align="center">
		 
	 </td>
   </tr>
	 <tr>
    <td bgcolor="#45B2D8" ><table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="361" height="43" align="center" valign="middle"><img src="images/login-form-topshine-bg.gif" width="361" height="43"></td>
        </tr>
        <tr>
          <td height="156" align="center" valign="middle" background="images/login-form-login-bg.gif"><form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
			<table width="250" border="0" cellpadding="4" cellspacing="0">
			   
			   <tr>
				 <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
			   </tr>
			   <tr>
				 <td width="100%" class="style1">Email</td>
				 <td width="100%"><input type="text" name="Email" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" class="style1">Password</td>
				 <td width="100%"><input type="password" name="PWD" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" colspan="2" align="center"><input name="submit" type="image"  src="images/login-form-lgn-sbtn.gif" style="width:111px; height:35px; border:none;"></td>
			   </tr>
		  </table>
		 </form>
          </td>
        </tr>
        <tr>
          <td width="361" height="70" align="center" valign="middle"><img src="images/login-form-bot-shine-bg.jpg" width="361" height="70"></td>
    </tr>
  </table></td>
  </tr>
</table>
 
</body>
</html>
