<style>
.comment_form{ width:650px; float:left; background:#b6d7fe; border: #89BFE7 solid thin; padding:10px; }
.comment_text_a{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;}
.comment_text_b{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold; }
.comment_text_c{font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333; font-weight:bold;}
.comment_text_d{font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; }
/*.comment ul,li{ list-style:none; margin-left:25px;}*/
.comment ul li{ list-style:none; margin-left:0px;}
.reply_text{font-family:Arial, Helvetica, sans-serif; font-size:12px; color: #32A0D6; font-weight:bold; }
</style>
<script language="javascript">
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

function validateMe0(formm)
{  
	if(formm.name0.value=="")
	{
			alert("please enter your Name!");
			formm.name0.focus();
				return false;
	}
	if(formm.email0.value=="")
	{
			alert("please enter your email id!");
			formm.email0.focus();
				return false;
	}
	if(form.email0.value!="")
	{
		if (!validmail1(form.email0.value))
		{
			//alert("Please enter your valid email address!");
			form.email0.focus();
			return false;
		}

	}
	if(formm.comments0.value=="")
	{
			alert("please enter your comments!");
			formm.comments0.focus();
				return false;
	}
	if(formm.captcha0.value=="")
	{
			alert("please enter captcha!");
			formm.captcha0.focus();
				return false;
	}	
		
}

function validateMe(formm)
{  
	if(formm.name.value=="")
	{
			alert("please enter your Name!");
			formm.name.focus();
				return false;
	}
	if(formm.email.value=="")
	{
			alert("please enter your email id!");
			formm.email.focus();
				return false;
	}
	if(form.email.value!="")
	{
		if (!validmail(form.email.value))
		{
			//alert("Please enter your valid email address!");
			form.email.focus();
			return false;
		}

	}
	if(formm.comments.value=="")
	{
			alert("please enter your comments!");
			formm.comments.focus();
				return false;
	}
	if(formm.captcha.value=="")
	{
			alert("please enter captcha!");
			formm.captcha.focus();
				return false;
	}	
		
	}

function insRow(i)
{
	var ni = document.getElementById('myTable' + i);
	ni.innerHTML='<div class="comment_form"><form id="form" name="form" method="post" action="com_submit.php"  onSubmit="return validateMe(this);"><input type="hidden" readonly name="uri" id="uri" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>" ><input type="hidden" readonly name="current_id" id="current_id" value="'+ i +'" ><table ><tr><td valign="top" colspan="2" align="right"><a  onclick="deleteRow('+ i +')" style="cursor:pointer;"><img src="images/closelabel.png" border=0 ></a></td></tr><tr><td valign="top"><p class="comment_text_b">Name</p></td><td><input type="text" name="name" id="name" style="width:300px;" /></td></tr><tr><td valign="top"><p class="comment_text_b">Email</p></td><td><input type="text" name="email" id="email" style="width:300px;" /></td></tr><tr><td valign="top"><p class="comment_text_b">Comment</p></td><td><textarea name="comments" rows="5" style="width:500px;" ></textarea></td></tr><tr><td valign="middle"><p><span class="comment_text_b">Enter the code above</span></p></td><td align="left" ><table width="100%" border="0" cellspacing="0" cellpadding="0">  <tr>    <td width="23%" valign="bottom"><input type="text" name="captcha" id="captcha"></td><td width="77%" valign="bottom"><img src="captcha.php" alt="Comment"></td>  </tr></table></td></tr><tr><td colspan="2" align="right"><button type="submit"><img src="images/add-comment.png" border=0 ></button><div class="spacer"></div></td></tr></table></form></div>';
}
function deleteRow(i)
{
 	 var ni = document.getElementById('myTable' + i);
	 ni.innerHTML='';
}
</script>
<div style="height:470px; overflow:scroll; overflow-x:hidden; border:thin solid  #999;" class="common-comment-wrapper">
<table border="0" style="width:100%;" ><tr><td valign="top" style="padding-top:15px; padding-bottom:5px;">
<table style="width:100%; border-top:#333333 2px solid;"><tr><td>
<?php
 $queryCount = "SELECT * FROM `comments_pages` WHERE `parent` = '0' and Page_Name='".$_SERVER['SCRIPT_NAME']."' and Status=1";
 list($commentCount,$commentCountQuery)=MainselectfuncNew($queryCount,$array = array());

?>
<strong style="font-size:16px;"> <?php echo $commentCount; if($commentCount>1) echo "&nbsp;Comments"; else echo "&nbsp;Comment"; ?>, read them below or <a href="#putComment"  style="cursor:pointer;"><b><u>add one</u></b></a></strong>
</td></tr>
<!--<tr><td id="myTable0" ></td></tr> -->
</table>
<div id="getResult"><?php if (strlen($_SESSION['Msg'])>0) { echo $_SESSION['Msg']; $_SESSION['Msg'] =''; } ?></div>
<div id="displayResult">
<?php
function get_categories($parent = 0)
{
    $html = '<ul class="comment">';
    $query = "SELECT * FROM `comments_pages` WHERE `parent` = '$parent' and Page_Name='".$_SERVER['SCRIPT_NAME']."' and Status=1  order by Rid desc  limit 0,5";
	list($rowCount,$row)=MainselectfuncNew($query,$array = array());

    for($j=0;$j<$rowCount;$j++)    
    {
        $current_id = $row[$j]['Rid'];
		$dt = $row[$j]['Dated'];
		$dt_arr = explode(" ", $dt);
		$dt_day = explode('-',$dt_arr[0]);
		$dt_time = explode(':',$dt_arr[1]);
		$dt_mktime = mktime($dt_time[0], $dt_time[1], $dt_time[2], $dt_day[1] , $dt_day[2], $dt_day[0]);
		$finalDisplayDate = date("F j, Y g:i a", $dt_mktime);  

        $html .= '<li style="margin-left:25px; list-style:none;"><table><tr><td><span class="comment_text_c"><b>' . $row[$j]['Name'].'</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="comment_text_d">  '.$finalDisplayDate.'</span></td></tr>';
		$html .= '<tr><td class="comment_text_a">' . $row[$j]['Comment'].'</td></tr>';
		$html .= '<tr><td class="reply_text" ><a onClick="insRow('.$current_id.');" style="cursor:pointer;">Post Reply</a></td></tr>';
				$html .= '<tr><td id="myTable'.$current_id.'" ></td></tr></table>';
        $has_sub = NULL;
        $hasSql = "SELECT COUNT(`parent`) FROM `comments_pages` WHERE `parent` = '$current_id'";
		list($has_sub,$rowhasSql)=MainselectfuncNew($hasSql,$array = array());
        if($has_sub)
        {
            $html .= get_categories($current_id);
        }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
print get_categories();
?>
</div>
<div style="clear:both;"></div>
<?php $page = str_replace("/", "", $_SERVER['SCRIPT_NAME']); ?>
<div style="text-align:right;"><a href="comments_list.php?page=<?php echo $page; ?>" target="_blank" rel="nofollow">Load more Comments</a></div>
</td></tr>
<tr><td id="putComment" style="margin-left:25px;"><div class="comment_form"><form id="form0" name="form0" method="post" action="com_submit0.php"  onSubmit="return validateMe0(this);"><input type="hidden" readonly name="uri0" id="uri0" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>" ><input type="hidden" readonly name="current_id0" id="current_id0" value="0" ><table ><tr><td valign="top" colspan="2"><p class="comment_text_c" style="font-size:17px;">Add Comment</p></td></tr><tr><td valign="top"><p class="comment_text_b">Name</p></td><td><input type="text" name="name0" id="name0" style="width:300px;" /></td></tr><tr><td valign="top"><p class="comment_text_b">Email</p></td><td><input type="text" name="email0" id="email0" style="width:300px;" /></td></tr><tr><td valign="top"><p class="comment_text_b">Comment</p></td><td><textarea name="comments0" rows="3" style="width:100%;" ></textarea></td></tr><tr><td valign="middle"><p><span class="comment_text_b">Enter the code above</span></p></td><td align="left" ><table width="100%" border="0" cellspacing="0" cellpadding="0">  <tr>    <td width="23%" valign="bottom"><input type="text" name="captcha0" id="captcha0"></td><td width="77%" valign="bottom"><img src="/captcha.php" alt="captcha"></td>  </tr></table></td></tr><tr><td colspan="2" align="right"><button type="submit"><img src="http://www.deal4loans.com/images/add-comment.png" alt="Comment" border=0 ></button><div class="spacer"></div></td></tr></table></form></div></td></tr>
</table>
</div>